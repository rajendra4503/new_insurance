<?php
session_start();
ini_set("display_errors","0");
include('include/configinc.php');
include('include/session.php');
include('include/functions.php');

$logged_userid = $_SESSION['logged_userid'];

function escapeString($string) {
    return mysql_real_escape_string($string);
}

if (!empty($_GET['CostId']) != '') {

    $CostId = $_REQUEST['CostId'];
}
 
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>eTPA - Employee</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/planpiper.css">
    <link rel="stylesheet" type="text/css" href="fonts/font.css">
    <link rel="shortcut icon" href="images/planpipe_logo.png"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootbox.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script src="js/bootstrap3-typeahead.min.js"></script>
    <style type="text/css">
          .error{
          color: #ed0716;
          font-size: 15px;
          font-weight: bold;
          }
          #deceased{
          background-color:#FFF3F5;
          padding-top:10px;
          margin-bottom:10px;
          }
          .remove_field{
          color: red;
          float:right;  
          cursor:pointer;
          position : absolute;
          }
          .remove_field:hover{
          text-decoration:none;
          }
      </style>
  </head>
<body style="overflow:hidden;">

  <div id="planpiper_wrapper">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0" style="height:100%;">
      <div class="col-sm-2 paddingrl0"  id="sidebargrid">
      <?php include("sidebar.php");?>
    </div>
        <div class="col-sm-10 paddingrl0" id="content_wrapper">
      <?php include_once('top_header.php');?>
<section>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="mainplanlistdiv" style="height: 680px;">

      


<form action="customer_employee_details.php?CostId=<?php echo $CostId;?>"  name="basicform" id="basicform" method="post" enctype="multipart/form-data">

  <input type="hidden" name="type" value="insert">

  <input type="hidden" name="CostId" value="<?php echo $CostId;?>">

  <div class="col-md-6 col-sm-6">

        <div class="form-group">
            <label for="name">Employee Number *</label>
            <input type="text" class="form-control input-sm numberonly" id="employee_number" name="employee_number" required>
        </div>

        <div class="form-group">
            <label for="name">Last Name *</label>
            <input type="text" class="form-control input-sm" id="last_name" name="last_name" placeholder="" required>
        </div>

        <div class="form-group">
            <label for="name">First Name *</label>
            <input type="text" class="form-control input-sm" id="first_name" name="first_name" placeholder="" required>
        </div>

        <div class="form-group">
            <label for="name">Date of Birth *</label>
            <input type="text" class="form-control input-sm" id="date_birth" name="date_birth" required>
        </div>

        <div class = "form-group">
            <label for="years">Gender *</label>  
            <select class="form-control input-sm" name="sex" id="sex" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Transgender">Transgender</option>
            </select>
        </div>

        <div class="form-group">
            <label for="gender">Mobile Number</label>
            <input type="text" class="form-control input-sm" id="mobile_number" name="mobile_number" placeholder="" required>
        </div>

        <div class="form-group">
            <label for="name">Email ID *</label>
            <input type="email" class="form-control input-sm" id="email" name="email" placeholder="" required>
        </div>
  </div>

  <div class="col-md-6 col-sm-6">

      <div class="form-group">
         <label for="address">Address Line 1</label>
         <input type="text" class="form-control input-sm" name="address_1" id="address_1" required>
       </div>

       <div class="form-group">
         <label for="address">Address Line 2</label>
         <input type="text" class="form-control input-sm" name="address_2"  id="address_2" required>
       </div>

       <div class="form-group">
          <label for="country">Country *</label>
          <input type="text" class="form-control input-sm" id="country" name="country" placeholder="" required>
       </div>

      <div class="form-group">
          <label for="state">State *</label>
          <input type="text" class="form-control input-sm" id="state" name="state" placeholder="" required>
      </div>

      <div class="form-group">
          <label for="city">City *</label>
          <input type="text" class="form-control input-sm" id="city" name="city" placeholder="" required>
      </div>

      <div class="form-group">
          <label for="pincode">Postal Code *</label>
          <input type="text" class="form-control input-sm numberonly" id="postal_code" name="postal_code" placeholder="" required>
      </div>
 </div>

 <div class="field_wrapper">

  <div class="col-md-12 col-sm-12">

        <div class="form-group col-md-3 col-sm-3">
            <label for="name">Last Name*</label>
            <input type="text" class="form-control input-sm" name="dep_last_name[]">
        </div>

        <div class="form-group col-md-3 col-sm-3">
            <label for="gender">First Name *</label>
            <input type="text" class="form-control input-sm" name="dep_first_name[]" placeholder="">
        </div>

        <div class="form-group col-md-3 col-sm-3">
          <label for="age">Gender</label>
          <select class="form-control input-sm" name="dep_gender[]">
             <option value="Male">Male</option>
             <option value="Female">Female</option>
             <option value="Transgender">Transgender</option>
          </select>
        </div>

        <div class="form-group col-md-3 col-sm-3">
            <label for="DOB">Date of Birth*</label>
            <input type="text" class="form-control input-sm datepicker" name="dep_date_birth[]" placeholder="">
        </div>
  </div>

