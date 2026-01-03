
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Vendors">Vendors</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Vendor Id</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Vendors/insertVendors'; ?>" name="formats_submit" id="formats_submit" method="post" enctype="multipart/form-data">
                 
                  <span class="small" id="gst_duplicate_error" style="color:red;"></span> 
                  <fieldset class="form-fieldset">
                    <legend>Create Vendor ID Form</legend>
                      <div class="form-row">
                       <div class="form-group col-sm-6">
                        <label for="bank_id">Bank</label>
                        <select class="custom-select" id="bank_id" name="bank_id">
                          <option value='' selected>Select Bank</option>
                          <?php foreach ($banks as  $value) { ?>
                            <option value="<?php echo $value->bank_id; ?>" <?php if($action == 'edit'){  if($vendorsData->bank_id == $value->bank_id){ echo "selected"; }  } ?>><?php echo $value->bank_name; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="bank_id_error" style="color:red;"></span> 
                      </div>

                        <div class="form-group col-sm-6">
                        <label for="state_id">State</label>
                        <select class="custom-select" id="state_id" name="state_id">
                          <option value='' selected>Select State</option>
                          <?php foreach ($states as  $value) { ?>
                            <option value="<?php echo $value->state_id; ?>" <?php if($action == 'edit'){  if($vendorsData->state_id == $value->state_id){ echo "selected"; }  } ?>><?php echo $value->state_name; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="state_id_error" style="color:red;"></span> 
                      </div>

                      
                     
                    </div>
                     <div class="form-row">                      
                       <div class="form-group col-sm-6">
                        <label for="vendor_no">Vendor Id</label>
                        <input type="text" class="form-control" id="vendor_no" name="vendor_no" value="<?php if($action == 'edit'){ echo $vendorsData->vendor_no; } ?>">
                        <span class="small" id="vendor_no_error" style="color:red;"></span> 
                      </div>
                     
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="notes">Notes</label>
                            <textarea class="form-control" id="notes" name="notes"><?php if($action == 'edit'){ echo $vendorsData->notes; } ?></textarea>
                            <span class="small" id="notes_error" style="color:red;"></span> 
                        </div>
                    </div>
                    
                  </fieldset>
                    <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo $vendorsData->vendor_id; ?>">
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
      var bank_id = $("#bank_id").val();
     // var branch_name = $("#branch_name").val();
      var state_id = $("#state_id").val();
      var vendor_no = $("#vendor_no").val();
      var action = $("#action").val();
      if(bank_id == ''){
        $("#bank_id_error").html("Please Select Bank Name");
        $("#bank_id").focus();
        return false;
      }else{
        $("#bank_id_error").html("");
      }
       if(state_id == ''){
        $("#state_id_error").html("Please Select State Name");
        $("#state_id").focus();
        return false;
      }else{
        $("#state_id_error").html("");
      }
      // if(branch_name == ''){
      //   $("#branch_name_error").html("Branch Name Required");
      //   $("#branch_name").focus();
      //   return false;
      // }else{
      //   $("#branch_name_error").html("");
      // }
       if(vendor_no == ''){
        $("#vendor_no_error").html("Vendor Id Is Required");
        $("#vendor_no").focus();
        return false;
      }else{
        $("#vendor_no_error").html("");
      }
      var vendor_id = '0';
      if(action == 'edit'){
        vendor_id = $("#vendor_id").val();       
      }

      var result = 0;

     $.ajax({  
        url:"<?php echo base_url(); ?>Vendors/checkDupliate",
        data: 'bank_id='+bank_id+'&state_id='+state_id+'&action='+action+'&vendor_id='+vendor_id, 
        type: "POST",  
        async: false,
        success:function(data){ 
          console.log(data);
          if(action == 'edit'){

            if(data['bank_id'] == bank_id && data['state_id'] == state_id){
                    result = 1;
            }else {
            $.ajax({  
            url:"<?php echo base_url(); ?>Vendors/checkDupliate",
            data: 'bank_id='+bank_id+'&state_id='+state_id+'&vendor_id='+vendor_id+'&action=add', 
            type: "POST",  
            async: false,
            success:function(data){ 
              if(!data){
                 //return true; //true;
                 result = 1;
              }else {
              $("#gst_duplicate_error").html("Vendor Id Already Availabble");
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
               $("#gst_duplicate_error").html("Vendor Id Already Availabble");
               //return false;
               result = 0;
            }
            
          }

        }
    });


   if(result == '0'){
    return false;
   }else {
    return true;
   }
   
   



    });
  </script>
</body>

</html>