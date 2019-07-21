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

function getTotalSequence() {
  $CostId = $_REQUEST['CostId'];
  $sel_id= "SELECT max(plan_sequence_number) AS maxemp from customer_plan where Cust_ID = '$CostId'";
  $sel_exeid=mysql_query($sel_id);
  $empid= mysql_fetch_array($sel_exeid);
  $num = $empid['maxemp'];
  ++$num;
  $len = strlen($num);
  for($i=$len; $i< 2; ++$i) {
  $num = '10'.$num;
  }
  return $num;
}

$sequenceno = getTotalSequence();

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

          <li role="presentation" class="navbartoptabs">
            <a href="customer_edit.php?CostId=<?php echo $_REQUEST['CostId'];?>">Customer Setup</a>
          </li>

          <li role="presentation" class="active navbartoptabs">
            <a href="customer_new.php?CostId=<?php echo $_REQUEST['CostId'];?>">Customer Plan</a>
          </li>

          <!-- <li role="presentation" class="navbartoptabs">
            <a href="#">Plan Risk Coverage</a>
          </li>

          <li role="presentation" class="navbartoptabs">
            <a href="#">Employee Upload</a>
          </li> -->

    </ul>

    <?php

   if($_POST['CostId'] != '' && $_POST['Plan_Sequence_Number'] != '' && $_POST['Plan_Name'] != ''){

      $CostId = escapeString($_POST['CostId']);
      $Plan_Sequence_Number = escapeString($_POST['Plan_Sequence_Number']);
      $Plan_Name = escapeString($_POST['Plan_Name']);
      $Plan_Description = escapeString($_POST['Plan_Description']);
      $Effective_Date = date('Y-m-d',strtotime($_POST['Effective_Date']));
      $End_Date = date('Y-m-d',strtotime($_POST['End_Date']));
      $Annual_Limit_Plan = escapeString($_POST['Annual_Limit_Plan']);
      $Expense_limits_Apply = escapeString($_POST['Expense_limits_Apply']);
      $Preset_Plan = escapeString($_POST['Preset_Plan']);

      //$inclusions = implode(',',$_POST['Inclusions']);

      //$exclusions = implode(',',$_POST['Exclusions']);

      $query = "INSERT INTO `customer_plan` (`Cust_ID`, `plan_sequence_number`, `plan_name`, `plan_description`, `effective_date`, `end_date`, `annual_limit_plan`, `expense_limits_apply`, `present_plan_id`, `custom_plan_id`,`Inclusions`,`Exclusions`,`Created_Date`, `Created_By`) VALUES ('$CostId','$Plan_Sequence_Number', '$Plan_Name', '$Plan_Description', '$Effective_Date', '$End_Date', '$Annual_Limit_Plan', '$Expense_limits_Apply','$Preset_Plan','','','',now(),'$logged_userid')";


         if( $_POST['expense_limit_name'] != 0 && $_POST['Annual_Amount'] != ''){


            for($i = 0 ; $i < count($_POST['expense_limit_name']) ; $i++){

              $expense_limit_name  = mysql_real_escape_string( $_POST['expense_limit_name'][$i]);

              $Annual_Amount  = mysql_real_escape_string( $_POST['Annual_Amount'][$i]);

              $Expense_Limit_Type = mysql_real_escape_string($_POST['Expense_Limit_Type'][$i]);

              $Expense_Limit  = mysql_real_escape_string( $_POST['Expense_Limit'][$i]);

              $date_birth  =  date('Y-m-d',strtotime($_POST['dep_date_birth'][$i]));

              $plan_query = "INSERT INTO `customer_custom_plan` (`Cust_ID`, `plan_sequence_number`, `expense_limit_name`, `annual_amount`, `expense_limit_type`, `expense_limit`, `Created_Date`, `Created_By`) VALUES ('$CostId','$Plan_Sequence_Number', '$expense_limit_name','$Annual_Amount','$Expense_Limit_Type','$Expense_Limit',now(),'$logged_userid')";

               mysql_query($plan_query);

            } 
         }  
 
        if(mysql_query($query)){
           $msg = 'Customer Plan Added Successfully.';
        }
     }
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>?CostId=<?php echo $_REQUEST['CostId'];?>"  name="basicform" id="basicform" method="post" enctype="multipart/form-data">


   <input  value="<?php echo $_REQUEST['CostId'];?>" type="hidden" class="form-control input-sm" name="CostId">

      <div class="col-md-4">
        <div class="form-group">
            <label for="name">Plan Sequence Number</label>
            <input readonly type="text" class="form-control input-sm" id="Plan_Sequence_Number" name="Plan_Sequence_Number" value="<?php echo $sequenceno;?>">
        </div>
      </div>

      <div class="col-md-8">     
          <div class="form-group">
              <label for="name">Plan Name</label>
              <input type="text" class="form-control input-sm" id="Plan_Name" name="Plan_Name">
          </div>
      </div>
          
    <div class="col-md-12">
          <div class="form-group">
              <label for="name">Plan Description</label>
              <input type="text" class="form-control input-sm" id="Plan_Description" name="Plan_Description">
          </div>
     </div>

      <div class="col-md-6">     
          <div class="form-group">
              <label for="name">Effective Date</label>
              <div class='input-group date' id='datetimepicker1'>
                  <input type="text" class="form-control input-sm" id="Effective_Date" name="Effective_Date">
                  <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                  </span>
            </div>
          </div>
      </div>

       <div class="col-md-6">     
          <div class="form-group">
              <label for="name">End Date</label>
              <div class='input-group date' id='datetimepicker1'>
                   <input type="text" class="form-control input-sm" id="End_Date" name="End_Date">
                  <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                  </span>
            </div>
             
          </div>
      </div>

      <div class="col-md-6">     
          <div class="form-group">
              <label for="name">Annual Limit for Plan</label>
              <div class="input-group"> 
                <span class="input-group-addon">₹</span>
                <input type="text" class="form-control input-sm amount" id="Annual_Limit_Plan" name="Annual_Limit_Plan">
              </div>
          </div>
      </div>

      <div class="col-md-6">     
          <div class="form-group">
            <label for="happy">Do Expense-limits Apply for This Plan?</label>
            <br>
            <label class="radio-inline">
            <input type="radio" name="Expense_limits_Apply" value="1">Yes
            </label>
            <label class="radio-inline">
            <input type="radio" name="Expense_limits_Apply" value="0">No
            </label>
          </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-6"> 
        <div class = "form-group">
          <label for="years">Select Present Plan</label>  
          <select class="form-control input-sm" name="Preset_Plan" id="Preset_Plan">
          <option>Select Present Plan</option>
          <option value='1'>Basic Plan</option>
          <option value='2'>Standard Plan</option>
          <option value='3'>Super Plan</option>
          </select>
        </div>
      </div>

      <div class="col-md-1"> 
        <div class="form-group" style="margin-top: 30px;">
          <label for="years">OR</label>
       </div>
      </div>
      

     <div class="col-md-5">
        <div class="form-group">
            <label for="years"></label>  
            <div class="col-md-8" style="margin-top: 16px;">
            <button id="add_custom_plan" class="btn btn-primary" type="button" style="width: 100%;">
            Click here to create a custom plan
            </button> 
            </div>
        </div>
     </div>


    <div id="select_plan" class="col-sm-12 col-md-12" style="margin-top: 10px; display: none;">

        <div class="form-group col-sm-12 col-md-12">
            <label for="address" class="col-sm-6 col-md-6 control-label text-left">Health Check-Up Cost</label>
            <div class="col-sm-4 col-md-4"> 
            <div class="input-group"> 
            <span class="input-group-addon">₹</span>
            <input type="text" class="form-control input-sm amount" id="Health_CheckUp_Cost" name="Health_CheckUp_Cost" readonly>
            </div>
            </div>
        </div>

        <div class="form-group col-sm-12 col-md-12">
          <label for="address" class="col-sm-6 col-md-6 control-label text-left">Pre Hospitalization Expenses</label>
          <div class="col-sm-4 col-md-4"> 
          <div class="input-group"> 
          <span class="input-group-addon">₹</span>
          <input type="text" class="form-control input-sm amount" id="Pre_Hospitalization_Expenses" name="Pre_Hospitalization_Expenses" readonly>
          </div>
          </div>
        </div>


        <div class="form-group col-sm-12 col-md-12">
            <label for="address" class="col-sm-6 col-md-6 control-label text-left">Ambulance Charges</label>
            <div class="col-sm-4 col-md-4">
            <div class="input-group"> 
            <span class="input-group-addon">₹</span>
            <input type="text" class="form-control input-sm amount" id="Ambulance_Charges" name="Ambulance_Charges" readonly>
            </div>
            </div>
        </div>

         
         <div class="form-group col-sm-12 col-md-12">
            <label for="address" class="col-sm-6 col-md-6 control-label text-left">Hospitalization Accommodation ( including all room services and telephone charges)</label>
            <div class="col-sm-4 col-md-4">
            <div class="input-group"> 
            <span class="input-group-addon">₹</span>
            <input type="text" class="form-control input-sm amount" id="Hospitalization_Accnmmodation" name="Hospitalization_Accnmmodation" readonly>
            </div>
            </div>
         </div>


        <div class="form-group col-sm-12 col-md-12">
          <label for="address" class="col-sm-6 col-md-6 control-label text-left">Consultant's Fee</label>
          <div class="col-sm-4 col-md-4">
          <div class="input-group"> 
          <span class="input-group-addon">₹</span>
          <input type="text" class="form-control input-sm amount" id="Consuitant" name="Consuitant" readonly>
          </div> 
          </div>
        </div>

      <div class="form-group col-sm-12 col-md-12">
          <label for="address" class="col-sm-6 col-md-6 control-label text-left">Routine Investigations</label>
          <div class="col-sm-4 col-md-4"> 
          <div class="input-group"> 
          <span class="input-group-addon">₹</span>
          <input type="text" class="form-control input-sm amount" id="Routine_Investigations" name="Routine_Investigations" readonly>
          </div> 
          </div>
      </div>

      <div class="form-group col-sm-12 col-md-12">
        <label for="address" class="col-sm-6 col-md-6 control-label text-left">Medicine & Drugs Prescribed by The Consultant</label>
        <div class="col-sm-4 col-md-4">
        <div class="input-group"> 
        <span class="input-group-addon">₹</span>
        <input type="text" class="form-control input-sm amount" id="Medicicne_Drugs" name="Medicicne_Drugs" readonly>
        </div>
        </div>
      </div>

      <div class="form-group col-sm-12 col-md-12">
        <label for="address" class="col-sm-6 col-md-6 control-label text-left">Major Surgical Operation</label>
        <div class="col-sm-4 col-md-4">
          <div class="input-group"> 
          <span class="input-group-addon">₹</span>
          <input type="text" class="form-control input-sm amount" id="Major_Surgical" name="Major_Surgical" readonly>
          </div>
          </div>
      </div>

      <div class="form-group col-sm-12 col-md-12">
        <label for="address" class="col-sm-6 col-md-6 control-label text-left">Intermediate Surgical Operation</label>
        <div class="col-sm-4 col-md-4"> 
          <div class="input-group"> 
          <span class="input-group-addon">₹</span>
          <input type="text" class="form-control input-sm amount" id="Intermediate_Surgical" name="Intermediate_Surgical" readonly>
          </div>
          </div>
      </div>

      <div class="form-group col-sm-12 col-md-12">
        <label for="address" class="col-sm-6 col-md-6 control-label text-left">Ancillary Services</label>
          <div class="col-sm-4 col-md-4">
          <div class="input-group"> 
          <span class="input-group-addon">₹</span>
          <input type="text" class="form-control input-sm amount" id="Ancillary_Services" name="Ancillary_Services" readonly>
          </div>
          </div>
      </div>

      <div class="form-group col-sm-12 col-md-12">
        <label for="address" class="col-sm-6 col-md-6 control-label text-left">Post Hospitalization Expenses</label>
        <div class="col-sm-4 col-md-4">
          <div class="input-group"> 
          <span class="input-group-addon">₹</span>
          <input type="text" class="form-control input-sm amount" id="Post_Hospitalization_Expenses" name="Post_Hospitalization_Expenses" readonly>
          </div>
        </div>
      </div>

    </div>


  <div id="custome_plan" style="display:none;">

      <div class="field_wrapper">

        <div class="col-md-12 col-sm-12">

            <div class="form-group col-md-3 col-sm-3">
                <label for="name">Expense Limits for This Plan</label>
                <select class="form-control input-sm" name="expense_limit_name[]">
                <option value="0">Select Expense Limit</option> 
                <option value="Health Check-Up Cost">Health Check-Up Cost</option>
                <option value="Pre Hospitalization Expenses">Pre Hospitalization Expenses</option>
                <option value="Ambulance Charges">Ambulance Charges</option>
                </select>
            </div>

            <div class="form-group col-md-3 col-sm-3">
                <label for="gender">Annual Amount</label>
                 <div class="input-group"> 
                   <span class="input-group-addon">₹</span>
                   <input type="text" class="form-control input-sm amount" name="Annual_Amount[]" placeholder="">
                </div>
            </div>

            <div class="form-group col-md-3 col-sm-3">
                <label for="age">Expense Limit Type</label>
                <select class="form-control input-sm" name="Expense_Limit_Type[]">
                <option value="0">Select Expense Limit Type</option>  
                <option value="Daily">Daily</option>
                <option value="Per Claim">Per Claim</option>
                <option value="Annual">Annual</option>
                <option value="Lifetime">Lifetime</option>
                </select>
            </div>

            <div class="form-group col-md-3 col-sm-3">
                <label for="DOB">Expense Limit</label>
                <div class="input-group"> 
                   <span class="input-group-addon">₹</span>
                  <input type="text" class="form-control input-sm amount" name="Expense_Limit[]" placeholder="">
                </div>
            </div>

        </div>

    </div>

        <div class="col-md-12 col-sm-12">
          <div class="form-group col-md-3 col-md-offset-9">
            <input type='button' class="btn btn-primary" value="Add More Expense Limits" id="add" style="width:100%;" />
          </div>
        </div>

    </div>

