<?php
include('include/configinc.php');
$request = $_GET['query'];
$query = "SELECT ICD10_PCS_CODE,ICD10_PCS_CODE_DISPLAY_STRING,ICD10_PCS_CODE_DESCRIPTION FROM diagnosis_procedure_code WHERE ICD10_PCS_CODE LIKE '%".$request."%'";
$result = mysql_query($query);
if(mysql_num_rows($result) > 0)
{
 while($row = mysql_fetch_assoc($result))
 {

 	    $icdcodecm =   $row['ICD10_PCS_CODE'];

		$searchicd = mysql_query("SELECT ICD10_PCS_CODE FROM `allow_diagnosis_procedure_code` WHERE ICD10_PCS_CODE = '$icdcodecm'");

		if(mysql_num_rows($searchicd) > 0){
			$img = '<span class="glyphicon glyphicon-ok"></span>';
		}else{
			$img = '<span class="glyphicon glyphicon-remove"></span>';
		}

	     $data[] = array(
	      'value' => $row['ICD10_PCS_CODE'], 
	      'label' => $row['ICD10_PCS_CODE_DISPLAY_STRING'],
	      'desc'  => $row['ICD10_PCS_CODE_DESCRIPTION'],
	      'status'=> $img
	      );
 }
  echo json_encode($data);
}
exit;
?>