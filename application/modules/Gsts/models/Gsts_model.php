<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gsts_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}	
	
	public function getgsts(){
		$sql = "SELECT * FROM `gsts`
				INNER JOIN allbanks ON allbanks.bank_id = gsts.bank_id
				INNER JOIN states ON states.state_id = gsts.state_id";
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
	public function getAllbranchs(){
		$sql = "SELECT * FROM `allbranchs`";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getGstDetails($id){
		$sql = "SELECT * FROM `gsts` WHERE gst_id='$id'";		                               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
		return $query->row();
		}else {
		return false;
		}
	}
	public function checkDupliate($bank_id, $state_id, $action, $id,$branch_id){
		if($action == 'add'){
			$sql = "SELECT * FROM `gsts` WHERE bank_id='$bank_id' AND state_id ='$state_id' ";
		}else {
				$sql = "SELECT * FROM `gsts` WHERE gst_id='$id'";
		}
		//echo $sql;
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
		return $query->row();
		}else {
		return false;
		}	
	}
	public function getBankBranches($bank_id,$state_id){
		$sql = "SELECT * FROM allbanks
				INNER JOIN allbranchs ON allbranchs.bank_id = allbanks.bank_id
				WHERE 
				allbranchs.bank_id != 0";
		if(!empty($bank_id)) {
			$sql .=" AND allbranchs.bank_id = $bank_id";
		}
		if(!empty($state_id)) {
			$sql .=" AND allbranchs.state_id = $state_id";
		}
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