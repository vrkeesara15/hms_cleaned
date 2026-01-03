<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : ch.v.sudhakar9@gmail.com, phpguidance@gmail.com
 * Project : Admin Panel
 * Version v1.0`
 * Controller : Empanelments
 *  
 */
class Empanelments extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Empanelments_model');
        $this->load->language('Empanelments');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Empanelments",
                           'link' => base_url()."Empanelments"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Empanelments");
        $data['details']  = $this->Empanelments_model->getEmpanelments();
        $this->template->load_view('Empanelments', $data);        

    }
    public function addEmpanelment() {      
        if($this->session->userdata('user_role') == '3'){
            redirect(base_url().'Dashboard'); 
        }
        $breadcrumbarray = array('label'=> "Empanelments",
                           'link' => base_url()."Empanelments"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Empanelments");   
        $data['action'] = 'add';          
        $data['bank_details'] = $this->Empanelments_model->get_bank_details();   
        $data['state_details'] = $this->Empanelments_model->get_state_details();
        $this->template->load_view('Empanelments_add',$data);        

    
  }
   public function editEmpanelment($id="") {   
   if($this->session->userdata('user_role') == '3'){
            redirect(base_url().'Dashboard'); 
        }   
        $breadcrumbarray = array('label'=> "Empanelments",
                           'link' => base_url()."Empanelments"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Empanelments"); 
        $data['empanelmentdata'] = $this->Empanelments_model->getempanelmentdata($id);  
        $data['bank_details'] = $this->Empanelments_model->get_bank_details();   
        $data['state_details'] = $this->Empanelments_model->get_state_details(); 
        $data['action'] = 'edit';    
        $this->template->load_view('Empanelments_add',$data);        

    }
   public function insertEmpanelments() {

    if($_POST) {
        
        $bank_id  = $this->input->post('bank_id');
        $state_id  = $this->input->post('state_id');
        $circle  = $this->input->post('circle');
        $action  = $this->input->post('action');
        $start_date  = $this->input->post('start_date');
        $expiry_date  = $this->input->post('expiry_date');
        
        if($action == "add") {
            $getMaxID = $this->Empanelments_model->getMaxID();
            $id = ($getMaxID->maxid+1);
            $agreement_doc = $this->files_upload("assets/empanelment_doc/agreement_doc/",'*','agreement_doc',$id,'agreement_doc');
            $inserData = array(
                            'bank_id' => $bank_id,
                            'state_id' => $state_id,
                            'circle' => $circle,
                            'agreement_doc' => $agreement_doc,
                            'start_date'    => $start_date,
                            'expiry_date'    => $expiry_date,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
             $res = $this->Common_model->insertSingle('empanelments', $inserData);
        } else {
               $empanelment_id = $this->input->post('empanelment_id');
              $updateData['bank_id'] = $bank_id;
              $updateData['state_id'] = $state_id;
              $updateData['circle'] = $circle;
              $updateData['start_date'] = $start_date;
              $updateData['expiry_date'] = $expiry_date;
              $updateData['updated_by'] = $this->session->userdata('emp_id');
              $updateData['updated_date'] = date('Y-m-d H:i:s');
            $id = $empanelment_id;
            if(!empty($_FILES['agreement_doc']['name'])) {
                $agreement_doc = $this->files_upload("assets/empanelment_doc/agreement_doc/",'*','agreement_doc',$id,'agreement_doc');
                $updateData['agreement_doc'] = $agreement_doc;
            }
            
             $param = array('empanelment_id'=>$empanelment_id);
             $affectedRows = $this->Common_model->updateRow('empanelments',$updateData,$param);
        }
        
         $red=base_url()."Empanelments";
                redirect($red);
    }
  }

  function files_upload($upload_path,$allowed_types,$filename,$emp_id,$type) {
        $config = array();
        $config['upload_path'] = $upload_path; //../upload/adImages
        $config['allowed_types'] = $allowed_types; //
        // $config['max_size'] = '2000';
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!empty($_FILES[$filename]['name'])) {
            $name = $_FILES[$filename]['name'];
            $file_ext = explode('.',$name);
            $ext = end($file_ext);
             $new_file_name = $emp_id.'_'.$type.'_'.time().'.'.$ext;
             $_FILES['file']['name'] = $new_file_name;
             $_FILES['file']['type'] = $_FILES[$filename]['type'];
             $_FILES['file']['tmp_name'] = $_FILES[$filename]['tmp_name'];
             $_FILES['file']['error'] = $_FILES[$filename]['error'];
             $_FILES['file']['size'] = $_FILES[$filename]['size'];
             if($this->upload->do_upload('file')){
               $uploadData = $this->upload->data();
               $return_file_name = $uploadData['file_name'];
               return $uploadData['file_name'];
             } else {
               $error = array('error' => $this->upload->display_errors());
               log_message('error', $error);
               return false;
             }
        } else {
            return false;
        }
  }
    public function delete(){           
     if($this->session->userdata('user_role') != '1'){
            redirect(base_url().'Dashboard'); 
        }  
         $empanelment_id = $this->input->post('empanelment_id');
         $param = array('empanelment_id'=>$empanelment_id);
         $getdetails =  $this->Empanelments_model->getempanelmentdata($empanelment_id); 
         $this->Common_model->deleteRow('empanelments',$param);
         unlink("./assets/empanelment_doc/agreement_doc/".$getdetails->agreement_doc);
    } 

}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
