<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Allbanks_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
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
	public function getBankCharges($bank_id=''){
		$sql = "SELECT * FROM `bank_charges` WHERE bank_id ='$bank_id'";		
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}	
	}
	public function get_bank_details($id){
		$sql = "SELECT * FROM `allbanks` WHERE bank_id='$id'";		                                
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