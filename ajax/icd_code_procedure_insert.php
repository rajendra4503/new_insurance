<?php
include('../include/configinc.php');
$data = array();
if ($_REQUEST['code'] != '' && $_REQUEST['code_description'] != '') {
	$icd_code = $_REQUEST['code'];
	$icd_desc = $_REQUEST['code_description'];
	$icd_display = $icd_code.'-'.$icd_desc;
	$query = mysql_query("INSERT INTO `allow_diagnosis_procedure_code` (`ICD10_PCS_CODE`, `ICD10_PCS_CODE_DESCRIPTION`,`ICD10_PCS_CODE_DISPLAY_STRING`, `CreatedDate`, `CreatedBy`) VALUES ('$icd_code','$icd_desc','$icd_display',now(),'System')");
	if($query){
        $data['status'] = "ok";
	}else{
		$data['status'] = "no";
	}
	echo json_encode($data);
}
exit;
?>