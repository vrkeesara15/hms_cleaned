<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formats_model extends CI_Model {

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
public function getFormats(){
		$sql = "SELECT * FROM `formats`
				INNER JOIN allbanks ON allbanks.bank_id = formats.bank_id
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
		$sql = "select MAX(format_id) as maxid from formats";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	public function getFormatsdata($format_id){
		$sql = "select * from formats WHERE format_id='$format_id'";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	public function formatDocumentsData($format_id){
		$sql = "select * from format_documents WHERE format_id='$format_id'";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getFormatDocuments() {
		$sql = "select * from format_documents";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getAllFormats() {
		$sql = "select * from formats";		                                
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