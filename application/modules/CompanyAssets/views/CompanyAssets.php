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
          <li class="breadcrumb-item active" aria-current="page">Company Assets</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
            <h5>Manage Company Assets</h5>
      <div class="card">
        <div class="card-body">
          <!-- Toolbar -->         
          
        <form action="<?php echo base_url().'CompanyAssets/'; ?>"  method="post" enctype="multipart/form-data">
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
        <div class="col-sm-2" align="center">
            <a href="<?php echo base_url(); ?>CompanyAssets/add" class="form-control form-control-sm btn-primary"  name="adddebit" id="adddebit">Add </a>
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
                  <th scope="col"><?php echo lang('name');?></th>
                  <th scope="col"><?php echo lang('amount');?></th>
                  <th scope="col"><?php echo lang('bill_type');?></th>
                  <th scope="col"><?php echo lang('purchase_date');?></th>
                  <th scope="col"><?php echo lang('warranty_expiry_date');?></th>
                  <th scope="col"><?php echo lang('description');?></th>
                  <th scope="col"><?php echo lang('contact_details'); ?></th> 
                  <th scope="col"><?php echo lang('bill'); ?></th> 
                  <th scope="col"><?php echo lang('actions'); ?></th>       
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($CompanyAssets)){
                  $i = 1;
                  $j =1;
                foreach($CompanyAssets as $value){ ?>
                  <tr id='delete_<?php echo $value->company_asset_id;?>'>
                    <td><?php echo $value->company_asset_id; ?></td>
                    <td><?php echo $value->name; ?></td>
                    <td><?php echo $value->amount; ?></td>
                    <td><?php echo $value->bill_type; ?></td>
                    <td><?php echo date('d-M-Y', strtotime($value->purchase_date)); ?></td>
                    <td><?php echo date('d-M-Y', strtotime($value->warranty_expiry_date)); ?></td>
                    <td><?php echo $value->description; ?></td>
                    <td><?php echo $value->contact_details; ?></td>
                    <td><?php if(!empty($value->bill_file)){ //echo $value->bill_file; ?><a target="_blank" href="<?php echo base_url(); ?>assets/CompanyAssets/<?php echo $value->bill_file; ?>"><i class="fa fa-download" aria-hidden="true"></i></a> <?php } ?></td>
                    <td><a href="<?php echo base_url(); ?>CompanyAssets/add/<?php echo $value->company_asset_id; ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a></td>
                  </tr>
              <?php $j++;  $i++; }
               }   else { ?>
                  <tr><td colspan="9">No Data found</td></tr>
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