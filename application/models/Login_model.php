<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author  : Challagulla venkata sudhakar
 * Project : Admin 
 * Version v1.0
 * Model : login_model
 * Mail id : phpguidance@gmail.com
  */
class Login_model extends CI_Model {	
	
   
	
	public function get_by_username($username) {

        $sql = "SELECT user_fname,user_lname,user_email,user_password,user_id,user_role,emp_id,user_status  FROM sg_users
                WHERE user_email ='$username' AND user_status ='y'";		
                //echo $sql;exit;
		$query = $this->db->query($sql);		
		if($query->num_rows() > 0) {
         return $query->row();
        }else {
         return false;
      }
	}


}


/* End of file Loging_model.php */
/* Location: ./application/models/Login_model.php */