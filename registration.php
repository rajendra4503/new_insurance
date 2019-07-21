<?php
session_start();
ini_set("display_errors","0");
include_once('include/configinc.php');
date_default_timezone_set("Asia/Kolkata");
include ('SMTP/PHPMailerAutoload.php');
include ('SMTP/class.phpmailer.php');
include ('SMTP/class.smtp.php');

$remember_me = (empty($_COOKIE['remember_me'])) ? '' : $_COOKIE['remember_me'];

//GET COUNTRIES
$get_countries = mysql_query("select CountryCode, CountryName, CurrencyCode, Timezone from COUNTRY_DETAILS where Timezone!=''");

$country_count = mysql_num_rows($get_countries);
$country_options = "";
if($country_count > 0){
	while ($countries = mysql_fetch_array($get_countries)) {
		$country_code = $countries['Timezone'];
		$country_name = $countries['CountryName'];
		$currency_code = $countries['CurrencyCode'];
		$country_options .= "<option value='$country_code'>$country_name</option>";
	}
	
}
	if((isset($_REQUEST['mobilenumber'])) && (!empty($_REQUEST['mobilenumber']))){

	//echo "<pre>"; print_r($_REQUEST);exit;
	$user_type 				= mysql_real_escape_string(trim(htmlspecialchars($_REQUEST['user_type'])));
	$mobilenumber 			= ltrim(mysql_real_escape_string(trim(htmlspecialchars($_REQUEST['mobilenumber']))),'0');
	$email 					= mysql_real_escape_string(trim(htmlspecialchars($_REQUEST['email'])));
	$password1 				= mysql_real_escape_string(trim(htmlspecialchars($_REQUEST['password1'])));
	$firstname 				= mysql_real_escape_string(trim(htmlspecialchars(ucfirst($_REQUEST['firstname']))));
	
	$lastname 				= mysql_real_escape_string(trim(htmlspecialchars(ucfirst($_REQUEST['lastname']))));
	$name 					= $firstname." ".$lastname;


	$country 				= mysql_real_escape_string(trim(htmlspecialchars($_REQUEST['country'])));
	$state 					= mysql_real_escape_string(trim(htmlspecialchars($_REQUEST['state'])));
	$city 					= mysql_real_escape_string(trim(htmlspecialchars($_REQUEST['city'])));
	$addressline1 			= mysql_real_escape_string(trim(htmlspecialchars($_REQUEST['addressline1'])));
	$addressline2 			= mysql_real_escape_string(trim(htmlspecialchars($_REQUEST['addressline2'])));
	$pincode 				= mysql_real_escape_string(trim(htmlspecialchars($_REQUEST['pincode'])));
	$countrycodelandline 	= mysql_real_escape_string(trim(htmlspecialchars($_REQUEST['countrycodelandline'])));
	$areacode 				= mysql_real_escape_string(trim(htmlspecialchars($_REQUEST['areacode'])));
	$areacode 				= ltrim($areacode, '0');
	$landline 				= ltrim(mysql_real_escape_string(trim(htmlspecialchars($_REQUEST['landline']))),'0');	
	//GENERATE 15 DIGIT RANDOM NUMBER
	$i = 0;
	$tmp = mt_rand(1,9);
	do {
	    $tmp .= mt_rand(0, 9);
	} while(++$i < 14);
	//echo $tmp;

	$get_countrycode_query	= mysql_query("select substr(CountryID,1,2) from COUNTRY_DETAILS where CountryCode='$country' and Timezone!=''");

	$country_code 	= mysql_result($get_countrycode_query, 0);

	$planpiper_email = $country_code.$mobilenumber."@insurance.com";

	$_SESSION['country_code'] = $country_code;

	$_SESSION['mobile_number'] = $mobilenumber;

	$_SESSION['name'] = $name;

	$_SESSION['redirection'] = "V";

	$userid = $country.$tmp;

	$_SESSION['registered_userid']  = $userid;

	$_SESSION['registered_useremail']  	= $email;

	$_SESSION['registered_username']  = $name;

	$_SESSION['registered_usertmp']  = $tmp;

	$_SESSION['registered_usercountry'] = $country;

	$_SESSION['registered_userstate']  = $state;

	$_SESSION['registered_usercity']  = $city;

	$mobilenumber = $country.$mobilenumber;

	$insert_user_access = "insert into USER_ACCESS (UserID, MobileNo, EmailID, PlanpiperEmailID, Password, PasswordStatus, UserStatus, CreatedDate,CreatedBy,UpdatedBy) values ('$userid','$mobilenumber','$email','$planpiper_email','$password1','1','A',now(),'$userid','')";

	$insert_user_access_run = mysql_query($insert_user_access);

	$insert_user_details = "insert into USER_DETAILS (UserID, FirstName, LastName, CountryCode, StateID, CityID, AddressLine1,AddressLine2, PinCode, AreaCode, Landline,AdStartDate,AdEndDate,CreatedDate,CreatedBy,UpdatedBy) values ('$userid', '$firstname', '$lastname' , '$country', '$state', '$city', '$addressline1', '$addressline2', '$pincode', '$areacode', '$landline','0000-00-00','0000-00-00', now(),'$userid','')";
    
	$insert_user_details_run = mysql_query($insert_user_details);
	
			$i = 0;
			$tmp = mt_rand(1,9);
			do {
			    $tmp .= mt_rand(0, 9);
			} while(++$i < 14);

			$individualid = $country.$tmp;

			if($user_type=='V')
			{
				
               $insert_individual_mapping = "insert into USER_MERCHANT_MAPPING (MerchantID, UserID, RoleID, Status,Type, CreatedDate) values ('$individualid','$userid','1','A','M',now())";

				$insert_individual_mapping_run = mysql_query($insert_individual_mapping);

				$insert_individual_details = "insert into MERCHANT_DETAILS (MerchantID, CompanyCountryCode, CompanyStateID, CompanyCityID, CreatedDate) values ('$individualid', '$country', '$state' , '$city', now())";

				//echo $insert_merchant_details;exit;
				$insert_individual_details_run = mysql_query($insert_individual_details);

				/*INSERT MODULES*/
				$insert_modules = mysql_query("insert into MAPPING_MERCHANT_WITH_MODULES (MerchantID,ModuleID,Status,CreatedDate,CreatedBy) select '$individualid' as MerchantID ,ModuleID,'A',now(),'$userid' from PLANPIPER_MODULES where ModuleID>5 order by ModuleID");
				/*END OF INSERT MODULES*/

				/*For Individual User Registration Update UserStatus to Active State by default in UserAccess Table*/
				mysql_query("update USER_ACCESS set UserStatus='A' where UserID='$userid' and MobileNo='$mobilenumber' and EmailID='$email'");
				/*End of Update*/

				$_SESSION['logged_userid'] 				= $userid;
				$_SESSION['logged_merchantid'] 			= $individualid;
				$_SESSION['logged_mobile']   			= $mobilenumber;
				$_SESSION['logged_email'] 				= $email;     
				$_SESSION['logged_roleid'] 				= 1;
				$_SESSION['logged_firstname'] 			= $firstname;
				$_SESSION['logged_lastname'] 			= $lastname;
				$_SESSION['logged_userstatus'] 			= 'A';
				$_SESSION['logged_companycountryid'] 	= $country;
				$_SESSION['logged_companyname'] 		= "";
				$_SESSION['logged_usertype'] 			= "I";
				$_SESSION['logged_userdp'] 				= "";

				header("Location:login.php");


			}
			else
			{
				//echo 456;exit;
				//GENERATE 15 DIGIT RANDOM NUMBER

				$insert_individual_mapping = "insert into USER_MERCHANT_MAPPING (MerchantID, UserID, RoleID, Status,Type, CreatedDate) values ('$individualid','$userid','2','A','I',now())";

				$insert_individual_mapping_run = mysql_query($insert_individual_mapping);

				$insert_individual_details = "insert into MERCHANT_DETAILS (MerchantID, CompanyCountryCode, CompanyStateID, CompanyCityID, CreatedDate) values ('$individualid', '$country', '$state' , '$city', now())";

				//echo $insert_merchant_details;exit;
				$insert_individual_details_run = mysql_query($insert_individual_details);

				/*INSERT MODULES*/
				$insert_modules = mysql_query("insert into MAPPING_MERCHANT_WITH_MODULES (MerchantID,ModuleID,Status,CreatedDate,CreatedBy) select '$individualid' as MerchantID ,ModuleID,'A',now(),'$userid' from PLANPIPER_MODULES where ModuleID>5 order by ModuleID");
				/*END OF INSERT MODULES*/

				/*For Individual User Registration Update UserStatus to Active State by default in UserAccess Table*/
				mysql_query("update USER_ACCESS set UserStatus='A' where UserID='$userid' and MobileNo='$mobilenumber' and EmailID='$email'");
				/*End of Update*/

				$_SESSION['logged_userid'] 				= $userid;
				$_SESSION['logged_merchantid'] 			= $individualid;
				$_SESSION['logged_mobile']   			= $mobilenumber;
				$_SESSION['logged_email'] 				= $email;     
				$_SESSION['logged_roleid'] 				= 2;
				$_SESSION['logged_firstname'] 			= $firstname;
				$_SESSION['logged_lastname'] 			= $lastname;
				$_SESSION['logged_userstatus'] 			= 'A';
				$_SESSION['logged_companycountryid'] 	= $country;
				$_SESSION['logged_companyname'] 		= "";
				$_SESSION['logged_usertype'] 			= "I";
				$_SESSION['logged_userdp'] 				= "";

				header("Location:login.php");
			}		
	?>
	<script type="text/javascript">
	//alert("Thank you for registering with planpiper. An activation link has been sent to your registered email address. Click on it to activate your account. Thank you.");
	//window.location.href = "index.php";
	</script>
	<?php
	}
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>eTPA</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link href="css/custom.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/planpiper.css">
<link rel="stylesheet" type="text/css" href="fonts/font.css">
<link rel="shortcut icon" href="images/planpipe_logo.png"/> 
<style type="text/css">
 #styled-select select {
	margin-top: 10px;
	background: transparent;
	background-color:#0b3024;
	color: #f2bd43;
	width: 150px;
	padding: 5px;
	line-height: 1;
	border: 0;
	border-radius: 0;
	height: 34px;
	-webkit-appearance: none;
}
#styled-select select:hover {
	background-color:#0b3024;
}
</style>      
<script type="text/javascript">
	function keychk(event)
	{
		if(event.keyCode==13)
		{
			$("#registerbutton").click();
		}
	}