<!-- 
    <div class="form-group col-md-12 col-sm-12">
     <label for="DOB">Inclusions & Exclusions</label>
    </div>

     <div class="col-md-12 col-sm-12 form-group">
        <label>Crtical-care and Special Benefits Included</label>
        <select id="optgroup" name="Inclusions[]" class="form-control form-control-chosen1" data-placeholder="Select Benefits to be Included from drop-down list" multiple>
            <option value="1">Maternity Benefits</option>
            <option value="2">Pre-existing Diseases</option>
        </select>
      </div>


      <div class="col-md-12 col-sm-12 form-group">
        <label>Exclusions</label>
        <select id="optgroup" name="Exclusions[]" class="form-control form-control-chosen2" data-placeholder="Select Exclusions from drop-down list" multiple>
            <option value="1">First Heart attack of specified severity</option>
            <option value="2">Open chest Coronary artery bypass grafting</option>
            <option value="3">Open Heart replacement or repair of Heart valves</option>
            <option value="4">Coma of specified severity</option>
        </select>
      </div> -->


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
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.6/chosen.jquery.min.js"></script>

   <?php if($msg != '') {?> 
      <script type="text/javascript">
            var costid = "<?php echo $CostId; ?>";
            var sequence = "<?php echo $Plan_Sequence_Number;?>";
            bootbox.alert({
            message: "<?php echo $msg;?>",
            callback: function(){ 
             window.location.href = 'inclusions_exclusions.php?CostId='+costid+'&seqno='+sequence;
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


  $('input.amount').keyup(function(event) {
    if(event.which >= 37 && event.which <= 40) return;
    $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      ;
    });
  });


  $('body').on('keyup',"input.amount",function(event) {
    if(event.which >= 37 && event.which <= 40) return;
    $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      ;
    });
  });

    var wrapper = $('.field_wrapper');
    var x = 1;
    $('#add').click(function () { 

            x++;
            var fieldHTML = '<div class="col-md-12 col-sm-12"><div class="form-group col-md-3 col-sm-3"><label for="name">Expense Limits for This Plan</label><select class="form-control input-sm" name="expense_limit_name[]"><option value="0">Select Expense Limit</option><option value="Health Check-Up Cost">Health Check-Up Cost</option><option value="Pre Hospitalization Expenses">Pre Hospitalization Expenses</option><option value="Ambulance Charges">Ambulance Charges</option></select></div><div class="form-group col-md-3 col-sm-3"><label for="gender">Annual Amount</label><div class="input-group"> <span class="input-group-addon">₹</span> <input type="text" class="form-control input-sm amount" name="Annual_Amount[]" placeholder=""></div></div><div class="form-group col-md-3 col-sm-3"><label for="age">Expense Limit Type</label><select class="form-control input-sm" name="Expense_Limit_Type[]"><option value="0">Select Expense Limit Type</option><option value="Daily">Daily</option><option value="Per Claim">Per Claim</option><option value="Annual">Annual</option><option value="Lifetime">Lifetime</option></select></div><div class="form-group col-md-3 col-sm-3"><label for="DOB">Expense Limit</label><div class="input-group"> <span class="input-group-addon">₹</span><input type="text" class="form-control input-sm amount" name="Expense_Limit[]" placeholder=""></div></div></div>';

            $(wrapper).append(fieldHTML); 
    });

    $(wrapper).on('click', '.remove_field', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });

    $("#add_custom_plan").on('click', function(e){
       $("#Preset_Plan").val("");
       $('#select_plan').hide();
       $('#custome_plan').show();
    });

    $("#Preset_Plan").on('change', function(e){

        $('#select_plan').show();

        $('#custome_plan').hide();
        
        var PlanValue = $(this).val();

        var dataString = "PlanValue="+PlanValue;

    $.ajax({
          type: 'POST',
          url: 'ajax/add_master_plan_value.php',
          data    : dataString,
          datatype: 'json',
          cache: false,
          success: function (data) {
              var data1 = $.parseJSON(data);
                 if(data1.status == 'ok'){

                        $('#Health_CheckUp_Cost').val(data1.result.Health_CheckUp_Cost);

                        $('#Pre_Hospitalization_Expenses').val(data1.result.Pre_Hospitalization_Expenses);

                        $('#Ambulance_Charges').val(data1.result.Ambulance_Charges);

                        $('#Hospitalization_Accnmmodation').val(data1.result.Hospitalization_Accnmmodation);

                        $('#Consuitant').val(data1.result.Consuitant);

                        $('#Routine_Investigations').val(data1.result.Routine_Investigations);

                        $('#Medicicne_Drugs').val(data1.result.Medicicne_Drugs);

                        $('#Major_Surgical').val(data1.result.Major_Surgical);

                        $('#Intermediate_Surgical').val(data1.result.Intermediate_Surgical);

                        $('#Ancillary_Services').val(data1.result.Ancillary_Services);

                        $('#Post_Hospitalization_Expenses').val(data1.result.Post_Hospitalization_Expenses);

                  }else{
                      bootbox.alert({
                         message: "Something wrong contact us.",
                         size: 'small'
                      });
                  } 
             }
         });
    });

  $('.numberonly').bind('keyup paste', function(){
      this.value = this.value.replace(/[^0-9]/g, '');
  });

  jQuery().ready(function() {

    var v = jQuery("#basicform").validate({
        rules: {
          Plan_Name : "required",
          Plan_Description : "required",
          Effective_Date: "required",
          End_Date: "required",
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


    $(function() {
        $( "#Effective_Date" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+10'
        });
    });

   $(function() {
        $( "#End_Date" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+10'
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