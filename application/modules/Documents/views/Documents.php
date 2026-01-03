 <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Manage Documents</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <h5>Manage Documents</h5>

      <div class="card">
        <div class="card-body">
          <!-- Toolbar --> 
        
        

          <div class="table-responsive">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning">
             <!--  <caption class="p-0 text-right"><small>Showing 1 to 5 of 57 entries</small></caption> -->

              <!-- Filter columns -->
              <thead class="thead-primary">
               
                <tr>
                  <th scope="col">
                    S.No
                  </th>
                  <th scope="col">Module Name</th>
                  <th scope="col">Item Id</th>
                  <th scope="col">Document Name</th>
                  <th scope="col">Document Format</th>
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
                <tr id='delete_<?php echo $value->doc_id;?>'>
                  <td> <?php echo $i; ?> </td>
                  <td><?php echo $value->module_name;?></td>
                  <td><?php echo getRowName($value->module_id,$value->item_id);?></td>
                  <td><?php echo $value->doc_name;?></td>
                  
                   <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">
                       <?php $path = "assets/documents"; ?>
                      <a href="<?php echo base_url().$path.'/'.$value->doc_file;?>" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>                     
                    </div>
                  </td>
                  <?php if($this->session->userdata('user_role') == '1'){ ?>
                  <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">
                     
                     <!--  <a href="<?php echo base_url(); ?>Formats/editEmpanelment/<?php echo $value->doc_id;  ?>"  class="btn btn-link btn-icon bigger-130 text-success" ><i data-feather="edit"></i></a> -->
                      <a href="javascript:void(0)" class="btn btn-link btn-icon bigger-130 text-danger trash" id="<?php echo $value->doc_id;?>"><i data-feather="trash"></i></a>
                    </div>
                  </td>
                <?php } ?>
                </tr>
               
                <?php $i++; }  } ?>
               
               
              </tbody>
            </table><!-- /.table -->

          </div><!-- /.table-responsive -->

          <div class="d-flex align-items-center flex-column flex-sm-row">

            

            <!-- Pagination -->
         <!--    <ul class="pagination pagination-sm pagination-circle mb-0 ml-sm-auto mt-1 mt-sm-0">
              <li class="page-item disabled">
                <span class="page-link"><i data-feather="chevron-left"></i></span>
              </li>
              <li class="page-item active"><span class="page-link">1</span></li>
              <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
              <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
              <li class="page-item readonly"><span class="page-link">...</span></li>
              <li class="page-item"><a class="page-link" href="javascript:void(0)">10</a></li>
              <li class="page-item"><a class="page-link" href="javascript:void(0)"><i data-feather="chevron-right"></i></a></li>
            </ul> -->

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
          data: "doc_id="+ del_id,
          url: '<?php echo base_url();?>Documents/delete',
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