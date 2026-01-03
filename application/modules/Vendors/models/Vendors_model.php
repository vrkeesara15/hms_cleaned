<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendors_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}	
	
	public function getvendors(){
		$sql = "SELECT vendors.*,allbanks.bank_id,allbanks.bank_name,states.state_id,states.state_name FROM `vendors`
				INNER JOIN allbanks ON allbanks.bank_id = vendors.bank_id
				INNER JOIN states ON states.state_id = vendors.state_id";
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
	public function getGstDetails($id){
		$sql = "SELECT * FROM `vendors` WHERE vendor_id='$id'";		                               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
		return $query->row();
		}else {
		return false;
		}
	}
	public function checkDupliate($bank_id, $state_id, $action, $id){
		if($action == 'add'){
			$sql = "SELECT * FROM `vendors` WHERE bank_id='$bank_id' AND state_id ='$state_id'";
		}else {
				$sql = "SELECT * FROM `vendors` WHERE vendor_id='$id'";
		}
		//echo $sql;exit;
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