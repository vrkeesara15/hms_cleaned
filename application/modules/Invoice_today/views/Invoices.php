  <div id="ajaxdata">
 <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Manage Invoices</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <h5>Manage Invoices</h5>
 
      <div class="card">
        <div class="card-body">
          <!-- Toolbar --> 
          <div class="btn-group btn-group-sm mb-3" role="group">
            <!-- <a href="<?php echo base_url();?>Invoice/addInvoices"><button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">add_circle_outline</i> Add</button></a> -->
          </div>
<div class="table-responsive">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning">
              <!-- Filter columns -->
              <thead class="thead-primary">
               
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Invocie ID</th>
                  <th scope="col">Borrower Name</th>
                  <th scope="col">Account No</th>
                  <th scope="col">Branch Name</th>
                  <th scope="col">Branch Code</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Created By</th>                 
                  <th scope="col">View</th>        
             <?php  if($this->session->userdata('user_role') == '1' OR $this->session->userdata('user_role') == '2'){ ?>
                  <th scope="col" class="text-center">Actions</th>
                <?php } ?>
              
                </tr>
              </thead>

              <tbody>
                <?php if(!empty($details)) { ?>
                <?php $i=1; foreach ($details as $key => $value) { ?>
               
                <tr id="row_<?php echo $value->id;?>">
                  <td><?php echo $i; ?></td>
                  <td>#<?php echo $value->id; ?></td>
                  <td><?php echo ($value->barrower_name)?$value->barrower_name:$value->borrower_name; ?></td>
                  <td><?php echo $value->account; ?></td>
                  <?php $branchDetails = getBranchDetails($value->branch_id); ?>
                  <td><?php echo $branchDetails->branch_name; ?></td>
                  <td><?php echo $branchDetails->branch_code; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($value->invoice_inserted_date)); ?></td>
                    <td><?php echo getEmployeeName($value->invoice_inserted_by); ?></td>
                   <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">
                      <a href="<?php echo base_url(); ?>Invoice/invoice_view/<?php echo $value->id; ?>" class="btn btn-link btn-icon bigger-130 text-primary"><i data-feather="eye"></i></a>                     
                    </div>
                  </td>
                  <?php  if($this->session->userdata('user_role') == '1' OR $this->session->userdata('user_role') == '2'){ ?>
                  <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group" id="retainDelete<?php echo $value->id; ?>">
                      <?php
                      $actionval = 'n';
                      $invoiceAction = checkSettleRejectStatus($value->id,$value->invoice_inserted_date);
                      if($invoiceAction == "showsettle"){
                        $lastMonthEnd = date("Y-m-t",strtotime(date("Y-m-t")."-1 month"));
                        $lastMonthEnd = date("Y-m-d",strtotime(date($lastMonthEnd)."+5 day"));
                        $curdayMonth = date("m-Y",strtotime($value->invoice_inserted_date));
                        
                        if($value->invoice_inserted_date> $lastMonthEnd || ($curdayMonth == date("m-Y"))){
                          $actionval = 'y';
                       if($value->manual_invoice != 'y'){ ?>
                        <a href="<?php echo base_url(); ?>Invoice/addInvoices/<?php echo $value->id; ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url(); ?>Invoice/manualInvoices/<?php echo $value->id; ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a>
                      <?php }
                        }
                      }
                      

                      if($invoiceAction == "showsettle"){
                        if($actionval == 'y'){
                       ?> / &nbsp; <?php } ?><br>
                      <a href="<?php echo base_url(); ?>Invoice/settleInvoice/<?php echo $value->id; ?>" class="btn btn-success">Settle</a>
                    <?php }else if($invoiceAction == "showreject"){ ?>
                        &nbsp;
                        <button onclick="rejectInvoice(<?php echo $value->id; ?>)" class="btn btn-danger">Reject</button>
                     <!-- <a href="<?php echo base_url(); ?>Invoice/rejectInvoice/<?php echo $value->id; ?>" class="btn btn-danger">Reject</a>-->
                      <button onclick="retainInvoice(<?php echo $value->id; ?>)" class="btn btn-warning">Retain</button>
                    <?php } ?>
                     <!--  <a href="#"  id="<?php echo $value->id;?>" class="trash btn btn-link btn-icon bigger-130 text-danger"><i data-feather="trash"></i></a> -->
                    
                    </div>
                  </td>
                <?php } ?>
               
                </tr>
               <?php $i++; } ?>
                <?php } else { ?>
                  <tr><td colspan="7">No Data found</td></tr>
                <?php } ?>
               
               
              </tbody>
            </table><!-- /.table -->

          </div><!-- /.table-responsive -->           
               
                <nav aria-label="Page navigation example">
                
                      <?php echo $links; ?>
                </nav>
          
          

        </div>
      </div>

    
    </div>
  </div>
    <!-- /Main body -->

  </div>
  <!-- /Main -->

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
  <script src="<?php echo assets_url(); ?>new/plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js"></script>
  <script>
    $(() => {
          // Run datatable
      var table = $('#example').DataTable({
        drawCallback: function() {
          $('.dataTables_paginate > .pagination').addClass('pagination-sm') // make pagination small
        }
      })
      // Apply column filter
      $('#example .dt-column-filter th').each(function(i) {
        $('input', this).on('keyup change', function() {
          if (table.column(i).search() !== this.value) {
            table
              .column(i)
              .search(this.value)
              .draw()
          }
        })
      })
      // Toggle Column filter function
      var responsiveFilter = function(table, index, val) {
        var th = $(table).find('.dt-column-filter th').eq(index)
        val === true ? th.removeClass('d-none') : th.addClass('d-none')
      }
      // Run Toggle Column filter at first
      $.each(table.columns().responsiveHidden(), function(index, val) {
        responsiveFilter('#example', index, val)
      })
      // Run Toggle Column filter on responsive-resize event
      table.on('responsive-resize', function(e, datatable, columns) {
        $.each(columns, function(index, val) {
          responsiveFilter('#example', index, val)
        })
      })
    })


    $(document).ready(function() {
  $('.pagination').on('click','a',function(e){  
  //alert("ddd")      ;
  //return false;
   var href = $(this).attr('href');  
    // var url = $('#url').val(); 
    // var s_follow_type = $('#s_follow_type').val();    
    
    $.ajax({
      url: href,
      type: 'POST',
      async : false,
      datatype:'application/json',
      data: '',
      success: function(response){  
        $('#ajaxdata').html(response);            
      }
    }); 
    return false; 
  });
});

    $(".trash").on("click",function(){
      if(confirm("Are you sure to delete invoice?")){
        var idval = $(this).attr('id');
        $("#row_"+idval).hide();
        $.ajax({
            url:'<?php echo base_url();?>Invoice/deleteInvoice',
            type: 'POST',
            datatype:'application/json',
            data: 'invoice_id='+idval,
            success:function(data){                  
               
            }
        });
      }
    });
    function retainInvoice(invoice_id){
      if(confirm("Are you sure to retain invoice?")){
        $.ajax({
            url:'<?php echo base_url();?>Invoice/retainInvoice',
            type: 'POST',
            datatype:'application/json',
            data: 'invoice_id='+invoice_id,
            success:function(data){  
               $("#retainDelete"+invoice_id).html("<a href='<?php echo base_url(); ?>Invoice/settleInvoice/"+invoice_id+"' class='btn btn-success'>Settle</a>");
            }
        });
      }
    }
    
    function rejectInvoice(invoice_id){
      if(confirm("Are you sure to reject invoice?")){
          
          $("#retainDelete"+invoice_id).html("");
          window.location.href = "<?php echo base_url(); ?>Invoice/rejectInvoice/"+invoice_id;
        
      }
    }

  </script>

</body>

</html>