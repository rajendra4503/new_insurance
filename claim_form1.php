<?php
session_start();
ini_set("display_errors","0");
//echo "<pre>"; print_r($_SESSION);
include('include/configinc.php');

include('include/session.php');

include('include/functions.php');

include ('SMTP/PHPMailerAutoload.php');

include ('SMTP/class.phpmailer.php');

include ('SMTP/class.smtp.php');

$country_code = $_SESSION['logged_companycountry'];

$country_code = "+".ltrim($country_code, '0');


function sendMail($claimid ,$name,$IP_Registration){

$date = date('Y-m-d H:i:s');

$toMail=$_SESSION['logged_email'];


$logedName=$_SESSION['logged_firstname'].' '.$_SESSION['logged_lastname'];

$mail = new PHPMailer;

$mail->isSMTP(); 

$mail->Host = "mailxout.mantrabilling.com";

$mail->SMTPAuth = true; 

$mail->Username = "rajendra@appmantras.com";

$mail->Password = "fgh(12)!artc"; 

$mail->SMTPSecure = "ssl"; 

$mail->Port = 465;

$mail->isHTML(true);

$mail->From = 'rajendra@appmantras.com';

$mail->FromName = "Insurance Policy Team";

$mail->Subject = 'Successfully receiving the claim';

$mail->addAddress('sudhir@sumagotech.com');



$messages = '<!DOCTYPE html>
<html>
<head>
<title>ABC Insurance Policy</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css"> 
    body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
    table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} 
    img{-ms-interpolation-mode: bicubic;}
    img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
    table{border-collapse: collapse !important;}
    body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }
    @media screen and (max-width: 525px) {
        .wrapper {
          width: 100% !important;
            max-width: 100% !important;
        }
        .logo img {
          margin: 0 auto !important;
        }
        .mobile-hide {
          display: none !important;
        }
        .img-max {
          max-width: 100% !important;
          width: 100% !important;
          height: auto !important;
        }
        .responsive-table {
          width: 100% !important;
        }
        .padding {
          padding: 10px 5% 15px 5% !important;
        }
        .padding-meta {
          padding: 30px 5% 0px 5% !important;
          text-align: center;
        }
        .padding-copy {
             padding: 10px 5% 10px 5% !important;
          text-align: center;
        }
        .no-padding {
          padding: 0 !important;
        }

        .section-padding {
          padding: 50px 15px 50px 15px !important;
        }
        .mobile-button-container {
            margin: 0 auto;
            width: 100% !important;
        }
        .mobile-button {
            padding: 15px !important;
            border: 0 !important;
            font-size: 16px !important;
            display: block !important;
        }
    }
    div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
</head>
<body style="margin: 0 !important; padding: 0 !important;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#ffffff" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="wrapper">
                <tr>
                    <td align="center" valign="top" style="padding: 15px 0;" class="logo">
                          <p>ABC Insurance Company<br>
                          PO Box 123456<br>
                          Bangalore,560001</P>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 15px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 795px;" class="responsive-table">
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
              <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
					<p><strong>Ref : </strong>Patient Name : <span style="margin-left: 74px;">'.$name.'</span></p>
					<p style="margin-left:40px;">Claim id :  <span style="margin-left:112px;">'.$claimid.'</span></p>
					<p style="margin-left:40px;">Policy Number : <span style="margin-left:65px;">'.$IP_Registration.'
					</span></p>
					<p style="margin-left:40px;">Subscriber Number : <span style="margin-left: 29px;">'.$IP_Registration.'</span></P>
					<p style="margin-left:40px;">Date of Claim Filing :<span style="margin-left:33px;">'.$date.'</span></p>
                </td>
          </tr>

        <tr>
            <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
              <strong>Dear '.$logedName.'</strong>
            </td>
        </tr>
        <tr>
          <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
				<p>This is to let you know that claim submitted for <strong>'.$name.'</strong> has been received by
				us. It will be processed in due course and you will be informed.</p>
          </td>
        </tr>
        <tr>
          <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
				<p>Please note the claim id <strong>'.$claimid.'</strong> assigned to this claim. Please use this
				claim id in all communications related to this claim.</p>
          </td>
        </tr>
        <tr>
          <td align="left" style="padding:0 0 0 0; font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
          <p> With best regards <br>
          <strong>Claim Administrator</strong>
          <br>
          <strong>ABC Insurance Company</strong>
          </p>
          </td>
        </tr>
        </table>
        </td>
    </tr>
</table>
</td>
</tr>
</table>
</body>
</html>';

	$mail->msgHTML($messages, dirname(__FILE__));
	if(!$mail->send()) {
	//echo 'Mailer error: ' . $mail->ErrorInfo;
	} else {
	  
	}
}

function escape_string($var) {
	return mysql_real_escape_string($var);
}

$msg = '';

