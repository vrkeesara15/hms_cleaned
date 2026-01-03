<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employees_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}	

	public function getMaxID(){
		$sql = "select MAX(id) as maxid from emp_profile";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	public function getAllEmployees(){
		$sql = "select * from emp_profile 
				INNER JOIN sg_users ON sg_users.emp_id = emp_profile.id
				WHERE emp_profile.id !='1'";
		if($this->session->userdata('user_role') == '2' ){	
			$mid = $this->session->userdata('emp_id');
		$sql .=" AND emp_profile.manager_id='$mid'";	
		}                         
		$sql .= " ORDER BY id DESC ";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
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
	
	public function getEmployeeData($id){
		$sql = "select * from emp_profile
		INNER JOIN sg_users ON sg_users.emp_id = emp_profile.id
		 WHERE emp_profile.id='$id'";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}

	public function changeStatus($data, $id)
	{
		$this->db->where('id', $id);	
		$this->db->update('emp_profile', $data); 
		return $this->db->affected_rows();
	}
	public function changeStatusLogin($data, $id)
	{
		$this->db->where('emp_id', $id);	
		$this->db->update(' sg_users', $data); 

		//echo $this->db->last_query();exit;
		return $this->db->affected_rows();
	}
	public function update($table,$data,$where) 
		{
			return $this->db->update($table, $data, $where);
			
		}
	public function getAllEmployeesCount($limit, $start){
		$sql = "select * from emp_profile 
				INNER JOIN sg_users ON sg_users.emp_id = emp_profile.id
				WHERE emp_profile.id !='1'";
		if($this->session->userdata('user_role') == '2' ){	
			$mid = $this->session->userdata('emp_id');
		$sql .=" AND emp_profile.manager_id='$mid'";	
		}                                
		/*$sql .= " GROUP BY emp_profile.id  ORDER BY emp_profile.id DESC  LIMIT $start, $limit";               */
		$sql .= " GROUP BY emp_profile.id  ORDER BY emp_profile.id DESC ";               

		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function contractPaidAmount($emp_id){
	    $sql = "SELECT SUM(paid_amount) as totalPaidAmount FROM contractor_payment_audit WHERE emp_id='$emp_id'";
	    $query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	    
	}
	
	public function contractorAdvancePaidAmount($emp_id){
	    $sql = "SELECT SUM(requested_amount) as requestedAmount,SUM(paid_amount) as advancePaidAmount FROM advance_requests WHERE emp_id='$emp_id'";
	    $query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	    
	}
	
	public function advanceRequestPayments($emp_id){
	    $sql = "SELECT advance_payment_audit.id,advance_payment_audit.paid_amount,advance_payment_audit.advance_request_id,advance_payment_audit.payment_date,advance_payment_audit.payment_receipt FROM `advance_payment_audit` 
                INNER JOIN advance_requests ON advance_requests.advance_request_id = advance_payment_audit.advance_request_id
                WHERE advance_requests.emp_id='$emp_id'";
        $query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}
	public function settleAdvancePayments($emp_id){
	    $sql = "SELECT
                        *
                    FROM
                        contractor_payment_audit
                    LEFT JOIN contractor_charges ON contractor_charges.contractor_charges_id = contractor_payment_audit.contractor_charges_id 
                    
                    WHERE
                        contractor_payment_audit.emp_id='$emp_id'";
	    $query = $this->db->query($sql);
	    if($query->num_rows()>0){
	        return $query->result();
	    }else{
	        return false;
	    }
	}
	public function getManualDebits($emp_id){
	    $sql = "SELECT * FROM `manual_debits` WHERE emp_id='$emp_id'";
	    $query = $this->db->query($sql);
	    if($query->num_rows()>0){
	        return $query->result();
	    }else{
	        return false;
	    }
	}
}

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */