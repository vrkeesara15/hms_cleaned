<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : ch.v.sudhakar9@gmail.com, phpguidance@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Employees
 *  
 */
class Employees extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Employees_model');
        $this->load->language('Employees');
        $this->load->library('pagination');
        $this->load->helper('phpass');   
    }    
    public function index() {    
       // echo $this->session->userdata('user_role') ;exit;
        if($this->session->userdata('user_role') == '3' ){
            redirect(base_url().'Dashboard'); 
        }
        $breadcrumbarray = array('label'=> "Employees",
                           'link' => base_url()."Employees"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Employees");   
        //$data['employees'] = $this->Employees_model->getAllEmployees();
       // $this->template->load_view('Employees',$data);
      /* $config['base_url'] = base_url().'/Employees/';
                $config["total_rows"] = count($this->Employees_model->getAllEmployees());
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
                
            $data["employees"] = $this->Employees_model->getAllEmployeesCount($config["per_page"], $page);
                $data['page'] = $page;
                $data["links"] = $this->pagination->create_links();
            if($_POST){           
                $this->load->view('Employees_ajax', $data);
            }else {
                $this->template->load_view('Employees', $data);
            } */
            $data["employees"] = $this->Employees_model->getAllEmployeesCount(0,0);
            $this->template->load_view('Employees', $data);

    }
    public function addEmployee() { 
         if($this->session->userdata('user_role') == '3'){
            redirect(base_url().'Dashboard'); 
        }
        $breadcrumbarray = array('label'=> "Employees",
                           'link' => base_url()."Employees"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Employees");
        $data['action'] = 'add';          
        $data['admins'] = $this->Employees_model->getAdminusers();
        $this->template->load_view('Employees_add',$data);        

    }

    public function editEmployee($id="") {     
     if($this->session->userdata('emp_id') != $id AND  $this->session->userdata('user_role') =='3'){
            redirect(base_url().'Dashboard'); 
        } 
        $breadcrumbarray = array('label'=> "Employees",
                           'link' => base_url()."Employees"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Employees"); 
        $data['employeedata'] = $this->Employees_model->getEmployeeData($id);   
        $data['action'] = 'edit';                
        $data['admins'] = $this->Employees_model->getAdminusers(); 
       if($this->session->userdata('user_role') !='1' && $this->session->userdata('user_role') !='2'){
        $this->template->load_view('Employee_edit',$data);        
        }else {
             $this->template->load_view('Employees_add',$data);  
        }

    }

    public function viewEmployee($id) {  
     if($this->session->userdata('emp_id') != $id AND  $this->session->userdata('user_role') =='3'){
            redirect(base_url().'Dashboard'); 
        }     
        $breadcrumbarray = array('label'=> "Employees",
                           'link' => base_url()."Employees"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Employees"); 
        $data["employeedata"] = $this->Employees_model->getEmployeeData($id); 
        
        $totalAdvanceAmounts = $this->Employees_model->contractorAdvancePaidAmount($id);
        $totalPaidFromContractor = $this->Employees_model->contractPaidAmount($id);
        $totalManualDebits = $this->Common_model->contractorManualDebitAmount($id);
        if(!empty($totalAdvanceAmounts)){
            $advancePaidTotal = $totalAdvanceAmounts->advancePaidAmount;
        }else{
            $advancePaidTotal = 0;
        }
        if(!empty($totalPaidFromContractor)){
            $paidFromContractor = $totalPaidFromContractor->totalPaidAmount;
        }else{
            $paidFromContractor = 0;
        }
        if(!empty($totalManualDebits)){
            $manualDebitsPaid = $totalManualDebits->manualDebitAmount;
        }else{
            $manualDebitsPaid = 0;
        }
        
        $contractorAdvanceAmount = $advancePaidTotal - $paidFromContractor - $manualDebitsPaid;
        $data['contractorAdvanceAmount'] = $contractorAdvanceAmount;
        $totalAdvanceAmounts = $this->Employees_model->advanceRequestPayments($id);
        $data['advanceRequestPayments'] = $totalAdvanceAmounts;
        $settleAdvancePayments = $this->Employees_model->settleAdvancePayments($id);
        $data['settleAdvancePayments'] = $settleAdvancePayments;
        
        $data['manualDebits'] = $this->Employees_model->getManualDebits($id);
        
        
        $this->template->load_view('Employee_view',$data);        

    }
    
  public function insertEmployee() {

    if($_POST) {

        $fname  = $this->input->post('fname');
        $lname  = $this->input->post('lname');
        $phone  = $this->input->post('phone');
        $email  = $this->input->post('email');
        $phone2  = $this->input->post('phone2');
        $email2  = $this->input->post('email2');
	
	$pan_number  = $this->input->post('pan_number');
        $address  = $this->input->post('address');
        $account_number  = $this->input->post('account_number');
        $bank_name  = $this->input->post('bank_name');
        $ifsc_code  = $this->input->post('ifsc_code');
        $branch_name  = $this->input->post('branch_name');
        $branch_address  = $this->input->post('branch_address');
        $user_role = $this->input->post('user_role');
        $designation  = $this->input->post('designation');
        $action = $this->input->post('action');
        $area  = $this->input->post('area');
        if($action == "add") {
            $getMaxID = $this->Employees_model->getMaxID();
            $id = ($getMaxID->maxid+1);
            $employer_id_card = $this->files_upload("assets/employer_doc/id_card/",'*','employer_id_card',$id,'id_card');
            $employer_auth_letter = $this->files_upload("assets/employer_doc/auth_letter/",'*','employer_auth_letter',$id,'auth_letter');
            $employer_seal_format = $this->files_upload("assets/employer_doc/seal_format/",'*','employer_seal_format',$id,'seal_format');
            $employer_dra_certificate = $this->files_upload("assets/employer_doc/dra_certificate/",'*','employer_dra_certificate',$id,'dra_certificate');

            $employee_signature = $this->files_upload("assets/employee_doc/signature/",'*','employee_signature',$id,'signature');
            $employee_aadhar_card = $this->files_upload("assets/employee_doc/aadhar_card/",'*','employee_aadhar_card',$id,'aadhar_card');
            $employee_pan_card = $this->files_upload("assets/employee_doc/pan_card/",'*','employee_pan_card',$id,'pan_card');
            $employee_edu_certificate = $this->files_upload("assets/employee_doc/edu_certificate/",'*','employee_edu_certificate',$id,'edu_certificate');
            
            $police_verification_certificate = $this->files_upload("assets/employee_doc/police_verification_certificate/",'*','police_verification_certificate',$id,'police_certificate');
            $sbi_id_card = $this->files_upload("assets/employee_doc/sbi_id_card/",'*','sbi_id_card',$id,'sbi_id_card');
            $company_id_card = $this->files_upload("assets/employee_doc/company_id_card/",'*','company_id_card',$id,'company_id_card');
            
            $sbi_id_card = $this->files_upload("assets/employee_doc/sbi_id_card/",'*','sbi_id_card',$id,'sbi_id_card');
            $indian_bank_id_card = $this->files_upload("assets/employee_doc/indian_bank_id_card/",'*','indian_bank_id_card',$id,'indian_bank_id_card');
            $punjab_national_bank_id_card = $this->files_upload("assets/employee_doc/punjab_national_bank_id_card/",'*','punjab_national_bank_id_card',$id,'punjab_national_bank_id_card');
            $indian_overseas_bank_id_card = $this->files_upload("assets/employee_doc/indian_overseas_bank_id_card/",'*','indian_overseas_bank_id_card',$id,'indian_overseas_bank_id_card');
            $central_bank_of_india_id_card = $this->files_upload("assets/employee_doc/central_bank_of_india_id_card/",'*','central_bank_of_india_id_card',$id,'central_bank_of_india_id_card');
            $canara_bank_id_card = $this->files_upload("assets/employee_doc/canara_bank_id_card/",'*','canara_bank_id_card',$id,'canara_bank_id_card');
            $karur_vysya_bank_id_card = $this->files_upload("assets/employee_doc/karur_vysya_bank_id_card/",'*','karur_vysya_bank_id_card',$id,'karur_vysya_bank_id_card');
            
            
            $employee_resume = $this->files_upload("assets/employee_doc/resume/",'*','employee_resume',$id,'resume');
            if($this->session->userdata('user_role') =='1'){ 
            if($user_role == '2'){
                $manager_id  =  $this->session->userdata('emp_id');
            }else {
                $manager_id =$this->input->post('manager_id');
            }
           }else {
                 $manager_id  =  $this->session->userdata('emp_id');
           }

            $inserData = array(
                            'fname' => $fname,
                            'lname' => $lname,
                            'phone' => $phone,
                            'email' => $email,
                            'phone2' => $phone2,
                            'email2' => $email2,
                            'area' => $area,
                            'user_role' => $user_role,
                            'manager_id' => $manager_id,
			                'emp_address' => $address,
                            'account_number' => $account_number,
                            'ifsc_code' => $ifsc_code,
                            'bank_name' => $bank_name,
                            'branch_name' => $branch_name,
                            'pan_number' => $pan_number,
                            'branch_address' => $branch_address,
                            'employer_auth_letter' => $employer_auth_letter,
                            'employer_id_card' => $employer_id_card,
                            'employer_seal_format' => $employer_seal_format,
                            'employer_dra_certificate' => $employer_dra_certificate,
                            'employee_signature' => $employee_signature,
                            'employee_aadhar_card' => $employee_aadhar_card,
                            'employee_pan_card' => $employee_pan_card,
                            'employee_edu_certificate' => $employee_edu_certificate,
                            'employee_resume' => $employee_resume,
                            'police_verification_certificate' => $police_verification_certificate,
                            'sbi_id_card' => $sbi_id_card,
                            'indian_bank_id_card' => $indian_bank_id_card,
                            'punjab_national_bank_id_card' => $punjab_national_bank_id_card,
                            'indian_overseas_bank_id_card' => $indian_overseas_bank_id_card,
                            'central_bank_of_india_id_card' => $central_bank_of_india_id_card,
                            'canara_bank_id_card' => $canara_bank_id_card,
                            'karur_vysya_bank_id_card' => $karur_vysya_bank_id_card,
                            'company_id_card' => $company_id_card,
                            'designation' => $designation,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
             $res = $this->Common_model->insertSingle('emp_profile', $inserData);
             
             $password = $this->input->post('password');
             $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);  
             $hashedPassword = $hasher->HashPassword($password); 
             $inserData1 = array(
                            'user_email' => $email,
                            'emp_id' => $res,
                            'user_password' => $hashedPassword,
                            'user_role' => $user_role,
                            'user_fname' => $fname,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'),
                            'user_status' => 'n'
                        );
              $res = $this->Common_model->insertSingle('sg_users', $inserData1);
        } else {
            $emp_id = $this->input->post('emp_id');
              $updateData['fname'] = $fname;
              $updateData['lname'] = $lname;
              $updateData['phone'] = $phone;
              $updateData['email'] = $email;
              $updateData['phone2'] = $phone2;
              $updateData['email2'] = $email2;
              $updateData['area'] = $area;
              $updateData['designation'] = $designation;
	      
	      $updateData['emp_address'] = $address;
              $updateData['account_number'] = $account_number;
              $updateData['ifsc_code'] = $ifsc_code;
              $updateData['branch_name'] = $branch_name;
              $updateData['pan_number'] = $pan_number;
              $updateData['branch_address'] = $branch_address;
              $updateData['bank_name'] = $bank_name;
              $updateData['updated_date'] = date('Y-m-d H:i:s');
              $updateData['status'] = $this->input->post('status');
              $updateData['remarks'] = $this->input->post('remarks');
              $updateData['updated_by'] = $this->session->userdata('emp_id');

              $user_role = $this->input->post('user_role');
              $status  = $this->input->post('status');
             
            $id = $emp_id;
            if(!empty($_FILES['employer_id_card']['name'])) {
                $employer_id_card = $this->files_upload("assets/employer_doc/id_card/",'*','employer_id_card',$id,'id_card');
                $updateData['employer_id_card'] = $employer_id_card;
            }
            if(!empty($_FILES['employer_auth_letter']['name'])) {
                $employer_auth_letter = $this->files_upload("assets/employer_doc/auth_letter/",'*','employer_auth_letter',$id,'auth_letter');
                 $updateData['employer_auth_letter'] = $employer_auth_letter;
            }
            if(!empty($_FILES['employer_seal_format']['name'])) {
                $employer_seal_format = $this->files_upload("assets/employer_doc/seal_format/",'*','employer_seal_format',$id,'seal_format');
                $updateData['employer_seal_format'] = $employer_seal_format;
            }

            if(!empty($_FILES['employer_dra_certificate']['name'])) {
                $employer_dra_certificate = $this->files_upload("assets/employer_doc/dra_certificate/",'*','employer_dra_certificate',$id,'dra_certificate');
                $updateData['employer_dra_certificate'] = $employer_dra_certificate;
            }

            if(!empty($_FILES['employee_signature']['name'])) {
                $employee_signature = $this->files_upload("assets/employee_doc/signature/",'*','employee_signature',$id,'signature');
                $updateData['employee_signature'] = $employee_signature;
            }

            if(!empty($_FILES['employee_aadhar_card']['name'])) {
                $employee_aadhar_card = $this->files_upload("assets/employee_doc/aadhar_card/",'*','employee_aadhar_card',$id,'aadhar_card');
                $updateData['employee_aadhar_card'] = $employee_aadhar_card;
            }
            
            if(!empty($_FILES['employee_pan_card']['name'])) {
                $employee_pan_card = $this->files_upload("assets/employee_doc/pan_card/",'*','employee_pan_card',$id,'pan_card');
                $updateData['employee_pan_card'] = $employee_pan_card;
            }
            
            if(!empty($_FILES['employee_edu_certificate']['name'])) {
                $employee_edu_certificate = $this->files_upload("assets/employee_doc/edu_certificate/",'*','employee_edu_certificate',$id,'edu_certificate');
                $updateData['employee_edu_certificate'] = $employee_edu_certificate;
            }
            if(!empty($_FILES['employee_resume']['name'])) {
               $employee_resume = $this->files_upload("assets/employee_doc/resume/",'*','employee_resume',$id,'resume');
               $updateData['employee_resume'] = $employee_resume;
            }
            
             if(!empty($_FILES['police_verification_certificate']['name'])) {
               $police_verification_certificate = $this->files_upload("assets/employee_doc/police_verification_certificate/",'*','police_verification_certificate',$id,'resume');
               $updateData['police_verification_certificate'] = $police_verification_certificate;
            }
            
            if(!empty($_FILES['sbi_id_card']['name'])) {
               $sbi_id_card = $this->files_upload("assets/employee_doc/sbi_id_card/",'*','sbi_id_card',$id,'resume');
               $updateData['sbi_id_card'] = $sbi_id_card;
            }
            if(!empty($_FILES['indian_bank_id_card']['name'])) {
               $indian_bank_id_card = $this->files_upload("assets/employee_doc/indian_bank_id_card/",'*','indian_bank_id_card',$id,'resume');
               $updateData['indian_bank_id_card'] = $indian_bank_id_card;
            }
            if(!empty($_FILES['punjab_national_bank_id_card']['name'])) {
               $punjab_national_bank_id_card = $this->files_upload("assets/employee_doc/punjab_national_bank_id_card/",'*','punjab_national_bank_id_card',$id,'resume');
               $updateData['punjab_national_bank_id_card'] = $punjab_national_bank_id_card;
            }
            if(!empty($_FILES['indian_overseas_bank_id_card']['name'])) {
               $indian_overseas_bank_id_card = $this->files_upload("assets/employee_doc/indian_overseas_bank_id_card/",'*','indian_overseas_bank_id_card',$id,'resume');
               $updateData['indian_overseas_bank_id_card'] = $indian_overseas_bank_id_card;
            }
            if(!empty($_FILES['central_bank_of_india_id_card']['name'])) {
               $central_bank_of_india_id_card = $this->files_upload("assets/employee_doc/central_bank_of_india_id_card/",'*','central_bank_of_india_id_card',$id,'resume');
               $updateData['central_bank_of_india_id_card'] = $central_bank_of_india_id_card;
            }
            if(!empty($_FILES['canara_bank_id_card']['name'])) {
               $canara_bank_id_card = $this->files_upload("assets/employee_doc/canara_bank_id_card/",'*','canara_bank_id_card',$id,'resume');
               $updateData['canara_bank_id_card'] = $canara_bank_id_card;
            }
            if(!empty($_FILES['karur_vysya_bank_id_card']['name'])) {
               $karur_vysya_bank_id_card = $this->files_upload("assets/employee_doc/karur_vysya_bank_id_card/",'*','karur_vysya_bank_id_card',$id,'resume');
               $updateData['karur_vysya_bank_id_card'] = $karur_vysya_bank_id_card;
            }
            
             if(!empty($_FILES['company_id_card']['name'])) {
               $company_id_card = $this->files_upload("assets/employee_doc/company_id_card/",'*','company_id_card',$id,'resume');
               $updateData['company_id_card'] = $company_id_card;
            }
            
            if($this->session->userdata('user_role') =='1'){
                if($user_role == '2'){
                    $manager_id  =  $this->session->userdata('emp_id');
                }else {
                    $manager_id =$this->input->post('manager_id');
                }
           }else {
                $manager_id  =  $this->session->userdata('emp_id');
           }
           $updateData['manager_id'] = $manager_id;
            
             $param = array('id'=>$emp_id);
             
             $affectedRows = $this->Common_model->updateRow('emp_profile',$updateData,$param);
             //echo $this->db->last_query();exit;

             if($status == 'a'){
                $userData['user_status'] = 'y';
             }else {
                $userData['user_status'] = 'n';
             }                          
             $userData['updated_by'] = $this->session->userdata('emp_id');
             $userData['updated_date'] = date('Y-m-d H:i:s');
             $userData['user_role'] = $user_role;
             
             $password = $this->input->post('password');
             $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);  
             $hashedPassword = $hasher->HashPassword($password); 
             
             $userData['user_password'] = $hashedPassword;

             //update users table also
             $param = array('emp_id'=>$emp_id);
             $affectedRows = $this->Common_model->updateRow('sg_users',$userData,$param);
              //$updateData['status'] = $this->input->post('status');
        }
        
         $red=base_url()."Employees";
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
               return false;
             }
        } else {
            return false;
        }
  }
  public function changeStatus()    
    {
        $id = $_POST['id'];
        $staus = $_POST['status'];
        if($staus == 'a') {
        $formvalues['status'] = 'i';
         $loginsttaus['user_status'] = 'n';
        echo "0";
        } else {
        $formvalues['status'] = 'a';
        $loginsttaus['user_status'] = 'y';
        echo "1";
        }
        $this->Employees_model->changeStatus($formvalues, $id);
        $this->Employees_model->changeStatusLogin($loginsttaus, $id);

        //changeStatusLogin
    }
    public function addManualDebit(){
        if($_POST){
            $insertData['emp_id'] = $this->input->post('emp_id');
            $insertData['amount'] = $this->input->post('amount_paid');
            $insertData['debit_date'] = $this->input->post('payment_date');
            $insertData['debit_reason'] = $this->input->post('reason');
            $insertData['inserted_by'] = $this->session->userdata('emp_id');
            $insertData['inserted_date'] = date('Y-m-d H:i:s');
            $insertData['updated_by'] = $this->session->userdata('emp_id');
            $insertData['updated_date'] = date('Y-m-d H:i:s');
            $res = $this->Common_model->insertSingle('manual_debits', $insertData);
            $data['manualDebits'] = $this->Employees_model->getManualDebits($insertData['emp_id']);
            $respData = '<tr>
                      <th colspan="3">Manual Debits </th>
                      
                  </tr>
                  <tr>
                      <th>S.No</th>
                      <th>Date</th>
                      <th>Amount</th>
                  </tr>';
            if(!empty($data['manualDebits'])){ 
                $sno = 1; 
                foreach($data['manualDebits'] as $debitValue){
                    $respData .= '
                  <tr>
                      <th>'.$sno.'</th>
                      <th>'.Date('d-M-Y',strtotime($debitValue->debit_date)).'</th>
                      <th>'.$debitValue->amount.'</th>
                  </tr>';
                  $sno++;
                }
            }
            echo $respData;
            //$this->load->view('debits_ajax',$data);
            exit;
        }
    }
    public function delete(){             
         $id = $this->input->post('id');
          $param = array('id'=>$id);
         $this->Common_model->deleteRow('emp_profile',$param);
          $param1 = array('emp_id'=>$id);
         $this->Common_model->deleteRow('sg_users',$param1);
    }

}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
