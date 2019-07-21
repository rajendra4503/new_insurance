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

function getTotalEmployees() {
  $sel_id= "SELECT max(Cust_ID) AS maxemp from customer_setup_details";
  $sel_exeid=mysql_query($sel_id);
  $empid= mysql_fetch_array($sel_exeid);
  $num = $empid['maxemp'];
  ++$num;
  $len = strlen($num);
  for($i=$len; $i< 2; ++$i) {
  $num = '100'.$num;
  }
  return $num;
}

function random_strings($length_of_string) 
{ 
  $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  return substr(str_shuffle($str_result),0, $length_of_string); 
} 


$msg = '';

if($_POST['company_name'] != '' && $_POST['agent_name'] != '' && $_POST['officer_name'] != ''){

$agent_name   = escapeString($_POST['agent_name']);
$officer_name = escapeString($_POST['officer_name']);
$company_name = escapeString($_POST['company_name']);
$address_1 = escapeString($_POST['address_1']);
$address_2 = escapeString($_POST['address_2']);
$city = escapeString($_POST['city']);
$state = escapeString($_POST['state']);
$postal_code = escapeString($_POST['postal_code']);
$country = escapeString($_POST['country']);
$date_format = escapeString($_POST['date_format']);
$currency = escapeString($_POST['currency']);
$proposer_industry_type = escapeString($_POST['proposer_industry_type']);
$customer_type = escapeString($_POST['customer_type']);
$paid_up_capital = escapeString($_POST['paid_up_capital']);
$last_name = escapeString($_POST['last_name']);
$first_name = escapeString($_POST['first_name']);
$mobile_number = escapeString($_POST['mobile_number']);
$email = escapeString($_POST['email']);
$phone_number = escapeString($_POST['phone_number']);
$Fax = escapeString($_POST['Fax']);
$business_constiution = escapeString($_POST['business_constiution']);
$pan = escapeString($_POST['pan']);
$gstin = escapeString($_POST['gstin']);


    $newempno_id = random_strings(5);

    $Cust_ID = $newempno_id;

    $query = "INSERT INTO `customer_setup_details` (`Cust_ID`,`AgentName_BrokerName`, `Marketing_OfficerName`, `Company_Name`, `Address_Line1`, `Address_Line2`, `City`, `State`, `PostalCode`, `First_Name`, `Last_Name`, `Mobile`, `Email_Id`, `Country`, `Phone`, `Extension`, `Fax`, `Date_Format`, `Currency`, `Proposed_Industrytype`, `Business_Constitution`, `Customer_Type`, `PAN`, `GSTIN`, `Paidup_Capital`,`Created_Date`, `Created_By`,`Effective_Date`) VALUES ('$Cust_ID','$agent_name', '$officer_name', '$company_name', '$address_1', '$address_2', '$city', '$state', '$postal_code', '$first_name', '$last_name', '$mobile_number', '$email', '$country', '$phone_number', '', '$Fax', '$date_format', '$currency', '$proposer_industry_type', '$business_constiution','$customer_type', '$pan', '$gstin', '$paid_up_capital',now(), '$logged_userid',now())";


        if(mysql_query($query)){

          $userid = $Cust_ID;

          $insert_user_access = "insert into USER_ACCESS (UserID, MobileNo, EmailID, PlanpiperEmailID, Password, PasswordStatus, UserStatus, CreatedDate,CreatedBy) values ('$userid','$mobile_number','$email','$email','insurance','1','A',now(),'$logged_userid')";

          $insert_user_access_run = mysql_query($insert_user_access);


         $insert_user_details = "insert into USER_DETAILS (UserID, FirstName, LastName, CountryCode, StateID, CityID, AddressLine1,AddressLine2, PinCode, AreaCode, Landline,AdStartDate,AdEndDate,CreatedDate,CreatedBy) values ('$userid', '$first_name', '$last_name' , '00091', '1339', '547', '$address_1', '$address_2', '','', '','0000-00-00','0000-00-00', now(),'$logged_userid')";

          $insert_user_details_run = mysql_query($insert_user_details);

          $insert_individual_mapping = "insert into USER_MERCHANT_MAPPING (MerchantID, UserID, RoleID, Status,Type, CreatedDate) values ('$userid','$userid','4','A','I',now())";


          $insert_individual_mapping_run = mysql_query($insert_individual_mapping);

          $insert_individual_details = "insert into MERCHANT_DETAILS (MerchantID, CompanyCountryCode, CompanyStateID, CompanyCityID, CreatedDate) values ('$userid', '00091', '1339', '547',now())";

          $insert_individual_details_run = mysql_query($insert_individual_details);

          $msg = "Customer Added Successfully";

        }
     }
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>eTPA - Customer Users</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/planpiper.css">
    <link rel="stylesheet" type="text/css" href="fonts/font.css">
    <link rel="shortcut icon" href="images/planpipe_logo.png"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <style type="text/css">
      input.amount{
        text-align: right;
        padding-right: 15px;
      }
      #ui-datepicker-div{
           z-index: 9999;
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

        <li role="presentation" class="active navbartoptabs">
          <a href="customer.php">Customer Setup</a>
        </li>

        <li disabled role="presentation" class="navbartoptabs">
          <a href="#">Customer Plan</a>
        </li>

        <!-- <li role="presentation" class="navbartoptabs">
          <a href="#">Plan Risk Coverage</a>
        </li>

        <li role="presentation" class="navbartoptabs">
          <a href="#">Employee Upload</a>
        </li> -->

    </ul>


