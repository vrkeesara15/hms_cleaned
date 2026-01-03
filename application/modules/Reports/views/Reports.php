
 <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
 <!-- Add these lines to your HTML <head> section -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


 
  <div id="ajaxdata">
 <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Manage Reports</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <h5>Manage Reports</h5>

      <div class="card">
        <div class="card-body">
          <!-- Toolbar --> 
            <form action="<?php echo base_url(); ?>Reports/searchFilters" name="searchFilters" id="searchFilters" method="post" enctype="multipart/form-data">

              <div class="row">
                  <div class="col-md-2">
                      <label>Loan Type</label>
                      <select name="loan_type_id" class="form-control" id="loan_type_id">
                          <option value="">Loan Type</option>
                          <?php $i=1; foreach ($loantypes as $key => $value) { ?>
                      <option value="<?php echo $value->type_id; ?>" <?php echo (($loan_type_id == $value->type_id)?'selected':''); ?>><?php echo $value->type_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2">
                      <label>Invoice Type</label>
                      <select name="invoice_type" class="form-control" id="invoice_type">
                          <option value="" selected="">Invoice Type</option>
                          <option value="1" <?php echo (($invoice_type == 1)?'selected':''); ?>>Notice Charges</option>
                          <option value="2" <?php echo (($invoice_type == 2)?'selected':''); ?>>Invoice</option>   
                          <option value="3" <?php echo (($invoice_type == 3)?'selected':''); ?>>Expenses</option>  
                    </select>
                  </div>
                  <div class="col-md-2 d-none" id="recoveryTypeMain">
                      <label>Recovery Type</label>
                      <select name="recovery_type" class="form-control" id="recovery_type">
                          <option value="" selected="">Recovery Type</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                      <label>Bank Name</label>
                      <select name="bank_id" class="form-control" id="bank_id">
                          <option value="">Bank Name</option>
                          <?php foreach ($allBanks as $key => $value) { ?>
                      <option value="<?php echo $value->bank_id; ?>" <?php echo (($bank_id == $value->bank_id)?'selected':''); ?>><?php echo $value->bank_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2">
                      <label>Branch Name</label>
                     <select name="branch_id" class="form-control" id="branch_id">
                          <option value="">Branch Name</option>
                    </select>
                  </div>
                  <?php
                    if($this->session->userdata('user_role') == '1' || $this->session->userdata('user_role') == '2') { 
                         ?>
                            <div class="col-md-3">
                                <label>Employee</label>
                              <select name="employee_id[]" class="form-control custom-select" id="employee_id" multiple>
                                  <option value="">Employee</option>
                                  <?php foreach ($emp_details as $key => $value) { 
                               if($value->id != 1) {
                                   if(!empty($employee_id)){
                                        $employees = explode(",", $employee_id);
                                   }else{
                                        $employees = array();
                                   }
                                  ?>
                                    <option value="<?php echo $value->id; ?>" <?php echo (in_array( $value->id, $employees)?'selected':''); ?>><?php echo $value->fname.' '.$value->lname; ?></option>
                                  <?php }
                               } ?>
                            </select>
                          </div>
                        <?php
                    } else {
                        $empid = $this->session->userdata('emp_id'); 
                        ?>
                            <div class="col-md-3">
                                <label>Employee</label>
                              <select name="employee_id[]" class="form-control d-none" id="employee_id" multiple>
                                  <option value="">Employee</option>
                                  <?php foreach ($emp_details as $key => $value) { 
                               if($value->id == $empid) {
                                  ?>
                                    <option value="<?php echo $value->id; ?>" <?php echo ((($employee_id == $value->id) || ($employee_id == $empid))?'selected':''); ?>><?php echo $value->fname.' '.$value->lname; ?></option>
                                  <?php }
                               } ?>
                            </select>
                          </div>
                        <?php
                    }
                   ?>
                  
                      
                  <div class="col-sm-4">
                      <label>Start Date</label>
                        <input type="text" class="form-control datepicker-input form-control" autocomplete="off" placeholder="Start Date" name="start_date" id="start_date" value="<?php echo $start_date; ?>">
                        <span class="small" id="start_date_error" style="color:red;"></span> 
                    </div>
                    <div class="col-sm-4">
                        <label>End Date</label>
                        <input type="text" class="form-control datepicker-input1 form-control" autocomplete="off" placeholder="End Date" name="end_date" id="end_date" value="<?php echo $end_date; ?>">
                        <span class="small" id="end_date_error" style="color:red;"></span> 
                    </div>
                  <div class="col-md-2 mt-2">
                      <input type="submit" name="submit" id="submit" class="btn btn-primary mt-4" value="GO" />
                  </div>
              </div>
              </form>
            <br />
            <?php if($display != 'No') { 
            if(empty($details)) { ?>
                    <div class="table-responsive">
                         <thead class="thead-primary">
               <table class="table table-bordered table-sm">
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Invocie ID</th>
                  <th scope="col">Loan Account No</th>
                  <th scope="col">Borrower Name</th>
                  <th scope="col">Bank Name</th>
                  <th scope="col">Branch Name</th>
                  <!--<th scope="col">Account No</th>-->
                  <th scope="col">Recovery Amount</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Received Date</th>
                  <th scope="col">Created By</th>
                </tr>
              </thead>

              <tbody>
                        <tr><td colspan="7" class='text-center'>No Data found</td></tr>
                        </tbody></table>
                    </div>
            <?php } else { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-sm has-checkAll mb-0" data-bulk-target="#bulk-dropdown" data-checked-class="table-warning" id="example">
              <!-- Filter columns -->
              <thead class="thead-primary">
               
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Invocie ID</th>
                  <th scope="col">Loan Account No</th>
                  <th scope="col">Borrower Name</th>
                  <th scope="col">Bank Name</th>
                  <th scope="col">Branch Name</th>
                  <!--<th scope="col">Account No</th>-->
                  <th scope="col">Recovery Amount</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Received Date</th>
                  <th scope="col">Created By</th>
                </tr>
              </thead>

              <tbody>
                <?php if(!empty($details)) { ?>
                <?php $i=1; foreach ($details as $key => $value) { ?>
               
                <tr id="row_<?php echo $value->id;?>">
                 <td><?php echo $i; ?></td>
                  <td><a href="<?php echo base_url(); ?>Invoice/invoice_view/<?php echo $value->id; ?>">#<?php echo $value->id; ?></a></td>
                  <td><?php echo $value->account; ?></td>
                  <?php $branchDetails = getBranchDetails($value->branch_id); ?>
                  <td><?php echo ($value->barrower_name)?$value->barrower_name:$value->barrower_name; ?></td>
                  <td><?php echo $branchDetails->bank_name;; ?></td>
                  <td><?php echo $branchDetails->branch_name; ?></td>
                  <!--<td><?php //echo $value->account; ?></td>-->
                  <td><?php echo $value->total; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($value->invoice_inserted_date)); ?></td>
                  <td><?php if(!empty($value->received_date)){
                  echo date('d-m-Y', strtotime($value->received_date)); }else{ echo ''; } ?></td>
                  <td><?php echo getEmployeeName($value->invoice_inserted_by); ?></td>
                </tr>
               <?php $i++; } ?>
                <?php } else { ?>
                  <tr><td colspan="7">No Data found</td></tr>
                <?php } ?>
              </tbody>
            </table><!-- /.table -->
          </div><!-- /.table-responsive -->           
                <nav aria-label="Page navigation example">
                      <?php echo $links; ?>
                </nav>
                <?php } } ?>
        </div>
      </div>
    
    </div>
  </div>
    <!-- /Main body -->

  </div>
  <!-- /Main -->


  <!-- Main Scripts -->
  <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.js"></script>
  <!-- <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

  <!-- Plugins -->
  <script>
  
    $(() => {
        
        flatpickr('.datepicker-input', {
          /*minDate: "today",*/
        allowInput: true,
        onChange: function(dateObj, dateStr) {
           // console.info(dateObj);
           // console.info(dateStr);
            flatpickr('.datepicker-input1', {
                minDate: dateStr,
                allowInput: true
              })
        }
        
      })
          // Run datatable
      var table = $('#example').DataTable({
           "responsive": true, "lengthChange": false, "autoWidth": false,
          dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
          "columnDefs": [
      { "width": "200px", "targets": -1 } // Set the width of the last column to 200 pixels
    ],
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
      
    /*  flatpickr('.datepicker-input', {
        allowInput: true
      })*/
      
    })


    $(document).ready(function() {
        $('#employee_id').select2({
          placeholder: 'Select an employee',
          allowClear: true
        });
        
        var bank_id = $("#bank_id").val();
        var branch_id = '<?php echo $branch_id; ?>';
        if(bank_id != ''){
            $.ajax({  
                url:"<?php echo base_url(); ?>Invoice/getBranchas",
                data: {bank_id: bank_id },  
                type: "POST",  
                success:function(data){ 
                    var htmlString ='';
                    if(branch_id != ''){
                        htmlString+="<option value=''>Select Branch</option>"
                        $.each(data,function(i){
                            if(branch_id == data[i]['branch_id']){
                                htmlString+="<option value="+data[i]['branch_id']+" selected>"+data[i]['branch_name']+"</option>"
                            }else{
                                htmlString+="<option value="+data[i]['branch_id']+">"+data[i]['branch_name']+"</option>"
                            }
                        
                        });
                    }else{
                        htmlString+="<option value=''>Select Branch</option>"
                        $.each(data,function(i){
                            htmlString+="<option value="+data[i]['branch_id']+">"+data[i]['branch_name']+"</option>"
                        }); 
                    }
                    
                    $("#branch_id").html(htmlString);    
                }
            });
        }
         
        
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

    
    $("#invoice_type").on("change",function(){
        var thisVal = $(this).val();
        if(thisVal == 2){
        $("#recoveryTypeMain").addClass('d-line').removeClass('d-none');
      }else{
        $("#recoveryTypeMain").addClass('d-none').removeClass('d-line');
      }
      $("#loan_type_id").trigger('change');
    });
    $("#bank_id").on("change",function(){
     var bank_id = $(this).val();
         $.ajax({  
            url:"<?php echo base_url(); ?>Invoice/getBranchas",
            data: {bank_id: bank_id },  
            type: "POST",  
            success:function(data){ 
                var htmlString ='';
                htmlString+="<option value=''>Select Branch</option>"
                $.each(data,function(i){
                htmlString+="<option value="+data[i]['branch_id']+">"+data[i]['branch_name']+"</option>"
                });
                $("#branch_id").html(htmlString);    
            }
        });
      });
      
$("#loan_type_id").on("change",function(){
    
  var loan_type_id = $(this).val();
  var invoice_type = $("#invoice_type").val();
  if(loan_type_id == '1'  && invoice_type == '2'){
      $("#recoveryTypeMain").addClass('d-line').removeClass('d-none');
      $("#recovery_type").html("<option value='' selected>Select Recovery Type</option><option value='release' <?php echo (($recovery_type=='release')?'selected':''); ?>>Release</option><option value='auction' <?php echo (($recovery_type=='auction')?'selected':''); ?>>Auction</option><option value='recovery' <?php echo (($recovery_type=='recovery')?'selected':''); ?>>Recovery</option>");
      $("#invoice_type").trigger('change');
  } else if(loan_type_id == '5' && invoice_type == '2'){
    $("#recoveryTypeMain").addClass('d-line').removeClass('d-none');
    $("#recovery_type").html("<option value='' selected>Select Recovery Type</option><option value='13/2' <?php echo (($recovery_type=='13/2')?'selected':''); ?>>13/2</option><option value='13/4' <?php echo (($recovery_type=='13/4')?'selected':''); ?>>13/4</option><option value='nps' <?php echo (($recovery_type=='nps')?'selected':''); ?>>NPS</option>");
    $("#invoice_type").trigger('change');
  } else{
    $("#recoveryTypeMain").addClass('d-none').removeClass('d-line');
  }
    
});
<?php if(!empty($loan_type_id)) { ?>
$("#loan_type_id").trigger('change');
<?php } ?>
<?php if(!empty($bank_id)) { ?>
$("#bank_id").trigger('change');
<?php } ?>
  </script>

</body>

</html>