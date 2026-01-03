<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContractorCharges_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getContractorChargesCounts(){
		$sql = "SELECT `contractor_charges_id`, `charges_received_date`, `received_amount`, `tds_amount`, `gst_amount`, `expenses_amount`, `gross_contractor_charges`, `contractor_tds_charges`, `net_contractor_charges`, `contractor_advance_amount`, `net_amount_pay`, `payment_date`, `paid_amount`, `created_by`, `created_date`, `invoice_id` FROM `contractor_charges`
			INNER JOIN emp_profile ON emp_profile.id = contractor_charges.created_by
				";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}

	public function getAllContractorCharges($limit, $start){
		$sql = "SELECT `contractor_charges_id`, `charges_received_date`, `received_amount`, `tds_amount`, `gst_amount`, `expenses_amount`, `gross_contractor_charges`, `contractor_tds_charges`, `net_contractor_charges`, `contractor_advance_amount`, `net_amount_pay`, `payment_date`, `paid_amount`, `paid_date`, `paid_receipt`,contractor_charges. `notes`, `created_by`, `created_date`, `contractor_charges`.`updated_by`, `contractor_charges`.`updated_date`,  `contractor_charges`.`invoice_id`,`invoice`.`emp_id`,settle_other_document FROM `contractor_charges`
			INNER JOIN emp_profile ON emp_profile.id = contractor_charges.created_by
			INNER JOIN invoice ON invoice.id = contractor_charges.invoice_id ";	
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE invoice.emp_id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE (invoice.emp_id ='$empid' OR invoice.emp_id ='$empid')";
		}
		$sql .= " ORDER BY contractor_charges.contractor_charges_id DESC";                                
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