<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author  : Challagulla venkata sudhakar
 * Project : Admin Panel
 * Version v1.0
 * Model : common_model
 * Mail id : phpguidance@gmail.com
  */
class Common_model extends CI_Model {	
	/**
	* @$tablename : tablename
	* @$data : array
	* Usage : here insert single row
	*/
	public function insertSingle($tablename, $data =null){
      if($data !=null){
        $this->db->insert($tablename,$data);
		return $this->db->insert_id(); 
      }else {
      	return false;
      }
	}
	/*
	* @$tablename : tablename
	* @$data : multiple array's
	*  Usage : here insert multiple rows
	*/
	public function insertMany($tablename,$data = null){
	  if($data !=null){
		$this->db->insert_batch($tablename, $data);
	  }else {
	  	return false;
	  }
	}
	/*
	* @$tablename : table name
	* @$ params : array
	* usage : here udate single row with single condition or multiple where conditions
	*/
	public function updateRow($tablename, $data, $params){

	   foreach ($params as $key => $value) {
        $this->db->where($key,$value);
       }
       $this->db->update($tablename, $data);
	   return $this->db->affected_rows();
	}
	/*
	* @$tablename : tablename
	* @$ params  : array
	* Usage : Here delete data from database based on param condiion
	*/
	public function deleteRow($tablename, $params){
	   foreach ($params as $key => $value) {
        $this->db->where($key,$value);
       }
       $this->db->delete($tablename);
	}
	/*
	* @$tablename : tablename
	*  @params  : array
	* Usage : here we wil get result from table with conditions or with out conditions
	* Return :  object data
	*/
	public function getResult($tablename, $params = array()){
	   if(sizeof($params) >0) {
       foreach ($params as $key => $value) {
        $this->db->where($key,$value);
       }
	   }
	   $query = $this->db->get($tablename);
	   if($query->num_rows() > 0) {
        return $query->result();
       }else {
        return false;
       }	
	}

	/*
	* @$tablename : tablename
	*  @params  : array
	* Usage : here we wil get result from table with conditions or with out conditions
	* Return : array data
	*/
	public function getResultArray($tablename, $params = array()){
	   if(sizeof($params) >0) {
       foreach ($params as $key => $value) {
        $this->db->where($key,$value);
       }
	   }
	   $query = $this->db->get($tablename);
	   if($query->num_rows() > 0) {
        return $query->result_array();
       }else {
        return false;
       }	
	}
	/*
	* @$tablename : tablename
	*  @params  : array
	* Usage : here we wil get single row result from table with conditions or with out conditions
	* Return : array data
	*/
	public function getSingleRow($tablename, $params = array()){
	   if(sizeof($params) >0) {
       foreach ($params as $key => $value) {
        $this->db->where($key,$value);
       }
	   }
	   $query = $this->db->get($tablename);
	   if($query->num_rows() > 0) {
        return $query->row();
       }else {
        return false;
       }	
	}
	/*
	* @$tablename : tablename
	*  @params  : array
	* Usage : here we wil get single row result from table with conditions or with out conditions
	* Return : array data
	*/
	public function geCount($tablename, $params = array()){
	   if(sizeof($params) >0) {
       foreach ($params as $key => $value) {
        $this->db->where($key,$value);
       }
	   }
	   $query = $this->db->get($tablename);
	   if($query->num_rows() > 0) {
        return $query->num_rows();
       }else {
        return false;
       }	
	}
	/*
	* @$tablename : tablename
	*  @params  : array
	* Usage : Here we will truncate the database table
	* Return : array data
	*/
	public function truncate($tablename){
	   $this->db->truncate($tablename);       
	}
	 public function get_result($table_name='', $columns=array(), $id_array='',$order_by=array(),$limit='',$offset='',$and_like_array='',$or_like_array='',$min_val='',$max_val='',$or_array='',$in_array=array())
    {
        //Fileds
        if(!empty($columns)):
            $all_columns = implode(",", $columns);
            $this->db->select($all_columns);
        endif;
        // Min
         if(!empty($min_val)):          
            $this->db->select_min($min_val);
        endif;
        // Max
         if(!empty($max_val)):           
            $this->db->select_max($max_val);
        endif;
      
        //Order by 
        if(!empty($order_by)):
            foreach ($order_by as $key => $value)
            {
                $this->db->order_by($key, $value);
            }       
        endif; 
        //Where
        if(!empty($id_array)):      
            foreach ($id_array as $key => $value)
            {
                $this->db->where($key, $value);
            }
        endif;  
        //or where
        if(!empty($or_array)):  
            foreach ($or_array as $key => $value)
            {
                $this->db->or_where($key, $value);
            }
        endif;  
          //wherein
        if(!empty($in_array)): 
              foreach ($in_array as $key => $value)
            {
              $this->db->where_in($key, $value);
            }
        endif;  
        //Like And
        if(!empty($and_like_array)):            
            foreach ($and_like_array as $key => $value)
            {
                $this->db->like($key, $value);
            }           
        endif;  
        //Like or
        if(!empty($or_like_array)):            
            foreach ($or_like_array as $key => $value)
            {
                $this->db->or_like($key, $value);
            }           
        endif; 
        //Limit
        if(!empty($limit)): 
               $this->db->limit($limit,$offset);
        endif;  
        
        $query=$this->db->get($table_name);
        if($query->num_rows()>0)
            return $query->result();
        else
            return FALSE;
    }

