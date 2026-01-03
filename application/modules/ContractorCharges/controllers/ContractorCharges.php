<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Project : Admin Panel
 * Version v1.0
 * Controller : ContractorCharges
 *  
 */
class ContractorCharges extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('ContractorCharges_model');
        $this->load->language('ContractorCharges');
        $this->load->library('pagination');
        $this->load->helper('phpass');   
    }    
    public function index() {
        $breadcrumbarray = array('label'=> "Contractor Charges",
                           'link' => base_url()."ContractorCharges"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Contractor Charges");  

                $config['base_url'] = base_url().'/ContractorCharges/';
                $config["total_rows"] = $this->ContractorCharges_model->getContractorChargesCounts();
                $config["per_page"] = 10;
                $config["uri_segment"] = 2;
                $config['full_tag_open'] = '<ul class="pagination justify-content-end mb-0 mt-3">';
                $config['full_tag_close'] = '</ul>';
                $config['first_link'] = true;
                $config['last_link'] = true;
                $config['last_link'] = 'last';
                $config['first_link'] = 'first';
                $config['first_tag_open'] = '<li class="page-item">';
                $config['first_tag_close'] = '</li>';
                $config['prev_link'] = 'Previous';
                $config['prev_tag_open'] = '<li class="prev">';
                $config['prev_tag_close'] = '</li>';
                $config['next_link'] = 'Next';
                $config['next_tag_open'] = '<li class="page-item">';
                $config['next_tag_close'] = '</li>';
                $config['last_tag_open'] = '<li class="page-item">';
                $config['last_tag_close'] = '</li>';
                $config['cur_tag_open'] =  '<li  class="page-item  active"><a class="page-link"  href="#">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li class="page-item">';
                $config['num_tag_close'] = '</li>';

                $this->pagination->initialize($config);
                $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
                $data["contractorCharges"] = $this->ContractorCharges_model->getAllContractorCharges($config["per_page"], $page);
                $data['page'] = $page;
                $data["links"] = $this->pagination->create_links();
            if($_POST){           
                $this->load->view('contractor_charges_ajax', $data);
            }else {
                $this->template->load_view('contractor_charges', $data);
            }
    }
    
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
