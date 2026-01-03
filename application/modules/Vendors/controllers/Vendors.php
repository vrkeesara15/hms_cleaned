<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : ch.v.sudhakar9@gmail.com, phpguidance@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Vendors 
 *  
 */
class Vendors extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Vendors_model');
        $this->load->language('Vendors');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Vendors",
                           'link' => base_url()."Vendors"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Vendors"); 
        $data['details']  = $this->Vendors_model->getVendors();
        $this->template->load_view('Vendors',$data);        

    }
    public function addVendors() {      

        //  if($this->session->userdata('user_role') != '1'){
        //     redirect(base_url().'Dashboard'); 
        // }
        
        $breadcrumbarray = array('label'=> "Vendors",
                           'link' => base_url()."Vendors"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Vendors");
        $data['action'] = 'add';               
        $data['banks'] = $this->Vendors_model->getAllbanks();   
        $data['states'] = $this->Vendors_model->getAllstates(); 
        $this->template->load_view('Vendors_add',$data);   
   
      }
        public function editVendor($id="") {      
          // if($this->session->userdata('user_role') != '1'){
          //   redirect(base_url().'Dashboard'); 
          //   }        
        $breadcrumbarray = array('label'=> "Vendors",
                           'link' => base_url()."Vendors"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Edit Vendors Data"); 
        $data['vendorsData'] = $this->Vendors_model->getGstDetails($id);   
        $data['banks'] = $this->Vendors_model->getAllbanks();  
        $data['states'] = $this->Vendors_model->getAllstates();
        $data['action'] = 'edit';    
        $this->template->load_view('Vendors_add',$data);        

    }
    public function checkDupliate(){
      if($_POST) {
       $bank_id  = $this->input->post('bank_id');        
       $state_id  = $this->input->post('state_id');        
       $action  = $this->input->post('action'); 
       $vendor_id  = $this->input->post('vendor_id'); 

       $res = $this->Vendors_model->checkDupliate($bank_id,$state_id,$action, $vendor_id);

        header('Content-type: application/json');
        die( json_encode( $res ) );  

       // if($res){
       //  return $res;
       // }else {
       //  return false;
       // }


      }      
    }
        
   public function insertVendors() {

    if($_POST) {
        
        $bank_id  = $this->input->post('bank_id');        
        $state_id  = $this->input->post('state_id');        
        $vendor_no  = $this->input->post('vendor_no');
        $notes = $this->input->post('notes');
        $action  = $this->input->post('action');
        
        if($action == "add") {            
            $inserData = array(
                            'bank_id' => $bank_id,
                            'state_id' => $state_id,
                            'vendor_no' => $vendor_no,
                            'notes' => $notes,
                            'inserted_by' => $this->session->userdata('adminuser_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
        
             $res = $this->Common_model->insertSingle('vendors', $inserData);
        } else {
              $vendor_id = $this->input->post('vendor_id');
              $updateData['bank_id'] = $bank_id;
              $updateData['state_id'] = $state_id;
              $updateData['vendor_no'] = $vendor_no;
              $updateData['notes'] = $notes;
              $updateData['updated_by'] = $this->session->userdata('adminuser_id');
              $updateData['updated_date'] = date('Y-m-d H:i:s');
            $id = $vendor_id;
             $param = array('vendor_id'=>$vendor_id);
             $affectedRows = $this->Common_model->updateRow('vendors',$updateData,$param);
        }
        
         $red=base_url()."Vendors";
          redirect($red);
    }
  }
    public function delete(){       
        if($this->session->userdata('user_role') != '1'){
                redirect(base_url().'Dashboard'); 
        }              
         $vendor_id = $this->input->post('vendor_id');
         $param = array('vendor_id'=>$vendor_id);
         $this->Common_model->deleteRow('vendors',$param);        
    } 

}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
