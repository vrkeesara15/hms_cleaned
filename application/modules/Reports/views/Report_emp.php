
 <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
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
            <form action="<?php echo base_url(); ?>Reports/searchFiltersEmp" name="searchFilters" id="searchFilters" method="post" enctype="multipart/form-data">

              <div class="row">
                  <?php
                    if($this->session->userdata('user_role') == '1' || $this->session->userdata('user_role') == '2') { 
                         ?>
                            <div class="col-md-3">
                                <label>Employee</label>
                              <select name="employee_id[]" class="form-control custom-select" id="employee_id" multiple>
                                  <option value="">Employee</option>
                                  <?php foreach ($emp_details as $key => $value) { 
                                       if(!empty($employee_id)){
                                            $employees = explode(",", $employee_id);
                                       }else{
                                            $employees = array();
                                       }
                               if($value->id != 1) {
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
                              <select name="employee_id" class="form-control d-none" id="employee_id">
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
                  <th scope="col">Bank Name</th>
                  <th scope="col">Branch Name</th>
                  <th scope="col">Recovery Amount</th>
                  
                  <th scope="col">Received Amount</th>
                  <th scope="col">Expenses Amount</th>
                  <th scope="col">Net Amount Pay</th>
                  <th scope="col">Paid Amount</th>
                  <th scope="col">Paid Date</th>
                  
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
                  <th scope="col">Bank Name</th>
                  <th scope="col">Branch Name</th>
                  <th scope="col">Recovery Amount</th>
                  
                  <th scope="col">Received Amount</th>
                  <th scope="col">Expenses Amount</th>
                  <th scope="col">Net Amount Pay</th>
                  <th scope="col">Paid From Adv</th>
                  <th scope="col">Paid Date</th>
                  
                  
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
                 
                  <?php $branchDetails = getBranchDetails($value->branch_id); ?>
                  
                  <td><?php echo $branchDetails->bank_name;; ?></td>
                  <td><?php echo $branchDetails->branch_name; ?></td>
                  <!--<td><?php //echo $value->account; ?></td>-->
                  <td><?php echo $value->recovered_amt; ?></td>
                  
                  <td><?php echo $value->received_amount; ?></td>
                  <td><?php echo $value->expenses_amount; ?></td>
                  <td><?php echo $value->net_amount_pay; ?></td>
                  <td><?php echo $value->paid_amount; ?></td>
                  <td><?php echo $value->payment_date; ?></td>
                  
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
      

<?php if(!empty($loan_type_id)) { ?>
$("#loan_type_id").trigger('change');
<?php } ?>
<?php if(!empty($bank_id)) { ?>
$("#bank_id").trigger('change');
<?php } ?>
  </script>

</body>

</html>