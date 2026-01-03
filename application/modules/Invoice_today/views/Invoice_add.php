<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
    <!-- Main body -->
    <div class="main-body">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Invoice">Invoices</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Invoice</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
      <div class="row">
        <div class="col">
         
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url(); ?>Invoice/insertInvoice" name="invoice_submit" id="invoice_submit" method="post" enctype="multipart/form-data">
                  <fieldset class="form-fieldset">
                    <legend>Loan  Account Info</legend>
                   
                    <div class="row mb-3">                      
                      
                    <div class="col-sm-3">
                    <label>Select Loan Type:</label>
                    <select class="custom-select" id="loan_type_id" name="loan_type_id">
                    <option value='' selected>Select Loan Type</option>
                    <option value="1" <?php if($action == 'edit'){  if($invoiceData->loan_type_id == '1'){ echo "selected"; }  } ?>>Car Loans</option>
                    <option value="2" <?php if($action == 'edit'){  if($invoiceData->loan_type_id =='2'){ echo "selected"; }  } ?>>Personal Loans</option>   
                    <option value="3" <?php if($action == 'edit'){  if($invoiceData->loan_type_id =='3'){ echo "selected"; }  } ?>>Education Loans</option>   
                    <option value="4" <?php if($action == 'edit'){  if($invoiceData->loan_type_id =='4'){ echo "selected"; }  } ?>>AUCA Loans</option>    
                    <!-- <option value="5" <?php if($action == 'edit'){  if($invoiceData->loan_type_id =='5'){ echo "selected"; }  } ?>>Home Loans/Surface Loans</option>                -->   
                    </select>
                    <span class="small" id="loan_type_error" style="color:red;"></span>
                    </div>

                      <div class="col-sm-3" style="display:none" id="workorder_id">
                        <label>Select Work Order :</label>
                        <select class="custom-select" id="order_id" name="order_id">
                           <option value='' selected>Select Work Order</option>
                          <?php foreach ($workorders as $loan) { ?>
                            <option value="<?php echo $loan->order_id;?>"  
                              <?php if($action == 'edit'){ if($loan->order_id == $invoiceData->order_id)
                              { echo "selected"; } } ?> >
                              <?php echo $loan->work_order_num;?></option>
                          <?php  } ?>
                        </select>
                       <span class="small" id="order_id_error" style="color:red;"></span>
                      </div>
                      
                       <div class="col-sm-3">
                      <label>Invoice Type:</label>
                      <select class="custom-select" id="invoice_type" name="invoice_type">
                      <option value='' selected>Select Type Of Invoice</option>
                      <option value="1" <?php if($action == 'edit'){  if($invoiceData->invoice_type == '1'){ echo "selected"; }  } ?>>Notice Charges</option>
                      <option value="2" <?php if($action == 'edit'){  if($invoiceData->invoice_type =='2'){ echo "selected"; }  } ?>>Invoice</option>                    
                      </select>
                      <span class="small" id="invoice_type_error" style="color:red;"></span>
                      </div>
                     
                      <div class="col-sm-3">
                        <label>Select Loan Account:</label>
                        <select class="custom-select" id="loan_id" name="loan_id">
                          <?php
                          if($action == 'edit'){ foreach ($loanaccounts as $loan) {
                             ?>
                            <option value="<?php echo $loan->loan_id;?>"  
                              <?php if($loan->loan_id == $invoiceData->loan_id)
                              { echo "selected"; } ?> >
                              <?php echo $loan->barrower_name;?>_<?php echo $loan->loan_ac_number;?></option>
                          <?php } } ?>
                        </select>
                        <span class="small" id="loan_id_error" style="color:red;"></span>
                      </div>
                      <div class="col-sm-4">
                        <label>Date:</label>
                          <input type="text" class="form-control datepicker-input form-control-sm" autocomplete="off" placeholder="Date" name="bill_date" id="bill_date" value="<?php if($action == 'edit'){ echo $invoiceData->bill_date; } ?>">
                         <span class="small" id="bill_date_error" style="color:red;"></span> 
                      </div>
                    </div>

                   
                    <div class="row">                     
                      <div class="col-sm-4">
                        <label>GST NO:</label>
                          <input type="text" class="form-control form-control-sm" name="gst_no" placeholder="GST No" id="gst_no" value="<?php if($action == 'edit'){ echo $invoiceData->gst_no; } ?>" readonly>
                            <span class="small" id="gst_no_error" style="color:red;"></span> 
                      </div>
                      <div class="col-sm-4">
                        <label>Vendor Id:</label>
                          <input type="text" class="form-control form-control-sm" name="vendor_no" placeholder="Vendor Id" id="vendor_no" value="<?php if($action == 'edit'){ echo $invoiceData->vendor_no; } ?>" readonly>
                            <span class="small" id="vendor_no_error" style="color:red;"></span> 
                      </div>
                      <div class="col-sm-4">
                        <label>Account:</label>
                          <input type="text" class="form-control form-control-sm" name="account" placeholder="Input box" id="account" value="<?php if($action == 'edit'){ echo $invoiceData->account; } ?> " readonly>
                          <span class="small" id="account_error" style="color:red;"></span> 
                      </div>
                    </div>
                
                  </fieldset>
                  <fieldset class="form-fieldset" id="pcharges" style="display:none;">
                    <legend>Parking Days</legend>
                   
                    <div class="row">                     
                      <div class="col-sm-4">
                        <label>Start Date:</label>
                            <span class="small" id="Sez_date">s</span> 
                      </div>
                      <div class="col-sm-4">
                        <label>End Date:</label><span class="small" id="rel_date"></span> 
                      </div>
                         <div class="col-sm-4">
                        <label>No Of Days:</label><span class="small" id="days">12 Days</span> 
                      </div>
                    </div>
                
                  </fieldset>
                  <fieldset class="form-fieldset">
                    <legend>Invoice Data</legend>
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                          <table class="table table-bordered table-sm" id="dTable" >
                            <thead>
                              <tr>
                                <th>S.NO</th>
                                <th class="text-center">Details</th>
                                <th class="text-center">Recovered Amt</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Commission Charges</th>
                                <th class="text-center">GST %</th>
                                <th class="text-center">GST Amount</th>
                                <th class="text-center">Total</th>                                                    
                              </tr>
                            </thead>
                              <tbody>
                                <?php $i = 1; ?>
                              <?php if($action == 'add'){ ?>
                              <tr id="row_<?php echo $i;?>">
                              <td width="20"><?php echo $i;?></td>
                              <td><input type="text" name="borrower_name<?php echo $i ?>" id="borrower_name<?php echo $i ?>" class="form-control form-control-sm" placeholder="Enter Details" value=""  /><span class="small" id="borrower_name<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="130"><input type="text" name="recovered_amt<?php echo $i ?>" id="recovered_amt<?php echo $i ?>" class="form-control form-control-sm" placeholder="Recovered Amount" value=""  onchange="amountCal(this,<?php echo $i;?>)"/><span class="small" id="recovered_amt<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="130"><input type="text" name="date<?php echo $i ?>" id="date<?php echo $i ?>" class="form-control form-control-sm datepicker-input" placeholder="Date" value=""  /><span class="small" id="date<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="130"><input type="text" name="commission_charges<?php echo $i ?>" id="commission_charges<?php echo $i ?>" class="form-control form-control-sm" placeholder="Commission Charges" value=""  onchange="amountCal(this,<?php echo $i;?>)"/><span class="small" id="commission_charges<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="100"><input type="text" name="gst_p<?php echo $i ?>" id="gst_p<?php echo $i ?>" class="form-control form-control-sm" placeholder="GST" value="0" onchange="amountCal(this,<?php echo $i;?>)"/></td>
                              <td width="100"><input type="text" name="gstamount<?php echo $i ?>" id="gstamount<?php echo $i ?>" class="form-control form-control-sm" placeholder="GST" value="0" readonly /></td>
                                   <td width="130"><input type="text" name="total_amount<?php echo $i ?>" id="total_amount<?php echo $i ?>" class="form-control form-control-sm" placeholder="Total" value="0" readonly /></td>
                          </tr>
                        <?php }else{ 
                          $serviceCount = count($invoiceServices);
                          $subtotal =0;
                          $gstTotal =0;
                          $grandTotal =0;
                          foreach ($invoiceServices as $serviceData) {
                             $subtotal += ($serviceData->recovered_amt+$serviceData->commission_charges);
                              $gstTotal += $serviceData->gst;
                              $grandTotal += $serviceData->total;
                           
                          ?>
                          <tr id="row_<?php echo $i;?>">
                              <td width="20"><?php echo $i;?></td>
                              <td><input type="text" name="borrower_name<?php echo $i ?>" id="borrower_name<?php echo $i ?>" class="form-control form-control-sm" placeholder="Enter Borrower Name" value="<?php echo $serviceData->borrower_name; ?>"  /><span class="small" id="borrower_name<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="130"><input type="text" name="recovered_amt<?php echo $i ?>" id="recovered_amt<?php echo $i ?>" class="form-control form-control-sm" placeholder="Recovered Amount" value="<?php echo $serviceData->recovered_amt; ?>"  onchange="amountCal(this,<?php echo $i;?>)"/><span class="small" id="recovered_amt<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="130"><input type="text" name="date<?php echo $i ?>" id="date<?php echo $i ?>" class="form-control form-control-sm datepicker-input" placeholder="Date" 
                                value="<?php if($serviceData->date !='0000-00-00') {echo $serviceData->date; } ?>"

                                  /><span class="small" id="date<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="130"><input type="text" name="commission_charges<?php echo $i ?>" id="commission_charges<?php echo $i ?>" class="form-control form-control-sm" placeholder="Commission Charges" value="<?php echo $serviceData->commission_charges; ?>"  onchange="amountCal(this,<?php echo $i;?>)"/><span class="small" id="commission_charges<?php echo $i ?>_error" style="color:red;"></span></td>
                              <td width="100"><input type="text" name="gst_p<?php echo $i ?>" id="gst_p<?php echo $i ?>" class="form-control form-control-sm" placeholder="GST" value="<?php echo $serviceData->gst_p; ?>" onchange="amountCal(this,<?php echo $i;?>)"/></td>
                                  <td width="100"><input type="text" name="gstamount<?php echo $i ?>" id="gstamount<?php echo $i ?>" class="form-control form-control-sm" placeholder="GST" value="<?php echo $serviceData->gst; ?>" readonly /></td>
                                   <td width="130"><input type="text" name="total_amount<?php echo $i ?>" id="total_amount<?php echo $i ?>" class="form-control form-control-sm" placeholder="Total" value="<?php echo $serviceData->total; ?>" readonly /></td>
                          </tr>
                        <?php $i++; } } ?>
                          
                                 </tbody>
                        
                          </table>
                          <table class="table table-sm">
                            <thead>
                            <tr>
                              <th></th>
                              <th>Total Commission Amount</th>
                              <th>Total GST Amount</th>
                              <th>Grand Total</th>
                            </tr>
                            </thead>
                                <tbody>
                                <tr>
                                <td style="width: 70%" align="right" ></td>
                                <td align="right"><div style="float: right;" width="100">
                                  <input type="text" placeholder="Amount" name="tprice" id="tprice" value="<?php if($action == 'edit'){ echo $subtotal;  }else { echo '0';} ?>" class="form-control form-control-sm" readonly>
                                </td>
                                <td align="right"><div style="float: right;" width="80">
                                  <input type="text" placeholder="GST" name="gstTotalAmount" id="gstTotalAmount" value="<?php if($action == 'edit'){ echo $gstTotal;  } else { echo '0';} ?>" class="form-control form-control-sm" readonly>
                                </td>
                                <td align="right"><div style="float: right;" width="130">
                                  <input type="text" placeholder="Total" name="gtprice" id="gtprice" value="<?php if($action == 'edit'){ echo $grandTotal;  } else { echo '0';}  ?>" class="form-control form-control-sm" readonly>
                                </td>
                              </tr>
                              <tr><td colspan="4"> <span id="wordamount" class="text-muted font-size-sm"></span></td></tr>
                              <tr>
                                <td colspan="4">
                                  <button type="button" tabindex="-1" class="btn btn-primary btn-sm" id="addButton"><i class="fa fa-plus"></i></button>
                                  <button type="button" tabindex="-1" class="btn btn-danger btn-sm" id="removeButton"><i class="fa fa-minus"></i></button>
                                </td>
                                
                              </tr>
                              <input type="hidden" name="totalrows" id="totalrows" value="<?php if($action =='edit'){echo $serviceCount; }else{ echo 1; } ?>">
                              <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                              <input type="hidden" name="invoice_id" value="<?php if($action== 'edit'){ echo $invoiceData->id; } ?>">
                            </tbody>
                          </table>
                         
                        </div>
                      </div>
                    
                  </fieldset>
                  <div id="bankcharges">
           
        </div>
                  
                  <button class="btn btn-secondary" type="reset">Reset</button>
                  <button class="btn btn-primary" type="submit">Save</button>
                </form>
              </div>
            </div>
          </section>
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
  <!-- <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->
  <!-- Plugins -->
    <script src="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.js"></script>
  <script>
    $(() => {
      $('.summernote').summernote()
       $('.summernote-air').summernote({
        airMode: true
      })
        // Allow Input
      flatpickr('.datepicker-input', {
        allowInput: true
      })
    })
  </script>
  <!-- JS plugins goes here -->
  <script type="text/javascript">
   $("#addButton").click(function () {
    var limitRows = 10;
    var presentRows = $("#totalrows").val();
      if(presentRows < limitRows){
        var presentRow = parseInt(presentRows)+1;
        $("#totalrows").val(presentRow);
        var newTr = $('<tr></tr>').attr("id", "row_"+presentRow);
        //<span class="small" id="borrower_name<?php echo $i ?>_error" style="color:red;"></span>
        newTr.html("<td width='20'>"+presentRow+"</td><td><input type='text' name='borrower_name"+presentRow+"' id='borrower_name"+presentRow+"' class='form-control form-control-sm' placeholder='Enter Details' value=''  /><span id='borrower_name"+presentRow+"_error' class='small' style='color:red'></span></td><td width='130'><input type='text' name='recovered_amt"+presentRow+"' id='recovered_amt"+presentRow+"' class='form-control form-control-sm' placeholder='Recovered Amount' value='' onchange='amountCal(this,"+presentRow+")'/><span id='recovered_amt"+presentRow+"_error' class='small' style='color:red'></span></td><td width='130'><input type='text' name='date"+presentRow+"' id='date"+presentRow+"' class='form-control form-control-sm datepicker-input' placeholder='Date' value=''  /><span id='date"+presentRow+"_error' class='small' style='color:red'></span></td><td width='130'><input type='text' name='commission_charges"+presentRow+"' id='commission_charges"+presentRow+"' class='form-control form-control-sm' placeholder='Commission Charges' value='' onchange='amountCal(this,"+presentRow+")'  /><span id='commission_charges"+presentRow+"_error' class='small' style='color:red'></span></td><td width='100'><input type='text' name='gst_p"+presentRow+"' id='gst_p"+presentRow+"' class='form-control form-control-sm' placeholder='GST' value='0' onchange='amountCal(this,"+presentRow+")' /></td><td width='100'><input type='text' name='gstamount"+presentRow+"' id='gstamount"+presentRow+"' class='form-control form-control-sm' placeholder='GST' value='0' readonly /></td><td width='130'><input type='text' name='total_amount"+presentRow+"' id='total_amount"+presentRow+"' class='form-control form-control-sm' placeholder='Total' value='0' readonly /></td>");
         newTr.appendTo("#dTable"); 
         flatpickr('.datepicker-input', {
          allowInput: true
        })       
 }else {
        alert("Limit Only 10 Rows");
        return false;
    }
});
   $("#removeButton").click(function () {
    var limitRows = 1;
    var presentRows =  $("#totalrows").val();
    var presentRow = parseInt(presentRows);
      if(presentRow <=1){
          alert("At Least Keep One Row ");
          return false;
      } else {            
          $("#row_"+presentRow).remove();   
          $("#totalrows").val(presentRow-1);    
      }
    });

   
   $("#loan_type_id").on('change',function(){
    console.log("coming here");
      var loan_type_id = document.getElementById("loan_type_id").value;
      console.log(loan_type_id);
      if(loan_type_id !='1'){
        $("#workorder_id").attr("style", "display:none");
       // $("#pcharges").attr("style", "display:none");
        
      }else {
        $("#workorder_id").attr("style", "display:block");
        //$("#pcharges").attr("style", "display:block");
      }      
      
    });
   $("#gtprice").on('change',function(){
      var tprice = document.getElementById("gtprice").value;
      var wordAmount = convertNumberToWords(tprice);
      //  alert(wordAmount);
      $('#wordamount').text(wordAmount);
    });
   function convertNumberToWords(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    return words_string+' Rupees Only';
}
function amountCal(a,id) {     
       
        var totalRows = document.getElementById("totalrows").value;     
        var total = 0;
        var gstTotal =0;
        var gst =18; 
        var amount=0;
         var gstAmount =0;
         var gstHsn =0;
        var commission_charges=0;
        var gstp = 0;
        var recovered_amt=0;
        for(i=1; i<=totalRows; i++){   
              recovered_amt = parseInt(document.getElementById("recovered_amt"+i).value); 
              gstp = parseInt(document.getElementById("gst_p"+i).value); 
              commission_charges = parseInt(document.getElementById("commission_charges"+i).value); 
              if(commission_charges) {
                amount = parseInt(commission_charges);
              } else {
                amount = parseInt(0);
              }

              if(gstp == '0'){
                gstAmount = 0;
              }else {
                gstAmount = (amount/100)*gstp;
              }
              
              
              document.getElementById("gstamount"+i).value  = gstAmount;
              document.getElementById("total_amount"+i).value = amount+gstAmount;
              total+= amount;
              gstTotal+= gstAmount;
          }
        document.getElementById("tprice").value = total;
        document.getElementById("gstTotalAmount").value = gstTotal;
        document.getElementById("gtprice").value = gstTotal+total;
        $("#gtprice").trigger("change");
}

    $("#order_id").on("change",function(){
     var order_id = $(this).val();
     
     $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getBankCharges",
        data: 'order_id='+order_id,
        type: "POST",  
        success:function(data){ 
           $("#bankcharges").html(data);   
                     
        }
    });
   
    });


  $("#invoice_type").on("change",function(){

     var invoice_type = $(this).val();
     var order_id = $("#order_id").val();
     var loan_type_id = $("#loan_type_id").val();
     
     // alert(loan_type_id);
     if(loan_type_id == '1'){
     $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getLoanaccounts",
        data: 'invoice_type='+invoice_type+'&order_id='+order_id,
        type: "POST",  
        success:function(data){ 
            var htmlString ='';
            htmlString+="<option value=''>Select Loan Account</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['loan_id']+">"+data[i]['barrower_name']+"_"+data[i]['loan_ac_number']+"</option>"
            });
            $("#loan_id").html(htmlString);            
        }
    });
   }else {
         $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getLoanaccounts_loans",
        data: 'invoice_type='+invoice_type+'&loan_type_id='+loan_type_id,
        type: "POST",  
        success:function(data){ 
            var htmlString ='';
            htmlString+="<option value=''>Select Loan Account</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['loan_id']+">"+data[i]['barrower_name']+"_"+data[i]['loan_ac_number']+"</option>"
            });
            $("#loan_id").html(htmlString);            
        }
    });
   }
   
    });

    $("#loan_id").on("change",function(){          
     var loan_id = $(this).val();
     $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getLoanaccountsDetails",
        data: {loan_id: loan_id },  
        type: "POST",  
        success:function(data){ 
          $('#account').attr('value', data['loan_ac_number']);
          $('#gst_no').attr('value', data['gst_no']).change();
          var status = data['status'];          
          if( data['status'] == 'rel' ||  data['status'] =='a'){
          $.ajax({  
          url:"<?php echo base_url(); ?>Invoice/getParkingDays",
          data: 'loan_id='+loan_id+'&status='+status, 
          type: "POST",  
          success:function(data1){ 
              $("#pcharges").attr("style", "display:block");
              $("#days").text(data1['days'] );
               $("#Sez_date").text(data1['sdate'] );
                $("#rel_date").text(data1['rdate'] );
          }
        });
         }

          
          
             
          }
    });
   
    });

     $("#gst_no").on("change",function(){  
       var loan_id = $("#loan_id").val();
      $.ajax({  
        url:"<?php echo base_url(); ?>Invoice/getVendorId",
        data: {loan_id: loan_id },  
        type: "POST",  
        success:function(data){ 
          $('#vendor_no').attr('value', data['vendor_no']);
          }
    });
     });


