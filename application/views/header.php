<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Font & Icon -->
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/font/inter/inter.min.css" id="font-css">
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/material-design-icons-iconfont/material-design-icons.min.css">
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/fontawesome-free/css/all.min.css">
  <!-- Plugins -->
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/datatables/responsive.bootstrap4.min.css">
  <!-- Main Style -->
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.css">
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/css/style.min.css" id="main-css">
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/css/sidebar-royal.min.css" id="theme-css"> <!-- options: blue,cyan,dark,gray,green,pink,purple,red,royal,ash,crimson,namn,frost -->
  <title>HMS</title>
</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar header -->
    <div class="sidebar-header">
      <a href="<?php echo base_url();?>" class="logo">
        <img src="<?php echo assets_url(); ?>new/img/logo-white.svg" alt="Logo" id="main-logo">
        <?php
        if($this->session->userdata('user_role') == '1'){
        ?>
        Super Admin
      <?php } else { ?>
        <?php echo $this->session->userdata('user_name'); ?>
      <?php } ?>
      </a>
      <a href="#" class="nav-link nav-icon rounded-circle ml-auto" data-toggle="sidebar">
        <i class="material-icons">close</i>
      </a>
    </div>
    <!-- /Sidebar header -->

    <!-- Sidebar body -->
    <div class="sidebar-body">
      <ul class="nav treeview mb-4" data-accordion>
      
        <li class="nav-label">Hanshitha Management Services</li>
        <?php
        if($this->session->userdata('user_role') != '1'){
        ?>
         <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="users"></i>Profile</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url(); ?>Employees/viewEmployee/<?php echo $this->session->userdata('emp_id');  ?>" class="nav-link">Profile View</a></li>
            <li class="nav-item"><a href="<?php echo base_url(); ?>Employees/editEmployee/<?php echo $this->session->userdata('emp_id'); ?>" class="nav-link">Profile Settings</a></li>
           
          </ul>
        </li>
      <?php } ?>
    
        <?php
        
    if($this->session->userdata('adminuser_id') != '70'){
        
        if($this->session->userdata('user_role') != '3'){
        ?>
        <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="users"></i>Employees</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>Employees" class="nav-link">All Employees</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Employees/addEmployee" class="nav-link">Add Employee</a></li>
           
          </ul>
        </li>
      <?php } ?>
      <!--    <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="file"></i>Empanelments</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>Empanelments" class="nav-link">All Empanelments</a></li>
            <?php if($this->session->userdata('user_role') == '1'){ ?>
            <li class="nav-item"><a href="<?php echo base_url();?>Empanelments/addEmpanelment" class="nav-link">Add Empanelments</a></li>
          <?php } ?>
           
          </ul>
        </li> -->
         <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>Empanelments"><i data-feather="file"></i>Empanelments</a>
        </li>

        <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>Formats"><i data-feather="file"></i>Formats</a>
        </li>
<!-- 
         <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="file"></i>Formats</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>Formats" class="nav-link">All Formats</a></li>
            <?php if($this->session->userdata('user_role') == '1'){ ?>
            <li class="nav-item"><a href="<?php echo base_url();?>Formats/addFormats" class="nav-link">Add Format</a></li>
          <?php } ?>
           
          </ul>
        </li> -->

        
       <!--   <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="monitor"></i>Manage Banks</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>Allbanks" class="nav-link">All Banks</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Allbanks/addAllbanks" class="nav-link">Add Bank</a></li>
          </ul>
        </li>
 -->
        <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>Allbanks"><i data-feather="monitor"></i>Manage Banks</a>
        </li>
        <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>Bankcharges"><i data-feather="monitor"></i>Bank Charges</a>
        </li>

         <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>Allbranchs"><i data-feather="package"></i>Manage Branches</a>
        </li>
        <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>RBO"><i data-feather="package"></i>Manage RBO</a>
        </li>
         <?php
        if($this->session->userdata('user_role') == '1' OR $this->session->userdata('user_role') == '2'){
        ?>
       <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>Gsts"><i data-feather="monitor"></i>Manage GSTS</a>
        </li>
         <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>Vendors"><i data-feather="monitor"></i>Vendor Ids</a>
        </li>
          <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>Loantypes"><i data-feather="monitor"></i>Loan Types</a>
        </li>
         <li class="nav-item">
         	<a href="<?php echo base_url();?>LineTypes" class="nav-link"><i data-feather="monitor"></i>Line Types</a>
         </li>
        
      <?php } ?>

        <!--  <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="package"></i>Manage Branchs</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>Allbranchs" class="nav-link">All Branchss</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Allbranchs/addAllbranchs" class="nav-link">Add Branch</a></li>
          </ul>
        </li> -->
           <!-- <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="layers"></i>Work Orders</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>Workorders" class="nav-link">All Work Orders</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Workorders/addWorkorder" class="nav-link">Create Work Order</a></li>
          </ul>
        </li> -->
         <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="layers"></i>Loan Accounts</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>Loans" class="nav-link">All Accounts</a></li>           
            <li class="nav-item"><a href="<?php echo base_url();?>Loanaccounts" class="nav-link">Car Loan Accounts</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Loans/loantypes/2" class="nav-link">Personal Loans</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Loans/loantypes/3" class="nav-link">Education Loan</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Loans/loantypes/4" class="nav-link">AUCA Loan   </a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Loans/loantypes/5" class="nav-link">Home Loans/Surface Loans</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Loans/loantypes/6" class="nav-link">MSME/Business Loan</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Loans/loantypes/7" class="nav-link">Mudra Loan</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Loans/loantypes/8" class="nav-link">Crop/Agriculture Loan</a></li>       
          </ul>
        </li>
	<li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="printer"></i>Generate Notice</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>Notices" class="nav-link">RG3 Notice</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Notices/secondNotice" class="nav-link">Seizure Notice</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Loanaccounts/workorder_form" class="nav-link">Work Order</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Notices/thirdNotice" class="nav-link">Pre-Auction Notice</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Notices/finalNotice" class="nav-link">Final Notice</a></li>
            <!--<li class="nav-item"><a href="<?php echo base_url();?>Notices/workOrders" class="nav-link">Work Order</a></li>-->
            
          </ul>
        </li>
         <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="printer"></i>Manage Invoices</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>Invoice" class="nav-link">All Invoices</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Invoice/receivedInvioces" class="nav-link">Received Invoices</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Invoice/settledInvioces" class="nav-link">Settled Invoices</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Invoice/rejectedInvioces" class="nav-link">Rejected Invoices</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Invoice/deletedInvioces" class="nav-link">Deleted Invoices</a></li>
           <!--  <li class="nav-item"><a href="<?php echo base_url();?>Invoice/addInvoices" class="nav-link">Create Invoice</a></li> -->
            <li class="nav-item"><a href="<?php echo base_url();?>Invoice/manualInvoices" class="nav-link">Manual Invoice</a></li>
            <?php
            if($this->session->userdata('user_role') == '1'){
            ?>
            <li class="nav-item"><a href="<?php echo base_url();?>Mergeinvoice" class="nav-link">Merge Invoice</a></li>
            <?php } ?>
          </ul>
        </li>
         <?php
        /*if($this->session->userdata('user_role') == '1'){
        ?>
        <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="printer"></i>Line Type</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>LineTypes" class="nav-link">Line Types</a></li>
            
          </ul>
        </li>
         <?php }*/ ?>
         <!-- <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="users"></i>Manage Logs</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>Logs" class="nav-link">All Employee Logs</a></li>            
          </ul>
        </li> -->
         <li class="nav-item">
          <a href="<?php echo base_url();?>ContractorCharges" class="nav-link"><i data-feather="dollar-sign"></i>Contractor Charges</a>
         </li>
         <li class="nav-item">
          <a href="<?php echo base_url();?>AdvanceRequests" class="nav-link"><i data-feather="dollar-sign"></i>Advance Requests</a>
         </li>
           <?php
             if($this->session->userdata('user_role') == '1'){
           ?>
             <!-- <li class="nav-item">-->
             <!-- <a href="<?php echo base_url();?>CreditNotes" class="nav-link"><i data-feather="book"></i>Credit Notes</a>-->
             <!--</li>-->
             <li class="nav-item">
              <a href="<?php echo base_url();?>Announcements" class="nav-link"><i data-feather="book"></i>Announcements</a>
             </li>
             <li class="nav-item">
              <a href="<?php echo base_url();?>Debits" class="nav-link"><i data-feather="book"></i>Debits</a>
             </li>
              <li class="nav-item">
              <a href="<?php echo base_url();?>Expensetypes" class="nav-link"><i data-feather="book"></i>Expense Types</a>
             </li>
             <?php } ?>
            
        <?php
        if($this->session->userdata('user_role') == '1'){
        ?>
         <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>Logs"><i data-feather="users"></i>Employee Logs</a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url();?>CompanyAssets" class="nav-link"><i data-feather="dollar-sign"></i>Company Assets</a>
        </li>
        
      <?php } ?>
      <!--<li class="nav-item">-->
      <!--    <a href="<?php echo base_url();?>Reports" class="nav-link"><i data-feather="book"></i>Reports</a>-->
      <!--   </li>-->
         
         <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="layout"></i>Reports</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>Reports" class="nav-link"><i data-feather="book"></i>Reports</a></li>
            <li class="nav-item"><a href="<?php echo base_url();?>Reports/empreport" class="nav-link"><i data-feather="book"></i>Employee Reports</a></li> 
          </ul>
        </li>
         <?php
    }
        if($this->session->userdata('user_role') == '1' || $this->session->userdata('adminuser_id') == '70'){
        ?>
        <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="layout"></i>Audit</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>Audits" class="nav-link"><i data-feather="book"></i>Billing Periods</a></li>
          </ul>
        </li>
        <?php } ?>
      
        <!--   <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>Documents"><i data-feather="layout"></i>Manage Documents</a>
        </li> -->
        <!--  <li class="nav-item">
          <a class="nav-link has-icon treeview-toggle" href="#"><i data-feather="layout"></i>Manage Documents</a>
          <ul class="nav">
            <li class="nav-item"><a href="<?php echo base_url();?>Documents" class="nav-link">All Documents</a></li>           
          </ul>
        </li> -->
         <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>Auth/ChangePasskey"><i data-feather="lock"></i>Change Password</a>
        </li>
        <?php
        if($this->session->userdata('user_role') == '1' OR $this->session->userdata('user_role') == '2'){
        ?>
          <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>Auth/resetPassword"><i data-feather="key"></i>Reset Password</a>
        </li>
      <?php } ?>
         <li class="nav-item">
          <a class="nav-link has-icon" href="<?php echo base_url();?>Logout"><i data-feather="log-out"></i>Log Out</a>
        </li>
        
      </ul>
    </div>
    <!-- /Sidebar body -->

  </div>
  <!-- /Sidebar -->

  <!-- Main -->
  <div class="main">

    <!-- Main header -->
    <div class="main-header">
      <a class="nav-link nav-link-faded rounded-circle nav-icon" href="#" data-toggle="sidebar"><i class="material-icons">menu</i></a>
    <!--   <form class="form-inline ml-3 d-none d-md-flex">
        <span class="input-icon">
          <i class="material-icons">search</i>
          <input type="text" placeholder="Search..." class="form-control bg-gray-200 border-gray-200 rounded-lg">
        </span>
      </form> -->
      <ul class="nav nav-circle ml-auto">
        <!-- <li class="nav-item d-md-none"><a class="nav-link nav-link-faded nav-icon" data-toggle="modal" href="#searchModal"><i class="material-icons">search</i></a></li> -->
       <!--  <li class="nav-item d-none d-sm-block"><a class="nav-link nav-link-faded nav-icon" href="" id="refreshPage"><i class="material-icons">refresh</i></a></li> -->
        
        <li class="nav-item dropdown ml-2">
          <a class="nav-link nav-link-faded rounded nav-link-img dropdown-toggle px-2" href="#" data-toggle="dropdown" data-display="static">
           <!--  <img src="<?php echo assets_url(); ?>new/img/user.svg" alt="Admin" class="rounded-circle mr-2"> -->
            <span class="d-none d-sm-block"><?php echo $this->session->userdata('user_name'); ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right pt-0 overflow-hidden">
            <div class="media align-items-center bg-primary text-white px-4 py-3 mb-2">
              <img src="<?php echo assets_url(); ?>new/img/user.svg" alt="Admin" class="rounded-circle" width="50" height="50">
              <div class="media-body ml-2 text-nowrap">
                <h6 class="mb-0"><?php echo $this->session->userdata('user_name'); ?></h6>
                <!-- <span class="text-gray-400 font-size-sm"><?php echo $this->session->userdata('user_name'); ?></span> -->
              </div>
            </div>
           
           <!--  <a class="dropdown-item has-icon" href="javascript:void(0)"><i class="mr-2" data-feather="settings"></i>Settings</a> -->
            <a class="dropdown-item has-icon text-danger" href="<?php echo base_url();?>Logout"><i class="mr-2" data-feather="log-out"></i>Sign out</a>
          </div>
        </li>
      </ul>
    </div>
    <!-- /Main header -->
