<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : ch.v.sudhakar9@gmail.com, phpguidance@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Documents 
 *  
 */
class Documents extends MY_Controller {

    public function __construct(){
        parent::__construct();
         /*if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }*/        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Documents_model');
        $this->load->language('Documents');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Documents",
                           'link' => base_url()."Documents"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Documents"); 
        $data['details']  = $this->Documents_model->getDocuments();
        $this->template->load_view('Documents',$data);        

    }
    public function addDocuments($module_id='',$item_id='') {      

         /*if($this->session->userdata('user_role') != '1'){
            redirect(base_url().'Dashboard'); 
        }*/
        
        $breadcrumbarray = array('label'=> "Documents",
                           'link' => base_url()."Documents"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Documents");
        $data['action'] = 'add';
        $data['module_id'] = $module_id;
        $data['item_id'] = $item_id;
        $data['bank_details'] = $this->Documents_model->get_bank_details();   
        $this->template->load_view('Documents_add',$data);
    }      
   public function insertDocuments() {

    if($_POST) {
        
        $doc_name  = $this->input->post('doc_name');
        $action  = $this->input->post('action');
        $module_id = $this->input->post('module_id');
        $item_id = $this->input->post('item_id');
        if($action == "add") {             
            $doc_file = $this->files_upload("assets/documents/",'*','doc_file',$module_id,'doc_file');
            $inserData = array(                           
                            'doc_name' => $doc_name,
                            'doc_file' => $doc_file,
                            'module_id' =>$module_id,
                            'item_id' => $item_id,
                            'inserted_by' => $this->session->userdata('adminuser_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
            $res = $this->Common_model->insertSingle('documents', $inserData);
        } else {
            $doc_id = $this->input->post('doc_id');            
            $updateData['doc_name'] = $doc_name;
            $id = $doc_id;
            if(!empty($_FILES['doc_file']['name'])) {
                $doc_file = $this->files_upload("assets/documents/",'*','doc_file',$module_id,'doc_file');
                $updateData['doc_file'] = $doc_file;
            }
            $param = array('doc_id '=>$doc_id );
            $affectedRows = $this->Common_model->updateRow('documents',$updateData,$param);
        }        
        $red=base_url()."Documents";
        redirect($red);
    }
  }

  function files_upload($upload_path,$allowed_types,$filename,$emp_id,$type) {
        $config = array();
        $config['upload_path'] = $upload_path; //../upload/adImages
        $config['allowed_types'] = $allowed_types; //
        $config['max_size'] = '2000';
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
         $doc_id = $this->input->post('doc_id');
         $param = array('doc_id'=>$doc_id);
         $getdetails =  $this->Documents_model->getDocument($doc_id); 
         $this->Common_model->deleteRow('documents',$param);
         unlink("./assets/documents/".$getdetails->doc_file);
    } 

}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
