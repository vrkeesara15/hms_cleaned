   <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Announcements">All Announcements</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Announcement</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Announcements/insertAnnouncements'; ?>" name="bank_submit" id="bank_submit" method="post" enctype="multipart/form-data">
                 
                  
                  <fieldset class="form-fieldset">
                    <legend>Add Announcement Form</legend>
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <select class="col-sm-6 selectpicker" id="employee_id" name="employee_id[]" multiple  data-live-search="true" data-actions-box="true" title="Select Employee">
                          <?php
                          if(!empty($emp_details)){
                          foreach ($emp_details as $key => $value) { 
                            
                          ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->fname.' '.$value->lname; ?> <?php if($action == 'edit'){ (in_array($announcementdata->emp_id, $editEmployee))?'selected':''; } ?></option>
                          <?php  } } ?>
                        </select> 
                      </div>
                    </div>
                        
                    <div class="form-row">
                     <div class="form-group col-sm-4">
                        <label for="payment_date">Start Date</label>
                        <input type="text"  class="form-control datepicker-input"  name="start_date" id="start_date" placeholder="Start Date" value="<?php if($action == 'edit'){ echo date('Y-m-d',strtotime($announcementdata->start_date)); } ?>">
                        <span class="small" id="start_date_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="payment_date">End Date</label>
                        <input type="text"  class="form-control datepicker-input1"  name="end_date" id="end_date" placeholder="End Date" value="<?php if($action == 'edit'){ echo date('Y-m-d',strtotime($announcementdata->end_date)); } ?>">
                        <span class="small" id="end_date_error" style="color:red;"></span>
                      </div>
                    </div>
                     <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="announcement_image">Image:</label>
                        <input type="file" class="form-control" name="announcement_image" id="announcement_image">
                        <span class="small" id="announcement_image_error" style="color:red;"></span>
                      </div>
                    </div>
                    <div class="form-row">
                     <div class="form-group col-sm-6">
                        <label for="payment_date">Description</label>
                        <textarea class="form-control" placeholder="Description" name="description" id="description"><?php if($action == 'edit'){ echo $announcementdata->description; } ?></textarea>
                        <span class="small" id="description_error" style="color:red;"></span>
                      </div>
                    </div>
                  </fieldset>
                   <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="announcement_id" value="<?php echo $announcementdata->id; ?>">
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
    <script src="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


  <!-- Plugins -->
  <!-- JS plugins goes here -->
<script type="text/javascript">
flatpickr('.datepicker-input', {
          /*minDate: "today",*/
        allowInput: true,
        onChange: function(dateObj, dateStr) {
           // console.info(dateObj);
           // console.info(dateStr);
            flatpickr('.datepicker-input1', {
                minDate: dateStr,
                allowInput: true
              })
        }
        
      })
$(function () {
    $('select').selectpicker({
        actionsBox:true
    });
    
    $('#employee_id').selectpicker('val', <?php echo $getEditEmployee; ?>);


});
   $("#addButton").click(function () {
     var limitRows = 10;
     var presentRows = $("#totalrows").val();
      if(presentRows < limitRows){
        var presentRow = parseInt(presentRows)+1;
        $("#totalrows").val(presentRow);
        var newTr = $('<div class="form-row"></div>').attr("id", "row_"+presentRow);
        newTr.html("<div class='form-group col-sm-4'><label for='charge_name'>Charge Name"+presentRow+"</label><input type='text' name='charge_name"+presentRow+"' id='charge_name"+presentRow+"' class='form-control' placeholder='Enter Charge Name' value=''  /><span id='charge_name"+presentRow+"_error' class='small' style='color:red'></span></div><div class='form-group col-sm-4'><label for='charge_name'>Charge Amount"+presentRow+"</label><input type='text' name='charge_amount"+presentRow+"' id='charge_amount"+presentRow+"' class='form-control' placeholder='Enter Charge Amount' value=''  /><span id='charge_amount"+presentRow+"_error' class='small' style='color:red'></span></div>");
         newTr.appendTo("#chrgeid");                
 }else {
        alert("Limit Only 10 Charges");
        return false;
    }
      
});
   $("#removeButton").click(function () {
     var limitRows = 1;
    var presentRows =  $("#totalrows").val();
    var presentRow = parseInt(presentRows);
      if(presentRow <=1){
          alert("At Least Keep One Row ");
          return false;
      } else {            
          $("#row_"+presentRow).remove();   
          $("#totalrows").val(presentRow-1);    
      }
   });



$("#bank_submit").on("submit",function(){

    var bank_name = $("#bank_name").val();
    if(bank_name == ''){
      $("#bank_name_error").html("Bank Name Required");
      $("#bank_name").focus();
      return false;
    }else{
      $("#bank_name_error").html("");
    }
       
 

  // var totalrows = $("#totalrows").val();

 
  // var charge_name = "";
  // var charge_amount = "";


  // for(i=1;i<=totalrows;i++){
  //   charge_name = $("#charge_name"+i).val();
  //   charge_amount = $("#charge_amount"+i).val();
    
  //   if(charge_name == ''){
  //     $("#charge_name"+i+"_error").html("Charge Name Is  Required");
  //     $("#charge_name").focus();
  //     return false;
  //   }else{
  //     $("#charge_name"+i+"_error").html("");
  //   }
  //   if(charge_amount == ''){
  //     $("#charge_amount"+i+"_error").html("Charge Amount Is  Required");
  //     $("#charge_amount").focus();
  //     return false;
  //   }else{
  //     $("#charge_amount"+i+"_error").html("");
  //   }       

  // }
   //return false;
});

    
  </script>
</body>

</html>