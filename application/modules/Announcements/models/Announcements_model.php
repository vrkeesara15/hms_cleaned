<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Announcements_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}	
	
	public function getAnnouncements(){
		$sql = "SELECT * FROM `announcements`";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}
	}
	public function getAnnouncementCharges($id=''){
		$sql = "SELECT * FROM `announcements` WHERE id ='$id'";		
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else {
			return false;
		}	
	}
	public function get_Announcement_details($id){
		$sql = "SELECT * FROM `announcements` WHERE id='$id'";		                                
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	public function getEditEmployeeDetails($id){
		$sql = "SELECT * FROM `employee_announcements` WHERE announcement_id='$id'";		                                
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