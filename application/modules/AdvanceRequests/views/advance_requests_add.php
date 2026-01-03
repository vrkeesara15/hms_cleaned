
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>AdvanceRequests">Advance Requests</a></li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">
            <section id="section2" class="mt-2">
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'AdvanceRequests/insertAdvanceRequests'; ?>" name="profile_submit" id="profile_submit" method="post" enctype="multipart/form-data">
                  <fieldset class="form-fieldset">
                    <legend>Advance Requests</legend>
                    <div class="form-row">
                        
                        <?php 
                         if($this->session->userdata('user_role') == '1'){ ?>
                        <div class="form-group col-sm-4">
                            <label for="amount">Select Employee</label>
                            <select class="custom-select " id="employee_id" name="employee_id">
                          <option value='' selected>Select Employee</option>
                          <?php foreach ($emp_details as $key => $value) { 
                            if($value->id != 1) {
                          ?>
                            <option value="<?php echo $value->id; ?>" <?=(($employee_id == $value->id)?"selected":"")?>><?php echo $value->fname.' '.$value->lname; ?></option>
                          <?php } } ?>
                        </select>
                        <span class="small" id="employee_id_error" style="color:red;"></span> 
                         </div>
                         <?php } ?>
                         
                      <div class="form-group col-sm-4">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder=" Amount" value="<?php if($action == 'edit'){ echo $employeedata->amount; } ?>">
                        <span class="small" id="amount_error" style="color:red;"></span> 
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="purpose">Purpose</label>
                        <input type="text" class="form-control" name="purpose" id="purpose" placeholder="Purpose" value="<?php if($action == 'edit'){ echo $employeedata->purpose; } ?>">
                        <span class="small" id="purpose_error" style="color:red;"></span>
                      </div>
                  </div>
                  </fieldset>
                  <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <button class="btn btn-primary" type="submit" id="submitbtn">Submit</button>
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
    
    $("#profile_submit").on("submit",function(){
      var amount = $("#amount").val();
      var purpose = $("#purpose").val();
      
      <?php 
     if($this->session->userdata('user_role') == '1'){ ?>
     var employee_id = $("#employee_id").val();
     if(employee_id == ''){
        $("#employee_id_error").html("Employee Required");
        $("#employee_id").focus();
        return false;
      }else{
        $("#employee_id_error").html("");
      }
      <?php } ?>

     
      if(amount == ''){
        $("#amount_error").html("Amount Required");
        $("#amount").focus();
        return false;
      }else{
        $("#amount_error").html("");
      }
      if(purpose == ''){
        $("#purpose_error").html("Purpose Required");
        $("#purpose").focus();
        return false;
      }else{
        $("#purpose_error").html("");
      }
      $("#submitbtn").hide();
    });
  </script>

</body>

</html>