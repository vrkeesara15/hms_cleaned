
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loantypes">Loan Types</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Loan Type</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Loantypes/insertLoantypes'; ?>" name="typeform_submit" id="typeform_submit" method="post" enctype="multipart/form-data">
                 
                  
                  <fieldset class="form-fieldset">
                    <legend>Loan Type Add Form</legend>
                     <div class="form-row">
                        <div class="form-group col-sm-6">
                        <label for="type_name">Type Name</label>
                        <input type="text" class="form-control" id="type_name" name="type_name" value="<?php if($action == 'edit'){ echo $typedata->type_name; } ?>">
                        <span class="small" id="type_name_error" style="color:red;"></span> 
                      </div>
                    </div>
                    
                  </fieldset>
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="type_id" id="type_id" value="<?php echo $typedata->type_id; ?>">
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

    $("#typeform_submit").on("submit",function(){
      
      var type_name = $("#type_name").val();      
      if(type_name == ''){
        $("#type_name_error").html("Type Name Required");
        $("#type_name").focus();
        return false;
      }else{
        $("#type_name_error").html("");
      }      
    });
  </script>
</body>

</html>