</script>
</head>
<body style="overflow:hidden;">
	    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                 <a class="navbar-brand" href="index.html"><img src="images/Plan-Pipe-newlogo.png"/><!-- <span>&nbsp;&nbsp;eTPA</span> --></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav" style="border:none;margin-bottom:0px;border-radius:0px;">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="features.html">Features</a>
                    </li>
                    <li>
                        <a href="benefits.html">Benefits</a>
                    </li>
                    <li>
                        <a href="pricing.html">Pricing</a>
                    </li>
                    <li>
                        <a href="whocanuse.html">Who can use this app?</a>
                    </li>
                    <li class="active">
                        <a href="login.php">Login</a>
                    </li>
                    <li>
                        <a href="register.html">Register</a>
                    </li>
                    <li>
                        <a href="apps.html">Apps</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
	<div id="big_wrapper">

	<div align="center">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
	<div style="margin-bottom:30px;">
	<span id="errormessage" style="color:#F65100;font-family:RalewayRegular;">	
	</span>
	</div>

<form method="post" id="register_form" name="register_form" action="registration.php">
	  <div class="col-lg-offset-2 col-lg-8 col-lg-offset-2 col-md-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12" align="left">
		<div id="pageheading">Sign Up</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">				
		<span class="asterisk"></span>
		<select class="selectpicker forminputs3" id="user_type" name="user_type" required>
			
			<option style="display:none;" value="0">SELECT USER TYPE</option>

			<option value="I">CLAIM SUBMITTER</option>

			<option value="V">CLAIM PROCESSOR</option>

		</select>
		<span class="asterisk"></span>
		<input type="text" class="forminputs3 nonumbers firstlettercaps" placeholder="FIRST NAME" name="firstname" id="firstname" maxlength="20" required>
		<span class="asterisk"></span>
		<input type="text" class="forminputs3 nonumbers firstlettercaps" placeholder="LAST NAME" name="lastname" id="lastname" maxlength="20" required>
		<span class="asterisk"></span>
		<input type="email" placeholder="EMAIL ID" name="email" id="email" class="forminputs3" maxlength="50" required autocomplete='off'>	
		<span class="asterisk"></span>
		<input type="text" maxlength="10" placeholder="MOBILE NUMBER" name="mobilenumber" id="mobilenumber" class="forminputs3 onlynumbers" required autocomplete='off'>
		<span class="asterisk"></span>
		<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 paddingrl0" required>
			<input type="password" placeholder="PASSWORD" name="password1" id="password1" class="forminputs3" maxlength="20" required>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 paddingrl0" align="right">
		<div id="showpassword">Show Password</div>
		</div>
		<span class="asterisk"></span>
		<input type="password" placeholder="CONFIRM PASSWORD" name="confirmpassword" id="confirmpassword" class="forminputs3" maxlength="20" required>			
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<span class="asterisk"></span>
		<select class="selectpicker forminputs3" id="timezone" name="timezone" required>
		    <option style="display:none;" value="0">SELECT COUNTRY</option>
			<?php echo $country_options;?>
		</select>				
		<span class="asterisk"></span>
		<select class="selectpicker forminputs3" id="state" name="state" required>
		<option style="display:none;" value="0">SELECT STATE</option>
		</select>
		<span class="asterisk"></span>
		<select class="selectpicker forminputs3" id="city" name="city" required>
			<option style="display:none;" value="0">SELECT CITY</option>
		</select>
		<input type="text" class="forminputs3" placeholder="ADDRESS LINE 1" name="addressline1" id="addressline1" maxlength="250">
		<input type="text" class="forminputs3" placeholder="ADDRESS LINE 2" name="addressline2" id="addressline2" maxlength="250">
		<input type="text" class="forminputs3 onlynumbers" maxlength="6" placeholder="PINCODE" name="pincode" id="pincode">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 paddingl0">
			<input type="text" class="forminputs3" maxlength="3" placeholder="+91" name="countrycodelandline" id="countrycodelandline" value="+91">
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 paddingl0">
			<input type="text" class="forminputs3 onlynumbers" maxlength="5" placeholder="AREA CODE" name="areacode" id="areacode">
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddingr0">
			  <input type="text" class="forminputs3 onlynumbers" maxlength="8" placeholder="LANDLINE" name="landline" id="landline">
		</div>
		<input type="hidden" name="country" id="country" value="">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" style="margin-top:25px;">
			<div class="errormessages" id="registrationerror"></div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="ActionBar2" align="center" style="margin-top:25px;">
			<button id="registerbutton" class="formbuttonsmall">PROCEED</button>
			<button id="cancelbutton" class="formbuttonsmall">CANCEL</button>
		</div>
	</div>
