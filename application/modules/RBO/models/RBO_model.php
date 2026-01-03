<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RBO_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}	
	public function getAllmembers(){ 
		$sql = "select * from sg_owners";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}

}
public function getRBO(){
		$sql = "SELECT * FROM `rbo`
				INNER JOIN allbanks ON allbanks.bank_id = rbo.bank_id
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
		$sql = "select MAX(rbo_id) as maxid from rbo";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	public function getRBOdata($rbo_id){
		$sql = "select * from rbo WHERE rbo_id='$rbo_id'";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	
	public function getAllRBO() {
		$sql = "select * from rbo";		                                
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