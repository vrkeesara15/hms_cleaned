    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Employees">Employees</a></li>
          <li class="breadcrumb-item active" aria-current="page">Employee Profile</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
      <?php if(!empty($employeedata)){ ?>
      <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <img src="<?php echo assets_url(); ?>employer_doc/id_card/<?php echo $employeedata->employer_id_card; ?>" alt="<?php echo $employeedata->fname; ?> "width="280" height="325">
                 <!-- class="rounded-circle"  -->
                <div class="mt-3">
                  <h4><?php echo $employeedata->fname.' '.$employeedata->lname ; ?></h4>
                  <p class="text-secondary mb-1"><?php echo $employeedata->designation; ?></p>
                  
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="col-md-8">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Full Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $employeedata->fname.' '.$employeedata->lname ; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $employeedata->email; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Secondary Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $employeedata->email2; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Phone</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $employeedata->phone; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Secondary Phone</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $employeedata->phone2; ?>
                </div>
              </div>
              
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Role</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                 <?php if($employeedata->user_role == '1'){
                      echo "Super Admin";
                    }else if($employeedata->user_role == '2'){
                      echo "Admin";
                    }else if($employeedata->user_role == '3'){ 
                      echo "Employee";
                    }?>
                </div>
              </div>
              
              <hr>
             
            </div>
          </div>
          <div class="row gutters-sm">
            <div class="col-sm-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Company Documents</h6>
                  <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">ID Card</h6>
                    <a target="_blank" href="<?php echo assets_url(); ?>employer_doc/id_card/<?php echo $employeedata->employer_id_card; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Authorization Letter</h6>
                    <a target="_blank" href="<?php echo assets_url(); ?>employer_doc/auth_letter/<?php echo $employeedata->employer_id_card; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Seal Format</h6>
                    <a target="_blank" href="<?php echo assets_url(); ?>employer_doc/seal_format/<?php echo $employeedata->employer_seal_format; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">DRA Certificate</h6>
                    <a target="_blank" href="<?php echo assets_url(); ?>employer_doc/dra_certificate/<?php echo $employeedata->employer_dra_certificate; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                 
                </ul>
                </div>
              </div>
              <hr>
              <div class="card">
                <div class="card-body">
                  <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Advance Transactions</h6>
                  <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Advance Balance</h6>
                      <?php echo $contractorAdvanceAmount; ?>
                  </li>
                  <table border='1'>
                      <tr>
                          <th colspan="3">Advance Payments</th>
                          
                      </tr>
                      <tr>
                          <th>S.No</th>
                          <th>Date</th>
                          <th>Amount</th>
                      </tr>
                      <?php 
                          if(!empty($advanceRequestPayments)){ 
                              $sno = 1; 
                            foreach($advanceRequestPayments as $advanceValue){ ?>
                      <tr>
                          <td><?php echo $sno; ?></td>
                          <td><?php echo Date('d-M-Y',strtotime($advanceValue->payment_date)); ?></td>
                          <td><?php echo $advanceValue->paid_amount;  ?></td>
                      </tr>
                      <?php $sno++; } } ?>
                  </table>
                  <br />
                  <table border='1'>
                      <tr>
                          <th colspan="3">Debits from Settle Invoices</th>
                          
                      </tr>
                      <tr>
                          <th>S.No</th>
                          <th>Date</th>
                          <th>Amount</th>
                      </tr>
                      <?php 
                          if(!empty($settleAdvancePayments)){ 
                              $sno = 1; 
                            foreach($settleAdvancePayments as $settleAdvanceValue){ ?>
                      <tr>
                          <td><?php echo $sno; ?></td>
                          <td><?php echo Date('d-M-Y',strtotime($settleAdvanceValue->payment_date)); ?></td>
                          <td><?php echo $settleAdvanceValue->paid_amount;  ?></td>
                      </tr>
                      <?php $sno++; } } ?>
                  </table>
                  
                 
                </ul>
                </div>
              </div>
               
            </div>
             <div class="col-sm-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Employee Documents</h6>
                  <ul class="list-group list-group-flush">
                  <?php  if(!empty($employeedata->employee_aadhar_card)) { ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Aadhar Card</h6>
                    <a target="_blank" href="<?php echo assets_url(); ?>employee_doc/aadhar_card/<?php echo $employeedata->employee_aadhar_card; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <?php } ?>
                  <?php  if(!empty($employeedata->employee_pan_card)) { ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Pan Card</h6>
                    <a target="_blank" href="<?php echo assets_url(); ?>employee_doc/pan_card/<?php echo $employeedata->employee_pan_card; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <?php } ?>
                  <?php  if(!empty($employeedata->employee_edu_certificate)) { ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Education Qualification Certificate</h6>
                    <a target="_blank" href="<?php echo assets_url(); ?>employee_doc/edu_certificate/<?php echo $employeedata->employee_edu_certificate; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <?php } ?>
                  <?php  if(!empty($employeedata->employee_resume)) { ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Resume</h6>
                    <a target="_blank" href="<?php echo assets_url(); ?>employee_doc/resume/<?php echo $employeedata->employee_resume; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <?php } ?>
                  <?php  if(!empty($employeedata->police_verification_certificate)) { ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Police Verification Certificate</h6>
                    <a target="_blank" href="<?php echo assets_url(); ?>employee_doc/police_verification_certificate/<?php echo $employeedata->police_verification_certificate; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                  <?php } ?>
                  <?php  if(!empty($employeedata->sbi_id_card)) { ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">SBI ID Card</h6>
                    <a target="_blank" href="<?php echo assets_url(); ?>employee_doc/sbi_id_card/<?php echo $employeedata->sbi_id_card; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                   <?php } ?>
                  <?php  if(!empty($employeedata->indian_bank_id_card)) { ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
          					<h6 class="mb-0">Indian Bank ID Card</h6>
          					<a target="_blank" href="<?php echo assets_url(); ?>employee_doc/indian_bank_id_card/<?php echo $employeedata->indian_bank_id_card; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
          				</li>
                   <?php } ?>
                  <?php  if(!empty($employeedata->punjab_national_bank_id_card)) { ?>
          				<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
          					<h6 class="mb-0">Punjab National Bank ID Card</h6>
          					<a target="_blank" href="<?php echo assets_url(); ?>employee_doc/punjab_national_bank_id_card/<?php echo $employeedata->punjab_national_bank_id_card; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
          				</li>
                  <?php } ?>
                  <?php  if(!empty($employeedata->indian_overseas_bank_id_card)) { ?>
          				<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
          					<h6 class="mb-0">Indian Overseas Bank ID Card</h6>
          					<a target="_blank" href="<?php echo assets_url(); ?>employee_doc/indian_overseas_bank_id_card/<?php echo $employeedata->indian_overseas_bank_id_card; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
          				</li>
                  <?php } ?>
                  <?php  if(!empty($employeedata->central_bank_of_india_id_card)) { ?>
          				<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
          					<h6 class="mb-0">Central Bank of India ID Card</h6>
          					<a target="_blank" href="<?php echo assets_url(); ?>employee_doc/central_bank_of_india_id_card/<?php echo $employeedata->central_bank_of_india_id_card; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
          				</li>
                  <?php } ?>
                  <?php  if(!empty($employeedata->canara_bank_id_card)) { ?>
          				<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
          					<h6 class="mb-0">Canara Bank ID Card</h6>
          					<a target="_blank" href="<?php echo assets_url(); ?>employee_doc/canara_bank_id_card/<?php echo $employeedata->canara_bank_id_card; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
          				</li>
                  <?php } ?>
                  <?php  if(!empty($employeedata->karur_vysya_bank_id_card)) { ?>
          				<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
          					<h6 class="mb-0">Karur Vysya Bank ID Card</h6>
          					<a target="_blank" href="<?php echo assets_url(); ?>employee_doc/karur_vysya_bank_id_card/<?php echo $employeedata->karur_vysya_bank_id_card; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
          				</li>
				          <?php } ?>
                  <?php  if(!empty($employeedata->company_id_card)) { ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Company ID Card</h6>
                    <a target="_blank" href="<?php echo assets_url(); ?>employee_doc/company_id_card/<?php echo $employeedata->company_id_card; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a>
                  </li>
                   <?php } ?>
                </ul>
                </div>
              </div>
            </div>
            <!-- <div class="col-sm-6 mb-3">
              <div class="card h-100 shadow-none bg-gray-300">
                <div class="card-body">
                  <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-warning mr-2">rss_feed</i>Recent Activities</h6>
                  <div class="timeline timeline-left font-size-sm">
                    <div class="timeline-container left">
                      <div class="popover bs-popover-right popover-static">
                        <div class="arrow"></div>
                        <div class="popover-body text-muted">
                          <a href="javascript:void(0)" class="text-body">Kenneth Valdez</a> changed his profile photo.
                          <div class="small">2 hours ago</div>
                        </div>
                      </div>
                    </div>
                    <div class="timeline-container left">
                      <div class="popover bs-popover-right popover-static">
                        <div class="arrow"></div>
                        <div class="popover-body text-muted">
                          <a href="javascript:void(0)" class="text-body">Susan Smith</a> is now friends with Kenneth Valdez.
                          <div class="small">5 hours ago</div>
                        </div>
                      </div>
                    </div>
                    <div class="timeline-container left">
                      <div class="popover bs-popover-right popover-static">
                        <div class="arrow"></div>
                        <div class="popover-body text-muted">
                          <a href="javascript:void(0)" class="text-body">Kenneth Valdez</a> joined <a href="javascript:void(0)" class="text-body">Country Music</a> group.
                          <div class="small">8 hours ago</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    <?php } ?>

    </div>
    <!-- /Main body -->
    
  <!-- Search Modal -->
  <div class="modal" id="searchModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body p-1 p-lg-3">
          <form>
            <div class="input-group input-group-lg input-group-search">
              <div class="input-group-prepend">
                <button class="btn text-secondary btn-icon btn-lg" type="button" data-dismiss="modal">
                  <i class="fa fa-chevron-left"></i>
                </button>
              </div>
              <input type="text" class="form-control form-control-lg border-0 mx-1 px-0 px-lg-3" placeholder="Search..." autocomplete="off" required autofocus>
              <div class="input-group-append">
                <button class="btn text-secondary btn-icon btn-lg" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /Search Modal -->

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