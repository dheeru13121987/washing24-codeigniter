
<!doctype html>
<html lang="en">
  <head>
    <?= view('comman/header_tag'); ?>
  </head>
  <body >
    <div class="wrapper">
      <?= view('comman/header'); ?>
      <?= view('comman/menu'); ?>
      <div class="page-wrapper">
        <div class="container-fluid">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <?= view('comman/breadcrumb'); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-fluid">
            <div class="row row-deck row-cards"> 
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title"><?= $page_header ?></h3>
                    <div class="card-actions">
                      <a href="<?php echo base_url($new_frm_function); ?>" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Customer
                      </a>
                    </div>
                  </div>
                  <div class="card-body border-bottom">
                    <div class="row customer-details">
                      <div class="col-sm-12 col-md-4 col-xl-4">
                      </div>
                      <div class="col-sm-12 col-md-4 col-xl-4">
                        <h3>Customer Details</h3>
                        <div class="form-floating mb-3">
                          <input type="text" id="cusomer_id" class="form-select">
                          <input type="hidden" id="hidden_cusomer_id" name="customer_id">
                          <label for="floating-input">Customer Name/Mobile (Min. 3 char)</label>
                        </div>
                        <div class="form-floating mb-3">
                          <select class="form-select" id="" name="" aria-label="Floating label select example">
                            <option selected="">Select customer first</option>
                          </select>
                          <label for="floatingSelect">Select Package</label>
                        </div>
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="floating-input" autocomplete="off" disabled>
                          <label for="floating-input">Customer Email</label>
                        </div>
                        <div class="form-floating mb-3">
                          <input type="tel" disabled class="form-control" id="floating-input" autocomplete="off">
                          <label for="floating-input">Customer Mobile</label>
                        </div>
                        <h3>Customer Address</h3>
                        <div class="mb-3">
                          <label class="form-selectgroup-item flex-fill">
                            <input type="radio" name="form-project-manager[]" value="1" class="form-selectgroup-input">
                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                              <div class="me-3">
                                <span class="form-selectgroup-check"></span>
                              </div>
                              <div class="form-selectgroup-label-content d-flex align-items-center" style="text-align:left!important;">
                                <div>
                                  <div class="font-weight-medium">Home Address</div>
                                  <div class="text-muted">245 H Block, Radha Kunj Apartment</div>
                                  <div class="text-muted">Prayagraj, 211001</div>
                                  <div class="text-muted">Near Peeli Kothi</div>
                                </div>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="mb-3">
                          <label class="form-selectgroup-item flex-fill">
                            <input type="radio" name="form-project-manager[]" value="1" class="form-selectgroup-input">
                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                              <div class="me-3">
                                <span class="form-selectgroup-check"></span>
                              </div>
                              <div class="form-selectgroup-label-content d-flex align-items-center" style="text-align:left!important;">
                                <div>
                                  <div class="font-weight-medium">Office Address</div>
                                  <div class="text-muted">245 H Block, Radha Kunj Apartment</div>
                                  <div class="text-muted">Prayagraj, 211001</div>
                                  <div class="text-muted">Near Peeli Kothi</div>
                                </div>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="mb-3">
                          <label class="form-selectgroup-item flex-fill">
                            <input type="radio" name="form-project-manager[]" value="1" class="form-selectgroup-input">
                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                              <div class="me-3">
                                <span class="form-selectgroup-check"></span>
                              </div>
                              <div class="form-selectgroup-label-content d-flex align-items-center" style="text-align:left!important;">
                                <div>
                                  <div class="font-weight-medium">Neighor's Address</div>
                                  <div class="text-muted">245 H Block, Radha Kunj Apartment</div>
                                  <div class="text-muted">Prayagraj, 211001</div>
                                  <div class="text-muted">Near Peeli Kothi</div>
                                </div>
                              </div>
                            </div>
                          </label>
                        </div>
                        <h3>Pickup Details</h3>
                        <div class="form-floating mb-3">
                          <input type="date" id="cusomer_id" class="form-control">
                          <label for="floating-input">Pickup Date</label>
                        </div>
                        <div class="form-floating mb-3">
                          <select class="form-select" id="" name="" aria-label="Floating label select example">
                            <option value="">Select Time</option>
                            <option value="09AM - 11AM">09AM - 11AM</option>
                            <option value="09AM - 11AM">11AM - 01PM</option>
                            <option value="01PM - 03PM">01PM - 03PM</option>
                            <option value="03PM - 05PM">03PM - 05PM</option>
                            <option value="05PM - 07PM">05PM - 07PM</option>
                            <option value="07PM - 09PM">07PM - 09PM</option>
                          </select>
                          <label for="floatingSelect">Pickup Time</label>
                        </div>
                        <div class="d-flex">
                          <button type="button" class="btn btn-primary ms-auto">Make a order</button>
                        </div>                      
                      </div>
                      <div class="col-sm-12 col-md-4 col-xl-4">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?= view('comman/footer'); ?>
      </div>
    </div>
    <?= view('comman/footer_tag'); ?>
    <script type="text/javascript">
      jQuery(function($) {
        $('.<?= $active_class ?>').addClass('active');
      })
    </script>
    <script>
      $(function(){
        var valid;
        $("#cusomer_id").autocomplete({
          source: function( request, response ) {
            $.ajax({
              url: "<?php echo base_url('get-dropdown-customer-list'); ?>",
              dataType: "json",
              data: {
                str: request.term
              },
              success: function( data ) {
                response( data );
                //$("#hidden_cusomer_id").val(data.cusomer_id);
              }
            });
          },
          select: function(event, ui ){
            console.log(ui);
            if (ui.item == null || ui.item == typeof undefined || ui.item.label == 'Customer Not Found. Please Register First!'){
              $(this).val("");
              valid = false;
            }else{
              valid = true;
            }
          },
          close: function() {
            if (!valid){
              $(this).val('');
            }
            else{
              //$("#hidden_cusomer_id").val(data.cusomer_id);
            }
          },
          change: function (event, ui ) {
            if (ui.item == null || ui.item == typeof undefined || ui.item.label == 'Customer Not Found. Please Register First!'){
              $(this).val("");
            }
            else{
              //$("#hidden_cusomer_id").val(data.cusomer_id);
            }
          },
          minLength:3
        });
      });
    </script>
  </body>
</html>