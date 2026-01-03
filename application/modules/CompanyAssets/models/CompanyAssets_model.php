<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CompanyAssets_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getAllCompanyAssets($fields){
	    $start_date = $fields['start_date'];
	    $end_date = $fields['end_date'];
		$sql = "SELECT * FROM company_assets";
		if(!empty($start_date) && !empty($end_date)) {
		    $sql .= " WHERE purchase_date BETWEEN CAST('$start_date' AS DATE) AND CAST('$end_date' AS DATE)";
		}
		
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}

	
	
	public function getExpenseType(){
		$sql = "SELECT id,expense_type FROM `expenses_types` ";
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