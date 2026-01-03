<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Workorders"><?php echo lang('manage_work_orders');?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo lang('work_order_add');?></li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">
  <section id="section4" class="mt-2">
            <h5>Work Order Create Form</h5>
           
            <div class="card">
              <div class="card-body">
                 <form action="<?php echo base_url().'Workorders/insertWorkOrder'; ?>" name="workorder_submit" id="workorder_submit" method="post" enctype="multipart/form-data">
                  <fieldset class="form-fieldset">
                    <legend>Details</legend>
                   <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="fname">Select Bank</label>
                     <select class="custom-select" id="bank_id" name="bank_id">
                          <option value='' selected>Select Bank</option>
                          <?php foreach ($banks as  $value) { ?>
                            <option value="<?php echo $value->bank_id; ?>" <?php if($action == 'edit'){  if($workorderData->bank_id == $value->bank_id){ echo "selected"; }  } ?>><?php echo $value->bank_name; ?></option>
                          <?php } ?>
                        </select>
                      <span class="small" id="bank_id_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-4">
                       <label for="fname">Select Branch</label>
                     <select class="custom-select" id="branch_id" name="branch_id">
                          <option value='' selected>Select Branch</option>
                          <?php foreach ($branchs as  $value) { ?>
                            <option value="<?php echo $value->branch_id; ?>" <?php if($action == 'edit'){  if($workorderData->branch_id == $value->branch_id){ echo "selected"; }  } ?>><?php echo $value->branch_name; ?></option>
                          <?php } ?>
                        </select>
                      <span class="small" id="branch_id_error" style="color:red;"></span> 
                    </div>
                    
                  </div>
                 
                  <div class="form-row">
                   
                  
                    <div class="form-group col-md-4">
                     <label for="work_order_num">Work Order Number</label>
                      <input type="tel" class="form-control" name="work_order_num" id="work_order_num" placeholder="Work Order Number" value="<?php if($action == 'edit'){ echo $workorderData->work_order_num; } ?>">
                      <span class="small" id="vehicle_engine_num_error" style="color:red;"></span>
                    </div>
                  
                     
                    <div class="form-group col-md-4">                      
                     <label for="work_order_doc">Work Order Document</label>
                        <input type="file" class="form-control" name="work_order_doc" id="work_order_doc">
                        <span class="small" id="work_order_doc_error" style="color:red;"></span>
                    </div>
                  </div>
                 </fieldset>
                 <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="order_id" value="<?php echo $workorderData->order_id; ?>">
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
 
  <script src="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.js"></script>
  <script>
    $(() => {
      $('.summernote').summernote()
       $('.summernote-air').summernote({
        airMode: true
      })
        // Allow Input
      flatpickr('.datepicker-input', {
        allowInput: true
      })
      // Datetime
      flatpickr('.datetimepicker', {
        enableTime: true
      })
    })
  </script>

  <!-- Plugins -->
  <!-- JS plugins goes here -->
  <script type="text/javascript">

    $(() => {
     
      flatpickr('.datepicker-input', {
        allowInput: true
      })
    })
 
  $(document).ready(function(){
    $("#bank_id").on("change",function(){
     var bank_id = $(this).val();
     $.ajax({  
        url:"<?php echo base_url(); ?>Workorders/getBranchas",
        data: {bank_id: bank_id },  
        type: "POST",  
        success:function(data){ 
            var htmlString ='';
            htmlString+="<option value=''>Select Branch</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['branch_id']+">"+data[i]['branch_name']+"</option>"
            });
            $("#branch_id").html(htmlString);            
        }
    });
   
    });
  });
  

    $("#workorder_submit").on("submit",function(){
      var bank_id = $("#bank_id").val();
      var branch_id = $("#branch_id").val();
      var branch_controller = $("#branch_controller").val();      
      var barrower_name = $("#barrower_name").val();      
      var work_order_num = $("#work_order_num").val();
      var work_order_doc = $("#work_order_doc").val();
    

      if(bank_id == ''){
        $("#bank_id_error").html("Bank Is Required");
        $("#bank_id").focus();
        return false;
      }else{
        $("#bank_id_error").html("");
      }
      if(branch_id == ''){
        $("#branch_id_error").html("Branch Is Required");
        $("#branch_id").focus();
        return false;
      }else{
        $("#branch_id_error").html("");
      }
      if(branch_controller == ''){
        $("#branch_controller_error").html("Branch Controller Is Required");
        $("#branch_controller").focus();
        return false;
      }else{
        $("#branch_controller_error").html("");
      }
     
      if(barrower_name == ''){
        $("#barrower_name_error").html("Barrower Name Is Required");
        $("#barrower_name").focus();
        return false;
      }else{
        $("#barrower_name_error").html("");
      }
      if(work_order_num == ''){
        $("#work_order_num_error").html("Work Order Number Is Required");
        $("#work_order_num").focus();
        return false;
      }else{
        $("#work_order_num_error").html("");
      }

      <?php if($action != 'edit') { ?> 

      
      if(work_order_doc == ''){
        $("#work_order_doc_error").html("Work Order Document Is Required");
        $("#work_order_doc").focus();
        return false;
      }else{
        $("#work_order_doc_error").html("");
      }      

      <?php } ?>
      
    });
  </script>

</body>

</html>