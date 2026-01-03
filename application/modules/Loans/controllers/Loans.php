<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : ch.v.sudhakar9@gmail.com, phpguidance@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Loans
 *  
 */
class Loans extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Loans_model');
        $this->load->language('Loans');
        $this->load->library('pagination');
        $this->load->helper('phpass');   
    }
    public function index(){
       $this->template->load_view('loan_types');  
    }
    public function checkloantype(){
            if($_POST) {     
                $loan_type = $this->input->post('loan_type');
                if($loan_type == '1'){
                    redirect(base_url().'Loanaccounts');
                }else {
                    redirect(base_url().'Loans/loantypes/'.$loan_type);
                }
            }
    }
    public function loantypes($id) {    
        if($id ==''){
             redirect(base_url().'Loans');
        }
              
        $breadcrumbarray = array('label'=> "Loans",
                           'link' => base_url()."Loans"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loans");  
        $config['base_url'] = base_url().'/Loans/';
        $config["total_rows"] = $this->Loans_model->getLoansCounts($id);
        $config["per_page"] = 100;
        $config["uri_segment"] = 4;
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["Loans"] = $this->Loans_model->getAllLoans($id,$config["per_page"], $page);
        $data['page'] = $page;
        $data["links"] = $this->pagination->create_links();              
        if($_POST){           
            $this->load->view('Loans_ajax', $data);
        }else {
            $this->template->load_view('Loans', $data);
        }
    }

    public function addaccount($type_id = "") {          
        $breadcrumbarray = array('label'=> "Loans",
                           'link' => base_url()."Loans"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loans");
        $data['action'] = 'add';          
        $data['banks']  = $this->Loans_model->getAllbanks();
        $data['branchs'] ='';      
        $data['type_id'] = $type_id;
        $this->template->load_view('Loans_add',$data); 
    }

    public function addaccount1($loan_id = "") { 
        $breadcrumbarray = array('label'=> "Loans",
                           'link' => base_url()."Loans"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loans");
        $data['banks']  = $this->Loans_model->getAllbanks();
       
        //$data['workorders'] = $this->Loans_model->getWorkorders1();
       // $data['branchs'] ='';
        if($loan_id !=''){
            $data['action'] = 'edit';
            $data['loandata'] = $this->Loans_model->getLoanDetails($loan_id);
            $data['branchs'] = $this->Loans_model->getBranchs($data['loandata']->bank_id);
        }
        $this->template->load_view('Loans_add',$data); 
    }
  
    public function getBranchas($bank_id =''){
        if($_POST) {
        $bank_id = $this->input->post('bank_id');
        }else {
         $bank_id = $bank_id;
        }
        $branchs =  $this->Loans_model->getBranchs($bank_id);
        header('Content-type: application/json');
        die( json_encode( $branchs ) );  
    }

  public function insertloandetails() {

    if($_POST) {

        $bank_id  = $this->input->post('bank_id');
        $branch_id  = $this->input->post('branch_id'); 
        $branch_controller  = $this->input->post('branch_controller');                
        $loan_ac_number  = $this->input->post('loan_ac_number');
        $barrower_name  = $this->input->post('barrower_name');
        $date_of_sanction  = $this->input->post('date_of_sanction');
        $cus_loan_amount  = $this->input->post('cus_loan_amount');
        $outstanding_amount  = $this->input->post('outstanding_amount');
        $irregular_amount  = $this->input->post('irregular_amount');
        $type_id  = $this->input->post('type_id');
        
        $action = $this->input->post('action');
        if($action == "add") {
            $emp_id = $this->session->userdata('emp_id');
            $inserData = array(
                            'bank_id' => $bank_id,
                            'branch_id'  => $branch_id,
                            'type_id'  => $type_id,
                            'branch_controller' =>$branch_controller,
                            'emp_id' => $emp_id,
                            'loan_ac_number' => $loan_ac_number,
                            'barrower_name' => $barrower_name,
                            'date_of_sanction' => $date_of_sanction,
                            'cus_loan_amount' => $cus_loan_amount,
                            'outstanding_amount' => $outstanding_amount,
                            'irregular_amount' => $irregular_amount,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
             $res = $this->Common_model->insertSingle('Loanaccounts', $inserData);            
             
             
        } else {
                $emp_id = $this->session->userdata('emp_id');
                $loan_id = $this->input->post('loan_id');
                $updateData['bank_id'] = $bank_id;
                $updateData['branch_id'] = $branch_id;
                $updateData['type_id'] = $type_id;                
                $updateData['branch_controller'] = $branch_controller;
                $updateData['emp_id'] = $this->input->post('emp_id');
                $updateData['loan_ac_number'] = $loan_ac_number;
                $updateData['barrower_name'] = $barrower_name;
                $updateData['date_of_sanction'] = $date_of_sanction;
                $updateData['cus_loan_amount'] = $cus_loan_amount;
                $updateData['outstanding_amount'] = $outstanding_amount;
                $updateData['irregular_amount'] = $irregular_amount;
                $updateData['updated_date'] =date('Y-m-d H:i:s');   
                $updateData['updated_by'] = $emp_id;
                $id = $loan_id;                        
                $param = array('loan_id'=>$loan_id);           
                $affectedRows = $this->Common_model->updateRow('Loanaccounts',$updateData,$param);           
        }        
         $red=base_url()."Loans/loantypes/".$type_id;
         redirect($red);
    }
  }
   public function regcolse_form($loan_id="",$type='',$id='') {         
        $breadcrumbarray = array('label'=> "Loans",
                           'link' => base_url()."Loans"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Loans");
        $data['type'] = $type;
        if($id!= ""){
            $data['action'] = 'edit';
            $regularizeData = $this->Common_model->getSingleRow('reg_close_loans_data',array('id'=>$id));
            $data['regularizeData'] = $regularizeData;
            
        }else{
            $data['action'] = 'add';
        }
        $data['loan_id'] = $loan_id;        
        $this->template->load_view('Regularize_form',$data); 
    }
    public function insertForm() {

    if($_POST) {
         $action = $this->input->post('action');
         $loan_id  = $this->input->post('loan_id');
         $type  = $this->input->post('type');
         $remarks  = $this->input->post('remarks');
         $borrower_contact_no_1  = $this->input->post('borrower_contact_no_1');
         $borrower_contact_no_2  = $this->input->post('borrower_contact_no_2');
         $other_contact_no_1  = $this->input->post('other_contact_no_1');
         $other_contact_no_2  = $this->input->post('other_contact_no_2');          
        if($action == "add") {   
            $inserData = array(
                            'loan_id' => $loan_id,
                            'type' => $type,
                            'borrower_contact_no_1' => $borrower_contact_no_1,
                            'borrower_contact_no_2' => $borrower_contact_no_2,
                            'other_contact_no_1' => $other_contact_no_1,
                            'other_contact_no_2' => $other_contact_no_2,
                            'remarks' => $remarks,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
            $res = $this->Common_model->insertSingle('reg_close_loans_data', $inserData);
            if($res){
                $updatedata['status'] = $type; 
                $updateParam = array('loan_id'=>$loan_id);
                $this->Common_model->updateRow('Loanaccounts',$updatedata,$updateParam);
            }
             
        } else {
            $id = $this->input->post('id');
            $updateData['borrower_contact_no_1'] = $borrower_contact_no_1;
            $updateData['borrower_contact_no_2'] = $borrower_contact_no_2;
            $updateData['other_contact_no_1'] = $other_contact_no_1;
            $updateData['other_contact_no_2'] = $other_contact_no_2;
            $updateData['remarks'] = $remarks;            
            $updateData['updated_by'] = $this->session->userdata('emp_id');
            $updateData['updated_date'] =date('Y-m-d H:i:s');            
            $param = array('id'=>$id);
            $affectedRows = $this->Common_model->updateRow('reg_close_loans_data',$updateData,$param);
        }        
        $red=base_url()."Loans";
        redirect($red);
    }
  }
}
/* End of file module.php */
/* Location: ./application/controllers/module.php */