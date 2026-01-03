<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
    <!--<tr>  
  <td colspan="2">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px;" width="11%"  align="center"><img src="<?php echo base_url(); ?>assets/images/top_left.png" width="250px"></td>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px;" align="right" width="89%"><img src="<?php echo base_url(); ?>assets/images/top_right.png" width="400px" style="margin-top:1%"></td>
    </tr> 
    </table>
     <hr>
    </td>
    </tr>-->
  <tr>  
  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px;" width="90%"  align="center"><img src="<?php echo base_url(); ?>assets/images/hlogo6.png" width='100%'></td>
   <!-- <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;width:89px" colspan="2" align="right" width="89%">
    <strong style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:18px;">HANSHITHA MANAGEMENT SERVICES</strong><br />
    <span>(RESOLUTION & DEBT RECOVERY AGENCY)</span><br/>
    STRESSED ASSETS RESULUTION ENFORCEMENT AGENCY UNDER SARFAESI ACT. 2002 <br/>
     Plot No. 218, Shiva Sai Hills, Gajularamaram, Quthbullapur, Hyderabad - 500055<br/>
    <strong>Cell : 9553204444, 9908904703 <br/>E-mail : hmshyd2018@gmail.com, hms@hanshithagroup.com</strong><br/>
    <strong>GST No: 36AALFH3397N1ZM, PAN No: AALFH3397N</strong>  
    </td>-->
    </tr>      
    </table>
     <hr>
  </td>
    </tr>
    

  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr><td colspan='2' style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:20px;" align="center"><u>INVOICE</u></td></tr>
  <tr>
    <td width="40%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
             <?php /*
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px;">Bill No: #<?php if(!empty($bankdetails->received_invoice_id)){ echo $bankdetails->received_invoice_id; }else{ echo $bankdetails->id; } ?></td>
            */ ?>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px;">Bill No: #<?php echo $bankdetails->id;  ?></td>
          </tr>         
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"><span class="text-secondary">To,<br></span>
               <strong>The Chief / Branch Manager</strong><br>
                Bank Name: <?php echo $bankdetails->bank_name;?><br>
                Branch: <?php echo $bankdetails->branch_name;?><br>
                GST No:  <?php echo $idetails->gst_no;?>
                <?php //$gstres = getGSTNumber($bankdetails->bank_id,$bankdetails->state_id); echo $gstres->gst_no;?><br>
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
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"  align="right">Date: <?php echo date('d-m-Y', strtotime($bankdetails->bill_date));?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px;" width="100%">SUB: Recoveries under SARFAESI / Physical Possession / Hypothecation Clause Commission Receivable, Collections, Seizures mode in the month of Recoveries as per our Contract Request - Reg. <br/>

        </td>
      </tr>
        <tr>
          <?php 
        
        $gstTotal1 =0;
        
        $i =1; 
        foreach ($invoice_details as $key => $value) { 
          
          $gstTotal1 += $value->gst;
          
        }
        ?>
           <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; " width="100%">Recovery Service Charge Provide to Financial Institute (or) Non-Banking Companies Request - Reg.<br/>
            <?php if($gstTotal1== 0){ ?>
  RCM Applicable <br>
        <?php } ?>
        </td>
        
        
      </tr>
    
      
      
    </table></td>
  </tr>
  <tr>
            <td>&nbsp;</td>
          </tr>
            <tr>
            <td>&nbsp;</td>
          </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" width="100%">
         Borrower Name: <strong><?php echo $bankdetails->barrower_name;?></strong>, <br>
              Account Number:<strong> <?php echo $bankdetails->loan_ac_number;?></strong>, <br>Account Type: <?php echo $loanDetails; ?><br>

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
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <?php if($bankdetails->state_id == 2) { ?>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" width="4%" align="center">SI.No</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="42%" align="center">Details</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="10%" align="center">Recovered Amt</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="10%" align="center">Date</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="10%" align="center">Commission Charges</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="7%" align="center">IGST (18%) </td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="7%" align="center">CGST </td>
        <?php }else{ ?>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" width="5%" align="center">SI.No</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="44%" align="center">Details</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="12%" align="center">Recovered Amt</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="11%" align="center">Date</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="10%" align="center">Commission Charges</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="9%" align="center">IGST (18%) </td>
        <?php } ?>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="10%" align="center">Total</td>
        
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
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;"  align="center"><?php echo $i++; ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center"><?php echo $value->borrower_name; ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">
          <?php if($value->recovered_amt !='0'){ ?>
                    <?php echo number_format($value->recovered_amt); ?>/-
          <?php } ?>
        </td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">
          <?php if($value->date !='0000-00-00'){
          echo date('d M Y',strtotime($value->date)); 
                    }?>
        </td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">
           <?php if($value->commission_charges !='0'){
                 echo number_format($value->commission_charges); 
                 ?>/-
           <?php } ?>
        </td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">
          <?php if($value->gst !='0'){
                echo number_format($value->gst); ?>/-
          <?php } ?></td>
            <?php if($bankdetails->state_id == 2) { ?>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">
          <?php if($value->cgst !='0'){
                echo number_format($value->cgst); ?>/-
          <?php } ?></td>
            <?php } ?>
           <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center"><?php echo number_format($value->total); ?>/-</td>
           </tr>
         <?php } ?>
           <tr>
               <?php if($bankdetails->state_id == 2) { ?>
             <td colspan="7" style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;  border-left:1px solid #333;  border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">
                 <?php } else { ?> 
                 <td colspan="6" style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;  border-left:1px solid #333;  border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">
                     <?php } ?>
               <strong>(Rupees <span id="wordamount"><?php echo ucwords(convertNumberToWord($grandTotal));?> Only)
             </td>
              <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center"><?php echo number_format($grandTotal);?>/-</td>
            </tr>
                  
                

           <!-- <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">
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
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2">
      
      We request you to kindly release the charges by way of RTGS /NEFT transfer as per the following details:<br />
                <?php if($bankdetails->bank_id == '24') { ?>
                <!-- IDBI Bank Details Custom -->
                <strong>
                HANSHITHA MANAGEMENT SERVICES, IDBI Bank<br>
                A/C No - 0002102000070975, IFSC Code: IBKL0000002, Branch: Basheer Bagh, Hyderabad
                </strong>
                <?php } else { ?>
                <!-- Default Bank Details -->
                <strong>
                HANSHITHA MANAGEMENT SERVICES, State Bank of India<br>
                A/C No: 37883058699, IFSC: SBIN0061790, Branch: Anjaneya Nagar, Hyderabad.
                </strong>
                <?php } ?>
      <?php if($idetails->vendor_no !='' &&  $idetails->vendor_no !='NULL'){?>Vendor ID: <?php echo $idetails->vendor_no;}?>
       </strong>
       <br/>
       Your Truly<br/>
       For <strong>HANSHITHA MANAGEMENT SERVICES</strong><br/><br/>
       <img src="<?php echo base_url(); ?>assets/images/signature5.png" width=''>
       <?php /*if(!empty($employeeData->employee_signature)){ ?>
            <img src="<?php echo base_url(); ?>assets/employee_doc/signature/<?php echo $employeeData->employee_signature; ?>" width=''>
            <?php }*/ ?><br />
       (Managing Partner)
    </td>
    
  </tr> 
  <?php  if(empty($bankdetails->received_invoice_id)){ ?>
   <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"  align="right" colspan="2">Authorized Signature</td>
      </tr>
  <?php } ?>
  <!--<tr>  
  <td colspan="2">
      <hr>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px;" width="89%"  align="center"></td>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px;" align="right" width="11%"><img src="<?php echo base_url(); ?>assets/images/buttom_right.png" width="200px"></td>
    </tr> 
    <tr>    
</tr>
    </table>
     
    </td>
    </tr>-->
  <tr>
    <td colspan="4"><small>This is computer generated invoice signature not required</small></td>
  </tr>
</table>
</body>
</html>
