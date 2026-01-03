    <!-- Main body -->
    <div class="main-body">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
           <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loanaccounts">Car Loan Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Final Notice Form</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
      <div class="row">
        <div class="col-12">
          <section id="section1" class="mt-1"> 
            <h5>Final Notice Form</h5>
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Loanaccounts/insertFinalNoticeForm'; ?>" name="final_notice_form" id="final_notice_form" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-4">
                      <label for="signed_copy">Signed Copy</label>
                      <input type="file" class="form-control" id="signed_copy" name="signed_copy" placeholder="Signed Copy">
                      <span class="small" id="signed_copy_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-4">
                      <label for="postal_copy">Postal Copy</label>
                      <input type="file" class="form-control" id="postal_copy" name="postal_copy" placeholder="Postal Copy">
                      <span class="small" id="postal_copy_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-4">
                      <label for="visit_photos">Visit Photos</label>
                      <input type="file" class="form-control" id="visit_photos" name="visit_photos" placeholder="Visit Photos">
                      <span class="small" id="visit_photos_error" style="color:red;"></span> 
                    </div>
                  </div>
                  <fieldset class="form-fieldset">
                        <legend>Location 1</legend>
                        <div class="form-row">
                            <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="latitude">Latitude</label>
                      <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" value="<?php if($action == 'edit'){ echo $regularizeData->latitude; } ?>">
                      <span class="small" id="longitude_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="longitude">Longitude</label>
                      <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" value="<?php if($action == 'edit'){ echo $regularizeData->longitude; } ?>">
                      <span class="small" id="longitude_error" style="color:red;"></span> 
                    </div>
                    
                    <input type="hidden" id="loc" name="loc" value="<?php if($action=='edit') echo $regularizeData->location; ?>">    
                      <!-- /.box-body -->
                      <input type="hidden" name="lat" id="lat" value="<?php if($action=='edit') echo $regularizeData->latitude; ?>">
                      <input type="hidden" name="long" id="long" value="<?php if($action=='edit') echo $regularizeData->longitude; ?>">
                      
                      <div class="clearfix"></div>
                       <div class="form-group col-md-12">
                        <label>Location</label>
                        <input class="form-control" id="location" name="location" placeholder="Location" type="text" value="<?php if($action=='edit') echo $regularizeData->location; ?>">
                        <label class="control-label text-red" for="inputError" id="search1_longitude_errorloc"></label>
                      </div> 
                      
                      <div class="clearfix"></div><label></label>
                      <div class="form-group col-md-12">
                          <div id="us3" style="width: 700px; height: 300px;"></div>
                          <label></label>
                      </div>
                      
                  </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-fieldset">
                        <legend>Location 2</legend>
                        <div class="form-row">
                            <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="latitude">Latitude</label>
                      <input type="text" class="form-control" id="latitude1" name="latitude1" placeholder="Latitude" value="<?php if($action == 'edit'){ echo $regularizeData->latitude; } ?>">
                      <span class="small" id="longitude1_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="longitude">Longitude</label>
                      <input type="text" class="form-control" id="longitude1" name="longitude1" placeholder="Longitude" value="<?php if($action == 'edit'){ echo $regularizeData->longitude; } ?>">
                      <span class="small" id="longitude1_error" style="color:red;"></span> 
                    </div>
                    
                    <input type="hidden" id="loc1" name="loc1" value="<?php if($action=='edit') echo $regularizeData->location; ?>">    
                      <!-- /.box-body -->
                      <input type="hidden" name="lat1" id="lat1" value="<?php if($action=='edit') echo $regularizeData->latitude; ?>">
                      <input type="hidden" name="long1" id="long1" value="<?php if($action=='edit') echo $regularizeData->longitude; ?>">
                      
                      <div class="clearfix"></div>
                       <div class="form-group col-md-12">
                        <label>Location</label>
                        <input class="form-control" id="location1" name="location1" placeholder="Location" type="text" value="<?php if($action=='edit') echo $regularizeData->location; ?>">
                        <label class="control-label text-red" for="inputError" id="search1_longitude_errorloc"></label>
                      </div> 
                      
                      <div class="clearfix"></div><label></label>
                      <div class="form-group col-md-12">
                          <div id="us3-loc1" style="width: 700px; height: 300px;"></div>
                          <label></label>
                      </div>
                      
                  </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-fieldset">
                        <legend>Location 3</legend>
                        <div class="form-row">
                            <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="latitude">Latitude</label>
                      <input type="text" class="form-control" id="latitude2" name="latitude2" placeholder="Latitude" value="<?php if($action == 'edit'){ echo $regularizeData->latitude; } ?>">
                      <span class="small" id="longitude2_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="longitude">Longitude</label>
                      <input type="text" class="form-control" id="longitude2" name="longitude2" placeholder="Longitude" value="<?php if($action == 'edit'){ echo $regularizeData->longitude; } ?>">
                      <span class="small" id="longitude2_error" style="color:red;"></span> 
                    </div>
                    
                    <input type="hidden" id="loc2" name="loc2" value="<?php if($action=='edit') echo $regularizeData->location; ?>">    
                      <!-- /.box-body -->
                      <input type="hidden" name="lat2" id="lat2" value="<?php if($action=='edit') echo $regularizeData->latitude; ?>">
                      <input type="hidden" name="long2" id="long2" value="<?php if($action=='edit') echo $regularizeData->longitude; ?>">
                      
                      <div class="clearfix"></div>
                       <div class="form-group col-md-12">
                        <label>Location</label>
                        <input class="form-control" id="location2" name="location2" placeholder="Location" type="text" value="<?php if($action=='edit') echo $regularizeData->location; ?>">
                        <label class="control-label text-red" for="inputError" id="search1_longitude_errorloc"></label>
                      </div> 
                      
                      <div class="clearfix"></div><label></label>
                      <div class="form-group col-md-12">
                          <div id="us3-loc2" style="width: 700px; height: 300px;"></div>
                          <label></label>
                      </div>
                      
                  </div>
                        </div>
                    </fieldset>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                     <label for="remarks">Remarks</label>
                      <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks"><?php if($action == 'edit'){ echo $regularizeData->remarks; } ?></textarea>
                      <span class="small" id="remarks_error" style="color:red;"></span>
                    </div>                  
                    </div>
                  <input type="hidden" name="loan_id" value="<?php echo $loan_id; ?>">
                  <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="r_id" value="<?php echo $regularizeData->r_id; ?>">
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
  
  <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyB1dVemlvVclJPa3KgdmFAzNsm6eCtfmhA&sensor=false&libraries=places"></script>
   
