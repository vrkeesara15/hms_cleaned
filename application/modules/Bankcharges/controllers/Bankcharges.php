<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Sandeep Thoomula
 * Email : sandeep.thoomula@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Bankcharges 
 *  
 */
class Bankcharges extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Bankcharges_model');
        $this->load->language('Bankcharges');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Bankcharges",
                           'link' => base_url()."Bankcharges"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Bankcharges"); 
        $data['details']  = $this->Bankcharges_model->getBankcharges();
        $this->template->load_view('Bankcharges',$data);        

    }
    public function addBankcharges() {      

        
        $breadcrumbarray = array('label'=> "Bankcharges",
                           'link' => base_url()."Bankcharges"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Bankcharges");
        $data['action'] = 'add';               
        $data['banks'] = $this->Bankcharges_model->getAllbanks();   
        $this->template->load_view('Bankcharges_add',$data);   
   
      }
      public function editBankcharge($id="") {      
        $breadcrumbarray = array('label'=> "Bankcharges",
                           'link' => base_url()."Bankcharges"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Edit Bransh Data"); 
        $data['banks'] = $this->Bankcharges_model->getAllbanks();  
        $data['chargeData'] = $this->Bankcharges_model->getBankChargesDetails($id);
        $data['action'] = 'edit';    
        $this->template->load_view('Bankcharges_add',$data);        

    }
   
        
   public function insertBankcharges() {

    if($_POST) {
        
        $bank_id  = $this->input->post('bank_id');        
        $charge_name  = $this->input->post('charge_name');        
        $charge_amount  = $this->input->post('charge_amount');
        $notes  = $this->input->post('notes');
        $action  = $this->input->post('action');
        
        if($action == "add") {            
            $inserData = array(
                            'bank_id' => $bank_id,
                            'charge_name' => $charge_name,
                            'charge_amount' => $charge_amount,
                            'notes' => $notes,
                            'inserted_by' => $this->session->userdata('adminuser_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
        
             $res = $this->Common_model->insertSingle('bank_charges', $inserData);
        } else {
              $charge_id = $this->input->post('charge_id');
              $updateData['bank_id'] = $bank_id;
              $updateData['charge_name'] = $charge_name;
              $updateData['notes'] = $notes;
              $updateData['charge_amount'] = $charge_amount;
              $updateData['update_by'] = $this->session->userdata('adminuser_id');
              $updateData['update_date'] = date('Y-m-d H:i:s');
            $id = $charge_id;
             $param = array('charge_id'=>$charge_id);
             
             $affectedRows = $this->Common_model->updateRow('bank_charges',$updateData,$param);
        }
        
         $red=base_url()."Bankcharges";
          redirect($red);
    }
  }
    public function delete(){       
        if($this->session->userdata('user_role') != '1'){
                redirect(base_url().'Dashboard'); 
        }              
         $charge_id = $this->input->post('charge_id');
         $param = array('charge_id'=>$charge_id);
         $this->Common_model->deleteRow('bank_charges',$param);        
    } 
    public function getBranchas(){
      $bank_id =(($this->input->post('bank_id'))?$this->input->post('bank_id'):0);
      $state_id =(($this->input->post('state_id'))?$this->input->post('state_id'):0);
      $branchs =  $this->Bankcharges_model->getBankBranches($bank_id,$state_id);
      
      header('Content-type: application/json');
      die( json_encode( $branchs ) );  
    }
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
