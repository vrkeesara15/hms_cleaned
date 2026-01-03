
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Formats">Format</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Format</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          
          <section id="section2" class="mt-2">
          
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Formats/insertFormats'; ?>" name="formats_submit" id="formats_submit" method="post" enctype="multipart/form-data">
                 
                  
                  <fieldset class="form-fieldset">
                    <legend>Format Doc Form</legend>
                      <div class="form-row">
                       <div class="form-group col-sm-6">
                        <label for="bank_id">Bank</label>
                        <select class="custom-select" id="bank_id" name="bank_id">
                          <option value='' selected>Select bank</option>
                          <?php foreach ($bank_details as $key => $value) { ?>
                            <option value="<?php echo $value->bank_id; ?>" <?php if($action == 'edit'){  if($formatsdata->bank_id == $value->bank_id){ echo "selected"; }  } ?>><?php echo $value->bank_name; ?></option>
                          <?php } ?>
                        </select>
                        <span class="small" id="bank_id_error" style="color:red;"></span> 
                      </div>
                       <div class="form-group col-sm-6">
                        <label for="type_of_loan">Type Of Loan</label>
                        <input type="text" class="form-control" id="type_of_loan" name="type_of_loan" value="<?php if($action == 'edit'){ echo $formatsdata->type_of_loan; } ?>">
                        <span class="small" id="type_of_loan_error" style="color:red;"></span> 
                      </div>

                     
                    </div>
                    <div id="doc_files">
                        
                    </div>
                    <?php 
                        /*print_r($formatDocumentsData);*/
                    if($action == 'edit') {
                        $i=1;
                       // foreach($formatDocumentsData as $key => $value) {
                            /*echo 'doc_name:'.$value->doc_name.'&nbsp;'.'format_doc:'.$value->format_doc.'<br />';*/
                            ?>
                             <div class="form-row">
                             <div class="form-group col-sm-4">
                                <label for="doc_name">Document Name</label>
                                <input type="text" class="form-control" id="doc_name_1" name="doc_name_1" value="<?php if($action == 'edit'){ echo $formatsdata->doc_name; } ?>">
                                <span class="small" id="doc_name_<?php echo $i; ?>_error" style="color:red;"></span> 
                              </div>
                              <div class="form-group col-sm-4">
                               <label for="format_doc">Format Document</label>
                                <input type="file" class="form-control" id="format_doc_<?php echo $i; ?>" name="format_doc_<?php echo $i; ?>">
                                <span class="small" id="format_doc_<?php echo $i; ?>_error" style="color:red;"></span> 
                              </div>
                               <div class="form-group col-sm-4">
                               <label for="format_doc">Format Document Word</label>
                                <input type="file" class="form-control" id="format_doc_<?php echo $i; ?>_word" name="format_doc_<?php echo $i; ?>_word">
                                <span class="small" id="format_doc_<?php echo $i; ?>_word_error" style="color:red;"></span> 
                              </div>
                              <div class="form-group col-sm-4">
                                <label for="format_doc">&nbsp;</label>
                               <a href="<?php echo assets_url(); ?>format_doc/<?php echo $formatsdata->format_doc; ?>" class="text-secondary" target="_blank"><span class='mt-5'>view doc</span></a>
                               <label for="format_doc">&nbsp;</label>
                               <a href="<?php echo assets_url(); ?>format_doc/<?php echo $formatsdata->format_word_doc; ?>" class="text-secondary" target="_blank"><span class='mt-5'>view word doc</span></a>
                             </div>
                            </div>
                            <input type="hidden" name="format_doc_id_<?php echo $i; ?>" value="<?php echo $formatsdata->format_doc_id; ?>" />
                            <?php
                       $i++;
                      // }
                    }
                    ?>
                    <?php 
                     if($action != 'edit') { ?>
                    <div id="doc_files">
                        <div class="form-row">
                         <div class="form-group col-sm-6">
                            <label for="doc_name">Document Name</label>
                            <input type="text" class="form-control" id="doc_name_1" name="doc_name_1" value="<?php if($action == 'edit'){ echo $formatsdata->doc_name; } ?>">
                            <span class="small" id="doc_name_1_error" style="color:red;"></span> 
                          </div>
                          <div class="form-group col-sm-6">
                           <label for="format_doc">Format Document PDF</label>
                            <input type="file" class="form-control" id="format_doc_1" name="format_doc_1">
                            <span class="small" id="format_doc_1_error" style="color:red;"></span> 
                          </div>
                          
                           <div class="form-group col-sm-6">
                           <label for="format_doc_1_word">Format Document Word</label>
                            <input type="file" class="form-control" id="format_doc_1_word" name="format_doc_1_word">
                            <span class="small" id="format_doc_1_pdf_error" style="color:red;"></span> 
                          </div>
                        </div>
                    </div>
                    <!--<button type="button" tabindex="-1" class="btn btn-primary btn-sm" id="addButton"><i class="fa fa-plus"></i></button>-->
                    <!--<button type="button" tabindex="-1" class="btn btn-danger btn-sm" id="removeButton"><i class="fa fa-minus"></i></button>-->
                    <?php } else {  ?>
                     <div id="doc_files">
                        
                    </div>
                    <!--<button type="button" tabindex="-1" class="btn btn-primary btn-sm" id="addButton"><i class="fa fa-plus"></i></button>-->
                    <!--<button type="button" tabindex="-1" class="btn btn-danger btn-sm" id="removeButton"><i class="fa fa-minus"></i></button>-->
                    <?php } ?>
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label for="notes">Notes</label>
                            <textarea class="form-control" id="notes" name="notes"><?php if($action == 'edit'){ echo $formatsdata->notes; } ?></textarea>
                            <span class="small" id="notes_error" style="color:red;"></span> 
                        </div>
                    </div>
                    
                  </fieldset>
                    <input type="hidden" name="no_of_count" value="" id="no_of_count">
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="format_id" value="<?php echo $formatsdata->format_id; ?>">
                   <?php } ?>
                  <button class="btn btn-secondary" type="reset">Reset</button>
                  <button class="btn btn-primary" type="submit">Save</button>
                </form>
              </div>
            </div>
          </section>