    public function checkPermission($module_id,$roleid, $permission_id) {
    $this->db->where('module_id',$module_id);
    $this->db->where('role_id',$roleid);
    $this->db->where_in('permission_id',$permission_id);
    $query = $this->db->get('sg_role_permissions');
    //echo $this->db->last_query();exit;
    if($query->num_rows() > 0) {
         return $query->row();
        }else {
         return '';
      } 
  }
  public function getEmpLog($emp_id) {
    $sql = "SELECT * FROM emp_logs WHERE emp_id = '$emp_id' ORDER BY log_id DESC LIMIT 1";
    $query = $this->db->query($sql);
    if($query->num_rows()>0){
      return $query->row();
    }else {
      return false;
    }
  }

  public function getRowName($module_id, $link_id){

    if($link_id !=''){

    if($module_id == '1') {

      $sql = "SELECT * FROM empanelments WHERE empanelment_id ='$link_id'";

    }else if($module_id == '2') {
      $sql = "SELECT * FROM formats  WHERE format_id ='$link_id'";
    }else if($module_id == '3') {
      $sql = "SELECT * FROM workorders  WHERE order_id ='$link_id'";
    }else if($module_id == '4') {
      $sql = "SELECT * FROM regularize_form  WHERE r_id ='$link_id'";
    }else if($module_id == '5') {
      $sql = "SELECT * FROM seize_form  WHERE s_id ='$link_id'";
    }else if($module_id == '6') {
      $sql = "SELECT * FROM release_form  WHERE rel_id ='$link_id'";
    }else if($module_id == '7') {
      $sql = "SELECT * FROM auction_form  WHERE auc_id ='$link_id'";
    }else if($module_id == '8') {
      $sql = "SELECT * FROM emp_profile  WHERE emp_id ='$link_id'";
    }

     $query = $this->db->query($sql);
    if($query->num_rows()>0){
      return $query->row();
    }else {
      return false;
    }
  }else {
    return false;
  }
  }
  function getAllEmployees(){
    $sql = "select * from emp_profile WHERE id !='1'";                                    
    $query = $this->db->query($sql);
    if($query->num_rows()>0){
      return $query->result();
    }else {
      return false;
    }
  }

  function getEmployeesByAdminId($admin_id=""){
    $sql = "select * from emp_profile WHERE id !='1'";
    if($admin_id != ''){
      $sql .= " AND (manager_id = '$admin_id' OR id='$admin_id') ";
    }
    $query = $this->db->query($sql);
    if($query->num_rows()>0){
      return $query->result();
    }else {
      return false;
    }
  }

  public function getGSTNumber($bank_id,$state_id){
      $sql = "SELECT * FROM `gsts` WHERE state_id ='$state_id' AND bank_id ='$bank_id'";
    //  echo $sql;exit;
    $query = $this->db->query($sql);
    if($query->num_rows()>0){
      return $query->row();
    }else {
      return false;
    }
  }

