<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
        $this->template->set_title('Welcome');
        $this->load->model('Common_model');
        if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
	}	
	public function index()
	{
		$this->template->set_subpagetitle("Manage Dashboard");
		$breadcrumbarray = array('label'=> "404 Error",
                       'link' => base_url()."Dashboard"
                       );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
		$this->template->load_view('404');
	
	}
}