<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empanelments_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}	
	public function getEmpanelments(){
		$sql = "SELECT * FROM `empanelments`
				INNER JOIN allbanks ON allbanks.bank_id = empanelments.bank_id
				INNER JOIN states ON states.state_id = empanelments.state_id
				ORDER BY
				empanelment_id DESC
				";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function get_bank_details(){
		$sql = "SELECT * FROM `allbanks`";		                                
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