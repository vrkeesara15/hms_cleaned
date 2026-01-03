<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Project : Admin Panel
 * Version v1.0
 * Controller : AdvanceRequests 
 *  
 */
class AdvanceRequests extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('AdvanceRequests_model');
        $this->load->language('AdvanceRequests');
        $this->load->library('pagination');
        $this->load->helper('phpass');   
    }    
    public function index($employee_id='') {    
        $breadcrumbarray = array('label'=> "Advance Requests",
                           'link' => base_url()."AdvanceRequests"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Advance Requests");  
        $data['emp_details'] =  $this->Common_model->getResult('emp_profile');
                $config['base_url'] = base_url().'/AdvanceRequests/';
                $config["total_rows"] = $this->AdvanceRequests_model->getAdvanceRequestsCounts();
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
                if(!empty($employee_id)) {
                    $data['employee_id'] = $employee_id;
                    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                    $data["AdvanceRequests"] = $this->AdvanceRequests_model->getAllAdvanceRequestsByEmpoyee($config["per_page"], $page,$employee_id);
                } else {
                    $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
                    $data["AdvanceRequests"] = $this->AdvanceRequests_model->getAllAdvanceRequests($config["per_page"], $page);
                }
                
                $data['page'] = $page;
                $loanaccounts = (array)$this->Common_model->getResult('Loanaccounts');
                
                $data["links"] = $this->pagination->create_links();
            if($_POST){           
                $this->load->view('advance_requests_ajax', $data);
            }else {
                $this->template->load_view('advance_requests', $data);
            }

    }
    function advanceRequests_add() {

        $breadcrumbarray = array('label'=> "Advance Requests",
                           'link' => base_url()."AdvanceRequests"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Advance Requests");
        $data['emp_details'] =  $this->Common_model->getResult('emp_profile');
        $data['action'] = 'add';          
        $this->template->load_view('advance_requests_add',$data);  
    }
    function insertAdvanceRequests() {
        
        $action = $this->input->post('action');
            if($action == 'add'){
                $emp_id = $this->session->userdata('emp_id');
                if($emp_id == 1){
                    $emp_id = $this->input->post('employee_id');
                }
                $insertData['emp_id'] = $emp_id;
                $insertData['requested_amount'] = $this->input->post('amount');
                $insertData['paid_amount'] = 0;
                $insertData['requested_date'] = date('Y-m-d H:i:s');
                $insertData['requested_purpose'] = $this->input->post('purpose');
                $insertData['inserted_by'] = $this->session->userdata('emp_id');
                $insertData['inserted_date'] = date('Y-m-d H:i:s');               
                $this->Common_model->insertSingle('advance_requests', $insertData);
                redirect(base_url().'AdvanceRequests');
            }
    }
    function updateApproveAmount() {
        
        $advance_request_id =  $this->input->post('mainModelId');
        
        $payment_receipt = $this->files_upload("assets/advance_request/payment_receipt/",'*','payment_receipt',$advance_request_id,'payment_receipt');

        
        $paymentData['advance_request_id'] = $advance_request_id;
        $paymentData['paid_amount'] = $this->input->post('amount_paid');
        $paymentData['payment_date'] = $this->input->post('payment_date');
        $paymentData['payment_receipt'] = $payment_receipt;
        $paymentData['inserted_by'] = $this->session->userdata('emp_id');
        $paymentData['inserted_date'] = date('Y-m-d H:i:s');
        
        $res1 = $this->Common_model->insertSingle('advance_payment_audit',$paymentData);
        
        $previousPaymentData = $this->AdvanceRequests_model->getPaidTotalAdvance($advance_request_id);
        if(!empty($previousPaymentData)){
            $updateData['paid_amount'] = $previousPaymentData->paid_amount;
            $updateData['payment_date'] = $this->input->post('payment_date');
            $updateData['paid_status'] = 'y';
            $updateData['updated_by'] = $this->session->userdata('emp_id');
            $updateData['updated_date'] = date('Y-m-d H:i:s');
            
            $updateParam = array('advance_request_id'=>$advance_request_id);
            $res = $this->Common_model->updateRow('advance_requests', $updateData,$updateParam);
            
        }else{
            $updateData['paid_amount'] = $this->input->post('amount_paid');
            $updateData['payment_date'] = $this->input->post('payment_date');
            $updateData['paid_status'] = 'y';
            $updateData['updated_by'] = $this->session->userdata('emp_id');
            $updateData['updated_date'] = date('Y-m-d H:i:s');
            
            $updateParam = array('advance_request_id'=>$advance_request_id);
            $res = $this->Common_model->updateRow('advance_requests', $updateData,$updateParam);
            
        }
        
        redirect(base_url().'AdvanceRequests');
    }
    
    function rejectRequest($advance_request_id = '') {
        
        if($advance_request_id == ''){
            $advance_request_id =  $this->input->post('mainModelId');
        }
        
        
        $updateData['paid_status'] = 'r';
        $updateData['updated_by'] = $this->session->userdata('emp_id');
        $updateData['updated_date'] = date('Y-m-d H:i:s');
        
        $updateParam = array('advance_request_id'=>$advance_request_id);
        $res = $this->Common_model->updateRow('advance_requests', $updateData,$updateParam);
        
        
        redirect(base_url().'AdvanceRequests');
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
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
