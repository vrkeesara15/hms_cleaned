<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Project : Admin Panel
 * Version v1.0
 * Controller : Expensetypes 
 *  
 */
class Expensetypes extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Expensetypes_model');
        $this->load->model('Common_model');
        $this->load->language('Expensetypes');
        $this->load->library('pagination');
        $this->load->helper('phpass');   
    }    
    public function index() {
        
        
        
        $breadcrumbarray = array('label'=> "Expensetypes",
                           'link' => base_url()."Expensetypes"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Expensetypes");  
        $data["Expensetypes"] = $this->Expensetypes_model->getAllExpensetypes();
        
        $data['page'] = $page;
        
        $this->template->load_view('expenseTypes', $data);
    }
    public function addExpense($id = ""){
        $breadcrumbarray = array('label'=> "Expensetypes",
                           'link' => base_url()."Expensetypes"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Expensetypes");  


        $data["expenseTypes"] = $this->Expensetypes_model->getAllExpensetypes();
        if($_POST){
        	$action = $this->input->post('action');

            
            $insertData['expense_type'] = $this->input->post('expense_type');
            if($action == 'add'){
            	$insertData['created_by'] = $this->session->userdata('emp_id');
	            $insertData['created_date'] = date('Y-m-d H:i:s');
	            $insertData['updated_by'] = $this->session->userdata('emp_id');
	            $insertData['updated_date'] = date('Y-m-d H:i:s');
	            $res = $this->Common_model->insertSingle('expenses_types', $insertData);
            }else{
            	$insertData['updated_by'] = $this->session->userdata('emp_id');
	            $insertData['updated_date'] = date('Y-m-d H:i:s');	
	            $expId = $this->input->post('expensetype_id');
	            $param = array('id' => $expId);
	            $res = $this->Common_model->updateRow('expenses_types',$insertData,$param);
            }
            
            
            if($res){
            	redirect(base_url().'Expensetypes');	
            }else{
            	echo "insertion failed";
            }
            
        }else{
        	if($id != ""){
        		$data['action'] = 'edit';	

        		$data['expenseTypeData'] = $this->Expensetypes_model->getExpenseType($id);
        	}else{
        		$data['action'] = 'add';
        	}
        	
         	$this->template->load_view('expenseType_add', $data);   
        }
    }

}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
