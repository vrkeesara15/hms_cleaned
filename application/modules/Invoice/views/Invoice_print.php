<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new/css/style.min.css">
    


    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style type="text/css">
          *{
            font-size: 10px;
          }


    address p {
        margin: 0px;
    }

    </style>

</head>

<body onload="window.print();"  style="background: #fff;">
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1 style="font-size: 16px;">HANSHITHA MANAGEMENT SERVICES</h1>     
                    <hr>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info" style="margin-top:30px;">
            <table style="width: 100%">

            <tr>
                <!-- <td>
                  <div class="col-sm-6 invoice-col">
                    <address>
                        <strong style="font-weight: bold;">To:-  <br>
                        <?php echo  preg_replace('/(<br>)+$/', "", $invoice_details[0]->to_address); ?>
                        </strong>              
                    </address>
                  </div>
                </td> -->

                <td style="text-align: right; vertical-align: top;"><div class="text-right col-sm-6">
                    <time>Date :- <?php echo date('d-m-Y');?></time><br />
                </div>
                </td>
            </tr>
                
            </table>
            <br><br>
               
                
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
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
                <!-- /.col -->
                <p style="margin: 0">Note: This is a computer generated Invoice and requires no signature. </p>
                 <hr>
                <address class="font-size-sm">
                    We request you to kindly release the charges by way of RTGS /NEFT transfer as per the following details:<br />
                   <strong> HANSHITHA MANAGEMENT SERVICES, State Bank of India <br />
                    Account No: <?php echo $invoice_details[0]->account; ?>, ifsc: SBIN0015779,Vendor ID: HANS6570947
                    </strong>

                     <br />Your Truly<br />
                For <strong>HANSHITHA MANAGEMENT SERVICES</strong><br /><br />
                <img src="<?php echo base_url(); ?>assets/images/signature1.png" width=''><br />
                (Authorised Signatory)
               </address>
            </div>
            <!-- /.row -->


        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

</body>

</html>

