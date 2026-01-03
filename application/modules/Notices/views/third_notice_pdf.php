<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sale Notice - <?php if(!empty($bankData)){ echo $bankData->bank_name; } ?></title>
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
  <img src="https://hanshithagroup.com/emp/assets/banks/<?php echo $bankData->bank_logo; ?>" alt="SBI Logo" width="100">
</div>

<!-- Notice Title -->
<!--<div class="notice-title">1st Notice</div>-->

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
        <?php if(!empty($loanAccountData)){ echo $loanAccountData->barrower_name . ",<br>" . $loanAccountData->cus_address; } else { ?>
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

<div style="text-align: center;">
 <strong><u>SALE NOTICE</u></strong>
</div>
<br />
<div style="text-align: center;">
<u>(Letter to the Borrower before effecting the Sale of Repossessed Vehicle)</u>
</div>

<!-- Date and Salutation -->
<div style="text-align: right;">
  Date: <?php echo date('d-m-Y'); ?>
</div>

<p><strong>Dear Sir/Madam,</strong></p>

<!-- Subject -->
<div class="heading">
  Sub: Sale Notice Loan A/c No – <?php echo !empty($loanAccountData) ? $loanAccountData->loan_ac_number : ""; ?>
</div>

<!-- Body -->
<div class="justify">
  This has reference to our earlier notices with respect to your captioned loan account. On your failure to repay the dues, the Bank had repossessed the vehicle bearing registration No.
  <strong><?php echo !empty($loanAccountData) ? $loanAccountData->vehicle_registration_number : ""; ?></strong>
  purchased under the loan amount.
  <br><br>
  2. As you have failed to repay the dues in spite of repeated reminders/ notices and repossession of the vehicle by the bank, it has been decided to sell the vehicle to recover the dues under the loan account. The bank shall sell the vehicle through public auction or private treaty or any other mode of sale for a price acceptable to the Bank immediately on expire of 7 days of expiry of this notice. You are given a final opportunity to repay the entire loan amount along with interest and other charges within 7 days failing which the vehicle shall be sold by the bank towards the amount due under the loan. In case the proceeds of the sale of vehicle is insufficient to satisfy the entire dues of the loan account, Bank shall initiate necessary legal action for recovery of the remaining dues for which you will be absolutely liable until full discharge.
  <br><br>
 
</div>

<!-- Signature -->
<div style="margin-top: 40px;">
  Yours faithfully,<br><br>
  <strong><?php if(!empty($loanAccountData->addressing_text)) {
      echo $loanAccountData->addressing_text; 
  }else{ 
      echo 'Branch Manager / Authorised Officer'; 
  } ?></strong><br>
  <?php // echo $bankData->bank_name; ?>
</div>

</body>
</html>
