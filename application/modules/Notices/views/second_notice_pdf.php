<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>2nd Notice - <?php if(!empty($bankData)){ echo $bankData->bank_name; }else{ ?>SBI <?php } ?></title>
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
  <img src="<?php echo base_url(); ?>/assets/banks/<?php echo $bankData->bank_logo; ?>" alt="<?php echo $bankData->bank_logo; ?>" width="100">
</div>

<!-- Notice Title -->
<div class="notice-title">2nd Notice</div>

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

<!-- Date and Salutation -->
<div style="text-align: right;">
  Date: <?php echo date('d-m-Y'); ?>
</div>

<p><strong>Dear Sir/Madam,</strong></p>

<!-- Subject -->
<div class="heading">
  REPOSSESSION OF VEHICLE LOAN ACCOUNT NO. <?php echo !empty($loanAccountData) ? $loanAccountData->loan_ac_number : ""; ?>
</div>

<!-- Body -->
<div class="justify">
  Please refer to the Notice dated 
  <strong><?php echo !empty($loanAccountData) ? date('d-m-Y',strtotime($loanAccountData->first_notice_date)) : ""; ?></strong>
  requesting you to regularize your loan account 
  <br><br>
  2. It is noticed that despite out notice and requests, you have failed to repay the dues as mentioned in the said notice. As you have failed to repay the dues within the time period mentioned therein, the Bank has recalled the entire outstanding payable under the loan account. Besides, your account has been classified as non-performing asset with effect from 
  <strong><?php echo !empty($loanAccountData) ? date('d-m-Y',strtotime($loanAccountData->npa_date)) : ""; ?></strong> in accordance with income recognition and prudential accounting norms prescribed by RBI for Banks.
  <br><br>
  3. Therefore, you are hereby called upon to repay the entire loan outstanding along with interest within 7 days from the date of this notice. In case of your failure to repay and close the account, the Bank shall repossess the vehicle hypothecated by you as security towards the loan through M/s HANSHITHA MANAGEMENT SERVICES acting as Bank’s authorized Recovery Agent for repossession / sale.
  <br><br>
  4. You are requested to co-operate with the said Recovery Agent and deliver possession of the vehicle together with all switch keys and other accessories, registration certificates, insurance policy or policies to enable the Bank to sell or dispose of the same in any manner they think fit for the purpose of realization of the due in the loan account. Please also note that the charges towards repossession and garage parking charges, if any, until the date of sale and realization of the vehicle shall be charges and recovered from your loan account.
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
