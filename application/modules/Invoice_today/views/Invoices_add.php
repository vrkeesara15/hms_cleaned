
    <!-- Main body -->
    <div class="main-body">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="javascript:void(0)">Forms</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Invoices</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
      <div class="row">
        <div class="col">
          
          <section id="section2" class="mt-2">
            
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'Invoicess/insertInvoicess'; ?>" name="Invoicess_submit" id="Invoicess_submit" method="post" enctype="multipart/form-data">
                 <div class="row">
                  <div class="col-sm-6 mb-1">
                    <div class="list-with-gap">
                      <label>From</label>
                      <textarea class="form-control" rows="2" placeholder="Textarea"></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6 mb-1">
                    <div class="list-with-gap">
                      <label>To</label>
                      <textarea class="form-control" rows="2" placeholder="Textarea"></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <label>Order ID:</label>
                      <input type="text" class="form-control" placeholder="Input box">
                  </div>
                  <div class="col-sm-4">
                    <label>Payment Date:</label>
                      <input type="text" class="form-control" placeholder="Input box">
                  </div>
                  <div class="col-sm-4">
                    <label>Account:</label>
                      <input type="text" class="form-control" placeholder="Input box">
                  </div>
                </div>
                  <div class="row">
                            <div class="col-xs-12 table-responsive">

                                <table class="table table-bordered" id="dTable" >
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Type</th>
                                            <th>Service Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>  
                                            <th>Amount</th>
                                            <th>GST</th>
                                            <th>GST HSN</th>                                                                                      

                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php $i = 1; ?>
                                    <tr id="row_<?php echo $i;?>">
                                    <td width="20"><?php echo $i;?></td>
                                    
                                    <td><input type="text" name="desc<?php echo $i ?>" id="desc<?php echo $i ?>" class="form-control" placeholder="Enter Description" value=""  /></td>

                                    <td width="130"><input type="text" name="sdate<?php echo $i ?>" id="sdate<?php echo $i ?>" class="form-control " placeholder="Start Date" value="" /></td>
                                    


                                      <td width="100"><input type="text" name="amount<?php echo $i ?>" id="amount<?php echo $i ?>" class="form-control" value=""></td>

                                        <td width="80"><input type="text" name="gstamount<?php echo $i ?>" id="gstamount<?php echo $i ?>" class="form-control" value="" /></td>

                                         <td  width="130"><input type="text" name="gstnum<?php echo $i ?>" id="gstnum<?php echo $i ?>" class="form-control" placeholder="GST Number" value="" readonly /></td>


                                </tr>
                                
                                       </tbody>
                                </table>
                                <table class="table table-bordered" >
                                <thead>
                                <tr>
                                <th></th>
                                <th>Total Amount</th>
                                <th>SGST</th>
                                <th>CGST</th>
                                <th>Grand Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                          
                                            <td style="width: 70%" align="right" >Price</td>
                                             <td align="right"><div style="float: right;" width="100">                                          
                                            <input type="text" placeholder="Amount" name="tprice" id="tprice"  
                                            value=""
                                             class="form-control">
                                       
                                        </td>
                                            <td align="right"><div style="float: right;" width="80">                                          
                                            <input type="text" placeholder="Amount" name="sgst" id="sgst"  
                                            value=""
                                             class="form-control" readonly>
                                       
                                        </td>
                                        <td align="right"><div style="float: right;" width="80">                                          
                                            <input type="text" placeholder="Amount" name="cgst" id="cgst"  
                                            value=""
                                             class="form-control" readonly>
                                       
                                        </td>
                                         <td align="right"><div style="float: right;" width="130">                                          
                                            <input type="text" placeholder="Amount" name="gtprice" id="gtprice"  
                                            value=""
                                             class="form-control" readonly>
                                       
                                        </td>
                                        </tr>
                                      
                                         <tr>
                                        <td >
                                            <button type="button" tabindex="-1" class="btn btn-primary btn-sm" id="addButton"><i class="fa fa-plus"></i></button>
                                            <button type="button" tabindex="-1" class="btn btn-danger btn-sm" id="removeButton"><i class="fa fa-minus"></i></button>

                                        </td>
                                        <td colspan="5"> <span id="wordamount"></span></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                  
                  <!-- <button class="btn btn-secondary" type="reset">Reset</button>
                  <button class="btn btn-primary" type="submit">Save</button> -->
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
 <!--  <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script> -->
  <!-- Plugins -->
  <!-- JS plugins goes here -->
</body>
</html>