  public function getBranchCreatedBy($branch_id){
    $sql = "SELECT fname,lname FROM emp_profile
              INNER JOIN allbranchs ON allbranchs.inserted_by = emp_profile.id
              WHERE allbranchs.branch_id='$branch_id'";
    $query = $this->db->query($sql);
    if($query->num_rows()>0){
      $result = $query->row();
      $name = $result->fname.' '.$result->lname;
      return $name;
    }else{
      return false;
    }
  }
  public function getInvoiceTotals($invoice_id){
    $sql = "SELECT SUM(recovered_amt) AS recoveredamt, SUM(commission_charges) AS commissioncharges, SUM(total) AS total
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
  
    public function getAdvancePaymentHistory($advance_request_id){
        $sql = "SELECT * FROM `advance_payment_audit` WHERE advance_request_id='$advance_request_id' ORDER BY id DESC";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
          return $query->result();
        }else{
          return false;
        }
    }
    
    public function getBalanceAmountEmpId($emp_id){
	    $sql = "SELECT emp_id,SUM(paid_amount) as advance_paid_amount FROM `advance_requests` WHERE emp_id='$emp_id'";
	    $query = $this->db->query($sql);
	    $paidAmount = 0;
	    if($query->num_rows()>0){
	        $result = $query->row();
	        $paidAmount = $result->advance_paid_amount;
	    }
	    $contractorPaidAmount = 0;
	    $sql2 = "SELECT emp_id,SUM(paid_amount) as contractor_paid_amount FROM `contractor_payment_audit` WHERE emp_id='$emp_id'";
	    $query2 = $this->db->query($sql2);
	    if($query2->num_rows()>0){
	        $result2 = $query2->row();
	        $contractorPaidAmount = $result2->contractor_paid_amount;
	    }
	    
	    $manualDebitAmount = 0;
	    $sql3 = "SELECT SUM(amount) as manualDebitAmount FROM manual_debits WHERE emp_id='$emp_id'";
	    $query3 = $this->db->query($sql3);
	    if($query3->num_rows()>0){
	        $result3 = $query3->row();
	        $manualDebitAmount = $result3->manualDebitAmount;
	    }
	    $balanceAmount = $paidAmount - $contractorPaidAmount - $manualDebitAmount;
	    return $balanceAmount;
	}
	public function getBarrowerName($invoice_id){
        $sql = "SELECT `loan_id` FROM `invoice` WHERE id='$invoice_id'";
        $query = $this->db->query($sql);
        $res1 = $query->row();
        $loan_id = $res1->loan_id;
        $sql1 = "SELECT barrower_name FROM `Loanaccounts` WHERE loan_id =$loan_id";
        $query1 = $this->db->query($sql1);
        $res2 = $query1->row();
        
        if($query1->num_rows()>0){
          return $query1->row();
        }else{
          return false;
        }
      }
      public function getBarrowerNameAccNo($invoice_id){
        $sql = "SELECT `loan_id` FROM `invoice` WHERE id='$invoice_id'";
        $query = $this->db->query($sql);
        $res1 = $query->row();
        $loan_id = $res1->loan_id;
        $sql1 = "SELECT barrower_name,loan_ac_number FROM `Loanaccounts` WHERE loan_id =$loan_id";
        $query1 = $this->db->query($sql1);
        $res2 = $query1->row();
        
        if($query1->num_rows()>0){
          return $query1->row();
        }else{
          return false;
        }
      }
     public function getAnnouncements() {
         $today = date('Y-m-d');
         $empid = $this->session->userdata('emp_id');
      $sql = "SELECT 
                  id,
                  description, 
                  start_date, 
                  end_date,
                  emp_id
              FROM
                  employee_announcements
              WHERE 
                  status = 'y' AND ('$today' BETWEEN date(start_date) AND date(end_date)) AND emp_id IN('0','$empid')
              ORDER BY start_date DESC
              ";
      $query = $this->db->query($sql);
     // echo $this->db->last_query();
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return false;
      }
  }
  
    public function getBranchDetails($branch_id){
        $sql = "SELECT branch_name,branch_code,allbanks.bank_name FROM allbranchs
                INNER JOIN allbanks ON allbanks.bank_id = allbranchs.bank_id
                  WHERE allbranchs.branch_id='$branch_id'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
          $result = $query->row();
          return $result;
        }else{
          return false;
        }
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
				
		$whereCond = "";

		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " WHERE emp_profile.id ='$empid' AND invoice_status != 'd'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond .= " WHERE (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid') AND invoice_status != 'd'";
		}
		if($whereCond == ""){
		    $whereCond = " WHERE invoice_status != 'd' AND invoice_status != 'm'";
		}else{
		    $whereCond .= " AND invoice_status != 'd' AND invoice_status != 'm'";
		}

		$sql .= $whereCond." GROUP BY invoice.id  ORDER BY invoice.id DESC ";               
		
