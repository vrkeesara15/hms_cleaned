<link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/flatpickr/flatpickr.min.css">
    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Loanaccounts">Car Loan Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Aution Form</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">


          <section id="section1" class="mt-1">
            <h5>Auction Form</h5>
            <div class="card">
              <div class="card-body">
               <form action="<?php echo base_url().'Loanaccounts/insertAuction'; ?>" name="auction_submit" id="auction_submit" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="aution_date">Auction Date</label>
                      <input type="text" class="form-control datepicker-input" id="aution_date" name="aution_date" placeholder="Enter Select Auction Date" value="<?php if($action == 'edit'){ echo $auctiondata->aution_date; } ?>">
                      <span class="small" id="aution_date_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="auction_price">Auction Price</label>
                      <input type="text" class="form-control" id="auction_price" name="auction_price" placeholder="Enter your Auction Price" value="<?php if($action == 'edit'){ echo $auctiondata->auction_price; } ?>">
                      <span class="small" id="auction_price_error" style="color:red;"></span> 
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="buyer_name">Buyer Name</label>
                      <input type="text" class="form-control" id="buyer_name" name="buyer_name" placeholder="Enter  Buyer Name" value="<?php if($action == 'edit'){ echo $auctiondata->buyer_name; } ?>">
                      <span class="small" id="buyer_name_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="phone">Phone</label>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Buyer phone" value="<?php if($action == 'edit'){ echo $auctiondata->buyer_mobile; } ?>">
                      <span class="small" id="phone_error" style="color:red;"></span> 
                    </div>
                  </div>
                  
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="final_notice">Final Notice</label>
                      <input type="file" class="form-control" id="final_notice" name="final_notice" >
                       <span class="small" id="final_notice_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="postal_slip">Postal Slip</label>
                      <input type="file" class="form-control" id="postal_slip" name="postal_slip">
                      <span class="small" id="postal_slip_error" style="color:red;"></span> 
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="parking_yard_doc">Parking Yard Doc</label>
                      <input type="file" class="form-control" id="parking_yard_doc" name="parking_yard_doc">
                      <span class="small" id="parking_yard_doc_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="buyer_aadhar">Aadhar Card</label>
                      <input type="file" class="form-control" id="buyer_aadhar" name="buyer_aadhar" >
                      <span class="small" id="buyer_aadhar_error" style="color:red;"></span> 
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="buyer_pancard">Pancard</label>
                      <input type="file" class="form-control" id="buyer_pancard" name="buyer_pancard">
                      <span class="small" id="buyer_pancard_error" style="color:red;"></span> 
                    </div>
                    
                  </div>

                   <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="reserve_price">Reserve Price</label>
                      <input type="text" class="form-control" id="reserve_price" name="reserve_price" placeholder="Reserve Price" value="<?php if($action == 'edit'){ echo $auctiondata->reserve_price; } ?>">
                      <span class="small" id="reserve_price_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="paper_ad_name">Paper Ad Name</label>
                      <input type="text" class="form-control" id="paper_ad_name" name="paper_ad_name" placeholder="Enter Paper Ad Name" value="<?php if($action == 'edit'){ echo $auctiondata->paper_ad_name; } ?>">
                      <span class="small" id="paper_ad_name_error" style="color:red;"></span> 
                    </div>
                  </div>
                   <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="paper_ad">Paper Ad</label>
                      <input type="file" class="form-control" id="paper_ad" name="paper_ad" placeholder="Enter Paper Ad">
                      <span class="small" id="paper_ad_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="auction_report">Auction Report</label>
                      <input type="file" class="form-control" id="auction_report" name="auction_report" placeholder="File Updload">
                      <span class="small" id="auction_report_error" style="color:red;"></span> 
                    </div>
                  </div>
                <!--   <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="latitude">Latitude</label>
                      <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" value="<?php if($action == 'edit'){ echo $auctiondata->latitude; } ?>">
                      <span class="small" id="latitude_error" style="color:red;"></span> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="longitude">Longitude</label>
                      <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" value="<?php if($action == 'edit'){ echo $auctiondata->longitude; } ?>">
                      <span class="small" id="longitude_error" style="color:red;"></span> 
                    </div>
                  </div> -->
                    <div class="form-row">
                    <div class="form-group col-md-6">
                     <label for="remarks">Remarks</label>
                      <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks"><?php if($action == 'edit'){ echo $auctiondata->remarks; } ?></textarea>
                      <span class="small" id="remarks_error" style="color:red;"></span>
                    </div>                  
                    </div>
                  <?php if($action == 'edit'){ ?>
                 <!--    <div class="form-row">
                    <div class="form-group col-sm-6">
                      <label for="circle">To Add more Documents</label>
                      <a href="<?php echo base_url(); ?>Documents/addDocuments/7/<?php echo $auctiondata->auc_id; ?>" target="_blank" class="btn btn-primary">Click Here</a>
                    </div>
                    
                  </div> -->
                  <?php } ?>

                  <input type="hidden" name="loan_id" value="<?php echo $loan_id; ?>">
                  <input type="hidden" name="s_id" value="<?php echo $loandata->s_id; ?>">
                  <input type="hidden" name="action" value="<?php echo $action; ?>">
                  <?php if($action == 'edit'){ ?>
                     <input type="hidden" name="auc_id" value="<?php echo $auctiondata->auc_id; ?>">
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


  
<script type="text/javascript">
     $(() => {
     
      flatpickr('.datepicker-input', {
        allowInput: true
      })
    })
     
     $("#auction_submit").on("submit",function(){
      var aution_date = $("#aution_date").val();
      var auction_price = $("#auction_price").val();
      var buyer_name = $("#buyer_name").val();
      var photo = $("#photo").val();
      var final_notice = $("#final_notice").val();
      var postal_slip = $("#postal_slip").val();
     // var parking_yard_doc = $("#parking_yard_doc").val();
      var buyer_aadhar = $("#buyer_aadhar").val();
      var buyer_pancard = $("#buyer_pancard").val();
      var reserve_price = $("#reserve_price").val();
      var paper_ad_name = $("#paper_ad_name").val();
      var paper_ad = $("#paper_ad").val();
      var auction_report = $("#auction_report").val();
       
      if(aution_date == ''){
        $("#aution_date_error").html("Auction Date Is Required");
        $("#aution_date").focus();
        return false;
      }else{
        $("#aution_date_error").html("");
      }
      if(auction_price == ''){
        $("#auction_price_error").html("Auction Price Is Required");
        $("#auction_price").focus();
        return false;
      }else{
        $("#auction_price_error").html("");
      }
      if(buyer_name == ''){
        $("#buyer_name_error").html("Buyer Name Is Required");
        $("#buyer_name").focus();
        return false;
      }else{
        $("#buyer_name_error").html("");
      }
       if(phone == ''){
        $("#phone_error").html("Phone Is Required");
        $("#phone").focus();
        return false;
      }else{
        $("#phone_error").html("");
      }

      if(reserve_price == ''){
        $("#reserve_price_error").html("Reserve Price Is Required");
        $("#reserve_price").focus();
        return false;
      }else{
        $("#reserve_price_error").html("");
      }

      // if(paper_ad_name == ''){
      //   $("#paper_ad_name_error").html("Paper Ad Name Is Required");
      //   $("#paper_ad_name").focus();
      //   return false;
      // }else{
      //   $("#paper_ad_name_error").html("");
      // }
    
    <?php if($action != 'edit') { ?>
     
      if(final_notice == ''){
        $("#final_notice_error").html("Final Notice Is Required");
        $("#final_notice").focus();
        return false;
      }else{
        $("#final_notice_error").html("");
      }
      if(postal_slip == ''){
        $("#postal_slip_error").html("Postal Slip Is Required");
        $("#postal_slip").focus();
        return false;
      }else{
        $("#postal_slip_error").html("");
      }
      // if(parking_yard_doc == ''){
      //   $("#parking_yard_doc_error").html("Parking Yard Document Is Required");
      //   $("#parking_yard_doc").focus();
      //   return false;
      // }else{
      //   $("#parking_yard_doc_error").html("");
      // }
      
      if(buyer_aadhar == ''){
        $("#buyer_aadhar_error").html("Aadhar Card Is Required");
        $("#buyer_aadhar").focus();
        return false;
      }else{
        $("#buyer_aadhar_error").html("");
      }
      if(buyer_pancard == ''){ 
        $("#buyer_pancard_error").html("Buyer Pancard Is Required");
        $("#buyer_pancard").focus();
        return false;
      }else{
        $("#buyer_pancard_error").html("");
      }

      // if(paper_ad == ''){ 
      //   $("#paper_ad_error").html("Paper Ad Is Required");
      //   $("#paper_ad").focus();
      //   return false;
      // }else{
      //   $("#paper_ad_error").html("");
      // }

      // if(auction_report == ''){ 
      //   $("#auction_report_error").html("Buyer Auction Report Is Required");
      //   $("#auction_report").focus();
      //   return false;
      // }else{
      //   $("#auction_report_error").html("");
      // }
      
      <?php } ?>
    });
  </script>
</body>

</html>