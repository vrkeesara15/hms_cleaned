<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">

    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
           <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loanaccounts">Car Loan Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Seize Form</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">
          <section id="section2" class="mt-1">
            <h5>Seize Form</h5> 
            <div class="card">
              <div class="card-body">
               <form action="<?php echo base_url().'Loanaccounts/insertSeize'; ?>" name="seize_submit" id="seize_submit" method="post" enctype="multipart/form-data">
                  <fieldset class="form-fieldset">
                    <legend>Seize Info</legend>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="seize_date">Seize Date</label>
                      <input type="text" class="form-control datepicker-input" id="seize_date" name="seize_date" placeholder="Please select seize date" value="<?php if($action == 'edit'){ echo $seizedata->seize_date; } ?>">
                      <span class="small" id="seize_date_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="seized_by">Seized By</label>
                       <input type="text" class="form-control" id="seized_by" name="seized_by" placeholder="Please enter seized by" value="<?php if($action == 'edit'){ echo $seizedata->seized_by; } ?>">
                     
                       <span class="small" id="seized_by_error" style="color:red;"></span> 
                    </div>
                  </div>
                   <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="panchanama_doc">Panchanama Doc</label>
                      <input type="file" class="form-control" id="panchanama_doc" name="panchanama_doc" placeholder="panchanama doc">
                      <span class="small" id="panchanama_doc_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="stock_yard_panchanama">Stock Yard Panchanama</label>
                      <input type="file" class="form-control" id="stock_yard_panchanama" name="stock_yard_panchanama" placeholder="Stock Yard Panchanama">
                      <span class="small" id="stock_yard_panchanama_error" style="color:red;"></span>  
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      
                    <p class="">Seizer Guidelines Followed</p>
                    <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio1" name="seizer_guidelines_followed" id="seizer_guidelines_followed" class="custom-control-input" 
                    <?php if($action == 'edit'){ 
                      if($seizedata->seizer_guidelines_followed =='y') ?>
                     checked="checked"
                     <?php }else if($action == 'add') { echo "checked";}  ?> value='y'>
                    <label class="custom-control-label" for="customRadio1">Yes</label>
                    </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio2" name="seizer_guidelines_followed" id="seizer_guidelines_followed" class="custom-control-input"
                    <?php if($action == 'edit'){ 
                      if($seizedata->seizer_guidelines_followed =='n') ?>
                     checked="checked"
                     <?php } ?> value='n'>
                    <label class="custom-control-label" for="customRadio2">No</label>
                    </div>
                     <span class="small" id="seizer_guidelines_followed_error" style="color:red;"></span> 

                    </div>
                    <div class="form-group col-md-6">
                      <label for="inventory">Inventory : </label>
                      <input type="file" class="form-control" id="inventory" name="inventory" placeholder="Inventory">
                      <span class="small" id="inventory_error" style="color:red;"></span>  
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="photos">Photos</label>
                      <input type="file" class="form-control" id="photos" name="photos" placeholder="photos">
                      <span class="small" id="photos_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="videos">Videos</label>
                      <input type="file" class="form-control" id="videos" name="videos" placeholder="videos">
                      <span class="small" id="videos_error" style="color:red;"></span> 
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="latitude">Latitude</label>
                      <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" value="<?php if($action == 'edit'){ echo $seizedata->latitude; } ?>">
                      <span class="small" id="latitude_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="longitude">Longitude</label>
                      <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" value="<?php if($action == 'edit'){ echo $seizedata->longitude; } ?>">
                      <span class="small" id="longitude_error" style="color:red;"></span> 
                    </div>
                    
                    <input type="hidden" id="loc" name="loc" value="<?php echo $loc; ?>">    
                      <!-- /.box-body -->
                      <input type="hidden" name="lat" id="lat" value="<?php if($action=='edit') echo $seizedata->latitude; ?>">
                      <input type="hidden" name="long" id="long" value="<?php if($action=='edit') echo $seizedata->longitude; ?>">
                      
                      <div class="clearfix"></div>
                       <div class="form-group col-md-12">
                        <label>Location</label>
                        <input class="form-control" id="location" name="location" placeholder="Location" type="text" value="<?php if($action=='edit') echo $seizedata->location; ?>">
                        <label class="control-label text-red" for="inputError" id="search1_longitude_errorloc"></label>
                      </div> 
                      
                      <div class="clearfix"></div><label></label>
                      <div class="form-group col-md-12">
                          <div id="us3" style="width: 700px; height: 300px;"></div>
                          <label></label>
                      </div>
                    
                  </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                     <label for="remarks">Remarks</label>
                      <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks"><?php if($action == 'edit'){ echo $seizedata->remarks; } ?></textarea>
                      <span class="small" id="remarks_error" style="color:red;"></span>
                    </div>                  
                    </div>
                  <?php if($action == 'edit'){ ?>
                 <!--    <div class="form-row">
                    <div class="form-group col-sm-6">
                      <label for="circle">To Add more Documents</label>
                      <a href="<?php echo base_url(); ?>Documents/addDocuments/5/<?php echo $seizedata->s_id; ?>" target="_blank" class="btn btn-primary">Click Here</a>
                    </div>
                    
                  </div> -->
                  <?php } ?>
                  </fieldset>
                   <input type="hidden" name="loan_id" value="<?php echo $loan_id; ?>">
                  <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="s_id" value="<?php echo $seizedata->s_id; ?>">
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
  <!-- <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->
  <script src="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.js"></script>
   <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyB1dVemlvVclJPa3KgdmFAzNsm6eCtfmhA&sensor=false&libraries=places"></script>

   
