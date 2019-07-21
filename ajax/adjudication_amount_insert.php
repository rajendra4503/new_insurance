<?php
include('../include/configinc.php');

if($_REQUEST['amount_notes'] != '' && $_REQUEST['amount'] != ''){

	$claimid = $_REQUEST['claimid'];

	$amount_notes = $_REQUEST['amount_notes'];

	$amount = $_REQUEST['amount'];

	$query = mysql_query("UPDATE `patient_details` SET `Amount` = '$amount', `Amount_Notes` = '$amount_notes' , `Adjudication_Date` = now(),`Adjudicate_Status` = 1 WHERE Claim_ID = $claimid");

	if($query){
        $data['status'] = "ok";
	}else{
		$data['status'] = "no";
	}
	echo json_encode($data);
	exit;
}
?>