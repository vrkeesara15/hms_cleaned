<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Rajendar
 * Email : rajenderdaddanala@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : RBO 
 *  
 */
 /*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

class RBO extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('RBO_model');
        $this->load->language('RBO');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "RBO",
                           'link' => base_url()."RBO"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage RBO"); 
        $data['details']  = $this->RBO_model->getRBO();
        $data['bank_details'] = $this->RBO_model->get_bank_details();
        $data['states'] = $this->RBO_model->get_state_details(); 
        $data['getAllRBO'] = $this->RBO_model->getAllRBO();
       // $data['getrboDocuments'] = $this->RBO_model->getrboDocuments();
        $this->template->load_view('RBO',$data);           

    }
    public function addRBO() {      

         if($this->session->userdata('user_role') == '3'){
            redirect(base_url().'Dashboard'); 
        }
        
        $breadcrumbarray = array('label'=> "RBO",
                           'link' => base_url()."RBO"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage RBO");
        $data['action'] = 'add';               
        $data['bank_details'] = $this->RBO_model->get_bank_details();  
        $data['states'] = $this->RBO_model->get_state_details(); 

        $this->template->load_view('RBO_add',$data);   
   
      }
        public function editEmpanelment($id="") {      
          if($this->session->userdata('user_role') == '3'){
            redirect(base_url().'Dashboard'); 
            }        
        $breadcrumbarray = array('label'=> "RBO",
                           'link' => base_url()."RBO"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage RBO"); 
        $data['RBOdata'] = $this->RBO_model->getRBOdata($id);   
        $data['bank_details'] = $this->RBO_model->get_bank_details();  
        $data['action'] = 'edit';    
        $this->template->load_view('RBO_add',$data);        

    }
        
   public function insertRBO($rbo_id ='') {
    
    if($_POST) {
         $action  = $this->input->post('action');
        $bank_id  = $this->input->post('bank_id');
         $state_id  = $this->input->post('state_id');
         $rbo_name  = $this->input->post('rbo_name');
         
        if($action == "add") {
            $inserData = array(
                            'bank_id' => $bank_id,
                            'state_id' => $state_id,
                            'rbo_name' => $rbo_name,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
             $id = $this->Common_model->insertSingle('rbo', $inserData);
            
            
        } else {
            $rbo_id = $this->input->post('rbo_id');
            $updateData['bank_id'] = $bank_id;
            $updateData['state_id'] = $state_id;
            $updateData['rbo_name'] = $rbo_name;
            $updateData['updated_by'] = $this->session->userdata('emp_id');
            $updateData['updated_date'] = date('Y-m-d H:i:s');
            $id = $rbo_id;
            $param = array('rbo_id'=>$rbo_id);
            $affectedRows = $this->Common_model->updateRow('rbo',$updateData,$param);
        }
        
         $red=base_url()."RBO";
                redirect($red);
    }
  }
 public function editRBO($rbo_id="") {      
         
         if($this->session->userdata('user_role') == '3'){
            redirect(base_url().'Dashboard'); 
        }
        
        $breadcrumbarray = array('label'=> "RBO",
                           'link' => base_url()."RBO"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage RBO");
        $data['action'] = 'edit';               
        $data['bank_details'] = $this->RBO_model->get_bank_details();  
        $data['states'] = $this->RBO_model->get_state_details(); 
        $data['RBOdata'] = $this->RBO_model->getRBOdata($rbo_id); 
       /* echo "<pre>";
        print_r($data);
        exit();*/
        $this->template->load_view('RBO_add',$data);   
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
          $rbo_id = $this->input->post('rbo_id');
         $param = array('rbo_id'=>$rbo_id);
         $getdetails =  $this->RBO_model->getRBOdata($rbo_id); 
         $getrboDocumentsData = $this->RBO_model->rboDocumentsData($rbo_id); 
         $this->Common_model->deleteRow('RBO',$param);
         unlink("./assets/rbo_doc/".$getdetails->rbo_doc);
          $this->Common_model->deleteRow('rbo_documents',$param);
         foreach($getrboDocumentsData as $key=>$value) {
             //echo "rbo_doc_id->".$value->rbo_doc_id."-".$value->rbo_doc."<br />";
              unlink("./assets/rbo_doc/".$value->rbo_doc);
         }
    } 
     public function updateRecord(){       
                     
        /* $rbo_doc_id = $this->input->post('rbo_doc_id');
         
         $this->Common_model->deleteRow('RBO',$param);
         
              $updateData['bank_id'] = $bank_id;
              $updateData['type_of_loan'] = $type_of_loan;
              $updateData['doc_name'] = $doc_name;
              $updateData['updated_by'] = $this->session->userdata('emp_id');
              $updateData['updated_date'] = date('Y-m-d H:i:s');
            $id = $rbo_id;
            if(!empty($_FILES['rbo_doc']['name'])) {
                $rbo_doc = $this->files_upload("assets/rbo_doc/",'*','rbo_doc',$id,'rbo_doc');
                $updateData['rbo_doc'] = $rbo_doc;
            }
            
             $param = array('rbo_doc_id'=>$rbo_doc_id);
             $affectedRows = $this->Common_model->updateRow('RBO',$updateData,$param);*/
    }
    /*public function test() {
        for($i=0;$i<=72;$i++) {
         $getrboDocumentsData = $this->RBO_model->rboDocumentsData($i);
         foreach($getrboDocumentsData as $key=>$value) {
             $param = array('rbo_id'=>$value->rbo_id);
             $this->Common_model->deleteRow('rbo_documents',$param);
            unlink("./assets/rbo_doc/".$value->rbo_doc);
             echo "rbo_doc_id->".$value->rbo_doc_id."-".$value->rbo_doc."<br />";
         }
        }

    }*/
    
   
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
