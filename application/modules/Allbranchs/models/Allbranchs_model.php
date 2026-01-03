<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Allbranchs_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}	
	
	public function getAllbranchs($admin_id=""){
		$sql = "SELECT allbranchs.branch_name,allbranchs.branch_code,allbranchs.branch_id,allbanks.bank_name,states.state_name,allbranchs.bank_person_name,allbranchs.bank_person_designation,allbranchs.bank_person2_name,allbranchs.bank_person2_designation,
		allbranchs.bank_person2_phone, allbranchs.bank_person2_mail,
		allbranchs.bank_person_phone, allbranchs.bank_person_mail,allbranchs.notes FROM `allbranchs`
				INNER JOIN allbanks ON allbanks.bank_id = allbranchs.bank_id
				INNER JOIN states ON states.state_id = allbranchs.state_id";
		if(($this->session->userdata('user_role') == '3') || ($this->session->userdata('user_role') == '2')) {
		   $sql .="	INNER JOIN emp_profile ON emp_profile.id = allbranchs.inserted_by";
		}
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
	public function getAllstates(){
		$sql = "SELECT * FROM `states`";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getBranchDetails($id){
		$sql = "SELECT * FROM `allbranchs` WHERE branch_id='$id'";		                               
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