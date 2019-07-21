<?php
include('../include/configinc.php');
$query = "SELECT * FROM customer_setup_details";
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
		$Agent_ID     = $row['AgentName_BrokerName'];
		$Officer_ID     = $row['Marketing_OfficerName'];
		$id     = $row['Cust_ID'];
		$data[] = $i;
		$data[] = $row['Company_Name'];
		$data[] = $row['First_Name'].' '.$row['Last_Name'];

		$query1 = "SELECT First_Name,Last_Name FROM agent_broker_details WHERE Agent_ID = $Agent_ID";
        $result1 = mysql_query($query1);
        $test1 = mysql_fetch_assoc($result1);
		$data[] = $test1['First_Name'].' '.$test1['Last_Name'];

		$query2 = "SELECT First_Name,Last_Name FROM marketing_officer_details WHERE Officer_ID = $Officer_ID";
        $result2 = mysql_query($query2);
        $test2 = mysql_fetch_assoc($result2);
		$data[] = $test2['First_Name'].' '.$test2['Last_Name'];

		$data[] = '<a href="customer_edit.php?CostId='.$id.'" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a><a href="customer_new.php?CostId='.$id.'" class="edit" data-toggle="modal"><span class="glyphicon glyphicon-cog" data-toggle="tooltip" data-original-title="Setting"></span></a>';

		$allresult[] = $data;
		$i++;
 }
    $fulljson=array_merge($allresult);
    echo json_encode(array('data'=>$fulljson));
}
exit;
?>