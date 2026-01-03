<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
<style>
    .card {
    background-color: #fff;
    border-radius: 10px;
    border: none;
    position: relative;
    margin-bottom: 30px;
    box-shadow: 0 0.46875rem 2.1875rem rgba(90,97,105,0.1), 0 0.9375rem 1.40625rem rgba(90,97,105,0.1), 0 0.25rem 0.53125rem rgba(90,97,105,0.12), 0 0.125rem 0.1875rem rgba(90,97,105,0.1);
}
.l-bg-cherry {
    background: linear-gradient(to right, #493240, #f09) !important;
    color: #fff;
}

.l-bg-blue-dark {
    background: linear-gradient(to right, #373b44, #4286f4) !important;
    color: #fff;
}

.l-bg-green-dark {
    background: linear-gradient(to right, #0a504a, #38ef7d) !important;
    color: #fff;
}

.l-bg-orange-dark {
    background: linear-gradient(to right, #a86008, #ffba56) !important;
    color: #fff;
}

.card .card-statistic-3 .card-icon-large .fas, .card .card-statistic-3 .card-icon-large .far, .card .card-statistic-3 .card-icon-large .fab, .card .card-statistic-3 .card-icon-large .fal {
    font-size: 110px;
}

.card .card-statistic-3 .card-icon {
    text-align: center;
    line-height: 50px;
    margin-left: 15px;
    color: #000;
    position: absolute;
    right: -5px;
    top: 20px;
    opacity: 0.1;
}

.l-bg-cyan {
    background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
    color: #fff;
}

.l-bg-green {
    background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
    color: #fff;
}

.l-bg-orange {
    background: linear-gradient(to right, #f9900e, #ffba56) !important;
    color: #fff;
}

.l-bg-cyan {
    background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
    color: #fff;
}
</style>
    <!-- Main body -->
    <div class="main-body">

      <div class="row row-cols-2 row-cols-lg-4 gutters-sm">
          <!-- All Invoices -->
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title text-secondary font-size-sm">Invoices</h6>
              <div class="d-flex align-items-center mb-1">
                <i data-feather="pie-chart" class="mr-2"></i>
                <a href='<?php echo base_url(); ?>Invoice' ><h3 class="mb-0 mr-2"><?php echo getDashboardCounts('invoice'); ?></h3></a>
                <!-- <span class="small text-success">2.1%<i class="material-icons align-bottom">keyboard_arrow_up</i></span> -->
              </div>
              <div class="sparkline-data" data-value="0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,0,0,0,45,0,0,37,0,39,0,0,0,5,0,31,0,43,0,0,30,0,0,0,0,0,0,0,0,0"></div>
            </div>
          </div>
        </div>
        <!-- / All Invoices -->
        <!-- New Orders -->
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title text-secondary font-size-sm">Received Invoices</h6>
              <div class="d-flex align-items-center mb-1">
                <i data-feather="shopping-bag" class="mr-2"></i>
                <?php //	if($this->session->userdata('user_role') == '1'){ ?>
                <a href='<?php echo base_url(); ?>Invoice/receivedInvioces' ><h3 class="mb-0 mr-2"><?php echo getDashboardCounts('receivedinvoice'); ?></h3></a>
                <?php /* }else{ ?>
                <h3 class="mb-0 mr-2"><?php echo getDashboardCounts('receivedinvoice'); ?></h3>
                <?php } */ ?>
                
               <!--  <span class="small text-success">1.2%<i class="material-icons align-bottom">keyboard_arrow_up</i></span> -->
              </div>
              <div class="sparkline-data" data-value="0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,0,0,0,45,0,0,37,0,39,0,0,0,5,0,31,0,43,0,0,30,0,0,0,0,0,0,0,0,0"></div>
            </div>
          </div>
        </div>
        
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title text-secondary font-size-sm">Settled Invoices</h6>
              <div class="d-flex align-items-center mb-1">
                <i data-feather="shopping-bag" class="mr-2"></i>
                <?php 	if($this->session->userdata('user_role') != '0'){ ?>
                <a href='<?php echo base_url(); ?>Invoice/settledInvioces' ><h3 class="mb-0 mr-2"><?php echo getDashboardCounts('settledinvoice'); ?></h3></a>
                <?php }else{ ?>
                <h3 class="mb-0 mr-2"><?php echo getDashboardCounts('settledinvoice'); ?></h3>
                <?php } ?>
                
               <!--  <span class="small text-success">1.2%<i class="material-icons align-bottom">keyboard_arrow_up</i></span> -->
              </div>
              <div class="sparkline-data" data-value="0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,0,0,0,45,0,0,37,0,39,0,0,0,5,0,31,0,43,0,0,30,0,0,0,0,0,0,0,0,0"></div>
            </div>
          </div>
        </div>
        
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title text-secondary font-size-sm">Pending Invoices</h6>
              <div class="d-flex align-items-center mb-1">
                <i data-feather="shopping-bag" class="mr-2"></i>
                <?php 	if($this->session->userdata('user_role') != '0'){ ?>
                <a href='<?php echo base_url(); ?>Invoice/pendingInvioces' ><h3 class="mb-0 mr-2"><?php echo getDashboardCounts('pendinginvoice'); ?></h3></a>
                <?php }else{ ?>
                <h3 class="mb-0 mr-2"><?php echo getDashboardCounts('pendinginvoice'); ?></h3>
                <?php } ?>
                
               <!--  <span class="small text-success">1.2%<i class="material-icons align-bottom">keyboard_arrow_up</i></span> -->
              </div>
              <div class="sparkline-data" data-value="0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,0,0,0,45,0,0,37,0,39,0,0,0,5,0,31,0,43,0,0,30,0,0,0,0,0,0,0,0,0"></div>
            </div>
          </div>
        </div>
        
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title text-secondary font-size-sm">Deleted Invoices</h6>
              <div class="d-flex align-items-center mb-1">
                <i data-feather="shopping-bag" class="mr-2"></i>
                <?php 	if($this->session->userdata('user_role') != '0'){ ?>
                <a href='<?php echo base_url(); ?>Invoice/deletedInvioces' ><h3 class="mb-0 mr-2"><?php echo getDashboardCounts('deletedinvoice'); ?></h3></a>
                <?php }else{ ?>
                <h3 class="mb-0 mr-2"><?php echo getDashboardCounts('deletedinvoice'); ?></h3>
                <?php } ?>
                
               <!--  <span class="small text-success">1.2%<i class="material-icons align-bottom">keyboard_arrow_up</i></span> -->
              </div>
              <div class="sparkline-data" data-value="0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,0,0,0,45,0,0,37,0,39,0,0,0,5,0,31,0,43,0,0,30,0,0,0,0,0,0,0,0,0"></div>
            </div>
          </div>
        </div>
        <!-- /New Orders -->

        <!-- Bounce Rate -->
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title text-secondary font-size-sm">Empanelments</h6>
              <div class="d-flex align-items-center mb-1">
                <i data-feather="bar-chart-2" class="mr-2"></i>
                <a href='<?php echo base_url(); ?>Empanelments' ><h3 class="mb-0 mr-2"><?php echo getDashboardCounts('empanelment'); ?></h3></a>
                <!-- <span class="small text-danger">0.7%<i class="material-icons align-bottom">keyboard_arrow_down</i></span> -->
              </div>
              <div class="sparkline-data" data-value="0,0,0,0,0,0,0,0,0,0,0,40,0,5,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,45,1,0,0,35,0,0,40,0,0,45,0,0,0,5,0,0,20,0,5,0,0,0,0,0,0,0,0,0,0"></div>
            </div>
          </div>
        </div>
        <!-- /Bounce Rate -->

        <!-- New Users -->
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title text-secondary font-size-sm">Formats</h6>
              <div class="d-flex align-items-center mb-1">
                <i data-feather="user-plus" class="mr-2"></i>
                <a href='<?php echo base_url(); ?>Formats' ><h3 class="mb-0 mr-2"><?php echo getDashboardCounts('formats'); ?></h3></a>
               <!--  <span class="small text-danger">0.3%<i class="material-icons align-bottom">keyboard_arrow_down</i></span> -->
              </div>
              <div class="sparkline-data" data-value="0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,40,0,0,10,0,0,0,0,0,0,0,0,0,0,0,50,0,40,0,5,0,0,10,0,0,25,0,0,0,5,0,0,0,0,25,0,0,0,0,40,0,0,0,0,0"></div>
            </div>
          </div>
        </div>
        <!-- /New Users -->
        <?php 	if($this->session->userdata('user_role') == '1'){ ?>
        <!-- Employee Count -->
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title text-secondary font-size-sm">Employees</h6>
              <div class="d-flex align-items-center mb-1">
                <i data-feather="shopping-bag" class="mr-2"></i>
                
                <a href='<?php echo base_url(); ?>Employees' ><h3 class="mb-0 mr-2"><?php echo getDashboardCounts('employee'); ?></h3></a>
                
                
               <!--  <span class="small text-success">1.2%<i class="material-icons align-bottom">keyboard_arrow_up</i></span> -->
              </div>
              <div class="sparkline-data" data-value="0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,0,0,0,45,0,0,37,0,39,0,0,0,5,0,31,0,43,0,0,30,0,0,0,0,0,0,0,0,0"></div>
            </div>
          </div>
        </div>
        <?php } ?>
        
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title text-secondary font-size-sm">Loan accounts Pending for Data</h6>
              <div class="d-flex align-items-center mb-1">
                <i data-feather="shopping-bag" class="mr-2"></i>
                
                <h3 class="mb-0 mr-2"><?php echo getDashboardCounts('pendingloans'); ?></h3>
                
                
               <!--  <span class="small text-success">1.2%<i class="material-icons align-bottom">keyboard_arrow_up</i></span> -->
              </div>
              <div class="sparkline-data" data-value="0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,0,0,0,45,0,0,37,0,39,0,0,0,5,0,31,0,43,0,0,30,0,0,0,0,0,0,0,0,0"></div>
            </div>
          </div>
        </div>
        
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title text-secondary font-size-sm">Approved Loan accounts</h6>
              <div class="d-flex align-items-center mb-1">
                <i data-feather="shopping-bag" class="mr-2"></i>
                
                <h3 class="mb-0 mr-2"><?php echo getDashboardCounts('approvedloans'); ?></h3>
                
                
               <!--  <span class="small text-success">1.2%<i class="material-icons align-bottom">keyboard_arrow_up</i></span> -->
              </div>
              <div class="sparkline-data" data-value="0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,0,0,0,45,0,0,37,0,39,0,0,0,5,0,31,0,43,0,0,30,0,0,0,0,0,0,0,0,0"></div>
            </div>
          </div>
        </div>
        

        
      </div>
     
      <div class="col-md-12 ">
    <div class="row ">
        
          <?php 
          $announcementData = getAnnouncements();
          if(!empty($announcementData)){
                    foreach ($announcementData as $key => $value) { ?>
        <div class="col-xl-5 col-lg-5">
            <div class="card l-bg-blue-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-bullhorn"></i></div>
                    <div class="mb-4 mt-0">
                        <p class="card-title mb-0"><small>Announcements</small></p>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-12">
                            <p><?php echo $value->description; ?> </p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php } } ?>
        
    </div>
</div>
    </div>
    <!-- /Main body -->

      <!-- Main Scripts -->
  <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script>

  