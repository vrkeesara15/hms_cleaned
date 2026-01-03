<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Project : Admin Panel
 * Version v1.0
 * Controller : Company Assets 
 *  
 */
class CompanyAssets extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('CompanyAssets_model');
        $this->load->model('Common_model');
        $this->load->language('CompanyAssets');
        $this->load->library('pagination');
        $this->load->helper('phpass');   
    }    
    public function index() { 
        if($_POST) {
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
        } else {
            $start_date = '';
            $end_date = '';
        }
        
        $fields = array();
        $fields['start_date'] = $start_date;
        $fields['end_date'] = $end_date;
        $breadcrumbarray = array('label'=> "Company Assets",
                           'link' => base_url()."CompanyAssets"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Company Assets");  
        $data["CompanyAssets"] = $this->CompanyAssets_model->getAllCompanyAssets($fields);
        
        $data['page'] = $page;
        
        $this->template->load_view('CompanyAssets', $data);
    }
    public function add($id=""){
        $breadcrumbarray = array('label'=> "Company Assets",
                           'link' => base_url()."CompanyAssets"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Company Assets"); 
        if($id != ""){
            $data['action'] = 'edit';
            $data['companyAssetsData'] = $this->Common_model->getSingleRow('company_assets',array('company_asset_id'=>$id));
        }else{
            $data['action'] = 'add';
        }

        /**/
        if($_POST){
            $action = $this->input->post('action');
            if($action == 'edit'){
                $insertData['name'] = $this->input->post('name');
                $insertData['amount'] = $this->input->post('amount');
                $insertData['bill_type'] = $this->input->post('bill_type');
                $insertData['purchase_date'] = $this->input->post('purchase_date');
                $insertData['warranty_expiry_date'] = $this->input->post('warranty_expiry_date');
                $insertData['description'] = $this->input->post('description');
                $insertData['contact_details'] = $this->input->post('contact_details');
                $insertData['updated_by'] = $this->session->userdata('emp_id');
                $insertData['updated_date'] = date('Y-m-d H:i:s');
                $company_asset_id = $this->input->post('company_asset_id');
                $updateParam = array('company_asset_id'=>$company_asset_id);
                $res = $company_asset_id;
                $this->Common_model->updateRow('company_assets', $insertData,$updateParam);
                
            }else{
                $insertData['name'] = $this->input->post('name');
                $insertData['amount'] = $this->input->post('amount');
                $insertData['bill_type'] = $this->input->post('bill_type');
                $insertData['purchase_date'] = $this->input->post('purchase_date');
                $insertData['warranty_expiry_date'] = $this->input->post('warranty_expiry_date');
                $insertData['description'] = $this->input->post('description');
                $insertData['contact_details'] = $this->input->post('contact_details');
                $insertData['created_by'] = $this->session->userdata('emp_id');
                $insertData['created_date'] = date('Y-m-d H:i:s');
                $insertData['updated_by'] = $this->session->userdata('emp_id');
                $insertData['updated_date'] = date('Y-m-d H:i:s');
                $res = $this->Common_model->insertSingle('company_assets', $insertData);
            }
            
            

            if($res){
                if(!empty($_FILES['bill_file']['name'])) {
                   $bill_file = $this->files_upload("assets/CompanyAssets/",'*','bill_file',$res);
                   $updateData['bill_file'] = $bill_file;
                   $param = array('company_asset_id'=>$res);
                    $affectedRows = $this->Common_model->updateRow('company_assets',$updateData,$param);
                    
                    redirect(base_url().'CompanyAssets');
                }else{
                    redirect(base_url().'CompanyAssets');
                }
            }
            
            
        }else{
         $this->template->load_view('add', $data);   
        }
        
        
        

    }

    function files_upload($upload_path,$allowed_types,$filename,$receipt_id) {
        $config = array();
        $config['upload_path'] = $upload_path; 
        $config['allowed_types'] = $allowed_types; //
        // $config['max_size'] = '2000';
        
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!empty($_FILES[$filename]['name'])) {
            $name = $_FILES[$filename]['name'];
            $file_ext = explode('.',$name);
            $ext = end($file_ext);
             $new_file_name = $receipt_id.'_receipt_'.time().'.'.$ext;

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
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
