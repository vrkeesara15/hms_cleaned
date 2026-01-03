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
                <div class="col-xl-11 col-sm-11 col-md-11 col-lg-11 mt-0">
            
            </div>
            

          <div class="">
            <h4 style=" display: flex;   align-items: center; justify-content: center; flex-direction: column">INVOICE</h4>
          </div>
          <hr>
         <div class="row row-cols-10 row-cols-sm-10 row-cols-md-10">
            <div class="col">
                <br />
                <span style="float: left;">Invoice No : <?php echo $invoice_id; ?></span><br/>
                <span style="float: left;">From,</span><span style="float: right;">Date : <?php echo Date('d M Y'); ?></span><br />
                <address class="font-size-sm">
                <span style="float: left;">Name : <?php echo $employeeDetails->fname.' '.$employeeDetails->lname; ?></span><span style="float: right;">Ref Invoice No : <?php echo $contractor_charges->contractor_charges_id; ?></span><br>
                <span style="float: left;">Address : <?php echo $employeeDetails->emp_address; ?></span><span style="float: right;">PAN No : <?php echo $employeeDetails->pan_number; ?></span><br>
                </address>

                <span class="text-secondary">To,</span><br />
                <address class="font-size-sm right">
                <strong>M/s. HANSHITHA MANAGEMENT SERVICES</strong><span style="float: right;">GST.NO : 36AALFH3397N1ZM</span><br>
                ADDRESS: plot No.218,shiva sai hills<span style="float: right;">PAN No : AALFH3397N</span><br>
                Road No.5, gajularamaram,<br>
                Quthbullapur,Hyderabad,500055.
                <?php //$gstres = getGSTNumber($bankdetails->bank_id,$bankdetails->state_id); echo $gstres->gst_no;?><br>
                </address>
               


              </div>
          </div>
          <div class="table-responsive my-3">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <td>SI.No</td>
                  <td align="center">Description</td>
                  <td align="center">Amount</td>
                </tr>
              </thead>
              <tbody>

                    <tr>
                        <td>1</td>
                        <td align="center">Contract charges for the month of <?php echo Date('M-Y'); ?> </td>
                        <td align="center"><?php echo number_format($contractor_charges->net_contractor_charges);?></td>
                    </tr>
               
                  <tr>
                  <td colspan="2" align="center"><strong>(Rupees <span id="wordamount"><?php echo ucwords(convertNumberToWord($contractor_charges->net_contractor_charges));?> </span>Only)</strong></td>                  
                  <td align="center"><strong><?php echo number_format($contractor_charges->net_contractor_charges);?>/-</strong></td>
                </tr>
                
              </tbody>
            </table>
          </div>
          <div class="row row-cols-1">
            <div class="col">
               <address class="font-size-sm">
                    PAN No: <?php echo $employeeDetails->pan_number; ?> <br />
                    <strong>Bank account Details: </strong><br />
                    Name: <?php echo $employeeDetails->fname.' '.$employeeDetails->lname; ?> <br /> 
                    A/C No:&nbsp;<?php echo $employeeDetails->account_number; ?> <br />
                    Bank:&nbsp;<?php echo $employeeDetails->bank_name; ?> <br />
                    IFSC Code:&nbsp;<?php echo $employeeDetails->ifsc_code?> <br />
                    Branch:&nbsp;<?php echo $employeeDetails->branch_name; ?> <span style="float: right;"><?php echo $employeeDetails->fname.' '.$employeeDetails->lname; ?></span><br>
                    Adress:&nbsp;<?php echo $employeeDetails->branch_address; ?> <span style="float: right;">Authorised signatory</span><br>
                </address>
            </div>
            
           
          </div>
        </div>
        
          <div class="d-flex flex-column flex-sm-row mt-3">
            <!-- <button onclick="printDiv('printbody')" class="btn btn-light has-icon mt-1 mt-sm-0 printMe" type="button">
              <i class="mr-2" data-feather="printer"></i>Print
            </button> -->
           <a class="btn btn-primary has-icon ml-sm-auto mt-1 mt-sm-0" type="button" target="_blank" href="<?php echo base_url(); ?>assets/contractor_invoice_files/<?php echo $contractor_charges->invoice_file_name; ?>">
              <i class="mr-2" data-feather="download"></i>Download PDF
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