<script src="<?php echo base_url();?>assets/new/js/locationpicker.js"></script> 
  <!-- Plugins -->
  <!-- JS plugins goes here -->
  <script type="text/javascript">


    $("#final_notice_form").on("submit",function(){
     
      var signed_copy = $("#signed_copy").val();
      var postal_copy  = $("#postal_copy").val();
      var visit_photos  = $("#visit_photos").val();
    
    <?php if($action != 'edit') { ?>
      if(signed_copy == ''){
        $("#signed_copy_error").html("Signed Copy Is Required");
        $("#signed_copy").focus();
        return false;
      }else{
        $("#signed_copy_error").html("");
      }
      if(postal_copy == ''){
        $("#postal_copy_error").html("Postal Copy Is Required");
        $("#postal_copy").focus();
        return false;
      }else{
        $("#postal_copy_error").html("");
      }
      if(visit_photos == ''){
        $("#visit_photos_error").html("Visit Photos Is Required");
        $("#visit_photos").focus();
        return false;
      }else{
        $("#postal_copy_error").html("");
      }
      
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
    
     var latitude1 = position.coords.latitude;
    var longitude1 = position.coords.longitude;
    var address = 'address';
    geolocations1(latitude1,longitude1,address);
    
    var latitude2 = position.coords.latitude;
    var longitude2 = position.coords.longitude;
    var address = 'address';
    geolocations2(latitude2,longitude2,address);
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
          // Uncomment line below to show alert on each Location Changed event
          ///alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
      }
  });
}
function geolocations1(lat1,long1,address1){
  if(address1 == 'address'){
    codeLatLng(lat1, long1);
  }
  $('#us3-loc1').locationpicker({
      location: {latitude: lat1 , longitude: long1},         
      radius: 100,
      inputBinding: {
          latitudeInput: $('#latitude1'),
          longitudeInput: $('#longitude1'),
          locationNameInput: $('#location1')
          
      },
      enableAutocomplete: true,
      onchanged: function (currentLocation, radius, isMarkerDropped) {
          codeLatLng(currentLocation.latitude,currentLocation.longitude);
          // Uncomment line below to show alert on each Location Changed event
          ///alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
      }
  });
}
function geolocations2(lat2,long2,address2){
  if(address2 == 'address'){
    codeLatLng(lat2, long2);
  }
  $('#us3-loc2').locationpicker({
      location: {latitude: lat2 , longitude: long2},         
      radius: 100,
      inputBinding: {
          latitudeInput: $('#latitude2'),
          longitudeInput: $('#longitude2'),
          locationNameInput: $('#location2')
          
      },
      enableAutocomplete: true,
      onchanged: function (currentLocation, radius, isMarkerDropped) {
          codeLatLng(currentLocation.latitude,currentLocation.longitude);
          // Uncomment line below to show alert on each Location Changed event
          ///alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
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