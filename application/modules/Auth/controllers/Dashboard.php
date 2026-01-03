<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
        $this->template->set_title('Welcome');
        $this->load->model(array('Common_model','Dashboard_model'));
        if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        
	}	
	public function index()
	{
	//echo "<pre>"; print_r($this->session->all_userdata()); exit;
		$this->template->set_subpagetitle("Manage Dashboard");
		$breadcrumbarray = array('label'=> "Dashbord",
                       'link' => base_url()."Dashboard"
                       );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->load_view('Dashboard');
	}
}