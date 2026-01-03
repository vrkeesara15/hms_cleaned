 <!-- Main body -->
    <div class="main-body">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo lang('manage_work_orders');?></li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
      <div class="card">
        <div class="card-body">
          <!-- Toolbar -->         
          <div class="btn-group btn-group-sm mb-3" role="group">
            <a href="<?php echo base_url();?>Workorders/addWorkorder"><button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">add_circle_outline</i> Add</button></a>         
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning">
              <!-- Filter columns -->
              <thead class="thead-primary">               
                <tr>
                  <th scope="col"><?php echo lang('Sno');?></th>
                  <th scope="col">Created By</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Bank</th>
                  <th scope="col">Branch</th>                  
                  
                  <th scope="col"><?php echo lang('work_order_num');?></th>
                  <th scope="col">Download</th>                  
                </tr>
              </thead>

              <tbody>
                <?php if(!empty($Workorders)){
                  $i = 1;
                  $j =1;
                foreach($Workorders as $value){ ?>
                  <tr id='delete_<?php echo $value->order_id;?>'>
                    <td><?php echo $i; ?></td>
                    <td><?php echo getEmployeeName($value->inserted_by); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($value->inserted_date)); ?></td>
                    <td><?php echo $value->bank_name; ?></td>
                    <td><?php echo $value->branch_name; ?></td>
                    
                    <td><?php echo $value->work_order_num; ?></td>
                    <td class="text-center"> 
                    <div class="btn-group btn-group-xs" role="group">
                      <?php $path = "assets/workorderdoc"; ?>
                      <a href="<?php echo base_url().$path.'/'.$value->work_order_doc;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>                     
                    </div>
                  </td>
                  
                    <td class="text-center" >
                      <div class="btn-group btn-group-xs" role="group">
                        <a href="<?php echo base_url(); ?>Workorders/addWorkorder/<?php echo $value->order_id;  ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a>
                      </div>
                    </td>
                  </tr>
                   
              <?php $j++;  $i++; }
               }   else { ?>
                  <tr><td colspan="12">No Data found</td></tr>
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
    <script>    
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