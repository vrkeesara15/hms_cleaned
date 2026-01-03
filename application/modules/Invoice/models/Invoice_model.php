<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getInvoicesCounts(){
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.account,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " WHERE (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}	
			$sql .=" GROUP BY invoice.id ORDER BY invoice.id DESC ";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}
	public function getReceivedInvoicesCounts(){
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.account,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total,
				    contractor_charges.contractor_charges_id
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				LEFT JOIN contractor_charges ON contractor_charges.invoice_id = invoice.id
				WHERE contractor_charges_id is NULL ";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}
		if(!empty($whereCond)){
		     $whereCond .= " AND receive_status='y'";
		}else{
		    $whereCond = " AND receive_status='y'";
		}
		$sql .= $whereCond;
			$sql .=" GROUP BY invoice.id ORDER BY invoice.id DESC ";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}
	
	public function getPendingInvoicesCounts(){
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.account,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total,
				    contractor_charges.contractor_charges_id
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				LEFT JOIN contractor_charges ON contractor_charges.invoice_id = invoice.id
				WHERE contractor_charges_id is NULL ";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}
		if(!empty($whereCond)){
		     $whereCond .= " AND receive_status!='y'";
		}else{
		    $whereCond = " AND receive_status!='y'";
		}
		$sql .= $whereCond;
			$sql .=" GROUP BY invoice.id ORDER BY invoice.id DESC ";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}
	
	public function getSettledInvoicesCounts(){
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.account,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total,
				    contractor_charges.contractor_charges_id
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				LEFT JOIN contractor_charges ON contractor_charges.invoice_id = invoice.id
				WHERE contractor_charges_id is NOT NULL ";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}

		$sql .= $whereCond;
			$sql .=" GROUP BY invoice.id ORDER BY invoice.id DESC ";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}
	
	public function getInvoices($limit, $start){ 
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.bill_date,
				    invoice.account,
				    invoice.manual_invoice,
				    invoice.preview_status,
				    invoice.receive_status,
				    invoice.received_invoice_id,
				    invoice.invoice_status,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total,
				    invoice.inserted_by as invoice_inserted_by,
				    invoice.inserted_date as invoice_inserted_date,
				    Loanaccounts.*
				    
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				";
				
		$whereCond = "";

		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " WHERE emp_profile.id ='$empid' AND (invoice_status != 'd' AND invoice_status != 'm')";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " WHERE (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid') AND invoice_status != 'd'";
		}
		if($whereCond == ""){
		    $whereCond .= " WHERE invoice_status != 'd'";
		}

		$sql .= $whereCond." GROUP BY invoice.id  ORDER BY invoice.id DESC  LIMIT $start, $limit";               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
		public function getInvoicesNew(){ 
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.bill_date,
				    invoice.account,
				    invoice.manual_invoice,
				    invoice.preview_status,
				    invoice.receive_status,
				    invoice.received_invoice_id,
				    invoice.invoice_status,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total,
				    invoice.inserted_by as invoice_inserted_by,
				    invoice.inserted_date as invoice_inserted_date,
				    Loanaccounts.*
				    
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				";

		$whereCond = "";

		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " WHERE emp_profile.id ='$empid' AND (invoice_status != 'd' AND invoice_status != 'm')";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " WHERE (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid') AND (invoice_status != 'd' AND invoice_status != 'm')";
		}
		if($whereCond == ""){
		    $whereCond .= " WHERE invoice_status != 'd' AND invoice_status != 'm'";
		}					                 

		$sql .= $whereCond." GROUP BY invoice.id  ORDER BY invoice.id DESC ";               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getReceivedInvoices($limit=10, $start=0){ 
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.bill_date,
				    invoice.account,
				    invoice.manual_invoice,
				    invoice.preview_status,
				    invoice.receive_status,
				    invoice.received_invoice_id,
				    invoice.invoice_status,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total,
				    invoice.inserted_by as invoice_inserted_by,
				    invoice.inserted_date as invoice_inserted_date,
				    Loanaccounts.*,
				    invoice_services.borrower_name,
				    contractor_charges.contractor_charges_id,
				    invoice_receivals.received_date
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				INNER JOIN invoice_receivals ON invoice_receivals.invoice_id = invoice.id
				LEFT JOIN contractor_charges ON contractor_charges.invoice_id = invoice.id
				WHERE contractor_charges_id is NULL
				";
				
		$whereCond = "";

		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}	
		
		if(!empty($whereCond)){
		     $whereCond .= " AND receive_status='y'";
		}else{
		    $whereCond = " AND receive_status='y'";
		}
		if($whereCond == ""){
		    $whereCond = " AND (invoice_status != 'd' AND invoice_status != 'm')";
		}else{
		    $whereCond .= " AND (invoice_status != 'd' AND invoice_status != 'm')";
		}
		$sql .= $whereCond;

		$sql .= " GROUP BY invoice.id  ORDER BY invoice.id DESC";               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getPendingInvoices($limit=10, $start=0){ 
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.bill_date,
				    invoice.account,
				    invoice.manual_invoice,
				    invoice.preview_status,
				    invoice.receive_status,
				    invoice.received_invoice_id,
				    invoice.invoice_status,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total,
				    invoice.inserted_by as invoice_inserted_by,
				    invoice.inserted_date as invoice_inserted_date,
				    Loanaccounts.*,
				    invoice_services.borrower_name,
				    contractor_charges.contractor_charges_id
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				LEFT JOIN contractor_charges ON contractor_charges.invoice_id = invoice.id
				WHERE contractor_charges_id is NULL
				";

		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}	
		
		if(!empty($whereCond)){
		     $whereCond .= " AND receive_status!='y'";
		}else{
		    $whereCond = " AND receive_status!='y'";
		}
		
		if($whereCond == ""){
		    $whereCond = " AND (invoice_status != 'd' AND invoice_status != 'm')";
		}else{
		    $whereCond .= " AND (invoice_status != 'd' AND invoice_status != 'm')";
		}
		$sql .= $whereCond;

		$sql .= " GROUP BY invoice.id  ORDER BY invoice.id DESC";               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getDownloadPendingInvoices($limit=10, $start=0){ 
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.bill_date,
				    invoice.account,
				    invoice.manual_invoice,
				    invoice.preview_status,
				    invoice.receive_status,
				    invoice.received_invoice_id,
				    invoice.invoice_status,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total,
				    invoice.inserted_by as invoice_inserted_by,
				    invoice.inserted_date as invoice_inserted_date,
				    Loanaccounts.*,
				    invoice_services.borrower_name,
				    contractor_charges.contractor_charges_id
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				LEFT JOIN contractor_charges ON contractor_charges.invoice_id = invoice.id
				WHERE contractor_charges_id is NULL
				";

		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}	
		
		if(!empty($whereCond)){
		     $whereCond .= " AND download_status!='y'";
		}else{
		    $whereCond = " AND download_status!='y'";
		}
		
		if($whereCond == ""){
		    $whereCond = " AND (invoice_status != 'd' AND invoice_status != 'm')";
		}else{
		    $whereCond .= " AND (invoice_status != 'd' AND invoice_status != 'm')";
		}
		$sql .= $whereCond;

		$sql .= " GROUP BY invoice.id  ORDER BY invoice.id DESC";               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getSettledInvoices($limit=10, $start=0){ 
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.bill_date,
				    invoice.account,
				    invoice.manual_invoice,
				    invoice.preview_status,
				    invoice.receive_status,
				    invoice.received_invoice_id,
				    invoice.invoice_status,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total,
				    invoice.inserted_by as invoice_inserted_by,
				    invoice.inserted_date as invoice_inserted_date,
				    Loanaccounts.*,
				    invoice_services.borrower_name,
				    contractor_charges.contractor_charges_id
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				LEFT JOIN contractor_charges ON contractor_charges.invoice_id = invoice.id
				WHERE contractor_charges_id is NOT NULL
				";

		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}
		
		if($whereCond == ""){
		    $whereCond = " AND invoice_status != 'd'";
		}else{
		    $whereCond .= " AND invoice_status != 'd'";
		}
		
