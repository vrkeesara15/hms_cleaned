<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Challagulla Venkata Sudhakar
 * Email : ch.v.sudhakar9@gmail.com, phpguidance@gmail.com
 * Project : Admin Panel
 * Version v1.0
 * Controller : Invoice  
 *  
 */
class Invoice extends MY_Controller {

    public function __construct(){
        parent::__construct();
         if(!$this->authentication->checklogin()){
          redirect(base_url().'Login');
        }        
        $this->load->library(array('template','form_validation'));
        $this->template->set_title('Welcome');
        $this->load->model('Invoice_model');
        $this->load->language('Invoice');
        $this->load->library('pagination');
         $this->load->helper('phpass');   
    }    
    public function index() {      
        $breadcrumbarray = array('label'=> "Invoice",
                           'link' => base_url()."Invoice"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Invoice"); 

                $config['base_url'] = base_url().'/Invoice/';
                $config["total_rows"] = $this->Invoice_model->getInvoicesCounts();
                $config["per_page"] = 10;
                $config["uri_segment"] = 2;
                $config['full_tag_open'] = '<ul class="pagination justify-content-end mb-0 mt-3">';
                $config['full_tag_close'] = '</ul>';
                $config['first_link'] = true;
                $config['last_link'] = true;
                $config['last_link'] = 'last';
                $config['first_link'] = 'first';
                $config['first_tag_open'] = '<li class="page-item">';
                $config['first_tag_close'] = '</li>';
                $config['prev_link'] = 'Previous';
                $config['prev_tag_open'] = '<li class="prev">';
                $config['prev_tag_close'] = '</li>';
                $config['next_link'] = 'Next';
                $config['next_tag_open'] = '<li class="page-item">';
                $config['next_tag_close'] = '</li>';
                $config['last_tag_open'] = '<li class="page-item">';
                $config['last_tag_close'] = '</li>';
                $config['cur_tag_open'] =  '<li  class="page-item  active"><a class="page-link"  href="#">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li class="page-item">';
                $config['num_tag_close'] = '</li>';
                $this->pagination->initialize($config);
                $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $data["details"] = $this->Invoice_model->getInvoices($config["per_page"], $page);
                $data['page'] = $page;
                $data["links"] = $this->pagination->create_links();
            if($_POST){           
                $this->load->view('Invoices_ajax', $data);
            }else {
                $this->template->load_view('Invoices', $data);
            }    

    }
    public function addInvoices($invoice_id = ""){
        $breadcrumbarray = array('label'=> "Invoices",
                           'link' => base_url()."Invoices"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Invoices");
        if($invoice_id != ''){
            $data['action'] = 'edit';
            $data['invoiceData'] = $this->Common_model->getSingleRow('invoice',array('id'=>$invoice_id));
            $data['invoiceServices'] = $this->Common_model->getResult('invoice_services',array('invoice_id'=>$invoice_id));
            $data['loanaccounts'] = $this->Invoice_model->getLoanaccounts($data['invoiceData']->invoice_type,$data['invoiceData']->order_id);

        }else{
            $data['action'] = 'add';
        } 

        $data['loanaccounts'] = $this->Common_model->get_result('Loanaccounts',array('loan_id,branch_controller,loan_ac_number,barrower_name'));
        $data['workorders'] = $this->Invoice_model->getWorkOrders();                          
        $this->template->load_view('Invoice_add',$data);  
    }

    public function manualInvoices($invoice_id = ""){
        $breadcrumbarray = array('label'=> "Invoices",
                           'link' => base_url()."Invoices"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Invoices");

        $data['banks'] = $this->Common_model->get_result('allbanks'); 
        $data['loantypes'] = $this->Common_model->getResult('loantypes',array('status'=>'1'));
        if($invoice_id != ''){
            $data['action'] = 'edit';
            $data['invoiceData'] = $this->Common_model->getSingleRow('invoice',array('id'=>$invoice_id));
            $data['invoiceServices'] = $this->Common_model->getResult('invoice_services',array('invoice_id'=>$invoice_id));
            $data['loanaccounts'] = $this->Invoice_model->getLoanaccounts($data['invoiceData']->invoice_type,$data['invoiceData']->order_id);
            $gstsdata = $this->Common_model->getSingleRow('gsts',array('gst_no'=>$data['invoiceData']->gst_no));
            $data['loanAccountData'] = $this->Common_model->getSingleRow('Loanaccounts',array('loan_id'=>$data['invoiceData']->loan_id));
            $data['gstsdata'] = $gstsdata;
            $data['branchs'] = $this->Invoice_model->getBankBranchesNew($gstsdata->bank_id,$gstsdata->state_id);
            $data['getLineTypes'] = $this->Invoice_model->getLineTypes($data['invoiceData']->invoice_type); 
            $data['getInvFiles'] = $this->Invoice_model->getInvFiles($invoice_id);
        }else{
            $data['action'] = 'add';
        } 

        $data['loanaccounts'] = $this->Common_model->get_result('Loanaccounts',array('loan_id,branch_controller,loan_ac_number,barrower_name'));
        $data['workorders'] = $this->Invoice_model->getWorkOrders();  
        $getLineTypes_NC = $this->Invoice_model->getLineTypes('1');  
        $getLineTypes_INV = $this->Invoice_model->getLineTypes('2');  

        if(!empty($getLineTypes_NC)){
            $data['notice_charges_array'] = array_combine(array_column($getLineTypes_NC, 'linetype_id'), array_column($getLineTypes_NC, 'linetype_name'));

        }else{
            $data['notice_charges_array'] = array();
        }
        if(!empty($getLineTypes_INV)){
            $data['invocie_array'] = array_combine(array_column($getLineTypes_INV, 'linetype_id'), array_column($getLineTypes_INV, 'linetype_name'));
        }else{
            $data['invocie_array'] = array();
       
        }
        $getLoanAccountsAll = $this->Invoice_model->getLoanAccountsAll();  
        $all_loan_accounts = "";
        foreach ($getLoanAccountsAll as $key => $value) {
            $all_loan_accounts .= "\"".$value->loan_ac_number."\",";
        }
        $data['all_loan_accounts'] = $all_loan_accounts;
       
        $this->template->load_view('Invoice_manual',$data);  
    }


    public function getBankCharges(){
        if($_POST){
        $order_id = $this->input->post('order_id');
        $data['charges'] =  $this->Invoice_model->getBankCharges($order_id);
        $this->load->view('charges_ajax',$data);  
     }else {
        echo "0";
     }

    }
    public function getLoanaccounts(){
         $invoice_type = $this->input->post('invoice_type');
         $order_id = $this->input->post('order_id');
        $orders =  $this->Invoice_model->getLoanaccounts($invoice_type,$order_id);
        header('Content-type: application/json');
        die( json_encode( $orders ) );  
    }
    public function getLoanaccounts_loans(){
         $invoice_type = $this->input->post('invoice_type');
         $loan_type_id = $this->input->post('loan_type_id');
        $orders =  $this->Invoice_model->getLoanaccounts_loans($invoice_type,$loan_type_id);
        header('Content-type: application/json');
        die( json_encode( $orders ) );  
    }

    

    public function getLoanaccountsDetails(){
        $loan_id = $this->input->post('loan_id');
        $orders =  $this->Invoice_model->getLoanaccountsDetails($loan_id);
        header('Content-type: application/json');
        die( json_encode( $orders ) ); 
    }
    public  function getVendorId()
    {
        $loan_id = $this->input->post('loan_id');
        $orders =  $this->Invoice_model->getVendorBankDetails($loan_id);
        $bank_id = $orders->bank_id;
        $state_id = $orders->state_id;
        $vendordetails =  $this->Common_model->getVendorId($bank_id,$state_id);
        header('Content-type: application/json');
        die( json_encode( $vendordetails ) ); 
    }
    
    public function getParkingDays(){
             $loan_id = $this->input->post('loan_id');
             $status = $this->input->post('status');
             $data = calculateParkingDays($loan_id, $status);
            return $data;
    }

    public function insertInvoice(){
        if($_POST){


            $action = $this->input->post('action');
            if($action == 'add'){
                $insertData['bill_date'] = $this->input->post('bill_date');
                $insertData['order_id'] = $this->input->post('order_id');
                // $insertData['from_address'] = $this->input->post('from_address');
                // $insertData['to_address'] = $this->input->post('to_address');
                $insertData['gst_no'] = $this->input->post('gst_no');
                $insertData['vendor_no'] = $this->input->post('vendor_no');
                $insertData['account'] = $this->input->post('account');
                $insertData['loan_id'] = $this->input->post('loan_id');
                $insertData['invoice_type'] = $this->input->post('invoice_type');
                $insertData['emp_id'] = $this->session->userdata('emp_id'); 
                $insertData['inserted_by'] = $this->session->userdata('emp_id');
                $insertData['inserted_date'] = date('Y-m-d H:i:s');               
                
                $res1 = $this->Common_model->insertSingle('invoice', $insertData);
                if($res1){
                    $total_rows = $this->input->post('totalrows');
                     $invoice_id = $res1;
                    for($i=1;$i<=$total_rows;$i++){
                        $insertServiceData = array();
                        $insertServiceData['invoice_id'] = $invoice_id;
                        $insertServiceData['borrower_name'] = $this->input->post('borrower_name'.$i);
                        $insertServiceData['recovered_amt'] = $this->input->post('recovered_amt'.$i);
                        $insertServiceData['date'] = $this->input->post('date'.$i);
                        $insertServiceData['commission_charges'] = $this->input->post('commission_charges'.$i);
                         $insertServiceData['gst_p'] = $this->input->post('gst_p'.$i);
                        $insertServiceData['gst'] = $this->input->post('gstamount'.$i);
                        $insertServiceData['total'] = $this->input->post('total_amount'.$i);
                        $res = $this->Common_model->insertSingle('invoice_services', $insertServiceData);
                    }    
                    $this->invoice_generatepdf($res1);
                }
                
            }else{
                $invoice_id = $this->input->post('invoice_id');
                $updateData['bill_date'] = $this->input->post('bill_date');
                $updateData['order_id'] = $this->input->post('order_id');
                // $updateData['from_address'] = $this->input->post('from_address');
                // $updateData['to_address'] = $this->input->post('to_address');
                $updateData['gst_no'] = $this->input->post('gst_no');
                $updateData['vendor_no'] = $this->input->post('vendor_no');
                $updateData['account'] = $this->input->post('account');
                $updateData['loan_id'] = $this->input->post('loan_id');
                $updateData['invoice_type'] = $this->input->post('invoice_type');
                $updateData['emp_id'] = $this->session->userdata('emp_id'); 
                
                $updateData['updated_by'] = $this->session->userdata('emp_id');
                $updateData['updated_date'] = date('Y-m-d H:i:s');
                
                $updateParam = array('id'=>$invoice_id);
                $res = $this->Common_model->updateRow('invoice', $updateData,$updateParam);
              //  echo $this->db->last_query();exit;
                if($res){
                    $deleteParam = array('invoice_id'=>$invoice_id);
                    $this->Common_model->deleteRow('invoice_services',$deleteParam);

                    $total_rows = $this->input->post('totalrows');
                    for($i=1;$i<=$total_rows;$i++){
                        $insertServiceData = array();
                        $insertServiceData['invoice_id'] = $invoice_id;
                        $insertServiceData['borrower_name'] = $this->input->post('borrower_name'.$i);
                        $insertServiceData['recovered_amt'] = $this->input->post('recovered_amt'.$i);
                        $insertServiceData['date'] = $this->input->post('date'.$i);
                        $insertServiceData['commission_charges'] = $this->input->post('commission_charges'.$i);
                        $insertServiceData['gst_p'] = $this->input->post('gst_p'.$i);
                        $insertServiceData['gst'] = $this->input->post('gstamount'.$i);
                        $insertServiceData['total'] = $this->input->post('total_amount'.$i);
                        $res = $this->Common_model->insertSingle('invoice_services', $insertServiceData);
                    }    
                }
                $this->invoice_generatepdf($invoice_id);
            }

            //update work order status

            $invoice_type = $this->input->post('invoice_type');
            if($invoice_type =='2'){
                $loan_id = $this->input->post('loan_id');
                $update_values['status'] = 'c';
                $updateParam = array('loan_id'=>$loan_id);
                $this->Common_model->updateRow('Loanaccounts',$update_values,$updateParam);
            }
            
            redirect(base_url().'Invoice');
        }
    }

     
    
     public function dompdf($invoice_id){
     

            //  echo $invoice_id;exit;
        $data['invoice_details']  = $this->Invoice_model->getInvoiceDetails($invoice_id);
        $data['bankdetails']  = $this->Invoice_model->getInvoiceBankDetails($invoice_id);
        
        $invoice_pdf=  $this->load->view('pdf_demo',$data);

        $html = $this->output->get_output();
        $this->load->library('Pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', '');
        $this->dompdf->render();
        
        $pdfFilePath = "invoice_demo-".$invoice_id.'-'.date('d-m-Y');
      // echo $filename;
      $this->dompdf->stream($pdfFilePath,array('Attachment' => 0));

      file_put_contents('assets/invoices/demo/'.$pdfFilePath.'.pdf', $this->dompdf->output());



       // echo $invoice_pdf; exit();
        // $pdfFilePath = "invoice-".$invoice_id.'-'.date('d-m-Y').".pdf";

        // $update_values['pdf_file'] = $pdfFilePath;
        // $updateParam = array('id'=>$invoice_id);
        // $this->Common_model->updateRow('invoice',$update_values,$updateParam);

        //     require_once "application/vendor/autoload.php";
        //     $mpdf = new \Mpdf\Mpdf();
        //     $mpdf->WriteHTML($invoice_pdf);
        //     $mpdf->Output('assets/invoices/demo/'.$pdfFilePath, "F");

    }
     public function invoice_generatepdf_view($invoice_id){
       // echo $invoice_id;exit;
        $invoice_details = $this->Invoice_model->getInvoiceDetails($invoice_id);
        $data['invoice_details']  = $invoice_details;
        $data['bankdetails']  = $this->Invoice_model->getInvoiceBankDetails($invoice_id);
        $loanTypesDetails  = (array)$this->Invoice_model->getLoanTypesDetails();
        $loanDetails = array_combine(array_column($loanTypesDetails, 'type_id'),array_column($loanTypesDetails, 'type_name'));
        $data['loanDetails'] = $loanDetails[$invoice_details[0]->loan_type_id];
         $this->load->view('pdf-demo1',$data);



            // echo $invoice_id;exit;
       //  $data['invoice_details']  = $this->Invoice_model->getInvoiceDetails($invoice_id);
       //  $data['bankdetails']  = $this->Invoice_model->getInvoiceBankDetails($invoice_id);
        
       //  $invoice_pdf=  $this->load->view('pdf-demo1',$data,true);
       // // echo $invoice_pdf; exit();
       //  $pdfFilePath = "invoice-d".$invoice_id.'-'.date('d-m-Y').".pdf";

       //  $update_values['pdf_file'] = $pdfFilePath;
       //  $updateParam = array('id'=>$invoice_id);
       //  $this->Common_model->updateRow('invoice',$update_values,$updateParam);

       //      require_once "application/vendor/autoload.php";
       //      $mpdf = new \Mpdf\Mpdf();
       //      $mpdf->WriteHTML($invoice_pdf);
       //      $mpdf->Output('assets/invoices/demo/'.$pdfFilePath, "F");

    }
    public function invoice_generatepdf($invoice_id){
      //  echo $invoice_id;exit;

        $emp_id = $this->session->userdata('emp_id');
        $data['employeeData'] = $this->Common_model->getSingleRow('emp_profile',array('id'=>$emp_id));
        /*$data['invoice_details']  = $this->Invoice_model->getInvoiceDetails($invoice_id);
        $data['bankdetails']  = $this->Invoice_model->getInvoiceBankDetails($invoice_id);
        $data['idetails']  = $this->Invoice_model->getInvoiceDetails_single($invoice_id);*/

        $invoice_details  = $this->Invoice_model->getInvoiceDetails($invoice_id);
        $data['invoice_details']  = $invoice_details;
        $data['bankdetails']  = $this->Invoice_model->getInvoiceBankDetails($invoice_id);
        $data['idetails']  = $this->Invoice_model->getInvoiceDetails_single($invoice_id);
        $loanTypesDetails  = (array)$this->Invoice_model->getLoanTypesDetails();
        $loanDetails = array_combine(array_column($loanTypesDetails, 'type_id'),array_column($loanTypesDetails, 'type_name'));
        $data['loanDetails'] = $loanDetails[$invoice_details[0]->loan_type_id];
        /*$emp_id = $data['idetails']->updated_by;
        if($emp_id == 0){
        	$emp_id = $data['idetails']->inserted_by;
        }*/

        $emp_id = $data['idetails']->inserted_by;

        $data['employeeData'] = $this->Common_model->getSingleRow('emp_profile',array('id'=>$emp_id));

       // $html= $this->load->view('Invoice_print',$data,true);
        $invoice_pdf= $this->load->view('Invoice_pdf',$data,true);
       // echo $invoice_pdf; exit();
        $pdfFilePath = "invoice-".$invoice_id.'-'.date('d-m-Y').".pdf";

        $update_values['pdf_file'] = $pdfFilePath;
        $updateParam = array('id'=>$invoice_id);
        $this->Common_model->updateRow('invoice',$update_values,$updateParam);

            require_once "application/vendor/autoload.php";
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->SetWatermarkImage(base_url().'assets/images/final-Hanshitha-logo-watermark-3.png');
            $mpdf->showWatermarkImage = true;
            $mpdf->WriteHTML($invoice_pdf);
            $mpdf->Output('assets/invoices/'.$pdfFilePath, "F");

    }

    public function manual_invoice_generatepdf($invoice_id){
      //  echo $invoice_id;exit;
        $data['invoice_details']  = $this->Invoice_model->getInvoiceDetails($invoice_id);
        
        $data['idetails']  = $this->Invoice_model->getInvoiceDetails_single($invoice_id);
        $data['bankdetails']  = $this->Invoice_model->getManualInvoiceBankDetails($data['idetails']->gst_no);
       // $html= $this->load->view('Invoice_print',$data,true);
        $invoice_pdf= $this->load->view('Invoice_pdf',$data,true);
       // echo $invoice_pdf; exit();
        $pdfFilePath = "invoice-".$invoice_id.'-'.date('d-m-Y').".pdf";

        $update_values['pdf_file'] = $pdfFilePath;
        $updateParam = array('id'=>$invoice_id);
        $this->Common_model->updateRow('invoice',$update_values,$updateParam);

            require_once "application/vendor/autoload.php";
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($invoice_pdf);
            $mpdf->Output('assets/invoices/'.$pdfFilePath, "F");

    }
    public function settle_invoice_generatepdf($invoice_id){
      //  echo $invoice_id;exit;
        $data['invoiceData'] = $this->Common_model->getSingleRow('invoice',array('id'=>$invoice_id));
        $data['employeeDetails'] = $this->Common_model->getSingleRow('emp_profile',array('id'=>$data['invoiceData']->inserted_by));
        $data['contractor_charges'] = $this->Common_model->getSingleRow('contractor_charges',array('invoice_id'=>$invoice_id));
        $contractor_charges_id = $data['contractor_charges']->contractor_charges_id ;
        //echo $data['contractor_charges']->net_contractor_charges; 
        $data['invoice_id'] = $invoice_id;
        /*echo "<pre>";
        print_r($data['employeeDetails']); 
        exit();*/
       // $html= $this->load->view('Invoice_print',$data,true);
        $invoice_pdf= $this->load->view('settle_pdf',$data,true);
        //echo $invoice_pdf; exit();
        $pdfFilePath = "settle_invoice-".$invoice_id.'-'.$contractor_charges_id.'-'.date('d-m-Y').".pdf";

        $update_values['invoice_file_name'] = $pdfFilePath;
        $updateParam = array('contractor_charges_id'=>$contractor_charges_id);
        $this->Common_model->updateRow('contractor_charges',$update_values,$updateParam);

            require_once "application/vendor/autoload.php";
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($invoice_pdf);
            $mpdf->Output('assets/contractor_invoice_files/'.$pdfFilePath, "F");
    }
    public function settle_invoice_view($invoice_id){
      //  echo $invoice_id;exit;
        $data['invoiceData'] = $this->Common_model->getSingleRow('invoice',array('id'=>$invoice_id));
        $data['employeeDetails'] = $this->Common_model->getSingleRow('emp_profile',array('id'=>$data['invoiceData']->inserted_by));
        $data['contractor_charges'] = $this->Common_model->getSingleRow('contractor_charges',array('invoice_id'=>$invoice_id));
        //echo $data['contractor_charges']->net_contractor_charges; 
        $data['invoice_id'] = $invoice_id;
        $this->template->load_view('settle_invoice_pdf_new',$data); 
        //$invoice_pdf= $this->load->view('settle_invoice_pdf',$data,true);
        //echo $invoice_pdf; exit();
        
       
    }
    

    public function invoice_view($invoice_id){
        $breadcrumbarray = array('label'=> "Invoices",
                           'link' => base_url()."Invoices"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Invoice View");
        //$emp_id = $this->session->userdata('emp_id');
        
        /*$data['invoice_details']  = $this->Invoice_model->getInvoiceDetails($invoice_id);
        $data['idetails']  = $this->Invoice_model->getInvoiceDetails_single($invoice_id);
        $data['bankdetails']  = $this->Invoice_model->getInvoiceBankDetails($invoice_id);*/
        $data['invoice_details']  = $invoice_details;
        $data['idetails']  = $this->Invoice_model->getInvoiceDetails_single($invoice_id);
        $data['idetails']  = $this->Invoice_model->getInvoiceDetails_single($invoice_id);
        $data['bankdetails']  = $this->Invoice_model->getInvoiceBankDetails($invoice_id);
        $loanTypesDetails  = (array)$this->Invoice_model->getLoanTypesDetails();
        $loanDetails = array_combine(array_column($loanTypesDetails, 'type_id'),array_column($loanTypesDetails, 'type_name'));
        $data['loanDetails'] = $loanDetails[$invoice_details[0]->loan_type_id];
        /*$emp_id = $data['idetails']->updated_by;
        if($emp_id == 0){
        	$emp_id = $data['idetails']->inserted_by;
        }*/

        $emp_id = $data['idetails']->inserted_by;

        $data['employeeData'] = $this->Common_model->getSingleRow('emp_profile',array('id'=>$emp_id));
        $data['getInvFiles'] = $this->Invoice_model->getInvFiles($invoice_id);
       // $data['bankdetails']  = $this->Invoice_model->getInvoiceBankDetails($invoice_id);
        //echo "<pre>"; print_r($data);exit;
        $this->template->load_view('Invoice_view',$data);  
    }
    public function settle_invoice_view_new($invoice_id){
        $breadcrumbarray = array('label'=> "Invoices",
                           'link' => base_url()."Invoices"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Settle Invoice View");
         $data['invoiceData'] = $this->Common_model->getSingleRow('invoice',array('id'=>$invoice_id));
        $data['employeeDetails'] = $this->Common_model->getSingleRow('emp_profile',array('id'=>$data['invoiceData']->inserted_by));
        $data['contractor_charges'] = $this->Common_model->getSingleRow('contractor_charges',array('invoice_id'=>$invoice_id));
        //echo $data['contractor_charges']->net_contractor_charges; 
        $data['invoice_id'] = $invoice_id;
        $this->template->load_view('settle_invoice_pdf_new',$data);  
    }

    public function deleteInvoice(){
        if($_POST){
            $invoice_id = $this->input->post('invoice_id');
            $invoiceParam = array('id'=>$invoice_id);
            $serviceParam = array('invoice_id'=>$invoice_id);
            $this->Common_model->deleteRow('invoice_services',$serviceParam);
            $this->Common_model->deleteRow('invoice',$invoiceParam);

        }else{
            echo "forbidden access";
        }
    }

    public function getBranchas(){
        $bank_id = $this->input->post('bank_id');

        //$branchs =  $this->Common_model->get_result('allbranchs',array(),array('bank_id'=>$bank_id));
        $branchs =  $this->Invoice_model->getBankBrancheNames($bank_id);
       // echo $this->db->last_query();
        header('Content-type: application/json');
        die( json_encode( $branchs ) );  
    }
    public function getLineTypes(){
        $invoice_type = $this->input->post('invoice_type');
        $loan_type_id = $this->input->post('loan_type_id');

        //$branchs =  $this->Common_model->get_result('allbranchs',array(),array('bank_id'=>$bank_id));
        $branchs =  $this->Invoice_model->getLineTypes($invoice_type,$loan_type_id);
        
        header('Content-type: application/json');
        die( json_encode( $branchs ) );  
    }

    function testMpdf(){
        require_once "application/vendor/autoload.php";

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('<h1>Hello world!</h1>');
        $mpdf->Output();
    }
    
    public function insertInvoice_manual(){
        //echo "<pre>";
       /* print_r($_POST);
        print_r($_FILES);*/
         if($_POST){


            $action = $this->input->post('action');
            if($action == 'add'){
                $insertData['bill_date'] = $this->input->post('bill_date');
                $insertData['order_id'] = ($this->input->post('order_id'))?$this->input->post('order_id'):'0';
                // $insertData['from_address'] = $this->input->post('from_address');
                // $insertData['to_address'] = $this->input->post('to_address');
                $insertData['gst_no'] = $this->input->post('gst_no');
                //$insertData['vendor_no'] = $this->input->post('vendor_no');
                $insertData['account'] = trim($this->input->post('account'));

                $checkLoanExist = $this->Invoice_model->checkLoanAccount($insertData['account']); 

		        $insertData['loan_type_id'] = $this->input->post('loan_type_id');
                if($insertData['loan_type_id'] == '1'  || $insertData['loan_type_id'] == '5'){
                    $insertData['recovery_type'] = $this->input->post('recovery_type');
                }
                if(!empty($checkLoanExist)){
                    $loan_id = $checkLoanExist->loan_id;
                    $insertData['loan_id'] = $loan_id;

                }else{
                    //insert new loan
                    $bank_id  = $this->input->post('bank_id');
                    $branch_id  = $this->input->post('branch_id'); 
                    //$branch_controller  = $this->input->post('branch_controller');                
                    $loan_ac_number  = trim($insertData['account']);
                    $barrower_name  = $this->input->post('vendor_no');
                    $emp_id = $this->session->userdata('emp_id');
                    if($this->input->post('invoice_type') == '2'){
                        $loan_status = 'c';
                    }else{
                        $loan_status = 'p';
                    }
                    
                    $inserData = array(
                            'bank_id' => $bank_id,
                            'branch_id'  => $branch_id,
                            'type_id'  => $insertData['loan_type_id'],
                            'emp_id' => $emp_id,
                            'loan_ac_number' => $loan_ac_number,
                            'barrower_name' => $barrower_name,
                            'status' => $loan_status,
                            'inserted_by' => $this->session->userdata('emp_id'),
                            'inserted_date' => date('Y-m-d H:i:s'));
                    
                            $res = $this->Common_model->insertSingle('Loanaccounts', $inserData);
                    $insertData['loan_id'] = $res;

                }
               
                $insertData['invoice_type'] = $this->input->post('invoice_type');
                $insertData['notes'] = $this->input->post('invoice_notes');
                $insertData['emp_id'] = $this->session->userdata('emp_id'); 
                $insertData['manual_invoice'] = 'y';
                $insertData['inserted_by'] = $this->session->userdata('emp_id');
                $insertData['inserted_date'] = date('Y-m-d H:i:s');    


                        
                $res1 = $this->Common_model->insertSingle('invoice', $insertData);
                if($res1){
                    $total_rows = $this->input->post('totalrows');
                     $invoice_id = $res1;
                    for($i=1;$i<=$total_rows;$i++){
                        $insertServiceData = array();
                        $insertServiceData['invoice_id'] = $invoice_id;
                        $insertServiceData['line_id'] = $this->input->post('line_id'.$i)?$this->input->post('line_id'.$i):'';
                        $insertServiceData['borrower_name'] = $this->input->post('borrower_name'.$i);
                        $insertServiceData['recovered_amt'] = $this->input->post('recovered_amt'.$i);
                        $insertServiceData['date'] = $this->input->post('date'.$i);
                        $insertServiceData['commission_charges'] = $this->input->post('commission_charges'.$i);
                         $insertServiceData['gst_p'] = $this->input->post('gst_p'.$i);
                        $insertServiceData['gst'] = $this->input->post('gstamount'.$i);
                        $insertServiceData['total'] = $this->input->post('total_amount'.$i);
                        $res = $this->Common_model->insertSingle('invoice_services', $insertServiceData);
                    }    
                   $this->invoice_generatepdf($res1);
                    //$this->invoice_filesinsert($res1,$_POST,$_FILES);
                    $invoice_id = $res1;
                    $config = array();
                    $config['upload_path'] = "assets/invoice_files/"; //../upload/adImages
                    $config['allowed_types'] = "*"; //
                    
                    $this->load->library('upload');
                    

                    
                   $filereg = $this->upload_files("assets/invoice_files/", "INVFILE", $_FILES['invoice_files'],$invoice_id);
                   $invoice_files_insertdata = array();
                   if(!empty($filereg)){
                        foreach ($filereg['images'] as $key => $value) {
                           $inner_array = array();
                           $inner_array['invocie_id'] = $invoice_id;
                           $inner_array['file_name'] = $value;
                           $inner_array['display_name'] =$filereg['display_images'][$key];
                           $inner_array['inserted_by'] = $this->session->userdata('emp_id');
                           $inner_array['inserted_date'] = date('Y-m-d H:i:s');
                           $res = $this->Common_model->insertSingle('invoice_files', $inner_array);
                           //$invoice_files_insertdata[] = $inner_array;
                       } 
                   }
                }
            }else{
                $invoice_id = $this->input->post('invoice_id');
                
                $updateData['gst_no'] = $this->input->post('gst_no');
                
                $updateData['account'] = $this->input->post('account');
                //$updateData['loan_id'] = $this->input->post('loan_id');
                $updateData['invoice_type'] = $this->input->post('invoice_type');
                $insertData['notes'] = $this->input->post('invoice_notes');
                //$updateData['emp_id'] = $this->session->userdata('emp_id'); 

                $updateData['loan_type_id'] = $this->input->post('loan_type_id');
                if($updateData['loan_type_id'] == '1'  || $insertData['loan_type_id'] == '5'){
                    $updateData['recovery_type'] = $this->input->post('recovery_type');
                }
                
                $updateData['updated_by'] = $this->session->userdata('emp_id');
                $updateData['updated_date'] = date('Y-m-d H:i:s');
                
                $updateParam = array('id'=>$invoice_id);
                $res = $this->Common_model->updateRow('invoice', $updateData,$updateParam);
              
                if($res){
                    $deleteParam = array('invoice_id'=>$invoice_id);
                    $this->Common_model->deleteRow('invoice_services',$deleteParam);

                    $total_rows = $this->input->post('totalrows');
                    for($i=1;$i<=$total_rows;$i++){
                        $insertServiceData = array();
                        $insertServiceData['invoice_id'] = $invoice_id;
                        $insertServiceData['line_id'] = $this->input->post('line_id'.$i)?$this->input->post('line_id'.$i):'';
                        $insertServiceData['borrower_name'] = $this->input->post('borrower_name'.$i);
                        $insertServiceData['recovered_amt'] = $this->input->post('recovered_amt'.$i);
                        $insertServiceData['date'] = $this->input->post('date'.$i);
                        $insertServiceData['commission_charges'] = $this->input->post('commission_charges'.$i);
                        $insertServiceData['gst_p'] = $this->input->post('gst_p'.$i);
                        $insertServiceData['gst'] = $this->input->post('gstamount'.$i);
                        $insertServiceData['total'] = $this->input->post('total_amount'.$i);
                        $res = $this->Common_model->insertSingle('invoice_services', $insertServiceData);
                    }    
                }
                $this->invoice_generatepdf($invoice_id);
            }
            redirect(base_url().'Invoice');
        }
    }
     function upload_files($path, $title, $files,$invoice_id)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => '*',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();
        $display_images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];
            $extension = pathinfo($files['name'][$key], PATHINFO_EXTENSION);
            $image_info = explode(".", $files['name'][$key]); 

            $fileName = $title.'_'.$invoice_id.'_'.($key+1).'.'.$extension;

            $images[] = $fileName;
            $display_images[] = $image_info[0];

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
        $res = array();
        $res = array('images'=>$images,'display_images'=>$display_images);
        return $res;
    }
    function files_upload($upload_path,$allowed_types,$filename,$emp_id,$type) {
        $config = array();
        $config['upload_path'] = $upload_path; //../upload/adImages
        $config['allowed_types'] = $allowed_types; //
        $config['max_size'] = '2000';
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
  public function getGst(){
    if($_POST){
        $branch_id = $this->input->post('branch_id');
        $branchData = $this->Invoice_model->getBrachDetails($branch_id);
        $gstData = $this->Invoice_model->getGstData($branchData->bank_id,$branchData->state_id);
        
        
        header('Content-type: application/json');
        die( json_encode( $gstData ) ); 
    }
  }

    public function settleInvoice($invoice_id,$settle_invocie_id = ""){
        //$invoice_id = 62;
        $breadcrumbarray = array('label'=> "Invoices",
                           'link' => base_url()."Invoices"
                           );
        $link = breadcrumb($breadcrumbarray);
        $this->template->set_breadcrumb($link);
        $this->template->set_subpagetitle("Manage Invoices");
        if($settle_invocie_id != ''){
            $data['action'] = 'edit';

        }else{
            $data['action'] = 'add';
        } 
        $data['invoiceData'] = $this->Common_model->getSingleRow('invoice',array('id'=>$invoice_id));
        $invoiceTotals = $this->Invoice_model->getInvoiceTotals($invoice_id);
        if(!empty($invoiceTotals)){
            $data['invoice_total_amount'] = $invoiceTotals->total;
        }else{
            $data['invoice_total_amount'] = 0;    
        }
        $totalAdvanceAmounts = $this->Invoice_model->contractorAdvancePaidAmount($data['invoiceData']->emp_id);
        $totalPaidFromContractor = $this->Invoice_model->contractPaidAmount($data['invoiceData']->emp_id);
        if(!empty($totalAdvanceAmounts)){
            $advancePaidTotal = $totalAdvanceAmounts->advancePaidAmount;
        }else{
            $advancePaidTotal = 0;
        }
        if(!empty($totalPaidFromContractor)){
            $paidFromContractor = $totalPaidFromContractor->totalPaidAmount;
        }else{
            $paidFromContractor = 0;
        }
        
        $contractorAdvanceAmount = $advancePaidTotal - $paidFromContractor;
        $data['contractorAdvanceAmount'] = $contractorAdvanceAmount;
        
        $data['invoice_id'] = $invoice_id;
        $this->template->load_view('settle_invoice_add',$data);  
    }

 public function settle_insert() {
    
    $invoice_id = $this->input->post('invoice_id');
    $invoiceDetails = $this->Common_model->getSingleRow('invoice',array('id'=>$invoice_id));

    //$insertContractorChargesData
    // $insertData['gst_no'] = $this->input->post('gst_no');
    $insertData['charges_received_date'] = $this->input->post('received_date') ? $this->input->post('received_date') : NULL;
    $insertData['received_amount'] = $this->input->post('received_amount') ? $this->input->post('received_amount'): 0;
    $insertData['tds_amount'] = $this->input->post('tds_amount') ? $this->input->post('tds_amount'): 0;
    $insertData['gst_amount'] = $this->input->post('gst_amount') ? $this->input->post('gst_amount'): 0;
    $insertData['expenses_amount'] = $this->input->post('expenses_amount') ? $this->input->post('expenses_amount'): 0;
    $insertData['gross_contractor_charges'] = $this->input->post('gross_contactor_charges') ? $this->input->post('gross_contactor_charges'): 0;
    $insertData['contractor_tds_charges'] = $this->input->post('contractor_tds_charges') ? $this->input->post('contractor_tds_charges'): 0;
    $insertData['net_contractor_charges'] = $this->input->post('net_contactor_charges') ? $this->input->post('net_contactor_charges'): 0;
    $insertData['contractor_advance_amount'] = $this->input->post('contactor_advance_amount') ? $this->input->post('contactor_advance_amount'): 0;
    $insertData['net_amount_pay'] = $this->input->post('net_payable_amount') ? $this->input->post('net_payable_amount'): 0;
    $insertData['payment_date'] = $this->input->post('payment_date') ? $this->input->post('payment_date'): date(Y-m-d);
    $insertData['paid_amount'] = $this->input->post('payment_amount') ? $this->input->post('payment_amount'):0;
   // $insertData['remaining_amount'] = $this->input->post('remaining_amount') ? $this->input->post('remaining_amount'): '';
    $insertData['created_by'] = $this->session->userdata('emp_id') ? $this->session->userdata('emp_id'): 0;
    $insertData['created_date'] = date('Y-m-d H:i:s');
    $insertData['invoice_id'] = $this->input->post('invoice_id');
    $res = $this->Common_model->insertSingle('contractor_charges', $insertData);
    
    if($res){
        
        $invoiceTotals = $this->Invoice_model->getInvoiceTotals($invoice_id);
        if(!empty($invoiceTotals)){
            $invoice_total_amount = $invoiceTotals->total;
            $gst_total_amount = $invoiceTotals->gstamount;
        }else{
            $invoice_total_amount = 0;   
            $gst_total_amount = 0;
        }
        
        if($invoice_total_amount > $insertData['received_amount']){
            // create credit notes
            $creditNoteData['contractor_charges_id'] = $res;
            $creditNoteData['created_date'] = Date('Y-m-d');
            $creditNoteData['invoice_id'] = $invoice_id;
            $creditNoteData['account_no'] = $invoiceDetails->account;
            $creditNoteData['credit_note_amount'] = $this->input->post('remaining_amount') ? $this->input->post('remaining_amount'): 0;
            $creditNoteData['credit_note_gst_amount'] = $gst_total_amount;
            // $creditNoteData['credit_note_amount'] = $invoice_total_amount - $insertData['received_amount'];
            $creditNoteData['inserted_by'] = $this->session->userdata('emp_id');
            $creditNoteData['inserted_date'] = date('Y-m-d H:i:s');
            $this->Common_model->insertSingle('credit_note',$creditNoteData);
            $contractor_payment_audit['contractor_charges_id'] = $res;
             $contractor_payment_audit['paid_amount'] =  $insertData['paid_amount'];
             $contractor_payment_audit['payment_date'] =  $insertData['payment_date'];
             $contractor_payment_audit['emp_id'] = $invoiceDetails->emp_id;
             $contractor_payment_audit['inserted_by'] = $this->session->userdata('emp_id');
             $contractor_payment_audit['inserted_date'] = date('Y-m-d H:i:s');
             $this->Common_model->insertSingle('contractor_payment_audit',$contractor_payment_audit);
            
        }
        $this->settle_invoice_generatepdf($invoice_id);
    }
    redirect(base_url().'Invoice');
 }


public function rejectInvoice($invoice_id){
    // $invoice_id = $this->input->post('invoice_id');
    $invoiceDetails = $this->Common_model->getSingleRow('invoice',array('id'=>$invoice_id));
    /*$invoiceDetails = $this->Common_model->getSingleRow('invoice',array('id'=>$invoice_id));

    //$insertContractorChargesData
    // $insertData['gst_no'] = $this->input->post('gst_no');
    $insertData['charges_received_date'] = $this->input->post('received_date') ? $this->input->post('received_date') : NULL;
    $insertData['received_amount'] = $this->input->post('received_amount') ? $this->input->post('received_amount'): 0;
    $insertData['tds_amount'] = $this->input->post('tds_amount') ? $this->input->post('tds_amount'): 0;
    $insertData['gst_amount'] = $this->input->post('gst_amount') ? $this->input->post('gst_amount'): 0;
    $insertData['expenses_amount'] = $this->input->post('expenses_amount') ? $this->input->post('expenses_amount'): 0;
    $insertData['gross_contractor_charges'] = $this->input->post('gross_contactor_charges') ? $this->input->post('gross_contactor_charges'): 0;
    $insertData['contractor_tds_charges'] = $this->input->post('contractor_tds_charges') ? $this->input->post('contractor_tds_charges'): 0;
    $insertData['net_contractor_charges'] = $this->input->post('net_contactor_charges') ? $this->input->post('net_contactor_charges'): 0;
    $insertData['contractor_advance_amount'] = $this->input->post('contactor_advance_amount') ? $this->input->post('contactor_advance_amount'): 0;
    $insertData['net_amount_pay'] = $this->input->post('net_payable_amount') ? $this->input->post('net_payable_amount'): 0;
    $insertData['payment_date'] = $this->input->post('payment_date') ? $this->input->post('payment_date'): NULL;
    $insertData['paid_amount'] = $this->input->post('paid_amount') ? $this->input->post('paid_amount'):0;
   // $insertData['remaining_amount'] = $this->input->post('remaining_amount') ? $this->input->post('remaining_amount'): '';
    $insertData['created_by'] = $this->session->userdata('emp_id') ? $this->session->userdata('emp_id'): 0;
    $insertData['created_date'] = date('Y-m-d H:i:s');
    $insertData['invoice_id'] = $this->input->post('invoice_id');
    $res = $this->Common_model->insertSingle('contractor_charges', $insertData);
    
    if($res){
        */
        $invoiceTotals = $this->Invoice_model->getInvoiceTotals($invoice_id);
        if(!empty($invoiceTotals)){
            $invoice_total_amount = $invoiceTotals->total;
        }else{
            $invoice_total_amount = 0;    
        }
        
       
        // create credit notes
        $creditNoteData['contractor_charges_id'] = 0;
        $creditNoteData['created_date'] = Date('Y-m-d');
        $creditNoteData['invoice_id'] = $invoice_id;
        $creditNoteData['account_no'] = $invoiceDetails->account;
        $creditNoteData['credit_note_amount'] = $invoice_total_amount;
        $creditNoteData['inserted_by'] = $this->session->userdata('emp_id');
        $creditNoteData['inserted_date'] = date('Y-m-d H:i:s');
        $this->Common_model->insertSingle('credit_note',$creditNoteData);
        
    redirect(base_url().'Invoice');

}
 public function checkSettleRejectStatus($invoice_id, $createdDate = ""){
    $today = Date("Y-m-d");
    $contractorCharges = $this->Common_model->getSingleRow('contractor_charges',array('invoice_id'=>$invoice_id));
    if(!empty($contractorCharges)){
        return "settled";
    }else{
        $date4Months = date("Y-m-d",strtotime(" -120 days"));
        if($createdDate < $date4Months){
            // check for retain for this month
            $checkRetain = $this->Invoice_model->checkRetain($invoice_id);
            if(!empty($checkRetain)){
                $retainDate = $checkRetain->retain_date;
                if($retainDate < $today){
                    return "showreject";
                }else{
                    return "noreject";
                }
            }else{
                return "showreject";
            }
        }else{
            return "showsettle";
        }
    }
 }

 public function retainInvoice(){
    if($_POST){
        $invoice_id = $this->input->post('invoice_id');
        $retainData['invoice_id'] = $invoice_id;
        $retainData['retain_date'] = date("Y-m-t");
        $retainData['inserted_by'] = $this->session->userdata('emp_id');
        $retainData['inserted_date'] = date('Y-m-d H:i:s');
        $res = $this->Common_model->insertSingle('settle_retain', $retainData);
        if($res){
            echo "1";
        }else{
            echo "0";
        }
    }
 }
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */
