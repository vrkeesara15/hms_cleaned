<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Loan Type</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">
  <section id="section4" class="mt-2">
           
           
            <div class="card">
              <div class="card-body">
                 <form action="<?php echo base_url().'Loans/checkloantype'; ?>" name="loanaccount_submit" id="loanaccount_submit" method="post" enctype="multipart/form-data">
                  <fieldset class="form-fieldset">
                    <legend>Loan Type Selection</legend>
                 

                 
                
                  <div class="form-row">
                     <div class="form-group col-md-4">
                     <label for="branch_controller">Select Loan Type</label>
                    <select class="form-control" name="loan_type"id="loan_type">
                      <option value="1">Car Loans</option>
                      <option value="2">Personal Loans</option>
                      <option value="3">Education Loan</option>
                      <option value="4">AUCA Loan</option>   
                      <option value="5">Home Loans/Surface Loans</option>
                      <option value="6">MSME/Business Loan</option>
                      <option value="7">Mudra Loan</option>
                      <option value="8">Crop/Agriculture Loan</option>
                                       
                    </select>
                      <span class="small" id="branch_controller_error" style="color:red;"></span>
                    </div>
                  </div>
                 </fieldset>
                  <button class="btn btn-primary" type="submit">Submit</button>
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


  $(document).ready(function(){
    $("#bank_id").on("change",function(){
     var bank_id = $(this).val();
     $.ajax({  
        url:"<?php echo base_url(); ?>Loanaccounts/getBranchas",
        data: {bank_id: bank_id },  
        type: "POST",  
        success:function(data){ 
            var htmlString ='';
            htmlString+="<option value=''>Select Branch</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['branch_id']+">"+data[i]['branch_name']+"</option>"
            });
            $("#branch_id").html(htmlString);            
        }
    });
   
    });

     $("#order_id").on("change",function(){
     var order_id = $(this).val();
     $.ajax({  
        url:"<?php echo base_url(); ?>Loanaccounts/getWorkOrderDetails",
        data: {order_id: order_id },  
        type: "POST",  
        success:function(data){ 

          $('#bank_name').attr('placeholder', data['bank_name']);
          $('#branch_name').attr('placeholder', data['branch_name'])          

          $('#bank_id').attr('value', data['bank_id']);
          $('#branch_id').attr('value', data['branch_id'])          
        }
    });
   
    });
  });

   </script>

</body>

</html>