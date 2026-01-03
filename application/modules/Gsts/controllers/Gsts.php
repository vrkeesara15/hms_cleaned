<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : ch.v.sudhakar9@gmail.com, phpguidance@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Gsts 
 *  
 */
class Gsts extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Gsts_model');
        $this->load->language('Gsts');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Gsts",
                           'link' => base_url()."Gsts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Gsts"); 
        $data['details']  = $this->Gsts_model->getGsts();
        $this->template->load_view('Gsts',$data);        

    }
    public function addGsts() {      

        //  if($this->session->userdata('user_role') != '1'){
        //     redirect(base_url().'Dashboard'); 
        // }
        
        $breadcrumbarray = array('label'=> "Gsts",
                           'link' => base_url()."Gsts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Gsts");
        $data['action'] = 'add';               
        $data['banks'] = $this->Gsts_model->getAllbanks();   
        $data['states'] = $this->Gsts_model->getAllstates(); 
        $data['branchs'] = $this->Gsts_model->getAllbranchs(); 
        $this->template->load_view('Gsts_add',$data);   
   
      }
        public function editGst($id="") {      
          // if($this->session->userdata('user_role') != '1'){
          //   redirect(base_url().'Dashboard'); 
          //   }        
        $breadcrumbarray = array('label'=> "Gsts",
                           'link' => base_url()."Gsts"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Edit Bransh Data"); 
        $gstData = $this->Gsts_model->getGstDetails($id);  
        $data['gstData'] = $this->Gsts_model->getGstDetails($id);   
        $data['banks'] = $this->Gsts_model->getAllbanks();  
        $data['states'] = $this->Gsts_model->getAllstates();
        $data['branchs'] = $this->Gsts_model->getBankBranches($gstData->bank_id,$gstData->state_id);
        $data['action'] = 'edit';    
        $this->template->load_view('Gsts_add',$data);        

    }
    public function checkDupliate(){
      if($_POST) {
       $bank_id  = $this->input->post('bank_id');        
       $state_id  = $this->input->post('state_id');        
       $action  = $this->input->post('action'); 
       $gst_id  = $this->input->post('gst_id'); 
       $branch_id  = $this->input->post('branch_id'); 

       $res = $this->Gsts_model->checkDupliate($bank_id,$state_id,$action, $gst_id,$branch_id);

        header('Content-type: application/json');
        die( json_encode( $res ) );  

       // if($res){
       //  return $res;
       // }else {
       //  return false;
       // }


      }      
    }
        
   public function insertGsts() {

    if($_POST) {
        
        $bank_id  = $this->input->post('bank_id');        
        $state_id  = $this->input->post('state_id');        
        $gst_no  = $this->input->post('gst_no');
        $branch_id  = $this->input->post('branch_id');
        $notes  = $this->input->post('notes');
        $action  = $this->input->post('action');
        
        if($action == "add") {            
            $inserData = array(
                            'bank_id' => $bank_id,
                            'state_id' => $state_id,
                            'gst_no' => $gst_no,
                            'notes' => $notes,
                            'inserted_by' => $this->session->userdata('adminuser_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
        
             $res = $this->Common_model->insertSingle('gsts', $inserData);
        } else {
              $gst_id = $this->input->post('gst_id');
              $updateData['bank_id'] = $bank_id;
              $updateData['state_id'] = $state_id;
              $updateData['notes'] = $notes;
              // $updateData['branch_id'] = $branch_id;
              $updateData['gst_no'] = $gst_no;
              $updateData['updated_by'] = $this->session->userdata('adminuser_id');
              $updateData['updated_date'] = date('Y-m-d H:i:s');
            $id = $gst_id;
             $param = array('gst_id'=>$gst_id);
             $affectedRows = $this->Common_model->updateRow('gsts',$updateData,$param);
        }
        
         $red=base_url()."Gsts";
          redirect($red);
    }
  }
    public function delete(){       
        if($this->session->userdata('user_role') != '1'){
                redirect(base_url().'Dashboard'); 
        }              
         $gst_id = $this->input->post('gst_id');
         $param = array('gst_id'=>$gst_id);
         $this->Common_model->deleteRow('Gsts',$param);        
    } 
    public function getBranchas(){
      $bank_id =(($this->input->post('bank_id'))?$this->input->post('bank_id'):0);
      $state_id =(($this->input->post('state_id'))?$this->input->post('state_id'):0);
      $branchs =  $this->Gsts_model->getBankBranches($bank_id,$state_id);
      
      header('Content-type: application/json');
      die( json_encode( $branchs ) );  
    }
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
