<?php
include('../include/configinc.php');
$query = "SELECT Diagnosis_ID,ICD10_CM_CODE,ICD10_CM_CODE_DESCRIPTION,	CreatedBy,UpdatedBy,UpdatedDate FROM allow_diagnosis_code";
$result = mysql_query($query);
$datalist = array();
$allresult = array();
$code = [];
$i=1;
if(mysql_num_rows($result) > 0)
{
   while($row = mysql_fetch_assoc($result))
     {
		$data   = array();
		$id     = $row['Diagnosis_ID'];
		$data[] = $i;
		$data[] = $row['ICD10_CM_CODE'];
		$data[] = $row['ICD10_CM_CODE_DESCRIPTION'];
		$data[] = $row['CreatedBy'];
		$data[] = $row['UpdatedBy'];
		//$data[] = date("Y/m/d",$row['UpdatedDate']);
		$data[] = '<a href="JavaScript:void(0);" onclick="editFunction('.$id.')" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';
		$allresult[] = $data;
		$i++;
 }

    $fulljson=array_merge($allresult);
    echo json_encode(array('data'=>$fulljson));
}
exit;
?>