// 		if($this->session->userdata('user_role') == '3'){
// 			$empid = $this->session->userdata('emp_id');
// 			$sql .= " WHERE emp_profile.id ='$empid'";
// 		}
// 		if($this->session->userdata('user_role') == '2'){
// 			$empid = $this->session->userdata('emp_id');
// 			$sql .= " WHERE (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
// 		}	
// 			$sql .=" GROUP BY invoice.id ORDER BY invoice.id DESC ";		                                
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
		if($whereCond == ""){
		    $whereCond = " AND invoice_status != 'd' AND invoice_status != 'm'";
		}else{
		    $whereCond .= " AND invoice_status != 'd' AND invoice_status != 'm'";
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
		$whereCond = "";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}
		if($whereCond == ""){
		    $whereCond = " AND invoice_status != 'd' AND invoice_status != 'm'";
		}else{
		    $whereCond .= " AND invoice_status != 'd' AND invoice_status != 'm'";
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
		
		if($whereCond == ""){
		    $whereCond = " AND invoice_status != 'd' AND invoice_status != 'm'";
		}else{
		    $whereCond .= " AND invoice_status != 'd' AND invoice_status != 'm'";
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
	
	public function getDeletedInvoicesCounts(){
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
		$whereCond = "";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}
// 		if(!empty($whereCond)){
// 		     $whereCond .= " AND receive_status!='y'";
// 		}else{
// 		    $whereCond = " AND receive_status!='y'";
// 		}
		
		if($whereCond == ""){
		    $whereCond = " AND invoice_status = 'd' AND invoice_status != 'm'";
		}else{
		    $whereCond .= " AND invoice_status = 'd' AND invoice_status != 'm'";
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
	
	public function getDownloadPendingInvoicesCounts(){
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
			$sql .=" GROUP BY invoice.id ORDER BY invoice.id DESC ";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
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
	
	public function contractorManualDebitAmount($emp_id){
	    $sql = "SELECT SUM(amount) as manualDebitAmount FROM manual_debits WHERE emp_id='$emp_id'";
	    $query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}
	
	public function getPendingLoanCounts(){
		$sql = "SELECT
			    	Loanaccounts.loan_id
				FROM
				    Loanaccounts
				INNER JOIN emp_profile ON emp_profile.id = Loanaccounts.inserted_by
				WHERE approval_status = 'p' ";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}
		
		$sql .= $whereCond;
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}
	public function getApprovedLoanCounts(){
		$sql = "SELECT
			    	Loanaccounts.loan_id
				FROM
				    Loanaccounts
				INNER JOIN emp_profile ON emp_profile.id = Loanaccounts.inserted_by
				WHERE approval_status = 'a' ";
		if($this->session->userdata('user_role') == '3'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND emp_profile.id ='$empid'";
		}
		if($this->session->userdata('user_role') == '2'){
			$empid = $this->session->userdata('emp_id');
			$whereCond = " AND (emp_profile.id ='$empid' OR emp_profile.manager_id ='$empid')";
		}
		
		$sql .= $whereCond;
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}
}


/* End of file common_model.php */
/* Location: ./application/models/common_model.php */