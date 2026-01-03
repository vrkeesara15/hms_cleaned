<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Project : Admin Panel
 * Version v1.0
 * Controller : LineTypes 
 *  
 */
class LineTypes extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('LineTypes_model');
        $this->load->language('LineTypes');
        $this->load->library('pagination');
        $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "LineTypes",
                           'link' => base_url()."LineTypes"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage LineTypes"); 
        $data['details']  = $this->LineTypes_model->getLineTypes();
        $this->template->load_view('LineType',$data);        
    }
    public function addLineTypes() {      

        //  if($this->session->userdata('user_role') != '1'){
        //     redirect(base_url().'Dashboard'); 
        // }
        
        $breadcrumbarray = array('label'=> "LineTypes",
                           'link' => base_url()."LineTypes"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage LineTypes");
        $data['action'] = 'add';       
        $data['loanTypes'] = $this->Common_model->get_result('loantypes',array(),array('status'=>'1'));
        $this->template->load_view('LineType_add',$data);   
      }
        public function editLinetype($id="") {      
          // if($this->session->userdata('user_role') != '1'){
          //   redirect(base_url().'Dashboard'); 
          //   }        
        $breadcrumbarray = array('label'=> "LineTypes",
                           'link' => base_url()."LineTypes"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Edit Bransh Data"); 
        $data['lineTypeData'] = $this->LineTypes_model->getLineTypeDetails($id);
        $data['loanTypes'] = $this->Common_model->get_result('loantypes',array(),array('status'=>'1'));
        $data['action'] = 'edit';    
        $this->template->load_view('LineType_add',$data);        

    }
    public function checkDupliate(){
      if($_POST) {
               
       $action  = $this->input->post('action'); 
       $invoice_type  = $this->input->post('invoice_type');        
       $line_type  = $this->input->post('line_type');        
       $linetype_id  = $this->input->post('linetype_id'); 

       $res = $this->LineTypes_model->checkDupliate($line_type,$invoice_type,$action, $linetype_id);

        header('Content-type: application/json');
        die( json_encode( $res ) );  

       // if($res){
       //  return $res;
       // }else {
       //  return false;
       // }


      }      
    }
        
   public function insertLineTypes() {
        if($_POST) {
        
        $loan_type_id  = $this->input->post('loan_type_id');        
        $invoice_type  = $this->input->post('invoice_type');        
        $line_type  = $this->input->post('line_type');        
        $action  = $this->input->post('action');
        
        if($action == "add") {            
            $inserData = array(
                            'loan_type_id' => $loan_type_id,
                            'invoice_type' => $invoice_type,
                            'linetype_name' => $line_type,
                            'inserted_by' => $this->session->userdata('adminuser_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
        
             $res = $this->Common_model->insertSingle('linetypes', $inserData);
        } else {
              $linetype_id = $this->input->post('linetype_id');
              $updateData['loan_type_id'] = $loan_type_id;
              $updateData['invoice_type'] = $invoice_type;
              $updateData['linetype_name'] = $line_type;
              $updateData['updated_by'] = $this->session->userdata('adminuser_id');
              $updateData['updated_date'] = date('Y-m-d H:i:s');
            $id = $linetype_id;
             $param = array('linetype_id'=>$id);
             $affectedRows = $this->Common_model->updateRow('linetypes',$updateData,$param);
        }
        
         $red=base_url()."LineTypes";
          redirect($red);
    }
  }
    public function delete(){       
        if($this->session->userdata('user_role') != '1'){
                redirect(base_url().'Dashboard'); 
        }              
         $linetype_id = $this->input->post('linetype_id');
         $param = array('linetype_id'=>$linetype_id);
         $this->Common_model->deleteRow('linetypes',$param);        
    } 

}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
