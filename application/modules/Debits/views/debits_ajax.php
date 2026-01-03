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
                  <th scope="col"><?php echo lang('SNo');?></th>
                  <!--<th scope="col"><?php echo lang('date');?></th>-->
                  <th scope="col"><?php echo lang('created_by');?></th>
                  <th scope="col"><?php echo lang('amount');?></th>
                  <th scope="col"><?php echo lang('expense_type');?></th>
                  <th scope="col"><?php echo lang('paid_to');?></th>
                  <th scope="col"><?php echo lang('description');?></th>
                  <th scope="col"><?php echo lang('payment_method'); ?></th> 
                  <th scope="col"><?php echo lang('tds_amount');?></th>
                  <th scope="col"><?php echo lang('transaction_date'); ?></th> 
                  <th scope="col"><?php echo lang('receipt'); ?></th>       
                   <th scope="col"><?php echo lang('actions'); ?></th>       
                </tr>
              </thead>

             <tbody>
                 <?php if(!empty($Debits)){
                  $i = 1;
                  $j =1;
                foreach($Debits as $value){ ?>
                  <tr id='delete_<?php echo $value->id;?>'>
                    <td><?php echo $value->id; ?></td>
                   <!-- <td><?php echo $value->date_of_receipt; ?></td>-->
                    <td><?php echo getEmployeeName($value->created_by); ?></td>
                    <td><?php echo $value->amount; ?></td>
                    <td><?php echo $value->expense_type; ?></td>
                    <td><?php echo $value->paid_to; ?></td>
                    <td><?php echo $value->expense_description; ?></td>
                    <td><?php echo $value->payment_method; ?></td>
                    <td><?php echo $value->tds_amount; ?></td>
                    <td><?php if($value->transaction_date != '0000-00-00'){ echo $value->transaction_date; } ?></td>
                    <td><?php echo $value->expense_receipt; ?><a target="_blank" href="<?php echo base_url(); ?>assets/debits/receipts/<?php echo $value->expense_receipt; ?>"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                    <td><a href="<?php echo base_url(); ?>Debits/addExpense/<?php echo $value->id; ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a></td>
                  </tr>
              <?php $j++;  $i++; }
               }   else { ?>
                  <tr><td colspan="8">No Data found</td></tr>
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