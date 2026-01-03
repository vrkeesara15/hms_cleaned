<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expensetypes_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getAllExpensetypes(){
		$sql = "SELECT `id`, `expense_type`, `created_by`, `created_date`, `updated_by`, `updated_date` FROM `expenses_types`";
		
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getExpenseType($id){
		$sql = "SELECT id,expense_type FROM `expenses_types` WHERE id='$id' ";
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