<form action="<?php echo $_SERVER['PHP_SELF'];?>"  name="basicform" id="basicform" method="post" enctype="multipart/form-data">

<div id="sf1" class="frm">

<fieldset>

<div id="menu1"><br>

	<div class="form-group col-md-6 col-sm-6">
      <label for="name">Agent / Broker Name</label>
      <select class="form-control input-sm" id="agent_name" name="agent_name" required>
      <option value=''>Select Agent / Broker Name</option>
      <?php 
      $query = "SELECT * FROM agent_broker_details";
      $results = mysql_query($query);
      while($row = mysql_fetch_assoc($results)){ ?>
      <option value="<?php echo $row['Agent_ID']; ?>"><?php echo $row['First_Name'].' '.$row['Last_Name']; ?></option>
      <?php  } ?>
      </select>
    </div>

    <div class="form-group col-md-6 col-sm-6">
      <label for="email">Marketing Officer Name</label>
      <select class="form-control input-sm" id="officer_name" name="officer_name" required>
      <option value=''>Select Marketing Officer Name</option>
      <?php 
      $query = "SELECT * FROM marketing_officer_details";
      $results = mysql_query($query);
      while($row = mysql_fetch_assoc($results)){ ?>
      <option value="<?php echo $row['Officer_ID']; ?>"><?php echo $row['First_Name'].' '.$row['Last_Name']; ?></option>
      <?php  } ?>
      </select>
   </div>

