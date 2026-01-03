 <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Manage Empanelments</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <h5>Manage Empanelments</h5>

      <div class="card">
        <div class="card-body">
          <!-- Toolbar -->
          <?php if($this->session->userdata('user_role') != '3'){ ?>
          <div class="btn-group btn-group-sm mb-3" role="group">
            <a href="<?php echo base_url();?>Empanelments/addEmpanelment"><button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">add_circle_outline</i> Add</button></a>
         <!--    <button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">refresh</i> Refresh</button>
            <button type="button" class="btn btn-light has-icon"><i class="mr-1" data-feather="paperclip"></i> Export</button> -->
          </div>
        <?php } ?>

          <div class="table-responsive">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning" id="example">
             <!--  <caption class="p-0 text-right"><small>Showing 1 to 5 of 57 entries</small></caption> -->

              <!-- Filter columns -->
              <thead class="thead-primary">
               
                <tr>
                  <th scope="col">
                    S.No
                  </th>
                  <th scope="col">Bank</th>
                  <th scope="col">State</th>
                  <th scope="col">Circle</th>
                  <th scope="col">Eempanelment Doc</th>
                  <th scope="col">Agreement Doc</th>
                  <th scope="col">Start Date</th>
                  <th scope="col">Expiry Date</th>
                  <th scope="col">Notes</th>
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
                <tr id='delete_<?php echo $value->empanelment_id;?>'>
                  <td> <?php echo $i; ?> </td>
                  <td><?php echo $value->bank_name;?></td>
                  <td><?php echo $value->state_name;?></td>
                  <td><?php echo $value->circle;?></td>
                  
                <td class="text-center"> 
                    <div class="btn-group btn-group-xs" role="group">
                        <?php
                        $path = "assets/empanelment_doc/empanelment_doc";
                        $filePath = $path . '/' . $value->empanelment_doc;
                
                        if (file_exists($filePath)) {
                            echo '<a href="' . base_url() . $filePath . '" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary"><i data-feather="download"></i></a>';
                        } else {
                            echo '';
                        }
                        ?>
                    </div>
                </td>
                <td class="text-center"> 
                    <div class="btn-group btn-group-xs" role="group">
                        <?php
                        $path = "assets/empanelment_doc/agreement_doc";
                        $filePath = $path . '/' . $value->agreement_doc;
                
                        if (file_exists($filePath)) {
                            echo '<a href="' . base_url() . $filePath . '" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary"><i data-feather="download"></i></a>';
                        } else {
                            echo '';
                        }
                        ?>
                    </div>
                </td>             
                <td><?php echo (($value->start_date == '0000-00-00 00:00:00')?' ':date('d-m-Y',strtotime($value->start_date)));?></td>
                 <td><?php echo (($value->expiry_date == '0000-00-00 00:00:00')?' ':date('d-m-Y',strtotime($value->expiry_date)));?></td>
                 <td><?php echo $value->notes;?></td>
                  <?php if($this->session->userdata('user_role') == '1'){ ?>
                  <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">
                      <a href="<?php echo base_url(); ?>Empanelments/editEmpanelment/<?php echo $value->empanelment_id;  ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a>
                      <a href="javascript:void(0)" class="btn btn-link btn-icon bigger-130 text-danger trash" id="<?php echo $value->empanelment_id;?>"><i data-feather="trash"></i></a>
                    </div>
                  </td>
                <?php } ?>
                </tr>
                <?php $i++; }  }  else { ?>
                  <tr><td colspan="6">No Data found</td></tr>
                <?php } ?> 
               
               
              </tbody>
            </table><!-- /.table -->

          </div><!-- /.table-responsive -->

          <div class="d-flex align-items-center flex-column flex-sm-row">

          </div><!-- /.d-flex -->
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
          data: "&empanelment_id="+ del_id,
          url: '<?php echo base_url();?>Empanelments/delete',
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