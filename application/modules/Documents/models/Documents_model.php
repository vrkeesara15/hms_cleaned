<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documents_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}		
	public function getDocuments(){
		$sql = "SELECT documents.*,module.module_name FROM `documents` 
				INNER JOIN module ON module.module_id = documents.module_id";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}	
	}
	public function getDocument($doc_id){
		$sql = "SELECT * FROM `documents` WHERE doc_Id ='$doc_id'";		
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