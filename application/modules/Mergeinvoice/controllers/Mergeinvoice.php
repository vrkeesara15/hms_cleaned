<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mergeinvoice extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Mergeinvoice_model');
        $this->load->language('Mergeinvoice');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Mergeinvoice",
                           'link' => base_url()."Mergeinvoice"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Mergeinvoice"); 
        
        $data['details']  = $this->Mergeinvoice_model->getMergeInvoicesList();
        $this->template->load_view('Mergeinvoice',$data);        

    }
    public function addMergeinvoice() {      
        
        $breadcrumbarray = array('label'=> "Mergeinvoice",
                           'link' => base_url()."Mergeinvoice"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Mergeinvoice");
        $data['action'] = 'add';               
        $data['banks'] = $this->Mergeinvoice_model->getAllbanks();   
        $data['states'] = $this->Mergeinvoice_model->getAllstates(); 
        $data['invoiceIds'] = $this->Mergeinvoice_model->getInvoiceids();
        $editEmployee = array_column($data['invoiceIds'], 'id');
        $separator = "', '";
        $string = implode($separator, $editEmployee);
        $data['invoiceIdsforScript'] = "['".$string."']";
        $this->template->load_view('Mergeinvoice_add',$data);   
   
     }
    
        
   public function insertMergeinvoice() {

    if($_POST) {
        
        $invoice_ids  = $this->input->post('invoice_id');
        
        $invoiceIdsArray = array();
        foreach($invoice_ids as $invoice){
            $tempInvoice = explode("_", $invoice);
            array_push($invoiceIdsArray,$tempInvoice[0]);
        }
        $invoiceIds = implode(",", $invoiceIdsArray);
        
        if(!empty($invoiceIds)){
            $loanAccounts = $this->Mergeinvoice_model->getLoanAccountsInfo($invoiceIds);
        }
        $newLoanAccountArray = array();
        if(!empty($loanAccounts)){
            $newLoanAccountArray['bank_id'] = $loanAccounts[0]->bank_id;
            $newLoanAccountArray['branch_id'] = $loanAccounts[0]->branch_id;
            $newLoanAccountArray['type_id'] = $loanAccounts[0]->type_id;
            $newLoanAccountArray['emp_id'] = $loanAccounts[0]->emp_id;
            $newLoanAccountArray['status'] = $loanAccounts[0]->status;
            $newLoanAccountArray['inserted_by'] = $this->session->userdata('emp_id');
            $newLoanAccountArray['inserted_date'] = date('Y-m-d H:i:s');
            $loan_account_id = "";
            $borrower_name = "";
            foreach($loanAccounts as $loanAccount){
                if($loan_account_id == ""){
                    $loan_account_id = $loanAccount->loan_ac_number;
                    $borrower_name = $loanAccount->barrower_name;
                }else{
                    $loan_account_id .= ",".$loanAccount->loan_ac_number;
                    $borrower_name .= ",".$loanAccount->barrower_name;
                }
            }
            $newLoanAccountArray['loan_ac_number'] = $loan_account_id;
            $newLoanAccountArray['barrower_name'] = $borrower_name;
            
            $res = $this->Common_model->insertSingle('Loanaccounts', $newLoanAccountArray);
            $newInvoiceData['loan_id'] = $res;
            $invoiceDetailsNew = $this->Common_model->getSingleRow('invoice',array('id'=>$invoiceIdsArray[0]));
            
            $newInvoiceData['bill_date'] = $invoiceDetailsNew->bill_date;
            $newInvoiceData['order_id'] = $invoiceDetailsNew->order_id;
            $newInvoiceData['gst_no'] = $invoiceDetailsNew->gst_no;
            $newInvoiceData['account'] = $loan_account_id;
            $newInvoiceData['loan_type_id'] = $invoiceDetailsNew->loan_type_id;
            $newInvoiceData['recovery_type'] = $invoiceDetailsNew->recovery_type;
            $newInvoiceData['invoice_type'] = $invoiceDetailsNew->invoice_type;
            $newInvoiceData['notes'] = $invoiceDetailsNew->notes;
            $newInvoiceData['emp_id'] = $invoiceDetailsNew->emp_id; 
            $newInvoiceData['manual_invoice'] = 'y';
            $newInvoiceData['recovery_type'] = $invoiceDetailsNew->recovery_type;
            $newInvoiceData['inserted_by'] = $invoiceDetailsNew->inserted_by;
            $newInvoiceData['inserted_date'] = date('Y-m-d H:i:s');  
            
            
            $newInvoiceId = $this->Common_model->insertSingle('invoice', $newInvoiceData);
            
            foreach($invoiceIdsArray as $oldinvoiceId){
                $mergedData['new_invoice_id'] = $newInvoiceId;
                $mergedData['old_invoice_id'] = $oldinvoiceId;
                
                $this->Common_model->insertSingle('merged_invoices', $mergedData);
                $updateOldInvoice['invoice_status'] = 'm';
                $updateParam = array('id'=>$oldinvoiceId);
                $this->Common_model->updateRow('invoice', $updateOldInvoice,$updateParam);
                
                $oldInvoiceServices = $this->Common_model->get_result('invoice_services',array(),array('invoice_id'=>$oldinvoiceId));
                
                foreach($oldInvoiceServices as $oldInvoiceService){
                    
                    $insertServiceData = array();
                    $insertServiceData['invoice_id'] = $newInvoiceId;
                    $insertServiceData['line_id'] = $oldInvoiceService->line_id;
                    $insertServiceData['borrower_name'] = $oldInvoiceService->borrower_name;
                    $insertServiceData['recovered_amt'] = $oldInvoiceService->recovered_amt;
                    $insertServiceData['date'] = $oldInvoiceService->date;
                    $insertServiceData['commission_charges'] = $oldInvoiceService->commission_charges;
                    $insertServiceData['gst_p'] = $oldInvoiceService->gst_p;
                    $insertServiceData['cgst_p'] = $oldInvoiceService->cgst_p;
                    $insertServiceData['gst'] = $oldInvoiceService->gst;
                    $insertServiceData['cgst'] = $oldInvoiceService->cgst;
                    $insertServiceData['total'] = $oldInvoiceService->total;
                    
                    $this->Common_model->insertSingle('invoice_services', $insertServiceData);
                    
                }
                
                $oldInvoiceFiles = $this->Common_model->get_result('invoice_files',array(),array('invocie_id'=>$oldinvoiceId));
                foreach($oldInvoiceFiles as $oldInvoiceFile){
                    $insertFileData = array();
                    $insertFileData['invocie_id'] = $newInvoiceId;
                    $insertFileData['file_name'] = $oldInvoiceFile->file_name;
                    $insertFileData['display_name'] = $oldInvoiceFile->display_name;
                    $insertFileData['type'] = $oldInvoiceFile->type;
                    $insertFileData['inserted_by'] = $oldInvoiceFile->inserted_by;
                    $insertFileData['inserted_date'] = $oldInvoiceFile->inserted_date;
                    $insertFileData['updated_by'] = $oldInvoiceFile->updated_by;
                    $insertFileData['updated_date'] = $oldInvoiceFile->updated_date;
                    $this->Common_model->insertSingle('invoice_files', $insertFileData);
                }
            }
        }
        
        $red=base_url()."Mergeinvoice";
        redirect($red);
    }
  }
  
    public function getBranchas(){
        $bank_id = $this->input->post('bank_id');

        $branchs =  $this->Mergeinvoice_model->getBankBrancheNames($bank_id);
        header('Content-type: application/json');
        die( json_encode( $branchs ) );  
    }
    
    public function getInvoices(){
        $gst_no = $this->input->post('gst_no');

        $invoices =  $this->Mergeinvoice_model->getInvoiceidsByGst($gst_no);
        header('Content-type: application/json');
        die( json_encode( $invoices ) );  
    }

}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
