<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2" align="center">
       <strong style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:18px;">HANSHITHA MANAGEMENT SERVICES</strong><br />
     <span>(DEBT RECOVERY AGENCY)</span>          <br />
              STRESSED ASSETS RESULUTION ENFORCEMENT AGENCY UNDER SARFAESI ACT. 2002 <br />
              H.No. 5-3-319/28/2, Plot no. 28/2, venkatrao Nagar, Road No.6, Kukatpally, Hyd - 72.<br/>
               <strong> Cell : 9553204444, 9908904703, E-mail : hmshyd2018@gmail.com
               </strong><br/>
               <strong> GST No.: 36AALFH3397N1ZM, PAN No.: AALFH3397N</strong>
               <hr>
             </td>
      </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="49%"><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;">Bill No.: <?php echo $bankdetails->id;?></td>
          </tr>
         
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"><span class="text-secondary">To,</span>
               
                <strong>The Cheif / Branch Manager</strong><br>
                Bank Name : <?php echo $bankdetails->bank_name;?><br>
                Branch : <?php echo $bankdetails->branch_name;?><br>
                GST No.: <?php echo $bankdetails->gst_no;?><br>
                 </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        
         
          <tr>
            <td>&nbsp;</td>
          </tr>
      
          </table></td>
      </tr>
    </table></td>


    <td width="51%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right"></td>
      </tr>
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" align="right"></td>
      </tr>
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"  align="right">&nbsp;</td>
      </tr>
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"  align="right">Date : <?php echo date('d-m-Y', strtotime($bankdetails->bill_date));?></td>
      </tr>      
    </table></td>
  </tr>

  
  <tr>
    <td colspan="2"><table width="100%" border="1" cellspacing="0" cellpadding="0">

    <tr style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" >
  SUB: Recoveries under SARFASEI / Physical Possession / Hypothecation Clause Commission Receivable, Collections, Seizures mode in the month of Recoveries as per our Contract Request - Reg. <br />
    Recovery Service Charge Provide to Financial Institute (or) Non-Banking Companies Request - Reg.<br /><br /><br />
  </tr>


      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" width="4%" height="32" align="center">SI.No</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="55%" align="center">Details</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="15%" align="center">Recovered Amt</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="10%" align="center">Date</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" width="15%" height="32" align="center">Commission Charges</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="10%" align="center">GST %</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="15%" align="center">GST Amount</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="15%" align="center">Total</td>
      </tr>
      

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
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" height="32" align="center"><?php echo $i++; ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center"><?php echo $value->borrower_name; ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center"><?php echo number_format($value->recovered_amt); ?>/-</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center"> <?php 
                    if($value->date !='0000-00-00'){
                    echo date('d M Y',strtotime($value->date)); 
                    }
                    ?></td>
         <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" height="32" align="center"> <?php 
                    if($value->commission_charges !='0'){
                     echo number_format($value->commission_charges); 
                     ?>/-
                   <?php } ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center"> <?php 
                    if($value->gst !='0'){
                    echo number_format($value->gst_p); ?>%
                     <?php } ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center"> <?php 
                    if($value->gst !='0'){
                    echo number_format($value->gst); ?>/-
                     <?php } ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center"><?php echo number_format($value->total); ?>/-</td>
         </tr>
         <?php } ?>
     
      <tr>
      <td colspan="7"><strong>(Rupees <span id="wordamount"><?php echo ucwords(convertNumberToWord($grandTotal));?> Only)</span></strong></td>                  
                  <td><?php echo number_format($grandTotal);?>/-</td>
                </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
 
  <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2">
       <div class="row row-cols-2">
            <div class="col">
              
                We request you to kindly release the charges by way of RTGS /NEFT transfer as per the following details:<br />
               <strong> HANSHITHA MANAGEMENT SERVICES, State Bank of India <br />
                Account No: <?php echo $invoice_details[0]->account; ?>, IFSC: SBIN0015779,<?php if($bankdetails->bank_name =='SBI') { echo 'Vendor ID: HANS6570947';}?>
              </strong>

                <br />Your Truly<br />
                For <strong>HANSHITHA MANAGEMENT SERVICES</strong><br /><br />
                <img src="<?php echo base_url(); ?>assets/images/signature1.png" width=''><br />
                (Authorised Signatory)
               
            </div>
           
          </div>
    </td>
  </tr>
  
</table>
</body>
</html>
