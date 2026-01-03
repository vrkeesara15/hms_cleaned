    <!-- Main body -->
    <div class="main-body">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
           <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loanaccounts">Car Loan Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Regularize Form</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
      <div class="row">
        <div class="col">
          <section id="section1" class="mt-1"> 
            <h5>Regularize Form</h5>
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Loanaccounts/insertRegularize'; ?>" name="regularize_submit" id="regularize_submit" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="seizer_notice">Seizer Notice</label>
                      <input type="file" class="form-control" id="seizer_notice" name="seizer_notice" placeholder="Seizer Notice">
                      <span class="small" id="seizer_notice_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="postal_slip">Postal Slip</label>
                      <input type="file" class="form-control" id="postal_slip" name="postal_slip" placeholder="Postal Slip">
                      <span class="small" id="postal_slip_error" style="color:red;"></span> 
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="property_photo">Property Photo</label>
                      <input type="file" class="form-control" id="property_photo" name="property_photo" placeholder="Property Photo">
                      <span class="small" id="property_photo_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="visit_photo">Visit Photo</label>
                      <input type="file" class="form-control" id="visit_photo" name="visit_photo" placeholder="Visit Photo">
                      <span class="small" id="visit_photo_error" style="color:red;"></span> 
                    </div>
                  </div>
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
                    <div class="form-row">
                    <div class="form-group col-md-6">
                     <label for="remarks">Remarks</label>
                      <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks"><?php if($action == 'edit'){ echo $regularizeData->remarks; } ?></textarea>
                      <span class="small" id="remarks_error" style="color:red;"></span>
                    </div>                  
                    </div>
                  <?php if($action == 'edit'){ ?>
                    <!--   <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="circle">To Add more Documents</label>
                        <a href="<?php echo base_url(); ?>Documents/addDocuments/4/<?php echo $regularizeData->r_id; ?>" target="_blank" class="btn btn-primary">Click Here</a>
                      </div>
                      
                    </div> -->
                    <?php } ?>
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


    $("#regularize_submit").on("submit",function(){
     
      var seizer_notice = $("#seizer_notice").val();
      var postal_slip  = $("#postal_slip").val();
      var property_photo  = $("#property_photo").val();
      var visit_photo  = $("#visit_photo").val();
    
    <?php if($action != 'edit') { ?>
      if(seizer_notice == ''){
        $("#seizer_notice_error").html("Seizer Notice Is Required");
        $("#seizer_notice").focus();
        return false;
      }else{
        $("#seizer_notice_error").html("");
      }
      if(postal_slip == ''){
        $("#postal_slip_error").html("Postal Slip Is Required");
        $("#postal_slip").focus();
        return false;
      }else{
        $("#postal_slip_error").html("");
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
  
//  const input = document.getElementById("location");
// const options = {
  
//   componentRestrictions: { country: "in" },
//   fields: ["address_components", "geometry", "icon", "name"],
//   strictBounds: false,
// };
// const autocomplete = new google.maps.places.Autocomplete(input, options);
// //autocomplete.bindTo("bounds", map);

// $("#location").on("change",function(data){
//     console.log(data);
// });

  </script>

</body>

</html>