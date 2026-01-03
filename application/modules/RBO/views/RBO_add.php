
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>RBO">RBO</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add RBO</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'RBO/insertRBO'; ?>" name="RBO_submit" id="RBO_submit" method="post" enctype="multipart/form-data">
                 
                  
                  <fieldset class="form-fieldset">
                    <legend>RBO Doc Form</legend>
                      <div class="form-row">
                       <div class="form-group col-sm-6">
                        <label for="bank_id">Bank</label>
                        <select class="custom-select" id="bank_id" name="bank_id">
                          <option value='' selected>Select bank</option>
                          <?php foreach ($bank_details as $key => $value) { ?>
                            <option value="<?php echo $value->bank_id; ?>" <?php if($action == 'edit'){  if($RBOdata->bank_id == $value->bank_id){ echo "selected"; }  } ?>><?php echo $value->bank_name; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="bank_id_error" style="color:red;"></span> 
                      </div>
                       <div class="form-group col-sm-6">
                        <label for="state_id">State</label>
                        <select class="custom-select" id="state_id" name="state_id">
                          <option value='' selected>Select State</option>
                          <?php foreach ($states as  $value) { ?>
                            <option value="<?php echo $value->state_id; ?>" <?php if($action == 'edit'){  if($RBOdata->state_id == $value->state_id){ echo "selected"; }  } ?>><?php echo $value->state_name; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="state_id_error" style="color:red;"></span> 
                      </div>

                     
                    </div>
                      <div class="form-row">
                             <div class="form-group col-sm-4">
                                <label for="rbo_name">RBO Name</label>
                                <input type="text" class="form-control" id="rbo_name" name="rbo_name" value="<?php if($action == 'edit'){ echo $RBOdata->rbo_name; } ?>">
                                <span class="small" id="rbo_name_error" style="color:red;"></span> 
                              </div>
                              
                            </div>
                   
                    
                  </fieldset>
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="rbo_id" value="<?php echo $RBOdata->rbo_id; ?>">
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

    $("#RBO_submit").on("submit",function(){
      var bank_id = $("#bank_id").val();
      var state_id = $("#state_id").val();
      var rbo_name = $("#rbo_name").val();

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
       if(rbo_name == ''){
        $("#rbo_name_error").html("Please Enter RBO Name");
        $("#rbo_name").focus();
        return false;
      }else{
        $("#rbo_name_error").html("");
      }
      
      
    });
    
     
   /* $(".eachDoc").on("click",function(){
        var getID = $(this).attr('id');
        var mainID =  $(this).attr('mainID');
            $.ajax({
              url: "<?php echo base_url().'RBO/updateRecord'; ?>",
              type: 'POST',
              data: { recordId: mainID },
              success: function(response) {
                // Handle the response from the server
                console.log(response);
              }
            });
    })*/
    
  </script>
</body>

</html>