if (!empty($_POST['Claim_Type']) !='' && !empty($_POST['Provide_Type']) !='' && !empty($_POST['IP_Registration']) !='' ) {

	//Hospital Details

	// $Hospital_Name = escape_string($_POST['Hospital_Name']);
	// $Hospital_ID = escape_string($_POST['Hospital_ID']);
	// $hospital_type = escape_string($_POST['hospital_type']);
	// $Doctor_Name = escape_string($_POST['Doctor_Name']);
	// $Qualification = escape_string($_POST['Qualification']);
	// $Registration_No = escape_string($_POST['Registration_No']);
	// $cont_code = escape_string($_POST['cont_code']);
	// $phone_no = escape_string($_POST['phone_no']);
	// $area_code = escape_string($_POST['area_code']);
	// $date = date("Y-m-d", strtotime($_POST['date']));
	// $place = escape_string($_POST['place']);

	//Patient Details

	//$Patient_Name      =    escape_string($_POST['Patient_Name']);
	//$Patient_Last_Name =    escape_string($_POST['Patient_Last_Name']);
	//$gender = escape_string($_POST['gender']);
	//$DateofBirth = date("Y-m-d", strtotime($_POST['DateofBirth']));


	$Claim_Type   = $_POST['Claim_Type'];

	$Provide_Type = $_POST['Provide_Type'];

	 if($Provide_Type == 0){

		$q = mysql_query("SELECT max(Provider_ID) as LastID FROM non_network_provider_table");

		$value = mysql_fetch_object($q);
		if($value->LastID != 0){
		$new_id = substr($value->LastID,4);
		$nonpro_ID =  'NNPID'.$new_id+1;
		}else{
		$nonpro_ID =  'NNPID'.'00000001';
		} 

		$Non_Network_Provider_Name = $_POST['Non_Network_Provider_Name'];

		$Non_Network_Provider_Type = $_POST['Non_Network_Provider_Type'];

		$Non_Network_Provider_Pan = $_POST['Non_Network_Provider_Pan'];

		$Non_Network_Registration_No = $_POST['Non_Network_Registration_No'];

		$Non_Network_Address = $_POST['Non_Network_Address'];

		$Non_Network_City = $_POST['Non_Network_City'];

		$Non_Network_Sate = $_POST['Non_Network_State'];

		$Non_Network_pin_code = $_POST['Non_Network_pin_code'];

		$Non_Network_cont_code = $_POST['Non_Network_cont_code'];

		$Non_Network_area_code = $_POST['Non_Network_area_code'];

		$Non_Network_phone_no = $_POST['Non_Network_phone_no'];

		$Non_Network_OT = $_POST['Non_Network_OT'];

		$Non_Network_icu = $_POST['Non_Network_icu'];

		$Non_Network_PatientBeds = $_POST['Non_Network_PatientBeds'];


        $non_hospital_query = "INSERT INTO `non_network_provider_table` (`Provider_ID`, `Claim_ID`, `Hospital_Address`, `City`, `State`, `Pin_Code`, `CountryCode`, `AreaCode`, `PhoneNo`, `Registration_No`, `Hospital_PAN`, `Beds`, `OT`, `ICU`, `Others`, `CreatedDate`, `CreatedBy`, `UpdatedDate`, `UpdatedBy`) VALUES (NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', CURRENT_TIMESTAMP, '', '0000-00-00 00:00:00.000000', '')";
	   }


	$IP_Registration = escape_string($_POST['IP_Registration']);
	$DateofAdmission =  date("Y-m-d", strtotime($_POST['DateofAdmission']));
	$DateofTime = escape_string($_POST['DateofTime']);
	$DateofDischarge = date("Y-m-d", strtotime($_POST['DateofDischarge']));
	$TimeofDischarge = escape_string($_POST['TimeofDischarge']);
	$type_admission = escape_string($_POST['type_admission']);

	if( $_POST['DateofDelivery'] != '') {
	  $DateofDelivery = date("Y-m-d", strtotime($_POST['DateofDelivery']));
	} else {
	  $DateofDelivery = '';
	}

	$GravidaStatus = escape_string($_POST['GravidaStatus']);
	$status_time   =  escape_string($_POST['status_time']);
	$ClaimedAmount = escape_string($_POST['ClaimedAmount']);

	$q = mysql_query("SELECT max(Claim_ID) as LastClaimID FROM patient_details");

	$value = mysql_fetch_object($q);
	if($value->LastClaimID != 0){
    	$new_id = substr($value->LastClaimID,4);
    	$Claim_ID =  date("Y").$new_id+1;
     }else{
         $Claim_ID =  date("Y").'00000001';
     }   

	//$Patient_ID = 'PID-'.substr(str_shuffle("0123456789"), 0,5);

	$patient_query = "INSERT INTO patient_details (Claim_ID,Policy_No,Date_of_Admission,Time_of_Admission,Date_of_Discharge,Time_of_Discharge,Type_of_Admission,Date_of_Delivery,Gravida_Status,Status_Time_of_Discharge,Total_Claimed_Amount,CreatedDate,CreatedBy) VALUES ('$Claim_ID','$IP_Registration','$DateofAdmission', '$DateofTime', '$DateofDischarge', '$TimeofDischarge', '$type_admission', '$DateofDelivery', '$GravidaStatus', '$status_time','$ClaimedAmount',now(),'$logged_userid')";


		if (mysql_query($patient_query))
		{

		    // $hospital_query = "INSERT INTO `hospital_details` (`Claim_ID`, `Hospital_Name`, `Hospital_ID`,`Doctor_Name`,`Qualification`,`Network_Type`,`Registration_No`, `Country_Code`, `Area_Code`, `Phone_No`,`Declaration_Date`,`Declaration_Place`,`CreatedDate`, `CreatedBy`) VALUES ('$Claim_ID', '$Hospital_Name', '$Hospital_ID','$Doctor_Name','$Qualification','$hospital_type','$Registration_No', '$cont_code', '$area_code', '$phone_no','$date','$place',now(),'$logged_userid')";


				mysql_query($hospital_query); 
                //diagnosis details
			    if( !empty($_POST["diagnosis"])){
					$diagnosis    =   $_POST["diagnosis"];
					$procedure    =   $_POST["procedure"];
					$query = 'INSERT INTO claim_diagnosis_procedure (`Claim_ID`, `ICD10CM`,`ICD10PCS`) VALUES ';
					$query_parts = array();
						for($x=0; $x<count($diagnosis); $x++){
						if($diagnosis[$x] !='' && $diagnosis[$x] !=''){
							$query_parts[] = "('$Claim_ID','" .$diagnosis[$x] . "', '" . $procedure[$x]."')";
						}else{}
						}
						$query .= implode(',',$query_parts);
						mysql_query($query);
                  }
					$auth = $_POST['auth'];
					$auth_number = $_POST['auth_number'];
					$auth_reason = $_POST['auth_reason'];
					$injury = $_POST['injury'];
					$cause = $_POST['cause'];
					$injury_reason = $_POST['injury_reason'];
					$medico = $_POST['medico'];
					$police = $_POST['police'];
					$fir_no = $_POST['fir_no'];
					$report_reason = $_POST['report_reason'];
					$patint_query = "INSERT INTO `patient_diagnosis_details` (`Claim_ID`, `Authorization_Obtained`, `Authorization_Number`, `Authorization_Reason`, `Hospitalization_Injury`, `Give_Cause`, `Test_Conducted`, `Medico_Legal`, `Reported_Police`, `Fir_No`, `Reported_Reason`, `CreatedDate`, `CreatedBy`) VALUES ('$Claim_ID','$auth', '$auth_number', '$auth_reason', '$injury','$cause','$injury_reason', '$medico', '$police', '$fir_no', '$report_reason',now(),'$logged_userid')";
		            mysql_query($patint_query);

		// DETAILS OF CLAIM  
		
		$Health_CheckUp_Cost = $_POST['Health_CheckUp_Cost'];
		$Pre_Hospitalization_Expenses = $_POST['Pre_Hospitalization_Expenses'];
		$Ambulance_Charges = $_POST['Ambulance_Charges'];
		$Accnmmodation_Days = $_POST['Accnmmodation_Days'];
		$Accnmmodation_Charges = $_POST['Accnmmodation_Charges'];
		$Consultant_Days = $_POST['Consultant_Days'];
		$Consultant_Charges = $_POST['Consultant_Charges'];
		$Routine_Investigations = $_POST['Routine_Investigations'];
		$Medicicne_Drugs = $_POST['Medicicne_Drugs'];
		$Major_Surgical = $_POST['Major_Surgical'];
		$Intermediate_Surgical = $_POST['Intermediate_Surgical'];
		$Ancillary_Services = $_POST['Ancillary_Services'];
		$Post_Hospitalization_Expenses = $_POST['Post_Hospitalization_Expenses'];
		$Total_Treatment_Expenses = $_POST['Total_Treatment_Expenses'];
		

        $patient_claims_detail = "INSERT INTO `patient_claim_details` (`Claim_ID`, `Health_CheckUp_Cost`, `Pre_Hospitalization_Expenses`, `Ambulance_Charges`, `Accnmmodation_Days`, `Accnmmodation_Charges`, `Consultant_Days`, `Consultant_Charges`, `Routine_Investigations`, `Medicicne_Drugs`, `Major_Surgical`, `Intermediate_Surgical`, `Ancillary_Services`, `Post_Hospitalization_Expenses`, `Total_Treatment_Expenses`,`CreatedDate`,`CreatedBy`) VALUES ('$Claim_ID', '$Health_CheckUp_Cost', '$Pre_Hospitalization_Expenses', '$Ambulance_Charges', '$Accnmmodation_Days', '$Accnmmodation_Charges', '$Consultant_Days', '$Consultant_Charges', '$Routine_Investigations', '$Medicicne_Drugs', '$Major_Surgical', '$Intermediate_Surgical', '$Ancillary_Services', '$Post_Hospitalization_Expenses','$Total_Treatment_Expenses',now(),'$logged_userid')";

            mysql_query($patient_claims_detail);

            $target_path = "uploads/bills/";

      for($i = 0 ; $i < count($_POST['billno']) ; $i++){

		$billno = mysql_real_escape_string($_POST['billno'][$i]);

		$billdate = date("Y-m-d", strtotime($_POST['billdate'][$i]));

		//$billdate = mysql_real_escape_string($_POST['billdate'][$i]);

		$billissued  = mysql_real_escape_string( $_POST['billissued'][$i] );

		$billtowards = mysql_real_escape_string($_POST['billtowards'][$i]);

		$billamount = mysql_real_escape_string($_POST['billamount'][$i]);

		if($_FILES["bills"]['name'][$i]){
			$validextensions = array("jpeg", "jpg", "png","pdf","docx","doc");
			$ext = explode('.', basename($_FILES["bills"]['name'][$i]));
			$file_extension = end($ext); 
			$date          = time().mt_rand(1000,9999);
			$imgtype       = explode('.', basename($_FILES["bills"]['name'][$i]));
			$ext           = end($imgtype);
			$filename      = $imgtype[0];
			$fullfilename  = $date."@".$filename.".".$ext;
			$fullpath      = $target_path.$fullfilename;
			if (($_FILES["bills"]["size"][$i])
				&& in_array($ext, $validextensions)) {
				if (move_uploaded_file($_FILES["bills"]["tmp_name"][$i], $fullpath)) {
			      $bill = $fullfilename;
				}
            }
         }

     	 $patient_claim_bill_enclosed = "INSERT INTO `patient_claim_bill_enclosed` (`Claim_ID`, `Bill_No`, `Bill_Date`, `Bill_Issued`, `Bill_Towards`, `Bill_Amount`,`Bill`, `CreatedDate`, `CreatedBy`) VALUES ('$Claim_ID', '$billno', '$billdate', '$billissued','$billtowards', '$billamount','$bill',now(), '$logged_userid')";

       mysql_query($patient_claim_bill_enclosed);
     }
       // CLAIM DOCUMENTS SUBMITTED

	$target_path = "uploads/docs/";

	for ($x = 1; $x < 17; $x++) {
		$images = array();

		if (isset($_POST["doc$x"])) {


			for ($i = 0; $i < count($_FILES["file_doc$x"]["name"]); $i++) {

				$validextensions = array("jpeg", "jpg", "png","pdf","docx","doc");
				$ext = explode('.', basename($_FILES["file_doc$x"]['name'][$i]));
				$file_extension = end($ext); 
				$date          = time().mt_rand(1000,9999);
				$imgtype       = explode('.', basename($_FILES["file_doc$x"]['name'][$i]));
				$ext           = end($imgtype);
				$filename      = $imgtype[0];
				$fullfilename  = $date."@".$filename.".".$ext;
				$fullpath      = $target_path.$fullfilename;     
				if (($_FILES["file_doc$x"]["size"][$i])
				&& in_array($ext, $validextensions)) {
				if (move_uploaded_file($_FILES["file_doc$x"]["tmp_name"][$i], $fullpath)) {
			      $images[] = $fullfilename;
				} 
			  } 
			}

			$doc_name =  $_POST["doc$x"];

			$images  = implode(",", $images);

			if ($x == 16) {
				$please_specify = $_POST['please_specify'];	
			}else{
			   $please_specify = '';
			}


			$doc_query = mysql_query("INSERT INTO `patient_claim_fles` (`Claim_ID`, `Doc_Name`, `Docs`,`Any_Other`,`CreatedDate`, `CreatedBy`) VALUES ('$Claim_ID', '$doc_name','$images','$please_specify',now(),'$logged_userid')");

		     }
	     }

		            // NON NETWORK HOSPITAL DETAILS

		            
		            

						// if(mysql_query($non_hospital_query)){

						// $Patient_Name = $Patient_Name.' '.$Patient_Last_Name;
						// 	sendMail($Claim_ID, $Patient_Name,$IP_Registration);

						// $msg = 'Patient Data Submited Successfully.';

						// }else{
						// 	$msg = '';
						// }
    		    
		}
		else
		{
			$msg = "Error creating database: " . mysql_error();
		}
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>CLAIM FORM</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/planpiper.css">
		<link rel="stylesheet" type="text/css" href="fonts/font.css">
		<link rel="shortcut icon" href="images/planpipe_logo.png"/>

		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <link href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css" rel="stylesheet" />
			<style>
			.list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute; z-index: 99;}
			.list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
			.list li:hover{background:#ece3d2;cursor: pointer;}
			.error{color: red;font-size: 15px;font-weight: bold;}
			.dia_des{font-size: 15px;font-weight: normal;}
			.radio label, .checkbox label {font-weight: bold;}
			.area_code_errmsg{color: red;}
			.amount_errmsg{color: red;}
			.phone_no_errmsg{color: red;}
			.areacode_errmsg{color: red;}
			.phoneno_errmsg{color: red;}
			.help-inline-error {
			color: red;
			font-size: 15px;
			font-weight: bold;
			}
			.btn-primary {width: 86px;}

			input.expenses{
			text-align: right;
			padding-right: 15px;
			}
			input.amount{
			  text-align: right;
			  padding-right: 15px;
			}
			.glyphicon-ok {
			 color: green;
			 margin-right: 4px;
             margin-top: 30px;
			}
			.glyphicon-remove {
			 color: red;
			 margin-right: 4px;
             margin-top: 30px;
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
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0">
		<div id="plantitle">
		
			<span style="padding-left:0px;">
				CLAIM FORM
			</span>
		</div>
	</div>
	<?php if($msg !=''){ ?>
		<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo $msg; ?>
		</div>
	<?php } ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="mainplanlistdiv" style="height: 680px;">
	<div class="col-md-12 col-sm-12" style="height: 4px;top: -22px;">
	   <h2 style="color:#FE0000;text-align:center;font-size:16px; font-weight:bold;">
	   		( All colored fields are required )
	   </h2>
	</div>
	<div class="clearfix"></div>

<form  name="basicform" id="basicform" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">

<div id="sf1" class="frm">

<fieldset>

  <div id="menu1"><br>

	<div id="pageheading" style="text-align: left;">Claim & Provider Details</div>


	    <div class="form-group col-md-12 col-sm-12">
            <label for="address" class="col-md-4">Claim Type</label>
            <p class='container'>
	            <label class="radio-inline">
	            <input type="radio" name="Claim_Type" value="1">Out-Patient Claim
	            </label>
	            <label class="radio-inline">
	            <input type="radio" name="Claim_Type" value="0">Inpatient Claim
	            </label>
            </p>
        </div>

        <div class="form-group col-md-12 col-sm-12">
            <label for="address" class="col-md-4">Provider Type</label>
             <p class='container'>
	            <label class="radio-inline">
	            <input type="radio" name="Provide_Type" id="Network_Provide_Type" value="1">Network Provider
	            </label>
	            <label class="radio-inline">
	            <input type="radio"  name="Provide_Type" id="Non_Network_Provide_Type" value="0">Non-Network Provider
	            </label>
            </p>
        </div>

         <div id="network_dtails" class="form-group col-md-12 col-sm-12" style="display:none;">

         	<div class="form-group col-sm-6">
				<label>Network Provider</label>
				<input type="text" class="form-control" name="Network_Provider" id="Network_Provider" placeholder="Select Network Provider From Dropdown" required>
			</div>
			<div class="clearfix"></div>

			<div class="form-group col-sm-6">
				<label>Provider ID</label>
				<input type="text" class="form-control" name="Network_Provider_ID" id="Network_Provider_ID" readonly="">
			</div>

			<div class="form-group col-sm-6">
				<label>Provider Name</label>
				<input type="text" class="form-control" name="Network_Provider_Name" id="Network_Provider_Name" readonly="">
			</div>

		    <div class="form-group col-sm-6">
			    <label>Name of the treating Doctor</label>
			    <input type="text" class="form-control" id="Network_Doctor_Name" name="Network_Doctor_Name" required>
		    </div>

			<div class="form-group col-sm-6">
			    <label>Qualification</label>
			    <input type="text" class="form-control" id="Network_Qualification" name="Network_Qualification" required>
		    </div>

		    <div class="form-group col-sm-6">
			   <label>Registration No. with state code</label>
			   <input type="text" class="form-control" name="Network_Registration_No" id="Network_Registration_No" required>
		    </div>

			<div class="form-group col-sm-6">
			    <label>Contact No.</label>
			     <div class="clearfix"></div>
			    <div class="col-sm-4" style="margin-left: -15px;">
			      <input type="text" maxlength="3" class="form-control" name="Network_cont_code" id="Network_cont_code" value="<?php echo $country_code;?>" required> 
			    </div>
			    <div class="col-sm-4">
			      <input type="text" placeholder="Area Code" class="form-control numberonly" maxlength="3" name="Network_area_code" id="Network_area_code" required>&nbsp;<span class="area_code_errmsg">
			    </div>
			    <div class="col-sm-4">
			      <input type="text" placeholder="Phone No" maxlength="8" class="form-control numberonly" name="Network_phone_no" id="Network_phone_no" required>&nbsp;<span class="phone_no_errmsg">
			    </div>
			</div>

         </div>	

         <div class="clearfix"></div>
         <div  id="non_network_dtails" class="form-group col-md-12 col-sm-12" style="display:none;">

			<!-- <div class="clearfix"></div> -->

			<div class="form-group col-sm-3">
				<label>Provider Name</label>
				<input type="text" class="form-control" name="Non_Network_Provider_Name" id="Non_Network_Provider_Name">
			</div>

		    <div class="form-group col-md-3 col-sm-3">
		        <label for="address">Provider Type</label>
		        <br>
		        <label class="radio-inline">
		        <input type="radio" name="Non_Network_Provider_Type" value="1">Hospital
		        </label>
		        <label class="radio-inline">
		        <input type="radio" name="Non_Network_Provider_Type" value="0">Doctore
		        </label>
	        </div>

	        <div class="form-group col-sm-3">
				<label>Provider Pan</label>
				<input type="text" class="form-control" name="Non_Network_Provider_Pan" id="Non_Network_Provider_Pan">
			</div>

		    <div class="form-group col-sm-3">
			   <label>Registration No. with state code</label>
			   <input type="text" class="form-control" name="Non_Network_Registration_No" id="Non_Network_Registration_No">
		    </div>


			<div class="col-sm-6">
			    <label>Address</label>
			    <textarea class="form-control" id="Non_Network_Address" name="Non_Network_Address"></textarea>
		    </div>

		    <div class="form-group col-sm-2">
			   <label>City</label>
			   <input type="text" class="form-control" name="Non_Network_City" id="Non_Network_City">
		    </div>

		    <div class="form-group col-sm-2">
			   <label>State</label>
			   <input type="text" class="form-control" name="Non_Network_State" id="Non_Network_State">
		    </div>

		    <div class="form-group col-sm-2">
			   <label>Pin Code</label>
			   <input type="text" class="form-control" name="Non_Network_pin_code" id="Non_Network_pin_code">
		    </div>
		    <div class="clearfix"></div>

			<div class="form-group col-sm-6">
				<br>
			    <label>Contact No.</label>
			     <div class="clearfix"></div>
			    <div class="col-sm-4" style="margin-left: -15px;">
			      <input type="text" class="form-control" name="Non_Network_cont_code" id="Non_Network_cont_code" value="<?php echo $country_code;?>" required> 
			    </div>
			    <div class="col-sm-4">
			      <input type="text" placeholder="Area Code" class="form-control numberonly" maxlength="3" name="Non_Network_area_code" id="Non_Network_area_code" required>&nbsp;<span class="area_code_errmsg">
			    </div>
			    <div class="col-sm-4">
			      <input type="text" placeholder="Phone No" maxlength="8" class="form-control numberonly" name="Non_Network_phone_no" id="Non_Network_phone_no" required>&nbsp;<span class="phone_no_errmsg">
			    </div>
			</div>


         <div class="col-sm-12">
          <label> Facilities available in the hospital</label>
         </div>

		<div class="form-group col-sm-2">
			<label> OT &nbsp;&nbsp;</label>
			<input class="form-check-input" type="radio" name="Non_Network_OT" value="1">
			<label class="form-check-label" for="gridCheck">
			Yes
			</label>
			&nbsp;
			<input class="form-check-input" type="radio" name="Non_Network_OT" value="0">
			<label class="form-check-label" for="gridCheck">
			No
			</label>	
		</div>

		<div class="form-group col-sm-2">
			<label> ICU &nbsp;&nbsp;</label>
			<input class="form-check-input" type="radio" name="Non_Network_icu" value="1">
			<label class="form-check-label" for="gridCheck">
			Yes
			</label>
			&nbsp;
			<input class="form-check-input" type="radio" name="Non_Network_icu" value="0">
			<label class="form-check-label" for="gridCheck">
			No
			</label>
		</div>

	    <div class="col-sm-4">
		   <label>Number of Patient Beds</label>
		   <input id="Non_Network_PatientBeds" type="text" class="form-control numberonly" name="Non_Network_PatientBeds">
        </div>

     </div>

		<div class="form-group">
		<div class="col-lg-10 col-lg-offset-5">
		<button class="btn btn-primary open1" type="button">Next <span class="fa fa-arrow-right"></span></button> 
		</div>
		</div>

	    </div>
	</fieldset>
  </div>

<div id="sf2" class="frm" style="display: none;">
<fieldset>
<div id="menu2">

    <div class="clearfix"><br></div>

    <div id="pageheading" style="text-align: left;">Patient Details</div>

    <div class="form-group col-sm-4">
	    <label>Insurance Policy Number.</label>
	    <input type="text" class="form-control"  id="IP_Registration" name="IP_Registration" required>
    </div>

     <div class="form-group col-sm-4">
    	 <label>&nbsp;&nbsp;</label>

    	<div id="user-result" style="display: none;margin-top: -17px;">
			<span class="glyphicon glyphicon-remove">
			</span>
			<button id="verify_reject" type="button" class="btn btn-danger btn-md" style="margin-right: 11px;margin-top: -12px;">
			Patient Not Found !
			</button>
		</div>

    </div>

    <div class="clearfix"></div>

     <div class="form-group col-sm-6">
	    <label>Patient First Name </label>
	    <input type="text" class="form-control" name="Patient_Name" id="Patient_Name" required>
    </div>

	<div class="form-group col-sm-6">
	    <label>Patient Last Name </label>
	    <input type="text" class="form-control" id="Patient_Last_Name" name="Patient_Last_Name" required>
    </div>

    <div class="form-group col-sm-6">
	    <label>Gender</label>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="gender" id="Male" value="M">
				<label class="form-check-label" for="gridCheck">
					Male
				</label>
				&nbsp;&nbsp;
				<input class="form-check-input" type="radio" name="gender" value="F" id="Female">
				<label class="form-check-label" for="gridCheck">
				    Female
				</label>
				&nbsp;&nbsp;
				<input class="form-check-input" type="radio" name="gender" value="T" id="Transgender">
				<label class="form-check-label" for="gridCheck">
				    Transgender
				</label>
			</div>
    </div>
   
	<div class="form-group col-sm-4">
		<label>Date of Birth </label>
		<input type="text" class="form-control" name="DateofBirth" id="DateofBirth" required>
	</div>

	<div class="form-group col-sm-2">
		<label>Age</label>
		<div id="Age"></div>
    </div>

	<div class="clearfix"></div>

    <div class="form-group col-sm-3">
	    <label>Date of Admission </label>
		<input type="text" class="form-control" name="DateofAdmission" id="DateofAdmission" required>
    </div>
    <div class="form-group col-sm-3">
	    <label>Time </label>
		<input id="DateofTime" name="DateofTime" type="text" class="form-control input-small">
    </div>
  
    <div class="form-group col-sm-3">
	    <label>Date of Discharge </label>
		<input type="text" class="form-control" name="DateofDischarge" id="DateofDischarge" required>
    </div>
    <div class="form-group col-sm-3">
	    <label>Time</label>
		<input name="TimeofDischarge" id="TimeofDischarge" type="text" class="form-control input-small">
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-sm-5">
	    <label>Type of Admission</label>
			<div class="form-check">
				<input id="Planned" class="form-check-input" type="radio" name="type_admission" value="P" checked>
				<label class="form-check-label" for="gridCheck">
				    Planned
				</label>
				&nbsp;
				<input id="DayCare" class="form-check-input" type="radio" name="type_admission" value="D">
				<label class="form-check-label" for="gridCheck">
				    Day Care
				</label>
				&nbsp;
			<input class="form-check-input" type="radio" name="type_admission" value="M" id="maternity">
			<label class="form-check-label" for="gridCheck">
		         Maternity
			</label>
			&nbsp;
			<input id="Emergency" class="form-check-input" type="radio" name="type_admission" value="E">
				<label class="form-check-label" for="gridCheck">
					Emergency
				</label>
			</div>
    </div>
   
   
	<div class="col-sm-3 form-group">
		<label>Date of Delivery </label>
		<input type="text" class="form-control" name="DateofDelivery" id="DateofDelivery" disabled>
	</div>
	<div class="col-sm-2 form-group">
		<label>Gravida Status</label>
		<input type="text" class="form-control" name="GravidaStatus" id="GravidaStatus" disabled>
	</div>
    <div class="form-group col-sm-7">
	    <label>Status at time of Discharge :</label>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="status_time" value="H">
				<label class="form-check-label" for="gridCheck">
					Discharged to Home
				</label>
				&nbsp;
				<input class="form-check-input" type="radio" name="status_time" value="AH">
				<label class="form-check-label" for="gridCheck">
				   Discharged to Another Hospital
				</label>
				&nbsp;
				<input class="form-check-input" type="radio" name="status_time" value="DC">
				<label class="form-check-label" for="gridCheck">
				    Day Care
				</label>
				&nbsp;
				<input class="form-check-input" type="radio" name="status_time" value="D">
				<label class="form-check-label" for="gridCheck">
				    Deceased
				</label>
			</div>
    </div>

		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-5">
			<button class="btn btn-warning back2" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
			<button class="btn btn-primary open2" type="button">Next <span class="fa fa-arrow-right"></span></button> 
			</div>
		</div>

   </div>
  </fieldset>
 </div>

  <div id="sf3" class="frm" style="display: none;">
   <fieldset>
     <div id="menu3">
       <div style="clear:both;"><br></div>
    	<div id="pageheading" style="text-align: left;"> DETAILS OF AILMENT DIAGNOSED (PRIMARY)</div>

		<div class="col-sm-5">
			<label>Primary Diagnosis ( ICD 10 Codes ) </label>
			<input type="text" id="ICD1" name="diagnosis[]" class="form-control diagnosis" required>
			<p id="des_1" class="dia_des"></p>
		</div>
		<div class="col-sm-1" id="ICD1_Status"></div>

    	<div class="col-sm-5">
		    <label>Procedure ( ICD 10 PCS )</label>
			<input type="text" id="PCS1" name="procedure[]" class="form-control procedure" required>
			<p id="desp_1" class="dia_des"></p>
        </div>
        <div class="col-sm-1" id="PCS1_Status"></div>

        <div style="clear:both;"><br></div>

        <div class="col-sm-5">
			<label>Additional Diagnosis ( ICD 10 Codes ) </label>
			 <input type="text" id="ICD2" name="diagnosis[]" class="form-control diagnosis">
			 <p id="des_2" class="dia_des"></p>
		</div>
		<div class="col-sm-1" id="ICD2_Status"></div>

    	<div class="col-sm-5">
		    <label>Procedure ( ICD 10 PCS )</label>
			<input type="text" id="PCS2" name="procedure[]" class="form-control procedure">
			<p id="desp_2" class="dia_des"></p>
        </div>
        <div class="col-sm-1" id="PCS2_Status"></div>

        <div style="clear:both;"><br></div>

        <div class="col-sm-5">
			<label>Co-Morbidities ( ICD 10 Codes ) </label>
			 <input type="text" id="ICD3" name="diagnosis[]" class="form-control diagnosis">
			 <p id="des_3" class="dia_des"></p>
		</div>
		<div class="col-sm-1" id="ICD3_Status"></div>

    	<div class="col-sm-5">
		    <label>Procedure ( ICD 10 PCS )</label>
			<input type="text" id="PCS3" name="procedure[]" class="form-control procedure">
			<p id="desp_3" class="dia_des"></p>
        </div>
        <div class="col-sm-1" id="PCS3_Status"></div>

        <div style="clear:both;"><br></div>

        <div class="col-sm-5">
			<label>Co-Morbidities ( ICD 10 Codes ) </label>
			 <input type="text" id="ICD4" name="diagnosis[]" class="form-control diagnosis">
			 <p id="des_4" class="dia_des"></p>
		</div>
		<div class="col-sm-1" id="ICD4_Status"></div>

    	<div class="col-sm-5">
		    <label>Details of Procedure</label>
			<input type="text" id="PCS4" name="procedure[]" class="form-control procedure">
			<p id="desp_4" class="dia_des"></p>
        </div>
        <div class="col-sm-1" id="PCS4_Status"></div>

        <div style="clear:both;"><br></div>

		<div class="col-sm-3">
		<label>Pre Authorization Obtained</label>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="auth" value="1">
				<label class="form-check-label" for="gridCheck">Yes</label>
				&nbsp;
				<input class="form-check-input" type="radio" name="auth" value="0">
				<label class="form-check-label" for="gridCheck">No</label>
			</div>
		</div>
	    <div class="col-sm-4">
		   <label>Pre Authorization Number :</label>
		   <input type="text" class="form-control" name="auth_number">
        </div>
        <div style="clear: both;"><br></div>
	    <div class="col-sm-12">
		    <label>If Authorization By Network Hospital not Obtained, Give Reason </label>
		    <textarea class="form-control" name="auth_reason"></textarea>
	    </div>
        <div style="clear: both;"><br></div>
		<div class="col-sm-4">
		<label>Hospitalization due to injury</label>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="injury" value="1">
				<label class="form-check-label" for="gridCheck">
					Yes
				</label>
				&nbsp;
				<input class="form-check-input" type="radio" name="injury" value="0">
				<label class="form-check-label" for="gridCheck">
				   No
				</label>
			</div>
		</div>
	    <div class="col-sm-8">
		    <label>If yes, give cause</label>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="cause" value="S">
					<label class="form-check-label" for="gridCheck">
						Self Inflicted
					</label>
					&nbsp;
					<input class="form-check-input" type="radio" name="cause" value="R">
					<label class="form-check-label" for="gridCheck">
					   Road Traffic Accident
					</label>
					&nbsp;
					<input class="form-check-input" type="radio" name="cause" value="SC">
					<label class="form-check-label" for="gridCheck">
					  Substance abuse / alcohol consumption
					</label>
				</div>
	     </div>
	     <div style="clear: both;"><br></div>
	     <div class="col-sm-4">
			<label>If Medico Legal</label>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="medico" value="1">
				<label class="form-check-label" for="gridCheck">Yes</label>
				&nbsp;
				<input class="form-check-input" type="radio" name="medico" value="0">
				<label class="form-check-label" for="gridCheck">No</label>
			</div>
		 </div>
		  <div class="col-sm-8">
			    <label>If injury due to Substance abuse / alcohol consumption, Test Conducted to establish this </label>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="injury_reason" value="1">
					<label class="form-check-label" for="gridCheck">Yes
					</label>
					&nbsp;
					<input class="form-check-input" type="radio" name="injury_reason" value="0">
					<label class="form-check-label" for="gridCheck">No
					</label>
					<label class="form-check-label" for="gridCheck">
					&nbsp; &nbsp;(if yes, attach reports)
					</label>
				</div>
		   </div> 
		<div style="clear: both;"><br></div>
	    <div class="col-sm-4">
		    <label> Reported to Police</label>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="police" value="1">
				<label class="form-check-label" for="gridCheck">Yes</label>
				&nbsp;
				<input class="form-check-input" type="radio" name="police" value="0">
				<label class="form-check-label" for="gridCheck">No</label>
			</div>
	    </div>
    	<div class="col-sm-4">
		   <label>Fir No. </label>
		   <input type="text" class="form-control" name="fir_no">
        </div>
		<div class="col-sm-12">
			<label>If not Reported to  Police, give reason :</label>
			<textarea class="form-control" name="report_reason"></textarea>
		</div>

        <div class="form-group">
			<div class="col-lg-10 col-lg-offset-5">
			<button class="btn btn-warning back3" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
			<button class="btn btn-primary open3" type="button">Next <span class="fa fa-arrow-right"></span></button> 
			</div>
		</div>
      </div>
  </fieldset>
</div>

<div id="sf4" class="frm" style="display: none;">
	 <fieldset>
	   <div id="menu4"><br>

		<div id="pageheading" class="col-sm-12">
			<div class="col-sm-4" style="text-align:left;">
				DETAILS OF CLAIM
		    </div>
			<div class="col-sm-4">
				Total Claimed Amount
		    </div>
		    <div class="form-group col-sm-4 col-md-4 ">		
				<div class="input-group"> 
				<span class="input-group-addon">₹</span>
				<input readonly value="" id="TotalClaimedAmount" type="text" name="ClaimedAmount" style="margin-top: -3px;">
				</div>
			</div>
		</div>

	<div class="form-group col-md-12 col-sm-12">
      <label for="email">
         Details of treatment expenses claimed
      </label>
    </div>

      <div class="form-group col-sm-4 col-md-4">
          <label for="address" class="control-label text-left">Health Check-Up Cost</label>
          <div class="input-group"> 
			  <span class="input-group-addon">₹</span>
			  <input type="text" class="form-control input-sm expenses" id="Health_CheckUp_Cost" name="Health_CheckUp_Cost">
		  </div>
      </div>

     <div class="form-group col-sm-4 col-md-4 ">
        <label for="address" class="control-label text-left">Pre Hospitalization Expenses</label>
           <div class="input-group"> 
			  <span class="input-group-addon">₹</span>
			  <input type="text" class="form-control input-sm expenses" id="Pre_Hospitalization_Expenses" name="Pre_Hospitalization_Expenses">
		  </div>
       
     </div>

  
      <div class="form-group col-sm-4 col-md-4 ">
          <label for="address" class="control-label text-left">Ambulance Charges</label>
           <div class="input-group"> 
			  <span class="input-group-addon">₹</span>
			  <input type="text" class="form-control input-sm expenses" id="Ambulance_Charges" name="Ambulance_Charges">
		  </div>
         
      </div> 

      <div class="form-group col-sm-4 col-md-4">
          <label for="address" class="control-label text-left">Hospitalization Accommodation</label>

		  <div class="form-group col-sm-6 col-md-6">
		     <label for="address" class="control-label text-left">Days</label>
		     <input type="text" class="form-control input-sm" id="Accnmmodation_Days" name="Accnmmodation_Days">
		  </div>
		     
		  <div class="form-group col-sm-6 col-md-6">
		  	  <label for="address" class="control-label text-left">
		  	  Charges</label>
		  	  <div class="input-group"> 
			  <span class="input-group-addon">₹</span>

			  <input data-toggle="tooltip" data-placement="top" title="Enter Total Accommodation Charges" type="text" class="form-control input-sm expenses" id="Accnmmodation_Charges" name="Accnmmodation_Charges" />

		     </div>
		  	  
		  </div>
      </div>

      <div class="form-group col-sm-4 col-md-4">
          <label style="margin-left: -104px;" for="address" class="control-label text-left">Consultant  Fees</label>

		   <div class="form-group col-sm-6 col-md-6">
		     <label style="margin-top: 25px;" for="address" class="control-label text-left">Days</label>
		     <input type="text" class="form-control input-sm" id="Consultant_Days" name="Consultant_Days">
		  </div>

		  <div class="form-group col-sm-6 col-md-6">
		  	 <label for="address" class="control-label text-left">
		  	  Charges</label>
		  	  <div class="input-group"> 
			  <span class="input-group-addon">₹</span>
			  <input data-toggle="tooltip" data-placement="top" title="Enter Total Consultant Charges" type="text" class="form-control input-sm expenses" id="Consultant_Charges" name="Consultant_Charges">
		  </div>
		  	
		  </div>

      </div>
     <div class="clearfix"></div>

      <div class="form-group col-sm-4 col-md-4">
        <label for="address" class="control-label text-left">Routine Investigations</label>
		<div class="input-group"> 
		<span class="input-group-addon">₹</span>
		<input type="text" class="form-control input-sm expenses" id="Routine_Investigations" name="Routine_Investigations">
		</div>
       
      </div>

      <div class="form-group col-sm-4 col-md-4">
	        <label for="address" class="control-label text-left">Medicine & Drugs</label>
			<div class="input-group"> 
			<span class="input-group-addon">₹</span>
			<input type="text" class="form-control input-sm expenses" id="Medicicne_Drugs" name="Medicicne_Drugs">
			</div>
	       
      </div>


      <div class="form-group col-sm-4 col-md-4">
        <label for="address" class="control-label text-left">Major Surgical Operation</label>
        <div class="input-group"> 
			<span class="input-group-addon">₹</span>
			  <input type="text" class="form-control input-sm expenses" id="Major_Surgical" name="Major_Surgical">
			</div>
      
      </div>


      <div class="form-group col-sm-4 col-md-4">
        <label for="address" class="control-label text-left">
        	Intermediate Surg. Operation
        </label>

			<div class="input-group"> 
			<span class="input-group-addon">₹</span>
			<input type="text" class="form-control input-sm expenses" id="Intermediate_Surgical" name="Intermediate_Surgical">
			</div>
      </div>

 
      <div class="form-group col-sm-4 col-md-4">
        <label for="address" class="control-label text-left">Ancillary Services</label>
        <div class="input-group"> 
			<span class="input-group-addon">₹</span>
			 <input type="text" class="form-control input-sm expenses" id="Ancillary_Services" name="Ancillary_Services">
			</div>
       
      </div>

    
      <div class="form-group col-sm-4 col-md-4">
        <label for="address" class="control-label text-left">Post Hospitalization Expenses</label>

			<div class="input-group"> 
			<span class="input-group-addon">₹</span>
			<input type="text" class="form-control input-sm expenses" id="Post_Hospitalization_Expenses" name="Post_Hospitalization_Expenses">
			</div>
      </div>

     <div class="form-group col-md-3 col-sm-3">
        <label for="address">Total Treatment Expenses</label>
			<div class="input-group"> 
			<span class="input-group-addon">₹</span>
			<input readonly type="text" class="form-control input-sm cash_total" id="Total_Treatment_Expenses" name="Total_Treatment_Expenses" value="0">
			</div>
      </div>


      <!-- <div class="form-group col-md-3 col-sm-3">
        <label for="address">Pre Hospitalization Expenses</label>
        <input type="text" class="form-control input-sm numberonly expenses" id="Pre_Hospitalization_Expenses" name="Pre_Hospitalization_Expenses" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Hospitalization Expenses</label>
        <input type="text" class="form-control input-sm numberonly expenses" id="Hospitalization_Expenses" name="Hospitalization_Expenses" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Post Hospitalization Expenses</label>
        <input type="text" class="form-control input-sm numberonly expenses" id="Post_Hospitalization_Expenses" name="Post_Hospitalization_Expenses" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Health Check-Up Cost</label>
        <input type="text" class="form-control input-sm numberonly expenses" id="Health_CheckUp_Cost" name="Health_CheckUp_Cost" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Ambulance Charges</label>
        <input type="text" class="form-control input-sm numberonly expenses" id="Ambulance_Charges" name="Ambulance_Charges" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Others (code)</label>
        <input type="text" class="form-control input-sm numberonly expenses" id="Expenses_Claimed_Others_Code" name="Expenses_Claimed_Others_Code" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Total</label>
        <input type="text" class="form-control input-sm numberonly total_expenses" id="Expenses_Claimed_Total" name="Expenses_Claimed_Total" value="0">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Pre Hospitalization Period ( Days )</label>
        <input type="text" class="form-control input-sm numberonly" id="Pre_Hospitalization_Period" name="Pre_Hospitalization_Period">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Pro Hospitalization Period ( Days )</label>
        <input type="text" class="form-control input-sm numberonly" id="Pro_Hospitalization_Period" name="Pro_Hospitalization_Period">
      </div>

     <div class="form-group col-md-12 col-sm-12">
        <label for="email">
        Claim for Domiciliary Hospitalization &nbsp;&nbsp;
        </label>
        <label class="radio-inline">
        <input type="radio" name="Domiciliary_Hospitalization" value="1">Yes
        </label>
        <label class="radio-inline">
        <input type="radio" name="Domiciliary_Hospitalization" value="0">No
        </label>
        <label for="email">&nbsp;&nbsp;
        (if yes, provide details in annexure)
        </label>
    </div>

    <div class="col-md-12 col-sm-12">
      <label for="email">
        Details of Lump sum / cash benefit claimed
      </label>
    </div>

    <div class="form-group col-md-3 col-sm-3">
        <label for="address">Hospital Daily Cash</label>
        <input type="text" class="form-control input-sm numberonly cash" id="Hospital_Daily_Cash" name="Hospital_Daily_Cash" placeholder="">
    </div>

    <div class="form-group col-md-3 col-sm-3">
        <label for="address">Surgical Cash</label>
        <input type="text" class="form-control input-sm numberonly cash" id="Surgical_Cash" name="Surgical_Cash" placeholder="">
    </div>

    <div class="form-group col-md-3 col-sm-3">
        <label for="address">Critical Illness Benefit</label>
        <input type="text" class="form-control input-sm numberonly cash" id="Critical_Illness_Benefit" name="Critical_Illness_Benefit" placeholder="">
    </div>

    <div class="form-group col-md-3 col-sm-3">
      <label for="address">Convalescence</label>
      <input type="text" class="form-control input-sm numberonly cash" id="Convalescence" name="Convalescence">
    </div>

    <div class="form-group col-md-3 col-sm-3">
        <label for="address">Pre/Post hosp Lump sum benefit</label>
        <input type="text" class="form-control input-sm numberonly cash" id="Hosp_Lump_Sum_Benefit" name="Hosp_Lump_Sum_Benefit">
    </div>

    <div class="form-group col-md-3 col-sm-3">
        <label for="address">Others</label>
        <input type="text" class="form-control input-sm numberonly cash" id="Lump_Sum_Others" name="Lump_Sum_Others">
    </div>

    <div class="form-group col-md-3 col-sm-3">
        <label for="address">Total</label>
        <input type="text" class="form-control input-sm numberonly cash_total" id="Lump_Sum_Total" name="Lump_Sum_Total" value="0">
    </div> -->

  <div class="form-group">
		<div class="col-lg-10 col-lg-offset-5">
		<button class="btn btn-warning back4" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
		<button class="btn btn-primary open4" type="button">Next <span class="fa fa-arrow-right"></span></button></div>
  </div>

	   </div>
	</fieldset>
</div>

<div id="sf5" class="frm" style="display: none;">
   <fieldset>
	<div id="menu5"><br>
	      
	<div id="pageheading" style="text-align: left;">
	      		DETAILS OF BILLS ENCLOSED</div>

	<div class="field_wrapper">

		<div class="col-md-12 col-sm-12">

        <div class="form-group col-md-3 col-sm-3">
            <label for="name">Bill No.</label>
            <input type="text" class="form-control input-sm" name="billno[]">
        </div>

        <div class="form-group col-md-2 col-sm-2">
            <label for="gender">Date</label>
            <input type="text" class="form-control input-sm datepicker" name="billdate[]" placeholder="">
        </div>

        <div class="form-group col-md-3 col-sm-3">
          <label for="age">Issued By</label>
         <input type="text" class="form-control input-sm" name="billissued[]" placeholder="">
        </div>

        <div class="form-group col-md-3 col-sm-3">
            <label for="DOB">Towards</label>
            <input type="text" class="form-control input-sm" name="billtowards[]" placeholder="">
        </div>

         <div class="form-group col-md-3 col-sm-3">
            <label for="DOB">Amount</label>

            <div class="input-group"> 
			  <span class="input-group-addon">₹</span>
			   <input type="text" class="form-control input-sm amount" name="billamount[]" placeholder="">
		    </div>

         </div>

         <div class="form-group col-md-3 col-sm-3">
            <label for="DOB">Bills</label>
            <input type="file" name="bills[]">
         </div>
</div>
</div>
<div class="col-md-12 col-sm-12">
  <div class="form-group col-md-3 col-sm-3">
    <input type='button' class="btn btn-primary" value="Add" id="add"/>
  </div>
</div>

	<div class="form-group">
		<div class="col-lg-10 col-lg-offset-5">
		<button class="btn btn-warning back5" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
		<button class="btn btn-primary open5" type="button">Next <span class="fa fa-arrow-right"></span></button></div>
	</div>
	</div>
   </fieldset>
</div>   

<div id="sf6" class="frm" style="display: none;">
 <fieldset>
   <div id="menu6">
      <br>
      <div id="pageheading" style="text-align: left;">CLAIM DOCUMENTS SUBMITTED - CHECKLIST</div>

		<div class="col-sm-4">
		  <div class="checkbox">
			<label>
				<input name="doc1" id="doc1"  type="checkbox" value="Claim Form duly signed">Claim Form duly signed
			</label>
			<div id="doc1_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(1);">Add Files </a>
			</div>
		  </div>
		</div>

		<div class="col-sm-4">
		  <div class="checkbox">
			<label>
				<input name="doc2" id="doc2" type="checkbox" value="Investigation reports">Investigation reports
			</label>
			<div id="doc2_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(2);">Add Files </a>
			</div>
		  </div>
		</div>

		<div class="col-sm-4">
		  <div class="checkbox">
			<label>
				<input name="doc3" id="doc3" type="checkbox" value="Original Pre-authorization request">Original Pre-authorization request
			</label>
			<div id="doc3_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(3);">Add Files </a>
			</div>
		  </div>
		</div>


		<div class="col-sm-4">
		  <div class="checkbox">
				<label>
				<input name="doc4" id="doc4" type="checkbox" value="CT/ MRI/ USG/ HPE/ Investigation reports">CT/ MRI/ USG/ HPE/ Investigation reports
				</label>
				<div id="doc4_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(4);">Add Files </a>
				</div>
		  </div>
		</div>

		<div class="col-sm-4">
		  <div class="checkbox">
				<label>
				<input name="doc5" id="doc5" type="checkbox" value="Copy of the Pre-authorization approval letter">Copy of the Pre-authorization approval letter
				</label>
				<div id="doc5_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(5);">Add Files </a>
				</div>
		  </div>
		</div>


		<div class="col-sm-4">
		  <div class="checkbox">
				<label>
				<input name="doc6" id="doc6" type="checkbox" value="Doctor's referance slip">Doctor's referance slip
				</label>
				<div id="doc6_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(6);">Add Files </a>
				</div>
		  </div>
		</div>


		<div class="col-sm-4">
		  <div class="checkbox">
				<label>
				<input name="doc7" id="doc7" type="checkbox" value="Copy of photo ID card of patient verified by hospital">Copy of photo ID card of patient verified by hospital
				</label>
				<div id="doc7_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(7);">Add Files </a>
				</div>
		  </div>
		</div>


		<div class="col-sm-4">
		  <div class="checkbox">
				<label>
				<input name="doc8" id="doc8" type="checkbox" value="ECG">ECG
				</label>
				<div id="doc8_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(8);">Add Files </a>
				</div>
		  </div>
		</div>


		<div class="col-sm-4">
		  <div class="checkbox">
				<label>
				<input name="doc9" id="doc9" type="checkbox" value="Hospital discharge summary">Hospital discharge summary
				</label>
				<div id="doc9_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(9);">Add Files </a>
				</div>
		  </div>
		</div>


		<div class="col-sm-4">
		  <div class="checkbox">
				<label>
				<input name="doc10" id="doc10" type="checkbox" value="Pharmacy bills">Pharmacy bills
				</label>
				<div id="doc10_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(10);">Add Files </a>
				</div>
		  </div>
		</div>


		<div class="col-sm-4">
		  <div class="checkbox">
				<label>
				<input name="doc11" id="doc11" type="checkbox" value="Oparation Theatre Notes">Oparation Theatre Notes
				</label>
				<div id="doc11_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(11);">Add Files </a>
				</div>
		  </div>
		</div>


		<div class="col-sm-4">
		  <div class="checkbox">
				<label>
				<input name="doc12" id="doc12" type="checkbox" value="MLC report & Police FIR">MLC report & Police FIR
				</label>
				<div id="doc12_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(12);">Add Files </a>
				</div>
		  </div>
		</div>


		<div class="col-sm-4">
		  <div class="checkbox">
				<label>
				<input name="doc13" id="doc13" type="checkbox" value="Hospital main bil">Hospital main bil
				</label>
				<div id="doc13_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(13);">Add Files </a>
				</div>
		  </div>
		</div>


		<div class="col-sm-4">
		  <div class="checkbox">
				<label>
				<input name="doc14" id="doc14" type="checkbox" value="Original death summary from hospital, where applicable">Original death summary from hospital, where applicable
				</label>
				<div id="doc14_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(14);">Add Files </a>
				</div>
		  </div>
		</div>


	   <div class="col-sm-4">
		  <div class="checkbox">
				<label>
				<input name="doc15" id="doc15" type="checkbox" value="Hospital break-up bill">Hospital break-up bill
				</label>
				<div id="doc15_div" style="display: none;">
				<a href="javascript:void(0)" class="btn btn-primary" onclick="addmoreoption(15);">Add Files </a>
				</div>
		  </div>
		</div>


      <div class="form-group col-sm-6">
		<div class="checkbox">
			<label><input name="doc16" type="checkbox" value="Any other, please specify">Any other, please specify</label>
		</div>
		<div class="col-sm-12">
			<input type="text" class="form-control" name="please_specify">
        </div>
      </div>



      <div style="clear: both;"><br></div>

       <div class="form-group">
			<div class="col-lg-10 col-lg-offset-5">
			<button class="btn btn-warning back6" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
			<button class="btn btn-primary open6" type="button">Next <span class="fa fa-arrow-right"></span></button> 
			</div>
		</div>

   </div>
</fieldset>
</div>

  <div id="sf7" class="frm" style="display: none;">
   <fieldset>
     <div id="menu7">
	 	<br>
 <!--      <div id="pageheading" style="text-align: left;">DETAILS IN CASE OF NON NETWORK HOSPITAL (ONLY FILL IN CASE OF NON NETWORK HOSPITAL)</div>
         <div class="col-sm-12">
		   <label>Address of the hospital</label>
		   <textarea class="form-control" id="NonAddressHospital" name="AddressHospital"></textarea>
         </div>
         <div style="clear: both;"><br></div>
         <div class="col-sm-4">
		   <label>City</label>
		   <input id="NonCity" type="text" class="form-control" name="city">
         </div>
         <div class="col-sm-4">
		   <label>State</label>
		   <input id="NonState" type="text" class="form-control" name="state">
         </div>
         <div class="col-sm-4">
		   <label>Pin Code</label>
		   <input id="NonPinCode" type="text" class="form-control numberonly" name="PinCode">
         </div>
        <div style="clear: both;"><br></div>
        <div class="col-sm-6">
	    <label>Mobile No.</label>
	     <div class="clearfix"></div>
	      <div class="col-sm-2">
		      <input id="NonMobileCode" type="text" maxlength="3" value="+91" class="form-control" name="contcode" id="contcode" style="MARGIN-LEFT: -15PX;">
		    </div>
		    <div class="col-sm-3">
		      <input id="NonMobileAreaCode" type="text" placeholder="Area Code" class="form-control numberonly" maxlength="3" name="areacode" id="areacode">&nbsp;<span class="areacode_errmsg">
		    </div>
		    <div class="col-sm-3">
		      <input id="NonMobilePhoneNo" type="text" placeholder="Phone No" maxlength="8" class="form-control numberonly" name="phoneno" id="phoneno">&nbsp;<span class="phoneno_errmsg">
		    </div>
         </div>
        <div style="clear: both;"><br></div>
		<div class="col-sm-4">
			<label>Registration No. with State Code</label>
			<input id="RegistrationCode" type="text" class="form-control" name="RegistrationCode">
		</div>
        <div class="col-sm-4">
		   <label>Hospital PAN</label>
		   <input id="HospitalPAN" type="text" class="form-control" name="HospitalPAN">
        </div>
        <div class="col-sm-4">
		   <label>Number of Patient Beds</label>
		   <input id="PatientBeds" type="text" class="form-control numberonly" name="PatientBeds">
        </div>
        <div style="clear: both;"><br></div> -->
       <!-- 	     <div class="form-group col-sm-4">
			<label> ICU</label>
			   <div class="form-check">
					<input class="form-check-input" type="radio" name="icu" value="1">
					<label class="form-check-label" for="gridCheck">
						Yes
					</label>
					&nbsp;
					<input class="form-check-input" type="radio" name="icu" value="0">
					<label class="form-check-label" for="gridCheck">
						No
					</label>
			  </div>
	     </div> -->
	      <!-- <div class="col-sm-12">
		   	<label>Others</label>
		   	 <input id="others" type="text" class="form-control" name="others">
          </div> -->
		<div style="clear: both;"><br></div>
			<div id="pageheading" style="text-align: left;">DECLARATION BY THE HOSPITAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Please read very carefully)</div>
				<p style="font-size: 17px;font-style: bold;">We hereby declare that the information furnished in this Claim Form is true & correct to the best of our knowledge and belief. If we have made any false or untrue statement, suppress or concealment of anu material fact, our right to claim under this claim shall be forfeited.</p>
				<div class="col-sm-6">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Date:</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" name="date" id="date" required>
					</div>
				</div>
				<div class="col-sm-6">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Place:</label>
					<div class="col-sm-10">
					<input id="place" type="text" class="form-control" name="place" required>
					</div>
				</div>
			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-5">
				<button class="btn btn-warning back7" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
				<button class="btn btn-primary open7" type="button">Submit </button> 
				<img src="images/spinner.gif" alt="" id="loader" style="display: none">
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
<!-- <script src="js/autoNumeric.min.js"></script> -->

<script src="//unpkg.com/autonumeric"></script>


<script type="text/javascript">

  $('#Network_Provide_Type').click(function () {
	if ($(this).is(':checked')) {
	   $("#network_dtails").show();
	   $("#non_network_dtails").hide();
	}
  });

  $('#Non_Network_Provide_Type').click(function () {
	if ($(this).is(':checked')) {
	   $("#network_dtails").hide();
	   $("#non_network_dtails").show();
	}
  });

  $('#Network_Provider').typeahead({
		displayText: function(item) {
		return item.desc
		},
		afterSelect: function(item) {
		this.$element[0].value = item.desc;
		},
		source: function (query, process) {
		return $.getJSON('ajax/network_provider_type.php', { query: query }, function(data) {
		process(data)
		})
		},
		updater: function (item) {	
			$('#Network_Provider_ID').val(item.Provider_ID);
			$('#Network_Provider_Name').val(item.Provider_Name);
			$('#Network_Registration_No').val(item.Registration_No);
			$('#Network_Doctor_Name').val(item.Doctor_Name);
			$('#Network_Qualification').val(item.Qualification);
			$('#Network_cont_code').val(item.CountryCode);
			$('#Network_area_code').val(item.AreaCode);
			$('#Network_phone_no').val(item.PhoneNo);
        return item;
      }
    });
	
	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip();   
	});
 
  // new AutoNumeric('#Hospital_ID', {
  //   currencySymbol : ' €',
  //   decimalCharacter : ',',
  //   digitGroupSeparator : ',',
  // });


  $('input.expenses').keyup(function(event) {
	  if(event.which >= 37 && event.which <= 40) return;
	  $(this).val(function(index, value) {
	    return value
	    .replace(/\D/g, "")
	    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
	    ;
	  });
  });


  $(document).on("keyup", ".expenses", function() {
	var sum = 0;
	$(".expenses").each(function(){
	if($(this).val() != "")
	sum += parseInt($(this).val().replace(/,/g , '')); 
	});
	$("#Total_Treatment_Expenses").val(sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	// var y = parseInt(document.getElementById("Total_Treatment_Expenses").value);
	$("#TotalClaimedAmount").val(sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

  });


  
  $('.numberonly').bind('keyup paste', function(){
      this.value = this.value.replace(/[^0-9]/g, '');
  });

//Disabled Text

  $('#maternity').click(function () {
	if ($(this).is(':checked')) {
	   $("#DateofDelivery").prop( "disabled",false);
	   $("#GravidaStatus").prop( "disabled",false);
	}
  });

  $('#Emergency').click(function () {
	if ($(this).is(':checked')) {
	   $("#DateofDelivery").prop( "disabled",true);
	   $("#GravidaStatus").prop( "disabled",true);
	}
  });

  $('#Planned').click(function () {
	if ($(this).is(':checked')) {
	   $("#DateofDelivery").prop( "disabled",true);
	   $("#GravidaStatus").prop( "disabled",true);
	}
  });

  $('#DayCare').click(function () {
	if ($(this).is(':checked')) {
	   $("#DateofDelivery").prop( "disabled",true);
	   $("#GravidaStatus").prop( "disabled",true);
	}
  });

  $('#Network').click(function () {
	if ($(this).is(':checked')) {
		$("#NonAddressHospital").prop( "disabled",true);
		$("#NonCity").prop( "disabled",true);
		$("#NonState").prop( "disabled",true);
		$("#NonPinCode").prop( "disabled",true);
		$("#NonMobileCode").prop( "disabled",true);
		$("#NonMobileAreaCode").prop( "disabled",true);
		$("#NonMobilePhoneNo").prop( "disabled",true);
		$("#RegistrationCode").prop( "disabled",true);
		$("#HospitalPAN").prop( "disabled",true);
		$("#PatientBeds").prop( "disabled",true);
		$("#others").prop( "disabled",true);
	}
  });

  $('#NonNetwork').click(function () {
	if ($(this).is(':checked')) {
	   $("#NonAddressHospital").prop( "disabled",false);
	   $("#NonCity").prop( "disabled",false);
	   $("#NonState").prop( "disabled",false);
	   $("#NonPinCode").prop( "disabled",false);
	   $("#NonMobileCode").prop( "disabled",false);
	   $("#NonMobileAreaCode").prop( "disabled",false);
	   $("#NonMobilePhoneNo").prop( "disabled",false);
	   $("#RegistrationCode").prop( "disabled",false);
	   $("#HospitalPAN").prop( "disabled",false);
	   $("#PatientBeds").prop( "disabled",false);
	   $("#others").prop( "disabled",false);
	}
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

	
    $(".datepicker").datepicker({
		dateFormat : 'dd-mm-yy',
		changeMonth : true,
		changeYear : true,
		yearRange: '-100y:c+nn',
		maxDate: '-1d'
    });


     var wrapper = $('.field_wrapper');
     var max_fields = 50;
     var x = 1;
     $('#add').click(function () { 

      if(x < max_fields){
            x++;
		var fieldHTML = '<div class="col-md-12 col-sm-12"><div class="form-group col-md-3 col-sm-3"><label for="name">Bill No.</label><input type="text" class="form-control input-sm" name="billno[]"></div><div class="form-group col-md-3 col-sm-3"><label for="gender">Date</label><input type="text" class="form-control input-sm datepicker" name="billdate[]" placeholder=""></div><div class="form-group col-md-3 col-sm-3"><label for="age">Issued By</label><input type="text" class="form-control input-sm" name="billissued[]" placeholder=""></div><div class="form-group col-md-3 col-sm-3"><label for="DOB">Towards</label><input type="text" class="form-control input-sm" name="billtowards[]" placeholder=""></div><div class="form-group col-md-3 col-sm-3"><label for="DOB">Amount</label> <div class="input-group"> <span class="input-group-addon">₹</span><input type="text" class="form-control input-sm amount" name="billamount[]" placeholder=""></div></div><div class="form-group col-md-3 col-sm-3"><label for="DOB">Bills</label><input type="file" name="bills[]"></div></div>';

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

    $('input.amount').keyup(function(event) {
	  if(event.which >= 37 && event.which <= 40) return;
	  $(this).val(function(index, value) {
	    return value
	    .replace(/\D/g, "")
	    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
	    ;
	  });
  });

    $('body').on('keyup',".amount", function(){
	    if(event.which >= 37 && event.which <= 40) return;
		  $(this).val(function(index, value) {
		    return value
		    .replace(/\D/g, "")
		    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
		    ;
		});
    });


$(document).ready(function() {

	var x_timer; 	
	$("#IP_Registration").keyup(function (e){
		clearTimeout(x_timer);
		var user_name = $(this).val();
		x_timer = setTimeout(function(){
			check_username_ajax(user_name);
		}, 1000);
	});	

	function check_username_ajax(username){

		     //$("#user-result").html('<img src="images/bx_loader.gif"/>');

		     var dataString = "Policy_No="+username;

		      $.ajax({
                type: 'POST',
                url: 'ajax/get_patient_details.php',
                data: dataString,
                datatype: 'json',
                success: function (data) {
                	//$("#user-result").html('');
					var data1 = $.parseJSON(data);
					if(data1.status == 'ok'){

						//alert(data1.result.Sex);

					$("#user-result").hide();
					$('#Patient_Name').val(data1.result.First_Name);
					$('#Patient_Last_Name').val(data1.result.Last_Name);
					$('#DateofBirth').val(data1.result.Date_Of_Birth);

                    $('#Age').html(data1.result.Age);

					if(data1.result.Sex == 'Male'){
						$('#Male').attr('checked','checked');	
					}
					if(data1.result.Sex == 'Female'){
						$("#Female").attr('checked','checked');	
					}
					if(data1.result.Sex == 'Transgende'){
						$("#Transgender").attr('checked','checked');
					}

					}else{

						$("#user-result").show();
						$('#Patient_Name').val('');
						$('#Patient_Last_Name').val('');
						$('#DateofBirth').val('');
                        $('#Age').html('');
                        $('#Male').attr('checked',false);
                        $("#Female").attr('checked',false);
                        $("#Transgender").attr('checked',false);
					} 
				}
                
             });
    }

});
	$("#doc1").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc1_div").show();
	    } else {
	        $("#doc1_div").hide();
	    }
	});

	$("#doc2").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc2_div").show();
	    } else {
	        $("#doc2_div").hide();
	    }
	});

	$("#doc3").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc3_div").show();
	    } else {
	        $("#doc3_div").hide();
	    }
	});

	$("#doc4").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc4_div").show();
	    } else {
	        $("#doc4_div").hide();
	    }
	});


	$("#doc5").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc5_div").show();
	    } else {
	        $("#doc5_div").hide();
	    }
	});

	$("#doc6").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc6_div").show();
	    } else {
	        $("#doc6_div").hide();
	    }
	});

	$("#doc7").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc7_div").show();
	    } else {
	        $("#doc7_div").hide();
	    }
	});

	$("#doc8").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc8_div").show();
	    } else {
	        $("#doc8_div").hide();
	    }
	});

	$("#doc9").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc9_div").show();
	    } else {
	        $("#doc9_div").hide();
	    }
	});

	$("#doc10").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc10_div").show();
	    } else {
	        $("#doc10_div").hide();
	    }
	});

	$("#doc11").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc11_div").show();
	    } else {
	        $("#doc11_div").hide();
	    }
	});

	$("#doc12").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc12_div").show();
	    } else {
	        $("#doc12_div").hide();
	    }
	});

	$("#doc13").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc13_div").show();
	    } else {
	        $("#doc13_div").hide();
	    }
	});

	$("#doc14").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc14_div").show();
	    } else {
	        $("#doc14_div").hide();
	    }
	});

	$("#doc15").click(function() {
	    if($(this).is(":checked")) {
	        $("#doc15_div").show();
	    } else {
	        $("#doc15_div").hide();
	    }
	});


	function addmoreoption(id){
		var Id = id;
		var uniq = new Date().getTime();
		var slno  = "<div id='"+uniq+"'><input style='float:left;' name='file_doc"+Id+"[]' type='file'/><a class='btn btn-info btn-lg' style='padding-top: 4px;padding-left:5px;height: 25px;width: 25px; font-size:14px;' href='javascript:void(0);' onclick='delete_image_file("+uniq+")'><span class='glyphicon glyphicon-remove'></span></a></div>";
		$("#doc"+Id+"_div").append(slno);
	}

	function delete_image_file(elem){
		$('#'+elem).remove();  
	}



  jQuery().ready(function() {
    var v = jQuery("#basicform").validate({
      	rules: {
       		        Claim_Type: "required",
					Provide_Type: "required",
					area_code : "required",
					phone_no : "required",
					cont_code : "required",
					Patient_Name: "required",
					Patient_Last_Name: "required",
					IP_Registration: {
	 						required: true
		                    },
					DateofBirth:"required",
					DateofAdmission:"required",
					DateofDischarge:"required",
					ClaimedAmount:"required",
					ICD1 : "required",
					PCS1 : "required",
					date:"required",
					place:"required"
				},
				messages: {

					Claim_Type: "Please Select Claim Type<br/>",
					Provide_Type: "Please Select Provider Type<br/>",
					area_code: "Please Enter Area Code.",
					phone_no: "Please Enter Phone No.",
					Patient_Name: "Please Enter Patient First Name.",
					Patient_Last_Name: "Please Enter Patient Last Name.",
					IP_Registration:
						{
     					required:  "Please Enter User Patient Policy ID.",
     					digits: "this field can only contain numbers"
 						},
					DateofBirth: "Please Enter Date Of Birth.",
					DateofAdmission: "Please Enter Date Of Admission.",
					DateofDischarge: "Please Enter Date Of Discharge.",
					ClaimedAmount: "Please Enter Claimed Amount.",
					date: "Please Enter Declaration Date.",
					place: "Please Enter Declaration Place."
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					//error.addClass( "help-block" );

					if ( element.is(":radio") ) 
		            {
		                error.appendTo( element.parents('.container') );
		            }else {
						error.insertAfter( element );
					}

			// if ( element.prop( "type" ) === "checkbox" ) {
			// 	error.insertAfter( element.parent( "label" ) );
			// } else {
			// 	error.insertAfter( element );
			// }

				},
				highlight: function ( element, errorClass, validClass ) {
					// $( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					// $( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
				}
    });

    $(".open1").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf2").show("slow");
      }
    });

    $(".open2").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf3").show("slow");
      }
    });

     $(".open3").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf4").show("slow");
      }
    });

     $(".open4").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf5").show("slow");
      }
    });

     $(".open5").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf6").show("slow");
      }
    });

     $(".open6").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf7").show("slow");
      }
    });

    $(".open7").click(function() {
      if (v.form()) {
        $("#loader").show();
         setTimeout(function(){
           $( "#basicform" ).submit();
         }, 1000);
        return false;
      }
    });
    
    $(".back2").click(function() {
      $(".frm").hide("fast");
      $("#sf1").show("slow");
    });

    $(".back3").click(function() {
      $(".frm").hide("fast");
      $("#sf2").show("slow");
    });

    $(".back4").click(function() {
      $(".frm").hide("fast");
      $("#sf3").show("slow");
    });

     $(".back5").click(function() {
      $(".frm").hide("fast");
      $("#sf4").show("slow");
    });

    $(".back6").click(function() {
      $(".frm").hide("fast");
      $("#sf5").show("slow");
    });

    $(".back7").click(function() {
      $(".frm").hide("fast");
      $("#sf6").show("slow");
    });

  });

  $('#DateofTime').timepicker();

  $('#TimeofDischarge').timepicker();

