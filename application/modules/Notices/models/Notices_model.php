<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notices_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getFirstNoticesCounts(){
		$sql = "SELECT * FROM `loan_1st_notice`";

		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}

	public function getAllFirstNotices($limit, $start){
		$sql = "SELECT `loan_1st_notice`.`id`, `loan_1st_notice`.`loan_id`, `loan_1st_notice`.`bank_id`, `loan_1st_notice`.`branch_id`, `loan_1st_notice`.`branch_address`, `loan_1st_notice`.`barrower_name`, `loan_1st_notice`.`borrower_address`, `loan_1st_notice`.`notice_date`, `loan_1st_notice`.`loan_ac_number`, `loan_1st_notice`.`approved_amount`, `loan_1st_notice`.`approval_date`, `loan_1st_notice`.`irregular_amount`, `loan_1st_notice`.`postal_stamp`, `loan_1st_notice`.`notices`, `loan_1st_notice`.`inserted_by`, `loan_1st_notice`.`inserted_date`, 
		`loan_1st_notice`.`updated_by`, `loan_1st_notice`.`updated_date` ,
		allbranchs.branch_name,
		allbranchs.branch_address,
		allbanks.address,
		allbanks.bank_name
		FROM `loan_1st_notice`
		INNER JOIN allbranchs ON allbranchs.branch_id = loan_1st_notice.branch_id
		INNER JOIN allbanks ON allbanks.bank_id = loan_1st_notice.bank_id";	
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getFirstNoticeById($id=""){
		$sql = "SELECT * FROM `loan_1st_notice` where id='$id'";	
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	
	public function getSecondNoticeById($id=""){
		$sql = "SELECT * FROM `loan_2nd_notice` where id='$id'";	
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	
	public function getThirdNoticeById($id=""){
		$sql = "SELECT * FROM `loan_3rd_notice` where id='$id'";	
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	
	public function getFinalNoticeById($id=""){
		$sql = "SELECT * FROM `loan_final_notice` where id='$id'";	
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	
	public function getSecondNoticesCounts(){
		$sql = "SELECT * FROM `loan_2nd_notice`";

		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}

	public function getAllSecondNotices($limit, $start){
		$sql = "SELECT  `loan_2nd_notice`.`id`,  `loan_2nd_notice`.`loan_id`,  `loan_2nd_notice`.`bank_id`,  `loan_2nd_notice`.`branch_id`,  
		`loan_2nd_notice`.`branch_address`,  `loan_2nd_notice`.`barrower_name`,  `loan_2nd_notice`.`borrower_address`,  `loan_2nd_notice`.`notice_date`, 
		 `loan_2nd_notice`.`loan_ac_number`,  `loan_2nd_notice`.`first_notice_date`,  `loan_2nd_notice`.`npa_date`,  `loan_2nd_notice`.`inserted_by`, 
		  `loan_2nd_notice`.`inserted_date`,  `loan_2nd_notice`.`updated_by`,  `loan_2nd_notice`.`updated_date`,
		allbranchs.branch_name,
		allbranchs.branch_address,
    	allbanks.address,
    	allbanks.bank_name
		FROM `loan_2nd_notice`
		INNER JOIN allbranchs ON allbranchs.branch_id = loan_2nd_notice.branch_id
		INNER JOIN allbanks ON allbanks.bank_id = loan_2nd_notice.bank_id";	
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getThirdNoticesCounts(){
		$sql = "SELECT * FROM `loan_3rd_notice`";

		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}

	public function getAllThirdNotices($limit, $start){
		$sql = "SELECT `loan_3rd_notice`.`id`, `loan_3rd_notice`.`loan_id`, `loan_3rd_notice`.`bank_id`, `loan_3rd_notice`.`branch_id`, `loan_3rd_notice`.`branch_address`, 
		`loan_3rd_notice`.`barrower_name`, `loan_3rd_notice`.`borrower_address`, `loan_3rd_notice`.`notice_date`, `loan_3rd_notice`.`loan_ac_number`, 
		`loan_3rd_notice`.`vehicle_registration_number`, `loan_3rd_notice`.`inserted_by`, `loan_3rd_notice`.`inserted_date`, `loan_3rd_notice`.`updated_by`, 
		`loan_3rd_notice`.`updated_date`, 
		allbranchs.branch_name,
		allbranchs.branch_address,
    	allbanks.address,
    	allbanks.bank_name
		FROM `loan_3rd_notice`
		INNER JOIN allbranchs ON allbranchs.branch_id = loan_3rd_notice.branch_id
		INNER JOIN allbanks ON allbanks.bank_id = loan_3rd_notice.bank_id";	
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getFinalNoticesCounts(){
		$sql = "SELECT * FROM `loan_final_notice`";

		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}
	
	public function getAllFinalNotices($limit, $start){
		$sql = "SELECT `loan_final_notice`.`id`, `loan_final_notice`.`loan_id`, `loan_final_notice`.`bank_id`, `loan_final_notice`.`branch_id`, 
		`loan_final_notice`.`branch_address`, `loan_final_notice`.`barrower_name`, `loan_final_notice`.`borrower_address`, 
		`loan_final_notice`.`notice_date`, `loan_final_notice`.`loan_ac_number`, `loan_final_notice`.`vehicle_registration_number`, `loan_final_notice`.`auction_date`, 
		`loan_final_notice`.`telugu_news_paper`, `loan_final_notice`.`english_news_paper`, `loan_final_notice`.`news_publication_date`, `loan_final_notice`.`postal_stamp`,
		`loan_final_notice`.`notices`, `loan_final_notice`.`inserted_by`, `loan_final_notice`.`inserted_date`, `loan_final_notice`.`updated_by`, `loan_final_notice`.`updated_date`, 
		allbranchs.branch_name,
		allbranchs.branch_address,
    	allbanks.address,
    	allbanks.bank_name
		FROM `loan_final_notice`
		INNER JOIN allbranchs ON allbranchs.branch_id = `loan_final_notice`.branch_id
		INNER JOIN allbanks ON allbanks.bank_id = `loan_final_notice`.bank_id";	
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
}

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */