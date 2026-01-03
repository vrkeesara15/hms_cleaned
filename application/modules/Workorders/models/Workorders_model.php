<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workorders_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getWorkordersCounts(){
		$sql = "select allbanks.bank_name,allbranchs.branch_name,workorders.* from workorders
				INNER JOIN allbanks ON allbanks.bank_id = workorders.bank_id
				INNER JOIN allbranchs ON allbranchs.branch_id = workorders.branch_id
				INNER JOIN emp_profile ON emp_profile.id = workorders.inserted_by
				";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}

	public function getAllWorkorders($limit, $start){
		$sql = "select allbanks.bank_name,allbranchs.branch_name,workorders.* from workorders
				INNER JOIN allbanks ON allbanks.bank_id = workorders.bank_id
				INNER JOIN allbranchs ON allbranchs.branch_id = workorders.branch_id
				INNER JOIN emp_profile ON emp_profile.id = workorders.inserted_by";	
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}
		$sql .= " ORDER BY workorders.order_id DESC  LIMIT $start, $limit";                                
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
	
	public function getBranchs($id){
		$sql = "SELECT * FROM `allbranchs` WHERE bank_id='$id'";	                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getMaxID(){
		$sql = "select MAX(order_id) as maxid from workorders";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}

	}

	public function getOrderDetails($order_id){
		$sql = "SELECT *
				FROM
					`workorders`
				INNER JOIN allbanks ON allbanks.bank_id = workorders.bank_id
				INNER JOIN allbranchs ON allbranchs.branch_id = workorders.branch_id AND allbranchs.bank_id = allbanks.bank_id			
				WHERE
					workorders.order_id = $order_id";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	public function getAllWorkorders1()
	{
		$sql = "SELECT * FROM `workorders`";	                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
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