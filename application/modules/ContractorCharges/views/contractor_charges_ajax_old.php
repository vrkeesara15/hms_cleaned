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
                  <th scope="col">Date Created</th>
                  <th scope="col">Contractor</th>
                  <th scope="col">Invoice Number</th>
                  <th scope="col">Invoice Amount</th>
                  <th scope="col">Amount Received</th>
                  <th scope="col">Net Contractor Charges</th>
                  <th scope="col">Net Amount Payable</th>
                  <!--<th scope="col">Payment Date</th>-->
                  <th scope="col">Paid From Advance</th>
                  <th scope="col">View</th>   
                </tr>
              </thead>

              <tbody>
                <?php if(!empty($contractorCharges)){
                  $i = 1;
                  $j =1;
                foreach($contractorCharges as $value){ ?>
                  <tr id='delete_<?php echo $value->order_id;?>'>
                    <td><?php echo $i; ?></td>
                    <td><?php echo date('d-m-Y H:i:s', strtotime($value->created_date)); ?></td>
                    <td><?php echo getEmployeeName($value->created_by); ?></td>
                    
                    <td><a href="<?php echo base_url(); ?>Invoice/invoice_view/<?php echo $value->invoice_id; ?>"><?php echo $value->invoice_id; ?></a></td>
                    <td><?php
                    $invoiceTotal = getInvoiceTotal($value->invoice_id);
                     echo $invoiceTotal->total; ?></td>
                    <td><?php echo $value->received_amount; ?></td>
                    <td><?php echo $value->net_contractor_charges; ?></td>
                    <td><?php echo $value->net_amount_pay; ?></td>
                    <!--<td><?php /* echo date('d-m-Y', strtotime($value->payment_date)); */ ?>-->
                    <!--</td>-->
                    <td><?php echo $value->paid_amount; ?></td>
                  
                    <td class="text-center"> 
                    <div class="btn-group btn-group-xs" role="group">
                      
                      <a href="<?php echo base_url(); ?>ContractorCharges/charges_view/<?php echo $value->contractor_charges_id; ?>" class="btn btn-link btn-icon bigger-130 text-primary"><i data-feather="eye"></i></a>                     
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