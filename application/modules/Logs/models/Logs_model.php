<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}	
	public function getAlllogscounts($emp_email =''){
		$sql = "SELECT * FROM `emp_logs`";	
		if($emp_email !=''){
			$sql .= " INNER JOIN sg_users ON sg_users.emp_id = emp_logs.emp_id";
			$sql .= " WHERE sg_users.user_email = '$emp_email' ";
		}
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}	
	}
	public function getAllLogs($limit, $start, $emp_email =''){
		$sql = "SELECT * FROM `emp_logs`";
		if($emp_email !=''){
			$sql .= " INNER JOIN sg_users ON sg_users.emp_id = emp_logs.emp_id";
			$sql .= " WHERE sg_users.user_email = '$emp_email' ";
		}else {
			$sql .= " WHERE log_id !=''";
		}	
		$sql .= " ORDER BY log_id DESC LIMIT $start, $limit";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function get_bank_details(){
		$sql = "SELECT * FROM `banks`";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function get_state_details(){
		$sql = "SELECT * FROM `states`";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getMaxID(){
		$sql = "select MAX(empanelment_id) as maxid from empanelments";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}

	}
	
	public function getempanelmentdata($empanelment_id){
		$sql = "select * from empanelments WHERE empanelment_id='$empanelment_id'";		                                
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