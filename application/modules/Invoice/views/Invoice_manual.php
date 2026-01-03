<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">

<style>
  .ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 160px;
  padding: 5px 0;
  margin: 2px 0 0;
  list-style: none;
  font-size: 14px;
  text-align: left;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 4px;
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  background-clip: padding-box;
  max-height: 150px;
  overflow-y: auto;
  overflow-x: hidden;
}

.ui-autocomplete > li > div {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.42857143;
  color: #333333;
  white-space: nowrap;
}

.ui-state-hover,
.ui-state-active,
.ui-state-focus {
  text-decoration: none;
  color: #262626;
  background-color: #f5f5f5;
  cursor: pointer;
}

.ui-helper-hidden-accessible {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

  </style>
    <!-- Main body -->
    <div class="main-body">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Invoice">Invoices</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Invoice</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
      <div class="row">
        <div class="col">
         
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url(); ?>Invoice/insertInvoice_manual" name="invoice_submit" id="invoice_submit" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="state_id" id="state_id" <?php if($action == 'edit'){  ?> value="<?php echo $state; ?>" <?php }else{ ?> value="" <?php } ?> />
                  <fieldset class="form-fieldset">
                    <legend>Loan  Account Info</legend>
                   
                    <div class="row mb-3">                      
                      
                    <div class="col-sm-3">
                    <label>Select Loan Type:<span style="color: red">*</span></label>
                    <select class="custom-select" id="loan_type_id" name="loan_type_id">
                    <option value='' selected>Select Loan Type</option>
                    
                     <?php foreach ($loantypes as  $value) { ?>
                        <option value="<?php echo $value->type_id;?>" <?php if($action == 'edit'){  if($invoiceData->loan_type_id == $value->type_id){ echo "selected"; }  } ?>><?php echo $value->type_name;?></option>
                    <?php } ?>
                    </select>
                    <span class="small" id="loan_type_error" style="color:red;"></span>
                    </div>

                    
                      
                       <div class="col-sm-2">
                      <label>Invoice Type:<span style="color: red">*</span></label>
                      <select class="custom-select" id="invoice_type" name="invoice_type">
                      <option value='' selected>Select Type Of Invoice</option>
                      <option value="1" <?php if($action == 'edit'){  if($invoiceData->invoice_type == '1'){ echo "selected"; }  } ?>>Notice Charges</option>
                      <option value="2" <?php if($action == 'edit'){  if($invoiceData->invoice_type =='2'){ echo "selected"; }  } ?>>Invoice</option>
                      <option value="3" <?php if($action == 'edit'){  if($invoiceData->invoice_type =='3'){ echo "selected"; }  } ?>>Expenses</option>
                      </select>
                      <span class="small" id="invoice_type_error" style="color:red;"></span>
                      </div>
                      <!-- start -->
                      <?php if($action == 'edit') { 
                        if($invoiceData->loan_type_id == '1' && $invoiceData->invoice_type =='2'){ ?>
                          <div class="col-sm-2" id="recovery_div">
                            <label>Recovery Type:<span style="color: red">*</span></label>
                            <select class="custom-select" id="recovery_type" name="recovery_type">
                            <option value='' selected>Select Recovery Type</option>
                            <option value="release" <?php if($action == 'edit'){  if($invoiceData->recovery_type == 'release'){ echo "selected"; }  } ?>>Release</option>
                            <option value="auction" <?php if($action == 'edit'){  if($invoiceData->recovery_type =='auction'){ echo "selected"; }  } ?>>Auction</option> 
                            <option value="recovery" <?php if($action == 'edit'){  if($invoiceData->recovery_type =='recovery'){ echo "selected"; }  } ?>>Recovery</option>                    
                            </select>
                            <span class="small" id="recovery_type_error" style="color:red;"></span>
                          </div>
                       <?php } else if($invoiceData->loan_type_id == '5' && $invoiceData->invoice_type =='2'){ ?>
                          <div class="col-sm-2" id="recovery_div">
                            <label>Recovery Type:<span style="color: red">*</span></label>
                            <select class="custom-select" id="recovery_type" name="recovery_type">
                            <option value='' selected>Select Recovery Type</option>
                            <option value="13/2" <?php if($action == 'edit'){  if($invoiceData->recovery_type == '13/2'){ echo "selected"; }  } ?>>13/2</option>
                            <option value="13/4" <?php if($action == 'edit'){  if($invoiceData->recovery_type =='13/4'){ echo "selected"; }  } ?>>13/4</option> 
                            <option value="nps" <?php if($action == 'edit'){  if($invoiceData->recovery_type =='nps'){ echo "selected"; }  } ?>>NPS</option>                    
                            </select>
                            <span class="small" id="recovery_type_error" style="color:red;"></span>
                          </div>
                      <?php } } else { ?> 
                        <div class="col-sm-2" id="recovery_div" <?php if($action == 'edit'){ if($invoiceData->loan_type_id == '1' && $invoiceData->invoice_type =='2'){ ?> style="display: block;" <?php } }else{ ?> style="display: none;" <?php } ?>>
                      <label>Recovery Type:<span style="color: red">*</span></label>
                      <select class="custom-select" id="recovery_type" name="recovery_type">
                      <option value='' selected>Select Recovery Type</option>
                      <option value="release" <?php if($action == 'edit'){  if($invoiceData->recovery_type == 'release'){ echo "selected"; }  } ?>>Release</option>
                      <option value="auction" <?php if($action == 'edit'){  if($invoiceData->recovery_type =='auction'){ echo "selected"; }  } ?>>Auction</option> 
                      <option value="recovery" <?php if($action == 'edit'){  if($invoiceData->recovery_type =='recovery'){ echo "selected"; }  } ?>>Recovery</option>                    
                      </select>
                      <span class="small" id="recovery_type_error" style="color:red;"></span>
                    </div>
                      <?php } ?>
                      <!-- end -->
                      

                      <div class="col-sm-2">
                      <label for="fname">Select Bank:<span style="color: red">*</span></label>
                     <select class="custom-select" id="bank_id" name="bank_id">
                          <option value='' selected>Select Bank</option>
                          <?php foreach ($banks as  $value) { ?>
                            <option value="<?php echo $value->bank_id; ?>" <?php if($action == 'edit'){  if($gstsdata->bank_id == $value->bank_id){ echo "selected"; }  } ?>><?php echo $value->bank_name; ?></option>
                          <?php } ?>
                        </select>
                      <span class="small" id="bank_id_error" style="color:red;"></span> 
                    </div>
                    <div class="col-sm-3">
                       <label for="fname">Select Branch:<span style="color: red">*</span></label>
                     <select class="custom-select" id="branch_id" name="branch_id">
                          <option value='' selected>Select Branch</option>
                          <?php
                          if(!empty($branchs)){
                          foreach ($branchs as  $value) { ?>
                            <option value="<?php echo $value->branch_id; ?>" <?php if($action == 'edit'){  if($loanAccountData->branch_id == $value->branch_id){ echo "selected"; }  } ?>><?php echo $value->branch_name; ?></option>
                          <?php } } ?>
                        </select>
                      <span class="small" id="branch_id_error" style="color:red;"></span> 
                    </div>

                     
                      
                      
                    </div>

                   
                    <div class="row">  
                      <div class="col-sm-3">
                        <label>Borrower Name:<span style="color: red">*</span></label>
                          <input type="text" class="form-control form-control-sm" name="vendor_no" placeholder="Enter Borrower Name" id="vendor_no" value="<?php if($action == 'edit'){ echo $loanAccountData->barrower_name; } ?>">
                            <span class="small" id="vendor_no_error" style="color:red;"></span> 
                      </div>

                      <div class="col-sm-3 ui-widget ">
                      <label>Account Number:<span style="color: red">*</span></label>
                        <input  class="form-control form-control-sm" name="account" placeholder="Enter Number" id="account" <?php if($action == 'edit'){  ?> value="<?php if($action == 'edit'){ echo trim($invoiceData->account);  } ?>" <?php  } ?> >
                        <span class="small" id="account_error" style="color:red;"></span> 
                    </div>
                      
                      <div class="col-sm-3">
                          <label>Invoice Date:<span style="color: red">*</span></label>
                            <input type="text" class="form-control datepicker-input form-control-sm" autocomplete="off" placeholder="Date" name="bill_date" id="bill_date" value="<?php if($action == 'edit'){ echo $invoiceData->bill_date; } ?>">
                           <span class="small" id="bill_date_error" style="color:red;"></span> 
                        </div>                   
                      <div class="col-sm-3">
                        <label>GST NO:<span style="color: red">*</span></label>
                          <input type="text" class="form-control form-control-sm" name="gst_no" placeholder="GST No" id="gst_no" value="<?php if($action == 'edit'){ echo $invoiceData->gst_no; } ?>" readonly>
                            <span class="small" id="gst_no_error" style="color:red;"></span> 
                      </div>
                      
                    </div>


                    <br />
                    <br />
                    <div class="row" id="seizediv" style="display: none;">
                      <div class="col-sm-3">
                        <p class="">Seizer Guidelines Followed:</p>
                        
                        <input type="radio" id="customRadio1" name="seizer_guidelines_followed"
                        
                         value='y'>
                        Yes

                        <input type="radio" id="customRadio2" name="seizer_guidelines_followed"
                         value='n'>
                        No
                      </div>
                    </div>

                    <br />
                    <div class="row d-none" id="parkingdiv">
                      <div class="col-sm-3">
                        <p class="">Parking Charges Applicable:</p>
                        <input type="radio" id="pricingradio1" name="parking_charging"
                         value='y' onchange="changeParking('y')">
                        Yes
                        <input type="radio" id="pricingradio2" name="parking_charging"
                         value='n' onchange="changeParking('n')">
                        No
                      </div>
                    </div>
                    
                    <div class="row" id="old_files">
                      <div class="form-group col-md-4">                      
                        <span class="d-none"><label for="invoice_files">Files</label>
                        <input type="file" class="form-control" name="invoice_files[]" id="invoice_files" multiple>
                        <span class="small" id="invoice_files_error" style="color:red;"></span></span>
                      </div>
                      <?php if($action == 'edit') { ?>
                      <div class="form-group col-md-4"> 
                         <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal" style="margin-top: 10%;">View Files</button>
                      </div>
                      <?php } ?>
                       <div class="form-group col-md-4"> 
                        <span id="LoanTypeChangedValue"></span>
                       </div>
                    </div>
                    <div class="row" id="new_files">

                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">                      
                        <label for="invoice_notes">Notes</label>
                        <textarea class="form-control" name="invoice_notes" id="invoice_notes"><?php if($action == 'edit'){ echo $invoiceData->notes; } ?></textarea>
                        <span class="small" id="invoice_notes_error" style="color:red;"></span>
                      </div>
                    </div>
                
                  </fieldset>
                  <fieldset class="form-fieldset" id="pcharges" style="display:none;">
                    <legend>Parking Days</legend>
                   
                    <div class="row">                     
                      <div class="col-sm-4">
                        <label>Start Date:</label>
                            <input type="text" class="form-control datepicker-input form-control-sm" autocomplete="off" placeholder="Date" name="start_date" id="start_date" >
                      </div>
                      <div class="col-sm-4">
                        <label>End Date:</label><input type="text" class="form-control datepicker-input form-control-sm" autocomplete="off" placeholder="Date" name="end_date" id="end_date" > 
                      </div>
                         <div class="col-sm-4">
                        <label>No Of Days:</label><span class="small" id="days">  Days</span> 
                      </div>
                    </div>
                
                  </fieldset>

                  
                    
                    
                  
                  <fieldset class="form-fieldset">
                    <legend>Invoice Data</legend>
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                          <table class="table table-bordered table-sm" id="dTable" >
                            <thead>
                              <tr>
                                <th>S.NO</th>
                                <th class="text-center">Line Type</th>
                                <th class="text-center">Details</th>
                                <th class="text-center">Recovered Amt</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Commission Charges</th>
                                <th class="text-center">IGST (18%)</th>
                                <th class="text-center CGST">CGST %</th>
                                <th class="text-center">IGST Amount</th>
                                <th class="text-center CGST">CGST Amount</th>
                                <th class="text-center">Total</th>                                                    
                              </tr>
                            </thead>
                              <tbody>
                                <?php $i = 1; ?>
                              <?php if($action == 'add'){ ?>
                              <tr id="row_<?php echo $i;?>">
                              <td width="20"><?php echo $i;?></td>
                              <td><select name="line_id<?php echo $i ?>" id="line_id<?php echo $i ?>" class="form-control form-control-sm line_type" ><option value="">Select</option></select><span class="small" id="line_id<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td><input type="text" name="borrower_name<?php echo $i ?>" id="borrower_name<?php echo $i ?>" class="form-control form-control-sm" placeholder="Enter Details" value=""  /><span class="small" id="borrower_name<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="130"><input type="text" name="recovered_amt<?php echo $i ?>" id="recovered_amt<?php echo $i ?>" class="form-control form-control-sm" placeholder="Recovered Amount" value=""  onchange="amountCal(this,<?php echo $i;?>)"/><span class="small" id="recovered_amt<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="130"><input type="text" name="date<?php echo $i ?>" id="date<?php echo $i ?>" class="form-control form-control-sm datepicker-input" placeholder="Date" value=""  /><span class="small" id="date<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="130"><input type="text" name="commission_charges<?php echo $i ?>" id="commission_charges<?php echo $i ?>" class="form-control form-control-sm" placeholder="Commission Charges" value=""  onchange="amountCal(this,<?php echo $i;?>)"/><span class="small" id="commission_charges<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="100"><input type="text" name="gst_p<?php echo $i ?>" id="gst_p<?php echo $i ?>" class="form-control form-control-sm" placeholder="SGST" value="0" onchange="amountCal(this,<?php echo $i;?>)"/></td>
                              <td width="100" class="CGST"><input type="text" name="cgst_p<?php echo $i ?>" id="cgst_p<?php echo $i ?>" class="form-control form-control-sm " placeholder="CGST" value="0" onchange="amountCal(this,<?php echo $i;?>)"/></td>
                              <td width="100"><input type="text" name="gstamount<?php echo $i ?>" id="gstamount<?php echo $i ?>" class="form-control form-control-sm" placeholder="SGST" value="0" readonly /></td>
                              <td width="100" class="CGST"><input type="text" name="cgstamount<?php echo $i ?>" id="cgstamount<?php echo $i ?>" class="form-control form-control-sm" placeholder="CGST" value="0" readonly /></td>

                                   <td width="130"><input type="text" name="total_amount<?php echo $i ?>" id="total_amount<?php echo $i ?>" class="form-control form-control-sm" placeholder="Total" value="0" readonly /></td>
                          </tr>
                        <?php }else{ 
                          $serviceCount = count($invoiceServices);
                          $subtotal =0;
                          $gstTotal =0;
                          $grandTotal =0;
                          foreach ($invoiceServices as $serviceData) {
                             $subtotal += ($serviceData->recovered_amt+$serviceData->commission_charges);
                             if($state_id == 2) { 
                                 $gstTotal += $serviceData->gst;
                                 $gstTotal += $serviceData->cgst;
                             } else { 
                                 $gstTotal += $serviceData->gst;
                             }
                              
                              $grandTotal += $serviceData->total;
                           
                          ?>
                          <tr id="row_<?php echo $i;?>">
                              <td width="20"><?php echo $i;?></td>
                              <td><select name="line_id<?php echo $i ?>" id="line_id<?php echo $i ?>" class="form-control form-control-sm line_type"><option>Select</option>
                                <?php foreach ($getLineTypes as $key => $value) { ?>
                                  <option value="<?php echo $value->linetype_id; ?>" <?php echo (($serviceData->line_id == $value->linetype_id)?"selected":"check"); ?>><?php echo $value->linetype_name; ?></option>
                                <?php } ?>
                              </select><span class="small" id="line_id<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td><input type="text" name="borrower_name<?php echo $i ?>" id="borrower_name<?php echo $i ?>" class="form-control form-control-sm" placeholder="Enter Borrower Name" value="<?php echo $serviceData->borrower_name; ?>"  /><span class="small" id="borrower_name<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="130"><input type="text" name="recovered_amt<?php echo $i ?>" id="recovered_amt<?php echo $i ?>" class="form-control form-control-sm" placeholder="Recovered Amount" value="<?php echo $serviceData->recovered_amt; ?>"  onchange="amountCal(this,<?php echo $i;?>)"/><span class="small" id="recovered_amt<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="130"><input type="text" name="date<?php echo $i ?>" id="date<?php echo $i ?>" class="form-control form-control-sm datepicker-input" placeholder="Date" 
                                value="<?php if($serviceData->date !='0000-00-00') {echo $serviceData->date; } ?>"

                                  /><span class="small" id="date<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="130"><input type="text" name="commission_charges<?php echo $i ?>" id="commission_charges<?php echo $i ?>" class="form-control form-control-sm" placeholder="Commission Charges" value="<?php echo $serviceData->commission_charges; ?>"  onchange="amountCal(this,<?php echo $i;?>)"/><span class="small" id="commission_charges<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="100"><input type="text" name="gst_p<?php echo $i ?>" id="gst_p<?php echo $i ?>" class="form-control form-control-sm" placeholder="SGST" value="<?php echo $serviceData->gst_p; ?>" onchange="amountCal(this,<?php echo $i;?>)"/></td>
                              <td width="100" class="CGST"><input type="text" name="cgst_p<?php echo $i ?>" id="cgst_p<?php echo $i ?>" class="form-control form-control-sm" placeholder="CGST" value="<?php echo $serviceData->cgst_p; ?>" onchange="amountCal(this,<?php echo $i;?>)"/></td>
                                  <td width="100"><input type="text" name="gstamount<?php echo $i ?>" id="gstamount<?php echo $i ?>" class="form-control form-control-sm" placeholder="SGST" value="<?php echo $serviceData->gst; ?>" readonly /></td>
                                  <td width="100" class="CGST"><input type="text" name="cgstamount<?php echo $i ?>" id="cgstamount<?php echo $i ?>" class="form-control form-control-sm" placeholder="CGST" value="<?php echo $serviceData->cgst; ?>" readonly /></td>
                                   <td width="130"><input type="text" name="total_amount<?php echo $i ?>" id="total_amount<?php echo $i ?>" class="form-control form-control-sm" placeholder="Total" value="<?php echo $serviceData->total; ?>" readonly /></td>
                          </tr>
                        <?php $i++; } } ?>
                          
                                 </tbody>
                        
                          </table>
                          <table class="table table-sm">
                            <thead>
                            <tr>
                              <th></th>
                              <th>Total Commission Amount</th>
                              <th>Total GST Amount</th>
                              <th>Grand Total</th>
                            </tr>
                            </thead>
                                <tbody>
                                <tr>
                                <td style="width: 70%" align="right" ></td>
                                <td align="right"><div style="float: right;" width="100">
                                  <input type="text" placeholder="Amount" name="tprice" id="tprice" value="<?php if($action == 'edit'){ echo $subtotal;  }else { echo '0';} ?>" class="form-control form-control-sm" readonly>
                                </td>
                                <td align="right"><div style="float: right;" width="80">
                                  <input type="text" placeholder="GST" name="gstTotalAmount" id="gstTotalAmount" value="<?php if($action == 'edit'){ echo $gstTotal;  } else { echo '0';} ?>" class="form-control form-control-sm" readonly>
                                </td>
                                <td align="right"><div style="float: right;" width="130">
                                  <input type="text" placeholder="Total" name="gtprice" id="gtprice" value="<?php if($action == 'edit'){ echo $grandTotal;  } else { echo '0';}  ?>" class="form-control form-control-sm" readonly>
                                </td>
                              </tr>
                              <tr><td colspan="4"> <span id="wordamount" class="text-muted font-size-sm"></span></td></tr>
                              <tr>
                                <td colspan="4">
                                  <button type="button" tabindex="-1" class="btn btn-primary btn-sm" id="addButton"><i class="fa fa-plus"></i></button>
                                  <button type="button" tabindex="-1" class="btn btn-danger btn-sm" id="removeButton"><i class="fa fa-minus"></i></button>
                                </td>
                                
                              </tr>
                              <input type="hidden" name="totalrows" id="totalrows" value="<?php if($action =='edit'){echo $serviceCount; }else{ echo 1; } ?>">
                              <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                              <input type="hidden" name="invoice_id" value="<?php if($action== 'edit'){ echo $invoiceData->id; } ?>">
                              <input type="hidden" name="bankperson_phone" id="bankperson_phone" value="<?php if($action== 'edit'){ echo $branchDetails->bank_person_phone; } ?>">
                            </tbody>
                          </table>
                         
                        </div>
                      </div>
                    
                  </fieldset>
                  <div id="bankcharges">
           
        </div>
                  
                  <button class="btn btn-secondary" type="reset">Reset</button>
                  <?php if($invoiceData->preview_status != 'y'){  ?>
                    <button class="btn btn-primary" type="submit" id="invoicesubmit">Preview</button>
                  <?php }else{ ?>
                     <button class="btn btn-primary" type="submit" id="invoicesubmit">Save</button>
                  <?php } ?>
                </form>
              </div>
            </div>
          </section>
        </div>
     
      </div>
    </div>
    <!-- /Main body -->
  </div>
  <!-- /Main -->
 
  <!-- Main Scripts -->
  <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>
  <!-- <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->
  <!-- Plugins -->
    <script src="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.js"></script>
  <script>
    var LineTypes = "";
    $(() => {
      $('.summernote').summernote()
       $('.summernote-air').summernote({
        airMode: true
      })
        // Allow Input
      flatpickr('.datepicker-input', {
        allowInput: true,
        maxDate: new Date(),
      })
    })
  </script>
  <!-- JS plugins goes here -->
  <script type="text/javascript">
   $("#addButton").click(function () {
    var limitRows = 10;
    var presentRows = $("#totalrows").val();
      if(presentRows < limitRows){
        var presentRow = parseInt(presentRows)+1;
        $("#totalrows").val(presentRow);
        var newTr = $('<tr></tr>').attr("id", "row_"+presentRow);
        //<span class="small" id="borrower_name<?php echo $i ?>_error" style="color:red;"></span>
        newTr.html("<td width='20'>"+presentRow+"</td><td><select name='line_id"+presentRow+"' id='line_id"+presentRow+"' class='form-control form-control-sm line_type'>"+LineTypes+"</select><span id='line_id"+presentRow+"_error' class='small' style='color:red'></span></td><td><input type='text' name='borrower_name"+presentRow+"' id='borrower_name"+presentRow+"' class='form-control form-control-sm' placeholder='Enter Details' value=''  /><span id='borrower_name"+presentRow+"_error' class='small' style='color:red'></span></td><td width='130'><input type='text' name='recovered_amt"+presentRow+"' id='recovered_amt"+presentRow+"' class='form-control form-control-sm' placeholder='Recovered Amount' value='' onchange='amountCal(this,"+presentRow+")'/><span id='recovered_amt"+presentRow+"_error' class='small' style='color:red'></span></td><td width='130'><input type='text' name='date"+presentRow+"' id='date"+presentRow+"' class='form-control form-control-sm datepicker-input' placeholder='Date' value=''  /><span id='date"+presentRow+"_error' class='small' style='color:red'></span></td><td width='130'><input type='text' name='commission_charges"+presentRow+"' id='commission_charges"+presentRow+"' class='form-control form-control-sm' placeholder='Commission Charges' value='' onchange='amountCal(this,"+presentRow+")'  /><span id='commission_charges"+presentRow+"_error' class='small' style='color:red'></span></td><td width='100'><input type='text' name='gst_p"+presentRow+"' id='gst_p"+presentRow+"' class='form-control form-control-sm' placeholder='SGST' value='0' onchange='amountCal(this,"+presentRow+")' /></td><td width='100' class='CGST'><input type='text' name='cgst_p"+presentRow+"' id='cgst_p"+presentRow+"' class='form-control form-control-sm CGST' placeholder='CGST' value='0' onchange='amountCal(this,"+presentRow+")' /></td><td width='100'><input type='text' name='gstamount"+presentRow+"' id='gstamount"+presentRow+"' class='form-control form-control-sm' placeholder='SGST' value='0' readonly /></td><td class='CGST' width='100'><input type='text' name='cgstamount"+presentRow+"' id='cgstamount"+presentRow+"' class='form-control form-control-sm' placeholder='CGST' value='0' readonly /></td><td width='130'><input type='text' name='total_amount"+presentRow+"' id='total_amount"+presentRow+"' class='form-control form-control-sm' placeholder='Total' value='0' readonly /></td>");
         newTr.appendTo("#dTable"); 
         flatpickr('.datepicker-input', {
          allowInput: true,
        maxDate: new Date(),
        })       
        
        var state_id = $("#state_id").val();
        if(state_id == 2) {
              $(".CGST").addClass('d-line').removeClass('d-none');
         } else {
             $(".CGST").addClass('d-none').removeClass('d-line');
         }
 }else {
        alert("Limit Only 10 Rows");
        return false;
    }
});
   $("#removeButton").click(function () {
    var limitRows = 1;
    var presentRows =  $("#totalrows").val();
    var presentRow = parseInt(presentRows);
      if(presentRow <=1){
          alert("At Least Keep One Row ");
          return false;
      } else {            
          $("#row_"+presentRow).remove();   
          $("#totalrows").val(presentRow-1);    
      }
      amountCal(1,1);
    });

   
   $("#gtprice").on('change',function(){
      var tprice = document.getElementById("gtprice").value;
      var wordAmount = convertNumberToWords(tprice);
      //  alert(wordAmount);
      $('#wordamount').text(wordAmount);
    });
   function convertNumberToWords(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    return words_string+' Rupees Only';
}
function amountCal(a,id) {     
       
        var totalRows = document.getElementById("totalrows").value;     
        var total = 0;
        var gstTotal =0;
        var gst =18; 
        var amount=0;
         var gstAmount =0;
         var cgstAmount =0;
         var gstHsn =0;
        var commission_charges=0;
        var gstp = 0;
        var cgstp = 0;
        var recovered_amt=0;
        for(i=1; i<=totalRows; i++){   
              recovered_amt = parseInt(document.getElementById("recovered_amt"+i).value); 
              gstp = parseInt(document.getElementById("gst_p"+i).value)
              cgstp = parseInt(document.getElementById("cgst_p"+i).value); 
              commission_charges = parseInt(document.getElementById("commission_charges"+i).value); 
              if(commission_charges) {
                amount = parseInt(commission_charges);
              } else {
                amount = parseInt(0);
              }

              if(gstp == '0'){
                gstAmount = 0;
              }else {
                gstAmount = Math.round((amount/100)*gstp);
              }
               if(cgstp == '0'){
                cgstAmount = 0;
              }else {
                cgstAmount = Math.round((amount/100)*cgstp);
              }
              
              
              document.getElementById("gstamount"+i).value  = gstAmount;
              document.getElementById("cgstamount"+i).value  = cgstAmount;
              document.getElementById("total_amount"+i).value = amount+gstAmount+cgstAmount;
              total+= amount;
              gstTotal+= gstAmount;
              gstTotal+= cgstAmount;
          }
        document.getElementById("tprice").value = total;
        document.getElementById("gstTotalAmount").value = gstTotal;
        document.getElementById("gtprice").value = gstTotal+total;
        $("#gtprice").trigger("change");
}

    $("#order_id").on("change",function(){
     var order_id = $(this).val();
     
     $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getBankCharges",
        data: 'order_id='+order_id,
        type: "POST",  
        success:function(data){ 
           $("#bankcharges").html(data);   
                     
        }
    });
   
    });
