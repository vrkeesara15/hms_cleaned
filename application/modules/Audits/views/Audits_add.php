
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Audits">Audits</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Billing Period</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Audits/insertAudits'; ?>" name="insert_audit_submit" id="insert_audit_submit" method="post" enctype="multipart/form-data">
                 
                  <span class="small" id="gst_duplicate_error" style="color:red;"></span> 
                  <fieldset class="form-fieldset">
                    <legend>Billing Period Form</legend>
                      <div class="form-row">
                       <div class="form-group col-sm-6">
                        <label for="month">Month</label>
                        <select class="custom-select" id="month" name="month">
                          <option value='' selected>Select Month</option>
                          <?php for ($i=1; $i<=12; $i++) {
                            $monthName = date('F', mktime(0, 0, 0, $i, 10));
                          ?>
                            <option value="<?php echo $i; ?>" <?php if($action == 'edit'){  if($billingData->billing_month == $i){ echo "selected"; }  } ?>><?php echo $monthName; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="month_error" style="color:red;"></span> 
                      </div>

                      <div class="form-group col-sm-6">
                        <label for="year">Year</label>
                        <select class="custom-select" id="year" name="year">
                          <option value='' selected>Select Year</option>
                          <?php for ($y=2023; $y<=2035; $y++) { ?>
                            <option value="<?php echo $y; ?>" <?php if($action == 'edit'){  if($billingData->billing_year == $y){ echo "selected"; }  } ?>><?php echo $y; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="year_error" style="color:red;"></span> 
                      </div>

                      
                     
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">                      
                        <span class=""><label for="debit_file">Debits File</label>
                        <input type="file" class="form-control" name="debit_file" id="debit_file">
                        <span class="small" id="debit_file_error" style="color:red;"></span></span>
                      </div>
                      <div class="form-group col-md-6">                      
                        <span class=""><label for="credit_file">Credits File</label>
                        <input type="file" class="form-control" name="credit_file" id="credit_file">
                        <span class="small" id="credit_file_error" style="color:red;"></span></span>
                      </div>            
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">                      
                        <span class=""><label for="statement_file">Statements File</label>
                        <input type="file" class="form-control" name="statement_file" id="statement_file">
                        <span class="small" id="statement_file_error" style="color:red;"></span></span>
                      </div>
                      <div class="form-group col-md-6">                      
                        <span class=""><label for="contractor_charges_file">Contractor Charges File</label>
                        <input type="file" class="form-control" name="contractor_charges_file" id="contractor_charges_file">
                        <span class="small" id="contractor_charges_file_error" style="color:red;"></span></span>
                      </div>            
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">                      
                        <span class=""><label for="esi_receipt_file">ESI Receipts File</label>
                        <input type="file" class="form-control" name="esi_receipt_file" id="esi_receipt_file">
                        <span class="small" id="esi_receipt_file_error" style="color:red;"></span></span>
                      </div>
                      <div class="form-group col-md-6">                      
                        <span class=""><label for="pf_receipt_file">PF Receipts File</label>
                        <input type="file" class="form-control" name="pf_receipt_file" id="pf_receipt_file">
                        <span class="small" id="pf_receipt_file_error" style="color:red;"></span></span>
                      </div>            
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">                      
                        <span class=""><label for="employee_salary_file">Employee Salaries File</label>
                        <input type="file" class="form-control" name="employee_salary_file" id="employee_salary_file">
                        <span class="small" id="employee_salary_file_error" style="color:red;"></span></span>
                      </div>           
                    </div>
                    
                  </fieldset>
                    <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="billing_period_id" id="billing_period_id" value="<?php echo $billingData->id; ?>">
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

    $("#insert_audit_submit").on("submit",function(){
      var month = $("#month").val();
      var year = $("#year").val();
      
      var action = $("#action").val();
      if(month == ''){
        $("#month_error").html("Please Select Month");
        $("#month").focus();
        return false;
      }else{
        $("#month_error").html("");
      }
       if(year == ''){
        $("#year_error").html("Please Select Year");
        $("#year").focus();
        return false;
      }else{
        $("#year_error").html("");
      }
      var charge_id = '0';
      if(action == 'edit'){
        charge_id = $("#charge_id").val();       
      }

    });


  </script>
</body>

</html>