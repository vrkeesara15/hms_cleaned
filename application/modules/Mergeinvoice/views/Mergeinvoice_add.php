<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Mergeinvoice">Merged Invoices</a></li>
          <li class="breadcrumb-item active" aria-current="page">Merge Invoices</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Mergeinvoice/insertMergeinvoice'; ?>" name="formats_submit" id="formats_submit" method="post" enctype="multipart/form-data">
                 
                  <span class="small" id="gst_duplicate_error" style="color:red;"></span> 
                  <fieldset class="form-fieldset">
                    <legend>Invoice Merge Form</legend>
                      <div class="form-row">
                        <div class="col-sm-2">
                            <label for="fname">Select Bank:<span style="color: red">*</span></label>
                            <select class="custom-select" id="bank_id" name="bank_id">
                              <option value='' selected>Select Bank</option>
                              <?php foreach ($banks as  $value) { ?>
                                <option value="<?php echo $value->bank_id; ?>" <?php if($action == 'edit'){  if($gstsdata->bank_id == $value->bank_id){ echo "selected"; }  } ?>><?php echo $value->bank_name; ?></option>
                              <?php } ?>
                            </select>
                          <span class="small" id="bank_id_error" style="color:red;"></span> 
                        </div>
                    <div class="col-sm-3">
                       <label for="fname">Select Branch:<span style="color: red">*</span></label>
                        <select class="custom-select" id="branch_id" name="branch_id">
                          <option value='' selected>Select Branch</option>
                          <?php /*foreach ($branchs as  $value) { ?>
                            <option value="<?php echo $value->branch_id; ?>" <?php if($action == 'edit'){  if($loanAccountData->branch_id == $value->branch_id){ echo "selected"; }  } ?>><?php echo $value->branch_name; ?></option>
                          <?php } */ ?>
                        </select>
                      <span class="small" id="branch_id_error" style="color:red;"></span> 
                    </div>
                    
                       <div class="col-sm-6">
                        <label for="invoice_id">Invoice List with Same GST: <span style="color: red">*</span></label><br />
                        <select class=" selectpicker" id="invoice_id" name="invoice_id[]" multiple data-live-search="true">
                          <option value=''>Select Invoice Ids</option>
                          <?php 
                          /* if(!empty($invoiceIds)){
                          foreach ($invoiceIds as  $invoiceId) { ?>
                            <option value="<?php echo $invoiceId->id.'_'.$invoiceId->gst_no; ?>" ><?php echo '#'.$invoiceId->invoice_account; ?></option>
                          <?php } } */ ?>
                        </select>
                        <br>
                        <span class="small" id="invoice_id_error" style="color:red;"></span> 
                      </div>
                    </div>
                    
                  </fieldset>
                    <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                 
                  <button class="btn btn-primary" type="submit">Merge</button>
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
<!--  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
-->  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  <!-- <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->

  <!-- Plugins -->
  <!-- JS plugins goes here -->
<script type="text/javascript">
 $("#bank_id").on("change",function(){
     var bank_id = $(this).val();
     $.ajax({  
        url:"<?php echo base_url(); ?>Mergeinvoice/getBranchas",
        data: {bank_id: bank_id },  
        type: "POST",  
        success:function(data){ 
          //console.log(data);
            var htmlString ='';
            htmlString+="<option value=''>Select Branch</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['branch_id']+"_"+data[i]['gst_no']+">"+data[i]['branch_name']+"</option>";
            });
            //console.log(htmlString);
            $("#branch_id").html(htmlString);    
            //$('#gst_no').attr('value', data[0]['gst_no']).change();        
        }
    });
  });
  
  $("#branch_id").on("change",function(){
     var branch_id = $(this).val();
     var gst = branch_id.split('_');
    var maxLength = 30;
    var ellipsis = "...";
    var originalText = "";

     $.ajax({  
        url:"<?php echo base_url(); ?>Mergeinvoice/getInvoices",
        data: {gst_no: gst[1] },  
        type: "POST",  
        success:function(data){
            var htmlString ='';
            htmlString+="<option value=''>Select Invoice</option>"
            $.each(data,function(i){
                originalText = data[i]['invoice_account'];
                if (originalText.length > maxLength) {
                  var truncatedText = originalText.substring(0, maxLength);
                  var newText = truncatedText + ellipsis;
                  htmlString+="<option value="+data[i]['id']+"_"+data[i]['gst_no']+">"+newText+"</option>";
                } else {
                    htmlString+="<option value="+data[i]['id']+"_"+data[i]['gst_no']+">"+data[i]['invoice_account']+"</option>";
                }
                
            });
            
            $("#invoice_id").html(htmlString);   
            $('.selectpicker').selectpicker('refresh');
        }
    });
  });
  
  

    $("#formats_submit").on("submit",function(){
      var invoice_id = $("#invoice_id").val();
      if(invoice_id.length < 2){
          $("#invoice_id_error").html("Please select 2 invoices to merge");
          return false;
      }else{
          var othergst = 0;
          var oldgst = invoice_id[0];
          oldgst = oldgst.split('_');
          oldgst = oldgst[1];
          for(i=1;i<=invoice_id.length;i++){
              var invs = invoice_id[i].split('_');
              var gstval = invs[1];
              console.log(gstval);
              if(oldgst != gstval){
                 $("#invoice_id_error").html("Selected Invoices should of same branch");
                return false;
              }
          }
          $("#invoice_id_error").html("");
      }

    });
    
    $(function () {
        $('#invoice_id').selectpicker();

       
    });
</script>
</body>

</html>