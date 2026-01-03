<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debits_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getAllDebits($fields){
	    $start_date = $fields['start_date'];
	    $end_date = $fields['end_date'];
		$sql = "SELECT debits.`id`, debits.`expense_type` as debit_expid, expenses_types.expense_type,  `date_of_receipt`, `amount`, `paid_to`, `expense_description`, `payment_method`, `expense_receipt`,debits.`created_by`, debits.`created_date`, debits.`updated_by`, debits.`updated_date`, debits.`transaction_date`, debits.`tds_amount`,debits.`gst_type`,debits.`other_receipt` FROM `debits`
		        INNER JOIN expenses_types ON expenses_types.id = debits.expense_type
		";
		if(!empty($start_date) && !empty($end_date)) {
		    $sql .= " WHERE debits.transaction_date BETWEEN CAST('$start_date' AS DATE) AND CAST('$end_date' AS DATE)";
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