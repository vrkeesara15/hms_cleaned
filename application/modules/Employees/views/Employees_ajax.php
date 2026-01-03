 <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Manage Employees</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <h5>Manage Employees</h5>

      <div class="card">
        <div class="card-body">
          <!-- Toolbar -->
         
          <div class="btn-group btn-group-sm mb-3" role="group">
            <a href="<?php echo base_url();?>Employees/addEmployee"><button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">add_circle_outline</i> Add</button></a>
         <!--    <button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">refresh</i> Refresh</button>
            <button type="button" class="btn btn-light has-icon"><i class="mr-1" data-feather="paperclip"></i> Export</button> -->
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning" id="example">
             <!--  <caption class="p-0 text-right"><small>Showing 1 to 5 of 57 entries</small></caption> -->

              <!-- Filter columns -->
              <thead class="thead-primary">
               
                <tr>
                  <th scope="col">
                    S.No
                  </th>
                  <th scope="col" class="text-center">Detail</th>
                  <th scope="col">First name</th>
                  <th scope="col">Last name</th>                 
                  <th scope="col">Created</th>
                  <th scope="col">Created By</th>
                  <th scope="col">Role</th>
                  <th scope="col">View</th>
                  <th scope="col">Status</th>
                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>

              <tbody>
                <?php if(!empty($employees)){
                  $i = 1;
                  $j =1;
                foreach($employees as $employee){ ?>
                  <tr id='delete_<?php echo $employee->id;?>'>
                    <td>
                     <?php echo $i; ?>
                    </td>
                    <td class="text-center"><a href="#detailRow<?php echo $i; ?>" class="detail-toggle text-secondary" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="detailRow<?php echo $i; ?>"></a></td>
                    <td><?php echo $employee->fname; ?></td>
                    <td><?php echo $employee->lname; ?></td>
                    <td><?php echo date('d-m-Y',strtotime($employee->inserted_date)); ?></td>
                    <td><?php echo getEmployeeName($employee->inserted_by); ?></td>
                    <td>
                    <?php if($employee->user_role == '1'){
                      echo "Super Admin";
                    }else if($employee->user_role == '2'){
                      echo "Admin";
                    }else if($employee->user_role == '3'){ 
                      echo "Employee";
                    }?></td>

                     <td class="text-center">
                      <div class="btn-group btn-group-xs" role="group">
                        <a href="<?php echo base_url();?>Employees/viewEmployee/<?php echo $employee->id;  ?>" class="btn btn-link btn-icon bigger-130 text-primary"><i data-feather="eye"></i></a>                     
                      </div>
                    </td>
                  
                                        <td align="center" id="status<?php echo $j;?>">
                                          
                                         <?php
                                        if($employee->status == 'p') { ?>

                                        <button type="button" class="btn btn-primary btn-xs">Pending</button>
                                        <?php }else if($employee->status == 'r') { ?>
                                        <button type="button" class="btn btn-warning  btn-xs">Rejected</button>
                                        <?php }else if($employee->status == 'a') { ?>
                                        <button type="button" class="btn btn-success btn-xs">Approved</button>
                                        <?php } ?>
                                        
                                        
                                        </td>


                    <td class="text-center" >
                      <div class="btn-group btn-group-xs" role="group">
                        <a href="<?php echo base_url(); ?>Employees/editEmployee/<?php echo $employee->id;  ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a>                  
                      </div>
                    </td>
                  </tr>
                  <tr class="detail-row collapse" id="detailRow<?php echo $i; ?>">
                    <td colspan="10">
                      <ul class="data-detail ml-5">
                        <li><span>E-mail :</span><span><?php echo $employee->email; ?></span></li>
                        <?php if(!empty($employee->gender)){ ?>
                        <li><span>Gender </span><span><?php echo $employee->gender; ?></span></li>
                        <?php } ?>   
                        <li><span>Design : </span><span><?php echo $employee->designation; ?></span></li>
                          <li><span>Phone: </span><span><?php echo $employee->phone; ?></span></li>
                                            
                      </ul>
                    </td>
                  </tr>
              <?php $j++;  $i++; }
               } ?>

                
                 
               
              </tbody>
            </table><!-- /.table -->

          </div><!-- /.table-responsive -->

        </div>
      </div>

    
    </div>
    <!-- /Main body -->

  </div>
  <!-- /Main -->

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


 function changeStatus(id1, id,  status) { 
     var p_url= "<?php echo base_url(); ?>Employees/changeStatus";
     var ajaxLoading = false;
     if(!ajaxLoading) {
     var ajaxLoading = true;
     $('#'+id1).html('<img src="<?php echo base_url();?>assets/images/loading_small.gif">');
     jQuery.ajax({
     type: "POST",             
     url: p_url,
     data: 'id='+id+'&status='+status,
     success: function(data) {
      if(data == 1){
        $('#'+id1).html('<a class="green" href="#" onclick="changeStatus(\''+id1+'\', \''+id+'\', \'y\')">  <i data-feather="check"></i></a>');
       
      } else {
        $('#'+id1).html('<a class="red" href="#" onclick="changeStatus(\''+id1+'\', \''+id+'\', \'n\')"> <i data-feather="x"></i></a>');
         
      }
     ajaxLoading = false;
         }
         
     });  
        
    }
     }
     


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

          data: "&id="+ del_id,

          url: '<?php echo base_url();?>Employees/delete',

          success: function(msg) {

            $("#delete_"+del_id).hide();

          }

        });

       

        }

        return false;

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
  </script>

</body>

</html>