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
       $seqno = $_REQUEST['seqno'];
       $query = "SELECT c.Company_Name,c.Cust_ID,cp.plan_name,cp.plan_sequence_number FROM  customer_setup_details AS c JOIN customer_plan AS cp ON c.Cust_ID = cp.Cust_ID WHERE cp.Cust_ID = '$CostId' AND cp.plan_sequence_number = $seqno ";
       $sel_exeid=mysql_query($query);
       $customer = mysql_fetch_array( $sel_exeid);
   }
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Plan Sequence Number</title>
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
    <link href="css/component-chosen.css" rel="stylesheet">
    <style type="text/css">
        .error{color: #ed0716;font-size: 15px;font-weight: bold;}
        input.amount{
        text-align: right;
        padding-right: 15px;
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
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="mainplanlistdiv" style="height: 680px; margin-top: 10px;">
      <ul class="nav nav-pills nav-justified">
          <!-- <li role="presentation" class="navbartoptabs">
            <a href="customer_edit.php?CostId=<?php echo $_REQUEST['CostId'];?>">Customer Setup</a>
          </li>

          <li role="presentation" class="active navbartoptabs">
            <a href="customer_new.php?CostId=<?php echo $_REQUEST['CostId'];?>">Customer Plan</a>
          </li> -->

          <li role="presentation" class="active navbartoptabs">
            <a href="inclusions_exclusions_edit.php?CostId=<?php echo $_REQUEST['CostId'];?>&seqno=<?php echo $_REQUEST['seqno'];?>">Plan Risk Coverage</a>
          </li>
<!-- 
          <li role="presentation" class="navbartoptabs">
            <a href="customer_addemployee.php?CostId=<?php echo $_REQUEST['CostId'];?>&seqno=<?php echo $_REQUEST['seqno'];?>">Employee Upload</a>
          </li> -->
      </ul>

      <?php

      if($_POST['Cost_Code'] != '' && $_POST['seq_no'] != ''){
          $CostId = escapeString($_POST['Cost_Code']);
          $seq_no = escapeString($_POST['seq_no']);
          $inclusions = implode(',',$_POST['Inclusions']);
          $exclusions = implode(',',$_POST['Exclusions']);
          $query = "UPDATE `customer_plan` SET `Inclusions` = '$inclusions', `Exclusions` = '$exclusions' WHERE `Cust_ID` = '$CostId' AND plan_sequence_number = $seq_no"; 
          if(mysql_query($query)){
             $msg = 'Inclusions & Exclusions Updated Successfully.';
          }
     }

     if($_GET['CostId'] != '' && $_GET['seqno'] != ''){
          $CostId =$_GET['CostId'];
          $seq_no = $_GET['seqno'];
          $query = mysql_query("SELECT Inclusions,Exclusions FROM `customer_plan` WHERE `Cust_ID` = '$CostId' AND plan_sequence_number = $seq_no"); 
          $allresult = mysql_fetch_array($query);
          $Inclusions =  explode(',',$allresult['Inclusions']);
          $Exclusions =  explode(',',$allresult['Exclusions']);
     }
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>?CostId=<?php echo $_REQUEST['CostId'];?>&seqno=<?php echo $seqno;?>"  name="basicform" id="basicform" method="post" enctype="multipart/form-data">

      <div class="col-md-6">
            <div class="form-group">
                <label for="name">Customer Name</label>
                <input type="text" class="form-control input-sm" value="<?php echo $customer['Company_Name'];?>" readonly>
            </div>
       </div>

      <div class="col-md-6">
        <div class="form-group">
            <label for="name">Customer Code</label>
            <input type="text" class="form-control input-sm" name="Cost_Code" value="<?php echo $_REQUEST['CostId'];?>" readonly>
        </div>
      </div>

       <div class="col-md-6">
          <div class="form-group">
              <label for="name">Plan Sequence Number</label>
              <input type="text" class="form-control input-sm" name="seq_no" value="<?php echo $customer['plan_sequence_number'];?>" readonly>
          </div>
       </div>

        <div class="col-md-6">     
          <div class="form-group">
              <label for="name">Plan Name</label>
              <input type="text" class="form-control input-sm" value="<?php echo $customer['plan_name'];?>" readonly>
          </div>
       </div>

       <div class="clearfix"></div>

       <div class="form-group col-md-12 col-sm-12">
          <label for="DOB">Inclusions & Exclusions</label>
       </div>

      <div class="col-md-12 col-sm-12 form-group">
        <label>Critical-care and Special Benefits Included</label>
        <select id="optgroup" name="Inclusions[]" id="Inclusions" class="form-control form-control-chosen1" data-placeholder="Select Benefits to be Included from drop-down list" multiple>
              <?php
                  $query_inclusion = mysql_query("SELECT * FROM `inclusion_master`");
                  while($inclusion = mysql_fetch_array($query_inclusion)) { 
                  $inclusion_id = $inclusion['ID'];
                  $inclusion_name = $inclusion['Inclusions'];
                  if(in_array($inclusion_id,$Inclusions)){
                  ?>
                  <option selected value="<?php echo $inclusion_id;?>"><?php echo $inclusion_name;?></option>
                  <?php } else{ ?>
                  <option value="<?php echo $inclusion_id;?>"><?php echo $inclusion_name;?></option>
              <?php } } ?>
        </select>
      </div>

      <div class="col-md-12 col-sm-12 form-group">
        <label>Exclusions</label>
        <select id="optgroup" name="Exclusions[]" id="Exclusions" class="form-control form-control-chosen2" data-placeholder="Select Exclusions from drop-down list" multiple>
        <?php
              $query_inclusion = mysql_query("SELECT *  FROM `exclusion_master`");
              while($exclusion = mysql_fetch_array($query_inclusion)) {
              $Exclusion_id = $exclusion['ID'];
              $Exclusion_name = $exclusion['Exclusion'];
              if(in_array($Exclusion_id,$Exclusions)){ ?>
              <option selected value="<?php echo $Exclusion_id;?>"><?php echo $Exclusion_name;?></option>
              <?php } else{ ?>
                <option value="<?php echo $Exclusion_id;?>"><?php echo $Exclusion_name;?></option>
              <?php } } ?>
        </select>
      </div>

      <div class="form-group">
          <div class="col-lg-10 col-lg-offset-6">
          <button class="btn btn-primary open1" type="button">Submit</button> 
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
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.6/chosen.jquery.min.js"></script>

       <?php if($msg != '') {?> 
          <script type="text/javascript">
                var costid = "<?php echo $CostId; ?>";
                var sequence = "<?php echo $seqno;?>";
                bootbox.alert({
                message: "<?php echo $msg;?>",
                callback: function(){ 
                 window.location.href = 'customer_new.php?CostId='+costid;
                }
                });
          </script>
       <?php } ?>

    <script type="text/javascript">

      $('.form-control-chosen1').chosen({
        allow_single_deselect: true,
        width: '100%',
        disable_search_threshold: 100,
      });

      $('.form-control-chosen2').chosen({
        allow_single_deselect: true,
        width: '100%',
        disable_search_threshold: 100,
      });

   jQuery().ready(function() {

    var v = jQuery("#basicform").validate({
        rules: {
          Inclusions : "required",
          Exclusions : "required",
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
        var currentpage = "customer";
        $('#'+currentpage).addClass('active');
        $('#plapiper_pagename').html("Plan for Customer");
        var windowheight = h;
        var available_height = h - 100;
        $('#mainplanlistdiv').height(available_height);
        var sidebarflag = 1;
        $('#topbar-leftmenu').click(function(){
          if(sidebarflag == 1){
              $('#sidebargrid').hide("slow","swing");
              $('#content_wrapper').removeClass("col-sm-10");
              sidebarflag = 0;
          } else {
              $('#sidebargrid').show("slow","swing");
              $('#content_wrapper').addClass("col-sm-10");
              sidebarflag = 1;
          }
        });
        var merchant = '<?php echo $logged_merchantid;?>';
        <?php include('js/notification.js');?>
  });
</script>
</body>
</html>