</form>
<div>
</div>
</div>
</div><!-- big_wrapper ends -->

<div style="position:fixed;	bottom:0;left:0;width: 100%;">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:#0b3024;padding-top:2%;" align="center"  id="fixed_footer">

			<ul class="list-inline footerdiv">
				<li>
				<a href="http://www.appmantras.com"><img src="images/appmantraslogo.png" width="20" height="20" />&nbsp;App Mantras</a>
				</li>&nbsp;&nbsp;&nbsp;&nbsp;
				<li>
				<a href="useragreement.html">Terms of Usage</a>
				</li>&nbsp;&nbsp;&nbsp;&nbsp;

				<li>
				<a href="privacypolicy.html">Privacy Policy</a>
				</li>&nbsp;&nbsp;&nbsp;&nbsp;
				<li data-reveal-id="contact">
				<a href="contactus.html">Contact Us</a>
				</li>
			</ul>

         <p class="copyright text-muted small">Copyright &copy; App Mantras Software Pvt. Ltd. All Rights Reserved.</p>
    </div>	
 </div>	
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/ajax_city_state.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/modernizr.js"></script>
<script type="text/javascript" src="js/placeholders.min.js"></script>
<script type="text/javascript" src='js/get_user_timezone.js'></script>
<script type="text/javascript">

