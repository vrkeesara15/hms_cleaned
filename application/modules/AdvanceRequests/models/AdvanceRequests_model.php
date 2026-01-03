<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advancerequests_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getAdvanceRequestsCounts(){
		$sql = "SELECT 
					advance_requests.emp_id, 
				    advance_requests.requested_amount, 
				    advance_requests.paid_amount, 
				    advance_requests.requested_amount,
				    advance_requests.requested_date,
				    advance_requests.paid_status
				FROM 
					advance_requests 
				    ";
				    
	    $emp_id = $this->session->userdata('emp_id');
	    $user_role = $this->session->userdata('user_role');
	    if($user_role != 1){
	        $sql .= " WHERE emp_id = '$emp_id' ";
	    }
		
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}
	public function getAllAdvanceRequests($limit, $start) {
		$sql = "SELECT 
					advance_requests.advance_request_id,
					advance_requests.emp_id, 
				    advance_requests.paid_amount, 
				    advance_requests.requested_amount,
				    advance_requests.requested_date,
				    advance_requests.payment_date,
				    advance_requests.paid_status,
				    advance_requests.requested_purpose
				FROM 
					advance_requests  ";
		$emp_id = $this->session->userdata('emp_id');
	    $user_role = $this->session->userdata('user_role');
	    if($user_role != 1){
	        $sql .= " WHERE emp_id = '$emp_id' ";
	    }
		$sql .= "	ORDER BY advance_requests.advance_request_id DESC LIMIT $start, $limit";	                               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getPaidTotalAdvance($advance_request_id){
	    $sql = "SELECT advance_request_id,SUM(paid_amount) as paid_amount,COUNT(id) as paid_count FROM `advance_payment_audit` WHERE advance_request_id='$advance_request_id'";
	    $query = $this->db->query($sql);
	    if($query->num_rows()>0){
	        return $query->row();
	    }else{
	        return false;
	    }
	}
	public function getAllAdvanceRequestsByEmpoyee($limit, $start,$empoyee_id) {
		$sql = "SELECT 
					advance_requests.advance_request_id,
					advance_requests.emp_id, 
				    advance_requests.paid_amount, 
				    advance_requests.requested_amount,
				    advance_requests.requested_date,
				    advance_requests.payment_date,
				    advance_requests.paid_status,
				    advance_requests.requested_purpose
				FROM 
					advance_requests  ";
		$emp_id = $this->session->userdata('emp_id');
	    $user_role = $this->session->userdata('user_role');
	    if($user_role != 1 || $empoyee_id != 0 ){
	        $sql .= " WHERE emp_id = '$empoyee_id' ";
	    }
		$sql .= "	ORDER BY advance_requests.advance_request_id DESC LIMIT $start, $limit";	                               
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