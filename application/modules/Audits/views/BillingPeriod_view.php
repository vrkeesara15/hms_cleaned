    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Audits">Audits</a></li>
          <li class="breadcrumb-item active" aria-current="page">Billing Period</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
      <?php if(!empty($billingData)){ ?>
      <div class="row gutters-sm">
        
        <div class="col-md-8">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Billing Year</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $billingData->billing_year; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Billing Month</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php $monthName = date('F', mktime(0, 0, 0, $billingData->billing_month, 10));
                  echo $monthName;  ?>
                </div>
              </div>
              <hr>
              
             
            </div>
          </div>
          <div class="row gutters-sm">
            <div class="col-sm-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Billing Documents</h6>
                  <ul class="list-group list-group-flush">
                  <?php if(!empty($billingData->debit_file)){ ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Debit File</h6>
                    <a href="<?php echo assets_url(); ?>billing_period_files/<?php echo $billingData->debit_file; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <?php } ?>
                  <?php if(!empty($billingData->credit_file)){ ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Credit File</h6>
                    <a href="<?php echo assets_url(); ?>billing_period_files/<?php echo $billingData->credit_file; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <?php } ?>
                  <?php if(!empty($billingData->statement_file)){ ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Statement File</h6>
                    <a href="<?php echo assets_url(); ?>billing_period_files/<?php echo $billingData->statement_file; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <?php } ?>
                  <?php if(!empty($billingData->contractor_charges_file)){ ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Contractor Charges File</h6>
                    <a href="<?php echo assets_url(); ?>billing_period_files/<?php echo $billingData->contractor_charges_file; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <?php } ?>
                  <?php if(!empty($billingData->esi_receipt_file)){ ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">ESI Receipt File</h6>
                    <a href="<?php echo assets_url(); ?>billing_period_files/<?php echo $billingData->esi_receipt_file; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <?php } ?>
                  <?php if(!empty($billingData->pf_receipt_file)){ ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">PF Receipt File</h6>
                    <a href="<?php echo assets_url(); ?>billing_period_files/<?php echo $billingData->pf_receipt_file; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <?php } ?>
                  <?php if(!empty($billingData->employee_salary_file)){ ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Employee Salary File</h6>
                    <a href="<?php echo assets_url(); ?>billing_period_files/<?php echo $billingData->employee_salary_file; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <?php } ?>
                 
                </ul>
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </div>
    <?php } ?>

    </div>
    <!-- /Main body -->
    
 

  <!-- Main Scripts -->
  <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>
  <!-- <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->

  <!-- Plugins -->
  <!-- JS plugins goes here -->

</body>

</html>