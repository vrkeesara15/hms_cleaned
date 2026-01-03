<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Allbranchs extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Allbranchs_model');
        $this->load->language('Allbranchs');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Allbranchs",
                           'link' => base_url()."Allbranchs"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Allbranchs"); 
        $data['details']  = $this->Allbranchs_model->getAllbranchs();
        /*echo "<pre>";
        echo $this->db->last_query();
        print_r($data['details']); exit();*/
        
        $this->template->load_view('Allbranchs',$data);        

    }
    public function addAllbranchs() {      

        //  if($this->session->userdata('user_role') != '1'){
        //     redirect(base_url().'Dashboard'); 
        // }
        
        $breadcrumbarray = array('label'=> "Allbranchs",
                           'link' => base_url()."Allbranchs"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Allbranchs");
        $data['action'] = 'add';               
        $data['banks'] = $this->Allbranchs_model->getAllbanks();   
        $data['states'] = $this->Allbranchs_model->getAllstates(); 
        $data['rbos'] = $this->Common_model->getResult('rbo');
        $this->template->load_view('Allbranchs_add',$data);   
   
      }
        public function editBranch($id="") {      
          // if($this->session->userdata('user_role') != '1'){
          //   redirect(base_url().'Dashboard'); 
          //   }        
        $breadcrumbarray = array('label'=> "Allbranchs",
                           'link' => base_url()."Allbranchs"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Edit Bransh Data"); 
        $data['banchdata'] = $this->Allbranchs_model->getBranchDetails($id);   
        $data['banks'] = $this->Allbranchs_model->getAllbanks();  
        $data['states'] = $this->Allbranchs_model->getAllstates();
        $data['rbos'] = $this->Common_model->getResult('rbo');
        $data['action'] = 'edit';    
        $this->template->load_view('Allbranchs_add',$data);        

    }
        
   public function insertAllbranchs() {

    if($_POST) {
        
        $bank_id  = $this->input->post('bank_id');        
        $branch_name  = $this->input->post('branch_name');
        $branch_code = $this->input->post('branch_code');
        $state_id  = $this->input->post('state_id');        
        $bank_person1_name  = $this->input->post('bank_person1_name'); 
        $bank_person1_designation  = $this->input->post('bank_person1_designation'); 
        $bank_person1_phone  = $this->input->post('bank_person1_phone'); 
        $bank_person1_mail  = $this->input->post('bank_person1_mail'); 
        $home_branch_name = $this->input->post('home_branch_name') ? $this->input->post('home_branch_name'): '';
        $home_branch_code = $this->input->post('home_branch_code') ? $this->input->post('home_branch_code'): '';
        $rbo_id = $this->input->post('rbo_id') ? $this->input->post('rbo_id') :0;
        $branch_address = $this->input->post('branch_address') ? $this->input->post('branch_address'): '';
        
        
        //$gst_no  = $this->input->post('gst_no');
        $action  = $this->input->post('action');
        
        $bank_person_name  = $this->input->post('bank_person_name'); 
        $bank_person_designation  = $this->input->post('bank_person_designation'); 
        $bank_person_phone  = $this->input->post('bank_person_phone'); 
        $bank_person_mail  = $this->input->post('bank_person_mail'); 
        $notes  = $this->input->post('notes'); 
        
        if($action == "add") {            
            $inserData = array(
                            'bank_id' => $bank_id,
                            'branch_name' => $branch_name,
                            'state_id' => $state_id, 
                            'branch_code' => $branch_code,
                            'bank_person_name' => $bank_person_name,
                            'bank_person_designation' => $bank_person_designation,
                            'bank_person_phone' => $bank_person_phone,
                            'bank_person_mail' => $bank_person_mail,
			                'bank_person2_name' => $bank_person1_name,
                            'bank_person2_designation' => $bank_person1_designation,
                            'bank_person2_phone' => $bank_person1_phone,
                            'bank_person2_mail' => $bank_person1_mail,
                            'home_branch_name' => $home_branch_name,
                            'home_branch_code' => $home_branch_code,
                            'rbo_id' => $rbo_id,
                            'branch_address' => $branch_address,
                            'notes' => $notes,
                           // 'inserted_by' => $this->session->userdata('adminuser_id'),
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
        
             $res = $this->Common_model->insertSingle('allbranchs', $inserData);
        } else {
            $branch_id = $this->input->post('branch_id');
              $updateData['bank_id'] = $bank_id;
              $updateData['branch_name'] = $branch_name;
              $updateData['branch_code'] = $branch_code;
              $updateData['bank_person_name'] = $bank_person_name;
              $updateData['bank_person_designation'] = $bank_person_designation;
              $updateData['bank_person_phone'] = $bank_person_phone;
              $updateData['bank_person_mail'] = $bank_person_mail;
	      $updateData['bank_person2_name'] = $bank_person1_name;
              $updateData['bank_person2_designation'] = $bank_person1_designation;
              $updateData['bank_person2_phone'] = $bank_person1_phone;
              $updateData['bank_person2_mail'] = $bank_person1_mail;
              $updateData['home_branch_name'] = $home_branch_name;
              $updateData['home_branch_code'] = $home_branch_code;
              $updateData['rbo_id'] = $rbo_id;
              $updateData['notes'] = $notes;
              $updateData['branch_address'] = $branch_address;
              $updateData['state_id'] = $state_id;
             // $updateData['gst_no'] = $gst_no;
            $id = $branch_id;
             $param = array('branch_id'=>$branch_id);
             $affectedRows = $this->Common_model->updateRow('allbranchs',$updateData,$param);
        }
        
         $red=base_url()."Allbranchs";
          redirect($red);
    }
  }
    public function delete(){       
        if($this->session->userdata('user_role') != '1'){
                redirect(base_url().'Dashboard'); 
        }              
         $branch_id = $this->input->post('branch_id');
         $param = array('branch_id'=>$branch_id);
         $this->Common_model->deleteRow('allbranchs',$param);        
    }
    public function checkBranch(){
        if($_POST){
            $brachCode = $this->input->post('branchCode');
            $branchData = $this->Common_model->getSingleRow('allbranchs',array('branch_code'=>$brachCode));
            
            if(!empty($branchData)){
                echo "exist";
            }else{
                echo "notexist";
            }
        }
    }
    

}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
