 <section id="section2" class="mt-1">
            <h5>Bank Charges</h5>
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                 <table class="table table-bordered">
                    <thead >
                      <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Bank Name</th>
                        <th scope="col">Charge Name</th>
                        <th scope="col">Amount</th>                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($charges){
                        $i=1;
                        foreach ($charges as  $value) { ?>
                      <tr>
                        <th scope="row"><?php echo $i;?></th>
                        <td><?php echo $value->bank_name;?></td>
                        <td><?php echo $value->charge_name;?></td>
                        <td><?php echo $value->charge_amount;?></td>            
                      </tr>
                    <?php $i++; } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>