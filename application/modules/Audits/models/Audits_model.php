<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Audits_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}	
	
	public function getAudits(){
		$sql = "SELECT * FROM `billing_periods`";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}

	
	public function getAuditsDetails($id){
		$sql = "SELECT * FROM `billing_periods` WHERE id='$id'";		                               
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