$("#loan_type_id").on("change",function(){
    $("#LoanTypeChangedValue").html("");
     $("#new_files").html("&nbsp;");
	$("#pcharges").css("display","none");
  var loan_type_id = $(this).val();
  var invoice_type = $("#invoice_type").val();
  if(loan_type_id == '1'  && invoice_type == '2'){
    $("#recovery_div").css("display","block");
    $("#recovery_type").html("<option value='' selected>Select Recovery Type</option><option value='release' <?php if($action == 'edit'){  if($invoiceData->recovery_type == 'release'){ echo 'selected'; }  } ?>>Release</option><option value='auction' <?php if($action == 'edit'){  if($invoiceData->recovery_type =='auction'){ echo 'selected'; }  } ?>>Auction</option><option value='recovery' <?php if($action == 'edit'){  if($invoiceData->recovery_type =='recovery'){ echo 'selected'; }  } ?>>Recovery</option>");
    $("#invoice_type").trigger('change');
  } else if(loan_type_id == '5' && invoice_type == '2'){
    $("#recovery_div").css("display","block");
    $("#recovery_type").html("<option value='' selected>Select Recovery Type</option><option value='13/2' <?php if($action == 'edit'){  if($invoiceData->recovery_type == '13/2'){ echo 'selected'; }  } ?>>13/2</option><option value='13/4' <?php if($action == 'edit'){  if($invoiceData->recovery_type =='13/4'){ echo 'selected'; }  } ?>>13/4</option><option value='nps' <?php if($action == 'edit'){  if($invoiceData->recovery_type =='nps'){ echo 'selected'; }  } ?>>NPS</option>");
    $("#invoice_type").trigger('change');
  } else{
    $("#recovery_div").css("display","none");
  }
  
  if(loan_type_id == '1'){
    $("#seizediv").css("display","block");
  }else{
    $("#seizediv").css("display","none");
  }
  if(loan_type_id == '1'){
    $("#parkingdiv").addClass('d-line').removeClass('d-none');
  }else{
    $("#parkingdiv").addClass('d-none').removeClass('d-line');
  }
  /*if(loan_type_id == '1') {
    $("#LoanTypeChangedValue").html("<h6>Files List</h6><ol><li>Work Order Copy &nbsp;<span style='color:red'>(Mandatory)</span></li><li>Car Loan DOC &nbsp;<span style='color:red'>(Mandatory)</li><li>Panchanama &nbsp;<span style='color:red'>(Mandatory)</li><li>Seized Photos&nbsp;<span style='color:red'>(Mandatory)</li><li>Bank Releasing Letter</li></ol>");
  } else if(loan_type_id == '5') {
    $("#LoanTypeChangedValue").html("<h6>Files List</h6><ol><li>13/2 Notice</li><li>13/2 Serving Notice</li><li>13/2 Postal Slips</li><li>13/2 Serving Photos</li><li>News paper telugu</li><li>News paper english</li></ol>");
  } else {
    $("#LoanTypeChangedValue").html("&nbsp;");
  }*/

  var prow = $("#totalrows").val();
  if(invoice_type != '' && loan_type_id!= ''){
      $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getLineTypes",
        data: 'invoice_type='+invoice_type+'&loan_type_id='+loan_type_id,
        type: "POST",  
        success:function(data){ 
            var htmlString ="";
            htmlString+="<option value=''>Select Line Types</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['linetype_id']+">"+data[i]['linetype_name']+"</option>"
            });
            LineTypes = htmlString;
           for (let i = 1; i <= prow; i++) {
                  $("#line_id"+i).html(htmlString);
              }    
           
        }
      });
     }
  //seizediv
  changeAutoComplete(loan_type_id);
});
$("#recovery_type").on("change",function(){
    $("#LoanTypeChangedValue").html("&nbsp;");
     $("#new_files").html("&nbsp;");
    var recovery_type = $(this).val();
    var loan_type_id = $("#loan_type_id").val();
    $("#LoanTypeChangedValue").html("&nbsp;");
    if(loan_type_id =='1' && (recovery_type == 'release' || recovery_type == 'auction')) {
        $("#LoanTypeChangedValue").html("<h6>Files List</h6><ol><li>Work Order Copy &nbsp;<span style='color:red'>(Mandatory)</span></li><li>Car Loan DOC &nbsp;<span style='color:red'>(Mandatory)</li><li>Panchanama &nbsp;<span style='color:red'>(Mandatory)</li><li>Seized Photos&nbsp;<span style='color:red'>(Mandatory)</li><li>Bank Releasing Letter</li></ol>");
        $("#new_files").html("<div class='form-group col-md-4'><label for='work_order_copy'>Work Order Copy <span style='color:red;'>*</span></label><input type='file' class='form-control' name='work_order_copy' id='work_order_copy'><span class='small' id='work_order_copy_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='car_loan_doc'>Car Loan DOC <span style='color:red;'>*</span></label><input type='file' class='form-control' name='car_loan_doc' id='car_loan_doc'><span class='small' id='car_loan_doc_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='panchanama'>Panchanama <span style='color:red;'>*</span></label><input type='file' class='form-control' name='panchanama' id='panchanama'><span class='small' id='panchanama_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='seized_photos'>Seized Photos <span style='color:red;'>*</span></label><input type='file' class='form-control' name='seized_photos' id='seized_photos'><span class='small' id='seized_photos_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='bank_releasing_letter'>Bank Releasing Letter</label><input type='file' class='form-control' name='bank_releasing_letter' id='bank_releasing_letter'><span class='small' id='bank_releasing_letter_error' style='color:red;'></span></div>");

      } else if(loan_type_id =='1' && recovery_type == 'recovery') {
        $("#LoanTypeChangedValue").html("<h6>Files List</h6><ol><li>Work Order Copy &nbsp;<span style='color:red'>(Mandatory)</span></li><li>Car Loan DOC &nbsp;<span style='color:red'>(Mandatory)</li></ol>");
        $("#new_files").html("<div class='form-group col-md-4'><label for='work_order_copy'>Work Order Copy <span style='color:red;'>*</span></label><input type='file' class='form-control' name='work_order_copy' id='work_order_copy'><span class='small' id='work_order_copy_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='car_loan_doc'>Car Loan DOC <span style='color:red;'>*</span></label><input type='file' class='form-control' name='car_loan_doc' id='car_loan_doc'><span class='small' id='car_loan_doc_error' style='color:red;'></span></div>");
      } else if(loan_type_id =='5' && (recovery_type == 'nps' || recovery_type == '13/4')) {
        $("#LoanTypeChangedValue").html("<h6>Files List</h6><ol><li>13/2 Notice <span style='color:red'>(Mandatory)</span></li><li>13/2 Serving Notice <span style='color:red'>(Mandatory)</span></li><li>13/2 Postal Slips<span style='color:red'>(Mandatory)</span></li><li>13/2 Serving Photos&nbsp;<span style='color:red'>(Mandatory)</span></li><li>News paper telugu&nbsp;<span style='color:red'>(Mandatory)</span></li><li>News paper english&nbsp;<span style='color:red'>(Mandatory)</span></li></ol>");
        $("#new_files").html("<div class='form-group col-md-4'><label for='notice_13_2'>13/2 Notice<span style='color:red;'>*</span></label><input type='file' class='form-control' name='notice_13_2' id='notice_13_2'><span class='small' id='notice_13_2_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='serving_notice_13_2'>13/2 Serving Notice<span style='color:red;'>*</span></label><input type='file' class='form-control' name='serving_notice_13_2' id='serving_notice_13_2'><span class='small' id='serving_notice_13_2_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='postal_slips_13_2'>13/2 Postal Slips<span style='color:red;'>*</span></label><input type='file' class='form-control' name='postal_slips_13_2' id='postal_slips_13_2'><span class='small' id='postal_slips_13_2_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='serving_photos_13_2'>13/2 Serving Photos<span style='color:red;'>*</span></label><input type='file' class='form-control' name='serving_photos_13_2' id='serving_photos_13_2'><span class='small' id='serving_photos_13_2_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='news_paper_telugu'>News paper telugu<span style='color:red;'>*</span></label><input type='file' class='form-control' name='news_paper_telugu' id='news_paper_telugu'><span class='small' id='news_paper_telugu_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='news_paper_english'>News paper english<span style='color:red;'>*</span></label><input type='file' class='form-control' name='news_paper_english' id='news_paper_english'><span class='small' id='news_paper_english_error' style='color:red;'></span></div>");
      } else if(loan_type_id =='5' && recovery_type == '13/2') {
        $("#LoanTypeChangedValue").html("<h6>Files List</h6><ol><li>13/2 Notice <span style='color:red'>(Mandatory)</span></li><li>13/2 Serving Notice <span style='color:red'>(Mandatory)</span></li><li>13/2 Postal Slips<span style='color:red'>(Mandatory)</span></li><li>13/2 Serving Photos&nbsp;<span style='color:red'>(Mandatory)</span></li><li>News paper telugu&nbsp;</li><li>News paper english&nbsp;</li></ol>");
        $("#new_files").html("<div class='form-group col-md-4'><label for='notice_13_2'>13/2 Notice<span style='color:red;'>*</span></label><input type='file' class='form-control' name='notice_13_2' id='notice_13_2'><span class='small' id='notice_13_2_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='serving_notice_13_2'>13/2 Serving Notice<span style='color:red;'>*</span></label><input type='file' class='form-control' name='serving_notice_13_2' id='serving_notice_13_2'><span class='small' id='serving_notice_13_2_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='postal_slips_13_2'>13/2 Postal Slips<span style='color:red;'>*</span></label><input type='file' class='form-control' name='postal_slips_13_2' id='postal_slips_13_2'><span class='small' id='postal_slips_13_2_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='serving_photos_13_2'>13/2 Serving Photos<span style='color:red;'>*</span></label><input type='file' class='form-control' name='serving_photos_13_2' id='serving_photos_13_2'><span class='small' id='serving_photos_13_2_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='news_paper_telugu'>News paper telugu</label><input type='file' class='form-control' name='news_paper_telugu' id='news_paper_telugu'><span class='small' id='news_paper_telugu_error' style='color:red;'></span></div><div class='form-group col-md-4'><label for='news_paper_english'>News paper english</label><input type='file' class='form-control' name='news_paper_english' id='news_paper_english'><span class='small' id='news_paper_english_error' style='color:red;'></span></div>");

      } else if(loan_type_id =='2' || loan_type_id =='3' || loan_type_id =='4') {
          $("#LoanTypeChangedValue").html("&nbsp;");
          $("#new_files").html("&nbsp;");
      }else {
        $("#LoanTypeChangedValue").html("&nbsp;");
        $("#new_files").html("&nbsp;");
      }
});
  $("#invoice_type").on("change",function(){

     var invoice_type = $(this).val();
     var order_id = $("#order_id").val();
     var loan_type_id = $("#loan_type_id").val();

    if(loan_type_id == '1' && invoice_type == '2'){
      $("#recovery_div").css("display","block");
    } else if(loan_type_id == '5' && invoice_type == '2'){
      $("#recovery_div").css("display","block");
    }else{
      $("#recovery_div").css("display","none");
    }

     var prow = $("#totalrows").val();
     if(invoice_type != '' && loan_type_id!= ''){
      $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getLineTypes",
        data: 'invoice_type='+invoice_type+'&loan_type_id='+loan_type_id,
        type: "POST",  
        success:function(data){ 
            var htmlString ="";
            htmlString+="<option value=''>Select Line Types</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['linetype_id']+">"+data[i]['linetype_name']+"</option>"
            });
            LineTypes = htmlString;
           for (let i = 1; i <= prow; i++) {
                  $("#line_id"+i).html(htmlString);
              }    
           
        }
      });
     }
     
     // alert(loan_type_id);
     if(loan_type_id == '1'){
     $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getLoanaccounts",
        data: 'invoice_type='+invoice_type+'&order_id='+order_id,
        type: "POST",  
        success:function(data){ 
            var htmlString ='';
            htmlString+="<option value=''>Select Loan Account</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['loan_id']+">"+data[i]['barrower_name']+"_"+data[i]['loan_ac_number']+"</option>"
            });
            $("#loan_id").html(htmlString);            
        }
    });
   }else {
         $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getLoanaccounts_loans",
        data: 'invoice_type='+invoice_type+'&loan_type_id='+loan_type_id,
        type: "POST",  
        success:function(data){ 
            var htmlString ='';
            htmlString+="<option value=''>Select Loan Account</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['loan_id']+">"+data[i]['barrower_name']+"_"+data[i]['loan_ac_number']+"</option>"
            });
            $("#loan_id").html(htmlString);            
        }
    });
   }
   
    });

    $("#loan_id").on("change",function(){          
      var loan_id = $(this).val();
      $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getLoanaccountsDetails",
        data: {loan_id: loan_id },  
        type: "POST",  
        success:function(data){ 
          $('#account').attr('value', data['loan_ac_number']);
          $('#gst_no').attr('value', data['gst_no']).change();
          var status = data['status'];          
          if( data['status'] == 'rel' ||  data['status'] =='a'){
          $.ajax({  
            url:"<?php echo base_url(); ?>Invoice/getParkingDays",
            data: 'loan_id='+loan_id+'&status='+status, 
            type: "POST",  
            success:function(data1){ 
                $("#pcharges").attr("style", "display:block");
                $("#days").text(data1['days'] );
                 $("#Sez_date").text(data1['sdate'] );
                  $("#rel_date").text(data1['rdate'] );
            }
          });
         }
        }
      });
   
    });

     /*$("#gst_no").on("change",function(){  
       var loan_id = $("#loan_id").val();
      $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getVendorId",
        data: {loan_id: loan_id },  
        type: "POST",  
        success:function(data){ 
          $('#vendor_no').attr('value', data['vendor_no']);
          }
    });
     });*/


