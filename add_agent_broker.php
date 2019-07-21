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
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>eTPA - Agent Broker</title>
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
    <style type="text/css">.error{
     color: #ed0716;
     font-size: 15px;
     font-weight: bold;
}</style>
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

<?php

   if($_POST['last_name'] != '' && $_POST['first_name'] != '' && $_POST['mobile_number'] != ''){

      $company_name = escapeString($_POST['company_name']);
      $last_name = escapeString($_POST['last_name']);
      $first_name = escapeString($_POST['first_name']);
      $mobile_number = escapeString($_POST['mobile_number']);
      $email = escapeString($_POST['email']);
      $phone_number = escapeString($_POST['phone_number']);
      $Fax = escapeString($_POST['Fax']);
      $address_1 = escapeString($_POST['address_1']);
      $address_2 = escapeString($_POST['address_2']);
      $country = escapeString($_POST['country']);
      $state = escapeString($_POST['state']);
      $city = escapeString($_POST['city']);
      $postal_code = escapeString($_POST['postal_code']);

      $Commission_Percentage = escapeString($_POST['Commission_Percentage']);

      $query = "INSERT INTO `agent_broker_details` (`Company_Name`,`First_Name`, `Middle_Name`, `Last_Name`, `Mobile`, `Email_Id`, `Phone`, `Fax`, `Address_Line1`, `Address_Line2`, `City`, `State`, `Postal_Code`, `Country`,`Commission_Percentage`, `Created_Date`, `Created_By`) VALUES ('$company_name','$first_name', '', '$last_name', '$mobile_number', '$email', '$phone_number', '$Fax', '$address_1', '$address_2', '$city', '$state', '$postal_code', '$country','$Commission_Percentage',now(),'$logged_userid')";
        if(mysql_query($query)){
          ?>
           <script type="text/javascript">
              bootbox.alert("Agent Broker Added Successfully.");
              $('#basicform')[0].reset();
           </script>
          <?php
        }
     }
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>"  name="basicform" id="basicform" method="post" enctype="multipart/form-data">

  <div class="col-md-6 col-sm-6">

        <div class="form-group">
            <label for="name">Company Name *</label>
            <input type="text" class="form-control input-sm" id="company_name" name="company_name" required>
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
            <label for="gender">Mobile Number</label>
             <span class="help-block">Enter number with area code,Country code not necessary</span>
            <input type="text" class="form-control input-sm numberonly" id="mobile_number" name="mobile_number" placeholder="" required>
        </div>

        <div class="form-group">
            <label for="name">Email ID *</label>
            <input type="email" class="form-control input-sm" id="email" name="email" placeholder="" required>
        </div>

        <div class="form-group">
            <label for="gender">Phone Number</label>
             <span class="help-block">Enter number with area code,Country code not necessary</span>
            <input type="text" class="form-control input-sm numberonly" id="phone_number" name="phone_number" placeholder="">
        </div>

        <div class="form-group">
            <label for="gender">Fax Number</label>
             <span class="help-block">Enter number with area code,Country code not necessary</span>
            <input type="text" class="form-control input-sm numberonly" id="Fax" name="Fax" placeholder="">
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

       <div class="form-group">
          <label for="pincode">Commission Percentage *</label>
          <input type="text" class="form-control input-sm numberonly" id="Commission_Percentage" name="Commission_Percentage" required>
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

  $('.numberonly').bind('keyup paste', function(){
      this.value = this.value.replace(/[^0-9]/g, '');
  });

  jQuery().ready(function() {

    var v = jQuery("#basicform").validate({
        rules: {
          company_name : "required",
          last_name : "required",
          address_1: "required",
          first_name: "required",
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
          Commission_Percentage:"required",
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

  $(document).ready(function() {

        var w = window.innerWidth;
        var h = window.innerHeight;
        var total = h - 150;
        var each = total/12;
        $('.navbar_li').height(each);
        $('.navbar_href').height(each/2);
        $('.navbar_href').css('padding-top', each/4.9);
        var currentpage = "agent";
        $('#'+currentpage).addClass('active');
        $('#plapiper_pagename').html("Agent Management");
        var windowheight = h;
        var available_height = h - 170;
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