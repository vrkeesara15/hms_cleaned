<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>  
  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;" width="11%"  align="center"><img src="<?php echo base_url(); ?>assets/images/hlogo.png" width='120'></td>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px;width:89px" colspan="2" align="center" width="89%">
    <strong style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:18px;">HANSHITHA MANAGEMENT SERVICES</strong><br />
    <span>(RESOLUTION & DEBT RECOVERY AGENCY)</span><br/>
    STRESSED ASSETS RESULUTION ENFORCEMENT AGENCY UNDER SARFAESI ACT. 2002 <br/>
     H.No. 5-3-319/28/2, Plot no. 28/2, venkatrao Nagar, Road No.6, Kukatpally, Hyd - 72.<br/>
    <strong>Cell : 9553204444, 9908904703, E-mail : hmshyd2018@gmail.com</strong><br/>
    <strong>GST No.: 36AALFH3397N1ZM, PAN No.: AALFH3397N</strong>  
    </td>
    </tr>      
    </table>
     <hr>
  </td>
    </tr>

  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="40%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;">Bill No.: <?php echo $bankdetails->id;?></td>
          </tr>         
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px;"><span class="text-secondary">To,<br></span>
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
    <td width="60%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px;"  align="right">Date : <?php echo date('d-m-Y', strtotime($bankdetails->bill_date));?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;" width="100%">SUB: Recoveries under SARFASEI / Physical Possession / Hypothecation Clause Commission Receivable, Collections, Seizures mode in the month of Recoveries as per our Contract Request - Reg. <br/>

        </td>
      </tr>
        <tr>
           <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px; " width="100%">Recovery Service Charge Provide to Financial Institute (or) Non-Banking Companies Request - Reg.<br/>
  RCM Applicable <br>
        </td>
        
        
      </tr>
    
      
      
    </table></td>
  </tr>

  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px;" width="100%">
          Borrower Name : <?php echo $bankdetails->barrower_name;?>, <br>
              Account Number : <?php echo $bankdetails->loan_ac_number;?>, <br>Account Type : Car Loan<br>

        </td>
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
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px; border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" width="5%" align="center">SI.No</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="45%" align="center">Details</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="10%" align="center">Recovered Amt</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="10%" align="center">Date</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="10%" align="center">Commission Charges</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="10%" align="center">GST Amount</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="10%" align="center">Total</td>
        
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
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;"  align="center"><?php echo $i++; ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center"><?php echo $value->borrower_name; ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">
          <?php if($value->recovered_amt !='0'){ ?>
                    <?php echo number_format($value->recovered_amt); ?>/-
          <?php } ?>
        </td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">
          <?php if($value->date !='0000-00-00'){
          echo date('d M Y',strtotime($value->date)); 
                    }?>
        </td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">
           <?php if($value->commission_charges !='0'){
                 echo number_format($value->commission_charges); 
                 ?>/-
           <?php } ?>
        </td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">
          <?php if($value->gst !='0'){
                echo number_format($value->gst); ?>/-
          <?php } ?></td>

           <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center"><?php echo number_format($value->total); ?>/-</td>
           </tr>
         <?php } ?>
           <tr>
             <td colspan="6" style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px;  border-left:1px solid #333;  border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">
               <strong>(Rupees <span id="wordamount"><?php echo ucwords(convertNumberToWord($grandTotal));?> Only)
             </td>
              <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center"><?php echo number_format($grandTotal);?>/-</td>
            </tr>
                  
                

           <!-- <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">
          <?php echo number_format($grandTotal);?>/-</td> -->
      
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:15px;" colspan="2">
      
      We request you to kindly release the charges by way of RTGS /NEFT transfer as per the following details:<br />
     <strong> HANSHITHA MANAGEMENT SERVICES, State Bank of India <br />
     Account No: <?php echo $invoice_details[0]->account; ?>, IFSC: SBIN0015779,<?php if($bankdetails->bank_name =='SBI') { echo 'Vendor ID: HANS6570947';}?>
       </strong>
       <br/>
       Your Truly<br/>
       For <strong>HANSHITHA MANAGEMENT SERVICES</strong><br/><br/>
       <img src="<?php echo base_url(); ?>assets/images/signature1.png" width=''><br />
       (Authorised Signatory)
    </td>
  </tr>  
</table>
</body>
</html>
