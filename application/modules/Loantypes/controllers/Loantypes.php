<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : ch.v.sudhakar9@gmail.com, phpguidance@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Loantypes 
 *  
 */
class Loantypes extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Loantypes_model');
        $this->load->language('Loantypes');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Loantypes",
                           'link' => base_url()."Loantypes"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loantypes"); 
        $data['details']  = $this->Loantypes_model->getAllLoantypes();
        $this->template->load_view('Loantypes',$data);        

    }
    public function addLoantypes() {      

        if($this->session->userdata('user_role') != '1'){
            redirect(base_url().'Dashboard'); 
        }
        
        $breadcrumbarray = array('label'=> "Loantypes",
                           'link' => base_url()."Loantypes"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loantypes");
        $data['action'] = 'add';               
        $this->template->load_view('Loantypes_add',$data);   
   
      }
        public function editloanType($id="") {      
          if($this->session->userdata('user_role') != '1'){
            redirect(base_url().'Dashboard'); 
          }        
        $breadcrumbarray = array('label'=> "Loantypes",
                           'link' => base_url()."Loantypes"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Edit Loan Type Data"); 
        $data['typedata'] = $this->Loantypes_model->getLoantypeDetails($id);   
        $data['action'] = 'edit';    
        $this->template->load_view('Loantypes_add',$data);        

    }
        
   public function insertLoantypes() {
    if($_POST) {
        $type_name  = $this->input->post('type_name');
        $action  = $this->input->post('action');        
        if($action == "add") {            
            $inserData = array(
                            'type_name' => $type_name,
                            'inserted_by' => $this->session->userdata('adminuser_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));        
             $res = $this->Common_model->insertSingle('loantypes', $inserData);
        } else {
             $type_id = $this->input->post('type_id');
             $updateData['type_name'] = $type_name;
             $updateData['updated_by'] = $this->session->userdata('adminuser_id');
             $updateData['updated_date'] =date('Y-m-d H:i:s');   
             $id = $type_id;
             $param = array('type_id'=>$type_id);
             $affectedRows = $this->Common_model->updateRow('loantypes',$updateData,$param);
        }        
         $red=base_url()."Loantypes";
         redirect($red);
    }
  }
    public function delete(){       
        if($this->session->userdata('user_role') != '1'){
                redirect(base_url().'Dashboard'); 
        }              
         $type_id = $this->input->post('type_id');
         $param = array('type_id'=>$type_id);
         $this->Common_model->deleteRow('Loantypes',$param);        
    } 
   public function change_status(){
       echo  "<pre>";
       print_r($_POST);
   }
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
