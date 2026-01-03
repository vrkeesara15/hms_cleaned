<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : ch.v.sudhakar9@gmail.com, phpguidance@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Formats 
 *  
 */
class Formats extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Formats_model');
        $this->load->language('Formats');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Formats",
                           'link' => base_url()."Formats"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Formats"); 
        $data['details']  = $this->Formats_model->getFormats();
        $data['bank_details'] = $this->Formats_model->get_bank_details();
        $data['getAllFormats'] = $this->Formats_model->getAllFormats();
       // $data['getFormatDocuments'] = $this->Formats_model->getFormatDocuments();
        $this->template->load_view('Formats',$data);        

    }
    public function addFormats() {      

         if($this->session->userdata('user_role') == '3'){
            redirect(base_url().'Dashboard'); 
        }
        
        $breadcrumbarray = array('label'=> "Formats",
                           'link' => base_url()."Formats"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Formats");
        $data['action'] = 'add';               
        $data['bank_details'] = $this->Formats_model->get_bank_details();   
        $this->template->load_view('Formats_add',$data);   
   
      }
        public function editEmpanelment($id="") {      
          if($this->session->userdata('user_role') == '3'){
            redirect(base_url().'Dashboard'); 
            }        
        $breadcrumbarray = array('label'=> "Formats",
                           'link' => base_url()."Formats"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Formats"); 
        $data['formatsdata'] = $this->Formats_model->getFormatsdata($id);   
        //$data['formatDocumentsData'] = $this->Formats_model->formatDocumentsData($id);   
        /*echo "<pre>";
        print_r($data['formatDocumentsData']); exit();*/
        $data['bank_details'] = $this->Formats_model->get_bank_details();  
        $data['action'] = 'edit';    
        $this->template->load_view('Formats_add',$data);        

    }
        
   public function insertFormats() { 

    if($_POST) {
        
        $bank_id  = $this->input->post('bank_id');
        $type_of_loan  = $this->input->post('type_of_loan');
        $doc_name  = $this->input->post('doc_name_1');
        $notes = $this->input->post('notes');
        $action  = $this->input->post('action');
        
        if($action == "add") {
           /* echo "<pre>";
            print_r($_POST);
            print_r($_FILES); 
            exit();*/
            
            $inserData = array(
                            'bank_id' => $bank_id,
                            'type_of_loan' => $type_of_loan,
                            'doc_name' => $doc_name,
                            'notes' => $notes,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
        
             $id = $this->Common_model->insertSingle('formats', $inserData);
             $format_id = $id;
            if(!empty($_FILES['format_doc_1']['name'])) {
              $format_doc_1 = $this->files_upload("assets/format_doc/",'*','format_doc_1',$id,'format_doc_1');
              $doc_name_1 = $this->input->post('doc_name_1');
              $updateData['format_doc'] = $format_doc_1;
              $param = array('format_id'=>$id);
              $this->Common_model->updateRow('formats',$updateData,$param);
              //$formatDocumentsInserData = array();
            //   $formatDocumentsInserData = array(
            //                 'format_id' => $format_id,
            //                 'doc_name' => $doc_name_1,
            //                 'format_doc' => $format_doc_1,
            //                 'inserted_by' => $this->session->userdata('emp_id'),
            //                 'inserted_date' => date('Y-m-d H:i:s'));
            //     $this->Common_model->insertSingle('format_documents', $formatDocumentsInserData);
        
            } else {
              $format_doc_1 = '';
              $doc_name_1 = '';
            }
            
            if(!empty($_FILES['format_doc_1_word']['name'])) {
              $format_doc_1_word = $this->files_upload("assets/format_doc/",'*','format_doc_1_word',$id,'format_doc_1_word');
              $updateData['format_word_doc'] = $format_doc_1_word;
              $param = array('format_id'=>$id);
              $this->Common_model->updateRow('formats',$updateData,$param);
              //$formatDocumentsInserData = array();
            //   $formatDocumentsInserData = array(
            //                 'format_id' => $format_id,
            //                 'doc_name' => $doc_name_1,
            //                 'format_doc' => $format_doc_1,
            //                 'inserted_by' => $this->session->userdata('emp_id'),
            //                 'inserted_date' => date('Y-m-d H:i:s'));
            //     $this->Common_model->insertSingle('format_documents', $formatDocumentsInserData);
        
            } else {
              $format_doc_1 = '';
              $doc_name_1 = '';
            }
            
            // if(!empty($_FILES['format_doc_2']['name'])) {
            //   $format_doc_2 = $this->files_upload("assets/format_doc/",'*','format_doc_2',$id,'format_doc_2');
            //   $doc_name_2 = $this->input->post('doc_name_2');
            //   $formatDocumentsInserData =array();
            //   $formatDocumentsInserData = array(
            //                 'format_id' => $format_id,
            //                 'doc_name' => $doc_name_2,
            //                 'format_doc' => $format_doc_2,
            //                 'inserted_by' => $this->session->userdata('emp_id'),
            //                 'inserted_date' => date('Y-m-d H:i:s'));
            //     $this->Common_model->insertSingle('format_documents', $formatDocumentsInserData);
            // } else {
            //   $format_doc_2 = '';
            //   $doc_name_2 = '';
            // }
            
            // if(!empty($_FILES['format_doc_3']['name'])) {
            //   $format_doc_3 = $this->files_upload("assets/format_doc/",'*','format_doc_3',$id,'format_doc_3');
            //   $doc_name_3 = $this->input->post('doc_name_3');
            //   $formatDocumentsInserData = array();
            //   $formatDocumentsInserData = array(
            //                 'format_id' => $format_id,
            //                 'doc_name' => $doc_name_3,
            //                 'format_doc' => $format_doc_3,
            //                 'inserted_by' => $this->session->userdata('emp_id'),
            //                 'inserted_date' => date('Y-m-d H:i:s'));
            //     $this->Common_model->insertSingle('format_documents', $formatDocumentsInserData);
            // } else {
            //   $format_doc_3 = '';
            //   $doc_name_3 = '';
            // }
            
            // if(!empty($_FILES['format_doc_4']['name'])) {
            //   $format_doc_4 = $this->files_upload("assets/format_doc/",'*','format_doc_4',$id,'format_doc_4');
            //   $doc_name_4 = $this->input->post('doc_name_4');
            //   $formatDocumentsInserData = array();
            //   $formatDocumentsInserData = array(
            //                 'format_id' => $format_id,
            //                 'doc_name' => $doc_name_4,
            //                 'format_doc' => $format_doc_4,
            //                 'inserted_by' => $this->session->userdata('emp_id'),
            //                 'inserted_date' => date('Y-m-d H:i:s'));
            //     $this->Common_model->insertSingle('format_documents', $formatDocumentsInserData);
            // } else {
            //   $format_doc_4 = '';
            //   $doc_name_4 = '';
            // }
            
            // if(!empty($_FILES['format_doc_5']['name'])) {
            //   $format_doc_5 = $this->files_upload("assets/format_doc/",'*','format_doc_5',$id,'format_doc_5');
            //   $doc_name_5 = $this->input->post('doc_name_5');
            //   $formatDocumentsInserData = array();
            //   $formatDocumentsInserData = array(
            //                 'format_id' => $format_id,
            //                 'doc_name' => $doc_name_5,
            //                 'format_doc' => $format_doc_5,
            //                 'inserted_by' => $this->session->userdata('emp_id'),
            //                 'inserted_date' => date('Y-m-d H:i:s'));
            //     $this->Common_model->insertSingle('format_documents', $formatDocumentsInserData);
            // } else {
            //   $format_doc_5 = '';
            //   $doc_name_5 = '';
            // }
            
            // if(!empty($_FILES['format_doc_6']['name'])) {
            //   $format_doc_6 = $this->files_upload("assets/format_doc/",'*','format_doc_6',$id,'format_doc_6');
            //   $doc_name_6 = $this->input->post('doc_name_6');
            //   $formatDocumentsInserData = array();
            //   $formatDocumentsInserData = array(
            //                 'format_id' => $format_id,
            //                 'doc_name' => $doc_name_6,
            //                 'format_doc' => $format_doc_6,
            //                 'inserted_by' => $this->session->userdata('emp_id'),
            //                 'inserted_date' => date('Y-m-d H:i:s'));
            //     $this->Common_model->insertSingle('format_documents', $formatDocumentsInserData);
            // } else {
            //   $format_doc_6 = '';
            //   $doc_name_6 = '';
            // }
            
            // if(!empty($_FILES['format_doc_7']['name'])) {
            //   $format_doc_7 = $this->files_upload("assets/format_doc/",'*','format_doc_7',$id,'format_doc_7');
            //   $doc_name_7 = $this->input->post('doc_name_7');
            //   $formatDocumentsInserData = array();
            //   $formatDocumentsInserData = array(
            //                 'format_id' => $format_id,
            //                 'doc_name' => $doc_name_7,
            //                 'format_doc' => $format_doc_7,
            //                 'inserted_by' => $this->session->userdata('emp_id'),
            //                 'inserted_date' => date('Y-m-d H:i:s'));
            //     $this->Common_model->insertSingle('format_documents', $formatDocumentsInserData);
            // } else {
            //   $format_doc_7 = '';
            //   $doc_name_7 = '';
            // }
            
            // if(!empty($_FILES['format_doc_8']['name'])) {
            //   $format_doc_8 = $this->files_upload("assets/format_doc/",'*','format_doc_8',$id,'format_doc_8');
            //   $doc_name_8 = $this->input->post('doc_name_8');
            //   $formatDocumentsInserData = array();
            //   $formatDocumentsInserData = array(
            //                 'format_id' => $format_id,
            //                 'doc_name' => $doc_name_8,
            //                 'format_doc' => $format_doc_8,
            //                 'inserted_by' => $this->session->userdata('emp_id'),
            //                 'inserted_date' => date('Y-m-d H:i:s'));
            //     $this->Common_model->insertSingle('format_documents', $formatDocumentsInserData);
            // } else {
            //   $format_doc_9 = '';
            //   $doc_name_8 = '';
            // }
            
            // if(!empty($_FILES['format_doc_9']['name'])) {
            //   $format_doc_9 = $this->files_upload("assets/format_doc/",'*','format_doc_9',$id,'format_doc_9');
            //   $doc_name_9 = $this->input->post('doc_name_9');
            //   $formatDocumentsInserData = array();
            //   $formatDocumentsInserData = array(
            //                 'format_id' => $format_id,
            //                 'doc_name' => $doc_name_9,
            //                 'format_doc' => $format_doc_9,
            //                 'inserted_by' => $this->session->userdata('emp_id'),
            //                 'inserted_date' => date('Y-m-d H:i:s'));
            //     $this->Common_model->insertSingle('format_documents', $formatDocumentsInserData);
            // } else {
            //   $format_doc_9 = '';
            //   $doc_name_9 = '';
            // }
            
            // if(!empty($_FILES['format_doc_10']['name'])) {
            //   $format_doc_10 = $this->files_upload("assets/format_doc/",'*','format_doc_10',$id,'format_doc_10');
            //   $doc_name_10 = $this->input->post('doc_name_10');
            //   $formatDocumentsInserData = array();
            //   $formatDocumentsInserData = array(
            //                 'format_id' => $format_id,
            //                 'doc_name' => $doc_name_10,
            //                 'format_doc' => $format_doc_10,
            //                 'inserted_by' => $this->session->userdata('emp_id'),
            //                 'inserted_date' => date('Y-m-d H:i:s'));
            //     $this->Common_model->insertSingle('format_documents', $formatDocumentsInserData);
            // } else {
            //   $format_doc_10 = '';
            //   $doc_name_10 = '';
            // }
            
            
        } else {
            $format_id = $this->input->post('format_id');
            $updateData['bank_id'] = $bank_id;
            $updateData['type_of_loan'] = $type_of_loan;
            $updateData['notes'] = $notes;
            $updateData['updated_by'] = $this->session->userdata('emp_id');
            $updateData['updated_date'] = date('Y-m-d H:i:s');
            $id = $format_id;
            $param = array('format_id'=>$format_id);
            $affectedRows = $this->Common_model->updateRow('formats',$updateData,$param);
            if(!empty($_FILES['format_doc_1']['name'])) {
                $format_doc_1 = $this->files_upload("assets/format_doc/",'*','format_doc_1',$id,'format_doc_1');
              $doc_name_1 = $this->input->post('doc_name_1');
              $updateData['format_doc'] = $format_doc_1;
              $param = array('format_id'=>$id);
              $this->Common_model->updateRow('formats',$updateData,$param);
              
            } 
            
             if(!empty($_FILES['format_doc_1_word']['name'])) {
              $format_doc_1_word = $this->files_upload("assets/format_doc/",'*','format_doc_1_word',$id,'format_doc_1_word');
              $updateData['format_word_doc'] = $format_doc_1_word;
              $param = array('format_id'=>$id);
              $this->Common_model->updateRow('formats',$updateData,$param);
        
            } else {
              $format_doc_1 = '';
              $doc_name_1 = '';
            }
            
            // if(!empty($_FILES['format_doc_2']['name'])) {
            //   $format_doc_2 = $this->files_upload("assets/format_doc/",'*','format_doc_2',$id,'format_doc_2');
            //   $format_doc_id_2 = $this->input->post('format_doc_id_2');
            //   $doc_name_2 = $this->input->post('doc_name_2');
            //   $formatDocumentsUpdateData = array();
            //   $formatDocumentsUpdateData = array(
            //                 'doc_name' => $doc_name_2,
            //                 'format_doc' => $format_doc_2,
            //                 'updated_by' => $this->session->userdata('emp_id'),
            //                 'updated_date' => date('Y-m-d H:i:s'));
            //     $param = array('format_doc_id'=>$format_doc_id_2);
            //   $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            // } else {
            //     if(!empty($this->input->post('doc_name_2'))) {
            //           $format_doc_id_2 = $this->input->post('format_doc_id_2');
            //           $doc_name_2 = $this->input->post('doc_name_2');
            //           $formatDocumentsUpdateData = array();
            //           $formatDocumentsUpdateData = array(
            //                         'doc_name' => $doc_name_2,
            //                         'updated_by' => $this->session->userdata('emp_id'),
            //                         'updated_date' => date('Y-m-d H:i:s'));
            //             $param = array('format_doc_id'=>$format_doc_id_2);
            //           $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            //     }
            // }
            
            // if(!empty($_FILES['format_doc_3']['name'])) {
            //   $format_doc_3 = $this->files_upload("assets/format_doc/",'*','format_doc_3',$id,'format_doc_3');
            //   $format_doc_id_3 = $this->input->post('format_doc_id_3');
            //   $doc_name_3 = $this->input->post('doc_name_3');
            //   $formatDocumentsUpdateData = array();
            //   $formatDocumentsUpdateData = array(
            //                 'doc_name' => $doc_name_3,
            //                 'format_doc' => $format_doc_3,
            //                 'updated_by' => $this->session->userdata('emp_id'),
            //                 'updated_date' => date('Y-m-d H:i:s'));
            //     $param = array('format_doc_id'=>$format_doc_id_3);
            //   $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            // } else {
            //     if(!empty($this->input->post('doc_name_3'))) {
            //           $format_doc_id_3 = $this->input->post('format_doc_id_3');
            //           $doc_name_3 = $this->input->post('doc_name_3');
            //           $formatDocumentsUpdateData = array();
            //           $formatDocumentsUpdateData = array(
            //                         'doc_name' => $doc_name_3,
            //                         'updated_by' => $this->session->userdata('emp_id'),
            //                         'updated_date' => date('Y-m-d H:i:s'));
            //             $param = array('format_doc_id'=>$format_doc_id_3);
            //           $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            //     }
            // }
            
            // if(!empty($_FILES['format_doc_4']['name'])) {
            //   $format_doc_4 = $this->files_upload("assets/format_doc/",'*','format_doc_4',$id,'format_doc_4');
            //   $format_doc_id_4 = $this->input->post('format_doc_id_4');
            //   $doc_name_4 = $this->input->post('doc_name_4');
            //   $formatDocumentsUpdateData = array();
            //   $formatDocumentsUpdateData = array(
            //                 'doc_name' => $doc_name_4,
            //                 'format_doc' => $format_doc_4,
            //                 'updated_by' => $this->session->userdata('emp_id'),
            //                 'updated_date' => date('Y-m-d H:i:s'));
            //     $param = array('format_doc_id'=>$format_doc_id_4);
            //   $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            // } else {
            //     if(!empty($this->input->post('doc_name_4'))) {
            //           $format_doc_id_4 = $this->input->post('format_doc_id_4');
            //           $doc_name_4 = $this->input->post('doc_name_4');
            //           $formatDocumentsUpdateData = array();
            //           $formatDocumentsUpdateData = array(
            //                         'doc_name' => $doc_name_4,
            //                         'updated_by' => $this->session->userdata('emp_id'),
            //                         'updated_date' => date('Y-m-d H:i:s'));
            //             $param = array('format_doc_id'=>$format_doc_id_4);
            //           $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            //     }
            // }
            
            // if(!empty($_FILES['format_doc_5']['name'])) {
            //   $format_doc_5 = $this->files_upload("assets/format_doc/",'*','format_doc_5',$id,'format_doc_5');
            //   $format_doc_id_5 = $this->input->post('format_doc_id_5');
            //   $doc_name_5 = $this->input->post('doc_name_5');
            //   $formatDocumentsUpdateData = array();
            //   $formatDocumentsUpdateData = array(
            //                 'doc_name' => $doc_name_5,
            //                 'format_doc' => $format_doc_5,
            //                 'updated_by' => $this->session->userdata('emp_id'),
            //                 'updated_date' => date('Y-m-d H:i:s'));
            //     $param = array('format_doc_id'=>$format_doc_id_5);
            //   $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            // } else {
            //     if(!empty($this->input->post('doc_name_5'))) {
            //           $format_doc_id_5 = $this->input->post('format_doc_id_5');
            //           $doc_name_5 = $this->input->post('doc_name_5');
            //           $formatDocumentsUpdateData = array();
            //           $formatDocumentsUpdateData = array(
            //                         'doc_name' => $doc_name_5,
            //                         'updated_by' => $this->session->userdata('emp_id'),
            //                         'updated_date' => date('Y-m-d H:i:s'));
            //             $param = array('format_doc_id'=>$format_doc_id_5);
            //           $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            //     }
            // }
            
            
            // if(!empty($_FILES['format_doc_6']['name'])) {
            //   $format_doc_6 = $this->files_upload("assets/format_doc/",'*','format_doc_6',$id,'format_doc_6');
            //   $format_doc_id_6 = $this->input->post('format_doc_id_6');
            //   $doc_name_6 = $this->input->post('doc_name_6');
            //   $formatDocumentsUpdateData = array();
            //   $formatDocumentsUpdateData = array(
            //                 'doc_name' => $doc_name_6,
            //                 'format_doc' => $format_doc_6,
            //                 'updated_by' => $this->session->userdata('emp_id'),
            //                 'updated_date' => date('Y-m-d H:i:s'));
            //     $param = array('format_doc_id'=>$format_doc_id_6);
            //   $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            // } else {
            //     if(!empty($this->input->post('doc_name_6'))) {
            //       $format_doc_id_6 = $this->input->post('format_doc_id_6');
            //       $doc_name_6 = $this->input->post('doc_name_6');
            //       $formatDocumentsUpdateData = array();
            //       $formatDocumentsUpdateData = array(
            //                     'doc_name' => $doc_name_6,
            //                     'updated_by' => $this->session->userdata('emp_id'),
            //                     'updated_date' => date('Y-m-d H:i:s'));
            //         $param = array('format_doc_id'=>$format_doc_id_6);
            //       $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            //     }
            // }
            
            // if(!empty($_FILES['format_doc_7']['name'])) {
            //   $format_doc_7 = $this->files_upload("assets/format_doc/",'*','format_doc_7',$id,'format_doc_7');
            //   $format_doc_id_7 = $this->input->post('format_doc_id_7');
            //   $doc_name_7 = $this->input->post('doc_name_7');
            //   $formatDocumentsUpdateData = array();
            //   $formatDocumentsUpdateData = array(
            //                 'doc_name' => $doc_name_7,
            //                 'format_doc' => $format_doc_7,
            //                 'updated_by' => $this->session->userdata('emp_id'),
            //                 'updated_date' => date('Y-m-d H:i:s'));
            //     $param = array('format_doc_id'=>$format_doc_id_7);
            //   $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            // } else {
            //     if(!empty($this->input->post('doc_name_7'))) {
            //       $format_doc_id_7 = $this->input->post('format_doc_id_7');
            //       $doc_name_7 = $this->input->post('doc_name_7');
            //       $formatDocumentsUpdateData = array();
            //       $formatDocumentsUpdateData = array(
            //                     'doc_name' => $doc_name_7,
            //                     'updated_by' => $this->session->userdata('emp_id'),
            //                     'updated_date' => date('Y-m-d H:i:s'));
            //         $param = array('format_doc_id'=>$format_doc_id_7);
            //       $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            //     }
            // }
            
            // if(!empty($_FILES['format_doc_8']['name'])) {
            //   $format_doc_8 = $this->files_upload("assets/format_doc/",'*','format_doc_8',$id,'format_doc_8');
            //   $format_doc_id_8 = $this->input->post('format_doc_id_8');
            //   $doc_name_8 = $this->input->post('doc_name_8');
            //   $formatDocumentsUpdateData = array();
            //   $formatDocumentsUpdateData = array(
            //                 'doc_name' => $doc_name_8,
            //                 'format_doc' => $format_doc_8,
            //                 'updated_by' => $this->session->userdata('emp_id'),
            //                 'updated_date' => date('Y-m-d H:i:s'));
            //     $param = array('format_doc_id'=>$format_doc_id_8);
            //   $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            // } else {
            //     if(!empty($this->input->post('doc_name_8'))) {
            //       $format_doc_id_8 = $this->input->post('format_doc_id_8');
            //       $doc_name_8 = $this->input->post('doc_name_8');
            //       $formatDocumentsUpdateData = array();
            //       $formatDocumentsUpdateData = array(
            //                     'doc_name' => $doc_name_8,
            //                     'updated_by' => $this->session->userdata('emp_id'),
            //                     'updated_date' => date('Y-m-d H:i:s'));
            //         $param = array('format_doc_id'=>$format_doc_id_8);
            //       $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            //     }
            // }
            
            // if(!empty($_FILES['format_doc_9']['name'])) {
            //   $format_doc_9 = $this->files_upload("assets/format_doc/",'*','format_doc_9',$id,'format_doc_9');
            //   $format_doc_id_9 = $this->input->post('format_doc_id_9');
            //   $doc_name_9 = $this->input->post('doc_name_9');
            //   $formatDocumentsUpdateData = array();
            //   $formatDocumentsUpdateData = array(
            //                 'doc_name' => $doc_name_9,
            //                 'format_doc' => $format_doc_9,
            //                 'updated_by' => $this->session->userdata('emp_id'),
            //                 'updated_date' => date('Y-m-d H:i:s'));
            //     $param = array('format_doc_id'=>$format_doc_id_9);
            //   $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            // } else {
            //     if(!empty($this->input->post('doc_name_9'))) {
            //       $format_doc_id_9 = $this->input->post('format_doc_id_9');
            //       $doc_name_9 = $this->input->post('doc_name_9');
            //       $formatDocumentsUpdateData = array();
            //       $formatDocumentsUpdateData = array(
            //                     'doc_name' => $doc_name_9,
            //                     'updated_by' => $this->session->userdata('emp_id'),
            //                     'updated_date' => date('Y-m-d H:i:s'));
            //         $param = array('format_doc_id'=>$format_doc_id_9);
            //       $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            //     }
            // }
            
            // if(!empty($_FILES['format_doc_10']['name'])) {
            //   $format_doc_10 = $this->files_upload("assets/format_doc/",'*','format_doc_10',$id,'format_doc_10');
            //   $format_doc_id_10 = $this->input->post('format_doc_id_10');
            //   $doc_name_10 = $this->input->post('doc_name_10');
            //   $formatDocumentsUpdateData = array();
            //   $formatDocumentsUpdateData = array(
            //                 'doc_name' => $doc_name_10,
            //                 'format_doc' => $format_doc_10,
            //                 'updated_by' => $this->session->userdata('emp_id'),
            //                 'updated_date' => date('Y-m-d H:i:s'));
            //     $param = array('format_doc_id'=>$format_doc_id_10);
            //   $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            // } else {
            
            // if(!empty($this->input->post('doc_name_10'))) {
            //   $format_doc_id_10 = $this->input->post('format_doc_id_10');
            //   $doc_name_10 = $this->input->post('doc_name_10');
            //   $formatDocumentsUpdateData = array();
            //   $formatDocumentsUpdateData = array(
            //                 'doc_name' => $doc_name_10,
            //                 'updated_by' => $this->session->userdata('emp_id'),
            //                 'updated_date' => date('Y-m-d H:i:s'));
            //     $param = array('format_doc_id'=>$format_doc_id_10);
            //   $affectedRows = $this->Common_model->updateRow('format_documents',$formatDocumentsUpdateData,$param);
            // }
            // }
            
            
             
        }
        
         $red=base_url()."Formats";
                redirect($red);
    }
  }

  function files_upload($upload_path,$allowed_types,$filename,$emp_id,$type) {
        $config = array();
        $config['upload_path'] = $upload_path; //../upload/adImages
        $config['allowed_types'] = $allowed_types; //
        // $config['max_size'] = '2000';
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
          $format_id = $this->input->post('format_id');
         $param = array('format_id'=>$format_id);
         $getdetails =  $this->Formats_model->getFormatsdata($format_id); 
         $getformatDocumentsData = $this->Formats_model->formatDocumentsData($format_id); 
         $this->Common_model->deleteRow('formats',$param);
         unlink("./assets/format_doc/".$getdetails->format_doc);
          $this->Common_model->deleteRow('format_documents',$param);
         foreach($getformatDocumentsData as $key=>$value) {
             //echo "format_doc_id->".$value->format_doc_id."-".$value->format_doc."<br />";
              unlink("./assets/format_doc/".$value->format_doc);
         }
    } 
     public function updateRecord(){       
                     
        /* $format_doc_id = $this->input->post('format_doc_id');
         
         $this->Common_model->deleteRow('formats',$param);
         
              $updateData['bank_id'] = $bank_id;
              $updateData['type_of_loan'] = $type_of_loan;
              $updateData['doc_name'] = $doc_name;
              $updateData['updated_by'] = $this->session->userdata('emp_id');
              $updateData['updated_date'] = date('Y-m-d H:i:s');
            $id = $format_id;
            if(!empty($_FILES['format_doc']['name'])) {
                $format_doc = $this->files_upload("assets/format_doc/",'*','format_doc',$id,'format_doc');
                $updateData['format_doc'] = $format_doc;
            }
            
             $param = array('format_doc_id'=>$format_doc_id);
             $affectedRows = $this->Common_model->updateRow('formats',$updateData,$param);*/
    }
    /*public function test() {
        for($i=0;$i<=72;$i++) {
         $getformatDocumentsData = $this->Formats_model->formatDocumentsData($i);
         foreach($getformatDocumentsData as $key=>$value) {
             $param = array('format_id'=>$value->format_id);
             $this->Common_model->deleteRow('format_documents',$param);
            unlink("./assets/format_doc/".$value->format_doc);
             echo "format_doc_id->".$value->format_doc_id."-".$value->format_doc."<br />";
         }
        }

    }*/
    
   
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
