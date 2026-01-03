<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CreditNotes_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getCreditNotesCounts($fields){
		$sql = "SELECT credit_note.credit_note_id, credit_note.created_date, credit_note.account_no, credit_note.invoice_id, credit_note.credit_note_amount, credit_note.inserted_by, credit_note.inserted_date, credit_note.updated_by, credit_note.updated_date, invoice.inserted_date as inv_date FROM credit_note
				INNER JOIN invoice ON credit_note.invoice_id = invoice.id";
		
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else {
			return false;
		}
	}

	public function getAllCreditNotes($limit, $start,$fields){
		$sql = "SELECT credit_note.credit_note_id, credit_note.created_date, credit_note.account_no, credit_note.invoice_id, credit_note.credit_note_amount, credit_note.inserted_by, credit_note.inserted_date, credit_note.updated_by, credit_note.updated_date, invoice.inserted_date as inv_date FROM credit_note
				INNER JOIN invoice ON credit_note.invoice_id = invoice.id 
			ORDER BY credit_note.credit_note_id DESC  LIMIT $start, $limit";	                               
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	
	public function getAllCreditNotesNew($fields){
	    $start_date = $fields['start_date'];
	    $end_date = $fields['end_date'];
	    if(!empty($start_date) && !empty($end_date)) {
	        $sql = "SELECT credit_note.credit_note_id, credit_note.created_date, credit_note.account_no, credit_note.invoice_id, credit_note.credit_note_amount, credit_note.inserted_by, credit_note.inserted_date, credit_note.updated_by, credit_note.updated_date, invoice.inserted_date as inv_date FROM credit_note
				INNER JOIN invoice ON credit_note.invoice_id = invoice.id 
				WHERE
				credit_note.created_date BETWEEN CAST('$start_date' AS DATE) AND CAST('$end_date' AS DATE)
			    ORDER BY credit_note.credit_note_id DESC ";	 
	    } else {
	        $sql = "SELECT credit_note.credit_note_id, credit_note.created_date, credit_note.account_no, credit_note.invoice_id, credit_note.credit_note_amount, credit_note.inserted_by, credit_note.inserted_date, credit_note.updated_by, credit_note.updated_date, invoice.inserted_date as inv_date FROM credit_note
				    INNER JOIN invoice ON credit_note.invoice_id = invoice.id 
			        ORDER BY credit_note.credit_note_id DESC ";	 
	    }
		                              
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