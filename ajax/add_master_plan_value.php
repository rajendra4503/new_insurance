<?php
include('../include/configinc.php');
$data = array();
if ($_REQUEST['PlanValue'] != '') {

	$id = $_REQUEST['PlanValue'];

   $query = mysql_query("SELECT * FROM plan_master WHERE Selected_Plan = $id");

    $result = mysql_fetch_array($query);
	if(mysql_num_rows($query) > 0){
        $data['status'] = "ok";
        $data['result'] = ['Health_CheckUp_Cost' => $result['Health_CheckUp_Cost'],'Pre_Hospitalization_Expenses'=>$result['Pre_Hospitalization_Expenses'],'Ambulance_Charges'=>$result['Ambulance_Charges'],'Hospitalization_Accnmmodation'=>$result['Hospitalization_Accnmmodation'],'Consuitant'=>$result['Consuitant'],'Routine_Investigations'=>$result['Routine_Investigations'],'Medicicne_Drugs'=>$result['Medicicne_Drugs'],'Major_Surgical'=>$result['Major_Surgical'],'Intermediate_Surgical'=>$result['Intermediate_Surgical'],'Ancillary_Services'=>$result['Ancillary_Services'],'Post_Hospitalization_Expenses'=>$result['Post_Hospitalization_Expenses']];
	}else{
		$data['status'] = "no";
	}
	echo json_encode($data);
}
exit;
?>