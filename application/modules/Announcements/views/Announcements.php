 <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Manage Announcements</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <h5>Manage Announcements</h5>

      <div class="card">
        <div class="card-body">
          <!-- Toolbar --> 
          <?php 
           if($this->session->userdata('user_role') == '1'){ ?>
          <div class="btn-group btn-group-sm mb-3" role="group">
            <a href="<?php echo base_url();?>Announcements/addAnnouncements"><button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">add_circle_outline</i> Add</button></a>
          </div>
        <?php } ?>

          <div class="table-responsive">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning">
             <!--  <caption class="p-0 text-right"><small>Showing 1 to 5 of 57 entries</small></caption> -->

              <!-- Filter columns -->
              <thead class="thead-primary">
               
                <tr>
                  <th scope="col">
                    S.No
                  </th>
                  <th scope="col">Description</th>
                  <th scope="col">Start Date</th>
                  <th scope="col">End Date</th>
                  <th scope="col">Status</th>
                  <?php if($this->session->userdata('user_role') == '1'){ ?>
                  <th scope="col" class="text-center">Actions</th>
                <?php } ?>
                </tr>
              </thead>

              <tbody>
                <?php 
                if(!empty($details)){
                  $i = 1;
                  foreach($details as $value){ 
                  ?>
                <tr id='delete_<?php echo $value->id;?>'>
                  <td> <?php echo $i; ?> </td>
                  <td><?php echo $value->description;?></td>
                  <td><?php echo date('d M Y',strtotime($value->start_date));?></td>
                  <td><?php echo date('d M Y',strtotime($value->end_date));?></td>
                  <?php if($this->session->userdata('user_role') == '1'){ ?>
                    <td>
                    <button type='button' class='btn btn-sm btn-<?php echo (($value->status == 'y')?'success':'secondary'); ?> announcement_status'  main_id ="<?php echo $value->id;?>" id="announcement_<?php echo $value->id;?>" status="<?php echo (($value->status == 'y')?'y':'n'); ?>" value="<?php echo (($value->status == 'y')?'y':'n'); ?>" ><?php echo (($value->status == 'y')?'Activate':'Deactivate'); ?></button>
                       </td>
                  <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">
                     
                      <a href="<?php echo base_url(); ?>Announcements/editAnnouncement/<?php echo $value->id;  ?>"  class="btn btn-link btn-icon bigger-130 text-success" ><i data-feather="edit"></i></a>  
                      |<a href="#"  id="<?php echo $value->id;?>" class="trash btn btn-link btn-icon bigger-130 text-danger"><i data-feather="trash"></i></a>
                    </div>
                  </td>
                <?php } ?>
                </tr>
               
                <?php $i++; }  }  else { ?>
                  <tr><td colspan="5">No Data found</td></tr>
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
          data: "announcement_id="+ del_id,
          url: '<?php echo base_url();?>Announcements/delete',
          success: function(msg) {
            $("#delete_"+del_id).hide();
          }
        });       
        }
        return false;
      });
function chk2( url )  {
    if( confirm('Are you sure you want to change status') ) {
    return true;
    }else {
        return false;
    }
}
    $(document).ready(function(){
          $(".announcement_status").click(function() {  
             if(chk2()){
              var id= $(this).attr('main_id');
              var status= $(this).attr('status');
              $.ajax({
                  type: "POST",
                  data: {id:id,status:status},
                  url: '<?php echo base_url();?>Announcements/change_status',
                  success: function(msg) {
                    location.reload();
                  }
                });
            }
          });
        })
  </script>
</body>
</html>