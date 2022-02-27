
<!doctype html>
<html lang="en">
  <head>
    <?= view('comman/header_tag'); ?>
    <link href="assets/dist/css/datatables/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="assets/dist/css/datatables/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    <link href="assets/dist/css/datatables/responsive.dataTables.min.css" rel="stylesheet"/>
    <link href="assets/dist/css/datatables/buttons.bootstrap5.min.css" rel="stylesheet"/>
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
                        New
                      </a>
                    </div>
                  </div>
                  <div class="card-body border-bottom">
                    <div class="table-responsive">
                      <table id="datatable" class="table card-table table-vcenter text-nowrap">
                        <!-- <thead>
                          <tr>
                            <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                            <th class="w-1">No.
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 15 12 9 18 15" /></svg>
                            </th>
                            <th>Invoice Subject</th>
                            <th>Client</th>
                            <th>VAT No.</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                            <td><span class="text-muted">001401</span></td>
                            <td><a href="invoice.html" class="text-reset" tabindex="-1">Design Works</a></td>
                            <td>
                              <span class="flag flag-country-us"></span>
                              Carlson Limited
                            </td>
                            <td>
                              87956621
                            </td>
                            <td>
                              15 Dec 2017
                            </td>
                            <td>
                              <span class="badge bg-success me-1"></span> Paid
                            </td>
                            <td>$887</td>
                            <td class="text-end">
                              <span class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                <div class="dropdown-menu dropdown-menu-end">
                                  <a class="dropdown-item" href="#">
                                    Action
                                  </a>
                                  <a class="dropdown-item" href="#">
                                    Another action
                                  </a>
                                </div>
                              </span>
                            </td>
                          </tr>
                        </tbody> -->
                      </table>
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
    <script src="assets/dist/js/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/dist/js/datatables/dataTables.bootstrap5.min.js"></script>
    <script src="assets/dist/js/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/dist/js/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/dist/js/datatables/buttons.bootstrap5.min.js"></script>
    <script type="text/javascript">
      jQuery(function($) {
        $('.<?= $active_class ?>').addClass('active');
      })
    </script>
    <script>
      $(function() {
        var admin_url = "<?= site_url ?>";
        $("#datatable").DataTable({
          "processing": true,
          "serverSide": true,
          "order": [],
          "ajax": {
            "url": admin_url+'<?= $listing_function ?>',
            "type": "GET",
            "data": function(d) {
              d.myKey = "myValue";
            }
          },
        });
      });

      // function delete_my(id) {
      //   if (confirm('Are you sure to delete')) {
      //     $.ajax({
      //       url: admin_url + controller + "/delete_process",
      //       method: "post",
      //       dataType: "json",
      //       data: "delete_id=" + id + "&type=company&" + csrf_tocken_name + "=" + csrf_hash,
      //       beforeSend: function() {
      //         $('#loader').show();
      //       },
      //       success: function(info) {
      //         if (info.status == 1) {
      //           toastr['success']('', info.message, {
      //             closeButton: true,
      //             tapToDismiss: false,
      //             ltr: 'ltr'
      //           });
      //           location.reload();
      //         } else {
      //           toastr['danger']('', info.message, {
      //             closeButton: true,
      //             tapToDismiss: false,
      //             ltr: 'ltr'
      //           });
      //         }
      //       },
      //       complete: function(data) {
      //         $('#loader').hide();
      //       },
      //       error: function(xhr, ajaxOptions, thrownError) {
      //         alert('Somthing wrong in server please try again');
      //       }
      //     }); //ajax
      //   }
      // }

      // $(window).on('load', function() {
      //   if (feather) {
      //     feather.replace({
      //       width: 14,
      //       height: 14
      //     });
      //   }
      // })
    </script>
  </body>
</html>