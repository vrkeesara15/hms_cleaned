<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>CompanyAssets">Company Assets</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Company Assets</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">
        
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="" name="add_submit" id="add_submit" method="post" enctype="multipart/form-data">
                 
                  <span class="small" id="gst_duplicate_error" style="color:red;"></span> 
                  <fieldset class="form-fieldset">
                    <legend><?php if($action == 'edit'){ echo 'Edit'; } else { echo 'Add'; } ?> Company Assets Form</legend>
                    
                      <div class="form-row">
                          <div class="form-group col-sm-3">
                          <label for="name">Name:<span style="color: red">*</span></label>
                          <input type="text" class="form-control" id="name" name="name" value="<?php if($action == 'edit'){ echo $companyAssetsData->name; } ?>">
                          <span class="small" id="name_error" style="color:red;"></span> 
                        </div>
                        <div class="form-group col-sm-3">
                          <label for="amount">Amount:<span style="color: red">*</span></label>
                          <input type="text" class="form-control" id="amount" name="amount" value="<?php if($action == 'edit'){ echo $companyAssetsData->amount; } ?>">
                          <span class="small" id="amount_error" style="color:red;"></span> 
                        </div>
                        <div class="form-group col-sm-3">
                          <label for="fname">Bill Type:<span style="color: red">*</span></label>
                          <select class="custom-select" id="bill_type" name="bill_type">
                            <option value='' selected>Select Bill Type</option>
                            <option value='gst' <?php echo (($companyAssetsData->bill_type == 'gst')?'selected':''); ?>>GST</option>
                            <option value='non-gst' <?php echo (($companyAssetsData->bill_type == 'non-gst')?'selected':''); ?>>Non GST</option>
                          </select>
                          <span class="small" id="bill_type_error" style="color:red;"></span> 
                        </div>
                        <div class="form-group col-sm-3">
                          <label for="purchase_date">Purchase Date:<span style="color: red">*</span></label>
                          <input type="text" class="form-control datepicker-input" autocomplete="off" placeholder="Date" id="purchase_date" name="purchase_date" value="<?php if($action == 'edit' && !empty($companyAssetsData->purchase_date)){ echo $companyAssetsData->purchase_date; } ?>">
                          <span class="small" id="purchase_date_error" style="color:red;"></span> 
                        </div>
                      </div>
                     <div class="form-row">
                      <div class="form-group col-sm-3">
                          <label for="warranty_expiry_date">Warranty Expiry Date:<span style="color: red">*</span></label>
                          <input type="text" class="form-control datepicker-input" autocomplete="off" placeholder="Date" id="warranty_expiry_date" name="warranty_expiry_date" value="<?php if($action == 'edit' && !empty($companyAssetsData->warranty_expiry_date)){ echo $companyAssetsData->warranty_expiry_date; } ?>">
                          <span class="small" id="warranty_expiry_date_error" style="color:red;"></span> 
                        </div>
                        <div class="form-group col-sm-3">
                        <label for="bill_file">Bill File Upload:<span style="color: red">*</span></label>
                        <input type="file" class="form-control" name="bill_file" id="bill_file">
                        <span class="small" id="bill_file_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-sm-3">
                          <label for="description">Description</label>
                          <input type="text" class="form-control" id="description" name="description" value="<?php if($action == 'edit'){ echo $companyAssetsData->description; } ?>">
                          <span class="small" id="description_error" style="color:red;"></span> 
                        </div>
                        <div class="form-group col-sm-3">
                          <label for="contact_details">Contact Details</label>
                          <input type="text" class="form-control" id="contact_details" name="contact_details" value="<?php if($action == 'edit'){ echo $companyAssetsData->contact_details; } ?>">
                          <span class="small" id="contact_details_error" style="color:red;"></span> 
                        </div>
                    </div>
                    
                  </fieldset>
                    <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                    <input type="hidden" name="company_asset_id" id="company_asset_id" value="<?php echo $companyAssetsData->company_asset_id; ?>">
                  <button class="btn btn-primary" type="submit" id="assetsave">Save</button>
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
        //maxDate: new Date(),
      })
    })
  </script>
<script type="text/javascript">


    $("#add_submit").on("submit",function(){
        var name = $("#name").val();
        var amount = $("#amount").val();
        var bill_type = $("#bill_type").val();
        var purchase_date = $("#purchase_date").val();
        var warranty_expiry_date = $("#warranty_expiry_date").val();
        var bill_file = $("#bill_file").val();
        if(name == ""){
            $("#name_error").html("Please enter Name");
            return false;
        }else{
            $("#name_error").html("");
        }
         if(amount == ""){
            $("#amount_error").html("Please enter amount");
            return false;
        }else{
            $("#amount_error").html("");
        }
        if(bill_type == ""){
            $("#bill_type_error").html("Please enter Bill Type");
            return false;
        }else{
            $("#bill_type_error").html("");
        }
        if(purchase_date == ""){
            $("#purchase_date_error").html("Please enter Name");
            return false;
        }else{
            $("#purchase_date_error").html("");
        }
        if(warranty_expiry_date == ""){
            $("#warranty_expiry_date_error").html("Please enter Warranty Expiry Date");
            return false;
        }else{
            $("#warranty_expiry_date_error").html("");
        }
        <?php if($action != 'edit'){ ?>
        if(bill_file == ""){
            $("#bill_file_error").html("Please uplaod Bill");
            return false;
        }else{
            $("#bill_file_error").html("");
        }
        <?php } ?>
        $("#assetsave").hide();
      var result = 0;

    });


  </script>
</body>

</html>