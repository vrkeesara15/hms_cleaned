 <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Manage Invoices</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <h5>Manage Invoices</h5>

      <div class="card">
        <div class="card-body">
          <!-- Toolbar --> 
          <div class="btn-group btn-group-sm mb-3" role="group">
            <a href="<?php echo base_url();?>Invoice/addInvoices"><button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">add_circle_outline</i> Add</button></a>
          </div>
<div class="table-responsive">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning">
              <!-- Filter columns -->
             <thead class="thead-primary">
               
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Invocie ID</th>
                  <th scope="col">Barrower Name</th>
                  <th scope="col">Account No</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Created By</th> 
                    <th scope="col">View</th>                        
                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>

              <tbody>
                <?php if(!empty($details)) { ?>
                <?php $i=1; foreach ($details as $key => $value) { ?>
               
                <tr id="row_<?php echo $value->id;?>">
                  <td><?php echo $value->id; ?></td>
                  <td>#<?php echo $value->id; ?></td>
                  <td><?php echo $value->barrower_name; ?></td>
                  <td><?php echo $value->account; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($value->inserted_date)); ?></td>
                    <td><?php echo getEmployeeName($value->inserted_by); ?></td>
                   <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">
                      <a href="<?php echo base_url(); ?>Invoice/invoice_view/<?php echo $value->id; ?>" class="btn btn-link btn-icon bigger-130 text-primary"><i data-feather="eye"></i></a>                     
                    </div>
                  </td>
                  <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">
                      <a href="<?php echo base_url(); ?>Invoice/addInvoices/<?php echo $value->id; ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a>
                      <!-- <a href="#"  id="<?php echo $value->id;?>" class="trash btn btn-link btn-icon bigger-130 text-danger"><i data-feather="trash"></i></a> -->
                    </div>
                  </td>
                </tr>
               <?php } ?>
                <?php } else { ?>
                  <tr><td colspan="7">No Data found</td></tr>
                <?php } ?>
               
               
              </tbody>
            </table><!-- /.table -->

          </div><!-- /.table-responsive -->

           <div class="d-flex align-items-center flex-column flex-sm-row mt-4">

           <?php echo $links; ?>

          </div><!-- /.d-flex -->
          

        </div>
      </div>

    
    </div>
    <!-- /Main body -->

    <script>      
     
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