<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * Project : Admin Panel
 * Version v1.0
 * Controller : Allbanks 
 *  
 */
class Allbanks extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Allbanks_model');
        $this->load->language('Allbanks');
        $this->load->library('pagination');         
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Allbanks",
                           'link' => base_url()."Allbanks"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Allbanks"); 
        $data['details']  = $this->Allbanks_model->getAllbanks();
        $this->template->load_view('Allbanks',$data);    
    }
    public function addAllbanks() {    
        if($this->session->userdata('user_role') != '1'){
            redirect(base_url().'Dashboard'); 
        }        
        $breadcrumbarray = array('label'=> "Allbanks",
                           'link' => base_url()."Allbanks"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Add Bank");
        $data['action'] = 'add';               
        $data['charges'] = '';
        $this->template->load_view('Allbanks_add',$data);      
    }
    public function editBank($id="") {      
          if($this->session->userdata('user_role') != '1'){
            redirect(base_url().'Dashboard'); 
            }        
        $breadcrumbarray = array('label'=> "Allbanks",
                           'link' => base_url()."Allbanks"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Allbanks"); 
        $data['charges'] = $this->Allbanks_model->getBankCharges($id);   
        $data['bankdata'] = $this->Allbanks_model->get_bank_details($id);  
        $data['action'] = 'edit';    
        $this->template->load_view('Allbanks_add',$data);        

    }
        
   public function insertAllbanks() {
    if($_POST) {        
        $bank_name  = $this->input->post('bank_name');
        $address = $this->input->post('address');
        $notes = $this->input->post('notes');
        $action  = $this->input->post('action');        
        if($action == "add") {
            $inserData = array(
                            'bank_name' => $bank_name,
                            'address' => $address,
                            'notes' => $notes,
                            'inserted_by' => $this->session->userdata('adminuser_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
        
            $res = $this->Common_model->insertSingle('allbanks', $inserData);

            if($res){
                if(!empty($_FILES['bank_logo']['name'])) {
                    $bank_logo = $this->files_upload("assets/banks/",'*','bank_logo',$res,'bank_logo');
                     
                    $updatedata['bank_logo'] = $bank_logo;  
    
                    $updateParam = array('bank_id'=>$res);
                    $this->Common_model->updateRow('allbanks',$updatedata,$updateParam);
                }
                
                 //    $total_rows = $this->input->post('totalrows');
                     $bank_id = $res;
                //   for($i=1;$i<=$total_rows;$i++){
                //         $chargesdata = array();
                //         $chargesdata['bank_id'] = $bank_id;
                //         $chargesdata['charge_name'] = $this->input->post('charge_name'.$i);
                //         $chargesdata['charge_amount'] = $this->input->post('charge_amount'.$i);
                //         $chargesdata['inserted_by'] = $this->session->userdata('adminuser_id');
                //         $chargesdata['inserted_date'] = date('Y-m-d H:i:s');
                //         $res1 = $this->Common_model->insertSingle('bank_charges', $chargesdata);
                //     }  
            }

        } else {
            $bank_id = $this->input->post('bank_id');
            $updateData['bank_name'] = $bank_name;
            $updateData['address'] = $address;
            $updateData['notes'] = $notes;
            $id = $bank_id;
            $param = array('bank_id'=>$bank_id);
            if(!empty($_FILES['bank_logo']['name'])) {
                $bank_logo = $this->files_upload("assets/banks/",'*','bank_logo',$id,'bank_logo');
                $updateData['bank_logo'] = $bank_logo;
            }
            $affectedRows = $this->Common_model->updateRow('allbanks',$updateData,$param);

            $param = array('bank_id'=>$bank_id);
            // $res = $this->Common_model->deleteRow('bank_charges',$param);

           
                // $total_rows = $this->input->post('totalrows');
                     
                //   for($i=1;$i<=$total_rows;$i++){
                //         $chargesdata = array();
                //         $chargesdata['bank_id'] = $bank_id;
                //         $chargesdata['charge_name'] = $this->input->post('charge_name'.$i);
                //         $chargesdata['charge_amount'] = $this->input->post('charge_amount'.$i);
                //         $chargesdata['inserted_by'] = $this->session->userdata('adminuser_id');
                //         $chargesdata['inserted_date'] = date('Y-m-d H:i:s');
                //         $res1 = $this->Common_model->insertSingle('bank_charges', $chargesdata);
                //     } 


        }        
        $red=base_url()."Allbanks";
        redirect($red);
    }
    }
    
    function files_upload($upload_path,$allowed_types,$filename,$emp_id,$type) {
        $config = array();
        $config['upload_path'] = $upload_path; //../upload/adImages
        $config['allowed_types'] = $allowed_types; //
        
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!empty($_FILES[$filename]['name'])) {
            $name = $_FILES[$filename]['name'];
            $file_ext = explode('.',$name);
            $ext = end($file_ext);
             $new_file_name = $emp_id.'_'.$type.'_'.time().'.'.$ext;
             $_FILES['file']['name'] = $new_file_name;
             $_FILES['file']['type'] = $_FILES[$filename]['type'];
             $_FILES['file']['tmp_name'] = $_FILES[$filename]['tmp_name'];
             $_FILES['file']['error'] = $_FILES[$filename]['error'];
             $_FILES['file']['size'] = $_FILES[$filename]['size'];
             if($this->upload->do_upload('file')){
               $uploadData = $this->upload->data();
               $return_file_name = $uploadData['file_name'];
               return $uploadData['file_name'];
             } else {
               $error = array('error' => $this->upload->display_errors());
               return false;
             }
        } else {
            return false;
        }
  }
    public function delete(){       
        if($this->session->userdata('user_role') != '1'){
                redirect(base_url().'Dashboard'); 
        }              
         $bank_id = $this->input->post('bank_id');
         $param = array('bank_id'=>$bank_id);
         $this->Common_model->deleteRow('allbanks',$param);         
    } 

}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
