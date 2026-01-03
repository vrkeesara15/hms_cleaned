<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loans_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getLoansCounts($type_id){
		$sql = "select allbanks.bank_name,allbranchs.branch_name,Loanaccounts.* from Loanaccounts
		        INNER JOIN allbanks ON allbanks.bank_id = Loanaccounts.bank_id
				INNER JOIN allbranchs ON allbranchs.branch_id = Loanaccounts.branch_id
				INNER JOIN emp_profile ON emp_profile.id = Loanaccounts.emp_id
				WHERE Loanaccounts.type_id = '$type_id'
				";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}	
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}

	public function getAllLoans($type_id,$limit, $start){
		$sql = "select allbanks.bank_name,allbranchs.branch_name,Loanaccounts.* from Loanaccounts		      
				INNER JOIN allbanks ON allbanks.bank_id = Loanaccounts.bank_id
				INNER JOIN allbranchs ON allbranchs.branch_id = Loanaccounts.branch_id
				INNER JOIN emp_profile ON emp_profile.id = Loanaccounts.emp_id
				WHERE Loanaccounts.type_id = '$type_id'
				";	
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}	
		$sql .= " ORDER BY Loanaccounts.loan_id DESC  LIMIT $start, $limit";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getAllbanks(){
		$sql = "SELECT * FROM `allbanks`";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getAllEmployees(){
		$sql = "SELECT * FROM `emp_profile`";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getBranchs($id){
		$sql = "SELECT * FROM `allbranchs` WHERE bank_id='$id'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}

	public function getWorkorders1(){
		$sql = "select workorders.*,allbanks.bank_id,allbanks.bank_name,allbranchs.branch_id,allbranchs.branch_name from workorders
				INNER JOIN allbanks ON allbanks.bank_id = workorders.bank_id
				INNER JOIN emp_profile ON emp_profile.id = workorders.inserted_by
				INNER JOIN allbranchs ON allbranchs.branch_id = workorders.branch_id";

		// if($this->session->userdata('user_role') == '2'){
		// 	$empid = $this->session->userdata('emp_id');
		// 	$sql .= " WHERE workorders.inserted_by ='$empid' ";
		// }	

		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}

		$sql .= " ORDER BY order_id DESC";                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getLoanDetails($loan_id){
		$sql = "SELECT 
					*				  
				FROM
					`Loanaccounts`				
				WHERE
					Loanaccounts.loan_id = $loan_id";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}

	
	
	
	
	}
	

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */