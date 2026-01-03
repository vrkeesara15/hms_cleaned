
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Allbranchs">Branches</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Branch</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Allbranchs/insertAllbranchs'; ?>" name="formats_submit" id="formats_submit" method="post" enctype="multipart/form-data">
                 
                  
                  <fieldset class="form-fieldset">
                    <legend>Branch Information Add Form</legend>
                      <div class="form-row">
                       <div class="form-group col-sm-6">
                        <label for="bank_id">Bank</label>
                        <select class="custom-select" id="bank_id" name="bank_id">
                          <option value='' selected>Select Bank</option>
                          <?php foreach ($banks as  $value) { ?>
                            <option value="<?php echo $value->bank_id; ?>" <?php if($action == 'edit'){  if($banchdata->bank_id == $value->bank_id){ echo "selected"; }  } ?>><?php echo $value->bank_name; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="bank_id_error" style="color:red;"></span> 
                      </div>

                        <div class="form-group col-sm-6">
                        <label for="state_id">State</label>
                        <select class="custom-select" id="state_id" name="state_id">
                          <option value='' selected>Select State</option>
                          <?php foreach ($states as  $value) { ?>
                            <option value="<?php echo $value->state_id; ?>" <?php if($action == 'edit'){  if($banchdata->state_id == $value->state_id){ echo "selected"; }  } ?>><?php echo $value->state_name; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="state_id_error" style="color:red;"></span> 
                      </div>

                      
                     
                    </div>
                     <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="branch_name"> Maintenance Branch Name</label>
                            <input type="text" class="form-control" id="branch_name" name="branch_name" value="<?php if($action == 'edit'){ echo $banchdata->branch_name; } ?>">
                            <span class="small" id="branch_name_error" style="color:red;"></span> 
                         </div>
                        <div class="form-group col-sm-6">
                            <label for="branch_code">Maintenance Branch Code</label>
                            <input type="text" class="form-control" id="branch_code" name="branch_code" value="<?php if($action == 'edit'){ echo $banchdata->branch_code; } ?>">
                            <span class="small" id="branch_code_error" style="color:red;"></span> 
                        </div>
                        
                      <!--  <div class="form-group col-sm-6">
                        <label for="gst_no">GST Number</label>
                        <input type="text" class="form-control" id="gst_no" name="gst_no" value="<?php if($action == 'edit'){ echo $banchdata->gst_no; } ?>">
                        <span class="small" id="gst_no_error" style="color:red;"></span> 
                      </div> -->
                     
                    </div>
		    <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="home_branch_name"> Home Branch Name</label>
                        <input type="text" class="form-control" id="home_branch_name" name="home_branch_name" value="<?php if($action == 'edit'){ echo $banchdata->home_branch_name; } ?>">
                        <span class="small" id="home_branch_name_error" style="color:red;"></span> 
                     </div>
                    <div class="form-group col-sm-6">
                        <label for="home_branch_code">Home Branch Code</label>
                        <input type="text" class="form-control" id="home_branch_code" name="home_branch_code" value="<?php if($action == 'edit'){ echo $banchdata->home_branch_code; } ?>">
                        <span class="small" id="branch_code_error" style="color:red;"></span> 
                    </div>
                 
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                     <label for="RBO">RBO</label>
                       <select class="custom-select" id="rbo_id" name="rbo_id">
                          <option value='' selected>Select RBO</option>
                          <?php foreach ($rbos as  $value) { ?>
                            <option value="<?php echo $value->rbo_id; ?>" <?php if($action == 'edit'){  if($banchdata->rbo_id == $value->rbo_id){ echo "selected"; }  } ?>><?php echo $value->rbo_name; ?></option>
                          <?php } ?>
                        </select>
                      <span class="small" id="rbo_error" style="color:red;"></span>
                    </div>
                </div>
                 <div class="form-row">
                    <div class="form-group col-md-6">
                     <label for="address">Branch Address</label>
                      <textarea class="form-control" name="branch_address" id="branch_address" placeholder="Branch Address"><?php if($action == 'edit'){ echo $banchdata->branch_address; } ?></textarea>
                      <span class="small" id="branch_address_error" style="color:red;"></span>
                    </div>  
                </div>
              </fieldset>
              
              <!-- Bank Person 1 -->
                <fieldset class="form-fieldset mt-3">
                  <legend>Bank Person 1</legend>
                  <div class="form-row">
                    <div class="form-group col-sm-6">
                      <label for="bank_person_name">Name</label>
                      <input type="text" class="form-control" id="bank_person_name" name="bank_person_name" value="<?php if($action == 'edit'){ echo $banchdata->bank_person_name; } ?>">
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="bank_person_designation">Designation</label>
                      <input type="text" class="form-control" id="bank_person_designation" name="bank_person_designation" value="<?php if($action == 'edit'){ echo $banchdata->bank_person_designation; } ?>">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-sm-6">
                      <label for="bank_person_phone">Phone Number</label>
                      <input type="text" class="form-control" id="bank_person_phone" name="bank_person_phone" value="<?php if($action == 'edit'){ echo $banchdata->bank_person_phone; } ?>">
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="bank_person_mail">Mail Id</label>
                      <input type="text" class="form-control" id="bank_person_mail" name="bank_person1_mail" value="<?php if($action == 'edit'){ echo $banchdata->bank_person_mail; } ?>">
                    </div>
                  </div>
                </fieldset>


              <!-- Bank Person 2 -->
                <fieldset class="form-fieldset mt-3">
                  <legend>Bank Person 2</legend>
                  <div class="form-row">
                    <div class="form-group col-sm-6">
                      <label for="bank_person1_name">Name</label>
                      <input type="text" class="form-control" id="bank_person1_name" name="bank_person1_name" value="<?php if($action == 'edit'){ echo $banchdata->bank_person2_name; } ?>">
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="bank_person1_designation">Designation</label>
                      <input type="text" class="form-control" id="bank_person1_designation" name="bank_person1_designation" value="<?php if($action == 'edit'){ echo $banchdata->bank_person2_designation; } ?>">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-sm-6">
                      <label for="bank_person1_phone">Phone Number</label>
                      <input type="text" class="form-control" id="bank_person1_phone" name="bank_person1_phone" value="<?php if($action == 'edit'){ echo $banchdata->bank_person2_phone; } ?>">
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="bank_person1_mail">Mail Id</label>
                      <input type="text" class="form-control" id="bank_person1_mail" name="bank_person1_mail" value="<?php if($action == 'edit'){ echo $banchdata->bank_person2_mail; } ?>">
                    </div>
                  </div>
                  
                  
                </fieldset>
                <input type="hidden" name="action" value="<?php echo $action; ?>">
                <input type="hidden" name="branch_id" value="<?php if($action == 'edit'){ echo $banchdata->branch_id; } ?>">

              <button class="btn btn-secondary" type="reset">Reset</button>
              <button class="btn btn-primary" type="submit">Save</button>
            </form>
          </div>
        </div>
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
$("#branch_code").on("change",function(){
     var branchCode = $(this).val();
     
     $.ajax({  
        url:"<?php echo base_url(); ?>Allbranchs/checkBranch",
        data: 'branchCode='+branchCode,
        type: "POST",  
        success:function(data){ 
            if(data == 'exist'){
                $("#branch_code_error").html("Branch Code already exist"); 
            }else{
                $("#branch_code_error").html("");
            }
             
                     
        }
    });
});

    $("#formats_submit").on("submit",function(){
      var bank_id = $("#bank_id").val();
      var branch_name = $("#branch_name").val();
      var state_id = $("#state_id").val();
      // var gst_no = $("#gst_no").val();
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
      if(branch_name == ''){
        $("#branch_name_error").html("Branch Name Required");
        $("#branch_name").focus();
        return false;
      }else{
        $("#branch_name_error").html("");
      }
      //  if(gst_no == ''){
      //   $("#gst_no_error").html("Gst No Is Required");
      //   $("#gst_no").focus();
      //   return false;
      // }else{
      //   $("#gst_no_error").html("");
      // }
    });
  </script>
</body>

</html>