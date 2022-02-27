<!doctype html>
<html lang="en">  
  <?= view('head_tag'); ?>
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <style type="text/css">
    /*the container must be positioned relative:*/
    .autocomplete {
      position: relative;
      display: inline-block;
    }
    .w3-check{
      width: 24px;
      height: 24px;
      position: relative;
      top: 6px;
      font: inherit;
      margin: 0;
    }
    .autocomplete-items {
      position: absolute;
      border: 1px solid #d4d4d4;
      border-bottom: none;
      border-top: none;
      z-index: 99;
      /*position the autocomplete items to be the same width as the container:*/
      top: 100%;
      left: 0;
      right: 0;
    }
    .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff; 
      border-bottom: 1px solid #d4d4d4; 
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
      background-color: #e9e9e9; 
    }

    /*when navigating through the items using the arrow keys:*/
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
    table.custome th{
        width:25% !important;
    }
    table.custome td{
        width:75% !important;
    }
    table.half td{
        width:70% !important;
    }
    .mb-10{
        margin-bottom:10px;
    }
    .small-grey{
        font-size: .775rem;
        color:#7c7e7e;
    }
  </style>
  <body class="antialiased" style="background-color: white;font-family: Arial!important;">
    <div class="page" style="max-width:1200px; margin: auto;">
      <div style="margin-left: 12px;margin-right: 12px;">
        <?= view('header'); ?>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <?= view('menubar'); ?>
      </div>
      <div class="content" style="background-color:white !important">
        <div class="container-xl">
          <div style="margin-top: -20px;margin-bottom: 25px; background-color:#eeeeee;">
            <ol class="breadcrumb" aria-label="breadcrumbs" style="margin-left: 16px;">
              <li class="breadcrumb-item"><a href="#"><img src="<?= base_url() ?>/assets/static/home.png" style="height: 1rem;"></a></li>
              <li class="breadcrumb-item">Team Member Details</li>
            </ol>
          </div>
          <!-- Page title -->
          <div class="page-header" style="margin-bottom: -2px;">
            <div class="row align-items-center">
              <div class="col-auto">
                <h1>
                    Team Member Details
                </h1>
              </div>
            </div>
          </div>
          <div class="card">            
            <div class="row">
                <div class="col-12">
                    <div class="card" style="border: none;background-color:#bee5f3;">
                        <div class="card-body">
                            <div class="row mb-40">
                                <div class="col-lg-12 mb-10">
                                    <div class="row acc" onclick="showAcc('contact_details')">
                                        <div class="col-lg-11">Contact Details</div>
                                        <div class="col-lg-1 d-none d-lg-block d-xl-block text-right">+</div>
                                    </div>
                                    <div class="row review" id="contact_details">
                                        <div class="col-lg-12">
                                            <table class="table custome" style="border:2px solid #000000;">
                                                <tr>
                                                    <th>Title</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_title"><?php echo $title; ?></div>
                                                                <div id="hidden_div_title" style="display:none;">
                                                                    <select id="edit_title" class="form-select" onchange="$('#div_title').html($(this).val());">
                                                                        <option value="">Select Title</option>
                                                                        <option <?php echo $title=="Mr."?"selected":""; ?> value="Mr.">Mr.</option>
                                                                        <option <?php echo $title=="Mrs."?"selected":""; ?> value="Mrs.">Mrs.</option>
                                                                        <option <?php echo $title=="Miss."?"selected":""; ?> value="Miss.">Miss.</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_title" onclick="getEdited('div_title','hidden_div_title','edit_link_title','save_link_title')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_title" onclick="getSaved('div_title','hidden_div_title','edit_link_title','save_link_title',<?php echo $id; ?>,'title',$('#edit_title').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>First Name</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                            <div id="div_fname"><?php echo $f_name; ?></div>
                                                            <div id="hidden_div_fname" style="display:none;">
                                                                <input id="edit_fname" class="rdl_input form-control" style="" type="text" placeholder="First Name" value="<?php echo $f_name; ?>" onkeyup="$('#div_fname').html($(this).val());">
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_fname" onclick="getEdited('div_fname','hidden_div_fname','edit_link_fname','save_link_fname')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_fname" onclick="getSaved('div_fname','hidden_div_fname','edit_link_fname','save_link_fname',<?php echo $id; ?>,'fname',$('#edit_fname').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Last Name</th>
                                                    <td>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div id="div_lname"><?php echo $lname; ?></div>
                                                            <div id="hidden_div_lname" style="display:none;">
                                                                <input id="edit_lname" class="rdl_input form-control" style="" type="text" placeholder="Last Name" value="<?php echo $lname; ?>" onkeyup="$('#div_lname').html($(this).val());">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_lname" onclick="getEdited('div_lname','hidden_div_lname','edit_link_lname','save_link_lname')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_lname" onclick="getSaved('div_lname','hidden_div_lname','edit_link_lname','save_link_lname',<?php echo $id; ?>,'lname',$('#edit_lname').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Position In Business/Company</th>
                                                    <td>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div id="div_position"><?php echo $position; ?></div>
                                                            <div id="hidden_div_position" style="display:none;">
                                                                <input id="edit_position" class="rdl_input form-control" style="" type="text" placeholder="position" value="<?php echo $position; ?>" onkeyup="$('#div_position').html($(this).val());">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_position" onclick="getEdited('div_position','hidden_div_position','edit_link_position','save_link_position')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_position" onclick="getSaved('div_position','hidden_div_position','edit_link_position','save_link_position',<?php echo $id; ?>,'position',$('#edit_position').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Member Type</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_member_type"><?php echo $member_type; ?></div>
                                                                <div id="hidden_div_member_type" style="display:none;">
                                                                    <select id="edit_member_type" class="form-select" onchange="$('#div_member_type').html($('option:selected', this).attr('mytag'));">
                                                                        <option value="">Member Type</option>
                                                                        <?php  if($roles_list['status']): 
                                                                            foreach ($roles_list['records'] as $rec): ?>
                                                                            <option <?php echo $member_type==$rec['name']?"selected":""; ?> value="<?= $rec['id'] ?>" mytag="<?= $rec['name'] ?>"><?= $rec['name'] ?></option>
                                                                        <?php endforeach;endif;?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_member_type" onclick="getEdited('div_member_type','hidden_div_member_type','edit_link_member_type','save_link_member_type')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_member_type" onclick="getSaved('div_member_type','hidden_div_member_type','edit_link_member_type','save_link_member_type',<?php echo $id; ?>,'member_type',$('#edit_member_type').val());" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Reporting Manager</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_reporting_manager"><?php echo $reporting_manager; ?></div>
                                                                <div id="hidden_div_reporting_manager" style="display:none;">
                                                                    <select id="edit_reporting_manager" class="form-select" onchange="$('#div_reporting_manager').html($(this).val());">
                                                                        <option value="">Select</option>
                                                                        <?php  if($reporting_manager_list['status']): 
                                                                        foreach ($reporting_manager_list['records'] as $rec): 
                                                                            if($reporting_manager == $rec['code']){
                                                                        ?>
                                                                            <option selected value="<?= $rec['code'] ?>"><?= $rec['fname'] ?> <?= $rec['lname'] ?> (<?= $rec['code'] ?>)</option>
                                                                        <?php }else if($rec['status'] == 1){ ?>
                                                                            <option value="<?= $rec['code'] ?>"><?= $rec['fname'] ?> <?= $rec['lname'] ?> (<?= $rec['code'] ?>)</option>
                                                                        <?php } endforeach;endif; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_reporting_manager" onclick="getEdited('div_reporting_manager','hidden_div_reporting_manager','edit_link_reporting_manager','save_link_reporting_manager')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_reporting_manager" onclick="getSaved('div_reporting_manager','hidden_div_reporting_manager','edit_link_reporting_manager','save_link_reporting_manager',<?php echo $id; ?>,'reporting_manager',$('#edit_reporting_manager').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Mobile</th>
                                                    <td>
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <div id="div_mobile"><?php echo $mobile; ?></div>
                                                        <div id="hidden_div_mobile" style="display:none;">
                                                            <input id="edit_mobile" class="rdl_input form-control" style="" type="number" placeholder="Mobile" value="<?php echo $mobile; ?>" onkeyup="$('#div_mobile').html($(this).val());">
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_mobile" onclick="getEdited('div_mobile','hidden_div_mobile','edit_link_mobile','save_link_mobile')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_mobile" onclick="getSaved('div_mobile','hidden_div_mobile','edit_link_mobile','save_link_mobile',<?php echo $id; ?>,'mobile',$('#edit_mobile').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a></td>
                                                </tr>
                                                <tr>
                                                    <th>Telephone Code</th>
                                                    <td>
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <div id="div_tel_code"><?php echo $tel_code; ?></div>
                                                        <div id="hidden_div_tel_code" style="display:none;">
                                                            <select id="edit_tel_code" class="form-select" onchange="$('#div_tel_code').html($(this).val());">
                                                                <option value="">Select Telephone Code</option>
                                                                <option <?php echo $tel_code=="02"?"selected":""; ?> value="02">02</option>
                                                                <option <?php echo $tel_code=="03"?"selected":""; ?> value="03">03</option>
                                                                <option <?php echo $tel_code=="07"?"selected":""; ?> value="07">07</option>
                                                                <option <?php echo $tel_code=="08"?"selected":""; ?> value="08">08</option>
                                                            </select>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_tel_code" onclick="getEdited('div_tel_code','hidden_div_tel_code','edit_link_tel_code','save_link_tel_code')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_tel_code" onclick="getSaved('div_tel_code','hidden_div_tel_code','edit_link_tel_code','save_link_tel_code',<?php echo $id; ?>,'tel_code',$('#edit_tel_code').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a></td>
                                                </tr>
                                                <tr>
                                                    <th>Telephone </th>
                                                    <td>
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <div id="div_phone"><?php echo $phone; ?></div>
                                                        <div id="hidden_div_phone" style="display:none;">
                                                            <input id="edit_phone" class="rdl_input form-control" style="" type="number" placeholder="phone" value="<?php echo $phone; ?>" onkeyup="$('#div_phone').html($(this).val());">
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_phone" onclick="getEdited('div_phone','hidden_div_phone','edit_link_phone','save_link_phone')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_phone" onclick="getSaved('div_phone','hidden_div_phone','edit_link_phone','save_link_phone',<?php echo $id; ?>,'phone',$('#edit_phone').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a></td>
                                                </tr>
                                                <tr>
                                                    <th>Email Address</th>
                                                    <td>
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <div id="div_email"><?php echo $email; ?></div>
                                                        <div id="hidden_div_email" style="display:none;">
                                                            <input id="edit_email" class="rdl_input form-control" style="" type="text" placeholder="email" value="<?php echo $email; ?>" onkeyup="$('#div_email').html($(this).val());">
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_email" onclick="getEdited('div_email','hidden_div_email','edit_link_email','save_link_email')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_email" onclick="getSaved('div_email','hidden_div_email','edit_link_email','save_link_email',<?php echo $id; ?>,'email',$('#edit_email').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a></td>
                                                </tr>
                                                <tr>
                                                    <th>Date of Birth</th>
                                                    <td>
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <div id="div_dob"><?php echo date('d-m-Y',strtotime($dob)); ?></div>
                                                        <div id="hidden_div_dob" style="display:none;">
                                                            <input id="edit_dob" class="rdl_input form-control" type="date" value="<?php echo $dob; ?>" onfocusout="$('#div_dob').html($(this).val());">
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_dob" onclick="getEdited('div_dob','hidden_div_dob','edit_link_dob','save_link_dob')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_dob" onclick="getSaved('div_dob','hidden_div_dob','edit_link_dob','save_link_dob',<?php echo $id; ?>,'dob',$('#edit_dob').val());$('#div_dob').html($('#edit_dob').val());" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Comment</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_comment"><?php echo $comment; ?></div>
                                                                <div id="hidden_div_comment" style="display:none;">
                                                                    <textarea id="edit_comment" class="rdl_input form-control" rows="6" onfocusout="$('#div_comment').html($(this).val());"><?php echo $comment; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_comment" onclick="getEdited('div_comment','hidden_div_comment','edit_link_comment','save_link_comment')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_comment" onclick="getSaved('div_comment','hidden_div_comment','edit_link_comment','save_link_comment',<?php echo $id; ?>,'comment',$('#edit_comment').val());$('#div_comment').html($('#edit_comment').val());" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                            </table>                                              
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-10">
                                    <div class="row acc" onclick="showAcc('company_details')">
                                        <div class="col-lg-11">Company Details</div>
                                        <div class="col-lg-1 text-right d-none d-lg-block d-xl-block">+</div>
                                    </div>
                                    <div style="display:none;" class="row review" id="company_details">
                                        <div class="col-lg-12">
                                            <table class="table custome" style="border:2px solid #000000;">
                                                <tr>
                                                    <th>ABN</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_abn"><?php echo $abn; ?></div>
                                                                <div id="hidden_div_abn" style="display:none;">
                                                                    <input id="edit_abn" class="rdl_input form-control" style="" type="text" placeholder="ABN" value="<?php echo $abn; ?>" onkeyup="$('#div_abn').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_abn" onclick="getEdited('div_abn','hidden_div_abn','edit_link_abn','save_link_abn')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_abn" onclick="getSaved('div_abn','hidden_div_abn','edit_link_abn','save_link_abn',<?php echo $id; ?>,'abn',$('#edit_abn').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>ACN</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                            <div id="div_acn"><?php echo $acn; ?></div>
                                                            <div id="hidden_div_acn" style="display:none;">
                                                                <input id="edit_acn" class="rdl_input form-control" style="" type="text" placeholder="ACN" value="<?php echo $acn; ?>" onkeyup="$('#div_acn').html($(this).val());">
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_acn" onclick="getEdited('div_acn','hidden_div_acn','edit_link_acn','save_link_acn')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_acn" onclick="getSaved('div_acn','hidden_div_acn','edit_link_acn','save_link_acn',<?php echo $id; ?>,'acn',$('#edit_acn').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a></td>
                                                </tr>
                                                <tr>
                                                    <th>Company Name</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_company_name"><?php echo $company_name; ?></div>
                                                                <div id="hidden_div_company_name" style="display:none;">
                                                                    <input id="edit_company_name" class="rdl_input form-control" style="" type="text" placeholder="Company Name" value="<?php echo $company_name; ?>" onkeyup="$('#div_company_name').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_company_name" onclick="getEdited('div_company_name','hidden_div_company_name','edit_link_company_name','save_link_company_name')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_company_name" onclick="getSaved('div_company_name','hidden_div_company_name','edit_link_company_name','save_link_company_name',<?php echo $id; ?>,'company_name',$('#edit_company_name').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Trading Name</th>
                                                    <td>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div id="div_trading_name"><?php echo $trading_name; ?></div>
                                                            <div id="hidden_div_trading_name" style="display:none;">
                                                                <input id="edit_trading_name" class="rdl_input form-control" style="" type="text" placeholder="Trading Name" value="<?php echo $trading_name; ?>" onkeyup="$('#trading_name').val($(this).val());$('#div_trading_name').html($(this).val());">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_trading_name" onclick="getEdited('div_trading_name','hidden_div_trading_name','edit_link_trading_name','save_link_trading_name')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_trading_name" onclick="getSaved('div_trading_name','hidden_div_trading_name','edit_link_trading_name','save_link_trading_name',<?php echo $id; ?>,'trading_name',$('#edit_trading_name').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Company/Business Type</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_business_type"><?php echo $business_type; ?></div>
                                                                <div id="hidden_div_business_type" style="display:none;">
                                                                    <input id="edit_business_type" class="rdl_input form-control" style="" type="text" placeholder="Company/Business Type" value="<?php echo $business_type; ?>" onkeyup="$('#div_business_type').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_business_type" onclick="getEdited('div_business_type','hidden_div_business_type','edit_link_business_type','save_link_business_type')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_business_type" onclick="getSaved('div_business_type','hidden_div_business_type','edit_link_business_type','save_link_business_type',<?php echo $id; ?>,'business_type',$('#edit_business_type').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                            </table>                                                
                                        </div>                                    
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-10">
                                    <div class="row acc" onclick="showAcc('contact_address')">
                                        <div class="col-lg-11">Contact Address</div>
                                        <div class="col-lg-1 text-right d-none d-lg-block d-xl-block">+</div>
                                    </div>
                                    <div style="display:none;" class="row review" id="contact_address">
                                        <div class="col-lg-12">
                                            <table class="table custome" style="border:2px solid #000000;">
                                                <tr>
                                                    <th>Street Address</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_street_address"><?php echo $street_address; ?></div>
                                                                <div id="hidden_div_street_address" style="display:none;">
                                                                    <input id="edit_street_address" class="rdl_input form-control" style="" type="text" placeholder="Street Address" value="<?php echo $street_address; ?>" onkeyup="$('#div_street_address').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_street_address" onclick="getEdited('div_street_address','hidden_div_street_address','edit_link_street_address','save_link_street_address')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_street_address" onclick="getSaved('div_street_address','hidden_div_street_address','edit_link_street_address','save_link_street_address',<?php echo $id; ?>,'street_address',$('#edit_street_address').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Lot Number</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_lot_number"><?php echo $lot_number; ?></div>
                                                                <div id="hidden_div_lot_number" style="display:none;">
                                                                    <input id="edit_lot_number" class="rdl_input form-control" style="" type="text" placeholder="Lot Number" value="<?php echo $lot_number; ?>" onkeyup="$('#div_lot_number').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_lot_number" onclick="getEdited('div_lot_number','hidden_div_lot_number','edit_link_lot_number','save_link_lot_number')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_lot_number" onclick="getSaved('div_lot_number','hidden_div_lot_number','edit_link_lot_number','save_link_lot_number',<?php echo $id; ?>,'lot_number',$('#edit_lot_number').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Unit Type</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_unit_type"><?php echo $unit_type; ?></div>
                                                                <div id="hidden_div_unit_type" style="display:none;">
                                                                    <input id="edit_unit_type" class="rdl_input form-control" style="" type="text" placeholder="Unit Type" value="<?php echo $unit_type; ?>" onkeyup="$('#div_unit_type').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_unit_type" onclick="getEdited('div_unit_type','hidden_div_unit_type','edit_link_unit_type','save_link_unit_type')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_unit_type" onclick="getSaved('div_unit_type','hidden_div_unit_type','edit_link_unit_type','save_link_unit_type',<?php echo $id; ?>,'unit_type',$('#edit_unit_type').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Unit Number</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_unit_number"><?php echo $unit_number; ?></div>
                                                                <div id="hidden_div_unit_number" style="display:none;">
                                                                    <input id="edit_unit_number" class="rdl_input form-control" style="" type="text" placeholder="Unit Number" value="<?php echo $unit_number; ?>" onkeyup="$('#div_unit_number').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_unit_number" onclick="getEdited('div_unit_number','hidden_div_unit_number','edit_link_unit_number','save_link_unit_number')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_unit_number" onclick="getSaved('div_unit_number','hidden_div_unit_number','edit_link_unit_number','save_link_unit_number',<?php echo $id; ?>,'unit_number',$('#edit_unit_number').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a></td>
                                                </tr>
                                                <tr>
                                                    <th>Floor Type</th>
                                                    <td>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div id="div_floor_type"><?php echo $floor_type; ?></div>
                                                            <div id="hidden_div_floor_type" style="display:none;">
                                                                <input id="edit_floor_type" class="rdl_input form-control" style="" type="text" placeholder="Floor Type" value="<?php echo $floor_type; ?>" onkeyup="$('#div_floor_type').html($(this).val());">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_floor_type" onclick="getEdited('div_floor_type','hidden_div_floor_type','edit_link_floor_type','save_link_floor_type')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_floor_type" onclick="getSaved('div_floor_type','hidden_div_floor_type','edit_link_floor_type','save_link_floor_type',<?php echo $id; ?>,'floor_type',$('#edit_floor_type').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Floor Number</th>
                                                    <td>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div id="div_floor_no"><?php echo $floor_no; ?></div>
                                                            <div id="hidden_div_floor_no" style="display:none;">
                                                                <input id="edit_floor_no" class="rdl_input form-control" style="" type="text" placeholder="Floor Number" value="<?php echo $floor_no; ?>" onkeyup="$('#div_floor_no').html($(this).val());">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_floor_no" onclick="getEdited('div_floor_no','hidden_div_floor_no','edit_link_floor_no','save_link_floor_no')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_floor_no" onclick="getSaved('div_floor_no','hidden_div_floor_no','edit_link_floor_no','save_link_floor_no',<?php echo $id; ?>,'floor_no',$('#edit_floor_no').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Street Number</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_street_number"><?php echo $street_number; ?></div>
                                                                <div id="hidden_div_street_number" style="display:none;">
                                                                    <input id="edit_street_number" class="rdl_input form-control" style="" type="text" placeholder="Company/Business Type" value="<?php echo $street_number; ?>" onkeyup="$('#div_street_number').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_street_number" onclick="getEdited('div_street_number','hidden_div_street_number','edit_link_street_number','save_link_street_number')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_street_number" onclick="getSaved('div_street_number','hidden_div_street_number','edit_link_street_number','save_link_street_number',<?php echo $id; ?>,'street_number',$('#edit_street_number').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Street Number Suffix</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_street_number_suffix"><?php echo $street_number_suffix; ?></div>
                                                                <div id="hidden_div_street_number_suffix" style="display:none;">
                                                                    <input id="edit_street_number_suffix" class="rdl_input form-control" style="" type="text" placeholder="Street Number Suffix" value="<?php echo $street_number_suffix; ?>" onkeyup="$('#div_street_number_suffix').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_street_number_suffix" onclick="getEdited('div_street_number_suffix','hidden_div_street_number_suffix','edit_link_street_number_suffix','save_link_street_number_suffix')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_street_number_suffix" onclick="getSaved('div_street_number_suffix','hidden_div_street_number_suffix','edit_link_street_number_suffix','save_link_street_number_suffix',<?php echo $id; ?>,'street_number_suffix',$('#edit_street_number_suffix').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Street Name</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_street_name"><?php echo $street_name; ?></div>
                                                                <div id="hidden_div_street_name" style="display:none;">
                                                                    <input id="edit_street_name" class="rdl_input form-control" style="" type="text" placeholder="Street Name" value="<?php echo $street_name; ?>" onkeyup="$('#div_street_name').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_street_name" onclick="getEdited('div_street_name','hidden_div_street_name','edit_link_street_name','save_link_street_name')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_street_name" onclick="getSaved('div_street_name','hidden_div_street_name','edit_link_street_name','save_link_street_name',<?php echo $id; ?>,'street_name',$('#edit_street_name').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Street type</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_street_type"><?php echo $street_type; ?></div>
                                                                <div id="hidden_div_street_type" style="display:none;">
                                                                    <input id="edit_street_type" class="rdl_input form-control" style="" type="text" placeholder="Street type" value="<?php echo $street_type; ?>" onkeyup="$('#div_street_type').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_street_type" onclick="getEdited('div_street_type','hidden_div_street_type','edit_link_street_type','save_link_street_type')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_street_type" onclick="getSaved('div_street_type','hidden_div_street_type','edit_link_street_type','save_link_street_type',<?php echo $id; ?>,'street_type',$('#edit_street_type').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Street Suffix</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_street_suffix"><?php echo $street_suffix; ?></div>
                                                                <div id="hidden_div_street_suffix" style="display:none;">
                                                                    <input id="edit_street_suffix" class="rdl_input form-control" style="" type="text" placeholder="Street Suffix" value="<?php echo $street_suffix; ?>" onkeyup="$('#div_street_suffix').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_street_suffix" onclick="getEdited('div_street_suffix','hidden_div_street_suffix','edit_link_street_suffix','save_link_street_suffix')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_street_suffix" onclick="getSaved('div_street_suffix','hidden_div_street_suffix','edit_link_street_suffix','save_link_street_suffix',<?php echo $id; ?>,'street_suffix',$('#edit_street_suffix').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Suburb</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_suburb"><?php echo $suburb; ?></div>
                                                                <div id="hidden_div_suburb" style="display:none;">
                                                                    <input id="edit_suburb" class="rdl_input form-control" style="" type="text" placeholder="Suburb" value="<?php echo $suburb; ?>" onkeyup="$('#div_suburb').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_suburb" onclick="getEdited('div_suburb','hidden_div_suburb','edit_link_suburb','save_link_suburb')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_suburb" onclick="getSaved('div_suburb','hidden_div_suburb','edit_link_suburb','save_link_suburb',<?php echo $id; ?>,'suburb',$('#edit_suburb').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Post Code</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_postcode"><?php echo $postcode; ?></div>
                                                                <div id="hidden_div_postcode" style="display:none;">
                                                                    <input id="edit_postcode" class="rdl_input form-control" style="" type="text" placeholder="Post Code" value="<?php echo $postcode; ?>" onkeyup="$('#div_postcode').html($(this).val());">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_postcode" onclick="getEdited('div_postcode','hidden_div_postcode','edit_link_postcode','save_link_postcode')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_postcode" onclick="getSaved('div_postcode','hidden_div_postcode','edit_link_postcode','save_link_postcode',<?php echo $id; ?>,'postcode',$('#edit_postcode').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Select State</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_state"><?php echo $state; ?></div>
                                                                <div id="hidden_div_state" style="display:none;">
                                                                    <select id="edit_state" class="form-select" onchange="$('#div_state').html($(this).val());">
                                                                        <option value="">Select State</option>
                                                                        <option <?php echo $state=='ACT'?'selected':''; ?> value="ACT">ACT</option>
                                                                        <option <?php echo $state=='NSW'?'selected':''; ?> value="NSW">NSW</option>
                                                                        <option <?php echo $state=='NT'?'selected':''; ?> value="NT">NT</option>
                                                                        <option <?php echo $state=='QLD'?'selected':''; ?> value="QLD">QLD</option>
                                                                        <option <?php echo $state=='SA'?'selected':''; ?> value="SA">SA</option>
                                                                        <option <?php echo $state=='TAS'?'selected':''; ?> value="TAS">TAS</option>
                                                                        <option <?php echo $state=='VIC'?'selected':''; ?> value="VIC">VIC</option>
                                                                        <option <?php echo $state=='WA'?'selected':''; ?> value="WA">WA</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_state" onclick="getEdited('div_state','hidden_div_state','edit_link_state','save_link_state')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_state" onclick="getSaved('div_state','hidden_div_state','edit_link_state','save_link_state',<?php echo $id; ?>,'state',$('#edit_state').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                            </table>                                                
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-10">
                                    <div class="row acc" onclick="showAcc('div-notes')">
                                    <div class="col-lg-11">Notes</div>
                                    <div class="col-lg-1 text-right d-none d-lg-block d-xl-block">+</div>
                                    </div>
                                    <div style="display:none;" class="row review" id="div-notes">
                                        <div class="col-lg-12">
                                            <table id="table-add-notes" class="table half" style="border:2px solid #000000;">
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><button type="button" onclick="showAddNotes(<?php echo $id; ?>,0)" class="btn btn-info">ADD</button></td>
                                                </tr>
                                                <?php echo $lead_notes; ?>
                                            </table>                                                
                                        </div>
                                    </div>
                                </div>                                
                                <div class="col-lg-12 mb-10">
                                    <div class="row acc" onclick="showAcc('div-attachment')">
                                        <div class="col-lg-11">Attachment</div>
                                        <div class="col-lg-1 text-right d-none d-lg-block d-xl-block">+</div>
                                    </div>
                                    <div style="display:none;" class="row review" id="div-attachment">
                                        <div class="col-lg-12">
                                            <table id="table-add-attachment" class="table half" style="border:2px solid #000000;">
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><button type="button" onclick="showAddAttachment(<?php echo $id; ?>)" class="btn btn-info">ADD</button></td>
                                                </tr>
                                                <?php echo $lead_attachment; ?>
                                            </table>                                                
                                        </div>
                                    </div>
                                </div>                                
                                <div class="col-lg-12 mb-10">
                                    <div class="row acc" onclick="showAcc('div-commission')">
                                        <div class="col-lg-11">Commission</div>
                                        <div class="col-lg-1 text-right d-none d-lg-block d-xl-block">+</div>
                                    </div>
                                    <div style="display:none;" class="row review" id="div-commission">
                                        <div class="col-lg-12">
                                            <table id="table-add-commission" class="table table-res" style="border:2px solid #000000;">
                                                <?php $commission_row = 1; ?>
                                                <tr id="<?php echo 'commission_row_'.$commission_row++; ?>">
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <th></th>
                                                    <td><button type="button" onclick="showAddCommission(<?php echo $id; ?>,0,'')" class="btn btn-info">ADD</button></td>
                                                </tr>
                                                <tr id="<?php echo 'commission_row_'.$commission_row++; ?>">
                                                    <th>Service&nbsp;Type</th>
                                                    <th>Customer&nbsp;Type</th>
                                                    <th>Deliverable&nbsp;Range</th>
                                                    <th>Deliverable&nbsp;Period</th>
                                                    <th>Clawback&nbsp;Period</th>
                                                    <th>Clawback&nbsp;Criteria</th>
                                                    <th>Upfront&nbsp;Commission</th>
                                                    <th>Effective&nbsp;Date</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                                <?php if($team_commission['status']): 
                                                    foreach ($team_commission['records'] as $rec):
                                                    ?>
                                                    <tr id="<?php echo 'commission_row_'.$commission_row; ?>">
                                                        <td><?= $rec['service_type'] ?><?= empty($rec['retailers_name'])?"":" (".$rec['retailers_name'].")" ?></td>
                                                        <td><?= $rec['customer_type'] ?></td>
                                                        <td><?= $rec['deliverable_start_range'] ?> - <?= $rec['deliverable_end_range'] ?></td>
                                                        <td><?= $rec['deliverable_period'] ?></td>
                                                        <td><?= $rec['clawback_period'] ?> days</td>
                                                        <td><?= $rec['clawback_criteria'] ?> days</td>
                                                        <td>$<?= $rec['upfront_commission'] ?></td>
                                                        <td><?= date('d/m/Y',strtotime($rec['effective_date'])) ?></td>
                                                        <td><button class="btn btn-link" style="color:black;padding:0px;" onclick="showAddCommission(<?php echo $id; ?>,<?php echo $rec['team_commission_id']; ?>,`<?php echo 'commission_row_'.$commission_row; ?>`)"><i class="material-icons">create</i></button></td>
                                                        <td><button class="btn btn-link" style="color:#cd201f;padding:0px;" onclick="deleteCommission(<?php echo $rec['team_commission_id']; ?>,`<?php echo 'commission_row_'.$commission_row++; ?>`)"><i class="material-icons">delete</i></button></td>
                                                    </tr>
                                                <?php endforeach;endif; ?>    
                                            </table>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-10">
                                    <div class="row acc" onclick="showAcc('other_details')">
                                    <div class="col-lg-11">Other Details</div>
                                    <div class="col-lg-1 text-right d-none d-lg-block d-xl-block">+</div>
                                    </div>
                                    <div style="display:none;" class="row review" id="other_details">
                                        <div class="col-lg-12">
                                            <table class="table custome" style="border:2px solid #000000;">
                                                <tr>
                                                    <th><button type="button" onclick="changePassword(<?php echo $id; ?>)" class="btn btn-info">Change Password</button></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th>Date of Joining</th>
                                                    <td>
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <div id="div_doj"><?php echo date('d-m-Y',strtotime($doj)); ?></div>
                                                        <div id="hidden_div_doj" style="display:none;">
                                                            <input id="edit_doj" class="rdl_input form-control" type="date" value="<?php echo $doj; ?>" onfocusout="$('#div_doj').html($(this).val());">
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_doj" onclick="getEdited('div_doj','hidden_div_doj','edit_link_doj','save_link_doj')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_doj" onclick="getSaved('div_doj','hidden_div_doj','edit_link_doj','save_link_doj',<?php echo $id; ?>,'doj',$('#edit_doj').val());$('#div_doj').html($('#edit_doj').val());" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Master Partner Code</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_master_partner_code"><?php echo $master_partner_code; ?></div>
                                                                <div id="hidden_div_master_partner_code" style="display:none;">
                                                                    <select id="edit_master_partner_code" class="form-select" onchange="$('#div_master_partner_code').html($(this).val());">
                                                                        <option value="">Select</option>
                                                                        <?php  if($master_partner_code_list['status']): 
                                                                        foreach ($master_partner_code_list['records'] as $rec): 
                                                                            if($master_partner_code == $rec['code']){
                                                                        ?>
                                                                            <option selected value="<?= $rec['code'] ?>"><?= $rec['company_name'] ?> (<?= $rec['code'] ?>)</option>
                                                                        <?php }else if($rec['status'] == 1){ ?>
                                                                            <option value="<?= $rec['code'] ?>"><?= $rec['company_name'] ?> (<?= $rec['code'] ?>)</option>
                                                                        <?php } endforeach;endif; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_master_partner_code" onclick="getEdited('div_master_partner_code','hidden_div_master_partner_code','edit_link_master_partner_code','save_link_master_partner_code')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_master_partner_code" onclick="getSaved('div_master_partner_code','hidden_div_master_partner_code','edit_link_master_partner_code','save_link_master_partner_code',<?php echo $id; ?>,'master_partner_code',$('#edit_master_partner_code').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Partner Code</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_code"><?php echo $code; ?></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div id="div_status"><?php echo $status==1?"Active":"Inactive"; ?></div>
                                                                <div id="hidden_div_status" style="display:none;">
                                                                    <select id="edit_status" class="form-select" onchange="var val = $(this).val()==1?'Active':'Inactive';$('#div_status').html(val);">
                                                                        <option value="">Select Status</option>
                                                                        <option <?php echo $status==1?"selected":""; ?> value="1">Active</option>
                                                                        <option <?php echo $status==0?"selected":""; ?> value="0">Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a id="edit_link_status" onclick="getEdited('div_status','hidden_div_status','edit_link_status','save_link_status')" style="color:black;"><i class="material-icons">create</i></a>
                                                        <a id="save_link_status" onclick="getSaved('div_status','hidden_div_status','edit_link_status','save_link_status',<?php echo $id; ?>,'status',$('#edit_status').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>
                                                    </td>
                                                </tr>
                                                <!--<tr>-->
                                                <!--    <th>Access Type</th>-->
                                                <!--    <td>-->
                                                <!--        <div class="row">-->
                                                <!--            <div class="col-12">-->
                                                <!--                <div id="div_access_type"><?php echo $access_type; ?></div>-->
                                                <!--                <div id="hidden_div_access_type" style="display:none;">-->
                                                <!--                    <select id="edit_access_type" class="form-select" onchange="$('#div_access_type').html($(this).val());">-->
                                                <!--                        <option value="">Select Access Type</option>-->
                                                <!--                        <option <?php echo $access_type=='Admin'?"selected":""; ?> value="1">Admin</option>-->
                                                <!--                        <option <?php echo $access_type=='Manager'?"selected":""; ?> value="0">Manager</option>-->
                                                <!--                        <option <?php echo $access_type=='Member'?"selected":""; ?> value="0">Member</option>-->
                                                <!--                    </select>-->
                                                <!--                </div>-->
                                                <!--            </div>-->
                                                <!--        </div>-->
                                                <!--    </td>-->
                                                <!--    <td>-->
                                                <!--        <a id="edit_link_access_type" onclick="getEdited('div_access_type','hidden_div_access_type','edit_link_access_type','save_link_access_type')" style="color:black;"><i class="material-icons">create</i></a>-->
                                                <!--        <a id="save_link_access_type" onclick="getSaved('div_access_type','hidden_div_access_type','edit_link_access_type','save_link_access_type',<?php echo $id; ?>,'access_type',$('#edit_access_type').val())" style="color:green;display:none;"><i class="material-icons">done_outline</i></a>-->
                                                <!--    </td>-->
                                                <!--</tr>-->
                                            </table>                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">            
      function showAcc(step){
        $('#'+step).toggle('slow');
      }
      function getEdited(div1,div2,link1,link2){
        $('#'+div1).hide();
        $('#'+div2).show();
        $('#'+link1).hide();
        $('#'+link2).show();
      }
      function getSaved(div1,div2,link1,link2,id,name,value){
        $('#'+div1).show();
        $('#'+div2).hide();
        $('#'+link1).show();
        $('#'+link2).hide();
        $.ajax({
          url: "<?php echo base_url(); ?>/team/updateEachValue",
          dataType: "JSON",
          data:{ id: id, name: name, value: value }
        });
      }
    </script>
    <script type="text/javascript">
      jQuery(function($) {
        $('.team').addClass('active');
      });
      function showAddNotes(id,note_id,row_id){
        $('#lead_note').val("");
        $('#note_id').val(0);
        $('#row_id').val(0);
        if(note_id!=0){
            $('#note_id').val(note_id);
            $('#row_id').val(row_id);
            $.ajax({
                url: "<?php echo base_url(); ?>/team/getTeamNotes/"+note_id,
                type: "POST",
                contentType: "application/json",
                dataType: "json",
                success: function(response) {
                    if(response.status){
                        $('#lead_note').val(response.records[0].notes);
                    }
                }            
            });
        }
        $('#notes_lead_id').val(id);
        $('#modalAddNotes').modal({show:true,backdrop:'static'});
      }
      function deleteAttachment(id,row_id,file_name){
        var txt;
        var r = confirm("Are you want to sure delete!");
        if (r == true) {
            $.ajax({
                url: "<?php echo base_url(); ?>/team/deleteTeamAttachment/"+id,
                type: "POST",
                data: "file_name="+file_name,
                contentType: "application/json",
                success: function(response) {
                    if(response){
                        $('#'+row_id).html("");
                    }
                }            
            });
        }
      }
      function deleteCommission(id,row_id){
        var txt;
        var r = confirm("Are you want to sure delete!");
        if (r == true) {
            $.ajax({
                url: "<?php echo base_url(); ?>/team/deleteCommission/"+id,
                type: "POST",
                contentType: "application/json",
                success: function(response) {
                    if(response){
                        $('#'+row_id).html("");
                    }
                }            
            });
        }
      }
      function showAddAttachment(attachment_team_id){
        $('#attachment_team_id').val(attachment_team_id);
        $('#modalAddAttachment').modal({show:true,backdrop:'static'});
      }
      function showAddCommission(commission_team_id,team_commission_id,commission_row_id){
        $("#frm-add-commission")[0].reset();
        $('#commission_team_id').val(commission_team_id);
        $('#team_commission_id').val(0);
        $('#commission_row_id').val('');
        if(team_commission_id!=0){
            $('#team_commission_id').val(team_commission_id);
            $('#commission_row_id').val(commission_row_id);
            $.ajax({
                url: "<?php echo base_url(); ?>/team/getTeamCommission/"+team_commission_id,
                type: "POST",
                contentType: "application/json",
                dataType: "json",
                success: function(response) {
                    if(response.status){
                        $('#retailer_id').val(response.records[0].retailer_id);
                        $('#service_type').val(response.records[0].service_type);
                        $('#customer_type').val(response.records[0].customer_type);
                        $('#deliverable_start_range').val(response.records[0].deliverable_start_range);
                        $('#deliverable_end_range').val(response.records[0].deliverable_end_range);
                        $('#deliverable_period').val(response.records[0].deliverable_period);
                        $('#clawback_period').val(response.records[0].clawback_period);
                        $('#clawback_criteria').val(response.records[0].clawback_criteria);
                        $('#upfront_commission').val(response.records[0].upfront_commission);
                        $('#quality_manager_upfront_commission').val(response.records[0].quality_manager_upfront_commission);
                        $('#quality_analyst_upfront_commission').val(response.records[0].quality_analyst_upfront_commission);
                        var now = new Date(response.records[0].effective_date);
                        var day = ("0" + now.getDate()).slice(-2);
                        var month = ("0" + (now.getMonth() + 1)).slice(-2);
                        var today = now.getFullYear()+"-"+(month)+"-"+(day);
                        $('#effective_date').val(today);
                    }
                }            
            });
        }
        $('#modalAddCommission').modal({show:true,backdrop:'static'});
      }
      function changePassword(id){
        $('#change_password_id').val(id);
        $('#modalChangePassword').modal({show:true,backdrop:'static'});
      }
      function autoGeneratePassword(){
        alert('Please make sure you have copied password before save!');
        var chars = ["ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz","0123456789", "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"];
        var randPwd = [5,3,2].map(function(len, i) { return Array(len).fill(chars[i]).map(function(x) { return x[Math.floor(Math.random() * x.length)] }).join('') }).concat().join('').split('').sort(function(){return 0.5-Math.random()}).join('');
        $("#psw").val(randPwd);
      }
      function myFunction() {
        var x = document.getElementById("psw");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
      jQuery(function($) {
        $(document).ready(function () {
            $('#frm-add-commission').on('submit',(function(e) {
                e.preventDefault();
                var rowCount = $('#table-add-commission tr').length;
                $('#btn-add-commission').prop('disabled', true);
                if($('#commission_row_id').val()==0 || $('#commission_row_id').val()==''){
                    $('#commission_row_id').val("commission_row_"+rowCount);
                }
                var commission_row_id = $('#commission_row_id').val();
                var team_commission_id = $('#team_commission_id').val();
                $.ajax({
                    url: "<?php echo base_url(); ?>/team/saveTeamCommission",
                    type: "POST",
                    data: $("#frm-add-commission").serializeArray(),
                    contentType: "application/json",
                    success: function(response) {
                        $('#btn-add-commission').prop('disabled', false);
                        $('#modalAddCommission').modal('hide');
                        if(team_commission_id=="" || team_commission_id == 0){
                            var response = '<tr id="'+commission_row_id+'">'+response+'</tr>';
                            tableBody = $("#table-add-commission tbody tr").eq(1);
                            tableBody.after(response);
                        }
                        else{
                            $('#'+commission_row_id).html(response);
                        }
                        $("#frm-add-commission")[0].reset();
                    }            
                });
            }));
            $('#frm-add-notes').on('submit',(function(e) {
                e.preventDefault();
                var rowCount = $('#table-add-notes tr').length;
                $('#btn-add-notes').prop('disabled', true);
                var note_id = $('#note_id').val();
                if($('#row_id').val()==0||$('#row_id').val()==''){
                    $('#row_id').val("row"+rowCount);
                }
                var row_id = $('#row_id').val();
                $.ajax({
                url: "<?php echo base_url(); ?>/team/saveTeamNotes",
                type: "POST",
                data: $("#frm-add-notes").serializeArray(),
                contentType: "application/json",
                success: function(response) {
                    $('#btn-add-notes').prop('disabled', false);
                    $('#modalAddNotes').modal('hide');
                    if(note_id=="" || note_id == 0){
                        var response = '<tr id="row'+rowCount+'">'+response+'</tr>';
                        tableBody = $("#table-add-notes tbody tr:first");
                        tableBody.after(response);
                        $("#frm-add-notes")[0].reset();
                    }
                    else{
                        $('#'+row_id).html(response);
                    }
                }            
                });
            }));
            $('#frm-add-attachment').on('submit',(function(e) {
                e.preventDefault();
                var rowCount = $('#table-add-attachment tr').length;
                $('#btn-add-attachment').prop('disabled', true);
                var attachment_note_id = $('#attachment_note_id').val();
                if($('#attachment_row_id').val()==0 || $('#attachment_row_id').val()==''){
                    $('#attachment_row_id').val("attachment_row"+rowCount);
                }
                var formData = new FormData(this);
                $.ajax({
                    url: "<?php echo base_url(); ?>/team/saveTeamAttachment",
                    type: "POST",
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#btn-add-attachment').prop('disabled', false);
                        $('#modalAddAttachment').modal('hide');
                        var response = '<tr id="attachment_row'+rowCount+'">'+response+'</tr>';
                        tableBody = $("#table-add-attachment tbody tr:first");
                        tableBody.after(response);
                        $("#frm-add-attachment")[0].reset();
                    }            
                });
            }));
            $('#frm-change-password').on('submit',(function(e) {
                e.preventDefault();
                $('#btn-change-password').prop('disabled', true);
                $('#div-msg-save').addClass("alert-danger").removeClass("alert-success").html("Please Wait!").slideDown(100);
                $.ajax({
                    url: "<?php echo base_url(); ?>/team/changePassword",
                    type: "POST",
                    data: $("#frm-change-password").serializeArray(),
                    contentType: "application/json",
                    dataType: "json",
                    success: function(response) {
                        if(response.status=="Fail"){
                            $('#div-msg-save').addClass("alert-danger").removeClass("alert-success").html(response.msg).slideDown(500).delay(4000).slideUp(
                                function(){ 
                                    $('#btn-change-password').prop('disabled', false);
                                    $('#modalChangePassword').modal('hide');
                                }
                            );
                        }
                        else{
                            $('#div-msg-save').addClass("alert-success").removeClass("alert-danger").html(response.msg).slideDown(500).delay(4000).slideUp(
                                function(){
                                    $('#btn-change-password').prop('disabled', false);
                                    $('#modalChangePassword').modal('hide');
                                    $('#psw').val('');
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
        function remove_row(row){
            $('#'+row).html('');
        }
        function remove_row(row){
            $('#'+row).html('');
        }
    </script>
    <div class="modal fade" id="modalAddCommission" tabindex="-1" role="dialog" style="font-family: SourceSansPro, Helvetica, Arial, sans-serif;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-white bg-blue">
            <h5 class="modal-title">Add New Commission</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" style="color:white;">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="background-color:#fff;">
            <form id="frm-add-commission" enctype="multipart/form-data" method="post">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-2 row">
                            <label class="form-label col-4 col-form-label">Retailer</label>
                            <div class="col-8">
                                <select class="form-select" id="retailer_id" name="retailer_id">
                                    <option value="">Select Retailer</option>
                                    <?php if($retailers['status']){
                                        foreach($retailers['records'] as $rec){
                                        echo "<option retailer='".$rec['name']."' value='".$rec['id']."'>".$rec['name']."</option>";
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="form-label col-4 col-form-label required">Service Type</label>
                            <div class="col-8">
                                <input type="hidden" id="commission_team_id" name="team_id">
                                <input type="hidden" id="team_commission_id" name="team_commission_id">
                                <input type="hidden" id="commission_row_id" name="row_id">
                                <select id="service_type" name="service_type" class="form-select" required>
                                    <option value="">Select Service Type...</option>
                                    <option value="Electricity">Electricity</option>
                                    <option value="Gas">Gas</option>
                                    <option value="Dual">Dual</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="form-label col-4 col-form-label required">Customer Type</label>
                            <div class="col-8">
                                <select id="customer_type" name="customer_type" class="form-select" required>
                                    <option value="">Select Customer Type...</option>
                                    <option value="Residential">Residential</option>
                                    <option value="Business">Business</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="form-label col-4 col-form-label required">Deliverable Range</label>
                            <label class="form-label col-1 col-form-label required">From</label>
                            <div class="col-3">
                                <input id="deliverable_start_range" name="deliverable_start_range" type="number" class="form-control" placeholder="No of Sales" required/>
                            </div>
                            <label class="form-label col-1 col-form-label required">To</label>
                            <div class="col-3">
                                <input id="deliverable_end_range" name="deliverable_end_range" type="number" class="form-control" placeholder="No of Sales" required/>
                            </div>                  
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="form-label col-4 col-form-label required">Deliverable Period</label>
                            <div class="col-8">
                                <!-- <input id="deliverable_period" name="deliverable_period" type="number" class="form-control" placeholder="No of days"/> -->
                                <select id="deliverable_period" name="deliverable_period" class="form-select" required>
                                    <option value="">Select Deliverable Period</option>
                                    <option value="Monthly">Monthly</option>
                                    <!-- <option value="Yearly">Yearly</option> -->
                                </select>
                            </div>                  
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="form-label col-4 col-form-label required">Clawback Period</label>
                            <div class="col-8">
                                <input id="clawback_period" name="clawback_period" type="number" class="form-control" placeholder="No of Days" required/>
                            </div>                  
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="form-label col-4 col-form-label required">Clawback Criteria</label>
                            <div class="col-8">
                                <input id="clawback_criteria" name="clawback_criteria" type="number" class="form-control" placeholder="Clawback Criteria"/>
                            </div>                  
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="form-label col-4 col-form-label required">Sales<br/><small>Upfront Commission ($)</small></label>
                            <div class="col-8">
                                <input id="upfront_commission" name="upfront_commission" type="number" class="form-control" placeholder="Commission Amount ($)" step="any" required/>
                            </div>                  
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="form-label col-4 col-form-label required">Quality Manager<br/><small>Upfront Commission ($)</small></label>
                            <div class="col-8">
                                <input id="quality_manager_upfront_commission" name="quality_manager_upfront_commission" type="number" class="form-control" step="any" placeholder="Commission Amount ($)" required/>
                            </div>                  
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="form-label col-4 col-form-label required">Quality Analyst<br/><small>Upfront Commission ($)</small></label>
                            <div class="col-8">
                                <input id="quality_analyst_upfront_commission" name="quality_analyst_upfront_commission" type="number" class="form-control" step="any" placeholder="Commission Amount ($)" required/>
                            </div>                  
                        </div>
                        <div class="form-group mb-2 row">
                            <label class="form-label col-4 col-form-label required">Effective Date</label>
                            <div class="col-8">
                                <input id="effective_date" name="effective_date" type="date" class="form-control" placeholder="dd/mm/yyyy" required/>
                            </div>                  
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-footer btn-list justify-content-end">
                            <button id="btn-add-commission" type="submit" class="btn btn-primary btn-pill">Save</button>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalAddAttachment" tabindex="-1" role="dialog" style="font-family: SourceSansPro, Helvetica, Arial, sans-serif;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-white bg-blue">
            <h5 class="modal-title">Attachment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" style="color:white;">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="background-color:#fff;">
            <form id="frm-add-attachment" enctype="multipart/form-data" method="post">
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" id="attachment_team_id" name="team_member_id">
                        <input type="hidden" id="attachment_row_id" name="row_id">
                        <input type="file" class="form-control" name="attachment" required/>
                    </div>
                    <div class="col-12">
                        <div class="form-footer btn-list justify-content-start">
                            <button id="btn-add-attachment" type="submit" class="btn btn-primary btn-pill">Upload</button>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalAddNotes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="font-family: SourceSansPro, Helvetica, Arial, sans-serif;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-white bg-blue">
            <h5 class="modal-title" id="exampleModalCenterTitle">Notes</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" style="color:white;">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="background-color:#fff;">
            <div class="row">
              <div class="col-12">
                <div class="card" style="border: none;background-color:#fff;">
                  <form id="frm-add-notes">
                    <div class="card-body hr-tag">
                      <div id="div-msg-add-notes" class="alert text-center" style="display:none;"></div>
                      <div class="row buttom-line">
                        <div class="col-12">
                          <input type="hidden" id="notes_lead_id" name="team_member_id">
                          <input type="hidden" id="note_id" name="note_id">
                          <input type="hidden" id="row_id" name="row_id">
                          <textarea rows="6" id="lead_note" name="notes" class="form-control" required></textarea>
                        </div>
                      </div>
                      <div class="form-group mb-2 row" style="border:none;padding:none;">
                        <label class="form-label col-9 col-form-label"></label>
                        <div class="col-3">
                          <div class="form-footer btn-list justify-content-start">
                            <button id="btn-add-notes" type="submit" class="btn btn-primary btn-pill">Save</button>
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
    <div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog" style="font-family: SourceSansPro, Helvetica, Arial, sans-serif;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-white bg-blue">
            <h5 class="modal-title">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" style="color:white;">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="background-color:#fff;">
            <form id="frm-change-password" method="post">
                <div id="div-msg-save" class="alert text-center" style="display:none;"></div>
                <div class="row">
                    <div class="col-11">
                        <input type="hidden" id="change_password_id" name="id">
                        <input type="password" placeholder="Type new password" class="form-control" name="password" id="psw" required/><p><input class="w3-check" type="checkbox" onclick="myFunction()"> Show Password</p>
                    </div>
                    <div class="col-1">
                        <a class="btn btn-link" data-toggle="tooltip" data-placement="top" title="Auto generate password" onclick="autoGeneratePassword()"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg></a>
                    </div>
                    <div class="col-12">
                        <p><input class="w3-check" type="checkbox" name="is_send_notification"> Send Email Notification To Team Member</p>
                    </div>
                    <div class="col-12">
                        <div class="form-footer btn-list justify-content-start">
                            <button id="btn-change-password" type="submit" class="btn btn-primary btn-pill">Change Password Now</button>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>