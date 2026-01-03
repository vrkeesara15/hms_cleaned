<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loanaccounts">Manage Car Loan Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Car Loan Account</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">
  <section id="section4" class="mt-2">
            <h5>Create Loan Account Form</h5>
           
            <div class="card">
              <div class="card-body">
                 <form action="<?php echo base_url().'Loanaccounts/insertloandetails'; ?>" name="loanaccount_submit" id="loanaccount_submit" method="post" enctype="multipart/form-data">
                  <fieldset class="form-fieldset">
                    <legend>Basic Details</legend>
                   <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="fname">Select Bank</label>
                     <select class="custom-select" id="bank_id" name="bank_id">
                          <option value='' selected>Select Bank</option>
                          <?php foreach ($banks as  $value) { ?>
                            <option value="<?php echo $value->bank_id; ?>" <?php if($action == 'edit'){  if($loandata->bank_id == $value->bank_id){ echo "selected"; }  } ?>><?php echo $value->bank_name; ?></option>
                          <?php } ?>
                        </select>
                      <span class="small" id="bank_id_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-4">
                       <label for="fname">Select Branch</label>
                     <select class="custom-select" id="branch_id" name="branch_id">
                          <option value='' selected>Select Branch</option>
                          <?php 
                          if(!empty($branchs)){
                          foreach ($branchs as  $value) { ?>
                            <option value="<?php echo $value->branch_id; ?>" <?php if($action == 'edit'){  if($loandata->branch_id == $value->branch_id){ echo "selected"; }  } ?>><?php echo $value->branch_name; ?></option>
                          <?php } } ?>
                        </select>
                      <span class="small" id="branch_id_error" style="color:red;"></span> 
                    </div>
                     <div class="form-group col-md-4">
                       <label for="fname">Select Home Branch</label>
                     <select class="custom-select" id="home_branch_id" name="home_branch_id">
                          <option value='' selected>Select Home Branch</option>
                          <?php
                          if(!empty($branchs)){
                          foreach ($branchs as  $value) { ?>
                            <option value="<?php echo $value->branch_id; ?>" <?php if($action == 'edit'){  if($loandata->home_branch_id == $value->branch_id){ echo "selected"; }  } ?>><?php echo $value->branch_name; ?></option>
                          <?php } } ?>
                        </select>
                      <span class="small" id="home_branch_id_error" style="color:red;"></span> 
                    </div>
                    
                  </div>
                  <div class="form-row">
                     
                    <div class="form-group col-md-4">                      
                      <label for="loan_ac_number">Loan Ac Number</label>
                      <input type="text" class="form-control" name="loan_ac_number" id="loan_ac_number" placeholder="Loan Ac Number" value="<?php if($action == 'edit'){ echo $loandata->loan_ac_number; } ?>">
                      <span class="small" id="loan_ac_number_error" style="color:red;"></span>
                
                    </div>
                  
                    <div class="form-group col-md-4">
                     <label for="barrower_name">Borrower Name</label>
                      <input type="tel" class="form-control" name="barrower_name" id="barrower_name" placeholder="Borrower Name" value="<?php if($action == 'edit'){ echo $loandata->barrower_name; } ?>">
                      <span class="small" id="barrower_name_error" style="color:red;"></span>
                    </div>
                    
                    <div class="form-group col-md-4">
                     <label for="RBO">RBO</label>
                       <select class="custom-select" id="rbo_id" name="rbo_id">
                          <option value='' selected>Select RBO</option>
                          <?php 
                          if(!empty($rbos)){
                          foreach ($rbos as  $value) { ?>
                            <option value="<?php echo $value->rbo_id; ?>" <?php if($action == 'edit'){  if($loandata->rbo_id == $value->rbo_id){ echo "selected"; }  } ?>><?php echo $value->rbo_name; ?></option>
                          <?php } } ?>
                        </select>
                      <span class="small" id="rbo_error" style="color:red;"></span>
                    </div>
                   
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-4">                      
                      <label for="vehicle_number">Vehicle Number</label>
                      <input type="tel" class="form-control" name="vehicle_number" id="vehicle_number" placeholder="Enter Vehicle Number" value="<?php if($action == 'edit'){ echo $loandata->vehicle_number; } ?>">
                      <span class="small" id="vehicle_number_error" style="color:red;"></span>               
                    </div>
                    <div class="form-group col-md-4">
                     <label for="vehicle_chasse_number">Vehicle Chassis Number</label>
                      <input type="text" class="form-control" name="vehicle_chasse_number" id="vehicle_chasse_number" placeholder="Vehicle Chassis Number" value="<?php if($action == 'edit'){ echo $loandata->vehicle_chasse_number; } ?>">
                      <span class="small" id="vehicle_chasse_number_error" style="color:red;"></span>
                    </div>
                    <div class="form-group col-md-4">                      
                       <label for="vehicle_engine_num">Vehicle Engine Number</label>
                      <input type="tel" class="form-control" name="vehicle_engine_num" id="vehicle_engine_num" placeholder="Vehicle Engine Number" value="<?php if($action == 'edit'){ echo $loandata->vehicle_engine_num; } ?>">
                      <span class="small" id="vehicle_engine_num_error" style="color:red;"></span>
                    </div>                  
                 
                    </div>
                 
                 </fieldset>
                    <fieldset class="form-fieldset">
                    <legend>Vehicle other Details</legend>

                 <div class="form-row">
                    <div class="form-group col-md-4">
                     <label for="make_company">Make Company</label>
                      <input type="text" class="form-control" name="make_company" id="make_company" placeholder="Make Company" value="<?php if($action == 'edit'){ echo $loandata->make_company; } ?>">
                      <span class="small" id="make_company_error" style="color:red;"></span>
                    </div>
                    <div class="form-group col-md-4">                      
                       <label for="year_of_make">Year of Make</label>
                      <input type="tel" class="form-control" name="year_of_make" id="year_of_make" placeholder="Year of Make" 
                      value="<?php if($action == 'edit'){
                          if($loandata->year_of_make !='0000'){
                       echo $loandata->year_of_make; } } ?>">
                      <span class="small" id="year_of_make_error" style="color:red;"></span>
                    </div>
                  
                    <div class="form-group col-md-4">
                     <label for="rc_number">Make & Model</label>
                      <input type="tel" class="form-control" name="rc_number" id="rc_number" placeholder="Make & Model" value="<?php if($action == 'edit'){ echo $loandata->rc_number; } ?>">
                      <span class="small" id="rc_number_error" style="color:red;"></span>
                    </div>
                    </div>
                 <!--     <div class="form-row">
                    <div class="form-group col-md-4">
                     <label for="insurance_company">Insurance Company</label>
                      <input type="text" class="form-control" name="insurance_company" id="insurance_company" placeholder="Insurance Company " value="<?php if($action == 'edit'){ echo $loandata->insurance_company; } ?>">
                      <span class="small" id="value_error" style="color:red;"></span>
                    </div>
                    <div class="form-group col-md-4">                      
                       <label for="insurance_expiry">Insurance Expiry</label>
                      <input type="tel" class="form-control datetimepicker" name="insurance_expiry" id="insurance_expiry" placeholder="Insurance Expiry" value="<?php if($action == 'edit'){ if($loandata->insurance_expiry !='0000-00-00 00:00:00'){ echo $loandata->insurance_expiry; } } ?>">
                      <span class="small" id="insurance_expiry_error" style="color:red;"></span>
                    </div>
                    </div> -->
                   </fieldset>
                    <fieldset class="form-fieldset">
                    <legend>Customer Other Details</legend>
                    <div class="form-row">
                    <div class="form-group col-md-4">
                     <label for="cus_mobile">Mobile Number</label>
                      <input type="text" class="form-control" name="cus_mobile" id="cus_mobile" placeholder="Enter Mobile Number" value="<?php if($action == 'edit'){ echo $loandata->cus_mobile; } ?>">
                      <span class="small" id="cus_mobile_error" style="color:red;"></span>
                    </div>
                    <div class="form-group col-md-4">
                     <label for="cus_mobile">Mobile Number2</label>
                      <input type="text" class="form-control" name="cus_mobile2" id="cus_mobile2" placeholder="Enter Mobile Number2" value="<?php if($action == 'edit'){ echo $loandata->cus_mobile2; } ?>">
                      <span class="small" id="cus_mobile2_error" style="color:red;"></span>
                    </div>
                    <div class="form-group col-md-4">
                     <label for="cus_mobile">Mobile Number3</label>
                      <input type="text" class="form-control" name="cus_mobile3" id="cus_mobile3" placeholder="Enter Mobile Number3" value="<?php if($action == 'edit'){ echo $loandata->cus_mobile3; } ?>">
                      <span class="small" id="cus_mobile3_error" style="color:red;"></span>
                    </div>
                    <div class="form-group col-md-4">                      
                       <label for="cus_pan">PAN Number</label>
                      <input type="tel" class="form-control" name="cus_pan" id="cus_pan" placeholder="Enter PAN Number" value="<?php if($action == 'edit'){ echo $loandata->cus_pan; } ?>">
                      <span class="small" id="cus_pan_error" style="color:red;"></span>
                    </div>
                  
                    <div class="form-group col-md-4">
                     <label for="cus_address">Address</label>
                      <input type="tel" class="form-control" name="cus_address" id="cus_address" placeholder="Enter Address" value="<?php if($action == 'edit'){ echo $loandata->cus_address; } ?>">
                      <span class="small" id="cus_address_error" style="color:red;"></span>
                    </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">                      
                         <label for="work_order_doc">Customer File</label>
                            <input type="file" class="form-control" name="work_order_doc" id="work_order_doc">
                            <span class="small" id="customer_file_error" style="color:red;"></span>
                        </div>
                        <div class="form-group col-md-4">                      
                           <label for="cus_pan">Customer Aadhar Number</label>
                          <input type="tel" class="form-control" name="cus_aadhar_no" id="cus_aadhar_no" placeholder="Enter Adhar Number" value="<?php if($action == 'edit'){ echo $loandata->cus_aadhar_no; } ?>">
                          <span class="small" id="cus_adhar_error" style="color:red;"></span>
                        </div>
                     </div>
                        </fieldset>
                    <fieldset class="form-fieldset">
                        <legend>Co-Applicant Details</legend>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                             <label for="cus_mobile">Mobile Number</label>
                              <input type="text" class="form-control" name="coapplicant_mobile" id="coapplicant_mobile" placeholder="Enter Mobile Number" value="<?php if($action == 'edit'){ echo $loandata->coapplicant_mobile; } ?>">
                              <span class="small" id="coapplicant_mobile_error" style="color:red;"></span>
                            </div>
                            <div class="form-group col-md-4">
                             <label for="cus_mobile">Mobile Number2</label>
                              <input type="text" class="form-control" name="coapplicant_mobile2" id="coapplicant_mobile2" placeholder="Enter Mobile Number2" value="<?php if($action == 'edit'){ echo $loandata->coapplicant_mobile2; } ?>">
                              <span class="small" id="coapplicant_mobile2_error" style="color:red;"></span>
                            </div>
                        
                            <div class="form-group col-md-4">                      
                               <label for="cus_pan">PAN Number</label>
                              <input type="tel" class="form-control" name="coapplicant_pan" id="coapplicant_pan" placeholder="Enter PAN Number" value="<?php if($action == 'edit'){ echo $loandata->coapplicant_pan; } ?>">
                              <span class="small" id="cus_pan_error" style="color:red;"></span>
                            </div>
                      
                            <div class="form-group col-md-4">
                             <label for="cus_address">Address</label>
                              <input type="tel" class="form-control" name="coapplicant_address" id="coapplicant_address" placeholder="Enter Address" value="<?php if($action == 'edit'){ echo $loandata->coapplicant_address; } ?>">
                              <span class="small" id="cus_address_error" style="color:red;"></span>
                            </div>
                            
                            <div class="form-group col-md-4">                      
                               <label for="coapplicant_aadhar_no">CoApplicant Aadhar Number</label>
                              <input type="tel" class="form-control" name="coapplicant_aadhar_no" id="coapplicant_aadhar_no" placeholder="Enter Aadhar Number" value="<?php if($action == 'edit'){ echo $loandata->coapplicant_aadhar_no; } ?>">
                              <span class="small" id="coapplicant_adhar_error" style="color:red;"></span>
                            </div>
                            
                            <div class="form-group col-md-4">                      
                             <label for="coapplicant_adhar_doc">CoApplicant Aadhar File</label>
                                <input type="file" class="form-control" name="coapplicant_aadhar_doc" id="coapplicant_aadhar_doc">
                                <span class="small" id="coapplicant_adhar_doc_error" style="color:red;"></span>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-fieldset">
                        <legend>Guarantor  Details</legend>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                             <label for="guarantor_mobile">Mobile Number</label>
                              <input type="text" class="form-control" name="guarantor_mobile" id="guarantor_mobile" placeholder="Enter Mobile Number" value="<?php if($action == 'edit'){ echo $loandata->guarantor_mobile; } ?>">
                              <span class="small" id="guarantor_mobile_error" style="color:red;"></span>
                            </div>
                            <div class="form-group col-md-4">
                             <label for="guarantor_mobile2">Mobile Number2</label>
                              <input type="text" class="form-control" name="guarantor_mobile2" id="guarantor_mobile2" placeholder="Enter Mobile Number2" value="<?php if($action == 'edit'){ echo $loandata->guarantor_mobile2; } ?>">
                              <span class="small" id="guarantor_mobile2_error" style="color:red;"></span>
                            </div>
                        
                            <div class="form-group col-md-4">                      
                               <label for="cus_pan">PAN Number</label>
                              <input type="tel" class="form-control" name="guarantor_pan" id="guarantor_pan" placeholder="Enter PAN Number" value="<?php if($action == 'edit'){ echo $loandata->guarantor_pan; } ?>">
                              <span class="small" id="cus_pan_error" style="color:red;"></span>
                            </div>
                      
                            <div class="form-group col-md-4">
                             <label for="cus_address">Address</label>
                              <input type="tel" class="form-control" name="guarantor_address" id="guarantor_address" placeholder="Enter Address" value="<?php if($action == 'edit'){ echo $loandata->guarantor_address; } ?>">
                              <span class="small" id="cus_address_error" style="color:red;"></span>
                            </div>
                            
                            <div class="form-group col-md-4">                      
                               <label for="guarantor_aadhar_no">guarantor Aadhar Number</label>
                              <input type="tel" class="form-control" name="guarantor_aadhar_no" id="guarantor_aadhar_no" placeholder="Enter Aadhar Number" value="<?php if($action == 'edit'){ echo $loandata->guarantor_aadhar_no; } ?>">
                              <span class="small" id="guarantor_adhar_error" style="color:red;"></span>
                            </div>
                            
                            <div class="form-group col-md-4">                      
                             <label for="guarantor_adhar_doc">guarantor Aadhar File</label>
                                <input type="file" class="form-control" name="guarantor_aadhar_doc" id="guarantor_aadhar_doc">
                                <span class="small" id="guarantor_adhar_doc_error" style="color:red;"></span>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-fieldset">
                    <legend>Loan Details</legend>
                    <div class="form-row">
                  
                       <div class="form-group col-sm-4">
                        <label for="npa_date">Date of Sanction</label>
                          <input type="text" class="form-control datepicker-input form-control-sm" autocomplete="off" placeholder="Date" name="date_of_sanction" id="date_of_sanction" value="<?php if($action == 'edit'){ if($loandata->date_of_sanction !='0000-00-00'){ echo $loandata->date_of_sanction; } } ?>">
                         <span class="small" id="date_of_sanction_error" style="color:red;"></span> 
                      </div>
                      
                    <div class="form-group col-md-4">                      
                       <label for="cus_loan_amount">Loan Amount</label>
                      <input type="tel" class="form-control" name="cus_loan_amount" id="cus_loan_amount" placeholder="Enter Loan Amount" value="<?php if($action == 'edit'){ echo $loandata->cus_loan_amount; } ?>">
                      <span class="small" id="cus_loan_amount_error" style="color:red;"></span>
                    </div>
                  
                    <div class="form-group col-md-4">
                     <label for="outstanding_amount">Outstanding Amount</label>
                      <input type="tel" class="form-control" name="outstanding_amount" id="outstanding_amount" placeholder="Outstanding Amount" value="<?php if($action == 'edit'){ echo $loandata->outstanding_amount; } ?>">
                      <span class="small" id="outstanding_amount_error" style="color:red;"></span>
                    </div>
                    </div>
                
                 <div class="form-row">
                    <div class="form-group col-md-4">
                     <label for="irregular_amount">Irregular Amount</label>
                      <input type="text" class="form-control" name="irregular_amount" id="irregular_amount" placeholder="Irregular Amount" value="<?php if($action == 'edit'){ echo $loandata->irregular_amount; } ?>">
                      <span class="small" id="irregular_amount_error" style="color:red;"></span>
                    </div>
                    <div class="form-group col-md-4">                      
                       <label for="account_status">Account Status</label>
                      <input type="tel" class="form-control" name="account_status" id="account_status" placeholder="Account Status" value="<?php if($action == 'edit'){ echo $loandata->account_status; } ?>">
                      <span class="small" id="account_status_error" style="color:red;"></span>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="npa_date">NPA Date</label>
                          <input type="text" class="form-control datepicker-input form-control-sm" autocomplete="off" placeholder="Date" name="npa_date" id="npa_date" value="<?php if($action == 'edit'){  if($loandata->npa_date !='0000-00-00'){ echo $loandata->npa_date; } } ?>">
                         <span class="small" id="npa_date_error" style="color:red;"></span> 
                      </div>
                    </div>
                   
                    <div class="form-row">
                    <div class="form-group col-md-6">
                     <label for="remarks">Remarks</label>
                      <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks"><?php if($action == 'edit'){ echo $loandata->remarks; } ?></textarea>
                      <span class="small" id="remarks_error" style="color:red;"></span>
                    </div>                  
                    </div>
                    </fieldset>
                
                 

                  
                
                
                
                

                
                  <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="loan_id" value="<?php echo $loandata->loan_id; ?>">
                      <input type="hidden" name="emp_id" value="<?php echo $loandata->emp_id; ?>">
                   <?php } ?>
                 
                 <button class="btn btn-secondary" type="reset">Reset</button>
                  <button class="btn btn-primary" type="submit">Save</button>
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
 
  <script src="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.js"></script>
  <script>
    $(() => {
      $('.summernote').summernote()
       $('.summernote-air').summernote({
        airMode: true
      })
        // Allow Input
      flatpickr('.datepicker-input', {
        allowInput: true
      })
      // Datetime
      flatpickr('.datetimepicker', {
        enableTime: true
      })
    })
  </script>

  <!-- Plugins -->
  <!-- JS plugins goes here -->
  <script type="text/javascript">

    $(() => {
     
      flatpickr('.datepicker-input', {
        allowInput: true
      })
    })
 
  $(document).ready(function(){
    $("#bank_id").on("change",function(){
     var bank_id = $(this).val();
     $.ajax({  
        url:"<?php echo base_url(); ?>Loanaccounts/getBranchas",
        data: {bank_id: bank_id },  
        type: "POST",  
        success:function(data){ 
            var htmlString ='';
            htmlString+="<option value=''>Select Branch</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['branch_id']+">"+data[i]['branch_name']+"</option>"
            });
            $("#branch_id").html(htmlString); 
            $("#home_branch_id").html(htmlString); 
        }
    });
   
    });

  });

   
 

  
  

    $("#loanaccount_submit").on("submit",function(){
      // var branch_id = $("#branch_id").val();
      var branch_controller = $("#branch_controller").val();
      var loan_ac_number = $("#loan_ac_number").val();
      var barrower_name = $("#barrower_name").val();
      var rbo = $("#rbo_id").val();
      var vehicle_chasse_number = $("#vehicle_chasse_number").val();
      var vehicle_number = $("#vehicle_number").val();
      var vehicle_engine_num = $("#vehicle_engine_num").val();
      // var work_order_num = $("#work_order_num").val();
      // var work_order_doc = $("#work_order_doc").val();

      // var cus_mobile = $("#cus_mobile").val();
      // var cus_pan = $("#cus_pan").val();
      // var cus_address = $("#cus_address").val();

      // var date_of_sanction = $("#date_of_sanction").val();
      // var cus_loan_amount = $("#cus_loan_amount").val();
      // var outstanding_amount = $("#outstanding_amount").val();

      // var make_company = $("#make_company").val();
      // var year_of_make = $("#year_of_make").val();
      // var rc_number = $("#rc_number").val();

      //  var irregular_amount = $("#irregular_amount").val();
      // var year_of_make = $("#year_of_make").val();
      // var npa_date = $("#npa_date").val();
      
      

      
    

    //   if(order_id == ''){
    //     $("#order_id_error").html("Work Order Is Required");
    //     $("#order_id").focus();
    //     return false;
    //   }else{
    //     $("#order_id_error").html("");
    //   }
      // if(branch_id == ''){
      //   $("#branch_id_error").html("Branch Is Required");
      //   $("#branch_id").focus();
      //   return false;
      // }else{
      //   $("#branch_id_error").html("");
      // }
      // if(branch_controller == ''){
      //   $("#branch_controller_error").html("Branch Controller Is Required");
      //   $("#branch_controller").focus();
      //   return false;
      // }else{
      //   $("#branch_controller_error").html("");
      // }
      if(loan_ac_number == ''){
        $("#loan_ac_number_error").html("Loan Ac Number Is Required");
        $("#loan_ac_number").focus();
        return false;
      }else{
        $("#loan_ac_number_error").html("");
      }
      if(barrower_name == ''){
        $("#barrower_name_error").html("Borrower Name Is Required");
        $("#barrower_name").focus();
        return false;
      }else{
        $("#barrower_name_error").html("");
      }
      if(rbo == ''){
        $("#rbo_error").html("RBO Name Is Required");
        $("#rbo").focus();
        return false;
      }else{
        $("#rbo_error").html("");
      }

      //  if(cus_mobile == ''){
      //   $("#cus_mobile_error").html("Mobile Number Is Required");
      //   $("#cus_mobile").focus();
      //   return false;
      // }else{
      //   $("#cus_mobile_error").html("");
      // }
      // if(cus_address == ''){
      //   $("#cus_address_error").html("Customer Address Is Required");
      //   $("#cus_address").focus();
      //   return false;
      // }else{
      //   $("#cus_address_error").html("");
      // }
      //  if(cus_pan == ''){
      //   $("#cus_pan_error").html("PAN Number Is Required");
      //   $("#cus_pan").focus();
      //   return false;
      // }else{
      //   $("#cus_pan_error").html("");
      // }

      // if(date_of_sanction == ''){
      //   $("#date_of_sanction_error").html("Date Of Sanction Is Required");
      //   $("#date_of_sanction").focus();
      //   return false;
      // }else{
      //   $("#date_of_sanction_error").html("");
      // }
      // if(cus_loan_amount == ''){
      //   $("#cus_loan_amount_error").html("Customer Loan Amount Is Required");
      //   $("#cus_loan_amount").focus();
      //   return false;
      // }else{
      //   $("#cus_loan_amount_error").html("");
      // }
      //  if(outstanding_amount == ''){
      //   $("#outstanding_amount_error").html("Outstanding Amount Is Required");
      //   $("#outstanding_amount").focus();
      //   return false;
      // }else{
      //   $("#outstanding_amount_error").html("");
      // }


      //  if(irregular_amount == ''){
      //   $("#irregular_amount_error").html("Irregular Amount Is Required");
      //   $("#irregular_amount").focus();
      //   return false;
      // }else{
      //   $("#irregular_amount_error").html("");
      // }
      // if(account_status == ''){
      //   $("#account_status_error").html("Account Status Is Required");
      //   $("#account_status").focus();
      //   return false;
      // }else{
      //   $("#account_status_error").html("");
      // }
      //  if(npa_date == ''){
      //   $("#npa_date_error").html("NPA Date Is Required");
      //   $("#npa_date").focus();
      //   return false;
      // }else{
      //   $("#npa_date_error").html("");
      // }




      <?php if($action != 'edit') { ?>

      if(vehicle_number == ''){
        $("#vehicle_number_error").html("Vehicle Number Is Required");
        $("#vehicle_number").focus();
        return false;
      }else{
        $("#vehicle_number_error").html("");
      }

      if(vehicle_chasse_number == ''){
        $("#vehicle_chasse_number_error").html("Vehicle Chasse Number Is Required");
        $("#vehicle_chasse_number").focus();
        return false;
      }else{
        $("#vehicle_chasse_number_error").html("");
      }      

      if(vehicle_engine_num == ''){
        $("#vehicle_engine_num_error").html("Vehicle Engine Number Is Required");
        $("#vehicle_engine_num").focus();
        return false;
      }else{
        $("#vehicle_engine_num_error").html("");
      }
      if(work_order_num == ''){
        $("#work_order_num_error").html("Work Order Number Is Required");
        $("#work_order_num").focus();
        return false;
      }else{
        $("#work_order_num_error").html("");
      }
      if(work_order_doc == ''){
        $("#work_order_doc_error").html("Work Order Document Is Required");
        $("#work_order_doc").focus();
        return false;
      }else{
        $("#work_order_doc_error").html("");
      }      
<?php } ?>
      
    });
  </script>

</body>

</html>