<!doctype html>
<html lang="en">  
  <?= view('head_tag'); ?>
  <body class="antialiased" style="background-color: white;font-family: Arial!important;">
    <div class="page" style="max-width:1200px; margin: auto;">
      <div style="margin-left: 12px;margin-right: 12px;">
        <?= view('header'); ?>
        <?= view('menubar'); ?>
      </div>
      <div class="content" style="background-color:white !important">
        <div class="container-xl">
          <div style="margin-top: -20px;margin-bottom: 25px; background-color:#eeeeee;">
            <ol class="breadcrumb" aria-label="breadcrumbs" style="margin-left: 16px;">
              <li class="breadcrumb-item"><a href="#"><img src="<?= base_url() ?>/assets/static/home.png" style="height: 1rem;"></a></li>
              <li class="breadcrumb-item">Customers</li>
            </ol>
          </div>
          <!-- Page title -->
          <div class="page-header" style="margin-bottom: -2px;">
            <div class="row align-items-center">
              <div class="col-auto">
                <h1>
                  Our Customers
                </h1>
              </div><div class="col-auto ml-auto d-print-none">
                <span class="d-none d-sm-inline">
                </span>
              </div>
            </div>
          </div>          
          <div class="card">
            <div class="card-body" style="color: black;">
              <div class="row" style="padding-top:10px;">
                <div class="col-12" style="overflow-x: auto;">
                  <table id="example" class="table-bordered text-center table-responsive table-striped" style="width:100%;">
                    <thead>
                      <tr class="bg-gray" style="color:white;">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Telephone</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($customers['status']): foreach ($customers['records'] as $rec): ?>
                        <tr>
                          <td>CUST0<?= $rec['id'] ?></td>
                          <td><?= $rec['title'].' '.$rec['fname'].' '.$rec['lname'] ?></td>
                          <td><?= $rec['tel_code'].' '.$rec['telephone'] ?></td>
                          <td><?= $rec['mobile'] ?></td>
                          <td><?= $rec['email'] ?></td>
                          <td><span class="badge bg-<?= $rec['status'] == 1 ? 'green' : 'red' ?>" style="width:100%;"><?= $rec['status'] == 1 ? 'Active' : 'Inactive' ?></span></td>
                          <td><button class="btn btn-primary btn-pill btn-sm"  onclick="showEdit(<?= $rec['id'] ?>)" style="width:100%;">Edit</button><br/></td>
                        </tr>
                      <?php endforeach; endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <hr style="height:2px;border:1px;color:#333;background-color:#000;margin-bottom:10px;" />
          <div class="row">
            <div class="col-12 text-center">Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                By <a href="#"  style="color:black;" class="link-secondary">Select and Switch</a>.</div>
          </div>
        </div>
      </div>
    </div>
    <?= view('footer_tag'); ?>
    <script type="text/javascript">
      jQuery(function($) {
        $('.customers').addClass('active');
      })
    </script>
    <script type="text/javascript">
      function showEdit(id){
        $.ajax({
          url: "customers/getCustomer/"+id,
          type: "POST",
          contentType: "application/json",
          dataType: "json",
          success: function(response) {
            if(response.status)
            {
              $('#title').val(response.records[0].title);
              $('#fname').val(response.records[0].fname);
              $('#lname').val(response.records[0].lname);
              $('#tel_code').val(response.records[0].tel_code);
              $('#telephone').val(response.records[0].telephone);
              $('#mobile').val(response.records[0].mobile);
              $('#email').val(response.records[0].email);
              response.records[0].dnc == 0 ?
                $('#dnc').removeAttr("checked") : $('#dnc').attr("checked","TRUE");
              //$('#dnc').val(response.records[0].dnc);
              $('#status').val(response.records[0].status);
              $('#hidden-id').val(id);
              $('#modalEdit').modal('show');
            }else{
              alert(response.products);                
            }
          }
        });
      }
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable({
          "scrollY":        '100vh',
          "scrollCollapse": true,
          "paging":         false,
          "info":           true,
          "bLengthChange": false,
          "columnDefs": [
            { "width": "10%", "targets": 4 },
            { "width": "10%", "targets": 5 }
          ],
          "search": {"search": "<?php echo $customer_id; ?>"}
        });
      });
    </script>
    <script type="text/javascript">
      jQuery(function($) {
        $(document).ready(function () {
          $('#frm-edit').on('submit',(function(e) {
            e.preventDefault();
            $('#btn-edit').prop('disabled', true);
            $('#modalEdit').animate({ scrollTop: 0 }, 'fast');
            $.ajax({
              url: "customers/updateCustomer",
              type: "POST",
              data: $("#frm-edit").serializeArray(),
              contentType: "application/json",
              dataType: "json",
              success: function(response) {
                if(response.status=="Fail")
                {
                  $('#div-msg-edit').addClass("alert-danger").removeClass("alert-success").html(response.msg).slideDown(500).delay(4000).slideUp(
                    function(){                        
                      $('#btn-edit').prop('disabled', false);
                      $('#modalEdit').modal('hide');
                    }
                  );
                }
                else
                {
                  $('#div-msg-edit').addClass("alert-success").removeClass("alert-danger").html(response.msg).slideDown(500).delay(6000).slideUp(function(){
                      window.location.reload();
                    }
                  );
                }
              }            
            });
          }));
        });  
      });
    </script>
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="font-family: SourceSansPro, Helvetica, Arial, sans-serif;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-blue">
            <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Edit Customer Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" style="color:white;">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="background-color:#bee5f3;">
            <div class="row">
              <div class="col-12">
                <div class="card" style="border: none;background-color:#bee5f3;">
                  <form id="frm-edit" method="post">
                    <div class="card-body">
                      <div id="div-msg-edit" class="alert text-center" style="display:none;"></div>
                      <div class="form-group mb-2 row">
                        <label class="form-label col-3 col-form-label required">Full Name</label>
                        <div class="row col">
                          <div class="col-md-3 col">       
                            <select class="form-select" id="title" name="title">
                              <option value="Mr.">Mr.</option>
                              <option value="Mrs.">Mrs.</option>
                              <option value="Miss.">Miss.</option>
                            </select>
                          </div>
                          <div class="col-md-5 col">
                            <input type="text" class="form-control" aria-describedby="nameHelp" id="fname" name="fname" placeholder="First Name">
                          </div>
                          <div class="col-md-4 col">
                            <input type="text" id="lname" name="lname" class="form-control" aria-describedby="nameHelp" placeholder="Last Name">
                            <input type="hidden" id="hidden-id" name="id">
                          </div>
                        </div>
                      </div>
                      <div class="form-group mb-2 row">
                        <label class="form-label col-3 col-form-label required">Telephone</label>
                        <div class="row col">
                          <div class="col-3">
                            <select class="form-select" id="tel_code" name="tel_code">
                              <option value="02">02</option>
                              <option value="03">03</option>
                              <option value="07">07</option>
                              <option value="08">08</option>
                            </select>
                          </div>
                          <div class="col">
                            <input type="tel" id="telephone" name="telephone" class="form-control"  placeholder="Telephone">
                          </div>
                        </div>
                      </div>
                      <div class="form-group mb-2 row">
                        <label class="form-label col-3 col-form-label">Mobile</label>
                        <div class="col">
                          <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Mobile Number">
                        </div>
                      </div>
                      <div class="form-group mb-2 row">
                        <label class="form-label col-3 col-form-label required">Email Address</label>
                        <div class="col">
                          <input type="email" id="email" name="email" class="form-control" placeholder="Email Address">
                        </div>
                      </div>
                      <div class="form-group mb-2 row">
                        <label class="form-label col-3 col-form-label  required">Do not Contact</label>
                        <div class="col">
                          <input name="dnc" value="0" type="hidden">
                          <input class="form-check-input" id="dnc" name="dnc" value="1" type="checkbox">
                        </div>
                      </div>
                      <div class="form-group mb-2 row">
                        <label class="form-label col-3 col-form-label required">Status</label>
                        <div class="col">
                          <select  id="status" name="status" class="form-select" required="">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group mb-2 row">
                        <label class="form-label col-3 col-form-label"></label>
                        <div class="col">
                          <div class="form-footer btn-list justify-content-start">
                            <button id="btn-edit" type="submit" class="btn btn-primary btn-pill">Save</button>
                            <button type="reset" class="btn btn-danger btn-pill">Reset</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>                      
              </div>
            </div>
          </div>
          <!-- <div class="modal-footer"> 
          </div >-->
        </div>
      </div>
    </div>
  </body>
</html>