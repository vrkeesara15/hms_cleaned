<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bankcharges_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}	
	
	public function getBankcharges(){
		$sql = "SELECT * FROM `bank_charges`
				INNER JOIN allbanks ON allbanks.bank_id = bank_charges.bank_id";
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
	
	
	public function getBankChargesDetails($id){
		$sql = "SELECT * FROM `bank_charges` WHERE charge_id='$id'";		                               
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