</div>

    <div class="col-md-12 col-sm-12">
      <div class="form-group col-md-3 col-sm-3">
        <input type='button' class="btn btn-primary" value="Add" id="add"/>
      </div>
    </div>

  <div class="form-group">
    <div class="col-lg-10 col-lg-offset-6">
    <button class="btn btn-primary open1" type="button">Submit </button> 
    <img src="images/spinner.gif" alt="" id="loader" style="display: none">
    </div>
  </div>

  </form> 
  </div>
  </section>
 </div>
</div>  
</div>
</div><!-- big_wrapper ends -->   
<script type="text/javascript">

   var wrapper = $('.field_wrapper');
   var max_fields = 10;
   var x = 1;
    $('#add').click(function () { 

      if(x < max_fields){
            x++;
            var fieldHTML = '<div class="col-md-12 col-sm-12"><div class="form-group col-md-3 col-sm-3"><label for="name">Last Name*</label><input type="text" class="form-control input-sm" name="dep_last_name[]"></div><div class="form-group col-md-3 col-sm-3"><label for="gender">First Name*</label><input type="text" class="form-control input-sm" name="dep_first_name[]" placeholder=""></div><div class="form-group col-md-3 col-sm-3"><label for="age">Gender</label><select class="form-control input-sm" name="dep_gender[]"><option value="Male">Male</option><option value="Female">Female</option><option value="Transgender">Transgender</option></select></div><div class="form-group col-md-3 col-sm-3"><label for="DOB">Date of Birth*</label><input type="text" class="form-control input-sm datepicker" name="dep_date_birth[]" placeholder=""></div></div>';

            $(wrapper).append(fieldHTML); 

           }  else{
           alert("Only 10 Names Allowed");
         }  
    });

    $(wrapper).on('click', '.remove_field', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });

    $('.numberonly').bind('keyup paste', function(){
      this.value = this.value.replace(/[^0-9]/g, '');
    });
  
    $('body').on('focus',".datepicker", function(){
      $(this).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });

  jQuery().ready(function() {

    var v = jQuery("#basicform").validate({
        rules: {
          employee_number : "required",
          last_name : "required",
          address_1: "required",
          first_name: "required",
          date_birth:{
              required: true
          },
          address_2:"required",
          mobile_number:{
              required: true,
              digits: true
              },
          email:{
                 required: true,
                 email: true,
          },
          country : "required",
          state:"required",
          city:"required",
          postal_code:{
              required: true,
              digits: true
          },
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
          error.addClass( "help-block" );
          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
          } else {
            error.insertAfter( element );
          }
        },
        highlight: function ( element, errorClass, validClass ) {
        },
        unhighlight: function (element, errorClass, validClass) {
        }
    });

    $(".open1").click(function() {
      if (v.form()) {
        $("#loader").show();
         setTimeout(function(){
           $( "#basicform" ).submit();
         }, 1000);
        return false;
      }
    });

  });

  $("#date_birth").keypress(function(event) {event.preventDefault();});
  $(".datepicker").keypress(function(event) {event.preventDefault();});


  $(function() {
        $( "#date_birth" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });

        $( ".datepicker" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });

  $(document).ready(function() {
        var w = window.innerWidth;
        var h = window.innerHeight;
        var total = h - 150;
        var each = total/12;
        $('.navbar_li').height(each);
        $('.navbar_href').height(each/2);
        $('.navbar_href').css('padding-top', each/4.9);
        var currentpage = "";
        $('#'+currentpage).addClass('active');
        $('#plapiper_pagename').html("Employee Details");
        var windowheight = h;
        var available_height = h - 80;
        $('#mainplanlistdiv').height(available_height);
        var sidebarflag = 1;
        $('#topbar-leftmenu').click(function(){
          if(sidebarflag == 1){
              //$('#sidebargrid').hide(150);
              $('#sidebargrid').hide("slow","swing");
              //$('#content_wrapper').addClass("col-sm-12");
              $('#content_wrapper').removeClass("col-sm-10");
              sidebarflag = 0;
          } else {
              $('#sidebargrid').show("slow","swing");
              $('#content_wrapper').addClass("col-sm-10");
              //$('#content_wrapper').removeClass("col-sm-12");
              sidebarflag = 1;
          }
        });
        var merchant = '<?php echo $logged_merchantid;?>';
        <?php include('js/notification.js');?>
  });
</script>
</body>
</html>