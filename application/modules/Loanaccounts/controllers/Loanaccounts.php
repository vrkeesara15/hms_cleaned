<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : ch.v.sudhakar9@gmail.com, phpguidance@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Loanaccounts
 *  
 */
class Loanaccounts extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Loanaccounts_model');
        $this->load->language('Loanaccounts');
        $this->load->library('pagination');
        $this->load->helper('phpass');   
    }    
    public function index() {    
        $breadcrumbarray = array('label'=> "Loanaccounts",
                           'link' => base_url()."Loanaccounts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loanaccounts");  

                $config['base_url'] = base_url().'/Loanaccounts/';
                $config["total_rows"] = $this->Loanaccounts_model->getLoanaccountsCounts();
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
                $data["loanaccounts"] = $this->Loanaccounts_model->getAllLoanaccounts($config["per_page"], $page,1);
                $data['page'] = $page;
                $data["links"] = $this->pagination->create_links();
            if($_POST){           
                $this->load->view('Loanaccounts_ajax', $data);
            }else {
                $this->template->load_view('Loanaccounts', $data);
            }

        // $data['Loanaccounts'] = $this->Loanaccounts_model->getAllLoanaccounts();
        // $this->template->load_view('Loanaccounts',$data);        

    }
    public function addaccount($loan_id = "") { 
         
        $breadcrumbarray = array('label'=> "Loanaccounts",
                           'link' => base_url()."Loanaccounts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loanaccounts");
        $data['action'] = 'add';          
        $data['workorders'] = $this->Loanaccounts_model->getWorkorders();
        $data['banks'] = $this->Loanaccounts_model->getAllbanks(); 
        $data['rbos'] = $this->Loanaccounts_model->getAllRBO();
        $data['branchs'] ='';
        if($loan_id !=''){
            $data['action'] = 'edit';
            $data['loandata'] = $this->Loanaccounts_model->getLoanDetails($loan_id);
            $data['branchs'] =  $this->Loanaccounts_model->getBranchs($data['loandata']->bank_id);
          
        }
        $this->template->load_view('Loanaccounts_add',$data); 
    }
    public function getWorkOrderDetails(){
        $order_id = $this->input->post('order_id');
        $workdetails =  $this->Loanaccounts_model->getWorkOrderDetails($order_id);
        header('Content-type: application/json');
        die( json_encode( $workdetails ) );  
    }
    public function getBranchas(){
        $bank_id = $this->input->post('bank_id');
        $branchs =  $this->Loanaccounts_model->getBranchs($bank_id);
        header('Content-type: application/json');
        die( json_encode( $branchs ) );  
    }
     public function regularize_form($loan_id="",$r_id="") {
         
        $breadcrumbarray = array('label'=> "Loanaccounts",
                           'link' => base_url()."Loanaccounts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loanaccounts");
        if($r_id!= ""){
            $data['action'] = 'edit';
            $regularizeData = $this->Common_model->getSingleRow('regularize_form',array('r_id'=>$r_id));
            $data['regularizeData'] = $regularizeData;
            
        }else{
            $data['action'] = 'add';
        }
        $data['loan_id'] = $loan_id;
        $data['loandata'] = $this->Loanaccounts_model->getLoanDetails($loan_id);
        $data['banks'] = $this->Loanaccounts_model->getAllbanks();  
        $data['branchs'] ='';
        $this->template->load_view('Regularize_form',$data); 
    }
    
    public function workorder_form($loan_id="",$w_id="") {
         
        $breadcrumbarray = array('label'=> "Loanaccounts",
                           'link' => base_url()."Loanaccounts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage WorkOrder");
        if($w_id!= ""){
            $data['action'] = 'edit';
            $regularizeData = $this->Common_model->getSingleRow('workorder_form',array('w_id'=>$w_id));
            $data['regularizeData'] = $regularizeData;
            
        }else{
            $data['action'] = 'add';
        }
         $data['branchs'] ='';
         if(!empty($loan_id)){
            $data['workorderdata'] = $this->Common_model->getSingleRow('workorder_form',array('loan_id'=>$loan_id));
            $data['loan_id'] = $loan_id;
            $data['loandata'] = $this->Loanaccounts_model->getLoanDetails($loan_id);
            $data['branchs'] =  $this->Loanaccounts_model->getBranchs($data['loandata']->bank_id); 
         }
        
        if(!empty($data['workorderdata'])){
            $data['action'] = 'edit';
            $data['branchs'] =  $this->Loanaccounts_model->getBranchs($data['loandata']->bank_id); 
        }
        $data['banks'] = $this->Loanaccounts_model->getAllbanks();  
       

        $this->template->load_view('Workorder_form',$data); 
    }
    
    public function trackingdetails_form($loan_id="",$trackingdetails_id="") {
        $breadcrumbarray = array('label'=> "Loanaccounts",
                           'link' => base_url()."Loanaccounts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Reassign User");
        if($trackingdetails_id != ""){
            $data['action'] = 'edit';
        } else{
            $data['action'] = 'add';
        }
        $data['loan_id'] = $loan_id;
        $data['loandata'] = $this->Loanaccounts_model->getLoanDetails($loan_id);
        $data['trackingDetailsData']  =  $this->Common_model->getResult('tracking_details',array('loan_id'=>$loan_id));
        $data['branchs'] ='';
        $data['trackingdetails_id'] = $trackingdetails_id;
        $this->template->load_view('trackingdetails_form',$data); 
    }
    public function re_assign_user_form($loan_id="",$re_assign_id="") {
        $breadcrumbarray = array('label'=> "Loanaccounts",
                           'link' => base_url()."Loanaccounts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Reassign User");
        if($re_assign_id != ""){
            $data['action'] = 'edit';
        } else{
            $data['action'] = 'add';
        }
        $data['loan_id'] = $loan_id;
        $data['loandata'] = $this->Loanaccounts_model->getLoanDetails($loan_id);
        $data['banks'] = $this->Loanaccounts_model->getAllbanks();  
        $data['employees'] = $this->Loanaccounts_model->getAdminusers();

        $data['branchs'] ='';
        $this->template->load_view('re_assign_user_form',$data); 
    }
    
    public function final_notice_form($loan_id="",$r_id="") {
         
        $breadcrumbarray = array('label'=> "Loanaccounts",
                           'link' => base_url()."Loanaccounts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loanaccounts");
        if($r_id!= ""){
            $data['action'] = 'edit';
            $regularizeData = $this->Common_model->getSingleRow('regularize_form',array('r_id'=>$r_id));
            $data['regularizeData'] = $regularizeData;
            
        }else{
            $data['action'] = 'add';
        }
        $data['loan_id'] = $loan_id;
        $data['loandata'] = $this->Loanaccounts_model->getLoanDetails($loan_id);
        $data['banks'] = $this->Loanaccounts_model->getAllbanks();  
        $data['branchs'] ='';
        $this->template->load_view('Final_notice_form',$data); 
    }
    public function insertRegularize() {

    if($_POST) {
      //  echo "<pre>"; print_r($_POST);exit;
        $action = $this->input->post('action');
         $loan_id  = $this->input->post('loan_id');
         $remarks  = $this->input->post('remarks');
         $latitude  = $this->input->post('latitude');
         $longitude  = $this->input->post('longitude');
         $location = $this->input->post('location');
        if($action == "add") {
            $getMaxID = $this->Loanaccounts_model->getMaxID();
            $id = ($getMaxID->maxid+1);
            $seizer_notice = $this->files_upload("assets/seizer_notice/",'*','seizer_notice',$id,'seizer_notice');
            $postal_slip = $this->files_upload("assets/postal_slip/",'*','postal_slip',$id,'postal_slip');
            $property_photo = $this->files_upload("assets/property_photo/",'*','property_photo',$id,'property_photo');
            $visit_photo = $this->files_upload("assets/visit_photo/",'*','visit_photo',$id,'visit_photo');

            $inserData = array(
                            'loan_id' => $loan_id,
                            'seizer_notice' => $seizer_notice,
                            'postal_slip' => $postal_slip,
                            'property_photo' => $property_photo,
                            'visit_photo' => $visit_photo,
                            'remarks' => $remarks,
                            'latitude' => $latitude,
                            'longitude' => $longitude,
                            'location' => $location,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
             $res = $this->Common_model->insertSingle('regularize_form', $inserData);
             if($res){
                $updatedata['status'] = 'reg';  
              //  echo "<pre>"; print_r($updateData);exit;
                $updateParam = array('loan_id'=>$loan_id);
                $this->Common_model->updateRow('Loanaccounts',$updatedata,$updateParam);
             }
             
        } else {
            $r_id = $this->input->post('r_id');
            $updateData['update_by'] = $this->session->userdata('emp_id');
            $updateData['update_date'] =date('Y-m-d H:i:s');
             $updateData['latitude'] = $latitude;
            $updateData['longitude'] = $longitude;
            $updateData['location'] = $location;
            $updateData['remarks'] = $remarks;
             
            $id = $r_id;
            if(!empty($_FILES['seizer_notice']['name'])) {
                $seizer_notice = $this->files_upload("assets/seizer_notice/",'*','seizer_notice',$id,'seizer_notice');
                $updateData['seizer_notice'] = $seizer_notice;
            }
            if(!empty($_FILES['postal_slip']['name'])) {
                $postal_slip = $this->files_upload("assets/postal_slip/",'*','postal_slip',$id,'postal_slip');
                 $updateData['postal_slip'] = $postal_slip;
            }
            if(!empty($_FILES['property_photo']['name'])) {
                $property_photo = $this->files_upload("assets/property_photo/",'*','property_photo',$id,'property_photo');
                $updateData['property_photo'] = $property_photo;
            }

            if(!empty($_FILES['visit_photo']['name'])) {
                $visit_photo = $this->files_upload("assets/visit_photo/",'*','visit_photo',$id,'visit_photo');
                $updateData['visit_photo'] = $visit_photo;
            }
            
             $param = array('r_id'=>$r_id);
             $affectedRows = $this->Common_model->updateRow('regularize_form',$updateData,$param);
        }
        
        $red=base_url()."Loanaccounts/loanaccount_view/".$loan_id;
        redirect($red);
    }
  }

 
    
    
  public function seize_form($loan_id="",$s_id="") { 
         
        $breadcrumbarray = array('label'=> "Loanaccounts",
                           'link' => base_url()."Loanaccounts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loanaccounts");

        if($s_id!= ""){
            $data['action'] = 'edit';
            $seizedata = $this->Common_model->getSingleRow('seize_form',array('s_id'=>$s_id));
            $data['seizedata'] = $seizedata;
            
        }else{
            $data['action'] = 'add';
        }
      
        $data['banks'] = $this->Loanaccounts_model->getAllbanks();  
        $data['getAllEmployees'] = $this->Loanaccounts_model->getAllEmployees();
        $data['branchs'] ='';
        $data['loan_id'] = $loan_id;
        $data['s_id'] = $s_id;
        $data['loandata'] = $this->Loanaccounts_model->getLoanDetails($loan_id);
        
        $this->template->load_view('Seize_form',$data); 
    }
    
    public function finalNoticeView($loan_id="",$s_id="") { 
         
        
        $loan_id = '165';
        echo $this->load->view('final_notice_pdf',$data,true);
        // $invoice_pdf= $this->load->view('final_notice_pdf',$data,true);
        // $pdfFilePath = "loanaccount-".$loan_id.'-'.date('d-m-Y-his').".pdf";

        // require_once "application/vendor/autoload.php";
        //     $mpdf = new \Mpdf\Mpdf();
        //     $mpdf->SetWatermarkImage(base_url().'assets/images/final-Hanshitha-logo-watermark-3.png');
        //     $mpdf->showWatermarkImage = true;
        //     $mpdf->WriteHTML($invoice_pdf);
        //     $mpdf->Output('assets/loanaccounts/final_notice_pdf/'.$pdfFilePath, "F");
       // $this->template->load_view('final_notice_pdf',$data); 
    }
    
    public function generateLoanPDF($loan_id="",$s_id="") { 
         
        
        //$loan_id = '165';
        
        $data['loanAccountData'] = $this->Common_model->getSingleRow('Loanaccounts',array('loan_id'=>$loan_id));
        $data['bankData'] = $this->Common_model->getSingleRow('allbanks',array('bank_id'=>$data['loanAccountData']->bank_id));
        
        $invoice_pdf= $this->load->view('final_notice_pdf',$data,true);
        $pdfFilePath = "loanaccount-".$loan_id.'-'.date('d-m-Y-his').".pdf";

        require_once "application/vendor/autoload.php";
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->SetWatermarkImage(base_url().'assets/images/final-Hanshitha-logo-watermark-3.png');
            $mpdf->showWatermarkImage = true;
            $mpdf->WriteHTML($invoice_pdf);
            $mpdf->Output('assets/loanaccounts/final_notice_pdf/'.$pdfFilePath, "D");
       // $this->template->load_view('final_notice_pdf',$data); 
    }
    
    public function insertSeize() {    
    if($_POST) {
      
      //echo "<pre>"; print_r($_POST);exit;
         $action = $this->input->post('action');         
         $loan_id  = $this->input->post('loan_id');
         $seize_date  = $this->input->post('seize_date');
         $seized_by  = $this->input->post('seized_by');
         $remarks  = $this->input->post('remarks');
         $latitude  = $this->input->post('latitude');
         $longitude  = $this->input->post('longitude');
         $location = $this->input->post('location');
         $seizer_guidelines_followed  = $this->input->post('seizer_guidelines_followed');
        if($action == "add") {
            $getMaxID = $this->Loanaccounts_model->getSeizeFormMaxID();
            $id = ($getMaxID->maxid+1);
            $panchanama_doc = $this->files_upload("assets/panchanama_doc/",'*','panchanama_doc',$id,'panchanama_doc');
            $stock_yard_panchanama = $this->files_upload("assets/stock_yard_panchanama/",'*','stock_yard_panchanama',$id,'stock_yard_panchanama');
            $inventory = $this->files_upload("assets/inventory/",'*','inventory',$id,'inventory');
            $photos = $this->files_upload("assets/photos/",'*','photos',$id,'photos1');
            $videos = $this->files_upload("assets/videos/",'*','videos',$id,'videos1');
            $inserData = array(
                            'loan_id' => $loan_id,
                            'seize_date' => $seize_date,
                            'seized_by' => $seized_by,
                            'panchanama_doc' => $panchanama_doc,
                            'stock_yard_panchanama' => $stock_yard_panchanama,
                            'seizer_guidelines_followed' => $seizer_guidelines_followed,
                            'inventory' => $inventory,
                            'photo1' => $photos,
                            'video1' => $videos,
                            'remarks' =>$remarks,
                             'latitude' => $latitude,
                            'longitude' => $longitude,
                            'location'  => $location,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
             $res = $this->Common_model->insertSingle('seize_form', $inserData);
             $param = array('loan_id'=>$loan_id);
             $updateData['status'] = 's';
             $affectedRows = $this->Common_model->updateRow('Loanaccounts',$updateData,$param);
             
        } else {
            $s_id = $this->input->post('s_id');
            $updateData['loan_id'] =$loan_id;
            $updateData['seize_date'] =$seize_date;
            $updateData['seized_by'] =$seized_by;
            $updateData['seizer_guidelines_followed'] =$seizer_guidelines_followed;
            $updateData['update_by'] = $this->session->userdata('emp_id');
            $updateData['remarks'] = $remarks;
            $updateData['latitude'] = $latitude;
            $updateData['longitude'] = $longitude;
            $updateData['location'] = $location;
            $updateData['update_date'] =date('Y-m-d H:i:s');            
            $id = $s_id;
            if(!empty($_FILES['panchanama_doc']['name'])) {
                $panchanama_doc = $this->files_upload("assets/panchanama_doc/",'*','panchanama_doc',$id,'panchanama_doc');
                $updateData['panchanama_doc'] = $panchanama_doc;
            }
            if(!empty($_FILES['stock_yard_panchanama']['name'])) {
                $stock_yard_panchanama = $this->files_upload("assets/stock_yard_panchanama/",'*','stock_yard_panchanama',$id,'stock_yard_panchanama');
                 $updateData['stock_yard_panchanama'] = $stock_yard_panchanama;
            }
             if(!empty($_FILES['inventory']['name'])) {
                $inventory = $this->files_upload("assets/inventory/",'*','inventory',$id,'inventory');
                 $updateData['inventory'] = $inventory;
            }
            if(!empty($_FILES['photos']['name'])) {
                $photos1 = $this->files_upload("assets/photos/",'*','photos1',$id,'photos1');
                $updateData['photo1'] = $photos1;
            }
            if(!empty($_FILES['videos']['name'])) {
                $videos1 = $this->files_upload("assets/videos/",'*','videos1',$id,'videos1');
                $updateData['video1'] = $videos1;
            }            
             $param = array('s_id'=>$s_id);
             $affectedRows = $this->Common_model->updateRow('seize_form',$updateData,$param);
        }
        
        $red=base_url()."Loanaccounts/loanaccount_view/".$loan_id;
        redirect($red);
    }
  }
  
  
   public function insertWorkorder() {    
    if($_POST) {
      
         $action = $this->input->post('action');        
         $loan_id = $this->input->post('loan_id');
         $workorder_no  = $this->input->post('workorder_no');
         $workorder_date  = $this->input->post('workorder_date');
         $bankmanagerdetails  = $this->input->post('bankmanagerdetails');
         
        if($action == "add") {
            if(!empty($loan_id)){
                $inserData = array(
                            'loan_id' => $loan_id,
                            'workorder_no' => $workorder_no,
                            'workorder_date' => $workorder_date,
                            'bank_manager_details' =>$bankmanagerdetails,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
                $res = $this->Common_model->insertSingle('workorder_form', $inserData);
            }else{
                $bank_id  = (!empty($this->input->post('bank_id')) ? $this->input->post('bank_id') : $this->input->post('bank_id_hidden'));
                $branch_id  = (!empty($this->input->post('branch_id')) ? $this->input->post('branch_id') : $this->input->post('branch_id_hidden')); 
                           
                $loan_ac_number  = $this->input->post('loan_ac_number');
                $borrower_name      = $this->input->post('barrower_name');
                $borrower_address   = $this->input->post('borrower_address');
                $insertLoanData = array(
                    'bank_id' => $bank_id,
                    'branch_id'  => $branch_id,
                    'type_id'  => '1',
                    'emp_id' => $this->session->userdata('emp_id'),
                    'loan_ac_number' => $loan_ac_number,
                    'home_branch_id' => $branch_id,
                    'barrower_name' => $borrower_name,
                    'cus_loan_amount' => 0,
                    'irregular_amount' => 0,
                    'inserted_by' => $this->session->userdata('emp_id'),
                    're_assign_id' => $this->session->userdata('emp_id'),
                    'inserted_date' => date('Y-m-d H:i:s'));
                
                    $loanres = $this->Common_model->insertSingle('Loanaccounts', $insertLoanData);
                $loan_id = $loanres;
                $inserData = array(
                        'loan_id' => $loanres,
                        'workorder_no' => $workorder_no,
                        'workorder_date' => $workorder_date,
                        'bank_manager_details' =>$bankmanagerdetails,
                        'inserted_by' => $this->session->userdata('emp_id'),
                        'inserted_date' => date('Y-m-d H:i:s'));
                $res = $this->Common_model->insertSingle('workorder_form', $inserData);

            }
                        
             
             $workorder_file = $this->files_upload("assets/loanaccounts/workorder_file/",'*','workorder_file',$res,'workorder_file');
             
            $updateData['workorder_file'] =$workorder_file;
           
            
             $param = array('w_id'=>$res);
             $affectedRows = $this->Common_model->updateRow('workorder_form',$updateData,$param);
             
             
        }
        
        $red=base_url()."Loanaccounts/loanaccount_view/".$loan_id;
        redirect($red);
    }
  }
  public function insertEmpReassignform() { 
     
    if($_POST) {
      
         $action = $this->input->post('action');        
         $loan_id = $this->input->post('loan_id');
         $re_assign_id  = $this->input->post('emp_id');

        if($action == "edit") {
            
           $updateData = array('re_assign_id' => $re_assign_id);
            
             $param = array('loan_id'=>$loan_id);
             $affectedRows = $this->Common_model->updateRow('Loanaccounts',$updateData,$param);
             
             
        }
        
        $red=base_url()."Loanaccounts/loanaccount_view/".$loan_id;
        redirect($red);
    }
  }
  
    public function insertTrackingDetails(){
        if($_POST) {
            $action = $this->input->post('action');
            $loan_id = $this->input->post('loan_id');
            
            for($i=1;$i<=3;$i++){
                $cibil_score_file = "";
                 if(!empty($_FILES['cibil'.$i.'file']['name'])) {
                    $cibil_score_file = $this->files_upload("assets/loanaccounts/Trackingdetails/cibil_score_file/",'*','cibil'.$i.'file',$i,'cibil_score_file');
                }
                $cibil_description = $this->input->post('cibil'.$i.'description');
                $insertData['tracking_detail_type'] = 1;
                $insertData['loan_id'] = $loan_id;
                $insertData['image_name'] = $cibil_score_file;
                $insertData['image_count'] = $i;
                $insertData['description'] = $cibil_description;
                $insertData['inserted_by'] = $this->session->userdata('emp_id');
                $insertData['inserted_date'] = date('Y-m-d H:i:s');
                if($cibil_score_file != "" || !empty($cibil_description)){
                    $trackingdetails_id= $this->Common_model->insertSingle('tracking_details', $insertData);
                }
            }
            
            for($i=1;$i<=3;$i++){
                $fast_tag_file = "";
                 if(!empty($_FILES['fasttag'.$i.'file']['name'])) {
                    $fast_tag_file = $this->files_upload("assets/loanaccounts/Trackingdetails/fast_tag_file/",'*','fasttag'.$i.'file',$i,'fast_tag_file');
                }
                $fasttag_description = $this->input->post('fasttag'.$i.'description');
                $insertData['tracking_detail_type'] = 2;
                $insertData['loan_id'] = $loan_id;
                $insertData['image_name'] = $fast_tag_file;
                $insertData['image_count'] = $i;
                $insertData['description'] = $fasttag_description;
                $insertData['inserted_by'] = $this->session->userdata('emp_id');
                $insertData['inserted_date'] = date('Y-m-d H:i:s');
                if($fast_tag_file != "" || !empty($fasttag_description)){
                    $trackingdetails_id= $this->Common_model->insertSingle('tracking_details', $insertData);
                }
            }
            
            for($i=1;$i<=3;$i++){
                $gas_file = "";
                 if(!empty($_FILES['gas'.$i.'file']['name'])) {
                    $gas_file = $this->files_upload("assets/loanaccounts/Trackingdetails/gas_file/",'*','gas'.$i.'file',$i,'gas_file');
                }
                $gas_description = $this->input->post('gas'.$i.'description');
                $insertData['tracking_detail_type'] = 3;
                $insertData['loan_id'] = $loan_id;
                $insertData['image_name'] = $gas_file;
                $insertData['image_count'] = $i;
                $insertData['description'] = $gas_description;
                $insertData['inserted_by'] = $this->session->userdata('emp_id');
                $insertData['inserted_date'] = date('Y-m-d H:i:s');
                if($gas_file != "" || !empty($gas_description)){
                    $trackingdetails_id= $this->Common_model->insertSingle('tracking_details', $insertData);
                }
            }
            
            // Internet Files
            for($i = 1; $i <= 3; $i++) {
                $internet_file = "";
                if (!empty($_FILES['internet'.$i.'file']['name'])) {
                    $internet_file = $this->files_upload("assets/loanaccounts/Trackingdetails/internet_file/", '*', 'internet' . $i . 'file', $i, 'internet_file');
                }
                $internet_description = $this->input->post('internet' . $i . 'description');
                $insertData['tracking_detail_type'] = 4;
                $insertData['loan_id'] = $loan_id;
                $insertData['image_name'] = $internet_file;
                $insertData['image_count'] = $i;
                $insertData['description'] = $internet_description;
                $insertData['inserted_by'] = $this->session->userdata('emp_id');
                $insertData['inserted_date'] = date('Y-m-d H:i:s');
                if ($internet_file != "" || !empty($internet_description)) {
                    $trackingdetails_id = $this->Common_model->insertSingle('tracking_details', $insertData);
                }
            }
            
            // Ecommerce Files
            for($i = 1; $i <= 3; $i++) {
                $ecommerce_file = "";
                if (!empty($_FILES['ecommerce'.$i.'file']['name'])) {
                    $ecommerce_file = $this->files_upload("assets/loanaccounts/Trackingdetails/ecommerce_file/", '*', 'ecommerce' . $i . 'file', $i, 'ecommerce_file');
                }
                $ecommerce_description = $this->input->post('ecommerce' . $i . 'description');
                $insertData['tracking_detail_type'] = 5;
                $insertData['loan_id'] = $loan_id;
                $insertData['image_name'] = $ecommerce_file;
                $insertData['image_count'] = $i;
                $insertData['description'] = $ecommerce_description;
                $insertData['inserted_by'] = $this->session->userdata('emp_id');
                $insertData['inserted_date'] = date('Y-m-d H:i:s');
                if ($ecommerce_file != "" || !empty($ecommerce_description)) {
                    $trackingdetails_id = $this->Common_model->insertSingle('tracking_details', $insertData);
                }
            }
            
            // Other Files
            for($i = 1; $i <= 3; $i++) {
                $ecommerce_file = "";
                if (!empty($_FILES['other'.$i.'file']['name'])) {
                    $other_file = $this->files_upload("assets/loanaccounts/Trackingdetails/other_file/", '*', 'other' . $i . 'file', $i, 'other_file');
                }
                $other_description = $this->input->post('other' . $i . 'description');
                $insertData['tracking_detail_type'] = 6;
                $insertData['loan_id'] = $loan_id;
                $insertData['image_name'] = $other_file;
                $insertData['image_count'] = $i;
                $insertData['description'] = $other_description;
                $insertData['inserted_by'] = $this->session->userdata('emp_id');
                $insertData['inserted_date'] = date('Y-m-d H:i:s');
                if ($other_file != "" || !empty($other_description)) {
                    $trackingdetails_id = $this->Common_model->insertSingle('tracking_details', $insertData);
                }
            }
            
            $red=base_url()."Loanaccounts/loanaccount_view/".$loan_id;
            redirect($red);
            
        }
      
    }
//   public function insertTrackingDetailsForm() { 
   
//     if($_POST) {
      
//          $action = $this->input->post('action');        
//          $loan_id = $this->input->post('loan_id');
//          $trackingdetails_id  = $this->input->post('trackingdetails_id');
//          $notes = $this->input->post('notes');
        
//         if($action == 'add') {
//             $insertData = [
//                         'loan_id'  => $loan_id,
//                         'inserted_by' => $this->session->userdata('emp_id'),
//                         'inserted_date' => date('Y-m-d H:i:s')
//                     ];
//           $trackingdetails_id= $this->Common_model->insertSingle('trackingdetails_form', $insertData);
//             $updateParam1 = array('loan_id'=>$loan_id);
//             $updateData1['trackingdetails_id'] = $trackingdetails_id;
//             $affectedRows = $this->Common_model->updateRow('Loanaccounts',$updateData1,$updateParam1);
           
//           $id = $trackingdetails_id;
//             if(!empty($_FILES['cibil_score_file']['name'])) {
//                 $cibil_score_file = $this->files_upload("assets/loanaccounts/Trackingdetails/cibil_score_file/",'*','cibil_score_file',$id,'cibil_score_file');
//                 $updateData['cibil_score'] = $cibil_score_file;
//             }
//             if(!empty($_FILES['fast_tag_file']['name'])) {
//             $fast_tag_file = $this->files_upload("assets/loanaccounts/Trackingdetails/fast_tag_file/",'*','fast_tag_file',$id,'fast_tag_file');
//             $updateData['fast_tag'] = $fast_tag_file;
//             }
//              if(!empty($_FILES['gas_file']['name'])) {
//             $gas_file = $this->files_upload("assets/loanaccounts/Trackingdetails/gas_file/",'*','gas_file',$id,'gas_file');
//             $updateData['gas'] = $gas_file;
//             }
//             for ($i = 1; $i <= 10; $i++) {
//                 $fileInputName = 'file_input_' . $i;
                
//                 if (!empty($_FILES[$fileInputName]['name'])) {
//                     $uploadedFile = $this->files_upload("assets/loanaccounts/Trackingdetails/additional_files", '*', $fileInputName, $id, $fileInputName);
//                   // $updateData[$fileInputName] = $uploadedFile;
//                     $inserData = array(
//                             'trackingdetails_id' => $trackingdetails_id,
//                             'file_name' => $uploadedFile,
//                             'inserted_by' => $this->session->userdata('emp_id'),
//                             'inserted_date' => date('Y-m-d H:i:s'));
//                     $res = $this->Common_model->insertSingle('trackingdetails_files', $inserData);
//                 }
//             }
              
//             if (!empty($notes)) {
//                 $notesDetails = $this->Loanaccounts_model->getRecentNotes($trackingdetails_id);
                
//                 // Check if notes are different before inserting
//               if (!empty($notesDetails) && trim(strtolower($notesDetails->notes)) !== strtolower($notes)) {
//                     $insertData = [
//                         'trackingdetails_id' => $trackingdetails_id,
//                         'notes' => $notes,
//                         'inserted_by' => $this->session->userdata('emp_id'),
//                         'inserted_date' => date('Y-m-d H:i:s')
//                     ];
            
//                   $res1= $this->Common_model->insertSingle('trackingdetails_notes_details', $insertData);
//                 } if(empty($notesDetails)) {
//                     $insertData = [
//                         'trackingdetails_id' => $trackingdetails_id,
//                         'notes' => $notes,
//                         'inserted_by' => $this->session->userdata('emp_id'),
//                         'inserted_date' => date('Y-m-d H:i:s')
//                     ];
            
//                   $res1= $this->Common_model->insertSingle('trackingdetails_notes_details', $insertData);
//                 } 
//                 $notes_id = $res1;
//                 $updateData['notes_id'] = $notes_id;
//             }
            
             
            
//             $param = array('trackingdetails_id'=>$trackingdetails_id);
//              $affectedRows = $this->Common_model->updateRow('trackingdetails_form',$updateData,$param);
//         }
            
            
//         if($action == "edit") {
//             $id = $trackingdetails_id;
//             if(!empty($_FILES['cibil_score_file']['name'])) {
//                 $cibil_score_file = $this->files_upload("assets/loanaccounts/Trackingdetails/cibil_score_file/",'*','cibil_score_file',$id,'cibil_score_file');
//                 $updateData['cibil_score'] = $cibil_score_file;
//             }
//             if(!empty($_FILES['fast_tag_file']['name'])) {
//             $fast_tag_file = $this->files_upload("assets/loanaccounts/Trackingdetails/fast_tag_file/",'*','fast_tag_file',$id,'fast_tag_file');
//             $updateData['fast_tag'] = $fast_tag_file;
//             }
//              if(!empty($_FILES['gas_file']['name'])) {
//             $gas_file = $this->files_upload("assets/loanaccounts/Trackingdetails/gas_file/",'*','gas_file',$id,'gas_file');
//             $updateData['gas'] = $gas_file;
//             }
//             for ($i = 1; $i <= 10; $i++) {
//                 $fileInputName = 'file_input_' . $i;
                
//                 if (!empty($_FILES[$fileInputName]['name'])) {
//                     $uploadedFile = $this->files_upload("assets/loanaccounts/Trackingdetails/additional_files", '*', $fileInputName, $id, $fileInputName);
//                   // $updateData[$fileInputName] = $uploadedFile;
//                     $inserData = array(
//                             'trackingdetails_id' => $trackingdetails_id,
//                             'file_name' => $uploadedFile,
//                             'inserted_by' => $this->session->userdata('emp_id'),
//                             'inserted_date' => date('Y-m-d H:i:s'));
//                     $res = $this->Common_model->insertSingle('trackingdetails_files', $inserData);
//                 }
//             }
              
//             if (!empty($notes)) {
//                 $notesDetails = $this->Loanaccounts_model->getRecentNotes($trackingdetails_id);
                
//                 // Check if notes are different before inserting
//               if (!empty($notesDetails) && trim(strtolower($notesDetails->notes)) !== strtolower($notes)) {
//                     $insertData = [
//                         'trackingdetails_id' => $trackingdetails_id,
//                         'notes' => $notes,
//                         'inserted_by' => $this->session->userdata('emp_id'),
//                         'inserted_date' => date('Y-m-d H:i:s')
//                     ];
            
//                   $res1= $this->Common_model->insertSingle('trackingdetails_notes_details', $insertData);
//                 } if(empty($notesDetails)) {
//                     $insertData = [
//                         'trackingdetails_id' => $trackingdetails_id,
//                         'notes' => $notes,
//                         'inserted_by' => $this->session->userdata('emp_id'),
//                         'inserted_date' => date('Y-m-d H:i:s')
//                     ];
            
//                   $res1= $this->Common_model->insertSingle('trackingdetails_notes_details', $insertData);
//                 } 
//                 $notes_id = $res1;
//                 $updateData['notes_id'] = $notes_id;
//             }
            
             
            
//             $param = array('trackingdetails_id'=>$trackingdetails_id);
//              $affectedRows = $this->Common_model->updateRow('trackingdetails_form',$updateData,$param);
//         }
//         $red=base_url()."Loanaccounts/loanaccount_view/".$loan_id;
//         redirect($red);
//     }
//   }
  
     public function release_form($loan_id="",$s_id="",$rel_id="") { 
         
        $breadcrumbarray = array('label'=> "Loanaccounts",
                           'link' => base_url()."Loanaccounts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loanaccounts");
        if($rel_id!= ""){
            $data['action'] = 'edit';
            $releasedata = $this->Common_model->getSingleRow('release_form',array('rel_id'=>$rel_id));
            $data['releasedata'] = $releasedata;
            
        }else{
            $data['action'] = 'add';
        }           
        $data['banks'] = $this->Loanaccounts_model->getAllbanks();  
        $data['getAllEmployees'] = $this->Loanaccounts_model->getAllEmployees();  
        $data['branchs'] ='';
        $data['loan_id'] = $loan_id;
        $data['rel_id'] = $rel_id;
        $data['s_id'] = $s_id;
        $data['loandata'] = $this->Loanaccounts_model->getLoanDetails($loan_id);
        $this->template->load_view('Release_form',$data); 
    }
    public function insertRelease() {      

    if($_POST) {      
         $action = $this->input->post('action');         
         $s_id  = $this->input->post('s_id');
         $loan_id  = $this->input->post('loan_id');
         $release_date  = $this->input->post('release_date');
         $release_by  = $this->input->post('release_by');
         $remarks  = $this->input->post('remarks');
         $latitude  = $this->input->post('latitude');
         $longitude  = $this->input->post('longitude');
        if($action == "add") {
            $getMaxID = $this->Loanaccounts_model->getReleaseFormMaxID();
            $id = ($getMaxID->maxid+1);           
            $photo = $this->files_upload("assets/photos/",'*','photo',$id,'photo');
            $kyc = $this->files_upload("assets/kyc/",'*','kyc',$id,'kyc');
            $inserData = array(
                            's_id' => $s_id,
                            'loan_id' => $loan_id,
                            'release_date' => $release_date,
                            'released_by' => $release_by,
                            'photo' => $photo,
                            'kyc' => $kyc,
                            'remarks' =>$remarks,                            
                            'latitude' => $latitude,
                            'longitude' => $longitude,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
             $res = $this->Common_model->insertSingle('release_form', $inserData);
             $param = array('loan_id'=>$loan_id);
             $updateData['status'] = 'rel';
             $affectedRows = $this->Common_model->updateRow('Loanaccounts',$updateData,$param);          
        } else {
            $rel_id = $this->input->post('rel_id');
            $updateData['s_id'] = $s_id;
            $updateData['loan_id'] =$loan_id;
            $updateData['release_date'] =$release_date;
            $updateData['released_by'] =$release_by;
            $updateData['remarks'] = $remarks;
            $updateData['latitude'] = $latitude;
            $updateData['longitude'] = $longitude;
            $updateData['update_by'] = $this->session->userdata('emp_id');
            $updateData['update_date'] =date('Y-m-d H:i:s');
            $id = $rel_id;            
            if(!empty($_FILES['photo']['name'])) {
                $photo = $this->files_upload("assets/photos/",'*','photo',$id,'photo');
                $updateData['photo'] = $photo;
            }
            if(!empty($_FILES['kyc']['name'])) {
                $kyc = $this->files_upload("assets/kyc/",'*','kyc',$id,'kyc');
                $updateData['kyc'] = $kyc;
            }
            
             $param = array('rel_id'=>$rel_id);
             $affectedRows = $this->Common_model->updateRow('release_form',$updateData,$param);
        }        
         $red=base_url()."Loanaccounts";
                redirect($red);
    }
  }
    public function auction_form($loan_id="",$s_id="",$auc_id="") { 
         
        $breadcrumbarray = array('label'=> "Loanaccounts",
                           'link' => base_url()."Loanaccounts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loanaccounts");
        if($auc_id!= ""){
            $data['action'] = 'edit';
            $auctiondata = $this->Common_model->getSingleRow('auction_form',array('auc_id'=>$auc_id));
            $data['auctiondata'] = $auctiondata;
            
        }else{
            $data['action'] = 'add';
        }               
        $data['banks'] = $this->Loanaccounts_model->getAllbanks();  
        $data['branchs'] ='';
        $data['loan_id'] = $loan_id;
        $data['loandata'] = $this->Loanaccounts_model->getLoanDetails($loan_id);
        $this->template->load_view('Auction_form',$data); 
    }
    public function insertAuction() {       

    if($_POST) {      
         $action = $this->input->post('action');         
         $s_id  = $this->input->post('s_id');
         $loan_id  = $this->input->post('loan_id');
         $aution_date  = $this->input->post('aution_date');
         $auction_price  = $this->input->post('auction_price');
         $buyer_name  = $this->input->post('buyer_name');
         $buyer_mobile  = $this->input->post('phone');
         $reserve_price  = $this->input->post('reserve_price');
         $paper_ad_name  = $this->input->post('paper_ad_name');
         $remarks  = $this->input->post('remarks');
         $latitude  = '0.00';//$this->input->post('latitude');
         $longitude  = '0.00';//$this->input->post('longitude');


        if($action == "add") {
            $getMaxID = $this->Loanaccounts_model->getReleaseFormMaxID();
            $id = ($getMaxID->maxid+1);
            $final_notice = $this->files_upload("assets/auction/final_notice/",'*','final_notice',$id,'final_notice');
            $postal_slip = $this->files_upload("assets/auction/postal_slip/",'*','postal_slip',$id,'postal_slip');
            $parking_yard_doc = $this->files_upload("assets/auction/parking_yard_doc/",'*','parking_yard_doc',$id,'parking_yard_doc');
            $buyer_aadhar = $this->files_upload("assets/auction/buyer_aadhar/",'*','buyer_aadhar',$id,'buyer_aadhar');
            $buyer_pancard = $this->files_upload("assets/auction/buyer_pancard/",'*','buyer_pancard',$id,'buyer_pancard');
            $paper_ad = $this->files_upload("assets/auction/paper_ad/",'*','paper_ad',$id,'paper_ad');
            $auction_report = $this->files_upload("assets/auction/auction_report/",'*','auction_report',$id,'auction_report');
            $inserData = array(
                            's_id' => $s_id,
                            'loan_id' => $loan_id,
                            'final_notice' => $final_notice,
                            'postal_slip' => $postal_slip,
                            'parking_yard_doc' => $parking_yard_doc,
                            'aution_date' => $aution_date,
                            'auction_price' => $auction_price,
                            'buyer_name' => $buyer_name,
                            'buyer_mobile' => $buyer_mobile,
                            'buyer_aadhar' => $buyer_aadhar,
                            'buyer_pancard' => $buyer_pancard,
                            'reserve_price' => $reserve_price,
                            'paper_ad_name' => $paper_ad_name,
                            'paper_ad' => $paper_ad,
                            'auction_report' => $auction_report,
                            'remarks' => $remarks,
                             'latitude' => $latitude,
                            'longitude' => $longitude,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
             $res = $this->Common_model->insertSingle('auction_form', $inserData);
             $param = array('loan_id'=>$loan_id);
             $updateData['status'] = 'a';
             $affectedRows = $this->Common_model->updateRow('Loanaccounts',$updateData,$param);
             
        } else {
            $aution_date  = $this->input->post('aution_date');
            $auction_price  = $this->input->post('auction_price');
            $buyer_name  = $this->input->post('buyer_name');
            $buyer_mobile  = $this->input->post('phone');
            $reserve_price  = $this->input->post('reserve_price');
            $paper_ad_name  = $this->input->post('paper_ad_name');
            $auc_id = $this->input->post('auc_id');
            $updateData['s_id'] = $s_id;
            $updateData['loan_id'] =$loan_id;
            $updateData['aution_date'] =$aution_date;
            $updateData['auction_price'] =$auction_price;
            $updateData['buyer_name'] =$buyer_name;
            $updateData['buyer_mobile'] =$buyer_mobile;
            $updateData['reserve_price'] =$reserve_price;
            $updateData['paper_ad_name'] =$paper_ad_name;
            $updateData['remarks'] = $remarks;
             $updateData['latitude'] = $latitude;
            $updateData['longitude'] = $longitude;
            $updateData['update_by'] = $this->session->userdata('emp_id');
            $updateData['update_date'] =date('Y-m-d H:i:s');
            $id = $auc_id;
            
            if(!empty($_FILES['final_notice']['name'])) {
                $final_notice = $this->files_upload("assets/auction/final_notice/",'*','final_notice',$id,'final_notice');
                $updateData['final_notice'] = $final_notice;
            }
            if(!empty($_FILES['postal_slip']['name'])) {
                $postal_slip = $this->files_upload("assets/auction/postal_slip/",'*','postal_slip',$id,'postal_slip');
                $updateData['postal_slip'] = $postal_slip;
            }
            if(!empty($_FILES['parking_yard_doc']['name'])) {
                $parking_yard_doc = $this->files_upload("assets/auction/parking_yard_doc/",'*','parking_yard_doc',$id,'parking_yard_doc');
                $updateData['parking_yard_doc'] = $parking_yard_doc;
            }
            if(!empty($_FILES['buyer_aadhar']['name'])) {
                $buyer_aadhar = $this->files_upload("assets/auction/buyer_aadhar/",'*','buyer_aadhar',$id,'buyer_aadhar');
                $updateData['buyer_aadhar'] = $buyer_aadhar;
            }
            if(!empty($_FILES['buyer_pancard']['name'])) {
                $buyer_pancard = $this->files_upload("assets/auction/buyer_pancard/",'*','buyer_pancard',$id,'buyer_pancard');
                $updateData['buyer_pancard'] = $buyer_pancard;
            }

            if(!empty($_FILES['paper_ad']['name'])) {
                $paper_ad = $this->files_upload("assets/auction/paper_ad/",'*','paper_ad',$id,'paper_ad');
                $updateData['paper_ad'] = $paper_ad;
            }
            if(!empty($_FILES['auction_report']['name'])) {
                $auction_report = $this->files_upload("assets/auction/auction_report/",'*','auction_report',$id,'auction_report');
                $updateData['auction_report'] = $auction_report;
            }


             $param = array('auc_id'=>$auc_id);
             $affectedRows = $this->Common_model->updateRow('auction_form',$updateData,$param);
        }
        
         $red=base_url()."Loanaccounts";
                redirect($red);
    }
  }
    public function loanaccount_view($loan_id = '') { 
         
        $breadcrumbarray = array('label'=> "Loanaccounts",
                           'link' => base_url()."Loanaccounts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loanaccounts");
        $data['action'] = 'add';          
        //$data['banks'] = $this->Loanaccounts_model->getAllbanks();  
        $data['loandata'] = $this->Loanaccounts_model->getLoanDetails($loan_id);
        $data['workOrderData']  =  $this->Common_model->getSingleRow('workorder_form',array('loan_id'=>$loan_id));
        $data['finalNoticeData']  =  $this->Common_model->getSingleRow('final_notice_form',array('loan_id'=>$loan_id));
        $data['trackingDetailsData']  =  $this->Common_model->getResult('tracking_details',array('loan_id'=>$loan_id));

        $data['firstNoticeData']  =  $this->Common_model->getSingleRow('loan_1st_notice',array('loan_id'=>$loan_id));
        $data['secondNoticeData']  =  $this->Common_model->getSingleRow('loan_2nd_notice',array('loan_id'=>$loan_id));
        $data['thirdNoticeData']  =  $this->Common_model->getSingleRow('loan_3rd_notice',array('loan_id'=>$loan_id));
        $data['fourthFinalNoticeData']  =  $this->Common_model->getSingleRow('loan_final_notice',array('loan_id'=>$loan_id));
        //$data['trackingDetailsFiles'] = $this->Common_model->getResult('trackingdetails_files',array('trackingdetails_id'=>$data['trackingDetailsData']->trackingdetails_id));
        //$data['trackingDetailsNotes'] = $this->Common_model->getResult('trackingdetails_notes_details',array('trackingdetails_id'=>$data['trackingDetailsData']->trackingdetails_id));
       // echo "<pre>"; print_r($data['loandata']);exit;

        if($data['loandata']->status == 'reg'){
          $rParam = array('r_id'=>$data['loandata']->r_id);
          $data['regData']  =  $this->Common_model->getSingleRow('regularize_form',$rParam);
        }else if($data['loandata']->status == 's'){
          $rParam = array('s_id'=>$data['loandata']->s_id);
          $data['sezData']  =  $this->Common_model->getSingleRow('seize_form',$rParam);
        }else if($data['loandata']->status == 'rel'){

            $rParam = array('s_id'=>$data['loandata']->s_id);
            $data['sezData']  =  $this->Common_model->getSingleRow('seize_form',$rParam);
            // echo "<pre>"; echo $this->db->last_query();
            // echo "<br>";
            $data['relData']  =  $this->Common_model->getSingleRow('release_form',$rParam);

            //echo "<pre>"; echo $this->db->last_query();

        }else if($data['loandata']->status == 'a'){
            $rParam = array('s_id'=>$data['loandata']->s_id);
            $data['sezData']  =  $this->Common_model->getSingleRow('seize_form',$rParam);
            $data['auclData']  =  $this->Common_model->getSingleRow('auction_form',$rParam);

        }else if($data['loandata']->status == 'c'){
         
            $data['regData'] = '';
            $data['sezData'] = '';
            $data['relData'] = '';
            $data['auclData'] = '';
                    
        }else if($data['loandata']->status == 'p'){
            $data['regData'] = '';
            $data['sezData'] = '';
            $data['relData'] = '';
            $data['auclData'] = '';
        }


        // if(!empty($data['loandata']->s_id)){
        //     $seizeParam = array('s_id'=>$data['loandata']->s_id);
        //     $checkReleaseData = $this->Common_model->getSingleRow('release_form',$seizeParam); 
        //     $checkAuctionData = $this->Common_model->getSingleRow('auction_form',$seizeParam);
        //     $data['checkReleaseData'] = $checkReleaseData;
        //     $data['checkAuctionData'] = $checkAuctionData;
        // }
        
        // $data['branchs'] ='';
        // echo "<pre>"; print_r($data);exit;
        $this->template->load_view('Loanaccounts_view',$data); 
    }
   
  public function insertloandetails() {

    if($_POST) {
        $home_branch_id = '';
        $bank_id  = (!empty($this->input->post('bank_id')) ? $this->input->post('bank_id') : $this->input->post('bank_id_hidden'));
        $branch_id  = (!empty($this->input->post('branch_id')) ? $this->input->post('branch_id') : $this->input->post('branch_id_hidden')); 
        $home_branch_id  = (!empty($this->input->post('home_branch_id')) ? $this->input->post('home_branch_id') : $this->input->post('branch_id_hidden')); 
        if(empty($home_branch_id)){
            $home_branch_id = $branch_id;
        }
        $branch_controller  = (!empty($this->input->post('branch_controller'))? $this->input->post('branch_controller') : '');        
        $rbo_id  = (!empty($this->input->post('rbo_id'))? $this->input->post('rbo_id') : '');
        $loan_ac_number  = $this->input->post('loan_ac_number');
        $barrower_name  = $this->input->post('barrower_name');
        $vehicle_number  = $this->input->post('vehicle_number');
        $vehicle_chasse_number  = $this->input->post('vehicle_chasse_number');
        $vehicle_engine_num  = $this->input->post('vehicle_engine_num');
        $order_id  = (!empty($this->input->post('order_id'))? $this->input->post('order_id') : '');

        $cus_mobile  = $this->input->post('cus_mobile');
        $cus_pan  = $this->input->post('cus_pan');
        $cus_address  = $this->input->post('cus_address');
        $date_of_sanction  = $this->input->post('date_of_sanction');
        $cus_loan_amount  = $this->input->post('cus_loan_amount');
        $outstanding_amount  = $this->input->post('outstanding_amount');
        $irregular_amount  = $this->input->post('irregular_amount');
        $account_status  = $this->input->post('account_status');
        $make_company  = $this->input->post('make_company');
         $year_of_make  = $this->input->post('year_of_make');
        $rc_number  = $this->input->post('rc_number');
        $insurance_company  = $this->input->post('insurance_company');
        $insurance_expiry  = $this->input->post('insurance_expiry');
        $npa_date  = $this->input->post('npa_date');
        $remarks  = $this->input->post('remarks');
        
        $cus_mobile2  = $this->input->post('cus_mobile2');
        $cus_mobile3  = $this->input->post('cus_mobile3');
        $coapplicant_mobile  = $this->input->post('coapplicant_mobile');
        $coapplicant_mobile2  = $this->input->post('coapplicant_mobile2');
        $coapplicant_pan  = $this->input->post('coapplicant_pan');
        $coapplicant_address  = $this->input->post('coapplicant_address');
        
        $cus_aadhar_no  = $this->input->post('cus_aadhar_no');
        $coapplicant_aadhar_no  = $this->input->post('coapplicant_aadhar_no');
        $guarantor_mobile = $this->input->post('guarantor_mobile');
        $guarantor_mobile2 = $this->input->post('guarantor_mobile2');
        $guarantor_pan = $this->input->post('guarantor_pan');
        $guarantor_address = $this->input->post('guarantor_address');
        $guarantor_aadhar_no = $this->input->post('guarantor_aadhar_no');
        $guarantor_aadhar_doc = $this->input->post('guarantor_aadhar_doc');
        $re_assign_id = $this->session->userdata('emp_id');

        $action = $this->input->post('action');
        if($action == "add") {
            $emp_id = $this->session->userdata('emp_id');
            $inserData = array(
                            'bank_id' => $bank_id,
                            'branch_id'  => $branch_id,
                            'type_id'  => '1',
                            'emp_id' => $emp_id,
                            'loan_ac_number' => $loan_ac_number,
                            'home_branch_id' => $home_branch_id,
                            'barrower_name' => $barrower_name,
                            'rbo_id' => $rbo_id,
                            'vehicle_number' => $vehicle_number,
                            'vehicle_chasse_number' => $vehicle_chasse_number,
                            'vehicle_engine_num' => $vehicle_engine_num,
                            'cus_mobile' => $cus_mobile,
                            'cus_mobile2' => $cus_mobile2,
                            'cus_mobile3' => $cus_mobile3,
                            'coapplicant_mobile' => $coapplicant_mobile,
                            'coapplicant_mobile2' => $coapplicant_mobile2,
                            'coapplicant_pan' => $coapplicant_pan,
                            'coapplicant_address' => $coapplicant_address,
                            'cus_pan'  => $cus_pan,
                            'cus_address' => $cus_address,                          
                            'date_of_sanction' => $date_of_sanction,
                            'cus_loan_amount' => $cus_loan_amount,
                            'outstanding_amount' => $outstanding_amount,
                            'irregular_amount' => $irregular_amount,
                            'account_status' => $account_status,
                            'make_company' => $make_company,
                            'year_of_make' => $year_of_make,
                            'rc_number' => $rc_number,
                            'insurance_company' => $insurance_company,
                            'insurance_expiry' => $insurance_expiry,
                            'npa_date' => $npa_date,
                            'remarks' => $remarks,
                            'coapplicant_aadhar_no' => $coapplicant_aadhar_no,
                            'guarantor_mobile' => $guarantor_mobile,
                            'guarantor_mobile2' => $guarantor_mobile2,
                            'guarantor_pan' => $guarantor_pan,
                            'guarantor_address' => $guarantor_address,
                            'guarantor_aadhar_no' => $guarantor_aadhar_no,
                            'cus_aadhar_no' => $cus_aadhar_no,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            're_assign_id' => $re_assign_id,
                            'inserted_date' => date('Y-m-d H:i:s'));
             $res = $this->Common_model->insertSingle('Loanaccounts', $inserData);
             if($res){                 
                 $customer_file = $this->files_upload("assets/loanaccounts/customer_file/",'*','customer_file',$res,'customer_file'); 
                $updatedata['customer_file'] = $customer_file;
                $updateParam = array('loan_id'=>$res);
                
                if(!empty($_FILES['aadhar_doc']['name'])) {
                  $cus_aadhar = $this->files_upload("assets/loanaccounts/",'*','aadhar_doc',$res,'aadhar_doc');  
                   $updateData['cus_aadhar'] = $cus_aadhar;
                }
                if(!empty($_FILES['guarantor_aadhar_doc']['name'])) {
                  $guarantor_aadhar_doc = $this->files_upload("assets/loanaccounts/guarantor_aadhar_doc",'*','guarantor_aadhar_doc',$id,'guarantor_aadhar_doc');  
                   $updateData['guarantor_aadhar_file'] = $guarantor_aadhar_doc;
                }
            
                if(!empty($_FILES['coapplicant_aadhar_doc']['name'])) {
                  $coapplicant_aadhar = $this->files_upload("assets/loanaccounts/",'*','coapplicant_aadhar_doc',$id,'coapplicant_aadhar_doc');  
                   $updateData['coapplicant_aadhar'] = $coapplicant_aadhar;
                }
                $this->Common_model->updateRow('Loanaccounts',$updatedata,$updateParam);
             }
             
             
        } else {
                $emp_id = $this->session->userdata('emp_id');
                $loan_id = $this->input->post('loan_id');
                $updateData['bank_id'] = $bank_id;
                $updateData['branch_id'] = $branch_id;
                $updateData['home_branch_id'] = $home_branch_id;
                $updateData['rbo_id'] = $rbo_id;
                $updateData['branch_controller'] = $branch_controller;
                $updateData['order_id'] = $order_id;
                $updateData['emp_id'] = $this->input->post('emp_id');
                $updateData['loan_ac_number'] = $loan_ac_number;
                $updateData['barrower_name'] = $barrower_name;
                $updateData['vehicle_number'] = $vehicle_number;
                $updateData['vehicle_chasse_number'] = $vehicle_chasse_number;
                $updateData['vehicle_engine_num'] = $vehicle_engine_num;
                $updateData['cus_mobile'] = $cus_mobile;
                $updateData['cus_mobile2'] = $cus_mobile2;
                $updateData['cus_mobile3'] = $cus_mobile3;
                $updateData['coapplicant_mobile'] = $coapplicant_mobile;
                $updateData['coapplicant_mobile2'] = $coapplicant_mobile2;
                $updateData['coapplicant_pan'] = $coapplicant_pan;
                $updateData['coapplicant_address'] = $coapplicant_address;
                
                $updateData['cus_pan'] = $cus_pan;
                $updateData['cus_address'] = $cus_address;
                $updateData['date_of_sanction'] = $date_of_sanction;
                $updateData['cus_loan_amount'] = $cus_loan_amount;
                $updateData['outstanding_amount'] = $outstanding_amount;
                $updateData['irregular_amount'] = $irregular_amount;
                $updateData['account_status'] = $account_status;
                $updateData['make_company'] = $make_company;
                $updateData['year_of_make'] = $year_of_make;
                $updateData['rc_number'] = $rc_number;
                $updateData['insurance_company'] = $insurance_company;
                $updateData['insurance_expiry'] = $insurance_expiry;
                $updateData['npa_date'] = $npa_date;
                $updatedata['remarks'] = $remarks;
                $updateData['guarantor_mobile'] = $guarantor_mobile;
                $updateData['guarantor_mobile2'] = $guarantor_mobile2;
                $updateData['guarantor_pan'] = $guarantor_pan;
                $updateData['guarantor_address'] = $guarantor_address;
                $updateData['guarantor_aadhar_no'] = $guarantor_aadhar_no;
                $updateData['updated_date'] =date('Y-m-d H:i:s');   
                $updateData['updated_by'] = $emp_id;
            $id = $loan_id;            
            
             if(!empty($_FILES['customer_file']['name'])) {
              $customer_file = $this->files_upload("assets/loanaccounts/",'*','customer_file',$id,'customer_file');  
               $updateData['customer_file'] = $customer_file;
            } 
               if(!empty($_FILES['guarantor_aadhar_doc']['name'])) {
                  $guarantor_aadhar_doc = $this->files_upload("assets/loanaccounts/guarantor_aadhar_doc",'*','guarantor_aadhar_doc',$id,'guarantor_aadhar_doc');  
                   $updateData['guarantor_aadhar_file'] = $guarantor_aadhar_doc;
                }
             $param = array('loan_id'=>$loan_id);           
             $affectedRows = $this->Common_model->updateRow('Loanaccounts',$updateData,$param);
            
                 

             
        }        
         $red=base_url()."Loanaccounts";
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
  
    public function get_regularize_display() {
        if($_POST) {
            $r_id = $this->input->post('r_id');
            $regularizeData = $this->Common_model->getSingleRow('regularize_form',array('r_id'=>$r_id));
                $seizer_notice_path = base_url().'assets/seizer_notice/'.$regularizeData->seizer_notice;
                $postal_slip_path = base_url().'assets/postal_slip/'.$regularizeData->postal_slip;
                $property_photo_path = base_url().'assets/property_photo/'.$regularizeData->property_photo;
                $visit_photo_path = base_url().'assets/visit_photo/'.$regularizeData->visit_photo;

                $latitude =  $regularizeData->latitude;
                $longitude =  $regularizeData->longitude;
                $remarks  = $regularizeData->remarks;   
                

              $table = "<h3>Regularize Details</h3><div class='card'><div class='card-body'><div class='table-responsive'>";
              $table .= "<table class='table table-bordered'><tbody>";
              $table .= "<tr><td>Seizer Notice&nbsp;<a href='".$seizer_notice_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .= "<tr><td>Postal Slip&nbsp;<a href='".$postal_slip_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .= "<tr><td>Property Photo&nbsp;<a href='".$property_photo_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .= "<tr><td>Visit Photo&nbsp;<a href='".$visit_photo_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .="<tr><td>Latitude:&nbsp;<strong>".$latitude."</strong></td></tr>";
               $table .="<tr><td>longitude:&nbsp;<strong>".$longitude."</strong></td></tr>";
                 $table .="<tr><td>Remarks:&nbsp;<strong>".$remarks."</strong></td></tr>";
              $table .= "</tbody></table></div></div></div>";
              echo $table;
        } else {
             echo "forbidden access";
        }
    }
    public function get_sieze_display() {
        if($_POST) {
           // echo "<bre>"; print_r($_POST);exit;
            $s_id = $this->input->post('s_id');
            $seizeData = $this->Common_model->getSingleRow('seize_form',array('s_id'=>$s_id));
            if($seizeData->seizer_guidelines_followed == 'y'){
                $sgf = 'Yes';
               }else {
                $sgf = 'No';
               }
                $latitude =  $seizeData->latitude;
                $longitude =  $seizeData->longitude;
                $remarks  = $seizeData->remarks;                

                $panchanama_doc_path = base_url().'assets/panchanama_doc/'.$seizeData->panchanama_doc;
                $stock_yard_panchanama_path = base_url().'assets/stock_yard_panchanama/'.$seizeData->stock_yard_panchanama;
                $Inventory_path = base_url().'assets/inventory/'.$seizeData->inventory;
                $photo1_path = base_url().'assets/photos/'.$seizeData->photo1;
                $video1_path = base_url().'assets/videos/'.$seizeData->video1;

              $table = "<h3>Sieze Information </h3><div class='card'><div class='card-body'><div class='table-responsive'>";

              $table .= "<table class='table table-sm'><tbody>";
              $table .="<tr><td>Seize Date:&nbsp;<strong>".date('d M Y',strtotime($seizeData->seize_date))."</strong>&nbsp;&nbsp;Seize By:&nbsp;<strong>".$seizeData->seized_by."</strong></td></tr>";
               $table .="<tr><td>Seizer Guidelines Followed:&nbsp;<strong>".$sgf."</strong></td></tr>";
              $table .= "<tr><td>Panchanama Document &nbsp;<a href='".$panchanama_doc_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .= "<tr><td>Stock Yard Panchanama&nbsp;<a href='".$stock_yard_panchanama_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
               $table .= "<tr><td>Inventory&nbsp;<a href='".$Inventory_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .= "<tr><td>Photos&nbsp;<a href='".$photo1_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .= "<tr><td>Videos&nbsp;<a href='".$video1_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .="<tr><td>Latitude:&nbsp;<strong>".$latitude."</strong></td></tr>";
               $table .="<tr><td>longitude:&nbsp;<strong>".$longitude."</strong></td></tr>";
                $table .="<tr><td>Remarks:&nbsp;<strong>".$remarks."</strong></td></tr>";
              $table .= "</tbody></table></div></div></div>";
              echo $table;
        } else {
             echo "forbidden access";
        }
    }
    public function get_release_display() {
        if($_POST) {
            $rel_id = $this->input->post('rel_id');
            $releaseData = $this->Common_model->getSingleRow('release_form',array('rel_id'=>$rel_id));
                $latitude =  $releaseData->latitude;
                $longitude =  $releaseData->longitude;
                $photos_path = base_url().'assets/photos/'.$releaseData->photo;
                $kyc = base_url().'assets/kyc/'.$releaseData->kyc;
                 $remarks  = $releaseData->remarks;    

              $table = "<h3>Release Information </h3><div class='card'><div class='card-body'><div class='table-responsive'>";

              $table .= "<table class='table table-sm'><tbody>";
              $table .="<tr><td>Release Date:&nbsp;<strong>".date('d M Y',strtotime($releaseData->release_date))."</strong>&nbsp;&nbsp;Released By:&nbsp;<strong>".getEmployeeName($releaseData->released_by)."</strong></td></tr>";
              $table .= "<tr><td>Photo &nbsp;<a href='".$photos_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .= "<tr><td>KYC&nbsp;<a href='".$kyc."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .="<tr><td>Latitude:&nbsp;<strong>".$latitude."</strong></td></tr>";
               $table .="<tr><td>longitude:&nbsp;<strong>".$longitude."</strong></td></tr>";
                 $table .="<tr><td>Remarks:&nbsp;<strong>".$remarks."</strong></td></tr>";
              $table .= "</tbody></table></div></div></div>";
              echo $table;
        } else {
             echo "forbidden access";
        }
    }
    public function get_auction_display() {
        if($_POST) {
            $auc_id = $this->input->post('auc_id');
            $auctionData = $this->Common_model->getSingleRow('auction_form',array('auc_id'=>$auc_id));
             $latitude =  $auctionData->latitude;
                $longitude =  $auctionData->longitude;
                $remarks  = $auctionData->remarks;   
                $final_notice_path = base_url().'assets/auction/final_notice/'.$auctionData->final_notice;
                $postal_slip_path = base_url().'assets/auction/postal_slip/'.$auctionData->postal_slip;
                $parking_yard_doc_path = base_url().'assets/auction/parking_yard_doc/'.$auctionData->parking_yard_doc;
                $buyer_aadhar_path = base_url().'assets/auction/buyer_aadhar/'.$auctionData->buyer_aadhar;
                $buyer_pancard_path = base_url().'assets/auction/buyer_pancard/'.$auctionData->buyer_pancard;
                $auction_report_path = base_url().'assets/auction/auction_report/'.$auctionData->auction_report;
                 $paper_ad_path = base_url().'assets/auction/paper_ad/'.$auctionData->paper_ad;
               

              $table = "<h3>Auction Information </h3><div class='card'><div class='card-body'><div class='table-responsive'>";

              $table .= "<table class='table table-sm'><tbody>";
              $table .="<tr><td>Aution Date:&nbsp;<strong>".date('d M Y',strtotime($auctionData->aution_date))."</strong>&nbsp;&nbsp;Aution Price:&nbsp;<strong>".$auctionData->auction_price."</strong></td></tr>";
              $table .="<tr><td>Buyer Name:&nbsp;<strong>".$auctionData->buyer_name."</strong>&nbsp;&nbsp;Buyer Mobile:&nbsp;<strong>".$auctionData->buyer_mobile."</strong></td></tr>";
               $table .="<tr><td>Reserve Price:&nbsp;<strong>".$auctionData->reserve_price."</strong>&nbsp;&nbsp;Paper Ad Name:&nbsp;<strong>".$auctionData->paper_ad_name."</strong></td></tr>";
              $table .= "<tr><td>Final Notice &nbsp;<a href='".$final_notice_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .= "<tr><td>Postal Slip &nbsp;<a href='".$postal_slip_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .= "<tr><td>Parking Yard Document&nbsp;<a href='".$parking_yard_doc_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .= "<tr><td>Buyer Aadhar card&nbsp;<a href='".$buyer_aadhar_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
              $table .= "<tr><td>Buyer Pancard &nbsp;<a href='".$buyer_pancard_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";              
                $table .= "<tr><td>Auction Report &nbsp;<a href='".$auction_report_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
                 $table .= "<tr><td>Paper Ad &nbsp;<a href='".$paper_ad_path."' class='btn btn-icon text-secondary' type='button' target='_blank'><i class='material-icons'>cloud_download</i></a></td></tr>";
                 $table .="<tr><td>Latitude:&nbsp;<strong>".$latitude."</strong></td></tr>";
               $table .="<tr><td>longitude:&nbsp;<strong>".$longitude."</strong></td></tr>";
                $table .="<tr><td>Remarks:&nbsp;<strong>".$remarks."</strong></td></tr>";
              $table .= "</tbody></table></div></div></div>";
              echo $table;
        } else {
             echo "forbidden access";
        }
    }
    public function insertFinalNoticeForm() {
        if($_POST) {
            
            $action = $this->input->post('action');
         $loan_id  = $this->input->post('loan_id');
         $remarks  = $this->input->post('remarks');
         $latitude  = $this->input->post('latitude');
         $longitude  = $this->input->post('longitude');
         $location = $this->input->post('location');
        $latitude1  = $this->input->post('latitude1');
        $longitude1  = $this->input->post('longitude1');
        $location1 = $this->input->post('location1');
         $latitude2  = $this->input->post('latitude2');
         $longitude2  = $this->input->post('longitude2');
         $location2 = $this->input->post('location2');
        if($action == "add") {
            $getMaxID = $this->Loanaccounts_model->getMaxID();
            $id = ($getMaxID->maxid+1);
            $signed_copy = $this->files_upload("assets/signed_copy/",'*','signed_copy',$id,'signed_copy');
            $postal_copy = $this->files_upload("assets/postal_copy/",'*','postal_copy',$id,'postal_copy');
            $visit_photos = $this->files_upload("assets/visit_photos/",'*','visit_photos',$id,'visit_photos');

            $inserData = array(
                            'loan_id' => $loan_id,
                            'signed' => $signed_copy,
                            'postal' => $postal_copy,
                            'visit' => $visit_photos,
                            'remarks' => $remarks,
                            'latitude' => $latitude,
                            'longitude' => $longitude,
                            'location' => $location,
                            'latitude1' => $latitude1,
                            'longitude1' => $longitude1,
                            'location1' => $location1,
                            'latitude2' => $latitude2,
                            'longitude2' => $longitude2,
                            'location2' => $location2,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
             $res = $this->Common_model->insertSingle('final_notice_form', $inserData);
        }
        else {
            
            }
            $red=base_url()."Loanaccounts/loanaccount_view/".$loan_id;
            redirect($red);
        }
       
    }
    public function changeApprovalStatus(){
        if($_POST){
            $loan_id = $this->input->post('loan_id');
            $updatedata['approval_status'] = 'a';  
          
            $updateParam = array('loan_id'=>$loan_id);
            $this->Common_model->updateRow('Loanaccounts',$updatedata,$updateParam);
        }
    }
    

}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
