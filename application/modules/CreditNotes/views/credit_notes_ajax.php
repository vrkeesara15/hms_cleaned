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
                  <th scope="col"><?php echo lang('credit_note_number');?></th>
                  <th scope="col"><?php echo lang('date');?></th>
                  <th scope="col"><?php echo lang('barrower_name');?></th>
                  <th scope="col"><?php echo lang('account_number');?></th>
                  <th scope="col"><?php echo lang('associated_invoice_number');?></th>
                  <th scope="col"><?php echo lang('associated_invoice_date');?></th>
                  <th scope="col"><?php echo lang('credit_note_amount');?></th>
                  <th scope="col"><?php echo lang('credit_note_gst_amount');?></th>
                  <!--<th scope="col"><?php /* echo lang('total'); */ ?></th>-->
                  <th scope="col">Created Date & Time</th>       
                </tr>
              </thead>

             <tbody>
                <?php if(!empty($Credit_notes)){
                  $i = 1;
                  $j =1;
                foreach($Credit_notes as $value){ ?>
                  <tr id='delete_<?php echo $value->credit_note_id;?>'>
                    <td><?php echo $value->credit_note_id; ?></td>
                    <td><?php echo $value->created_date; ?></td>
                    <td><?php echo getBarrowerName($value->invoice_id); ?></td>
                    <td><?php echo $value->account_no; ?></td>
                   <td><a href="<?php echo base_url(); ?>Invoice/invoice_view/<?php echo $value->invoice_id; ?>"><?php echo $value->invoice_id; ?></a></td>
                    <td><?php echo $value->inv_date; ?></td>
                    <td><?php echo $value->credit_note_amount; ?></td>
                    <td><?php echo $value->credit_note_gst_amount; ?></td>
                    <!--<td><?php /* echo ($value->credit_note_amount+$value->credit_note_gst_amount); */ ?></td>-->
                    <td><?php echo date('d-m-Y H:i:s', strtotime($value->inserted_date)); ?></td>
                    
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