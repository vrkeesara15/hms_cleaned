   <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
   <div id="ajaxdata">
 <!-- Main body -->
    <div class="main-body">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Advance Requests</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
            <h5>Manage Advance Requests</h5>
      <div class="card">
                      
        <div class="card-body">
            <?php 
                if($this->session->userdata('user_role') == '1'){ ?>
            <div class="row">
            &ensp;&ensp;<select class="custom-select col-sm-3" id="employee_id" name="employee_id">
                          <option value='' selected>Select Employee</option>
                          <?php foreach ($emp_details as $key => $value) { 
                            if($value->id != 1) {
                            
                          ?>
                            <option value="<?php echo $value->id; ?>" <?=(($employee_id == $value->id)?"selected":"")?>><?php echo $value->fname.' '.$value->lname; ?></option>
                          <?php } } ?>
                        </select> 
                        </div>
                        <?php }  ?>
                        
                         <div class="clearfix"><br /></div>
          <!-- Toolbar -->      
          <?php
                    if($this->session->userdata('user_role') == '1'){
                    ?>
           <div class="btn-group btn-group-sm mb-3" role="group">
            <a href="<?php echo base_url();?>AdvanceRequests/advanceRequests_add"><button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">add_circle_outline</i> Add</button></a>
         <!--    <button type="button" class="btn btn-light has-icon"><i class="material-icons mr-1">refresh</i> Refresh</button>
            <button type="button" class="btn btn-light has-icon"><i class="mr-1" data-feather="paperclip"></i> Export</button> -->
          </div>
        <?php  } 
        ?>
       
          <div class="table-responsive" id="advance_table">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning">
              <!-- Filter columns -->
              <thead class="thead-primary">               
                <tr>
                  <th scope="col"><?php echo lang('SNO');?></th>
                  <th scope="col"><?php echo lang('employee');?></th>
                  <th scope="col"><?php echo lang('date_of_request');?></th>
                  <th scope="col">Purpose</th>
                  <th scope="col"><?php echo lang('amount_request');?></th>
                  <th scope="col"><?php echo lang('Amount_paid');?></th>
                  <th scope="col">Balance Amount</th>
                  <th scope="col">Purpose</th>
                  <th scope="col"><?php echo lang('payment_date');?></th>
                  <th scope="col">Status</th>
                  <th scope="col">View Transactions</th>
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
                    <td><?php echo (($value->requested_date)? (date('d-M-Y', strtotime($value->requested_date))):" - "); ?></td>
                    <td><?php echo $value->requested_purpose; ?></td>
                    <td><?php echo $value->requested_amount; ?></td>
                    <td><?php echo $value->paid_amount; ?></td>
                    <td><?php echo getBalanceAmountEmpId($value->emp_id); ?></td>
                    <td><?php echo $value->requested_purpose; ?></td>
                    <td><?php echo (($value->payment_date != '0000-00-00')? (date('d-M-Y', strtotime($value->payment_date))):" - "); ?></td>
                    <td><?php if($value->paid_status == 'n'){ 
                        echo "Not Paid"; 
                    }else if($value->paid_status == 'y'){
                        echo "Paid";
                    }else if($value->paid_status == 'r'){
                        echo "Rejected";
                    } ?></td>
                    <td class="text-center"><a href="#detailRow<?php echo $i; ?>" class="detail-toggle text-secondary" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="detailRow<?php echo $i; ?>"></a></td>
                     <?php
                    if($this->session->userdata('user_role') == '1'){
                    ?>
                    <td width="10%" class="text-center">
                        <?php if($value->paid_status == 'n'){ ?>
                      <div class="btn-group btn-group-xs modalMainBtn" role="group">
                      <a href="#" class="btn btn-link btn-icon bigger-130 text-success" data-toggle="modal" data-target="#exampleModal" data-mainId="<?=$value->advance_request_id?>" data-requestedAmount="<?=$value->requested_amount?>" >Pay</a>&nbsp;&nbsp;
                      / &nbsp;
                      <a href="<?php echo base_url(); ?>AdvanceRequests/rejectRequest/<?php echo $value->advance_request_id ?>" class="btn btn-link btn-icon bigger-130 text-success" data-mainId="<?=$value->advance_request_id?>" data-requestedAmount="<?=$value->requested_amount?>" >Reject</a>
                      </div>
                      <?php } ?>
                    </td>
                    <?php } ?>
                  </tr>
                  <tr class="detail-row collapse" id="detailRow<?php echo $i; ?>">
                    <td colspan="9">
                        <?php $paymentHistory = getAdvancePaymentHistory($value->advance_request_id);
                       // print_r($paymentHistory);
                        if(!empty($paymentHistory)) { ?>
                      <ul class="data-detail ml-5">
                         <?php foreach($paymentHistory as $phistory){ ?>
                        <li><span>Payment Date :</span>&ensp;<span><?php echo Date('d-M-Y',strtotime($phistory->payment_date)); ?></span>&ensp;<span>| <strong>Paid Amount : </strong></span>&ensp;<span><?php echo $phistory->paid_amount; ?></span>| <strong>Payment Receipt : </strong></span>&ensp;<span><a href="<?php echo assets_url(); ?>advance_request/payment_receipt/<?php echo $phistory->payment_receipt; ?>" class="text-secondary"><i class="mr-2 icon-inline" data-feather="download"></i></a></span>  
</li>
                        <?php } ?>
                        
                                            
                      </ul>
                      <?php } ?>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <form action="<?php echo base_url().'AdvanceRequests/updateApproveAmount'; ?>" name="updateApproveAmount_submit" id="updateApproveAmount_submit" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <fieldset class="form-fieldset">
            <legend>Amount Requests: <span id="amountRequest"></span></legend>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="amount_paid">Amount paid </label>
                <input type="number" class="form-control" name="amount_paid" id="amount_paid" placeholder=" Amount Paid" value="">
                <span class="small" id="amount_paid_error" style="color:red;"></span> 
              </div>
              <div class="form-group col-sm-6">
                <label for="payment_date">Payment Date</label>
                <input type="text"  class="form-control datepicker-input form-control"  name="payment_date" id="payment_date" placeholder="Payment Date" value="">
                <span class="small" id="payment_date_error" style="color:red;"></span>
              </div>
              <div class="form-group col-sm-6">
                <label for="payment_receipt">Payment Receipt</label>
                <input type="file" class="form-control" name="payment_receipt" id="payment_receipt">
                <span class="small" id="payment_receipt_error" style="color:red;"></span>
              </div>
              <input type="hidden" name="mainModelId" id="mainModelId">
          </div>
          </fieldset>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="receivesubmit">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
  <!-- Main Scripts -->
  <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.js"></script>

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
      flatpickr('.datepicker-input', {
        allowInput: true
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


    $(".modalMainBtn").on('click','a',function(e){
      var t = $(this);
      $("#amountRequest").html($(this).attr('data-requestedAmount'));
      $("#mainModelId").val($(this).attr('data-mainId'));
      
    });

     $("#updateApproveAmount_submit").on("submit",function(){
        var amount_paid = $("#amount_paid").val();
        var payment_date = $("#payment_date").val();
        var payment_receipt = $("#payment_receipt").val();

       
        if(amount_paid == ''){
          $("#amount_paid_error").html("Amount Paid Required");
          $("#amount_paid").focus();
          return false;
        }else{
          $("#amount_error").html("");
        }
        if(payment_date == ''){
          $("#payment_date_error").html("Payment Date Required");
          $("#payment_date").focus();
          return false;
        }else{
          $("#payment_date_error").html("");
        }
        if(payment_receipt == ''){
          $("#payment_receipt_error").html("Payment Receipt Required");
          $("#payment_receipt").focus();
          return false;
        }else{
          $("#payment_date_error").html("");
        }
        $("#receivesubmit").hide();
        
      });
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

$("#employee_id").on('change',function() {
    var employee_id = $(this).val();
    window.location.href="<?php echo base_url().'AdvanceRequests/'; ?>"+employee_id;
});


</script>

</body>
</html>