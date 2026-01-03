<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
        public function getReportsFilters($filters=array()){ 
           $loan_type_id =  $filters['loan_type_id'];
           $invoice_type = $filters['invoice_type'];
           $recovery_type = $filters['recovery_type'];
           $bank_id = $filters['bank_id'];
           $branch_id = $filters['branch_id'];
           $employee_id = $filters['employee_id'];
           $start_date = $filters['start_date'];
           $end_date = $filters['end_date'];
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.bill_date,
				    invoice.account,
				    invoice.manual_invoice,
				    invoice.preview_status,
				    invoice.receive_status,
				    invoice.received_invoice_id,
				    invoice.invoice_status,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.recovered_amt) as total,
				    invoice.inserted_by as invoice_inserted_by,
				    invoice.inserted_date as invoice_inserted_date,
				    invoice_receivals.received_date,
				    Loanaccounts.*
				    
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				LEFT JOIN invoice_receivals ON invoice_receivals.invoice_id = invoice.id
				";

		$whereCond = "WHERE invoice_services.invoice_id != 0 AND invoice_status != 'd' AND invoice_status != 'r' AND invoice_status != 'm'";

		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND emp_profile.id ='$empid' AND invoice_status != 'd'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND  (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid') AND invoice_status != 'd'";
		}
		if($whereCond == ""){
		    $whereCond .= " AND invoice_status != 'd'";
		}
		
		if(!empty($loan_type_id)) {
		    $whereCond .= " AND invoice.loan_type_id = $loan_type_id";
		}
		if(!empty($invoice_type)) {
		    $whereCond .= " AND invoice.invoice_type = $invoice_type";
		}
		if(!empty($recovery_type)) {
		    $whereCond .= " AND invoice.recovery_type = '$recovery_type'";
		}
		if(!empty($bank_id)) {
		    $whereCond .= " AND Loanaccounts.bank_id = $bank_id";
		}
		if(!empty($branch_id)) {
		    $whereCond .= " AND Loanaccounts.branch_id = $branch_id";
		}
		if(!empty($start_date) && !empty($end_date)) {
		    $whereCond .= " AND (invoice.bill_date BETWEEN '$start_date' AND '$end_date')";
		}
		if(!empty($employee_id)) {
		    //$ids_array = explode(',', $ids_string);
		    $whereCond .= " AND emp_profile.id IN ($employee_id)";
		}
		

		$sql .= $whereCond." GROUP BY invoice.id  ORDER BY invoice.id DESC ";               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getReportsFiltersEmp($filters=array()){ 
           
           $bank_id = $filters['bank_id'];
           $branch_id = $filters['branch_id'];
           $employee_id = $filters['employee_id'];
           $start_date = $filters['start_date'];
           $end_date = $filters['end_date'];
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.bill_date,
				    invoice.account,
				    invoice.manual_invoice,
				    invoice.preview_status,
				    invoice.receive_status,
				    invoice.received_invoice_id,
				    invoice.invoice_status,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total,
				    SUM(invoice_services.recovered_amt) as recovered_amt,
				    invoice.inserted_by as invoice_inserted_by,
				    invoice.inserted_date as invoice_inserted_date,
				    invoice_receivals.received_date,
				    Loanaccounts.*,
				    contractor_charges.*
				    
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				LEFT JOIN invoice_receivals ON invoice_receivals.invoice_id = invoice.id
				INNER JOIN contractor_charges on contractor_charges.invoice_id = invoice.id
				";

		$whereCond = "WHERE invoice_services.invoice_id != 0 AND invoice_status != 'd' AND invoice_status != 'r' AND invoice_status != 'm'";

		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND emp_profile.id ='$empid' AND invoice_status != 'd'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND  (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid') AND invoice_status != 'd'";
		}
		
		if(!empty($loan_type_id)) {
		    $whereCond .= " AND invoice.loan_type_id = $loan_type_id";
		}
		if(!empty($invoice_type)) {
		    $whereCond .= " AND invoice.invoice_type = $invoice_type";
		}
		if(!empty($recovery_type)) {
		    $whereCond .= " AND invoice.recovery_type = '$recovery_type'";
		}
		if(!empty($bank_id)) {
		    $whereCond .= " AND Loanaccounts.bank_id = $bank_id";
		}
		if(!empty($branch_id)) {
		    $whereCond .= " AND Loanaccounts.branch_id = $branch_id";
		}
		if(!empty($start_date) && !empty($end_date)) {
		    $whereCond .= " AND (invoice.bill_date BETWEEN '$start_date' AND '$end_date')";
		}
		if(!empty($employee_id)) {
		    $whereCond .= " AND emp_profile.id  IN ($employee_id)";
		}
		

		$sql .= $whereCond." GROUP BY invoice.id  ORDER BY invoice.id DESC ";               
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
		public function getReportsNew(){ 
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.bill_date,
				    invoice.account,
				    invoice.manual_invoice,
				    invoice.preview_status,
				    invoice.receive_status,
				    invoice.received_invoice_id,
				    invoice.invoice_status,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total,
				    invoice.inserted_by as invoice_inserted_by,
				    invoice.inserted_date as invoice_inserted_date,
				    invoice_receivals.received_date,
				    Loanaccounts.*
				    
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				LEFT JOIN invoice_receivals ON invoice_receivals.invoice_id = invoice.id
				";

		$whereCond = "";

		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " WHERE emp_profile.id ='$empid' AND invoice_status != 'd'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " WHERE (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid') AND invoice_status != 'd'";
		}
		if($whereCond == ""){
		    $whereCond .= " WHERE invoice_status != 'd'";
		}					                 

		$sql .= $whereCond." GROUP BY invoice.id  ORDER BY invoice.id DESC ";               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getloantypes() {
	    $sql = "SELECT * FROM loantypes";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getAllBanks() {
	    $sql = "SELECT * FROM allbanks";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getEmployeesDetailsByEmployee() {
	    $empid = $this->session->userdata('emp_id'); 
	    $sql = "SELECT * FROM emp_profile ";
	    
	    $whereCond = "WHERE emp_profile.id != 0 ";
	    if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND emp_profile.id ='$empid' ";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}
		if($whereCond == ""){
		    $whereCond .= " ";
		}
		$sql .= $whereCond;
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	
}

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */