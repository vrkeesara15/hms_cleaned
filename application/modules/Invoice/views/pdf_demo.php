 <!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Font & Icon -->
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/font/inter/inter.min.css" id="font-css">
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/material-design-icons-iconfont/material-design-icons.min.css">
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/fontawesome-free/css/all.min.css">
  <!-- Plugins -->
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/datatables/responsive.bootstrap4.min.css">
  <!-- Main Style -->
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.css">
  
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/css/sidebar-royal.min.css" id="theme-css"> 

  <!-- options: blue,cyan,dark,gray,green,pink,purple,red,royal,ash,crimson,namn,frost -->
  <title>HMS</title>
</head>

<body onload="window.print();"  style="background: #fff;">
 <!-- Main body -->
    <div class="main-body">


      <div class="card">
        <div class="card-body">
             <div class="printbody" id="printbody">
                <div class="col-xl-1 col-sm-1 col-md-1 col-lg-1 text-center">
             <!--  <i class="fab fa-cc-visa h1 text-secondary"></i> -->
            <!--  <img src="https://i.pinimg.com/564x/5a/02/5e/5a025e222970a3dd2c3706bde935ae15.jpg" width="100%" >   -->           
            </div>
            <div class="col-xl-11 col-sm-11 col-md-11 col-lg-11">
              <h2 class="text-right">HANSHITHA MANAGEMENT SERVICES<br> </h2>
              <h4 class="text-right"><span>(DEBT RECOVERY AGENCY)</span></h4>            
              <H6  class="text-center">STRESSED ASSETS RESULUTION ENFORCEMENT AGENCY UNDER SARFAESI ACT. 2002</H6>
              <p class="text-center">H.No. 5-3-319/28/2, Plot no. 28/2, venkatrao Nagar, Road No.6, Kukatpally, Hyd - 72.<br/>
               <strong> Cell : 9553204444, 9908904703, E-mail : hmshyd2018@gmail.com
               </strong><br/>
               <strong> GST No.: 36AALFH3397N1ZM, PAN No.: AALFH3397N</strong>
              </p>
            </div>
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
                GST No.: <?php echo $bankdetails->gst_no;?><br>
                </address>
                <address class="font-size-sm">
                <!--  <?php echo $invoice_details[0]->from_address; ?> -->
                <!--   GST NO: <?php echo $invoice_details[0]->gst_no; ?><br > -->
                  <small>SUB: Recoveries under SARFAESI / Physical Possession / Hypothecation Clause Commission Receivable, Collections, Seizures mode in the month of Recoveries as per our Contract Request - Reg. <br />
                  Recovery Service Charge Provide to Financial Institute (or) Non-Banking Companies Request - Reg.<br />
                  RCM Applicable </small>
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
                  <th>GST %</th>     
                  <th>GST Amount</th>     
                  <th>total</th>
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
                  <td><?php echo number_format($value->recovered_amt); ?>/-</td>
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
                  <td>
                     <?php 
                    if($value->gst !='0'){
                    echo number_format($value->gst_p); ?>%
                     <?php } ?>
                  </td>
                  <td>
                     <?php 
                    if($value->gst !='0'){
                    echo number_format($value->gst); ?>/-
                     <?php } ?>
                  </td>
                  <td><?php echo number_format($value->total); ?>/-</td>
                  </tr>
                  <?php } ?>
               
                  <tr>
                  <td colspan="7"><strong>(Rupees <span id="wordamount"></span></strong></td>                  
                  <td><?php echo number_format($grandTotal);?>/-</td>
                </tr>
                
              </tbody>
            </table>
          </div>
          <div class="row row-cols-2">
            <div class="col">
              <address class="font-size-sm">
                We request you to kindly release the charges by way of RTGS /NEFT transfer as per the following details:<br />
               <strong> HANSHITHA MANAGEMENT SERVICES, State Bank of India <br />
                Account No: <?php echo $invoice_details[0]->account; ?>, IFSC: SBIN0015779,Vendor ID: HANS6570947
              </strong>

                <br />Your Truly<br />
                For <strong>HANSHITHA MANAGEMENT SERVICES</strong><br /><br />
                <img src="<?php echo base_url(); ?>assets/images/signature1.png" width=''><br />
                (Authorised Signatory)
               </address>
            </div>
           
          </div>
        </div>
      
        </div>
      </div>
    </div>
    <!-- /Main body -->

      <!-- Main Scripts -->
  <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  
<!--   <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->


 <script>

 var wordAmount = convertNumberToWords(<?php echo $grandTotal; ?>);
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



</script>


</body>

</html>