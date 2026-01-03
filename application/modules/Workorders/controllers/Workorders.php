<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : ch.v.sudhakar9@gmail.com, phpguidance@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Workorders
 *  
 */
class Workorders extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Workorders_model');
        $this->load->language('Workorders');
        $this->load->library('pagination');
        $this->load->helper('phpass');   
    }    
    public function index() {    
        $breadcrumbarray = array('label'=> "Workorders",
                           'link' => base_url()."Workorders"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Workorders");  

                $config['base_url'] = base_url().'/Workorders/';
                $config["total_rows"] = $this->Workorders_model->getWorkordersCounts();
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
                $data["Workorders"] = $this->Workorders_model->getAllWorkorders($config["per_page"], $page);
                $data['page'] = $page;
                $data["links"] = $this->pagination->create_links();
            if($_POST){           
                $this->load->view('Workorders_ajax', $data);
            }else {
                $this->template->load_view('Workorders', $data);
            }

    }
    public function addWorkorder($order_id = "") { 
         
        $breadcrumbarray = array('label'=> "Workorders",
                           'link' => base_url()."Workorders"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Workorders");
        $data['action'] = 'add';          
        $data['banks'] = $this->Workorders_model->getAllbanks();  
        $data['branchs'] ='';
        if($order_id !=''){
            $data['action'] = 'edit';
            $data['workorderData'] = $this->Workorders_model->getOrderDetails($order_id);
            $data['branchs'] = $this->Workorders_model->getBranchs($data['workorderData']->bank_id);
        }
        $this->template->load_view('Workorders_add',$data); 
    }
    public function getBranchas(){
        $bank_id = $this->input->post('bank_id');
        $branchs =  $this->Workorders_model->getBranchs($bank_id);
        header('Content-type: application/json');
        die( json_encode( $branchs ) );  
    }    
   
  public function insertWorkOrder() {

    if($_POST) {

        $bank_id  = $this->input->post('bank_id');
        $branch_id  = $this->input->post('branch_id');
        
        $loan_ac_number  = $this->input->post('loan_ac_number');
        $barrower_name  = $this->input->post('barrower_name');        
        $work_order_num  = $this->input->post('work_order_num');

        $action = $this->input->post('action');
        if($action == "add") {
            $emp_id = $this->session->userdata('emp_id');
            $inserData = array(
                            'bank_id' => $bank_id,
                            'branch_id'  => $branch_id,                          
                           
                            'work_order_num' => $work_order_num,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
             $res = $this->Common_model->insertSingle('workorders', $inserData);
             if($res){
                $work_order_doc = $this->files_upload("assets/workorderdoc/",'*','work_order_doc',$res,'work_order'); 
                $updatedata['work_order_doc'] = $work_order_doc;
                $updateParam = array('order_id'=>$res);
                $this->Common_model->updateRow('workorders',$updatedata,$updateParam);
             }
             
             
        } else {
                $order_id = $this->input->post('order_id');
                $updateData['bank_id'] = $bank_id;
                $updateData['branch_id'] = $branch_id;
               
                $updateData['barrower_name'] = $barrower_name;
                $updateData['work_order_num'] = $work_order_num;
                $updateData['updated_by'] = $this->session->userdata('emp_id');          
                $updateData['updated_date'] =date('Y-m-d H:i:s');             
            $id = $order_id;            
            if(!empty($_FILES['work_order_doc']['name'])) {
               $work_order_doc = $this->files_upload("assets/workorderdoc/",'*','work_order_doc',$id,'work_order'); 
               $updateData['work_order_doc'] = $work_order_doc;
            }            
             $param = array('order_id'=>$order_id);
             $affectedRows = $this->Common_model->updateRow('workorders',$updateData,$param);
        }        
         $red=base_url()."Workorders";
         redirect($red);
    }
  }

  function files_upload($upload_path,$allowed_types,$filename,$emp_id,$type) {
        $config = array();
        $config['upload_path'] = $upload_path; //../upload/adImages
        $config['allowed_types'] = $allowed_types; //
        $config['max_size'] = '20000';
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
  public function updateDateAndtime(){
   //   $now = '2022-04-28 05:42:35';
   // echo  $now;
   //  $new_time = date("Y-m-d H:i:s", strtotime('+3 hours +30 minutes', strtotime($now)));

   //  echo $new_time;

    $res = $this->Workorders_model->getAllWorkorders1();
    exit;
    foreach($res as $v){
        $olddate =$v->inserted_date;
        echo $olddate;
        echo "<br>";
        $new_time = date("Y-m-d H:i:s", strtotime('+5 hours +30 minutes', strtotime($olddate)));
       echo $new_time;
        echo "<br>";
        $order_id = $v->order_id;
        $param = array('order_id'=>$order_id);
        $updateData['inserted_date'] = $new_time;
             $affectedRows = $this->Common_model->updateRow('workorders',$updateData,$param);
    }
  }

}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
