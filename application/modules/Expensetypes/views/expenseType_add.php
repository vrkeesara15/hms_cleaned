
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>ExpenseTypes">Expense Types</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Expensetypes/addExpense'; ?>" name="formats_submit" id="formats_submit" method="post" enctype="multipart/form-data">
                 
                  <fieldset class="form-fieldset">
                    <legend>Expense Type Information Add Form</legend>
                      <div class="form-row">
                        <div class="form-group col-sm-4">
                        <label for="expense_type">Expense Type</label>
                        <input type="text" class="form-control" id="expense_type" name="expense_type" value="<?php if($action == 'edit'){ echo $expenseTypeData->expense_type; } ?>">
                        <span class="small" id="expense_type_error" style="color:red;"></span> 
                      </div>
                    </div>
                  </fieldset>
                    <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="expensetype_id" id="expensetype_id" value="<?php echo $expenseTypeData->id; ?>">
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
  <!-- <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->

  <!-- Plugins -->
  <!-- JS plugins goes here -->
<script type="text/javascript">

    $("#formats_submit").on("submit",function(){
      var expense_type = $("#expense_type").val();
      if(expense_type == ''){
        $("#expense_type_error").html("Expense Type Required");
        return false;
      }else{
        $("#expense_type_error").html("");

      }

    });
  </script>
</body>

</html>