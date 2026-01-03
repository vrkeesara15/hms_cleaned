<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Debits">Debits</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Expense/Debit</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Debits/addExpense'; ?>" name="expense_submit" id="expense_submit" method="post" enctype="multipart/form-data">
                 
                  <span class="small" id="gst_duplicate_error" style="color:red;"></span> 
                  <fieldset class="form-fieldset">
                    <legend>Add Expenses Form</legend>
                      

                      <div class="form-row">
                        <div class="form-group col-sm-6">
                          <label for="amount">Amount:<span style="color: red">*</span></label>
                          <input type="text" class="form-control" id="amount" name="amount" value="<?php if($action == 'edit'){ echo $debitData->amount; } ?>">
                          <span class="small" id="amount_error" style="color:red;"></span> 
                        </div>
                        <div class="form-group col-sm-6">
                          <label for="fname">Expense Type:<span style="color: red">*</span></label>
                          <select class="custom-select" id="expense_type" name="expense_type">
                            <option value='' selected>Select Expense Type</option>
                            <?php if(!empty($expenseTypes)){
                              foreach($expenseTypes as $expType){
                               ?>
                               <option value="<?php echo $expType->id; ?>" <?php if($action == 'edit' && $debitData->expense_type== $expType->id){ echo 'selected'; } ?>>  <?php echo $expType->expense_type; ?></option>
                            <?php } } ?>
                          </select>
                          <span class="small" id="expense_type_error" style="color:red;"></span> 
                        </div>
                      </div>
                     <div class="form-row">
                      <div class="form-group col-sm-6">
                          <label for="paid_to">Name:<span style="color: red">*</span></label>
                          <input type="text" class="form-control" id="paid_to" name="paid_to" value="<?php if($action == 'edit'){ echo $debitData->paid_to; } ?>">
                          <span class="small" id="name_error" style="color:red;"></span> 
                        </div>
                        <div class="form-group col-sm-6">
                          <label for="payment_method">Payment Method:<span style="color: red">*</span></label>
                          <select class="custom-select" id="payment_method" name="payment_method">
                            <option value='' selected>Select Payment Method</option>
                            <option value="Cash" <?php if($action == 'edit' && $debitData->payment_method== 'Cash'){ echo 'selected'; } ?>>Cash</option>
                            <option value="Account Transfer" <?php if($action == 'edit' && $debitData->payment_method== 'Account Transfer'){ echo 'selected'; } ?>>Account Transfer</option>
                            <option value="UPI" <?php if($action == 'edit' && $debitData->payment_method== 'UPI'){ echo 'selected'; } ?>>UPI</option>
                            <option value="Cheque" <?php if($action == 'edit' && $debitData->payment_method== 'Cheque'){ echo 'selected'; } ?>>Cheque</option>
                          </select>
                          <span class="small" id="payment_method_error" style="color:red;"></span> 
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                          <label for="fname">GST Type:<span style="color: red"></span></label>
                          <select class="custom-select" id="gst_type" name="gst_type">
                            <option value='' selected>Select GST Type</option>
                            <option value="GST" <?php if($action == 'edit' && $debitData->gst_type== 'GST'){ echo 'selected'; } ?>>  GST</option>
                            <option value="Non-GST" <?php if($action == 'edit' && $debitData->gst_type== 'Non-GST'){ echo 'selected'; } ?>>  Non-GST</option>
                        
                          </select>
                          <span class="small" id="gst_type_error" style="color:red;"></span> 
                        </div>
                      </div>
                    
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                          <label for="tds_amount">TDS Amount<span style="color: red">*</span></label>
                          <input type="text" class="form-control" id="tds_amount" name="tds_amount" value="<?php if($action == 'edit'){ echo $debitData->tds_amount; } ?>">
                          <span class="small" id="tds_amount_error" style="color:red;"></span> 
                        </div>
                        <div class="form-group col-sm-6">
                          <label for="transaction_date">Transaction Date:<span style="color: red">*</span></label>
                          <input type="text" class="form-control datepicker-input" autocomplete="off" placeholder="Date" id="transaction_date" name="transaction_date" value="<?php if($action == 'edit' && !empty($debitData->transaction_date)){ echo $debitData->transaction_date; } ?>">
                          <span class="small" id="transaction_date_error" style="color:red;"></span> 
                        </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                          <label for="description">Description:<span style="color: red">*</span></label>
                          <textarea class="form-control" placeholder="Description" name="description" id="description"><?php if($action == 'edit'){ echo $debitData->expense_description; } ?></textarea>
                          
                          <span class="small" id="description_error" style="color:red;"></span> 
                        </div>
                        
                    </div>
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="receipt">Transfer Receipt:<span style="color: red">*</span></label>
                        <input type="file" class="form-control" name="receipt" id="receipt">
                        <span class="small" id="receipt_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="receipt">Other:<span style="color: red"></span></label>
                        <input type="file" class="form-control" name="other_receipt" id="other_receipt">
                        <span class="small" id="other_error" style="color:red;"></span>
                      </div>
                    </div>
                  </fieldset>
                    <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                    <input type="hidden" name="debit_id" id="debit_id" value="<?php echo $debitData->id; ?>">
                  <button class="btn btn-primary" type="submit" id="debitsubmit">Save</button>
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
  <!-- <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->

  <!-- Plugins -->
  <!-- JS plugins goes here -->
  <script>
    var LineTypes = "";
    $(() => {
     
        // Allow Input
      flatpickr('.datepicker-input', {
        allowInput: true,
        maxDate: new Date(),
      })
    })
  </script>
<script type="text/javascript">

    $("#expense_submit").on("submit",function(){
        var amount = $("#amount").val();
        var expense_type = $("#expense_type").val();
        var paid_to = $("#paid_to").val();
        var payment_method = $("#payment_method").val();
        var description = $("#description").val();
        var receipt = $("#receipt").val();
        var tds_amount = $("#tds_amount").val();
        var transaction_date = $("#transaction_date").val();
        if(amount == ""){
            $("#amount_error").html("Please enter amount");
            return false;
        }else{
            $("#amount_error").html("");
        }
        if(expense_type == ""){
            $("#expense_type_error").html("Please enter Expense Type");
            return false;
        }else{
            $("#expense_type_error").html("");
        }
        if(paid_to == ""){
            $("#name_error").html("Please enter Name");
            return false;
        }else{
            $("#name_error").html("");
        }
        if(payment_method == ""){
            $("#payment_method_error").html("Please enter Payment Method");
            return false;
        }else{
            $("#payment_method_error").html("");
        }
        if(tds_amount == ""){
            $("#tds_amount_error").html("Please Enter TDS Amount");
            return false;
        }else{
            $("#tds_amount_error").html("");
        }
        if(transaction_date == ""){
            $("#transaction_date_error").html("Please select transaction date");
            return false;
        }else{
            $("#transaction_date_error").html("");
        }
        if(description == ""){
            $("#description_error").html("Please enter Description");
            return false;
        }else{
            $("#description_error").html("");
        }
        <?php if($action != 'edit'){ ?>
        if(receipt == ""){
            $("#receipt_error").html("Please select file");
            return false;
        }else{
            $("#receipt_error").html("");
        }
        <?php } ?>
        
        
        
        
      $("#debitsubmit").hide();
      var result = 0;

    });


  </script>
</body>

</html>