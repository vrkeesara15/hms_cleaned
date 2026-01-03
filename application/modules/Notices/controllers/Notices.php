<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Sandeep Thoomula
 * Email : sandeep.thoomula@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Notices
 *  
 */
class Notices extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Notices_model');
        $this->load->language('Notices');
        $this->load->library('pagination');
        $this->load->helper('phpass');   
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 300);
    }    
    public function index() {    
        $breadcrumbarray = array('label'=> "Notices",
                           'link' => base_url()."Notices"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Notices");  

        $config['base_url'] = base_url().'/Notices/';
        $config["total_rows"] = $this->Notices_model->getFirstNoticesCounts();
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
        $data["notices"] = $this->Notices_model->getAllFirstNotices($config["per_page"], $page);
        $data['page'] = $page;
        $data["links"] = $this->pagination->create_links();
        
        if($_POST){           
            $this->load->view('Notices_ajax', $data);
        }else {
            $this->template->load_view('Notices', $data);
        }

    }

    public function secondNotice() {    
        $breadcrumbarray = array('label'=> "Notices",
                           'link' => base_url()."Notices"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage 2nd Notices");  

        $config['base_url'] = base_url().'/Notices/';
        $config["total_rows"] = $this->Notices_model->getSecondNoticesCounts();
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
        $data["notices"] = $this->Notices_model->getAllSecondNotices($config["per_page"], $page);
        $data['page'] = $page;
        $data["links"] = $this->pagination->create_links();
         
        if($_POST){           
            $this->load->view('Notices_ajax', $data);
        }else {
            $this->template->load_view('second_notices', $data);
        }

    }
    
     public function thirdNotice() {    
        $breadcrumbarray = array('label'=> "Notices",
                           'link' => base_url()."Notices"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage 2nd Notices");  

        $config['base_url'] = base_url().'/Notices/';
        $config["total_rows"] = $this->Notices_model->getThirdNoticesCounts();
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
        $data["notices"] = $this->Notices_model->getAllThirdNotices($config["per_page"], $page);
        $data['page'] = $page;
        $data["links"] = $this->pagination->create_links();
        if($_POST){           
            $this->load->view('Notices_ajax', $data);
        }else {
            $this->template->load_view('third_notices', $data);
        }

    }
    
    public function finalNotice() {  
        $breadcrumbarray = array('label'=> "Notices",
                           'link' => base_url()."Notices/finalNotice"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Final Notices");  

        $config['base_url'] = base_url().'/Notices/finalNotice';
        $config["total_rows"] = $this->Notices_model->getFinalNoticesCounts();
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
        $data["notices"] = $this->Notices_model->getAllFinalNotices($config["per_page"], $page);
        $data['page'] = $page;
        $data["links"] = $this->pagination->create_links();
        if($_POST){           
            $this->load->view('Notices_ajax', $data);
        }else {
            $this->template->load_view('final_notices_list', $data);
        }
    }
    
    public function addFirstNotice($notice_id = "",$generate=false) {
         
        $breadcrumbarray = array('label'=> "Notices",
                           'link' => base_url()."Notices"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Notices");
        $data['action'] = 'add';          
        $data['banks'] = $this->Notices_model->getAllbanks(); 
        $data['branchs'] ='';
        if($notice_id !=''){
            if($generate == true){
                $data['action'] = 'edit';
                $data['loandata'] = $this->Notices_model->getLoanDetails($notice_id);
                $data['branchs'] =  $this->Notices_model->getBranchs($data['loandata']->bank_id); 
                
            }else{
                $data['action'] = 'edit';
                
                $data['loandata'] = $this->Notices_model->getFirstNoticeById($notice_id);
                $data['branchs'] =  $this->Notices_model->getBranchs($data['loandata']->bank_id);    
                
            }
            
          
        }
        $data['generate'] = $generate;
        
        $this->template->load_view('first_notice_add',$data); 
    }
    
    
    public function addSecondNotice($notice_id = "",$generate=false) {
         
        $breadcrumbarray = array('label'=> "Notices",
                           'link' => base_url()."Notices"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Notices");
        $data['action'] = 'add';          
        $data['banks'] = $this->Notices_model->getAllbanks(); 
        $data['branchs'] ='';
        if($notice_id !=''){
            if($generate == true){
                $data['action'] = 'edit';
                $data['loandata'] = $this->Notices_model->getLoanDetails($notice_id);
                $data['branchs'] =  $this->Notices_model->getBranchs($data['loandata']->bank_id); 
                
            }else{
                $data['action'] = 'edit';
                
                $data['loandata'] = $this->Notices_model->getSecondNoticeById($notice_id);
                $data['branchs'] =  $this->Notices_model->getBranchs($data['loandata']->bank_id);    
                
            }
        }
        $data['generate'] = $generate;
        
       
        $this->template->load_view('second_notice_add',$data); 
    }
    
    public function addThirdNotice($notice_id = "",$generate=false) {
         
        $breadcrumbarray = array('label'=> "Notices",
                           'link' => base_url()."Notices"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Notices");
        $data['action'] = 'add';          
        $data['banks'] = $this->Notices_model->getAllbanks(); 
        $data['branchs'] ='';
        if($notice_id !=''){
            if($generate == true){
                $data['action'] = 'edit';
                $data['loandata'] = $this->Notices_model->getLoanDetails($notice_id);
                $data['branchs'] =  $this->Notices_model->getBranchs($data['loandata']->bank_id); 
                
            }else{
                $data['action'] = 'edit';
                
                $data['loandata'] = $this->Notices_model->getThirdNoticeById($notice_id);
                $data['branchs'] =  $this->Notices_model->getBranchs($data['loandata']->bank_id);    
                
            }
        }
        $data['generate'] = $generate;
        
        $this->template->load_view('third_notice_add',$data); 
    }
    
    public function addFinalNotice($notice_id = "",$generate=false) {
         
        $breadcrumbarray = array('label'=> "Notices",
                           'link' => base_url()."Notices/finalNotice"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Final Notice");
        $data['action'] = 'add';          
        $data['banks'] = $this->Notices_model->getAllbanks(); 
        $data['branchs'] ='';
        if($notice_id !=''){
            if($generate == true){
                $data['action'] = 'edit';
                $data['loandata'] = $this->Notices_model->getLoanDetails($notice_id);
                $data['branchs'] =  $this->Notices_model->getBranchs($data['loandata']->bank_id); 
                
            }else{
                $data['action'] = 'edit';
                
                $data['loandata'] = $this->Notices_model->getFinalNoticeById($notice_id);
                $data['branchs'] =  $this->Notices_model->getBranchs($data['loandata']->bank_id);    
                
            }
        }
        $data['generate'] = $generate;
        
        $this->template->load_view('final_notice_add',$data); 
    }
    public function getBranchas(){
        $bank_id = $this->input->post('bank_id');
        $branchs =  $this->Notices_model->getBranchs($bank_id);
        header('Content-type: application/json');
        die( json_encode( $branchs ) );  
    }
    
    public function firstNoticeView($id="") { 
        $data['loanAccountData'] = $this->Common_model->getSingleRow('loan_1st_notice',array('id'=>$id));
        $data['bankData'] = $this->Common_model->getSingleRow('allbanks',array('bank_id'=>$data['loanAccountData']->bank_id));
        $data['branchData'] = $this->Common_model->getSingleRow('allbranchs',array('branch_id'=>$data['loanAccountData']->branch_id));
        
        
        echo $this->load->view('first_notice_pdf',$data,true);

    }
    
    public function secondNoticeView($id="") { 
        $data['loanAccountData'] = $this->Common_model->getSingleRow('loan_2nd_notice',array('id'=>$id));
        $data['bankData'] = $this->Common_model->getSingleRow('allbanks',array('bank_id'=>$data['loanAccountData']->bank_id));
        $data['branchData'] = $this->Common_model->getSingleRow('allbranchs',array('branch_id'=>$data['loanAccountData']->branch_id));
        
        
        echo $this->load->view('second_notice_pdf',$data,true);

    }
    
    public function thirdNoticeView($id="") { 
        $data['loanAccountData'] = $this->Common_model->getSingleRow('loan_3rd_notice',array('id'=>$id));
        $data['bankData'] = $this->Common_model->getSingleRow('allbanks',array('bank_id'=>$data['loanAccountData']->bank_id));
        $data['branchData'] = $this->Common_model->getSingleRow('allbranchs',array('branch_id'=>$data['loanAccountData']->branch_id));
        
        
        echo $this->load->view('third_notice_pdf',$data,true);

    }
    
    public function finalNoticeView($id="") { 
        $data['loanAccountData'] = $this->Common_model->getSingleRow('loan_final_notice',array('id'=>$id));
        $data['bankData'] = $this->Common_model->getSingleRow('allbanks',array('bank_id'=>$data['loanAccountData']->bank_id));
        $data['branchData'] = $this->Common_model->getSingleRow('allbranchs',array('branch_id'=>$data['loanAccountData']->branch_id));
        
        echo $this->load->view('final_notice_pdf',$data,true);

    }
    
    public function generateFirstNotesPDF($id="",$s_id="") { 
        
        $data['loanAccountData'] = $this->Common_model->getSingleRow('loan_1st_notice',array('id'=>$id));
        
        $data['bankData'] = $this->Common_model->getSingleRow('allbanks',array('bank_id'=>$data['loanAccountData']->bank_id));
        $data['branchData'] = $this->Common_model->getSingleRow('allbranchs',array('branch_id'=>$data['loanAccountData']->branch_id));
        
        $invoice_pdf= $this->load->view('first_notice_pdf',$data,true);
        $pdfFilePath = "firstnotice-".$id.'-'.date('d-m-Y-his').".pdf";
        
        try {
            require_once "application/vendor/autoload.php";
            $mpdf = new \Mpdf\Mpdf();
            // $mpdf->SetWatermarkImage(base_url().'assets/images/final-Hanshitha-logo-watermark-3.png');
            // $mpdf->showWatermarkImage = true;
            $mpdf->WriteHTML($invoice_pdf);
            $mpdf->Output('assets/Notices/first_notice_pdf/'.$pdfFilePath, "D");
        } catch (\Mpdf\MpdfException $e) {
            echo "Error creating mPDF: " . $e->getMessage();
            exit;
        }

            
       // $this->template->load_view('final_notice_pdf',$data); 
    }
    
    public function generateSecondNoticePDF($id="",$s_id="") { 
        
        $data['loanAccountData'] = $this->Common_model->getSingleRow('loan_2nd_notice',array('id'=>$id));
        
        $data['bankData'] = $this->Common_model->getSingleRow('allbanks',array('bank_id'=>$data['loanAccountData']->bank_id));
        $data['branchData'] = $this->Common_model->getSingleRow('allbranchs',array('branch_id'=>$data['loanAccountData']->branch_id));
        
        $invoice_pdf= $this->load->view('second_notice_pdf',$data,true);
        $pdfFilePath = "loanaccount-".$id.'-'.date('d-m-Y-his').".pdf";

        require_once "application/vendor/autoload.php";
            $mpdf = new \Mpdf\Mpdf();
            // $mpdf->SetWatermarkImage(base_url().'assets/images/final-Hanshitha-logo-watermark-3.png');
            // $mpdf->showWatermarkImage = true;
            $mpdf->WriteHTML($invoice_pdf);
            $mpdf->Output('assets/Notices/second_notice_pdf/'.$pdfFilePath, "D");
       // $this->template->load_view('second_notice_pdf',$data); 
    }
    
    public function generateThirdNoticePDF($loan_id="",$s_id="") { 
        
        $data['loanAccountData'] = $this->Common_model->getSingleRow('loan_3rd_notice',array('id'=>$loan_id));
        
        $data['bankData'] = $this->Common_model->getSingleRow('allbanks',array('bank_id'=>$data['loanAccountData']->bank_id));
        $data['branchData'] = $this->Common_model->getSingleRow('allbranchs',array('branch_id'=>$data['loanAccountData']->branch_id));
        
        $invoice_pdf= $this->load->view('third_notice_pdf',$data,true);
        $pdfFilePath = "loanaccount-".$loan_id.'-'.date('d-m-Y-his').".pdf";

        require_once "application/vendor/autoload.php";
            $mpdf = new \Mpdf\Mpdf();
            // $mpdf->SetWatermarkImage(base_url().'assets/images/final-Hanshitha-logo-watermark-3.png');
            // $mpdf->showWatermarkImage = true;
            $mpdf->WriteHTML($invoice_pdf);
            $mpdf->Output('assets/Notices/third_notice_pdf/'.$pdfFilePath, "D");
       // $this->template->load_view('second_notice_pdf',$data); 
    }
    
    public function generateFinalNoticePDF($loan_id="",$s_id="") { 
        
        $data['loanAccountData'] = $this->Common_model->getSingleRow('loan_final_notice',array('id'=>$loan_id));
        
        $data['bankData'] = $this->Common_model->getSingleRow('allbanks',array('bank_id'=>$data['loanAccountData']->bank_id));
        $data['branchData'] = $this->Common_model->getSingleRow('allbranchs',array('branch_id'=>$data['loanAccountData']->branch_id));
        
        $invoice_pdf= $this->load->view('final_notice_pdf',$data,true);
        $pdfFilePath = "loanaccount-".$loan_id.'-'.date('d-m-Y-his').".pdf";

        require_once "application/vendor/autoload.php";
            $mpdf = new \Mpdf\Mpdf();
            // $mpdf->SetWatermarkImage(base_url().'assets/images/final-Hanshitha-logo-watermark-3.png');
            // $mpdf->showWatermarkImage = true;
            $mpdf->WriteHTML($invoice_pdf);
            $mpdf->Output('assets/Notices/final_notice_pdf/'.$pdfFilePath, "D");
    }
   
  public function insertFirstNotice() {

    if($_POST) {
        
        $bank_id  = (!empty($this->input->post('bank_id')) ? $this->input->post('bank_id') : $this->input->post('bank_id_hidden'));
        $branch_id  = (!empty($this->input->post('branch_id')) ? $this->input->post('branch_id') : $this->input->post('branch_id_hidden')); 
                   
        $loan_ac_number  = $this->input->post('loan_ac_number');
        $borrower_name      = $this->input->post('barrower_name');
        $borrower_address   = $this->input->post('borrower_address');
        $notice_date        = $this->input->post('notice_date');
        $account_number     = $this->input->post('loan_ac_number');
        $approved_amount    = $this->input->post('approved_amount');
        $approval_date      = $this->input->post('approval_date');
        $irregular_amount   = $this->input->post('irregular_amount');
        $addressing_text    = $this->input->post('addressing_text');
        
        
        $action = $this->input->post('action');
        if($action == "add") {
            $emp_id = $this->session->userdata('emp_id');
            $inserData = array(
                            'bank_id' => $bank_id,
                            'branch_id'  => $branch_id,
                           
                            'barrower_name'      => $borrower_name,  
                            'borrower_address'   => $borrower_address,
                            'notice_date'        => $notice_date,
                            'loan_ac_number'     => $account_number,
                            'approved_amount'    => $approved_amount,
                            'approval_date'      => $approval_date,
                            'irregular_amount'   => $irregular_amount,
                            'addressing_text'   => $addressing_text,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
             $res = $this->Common_model->insertSingle('loan_1st_notice', $inserData);
             if($res){
                $bank_id  = (!empty($this->input->post('bank_id')) ? $this->input->post('bank_id') : $this->input->post('bank_id_hidden'));
                $branch_id  = (!empty($this->input->post('branch_id')) ? $this->input->post('branch_id') : $this->input->post('branch_id_hidden')); 
                $loan_ac_number  = $this->input->post('loan_ac_number');
                $emp_id = $this->session->userdata('emp_id');
                $checkLoan = $this->Common_model->getSingleRow('Loanaccounts',array('loan_ac_number'=>$loan_ac_number));
                if(!empty($checkLoan)){
                    $loanres = $checkLoan->loan_id;

                }else{
                    $insertLoanData = array(
                    'bank_id' => $bank_id,
                    'branch_id'  => $branch_id,
                    'type_id'  => '1',
                    'emp_id' => $emp_id,
                    'loan_ac_number' => $loan_ac_number,
                    'home_branch_id' => $branch_id,
                    'barrower_name' => $borrower_name,
                    'cus_loan_amount' => $approved_amount,
                    'irregular_amount' => $irregular_amount,
                    'inserted_by' => $this->session->userdata('emp_id'),
                    're_assign_id' => $this->session->userdata('emp_id'),
                    'inserted_date' => date('Y-m-d H:i:s'));
                
                    $loanres = $this->Common_model->insertSingle('Loanaccounts', $insertLoanData);

                }

                $postal_stamp = $this->files_upload("assets/rg_1st_notices/postal_stamps/",'*','postal_stamp',$res,'rg_1st_notices');
                $notices = $this->files_upload("assets/rg_1st_notices/notices/",'*','notice_doc',$res,'notice_doc');
                $updateData['loan_id'] = $loanres;
                $updateData['postal_stamp'] = $postal_stamp;
                $updateData['notices'] = $notices;
                $updateParam = array('id'=>$res);
                $this->Common_model->updateRow('loan_1st_notice',$updateData,$updateParam);
             }
        } else {
            $generate = $this->input->post('generate');
            if($generate == true){
                $loan_id = $this->input->post('loan_id');
                $inserData = array(
                    'bank_id' => $bank_id,
                    'branch_id'  => $branch_id,
                    'loan_id'   => $loan_id,
                    'barrower_name'      => $borrower_name,  
                    'borrower_address'   => $borrower_address,
                    'notice_date'        => $notice_date,
                    'loan_ac_number'     => $account_number,
                    'approved_amount'    => $approved_amount,
                    'approval_date'      => $approval_date,
                    'irregular_amount'   => $irregular_amount,
                    'addressing_text'   => $addressing_text,
                    'inserted_by' => $this->session->userdata('emp_id'),
                    'inserted_date' => date('Y-m-d H:i:s'));
                $res = $this->Common_model->insertSingle('loan_1st_notice', $inserData);
                if($res){
                    $postal_stamp = $this->files_upload("assets/rg_1st_notices/postal_stamps/",'*','postal_stamp',$notice_id,'rg_1st_notices');
                    $notices = $this->files_upload("assets/rg_1st_notices/notices/",'*','notice_doc',$res,'notice_doc');    
                }
            }else{
                $emp_id = $this->session->userdata('emp_id');
                $notice_id = $this->input->post('notice_id');
                $updateData['bank_id'] = $bank_id;
                $updateData['branch_id'] = $branch_id;
                $updateData['loan_ac_number'] = $loan_ac_number;
                $updateData['barrower_name'] = $borrower_name;
                $updateData['borrower_address'] = $borrower_address;
                $updateData['notice_date'] = $notice_date;
                $updateData['irregular_amount'] = $irregular_amount;
                $updateData['addressing_text'] = $addressing_text;
                $updateData['approved_amount'] = $approved_amount;
                $updateData['approval_date'] = $approval_date;
                $updateData['updated_date'] =date('Y-m-d H:i:s');   
                $updateData['updated_by'] = $emp_id;
                
                $postal_stamp = $this->files_upload("assets/rg_1st_notices/postal_stamps/",'*','postal_stamp',$notice_id,'rg_1st_notices');
                $notices = $this->files_upload("assets/rg_1st_notices/notices/",'*','notice_doc',$res,'notice_doc');
                $updateData['postal_stamp'] = $postal_stamp;
                $updateData['notices'] = $notices;
                
                $param = array('id'=>$notice_id);           
                $affectedRows = $this->Common_model->updateRow('loan_1st_notice',$updateData,$param);
                
            }
        }        
        $red=base_url()."Notices";
        redirect($red);
    }
  }
  
  public function insertSecondNotice() {

    if($_POST) {
        
        $bank_id  = (!empty($this->input->post('bank_id')) ? $this->input->post('bank_id') : $this->input->post('bank_id_hidden'));
        $branch_id  = (!empty($this->input->post('branch_id')) ? $this->input->post('branch_id') : $this->input->post('branch_id_hidden')); 
        $loan_ac_number  = $this->input->post('loan_ac_number');
        $borrower_name      = $this->input->post('barrower_name');
        $borrower_address   = $this->input->post('borrower_address');
        $notice_date        = $this->input->post('notice_date');
        $account_number     = $this->input->post('loan_ac_number');
        $first_notice_date = $this->input->post('first_notice_date');
        $npa_date = $this->input->post('npa_date');
        $addressing_text    = $this->input->post('addressing_text');
        
        $action = $this->input->post('action');
        if($action == "add") {
            $emp_id = $this->session->userdata('emp_id');
            $inserData = array(
                'bank_id' => $bank_id,
                'branch_id'  => $branch_id,
                'loan_id'   => '',
                'barrower_name'      => $borrower_name,  
                'borrower_address'   => $borrower_address,
                'notice_date'        => $notice_date,
                'loan_ac_number'     => $loan_ac_number,
                'first_notice_date' => $first_notice_date,
                'npa_date'  => $npa_date,
                'addressing_text'   => $addressing_text,
                'inserted_by' => $this->session->userdata('emp_id'),
                'inserted_date' => date('Y-m-d H:i:s'));
            $res = $this->Common_model->insertSingle('loan_2nd_notice', $inserData);
            if($res){
                $checkLoan = $this->Common_model->getSingleRow('Loanaccounts',array('loan_ac_number'=>$loan_ac_number));
                if(!empty($checkLoan)){
                    $loanres = $checkLoan->loan_id;

                }else{
                    $insertLoanData = array(
                        'bank_id' => $bank_id,
                        'branch_id'  => $branch_id,
                        'type_id'  => '1',
                        'emp_id' => $emp_id,
                        'loan_ac_number' => $loan_ac_number,
                        'home_branch_id' => $branch_id,
                        'barrower_name' => $borrower_name,
                        
                        'cus_loan_amount' => 0,
                        'irregular_amount' => 0,
                        
                        'inserted_by' => $this->session->userdata('emp_id'),
                        're_assign_id' => $this->session->userdata('emp_id'),
                        'inserted_date' => date('Y-m-d H:i:s'));
                    $loanres = $this->Common_model->insertSingle('Loanaccounts', $insertLoanData);
                }
                $postal_stamp = $this->files_upload("assets/seizer_2nd_notices/postal_stamps/",'*','postal_stamp',$res,'postal_stamps');
                $notices = $this->files_upload("assets/seizer_2nd_notices/notices/",'*','notice_doc',$res,'notice_doc');
                $updateData['postal_stamp'] = $postal_stamp;
                $updateData['notices'] = $notices;
                $updateData['loan_id'] = $loanres;
                $updateParam = array('id'=>$res);
                $this->Common_model->updateRow('loan_2nd_notice',$updateData,$updateParam);
            }
        } else {
            $generate = $this->input->post('generate');
            if($generate == true){
                $loan_id = $this->input->post('loan_id');
                $inserData = array(
                    'bank_id' => $bank_id,
                    'branch_id'  => $branch_id,
                    'loan_id'   => $loan_id,
                    'barrower_name'      => $borrower_name,  
                    'borrower_address'   => $borrower_address,
                    'notice_date'        => $notice_date,
                    'loan_ac_number'     => $loan_ac_number,
                    'first_notice_date' => $first_notice_date,
                    'npa_date'  => $npa_date,
                    'addressing_text'   => $addressing_text,
                    'inserted_by' => $this->session->userdata('emp_id'),
                    'inserted_date' => date('Y-m-d H:i:s'));
                $res = $this->Common_model->insertSingle('loan_2nd_notice', $inserData);
                if($res){
                    $postal_stamp = $this->files_upload("assets/seizer_2nd_notices/postal_stamps/",'*','postal_stamp',$res,'postal_stamps');
                    $notices = $this->files_upload("assets/seizer_2nd_notices/notices/",'*','notice_doc',$res,'notice_doc');
                    $updateData['postal_stamp'] = $postal_stamp;
                    $updateData['notices'] = $notices;
                    $updateParam = array('id'=>$res);
                    $this->Common_model->updateRow('loan_2nd_notice',$updateData,$updateParam);
                }
            }else{
                $emp_id = $this->session->userdata('emp_id');
                $notice_id = $this->input->post('notice_id');
                $updateData['bank_id'] = $bank_id;
                $updateData['branch_id'] = $branch_id;
                $updateData['loan_ac_number'] = $loan_ac_number;
                $updateData['barrower_name'] = $borrower_name;
                $updateData['borrower_address'] = $borrower_address;
                $updateData['notice_date'] = $notice_date;
                $updateData['first_notice_date'] = $first_notice_date;
                $updateData['npa_date'] = $npa_date;
                $updateData['addressing_text'] = $addressing_text;
                
                $updateData['updated_date'] =date('Y-m-d H:i:s');   
                $updateData['updated_by'] = $emp_id;
                $postal_stamp = $this->files_upload("assets/seizer_2nd_notices/postal_stamps/",'*','postal_stamp',$res,'postal_stamps');
                $notices = $this->files_upload("assets/seizer_2nd_notices/notices/",'*','notice_doc',$res,'notice_doc');
                $updateData['postal_stamp'] = $postal_stamp;
                $updateData['notices'] = $notices;
                    
                $param = array('id'=>$notice_id);           
                $affectedRows = $this->Common_model->updateRow('loan_2nd_notice',$updateData,$param);
            }
             
        }        
        $red=base_url()."Notices/secondNotice";
        redirect($red);
    }
  }
  
   public function insertThirdNotice() {

        if($_POST) {
        
            $bank_id  = (!empty($this->input->post('bank_id')) ? $this->input->post('bank_id') : $this->input->post('bank_id_hidden'));
            $branch_id  = (!empty($this->input->post('branch_id')) ? $this->input->post('branch_id') : $this->input->post('branch_id_hidden')); 
                   
            $loan_ac_number  = $this->input->post('loan_ac_number');
            $borrower_name      = $this->input->post('barrower_name');
            $borrower_address   = $this->input->post('borrower_address');
            $notice_date        = $this->input->post('notice_date');
            $account_number     = $this->input->post('loan_ac_number');
            $addressing_text    = $this->input->post('addressing_text');
            
            $vehicle_registration_number   = $this->input->post('registration_number');
        
        
            $action = $this->input->post('action');
            if($action == "add") {
                $emp_id = $this->session->userdata('emp_id');
                $inserData = array(
                    'bank_id' => $bank_id,
                    'branch_id'  => $branch_id,
                    'loan_id'   => $loan_id,
                    'barrower_name'      => $borrower_name,  
                    'borrower_address'   => $borrower_address,
                    'notice_date'        => $notice_date,
                    'loan_ac_number'     => $loan_ac_number,
                    'vehicle_registration_number'    => $vehicle_registration_number,
                    'addressing_text'   => $addressing_text,
                    'inserted_by' => $this->session->userdata('emp_id'),
                    'inserted_date' => date('Y-m-d H:i:s'));
                $res = $this->Common_model->insertSingle('loan_3rd_notice', $inserData);
                if($res){
                    $bank_id  = (!empty($this->input->post('bank_id')) ? $this->input->post('bank_id') : $this->input->post('bank_id_hidden'));
                    $branch_id  = (!empty($this->input->post('branch_id')) ? $this->input->post('branch_id') : $this->input->post('branch_id_hidden')); 
                    $loan_ac_number  = $this->input->post('loan_ac_number');
                    $emp_id = $this->session->userdata('emp_id');
                    $checkLoan = $this->Common_model->getSingleRow('Loanaccounts',array('loan_ac_number'=>$loan_ac_number));
                    if(!empty($checkLoan)){
                        $loanres = $checkLoan->loan_id;

                    }else{
                        $insertLoanData = array(
                            'bank_id' => $bank_id,
                            'branch_id'  => $branch_id,
                            'type_id'  => '1',
                            'emp_id' => $emp_id,
                            'loan_ac_number' => $loan_ac_number,
                            'home_branch_id' => $branch_id,
                            'barrower_name' => $borrower_name,
                            
                            'cus_loan_amount' => 0,
                            'irregular_amount' => $irregular_amount,
                            
                            'inserted_by' => $this->session->userdata('emp_id'),
                            're_assign_id' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
                        $loanres = $this->Common_model->insertSingle('Loanaccounts', $insertLoanData);
                    }
                    $postal_stamp = $this->files_upload("assets/pre_auction_3rd_notices/postal_stamps/",'*','postal_stamp',$res,'rg_1st_notices');
                    $notices = $this->files_upload("assets/pre_auction_3rd_notices/notices/",'*','notice_doc',$res,'notice_doc');
                    $updateData['notices'] = $notices;
                    
                    $updateData['loan_id'] = $loanres;
                    $updateData['postal_stamp'] = $postal_stamp;
                    $updateParam = array('id'=>$res);
                    $this->Common_model->updateRow('loan_3rd_notice',$updateData,$updateParam);
                }
            } else {
                $generate = $this->input->post('generate');
                if($generate == true){
                    $loan_id = $this->input->post('loan_id');
                    $inserData = array(
                        'bank_id' => $bank_id,
                        'branch_id'  => $branch_id,
                        'loan_id'   => $loan_id,
                        'barrower_name'      => $borrower_name,  
                        'borrower_address'   => $borrower_address,
                        'notice_date'        => $notice_date,
                        'loan_ac_number'     => $loan_ac_number,
                        'vehicle_registration_number'    => $vehicle_registration_number,
                        'addressing_text'   => $addressing_text,
                        'inserted_by' => $this->session->userdata('emp_id'),
                        'inserted_date' => date('Y-m-d H:i:s'));
                    $res = $this->Common_model->insertSingle('loan_3rd_notice', $inserData);
                    if($res){
                        $postal_stamp = $this->files_upload("assets/pre_auction_3rd_notices/postal_stamps/",'*','postal_stamp',$res,'postal_stamps');
                        $notices = $this->files_upload("assets/pre_auction_3rd_notices/notices/",'*','notice_doc',$res,'notice_doc');
                        $updateData['postal_stamp'] = $postal_stamp;
                        $updateData['notices'] = $notices;
                        $param = array('id'=>$res);
                    $affectedRows = $this->Common_model->updateRow('loan_3rd_notice',$updateData,$param);
                    }
                }else{
                    $emp_id = $this->session->userdata('emp_id');
                    $notice_id = $this->input->post('notice_id');
                    $updateData['bank_id'] = $bank_id;
                    $updateData['branch_id'] = $branch_id;
                    $updateData['loan_ac_number'] = $loan_ac_number;
                    $updateData['barrower_name'] = $borrower_name;
                    $updateData['borrower_address'] = $borrower_address;
                    $updateData['notice_date'] = $notice_date;
                    $updateData['vehicle_registration_number'] = $vehicle_registration_number;
                    $updateData['addressing_text'] = $addressing_text;
                   
                    $updateData['updated_date'] =date('Y-m-d H:i:s');   
                    $updateData['updated_by'] = $emp_id;
                    $postal_stamp = $this->files_upload("assets/pre_auction_3rd_notices/postal_stamps/",'*','postal_stamp',$res,'postal_stamps');
                    $notices = $this->files_upload("assets/pre_auction_3rd_notices/notices/",'*','notice_doc',$res,'notice_doc');
                    $updateData['postal_stamp'] = $postal_stamp;
                    $updateData['notices'] = $notices;
                    
                    $param = array('id'=>$notice_id);
                    
                    $affectedRows = $this->Common_model->updateRow('loan_3rd_notice',$updateData,$param);
                }
                 
            }        
         $red=base_url()."Notices/thirdNotice";
         redirect($red);
    }
  }
  
    public function insertFinalNotice() {

        if($_POST) {
        
            $bank_id  = (!empty($this->input->post('bank_id')) ? $this->input->post('bank_id') : $this->input->post('bank_id_hidden'));
            $branch_id  = (!empty($this->input->post('branch_id')) ? $this->input->post('branch_id') : $this->input->post('branch_id_hidden'));
            $loan_ac_number  = $this->input->post('loan_ac_number');
            $borrower_name      = $this->input->post('barrower_name');
            $borrower_address   = $this->input->post('borrower_address');
            $notice_date        = $this->input->post('notice_date');
            $account_number     = $this->input->post('loan_ac_number');
            $vehicle_registration_number   = $this->input->post('registration_number');
            $auction_date       = $this->input->post('auction_date');
            $telugu_news_paper  = $this->input->post('telugu_news_paper');
            $english_news_paper = $this->input->post('english_news_paper');
            $news_publication_date  = $this->input->post('news_publication_date');
            $addressing_text    = $this->input->post('addressing_text');
        
            $action = $this->input->post('action');
            if($action == "add") {
                $emp_id = $this->session->userdata('emp_id');
                $inserData = array(
                    'bank_id' => $bank_id,
                    'branch_id'  => $branch_id,
                    'barrower_name'      => $borrower_name,  
                    'borrower_address'   => $borrower_address,
                    'notice_date'        => $notice_date,
                    'loan_ac_number'     => $account_number,
                    'vehicle_registration_number' => $vehicle_registration_number,
                    'auction_date'      => $auction_date,
                    'telugu_news_paper'   => $telugu_news_paper,
                    'english_news_paper'   => $english_news_paper,
                    'news_publication_date'   => $news_publication_date,
                    'addressing_text'   => $addressing_text,
                    'inserted_by' => $this->session->userdata('emp_id'),
                    'inserted_date' => date('Y-m-d H:i:s'));
                $res = $this->Common_model->insertSingle('loan_final_notice', $inserData);
                if($res){
                    $bank_id  = (!empty($this->input->post('bank_id')) ? $this->input->post('bank_id') : $this->input->post('bank_id_hidden'));
                    $branch_id  = (!empty($this->input->post('branch_id')) ? $this->input->post('branch_id') : $this->input->post('branch_id_hidden')); 
                    $loan_ac_number  = $this->input->post('loan_ac_number');
                    $emp_id = $this->session->userdata('emp_id');
                    $checkLoan = $this->Common_model->getSingleRow('Loanaccounts',array('loan_ac_number'=>$loan_ac_number));
                    if(!empty($checkLoan)){
                        $loanres = $checkLoan->loan_id;

                    }else{
                        $insertLoanData = array(
                            'bank_id' => $bank_id,
                            'branch_id'  => $branch_id,
                            'type_id'  => '1',
                            'emp_id' => $emp_id,
                            'loan_ac_number' => $loan_ac_number,
                            'home_branch_id' => $branch_id,
                            'barrower_name' => $borrower_name,
                            
                            'cus_loan_amount' => 0,
                            'irregular_amount' => 0,
                            
                            'inserted_by' => $this->session->userdata('emp_id'),
                            're_assign_id' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
                        $loanres = $this->Common_model->insertSingle('Loanaccounts', $insertLoanData);
                    }
                    $postal_stamp = $this->files_upload("assets/final_4th_notices/postal_stamps/",'*','postal_stamp',$res,'rg_1st_notices');
                    
                    $notices = $this->files_upload("assets/final_4th_notices/notices/",'*','notice_doc',$res,'notice_doc');
                    $updateData['notices'] = $notices;
                    
                    $updateData['loan_id'] = $loanres;
                    $updateData['postal_stamp'] = $postal_stamp;
                    $updateParam = array('id'=>$res);
                    $this->Common_model->updateRow('loan_final_notice',$updateData,$updateParam);
                }
            } else {
                $generate = $this->input->post('generate');
                if($generate == true){
                    $loan_id = $this->input->post('loan_id');
                    $inserData = array(
                        'bank_id' => $bank_id,
                        'branch_id'  => $branch_id,
                        'loan_id'   => $loan_id,
                        'barrower_name'      => $borrower_name,  
                        'borrower_address'   => $borrower_address,
                        'notice_date'        => $notice_date,
                        'loan_ac_number'     => $account_number,
                        'vehicle_registration_number' => $vehicle_registration_number,
                        'auction_date'      => $auction_date,
                        'telugu_news_paper'   => $telugu_news_paper,
                        'english_news_paper'   => $english_news_paper,
                        'news_publication_date'   => $news_publication_date,
                        'addressing_text'   => $addressing_text,
                        'inserted_by' => $this->session->userdata('emp_id'),
                        'inserted_date' => date('Y-m-d H:i:s'));
                    $res = $this->Common_model->insertSingle('loan_final_notice', $inserData);
                    if($res){
                        $postal_stamp = $this->files_upload("assets/final_4th_notices/postal_stamps/",'*','postal_stamp',$res,'postal_stamps');
                        $notices = $this->files_upload("assets/final_4th_notices/notices/",'*','notice_doc',$res,'notice_doc');
                        $updateData['postal_stamp'] = $postal_stamp;
                        $updateData['notices'] = $notices;
                        $updateParam = array('id'=>$res);
                        $this->Common_model->updateRow('loan_final_notice',$updateData,$updateParam);
                    }
                    
                }else{
                    $emp_id = $this->session->userdata('emp_id');
                    $notice_id = $this->input->post('notice_id');
                    $updateData['bank_id'] = $bank_id;
                    $updateData['branch_id'] = $branch_id;
                    $updateData['loan_ac_number'] = $loan_ac_number;
                    $updateData['barrower_name'] = $borrower_name;
                    $updateData['borrower_address'] = $borrower_address;
                    $updateData['notice_date'] = $notice_date;
                    $updateData['vehicle_registration_number'] = $vehicle_registration_number;
                    
                    $updateData['telugu_news_paper'] = $telugu_news_paper;
                    $updateData['english_news_paper'] = $english_news_paper;
                    $updateData['news_publication_date'] = $news_publication_date;
                    $updateData['auction_date'] = $auction_date;
                    $updateData['addressing_text'] = $addressing_text;
                    
                    $updateData['updated_date'] =date('Y-m-d H:i:s');   
                    $updateData['updated_by'] = $emp_id;
                    $postal_stamp = $this->files_upload("assets/final_4th_notices/postal_stamps/",'*','postal_stamp',$res,'postal_stamps');
                    $notices = $this->files_upload("assets/final_4th_notices/notices/",'*','notice_doc',$res,'notice_doc');
                    $updateData['postal_stamp'] = $postal_stamp;
                    $updateData['notices'] = $notices;
                    
                    $param = array('id'=>$notice_id);           
                    $affectedRows = $this->Common_model->updateRow('loan_final_notice',$updateData,$param);
                }
            }        
            $red=base_url()."Notices/finalNotice";
            redirect($red);
        }
    }

  function files_upload($upload_path,$allowed_types,$filename,$emp_id,$type) {
        $config = array();
        $config['upload_path'] = $upload_path; //../upload/adImages
        $config['allowed_types'] = $allowed_types; //
        // $config['max_size'] = '20000';
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
  
    public function phpinfo()
    {
        phpinfo();
    }
  
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
