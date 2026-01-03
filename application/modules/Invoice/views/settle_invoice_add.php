<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
    <!-- Main body -->
    <div class="main-body">
      <!-- Breadcrumb -->
      <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warning Message</title>
    <style>
        .warning {
            background-color: #ffcc00; /* Yellow background */
            color: #000; /* Black text */
            padding: 15px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin: 20px;
            border: 2px solid #ff0000; /* Red border */
        }
    </style>
</head>
<!--<body>-->
<!--    <div class="warning">-->
<!--        Loan Account Information is pending from Contractor. Please ask Contractor to go to the loan account page and fill in the required information.-->
<!--        <br><br>-->
<!--        రుణ ఖాతా సమాచారం కాంట్రాక్టర్ నుండి పెండింగ్‌లో ఉంది. దయచేసి కాంట్రాక్టర్‌ను రుణ ఖాతా పేజీకి వెళ్లి అవసరమైన సమాచారం పూర్తి చేయమని అడగండి.-->
<!--    </div>-->
<!--</body>-->
</html>

      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Invoice">Invoices</a></li>
          <li class="breadcrumb-item active" aria-current="page">Settle Invoice</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
      <div class="row">
        <div class="col">
         
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                  <p class="text-danger text-center" id="main_error"></p>
                <form action="<?php echo base_url(); ?>Invoice/settle_insert" name="settle_contractor_submit" id="settle_contractor_submit" method="post" enctype="multipart/form-data">
                  <fieldset class="form-fieldset">
                    <legend>Settle Contractor Charges</legend>
                   
                    <div class="row mb-3">                      
                    <div class="col-sm-3">
                    <label>Received Date:</label>
                    <input type="text" class="form-control datepicker-input form-control-sm" autocomplete="off" placeholder="Received Date" name="received_date" id="received_date" value="<?php if(!empty($receiveData->received_date)){ echo $receiveData->received_date; }  ?>">
                    <span class="small" id="received_date_error" style="color:red;"></span>
                    </div>
                     
                    <div class="col-sm-2">
                    <label>Received Amount:</label>
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Received Amount" name="received_amount" id="received_amount" value="<?php if(!empty($receiveData->received_amount)){ echo $receiveData->received_amount; }  ?>" >
                    <span class="small" id="received_amount_error" style="color:red;"></span>
                    </div>
                    <div class="col-sm-2">
                    <label>TDS Amount:</label>
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="TDS Amount" name="tds_amount" id="tds_amount" value="<?php if(!empty($receiveData->tds_amount)){ echo $receiveData->tds_amount; }  ?>">
                    <span class="small" id="tds_amount_error" style="color:red;"></span>
                    </div>
                    <div class="col-sm-2">
                    <label>GST Amount:</label>
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="GST Amount" name="gst_amount" id="gst_amount" value="<?php if(!empty($receiveData->gst_amount)){ echo $receiveData->gst_amount; }  ?>">
                    <span class="small" id="gst_amount_error" style="color:red;"></span>
                    </div>
                    <div class="col-sm-3">
                    <label>Remaining Amount:</label>
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Remaining Amount" name="remaining_amount" id="remaining_amount" value="<?php echo $invoice_total_amount-($receiveData->received_amount+$receiveData->tds_amount); ?>" readonly>
                    <span class="small" id="payment_amount_error" style="color:red;"></span>
                    </div>

                    </div>
                  </fieldset>
                  <fieldset class="form-fieldset " id="second_fieldset">
                    <legend>Invoice Total Amount: <span><?=$invoice_total_amount?></span> <!-- | Received Amount: <span id="received_amount_show1">0</span> --> </legend>
                    <div class="row mb-3">   

                    <div class="col-sm-3 offset-sm-1">
                    <label>Contractor Sharing %:</label>
                    <input type="number" class="form-control form-control-sm" autocomplete="off" placeholder="Percentage" name="percentage_no" id="percentage_no" pattern="^(100|[0-9]{1,3})$" title="Enter a percentage between 0 and 100" >
                    <span class="small" id="percentage_no_error" style="color:red;"></span>
                    </div>

                    <div class="col-sm-3">
                    <label>Commissionable Amount:</label>
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Received Amount" name="commissionable_amount" id="commissionable_amount" value="" >
                    <span class="small" id="commissionable_amount_error" style="color:red;"></span>
                    </div>

                    <div class="col-sm-3">
                    <label>Expenses Amount:</label>
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Expenses Amount" name="expenses_amount" id="expenses_amount" value="">
                    <span class="small" id="expenses_amount_error" style="color:red;"></span>
                    </div>

                    
                  </div>
                    <div class="row mb-3">  
                    <div class="col-sm-3 offset-sm-1">
                    <label>Gross Contractor Charges:</label>
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Gross Contractor Charges" name="gross_contactor_charges" id="gross_contactor_charges" value="" readonly>
                    <span class="small" id="gross_contactor_charges_error" style="color:red;"></span>
                    </div>
                    <div class="col-sm-3">
                    <label>Contractor TDS Charges:</label>
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Contractor TDS Charges" name="contractor_tds_charges" id="contractor_tds_charges" value="" readonly>
                    <span class="small" id="contractor_tds_charges_error" style="color:red;"></span>
                    </div>

                    <div class="col-sm-3">
                    <label>Net Contractor Charges:</label>
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Net Contractor Charges" name="net_contactor_charges" id="net_contactor_charges" value="" readonly>
                    <span class="small" id="net_contactor_charges_error" style="color:red;"></span>
                    </div>


                    
                    </div>
                    <div class="row mb-3">  
                    <div class="col-sm-3 offset-sm-1">
                    <label>Contractor Advance Balance:</label>
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Contractor Advance Charges" name="contactor_advance_amount" id="contactor_advance_amount" value="<?=$contractorAdvanceAmount?>" readonly>
                    <span class="small" id="contactor_advance_amount_error" style="color:red;"></span>
                    </div>

                    <div class="col-sm-3">
                    <label>Pay From Advance Balance:</label>
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Payment Amount" name="payment_amount" id="payment_amount" value="">
                    <span class="small" id="payment_error" style="color:red;"></span>
                    </div>

                    <div class="col-sm-3">
                    <label>Net Payable Amount:</label>
                    <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Net Payable Amount" name="net_payable_amount" id="net_payable_amount" value="" readonly>
                    <span class="small" id="net_payable_amount_error" style="color:red;"></span>
                    </div>

                    
                    
                    
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3  offset-sm-1">
                            <label>Paid Date:</label>
                            <input type="text" class="form-control datepicker-input form-control-sm" autocomplete="off" placeholder="Paid Date" name="paid_date" id="paid_date" value="<?php if(!empty($receiveData->paid_date)){ echo $receiveData->paid_date; }  ?>">
                            <span class="small" id="paid_date_error" style="color:red;"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Paid Receipt:</label>
                            <input type="file"  autocomplete="off" placeholder="Paid Receipt" name="paid_receipt" id="paid_receipt" value="<?php if(!empty($receiveData->paid_receipt)){ echo $receiveData->paid_receipt; }  ?>">
                            <span class="small" id="paid_receipt_error" style="color:red;"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Other document:</label>
                            <input type="file"  autocomplete="off" placeholder="other document" name="other_document" id="other_document" value="<?php if(!empty($receiveData->other_document)){ echo $receiveData->other_document; }  ?>">
                            <span class="small" id="paid_other_document_error" style="color:red;"></span>
                        </div>
                        <div class="col-sm-3 offset-sm-1">
                            <label>Notes:</label>
                            <input type="text" class="form-control form-control-sm" autocomplete="off" placeholder="Notes" name="notes" id="notes" value="<?php if(!empty($receiveData->notes)){ echo $receiveData->notes; }  ?>">
                            <span class="small" id="notes_error" style="color:red;"></span>
                        </div>
                    </div>
                    
                  </fieldset>
                  <input type="hidden" name="invoice_id" value="<?=$invoice_id?>">           
                  <button class="btn btn-secondary" type="reset">Reset</button>
                  <button class="btn btn-primary" type="submit" id="settle_btn">Settle Invoice</button>
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

    var invoice_total_amount = "<?=$invoice_total_amount?>";
    var edit_flag = false;
    <?php 
    $lastMonthEnd = date("Y-m-t",strtotime(date("Y-m-t")."-1 month"));
    $lastMonthEnd = date("Y-m-d",strtotime(date($lastMonthEnd)."-5 day"));
    $curdayMonth = date("m-Y",strtotime($invoiceData->inserted_date));
    if($value->invoice_inserted_date> $lastMonthEnd || ($curdayMonth == date("m-Y"))){
    ?>
    edit_flag = true;
    <?php } ?>
    
    var received_date = document.getElementById("received_date").value;
    var received_amount = document.getElementById("received_amount").value;
    var tds_amount = document.getElementById("tds_amount").value;
    var gst_amount = document.getElementById("gst_amount").value;
    var expenses_amount = document.getElementById("expenses_amount").value;
    var gross_contactor_charges = document.getElementById("gross_contactor_charges").value;
    var contractor_tds_charges = document.getElementById("contractor_tds_charges").value;
    var net_contactor_charges = document.getElementById("net_contactor_charges").value;
    var contactor_advance_amount = document.getElementById("contactor_advance_amount").value;
    var payment_amount = document.getElementById("payment_amount").value;
    var net_payable_amount = document.getElementById("net_payable_amount").value;
    var percentage_no = document.getElementById("percentage_no").value;
    $("#percentage_no").on('keyup',function(){
      var regex = /^\d{0,3}(\.\d+)?$/;
    var value = $(this).val();
    if (!regex.test(value)) {
       $(this).val(parseFloat(value.slice(0, 3) + "." + value.slice(3)));
    }
      percentage_no = $(this).val();
      if(percentage_no == '' || percentage_no >= 100){
          if(percentage_no >= 100) {
            percentage_no = $("#percentage_no").val(100);
            // document.getElementById('received_amount').readOnly = false;
          } else {
            // document.getElementById('received_amount').readOnly = true;
          }
          
        }else{
          // document.getElementById('received_amount').readOnly = false;
        }
    });

    $("#received_amount").on('focusout',function(){
    	received_amount = document.getElementById("received_amount").value;
    	tds_amount = document.getElementById("tds_amount").value ? document.getElementById("tds_amount").value : 0 ;
    	$("#remaining_amount").val(parseFloat(invoice_total_amount) - parseFloat(received_amount) - parseFloat(tds_amount));
    });

    $("#tds_amount").on('focusout',function(){
    	received_amount = document.getElementById("received_amount").value ? document.getElementById("received_amount").value : 0 ;
    	tds_amount = document.getElementById("tds_amount").value ? document.getElementById("tds_amount").value : 0 ;
    	$("#remaining_amount").val(parseFloat(invoice_total_amount) - parseFloat(received_amount) - parseFloat(tds_amount));
    });

    $("#commissionable_amount").on('focusout',function(){
      //var loan_type_id = document.getElementById("loan_type_id").value;
      var remaining_amount1 =  $('#remaining_amount').val();
      $("#main_error").text("");
      commissionable_amount = $(this).val();
      if(parseFloat(commissionable_amount) > parseFloat(received_amount) ){
          $("#commissionable_amount_error").html("Commissionable charges should lessthan Received amount");
          return false;
      }else{
          $("#commissionable_amount_error").html("");
      }
      $("#received_amount_show1").text(received_amount);

          if(commissionable_amount.length > 1) {
          if(parseFloat(invoice_total_amount) == parseFloat(commissionable_amount)) {
                    // $("#second_fieldset").addClass('d-line').removeClass('d-none');
                    $("#settle_btn").addClass('d-line').removeClass('d-none');
                //Gross Contactor Charges = Expenses + 20 % of (Received Amount – Expenses)
                expenses_amount = document.getElementById("expenses_amount").value;
                expenses_amount = (expenses_amount.length ==0)?0:expenses_amount;
                //var temp = commissionable_amount - expenses_amount;
                var temp = commissionable_amount;
                if(percentage_no >= 100) {
                    percentage_no = 100;
                  } 
                gross_contactor_charges = (parseFloat(expenses_amount) + (parseFloat(temp)*parseFloat(percentage_no)/100));
                $("#gross_contactor_charges").val(gross_contactor_charges);

                //Contractor TDS Charges = 1 % of Gross Contact Charges
                contractor_tds_charges = (parseFloat(gross_contactor_charges) * 1/100);
                $("#contractor_tds_charges").val(contractor_tds_charges);

                //Net Contactor Charges = Gross Contactor Charges – Contractor TDS
                net_contactor_charges = (gross_contactor_charges - contractor_tds_charges);
                $("#net_contactor_charges").val(net_contactor_charges);

                //Contactor Advance Amount  from Advance Amounts module
                // contactor_advance_amount = 0;
                $("#contactor_advance_amount").val(contactor_advance_amount);

                //Net Payable Amount = Net Contactor Charges – Contactor Advance Amount
                net_payable_amount = (net_contactor_charges - payment_amount);
                $("#net_payable_amount").val(net_payable_amount);
       // } else if(parseFloat(invoice_total_amount) > parseFloat(commissionable_amount)) {
        } else if(remaining_amount1 != 0) {
                var d = new Date();
                var month = d.getMonth()+1;
                var day = d.getDate();
                //console.log("Day:"+day+" - Month:"+month);
               
            //     if(!edit_flag) {
            //     // $("#second_fieldset").addClass('d-line').removeClass('d-none');
            //   //Gross Contactor Charges = Expenses + 20 % of (Received Amount – Expenses)
            //     expenses_amount = document.getElementById("expenses_amount").value;
            //     expenses_amount = (expenses_amount.length ==0)?0:expenses_amount;
            //     //var temp = commissionable_amount - expenses_amount;
            //     var temp = commissionable_amount;
            //     gross_contactor_charges = (parseFloat(expenses_amount) + (parseFloat(temp)*parseFloat(percentage_no)/100));
            //     $("#gross_contactor_charges").val(gross_contactor_charges);

            //     //Contractor TDS Charges = 1 % of Gross Contact Charges
            //     contractor_tds_charges = (parseFloat(gross_contactor_charges) * 1/100);
            //     $("#contractor_tds_charges").val(contractor_tds_charges);

            //     //Net Contactor Charges = Gross Contactor Charges – Contractor TDS
            //     net_contactor_charges = (gross_contactor_charges - contractor_tds_charges);
            //     $("#net_contactor_charges").val(net_contactor_charges);

            //     //Contactor Advance Amount  from Advance Amounts module
            //     // contactor_advance_amount = 0;
            //     $("#contactor_advance_amount").val(contactor_advance_amount);

            //     //Net Payable Amount = Net Contactor Charges – Contactor Advance Amount
            //     net_payable_amount = (net_contactor_charges - payment_amount);
            //     $("#net_payable_amount").val(net_payable_amount);
            //     // $(".remaining_amount_class").removeClass('d-none').addClass('d-line');
            //     //Remaining Amount = Total Invoice Amount – Received Amount
            //     $("#remaining_amount").val(parseFloat(invoice_total_amount) - parseFloat(commissionable_amount));
            //   } else {
               // $("#second_fieldset").addClass('d-none').removeClass('d-line');
               $("#settle_btn").addClass('d-none').removeClass('d-line');
               $("#main_error").text("Edit the invoice and adjust amounts");
               $("#expenses_amount").val('');
                //alert("Edit the invoice and adjust amounts"); 
                return false;
             // }
        } else {
            $("#settle_btn").addClass('d-line').removeClass('d-none');
             // $("#second_fieldset").addClass('d-line').removeClass('d-none');
              //Gross Contactor Charges = Expenses + 20 % of (Received Amount – Expenses)
                expenses_amount = document.getElementById("expenses_amount").value;
                expenses_amount = (expenses_amount.length ==0)?0:expenses_amount;
                //var temp = commissionable_amount - expenses_amount;
                var temp = commissionable_amount;
                gross_contactor_charges = (parseFloat(expenses_amount) + (parseFloat(temp)*parseFloat(percentage_no)/100));
                $("#gross_contactor_charges").val(gross_contactor_charges);

                //Contractor TDS Charges = 1 % of Gross Contact Charges
                contractor_tds_charges = (parseFloat(gross_contactor_charges) * 1/100);
                $("#contractor_tds_charges").val(contractor_tds_charges);

                //Net Contactor Charges = Gross Contactor Charges – Contractor TDS
                net_contactor_charges = (gross_contactor_charges - contractor_tds_charges);
                $("#net_contactor_charges").val(net_contactor_charges);

                //Contactor Advance Amount  from Advance Amounts module
                // contactor_advance_amount = 0;
                $("#contactor_advance_amount").val(contactor_advance_amount);

                //Net Payable Amount = Net Contactor Charges – Contactor Advance Amount
                net_payable_amount = (net_contactor_charges - payment_amount);
                $("#net_payable_amount").val(net_payable_amount);

                //Remaining Amount = Total Invoice Amount – Received Amount
                $("#remaining_amount").val(0);
                // $(".remaining_amount_class").removeClass('d-line').addClass('d-none');
        }
      } else {
        // $("#second_fieldset").addClass('d-none').removeClass('d-line');
        $("#settle_btn").addClass('d-line').removeClass('d-none');
      }
      
    });
    $("#expenses_amount").on('keyup',function(){
        expenses_amount = document.getElementById("expenses_amount").value;
        $("#commissionable_amount").trigger("focusout");

    });
    $("#percentage_no").on('change',function(){
        percentage_no = document.getElementById("percentage_no").value;
        $("#commissionable_amount").trigger("focusout");

    });
    $("#payment_amount").on('change',function(){
        payment_amount = document.getElementById("payment_amount").value;
        net_payable_amount = (net_contactor_charges - payment_amount);
        $("#net_payable_amount").val(net_payable_amount);
        if(net_payable_amount<0){
            $("#payment_error").html("Pay from advance amount cannot be greater than Net Contractor Charges");
            return false;
        }else{
            $("#payment_error").html("");
        }
        if(parseInt(contactor_advance_amount) < parseInt(payment_amount)){
            $("#payment_error").html("Pay from Advance Balance cannot be greater than Advance Balance Amount");
            return false
        }else{
            $("#payment_error").html("");
        }
        

    });
    
    $("#settle_contractor_submit").on("submit",function(){
      var received_date = $("#received_date").val();
      var received_amount =  $("#received_amount").val();
      var tds_amount =  $("#tds_amount").val();
      var gst_amount =  $("#gst_amount").val();
      var percentage_no = $("#percentage_no").val();
      var commissionable_amount = $("#commissionable_amount").val();
      document.getElementById('received_amount').readOnly = true;
        if(received_date == ''){
          $("#received_date_error").html("Please Selecte Date");
          $("#received_date").focus();
          return false;
        }else{
          $("#received_date_error").html("");
        }
        if(percentage_no == ''){

          $("#percentage_no_error").html("Received Amount Required");
          $("#percentage_no").focus();
          return false;
        }else{
          document.getElementById('received_amount').readOnly = false;
          $("#percentage_no_error").html("");
        }

         if(received_amount == ''){
          $("#received_amount_error").html("Received Amount Required");
          $("#received_amount").focus();
          return false;
        }else{
          $("#received_amount_error").html("");
        }

        if(tds_amount == ''){
          $("#tds_amount_error").html("TDS Amount Required");
          $("#tds_amount").focus();
          return false;
        }else{
          $("#tds_amount_error").html("");
        }

        if(gst_amount == ''){
          $("#gst_amount_error").html("GST Amount Required");
          $("#gst_amount").focus();
          return false;
        }else{
          $("#gst_amount_error").html("");
        }
        
        if(parseFloat(commissionable_amount) > parseFloat(received_amount) ){
          $("#commissionable_amount_error").html("Commissionable amount should lessthan Received amount");
          $("#commissionable_amount").focus();
          return false;
        }else{
          $("#commissionable_amount_error").html("");
        }
        $("#settle_btn").hide();
        
    });
    
  </script>
</body>
</html>