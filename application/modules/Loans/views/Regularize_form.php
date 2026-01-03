    <!-- Main body -->
    <div class="main-body">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
           <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loans">Loan Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            <?php if($type=='reg'){ echo 'Regularize';}else { echo "Close";} ?> Form</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
      <div class="row">
        <div class="col">
          <section id="section1" class="mt-1"> 
            <h5> <?php if($type=='reg'){ echo 'Regularize';}else { echo "Close";} ?> Form</h5>
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Loans/insertForm'; ?>" name="regularize_submit" id="regularize_submit" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="borrower_contact_no_1">Borrower Contact No.1</label>
                      <input type="text" class="form-control" id="borrower_contact_no_1" name="borrower_contact_no_1" placeholder="Brrower Contact No.1" value="<?php if($action == 'edit'){ echo $regularizeData->borrower_contact_no_1; } ?>">
                      <span class="small" id="borrower_contact_no_1_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-4">
                      <label for="borrower_contact_no_2">Borrower Contact No.2</label>
                      <input type="text" class="form-control" id="borrower_contact_no_2" name="borrower_contact_no_2" placeholder="Borrower Contact No.2" value="<?php if($action == 'edit'){ echo $regularizeData->borrower_contact_no_2; } ?>">
                      <span class="small" id="borrower_contact_no_2_error" style="color:red;"></span> 
                    </div>
                      <div class="form-group col-md-4">
                      <label for="other_contact_no_1">Other Contact No.1</label>
                      <input type="text" class="form-control" id="other_contact_no_1" name="other_contact_no_1" placeholder="Other Contact No.1" value="<?php if($action == 'edit'){ echo $regularizeData->other_contact_no_1; } ?>">
                      <span class="small" id="other_contact_no_1_error" style="color:red;"></span> 
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="other_contact_no_2">Other Contact No.2</label>
                      <input type="text" class="form-control" id="other_contact_no_2" name="other_contact_no_2" placeholder="Other Contact No.2" value="<?php if($action == 'edit'){ echo $regularizeData->other_contact_no_2; } ?>">
                      <span class="small" id="other_contact_no_2_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-4">
                      <label for="remarks">Performance Remarks</label>
                      <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks"><?php if($action == 'edit'){ echo $regularizeData->remarks; } ?></textarea>
                      <span class="small" id="remarks_error" style="color:red;"></span> 
                    </div>
                  </div>


                  <input type="hidden" name="loan_id" value="<?php echo $loan_id; ?>">
                  <input type="hidden" name="action" value="<?php echo $action; ?>">
                   <input type="hidden" name="type" value="<?php echo $type; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="id" value="<?php echo $regularizeData->id; ?>">
                   <?php } ?>
                  <button class="btn btn-secondary" type="reset">Reset</button>
                  <button class="btn btn-primary" type="submit">Save</button>
                </form>
              </div>
            </div>
          </section>

         
        </div>

      
      </div>
    </div>
    <!-- /Main body -->


  </div>
  <!-- /Main -->

  <!-- Main Scripts -->
  <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>
  
  <!-- Plugins -->
  <!-- JS plugins goes here -->
  <script type="text/javascript">


    $("#regularize_submit").on("submit",function(){
     
      var borrower_contact_no_1 = $("#borrower_contact_no_1").val();
         
    
      if(borrower_contact_no_1 == ''){
        $("#borrower_contact_no_1_error").html("Borrower Contact Noumber Is Required");
        $("#borrower_contact_no_1").focus();
        return false;
      }else{
        $("#borrower_contact_no_1_error").html("");
      }
    });
  </script>

</body>

</html>