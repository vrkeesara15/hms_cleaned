<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Empanelments">Empanelment</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Empanelment</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

         
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Empanelments/insertEmpanelments'; ?>" name="empanelments_submit" id="empanelments_submit" method="post" enctype="multipart/form-data">
                  
                  <fieldset class="form-fieldset">
                    <legend>Empanelment Form</legend>
                      <div class="form-row">
                       <div class="form-group col-sm-4">
                        <label for="bank_id">Bank</label>
                        <select class="custom-select" id="bank_id" name="bank_id">
                          <option value='' selected>Select bank</option>
                          <?php foreach ($bank_details as $key => $value) { ?>
                            <option value="<?php echo $value->bank_id; ?>" <?php if($action == 'edit'){  if($empanelmentdata->bank_id == $value->bank_id){ echo "selected"; }  } ?>><?php echo $value->bank_name; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="bank_id_error" style="color:red;"></span> 
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="state_id">State</label>
                        <select class="custom-select" id="state_id" name="state_id">
                          <option value='' selected>Select state</option>
                          <?php foreach ($state_details as $key => $value) { ?>
                            <option value="<?php echo $value->state_id; ?>" <?php if($action == 'edit'){  if($empanelmentdata->state_id == $value->state_id){ echo "selected"; }  } ?>><?php echo $value->state_name; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="state_id_error" style="color:red;"></span> 
                      </div>
                      <div class="form-group col-sm-4"> 
                        <label for="circle">Circle</label>
                        <input type="text" class="form-control" id="circle" name="circle" value="<?php if($action == 'edit'){ echo $empanelmentdata->circle; } ?>">
                        <span class="small" id="circle_error" style="color:red;"></span> 
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                       <label for="empanelment_doc">Empanelment Document</label>
                        <input type="file" class="form-control" id="empanelment_doc" name="empanelment_doc">
                        <span class="small" id="empanelment_doc_error" style="color:red;"></span> 
                      </div>
                      <div class="form-group col-sm-6">
                       <label for="agreement_doc">Agreement Document</label>
                        <input type="file" class="form-control" id="agreement_doc" name="agreement_doc">
                        <span class="small" id="agreement_doc_error" style="color:red;"></span> 
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="start_date">Start Date</label>
                        <input type="text" class="form-control datepicker-input form-control-sm" id="start_date" name="start_date" value="<?php if($action == 'edit'){ echo (($empanelmentdata->start_date == '0000-00-00 00:00:00')?' ':$empanelmentdata->start_date); } ?>">
                        <span class="small" id="circle_error" style="color:red;"></span> 
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="text" class="form-control datepicker-input form-control-sm" id="expiry_date" name="expiry_date" value="<?php if($action == 'edit'){ echo (($empanelmentdata->expiry_date == '0000-00-00 00:00:00')?' ':$empanelmentdata->expiry_date); } ?>">
                        <span class="small" id="circle_error" style="color:red;"></span> 
                      </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label for="notes">Notes</label>
                            <textarea class="form-control" id="notes" name="notes"><?php if($action == 'edit'){ echo $empanelmentdata->notes; } ?></textarea>
                            <span class="small" id="notes_error" style="color:red;"></span> 
                        </div>
                    </div>
                  </fieldset>
                   <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="empanelment_id" value="<?php echo $empanelmentdata->empanelment_id; ?>">
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
      <script src="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.js"></script>
<script type="text/javascript">

    $(() => {
      $('.summernote').summernote()
       $('.summernote-air').summernote({
        airMode: true
      })
        // Allow Input
      flatpickr('.datepicker-input', {
        allowInput: true,
        //maxDate: new Date(),
      })
    })
    $("#empanelments_submit").on("submit",function(){
      var bank_id = $("#bank_id").val();
      var state_id = $("#state_id").val();
      var circle = $("#circle").val();
      var agreement_doc = $("#agreement_doc").val();
      var empanelment_doc = $("#empanelment_doc").val();
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
      if(circle == ''){
        $("#circle_error").html("Circle Number Required");
        $("#circle").focus();
        return false;
      }else{
        $("#circle_error").html("");
      }
       <?php if($action != 'edit') { ?>
       
    //   if(agreement_doc == ''){
    //     $("#agreement_doc_error").html("Agreement Document Required");
    //     $("#agreement_doc").focus();
    //     return false;
    //   }else{
    //     $("#agreement_doc_error").html("");
    //   }
      
    <?php } ?>
      
    });
  </script>
  <!-- Plugins -->
  <!-- JS plugins goes here -->

</body>

</html>