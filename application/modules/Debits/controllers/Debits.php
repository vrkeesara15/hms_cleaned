<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Project : Admin Panel
 * Version v1.0
 * Controller : Debits 
 *  
 */
class Debits extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Debits_model');
        $this->load->model('Common_model');
        $this->load->language('Debits');
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
        $breadcrumbarray = array('label'=> "Debits",
                           'link' => base_url()."Debits"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Debits");  
        $data["Debits"] = $this->Debits_model->getAllDebits($fields);
        
        $data['page'] = $page;
        
        $this->template->load_view('debits', $data);
    }
    public function addExpense($id=""){
        $breadcrumbarray = array('label'=> "Debits",
                           'link' => base_url()."Debits"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Debits"); 
        if($id != ""){
            $data['action'] = 'edit';
            $data['debitData'] = $this->Common_model->getSingleRow('debits',array('id'=>$id));
        }else{
            $data['action'] = 'add';
        }


        $data["expenseTypes"] = $this->Debits_model->getExpenseType();
        if($_POST){
            $action = $this->input->post('action');
            if($action == 'edit'){
                $insertData['expense_type'] = $this->input->post('expense_type');
                $insertData['amount'] = $this->input->post('amount');
                $insertData['paid_to'] = $this->input->post('paid_to');
                $insertData['expense_description'] = $this->input->post('description');
                $insertData['payment_method'] = $this->input->post('payment_method');
                $insertData['tds_amount'] = $this->input->post('tds_amount');
                $insertData['transaction_date'] = $this->input->post('transaction_date');
                $insertData['gst_type'] = $this->input->post('gst_type');
                $insertData['updated_by'] = $this->session->userdata('emp_id');
                $insertData['updated_date'] = date('Y-m-d H:i:s');
                $debit_id = $this->input->post('debit_id');
                $updateParam = array('id'=>$debit_id);
                $res = $debit_id;
                $this->Common_model->updateRow('debits', $insertData,$updateParam);
                
            }else{
                $insertData['expense_type'] = $this->input->post('expense_type');
                $insertData['date_of_receipt'] = date('Y-m-d H:i:s');
                $insertData['amount'] = $this->input->post('amount');
                $insertData['paid_to'] = $this->input->post('paid_to');
                $insertData['expense_description'] = $this->input->post('description');
                $insertData['payment_method'] = $this->input->post('payment_method');
                $insertData['tds_amount'] = $this->input->post('tds_amount');
                $insertData['transaction_date'] = $this->input->post('transaction_date');
                $insertData['gst_type'] = $this->input->post('gst_type');
                $insertData['created_by'] = $this->session->userdata('emp_id');
                $insertData['created_date'] = date('Y-m-d H:i:s');
                $insertData['updated_by'] = $this->session->userdata('emp_id');
                $insertData['updated_date'] = date('Y-m-d H:i:s');
                $res = $this->Common_model->insertSingle('debits', $insertData);
            }
            
            

            if($res){
                if(!empty($_FILES['receipt']['name'])) {
                   $debit_receipt = $this->files_upload("assets/debits/receipts/",'*','receipt',$res);
                   $other_receipt = '';
                   if(!empty($_FILES['other_receipt']['name'])){
                       $other_receipt = $this->files_upload("assets/debits/other_receipts/",'*','other_receipt',$res);
                   }
                   $updateData['expense_receipt'] = $debit_receipt;
                   $updateData['other_receipt'] = $other_receipt;
                   $param = array('id'=>$res);
                    $affectedRows = $this->Common_model->updateRow('debits',$updateData,$param);
                    
                    redirect(base_url().'Debits');
                }else{
                    $other_receipt = '';
                   if(!empty($_FILES['other_receipt']['name'])){
                        $other_receipt = $this->files_upload("assets/debits/other_receipts/",'*','other_receipt',$res);
                        $updateData['other_receipt'] = $other_receipt;
                        $param = array('id'=>$res);
                        $affectedRows = $this->Common_model->updateRow('debits',$updateData,$param);
                   }
                    
                    redirect(base_url().'Debits');
                }
            }
            
            
        }else{
         $this->template->load_view('add_expense', $data);   
        }
        
        
        

    }

    function files_upload($upload_path,$allowed_types,$filename,$receipt_id) {
        $config = array();
        $config['upload_path'] = $upload_path; 
        $config['allowed_types'] = $allowed_types; //
        // $config['max_size'] = '2000';
        
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!empty($_FILES[$filename]['name'])) {
            $name = $_FILES[$filename]['name'];
            $file_ext = explode('.',$name);
            $ext = end($file_ext);
             $new_file_name = $receipt_id.'_receipt_'.time().'.'.$ext;

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
