
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="javascript:void(0)">Forms</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Employee</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

         
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Employees/insertEmployee'; ?>" name="profile_submit" id="profile_submit" method="post" enctype="multipart/form-data">
                  <fieldset class="form-fieldset">
                    <legend>Basic Info</legend>
                    <div class="form-group">
                      <label for="fname">First Name</label>
                      <input type="text" readonly="" class="form-control" name="fname" id="fname" placeholder="Enter your fullname" value="<?php if($action == 'edit'){ echo $employeedata->fname; } ?>">
                      <span class="small" id="fname_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group">
                      <label for="lname">Last Name</label>
                      <input type="text" readonly="" class="form-control" name="lname" id="lname" placeholder="Enter your Last" value="<?php if($action == 'edit'){ echo $employeedata->lname; } ?>">
                      <span class="small" id="lname_error" style="color:red;"></span>
                    </div>
                    <div class="form-group">
                      <label for="phone">Phone Number</label>
                      <input type="tel" readonly="" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" value="<?php if($action == 'edit'){ echo $employeedata->phone; } ?>">
                      <span class="small" id="phone_error" style="color:red;"></span>
                    </div>
                    <div class="form-group">
                      <label for="designation">Designation</label>
                      <input type="tel"  readonly="" class="form-control" name="designation" id="designation" placeholder="Enter your Designation" value="<?php if($action == 'edit'){ echo $employeedata->designation; } ?>">
                      <span class="small" id="designation_error" style="color:red;"></span>
                    </div>
                  </fieldset>
                  <fieldset class="form-fieldset">
                    <legend>Login</legend>
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="email">Email</label>
                        <input type="text"  readonly="" class="form-control" name="email" id="email" value="<?php if($action == 'edit'){ echo $employeedata->email; } ?>">
                        <span class="small" id="email_error" style="color:red;"></span>
                      </div>
                      <?php if($action != 'edit') { ?>
                      <div class="form-group col-sm-6">
                       <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <span class="small" id="password_error" style="color:red;"></span>
                      </div>
                      <?php } ?>
                    </div>
                  </fieldset>
                   
                    
                  <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="emp_id" value="<?php echo $employeedata->id; ?>">
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
    $("#profile_submit").on("submit",function(){
      var fname = $("#fname").val();
      var lname = $("#lname").val();
      var phone = $("#phone").val();
      var designation = $("#designation").val();
      var email = $("#email").val();
   
      if(fname == ''){
        $("#fname_error").html("First Name Required");
        $("#fname").focus();
        return false;
      }else{
        $("#fname_error").html("");
      }
      if(lname == ''){
        $("#lname_error").html("Last Name Required");
        $("#lname").focus();
        return false;
      }else{
        $("#lname_error").html("");
      }
      if(phone == ''){
        $("#phone_error").html("Phone Number Required");
        $("#phone").focus();
        return false;
      }else{
        $("#phone_error").html("");
      }
      if(designation == ''){
        $("#designation_error").html("Designation Required");
        $("#designation").focus();
        return false;
      }else{
        $("#designation_error").html("");
      }
      if(email == ''){
        $("#email_error").html("Email Required");
        $("#email").focus();
        return false;
      }else{
        $("#email_error").html("");
      }
      <?php if($action != 'edit') { ?>


      // if(employer_id_card == ''){
      //   $("#employer_id_card_error").html("Employer Id Card Required");
      //   $("#employer_id_card").focus();
      //   return false;
      // }else{
      //   $("#employer_id_card_error").html("");
      // }
      // if(employer_auth_letter == ''){
      //   $("#employer_auth_letter_error").html("Employer Authorization Letter Required");
      //   $("#employer_auth_letter").focus();
      //   return false;
      // }else{
      //   $("#employer_auth_letter_error").html("");
      // }
      // if(employer_seal_format == ''){
      //   $("#employer_seal_format_error").html("Employer Seal Format Required");
      //   $("#employer_seal_format").focus();
      //   return false;
      // }else{
      //   $("#employer_seal_format_error").html("");
      // }
      // if(employee_aadhar_card == ''){
      //   $("#employee_aadhar_card_error").html("Employee Aadhar Card Required");
      //   $("#employee_aadhar_card").focus();
      //   return false;
      // }else{
      //   $("#employee_aadhar_card_error").html("");
      // }
      // if(employee_pan_card == ''){
      //   $("#employee_pan_card_error").html("Employee Pan Card Required");
      //   $("#employee_pan_card").focus();
      //   return false;
      // }else{
      //   $("#employee_pan_card_error").html("");
      // }
      // if(employee_edu_certificate == ''){
      //   $("#employee_edu_certificate_error").html("Employee Education Certificates Required");
      //   $("#employee_edu_certificate").focus();
      //   return false;
      // }else{
      //   $("#employee_edu_certificate_error").html("");
      // }
      // if(employee_resume == ''){
      //   $("#employee_resume_error").html("Employee Resume Required");
      //   $("#employee_resume").focus();
      //   return false;
      // }else{
      //   $("#employee_resume_error").html("");
      // }
<?php } ?>
      
    });
  </script>

</body>

</html>