$(document).ready(function() {
	var emailerrorflag = 0;
	var mobileerrorflag = 0;
	setTimeout(function(){ $("#mobilenumber").click(); }, 1000);
	        $("#mobilenumber,#timezone").on("click",function(){
			var timezone=$("#timezone").val();
			$.ajax({
				url:'ajax_validation.php',
				data:{timezone:timezone,type:"get_country_code"},
				type: 'post',
				success : function(resp){
				var code = resp;
				var ccode= resp;
				ccode = ccode.replace(/^0+/, '');
				ccode = "+"+ccode;
				 $("#countrycodelandline").val(ccode);
				document.getElementById('country').value = code; 
					if(code!="")
					{
						var co = $.trim(code);
						var dataString = 'country='+co+'&type=get_states';	   
						$.ajax({
							url:'ajax_country_state_city.php',
							data:dataString,
							type: 'post',
							async: true,
							success : function(response,status){
								$("#state").html(response);
								$("#city").html("<option value='-1'>SELECT CITY</option>");              
							},
							error : function(resp){
							}
						});
						$("#state").on("change",function(){
						var state=$("#state").val();
							$.ajax({
								url:'ajax_country_state_city.php',
								data:{state:state,type:"get_cities"},
								type: 'post',
								success : function(resp){
									$("#city").html(resp);               
								},
								error : function(resp){}
							});
						});
					}        
				},
				error : function(resp){}
				});
			});


	$("#email").keyup(function(){ 
        var mail = $("#email").val();
        if (validateEmail(mail)) {
        	var dataString = "type=check_duplicate_email&mailid="+mail;
        	$.ajax({
				type		: 'POST', 
				url			: 'ajax_validation.php', 
				crossDomain	: true,
				data		: dataString,
				dataType	: 'json', 
				async		: false,
				success	: function (response)
					{ 
						if(response.success == true){
							emailerrorflag = 1;
							$("#registrationerror").fadeIn();
				            $("#registrationerror").text("This email id is already registered with planpiper");
				            $("#registrationerror").fadeOut(5000);
							return false;
						} else {
							emailerrorflag = 0;
						}
					},
				error: function(error)
				{
					
				}
			}); 
        }
    });
    $("#mobilenumber").keyup(function(){ 
        var mobile = $("#mobilenumber").val();
        if (mobile.length > 7) {
        	var dataString = "type=check_duplicate_mobile&mobile=00091"+mobile;
        	$.ajax({
				type		: 'POST', 
				url			: 'ajax_validation.php', 
				crossDomain	: true,
				data		: dataString,
				dataType	: 'json', 
				async		: false,
				success	: function (response)
					{ 
						if(response.success == true){
							mobileerrorflag = 1;
							$("#registrationerror").fadeIn();
				            $("#registrationerror").text("This mobile number is already registered with planpiper");
				            $("#registrationerror").fadeOut(5000);
							return false;
						} else {
							mobileerrorflag = 0;
						}
					},
				error: function(error)
				{
					
				}
			}); 
        }
    });
    var passwordvisible = 0;
    $('#showpassword').click(function(){
    	if(passwordvisible == 0){
	    	$('#password1').attr("type","input");
	    	$('#confirmpassword').attr("type","input");
	    	$('#showpassword').text("Hide Password");
	    	passwordvisible = 1;
    	} else{
      		$('#password1').attr("type","password");
	    	$('#confirmpassword').attr("type","password");
	    	$('#showpassword').text("Show Password");
	    	passwordvisible = 0;  		
    	}

    });
	$("#registerbutton").click(function() {
		var user_type = $('#user_type').val();
        if(user_type == '0'){
            $('#user_type').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please select type of user.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }
        var firstname = $('#firstname').val();
		firstname       = firstname.replace(/ /g,''); //To check if the variable contains only spaces
        if(firstname == ''){
            $('#firstname').val('');
            $('#firstname').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please enter your first name.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }
        var lastname = $('#lastname').val();
		lastname       = lastname.replace(/ /g,''); //To check if the variable contains only spaces
        if(lastname == ''){
            $('#lastname').val('');
            $('#lastname').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please enter your last name.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }
       var email = $('#email').val();
        email = email.replace(/ /g,''); //To check if the variable contains only spaces
        if(email == ''){
            //$('#email_id').val('');
            $('#email').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please enter your email id.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }
        else
        {
            var email = $('#email').val();
            if (validateEmail(email)) {
            //alert('Nice!! your Email is valid, now you can continue..');
            }
            else {
            $('#email').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please enter a valid email id.");
            $("#registrationerror").fadeOut(5000);
            return false;
            e.preventDefault();
            }
            if(emailerrorflag == 1){
	            $('#email').focus();
	            $("#registrationerror").fadeIn();
	            $("#registrationerror").text("This email id is already registered with Planpiper. Please enter a new email id.");
	            $("#registrationerror").fadeOut(5000);
	            return false;
	            e.preventDefault();
            }
        }
        var mobilenumber = $('#mobilenumber').val();
		mobilenumber       = mobilenumber.replace(/ /g,''); //To check if the variable contains only spaces
        if(mobilenumber == ''){
            $('#mobilenumber').val('');
            $('#mobilenumber').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please enter your mobile number.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }

        if(isNaN(mobilenumber)){
            $('#mobilenumber').val('');
            $('#mobilenumber').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please enter a valid mobile number.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }
        if(mobilenumber<999999){
            $('#mobilenumber').val('');
            $('#mobilenumber').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please enter a valid mobile number.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }
        if(Number(mobilenumber).toString().length < 7){
            //alert("Please enter a valid mobile number");
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please enter a valid mobile number.");
            $("#registrationerror").fadeOut(5000);
            $("#mobilenumber").focus();
            return false;
        } else {
        	var country = $('#country').val();
        	var dataString = "type=check_duplicate_mobile&mobile="+country+mobilenumber;
        	//alert(dataString);
        	$.ajax({
				type		: 'POST', 
				url			: 'ajax_validation.php', 
				crossDomain	: true,
				data		: dataString,
				dataType	: 'json', 
				async		: false,
				success	: function (response)
					{ 
						//alert(response.success);
						if(response.success == true){
							mobileerrorflag = 1;
							$("#registrationerror").fadeIn();
				            $("#registrationerror").text("This mobile number is already registered with planpiper");
				            $("#registrationerror").fadeOut(5000);
						} else {
							mobileerrorflag = 0;
						}
					},
				error: function(error)
				{
					
				}
			});         	
        }
        if(mobileerrorflag == 1){
        		$('#mobilenumber').focus();
        		$("#registrationerror").fadeIn();
				$("#registrationerror").text("This mobile number is already registered with planpiper");
				$("#registrationerror").fadeOut(5000);
				return false;
        }
        var password1 	= $("#password1").val();
		var password2 	= $("#confirmpassword").val();
        if(password1==""){
			$("#registrationerror").fadeIn();
			$("#registrationerror").text("Please enter a password");
			$("#password1").focus();
			$("#registrationerror").fadeOut(5000);
			return false;
			}

			if(password1.indexOf(" ") !== -1 ){
				$("#registrationerror").fadeIn();
				$("#registrationerror").text("Please enter a password without any whitespaces.");
				$("#password1").focus();
				$("#registrationerror").fadeOut(5000);
				return false;
			}
			if(password1!=""){
				//alert(password1)
			var passw = /^(?=.*\d)(?=.*[a-zA-Z])(?=.*[a-zA-Z0-9!@#$%^&*]).{6,15}$/;
			    if(!password1.match(passw)) 
			    { 
			    $("#registrationerror").fadeIn();
				$("#registrationerror").text("Password should have 6-15 characters which contains atleast one numeric digit and one alphabet");
				$("#confirmpassword").focus();
				$("#registrationerror").fadeOut(5000);
			    return false;
			    }
			}
		if(password2==""){
			$("#registrationerror").fadeIn();
			$("#registrationerror").text("Please confirm your password");
			$("#confirmpassword").focus();
			$("#registrationerror").fadeOut(5000);
			return false;
			}
			if(password2.indexOf(" ") !== -1 ){
				$("#registrationerror").fadeIn();
				$("#registrationerror").text("Please enter a password without any whitespaces.");
				$("#registrationerror").fadeOut(5000);
				return false;
			}
			if(password1 != "" && password2 != ""){
				if(password1 != password2)
				{
				//alert("Password Mismatch");
				$("#registrationerror").fadeIn();
				$("#registrationerror").text("Passwords don't match");
				$("#confirmpassword").focus();
				$("#registrationerror").fadeOut(5000);
				return false;
				}
			}
        var country = $('#country').val();
        if(country == '0'){
            $('#country').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please select your country.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }
        var state = $('#state').val();
        if(state == '0'){
            $('#state').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please select your state.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }
        var city = $('#city').val();
        if(city == '0'){
            $('#city').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please select your city.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }
        var pincode = $('#pincode').val();
		pincode       = pincode.replace(/ /g,''); //To check if the variable contains only spaces
        if(pincode != '' && pincode < 99999){
            $('#pincode').val('');
            $('#pincode').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please enter valid pincode.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }
        var areacode = $('#areacode').val();
		areacode       = areacode.replace(/ /g,''); //To check if the variable contains only spaces

        if(areacode != '' && (areacode ==0 || areacode ==00 || areacode ==000 || areacode ==0000 || areacode ==00000)){

            $('#areacode').val('');
            $('#areacode').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please enter valid areacode.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }

        var landline 	= $('#landline').val();
		landline       	= landline.replace(/ /g,''); //To check if the variable contains only spaces
        if(landline != '' && landline < 99999){
            $('#landline').val('');
            $('#landline').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please enter valid landline.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }
        if(landline!="" && areacode=="")
        {
        	$('#areacode').focus();
            $("#registrationerror").fadeIn();
            $("#registrationerror").text("Please enter areacode.");
            $("#registrationerror").fadeOut(5000);
            return false;
        }
        $('#register_form').submit();
	});
	$("#cancelbutton").click(function() {
		window.location.href="login.php";
		return false;
	});

	//Function that validates email address through a regular expression.
	function validateEmail(sEmail) {
		var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if (filter.test(sEmail))
		{
		return true;
		}
		else
		{
		return false;
		}
	}

	$('#country').on('change', function() {
		  var code = $(this).val();
		  code = code.replace(/^0+/, '');
		  code = "+"+code;
		  //alert(code);
		  //$('#countrycode').val(code);
		  $('#countrycodelandline').val(code);
		});
});
</script>
</body>
</html>