<script src="<?php echo base_url();?>assets/new/js/locationpicker.js"></script> 

  <!-- Plugins -->
  <!-- JS plugins goes here -->
  <script type="text/javascript">

     $(() => {
      flatpickr('.datepicker-input', {
        allowInput: true
      })
    })
   $("#seize_submit").on("submit",function(){
      var seize_date = $("#seize_date").val();
      var seized_by = $("#seized_by").val();
      var seizer_guidelines_followed = $('input[name="seizer_guidelines_followed"]:checked').val();
      var panchanama_doc = $("#panchanama_doc").val();
      //var inventory = $("#inventory").val();
      
    //  var stock_yard_panchanama = $("#stock_yard_panchanama").val();

      var photos = $("#photos").val();
    //  var videos = $("#videos").val();
      if(seize_date == ''){
        $("#seize_date_error").html("Seize Date Is Required");
        $("#seize_date").focus();
        return false;
      }else{
        $("#seize_date_error").html("");
      }
      if(seized_by == ''){
        $("#seized_by_error").html("Seized By Is Required");
        $("#seized_by").focus();
        return false;
      }else{
        $("#seized_by_error").html("");
      }
      if(seized_by == ''){
        $("#seized_by_error").html("Seized By Is Required");
        $("#seized_by").focus();
        return false;
      }else{
        $("#seized_by_error").html("");
      }
       if(seizer_guidelines_followed == ''){
        $("#seizer_guidelines_followed_error").html("It IS Required");
        $("#seizer_guidelines_followed").focus();
        return false;
      }else{
        $("#seizer_guidelines_followed_error").html("");
      }

      
   // return false;
    <?php if($action != 'edit') { ?>
      if(panchanama_doc == ''){
        $("#panchanama_doc_error").html("Panchanama Document Is Required");
        $("#panchanama_doc").focus();
        return false;
      }else{
        $("#panchanama_doc_error").html("");
      }
      // if(stock_yard_panchanama == ''){
      //   $("#stock_yard_panchanama_error").html("Stock Yard Panchanama Is Required");
      //   $("#stock_yard_panchanama").focus();
      //   return false;
      // }else{
      //   $("#stock_yard_panchanama_error").html("");
      // }
      //  if(inventory == ''){
      //   $("#inventory_error").html("Inventory Is Required");
      //   $("#inventory").focus();
      //   return false;
      // }else{
      //   $("#inventory_error").html("");
      // }
      
      if(photos == ''){
        $("#photos_error").html("Photos Is Required");
        $("#photos").focus();
        return false;
      }else{
        $("#photos_error").html("");
      }
      // if(videos == ''){
      //   $("#videos_error").html("Videos Is Required");
      //   $("#videos").focus();
      //   return false;
      // }else{
      //   $("#videos_error").html("");
      // }
      <?php } ?>
    });
    
     var action  = document.getElementById('action').value;
var loc  = document.getElementById('loc').value;
if(action == 'edit' && loc == ''){
  var lat = document.getElementById('lat').value;
  var long = document.getElementById('long').value;
  var address = '';
    geolocations(lat,long,address);
}else{
  getLocation();
}

function showLocation(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    var address = 'address';
    geolocations(latitude,longitude,address);
 }

 function errorHandler(err) {
    var lat = 17.486442900000004;
    var long = 78.3898997;
    var address = 'address';
    if(err.code == 1) {
       geolocations(lat,long,address);

    } else if( err.code == 2) {
       geolocations(lat,long,address);
    }
 }

 function getLocation() {
    if(navigator.geolocation) {
       // timeout at 60000 milliseconds (60 seconds)
       var options = {timeout:60000};
       navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options);
    } else {
       alert("Sorry, browser does not support geolocation!");
    }
 }

function geolocations(lat,long,address){
  if(address == 'address'){
    codeLatLng(lat, long);
  }
  $('#us3').locationpicker({
      location: {latitude: lat , longitude: long},         
      radius: 100,
      inputBinding: {
          latitudeInput: $('#latitude'),
          longitudeInput: $('#longitude'),
          locationNameInput: $('#location')
          
      },
      enableAutocomplete: true,
      onchanged: function (currentLocation, radius, isMarkerDropped) {
          codeLatLng(currentLocation.latitude,currentLocation.longitude);
          
      }
  });
}
geocoder = new google.maps.Geocoder();
function codeLatLng(lat, lng) {
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        if(results[1]) {
          $('#location').val(results[0].formatted_address);
        }else{
          $('#location').val('');
        }
      }else{
          $('#location').val('');
      }
    });
  }

  </script>

</body>

</html>