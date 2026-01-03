   <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
   <div id="ajaxdata">
 <!-- Main body -->
    <div class="main-body">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Debits</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
            <h5>Manage Debits</h5>
      <div class="card">
        <div class="card-body">
          <!-- Toolbar -->         
          
        <form action="<?php echo base_url().'Debits/'; ?>"  method="post" enctype="multipart/form-data">
            <div class="row">
        <div class="col-sm-4">
            <input type="text" class="form-control datepicker-input form-control-sm" autocomplete="off" placeholder="Start Date" name="start_date" id="start_date" value="">
            <span class="small" id="start_date_error" style="color:red;"></span> 
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control datepicker-input1 form-control-sm" autocomplete="off" placeholder="End Date" name="end_date" id="end_date" value="">
            <span class="small" id="end_date_error" style="color:red;"></span> 
        </div>
        <div class="col-sm-1">
            <input type="submit" class="form-control form-control-sm btn-primary"  name="go" id="go" value="Go">
        </div>
        <div class="col-sm-2" align="right">
            <a href="<?php echo base_url(); ?>Debits/addExpense" class="form-control form-control-sm btn-primary"  name="adddebit" id="adddebit">Add Debit </a>
        </div>
         </div>
        </form>
       
        <br />
          <div class="table-responsive">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning" id="example">
              <!-- Filter columns -->
              <thead class="thead-primary">               
                <tr>
                  <th scope="col"><?php echo lang('SNo');?></th>
                 <!-- <th scope="col"><?php echo lang('date');?></th>-->
                  <th scope="col"><?php echo lang('created_by');?></th>
                  <th scope="col"><?php echo lang('amount');?></th>
                  <th scope="col"><?php echo lang('expense_type');?></th>
                  <th scope="col"><?php echo lang('paid_to');?></th>
                  <th scope="col"><?php echo lang('description');?></th>
                  <th scope="col"><?php echo lang('payment_method'); ?></th> 
                  <th scope="col"><?php echo lang('tds_amount');?></th>
                  <th scope="col"><?php echo lang('transaction_date'); ?></th> 
                  <th scope="col"><?php echo "GST Type"; ?></th> 
                  <th scope="col"><?php echo lang('receipt'); ?></th>  
                  <th scope="col"><?php echo lang('other_receipt'); ?></th>  
                   <th scope="col"><?php echo lang('actions'); ?></th>       
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($Debits)){
                  $i = 1;
                  $j =1;
                foreach($Debits as $value){ ?>
                  <tr id='delete_<?php echo $value->id;?>'>
                    <td><?php echo $value->id; ?></td>
                    <!--<td><?php echo $value->date_of_receipt; ?></td>-->
                    <td><?php echo getEmployeeName($value->created_by); ?></td>
                    <td><?php echo $value->amount; ?></td>
                    <td><?php echo $value->expense_type; ?></td>
                    <td><?php echo $value->paid_to; ?></td>
                    <td><?php echo $value->expense_description; ?></td>
                    <td><?php echo $value->payment_method; ?></td>
                    <td><?php echo $value->tds_amount; ?></td>
                    <td><?php if($value->transaction_date != '0000-00-00'){ echo $value->transaction_date; } ?></td>
                    <td><?php echo $value->gst_type; ?></td>
                    <td><?php //echo $value->expense_receipt; ?><a target="_blank" href="<?php echo base_url(); ?>assets/debits/receipts/<?php echo $value->expense_receipt; ?>"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                    <td><?php if(!empty($value->other_receipt)){ // echo $value->other_receipt; ?><a target="_blank" href="<?php echo base_url(); ?>assets/debits/other_receipts/<?php echo $value->other_receipt; ?>"><i class="fa fa-download" aria-hidden="true"></i></a> <?php } ?></td>
                    <td><a href="<?php echo base_url(); ?>Debits/addExpense/<?php echo $value->id; ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a></td>
                  </tr>
              <?php $j++;  $i++; }
               }   else { ?>
                  <tr><td colspan="8">No Data found</td></tr>
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
    <script src="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
  <script>
  var end_date = '';
    $(() => {
        
        
           // Allow Input
      flatpickr('.datepicker-input', {
          /*minDate: "today",*/
        allowInput: true,
        onChange: function(dateObj, dateStr) {
           // console.info(dateObj);
           // console.info(dateStr);
            flatpickr('.datepicker-input1', {
                minDate: dateStr,
                allowInput: true
              })
        }
        
      })
      
      
      
          // Run datatable
      var table = $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
             'csv', 'excel', 'pdf', 'print'
        ],
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