<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Sandeep Thoomula
 * Email : sandeep.thoomula@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Audits 
 *  
 */
class Audits extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Audits_model');
        $this->load->language('Audits');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Audits",
                           'link' => base_url()."Audits"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Audits"); 
        $data['details']  = $this->Audits_model->getAudits();
        $this->template->load_view('Audits',$data);        

    }
    public function addAudits() {      

        
        $breadcrumbarray = array('label'=> "Audits",
                           'link' => base_url()."Audits"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Audits");
        $data['action'] = 'add';               
          
        $this->template->load_view('Audits_add',$data);   
   
      }
      public function editBillingPeriod($id="") {      
        $breadcrumbarray = array('label'=> "Audits",
                           'link' => base_url()."Audits"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Edit Billing Period Data"); 
        $data['billingData'] = $this->Audits_model->getAuditsDetails($id);
        $data['action'] = 'edit';    
        $this->template->load_view('Audits_add',$data);        

    }
   
        
   public function insertAudits() {

    if($_POST) {
        
        $month  = $this->input->post('month');        
        $year  = $this->input->post('year');   
        $debit_file = "";
        $credit_file = "";
        $statement_file = "";
        $esi_receipt_file = "";
        $pf_receipt_file = "";
        $employee_salary_file = "";
        $contractor_charges_file = "";

        
        $action  = $this->input->post('action');
        if(!empty($_FILES['debit_file']['name'])) {
          $debit_file = $this->files_upload("assets/billing_period_files/",'*','debit_file','debit_file');
        }
        if(!empty($_FILES['credit_file']['name'])) {
          $credit_file = $this->files_upload("assets/billing_period_files/",'*','credit_file','credit_file');
        }
        if(!empty($_FILES['statement_file']['name'])) {
          $statement_file = $this->files_upload("assets/billing_period_files/",'*','statement_file','statement_file');
        }
        if(!empty($_FILES['contractor_charges_file']['name'])) {
          $contractor_charges_file = $this->files_upload("assets/billing_period_files/",'*','contractor_charges_file','contractor_charges_file');
        }
        if(!empty($_FILES['esi_receipt_file']['name'])) {
          $esi_receipt_file = $this->files_upload("assets/billing_period_files/",'*','esi_receipt_file','esi_receipt_file');
        }
        if(!empty($_FILES['pf_receipt_file']['name'])) {
          $pf_receipt_file = $this->files_upload("assets/billing_period_files/",'*','pf_receipt_file','pf_receipt_file');
        }
        if(!empty($_FILES['employee_salary_file']['name'])) {
          $employee_salary_file = $this->files_upload("assets/billing_period_files/",'*','employee_salary_file','employee_salary_file');
        }
        
        if($action == "add") {            
            $inserData = array(
                            'billing_month' => $month,
                            'billing_year' => $year,
                            'debit_file' => $debit_file,
                            'credit_file' => $credit_file,
                            'statement_file' => $statement_file,
                            'contractor_charges_file' => $contractor_charges_file,
                            'esi_receipt_file' => $esi_receipt_file,
                            'pf_receipt_file' => $pf_receipt_file,
                            'employee_salary_file' => $employee_salary_file,
                            'inserted_by' => $this->session->userdata('adminuser_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
        
             $res = $this->Common_model->insertSingle('billing_periods', $inserData);


        } else {
              $id = $this->input->post('billing_period_id');
              $updateData['billing_month'] = $month;
              $updateData['billing_year'] = $year;
              if(!empty($debit_file)){
                $updateData['debit_file'] = $debit_file;
              }
              if(!empty($credit_file)){
                $updateData['credit_file'] = $credit_file;
              }
              if(!empty($statement_file)){
                $updateData['statement_file'] = $statement_file;
              }
              if(!empty($contractor_charges_file)){
                $updateData['contractor_charges_file'] = $contractor_charges_file;
              }
              if(!empty($esi_receipt_file)){
                $updateData['esi_receipt_file'] = $esi_receipt_file;
              }
              if(!empty($pf_receipt_file)){
                $updateData['pf_receipt_file'] = $pf_receipt_file;
              }
              if(!empty($employee_salary_file)){
                $updateData['employee_salary_file'] = $employee_salary_file;
              }
              $updateData['updated_by'] = $this->session->userdata('adminuser_id');
              $updateData['updated_date'] = date('Y-m-d H:i:s');
            
              $param = array('id'=>$id);
              $affectedRows = $this->Common_model->updateRow('billing_periods',$updateData,$param);
        }
        
         $red=base_url()."Audits";
          redirect($red);
    }
  }

  public function viewBillingPeriod($id) {  
        
      $breadcrumbarray = array('label'=> "Audits",
                           'link' => base_url()."Audits"
                           );
      $link = breadcrumb($breadcrumbarray);
      $this->template->set_breadcrumb($link);
      $this->template->set_subpagetitle("Manage Billing Period"); 
      $data["billingData"] = $this->Audits_model->getAuditsDetails($id);      
      $this->template->load_view('BillingPeriod_view',$data);        

  }

    public function delete(){       
        if($this->session->userdata('user_role') != '1'){
                redirect(base_url().'Dashboard'); 
        }              
         $charge_id = $this->input->post('charge_id');
         $param = array('charge_id'=>$charge_id);
         $this->Common_model->deleteRow('billing_periods',$param);        
    } 


    function files_upload($upload_path,$allowed_types,$filename,$file_value) {
        $config = array();
        $config['upload_path'] = $upload_path; 
        $config['allowed_types'] = $allowed_types;
        
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!empty($_FILES[$filename]['name'])) {
            $name = $_FILES[$filename]['name'];
            $file_ext = explode('.',$name);
            $ext = end($file_ext);
             $new_file_name = $file_value.time().'.'.$ext;

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