// 		if(!empty($whereCond)){
// 		     $whereCond .= " AND receive_status='y'";
// 		}else{
// 		    $whereCond = " AND receive_status='y'";
// 		}
		$sql .= $whereCond;

		$sql .= " GROUP BY invoice.id  ORDER BY invoice.id DESC";               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getRejectedInvoices($limit=10, $start=0){ 
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.bill_date,
				    invoice.account,
				    invoice.manual_invoice,
				    invoice.preview_status,
				    invoice.receive_status,
				    invoice.received_invoice_id,
				    invoice.invoice_status,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total,
				    invoice.inserted_by as invoice_inserted_by,
				    invoice.inserted_date as invoice_inserted_date,
				    Loanaccounts.*,
				    invoice_services.borrower_name,
				    contractor_charges.contractor_charges_id
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				LEFT JOIN contractor_charges ON contractor_charges.invoice_id = invoice.id
				WHERE contractor_charges_id is NULL
				";

		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}	
		
		if(!empty($whereCond)){
		     $whereCond .= " AND invoice.invoice_status ='r'";
		}else{
		    $whereCond = " AND invoice.invoice_status='r'";
		}
		$sql .= $whereCond;

		$sql .= " GROUP BY invoice.id  ORDER BY invoice.id DESC";               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getDeletedInvoices($limit=10, $start=0){ 
		$sql = "SELECT
			    	invoice.id,
				    invoice.bill_no,
				    invoice.bill_date,
				    invoice.account,
				    invoice.manual_invoice,
				    invoice.preview_status,
				    invoice.receive_status,
				    invoice.received_invoice_id,
				    invoice.invoice_status,
				    SUM(invoice_services.gst) as gst,
				    SUM(invoice_services.total) as total,
				    invoice.inserted_by as invoice_inserted_by,
				    invoice.inserted_date as invoice_inserted_date,
				    Loanaccounts.*,
				    invoice_services.borrower_name,
				    contractor_charges.contractor_charges_id
				FROM
				    invoice
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN emp_profile ON emp_profile.id = invoice.emp_id
				LEFT JOIN contractor_charges ON contractor_charges.invoice_id = invoice.id
				WHERE contractor_charges_id is NULL
				";

		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}	
		
		if(!empty($whereCond)){
		     $whereCond .= " AND invoice.invoice_status ='d'";
		}else{
		    $whereCond = " AND invoice.invoice_status='d'";
		}
		$sql .= $whereCond;

		$sql .= " GROUP BY invoice.id  ORDER BY invoice.id DESC";               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getInvoiceDetails($invoice_id){ 
		$sql = "SELECT *  FROM invoice 
				INNER JOIN invoice_services ON invoice.id = invoice_services.invoice_id 
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN allbanks ON allbanks.bank_id = Loanaccounts.bank_id
				INNER JOIN allbranchs ON allbranchs.branch_id = Loanaccounts.branch_id
				WHERE invoice.id = $invoice_id";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
    public function getLoanTypesDetails(){ 
		$sql = "SELECT *  FROM loantypes";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getManualInvoiceBankDetails($gst_no){
		$sql = "SELECT * FROM `gsts` WHERE gst_no = '$gst_no'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			$result = $query->row();
		}else {
			return false;
		}


	}
	public function getInvoiceDetails_single($invoice_id){ 
		$sql = "SELECT *  FROM invoice
				WHERE invoice.id = $invoice_id";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	
	public function getInvoiceBankDetails($invoice_id){ 
		$sql = "SELECT Loanaccounts.barrower_name, Loanaccounts.loan_ac_number, Loanaccounts.bank_id,allbanks.bank_name,allbranchs.branch_name,allbranchs.state_id,invoice.id,invoice.bill_date,invoice.received_invoice_id  FROM invoice 
				INNER JOIN Loanaccounts ON Loanaccounts.loan_id = invoice.loan_id
				INNER JOIN allbanks ON allbanks.bank_id = Loanaccounts.bank_id
				INNER JOIN allbranchs ON allbranchs.branch_id = Loanaccounts.branch_id
				WHERE invoice.id =  $invoice_id";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	public function getLoanaccounts($type_of_invoice='', $order_id=''){
		if($type_of_invoice =='1'){
			$sql = "SELECT loan_id,barrower_name,loan_ac_number FROM Loanaccounts 
			        INNER JOIN emp_profile ON emp_profile.id = Loanaccounts.emp_id
			        WHERE Loanaccounts.status = 'p' AND Loanaccounts.order_id='$order_id'";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}					                 
	
		}else {
			$sql = "SELECT loan_id,barrower_name,loan_ac_number FROM Loanaccounts 
					INNER JOIN emp_profile ON emp_profile.id = Loanaccounts.emp_id
			        WHERE Loanaccounts.status IN('reg','rel','a') AND Loanaccounts.order_id='$order_id'";	
			if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}
		}
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}

	public function getLoanaccounts_loans($type_of_invoice='', $loan_type_id=''){
		if($type_of_invoice =='1'){
			$sql = "SELECT loan_id,barrower_name,loan_ac_number FROM Loanaccounts 
			        INNER JOIN emp_profile ON emp_profile.id = Loanaccounts.emp_id
			        WHERE Loanaccounts.status = 'p' AND Loanaccounts.type_id ='$loan_type_id'";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}					                 
	
		}else {
			$sql = "SELECT loan_id,barrower_name,loan_ac_number FROM Loanaccounts 
					INNER JOIN emp_profile ON emp_profile.id = Loanaccounts.emp_id
			        WHERE Loanaccounts.status IN('reg','c') AND Loanaccounts.type_id ='$loan_type_id'"; 	
			if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$sql .= " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}
		}
		//echo $sql;exit;
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getLoanaccountsDetails($loan_id){		
		$sql = "SELECT  * FROM Loanaccounts 
				INNER JOIN allbranchs ON allbranchs.branch_id = Loanaccounts.branch_id
				INNER JOIN allbanks ON allbranchs.bank_id = allbranchs.bank_id
				INNER JOIN gsts as g ON g.bank_id = Loanaccounts.bank_id
				INNER JOIN gsts ON gsts.state_id = allbranchs.state_id
				WHERE loan_id ='$loan_id' ";
		$query = $this->db->query($sql);
		//echo $sql;exit;
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	public function getSeizeDeatils($lid=''){
		$sql = "SELECT seize_date FROM  seize_form WHERE loan_id = $lid";
		
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	public function getRelDeatils($lid=''){
		$sql = "SELECT release_date FROM  release_form WHERE loan_id = $lid";
		
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	public function getWorkOrders(){
		$sql = "SELECT  order_id,bank_id,work_order_num FROM workorders
				INNER JOIN emp_profile ON emp_profile.id = workorders.inserted_by";
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
			return $query->result();
		}else {
			return false;
		}
	}
	public function getBankCharges($order_id){
		$sql = "SELECT bank_charges.charge_name,bank_charges.charge_amount,allbanks.bank_name FROM `bank_charges`
				INNER  JOIN workorders ON workorders.bank_id = bank_charges.bank_id
				INNER  JOIN allbanks ON allbanks.bank_id = bank_charges.bank_id
				WHERE workorders.order_id ='$order_id'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}

	public function getVendorBankDetails($lid=''){
		$sql = "SELECT allbanks.bank_id,allbranchs.state_id,allbranchs.branch_id 
				FROM `Loanaccounts`
				INNER JOIN allbanks ON allbanks.bank_id = Loanaccounts.bank_id
				INNER JOIN allbranchs ON allbranchs.branch_id = Loanaccounts.branch_id
				WHERE Loanaccounts.loan_id ='$lid'";		
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}

	public function getBankBranches($bank_id){
		$sql = "SELECT * FROM allbanks
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
		public function getBankBrancheNames($bank_id){
		$sql = "SELECT 
	              allbranchs.branch_id,
                  allbranchs.branch_name,
                  allbranchs.state_id
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
	public function getLineTypes($invoice_type,$loan_type_id=''){
		$sql = "SELECT * FROM linetypes WHERE invoice_type ='$invoice_type'";
		if($loan_type_id != ''){
			$sql .= " AND loan_type_id='$loan_type_id'";	
		}
		
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}
	public function getBankBranchesNew($bank_id,$state_id){
		$sql = "SELECT * FROM allbanks
				INNER JOIN allbranchs ON allbranchs.bank_id = allbanks.bank_id
				WHERE 
				allbranchs.bank_id != 0";
		if(!empty($bank_id)) {
			$sql .=" AND allbranchs.bank_id = $bank_id";
		}
		if(!empty($state_id)) {
			$sql .=" AND allbranchs.state_id = $state_id";
		}
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}
	public function checkLoanAccount($account_no){
		$sql = "SELECT * FROM Loanaccounts WHERE loan_ac_number LIKE '$account_no'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function getBrachDetails($branch_id){
		$sql = "SELECT * FROM `allbranchs` WHERE branch_id='$branch_id'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function getGstData($bank_id,$state_id){
		$sql = "SELECT * FROM `gsts` WHERE bank_id='$bank_id' AND state_id='$state_id'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function getLoanAccountsAll(){
    $sql = "SELECT DISTINCT loan_ac_number FROM Loanaccounts ";
    
    $query = $this->db->query($sql);
    if($query->num_rows()>0){
      return $query->result();
    }else{
      return false;
    }
  }
	public function getInvFiles($invoice_id){
		$sql = "SELECT * FROM invoice_files WHERE invocie_id=$invoice_id";
		
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function getInvoiceTotals($invoice_id){
		$sql = "SELECT SUM(recovered_amt) AS recoveredamt, SUM(commission_charges) AS commissioncharges, SUM(total) AS total, SUM(gst) AS gstamount
			FROM
			        `invoice_services`
			   WHERE
			       invoice_id = $invoice_id
			   GROUP BY
			       invoice_id";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function checkRetain($invoice_id){
		$sql = "SELECT * FROM settle_retain WHERE invoice_id = '$invoice_id' ORDER BY retain_date DESC";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}
	
	public function contractPaidAmount($emp_id){
	    $sql = "SELECT SUM(paid_amount) as totalPaidAmount FROM contractor_payment_audit WHERE emp_id='$emp_id'";
	    $query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	    
	}
	public function contractorAdvancePaidAmount($emp_id){
	    $sql = "SELECT SUM(requested_amount) as requestedAmount,SUM(paid_amount) as advancePaidAmount FROM advance_requests WHERE emp_id='$emp_id'";
	    $query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	    
	}

	public function get_invoice_files($invoice_id){
	    $sql = "SELECT id,type FROM invoice_files WHERE invocie_id =$invoice_id";
	    $query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return false;
		}
	    
	}
	
	public function getLastContractorRecord($emp_id){
	    $sql = "SELECT contractor_charges_id,MAX(contractor_invoice_id) as contractor_invoice_id ,contractor_emp_id FROM `contractor_charges` WHERE contractor_emp_id='$emp_id'";
	    $query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	    
	}
	
	public function getMaxInvoiceData(){
	    $sql = "SELECT MAX(received_invoice_id) as received_invoice_id from invoice";
	    $query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}
	
	public function getReceivedInvoiceIds(){
	    $sql = "SELECT invoice_receivals.invoice_id FROM invoice_receivals GROUP BY invoice_receivals.invoice_id ORDER BY inserted_date DESC";
	    $query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}


	
  
	// public function getVendorDetails($bank_id='',$state_id=''){
	// 	$sql = "SELECT allbanks.bank_id,allbranchs.state_id,allbranchs.branch_id 
	// 			FROM `Loanaccounts`
	// 			INNER JOIN allbanks ON allbanks.bank_id = Loanaccounts.bank_id
	// 			INNER JOIN allbranchs ON allbranchs.branch_id = Loanaccounts.branch_id
	// 			WHERE Loanaccounts.loan_id ='$lid'";		
	// 	$query = $this->db->query($sql);
	// 	if($query->num_rows()>0){
	// 		return $query->row();
	// 	}else {
	// 		return false;
	// 	}
	// }
	
	

	

	

	
}

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */