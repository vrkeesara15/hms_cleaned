 <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Invoice View</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="card">
        <div class="card-body">
             <div class="printbody" id="printbody">
                <!-- <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 mt-0">-->
             
                <!--    <img src="<?php echo base_url(); ?>assets/images/top_left.png" width="25%" style="margin-top:1%" align="left">      -->
                
                <!--    <img src="<?php echo base_url(); ?>assets/images/top_right.png" width="70%" style="margin-top:1%" align="right">-->
                <!--</div> -->
                
                <div class="col-xl-11 col-sm-11 col-md-11 col-lg-11 mt-0">
                    
               <i class="fab text-secondary"></i> 
             <!--<img src="<?php echo base_url(); ?>assets/images/hlogo.png" width="150px" >             -->
             <img src="<?php echo base_url(); ?>assets/images/top_left.png" width="25%" style="margin-top:1%" align="left">
              <h5 class="text-center">HANSHITHA MANAGEMENT SERVICES<br> </h5>
              <h6 class="text-center"><span>(RESOLUTION & DEBT RECOVERY AGENCY)</span></h6>            
              <h6  class="text-center">STRESSED ASSETS RESULUTION ENFORCEMENT AGENCY UNDER SARFAESI ACT. 2002</h6>
              <p class="text-center">Plot No. 218, Shiva Sai Hills, Gajularamaram, Quthbullapur, Hyderabad - 500055<br/>
               <strong> Cell : 9553204444, 9908904703, E-mail : hmshyd2018@gmail.com,hms@hanshithagroup.com
               </strong><br/>
               <strong> GST No.: 36AALFH3397N1ZM, PAN No.: AALFH3397N</strong>
              </p>
            </div>
            <div class="clearfix"></div>
            <hr>

          <div class="d-flex justify-content-between align-items-center">
            <h4>Bill No. <?php echo $bankdetails->id;?></h4>
            <span>Date :<?php echo date('d-m-Y', strtotime($bankdetails->bill_date));?></span>
          </div>
          
         <div class="row row-cols-10 row-cols-sm-10 row-cols-md-10">
            <div class="col">
                <br />
                <span class="text-secondary">To,</span>
                <address class="font-size-sm">
                <strong>The Cheif / Branch Manager</strong><br>
                Bank Name : <?php echo $bankdetails->bank_name;?><br>
                Branch : <?php echo $bankdetails->branch_name;?><br>
                GST No.: <?php echo $idetails->gst_no;?>
                <?php //$gstres = getGSTNumber($bankdetails->bank_id,$bankdetails->state_id); echo $gstres->gst_no;?><br>
                </address>
                <address class="font-size-sm">
                <!--  <?php echo $invoice_details[0]->from_address; ?> -->
                <!--   GST NO: <?php echo $invoice_details[0]->gst_no; ?><br > -->
                  <small>SUB: Recoveries under SARFAESI / Physical Possession / Hypothecation Clause Commission Receivable, Collections, Seizures mode in the month of Recoveries as per our Contract Request - Reg. <br />
                  Recovery Service Charge Provide to Financial Institute (or) Non-Banking Companies Request - Reg.<br />
                  <div id="rcmdiv">RCM Applicable </div></small>

              <br><br>
               
               Borrower Name :<strong> <?php echo $bankdetails->barrower_name;?></strong>, 
              Account Number : <strong><?php echo $bankdetails->loan_ac_number;?></strong>,
              Account Type : <?php echo $loanDetails; ?><br>
                
            
                </address>


              </div>
          </div>
          <div class="table-responsive my-3">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th>SI.No</th>
                  <th>Details</th>
                  <th>Recovered Amt</th>
                  <th>Date</th>
                  <th>Commission Charges</th>
                 <!--  <th>GST %</th>      -->
                  <th>SGST </th>     
                 <?php if($bankdetails->state_id == 2) { ?>
                  <th>CGST </th>     
                  <?php } ?>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>

                  <?php 
                  $subtotal =0;
                  $gstTotal =0;
                  $grandTotal =0;
                  $i =1; 
                  foreach ($invoice_details as $key => $value) { 
                  $subtotal += ($value->recovered_amt+$value->commission_charges);
                  $gstTotal += $value->gst;
                  $grandTotal += $value->total;
                  ?>
                  <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $value->borrower_name; ?></td>
                  <td>
                    <?php if($value->recovered_amt !='0'){ ?>
                    <?php echo number_format($value->recovered_amt); ?>/-
                  <?php } ?>
                  </td>
                  <td>
                    <?php 
                    if($value->date !='0000-00-00'){
                    echo date('d M Y',strtotime($value->date)); 
                    }
                    ?>
                  </td>
                  <td>
                   <?php 
                    if($value->commission_charges !='0'){
                     echo number_format($value->commission_charges); 
                     ?>/-
                   <?php } ?>
                  </td>
                <!--   <td>
                     <?php 
                    if($value->gst !='0'){
                    echo number_format($value->gst_p); ?>%
                     <?php } ?>
                  </td> -->
                  <td>
                     <?php 
                    if($value->gst !='0'){
                    echo number_format($value->gst); ?>/-
                     <?php } ?>
                  </td>
                  <?php if($bankdetails->state_id == 2) { ?>
                  <td>
                     <?php 
                    if($value->cgst !='0'){
                    echo number_format($value->cgst); ?>/-
                     <?php } ?>
                  </td>
                  <?php } ?>
                  <td><?php echo number_format($value->total); ?>/-</td>
                  </tr>
                  <?php } ?>
               
                  <tr>
                      <?php if($bankdetails->state_id == 2) { ?>
                  <td colspan="7"><strong>(Rupees <span id="wordamount"></span>)</strong></td>    
                  <?php } else { ?>
                  <td colspan="6"><strong>(Rupees <span id="wordamount"></span>)</strong></td>    
                  <?php } ?>
                  <td><strong><?php echo number_format($grandTotal);?>/-</strong></td>
                </tr>
                
              </tbody>
            </table>
          </div>
          <div class="row row-cols-1">
            <div class="col">
              <address class="font-size-sm">
                We request you to kindly release the charges by way of RTGS /NEFT transfer as per the following details:<br />
               <strong> HANSHITHA MANAGEMENT SERVICES, State Bank of India <br />
                Account No: 37883058699, IFSC: SBIN0061790,Anjaneya Nagar,Hyderabad.
                <?php if($idetails->vendor_no !='' &&  $idetails->vendor_no !='NULL'){?>Vendor ID: <?php echo $idetails->vendor_no;}?>
              </strong>

                <br />Your Truly<br />
                For <strong>HANSHITHA MANAGEMENT SERVICES</strong><br /><br />
                <img src="<?php echo base_url(); ?>assets/images/signature1.png" width=''>
                <?php /*if(!empty($employeeData->employee_signature)){ ?>
                <img src="<?php echo base_url(); ?>assets/employee_doc/signature/<?php echo $employeeData->employee_signature; ?>" width=''><?php }*/ ?><br />
                (Authorised Signatory)
               </address>
            </div>
            <div>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>This is computer generated invoice signature not required</small>
            </div>
           
          </div>
        </div>
        
          <div class="d-flex flex-column flex-sm-row mt-3">
            <!-- <button onclick="printDiv('printbody')" class="btn btn-light has-icon mt-1 mt-sm-0 printMe" type="button">
              <i class="mr-2" data-feather="printer"></i>Print
            </button> -->
            <?php if(!empty($getInvFiles)) { ?>
            <button class=" has-icon ml-sm-auto mt-1 mt-sm-0" type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal" style="margin-top: 10%;">View Invoice Files</button>
            <?php } ?>
            <a class="btn btn-primary has-icon ml-sm-auto mt-1 mt-sm-0" type="button" href="<?php echo base_url(); ?>Invoice/manualInvoices/<?php echo $idetails->id; ?>">
              <i class="mr-2"></i>Edit
            </a>
            <a class="btn btn-primary has-icon ml-sm-auto mt-1 mt-sm-0" type="button" href="<?php echo base_url(); ?>Invoice/saveInvoice/<?php echo $idetails->id; ?>">
              <i class="mr-2"></i>Save
            </a>
           
           
          </div>
        </div>
      </div>
    </div>
    <!-- /Main body -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">List of uploaded files</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">FIle Name</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>
        <?php 
        $i =1;
        foreach ($getInvFiles as $key => $value) {
         ?>
    <tr>
      <th scope="row"><?=$i++;?></th>
      <td><?=$value->display_name;?></td>
      <td><a href="<?php echo base_url().'assets/invoice_files/'.$value->file_name; ?>" download>View</a></td>
    </tr>
    <?php } ?>
        </tbody>
    </table>
      </div>
      
    </div>
  </div>
</div>

      <!-- Main Scripts -->
  <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>
<!--   <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->


 <script>

 var wordAmount = convertNumberToWords(<?php echo $grandTotal; ?>);
 <?php if($gstTotal != 0){ ?>
  $("#rcmdiv").css("display","none");
 <?php } ?>
      //  alert(wordAmount);
      $('#wordamount').text(wordAmount);
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


function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}

</script>