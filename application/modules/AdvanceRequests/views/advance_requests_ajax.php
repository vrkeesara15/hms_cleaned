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
                  <th scope="col"><?php echo lang('SNO');?></th>
                  <th scope="col"><?php echo lang('employee');?></th>
                  <th scope="col"><?php echo lang('date_of_request');?></th>
                  <th scope="col"><?php echo lang('amount_request');?></th>
                  <th scope="col"><?php echo lang('Amount_paid');?></th>
                  <th scope="col"><?php echo lang('payment_date');?></th>
                  <?php
                    if($this->session->userdata('user_role') == '1'){
                    ?>
                  <th scope="col">Action</th>
                  <?php } ?>
                     
                </tr>
              </thead>

              <tbody>
                 
                <?php if(!empty($AdvanceRequests)){
                  $i = 1;
                  $j =1;
                foreach($AdvanceRequests as $value){ ?>
                  <tr id='delete_<?php echo $value->advance_request_id;?>'>
                    <td><?php echo $i; ?></td>
                    <td><?php echo getEmployeeName($value->emp_id); ?></td>
                    <td><?php echo (($value->requested_date)? (date('d-m-Y', strtotime($value->requested_date))):" - "); ?></td>
                    <td><?php echo $value->requested_amount; ?></td>
                    <td><?php echo $value->paid_amount; ?></td>
                    <td><?php echo (($value->payment_date != '0000-00-00')? (date('d-m-Y', strtotime($value->payment_date))):" - "); ?></td>
                     <?php
                    if($this->session->userdata('user_role') == '1'){
                    ?>
                    <td class="text-center">
                      <div class="btn-group btn-group-xs modalMainBtn" role="group">
                      <a href="#" class="btn btn-link btn-icon bigger-130 text-success" data-toggle="modal" data-target="#exampleModal" data-mainId="<?=$value->advance_request_id?>" data-requestedAmount="<?=$value->requested_amount?>" ><i class="material-icons mr-1" >add_circle_outline</i>Payment</a>
                      </div>
                    </td>
                    <?php } ?>
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