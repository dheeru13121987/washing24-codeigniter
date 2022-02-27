<!doctype html>
<html lang="en">  
  <?= view('head_tag'); ?>
  <style type="text/css">
    /* The message box is shown when the user clicks on the password field */
    #message {
      display:none;
      background: #f1f1f1;
      color: #000;
      position: relative;
      padding: 20px;
      margin-top: 10px;
    }
    #message p {
      padding: 10px 35px;
      font-size: 18px;
    }
    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
      color: green;
    }
    .valid:before {
      position: relative;
      left: -35px;
      content: "&#10004;";
    }
    /* Add a red text color and an "x" icon when the requirements are wrong */
    .invalid {
      color: red;
    }
    .invalid:before {
      position: relative;
      left: -35px;
      content: "&#10006;";
    }
    .w3-check{
      width: 24px;
      height: 24px;
      position: relative;
      top: 6px;
      font: inherit;
      margin: 0;
    }
    .autocomplete-active {
      background-color: DodgerBlue !important; 
      color: #ffffff; 
    }                  
    .acc{
        padding: 10px;
        font-size: 20px;
        font-weight:bold;
        width: 100%;
        height: 55px;
        border-radius: 0;
        margin: 0px auto;
        border: 1px solid #cccccc;
        opacity: 1;
        box-shadow: 3px 3px 20px rgba(58, 41, 41, 0.26) !important;
        vertical-align: top;
        text-transform: none;
        background-color:#002579;
        color:white;
    }
  </style>
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
              <li class="breadcrumb-item">My Team</li>
            </ol>
          </div>
          <!-- Page title -->
          <div class="page-header" style="margin-bottom: -2px;">
            <div class="row align-items-center">
              <div class="col-auto">
                <h1>
                  My Team
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
                  <button class="btn btn-primary btn-pill"  data-toggle="modal" data-target="#modalAdd" style="margin-top:5px;">ADD Member</button>
                  <table id="example" class="table-bordered text-center table-responsive table-striped" style="width:100%;">
                    <thead>
                      <tr class="bg-gray" style="color:white;">
                        <th>ID</th>
                        <th>Partner Code</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($team['status']): 
                        foreach ($team['records'] as $rec): ?>
                      <tr>
                        <td><?= $rec['id'] ?></td>
                        <td><a href="team/details/<?= $rec['id'] ?>"><?= $rec['code'] ?></a></td>
                        <td><a href="team/details/<?= $rec['id'] ?>"><?= $rec['member_type']==2?$rec['company_name']:$rec['title']." ".$rec['fname']." ".$rec['lname'] ?></a></td>
                        <td><a href="team/details/<?= $rec['id'] ?>"><?= $rec['email'] ?></a></td>
                        <td><a href="team/details/<?= $rec['id'] ?>"><?= $rec['mobile'] ?></a></td>
                        <td><span class="badge bg-<?= $rec['status'] == 1 ? 'green':'red' ?>" style="width:100%;"><?= $rec['status'] == 1 ? 'Active':'Inactive' ?></span></td>
                      </tr>                      
                      <?php endforeach;endif;?>
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
        $('.team').addClass('active');
      })
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable({
          "paging": false,
          "info": false,
          "bLengthChange": false,
          "columnDefs": [
            { "width": "10%", "targets": 4 },
            { "width": "10%", "targets": 5 }
          ]
        });
      });
    </script>
    <script type="text/javascript">
      jQuery(function($) {
        $(document).ready(function () {      
          $('#frm-save').on('submit',(function(e) {
            e.preventDefault();
            $('#btn-save').prop('disabled', true);
            $('#modalAdd').animate({ scrollTop: 0 }, 'slow');
            $.ajax({
              url: "<?php echo base_url(); ?>/team/save",
              type: "POST",
              data: $("#frm-save").serializeArray(),
              contentType: "application/json",
              dataType: "json",
              success: function(response) {
                if(response.status=="Fail")
                {
                  $('#div-msg-save').addClass("alert-danger").removeClass("alert-success").html(response.msg).slideDown(500).delay(4000).slideUp(
                      function(){             
                        $('#btn-save').prop('disabled', false);
                      }
                  );
                }
                else
                {
                  $('#div-msg-save').addClass("alert-success").removeClass("alert-danger").html(response.msg).slideDown(500).delay(4000).slideUp(
                      function(){
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
    <script>
      function myFunction() {
        var x = document.getElementById("psw");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>
    <script type="text/javascript">
      function showEdit(id){
        $.ajax({
          url: "<?php echo base_url(); ?>/team/getData/"+id,
          type: "POST",
          contentType: "application/json",
          dataType: "json",
          success: function(response) {
            if(response.status)
            {
              $('#fname').val(response.records[0].fname);
              $('#code').val(response.records[0].code);
              $('#lname').val(response.records[0].lname);
              $('#email').val(response.records[0].email);
              $('#mobile').val(response.records[0].mobile);
              $('#designation').val(response.records[0].designation);
              //$('#password').val(response.records[0].password);
              $('#hidden-id').val(id);
              $('#modalEdit').modal('show');
            }else{
              alert(response.products);                
            }
          }
        });
      }
      function autoGeneratePassword(){
        alert('Please make sure you have copied password before save!');
        var chars = ["ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz","0123456789", "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"];
        var randPwd = [5,3,2].map(function(len, i) { return Array(len).fill(chars[i]).map(function(x) { return x[Math.floor(Math.random() * x.length)] }).join('') }).concat().join('').split('').sort(function(){return 0.5-Math.random()}).join('');
        $("#psw").val(randPwd);
      }      
      function getBusinessDetails(abn,acn){
        $.ajax({
          url: "lead/getBusinessNameByAbnAcn",
          dataType: "JSON",
          data:{ abn: abn, acn: acn },
          success: function( data ) {
            if(data.AbnStatus=='Active'){
              $('#acn').val(data.Acn);
              $('#abn').val(data.Abn);
              $('#company_name').val(data.EntityName);
              $('#trading_name').val(data.BusinessName);
              $('#business_type').val(data.EntityTypeCode);
            }else{
              alert('Please valid ABN or ACN number');
            }
          }
        });
      }
      function setAllAddressFeilds(address){
        $('#unit_number').val("");
        $('#unit_type').val("");
        $('#floor_no').val("");
        $('#street_number').val("");
        $('#street_name').val("");
        $('#street_type').val("");
        $('#suburb').val("");
        $('#state').val("");
        $('#postcode').val("");
        var RecordId = ''; 
        var address_obj = $("#hidden_street_address").val();
        const myAddressArr = address_obj.split(",");
        $.each(myAddressArr, function( index, myAddress ) {
          if(myAddress.indexOf(address) != -1){
            var raw = myAddress.split("-");
            RecordId = raw[1];
          }
        });
        $.ajax({
          url: "lead/getAddressFeilds",
          dataType: "JSON",
          data:{ RecordId: RecordId },
          success: function( data ) {
            $('#unit_number').val(data.UnitNumber);
            $('#unit_type').val(data.UnitType);
            $('#floor_no').val(data.LevelNumber);
            $('#street_number').val(data.StreetNumber1);
            $('#street_name').val(data.StreetName);
            $('#street_type').val(data.StreetType);
            $('#suburb').val(data.Locality);
            $('#state').val(data.State);
            $('#postcode').val(data.Postcode);
          }
        });
      }
      $(function(){
        $("#street_address").autocomplete({
          source: function( request, response ) {
            $.ajax({
              url: "lead/getAddress",
              dataType: "json",
              data: {
                q: request.term
              },
              success: function( data ) {
                response(data.addr);
                $('#hidden_street_address').val(data.full_addr);
              }
            });
          },
          select: function(event, ui ){
            console.log(ui);
            $(this).val(ui.item.id);
            valid = true;
          },
          close: function() {
            if (!valid){
              $(this).val('');
              $('#hidden_street_address').val("");
            }
            else{
              setAllAddressFeilds($(this).val());
            }
          },
          change: function (event, ui ) {
            if (ui.item == null || ui.item == typeof undefined){
              $(this).val("");
              $('#hidden_street_address').val("");
            }
            else{
              setAllAddressFeilds($(this).val());
            }
          },
          minLength: 3
        });
        $( "#street_address" ).autocomplete( "option", "appendTo", ".eventInsForm" );
      });
      $( function() {
        var availableTags = [
          "Ct",
          "At"
        ];
        $("#street_type").autocomplete({
          source: availableTags
        });
        $( "#street_type" ).autocomplete( "option", "appendTo", ".eventInsForm" );
      });
    </script>
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="font-family: SourceSansPro, Helvetica, Arial, sans-serif;">
      <div class="modal-dialog modal-xl" style="max-width: 1020px!important;" role="document">
        <div class="modal-content">
          <div class="modal-header bg-blue">
            <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Add Team Member Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" style="color:white;">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="background-color:#bee5f3;">
            <div class="row">
              <div class="col-12">
                <div class="card" style="border: none;background-color:#bee5f3;">
                  <form id="frm-save" method="post" class="eventInsForm">
                    <div class="card-body">
                      <div id="div-msg-save" class="alert text-center" style="display:none;"></div>
                      <div class="row mb-2">
                        <label class="form-label col-3 col-form-label">Member Type</label>
                        <div class="col">
                          <select onchange="if($(this).val()==2){$('.business').each(function(){$(this).show();});}else{$('.business').each(function(){$(this).hide();});}" name="member_type" class="form-select" required>
                            <option value="">Member Type</option>
                            <?php if($roles['status']): 
                              foreach ($roles['records'] as $rec): ?>
                              <option value="<?= $rec['id'] ?>"><?= $rec['name'] ?></option>
                            <?php endforeach;endif;?>
                          </select>
                        </div>
                      </div>                      
                      <div style="display:none;" class="row acc business" onclick="$('#company_details').toggle('show');">
                        <div class="col-lg-11">Company Details</div>
                        <div class="col-lg-1 d-none d-lg-block d-xl-block text-right">+</div>
                      </div>
                      <div style="display:none;" class="row review business" id="company_details">
                        <div style="margin:10px;" class="col-12">
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">ABN</label>
                            <div class="col-8">
                              <input id="abn" name="abn" type="text" class="form-control" placeholder="ABN" onfocusout="getBusinessDetails(this.value,acn.value)"/>
                            </div>
                          </div>
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">ACN</label>
                            <div class="col-8">
                              <input id="acn" name="acn" type="text" class="form-control" placeholder="ACN" onfocusout="getBusinessDetails(abn.value,this.value)"/>
                            </div>
                          </div>
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">Company Name</label>
                            <div class="col-8">
                              <input id="company_name" name="company_name" type="text" class="form-control" placeholder="Company Name" autocomplete="chrome-off" readonly/>
                            </div>
                          </div>
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label">Trading Name</label>
                            <div class="col-8">
                              <input id="trading_name" name="trading_name" type="text" class="form-control" placeholder="Trading Name" autocomplete="chrome-off" readonly/>
                            </div>
                          </div>
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label">Company/Business Type</label>
                            <div class="col-8">
                              <input id="business_type" name="business_type" type="text" class="form-control" placeholder="Company Type" autocomplete="chrome-off" readonly/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div style="margin-top:10px;" class="row acc" onclick="$('#contact_details').toggle('show');">
                        <div class="col-lg-11">Contact Details</div>
                        <div class="col-lg-1 d-none d-lg-block d-xl-block text-right">+</div>
                      </div>
                      <div class="row review" id="contact_details">
                        <div style="margin:10px;" class="col-12">
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">Full Name</label>
                            <div class="col-md-2 col">
                              <select name="title" class="form-select" required>
                                <option value="">Title</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Miss.">Miss.</option>
                              </select>
                            </div>
                            <div class="col-md-3 col">
                              <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="col-md-3 col">
                              <input type="text" name="lname" class="form-control"
                              placeholder="Last Name" required>
                            </div>                  
                            <small class="form-hint"></small>
                          </div>
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">Position</label>
                            <div class="col-8">
                              <input type="text" class="form-control" name="position" placeholder="Position">
                              <small class="form-hint"></small>
                            </div>
                          </div>
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">Reporting Manager</label>
                            <div class="col-8">
                              <select class="form-select" name="reporting_manager">
                                <option value="">Select</option>
                                <?php  if($all_member['status']): 
                                  foreach ($all_member['records'] as $rec): 
                                    if($rec['status'] == 1){?>
                                  <option value="<?= $rec['fname'] ?> <?= $rec['lname'] ?> (<?= $rec['code'] ?>)"><?= $rec['fname'] ?> <?= $rec['lname'] ?> (<?= $rec['code'] ?>)</option>
                                <?php } endforeach;endif;?>
                              </select>
                              <small class="form-hint"></small>
                            </div>
                          </div>
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">Mobile</label>
                            <div class="col-8">
                              <input type="text" name="mobile" class="form-control" placeholder="Mobile Number" required>
                              <small class="form-hint"></small>
                            </div>
                          </div>
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">Phone</label>
                            <div class="col-3">
                              <select id="tel_code" name="tel_code" class="form-select">
                                <option value="">Select Telephone Code</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                              </select>
                            </div>
                            <div class="col-5">
                              <input type="text" name="phone" class="form-control" placeholder="Phone">
                              <small class="form-hint"></small>
                            </div>
                          </div>
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">Email Address</label>
                            <div class="col-8">
                              <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                              <small class="form-hint"></small>
                            </div>
                          </div>
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">Date of Birth</label>
                            <div class="col-8">
                              <input type="date" name="dob" class="form-control" placeholder="Date of Birth" required>
                              <small class="form-hint"></small>
                            </div>
                          </div>
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">Comment</label>
                            <div class="col-8">
                              <textarea name="comment" rows="6" class="form-control"></textarea>
                              <small class="form-hint"></small>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div style="margin-top:10px;" class="row acc" onclick="$('#contact_address').toggle('show');">
                        <div class="col-lg-11">Contact Address</div>
                        <div class="col-lg-1 d-none d-lg-block d-xl-block text-right">+</div>
                      </div>
                      <div class="row review" id="contact_address">
                        <div style="margin:10px;" class="col-12">
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">Address Type</label>
                            <div class="col">
                              <div class="form-selectgroup">
                                <label class="form-selectgroup-item">
                                  <input type="radio" id="addresstype-automatic" name="addresstype" value="Automatic" class="form-selectgroup-input" onclick="$(this).attr('checked',true);$('#div-address-automatic').show();$('#div-address-manual').hide();" checked>
                                  <span class="form-selectgroup-label">Automatic</span>
                                </label>
                                <label class="form-selectgroup-item">
                                  <input type="radio" id="addresstype-manual" name="addresstype" value="Manual" class="form-selectgroup-input" onclick="$(this).attr('checked',true);$('#div-address-automatic').hide();$('#div-address-manual').show();">
                                  <span class="form-selectgroup-label">Manual</span>
                                </label>
                              </div>
                            </div>
                          </div>
                          <div id="div-address-automatic" class="form-group mb-2 row">
                              <label class="form-label col-3 col-form-label">Street Address</label>
                              <div class="col-8">
                                <input id="street_address" name="street_address" type="text" class="form-control" placeholder="Start typing an address..." autocomplete="off"/>
                                <input type="hidden" id="hidden_street_address"/>
                              </div>
                          </div>
                          <div id="div-address-manual" style="display:none;">
                            <div class="form-group mb-2 row">
                              <label class="form-label col-3 col-form-label">Lot Number</label>
                              <div class="col-8">
                                <input id="lot_number" name="lot_number" type="text" class="form-control" value="" placeholder="Lot Number" autocomplete="off"/>
                              </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="form-label col-3 col-form-label">Unit Type</label>
                                <div class="col-8">
                                    <input id="unit_type" name="unit_type" type="text" class="form-control" placeholder="Unit Type" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="form-label col-3 col-form-label">Unit Number</label>
                                <div class="col-8">
                                <input id="unit_number" name="unit_number" type="text" class="form-control" placeholder="Unit Number" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                              <label class="form-label col-3 col-form-label">Floor Type</label>
                              <div class="col-8">
                                <input id="floor_type" name="floor_type" type="text" class="form-control" placeholder="Floor Type" autocomplete="off"/>
                              </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="form-label col-3 col-form-label">Floor Number</label>
                                <div class="col-8">
                                    <input id="floor_no" name="floor_no" type="text" class="form-control" placeholder="Floor Number" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="form-label col-3 col-form-label">Street Number</label>
                                <div class="col-8">
                                    <input id="street_number" name="street_number" type="text" class="form-control" placeholder="Street Number" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                              <label class="form-label col-3 col-form-label">Street Number Suffix</label>
                              <div class="col-8">
                                <input id="street_number_suffix" name="street_number_suffix" type="text" class="form-control" placeholder="Street Number Suffix" autocomplete="off"/>
                              </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="form-label col-3 col-form-label">Street Name</label>
                                <div class="col-8">
                                    <input id="street_name" name="street_name" type="text" class="form-control" placeholder="Street Name" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="form-label col-3 col-form-label">Street type</label>
                                <div class="col-8">
                                    <input id="street_type" name="street_type" type="text" class="form-control" placeholder="Select Street type" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                              <label class="form-label col-3 col-form-label">Street Suffix</label>
                              <div class="col-8">
                                <input id="street_suffix" name="street_suffix" type="text" class="form-control" placeholder="Street Suffix" autocomplete="off"/>
                              </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="form-label col-3 col-form-label">Suburb</label>
                                <div class="col-8">
                                    <input id="suburb" name="suburb" type="text" class="form-control" placeholder="Suburb" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="form-label col-3 col-form-label">Post Code</label>
                                <div class="col-8">
                                <input id="postcode" name="postcode" type="text" class="form-control" placeholder="Post Code" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                              <label class="form-label col-3 col-form-label">Select State</label>
                              <div class="col-8">
                                <select id="state" name="state" class="form-select">
                                  <option value="">Select State</option>
                                  <option value="ACT">ACT</option>
                                  <option value="NSW">NSW</option>
                                  <option value="NT">NT</option>
                                  <option value="QLD">QLD</option>
                                  <option value="SA">SA</option>
                                  <option value="TAS">TAS</option>
                                  <option value="VIC">VIC</option>
                                  <option value="WA">WA</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div style="margin-top:10px;" class="row acc" onclick="$('#other_details').toggle('show');">
                        <div class="col-lg-11">Other Details</div>
                        <div class="col-lg-1 d-none d-lg-block d-xl-block text-right">+</div>
                      </div>
                      <div class="row review" id="other_details">
                        <div style="margin:10px;" class="col-12">
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">Date of Joining</label>
                            <div class="col-8">
                              <input id="doj" name="doj" type="date" class="form-control" placeholder="Date of Joining" autocomplete="off"/>
                            </div>
                          </div>
                          <div class="form-group mb-2 row">
                              <label class="form-label col-3 col-form-label required">Master Partner Code</label>
                              <div class="col-8">
                              <select class="form-select" name="master_partner_code">
                                <option value="">Select</option>
                                <?php  if($master_partner_code['status']): 
                                  foreach ($master_partner_code['records'] as $rec): 
                                  if($rec['status'] == 1){ ?>
                                  <option value="<?= $rec['code'] ?>"><?= $rec['company_name'] ?> (<?= $rec['code'] ?>)</option>
                                <?php } endforeach; endif;?>
                              </select>
                              </div>
                          </div>
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">Password</label>
                            <div class="col-8">
                              <input placeholder="Password" autocomplete="chrome-off" class="form-control" type="password" name="password" id="psw" required>
                              <!-- An element to toggle between password visibility -->
                              <p><input class="w3-check" type="checkbox" onclick="myFunction()"> Show Password</p>
                            </div>
                            <div class="col-1">
                              <a class="btn btn-link" data-toggle="tooltip" data-placement="top" title="Auto generate password" onclick="autoGeneratePassword()"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg></a>
                            </div>
                          </div>
                          <div class="form-group mb-2 row">
                            <label class="form-label col-3 col-form-label required">Status</label>
                            <div class="col-8">                          
                              <div class="form-selectgroup">
                                <input class="form-check-input" type="radio" name="status" checked="" value="1">
                                <label class="form-label">&nbsp;Active</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" name="status" value="0">
                                <label class="form-label">&nbsp;Inactive</label>
                              </div>
                            </div>
                          </div>
                          <!--<div class="form-group mb-2 row">-->
                          <!--  <label class="form-label col-3 col-form-label required">Access Type</label>-->
                          <!--  <div class="col-8">                          -->
                          <!--    <div class="form-selectgroup">-->
                          <!--      <input class="form-check-input" type="radio" name="access_type" value="Admin" required>-->
                          <!--      <label class="form-label">&nbsp;Admin</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" name="access_type" value="Manager" required>-->
                          <!--      <label class="form-label">&nbsp;Manager</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                          <!--      <input class="form-check-input" type="radio" name="access_type" value="Member" checked required>-->
                          <!--      <label class="form-label">&nbsp;Member</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                          <!--    </div>-->
                          <!--  </div>-->
                          </div>
                        </div>
                      </div>                      
                      <div style="margin-top:10px;" class="row review">
                        <div class="col-12">
                          <div class="form-footer text-right">
                            <button id="btn-save" type="submit" class="btn btn-primary btn-pill">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
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
        </div>
      </div>
    </div>
  </body>
</html>