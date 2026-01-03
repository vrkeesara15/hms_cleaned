<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>1st Notice - SBI</title>
  <style>
    body {
      font-family: Verdana, Geneva, sans-serif;
      font-size: 13px;
      margin: 20px;
    }
    .heading {
      font-size: 16px;
      font-weight: bold;
      margin: 20px 0 10px 0;
    }
    .justify {
      text-align: justify;
      line-height: 1.6;
    }
    .bold {
      font-weight: bold;
    }
    .border-wrapper {
      border: 1px solid #000;
      padding: 10px;
      margin-bottom: 20px;
    }
    table td {
      vertical-align: top;
    }
    .logo {
      text-align: center;
      margin-bottom: 10px;
    }
    .notice-title {
      text-align: right;
      font-size: 15px;
      font-weight: bold;
      margin-bottom: 10px;
      text-transform: uppercase;
    }
  </style>
</head>
<body>

<!-- SBI Logo -->
<div class="logo">
    <?php if(!empty($bankData->bank_logo)){ ?>
  <img src="https://hanshithagroup.com/emp/assets/banks/<?php echo $bankData->bank_logo; ?>" alt="SBI Logo" width="100">
  <?php }else{ ?>
  Logo Not available
  <?php } ?>
</div>

<!-- Notice Title -->
<div class="notice-title">1st Notice</div>

<!-- Single bordered box for From & To -->
<div class="border-wrapper">
  <table width="100%" cellpadding="5" cellspacing="0">
    <tr>
      <td width="50%">
        <span class="bold">From</span><br>
         <?php if(!empty($bankData)){ echo $bankData->bank_name . ",<br>" . $branchData->branch_address; } else { ?>
        STATE BANK OF INDIA <br>
        RACPC-II, 3RD FLOOR “KTC ILLUMINATION” <br>
        PLOT NO:32 TO 34 & 39 TO 41, <br>
        NEAR IMAGE HOSPITAL <br>
        MAHDAPUR, HYDERABAD-500081
        <?php } ?>
        
      </td>
      <td width="50%">
        <span class="bold">To</span><br>
        <?php if(!empty($loanAccountData)){ echo $loanAccountData->barrower_name . ",<br>" . $loanAccountData->borrower_address; } else { ?>
        MR. A RATNA MOHAN,<br>
        S/O SUBHAS CHANDRA C<br>
        H NO 1-59/D-582,<br>
        NEW MARUTHI NAGAR, <br>
        ROAD NO-05, KOTHAPET, <br>
        SAROOR NAGAR, HYDERABAD-500035
        <?php } ?>
      </td>
    </tr>
  </table>
</div>

<!-- Date and Salutation -->
<div style="text-align: right;">
  Date: <?php echo date('d-m-Y'); ?>
</div>

<p><strong>Dear Sir/Madam,</strong></p>

<!-- Subject -->
<div class="heading">
  Loan A/c No. <?php echo !empty($loanAccountData) ? $loanAccountData->loan_ac_number : "38154268348"; ?> – Irregularity in Repayment
</div>

<!-- Body -->
<div class="justify">
  This has reference to your loan account with our Bank for an amount of 
  <strong><?php echo !empty($loanAccountData) ? "Rs. " . number_format($loanAccountData->approved_amount) . "/-" : "Rs.5,30,000/-"; ?></strong>
  availed by you on 
  <strong><?php echo !empty($loanAccountData) ? date('d-m-Y',strtotime($loanAccountData->approval_date)) : ""; ?></strong>
  for purchase of Vehicle/Car. The loan was disbursed to you upon executing the necessary loan documents by you including Hypothecation Agreement hypothecating the vehicle as security for the loan.
  <br><br>
  2. As per the terms and conditions of sanction of the loan, you are required to repay the installments/ loan dues on the due date on each month as per the agreed repayment schedule mentioned in the sanction terms without prejudice to the right of the Bank to recall the loan on demand. However, you have failed to repay the instalment on due date and/or there was no sufficient balance available in your Savings/ Current Account for debit towards dues of the loan amount.
  <br><br>
  3. You are therefore requested to deposit a sum of 
  <strong><?php echo !empty($loanAccountData) ? "Rs. " . number_format($loanAccountData->irregular_amount) . "/-" : "Rs.16,945/-"; ?></strong>
  and regularise the loan account within 15 days of receipt of this notice. In case of your failure to repay the over dues and regularise the loan account, the bank shall be constrained to recall the entire amount outstanding and also to initiate necessary action to recover the dues including the repossession/ seizure of the vehicle and to eventually sell it off in public auction/ private treaty for satisfaction of the Bank’s dues.
  <br><br>
  4. We therefore hereby call upon you to deposit the over dues immediately in any case not beyond 15 days to avoid any of the actions referred above.
</div>

<!-- Signature -->
<div style="margin-top: 40px;">
  Yours faithfully,<br><br>
  <strong><?php if(!empty($loanAccountData->addressing_text)) {
      echo $loanAccountData->addressing_text; 
  }else{ 
      echo 'Branch Manager / Authorised Officer'; 
  } ?></strong><br>
  <?php //echo $bankData->bank_name; ?>
</div>

</body>
</html>
