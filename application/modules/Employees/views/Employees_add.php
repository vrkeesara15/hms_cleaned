<style>
.fa-eye { 
    color:#8a2be2 !important;
}
    </style>
</style>
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Employees">Employees</a></li>
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
                    <div class="form-row">

                      <div class="form-group col-sm-4">
                      <label for="role">Select Role</label>
                       <select class="custom-select" id="user_role" name="user_role">
                        <option value="">Select Role</option>
                        <?php if($this->session->userdata('user_role') =='1'){ ?>
                        <option value="2" <?php if($action == 'edit'){ if($employeedata->user_role == '2') echo 'selected'; } ?>>Admin</option>
                      <?php } ?>
                        <option value="3" <?php if($action == 'edit'){ if($employeedata->user_role == '3') echo 'selected'; } ?>>Employee</option>
                      </select>
                      <span class="small" id="user_role_error" style="color:red;"></span>
                    </div>
                      <div class="form-group col-sm-4">
                    
                      <label for="fname">First Name</label>
                      <input type="text" class="form-control" name="fname" id="fname" placeholder=" First Name" value="<?php if($action == 'edit'){ echo $employeedata->fname; } ?>">
                      <span class="small" id="fname_error" style="color:red;"></span> 
                    </div>
                   <div class="form-group col-sm-4">
                      <label for="lname">Last Name</label>
                      <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value="<?php if($action == 'edit'){ echo $employeedata->lname; } ?>">
                      <span class="small" id="lname_error" style="color:red;"></span>
                    </div>
                      
                  </div>
                   <div class="form-row">
                     <div class="form-group col-sm-4">
                      <label for="phone">Phone Number</label>
                      <input type="tel" class="form-control" name="phone" id="phone" placeholder="Mobile Number" value="<?php if($action == 'edit'){ echo $employeedata->phone; } ?>">
                      <span class="small" id="phone_error" style="color:red;"></span>
                    </div>
                   <div class="form-group col-sm-4">
                      <label for="designation">Designation</label>
                      <input type="tel" class="form-control" name="designation" id="designation" placeholder="Designation" value="<?php if($action == 'edit'){ echo $employeedata->designation; } ?>">
                      <span class="small" id="designation_error" style="color:red;"></span>
                    </div>
                    <?php if($this->session->userdata('user_role') =='1'){ ?>
                     <div class="form-group col-sm-4" style="display:block" id="managerselect">
                      <label for="role">Select Manager</label>
                      <select class="custom-select" id="manager_id" name="manager_id">
                        <?php foreach ($admins as  $value) { ?>
                        <option value="<?php echo $value->id;?>" <?php if($action == 'edit' && $value->id== $employeedata->manager_id){ echo 'selected'; } ?>><?php echo $value->fname.' '.$value->lname;?></option>
                        <?php } ?>                        
                      </select>
                      <span class="small" id="user_role_error" style="color:red;"></span>
                    </div>
                  <?php } ?>

                  </div>

                  <div class="form-row">
                    <div class="form-group col-sm-4">
                      <label for="phone">Secondary Phone Number</label>
                      <input type="tel" class="form-control" name="phone2" id="phone2" placeholder="Secondary Phone Number" value="<?php if($action == 'edit'){ echo $employeedata->phone2; } ?>">
                      <span class="small" id="phone2_error" style="color:red;"></span>
                    </div>
                    <div class="form-group col-sm-4">
                      <label for="phone">Secondary Email</label>
                      <input type="tel" class="form-control" name="email2" id="email2" placeholder="Secondary Email" value="<?php if($action == 'edit'){ echo $employeedata->email2; } ?>">
                      <span class="small" id="email2_error" style="color:red;"></span>
                    </div>
                    <div class="form-group col-sm-4">
                      <label for="area">Area</label>
                      <input type="text" class="form-control" name="area" id="area" placeholder="Enter Area" value="<?php if($action == 'edit'){ echo $employeedata->area; } ?>">
                      <span class="small" id="area_error" style="color:red;"></span>
                    </div>
                  </div>
                  </fieldset>
                 <?php if($action == 'edit'){ ?>
                   <?php if($this->session->userdata('user_role') =='1'){ ?>
                  <fieldset class="form-fieldset">
                    <legend>Employee Status</legend>
                    <div class="form-row">

                      <div class="form-group col-sm-4">
                      <label for="role">Select Status</label>
                       <select class="custom-select" id="status" name="status">
                        <option value="">Select Status</option>                        
                        <option value="p" <?php if($action == 'edit'){ if($employeedata->status == 'p') echo 'selected'; } ?>>pending</option>                      
                        <option value="a" <?php if($action == 'edit'){ if($employeedata->status == 'a') echo 'selected'; } ?>>Approved</option>
                        <option value="r" <?php if($action == 'edit'){ if($employeedata->status == 'r') echo 'selected'; } ?>>Rejected</option>
                      </select>
                      <span class="small" id="user_role_error" style="color:red;"></span>
                    </div>
                      
                   <div class="form-group col-sm-4">
                      <label for="remarks">Remarks</label>
                      <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Remark" value="<?php if($action == 'edit'){ echo $employeedata->remarks; } ?>">
                      <span class="small" id="remarks_error" style="color:red;"></span>
                    </div>
                      
                  </div>
                
                  </fieldset>
                <?php } ?>
                 <?php } ?>
                  <fieldset class="form-fieldset">
                    <legend>Login</legend>
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" placeholder="Email" name="email" id="email" value="<?php if($action == 'edit'){ echo $employeedata->email; } ?>">
                        <span class="small" id="email_error" style="color:red;"></span>
                      </div>
                      <?php /*if($action != 'edit') { */ ?>
                      <div class="form-group col-sm-6">
                       <label for="password">Password</label>
                        <input type="text" class="form-control" placeholder="Password" name="password" id="password">
                        <span class="small" id="password_error" style="color:red;"></span>
                      </div>
                      <?php /* } */ ?>
                    </div>
                  </fieldset>
                    <fieldset class="form-fieldset">
                    <legend>Employer Documents</legend>
                    <div class="form-row">
                      
                      <div class="form-group col-sm-6">
                       <label for="employer_auth_letter">Authorization Letter <?php if($action == 'edit') { ?><?php  if(!empty($employeedata->employer_auth_letter)) { ?><a target="_blank" href="<?php echo assets_url(); ?>employer_doc/auth_letter/<?php echo $employeedata->employer_auth_letter; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a><?php } } ?></label>
                        <input type="file" class="form-control" name="employer_auth_letter" id="employer_auth_letter">
                        <span class="small" id="employer_auth_letter_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-sm-6">
                       <label for="employer_seal_format">Seal Format <?php if($action == 'edit') { ?><?php  if(!empty($employeedata->employer_seal_format)) { ?><a target="_blank" href="<?php echo assets_url(); ?>employer_doc/seal_format/<?php echo $employeedata->employer_seal_format; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a><?php } } ?></label>
                        <input type="file" class="form-control" name="employer_seal_format" id="employer_seal_format">
                        <span class="small" id="employer_seal_format_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-sm-6">
                       <label for="sbi_id_card">SBI ID Card <?php if($action == 'edit') { ?><?php  if(!empty($employeedata->sbi_id_card)) { ?><a target="_blank" href="<?php echo assets_url(); ?>employee_doc/sbi_id_card/<?php echo $employeedata->sbi_id_card; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a> <?php } } ?></label>
                        <input type="file" class="form-control" name="sbi_id_card" id="sbi_id_card">
                        <span class="small" id="sbi_id_card_error" style="color:red;"></span>
                      </div>
                       <div class="form-group col-sm-6">
                       <label for="company_id_card">Company ID Card <?php if($action == 'edit') { ?><?php  if(!empty($employeedata->company_id_card)) { ?><a target="_blank" href="<?php echo assets_url(); ?>employee_doc/company_id_card/<?php echo $employeedata->company_id_card; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a> <?php } } ?></label>
                        <input type="file" class="form-control" name="company_id_card" id="company_id_card">
                        <span class="small" id="company_id_card_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-sm-6">
                       <label for="indian_bank_id_card">Indian Bank ID Card <?php if($action == 'edit') { ?><?php  if(!empty($employeedata->indian_bank_id_card)) { ?> <a target="_blank" href="<?php echo assets_url(); ?>employee_doc/indian_bank_id_card/<?php echo $employeedata->indian_bank_id_card; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a><?php } } ?></label>
                        <input type="file" class="form-control" name="indian_bank_id_card" id="indian_bank_id_card">
                        <span class="small" id="indian_bank_id_card_error" style="color:red;"></span>
                     </div>
                     <div class="form-group col-sm-6">
                       <label for="punjab_national_bank_id_card">Punjab National Bank ID Card <?php if($action == 'edit') { ?><?php  if(!empty($employeedata->punjab_national_bank_id_card)) { ?><a target="_blank" href="<?php echo assets_url(); ?>employee_doc/punjab_national_bank_id_card/<?php echo $employeedata->punjab_national_bank_id_card; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a> <?php } } ?></label>
                        <input type="file" class="form-control" name="punjab_national_bank_id_card" id="punjab_national_bank_id_card">
                        <span class="small" id="punjab_national_bank_id_card_error" style="color:red;"></span>
                     </div>
                     <div class="form-group col-sm-6">
                       <label for="indian_overseas_bank_id_card">Indian Overseas Bank ID Card <?php if($action == 'edit') { ?><?php  if(!empty($employeedata->indian_overseas_bank_id_card)) { ?><a target="_blank" href="<?php echo assets_url(); ?>employee_doc/indian_overseas_bank_id_card/<?php echo $employeedata->indian_overseas_bank_id_card; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a> <?php } } ?></label>
                        <input type="file" class="form-control" name="indian_overseas_bank_id_card" id="indian_overseas_bank_id_card">
                        <span class="small" id="indian_overseas_bank_id_card_error" style="color:red;"></span>
                     </div>
                     <div class="form-group col-sm-6">
                       <label for="central_bank_of_india_id_card">Central Bank of India ID Card <?php if($action == 'edit') { ?><?php  if(!empty($employeedata->central_bank_of_india_id_card)) { ?><a target="_blank" href="<?php echo assets_url(); ?>employee_doc/central_bank_of_india_id_card/<?php echo $employeedata->central_bank_of_india_id_card; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a> <?php } } ?></label>
                        <input type="file" class="form-control" name="central_bank_of_india_id_card" id="central_bank_of_india_id_card">
                        <span class="small" id="central_bank_of_india_id_card_error" style="color:red;"></span>
                     </div>
                     <div class="form-group col-sm-6">
                       <label for="canara_bank_id_card">Canara Bank ID Card <?php if($action == 'edit') { ?><?php  if(!empty($employeedata->canara_bank_id_card)) { ?><a target="_blank" href="<?php echo assets_url(); ?>employee_doc/canara_bank_id_card/<?php echo $employeedata->canara_bank_id_card; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a> <?php } } ?></label>
                        <input type="file" class="form-control" name="canara_bank_id_card" id="canara_bank_id_card">
                        <span class="small" id="canara_bank_id_card_error" style="color:red;"></span>
                     </div>
                     <div class="form-group col-sm-6">
                       <label for="karur_vysya_bank_id_card">Karur Vysya Bank ID Card <?php if($action == 'edit') { ?> <?php  if(!empty($employeedata->karur_vysya_bank_id_card)) { ?><a target="_blank" href="<?php echo assets_url(); ?>employee_doc/karur_vysya_bank_id_card/<?php echo $employeedata->karur_vysya_bank_id_card; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a><?php } } ?></label>
                        <input type="file" class="form-control" name="karur_vysya_bank_id_card" id="karur_vysya_bank_id_card">
                        <span class="small" id="karur_vysya_bank_id_card_error" style="color:red;"></span>
                     </div>
                    </div>
                  </fieldset>
                    <fieldset class="form-fieldset">
                    <legend>Employee Documents</legend>
                    <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="employer_id_card">Profile Photo <?php if($action == 'edit') { ?> <?php  if(!empty($employeedata->employer_id_card)) { ?><a target="_blank" href="<?php echo assets_url(); ?>employer_doc/id_card/<?php echo $employeedata->employer_id_card; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a><?php } } ?></label>
                        <input type="file" class="form-control" name="employer_id_card" id="employer_id_card">
                        <span class="small" id="employer_id_card_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="employee_aadhar_card">Signature<?php if($action == 'edit') { ?> <?php  if(!empty($employeedata->employee_signature)) { ?><a target="_blank" href="<?php echo assets_url(); ?>employee_doc/signature/<?php echo $employeedata->employee_signature; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a><?php } } ?></label>
                        <input type="file" class="form-control" name="employee_signature" id="employee_signature">
                        <span class="small" id="employee_signature_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="employee_aadhar_card">Aadhar Card <?php if($action == 'edit') { ?> <?php  if(!empty($employeedata->employee_aadhar_card)) { ?> <a target="_blank" href="<?php echo assets_url(); ?>employee_doc/aadhar_card/<?php echo $employeedata->employee_aadhar_card; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a><?php } } ?></label>
                        <input type="file" class="form-control" name="employee_aadhar_card" id="employee_aadhar_card">
                        <span class="small" id="employee_aadhar_card_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-sm-6">
                       <label for="employee_pan_card">Pan Card <?php if($action == 'edit') { ?> <?php  if(!empty($employeedata->employee_pan_card)) { ?> <a target="_blank" href="<?php echo assets_url(); ?>employee_doc/pan_card/<?php echo $employeedata->employee_pan_card; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a><?php } } ?></label>
                        <input type="file" class="form-control" name="employee_pan_card" id="employee_pan_card">
                        <span class="small" id="employee_pan_card_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-sm-6">
                       <label for="employee_edu_certificate">Education Qualification Certificate <?php if($action == 'edit') { ?> <?php  if(!empty($employeedata->employee_edu_certificate)) { ?><a target="_blank" href="<?php echo assets_url(); ?>employee_doc/edu_certificate/<?php echo $employeedata->employee_edu_certificate; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a> <?php } } ?></label>
                        <input type="file" class="form-control" name="employee_edu_certificate" id="employee_edu_certificate">
                        <span class="small" id="employee_edu_certificate_error" style="color:red;"></span>
                      </div>
                       <div class="form-group col-sm-6">
                       <label for="employee_resume">Resume <?php if($action == 'edit') { ?> <?php  if(!empty($employeedata->employee_resume)) { ?> <a target="_blank" href="<?php echo assets_url(); ?>employee_doc/resume/<?php echo $employeedata->employee_resume; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a><?php } } ?></label>
                        <input type="file" class="form-control" name="employee_resume" id="employee_resume">
                        <span class="small" id="employee_resume_error" style="color:red;"></span>
                      </div>
                       <div class="form-group col-sm-6">
                       <label for="police_verification_certificate">Police Verification Certificate <?php if($action == 'edit') { ?> <?php  if(!empty($employeedata->police_verification_certificate)) { ?> <a target="_blank" href="<?php echo assets_url(); ?>employee_doc/police_verification_certificate/<?php echo $employeedata->police_verification_certificate; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a> <?php } } ?></label>
                        <input type="file" class="form-control" name="police_verification_certificate" id="police_verification_certificate">
                        <span class="small" id="police_verification_certificate_error" style="color:red;"></span>
                      </div>
                      <div class="form-group col-sm-6">
                       <label for="employer_dra_certificate">DRA Certificate <?php if($action == 'edit') { ?> <?php  if(!empty($employeedata->employer_dra_certificate)) { ?> <a target="_blank" href="<?php echo assets_url(); ?>employer_doc/dra_certificate/<?php echo $employeedata->employer_dra_certificate; ?>" class="text-secondary"><i class="mr-2 fa fa-eye"></i></a><?php } } ?></label>
                        <input type="file" class="form-control" name="employer_dra_certificate" id="employer_dra_certificate">
                        <span class="small" id="employer_dra_certificate_error" style="color:red;"></span>
                      </div>
                       
                    </div>
                  </fieldset>

                  <fieldset class="form-fieldset">
                    <legend>Other Info</legend>
                    <div class="form-row">
                      
                     
                      <div class="form-group col-sm-6">
                        <label for="email">PAN No</label>
                        <input type="text" class="form-control" placeholder="PAN Card Number" name="pan_number" id="pan_number" value="<?php if($action == 'edit'){ echo $employeedata->pan_number; } ?>">
                        <span class="small" id="pan_number_error" style="color:red;"></span>
                      </div>
                     
                    </div>

                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="address">Address</label>
                        <textarea class="form-control" placeholder="Address" name="address" id="address"><?php if($action == 'edit'){ echo $employeedata->emp_address; } ?></textarea>
                        <span class="small" id="address_error" style="color:red;"></span>
                      </div>
                    </div>
                  </fieldset>

                  <fieldset class="form-fieldset">
                    <legend>Bank Details</legend>
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="accno">Account Number</label>
                        <input type="text" class="form-control" placeholder="Account Number" name="account_number" id="account_number" value="<?php if($action == 'edit'){ echo $employeedata->account_number; } ?>">
                        <span class="small" id="account_number_error" style="color:red;"></span>
                      </div>

                      <div class="form-group col-sm-4">
                        <label for="accno">Bank Name</label>
                        <input type="text" class="form-control" placeholder="Bank Name" name="bank_name" id="bank_name" value="<?php if($action == 'edit'){ echo $employeedata->bank_name; } ?>">
                        <span class="small" id="bank_name_error" style="color:red;"></span>
                      </div>

                      <div class="form-group col-sm-4">
                        <label for="accno">IFSC Code</label>
                        <input type="text" class="form-control" placeholder="IFSC Code" name="ifsc_code" id="ifsc_code" value="<?php if($action == 'edit'){ echo $employeedata->ifsc_code; } ?>">
                        <span class="small" id="ifsc_code_error" style="color:red;"></span>
                      </div>

                    </div>

                    <div class="form-row">

                      <div class="form-group col-sm-4">
                        <label for="branch_name">Branch Name</label>
                        <input type="text" class="form-control" placeholder="Branch Name" name="branch_name" id="branch_name" value="<?php if($action == 'edit'){ echo $employeedata->branch_name; } ?>">
                        <span class="small" id="branch_name_error" style="color:red;"></span>
                      </div>

                      <div class="form-group col-sm-6">
                        <label for="address">Branch Address</label>
                        <textarea class="form-control" placeholder="Branch Address" name="branch_address" id="branch_address"><?php if($action == 'edit'){ echo $employeedata->branch_address; } ?></textarea>
                        <span class="small" id="branch_address_error" style="color:red;"></span>
                      </div>
                    </div>
                  </fieldset>





                  <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="emp_id" value="<?php echo $employeedata->id; ?>">
                   <?php } ?>
                  <button class="btn btn-secondary" type="reset">Reset</button>
                  <button class="btn btn-primary" type="submit" id="empsave">Save</button>
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
    $("#user_role").on("change",function(){
      var user_role = $("#user_role").val();
      if(user_role == '3'){
        $("#managerselect").attr("style", "display:block")
      }else {
          $("#managerselect").attr("style", "display:none")
      }
    })
    $("#profile_submit").on("submit",function(){
      var user_role = $("#user_role").val();
      var fname = $("#fname").val();
      var lname = $("#lname").val();
      var phone = $("#phone").val();
      
      var designation = $("#designation").val();
      var email = $("#email").val();
      var password = $("#password").val();
      var employer_id_card = $("#employer_id_card").val();
      var employer_auth_letter = $("#employer_auth_letter").val();
      var employer_seal_format = $("#employer_seal_format").val();
      var employee_aadhar_card = $("#employee_aadhar_card").val();
      var employee_pan_card = $("#employee_pan_card").val();
      var employee_edu_certificate = $("#employee_edu_certificate").val();
      var employee_resume = $("#employee_resume").val();
      var police_verification_certificate = $("#police_verification_certificate").val();
      var sbi_id_card = $("#sbi_id_card").val();
      var company_id_card = $("#company_id_card").val();
      
      if(user_role == ''){
        $("#user_role_error").html("First Name Required");
          $("#user_role").focus();
          return false;
      }else{
        $("#user_role_error").html("");
      }
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

      if(password == ''){
        $("#password_error").html("Password Required");
        $("#password").focus();
        return false;
      }else{
        $("#password_error").html("");
      }

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
      
    //   if(police_verification_certificate == ''){
    //      $("#police_verification_certificate_error").html("Police Verification Certificate Required");
    //      $("#police_verification_certificate").focus();
    //      return false;
    //   }else{
    //      $("#police_verification_certificate_error").html("");
    //   }
    //   if(sbi_id_card == ''){
    //      $("#sbi_id_card_error").html("SBI ID Card Required");
    //      $("#sbi_id_card").focus();
    //      return false;
    //   }else{
    //      $("#sbi_id_card_error").html("");
    //   }
    //   if(company_id_card == ''){
    //      $("#company_id_card_error").html("Company ID Card Required");
    //      $("#company_id_card").focus();
    //      return false;
    //   }else{
    //      $("#company_id_card_error").html("");
    //   }
       
<?php } ?>
    $("#empsave").hide();
      
    });
  </script>

</body>

</html>