$(document).ready(function () {

  $("#area_code").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $(".area_code_errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
   });

  $("#phone_no").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $(".phone_no_errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
   });

  $("#areacode").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $(".areacode_errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
   });

  $("#phoneno").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $(".phoneno_errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
   });

  $("#ClaimedAmount").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $(".amount_errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
   });

});

/**************************diagnosis********************/
	$('#ICD1').typeahead({
		displayText: function(item) {
		return item.label
		},
		afterSelect: function(item) {
		this.$element[0].value = item.value;
		},
		source: function (query, process) {
		return $.getJSON('ajax_diagnosis_code.php', { query: query }, function(data) {
		process(data)
		})
		},
		updater: function (item) {
			$('#des_1').html(item.desc);
			$('#ICD1_Status').html(item.status);
        	return item;
      }
    });

	$('#ICD2').typeahead({
		displayText: function(item) {
		return item.label
		},
		afterSelect: function(item) {
		this.$element[0].value = item.value;
		},
		source: function (query, process) {
		return $.getJSON('ajax_diagnosis_code.php', { query: query }, function(data) {
		process(data)
		})
		},
		updater: function (item) {
		$('#des_2').html(item.desc);
		$('#ICD2_Status').html(item.status);
        return item;
      }
    });

	$('#ICD3').typeahead({
		displayText: function(item) {
		return item.label
		},
		afterSelect: function(item) {
		this.$element[0].value = item.value;
		},
		source: function (query, process) {
		return $.getJSON('ajax_diagnosis_code.php', { query: query }, function(data) {
		process(data)
		})
		},
		updater: function (item) {
		$('#des_3').html(item.desc);
		$('#ICD3_Status').html(item.status);
        return item;
      }
    });

	$('#ICD4').typeahead({
		displayText: function(item) {
		return item.label
		},
		afterSelect: function(item) {
		this.$element[0].value = item.value;
		},
		source: function (query, process) {
		return $.getJSON('ajax_diagnosis_code.php', { query: query }, function(data) {
		process(data)
		})
		},
		updater: function (item) {
		$('#des_4').html(item.desc);
		$('#ICD4_Status').html(item.status);
        return item;
      }
    });
	/**************************diagnosis********************/
	$('#PCS1').typeahead({
		displayText: function(item) {
		return item.label
		},
		afterSelect: function(item) {
		this.$element[0].value = item.value
		},
		source: function (query, process) {
		return $.getJSON('ajax_procedure_code.php', { query: query }, function(data) {
		process(data)
		})
		},
		updater: function (item) {
		$('#desp_1').html(item.desc);
		$('#PCS1_Status').html(item.status);
        return item;
      }
    });

	$('#PCS2').typeahead({
		displayText: function(item) {
		return item.label
		},
		afterSelect: function(item) {
		this.$element[0].value = item.value
		},
		source: function (query, process) {
		return $.getJSON('ajax_procedure_code.php', { query: query }, function(data) {
		process(data)
		})
		},
		updater: function (item) {
		$('#desp_2').html(item.desc);
		$('#PCS2_Status').html(item.status);
        return item;
      }
    });

	$('#PCS3').typeahead({
		displayText: function(item) {
		return item.label
		},
		afterSelect: function(item) {
		this.$element[0].value = item.value
		},
		source: function (query, process) {
		return $.getJSON('ajax_procedure_code.php', { query: query }, function(data) {
		process(data)
		})
		},
		updater: function (item) {
		$('#desp_3').html(item.desc);
		$('#PCS3_Status').html(item.status);
        return item;
      }
    });

	$('#PCS4').typeahead({
		displayText: function(item) {
		return item.label
		},
		afterSelect: function(item) {
		this.$element[0].value = item.value
		},
		source: function (query, process) {
		return $.getJSON('ajax_procedure_code.php', { query: query }, function(data) {
		process(data)
		})
		},
		updater: function (item) {
		$('#desp_4').html(item.desc);
		$('#PCS4_Status').html(item.status);
        return item;
      }
    });

	$("#DateofBirth").keypress(function(event) {event.preventDefault();});

	$("#DateofAdmission").keypress(function(event) {event.preventDefault();});

	$("#DateofDischarge").keypress(function(event) {event.preventDefault();});

	$("#DateofDelivery").keypress(function(event) {event.preventDefault();});

	$("#date").keypress(function(event) {event.preventDefault();});

    
    $(function() {
        $( "#DateofBirth" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });
    $(function() {
        $( "#DateofAdmission" ).datepicker({
             dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });
    $(function() {
        $( "#DateofDischarge" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });
    $(function() {
        $( "#DateofDelivery" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });
    $(function() {
        $( "#date" ).datepicker({
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
        var currentpage = "claim_form1";
        $('#'+currentpage).addClass('active');
        $('#plapiper_pagename').html("Claim From B");
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