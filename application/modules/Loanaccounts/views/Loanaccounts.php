   <div id="ajaxdata">
 <!-- Main body -->
    <div class="main-body">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loans">Loan Type</a></li>
          <li class="breadcrumb-item active" aria-current="page">Car Loan Accounts</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
      <div class="card">
        <div class="card-body">
          <!-- Toolbar -->         
          <div class="btn-group btn-group-sm mb-3" role="group">
           <a href="<?php echo base_url();?>Loanaccounts/addaccount"><button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">add_circle_outline</i> Add</button></a>       
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning" id="example">
              <!-- Filter columns -->
              <thead class="thead-primary">               
                <tr>
                  <th scope="col"><?php echo lang('Sno');?></th>
                  
                  <th scope="col">Created By</th>
                  <th scope="col">Assgined User</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Work Order No</th>
                  <th scope="col">Bank</th>
                  <th scope="col">Branch</th>
                  <th scope="col">Loan AC No</th>
                  <th scope="col"><?php echo lang('barrower_name');?></th>
                  <th scope="col"><?php echo lang('work_view');?></th>
                  <th scope="col"><?php echo lang('status');?></th>
                  <th scope="col">Approval Status</th>
                  <th scope="col"><?php echo lang('actions');?></th>
                </tr>
              </thead>

              <tbody>
                <?php if(!empty($loanaccounts)){
                  $i = 1;
                  $j =1;
                foreach($loanaccounts as $value){ ?>
                  <tr id='delete_<?php echo $value->loan_id;?>'>
                    <td><?php echo $value->loan_id;?></td>
                    
                    <td><?php echo getEmployeeName($value->inserted_by); ?></td>
                    <td><?php echo getEmployeeName($value->re_assign_id); ?></td>

                    <td><?php echo date('d M Y H:i:s', strtotime($value->inserted_date)); ?>
                      
                    </td>
                    <td><?php echo $value->work_order_num; ?></td>
                    <td><?php echo $value->bank_name; ?></td>
                    <td><?php echo $value->branch_name; ?></td>
                    <td><?php echo $value->loan_ac_number; ?></td>
                    <td><?php echo $value->barrower_name; ?></td>                   
                    <td><button class="btn btn-icon text-info" type="button">
                    <a href="<?php echo base_url(); ?>Loanaccounts/loanaccount_view/<?php echo $value->loan_id; ?>"><i data-feather="eye"></i></a></button>
                  </td>
                    <td class="text-center" >                     
                    <?php if($value->status == 'p'){  ?>                      
                    <button type="button" class="btn btn-primary btn-xs">Pending</button>
                    <?php }else if($value->status == 'reg'){ ?>                      
                    <button type="button" class="btn btn-success btn-xs">Regularize</button>
                    <?php }else if($value->status == 's'){ ?>
                    <button type="button" class="btn btn-success btn-xs">Sieze</button>
                    <?php  }else if($value->status == 'rel'){ ?>
                      <button type="button" class="btn btn-success btn-xs">Release</button>
                    <?php  }else if($value->status == 'a'){ ?>
                      <button type="button" class="btn btn-success btn-xs">Auction</button>
                    <?php  }else if($value->status == 'c'){ ?>
                      <button type="button" class="btn btn-success btn-xs">Closed</button>
                    <?php  } ?>
                    </td>
                     <td class="text-center" >    
                     <div class="btn-group btn-group-xs" role="group" id="statusupdate<?php echo $value->loan_id; ?>">
                    <?php if($value->approval_status == 'p'){  ?>  
                    <button type="button" class="btn btn-primary btn-xs" id="pendingapprove" onclick="changeStatus(<?php echo $value->loan_id; ?>)">Pending for Data</button>
                    <?php }else if($value->approval_status == 'a'){ ?>                      
                    <button type="button" class="btn btn-success btn-xs">Approved</button>
                    <?php } ?>
                    </div>
                    </td>
                    <td class="text-center" >
                      <div class="btn-group btn-group-xs" role="group">
                        <a href="<?php echo base_url(); ?>Loanaccounts/addaccount/<?php echo $value->loan_id;  ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a>
                      </div>
                    </td>
                  </tr>
                   
              <?php $j++;  $i++; }
               }   else { ?>
                  <tr><td colspan="14">No Data found</td></tr>
                <?php } ?>
              </tbody>
            </table><!-- /.table -->

          </div><!-- /.table-responsive -->
            <nav aria-label="Page navigation example">
            <?php echo $links; ?>
            </nav>
      </div>

    
    </div>
    <!-- /Main body -->
</div>
  </div>
  <!-- /Main -->

  <!-- Main Scripts -->
  <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>
  
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
    
    function changeStatus(loan_id){
       if(confirm("Are you sure to approve Loan account? you cannot revert this action!")){
        $.ajax({
            url:'<?php echo base_url();?>Loanaccounts/changeApprovalStatus',
            type: 'POST',
            datatype:'application/json',
            data: 'loan_id='+loan_id,
            success:function(data){
               $("#statusupdate"+loan_id).html("<a href='' class='btn btn-success'>Approved</a>");
            }
        });
      }
  }

 $(document).ready(function() {
  $('.pagination').on('click','a',function(e){  
   var href = $(this).attr('href');  
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
</script>
</body>
</html>