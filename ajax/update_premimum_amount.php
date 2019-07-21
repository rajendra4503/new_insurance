<?php

include('../include/configinc.php');

 function cleanData($a) {
    return str_replace("," , "" , $a);
 }

$data = array();

if ($_REQUEST['customer_code'] != '' && $_REQUEST['seq_no'] != '' && $_REQUEST['value'] != '') {

	$CostId = $_REQUEST['customer_code'];

	$psn = $_REQUEST['seq_no'];

	$value = $_REQUEST['value'];

    $query = mysql_query("SELECT * FROM customer_plan WHERE Cust_ID = '$CostId' AND plan_sequence_number = $psn");

    $result = mysql_fetch_array($query);

	if(mysql_num_rows($query) > 0){

        $annual_plan = $result['annual_limit_plan'];

        $query7 = "SELECT COUNT(CASE WHEN employee_details.Sex='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_details.Sex='Female' THEN 1 END) AS female FROM employee_details WHERE employee_details.Customer_Code = '$CostId' AND employee_details.plan_sequence_number = $psn";
            $totalquery7 = mysql_query($query7);
            $tota7 = mysql_fetch_array($totalquery7);


          $query_dep7 = "SELECT COUNT(CASE WHEN employee_dependent.Gender='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_dependent.Gender='Female' THEN 1 END) AS female FROM employee_dependent WHERE employee_dependent.Customer_Code = '$CostId' AND employee_dependent.plan_sequence_number = $psn";
          $totalquery_dep7 = mysql_query($query_dep7);
          $total_dep7 = mysql_fetch_array($totalquery_dep7);

          $gender = $tota7['male']+$tota7['female']+$total_dep7['male']+$total_dep7['female'];

          $total_payable = $gender * cleanData($value);

          $query = mysql_query("UPDATE `customer_plan` SET `premium_amount` = '$value',`amount_payable` = '$total_payable' WHERE Cust_ID = '$CostId' AND plan_sequence_number = $psn");

		$total_query = mysql_query("SELECT SUM(amount_payable) total FROM customer_plan WHERE Cust_ID = '$CostId'");
		$total_result = mysql_fetch_array($total_query);
		$total_value = $total_result['total'];

		$total_value_formatted = number_format($total_value);

		$total_payable_formatted = number_format($total_payable);


		$data['result'] = ['amount_payable' => $total_payable_formatted,'Grand_Total'=>$total_value_formatted];
		
		$data['status'] = "ok";
           
	}else{
		$data['status'] = "no";
	}
	echo json_encode($data);
}

exit;

?>