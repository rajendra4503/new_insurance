<?php
session_start();
//ini_set("display_errors","0");
include('include/configinc.php');
include('include/session.php');
include('include/functions.php');
include ('SMTP/PHPMailerAutoload.php');
include ('SMTP/class.phpmailer.php');
include ('SMTP/class.smtp.php');

/************Get user and Hospital Deatils****************/


if(isset($_POST["Policy_No"]))
{
  
  $username = $_POST["Policy_No"];

  $statement = mysql_query("SELECT PolicyID FROM employee_details WHERE   PolicyID ='$username'");
  if(mysql_num_rows($statement) > 0){
    die('<img src="images/available.png" />');
  }else{
    die('<img src="images/not-available.png" />');
  }
}


	if ($_POST['type'] == 'checked' && $_POST['claimId']) {

		$ID = $_POST['claimId'];

		$status = $_POST['status'];

    $status = $_POST['status'];

		if($status == 1){
			echo 'alreay';
      
		}else{

     $ipn_no = $_POST['IPRegistration'];

     $query_ipn_no = mysql_query("SELECT * FROM  patient_details AS PD JOIN employee_details AS IPR ON  PD.Policy_No = IPR.PolicyID WHERE IPR.PolicyID ='$ipn_no'");

     if(mysql_num_rows($query_ipn_no) > 0){

        $query = "UPDATE patient_details SET Policy_Status = 1,UpdatedDate=now(),UpdatedBy = $logged_userid
        WHERE Claim_ID = '$ID'";

          if(mysql_query($query)){
             echo 'OK';
          }

      }

     else{

             $query = mysql_query("UPDATE patient_details SET Status = 3,Policy_Status = 0,UpdatedDate=now(),UpdatedBy = $logged_userid
              WHERE Claim_ID = '$ID'");

              $submitterID = $_POST['submitterID'];

    $submitter_query = mysql_query("SELECT A.EmailID,A.MobileNo,D.FirstName,D.LastName FROM USER_ACCESS AS A JOIN USER_DETAILS AS D ON A.UserID = D.UserID WHERE A.UserID = $submitterID");


    $result = mysql_fetch_assoc($submitter_query);
    $submitter_email = 'sudhir@sumagotech.com'; //$result['EmailID'];
    //$submitter_email = 'rajendra.singh450@gmail.com'; //$result['EmailID'];
    $submitter_mobile = $result['MobileNo'];
    $submitter_name = $result['FirstName'].' '.$result['LastName'];


    $patient_query = mysql_query("SELECT Patient_Name,Patient_Last_Name,Policy_No FROM patient_details WHERE Claim_ID = $ID");
    $pat_result = mysql_fetch_assoc($patient_query);
    $pat_name = $pat_result['Patient_Name'].' '.$pat_result['Patient_Last_Name'];
    $pat_policyNo = $pat_result['Policy_No'];


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

    $mail->FromName = "ABC Insurance Policy Team";

    //$mail->AddReplyTo($logged_EmailID, $logged_firstname.' '.$logged_lastname);

    $mail->Subject = 'Claim is Rejected.';

    $mail->addAddress($submitter_email);

    $messages = '
<!DOCTYPE html>
<html>
<head>
<title>Insurance Policy</title>
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
                                  <strong>Dear '.$submitter_name.'</strong>
                                </td>
                            </tr>
                            <tr>
                              <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
                              <p>
                              The medical claim submitted by you for patient <strong>'.$pat_name.'</strong> has been received by us.
                              Based on the details provided by you, we find that the patient is not eligible for insurance coverage with our company and so the claim is rejected.
                              <p>This rejection could have one of the following possible causes : </p>
                              <p>1.  The insurance details provided were incorrect.</p>
                              <p>2.  The patients demographics or insurance policy included on the claim was not eligible for the date of service of the claim</p>
                              <p>The claim may be resubmitted after correcting the data.</p>
                              </p>
                              </td>
                            </tr>
                            <tr>
                              <td align="left" style="padding:0 0 0 0; font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
                                <p> With best regards ,</p>
                                <p>
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
</html>
';

              $mail->msgHTML($messages, dirname(__FILE__));
              if(!$mail->send()) {
              
              } else {
              
              }

            echo 'NOT';
          }

	   }

	}



	if ($_POST['type'] == 'review' && $_POST['claimId']) {

		$ID = $_POST['claimId'];

		$status = $_POST['status'];

		if($status == 1){
			echo 'Patient Already Verified Successfully.';
		}else{

		$submitterID = $_POST['submitterID'];

		$submitter_query = mysql_query("SELECT A.EmailID,A.MobileNo,D.FirstName,D.LastName FROM USER_ACCESS AS A JOIN USER_DETAILS AS D ON A.UserID = D.UserID WHERE A.UserID = $submitterID");

		$result = mysql_fetch_assoc($submitter_query);
		$submitter_email = 'sudhir@sumagotech.com';//$result['EmailID'];
    //$submitter_email = 'rajendra.singh450@gmail.com';
		$submitter_mobile = $result['MobileNo'];
		$submitter_name = $result['FirstName'].' '.$result['LastName'];


		$patient_query = mysql_query("SELECT Patient_Name,Patient_Last_Name,Policy_No FROM patient_details WHERE Claim_ID = $ID");

		$pat_result = mysql_fetch_assoc($patient_query);
		$pat_name = $pat_result['Patient_Name'].' '.$pat_result['Patient_Last_Name'];
		$pat_policyNo = $pat_result['Policy_No'];

		$hos_query = mysql_query("SELECT Declaration_Date FROM hospital_details WHERE Claim_ID = $ID");
		$hos_result = mysql_fetch_assoc($hos_query);
		$claimfilingDate = date("Y-m-d", strtotime($hos_result['Declaration_Date']));


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
		$mail->FromName = "ABC Insurance Policy Team";
		//$mail->AddReplyTo($logged_EmailID, $logged_firstname.' '.$logged_lastname);
		$mail->Subject = 'Review of ABC Insurance Policy';
		$mail->addAddress($submitter_email);

     $messages = '';

		 $messages .= '<!DOCTYPE html>
<html>
<head>
<title>Insurance Policy</title>
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

                  <p><strong>Ref : </strong>Patient Name : '.$pat_name.'</p>
                  <p style="margin-left:40px;">Claim id : '.$ID.'</p>
                  <p style="margin-left:40px;">Policy Number : '.$pat_policyNo.'</p>
                  <p style="margin-left:40px;">Subscriber Number : '.$pat_policyNo.'</p>
                  <p style="margin-left:40px;">Date of Claim Filing  : '.$claimfilingDate.'</p>
              </td>
          </tr>

        <tr>
            <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
              <strong>Dear '.$submitter_name.'</strong>
            </td>
        </tr>
        <tr>
          <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
              <p>
              The claim <strong>'.$ID.'</strong>, submitted for <strong>'.$pat_name.'</strong>,was processed and the following procedures/charges have been denied-
              </p>
          </td>
        </tr>
        <tr>
           <td>
              <table class="table table-bordered dataTable no-footer" role="grid" style="width:100%;border:1px solid #000;text-align:center;" border="1">
              <thead>
                <tr>
                  <th>S. No.</th>
                  <th>Procedure/Charges</th>
                  <th>Description of the procedure</th>
                </tr>
              </thead>
              <tbody>
                <tr>';


      if (isset($_POST['claimId'] ) && !empty($_POST['claimId'])) {
        $query_master = "SELECT DISTINCT ICD10CM, ICD10PCS FROM diagnosis_master";
        $result_m = mysql_query($query_master);
        $icdcm = [];
        $icdpcs = [];
        while ($result_q = mysql_fetch_array($result_m))  
        {
          array_push($icdcm,$result_q["ICD10CM"]);
          array_push($icdpcs,$result_q["ICD10PCS"]);
        }
        $icdcm_l  =   array_unique($icdcm);
        $icdpcs_l =   array_unique($icdpcs);
        $PClaimID = $_POST['claimId'];
        $pcquery = "SELECT DISTINCT C.Claim_ID,C.ICD10CM,C.ICD10PCS,D.ICD10_CM_CODE_DESCRIPTION,P.ICD10_PCS_CODE_DESCRIPTION FROM claim_diagnosis_procedure AS C JOIN diagnosis_code AS D ON C.ICD10CM = D.ICD10_CM_CODE JOIN diagnosis_procedure_code AS P ON C.ICD10PCS = P.ICD10_PCS_CODE WHERE C.Claim_ID = '$PClaimID'";
        $resultq1 = mysql_query($pcquery);
      }

      $i = 1;
      while ($row = mysql_fetch_array($resultq1))  
      {
          if (!in_array($row["ICD10PCS"],$icdpcs_l)){ 

            $a = $row["ICD10PCS"];
            $b = $row["ICD10_PCS_CODE_DESCRIPTION"];

            $messages .= '<tr>
                      <td>'.$i.'</td>
                      <td> '.$a.'-'.$b.'
                      </td>
                      <td>Procedure not covered</td>
                      </tr>';
           }
           $i++;
        }

               $messages .= '</tbody>
            </table>
           </td>
        </tr>
        <tr>
          <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
              <p>
             In case you wish to contest this denial, then an appeal may be filed citing the claim id and providing appropriate proof of medical necessity within the next 30 days.
              </p>
          </td>
        </tr>
        <tr>
          <td align="left" style="padding:0 0 0 0; font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
                <p> With best regards ,</p>
                <p>
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
// echo $messages;
// exit;

		$mail->msgHTML($messages, dirname(__FILE__));
		if(!$mail->send()) {
		  //echo 'Mailer error: ' . $mail->ErrorInfo;
		} else {
		  //echo 'Message has been sent successfully.';
		}

		$query = "UPDATE patient_details SET Status = 2 ,UpdatedDate=now(),UpdatedBy = $logged_userid
		WHERE Claim_ID = '$ID'";

		if(mysql_query($query)){

			echo 'Mail Send Successfully for Review.';

		 }

	  }
    
	}


	if ($_POST['type'] == 'reject' && $_POST['claimId']) {

		$ID = $_POST['claimId'];

		$status = $_POST['status'];

		if($status == 1){
			echo 'Patient Already Verified Successfully.';
		}else{

		$submitterID = $_POST['submitterID'];

		$submitter_query = mysql_query("SELECT A.EmailID,A.MobileNo,D.FirstName,D.LastName FROM USER_ACCESS AS A JOIN USER_DETAILS AS D ON A.UserID = D.UserID WHERE A.UserID = $submitterID");


		$result = mysql_fetch_assoc($submitter_query);
		$submitter_email = 'sudhir@sumagotech.com'; //$result['EmailID'];
    // $submitter_email = 'rajendra.singh450@gmail.com'; //$result['EmailID'];
		$submitter_mobile = $result['MobileNo'];
		$submitter_name = $result['FirstName'].' '.$result['LastName'];


		$patient_query = mysql_query("SELECT Patient_Name,Patient_Last_Name,Policy_No FROM patient_details WHERE Claim_ID = $ID");
		$pat_result = mysql_fetch_assoc($patient_query);
		$pat_name = $pat_result['Patient_Name'].' '.$pat_result['Patient_Last_Name'];
		$pat_policyNo = $pat_result['Policy_No'];


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

		$mail->FromName = "ABC Insurance Policy Team";

		//$mail->AddReplyTo($logged_EmailID, $logged_firstname.' '.$logged_lastname);

		$mail->Subject = 'Claim is Rejected.';

		$mail->addAddress($submitter_email);

		$messages = '
<!DOCTYPE html>
<html>
<head>
<title>Insurance Policy</title>
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
                                  <strong>Dear '.$submitter_name.'</strong>
                                </td>
                            </tr>
                            <tr>
                              <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
                              <p>
                              The medical claim submitted by you for patient <strong>'.$pat_name.'</strong> has been received by us.
                              Based on the details provided by you, we find that the patient is not eligible for insurance coverage with our company and so the claim is rejected.
                              <p>This rejection could have one of the following possible causes : </p>
                              <p>1.  The insurance details provided were incorrect.</p>
                              <p>2.  The patients demographics or insurance policy included on the claim was not eligible for the date of service of the claim</p>
                              <p>The claim may be resubmitted after correcting the data.</p>
                              </p>
                              </td>
                            </tr>
                            <tr>
                              <td align="left" style="padding:0 0 0 0; font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
                                <p> With best regards ,</p>
                                <p>
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
</html>
';

		$mail->msgHTML($messages, dirname(__FILE__));
		if(!$mail->send()) {
		//echo 'Mailer error: ' . $mail->ErrorInfo;
		} else {
		//echo 'Message has been sent successfully.';
		}

		$query = "UPDATE patient_details SET Status = 3 ,UpdatedDate=now(),UpdatedBy = $logged_userid
		WHERE Claim_ID = '$ID'";
		if(mysql_query($query)){
			echo 'Insurance Policy Reject Successfully.';
		}
	  }
  }
  

  if ($_POST['type'] == 'sucess' && $_POST['claimId']) {

		$ID = $_POST['claimId'];

		$status = $_POST['status'];

		if($status == 1){
			echo 'Patient claim already sent for payment processing';
		}else{

      $submitterID = $_POST['submitterID'];
      $query = "UPDATE patient_details SET Status = 1 ,UpdatedDate=now(),UpdatedBy = $logged_userid
      WHERE Claim_ID = '$ID'";
      if(mysql_query($query)){
        echo ' Claim sent for payment processing.';
      }
    }

  }

	// if ($_POST['type'] == 'unchecked' && $_POST['claimId']) {
	// 	$ID = $_POST['claimId'];
	// 	$query = "UPDATE patient_details SET Status = 0 
	// 	WHERE Claim_ID = '$ID'";
	// 	if(mysql_query($query)){
	// 		echo 'Patient Unverified Successfully';
	// 	}
	// }
	exit;
?>