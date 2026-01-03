 <!-- Main body -->
    <div class="main-body">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Manage Car Loan Accounts</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
        <div class="card">
        <div class="card-body">
          <!-- Toolbar -->
            <div class="btn-group btn-group-sm mb-3" role="group">
            <a href="<?php echo base_url();?>Loanaccounts/addaccount"><button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">add_circle_outline</i> Add</button></a>         
          </div>


          <div class="table-responsive">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning">
              <!-- Filter columns -->
              <thead class="thead-primary">               
                <tr>
                  <th scope="col"><?php echo lang('Sno');?></th>
                  <th scope="col" class="text-center"><?php echo lang('detail');?></th>
                  <th scope="col">Created By</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Bank</th>
                  <th scope="col">Branch</th>
                  <th scope="col">Loan AC No</th>
                  <th scope="col"><?php echo lang('barrower_name');?></th>
                  <th scope="col"><?php echo lang('work_order_doc');?></th>
                  <th scope="col"><?php echo lang('work_view');?></th>
                  <th scope="col"><?php echo lang('status');?></th>
                  <th scope="col"><?php echo lang('actions');?></th>
                </tr>
              </thead>

              <tbody>
                <?php if(!empty($loanaccounts)){
                  $i = 1;
                  $j =1;
                foreach($loanaccounts as $value){ ?>
                  <tr id='delete_<?php echo $value->loan_id;?>'>
                    <td><?php echo $value->loan_id;?></td>
                    <td class="text-center"><a href="#detailRow<?php echo $i; ?>" class="detail-toggle text-secondary" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="detailRow<?php echo $i; ?>"></a></td>
                    <td><?php echo getEmployeeName($value->inserted_by); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($value->work_order_date)); ?></td>
                    <td><?php echo $value->bank_name; ?></td>
                    <td><?php echo $value->branch_name; ?></td>
                    <td><?php echo $value->loan_ac_number; ?></td>
                    <td><?php echo $value->barrower_name; ?></td>
                    <td class="text-center"> 
                    <div class="btn-group btn-group-xs" role="group">
                      <?php $path = "assets/workorderdoc"; ?>
                      <a href="<?php echo base_url().$path.'/'.$value->work_order_doc;?>" target="_blank" class="btn btn-link btn-icon bigger-130 text-primary" download><i data-feather="download"></i></a>                     
                    </div>
                  </td>
                 <td><button class="btn btn-icon text-info" type="button">
                    <a href="<?php echo base_url(); ?>Loanaccounts/loanaccount_view/<?php echo $value->loan_id; ?>"><i data-feather="eye"></i></a></button>
                  </td>
                    <td class="text-center" >                     
                    <?php if($value->status == 'p'){  ?>                      
                    <button type="button" class="btn btn-primary btn-xs">Pending</button>
                    <?php }else if($value->status == 'reg'){ ?>                      
                    <button type="button" class="btn btn-success btn-xs">Regularize</button>
                    <?php }else if($value->status == 's'){ ?>
                    <button type="button" class="btn btn-success btn-xs">Sieze</button>
                    <?php  }else if($value->status == 'rel'){ ?>
                      <button type="button" class="btn btn-success btn-xs">Release</button>
                    <?php  }else if($value->status == 'a'){ ?>
                      <button type="button" class="btn btn-success btn-xs">Auction</button>
                    <?php  } ?>
                    </td>
                    <td class="text-center" >
                      <div class="btn-group btn-group-xs" role="group">
                        <a href="<?php echo base_url(); ?>Loanaccounts/addaccount/<?php echo $value->loan_id;  ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a>
                      </div>
                    </td>
                  </tr>
                   <tr class="detail-row collapse" id="detailRow<?php echo $i; ?>">
                    <td colspan="12">
                      <ul class="data-detail ml-5">
                       
                        <li><span><?php echo lang('branch_controller');?> : &nbsp; &nbsp; </span><span><?php echo $value->branch_controller; ?></span></li>
                        <li><span><?php echo lang('vehicle_number');?>: &nbsp; &nbsp;</span><span><?php echo $value->vehicle_number; ?></span></li>
                        <li><span>Vehicle Chasse Number: &nbsp; &nbsp;</span><span><?php echo $value->vehicle_chasse_number; ?></span></li>
                        <li><span><?php echo lang('vehicle_engine_num');?>: &nbsp; &nbsp;</span><span><?php echo $value->vehicle_engine_num; ?></span></li>
                        <li>
                        <div class="list-with-gap">
                          <?php if($value->status == 'p'){  ?>  
                         <a href="<?php echo base_url(); ?>Loanaccounts/regularize_form/<?php echo $value->loan_id; ?>">
                          <button type="button" class="btn btn-primary">
                          Regularize
                         </button></a>
                        <a href="<?php echo base_url(); ?>Loanaccounts/seize_form/<?php echo $value->loan_id; ?>"><button type="button" class="btn btn-secondary">
                          Sieze
                      </button>    
                        </a>
                          <?php }else if($value->status == 'reg'){ ?>
                            Status : regularized
                          <?php }else if($value->status == 's'){ ?>
                            <a href="<?php echo base_url(); ?>Loanaccounts/auction_form/<?php echo $value->loan_id; ?>"><button type="button" class="btn btn-primary">                         
                          Auction
                         </button></a>
                        <a href="<?php echo base_url(); ?>Loanaccounts/release_form/<?php echo $value->loan_id; ?>"> <button type="button" class="btn btn-secondary">
                       Release
                        </button> </a>   
                          <?php } ?>
                        </div>
                        </li>
                      </ul>
                    </td>
                  </tr>
              <?php $j++;  $i++; }
               } ?>
              </tbody>
            </table><!-- /.table -->

          </div><!-- /.table-responsive -->
        <div class="d-flex align-items-center flex-column flex-sm-row mt-4">
               <?php echo $links; ?>
         </div>
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