   <div id="ajaxdata">
 <!-- Main body -->
    <div class="main-body">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loans">Loan Type</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            <?php 
            $type_id = $this->uri->segment(3); 
            $res = getloanTypeDetails($type_id);
            echo $res->type_name;
            ?>
          </li>
        </ol>
      </nav>
       
      <div class="card mb-3">
        <div class="card-body p-2" style="height: 47px">
        <!--   <div class="d-flex align-items-center collapse transition-none blog-toolbar">
            <button class="btn btn-sm btn-icon mr-2" data-toggle="collapse" data-target=".blog-toolbar">
              <i data-feather="chevron-left"></i>
            </button>
            <span class="input-icon input-icon-sm">
              <i class="material-icons">search</i>
              <input type="text" class="form-control form-control-sm bg-gray-200 border-gray-200" placeholder="Search blog">
            </span>
          </div> -->
          <div class="d-flex align-items-center collapse transition-none show blog-toolbar">
            <!-- <button class="btn btn-outline-primary btn-sm has-icon" type="button" onclick="$('.sidebar-body').find(`a:contains('Add New Post')`)[0].click()"><i data-feather="plus" class="mr-1"></i> <a href="<?php echo base_url();?>Loans/addaccount/<?php echo $this->uri->segment(3);?>">Add Loan Account</a></button> -->
            <!-- <button class="btn btn-light btn-sm btn-icon ml-auto mr-1" type="button" >
              <i data-feather="search"></i>
            </button> -->
            
           <!--  <select class="custom-select custom-select-sm w-auto">
              <option value="all">All</option>
              <option value="published">Published</option>
              <option value="draft">Draft</option>
            </select> -->
          </div>
        </div>
      </div>
      <!-- /Breadcrumb -->
      <div class="card">
        <div class="card-body">
          <!-- Toolbar -->         
        
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
                  <!-- <th scope="col"><?php echo lang('work_view');?></th> -->
                  <th scope="col"><?php echo lang('status');?></th>
                  <th scope="col"><?php echo lang('actions');?></th>
                </tr>
              </thead>

              <tbody>
                <?php if(!empty($Loans)){
                  $i = 1;
                  $j =1;
                foreach($Loans as $value){ ?>
                  <tr id='delete_<?php echo $value->loan_id;?>'>
                    <td><?php echo $i; ?></td>
                    <td class="text-center"><a href="#detailRow<?php echo $i; ?>" class="detail-toggle text-secondary" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="detailRow<?php echo $i; ?>"></a></td>
                    <td><?php echo getEmployeeName($value->inserted_by); ?></td>
                    <td><?php echo date('d M Y H:i:s', strtotime($value->inserted_date)); ?>
                      
                    </td>                    
                    <td><?php echo $value->bank_name; ?></td>
                    <td><?php echo $value->branch_name; ?></td>
                    <td><?php echo $value->loan_ac_number; ?></td>
                    <td><?php echo $value->barrower_name; ?></td>                   
                  </td>
                 <!--  <td><button class="btn btn-icon text-info" type="button">
                    <a href="<?php echo base_url(); ?>Loanaccounts/loanaccount_view/<?php echo $value->loan_id; ?>"><i data-feather="eye"></i></a></button>
                  </td> -->
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
                    <?php  }else if($value->status == 'c'){ ?>
                      <button type="button" class="btn btn-success btn-xs">Closed</button>
                    <?php  } ?>
                    </td>
                    <td class="text-center" >
                      <div class="btn-group btn-group-xs" role="group">
                        <a href="<?php echo base_url(); ?>Loans/addaccount1/<?php echo $value->loan_id;  ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a>
                      </div>
                    </td>
                  </tr>
                   <tr class="detail-row collapse" id="detailRow<?php echo $i; ?>">
                    <td colspan="12">
                      <section id="section2" class="mt-1">
            <h5>Loan More Information</h5>
            
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="thead-primary">
                      <tr>
                        <th scope="col">Branch Controller</th>
                        <th scope="col">Sanction Date</th>
                        <th scope="col">Sanction Amount</th>
                        <th scope="col">Overdue Amount</th>
                        <th scope="col">Outstanding  Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><?php echo $value->branch_controller; ?></th>
                        <td><?php echo $value->date_of_sanction; ?></td>
                        <td class="font-number"><?php echo $value->cus_loan_amount; ?></td>
                          <td class="font-number"><?php echo $value->irregular_amount; ?></td>
                        <td class="font-number"><?php echo $value->outstanding_amount; ?></td>
                      
                      </tr>
                     
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>
                     
                          
                        <div class="list-with-gap">
                          <?php if($value->status == 'p'){  ?>  
                         <a href="<?php echo base_url(); ?>Loans/regcolse_form/<?php echo $value->loan_id; ?>/reg">
                          <button type="button" class="btn btn-primary">
                          Regularize
                         </button></a>
                        <a href="<?php echo base_url(); ?>Loans/regcolse_form/<?php echo $value->loan_id; ?>/c"><button type="button" class="btn btn-secondary">
                          Close
                      </button>    
                        </a>
                          <?php }else if($value->status == 'reg' OR $value->status =='c'){ ?>
                              <section id="section2" class="mt-2">
            <h5>
              <?php if($value->status == 'reg') {
                echo "Loan Regularized ";
              } else {
                echo "Loan Close";
              }
              ?>
            Information </h5>
            <?php $regc_data = getloanRegCloseDetails($value->loan_id); ?>
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="thead-primary">
                      <tr>
                        <th scope="col">Borrower Contact No.1</th>
                        <th scope="col">Borrower Contact No.2</th>
                        <th scope="col">Other Contact No.1</th>
                        <th scope="col">Other Contact No.2</th>
                        <th scope="col">Performance Remarks</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><?php echo $regc_data->borrower_contact_no_1;?></th>
                        <td><?php echo $regc_data->borrower_contact_no_2;?></td>
                        <td><?php echo $regc_data->other_contact_no_1;?></td>
                        <td><?php echo $regc_data->other_contact_no_2;?></td>
                        <td class="font-number"><?php echo $regc_data->remarks;?></td>
                        <td class="font-number"><a href="<?php echo base_url(); ?>Loans/regcolse_form/<?php echo $value->loan_id;  ?>/<?php echo $value->status;?>/<?php echo $regc_data->id;?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a></td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>
                           
                          <?php } ?>
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
</div>
  </div>
  <!-- /Main -->

  <!-- Main Scripts -->
  <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>
  
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
</body>
</html>