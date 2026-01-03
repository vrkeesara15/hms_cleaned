 <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Invoice View</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <h5>Invoice View</h5>

      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <h4></h4>
            <span><?php echo date('d M Y',strtotime($invoice_details[0]->bill_date)); ?></span>
          </div>
          <hr>
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
            <div class="col">
              <span class="text-secondary">From</span>
              <address class="font-size-sm">
               <?php echo $invoice_details[0]->from_address; ?>
              </address>
            </div>
            <div class="col">
              <span class="text-secondary">To</span>
              <address class="font-size-sm">
                <?php echo $invoice_details[0]->to_address; ?>
              </address>
            </div>
            <div class="col">
              <ul class="list-unstyled">
                <li><strong>Invoice <?php echo "#".$invoice_details[0]->id; ?></strong></li>
                <li>&nbsp;</li>
                <li><strong>Bill No:</strong> <?php echo $invoice_details[0]->bill_no; ?></li>
                <li><strong>GST NO:</strong> <?php echo $invoice_details[0]->gst_no; ?></li>
                <li><strong>Account:</strong> <?php echo $invoice_details[0]->account; ?></li>
              </ul>
            </div>
          </div>
          <div class="table-responsive my-3">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th class="text-center">Borrower Name & A/C.No. </th>
                  <th>Recovered Amt</th>
                  <th>Date</th>
                  <th>Commission Charges</th>
                  <th>GST 18%</th>
                  <th class="text-right">Total</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $subtotal =0;
                  $gstTotal =0;
                  $grandTotal =0;
                $i =1; foreach ($invoice_details as $key => $value) { 
                  $subtotal += ($value->recovered_amt+$value->commission_charges);
                  $gstTotal += $value->gst;
                  $grandTotal += $value->total;
                  ?>
                 <tr>
                  <td class="text-center"><?php echo $i++; ?></td>
                  <td><?php echo $value->borrower_name; ?></td>
                   <td><?php echo $value->recovered_amt; ?></td>
                   <td><?php echo $value->commission_charges; ?></td>
                   <td><?php echo $value->gst; ?></td>
                   <td class="text-right"><?php echo $value->total; ?></td>
                </tr>
                <?php } ?>
                
              </tbody>
            </table>
          </div>
          <div class="row row-cols-2">
            <div class="col">
              <p></p>
            </div>
            <div class="col">
              <p class="lead">Amount</p>
              <div class="table-responsive">
                <table class="table table-sm">
                  <tbody>
                    <tr>   
                      <th class="w-50">Subtotal:</th>
                      <td><?php echo $subtotal; ?></td>
                    </tr>
                    <tr>
                      <th>GST(18%)</th>
                      <td><?php echo $gstTotal; ?></td>
                    </tr>
                    <tr>
                      <th>Grand Total:</th>
                      <td><?php echo $grandTotal; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="d-flex flex-column flex-sm-row mt-3">
            <button class="btn btn-light has-icon mt-1 mt-sm-0" type="button">
              <i class="mr-2" data-feather="printer"></i>Print
            </button>
            <button class="btn btn-primary has-icon ml-sm-auto mt-1 mt-sm-0" type="button">
              <i class="mr-2" data-feather="download"></i>Generate PDF
            </button>
            
          </div>
        </div>
      </div>

    
    </div>
    <!-- /Main body -->

  </div>
  <!-- /Main -->

  <!-- Search Modal -->
  <div class="modal" id="searchModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body p-1 p-lg-3">
          <form>
            <div class="input-group input-group-lg input-group-search">
              <div class="input-group-prepend">
                <button class="btn text-secondary btn-icon btn-lg" type="button" data-dismiss="modal">
                  <i class="fa fa-chevron-left"></i>
                </button>
              </div>
              <input type="text" class="form-control form-control-lg border-0 mx-1 px-0 px-lg-3" placeholder="Search..." autocomplete="off" required autofocus>
              <div class="input-group-append">
                <button class="btn text-secondary btn-icon btn-lg" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /Search Modal -->

  <!-- Main Scripts -->
  <script src="<?php echo assets_url(); ?>new/js/jquery.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/plugins/feather-icons/feather.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/script.min.js"></script>
  <script src="<?php echo assets_url(); ?>new/js/settings.min.js"></script>

  <!-- Plugins -->
  <script src="<?php echo assets_url(); ?>new/plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js"></script>
  <script>
    $(() => {
          // Run datatable
      var table = $('#example').DataTable({
        drawCallback: function() {
          $('.dataTables_paginate > .pagination').addClass('pagination-sm') // make pagination small
        }
      })
      // Apply column filter
      $('#example .dt-column-filter th').each(function(i) {
        $('input', this).on('keyup change', function() {
          if (table.column(i).search() !== this.value) {
            table
              .column(i)
              .search(this.value)
              .draw()
          }
        })
      })
      // Toggle Column filter function
      var responsiveFilter = function(table, index, val) {
        var th = $(table).find('.dt-column-filter th').eq(index)
        val === true ? th.removeClass('d-none') : th.addClass('d-none')
      }
      // Run Toggle Column filter at first
      $.each(table.columns().responsiveHidden(), function(index, val) {
        responsiveFilter('#example', index, val)
      })
      // Run Toggle Column filter on responsive-resize event
      table.on('responsive-resize', function(e, datatable, columns) {
        $.each(columns, function(index, val) {
          responsiveFilter('#example', index, val)
        })
      })
    })

  </script>

</body>

</html>