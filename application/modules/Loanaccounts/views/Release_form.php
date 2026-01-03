<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loanaccounts">Car Loan Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Realese Form</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col"> 


          <section id="section1" class="mt-1">
            <h5>Release Form</h5>
            <div class="card">
              <div class="card-body">
               <form action="<?php echo base_url().'Loanaccounts/insertRelease'; ?>" name="release_submit" id="release_submit" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="release_date">Release Date</label>
                      <input type="text" class="form-control datepicker-input" id="release_date" name="release_date" placeholder="Enter Select Release Date" value="<?php if($action == 'edit'){ echo $releasedata->release_date; } ?>">
                      <span class="small" id="release_date_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="release_by">Release by</label>
                     <input type="text" class="form-control" id="release_by" name="release_by" placeholder="Enter your Release By" value="<?php if($action == 'edit'){ echo $releasedata->released_by; } ?>">
                    <!--   <select class="form-control bs-select" name="release_by" id="release_by">
                        <?php 
                          foreach ($getAllEmployees as $key => $value) { ?>
                            <option value="<?php echo $value->id; ?>" <?php if($action == 'edit'){ if($value->id == $releasedata->released_by){ echo "selected";  } } ?>><?php echo getEmployeeName($value->id); ?></option>
                            
                         <?php  }
                        ?>
                         
                      </select> -->
                      <span class="small" id="release_by_error" style="color:red;"></span> 
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="photo">Photo</label>
                      <input type="file" class="form-control" id="photo" name="photo" placeholder="photo">
                       <span class="small" id="photo_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="kyc">KYC</label>
                      <input type="file" class="form-control" id="kyc" name="kyc" placeholder="kyc">
                       <span class="small" id="kyc_error" style="color:red;"></span> 
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="latitude">Latitude</label>
                      <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" value="<?php if($action == 'edit'){ echo $releasedata->latitude; } ?>">
                      <span class="small" id="latitude_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="longitude">Longitude</label>
                      <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" value="<?php if($action == 'edit'){ echo $releasedata->longitude; } ?>">
                      <span class="small" id="longitude_error" style="color:red;"></span> 
                    </div>
                  </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                     <label for="remarks">Remarks</label>
                      <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks"><?php if($action == 'edit'){ echo $releasedata->remarks; } ?></textarea>
                      <span class="small" id="remarks_error" style="color:red;"></span>
                    </div>                  
                    </div>

                  <?php if($action == 'edit'){ ?>
                 <!--    <div class="form-row">
                    <div class="form-group col-sm-6">
                      <label for="circle">To Add more Documents</label>
                      <a href="<?php echo base_url(); ?>Documents/addDocuments/6/<?php echo $releasedata->rel_id; ?>" target="_blank" class="btn btn-primary">Click Here</a>
                    </div>
                    
                  </div> -->
                  <?php } ?>
                  <input type="hidden" name="s_id" value="<?php echo $loandata->s_id; ?>">
                  <input type="hidden" name="loan_id" value="<?php echo $loan_id; ?>">
                  <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="rel_id" value="<?php echo $releasedata->rel_id; ?>">
                   <?php } ?>
                  <button class="btn btn-secondary" type="reset">Reset</button>
                  <button class="btn btn-primary" type="submit">Save</button>
                </form>
              </div>
            </div>
          </section>

         


          

          
          

        

        
          

        </div>

        <div class="col-3 d-none d-xl-block">
         
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
      <script src="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.js"></script>

  <!-- <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->

  <!-- Plugins -->
  <!-- JS plugins goes here -->
  
<script type="text/javascript">
     $(() => {
     
      flatpickr('.datepicker-input', {
        allowInput: true
      })
    })

     
     
     $("#release_submit").on("submit",function(){
      var release_date = $("#release_date").val();
      var release_by = $("#release_by").val();
      var photo = $("#photo").val();
      var kyc = $("#kyc").val();
      if(release_date == ''){
        $("#release_date_error").html("Release Date Is Required");
        $("#release_date").focus();
        return false;
      }else{
        $("#release_date_error").html("");
      }
      if(release_by == ''){
        $("#release_by_error").html("Release By Is Required");
        $("#release_by").focus();
        return false;
      }else{
        $("#release_by_error").html("");
      }
    
    <?php if($action != 'edit') { ?>
     
      if(photo == ''){
        $("#photo_error").html("Photo Is Required");
        $("#photo").focus();
        return false;
      }else{
        $("#photo_error").html("");
      }
      if(kyc == ''){
        $("#kyc_error").html("KYC Is Required");
        $("#kyc").focus();
        return false;
      }else{
        $("#kyc_error").html("");
      }
      <?php } ?>
    });
  </script>
</body>

</html>