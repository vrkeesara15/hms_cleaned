<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">

    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
           <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loanaccounts">Car Loan Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Re-assign Form</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">
          <section id="section2" class="mt-1">
            <h5>Re-assign Form</h5> 
            <div class="card">
              <div class="card-body">
               <form action="<?php echo base_url().'Loanaccounts/insertEmpReassignform'; ?>" name="re_assign_submit" id="re_assign_submit" method="post" enctype="multipart/form-data">
                  <fieldset class="form-fieldset">
                    <legend>Re-assign Info</legend>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="role">Select User</label>
                      <select class="custom-select" id="emp_id" name="emp_id">
                        <?php foreach ($employees as  $value) { ?>
                          <option value="<?php echo $value->id;?>" <?php if($action == 'edit' && $value->id== $loandata->re_assign_id){ echo 'selected'; } ?>><?php echo $value->fname.' '.$value->lname;?></option>
                        <?php } ?>                        
                      </select>
                      <span class="small" id="user_role_error" style="color:red;"></span>
                    </div>
                  </div>
                  </fieldset>
                   <input type="hidden" name="loan_id" value="<?php echo $loan_id; ?>">
                  <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                  <?php if(!empty($loandata)){ ?>
                     <input type="hidden" name="re_assign_id" value="<?php echo $loandata->re_assign_id; ?>">
                   <?php } ?>
                  <button class="btn btn-secondary" type="reset">Reset</button>
                  <button class="btn btn-primary" type="submit">Save</button>
                </form>
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

  <!-- Main Scripts -->
  <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>
  <!-- <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->
  <script src="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.js"></script>
   <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>

<!--<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCOMOjJl06Rmnpsg39_HwCJnlYJdPpRYRdsf&sensor=false&libraries=places'></script>-->
   
<script src="<?php echo base_url();?>assets/new/js/locationpicker.js"></script> 

  <!-- Plugins -->
  <!-- JS plugins goes here -->
  <script type="text/javascript">

     $(() => {
      flatpickr('.datepicker-input', {
        allowInput: true
      })
    })
   $("#workorder_submit").on("submit",function(){
      var workorder_date = $("#workorder_date").val();
      var workorder_no = $("#workorder_no").val();
      

      var workorder_file = $("#workorder_file").val();
      if(workorder_no == ''){
        $("#workorder_no_error").html("Workorder Number Is Required");
        $("#workorder_no").focus();
        return false;
      }else{
        $("#workorder_no_error").html("");
      }
      if(workorder_date == ''){
        $("#workorder_date_error").html("Workorder Date Is Required");
        $("#workorder_date").focus();
        return false;
      }else{
        $("#workorder_date_error").html("");
      }
     
      
      if(workorder_file == ''){
        $("#workorder_file_error").html("Workorder File Is Required");
        $("#workorder_file").focus();
        return false;
      }else{
        $("#workorder_file").html("");
      }
      
    });
    

  </script>

</body>

</html>