$("#invoice_submit").on("submit",function(){
  var order_id = $("#order_id").val();
  var loan_type_id = $("#loan_type_id").val();
  var invoice_type = $("#invoice_type").val();
  var loan_id = $("#loan_id").val();
  var bill_date = $("#bill_date").val();
  var gst_no = $("#gst_no").val();
  var account = $("#account").val();
  var totalrows = $("#totalrows").val();

  //var loan_type_id = $("#loan_type_id").val();


  if(loan_type_error == ''){
    $("#loan_type_error_error").html("Select Loan Type");
    $("#loan_type_error").focus();
    return false;
  }else{
    $("#loan_type_error_error").html("");
  }

if(loan_type_id == '1'){

  if(order_id == ''){
    $("#order_id_error").html("Select Work Order Is Required");
    $("#order_id").focus();
    return false;
  }else{
    $("#order_id_error").html("");
  }
}

  if(invoice_type == ''){
    $("#invoice_type_error").html("Invoice Type Required");
    $("#invoice_type").focus();
    return false;
  }else{
    $("#invoice_type_error").html("");
  }

  if(loan_id == ''){
    $("#loan_id_error").html("Loan Acount Required");
    $("#loan_id").focus();
    return false;
  }else{
    $("#loan_id_error").html("");
  }
  if(bill_date == ''){
    $("#bill_date_error").html("Bill Date Required");
    $("#bill_date").focus();
    return false;
  }else{
    $("#bill_date_error").html("");
  }
  
  if(gst_no == ''){
    $("#gst_no_error").html("GST No Required");
    $("#gst_no").focus();
    return false;
  }else{
    $("#gst_no_error").html("");
  }
  if(account == ''){
    $("#account_error").html("Account No Required");
    $("#account").focus();
    return false;
  }else{
    $("#account_error").html("");
  }
  var borrower_name = "";
  var recovered_amt = "";
  var date_b = "";
  var commission_charges = "";

  for(i=1;i<=totalrows;i++){
    borrower_name = $("#borrower_name"+i).val();
    recovered_amt = $("#recovered_amt"+i).val();
    date_b = $("#date"+i).val();
    commission_charges = $("#commission_charges"+i).val();
    if(borrower_name == ''){
      $("#borrower_name"+i+"_error").html("Details Is  Required");
      $("#borrower_name").focus();
      return false;
    }else{
      $("#borrower_name"+i+"_error").html("");
    }
    

  }
  
});

</script>
</body>
</html>