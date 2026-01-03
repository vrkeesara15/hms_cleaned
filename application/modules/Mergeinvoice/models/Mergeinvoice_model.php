<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mergeinvoice_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}	
	
	public function getvendors(){
		$sql = "SELECT * FROM `vendors`
				INNER JOIN allbanks ON allbanks.bank_id = vendors.bank_id
				INNER JOIN states ON states.state_id = vendors.state_id";
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
	public function getGstDetails($id){
		$sql = "SELECT * FROM `vendors` WHERE vendor_id='$id'";		                               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
		return $query->row();
		}else {
		return false;
		}
	}
	public function checkDupliate($bank_id, $state_id, $action, $id){
		if($action == 'add'){
			$sql = "SELECT * FROM `vendors` WHERE bank_id='$bank_id' AND state_id ='$state_id'";
		}else {
				$sql = "SELECT * FROM `vendors` WHERE vendor_id='$id'";
		}
		//echo $sql;exit;
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
		return $query->row();
		}else {
		return false;
		}	
	}
	
	public function getMergeInvoicesList(){
	    $sql = "SELECT GROUP_CONCAT(old_invoice_id) as old_invoice_id,new_invoice_id,id FROM `merged_invoices` GROUP BY new_invoice_id";
	    $query = $this->db->query($sql);
	    if($query->num_rows()>0){
	        return $query->result();
	    }else{
	        return false;
	    }
	}
	
	public function getInvoiceids(){
	    $sql = "SELECT id,concat(id,'-',account) as invoice_account,gst_no FROM `invoice` WHERE invoice_status NOT IN('r','d','m') ORDER BY id desc";
	    $query = $this->db->query($sql);
	    if($query->num_rows()>0){
	        return $query->result();
	    }else{
	        return false;
	    }
	}
	
	public function getInvoiceidsByGst($gst_no){
	    $sql = "SELECT id,concat(id,'-',account) as invoice_account,gst_no FROM `invoice` WHERE gst_no = '$gst_no' AND invoice_status NOT IN('r','d','m') ORDER BY id desc";
	    $query = $this->db->query($sql);
	    if($query->num_rows()>0){
	        return $query->result();
	    }else{
	        return false;
	    }
	}
	public function getBankBrancheNames($bank_id){
		$sql = "SELECT 
	              allbranchs.branch_id,
                  allbranchs.branch_name,
                  allbranchs.state_id,
                  gsts.gst_no
		        FROM allbanks
				INNER JOIN allbranchs ON allbranchs.bank_id = allbanks.bank_id
				INNER JOIN gsts ON gsts.bank_id = allbanks.bank_id AND gsts.state_id = allbranchs.state_id";
		if(($this->session->userdata('user_role') == '3') || ($this->session->userdata('user_role') == '2')) {
		   $sql .="	INNER JOIN emp_profile ON emp_profile.id = allbranchs.inserted_by";
		}
				$sql .= " WHERE allbranchs.bank_id='$bank_id'";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}	
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}
	public function getLoanAccountsInfo($invoiceIds){
	    $sql = "SELECT loan_id FROM invoice WHERE id IN($invoiceIds)";
	    $query = $this->db->query($sql);
	    if($query->num_rows()>0){
			$loan_ids = $query->result();
			$loan_ids_array = array_column($loan_ids,'loan_id');
			$laonIds = implode(",", $loan_ids_array);
			$loansql = "SELECT * FROM Loanaccounts WHERE loan_id IN($laonIds)";
			$loanquery = $this->db->query($loansql);
			if($loanquery->num_rows()>0){
			    $loanData = $loanquery->result();
			    return $loanData;
			}else{
			    return fasle;
			}
		}else{
			return false;
		}
	}
}

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */