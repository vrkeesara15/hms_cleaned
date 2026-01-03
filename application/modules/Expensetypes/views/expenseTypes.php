 <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Manage Expense Type</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <h5>Line Type</h5>

      <div class="card">
        <div class="card-body">
          <!-- Toolbar --> 
          <?php 
           if($this->session->userdata('user_role') == '1' OR $this->session->userdata('user_role') == '2'){ ?>
          <div class="btn-group btn-group-sm mb-3" role="group">
            <a href="<?php echo base_url();?>Expensetypes/addExpense"><button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">add_circle_outline</i> Add</button></a>        
          </div>
        <?php } ?>

          <div class="table-responsive">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning">
             <!--  <caption class="p-0 text-right"><small>Showing 1 to 5 of 57 entries</small></caption> -->

              <!-- Filter columns -->
              <thead class="thead-primary">
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Expense type</th> 
                  <th scope="col">Created Date</th> 
                  <th scope="col">Created By</th> 
                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if(!empty($Expensetypes)){
                  $i = 1;
                  foreach($Expensetypes as $value){ 
                  ?>
                <tr id='delete_<?php echo $value->linetype_id;?>'>
                  <td> <?php echo $i; ?></td>
                  <td><?php echo $value->expense_type;?></td>
                  <td><?php echo $value->created_date;?></td>
                  <td><?php echo getEmployeeName($value->created_by); ?></td>
                  <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">                     
                      <a href="<?php echo base_url(); ?>Expensetypes/addExpense/<?php echo $value->id;  ?>"  class="btn btn-link btn-icon bigger-130 text-success" ><i data-feather="edit"></i></a></div>
                  </td>
                </tr>
               <?php $i++; }  }  else { ?>
                  <tr><td colspan="4">No Data found</td></tr>
                <?php } ?> 
               
               
              </tbody>
            </table><!-- /.table -->

          </div><!-- /.table-responsive -->
          
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

function chk1( url )  {
    if( confirm('Are you sure you want to delete this row?') ) {
    return true;
    }else {
        return false;
    }
}
    $(".trash ").click(function() {  
        if(chk1()){
         var del_id= $(this).attr('id');
          $.ajax({
          type: "POST",
          data: "linetype_id="+ del_id,
          url: '<?php echo base_url();?>LineTypes/delete',
          success: function(msg) {
            $("#delete_"+del_id).hide();
          }
        });
       
        }
        return false;
      });
  </script>

</body>

</html>