<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Rajendar
 * Email : rajenderdaddanala@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Reports  
 *  
 */
class Reports extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Reports_model');
        $this->load->language('Reports');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Reports",
                           'link' => base_url()."Reports"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Reports"); 
        $data["details"] = $this->Reports_model->getReportsNew();
        $data["loantypes"] = $this->Reports_model->getloantypes();
        $data["allBanks"] = $this->Reports_model->getAllBanks();
         $data['emp_details'] =  $this->Reports_model->getEmployeesDetailsByEmployee();
         $data['display'] = "No";
        $this->template->load_view('Reports', $data);
    }
    public function empreport() {      
        $breadcrumbarray = array('label'=> "Reports",
                           'link' => base_url()."Reports"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Reports"); 
        $data["details"] = $this->Reports_model->getReportsNew();
        $data["loantypes"] = $this->Reports_model->getloantypes();
        $data["allBanks"] = $this->Reports_model->getAllBanks();
         $data['emp_details'] =  $this->Reports_model->getEmployeesDetailsByEmployee();
         $data['display'] = "No";
        $this->template->load_view('Report_emp', $data);
    }
    public function searchFilters(){
        if($this->input->post()) {
        $breadcrumbarray = array('label'=> "Reports",
                           'link' => base_url()."Reports"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Reports"); 
        $loan_type_id = ($this->input->post('loan_type_id')?$this->input->post('loan_type_id'):'');
        $invoice_type = ($this->input->post('invoice_type')?$this->input->post('invoice_type'):'');
        $recovery_type = ($this->input->post('recovery_type')?$this->input->post('recovery_type'):'');
        $bank_id = ($this->input->post('bank_id')?$this->input->post('bank_id'):'');
        $branch_id = ($this->input->post('branch_id')?$this->input->post('branch_id'):'');
        $start_date = ($this->input->post('start_date')?$this->input->post('start_date'):'');
        $end_date = ($this->input->post('end_date')?$this->input->post('end_date'):'');
        $employee_id = ($this->input->post('employee_id')?$this->input->post('employee_id'):'');
        if(!empty($employee_id)) {
            $employee_id = implode(',', $employee_id);
        }
        
        
       
        $filters = array();
        $data['loan_type_id'] =  $filters['loan_type_id'] = $loan_type_id;
        $data['invoice_type'] =  $filters['invoice_type'] = $invoice_type;
        $data['recovery_type'] =  $filters['recovery_type'] = $recovery_type;
        $data['bank_id'] =  $filters['bank_id'] = $bank_id;
        $data['branch_id'] =  $filters['branch_id'] = $branch_id;
        $data['start_date'] =  $filters['start_date'] = $start_date;
        $data['end_date'] =  $filters['end_date'] = $end_date;
        $data['employee_id'] =  $filters['employee_id'] = $employee_id;
        
        
        $data["details"] = $this->Reports_model->getReportsFilters($filters);
        $data["loantypes"] = $this->Reports_model->getloantypes();
        $data["allBanks"] = $this->Reports_model->getAllBanks();
        $data['emp_details'] =  $this->Reports_model->getEmployeesDetailsByEmployee();
        $data['display'] = "Yes";
        $this->template->load_view('Reports', $data);
        }
    }
    
    public function searchFiltersEmp(){
        if($this->input->post()) {
        $breadcrumbarray = array('label'=> "Reports",
                           'link' => base_url()."Reports"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Reports"); 
        $bank_id = ($this->input->post('bank_id')?$this->input->post('bank_id'):'');
        $branch_id = ($this->input->post('branch_id')?$this->input->post('branch_id'):'');
        $start_date = ($this->input->post('start_date')?$this->input->post('start_date'):'');
        $end_date = ($this->input->post('end_date')?$this->input->post('end_date'):'');
        $employee_id = ($this->input->post('employee_id')?$this->input->post('employee_id'):'');
        
        if(!empty($employee_id)) {
            $employee_id = implode(',', $employee_id);
        }
        $filters = array();
        $data['bank_id'] =  $filters['bank_id'] = $bank_id;
        $data['branch_id'] =  $filters['branch_id'] = $branch_id;
        $data['start_date'] =  $filters['start_date'] = $start_date;
        $data['end_date'] =  $filters['end_date'] = $end_date;
        $data['employee_id'] =  $filters['employee_id'] = $employee_id;
        
        
        $data["details"] = $this->Reports_model->getReportsFiltersEmp($filters);
        
        $data["allBanks"] = $this->Reports_model->getAllBanks();
        $data['emp_details'] =  $this->Reports_model->getEmployeesDetailsByEmployee();
        $data['display'] = "Yes";
        $this->template->load_view('Report_emp', $data);
        }
    }
   
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
