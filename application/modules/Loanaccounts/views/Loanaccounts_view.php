
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
           <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loanaccounts">Car Loan Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Car Loan Account View</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
          <!-- Action/Detail Block -->
          <div class="card mb-4 p-3">
            <ul class="data-detail ml-3">
              <li><span><?php echo lang('vehicle_number');?>: &nbsp; &nbsp;</span><span><?php echo $loandata->vehicle_number; ?></span></li>
              <li><span>Vehicle Chasse Number: &nbsp; &nbsp;</span><span><?php echo $loandata->vehicle_chasse_number; ?></span></li>
              <li><span><?php echo lang('vehicle_engine_num');?>: &nbsp; &nbsp;</span><span><?php echo $loandata->vehicle_engine_num; ?></span></li>
              <li>
                <div class="list-with-gap mt-2">
                  <a href="<?php echo base_url(); ?>Loanaccounts/re_assign_user_form/<?php echo $loandata->loan_id; ?>/<?php echo $loandata->re_assign_id; ?>/">
                    <button type="button" class="btn btn-primary" <?php if($loandata->status == 'reg'){ echo 'disabled'; } ?>>Re-assign user</button>
                  </a>
                  <a href="<?php echo base_url(); ?>Loanaccounts/trackingdetails_form/<?php echo $loandata->loan_id; ?>/<?php echo (isset($loandata->trackingdetails_id)?$loandata->trackingdetails_id:''); ?>">
                    <button type="button" class="btn btn-primary" <?php if($loandata->status == 'reg'){ echo 'disabled'; } ?>>Tracking Details</button>
                  </a>
                  <a href="<?php echo base_url(); ?>Loanaccounts/generateLoanPDF/<?php echo $loandata->loan_id; ?>">
                    <button type="button" class="btn btn-primary" <?php if($loandata->status == 'reg'){ echo 'disabled'; } ?>><i data-feather="download"></i> Final Notice</button>
                  </a>
                  <a href="<?php echo base_url(); ?>Loanaccounts/final_notice_form/<?php echo $loandata->loan_id; ?>">
                    <button type="button" class="btn btn-primary" <?php if($loandata->status == 'reg'){ echo 'disabled'; } ?>>Final Notice Form</button>
                  </a>
                  <a href="<?php echo base_url(); ?>Loanaccounts/workorder_form/<?php echo $loandata->loan_id; ?>">
                    <button type="button" class="btn btn-primary" <?php if($loandata->status == 'reg'){ echo 'disabled'; } ?>>Work Order</button>
                  </a>
                  <?php if($loandata->status == 'p'){  ?>
                    <a href="<?php echo base_url(); ?>Loanaccounts/regularize_form/<?php echo $loandata->loan_id; ?>">
                      <button type="button" class="btn btn-primary">Regularize</button>
                    </a>
                    <a href="<?php echo base_url(); ?>Loanaccounts/seize_form/<?php echo $loandata->loan_id; ?>">
                      <button type="button" class="btn btn-secondary">Sieze</button>
                    </a>
                  <?php }else if($loandata->status == 'reg'){ ?>
                    <span class="badge badge-success">Status : regularized</span>
                  <?php }else if($loandata->status == 's'){ ?>
                    <a href="<?php echo base_url(); ?>Loanaccounts/auction_form/<?php echo $loandata->loan_id; ?>">
                      <button type="button" class="btn btn-primary">Auction</button>
                    </a>
                    <a href="<?php echo base_url(); ?>Loanaccounts/release_form/<?php echo $loandata->loan_id; ?>">
                      <button type="button" class="btn btn-secondary">Release</button>
                    </a>
                  <?php } ?>
                </div>
              </li>
            </ul>
          </div>
          <!-- /Action/Detail Block -->

      <div class="row gutters-sm">
        <div class="col-md-6">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Assigned User</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php $assigned_user = getEmployeeName($loandata->re_assign_id);
                    echo $assigned_user;
                  ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Bank Name</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->bank_name; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Branch</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->branch_name; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Branch Controller</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                 <?php echo $loandata->branch_controller; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Loan Ac Number</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->loan_ac_number; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Work Order Number</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                 <?php echo $loandata->work_order_num; ?>
                </div>
              </div>
               <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Borrower Name</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->barrower_name; ?>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Mobile Number</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->cus_mobile; ?>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">PAN Number</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->cus_pan; ?>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Address</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->cus_address; ?>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Date of Sanction</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php if($loandata->date_of_sanction !='0000-00-00'){ echo date('d-m-Y',strtotime($loandata->date_of_sanction)); } ?>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Loan Amount</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->cus_loan_amount; ?>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Outstanding Amount</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->outstanding_amount; ?>
                </div>
              </div>
              <hr>

             

            </div>
          </div>
          
        </div>
        <div class="col-md-6">
          <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Irregular Amount</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->irregular_amount; ?>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Account Status</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->account_status; ?>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">NPA Date</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php if($loandata->npa_date !='0000-00-00'){ echo date('d-m-Y',strtotime($loandata->npa_date)); } ?>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Make Company</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php  echo $loandata->make_company; ?>
                </div>
              </div>
              <hr>
             
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Year of Make </h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php if($loandata->year_of_make !='0000'){ echo $loandata->year_of_make; } ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Make & Model</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->rc_number; ?>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Insurance Company</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->insurance_company; ?>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Insurance Expiry</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                 <!--  <?php echo $loandata->insurance_expiry; ?> -->
                   <?php  if($loandata->insurance_expiry !='0000-00-00 00:00:00'){ echo date('d-m-Y',strtotime($loandata->insurance_expiry)); } ?>
                </div>
              </div>
              <hr>
             
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Vehicle Number</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                 <?php echo $loandata->vehicle_number; ?>
                </div>
              </div>
              <hr>
                <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Vehicle Chassis Number</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                 <?php echo $loandata->vehicle_chasse_number; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Vehicle Engine Number</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->vehicle_engine_num; ?>
                </div>
              </div>
             <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Customer Document File</h6>
                </div>
                <div class="col-sm-6 text-secondary">                  
                   <?php $path = "assets/workorderdoc/customer_file/"; ?>
                   <?php if($loandata->customer_file !='0') { ?>
                      <a href="<?php echo base_url().$path.'/'.$loandata->customer_file;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>    
                    <?php } else { echo "No Document Found"; } ?>
                   
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Loan Account Status</h6>
                </div>
                <div class="col-sm-6 text-secondary">

                  <?php if($loandata->status == 'p'){  ?>                      
                    <button type="button" class="btn btn-primary btn-xs">Pending</button>
                    <?php }else if($loandata->status == 'reg'){ ?>                      
                    <button type="button" class="btn btn-success btn-xs">Regularize</button>
                    <?php }else if($loandata->status == 's'){ ?>
                    <button type="button" class="btn btn-success btn-xs">Sieze</button>
                    <?php  }else if($loandata->status == 'rel'){ ?>
                      <button type="button" class="btn btn-success btn-xs">Release</button>
                    <?php  }else if($loandata->status == 'a'){ ?>
                      <button type="button" class="btn btn-success btn-xs">Auction</button>
                    <?php  }else if($loandata->status == 'c'){ ?>
                      <button type="button" class="btn btn-success btn-xs">Closed</button>
                    <?php  } ?>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Remarks</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $loandata->remarks; ?>
                </div>
              </div>
              <hr>
            </div>
          </div>
         
        </div>
        <?php if(!empty($workOrderData)){ ?>
        <div class="col-md-6">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Work Order Details</h6>
                </div>
                
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Workorder Number</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $workOrderData->workorder_no; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Workorder Date</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                 <?php echo $workOrderData->workorder_date; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Work Order File</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                    <a href="<?php echo base_url().'assets/loanaccounts/workorder_file/'.$workOrderData->workorder_file;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>   
                  
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Bank Manager Details</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                 <?php echo $workOrderData->bank_manager_details; ?>
                </div>
              </div>
               <hr>
              

            </div>
          </div>
          
        </div>
        <?php } ?>
         <?php if(!empty($finalNoticeData)){ ?>
        <div class="col-md-6">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Final Notice Details</h6>
                </div>
                
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Final Notice Signed Copy</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <a href="<?php echo base_url().'assets/signed_copy/'.$finalNoticeData->signed;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>   
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Postal Copy</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                 <a href="<?php echo base_url().'assets/postal_copy/'.$finalNoticeData->postal;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>   
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Visit Photos</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                    <a href="<?php echo base_url().'assets/visit_photos/'.$finalNoticeData->visit;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>   
                  
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Location1 </h6>
                </div>
                <div class="col-sm-6 text-secondary">
                 <?php echo $finalNoticeData->location; ?>
                </div>
              </div>
               <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Location2 </h6>
                </div>
                <div class="col-sm-6 text-secondary">
                 <?php echo $finalNoticeData->location1; ?>
                </div>
              </div>
               <hr>
               <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Location3 </h6>
                </div>
                <div class="col-sm-6 text-secondary">
                 <?php echo $finalNoticeData->location2; ?>
                </div>
              </div>
               <hr>
              

            </div>
          </div>
          
        </div>
        <?php } ?>
        <?php if(!empty($firstNoticeData)){ ?>
        <div class="col-md-6">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">First Notice Details</h6>
                </div>
                
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Notice Date</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $firstNoticeData->notice_date; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Approved Amount</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $firstNoticeData->approved_amount; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Approved Date</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $firstNoticeData->approval_date; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Irregular Amount</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <?php echo $firstNoticeData->irregular_amount; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Postal Stamp</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                 <a href="<?php echo base_url().'assets/rg_1st_notices/postal_stamps/'.$firstNoticeData->postal_stamp;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>   
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="mb-0">Notice</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                    <a href="<?php echo base_url().'assets//rg_1st_notices/notices/'.$firstNoticeData->notices;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>   
                  
                </div>
              </div>
              <hr>
              
              

            </div>
          </div>
          
        </div>
        <?php } ?>
        <?php if (!empty($secondNoticeData)) { ?>
          <div class="col-md-6">
            <div class="card mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Second Notice Details</h6>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Notice Date</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <?php echo $secondNoticeData->notice_date; ?>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">First Notice Date</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <?php echo $secondNoticeData->first_notice_date; ?>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">NPA Date</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <?php echo $secondNoticeData->npa_date; ?>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Postal Stamp</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <a href="<?php echo base_url('assets/rg_2nd_notices/postal_stamps/' . $secondNoticeData->postal_stamp); ?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download>
                      <i data-feather="download"></i>
                    </a>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Notice</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <a href="<?php echo base_url('assets/rg_2nd_notices/notices/' . $secondNoticeData->notices); ?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download>
                      <i data-feather="download"></i>
                    </a>
                  </div>
                </div>
                <hr>
              </div>
            </div>
          </div>
        <?php } ?>

        <?php if (!empty($thirdNoticeData)) { ?>
          <div class="col-md-6">
            <div class="card mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Third Notice Details</h6>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Notice Date</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <?php echo $thirdNoticeData->notice_date; ?>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Vehicle Registration Number</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <?php echo $thirdNoticeData->vehicle_registration_number; ?>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Postal Stamp</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <a href="<?php echo base_url('assets/pre_auction_3rd_notices/postal_stamps/' . $thirdNoticeData->postal_stamp); ?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download>
                      <i data-feather="download"></i>
                    </a>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Notice</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <a href="<?php echo base_url('assets/pre_auction_3rd_notices/notices/' . $thirdNoticeData->notices); ?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download>
                      <i data-feather="download"></i>
                    </a>
                  </div>
                </div>
                <hr>
              </div>
            </div>
          </div>
        <?php } ?>

        <?php if (!empty($fourthFinalNoticeData)) { ?>
          <div class="col-md-6">
            <div class="card mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Fourth (Final) Notice Details</h6>
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Notice Date</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <?php echo $fourthFinalNoticeData->notice_date; ?>
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Vehicle Registration Number</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <?php echo $fourthFinalNoticeData->vehicle_registration_number; ?>
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Auction Date</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <?php echo $fourthFinalNoticeData->auction_date; ?>
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Telugu Newspaper</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <?php echo $fourthFinalNoticeData->telugu_news_paper; ?>
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">English Newspaper</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <?php echo $fourthFinalNoticeData->english_news_paper; ?>
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">News Publication Date</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <?php echo $fourthFinalNoticeData->news_publication_date; ?>
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Postal Stamp</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <a href="<?php echo base_url('assets/final_4th_notices/postal_stamps/' . $fourthFinalNoticeData->postal_stamp); ?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download>
                      <i data-feather="download"></i>
                    </a>
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">Notice</h6>
                  </div>
                  <div class="col-sm-6 text-secondary">
                    <a href="<?php echo base_url('assets/final_4th_notices/notices/' . $fourthFinalNoticeData->notices); ?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download>
                      <i data-feather="download"></i>
                    </a>
                  </div>
                </div>
                <hr>

              </div>
            </div>
          </div>
        <?php } ?>

        </div>
        <?php if(!empty($trackingDetailsData)) { ?>
         <div class="col-md-6">
          <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                <div class="col-sm-12">
                  <h6 class="text-center">Tracking Details</h6>
                    </div>
                  </div>
                  <hr>
                  <?php foreach ($trackingDetailsData as $key => $value) { 
                    if($value->tracking_detail_type == 1){

                      ?>
                      <div class="row">
                      <div class="col-sm-6">
                        <h6 class="mb-0">Cibil Score <?php echo $value->image_count; ?> (<?php echo $value->description; ?>)</h6>
                      </div>
                      <div class="col-sm-6 text-secondary">
                       <a href="<?php echo base_url().'assets/loanaccounts/Trackingdetails/cibil_score_file/'.$value->image_name;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>
                      </div>
                    </div>
                  <?php }else if($value->tracking_detail_type == 2){ ?>
                    <div class="row">
                      <div class="col-sm-6">
                        <h6 class="mb-0">FastTag File <?php echo $value->image_count; ?> (<?php echo $value->description; ?>)</h6>
                      </div>
                      <div class="col-sm-6 text-secondary">
                       <a href="<?php echo base_url().'assets/loanaccounts/Trackingdetails/fast_tag_file/'.$value->image_name;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>
                      </div>
                    </div>
                  <?php }else if($value->tracking_detail_type == 3){ ?>
                    <div class="row">
                      <div class="col-sm-6">
                        <h6 class="mb-0">Gas File <?php echo $value->image_count; ?> (<?php echo $value->description; ?>)</h6>
                      </div>
                      <div class="col-sm-6 text-secondary">
                       <a href="<?php echo base_url().'assets/loanaccounts/Trackingdetails/gas_file/'.$value->image_name;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>
                      </div>
                    </div>
                  <?php }else if($value->tracking_detail_type == 4){ ?>
                    <div class="row">
                      <div class="col-sm-6">
                        <h6 class="mb-0">Internet File <?php echo $value->image_count; ?> (<?php echo $value->description; ?>)</h6>
                      </div>
                      <div class="col-sm-6 text-secondary">
                       <a href="<?php echo base_url().'assets/loanaccounts/Trackingdetails/internet_file/'.$value->image_name;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>
                      </div>
                    </div>
                  <?php }else if($value->tracking_detail_type == 5){ ?>
                    <div class="row">
                      <div class="col-sm-6">
                        <h6 class="mb-0">FastTag File <?php echo $value->image_count; ?> (<?php echo $value->description; ?>)</h6>
                      </div>
                      <div class="col-sm-6 text-secondary">
                       <a href="<?php echo base_url().'assets/loanaccounts/Trackingdetails/ecommerce_file/'.$value->image_name;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>
                      </div>
                    </div>
                  <?php }else if($value->tracking_detail_type == 6){ ?>
                    <div class="row">
                      <div class="col-sm-6">
                        <h6 class="mb-0">Other File <?php echo $value->image_count; ?> (<?php echo $value->image_description ?>)</h6>
                      </div>
                      <div class="col-sm-6 text-secondary">
                       <a href="<?php echo base_url().'assets/loanaccounts/Trackingdetails/other_file/'.$value->image_name;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>
                      </div>
                    </div>
                  <?php } ?>
                  <?php }
                  ?>
                 
                  <hr>
                        
              
              </div>
            </div>
        </div>
        <?php } ?>
      </div>
      <?php if($loandata->status != 'p' AND $loandata->status != 'c'){ ?>
        <div class="row gutters-sm">
          <div class="col-md-6">
          <div class="card mb-3">
            <div class="card-body">              
              <?php if($loandata->status == 'p'){ ?>
               <!--  <div class="row">
                  <div class="col-sm-6">
                    <h6 class="mb-0">No Loan Account Actions</h6>
                  </div>
                </div> -->
              <?php }else { ?>            

              <?php if($loandata->status == 'reg'){
                $name = "Regularize";
                $date = date('d-m-Y', strtotime($regData->inserted_date));
                $doneby =  getEmployeeName($regData->inserted_by);
                $id = $regData->r_id;
                $url = 'regularize_form';
                $data_type = 'regularize';
              }else  {
                $name = "Sieze";
                $date = date('d-m-Y', strtotime($sezData->seize_date));
                $doneby = getEmployeeName($sezData->inserted_by);
                $id = $sezData->s_id;
                $url = 'seize_form';
                $data_type = 'sieze';
              }
              ?>
                 
            <section id="section4" class="mt-2">
            <h5><?php echo $name; ?> Completed</h5>            
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>                       
                        <th scope="col">Action By</th>
                        <th scope="col">Date</th>
                        <th scope="col">View</th>
                        <th scope="col">Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><?php echo $doneby;?></th>
                        <td><?php echo $date;?></td>
                        <td> <a href="javascript:void(0)" class="btn btn-link btn-icon bigger-130 text-primary visibility" data-type="<?php echo $data_type;?>" data-order_id="<?php echo $loandata->loan_id; ?>"
                          <?php if($loandata->status == 'reg'){ ?>
                            data-r_id="<?php echo $loandata->r_id; ?>"
                          <?php } else { ?> 
                            data-s_id="<?php echo $loandata->s_id; ?>"
                          <?php }?>                        

                          title="Detail"><i class="material-icons">visibility</i></a></td>
                        <td>  <a href="<?php echo base_url(); ?>Loanaccounts/<?php echo $url;?>/<?php echo $loandata->loan_id; ?>/<?php echo $id; ?>" class="btn btn-link btn-icon bigger-130 text-success" title="Edit"><i class="material-icons">edit</i></a></td>                      
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>   
          <?php } ?>         

            </div>
          </div>
         
        </div>
        <?php if($loandata->status == 'rel' OR $loandata->status == 'a') { ?>
          <div class="col-md-6">
          <div class="card mb-3">
            <div class="card-body">

              <?php if($loandata->status == 'rel'){
                $name = "Release";
                $date = date('d-m-Y', strtotime($relData->release_date));
                 $doneby = getEmployeeName($relData->inserted_by);
                $id = $relData->rel_id;
                $url = 'release_form';
                $data_type = 'release';
              }else {
                $name = "Auction";
                $date = date('d-m-Y', strtotime($auclData->aution_date));
                $doneby = getEmployeeName($auclData->inserted_by);
                $id = $auclData->auc_id;
                $url = 'auction_form';
                $data_type = 'auction';
              }
              ?>              
                 
           <section id="section4" class="mt-2">
            <h5><?php echo $name; ?> Completed</h5>            
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>                       
                        <th scope="col">Action By</th>
                        <th scope="col">Date</th>
                        <th scope="col">View</th>
                        <th scope="col">Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><?php echo $doneby;?></th>
                        <td><?php echo $date;?></td>
                        <td> <a href="javascript:void(0)" class="btn btn-link btn-icon bigger-130 text-primary visibility" data-type="<?php echo $data_type;?>" data-order_id="<?php echo $loandata->loan_id; ?>"
                         data-s_id="<?php echo $loandata->s_id; ?>"
                         <?php if($loandata->status == 'rel') { ?>
                           data-rel_id="<?php echo $loandata->rel_id; ?>"
                         <?php }else { ?>
                           data-auc_id="<?php echo $loandata->auc_id; ?>"
                         <?php } ?>
                          title="Detail">
                          <i class="material-icons">visibility</i></a></td>
                        <td> <a href="<?php echo base_url(); ?>Loanaccounts/<?php echo $url;?>/<?php echo $loandata->loan_id; ?>/<?php echo $loandata->s_id; ?>/<?php echo $id ?>" class="btn btn-link btn-icon bigger-130 text-success" title="Edit"><i class="material-icons">edit</i></a></td>                      
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>  
        

            </div>
          </div>
         
        </div>
      <?php } ?>
       
        
      </div>
    <?php } ?>
    </div>
    <!-- /Main body -->


  </div>
  <!-- /Main -->
