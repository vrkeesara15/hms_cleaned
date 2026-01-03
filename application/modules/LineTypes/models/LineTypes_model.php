<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LineTypes_model extends CI_Model { 

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}	
	
	public function getlinetypes(){
		$sql = "SELECT linetypes.linetype_name,linetypes.invoice_type,linetypes.loan_type_id,linetypes.linetype_id,loantypes.type_name FROM `linetypes`
			INNER JOIN loantypes ON loantypes.type_id = linetypes.loan_type_id";
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
	public function getLineTypeDetails($id){
		$sql = "SELECT * FROM `linetypes` WHERE linetype_id='$id'";		                               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
		return $query->row();
		}else {
		return false;
		}
	}
	public function checkDupliate($line_type,$invoice_type,$action, $linetype_id){
		if($action == 'add'){
			$sql = "SELECT * FROM `linetypes` WHERE linetype_name='$line_type' AND invoice_type ='$invoice_type'";
		}else {
				$sql = "SELECT * FROM `linetypes` WHERE linetype_id='$linetype_id'";
		}
		//echo $sql;
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