<?php
            $no_of_count = 3;
            for ($i=1; $i < $no_of_count; $i++) {
              $varName = ${"format_doc_" .$i};
             // $varName = $this->files_upload("assets/format_doc/",'*',$varName,$id,$varName);
              echo $varName;
            }

?>

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
      var type_of_loan = $("#type_of_loan").val();
      var doc_name = $("#doc_name").val();
      var format_doc = $("#format_doc").val();
      var format_doc_word = $("#format_doc_word").val();
      if(bank_id == ''){
        $("#bank_id_error").html("Please Select Bank Name");
        $("#bank_id").focus();
        return false;
      }else{
        $("#bank_id_error").html("");
      }
      if(type_of_loan == ''){
        $("#type_of_loan_error").html("Type Of Loan Required");
        $("#type_of_loan").focus();
        return false;
      }else{
        $("#type_of_loan_error").html("");
      }
      if(doc_name == ''){
        $("#doc_name_error").html("Document Name Number Required");
        $("#doc_name").focus();
        return false;
      }else{
        $("#doc_name_error").html("");
      }
       <?php if($action != 'edit') { ?>
      if(format_doc == ''){
        $("#format_doc_error").html("Format Document Required");
        $("#format_doc").focus();
        return false;
      }else{
        $("#format_doc_error").html("");
      }
    <?php } ?>
      
    });
    <?php if($action == 'edit') { ?>
        var presentRows = <?php echo $i; ?>;
    <?php } else { ?>
        var presentRows = 2;
    <?php } ?>
     
    $("#addButton").click(function () {
    var doc_files = $("#doc_files");
    var limitRows = 51;
   
      if(presentRows < limitRows){
          var presentRow = presentRows++;
             doc_files.append("<div class='form-row' id='row_"+presentRow+"'><div class='form-group col-sm-6'><label for='doc_name_"+presentRow+"'>Document Name</label> <input type='text' class='form-control' id='doc_name_"+presentRow+"' name='doc_name_"+presentRow+"' value=''> <span class='small' id='doc_name_"+presentRow+"_error' style='color:red;'></span>  </div>  <div class='form-group col-sm-6'>  <label for='format_doc_"+presentRow+"'>Format Document</label> <input type='file' class='form-control' id='format_doc_"+presentRow+"' name='format_doc_"+presentRow+"'>  <span class='small' id='format_doc_"+presentRow+"_error' style='color:red;'></span>  </div></div>");
             $("#no_of_count").val(presentRow);
        } else {
                alert("Limit Only 50 Rows");
                return false;
        }
    });
     $("#removeButton").click(function () {
        var limitRows = 1;
        var presentRow = parseInt(presentRows-1);
          if(presentRow <=1) {
              alert("At Least Keep One Row ");
              return false;
          } else {            
              $("#row_"+presentRow).remove();   
              presentRows--;
              $("#no_of_count").val(presentRow);
          }
    });
   /* $(".eachDoc").on("click",function(){
        var getID = $(this).attr('id');
        var mainID =  $(this).attr('mainID');
            $.ajax({
              url: "<?php echo base_url().'Formats/updateRecord'; ?>",
              type: 'POST',
              data: { recordId: mainID },
              success: function(response) {
                // Handle the response from the server
                console.log(response);
              }
            });
    })*/
    
  </script>
</body>

</html>