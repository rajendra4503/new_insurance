<?php
include('../include/configinc.php');
$data = array();
if ($_REQUEST['codeId'] != '' && $_REQUEST['icd_code'] != '') {
	$codeId = $_REQUEST['codeId'];
	$icd_code = $_REQUEST['icd_code'];
	$icd_desc = $_REQUEST['icd_desc'];
	$icd_display = $icd_code.'-'.$icd_desc;

	$query = mysql_query("UPDATE `allow_diagnosis_procedure_code` SET `ICD10_PCS_CODE` = '$icd_code', `ICD10_PCS_CODE_DESCRIPTION` = '$icd_desc', `ICD10_PCS_CODE_DISPLAY_STRING` = '$icd_display' , `UpdatedBy` = 'System' WHERE Procedure_ID = $codeId");

	if($query){
        $data['status'] = "ok";
	}else{
		$data['status'] = "no";
	}
	echo json_encode($data);
	exit;
}

?>