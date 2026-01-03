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


          <div class="d-flex align-items-center flex-column flex-sm-row mt-4">

            <?php echo $links; ?>

            <!-- Pagination -->
           <!--  <ul class="pagination pagination-sm pagination-circle mb-0 ml-sm-auto mt-1 mt-sm-0">
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
  </script>