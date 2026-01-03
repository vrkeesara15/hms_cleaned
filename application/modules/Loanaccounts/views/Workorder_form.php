<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">

    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
           <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loanaccounts">Car Loan Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Work Order Form</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">
          <section id="section2" class="mt-1">
            <h5>workorder Form</h5> 
            <div class="card">
              <div class="card-body">
               <form action="<?php echo base_url().'Loanaccounts/insertWorkorder'; ?>" name="workorder_submit" id="workorder_submit" method="post" enctype="multipart/form-data">

                  <fieldset class="form-fieldset">
                    <legend>Workorder Info</legend>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                      <label for="fname">Select Bank</label>
                     <select class="custom-select" id="bank_id" name="bank_id">
                          <option value='' selected>Select Bank</option>
                          <?php foreach ($banks as  $value) { ?>
                            <option value="<?php echo $value->bank_id; ?>" <?php if(!empty($loandata)){  if($loandata->bank_id == $value->bank_id){ echo "selected"; }  } ?>><?php echo $value->bank_name; ?></option>
                          <?php } ?>
                        </select>
                      <span class="small" id="bank_id_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                       <label for="fname">Select Branch</label>
                     <select class="custom-select" id="branch_id" name="branch_id">
                          <option value='' selected>Select Branch</option>
                          <?php foreach ($branchs as  $value) { ?>
                            <option value="<?php echo $value->branch_id; ?>" <?php if(!empty($loandata)){  if($loandata->branch_id == $value->branch_id){ echo "selected"; }  } ?>><?php echo $value->branch_name; ?></option>
                          <?php } ?>
                        </select>
                      <span class="small" id="branch_id_error" style="color:red;"></span> 
                    </div>
                   
                    
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="barrower_name">Borrower Name</label>
                    <input type="text" class="form-control" name="barrower_name" id="barrower_name" placeholder="Borrower Name" value="<?php if(!empty($loandata)){ echo $loandata->barrower_name; } ?>">
                    <span class="small" id="barrower_name_error" style="color:red;"></span>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="borrower_address">Borrower Address</label>
                    <input type="text" class="form-control" name="borrower_address" id="borrower_address" placeholder="Borrower Address" value="<?php if(!empty($loandata)){ if(!empty($loandata->borrower_address)){ echo $loandata->borrower_address; }else{ echo $loandata->cus_address; } } ?>">
                    <span class="small" id="borrower_address_error" style="color:red;"></span>
                  </div>
                </div>
                 <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="loan_ac_number">Account Number</label>
                    <input type="text" class="form-control" name="loan_ac_number" id="loan_ac_number" placeholder="Account Number" value="<?php if(!empty($loandata)){ echo $loandata->loan_ac_number; } ?>">
                    <span class="small" id="loan_ac_number_error" style="color:red;"></span>
                  </div>
                </div>

                    <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="workorderd_by">Workorder Number</label>
                       <input type="text" class="form-control" id="workorder_no" name="workorder_no" placeholder="Please enter workorderd No." value="<?php if(!empty($workorderdata)){ echo $workorderdata->workorder_no; } ?>">
                     
                       <span class="small" id="workorder_no_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="workorder_date">Workorder Date</label>
                      <input type="text" class="form-control datepicker-input" id="workorder_date" name="workorder_date" placeholder="Please select workorder date" value="<?php if(!empty($workorderdata)){ echo $workorderdata->workorder_date; } ?>">
                      <span class="small" id="workorder_date_error" style="color:red;"></span> 
                    </div>
                    
                  </div>
                   <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="workorder_file">Work Order File</label>
                      <input type="file" class="form-control" id="workorder_file" name="workorder_file" placeholder="work order file">
                      <span class="small" id="workorder_file_error" style="color:red;"></span> 
                    </div>
                    
                  </div>
                  
                    <div class="form-row">
                    <div class="form-group col-md-6">
                     <label for="remarks">Bank Manager Details</label>
                      <textarea class="form-control" name="bankmanagerdetails" id="bankmanagerdetails" placeholder="Bank Manager Details"><?php if(!empty($workorderdata)){ echo $workorderdata->bank_manager_details; } ?></textarea>
                      <span class="small" id="bankmanagerdetails_error" style="color:red;"></span>
                    </div>                  
                    </div>
                 
                  </fieldset>
                   <input type="hidden" name="loan_id" value="<?php echo $loan_id; ?>">
                  <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                  <?php if(!empty($workorderdata)){ ?>
                     <input type="hidden" name="w_id" value="<?php echo $workorderdata->w_id; ?>">
                   <?php } ?>
                  <button class="btn btn-secondary" type="reset">Reset</button>
                  <button class="btn btn-primary" type="submit">Save</button>
                </form>
              </div>
            </div>
          </section>



        </div>

        <div class="col-3 d-none d-xl-block">
          
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
  <script src="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.js"></script>
   <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>

<!--<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCOMOjJl06Rmnpsg39_HwCJnlYJdPpRYRdsf&sensor=false&libraries=places'></script>-->
   
<script src="<?php echo base_url();?>assets/new/js/locationpicker.js"></script> 

  <!-- Plugins -->
  <!-- JS plugins goes here -->
  <script type="text/javascript">

     $(() => {
      flatpickr('.datepicker-input', {
        allowInput: true
      })
    })
   $("#workorder_submit").on("submit",function(){
      var workorder_date = $("#workorder_date").val();
      var workorder_no = $("#workorder_no").val();
      

      var workorder_file = $("#workorder_file").val();
      if(workorder_no == ''){
        $("#workorder_no_error").html("Workorder Number Is Required");
        $("#workorder_no").focus();
        return false;
      }else{
        $("#workorder_no_error").html("");
      }
      if(workorder_date == ''){
        $("#workorder_date_error").html("Workorder Date Is Required");
        $("#workorder_date").focus();
        return false;
      }else{
        $("#workorder_date_error").html("");
      }
     
      
      if(workorder_file == ''){
        $("#workorder_file_error").html("Workorder File Is Required");
        $("#workorder_file").focus();
        return false;
      }else{
        $("#workorder_file").html("");
      }
      
    });
    

  $(document).ready(function(){
    $("#bank_id").on("change",function(){
     var bank_id = $(this).val();``
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
        }
    });
    });
  });

  </script>

</body>

</html>