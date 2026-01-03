
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Bankcharges">Bankcharges</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Bank Charges</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Bankcharges/insertBankcharges'; ?>" name="bankcharges_submit" id="bankcharges_submit" method="post" enctype="multipart/form-data">
                 
                  <span class="small" id="gst_duplicate_error" style="color:red;"></span> 
                  <fieldset class="form-fieldset">
                    <legend>Bank Charges Add Form</legend>
                      <div class="form-row">
                       <div class="form-group col-sm-6">
                        <label for="bank_id">Bank</label>
                        <select class="custom-select" id="bank_id" name="bank_id">
                          <option value='' selected>Select Bank</option>
                          <?php foreach ($banks as  $value) { ?>
                            <option value="<?php echo $value->bank_id; ?>" <?php if($action == 'edit'){  if($chargeData->bank_id == $value->bank_id){ echo "selected"; }  } ?>><?php echo $value->bank_name; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="bank_id_error" style="color:red;"></span> 
                      </div>

                         <div class="form-group col-sm-6">
                        <label for="charge_name">Bank Charge Name</label>
                        <input type="text" class="form-control" id="charge_name" name="charge_name" value="<?php if($action == 'edit'){ echo $chargeData->charge_name; } ?>">
                        <span class="small" id="charge_name_error" style="color:red;"></span> 
                      </div>

                      
                     
                    </div>
                     <div class="form-row">                      
                       <div class="form-group col-sm-6">
                        <label for="charge_amount">Bank Charge Amount</label>
                        <input type="text" class="form-control" id="charge_amount" name="charge_amount" value="<?php if($action == 'edit'){ echo $chargeData->charge_amount; } ?>">
                        <span class="small" id="charge_amount_error" style="color:red;"></span> 
                      </div>
                      
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="notes">Notes</label>
                            <textarea class="form-control" id="notes" name="notes"><?php if($action == 'edit'){ echo $chargeData->notes; } ?></textarea>
                            <span class="small" id="notes_error" style="color:red;"></span> 
                        </div>
                    </div>
                    
                  </fieldset>
                    <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="charge_id" id="charge_id" value="<?php echo $chargeData->charge_id; ?>">
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

    $("#bankcharges_submit").on("submit",function(){
      var bank_id = $("#bank_id").val();
      var charge_name = $("#charge_name").val();
      var charge_amount = $("#charge_amount").val();
      var action = $("#action").val();
      if(bank_id == ''){
        $("#bank_id_error").html("Please Select Bank Name");
        $("#bank_id").focus();
        return false;
      }else{
        $("#bank_id_error").html("");
      }
       if(charge_name == ''){
        $("#charge_name_error").html("Please Enter Charge Name");
        $("#charge_name").focus();
        return false;
      }else{
        $("#charge_name_error").html("");
      }
   
       if(charge_amount == ''){
        $("#charge_amount_error").html("Gst No Is Required");
        $("#charge_amount").focus();
        return false;
      }else{
        $("#charge_amount_error").html("");
      }
      var charge_id = '0';
      if(action == 'edit'){
        charge_id = $("#charge_id").val();       
      }
   



    });


  </script>
</body>

</html>