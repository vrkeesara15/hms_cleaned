<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : ch.v.sudhakar9@gmail.com, phpguidance@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Auth
 * 
 * This controller will maintain the login , logout, changepassword functions
 */
class Auth extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Login_model','Common_model'));
        $this->load->helper('phpass');
        date_default_timezone_set('Asia/Calcutta');
        
    }

	public function index()
	{   if($this->authentication->checklogin()){
          redirect(base_url().'Dashboard');
        }else {
          redirect(base_url().'Login');	
        }
		
	}
	/*
	* @Login
	*
	* This function will do login functionality
	* Pass Post variables data from login form
    *
	* @return null 
	*/
	public function Login(){
		if($this->authentication->checklogin()){
          redirect(base_url().'Dashboard');
        }
	 
	    $validationRules = $this->_rules();
        foreach ($validationRules as $form_field)   {
        $rules[] = array(
        'name' => $form_field['field'],
        'display' => $form_field['label'],
        'rules' => $form_field['rules'],
        );
        }

      
$json_rules = json_encode($rules);
$script = <<< JS
<script>
var CIS = CIS || { Script: { queue: [] } };
CIS.Form.validation('login_form',{$json_rules});
</script>
JS;

        if (isset($_POST) && is_array($_POST) && count($_POST) > 0) {
	        if ( ! $user = $this->Login_model->get_by_username($this->input->post('user_name', TRUE))) {         
	              $data['username_email_error'] = lang('sign_in_username_email_does_not_exist');
	        }else {            
                if ( ! $this->authentication->check_password($user->user_password, $this->input->post('user_password', TRUE))) {
                   $data['sign_in_error'] = lang('sign_in_combination_incorrect');
                }  else   {
                  $logtrackid = rand();
	                //Here implement the user session data
	                $userdata = array('user_email'=>$user->user_email,
                                  'adminuser_id' => $user->user_id,
                                  'emp_id' => $user->emp_id,
                                  'user_password' => $user->user_password,
                                  'user_role' => $user->user_role,
                                  'user_name' => $user->user_fname,
                                  'logtrackid'     => $logtrackid
                                  );

                  if($user->user_role !='1'){
                    $logdata['emp_id'] = $user->emp_id;
                    $logdata['logtrackid'] = $logtrackid;
                    $logdata['login_time'] = date('Y-m-d H:i:s');                  
                    $result = $this->common_model->insertSingle('emp_logs', $logdata);
                  }

                  $this->session->set_userdata($userdata);
                  redirect(base_url().'Dashboard'); 
                }            
                }
            }
       $data['script'] = $script;
       $this->load->view('Login', $data);	
	}
	/*
	* @_rules 
	*
	* This function will bind all login function validation rules 
	*
	* @return Associative array
	*/
	public function _rules() {
        $rules = array(
                array('field' => 'user_name','label' => lang('user_name'),'rules' => 'trim|required|xss_clean|max_length[250]'),
                array('field' => 'user_password','label' => lang('user_password'),'rules' => 'trim|required|xss_clean|max_length[250]'));
        return $rules;
    }   
   
    /*
    * @ChangePassowrd
    *
    * Pass old and new password to  this function from change password form
    * 
    * @return Null
    */
    public function ChangePasskey(){
    	$this->load->library('template');
    	if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        $this->template->set_subpagetitle("Change Password");
		$breadcrumbarray = array('label'=> "Change Password",
                       'link' => base_url()."ChangePasskey"
                       );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);

        $validationRules = $this->_cprules();
        foreach ($validationRules as $form_field)   {
        $rules[] = array(
        'name' => $form_field['field'],
        'display' => $form_field['label'],
        'rules' => $form_field['rules'],
        );
        }
      
$json_rules = json_encode($rules);
$script = <<< JS
<script>
var CIS = CIS || { Script: { queue: [] } };
CIS.Form.validation('changepassword_from',{$json_rules});
</script>
JS;
if (isset($_POST) && is_array($_POST) && count($_POST) > 0) {
       // if(demo != '0'){
            $user_id = $this->session->userdata('emp_id');
            $oldpassword = $this->input->post('old_password');
            //check old password correct or not
            $params = array('emp_id'=>$user_id);
            $res = $this->common_model->getSingleRow('sg_users', $params);
          if ( ! $this->authentication->check_password($res->user_password, $oldpassword, TRUE)) {
			      $data['old_password_error'] = lang('old_password_error');
			    } else   {
    			  $new_password = $this->input->post('new_password');
			      $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
	          $hashed_password = $hasher->HashPassword( $new_password);
	          //update new password
	          $formvalues['user_password'] = $hashed_password;
	          $result = $this->common_model->updateRow('sg_users', $formvalues,$params);
	          if($result !=''){
              $data['password_change_success'] = lang('password_change_success');
            }else {
              $data['old_password_error'] = lang('old_password_error');
            }
			    }

        // }else {
        //   $data['old_password_error'] = "This is demo version";
        // }      

        }

        $data['script'] = $script;
		$this->template->load_view('ChangePassword',$data);
    }
    /*
	* @_rules 
	*
	* This function will bind all login function validation rules 
	*
	* @return Associative array
	*/
	public function _cprules() {
        $rules = array(
                array('field' => 'old_password','label' => lang('old_password'),'rules' => 'trim|required|xss_clean|max_length[250]'),
                array('field' => 'new_password','label' => lang('new_password'),'rules' => 'trim|required|xss_clean'),
                array('field' => 'confirm_password','label' => lang('confirm_password'),'rules' => 'trim|required|xss_clean|matches[new_password]'));
        return $rules;
    }
    /*
    * @ChangePassowrd
    *
    * Pass old and new password to  this function from change password form
    * 
    * @return Null
    */
    public function resetPassword(){
      $this->load->library('template');
      if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        $this->template->set_subpagetitle("Change Password");
    $breadcrumbarray = array('label'=> "Change Password",
                       'link' => base_url()."ChangePasskey"
                       );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);

      
          if (isset($_POST) && is_array($_POST) && count($_POST) > 0) {
            $user_id = $this->session->userdata('emp_id');
            $emp_id = $this->input->post('emp_id');
            $params = array('emp_id'=>$emp_id);
            $new_password = $this->input->post('new_password');
            $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $hashed_password = $hasher->HashPassword( $new_password);
            //update new password
            $formvalues['user_password'] = $hashed_password;
            $result = $this->common_model->updateRow('sg_users', $formvalues,$params);
            if($result !=''){
              $data['password_change_success'] = lang('password_change_success');
            }
        }
        $useremp_id = $this->session->userdata('emp_id'); 
        if($useremp_id == 1){
          $data['employees'] = $this->Common_model->getAllEmployees();
        }else{
          $data['employees'] = $this->Common_model->getEmployeesByAdminId($useremp_id);
        }
        
        $this->template->load_view('Resetpassword',$data);
    }

    /*
    * @Logout
    *
    * This is function will destroy the session
    * 
    * @return null
    */
    public function Logout(){

          $emp_id = $this->session->userdata('emp_id');
          $logtrackid = $this->session->userdata('logtrackid');
          $res = $this->Common_model->getEmpLog($emp_id);
          if($res){
             if($logtrackid == $res->logtrackid){

                 $params = array('log_id'=>$res->log_id);
                 $logdata['logout_time'] = date('Y-m-d H:i:s');                  
                 $result = $this->common_model->updateRow('emp_logs', $logdata, $params);
             }
          }
           $this->authentication->sign_out();
           redirect(base_url().'Login');
    }   
}