
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>LineTypes">Line Types</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'LineTypes/insertLineTypes'; ?>" name="formats_submit" id="formats_submit" method="post" enctype="multipart/form-data">
                 
                  <fieldset class="form-fieldset">
                    <legend>Line Type Information Add Form</legend>
                      <div class="form-row">
                         <div class="col-sm-4">
                            <label>Select Loan Type:<span style="color: red">*</span></label>
                            <select class="custom-select" id="loan_type_id" name="loan_type_id">
                            <option value='' selected>Select Loan Type</option>
                            <?php foreach($loanTypes as $loanType) { ?>
                                <option value="<?php echo $loanType->type_id; ?>" <?php if($action == 'edit'){  if($lineTypeData->loan_type_id == $loanType->type_id){ echo "selected"; }  } ?>><?php echo $loanType->type_name; ?></option>
                            <?php } ?>
                            <!--<option value="1" <?php if($action == 'edit'){  if($lineTypeData->loan_type_id == '1'){ echo "selected"; }  } ?>>Car Loans</option>-->
                            <!--<option value="2" <?php if($action == 'edit'){  if($lineTypeData->loan_type_id =='2'){ echo "selected"; }  } ?>>Personal Loans</option>   -->
                            <!--<option value="3" <?php if($action == 'edit'){  if($lineTypeData->loan_type_id =='3'){ echo "selected"; }  } ?>>Education Loans</option>   -->
                            <!--<option value="4" <?php if($action == 'edit'){  if($lineTypeData->loan_type_id =='4'){ echo "selected"; }  } ?>>AUCA Loans</option>    -->
                            <!--<option value="5" <?php if($action == 'edit'){  if($lineTypeData->loan_type_id =='5'){ echo "selected"; }  } ?>>Home Loans/Surface Loans</option> -->
                            </select>
                            <span class="small" id="loan_type_error" style="color:red;"></span>
                    </div>
                       <div class="form-group col-sm-4">
                        <label>Invoice Type:<span style="color: red">*</span></label>
                        <select class="custom-select" id="invoice_type" name="invoice_type">
                          <option value='' selected>Select Type Of Invoice</option>
                          <option value="1" <?php if($action == 'edit'){  if($lineTypeData->invoice_type == '1'){ echo "selected"; }  } ?>>Notice Charges</option>
                          <option value="2" <?php if($action == 'edit'){  if($lineTypeData->invoice_type =='2'){ echo "selected"; }  } ?>>Invoice</option>  
                          <option value="3" <?php if($action == 'edit'){  if($lineTypeData->invoice_type =='3'){ echo "selected"; }  } ?>>Expenses</option> 
                        </select>
                      <span class="small" id="invoice_type_error" style="color:red;"></span>
                      </div>

                        <div class="form-group col-sm-4">
                        <label for="line_type">Line Type</label>
                        <input type="text" class="form-control" id="line_type" name="line_type" value="<?php if($action == 'edit'){ echo $lineTypeData->linetype_name; } ?>">
                        <span class="small" id="line_type_error" style="color:red;"></span> 
                      </div>
                    </div>
                  </fieldset>
                    <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="linetype_id" id="linetype_id" value="<?php echo $lineTypeData->linetype_id; ?>">
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
  <!-- <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->

  <!-- Plugins -->
  <!-- JS plugins goes here -->
<script type="text/javascript">

    $("#formats_submit").on("submit",function(){
      //console.log('step1');
      
      var loan_type_id = $("#loan_type_id").val();
      var invoice_type = $("#invoice_type").val();
      var line_type = $("#line_type").val();
      var action = $("#action").val();
      if(loan_type_id == ''){
          $("#loan_type_error").html("Select Loan Type");
          return false;
        }else{
          $("#loan_type_error").html("");
        }
      if(invoice_type == ''){
        $("#invoice_type_error").html("Please Select Invoice Type");
        $("#invoice_type").focus();
        return false;
      }else{
        $("#invoice_type_error").html("");
      }
       if(line_type == ''){
        $("#line_type_error").html("Line type name is required");
        $("#line_type").focus();
        return false;
      }else{
        $("#line_type_error").html("");
      }
    

console.log('step2');
      var result = 0;

     $.ajax({  
        url:"<?php echo base_url(); ?>LineTypes/checkDupliate",
        data: 'invoice_type='+invoice_type+'&line_type='+line_type+'&action='+action+'&linetype_id='+linetype_id, 
        type: "POST",  
        async: false,
        success:function(data){ 
          
          if(action == 'edit'){

            if(data['invoice_type'] == invoice_type && data['line_type'] == line_type){
                    result = 1;
            }else {
            $.ajax({  
            url:"<?php echo base_url(); ?>LineTypes/checkDupliate",
            data: 'invoice_type='+invoice_type+'&line_type='+line_type+'&linetype_id='+linetype_id+'&action=add', 
            type: "POST",  
            async: false,
            success:function(data){ 
              if(!data){
                 //return true; //true;
                 result = 1;
              }else {
              $("#gst_duplicate_error").html("Line type Already Availabble");
                // return false;
                 result = 0;
              }
            }
            });   
            }   

          }else {
            if(!data){
              //return true; //true;
              result = 1;
            }else {
               $("#gst_duplicate_error").html("Line type Already Availabblea");
               //return false;
               result = 0;
            }
            
          }

        }
    });
console.log('step3');

   if(result == '0'){
    return false;
   }else {
    return true;
   }
   
   



    });
  </script>
</body>

</html>