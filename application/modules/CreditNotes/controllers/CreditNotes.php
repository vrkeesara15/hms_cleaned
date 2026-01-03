<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Project : Admin Panel
 * Version v1.0
 * Controller : CreditNotes 
 *  
 */
class CreditNotes extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('CreditNotes_model');
        $this->load->language('CreditNotes');
        $this->load->library('pagination');
        $this->load->helper('phpass');   
    }    
    public function index() { 
        if($_POST) {
                $start_date = $this->input->post('start_date');
                $end_date = $this->input->post('end_date');
        } else {
             $start_date = '';
             $end_date = '';
        }
        
        $fields = array();
        $fields['start_date'] = $start_date;
        $fields['end_date'] = $end_date;
        $breadcrumbarray = array('label'=> "Credit Notes",
                           'link' => base_url()."CreditNotes"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Credit Notes");  
        $data["Credit_notes"] = $this->CreditNotes_model->getAllCreditNotesNew($fields);
        /*echo "<pre>";
        echo "New";
        print_r($_POST);
        print_r($fields);
        echo $this->db->last_query();
        exit();*/
        $data['page'] = $page;
        $loanaccounts = (array)$this->Common_model->getResult('Loanaccounts');
        $data['barrower_name_array'] = array_combine(array_column($loanaccounts, 'loan_ac_number'),array_column($loanaccounts, 'barrower_name'));
        $this->template->load_view('credit_notes', $data);
    }
    public function index1() { 
        /*if(isset($_POST)) {
                $start_date = ($this->input->post('start_date'))?$this->input->post('start_date'):'';
                $end_date = ($this->input->post('end_date'))?$this->input->post('end_date'):'';
        } else {
             $start_date = '';
             $end_date = '';
        }
        $fields = array();
        $fields['start_date'] = $start_date;
        $fields['end_date'] = $end_date;*/
        $fields = array();
        $breadcrumbarray = array('label'=> "Credit Notes",
                           'link' => base_url()."CreditNotes"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Credit Notes");  
                $config['base_url'] = base_url().'/CreditNotes/';
                $config["total_rows"] = $this->CreditNotes_model->getCreditNotesCounts($fields);
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
                $data["Credit_notes"] = $this->CreditNotes_model->getAllCreditNotes($config["per_page"], $page,$fields);
                $data['page'] = $page;
                $loanaccounts = (array)$this->Common_model->getResult('Loanaccounts');
                $data['barrower_name_array'] = array_combine(array_column($loanaccounts, 'loan_ac_number'),array_column($loanaccounts, 'barrower_name'));
                $data["links"] = $this->pagination->create_links();
            if($_POST){           
                $this->load->view('credit_notes_ajax', $data);
            }else {
                $this->template->load_view('credit_notes', $data);
            }

    }
    
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
