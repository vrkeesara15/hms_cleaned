<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Final Notice - <?php if(!empty($bankData)){ echo $bankData->bank_name; }else{ ?>SBI <?php } ?></title>
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
    .highlight {
      background-color: yellow;
      font-weight: bold;
    }
     .branch-details {
      text-align: center;
      font-weight: bold;
      margin-bottom: 10px;
      font-size: 14px;
    }
  </style>
</head>
<body>

<!-- SBI Logo -->
<div class="logo">
  <img src="<?php echo base_url(); ?>/assets/banks/<?php echo $bankData->bank_logo; ?>" alt="<?php echo $bankData->bank_logo; ?>" width="100">
</div>

<div class="branch-details">
  <?php echo (!empty($bankData) ? $bankData->bank_name : 'BRANCH NAME') ?><br>
  <?php echo (!empty($branchData) ? $branchData->branch_address : 'BRANCH ADDRESS') ?>
</div>

<!-- Single bordered box for From & To -->
<div class="border-wrapper">
  <table width="100%" cellpadding="5" cellspacing="0">
    <tr>
      
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

<!-- Date -->
<div style="text-align: right;">
  Date: <?php echo date('d-m-Y'); ?>
</div>

<!-- Salutation -->
<p><strong>Dear Sir/Madam,</strong></p>

<!-- Subject -->
<div class="heading">
  Car Loan A/c No. <?php echo !empty($loanAccountData) ? $loanAccountData->loan_ac_number : 'Account No'; ?><br>
  VEHICLE NO: <?php echo !empty($loanAccountData) ? $loanAccountData->vehicle_registration_number : 'Vehicle Registration No'; ?>
</div>

<!-- Body -->
<div class="justify">
  We refer to our notice advising you to discharge the debt due to the bank. We have also advised you in the said letter that the bank would be constrained to take possession of the vehicle hypothecated to the bank, in case you failed to discharge the debt.
  <br><br>
  2. Despite the above notice, you have failed to discharge the debt, and the bank has taken possession of the vehicle from you.
  <br><br>
  3. The bank has decided to auction the vehicle in <strong>Public Auction on 
  <?php echo !empty($loanAccountData) ? date('d-m-Y', strtotime($loanAccountData->auction_date)) : '15-05-2025'; ?></strong>,
  by inviting tenders from the public. The said auction notice has been published in
  <strong><?php echo !empty($loanAccountData) ? $loanAccountData->telugu_news_paper : 'Eenadu'; ?> and 
 <?php echo !empty($loanAccountData) ? $loanAccountData->english_news_paper : 'The Hindu'; ?></strong> newspapers on 
  <strong><?php echo !empty($loanAccountData) ? date('d-m-Y', strtotime($loanAccountData->news_publication_date)) : '10-05-2025'; ?></strong>.
  <br><br>
  4. You are hereby given one more opportunity to repay the bank dues plus interest, seizure charges, storage charges, paper publication charges, and other expenses immediately, to avoid auction of your vehicle hypothecated to the bank, within 7 days from the date of this letter.
  <br><br>
  5. Please treat this letter as <strong>final notice</strong> for auctioning the car and a suit will be filed in the court of law against you for the remaining balance after appropriating the net sale proceeds in the auction.
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