$("#invoice_submit").on("submit",function(){
  var order_id = $("#order_id").val();
  var loan_type_id = $("#loan_type_id").val();
  var invoice_type = $("#invoice_type").val();
  var loan_id = $("#loan_id").val();
  var bill_date = $("#bill_date").val();
  var gst_no = $("#gst_no").val();
  var account = $("#account").val();
  var totalrows = $("#totalrows").val();
  var recovery_type = $("#recovery_type").val();

  //var loan_type_id = $("#loan_type_id").val();

  if(loan_type_id == ''){
    $("#loan_type_error").html("Select Loan Type");
    $("#loan_type_id").focus();
    return false;
  }else{
    $("#loan_type_error").html("");
  }
  /*if(loan_type_error == ''){
    $("#loan_type_error").html("Select Loan Type");
    $("#loan_type_error").focus();
    return false;
  }else{
    $("#loan_type_error_error").html("");
  }*/

if(loan_type_id == '1'){

  /*if(order_id == ''){
    $("#order_id_error").html("Select Work Order Is Required");
    $("#order_id").focus();
    return false;
  }else{
    $("#order_id_error").html("");
  }*/
  var seizer_guidelines_followed = $('input[name="seizer_guidelines_followed"]:checked').val();
  
  var invoice_files = $("#invoice_files").val();
  
  if(seizer_guidelines_followed == 'y'){
  	if(invoice_files == ''){
  		/*$("#invoice_files_error").html("Invoice Files Required");
  		return false;*/
  	}else{
  		$("#invoice_files_error").html("");
  	}
  }else{
  	$("#invoice_files_error").html("");
  }
  
}else{
	$("#invoice_files_error").html("");
}

  if(invoice_type == ''){
    $("#invoice_type_error").html("Invoice Type Required");
    $("#invoice_type").focus();
    return false;
  }else{
    $("#invoice_type_error").html("");
  }

  if(loan_id == ''){
    $("#loan_id_error").html("Loan Acount Required");
    $("#loan_id").focus();
    return false;
  }else{
    $("#loan_id_error").html("");
  }
  if(bill_date == ''){
    $("#bill_date_error").html("Bill Date Required");
    $("#bill_date").focus();
    return false;
  }else{
    $("#bill_date_error").html("");
  }
  
  var bank_person_name = $("#bankperson_phone").val();
  if(bank_person_name == ''){
    $("#branch_id_error").html("Please add Bank person details for selected Branch");
    return false;
  }else{
    $("#branch_id_error").html("");
  }
  
/*start*/
<?php if($action != "edit") { ?>
if(loan_type_id =='1' && (recovery_type == 'release' || recovery_type == 'auction')) {
    var work_order_copy = $("#work_order_copy").val();
    var car_loan_doc = $("#car_loan_doc").val();
    var panchanama = $("#panchanama").val();
    var seized_photos = $("#seized_photos").val();
        
      if(work_order_copy == ''){
        $("#work_order_copy_error").html("Work Order Copy Required");
        $("#work_order_copy").focus();
        return false;
      }else{
        $("#work_order_copy_error").html("");
      }
      if(car_loan_doc == ''){
        $("#car_loan_doc_error").html("Car Loan DOC Required");
        $("#car_loan_doc").focus();
        return false;
      }else{
        $("#car_loan_doc_error").html("");
      }
      if(panchanama == ''){
        $("#panchanama_error").html("Panchanama Required");
        $("#panchanama").focus();
        return false;
      }else{
        $("#panchanama_error").html("");
      }

      if(seized_photos == ''){
        $("#seized_photos_error").html("Seized Photos Required");
        $("#seized_photos").focus();
        return false;
      }else{
        $("#seized_photos_error").html("");
      }

        
        

      } else if(loan_type_id =='1' && recovery_type == 'recovery') {
        var work_order_copy = $("#work_order_copy").val();
        var car_loan_doc = $("#car_loan_doc").val();
                  
          if(work_order_copy == ''){
            $("#work_order_copy_error").html("Work Order Copy Required");
            $("#work_order_copy").focus();
            return false;
          }else{
            $("#work_order_copy_error").html("");
          }
          if(car_loan_doc == ''){
            $("#car_loan_doc_error").html("Car Loan DOC Required");
            $("#car_loan_doc").focus();
            return false;
          }else{
            $("#car_loan_doc_error").html("");
          }
      } else if(loan_type_id =='5' && (recovery_type == 'nps' || recovery_type == '13/4')) {
        var notice_13_2 = $("#notice_13_2").val();
        var serving_notice_13_2 = $("#serving_notice_13_2").val();
        var postal_slips_13_2 = $("#postal_slips_13_2").val();
        var serving_photos_13_2 = $("#serving_photos_13_2").val();
        if(notice_13_2 == ''){
            $("#notice_13_2_error").html("13/2 Notice Required");
            $("#notice_13_2").focus();
            return false;
          }else{
            $("#notice_13_2_error").html("");
          }

         if(serving_notice_13_2 == ''){
            $("#serving_notice_13_2_error").html("13/2 Serving Notice Required");
            $("#serving_notice_13_2").focus();
            return false;
          }else{
            $("#serving_notice_13_2_error").html("");
          }
        if(postal_slips_13_2 == ''){
            $("#postal_slips_13_2_error").html("13/2 Serving Photos Required");
            $("#postal_slips_13_2").focus();
            return false;
          }else{
            $("#postal_slips_13_2_error").html("");
          }
        
        
        
      } else if(loan_type_id =='5' && recovery_type == '13/2') {
               
        var notice_13_2 = $("#notice_13_2").val();
        var serving_notice_13_2 = $("#serving_notice_13_2").val();
        var postal_slips_13_2 = $("#postal_slips_13_2").val();
        var serving_photos_13_2 = $("#serving_photos_13_2").val();
        var news_paper_telugu = $("#news_paper_telugu").val();
        var news_paper_english = $("#news_paper_english").val();
        if(notice_13_2 == ''){
            $("#notice_13_2_error").html("13/2 Notice Required");
            $("#notice_13_2").focus();
            return false;
          }else{
            $("#notice_13_2_error").html("");
          }

         if(serving_notice_13_2 == ''){
            $("#serving_notice_13_2_error").html("13/2 Serving Notice Required");
            $("#serving_notice_13_2").focus();
            return false;
          }else{
            $("#serving_notice_13_2_error").html("");
          }
        if(postal_slips_13_2 == ''){
            $("#postal_slips_13_2_error").html("13/2 Serving Photos Required");
            $("#postal_slips_13_2").focus();
            return false;
          }else{
            $("#postal_slips_13_2_error").html("");
          }
          if(news_paper_telugu == ''){
            $("#news_paper_telugu_error").html("News Paper Telugu Required");
            $("#news_paper_telugu").focus();
            return false;
          }else{
            $("#news_paper_telugu_error").html("");
          }
          if(news_paper_english == ''){
            $("#news_paper_english_error").html("News Paper English Required");
            $("#news_paper_english").focus();
            return false;
          }else{
            $("#news_paper_english_error").html("");
          }

          
          

      } else if(loan_type_id =='2' || loan_type_id =='3' || loan_type_id =='4') {
          
      }else {
        
      }
    <?php } ?>
/*end*/

  if(gst_no == ''){
    $("#gst_no_error").html("GST No Required");
    $("#gst_no").focus();
    return false;
  }else{
    $("#gst_no_error").html("");
  }
  if(account == ''){
    $("#account_error").html("Account No Required");
    $("#account").focus();
    return false;
  }else{
    $("#account_error").html("");
  }
  var borrower_name = "";
  var recovered_amt = "";
  var date_b = "";
  var commission_charges = "";

  for(i=1;i<=totalrows;i++){
    borrower_name = $("#borrower_name"+i).val();
    recovered_amt = $("#recovered_amt"+i).val();
    date_b = $("#date"+i).val();
    commission_charges = $("#commission_charges"+i).val();
    if(borrower_name == ''){
      $("#borrower_name"+i+"_error").html("Details Is  Required");
      $("#borrower_name").focus();
      return false;
    }else{
      $("#borrower_name"+i+"_error").html("");
    }
    

  }
  $("#invoicesubmit").hide();
  
});

