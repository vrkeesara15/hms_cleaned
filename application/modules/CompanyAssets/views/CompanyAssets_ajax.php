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
                  <th scope="col"><?php echo lang('name');?></th>
                  <th scope="col"><?php echo lang('amount');?></th>
                  <th scope="col"><?php echo lang('bill_type');?></th>
                  <th scope="col"><?php echo lang('purchase_date');?></th>
                  <th scope="col"><?php echo lang('warranty_expiry_date');?></th>
                  <th scope="col"><?php echo lang('description');?></th>
                  <th scope="col"><?php echo lang('contact_details'); ?></th> 
                  <th scope="col"><?php echo lang('actions'); ?></th>     
                </tr>
              </thead>

             <tbody>
                <?php if(!empty($Debits)){
                  $i = 1;
                  $j =1;
                foreach($Debits as $value){ ?>
                  <tr id='delete_<?php echo $value->company_asset_id;?>'>
                    <td><?php echo $value->company_asset_id; ?></td>
                    <td><?php echo $value->name; ?></td>
                    <td><?php echo $value->amount; ?></td>
                    <td><?php echo $value->bill_type; ?></td>
                    <td><?php echo date('d-M-Y', strtotime($value->purchase_date)); ?></td>
                    <td><?php echo date('d-M-Y', strtotime($value->warranty_expiry_date)); ?></td>
                    <td><?php echo $value->description; ?></td>
                    <td><?php echo $value->contact_details; ?></td>
                    <td><a href="<?php echo base_url(); ?>CompanyAssets/add/<?php echo $value->company_asset_id; ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a></td>
                  </tr>
              <?php $j++;  $i++; }
               }   else { ?>
                  <tr><td colspan="9">No Data found</td></tr>
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