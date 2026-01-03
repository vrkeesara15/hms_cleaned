
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Documents">Documents</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Document</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">


          <section id="section4" class="mt-5"> 
            <h5>Upload Additional Documents</h5>
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Documents/insertDocuments'; ?>" name="doc_form" id="doc_form" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="doc_name">Document Name</label>
                      <input type="text" class="form-control" id="doc_name" name="doc_name" placeholder="Document Name">
                      <span class="small" id="doc_name_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="doc_file">Document File</label>
                      <input type="file" class="form-control" id="doc_file" name="doc_file" placeholder="Postal Slip">
                      <span class="small" id="doc_file_error" style="color:red;"></span> 
                    </div>
                  </div>
                 
                  
                  <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <input type="hidden" name="module_id" value="<?php echo $module_id; ?>">
                  <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                  <?php if($action == 'edit'){ ?>
                   <input type="hidden" name="emp_id" value="<?php echo $regularizeData->r_id; ?>">
                   <?php } ?>                 
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

    $("#doc_form").on("submit",function(){
    
      var doc_name = $("#doc_name").val();
      var doc_file = $("#doc_file").val();
      if(doc_name == ''){
        $("#doc_name_error").html("Document Name Number Required");
        $("#doc_name").focus();
        return false;
      }else{
        $("#doc_name_error").html("");
      }
       <?php if($action != 'edit') { ?>
      if(doc_file == ''){
        $("#doc_file_error").html("Format Document Required");
        $("#doc_file").focus();
        return false;
      }else{
        $("#doc_file_error").html("");
      }
    <?php } ?>
      
    });
  </script>
</body>

</html>