<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loanaccounts_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getLoanaccountsCounts(){
		$sql = "select allbanks.bank_name,allbranchs.branch_name,Loanaccounts.*, workorders.	work_order_num from Loanaccounts
		        LEFT JOIN workorders ON workorders.order_id = Loanaccounts.order_id
				INNER JOIN allbanks ON allbanks.bank_id = Loanaccounts.bank_id
				INNER JOIN allbranchs ON allbranchs.branch_id = Loanaccounts.branch_id
				INNER JOIN emp_profile ON emp_profile.id = Loanaccounts.emp_id
				";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE (emp_profile.id ='$empid' OR Loanaccounts.re_assign_id = '$empid') ";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid' OR Loanaccounts.re_assign_id = '$empid')";
		}
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}

	public function getAllLoanaccounts($limit, $start, $type = 1){
		$sql = "select allbanks.bank_name,allbranchs.branch_name,Loanaccounts.*, workorders.	work_order_num from Loanaccounts
		        LEFT JOIN workorders ON workorders.order_id = Loanaccounts.order_id
				INNER JOIN allbanks ON allbanks.bank_id = Loanaccounts.bank_id
				INNER JOIN allbranchs ON allbranchs.branch_id = Loanaccounts.branch_id
				INNER JOIN emp_profile ON emp_profile.id = Loanaccounts.emp_id
				";	
		$sql .= " WHERE Loanaccounts.type_id = $type";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND (emp_profile.id ='$empid' OR Loanaccounts.re_assign_id = '$empid')";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid' OR Loanaccounts.re_assign_id = '$empid')";
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
	public function getWorkorders(){
		$sql = "select * From workorders
				INNER JOIN emp_profile ON emp_profile.id = workorders.inserted_by";
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

		//echo $sql;exit;                            
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getWorkOrderDetails($order_id){
		$sql = "SELECT  workorders.*, allbanks.bank_id,allbanks.bank_name,
		        allbranchs.branch_id,allbranchs.branch_name FROM  workorders
				INNER JOIN allbanks ON allbanks.bank_id = workorders.bank_id
				INNER JOIN allbranchs ON allbranchs.branch_id = workorders.branch_id";

		$sql .= " WHERE workorders.order_id = '$order_id' ";
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND workorders.inserted_by ='$empid' ";
		}

		$sql .= " ORDER BY order_id DESC";                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}

	public function getWorkorders1(){
		$sql = "select workorders.*,allbanks.bank_id,allbanks.bank_name,allbranchs.branch_id,allbranchs.branch_name from workorders
				INNER JOIN allbanks ON allbanks.bank_id = workorders.bank_id
				INNER JOIN allbranchs ON allbranchs.branch_id = workorders.branch_id";

		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE workorders.inserted_by ='$empid' ";
		}	
		$sql .= " ORDER BY order_id DESC";                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}

	public function getMaxID(){
		$sql = "select MAX(loan_id) as maxid from Loanaccounts";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}

	}
	public function getRecentNotes($trackingdetails_id){
		$sql = "SELECT * FROM `trackingdetails_notes_details` where trackingdetails_id = $trackingdetails_id  ORDER BY `track_note_id` DESC  LIMIT 1";	
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}

	}
	
	public function getSeizeFormMaxID(){
		$sql = "select MAX(s_id) as maxid from seize_form";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}

	}
	public function getReleaseFormMaxID(){
		$sql = "select MAX(rel_id) as maxid from release_form";	                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}

	}
	public function getAuctionFormMaxID(){
		$sql = "select MAX(auc_id) as maxid from auction_form";	                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}

	}
	
	public function getEmployeeData($id){
		$sql = "select * from emp_profile WHERE id='$id'";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}

	public function getLoanDetails($loan_id){
		$sql = "SELECT 
					Loanaccounts.*,
				    allbanks.bank_name,
				    allbanks.bank_id,
				    allbranchs.branch_name,
				    allbranchs.branch_id,
				    regularize_form.r_id,
                    seize_form.s_id,
                    release_form.rel_id,
                    auction_form.auc_id,                   
                    workorders.work_order_num,
                    workorders.order_id
				FROM
					`Loanaccounts`
				LEFT JOIN workorders ON workorders.order_id = Loanaccounts.order_id
				INNER JOIN allbanks ON allbanks.bank_id = Loanaccounts.bank_id
				INNER JOIN allbranchs ON allbranchs.branch_id = Loanaccounts.branch_id AND allbranchs.bank_id = allbanks.bank_id
				LEFT JOIN regularize_form ON regularize_form.loan_id = Loanaccounts.loan_id
				LEFT JOIN seize_form ON seize_form.loan_id = Loanaccounts.loan_id
				LEFT JOIN release_form ON seize_form.s_id = release_form.s_id
				LEFT JOIN auction_form ON seize_form.s_id = auction_form.s_id
				WHERE
					Loanaccounts.loan_id = $loan_id";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	
	public function getBankBranches($bank_id){
		$sql = "SELECT * FROM allbanks
				INNER JOIN allbranchs ON allbranchs.bank_id = allbanks.bank_id
				INNER JOIN gsts ON gsts.bank_id = allbanks.bank_id AND gsts.state_id = allbranchs.state_id";
		if(($this->session->userdata('user_role') == '3') || ($this->session->userdata('user_role') == '2')) {
		   $sql .="	INNER JOIN emp_profile ON emp_profile.id = allbranchs.inserted_by";
		}
				$sql .= " WHERE allbranchs.bank_id='$bank_id'";
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
			return $query->result();
		}else{
			return false;
		}
	}
	public function update($table,$data,$where) 
		{
			return $this->db->update($table, $data, $where);
			
		}
		public function getAdminusers(){
		$sql = "select * from emp_profile 
				INNER JOIN sg_users ON sg_users.emp_id = emp_profile.id
				WHERE (sg_users.user_role ='2' OR sg_users.user_role='1')";                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getAllRBO() {
		$sql = "select * from rbo";		                                
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