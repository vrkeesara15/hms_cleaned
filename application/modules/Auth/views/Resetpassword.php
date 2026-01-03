   <!-- Plugins -->
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/select2/css/select2.min.css">
 <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="javascript:void(0)">Employees</a></li>
          <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

        <section id="section4" class="mt-5">
            <h5>Reset Password Form</h5>
            <?php if (isset($old_password_error) || isset($password_change_success)) {  ?>
              <?php if (isset($old_password_error)) { ?>
                <div class="alert alert-danger alert-dismissable">
                <i class="fa fa-ban"></i>
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <b>Alert!</b> 
                <?php echo $old_password_error; ?>
                </div>
                <?php }else { ?>
                <div class="alert alert-success alert-dismissable">
                <i class="fa fa-check"></i>
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <b>Alert!</b> 
                <?php echo $password_change_success; ?>
                </div>
              <?php } ?>
              <?php } ?> 
            <div class="card">
              <div class="card-body">
                 <?php
                  $url = current_url();
                    $attributes = array(
                                      'name' => 'resetform_from',
                                      'id'=>'resetform_from',
                                      'method'=>'post',
                                      'enctype'=>'multipart/form-data');
                     echo form_open($url, $attributes); 
                  ?>              
                  <div class="form-group row no-gutters">
                    <label for="firstNameLeft" class="col-3 col-sm-2 col-form-label">Select Employee</label>
                    <div class="col-sm-5 mb-1">
                     <select class="form-control select2" data-select2-search="true" data-placeholder="Select Employee" name="emp_id" id="emp_id">
                       <option value=""></option>
                      <?php if($employees !='') {
                        foreach ($employees as  $value) { ?>
                        <option value="<?php echo $value->id;?>">
                          <?php echo $value->fname.' ('.$value->email.')';?>
                          </option>    
                        <?php } }?>
                    </select>
                    <span class="small" id="emp_id_error" style="color:red;"></span>
                  </div>
                  

                  </div>
                  <div class="form-group row no-gutters">
                    <label for="lastNameLeft" class="col-3 col-sm-2 col-form-label">New Password</label>
                    <div class="col">
                      <input type="text" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password">
                       <span class="small" id="new_password_error" style="color:red;"></span>
                    </div>
                  </div>
                  <div class="form-group row no-gutters">
                    <label for="emailLeft" class="col-3 col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col">
                      <input type="text" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password">
                       <span class="small" id="confirm_password_error" style="color:red;"></span>
                    </div>
                  </div>
                 
                  <div class="row no-gutters">
                    <div class="col offset-3 offset-sm-2">                      
                      <button class="btn btn-primary" type="submit" id="psw_submit">Submit</button>
                    </div>
                  </div>
                  <?php echo form_close(); ?> 
              </div>
            </div>
          </section>
</div>

  <div class="col-3 d-none d-xl-block">
  </div>
</div>
           </div>
    <!-- /Main body -->

  </div>
  <!-- /Main -->
 <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>

    <!-- Plugins -->
  <script src="<?php echo assets_url(); ?>new/plugins/select2/js/select2.min.js"></script>
  <script>
    $(() => {
      App.select2()
    })
  </script>
  <script type="text/javascript">
    $("#resetform_from").on("submit",function(){
      var emp_id = $("#emp_id").val();
      var new_password = $("#new_password").val();
      var confirm_password = $("#confirm_password").val();
      if(emp_id == ''){
        $("#emp_id_error").html("Employee Selection Required");
        $("#emp_id").focus();
        return false;
      }else{
        $("#emp_id_error").html("");
      }
      if(new_password == ''){
        $("#new_password_error").html("New Password Required");
        $("#new_password").focus();
        return false;
      }else{
        $("#new_password_error").html("");
      }
      if(confirm_password == ''){
        $("#confirm_password_error").html("Confirm Password Required");
        $("#confirm_password").focus();
        return false;
      }else{
        $("#confirm_password_error").html("");
      }

      if(new_password != confirm_password){
         $("#confirm_password_error").html("New password And Confirm Password Should Equal");
        $("#confirm_password").focus();
        return false;
      }else{
        $("#confirm_password_error").html("");
      }
      
      
    });
  </script>