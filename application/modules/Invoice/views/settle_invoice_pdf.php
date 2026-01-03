<DOCTYPE html>
<html lang="en">
<head>
	<title>Invoice</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,intial-scale=1.0">
</head>
<body>
        <table>
	    <tr><td>&nbsp;</td></tr>
	    <tr><td>&nbsp;</td></tr>
	</table>
        <table width="80%" border="1" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<th colspan="3" align="center" style="text-align:center;">INVOICE</th>
		</tr>
		<tr>
			<td style="margin:20px;padding:10px;">From:<br>
			Name:&emsp;<?php echo $employeeDetails->fname.' '.$employeeDetails->lname; ?><br>
			address:&emsp;<?php echo $employeeDetails->emp_address; ?>
			</td>
			<td colspan="2" style="border-spacing:40px;">
			Date:&emsp;&emsp;&emsp;&emsp;<?php echo Date('d.m.Y'); ?><br>
			Invoice No:&emsp;<?php echo $invoice_id; ?><br>
			PAN NO:&emsp;&emsp;<?php echo $employeeDetails->pan_number; ?><br>
			</td>
		</tr>
		<tr>
			<td style="margin:20px;padding:20px;">TO<br>
			M/s. HANSHITHA MANAGEMENT SERVICES<br>
			ADDRESS:&emsp;plot No.218,shiva sai hills<br>
			Road No.5, gajularamaram,<br>Quthbullapur,Hyderabad,500055.</td>
			<td colspan="2">
			GST.NO    &emsp;36AALFH3397N1ZM<br>
			PAN No  &emsp;  AALFH3397N
			</td>
		</tr>
		<tr>
			<th>S.No</th>
			<th>Description</th>
			<th>Amount</th>
		</tr>
		<tr>
			<td  width="40%">1</td>
			<td>&emsp; Contract charges for the month of <?php echo Date('M-Y'); ?></td>
			<td><?php echo number_format($contractor_charges->net_contractor_charges); ?></td>
		</tr>
		<tr>
			<th colspan="2">Total</th>
			<td rowspan="2" align="center"><?php echo number_format($contractor_charges->net_contractor_charges);?></td> 
		</tr>
		<tr>
		<td colspan="2" align="center"> Rupees <span id="wordamount"><?php echo ucwords(convertNumberToWord($contractor_charges->net_contractor_charges));?> </span>Only</td></tr>
		<tr>
			<td colspan="3" style="padding:3px;">PAN No:&emsp;&emsp;&emsp;<?php echo $employeeDetails->pan_number; ?><br>
			Bank account Details:<br>
			Name:&emsp;&emsp;&emsp; <?php echo $employeeDetails->fname.' '.$employeeDetails->lname; ?><br>
			A/C No:&emsp;&emsp;&emsp;<?php echo $employeeDetails->account_number; ?><br>
			Bank:&emsp;&emsp;&emsp;&emsp;<?php echo $employeeDetails->bank_name; ?> 
			<br>
			IFSC Code:&emsp;<?php echo $employeeDetails->ifsc_code?><br>
			Branch:&emsp;&emsp;&emsp;<?php echo $employeeDetails->branch_name; ?><br>
			Adress:&emsp;&emsp;&emsp;<?php echo $employeeDetails->branch_address; ?></td>
		</tr>
		
		
	</table>
	<table width="90%">
	    <tr><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th></tr>
	    <tr><td colspan="3" align="right">
			&emsp;&emsp;&emsp;<?php echo $employeeDetails->fname.' '.$employeeDetails->lname; ?><br>Authorised signatory
			</td></tr>
			</table>
			<table>
	    <tr><td>&nbsp;</td></tr>
	    <tr><td>&nbsp;</td></tr>
	</table>
</body>
</html>