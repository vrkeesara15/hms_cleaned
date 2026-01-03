<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : ch.v.sudhakar9@gmail.com, phpguidance@gmail.com
 * Project : Admin Panel
 * Version v1.0`
 * Controller : Employees
 *  
 */
class Logs extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Logs_model');
        $this->load->language('Logs');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Logs",
                           'link' => base_url()."Logs"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Logs");

         $emp_email ='';
         if($_POST){
          $emp_email = $this->input->post('emp_email');
         }  


          $config['base_url'] = base_url().'/Logs/';
          $config["total_rows"] = $this->Logs_model->getAlllogscounts($emp_email);
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
          $data["details"] = $this->Logs_model->getAllLogs($config["per_page"], $page, $emp_email);
          $data['page'] = $page;
          $data["links"] = $this->pagination->create_links();
           if($_POST){           
              $this->load->view('Logs_ajax', $data);
          }else {
              $this->template->load_view('Logs', $data);
          }

        //  $this->template->load_view('', $data);
                

    }
    public function addEmpanelment() {      
        if($this->session->userdata('user_role') != '1'){
            redirect(base_url().'Dashboard'); 
        }
        $breadcrumbarray = array('label'=> "Logs",
                           'link' => base_url()."Logs"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Logs");   
        $data['action'] = 'add';          
        $data['bank_details'] = $this->Logs_model->get_bank_details();   
        $data['state_details'] = $this->Logs_model->get_state_details();
        $this->template->load_view('Logs_add',$data);        

    
  }
   public function editEmpanelment($id="") {   
   if($this->session->userdata('user_role') != '1'){
            redirect(base_url().'Dashboard'); 
        }   
        $breadcrumbarray = array('label'=> "Logs",
                           'link' => base_url()."Logs"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Logs"); 
        $data['empanelmentdata'] = $this->Logs_model->getempanelmentdata($id);  
        $data['bank_details'] = $this->Logs_model->get_bank_details();   
        $data['state_details'] = $this->Logs_model->get_state_details(); 
        $data['action'] = 'edit';    
        $this->template->load_view('Logs_add',$data);        

    }
   public function insertLogs() {

    if($_POST) {
        
        $bank_id  = $this->input->post('bank_id');
        $state_id  = $this->input->post('state_id');
        $circle  = $this->input->post('circle');
        $action  = $this->input->post('action');
        
        if($action == "add") {
            $getMaxID = $this->Logs_model->getMaxID();
            $id = ($getMaxID->maxid+1);
            $agreement_doc = $this->files_upload("assets/empanelment_doc/agreement_doc/",'*','agreement_doc',$id,'agreement_doc');
            $inserData = array(
                            'bank_id' => $bank_id,
                            'state_id' => $state_id,
                            'circle' => $circle,
                            'agreement_doc' => $agreement_doc,
                            //'inserted_by' => $this->session->userdata('adminuser_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
             $res = $this->Common_model->insertSingle('Logs', $inserData);
        } else {
            $empanelment_id = $this->input->post('empanelment_id');
              $updateData['bank_id'] = $bank_id;
              $updateData['state_id'] = $state_id;
              $updateData['circle'] = $circle;
            $id = $empanelment_id;
            if(!empty($_FILES['agreement_doc']['name'])) {
                $agreement_doc = $this->files_upload("assets/empanelment_doc/agreement_doc/",'*','agreement_doc',$id,'agreement_doc');
                $updateData['agreement_doc'] = $agreement_doc;
            }
            
             $param = array('empanelment_id'=>$empanelment_id);
             $affectedRows = $this->Common_model->updateRow('Logs',$updateData,$param);
        }
        
         $red=base_url()."Logs";
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
         $empanelment_id = $this->input->post('empanelment_id');
         $param = array('empanelment_id'=>$empanelment_id);
         $getdetails =  $this->Logs_model->getempanelmentdata($empanelment_id); 
         $this->Common_model->deleteRow('Logs',$param);
         unlink("./assets/empanelment_doc/agreement_doc/".$getdetails->agreement_doc);
    } 

}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
