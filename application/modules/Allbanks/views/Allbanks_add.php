
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Allbanks">All Banks</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Bank</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Allbanks/insertAllbanks'; ?>" name="bank_submit" id="bank_submit" method="post" enctype="multipart/form-data">
                 
                  
                  <fieldset class="form-fieldset">
                    <legend>Add Banks Form</legend>
                      
                    <div class="form-row">
                     <div class="form-group col-sm-4">
                        <label for="bank_name">Bank Name</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php if($action == 'edit'){ echo $bankdata->bank_name; } ?>" <?php if($action == 'edit'){ ?>readonly <?php } ?>>
                        <span class="small" id="bank_name_error" style="color:red;"></span> 
                      </div>
                      
                    <div class="form-group col-sm-4">
                       <label for="bank_logo">Bank Logo</label>
                        <input type="file" class="form-control" id="bank_logo" name="bank_logo">
                        <span class="small" id="bank_logo_error" style="color:red;"></span> 
                    </div>
                      
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                         <label for="address">Address</label>
                          <textarea class="form-control" name="address" id="address" placeholder="Address"><?php if($action == 'edit'){ echo $bankdata->address; } ?></textarea>
                          <span class="small" id="remarks_error" style="color:red;"></span>
                        </div>                  
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                     <label for="notes">Notes</label>
                      <textarea class="form-control" name="notes" id="notes" placeholder="Notes"><?php if($action == 'edit'){ echo $bankdata->notes; } ?></textarea>
                      <span class="small" id="notes_error" style="color:red;"></span>
                    </div>                  
                    </div>
                  </fieldset>
                   <input type="hidden" name="totalrows" id="totalrows" value="<?php if($action =='edit'){echo $chargescount; }else{ echo 1; } ?>">
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="bank_id" value="<?php echo $bankdata->bank_id; ?>">
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


$("#bank_submit").on("submit",function(){

    var bank_name = $("#bank_name").val();
    if(bank_name == ''){
      $("#bank_name_error").html("Bank Name Required");
      $("#bank_name").focus();
      return false;
    }else{
      $("#bank_name_error").html("");
    }
       
});

    
  </script>
</body>

</html>