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

      <h5>Invoice View</h5>

      <div class="card">
        <div class="card-body">
          <div class="printbody" id="printbody">
           

                <div class="col-xl-1 col-sm-1 col-md-1 col-lg-1 text-center">
             <!--  <i class="fab fa-cc-visa h1 text-secondary"></i> -->
            <!--  <img src="https://i.pinimg.com/564x/5a/02/5e/5a025e222970a3dd2c3706bde935ae15.jpg" width="100%" >   -->           
            </div>
            <div class="col-xl-11 col-sm-11 col-md-11 col-lg-11">
              <h1 class="text-right">HANSHITHA MANAGEMENT SERVICES<br> </h1>
              <h3 class="text-right"><span>(DEBT RECOVERY AGENCY)</span></h3>            
              <!-- <h3 class="align-items-right"></h3> -->
              <H6  class="text-center">STRESSED ASSETS RESULUTION ENFORCEMENT AGENCY UNDER SARFAESI ACT. 2002</H5>
              <p class="text-center">H.No. 5-3-319/28/2, Plot no. 28/2, venkatrao Nagar, Road No.6, Kukatpally, Hyd - 72.<br/>
               <strong> Cell : 9553204444, 9908904703, E-mail : hmshyd2018@gmail.com
               </strong><br/>
               <strong> GST No.: 36AALFH3397N1ZM, PAN No.: AALFH3397N</strong>
              </p>
            </div>
            <hr>
            <div class="row row-cols-10 row-cols-sm-10 row-cols-md-10">
              <div class="col">
                <br />
                <span class="text-secondary">To,</span>
                <address class="font-size-sm">
                <strong>The Cheif / Branch Manager</strong><br>
                Bank Name<br>
                Branch : Branch Name<br>
                GST No.: 36AAACS8577K1ZQ
                </address>
                <address class="font-size-sm">
                <!--  <?php echo $invoice_details[0]->from_address; ?> -->
                  <!-- GST NO: <?php echo $invoice_details[0]->gst_no; ?><br > -->
                  <small>SUB: Recoveries under SARFASEI / Physical Possession / Hypothecation Clause Commission Receivable, Collections, Seizures mode in the month of Recoveries as per our Contract Request - Reg. <br />
                  Recovery Service Charge Provide to Financial Institute (or) Non-Banking Companies Request - Reg.<br />
                  RCM Applicable </small>
                </address>
              </div>
             
            </div>
            <div class="table-responsive my-3">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>S.NO</th>
                    <th class="text-center">Details</th>
                    <th>Recovered Amt</th>
                    <th>Date</th>
                    <th>Commission Charges</th>
                    <th>GST 18%</th>
                    <th class="text-right">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $subtotal =0;
                    $gstTotal =0;
                    $grandTotal =0;
                  $i =1; foreach ($invoice_details as $key => $value) { 
                    $subtotal += ($value->recovered_amt+$value->commission_charges);
                    $gstTotal += $value->gst;
                    $grandTotal += $value->total;
                    ?>
                   <tr>
                    <td><?php echo $i++; ?></td>
                    <td class="text-left"><?php echo $value->borrower_name; ?></td>
                     <td class="text-left"><?php echo $value->recovered_amt; ?></td>
                     <td><?php echo date('d M Y',strtotime($value->date)); ?></td>
                     <td class="text-left"><?php echo $value->commission_charges; ?></td>
                     <td class="text-left"><?php echo $value->gst; ?></td>
                     <td class="text-right"><?php echo $value->total; ?></td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>
            </div>
            <div class="row row-cols-2">
              <div class="col">
                
              </div>
              <div class="col">
                <p class="lead">Amount</p>
                <div class="table-responsive">
                  <table class="table table-sm">
                    <tbody>
                      <tr>   
                        <th class="w-50">Subtotal:</th>
                        <td><?php echo $subtotal; ?></td>
                      </tr>
                      <tr>
                        <th>GST(18%)</th>
                        <td><?php echo $gstTotal; ?></td>
                      </tr>
                      <tr>
                        <th>Grand Total:</th>
                        <td><?php echo $grandTotal; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <p> <small><span id="wordamount" class="text-muted" style="padding:20px;"></span></small></p>
            </div>
            <div class="my-3">
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

          <div class="d-flex flex-column flex-sm-row mt-3">
            <button onclick="printDiv('printbody')" class="btn btn-light has-icon mt-1 mt-sm-0 printMe" type="button">
              <i class="mr-2" data-feather="printer"></i>Print
            </button>
            <a class="btn btn-primary has-icon ml-sm-auto mt-1 mt-sm-0" type="button" target="_blank" href="<?php echo base_url(); ?>assets/invoices/<?php echo $invoice_details[0]->pdf_file; ?>">
              <i class="mr-2" data-feather="download"></i>Generate PDF
            </a>
            
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
<!--   <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->

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


function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}

</script>

</body>

</html>