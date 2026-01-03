 <div class="main-body">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            <?php 
            $type_id = $this->uri->segment(3); 
            $res = getloanTypeDetails($type_id);
            echo $res->type_name;
            ?>
          </li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
      <div class="card">
        <div class="card-body">
          <!-- Toolbar -->         
          <div class="btn-group btn-group-sm mb-3" role="group">
            <a href="<?php echo base_url();?>Loans/addaccount/<?php echo $this->uri->segment(3);?>"><button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">add_circle_outline</i> Add</button></a>         
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
                        <a href="<?php echo base_url(); ?>Loanaccounts/addaccount/<?php echo $value->loan_id;  ?>" class="btn btn-link btn-icon bigger-130 text-success"><i data-feather="edit"></i></a>
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