  <tr>
      <th colspan="3">Advance Payments</th>
      
  </tr>
  <tr>
      <th>S.No</th>
      <th>Date</th>
      <th>Amount</th>
  </tr>
  <?php 
      if(!empty($manualDebits)){ 
          $sno = 1; 
        foreach($manualDebits as $debitValue){ ?>
  <tr>
      <td><?php echo $sno; ?></td>
      <td><?php echo Date('d-M-Y',strtotime($debitValue->debit_date)); ?></td>
      <td><?php echo $debitValue->amount;  ?></td>
  </tr>
  <?php $sno++; } } ?>