<div class="col-md-12 col-sm-12"></div>
  <div class="col-md-6 col-sm-6">

      <div class="form-group">
          <label for="name">Company Name * </label>
          <input type="text" class="form-control input-sm" id="company_name" name="company_name" required>
      </div>

       <div class="form-group">
         <label for="address">Address Line 1</label>
         <input type="text" class="form-control input-sm" name="address_1" id="address_1" required>
       </div>

       <div class="form-group">
         <label for="address">Address Line 2</label>
         <input type="text" class="form-control input-sm" name="address_2"  id="address_2" required>
       </div>

       <div class="form-group">
          <label for="city">City *</label>
          <input type="text" class="form-control input-sm" id="city" name="city" placeholder="" required>
       </div>

      <div class="form-group">
          <label for="state">State *</label>
          <input type="text" class="form-control input-sm" id="state" name="state" placeholder="" required>
      </div>

      <div class="form-group">
          <label for="pincode">Postal Code *</label>
          <input type="text" class="form-control input-sm numberonly" id="postal_code" name="postal_code" placeholder="" required>
      </div>

      <div class="form-group">
          <label for="country">Country *</label>
          <input type="text" class="form-control input-sm" id="country" name="country" placeholder="" required>
      </div>

      <div class = "form-group">
          <label for="years">Date Format</label>  
          <select class="form-control input-sm" name="date_format" id="date_format">
          <option value=''>Select Date Format</option>
          <option value="dd/mm/ccyy">dd/mm/ccyy</option>
          <option value="mm/dd/ccyy">mm/dd/ccyy</option>
          <option value="ccyy/mm/dd">ccyy/mm/dd</option>
          </select>
      </div>

      <div class = "form-group">
          <label for="years">Currency</label>  
          <select class="form-control input-sm" name="currency" id="currency" required>
          <option value=''>Select Currency</option>
          <!--   <option value="৳">৳</option> -->
          <option value="₹">₹</option>
          <!--  <option value="$">$</option> -->
          </select>
      </div>

      <div class = "form-group">
          <label for="years">Proposer Industry Type *</label>  
          <select class="form-control input-sm" name="proposer_industry_type" id="proposer_industry_type" required>
          <option value=''>Select Industry Type</option>
          <option value="Partnership">Partnership</option>
          <option value="Company">Company</option>
          <option value="Government">Government</option>
          <option value="Others">Others</option>
          </select>
      </div>

      <div class = "form-group">
          <label for="years">Customer Type *</label>  
          <select class="form-control input-sm" name="customer_type" id="customer_type" required>
          <option value=''>Select Customer Type</option>
          <option value="General">General</option>
          <option value="EOU/STP/EHTP">EOU/STP/EHTP</option>
          <option value="Government">Government</option>
          <option value="Overseas Related Parties">Overseas Related Parties</option>
          <option value="SEZ">SEZ</option>
          <option value="Others">Others</option>
          </select>
      </div>

      <div class = "form-group">
          <label for="years">Paid-up Capital *</label>
          <div class="input-group"> 
          <span class="input-group-addon">₹</span>
          <input type="text" class="form-control input-sm amount" name="paid_up_capital" id="paid_up_capital" placeholder="In Million" required>
          </div> 
      </div>

  </div>

  <div class="col-md-6 col-sm-6">

        <div class="form-group">
            <label for="name">Contact Person at this location</label>
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
            <input type="text" class="form-control input-sm numberonly" id="mobile_number" name="mobile_number" placeholder="">
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
            <input type="text" class="form-control input-sm" id="Fax" name="Fax" placeholder="">
        </div>

        <div class = "form-group">
          <label for="years">Business Constitution *</label>  
          <select class="form-control input-sm" name="business_constiution" id="business_constiution" required>
          <option disabled="disabled">-- Select --</option>
          <option value="Non Resident Entity">Non Resident Entity</option>
          <option value="Foreign Registered Company">Foreign Registered Company</option>
          <option value="Foreign LLP">Foreign LLP</option>
          <option value="Government">Government</option>
          <option value="Department">Department</option>
          <option value="LLP Partnership">LLP Partnership</option>
          <option value="Local Authorities">Local Authorities</option>
          <option value="Partnership">Partnership</option>
          <option value="Private Limited Company">Private Limited Company</option>
          <option value="Proprietorship">Proprietorship</option>
          <option value="Public Ltd Co">Public Ltd Co</option>
          <option value="Others">Others</option>
          </select>
      </div>

      <div class = "form-group">
        <label for="years">PAN *</label>  
        <input type="text" maxlength="10" class="form-control input-sm" id="pan" name="pan" placeholder="" required>
      </div>

      <div class = "form-group">
          <label for="years">GSTIN *</label>
          <input maxlength="15" type="text" class="form-control input-sm" id="gstin" name="gstin" placeholder="Enter exactly 15 characters text" required>
      </div>

</div>

	  <div class="form-group">
    		<div class="col-lg-10 col-lg-offset-5">
    		<button class="btn btn-primary open3" type="button">Next<span class="fa fa-arrow-right"></span></button> 
    		</div>
	  </div>

</div>
</fieldset>
</div>
	</div>
	</form> 
	</div>
	</section>
 </div>
</div>	
</div>
</div><!-- big_wrapper ends -->   
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
 <?php if($msg != '') {?> 
  <script type="text/javascript">
        var costid = "<?php echo $userid; ?>";
        bootbox.alert({
        message: "<?php echo $msg;?>",
        callback: function(){ 
         window.location.href = 'customer_new.php?CostId='+costid;
        }
        });
  </script>
  <?php } ?>
<script type="text/javascript">

  $('input.amount').keyup(function(event) {
    if(event.which >= 37 && event.which <= 40) return;
    $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      ;
    });
  });

  $(".Plan_Selected").on('change', function(e){ 
    var PlanValue = $("input[name='plan']:checked").val();
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

$("#period_insurance").keypress(function(event) {event.preventDefault();});
$("#to_midnight").keypress(function(event) {event.preventDefault();});
  $(function() {
        $( "#period_insurance" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });

        $( "#to_midnight" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+15',
            // maxDate: '-1d'
        });
    });

  jQuery().ready(function() {

    var v = jQuery("#basicform").validate({

      	rules: {
					agent_name: "required",
					officer_name : "required",
					company_name : "required",
					last_name : "required",
					address_1: "required",
					first_name: "required",
					address_2:"required",
          mobile_number:{digits: true},
					city:"required",
					state:"required",
					postal_code:{required: true,digits: true},
					country : "required",
          currency : "required",
					business_constiution : "required",
					pan:{required: true,maxlength:10,minlength:10},
					proposer_industry_type:"required",
					gstin: {required: true,maxlength:15,minlength:15},
					customer_type:"required",
          room_rent:{digits: true},
          icu_rent:{digits: true},
          cataract_claims:{digits: true}
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


        $(".open3").click(function() {
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
        $('#plapiper_pagename').html("Corporate Customer Setup");
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