<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loanaccounts">Manage Loan Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Loan Account</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">
  <section id="section4" class="mt-2">
            <h5>Loan Account Form</h5>
           
            <div class="card">
              <div class="card-body">
                 <form action="<?php echo base_url().'Loans/insertloandetails'; ?>" name="loanaccount_submit" id="loanaccount_submit" method="post" enctype="multipart/form-data">
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
                          <?php foreach ($branchs as  $value) { ?>
                            <option value="<?php echo $value->branch_id; ?>" <?php if($action == 'edit'){  if($loandata->branch_id == $value->branch_id){ echo "selected"; }  } ?>><?php echo $value->branch_name; ?></option>
                          <?php } ?>
                        </select>
                      <span class="small" id="branch_id_error" style="color:red;"></span> 
                    </div>
                      <div class="form-group col-md-4">
                     <label for="branch_controller">Branch Controller</label>
                      <input type="text" class="form-control" name="branch_controller" id="branch_controller" placeholder="Branch Controller" value="<?php if($action == 'edit'){ echo $loandata->branch_controller; } ?>">
                      <span class="small" id="branch_controller_error" style="color:red;"></span>
                    </div>

                 
                  </div>
                  <div class="form-row">
                   
                   
                    <div class="form-group col-md-4">                      
                      <label for="loan_ac_number">Loan Ac Number</label>
                      <input type="text" class="form-control" name="loan_ac_number" id="loan_ac_number" placeholder="Loan Ac Number" value="<?php if($action == 'edit'){ echo $loandata->loan_ac_number; } ?>">
                      <span class="small" id="loan_ac_number_error" style="color:red;"></span>
                
                    </div>
                  
                    <div class="form-group col-md-4">
                     <label for="barrower_name">Barrower Name</label>
                      <input type="text" class="form-control" name="barrower_name" id="barrower_name" placeholder="Barrower Name" value="<?php if($action == 'edit'){ echo $loandata->barrower_name; } ?>">
                      <span class="small" id="barrower_name_error" style="color:red;"></span>
                    </div>
                   
                  </div>
                  <div class="form-row">
                   <div class="form-group col-sm-4">
                        <label for="npa_date">Date of Sanction</label>
                          <input type="text" class="form-control datepicker-input form-control-sm" autocomplete="off" placeholder="Date" name="date_of_sanction" id="date_of_sanction" value="<?php if($action == 'edit'){ if($loandata->date_of_sanction !='0000-00-00'){ echo $loandata->date_of_sanction; } } ?>">
                         <span class="small" id="date_of_sanction_error" style="color:red;"></span> 
                      </div>
                      
                    <div class="form-group col-md-4">                      
                       <label for="cus_loan_amount">Loan Amount</label>
                      <input type="text" class="form-control" name="cus_loan_amount" id="cus_loan_amount" placeholder="Enter Loan Amount" value="<?php if($action == 'edit'){ echo $loandata->cus_loan_amount; } ?>">
                      <span class="small" id="cus_loan_amount_error" style="color:red;"></span>
                    </div>
                  
                    <div class="form-group col-md-4">
                     <label for="outstanding_amount">Outstanding Amount</label>
                      <input type="text" class="form-control" name="outstanding_amount" id="outstanding_amount" placeholder="Outstanding Amount" value="<?php if($action == 'edit'){ echo $loandata->outstanding_amount; } ?>">
                      <span class="small" id="outstanding_amount_error" style="color:red;"></span>
                    </div>
                     <div class="form-group col-md-4">
                     <label for="irregular_amount">Overdue Amount</label>
                      <input type="text" class="form-control" name="irregular_amount" id="irregular_amount" placeholder="Irregular Amount" value="<?php if($action == 'edit'){ echo $loandata->irregular_amount; } ?>">
                      <span class="small" id="irregular_amount_error" style="color:red;"></span>
                    </div>
                    </div>
                 
                 </fieldset>
                
                  <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="loan_id" value="<?php echo $loandata->loan_id; ?>">
                     <input type="hidden" name="emp_id" value="<?php echo $loandata->emp_id; ?>">                     
                     <input type="hidden" name="type_id" value="<?php echo $loandata->type_id; ?>">
                   <?php }else { ?>
                 <input type="hidden" name="type_id" value="<?php echo $type_id; ?>">
               <?php  } ?>
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
        url:"<?php echo base_url(); ?>Loans/getBranchas",
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

   
 

  
  

    $("#loanaccount_submit").on("submit",function(){
      var bank_id = $("#bank_id").val();
      var branch_id = $("#branch_id").val();
     // var branch_controller = $("#branch_controller").val();
      var loan_ac_number = $("#loan_ac_number").val();
      var barrower_name = $("#barrower_name").val();
      var date_of_sanction = $("#date_of_sanction").val();
      var cus_loan_amount = $("#cus_loan_amount").val();
      var outstanding_amount = $("#outstanding_amount").val();
      var irregular_amount = $("#irregular_amount").val();
          
    

      if(bank_id == ''){
        $("#bank_id_error").html("Bank Selection Is Required");
        $("#bank_id").focus();
        return false;
      }else{
        $("#bank_id_error").html("");
      }
      if(branch_id == ''){
        $("#branch_id_error").html("Branch Is Required");
        $("#branch_id").focus();
        return false;
      }else{
        $("#branch_id_error").html("");
      }
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
        $("#barrower_name_error").html("Barrower Name Is Required");
        $("#barrower_name").focus();
        return false;
      }else{
        $("#barrower_name_error").html("");
      }

      

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
      
    });
  </script>

</body>

</html>