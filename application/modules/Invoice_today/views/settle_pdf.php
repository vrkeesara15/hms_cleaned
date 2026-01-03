<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  

  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td width="40%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"> 
                Invoice No : <?php echo $invoice_id; ?><br>
               <strong>From,</strong><br>
                Name: <?php echo $employeeDetails->fname.' '.$employeeDetails->lname; ?><br>
                Address: <?php echo $employeeDetails->emp_address; ?><br>
                
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
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"  align="right">
            Date: <?php echo Date('d M Y'); ?> <br >
            Ref Invoice No : <?php echo $contractor_charges->contractor_charges_id; ?> <br >
            PAN No : <?php echo $employeeDetails->pan_number; ?> <br >
            </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="40%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
         
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"> 
               <strong>To,</strong><br>
                <strong>M/s. HANSHITHA MANAGEMENT SERVICES</strong><br>
                ADDRESS: plot No.218,shiva sai hills<br>
                Road No.5, gajularamaram,<br>
                Quthbullapur,Hyderabad,500055.
                
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
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"  align="right">
             <br >
            GST.NO : 36AALFH3397N1ZM <br>
            PAN No : AALFH3397N<br >
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
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" width="5%" align="center">SI.No</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="85%" align="center">Description</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="10%" align="center">Amount</td>
        
      </tr>
       <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;"  align="center">1</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">Contract charges for the month of <?php echo Date('M-Y'); ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center"><?php echo number_format($contractor_charges->net_contractor_charges);?></td>
       </tr>
                  <tr>
             <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;  border-left:1px solid #333;  border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">
               <strong>(Rupees <span id="wordamount"><?php echo ucwords(convertNumberToWord($contractor_charges->net_contractor_charges));?> </span>Only)</strong>
             </td>
              <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center"><strong><?php echo number_format($contractor_charges->net_contractor_charges);?>/-</strong></td>
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
    <td width="40%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"> 
                PAN No: <?php echo $employeeDetails->pan_number; ?> <br />
                    <strong>Bank account Details: </strong><br />
                    Name: <?php echo $employeeDetails->fname.' '.$employeeDetails->lname; ?> <br /> 
                    A/C No:&nbsp;<?php echo $employeeDetails->account_number; ?> <br />
                    Bank:&nbsp;<?php echo $employeeDetails->bank_name; ?> <br />
                    IFSC Code:&nbsp;<?php echo $employeeDetails->ifsc_code?> <br />
                    Branch:&nbsp;<?php echo $employeeDetails->branch_name; ?> <br>
                    Adress:&nbsp;<?php echo $employeeDetails->branch_address; ?><br>
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
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"  align="right">
             <br >
             <br >
            <?php echo $employeeDetails->fname.' '.$employeeDetails->lname; ?> <br >
            Authorised signatory <br >
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
    <td colspan="4"><small>This is computer generated invoice signature not required</small></td>
  </tr>
</table>
</body>
</html>
