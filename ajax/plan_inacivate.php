<?php
include('../include/configinc.php');
$data = array();

if ($_REQUEST['date'] != '' && $_REQUEST['cust_id'] != '' && $_REQUEST['status'] == 'Inactive') {
	
	$date = date('Y-m-d',strtotime($_REQUEST['date']));

	$cust_id = $_REQUEST['cust_id'];

	$status = $_REQUEST['status'];

	$desc = $_REQUEST['desc'];

	$seqno = $_REQUEST['seqno'];

	$query = mysql_query("UPDATE `customer_plan` SET `plan_status` = '$status', `deactivate_date` = '$date', `plan_status_description` = '$desc' , `Updated_By` = '$cust_id' WHERE Cust_ID = '$cust_id' AND plan_sequence_number = $seqno");

	if($query){
        $data['status'] = "ok";
	}else{
		$data['status'] = "no";
	}
	echo json_encode($data);
	exit;
}

?>