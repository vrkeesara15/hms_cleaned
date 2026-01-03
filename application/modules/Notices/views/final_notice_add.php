<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Notices">Generate Final Notice</a></li>
          <li class="breadcrumb-item active" aria-current="page">Final Notice</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">
  <section id="section4" class="mt-2">
            <h5>Create Final Notice Form</h5>
           
            <div class="card">
              <div class="card-body">
                 <form action="<?php echo base_url().'Notices/insertFinalNotice'; ?>" name="finalnotice_submit" id="finalnotice_submit" method="post" enctype="multipart/form-data">
                  <!-- New field: Branch Address -->
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
                   
                    
                  </div>
                   
                    
                    <!-- Below Borrower Name -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label for="barrower_name">Borrower Name</label>
                        <input type="text" class="form-control" name="barrower_name" id="barrower_name" placeholder="Borrower Name" value="<?php if($action == 'edit'){ echo $loandata->barrower_name; } ?>">
                        <span class="small" id="barrower_name_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="borrower_address">Borrower Address</label>
                        <input type="text" class="form-control" name="borrower_address" id="borrower_address" placeholder="Borrower Address" value="<?php if($action == 'edit'){ if(!empty($loandata->borrower_address)){ echo $loandata->borrower_address; }else{ echo $loandata->cus_address; } } ?>">
                        <span class="small" id="borrower_address_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="notice_date">Notice Date</label>
                        <input type="text" class="form-control datepicker-input" name="notice_date" id="notice_date" placeholder="Notice Date" value="<?php if($action == 'edit'){ echo $loandata->notice_date; } ?>">
                        <span class="small" id="notice_date_error" style="color:red;"></span>
                      </div>
                    </div>
                    
                    <!-- After Vehicle Engine Number row -->
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="loan_ac_number">Account Number</label>
                        <input type="text" class="form-control" name="loan_ac_number" id="loan_ac_number" placeholder="Account Number" value="<?php if($action == 'edit'){ echo $loandata->loan_ac_number; } ?>">
                        <span class="small" id="loan_ac_number_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-md-4" style="display: none;">
                        <label for="approved_amount">Approved Amount</label>
                        <input type="text" class="form-control" name="approved_amount" id="approved_amount" placeholder="Approved Amount" value="<?php if($action == 'edit'){ if(!empty($loandata->approved_amount)){ echo $loandata->approved_amount; }else{ echo $loandata->cus_loan_amount; } } ?>">
                        <span class="small" id="approved_amount_error" style="color:red;"></span>
                      </div>
                       <div class="form-group col-md-4">
                        <label for="registration_number">Vehicle Registration Number</label>
                        <input type="text" class="form-control" name="registration_number" id="registration_number" placeholder="Vehicle Registration Number" value="<?php if($action == 'edit'){ echo $loandata->vehicle_registration_number; } ?>">
                        <span class="small" id="registration_number_error" style="color:red;"></span>
                      </div>
                      
                      <div class="form-group col-md-4">
                        <label for="auction_date">Auction Date</label>
                        <input type="text" class="form-control datepicker-input" name="auction_date" id="auction_date" placeholder="Auction Date" value="<?php if($action == 'edit'){ if(!empty($loandata->auction_date)){ echo $loandata->auction_date; }else if($loandata->auction_date!='0000-00-00'){ echo $loandata->auction_date; } } ?>">
                        <span class="small" id="auction_date_error" style="color:red;"></span>
                      </div>
                    </div>
                    
                    <!-- New Paper row -->
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="telugu_news_paper">Telugu News Paper Name</label>
                        <input type="text" class="form-control" name="telugu_news_paper" id="telugu_news_paper" placeholder="Telugu News Paper Name" value="<?php if($action == 'edit'){ echo $loandata->telugu_news_paper; } ?>">
                        <span class="small" id="telugu_news_paper_error" style="color:red;"></span>
                      </div>
                       <div class="form-group col-md-4">
                        <label for="english_news_paper">English News Paper Name</label>
                        <input type="text" class="form-control" name="english_news_paper" id="english_news_paper" placeholder="English News Paper Name" value="<?php if($action == 'edit'){ echo $loandata->english_news_paper; } ?>">
                        <span class="small" id="english_news_paper_error" style="color:red;"></span>
                      </div>
                      
                      <div class="form-group col-md-4">
                        <label for="news_publication_date">News Paper Publication Date</label>
                        <input type="text" class="form-control datepicker-input" name="news_publication_date" id="news_publication_date" placeholder="New Publication Date" value="<?php if($action == 'edit'){ if(!empty($loandata->news_publication_date)){ echo $loandata->news_publication_date; }else if($loandata->news_publication_date!='0000-00-00'){ echo $loandata->news_publication_date; } } ?>">
                        <span class="small" id="news_publication_date_error" style="color:red;"></span>
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="addressing_text">Addressing Text</label>
                      <select class="custom-select" id="addressing_text" name="addressing_text">
                        <option value='' selected>Addressing Text</option>
                        <option value="Chief Manager" <?php if($action == 'edit'){  if($loandata->addressing_text == 'Chief Manager'){ echo "selected"; }  } ?>>Chief Manager</option>
                        <option value="Assistant General Manager" <?php if($action == 'edit'){  if($loandata->addressing_text == 'Assistant General Manager'){ echo "selected"; }  } ?>>Assistant General Manager</option>
                        <option value="Branch Manager" <?php if($action == 'edit'){  if($loandata->addressing_text == 'Branch Manager'){ echo "selected"; }  } ?>>Branch Manager</option>
                        <option value="Authorized Officer" <?php if($action == 'edit'){  if($loandata->addressing_text == 'Authorized Officer'){ echo "selected"; }  } ?>>Authorized Officer</option>
                      </select>
                      <!-- <label for="addressing_text">Addressing Text</label>
                      <input type="text" class="form-control" name="addressing_text" id="addressing_text" placeholder="Addressing Text" value="<?php if($action == 'edit'){ echo $loandata->addressing_text; } ?>">
                      <span class="small" id="addressing_text_error" style="color:red;"></span> -->
                    </div>
                    
                    <div class="form-row">
                      <div class="form-group col-md-4">                      
                         <label for="postal_stamps">Postal Stamp</label>
                            <input type="file" class="form-control" name="postal_stamp" id="postal_stamp">
                            <span class="small" id="postal_stamp__error" style="color:red;"></span>
                        </div>
                        <div class="form-group col-md-4">                      
                         <label for="notices_doc">Notice File</label>
                            <input type="file" class="form-control" name="notice_doc" id="notice_doc">
                            <span class="small" id="notice_doc_error" style="color:red;"></span>
                        </div>
                     </div>
                    
                    

                  <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <input type="hidden" name="generate" value="<?php echo $generate; ?>">
                  <input type="hidden" name="loan_id" value="<?php echo $loandata->loan_id; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="notice_id" value="<?php echo $loandata->id; ?>">
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
        }
    });
   
    });

  });

   
 

  
  

    $("#firstnotice_submit").on("submit",function(){
      var branch_id = $("#branch_id").val();
      
      var loan_ac_number = $("#loan_ac_number").val();
      var barrower_name = $("#barrower_name").val();
      var notice_date = $("#notice_date").val();
      

      var irregular_amount = $("#irregular_amount").val();
    
       if(branch_id == ''){
         $("#branch_id_error").html("Branch Is Required");
         $("#branch_id").focus();
         return false;
       }else{
         $("#branch_id_error").html("");
       }
      
      if(barrower_name == ''){
        $("#barrower_name_error").html("Borrower Name Is Required");
        $("#barrower_name").focus();
        return false;
      }else{
        $("#barrower_name_error").html("");
      }
      
      if(loan_ac_number == ''){
        $("#loan_ac_number_error").html("Loan Ac Number Is Required");
        $("#loan_ac_number").focus();
        return false;
      }else{
        $("#loan_ac_number_error").html("");
      }
      
      if(notice_date == ''){
        $("#notice_date").html("Notice Date Is Required");
        $("#notice_date").focus();
        return false;
      }else{
        $("#notice_date_error").html("");
      }
      

        if(irregular_amount == ''){
            $("#irregular_amount_error").html("Irregular Amount Is Required");
            $("#irregular_amount").focus();
            return false;
       }else{
            $("#irregular_amount_error").html("");
       }
      

      <?php if($action != 'edit') { ?>

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