$(document).ready(function(){
    $("#bank_id").on("change",function(){
     var bank_id = $(this).val();
     $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getBranchas",
        data: {bank_id: bank_id },  
        type: "POST",  
        success:function(data){ 
          //console.log(data);
            var htmlString ='';
            htmlString+="<option value=''>Select Branch</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['branch_id']+">"+data[i]['branch_name']+"</option>";
            });
            //console.log(htmlString);
            $("#branch_id").html(htmlString);    
            //$('#gst_no').attr('value', data[0]['gst_no']).change();        
        }
    });
  });
  
  <?php if($action == 'edit'){ ?> 
    <?php if($state_id == 2) { ?>
        $(".CGST").addClass('d-line').removeClass('d-none');
    <?php } else { ?>
        $(".CGST").addClass('d-none').removeClass('d-line');
    <?php } ?>
  <?php } else { ?>
    $(".CGST").addClass('d-none').removeClass('d-line');
  <?php } ?>
    var show_state_gst = 1;
    $("#branch_id").on("change",function(){
       
        var trows = $('#totalrows').val(); 
         for(i=trows;i>1;i--) {
             $("#removeButton").trigger('click');
         }
         $("#commission_charges1").val('');
         $("#recovered_amt1").val('');
         $("#borrower_name1").val('');
         $("#line_id1").val('');
         $("#gstamount1").val(0);
         $("#cgstamount1").val(0);
         $("#tprice").val(0);
         $("#gstTotalAmount").val(0);
         $("#gtprice").val(0);
         $("#total_amount1").val(0);
         $("#gst_p1").val(0);
         

     var branch_id = $(this).val();
     
     $.ajax({
        url:"<?php echo base_url(); ?>Invoice/getBrachDetails",
        data: {branch_id: branch_id },  
        type: "POST",  
        success:function(data){ 
            
            $("#bankperson_phone").val(data.bank_person_phone)
        }
    });
    
     $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getGst",
        data: {branch_id: branch_id },  
        type: "POST",  
        success:function(data){ 
            var htmlString ='';
            $('#gst_no').attr('value', data['gst_no']).change();   
             var state_id = $("#state_id").val(data['state_id']);
             if(data['state_id'] == 2) {
                  $(".CGST").addClass('d-line').removeClass('d-none');
             } else {
                 $(".CGST").addClass('d-none').removeClass('d-line');
             }
        }
    });
  });
   $("#dTable").on('click','.line_type',function(){
      var thisVal = $(this).closest('.line_type');
      var thisId = thisVal.attr('id');
      var res = thisId.replace('line_id','');
      var getID = "borrower_name"+res;
      $("#"+getID).val(thisVal.find("option:selected").text());

    });

});


