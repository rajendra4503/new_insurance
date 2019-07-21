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
if (!empty($_POST['Hospital_Name']) !='' && !empty($_POST['Patient_Name']) !='' && !empty($_POST['IP_Registration']) !='') {
	//Hospital Details
	$Hospital_Name = escape_string($_POST['Hospital_Name']);
	$Hospital_ID = escape_string($_POST['Hospital_ID']);
	$hospital_type = escape_string($_POST['hospital_type']);
	$Doctor_Name = escape_string($_POST['Doctor_Name']);
	$Qualification = escape_string($_POST['Qualification']);
	$Registration_No = escape_string($_POST['Registration_No']);
	$cont_code = escape_string($_POST['cont_code']);
	$phone_no = escape_string($_POST['phone_no']);
	$area_code = escape_string($_POST['area_code']);
	// $date = escape_string($_POST['date']);
	$date = date("Y-m-d", strtotime($_POST['date']));
	$place = escape_string($_POST['place']);
	//Patient Details
	$Patient_Name      =    escape_string($_POST['Patient_Name']);

	$Patient_Last_Name =    escape_string($_POST['Patient_Last_Name']);

	$IP_Registration = escape_string($_POST['IP_Registration']);
	$gender = escape_string($_POST['gender']);
	$DateofBirth = date("Y-m-d", strtotime($_POST['DateofBirth']));
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
	$status_time = escape_string($_POST['status_time']);
	$ClaimedAmount = escape_string($_POST['ClaimedAmount']);
	$q = mysql_query("SELECT max(Claim_ID) as LastClaimID FROM patient_details");
	$value = mysql_fetch_object($q);
	if($value->LastClaimID != 0){
    	$new_id = substr($value->LastClaimID,4);
    	$Claim_ID =  date("Y").$new_id+1;
     }else{
         $Claim_ID =  date("Y").'00000001';
     }
	$Patient_ID = 'PID-'.substr(str_shuffle("0123456789"), 0,5);
	$patient_query = "INSERT INTO patient_details (Patient_ID,Claim_ID,Patient_Name,Patient_Last_Name,Policy_No,Gender,Date_of_Birth,Date_of_Admission, Time_of_Admission,Date_of_Discharge,Time_of_Discharge,Type_of_Admission,Date_of_Delivery,Gravida_Status,Status_Time_of_Discharge,Total_Claimed_Amount,CreatedDate,CreatedBy) VALUES (
	'$Patient_ID', '$Claim_ID', '$Patient_Name','$Patient_Last_Name','$IP_Registration', '$gender', '$DateofBirth', '$DateofAdmission', '$DateofTime', '$DateofDischarge', '$TimeofDischarge', '$type_admission', '$DateofDelivery', '$GravidaStatus', '$status_time','$ClaimedAmount',now(),'$logged_userid')";
		if (mysql_query($patient_query))
		{

				$hospital_query = "INSERT INTO `hospital_details` (`Claim_ID`, `Hospital_Name`, `Hospital_ID`,`Doctor_Name`,`Qualification`,`Network_Type`,`Registration_No`, `Country_Code`, `Area_Code`, `Phone_No`,`Declaration_Date`,`Declaration_Place`,`CreatedDate`, `CreatedBy`) VALUES ('$Claim_ID', '$Hospital_Name', '$Hospital_ID','$Doctor_Name','$Qualification','$hospital_type','$Registration_No', '$cont_code', '$area_code', '$phone_no','$date','$place',now(),'$logged_userid')";

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
		
		$Pre_Hospitalization_Expenses = $_POST['Pre_Hospitalization_Expenses']; 
		$Hospitalization_Expenses = $_POST['Hospitalization_Expenses'];
		$Post_Hospitalization_Expenses = $_POST['Post_Hospitalization_Expenses'];
		$Health_CheckUp_Cost = $_POST['Health_CheckUp_Cost'];
		$Ambulance_Charges = $_POST['Ambulance_Charges'];
		$Expenses_Claimed_Others_Code = $_POST['Expenses_Claimed_Others_Code'];
		$Expenses_Claimed_Total = $_POST['Expenses_Claimed_Total'];
		$Pre_Hospitalization_Period = $_POST['Pre_Hospitalization_Period'];
		$Pro_Hospitalization_Period = $_POST['Pro_Hospitalization_Period'];
		$Domiciliary_Hospitalization = $_POST['Domiciliary_Hospitalization'];
		$Hospital_Daily_Cash = $_POST['Hospital_Daily_Cash'];
		$Surgical_Cash = $_POST['Surgical_Cash'];
		$Critical_Illness_Benefit = $_POST['Critical_Illness_Benefit'];
		$Convalescence = $_POST['Convalescence'];
		$Hosp_Lump_Sum_Benefit = $_POST['Hosp_Lump_Sum_Benefit'];
		$Lump_Sum_Others = $_POST['Lump_Sum_Others'];
		$Lump_Sum_Total = $_POST['Lump_Sum_Total'];

        $patient_claims_detail = "INSERT INTO `patient_claim_details` (`Claim_ID`, `Pre_Hospitalization_Expenses`, `Hospitalization_Expenses`, `Post_Hospitalization_Expenses`, `Health_Check_Up_Cost`, `Ambulance_Charges`, `Expenses_Claimed_Others_Code`, `Expenses_Claimed_Total`, `Pre_Hospitalization_Period`, `Pro_Hospitalization_Period`, `Domiciliary_Hospitalization`, `Hospital_Daily_Cash`, `Surgical_Cash`, `Critical_Illness_Benefit`, `Convalescence`, `Hosp_Lump_Sum_Benefit`, `Lump_Sum_Others`, `Lump_Sum_Total`, `CreatedDate`,`CreatedBy`) VALUES ('$Claim_ID', '$Pre_Hospitalization_Expenses', '$Hospitalization_Expenses', '$Post_Hospitalization_Expenses', '$Health_CheckUp_Cost', '$Ambulance_Charges', '$Expenses_Claimed_Others_Code', '$Expenses_Claimed_Total', '$Pre_Hospitalization_Period', '$Pro_Hospitalization_Period', '$Domiciliary_Hospitalization', '$Hospital_Daily_Cash', '$Surgical_Cash', '$Critical_Illness_Benefit','$Convalescence','$Hosp_Lump_Sum_Benefit','$Lump_Sum_Others','$Lump_Sum_Total',now(),'$logged_userid')";

            mysql_query($patient_claims_detail);

      for($i = 0 ; $i < count($_POST['billno']) ; $i++){

		$billno = mysql_real_escape_string($_POST['billno'][$i]);
		$billdate = mysql_real_escape_string($_POST['billdate'][$i]);
		$billissued  = mysql_real_escape_string( $_POST['billissued'][$i] );
		$billtowards = mysql_real_escape_string($_POST['billtowards'][$i]);
		$billamount = mysql_real_escape_string($_POST['billamount'][$i]);
     	$patient_claim_bill_enclosed = "INSERT INTO `patient_claim_bill_enclosed` (`Claim_ID`, `Bill_No`, `Bill_Date`, `Bill_Issued`, `Bill_Towards`, `Bill_Amount`, `CreatedDate`, `CreatedBy`) VALUES ('$Claim_ID', '$billno', '$billdate', '$billissued','$billtowards', '$billamount',now(), '$logged_userid')";
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
		            $AddressHospital = $_POST['AddressHospital'];
		            $city = $_POST['city'];
		            $state = $_POST['state'];
		            $PinCode = $_POST['PinCode'];
		            $contcode = $_POST['contcode'];
		            $areacode = $_POST['areacode'];
		            $phoneno = $_POST['phoneno'];
		            $RegistrationCode = $_POST['RegistrationCode'];
		            $HospitalPAN = $_POST['HospitalPAN'];
		            $PatientBeds = $_POST['PatientBeds'];
		            $icu = $_POST['icu'];
		            $OT = $_POST['OT'];
		            $others = $_POST['others'];
		            $non_hospital_query = "INSERT INTO `non_network_hospital` (`Claim_ID`, `Hospital_Address`, `City`, `State`, `Pin_Code`, `CountryCode`, `AreaCode`, `PhoneNo`, `Registration_No`, `Hospital_PAN`, `Beds`, `OT`, `ICU`, `Others`, `CreatedDate`, `CreatedBy`) VALUES ('$Claim_ID', '$AddressHospital', '$city', '$state', '$PinCode', '$contcode', ' $areacode', '$phoneno', '$RegistrationCode', '$HospitalPAN', '$PatientBeds', '$icu', '$OT', '$others',now(), '$logged_userid')";
		            

						if(mysql_query($non_hospital_query)){

						$Patient_Name = $Patient_Name.' '.$Patient_Last_Name;
							sendMail($Claim_ID, $Patient_Name,$IP_Registration);

						$msg = 'Patient Data Submited Successfully.';

						}else{
							$msg = '';
						}
    		    
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
		<title>eTPA - Plan Users</title>
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
			<?php $title = "CLAIM FORM - PART B"; ?>
			<span style="padding-left:0px;">
				<?php echo $title;?>  <?php if(isset($PatientList) &&  $PatientList !=''){echo '('.$PatientList.')';}?>  
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
			<div id="pageheading" style="text-align: left;">DETAILS OF HOSPITAL</div>
			<div class="form-group col-sm-12">
				<label>Name of the Hospital</label>
				<input type="text" class="form-control" name="Hospital_Name" required>
			</div>
			<div class="form-group col-sm-6">
				<label>Hospital ID</label>
				<input type="text" class="form-control" name="Hospital_ID">
			</div>

	      <div class="form-group col-sm-6">
		    <label>Type of Hospital</label>
				<div class="form-check">
				<input class="form-check-input" type="radio" name="hospital_type" value="1">
					<label class="form-check-label" for="gridCheck">
						Network
					</label>
					   &nbsp;&nbsp;
					<input class="form-check-input" type="radio" name="hospital_type" value="0">
					<label class="form-check-label" for="gridCheck">
					   Non Network 
					</label>
				</div>
	    </div>
	    <div class="clearfix"></div>
	    <div class="form-group col-sm-6">
		    <label>Name of the treating Doctor</label>
		    <input type="text" class="form-control" name="Doctor_Name">
	    </div>
	    <div class="form-group col-sm-6">
		    <label>Qualification</label>
		    <input type="text" class="form-control" name="Qualification">
	    </div>
	    <div class="form-group col-sm-6">
		   <label>Registration No. with state code</label>
		   <input type="text" class="form-control" name="Registration_No" id="Registration_No">
	    </div>
	    <div class="form-group col-sm-6">
		    <label>Mobile No.</label>
		     <div class="clearfix"></div>
		    <div class="col-sm-2" style="margin-left: -15px;">
		      <input type="text" maxlength="3" value="+91" class="form-control" name="cont_code" id="cont_code" required> 
		    </div>
		    <div class="col-sm-3">
		      <input type="text" placeholder="Area Code" class="form-control numberonly" maxlength="3" name="area_code" id="area_code" required>&nbsp;<span class="area_code_errmsg">
		    </div>
		    <div class="col-sm-3">
		      <input type="text" placeholder="Phone No" maxlength="8" class="form-control numberonly" name="phone_no" id="phone_no" required>&nbsp;<span class="phone_no_errmsg">
		    </div>
	    </div>
			<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
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
    <div id="pageheading" style="text-align: left;">DETAILS OF PATIENT ADMITTED	</div>
     <div class="form-group col-sm-6">
	    <label>Patient First Name </label>
	    <input type="text" class="form-control" name="Patient_Name" id="Patient_Name" required>
    </div>
	<div class="form-group col-sm-6">
	    <label>Patient Last Name </label>
	    <input type="text" class="form-control" id="Patient_Last_Name" name="Patient_Last_Name" required>
    </div>
    <div class="form-group col-sm-3">
	    <label>Insurance Policy Number.</label>
	    <input type="text" class="form-control numberonly"  id="IP_Registration"  maxlength="10" name="IP_Registration" required>
    </div>
    <div class="form-group col-sm-2" style="margin-top: 30px;">
    	 <label>&nbsp;&nbsp;</label>
    	<span id="user-result"></span>
    </div>

    <div class="form-group col-sm-6">
	    <label>Gender</label>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="gender" value="M">
				<label class="form-check-label" for="gridCheck">
					Male
				</label>
				&nbsp;&nbsp;
				<input class="form-check-input" type="radio" name="gender" value="F">
				<label class="form-check-label" for="gridCheck">
				    Female
				</label>
				&nbsp;&nbsp;
				<input class="form-check-input" type="radio" name="gender" value="T">
				<label class="form-check-label" for="gridCheck">
				    Transgender
				</label>
			</div>
    </div>
    <div style="clear:both;"></div>
	<div class="form-group col-sm-4">
		<label>Date of Birth </label>
		<input type="text" class="form-control" name="DateofBirth" id="DateofBirth" required>
	</div>
    <div class="form-group col-sm-4">
	    <label>Date of Admission </label>
		<input type="text" class="form-control" name="DateofAdmission" id="DateofAdmission" required>
    </div>
    <div class="form-group col-sm-4">
	    <label>Time </label>
		<input id="DateofTime" name="DateofTime" type="text" class="form-control input-small">
    </div>
    <div style="clear:both;"></div>
    <div class="form-group col-sm-4">
	    <label>Date of Discharge </label>
		<input type="text" class="form-control" name="DateofDischarge" id="DateofDischarge" required>
    </div>
    <div class="form-group col-sm-4">
	    <label>Time</label>
		<input name="TimeofDischarge" id="TimeofDischarge" type="text" class="form-control input-small">
    </div>
    <div class="form-group col-sm-4">
	    <label>Type of Admission</label>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="type_admission" value="E">
				<label class="form-check-label" for="gridCheck">
					Emergency
				</label>
				&nbsp;
				<input class="form-check-input" type="radio" name="type_admission" value="P">
				<label class="form-check-label" for="gridCheck">
				    Planned
				</label>
				&nbsp;
				<input class="form-check-input" type="radio" name="type_admission" value="D">
				<label class="form-check-label" for="gridCheck">
				    Day Care
				</label>
				&nbsp;
				<input class="form-check-input" type="radio" name="type_admission" value="M">
				<label class="form-check-label" for="gridCheck">
				    Maternity
				</label>
			</div>
    </div>
    <div style="clear:both;"></div>
    	<label style="margin-left: 15px;">If Maternity</label>
    <div style="clear:both;"></div>	
	<div class="col-sm-3 form-group">
		<label>Date of Delivery </label>
		<input type="text" class="form-control" name="DateofDelivery" id="DateofDelivery">
	</div>
	<div class="col-sm-2 form-group">
		<label>Gravida Status</label>
		<input type="text" class="form-control" name="GravidaStatus">
	</div>
    <div class="form-group col-sm-7">
	    <label>Status at time of Discharge :</label>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="status_time" value="H">
				<label class="form-check-label" for="gridCheck">
					Discharged at Home
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
    <div style="clear:both;"></div>
    <div class="form-group col-sm-4">
	   <label>Total Claimed Amount</label>
	   <input type="text" class="form-control numberonly" id ="ClaimedAmount" name="ClaimedAmount" required> &nbsp;<span class="amount_errmsg">
    </div>

		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
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
		<div class="col-sm-6">
			<label>Primary Diagnosis ( ICD 10 Codes ) </label>
			<input type="text" id="ICD1" name="diagnosis[]" class="form-control diagnosis" required>
			<p id="des_1" class="dia_des"></p>
		</div>
    	<div class="col-sm-6">
		    <label>Procedure ( ICD 10 PCS )</label>
			<input type="text" id="PCS1" name="procedure[]" class="form-control procedure" required>
			<p id="desp_1" class="dia_des"></p>
        </div>
        <div style="clear:both;"><br></div>
        <div class="col-sm-6">
			<label>Additional Diagnosis ( ICD 10 Codes ) </label>
			 <input type="text" id="ICD2" name="diagnosis[]" class="form-control diagnosis">
			 <p id="des_2" class="dia_des"></p>
		</div>
    	<div class="col-sm-6">
		    <label>Procedure ( ICD 10 PCS )</label>
			<input type="text" id="PCS2" name="procedure[]" class="form-control procedure">
			<p id="desp_2" class="dia_des"></p>
        </div>
        <div style="clear:both;"><br></div>
        <div class="col-sm-6">
			<label>Co-Morbidities ( ICD 10 Codes ) </label>
			 <input type="text" id="ICD3" name="diagnosis[]" class="form-control diagnosis">
			 <p id="des_3" class="dia_des"></p>
		</div>
    	<div class="col-sm-6">
		    <label>Procedure ( ICD 10 PCS )</label>
			<input type="text" id="PCS3" name="procedure[]" class="form-control procedure">
			<p id="desp_3" class="dia_des"></p>
        </div>
        <div style="clear:both;"><br></div>
        <div class="col-sm-6">
			<label>Co-Morbidities ( ICD 10 Codes ) </label>
			 <input type="text" id="ICD4" name="diagnosis[]" class="form-control diagnosis">
			 <p id="des_4" class="dia_des"></p>
		</div>
    	<div class="col-sm-6">
		    <label>Details of Procedure</label>
			<input type="text" id="PCS4" name="procedure[]" class="form-control procedure">
			<p id="desp_4" class="dia_des"></p>
        </div>
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
		    <label>If Authorization By Network Hospital not Obtained ,Give Reason </label>
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
		    <label>If yes,give cause</label>
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
			    <label>If injurydue to Substance abuse / alcohol consumption, Test Conducted to establish this </label>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="injury_reason" value="1">
					<label class="form-check-label" for="gridCheck">Yes
					</label>
					&nbsp;
					<input class="form-check-input" type="radio" name="injury_reason" value="0">
					<label class="form-check-label" for="gridCheck">No
					</label>
					<label class="form-check-label" for="gridCheck">
					&nbsp; &nbsp;(if yesy , attach reports)
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
			<label>If not Reported to  Police,give reason :</label>
			<textarea class="form-control" name="report_reason"></textarea>
		</div>

        <div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
			<button class="btn btn-warning back3" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
			<button class="btn btn-primary open3" type="button">Next <span class="fa fa-arrow-right"></span></button> 
			</div>
		</div>
      </div>
  </fieldset>
</div>

<div id="sf4" class="frm" style="display: none;">
	 <fieldset>
	   <div id="menu4">
	      <br>
	      <div id="pageheading" style="text-align: left;">DETAILS OF CLAIM</div>

	<div class="form-group col-md-12 col-sm-12">
      <label for="email">
         Details of treatment expenses claimed
      </label>
    </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Pre Hospitalization Expenses</label>
        <input type="text" class="form-control input-sm numberonly" id="Pre_Hospitalization_Expenses" name="Pre_Hospitalization_Expenses" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Hospitalization Expenses</label>
        <input type="text" class="form-control input-sm numberonly" id="Hospitalization_Expenses" name="Hospitalization_Expenses" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Post Hospitalization Expenses</label>
        <input type="text" class="form-control input-sm numberonly" id="Post_Hospitalization_Expenses" name="Post_Hospitalization_Expenses" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Health Check-Up Cost</label>
        <input type="text" class="form-control input-sm numberonly" id="Health_CheckUp_Cost" name="Health_CheckUp_Cost" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Ambulance Charges</label>
        <input type="text" class="form-control input-sm numberonly" id="Ambulance_Charges" name="Ambulance_Charges" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Others (code)</label>
        <input type="text" class="form-control input-sm numberonly" id="Expenses_Claimed_Others_Code" name="Expenses_Claimed_Others_Code" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Total</label>
        <input type="text" class="form-control input-sm numberonly" id="Expenses_Claimed_Total" name="Expenses_Claimed_Total" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Pre Hospitalization Period</label>
        <input type="text" class="form-control input-sm numberonly" id="Pre_Hospitalization_Period" name="Pre_Hospitalization_Period" placeholder="Days">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Pro Hospitalization Period</label>
        <input type="text" class="form-control input-sm numberonly" id="Pro_Hospitalization_Period" name="Pro_Hospitalization_Period" placeholder="Days">
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
        <input type="text" class="form-control input-sm numberonly" id="Hospital_Daily_Cash" name="Hospital_Daily_Cash" placeholder="">
    </div>

    <div class="form-group col-md-3 col-sm-3">
        <label for="address">Surgical Cash</label>
        <input type="text" class="form-control input-sm numberonly" id="Surgical_Cash" name="Surgical_Cash" placeholder="">
    </div>

    <div class="form-group col-md-3 col-sm-3">
        <label for="address">Critical Illness Benefit</label>
        <input type="text" class="form-control input-sm numberonly" id="Critical_Illness_Benefit" name="Critical_Illness_Benefit" placeholder="">
    </div>

    <div class="form-group col-md-3 col-sm-3">
        <label for="address">Convalescence</label>
        <input type="text" class="form-control input-sm numberonly" id="Convalescence" name="Convalescence" placeholder="">
    </div>

    <div class="form-group col-md-3 col-sm-3">
        <label for="address">Pre/Post hosp Lump sum benefit</label>
        <input type="text" class="form-control input-sm numberonly" id="Hosp_Lump_Sum_Benefit" name="Hosp_Lump_Sum_Benefit" placeholder="">
    </div>

    <div class="form-group col-md-3 col-sm-3">
        <label for="address">Others</label>
        <input type="text" class="form-control input-sm numberonly" id="Lump_Sum_Others" name="Lump_Sum_Others" placeholder="">
    </div>

    <div class="form-group col-md-3 col-sm-3">
        <label for="address">Total</label>
        <input type="text" class="form-control input-sm numberonly" id="Lump_Sum_Total" name="Lump_Sum_Total" placeholder="">
    </div>

    <div class="form-group">
		<div class="col-lg-10 col-lg-offset-2">
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

        <div class="form-group col-md-2 col-sm-2">
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

         <div class="form-group col-md-2 col-sm-2">
            <label for="DOB">Amount</label>
            <input type="text" class="form-control input-sm numberonly" name="billamount[]" placeholder="">
        </div>
</div>

<div class="col-md-12 col-sm-12">
  <div class="form-group col-md-3 col-sm-3">
    <input type='button' class="btn btn-primary" value="Add" id="add"/>
  </div>
</div>

	<div class="form-group">
		<div class="col-lg-10 col-lg-offset-2">
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
			<div class="col-lg-10 col-lg-offset-2">
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
      <div id="pageheading" style="text-align: left;">DETAILS IN CASE OF NON NETWORK HOSPITAL (ONLY FILL IN CASE OF NON NETWORK HOSPITAL)</div>
         <div class="col-sm-12">
		   <label>Address of the hospital</label>
		   <textarea class="form-control" name="AddressHospital"></textarea>
         </div>
         <div style="clear: both;"><br></div>
         <div class="col-sm-4">
		   <label>City</label>
		   <input type="text" class="form-control" name="city">
         </div>
         <div class="col-sm-4">
		   <label>State</label>
		   <input type="text" class="form-control" name="state">
         </div>
         <div class="col-sm-4">
		   <label>Pin Code</label>
		   <input type="text" class="form-control numberonly" name="PinCode">
         </div>
        <div style="clear: both;"><br></div>
        <div class="col-sm-6">
	    <label>Mobile No.</label>
	     <div class="clearfix"></div>
	      <div class="col-sm-2">
		      <input type="text" maxlength="3" value="+91" class="form-control" name="contcode" id="contcode" style="MARGIN-LEFT: -15PX;">
		    </div>
		    <div class="col-sm-3">
		      <input type="text" placeholder="Area Code" class="form-control numberonly" maxlength="3" name="areacode" id="areacode">&nbsp;<span class="areacode_errmsg">
		    </div>
		    <div class="col-sm-3">
		      <input type="text" placeholder="Phone No" maxlength="8" class="form-control numberonly" name="phoneno" id="phoneno">&nbsp;<span class="phoneno_errmsg">
		    </div>
         </div>
        <div style="clear: both;"><br></div>
		<div class="col-sm-4">
			<label>Registration No. with State Code</label>
			<input type="text" class="form-control" name="RegistrationCode">
		</div>
        <div class="col-sm-4">
		   <label>Hospital PAN</label>
		   <input type="text" class="form-control" name="HospitalPAN">
        </div>
        <div class="col-sm-4">
		   <label>Number of Patient Beds</label>
		   <input type="text" class="form-control numberonly" name="PatientBeds">
        </div>
        <div style="clear: both;"><br></div>
        <div class="col-sm-12">
          <label> Facilities available in the hospital</label>
        </div>
          <div class="form-group col-sm-4">
		        <label> OT</label>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="OT" value="1">
					<label class="form-check-label" for="gridCheck">
					  Yes
					</label>
					&nbsp;
					<input class="form-check-input" type="radio" name="OT" value="0">
					<label class="form-check-label" for="gridCheck">
					   No
					</label>
				</div>
	     </div>
	     <div class="form-group col-sm-4">
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
	     </div>
	      <div class="col-sm-12">
		   	<label>Others</label>
		   	 <input type="text" class="form-control" name="others">
          </div>
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
				<div class="col-lg-10 col-lg-offset-2">
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
<script type="text/javascript">

  $('.numberonly').bind('keyup paste', function(){
      this.value = this.value.replace(/[^0-9]/g, '');
  });

    $('body').on('focus',".datepicker", function(){
      $(this).datepicker({
            dateFormat : 'yy-mm-dd',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn'
        });
    });

	
    $(".datepicker").datepicker({
        dateFormat : 'yy-mm-dd',
        changeMonth : true,
        changeYear : true,
        yearRange: '-100y:c+nn'
    });


     var wrapper = $('.field_wrapper');
     var max_fields = 50;
     var x = 1;
     $('#add').click(function () { 

      if(x < max_fields){
            x++;
            var fieldHTML = '<div class="form-group col-md-2 col-sm-2"><label for="name">Bill No.</label><input type="text" class="form-control input-sm" name="billno[]"> </div><div class="form-group col-md-2 col-sm-2"><label for="gender">Date</label><input type="text" class="form-control input-sm datepicker" name="billdate[]" placeholder=""></div><div class="form-group col-md-3 col-sm-3"><label for="age">Issued By</label><input type="text" class="form-control input-sm" name="billissued[]" placeholder=""></div><div class="form-group col-md-3 col-sm-3"><label for="DOB">Towards</label><input type="text" class="form-control input-sm" name="billtowards[]" placeholder=""></div><div class="form-group col-md-2 col-sm-2"><label for="DOB">Amount</label><input type="text" class="form-control input-sm" name="billamount[]" placeholder=""></div>';

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
		$("#user-result").html('<img src="images/bx_loader.gif"/>');
		$.post('verification_patient.php', {'Policy_No':username}, function(data) {
		  $("#user-result").html(data);
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
					Hospital_Name: "required",
					area_code : "required",
					phone_no : "required",
					cont_code : "required",
					Patient_Name: "required",
					Patient_Last_Name: "required",
					IP_Registration: {
	 						required: true,
		     				digits: true
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
					Hospital_Name: "Please Enter Hospital Name.",
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
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
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
            dateFormat : 'mm/dd/yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });
    $(function() {
        $( "#DateofAdmission" ).datepicker({
            dateFormat : 'mm/dd/yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });
    $(function() {
        $( "#DateofDischarge" ).datepicker({
            dateFormat : 'mm/dd/yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });
    $(function() {
        $( "#DateofDelivery" ).datepicker({
            dateFormat : 'mm/dd/yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });
    $(function() {
        $( "#date" ).datepicker({
            dateFormat : 'mm/dd/yy',
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