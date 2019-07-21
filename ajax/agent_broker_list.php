<?php
include('../include/configinc.php');
$query = "SELECT * FROM agent_broker_details";
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
		$id     = $row['Agent_ID'];
		$data[] = $i;
		$data[] = $row['Company_Name'];
		$data[] = $row['First_Name'].' '.$row['Last_Name'];
		$data[] = $row['Mobile'];
		$data[] = $row['Email_Id'];
		$data[] = $row['City'];
		$data[] = '<a href="agent_broker_edit.php?id='.$id.'" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';
		$allresult[] = $data;
		$i++;
 }
    $fulljson=array_merge($allresult);
    echo json_encode(array('data'=>$fulljson));
}
exit;
?>