function changeParking(val){
	if(val == 'y'){
		$("#pcharges").css("display","block");
	}else{
		$("#pcharges").css("display","none");
	}
}
$("#end_date").on("change",function(){
	var start_date = new Date($("#start_date").val());
	var end_date = new Date($("#end_date").val());
	var difference = end_date.getTime() - start_date.getTime();
	var TotalDays = (Math.ceil(difference / (1000 * 3600 * 24)) + 1);
	$("#days").html(TotalDays+" Days");
	
})

$("#start_date").on("change",function(){
	if($("#end_date").val() != ''){
		var start_date = new Date($("#start_date").val());
		var end_date = new Date($("#end_date").val());
		var difference = end_date.getTime() - start_date.getTime();
		var TotalDays = (Math.ceil(difference / (1000 * 3600 * 24)) + 1);
		$("#days").html(TotalDays+" Days");	
	}
})

<?php if($action == 'edit'){ ?>
    let invoice_type_temp = $("#invoice_type").val();
     let loan_type_id_temp = $("#loan_type_id").val();
if(invoice_type_temp != '' && loan_type_id_temp!= ''){
      $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getLineTypes",
        data: 'invoice_type='+invoice_type_temp+'&loan_type_id='+loan_type_id_temp,
        type: "POST",  
        success:function(data){ 
            var htmlString ="";
            htmlString+="<option value=''>Select Line Types</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['linetype_id']+">"+data[i]['linetype_name']+"</option>"
            });
            LineTypes = htmlString;
           
        }
      });
}
<?php } ?>
</script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
  $( function() {
    var availableTags = [
      <?php echo $all_loan_accounts; ?>
    ];
    $("#account").autocomplete({
      source: availableTags
    });
  } );
  
  function changeAutoComplete(loan_type_id) {
      $("#invoicesubmit").show();
      $("#account").val('');
       var availableTags = [
      <?php echo $all_loan_accounts; ?>
    ];
      if(loan_type_id == 1) {
        $("#account").autocomplete({
          source: availableTags,
          change: function(event, ui) {
            if (ui.item) {
                $("#invoicesubmit").show();
                $("#account_error").text('');
            } else {
                var ltp_id = $("#loan_type_id").val();
                if(ltp_id == 1) {
                    // $("#invoicesubmit").hide();
                    // $("#account_error").text("Loan Account Number Not Available");
                }
            }
        }
        });
    } else {
         $("#invoicesubmit").show();
        $("#account_error").text('');
        $("#account").autocomplete({
          source: availableTags,
        });
    }
  }
  </script>
  <!-- Button trigger modal -->
<?php if($action == "edit") { ?>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">List of uploaded files</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">FIle Name</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>
        <?php 
        $i =1;
        foreach ($getInvFiles as $key => $value) {
         ?>
    <tr>
      <th scope="row"><?=$i++;?></th>
      <td><?=$value->display_name;?></td>
      <td><a href="<?php echo base_url().'assets/invoice_files/'.$value->file_name; ?>" download>View</a></td>
    </tr>
    <?php } ?>
        </tbody>
    </table>
      </div>
      
    </div>
  </div>
</div>
<?php } ?>
<?php if($action == "edit") { ?>
  <script type="text/javascript">
    var loan_type_id = $("#loan_type_id").val();
    if(loan_type_id == '1' || loan_type_id == '5') {
      $("#recovery_type").trigger('change');
    }
  </script>
<?php } ?>

</body>
</html>