<!-- Visibility Modal -->
  <div class="modal" id="VisibilityModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body p-1 p-lg-3" id="VisibilityModalHtml">
          
        </div>
      </div>
    </div>
  </div>
  <!-- /Visibility Modal -->
  <!-- Main Scripts -->
  <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>


  <!-- Plugins -->
  <!-- JS plugins goes here -->
  <script type="text/javascript">

  $(document).ready(function(){
    $("#bank_id").on("change",function(){
     var bank_id = $(this).val();
     $.ajax({  
        url:"<?php echo base_url(); ?>Loanaccounts/getBranchas",
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
      var loan_ac_number = $("#loan_ac_number").val();
      var barrower_name = $("#barrower_name").val();
      var vehicle_number = $("#vehicle_number").val();
      var vehicle_engine_num = $("#vehicle_engine_num").val();
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
      if(loan_ac_number == ''){
        $("#loan_ac_number_error").html("Loan Ac Number Is Required");
        $("#loan_ac_number").focus();
        return false;
      }else{
        $("#loan_ac_number_error").html("");
      }
      if(barrower_name == ''){
        $("#barrower_name_error").html("Barrower Name Is Required");
        $("#barrower_name").focus();
        return false;
      }else{
        $("#barrower_name_error").html("");
      }
      <?php if($action != 'edit') { ?>

      if(vehicle_number == ''){
        $("#vehicle_number_error").html("Vehicle Number Is Required");
        $("#vehicle_number").focus();
        return false;
      }else{
        $("#vehicle_number_error").html("");
      }

      if(vehicle_engine_num == ''){
        $("#vehicle_engine_num_error").html("Vehicle Engine Number Is Required");
        $("#vehicle_engine_num").focus();
        return false;
      }else{
        $("#vehicle_engine_num_error").html("");
      }
      if(work_order_num == ''){
        $("#work_order_num_error").html("Work Order Number Is Required");
        $("#work_order_num").focus();
        return false;
      }else{
        $("#work_order_num_error").html("");
      }
      if(work_order_doc == ''){
        $("#work_order_doc_error").html("Work Order Document Is Required");
        $("#work_order_doc").focus();
        return false;
      }else{
        $("#work_order_doc_error").html("");
      }      
<?php } ?>
      
    });
    $(document).ready(function(){
        $(".visibility").on("click",function(){
          var type = $(this).attr('data-type');
          var loan_id = $(this).attr('data-order_id');
          if(type == "regularize") {
            var r_id = $(this).attr('data-r_id');
            regularize_display(loan_id,r_id);
          } else if(type == "sieze") {
            var s_id = $(this).attr('data-s_id');
            sieze_display(loan_id,s_id);
          } else if(type == "release") {
            var s_id = $(this).attr('data-s_id');
            var rel_id = $(this).attr('data-rel_id');
            release_display(loan_id,s_id,rel_id);
          } else if(type == "auction") {
            var s_id = $(this).attr('data-s_id');
            var auc_id = $(this).attr('data-auc_id');
            auction_display(loan_id,s_id,auc_id);
          }
        });
    });
    function regularize_display(loan_id,r_id) {
        $.ajax({  
          url:"<?php echo base_url(); ?>Loanaccounts/get_regularize_display",
          data: {loan_id:loan_id,r_id:r_id },  
          type: "POST",  
          success:function(data){ 
            $("#VisibilityModalHtml").html("");
            $("#VisibilityModalHtml").html(data);
            $("#VisibilityModal").modal('show');           
          }
        });
    }
    function sieze_display(loan_id,s_id) {
      $.ajax({  
          url:"<?php echo base_url(); ?>Loanaccounts/get_sieze_display",
          data: {loan_id:loan_id,s_id:s_id },  
          type: "POST",  
          success:function(data){ 
            $("#VisibilityModalHtml").html("");
            $("#VisibilityModalHtml").html(data);
            $("#VisibilityModal").modal('show');           
          }
        });
    }
    function release_display(loan_id,s_id,rel_id) {
       $.ajax({  
          url:"<?php echo base_url(); ?>Loanaccounts/get_release_display",
          data: {loan_id:loan_id,s_id:s_id,rel_id:rel_id },  
          type: "POST",  
          success:function(data){ 
            $("#VisibilityModalHtml").html("");
            $("#VisibilityModalHtml").html(data);
            $("#VisibilityModal").modal('show');           
          }
        });
    }
    function auction_display(loan_id,s_id,auc_id) {
       $.ajax({  
          url:"<?php echo base_url(); ?>Loanaccounts/get_auction_display",
          data: {loan_id:loan_id,s_id:s_id,auc_id:auc_id },  
          type: "POST",  
          success:function(data){ 
            $("#VisibilityModalHtml").html("");
            $("#VisibilityModalHtml").html(data);
            $("#VisibilityModal").modal('show');           
          }
        });
    }
        $(document).ready(function(){
        $("#notesHistory").on("click",function(){
           $("#notesHistoryView").toggleClass('d-none d-line');
        });
        });
  </script>

</body>

</html>