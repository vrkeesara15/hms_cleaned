<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : rajenderdaddanala@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Announcements 
 *  
 */
class Announcements extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Announcements_model');
        $this->load->language('Announcements');
        $this->load->library('pagination');         
    }    
    public function index() {      

        $breadcrumbarray = array('label'=> "Announcements",
                           'link' => base_url()."Announcements"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Announcements"); 
        $data['details']  = $this->Announcements_model->getAnnouncements();
        $this->template->load_view('Announcements',$data);    
    }
    public function addAnnouncements() {    
        if($this->session->userdata('user_role') != '1'){
            redirect(base_url().'Dashboard'); 
        }        
        $breadcrumbarray = array('label'=> "Announcements",
                           'link' => base_url()."Announcements"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Add Announcement");
        $data['action'] = 'add';               
        $data['charges'] = '';
        $data['emp_details'] =  $this->Common_model->getResult('emp_profile');
        $this->template->load_view('Announcements_add',$data);      
    }
    public function editAnnouncement($id="") {      
          if($this->session->userdata('user_role') != '1'){
            redirect(base_url().'Dashboard'); 
            }        
        $breadcrumbarray = array('label'=> "Announcements",
                           'link' => base_url()."Announcements"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Announcements"); 
        $data['charges'] = $this->Announcements_model->getAnnouncementCharges($id);   
        $data['announcementdata'] = $this->Announcements_model->get_Announcement_details($id);  
        $data['action'] = 'edit';    
        $data['emp_details'] =  $this->Common_model->getResult('emp_profile');
        $getEditEmployeeDetails =  $this->Announcements_model->getEditEmployeeDetails($id);
        $editEmployee = array_column($getEditEmployeeDetails, 'emp_id');
        $separator = "', '";
        $string = implode($separator, $editEmployee);
        $data['editEmployee'] = $editEmployee;
        $data['getEditEmployee'] = "['".$string."']";
        $this->template->load_view('Announcements_add',$data);        

    }
        
   public function insertAnnouncements() {
    
    if($_POST) {        
        $start_date  = $this->input->post('start_date');
        $end_date  = $this->input->post('end_date');
        $description  = $this->input->post('description');
        $action  = $this->input->post('action');        
        $emp_id = $this->input->post('employee_id');
        
        if($action == "add") {
            $inserData = array(
                            'start_date' => $start_date.date(' H:i:s'),
                            'end_date' => $end_date.date(' H:i:s'),
                            'description' => $description,
                            'emp_id' => '',
                            'inserted_by' => $this->session->userdata('adminuser_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
            $res = $this->Common_model->insertSingle('announcements', $inserData);
            $announcement_id = $res;
            $announcement_image = "";
            if($res){
                if(!empty($_FILES['announcement_image']['name'])) {
                   $announcement_image = $this->files_upload("assets/announcements/images/",'*','announcement_image',$res);
                   
                   $updateData['announcement_image'] = $announcement_image;
                   
                   $param = array('id'=>$res);
                    $affectedRows = $this->Common_model->updateRow('announcements',$updateData,$param);
                }
            }
            if(!empty($emp_id)){
                foreach ($emp_id as $key => $value) {
                    $inserData1 = array();
                   $inserData1 = array(
                                'announcement_id' => $announcement_id,
                                'start_date' => $start_date.date(' H:i:s'),
                                'end_date' => $end_date.date(' H:i:s'),
                                'description' => $description,
                                'announcement_image' => $announcement_image,
                                'emp_id' => $value,
                                'inserted_by' => $this->session->userdata('adminuser_id'),
                                'inserted_date' => date('Y-m-d H:i:s'));
                    $res1 = $this->Common_model->insertSingle('employee_announcements', $inserData1);
                } 
            }else{
                $inserData1 = array(
                                'announcement_id' => $announcement_id,
                                'start_date' => $start_date.date(' H:i:s'),
                                'end_date' => $end_date.date(' H:i:s'),
                                'description' => $description,
                                'announcement_image' => $announcement_image,
                                'emp_id' => 0,
                                'inserted_by' => $this->session->userdata('adminuser_id'),
                                'inserted_date' => date('Y-m-d H:i:s'));
                $res1 = $this->Common_model->insertSingle('employee_announcements', $inserData1);
            }
            
        } else {
            $announcement_id = $this->input->post('announcement_id');
            $updateData['start_date'] = $this->input->post('start_date').date(' H:i:s');
            $updateData['end_date'] = $this->input->post('end_date').date(' H:i:s');
            $updateData['description'] = $this->input->post('description');
            $updateData['emp_id'] = $this->input->post('employee_id');
            $announcement_image = "";
              
            if(!empty($_FILES['announcement_image']['name'])) {
               $announcement_image = $this->files_upload("assets/announcements/images/",'*','announcement_image',$res);
               $updateData['announcement_image'] = $announcement_image;
            }
            $id = $announcement_id;
            $param = array('id'=>$announcement_id);
            $affectedRows = $this->Common_model->updateRow('announcements',$updateData,$param);
            $param1 = array('announcement_id'=>$announcement_id);
            $this->Common_model->deleteRow('employee_announcements',$param1);
            $emp_id =  $this->input->post('employee_id');
            if(!empty($emp_id)){
                foreach ($emp_id as $key => $value) {
                    $inserData1 = array();
                   $inserData1 = array(
                                'announcement_id' => $announcement_id,
                                'start_date' => $this->input->post('start_date').date(' H:i:s'),
                                'end_date' => $this->input->post('end_date').date(' H:i:s'),
                                'description' => $this->input->post('description'),
                                'announcement_image' => $announcement_image,
                                'emp_id' => $value,
                                'inserted_by' => $this->session->userdata('adminuser_id'),
                                'inserted_date' => date('Y-m-d H:i:s'));
                    $res1 = $this->Common_model->insertSingle('employee_announcements', $inserData1);
                }
            }else{
                $inserData1 = array(
                                'announcement_id' => $announcement_id,
                                'start_date' => $this->input->post('start_date').date(' H:i:s'),
                                'end_date' => $this->input->post('end_date').date(' H:i:s'),
                                'description' => $this->input->post('description'),
                                'announcement_image' => $announcement_image,
                                'emp_id' => 0,
                                'inserted_by' => $this->session->userdata('adminuser_id'),
                                'inserted_date' => date('Y-m-d H:i:s'));
                    $res1 = $this->Common_model->insertSingle('employee_announcements', $inserData1);
            }
        }        
        $red=base_url()."Announcements";
        redirect($red);
    }
    }
    public function delete(){       
        if($this->session->userdata('user_role') != '1'){
                redirect(base_url().'Dashboard'); 
        }              
         $announcement_id = $this->input->post('announcement_id');
         $param = array('id'=>$announcement_id);
         $this->Common_model->deleteRow('announcements',$param);  
         $param = array('announcement_id'=>$announcement_id);
         $this->Common_model->deleteRow('employee_announcements',$param); 
         
    } 
    
    public function change_status(){
        $announcement_id = $this->input->post('id');
        $updateData['status'] = ($this->input->post('status')=='y')?'n':'y';
        $id = $announcement_id;
        $param = array('id'=>$announcement_id);
        $affectedRows = $this->Common_model->updateRow('announcements',$updateData,$param);
         $param1 = array('announcement_id'=>$announcement_id);
        $affectedRows1 = $this->Common_model->updateRow('employee_announcements',$updateData,$param1);
   }
   
   function files_upload($upload_path,$allowed_types,$filename,$receipt_id) {
        $config = array();
        $config['upload_path'] = $upload_path; 
        $config['allowed_types'] = $allowed_types; //
        $config['max_size'] = '2000';
        
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!empty($_FILES[$filename]['name'])) {
            $name = $_FILES[$filename]['name'];
            $file_ext = explode('.',$name);
            $ext = end($file_ext);
             $new_file_name = 'announcement_'.time().'.'.$ext;

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
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
