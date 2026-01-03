
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Gsts">Gsts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add GST No</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Gsts/insertGsts'; ?>" name="formats_submit" id="formats_submit" method="post" enctype="multipart/form-data">
                 
                  <span class="small" id="gst_duplicate_error" style="color:red;"></span> 
                  <fieldset class="form-fieldset">
                    <legend>Branch Information Add Form</legend>
                      <div class="form-row">
                       <div class="form-group col-sm-6">
                        <label for="bank_id">Bank</label>
                        <select class="custom-select" id="bank_id" name="bank_id">
                          <option value='' selected>Select Bank</option>
                          <?php foreach ($banks as  $value) { ?>
                            <option value="<?php echo $value->bank_id; ?>" <?php if($action == 'edit'){  if($gstData->bank_id == $value->bank_id){ echo "selected"; }  } ?>><?php echo $value->bank_name; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="bank_id_error" style="color:red;"></span> 
                      </div>

                        <div class="form-group col-sm-6">
                        <label for="state_id">State</label>
                        <select class="custom-select" id="state_id" name="state_id">
                          <option value='' selected>Select State</option>
                          <?php foreach ($states as  $value) { ?>
                            <option value="<?php echo $value->state_id; ?>" <?php if($action == 'edit'){  if($gstData->state_id == $value->state_id){ echo "selected"; }  } ?>><?php echo $value->state_name; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="state_id_error" style="color:red;"></span> 
                      </div>

                      
                     
                    </div>
                     <div class="form-row">                      
                       <div class="form-group col-sm-6">
                        <label for="gst_no">GST Number</label>
                        <input type="text" class="form-control" id="gst_no" name="gst_no" value="<?php if($action == 'edit'){ echo $gstData->gst_no; } ?>">
                        <span class="small" id="gst_no_error" style="color:red;"></span> 
                      </div>
                      <?php /*
                      <div class="form-group col-sm-6">
                       <label for="fname">Select Branch:<span style="color: red">*</span></label>
                     <select class="custom-select" id="branch_id" name="branch_id">
                          <option value='' selected>Select Branch</option>
                          <?php foreach ($branchs as  $value) { ?>
                            <option value="<?php echo $value->branch_id; ?>" <?php if($action == 'edit'){  if($gstData->branch_id == $value->branch_id){ echo "selected"; }  } ?>><?php echo $value->branch_name; ?></option>
                          <?php } ?>
                        </select>
                      <span class="small" id="branch_id_error" style="color:red;"></span> 
                    </div>
                    */ ?>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="notes">Notes</label>
                            <textarea class="form-control" id="notes" name="notes"><?php if($action == 'edit'){ echo $gstData->notes; } ?></textarea>
                            <span class="small" id="notes_error" style="color:red;"></span> 
                        </div>
                    </div>
                     
                  
                    
                  </fieldset>
                    <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="gst_id" id="gst_id" value="<?php echo $gstData->gst_id; ?>">
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
      var bank_id = $("#bank_id").val();
     // var branch_name = $("#branch_name").val();
      var state_id = $("#state_id").val();
      var gst_no = $("#gst_no").val();
      var action = $("#action").val();
      // var branch_id = $("#branch_id").val();
      if(bank_id == ''){
        $("#bank_id_error").html("Please Select Bank Name");
        $("#bank_id").focus();
        return false;
      }else{
        $("#bank_id_error").html("");
      }
       if(state_id == ''){
        $("#state_id_error").html("Please Select State Name");
        $("#state_id").focus();
        return false;
      }else{
        $("#state_id_error").html("");
      }
    //   if(branch_id == ''){
    //     $("#branch_id_error").html("Please Select branch Name");
    //     $("#branch_id").focus();
    //     return false;
    //   }else{
    //     $("#branch_id_error").html("");
    //   }
      // if(branch_name == ''){
      //   $("#branch_name_error").html("Branch Name Required");
      //   $("#branch_name").focus();
      //   return false;
      // }else{
      //   $("#branch_name_error").html("");
      // }
       if(gst_no == ''){
        $("#gst_no_error").html("Gst No Is Required");
        $("#gst_no").focus();
        return false;
      }else{
        $("#gst_no_error").html("");
      }
      var gst_id = '0';
      if(action == 'edit'){
        gst_id = $("#gst_id").val();       
      }

      var result = 0;

     $.ajax({  
        url:"<?php echo base_url(); ?>Gsts/checkDupliate",
        data: 'bank_id='+bank_id+'&state_id='+state_id+'&action='+action+'&gst_id='+gst_id, 
        type: "POST",  
        async: false,
        success:function(data){ 
          
          if(action == 'edit'){

            if(data['bank_id'] == bank_id && data['state_id'] == state_id){
                    result = 1;
            }else {
            $.ajax({  
            url:"<?php echo base_url(); ?>Gsts/checkDupliate",
            data: 'bank_id='+bank_id+'&state_id='+state_id+'&gst_id='+gst_id+'&action=add', 
            type: "POST",  
            async: false,
            success:function(data){ 
              if(!data){
                 //return true; //true;
                 result = 1;
              }else {
              $("#gst_duplicate_error").html("Gst No Already Available");
                // return false;
                 result = 0;
              }
            }
            });   
            }   

          }else {
            if(!data){
              //return true; //true;
              result = 1;
            }else {
               $("#gst_duplicate_error").html("Gst No Already Available");
               //return false;
               result = 0;
            }
            
          }

        }
    });


   if(result == '0'){
    return false;
   }else {
    return true;
   }
   
   



    });

$(document).ready(function(){
    $("#bank_id").on("change",function(){
     var bank_id = $(this).val();
     var state_id = $("#state_id").val();
     $.ajax({  
        url:"<?php echo base_url(); ?>Gsts/getBranchas",
        data: {bank_id: bank_id,state_id: state_id },  
        type: "POST",  
        success:function(data){ 
          
            var htmlString ='';
            htmlString+="<option value=''>Select Branch</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['branch_id']+">"+data[i]['branch_name']+"</option>"
            });
            // $("#branch_id").html(htmlString);    
        }
    });
  });
    $("#state_id").on("change",function(){
     var state_id = $(this).val();
     var bank_id = $("#bank_id").val();
     $.ajax({  
        url:"<?php echo base_url(); ?>Gsts/getBranchas",
        data: {bank_id: bank_id,state_id: state_id  },  
        type: "POST",  
        success:function(data){ 
            var htmlString ='';
            htmlString+="<option value=''>Select Branch</option>"
            $.each(data,function(i){
            htmlString+="<option value="+data[i]['branch_id']+">"+data[i]['branch_name']+"</option>"
            });
            // $("#branch_id").html(htmlString);    
        }
    });
  });
});

  </script>
</body>

</html>