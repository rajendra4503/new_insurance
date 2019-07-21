<?php
include('../include/configinc.php');
$data = array();
if ($_REQUEST['codeId'] != '') {
	$id = $_REQUEST['codeId'];
    $query = mysql_query("SELECT * FROM allow_diagnosis_code WHERE Diagnosis_ID = $id");
    $result = mysql_fetch_array($query);
	if(mysql_num_rows($query) > 0){
        $data['status'] = "ok";
        $data['result'] = ['code' => $result['ICD10_CM_CODE'],'desc'=>$result['ICD10_CM_CODE_DESCRIPTION'],'codeId'=>$id];
	}else{
		$data['status'] = "no";
	}
	echo json_encode($data);
}
exit;
?>