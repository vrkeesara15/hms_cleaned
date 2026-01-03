 <!-- Main body -->
 <div id="ajaxdata">
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Manage Emp Logs</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <h5>Manage Employee Logs</h5>

      <div class="card">
        <div class="card-body">
          <!-- Toolbar -->
         
 
          <div class="table-responsive">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning">
             <!--  <caption class="p-0 text-right"><small>Showing 1 to 5 of 57 entries</small></caption> -->

              <!-- Filter columns -->
              <thead class="thead-primary">
                <tr class="column-filter">
                  <th colspan="1"></th>
                  <th>
                    <label class="input-clearable input-icon input-icon-sm input-icon-right">
                      <input type="text" name="emp_email" id="emp_email" class="form-control form-control-sm border-primary" placeholder="Search By Email Id"><i data-toggle="clear" class="material-icons">clear</i>
                    </label>
                  </th>
                  <th>
                   
                  </th>
                  <th>
                    
                  </th>
                
                  <th colspan="1"><button  class="emp_search btn btn-sm btn-outline-primary btn-block has-icon"><i class="material-icons">search</i></button></th>
                </tr>
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Empoyee Name</th>
                  <th scope="col">Date</th>
                  <th scope="col">Login Time</th>
                  <th scope="col">Logout Time</th>                  
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
                  <td><?php echo getEmployeeName($value->emp_id);?></td>
                  <td><?php echo date('d-m-Y',strtotime($value->login_time));?></td>
                  <td><?php echo date('d-m-Y H:i:s',strtotime($value->login_time));?></td>
                  <td>
                    <?php 
                    if($value->logout_time !='0000-00-00 00:00:00'){
                    echo date('d-m-Y H:i:s',strtotime($value->logout_time));
                    }else {
                      echo "Not Logout";
                    }
                    ?></td>
                </tr>
                <?php $i++; }  } ?>
               
               
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

     $(function() {        
      $(".emp_search").click(function(){        
        var emp_email = $('#emp_email').val(); 
        if( emp_email == '')
        {
         alert("Please Enter Employee Email Id")
         return false;
        }

        $('#ajaxdata').html('<img src="<?php echo base_url() ; ?>assets/images/loading_small.gif">'); 
        $.ajax({
              url:'<?php echo base_url();?>Logs',
              type: 'POST',
              datatype:'application/json',
              data: 'emp_email='+emp_email,
              success:function(data){
                 $('#ajaxdata').html(''); 
                  $("#ajaxdata").html(data);
              }
          });
        });      
    });

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