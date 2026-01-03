<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getTotalExpenses(){
		$sql = "SELECT sum(expense_amount) as totalexpenses  FROM sg_expenses WHERE status='paid'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	public function getTotalpendings(){
		$sql = "SELECT sum(expense_amount) as totalexpenses  FROM sg_expenses WHERE status='paid'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
}