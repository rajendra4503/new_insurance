<?php
include('../include/configinc.php');

  $EmpNo = $_REQUEST['EmpNo'];

  $CostId = $_REQUEST['CostId'];

  $PlanSeq = $_REQUEST['PlanSeq'];

  $datalist = array();

  $result = array();

  $query = mysql_query("SELECT * FROM employee_dependent WHERE Customer_Code = '$CostId' AND plan_sequence_number = $PlanSeq AND Employee_Number ='$EmpNo'");

    $i = 1;

    while ( $row = mysql_fetch_array($query)) {

      $data = array();

      $data[] = $i;

      $empID = $row['ID'];

      $emp_code = $row['Emp_Code'];

      $data[] = $row['Last_Name'];

      $data[] = $row['First_Name'];

      $data[] = $row['Gender'];

      $data[] = date('d-m-Y',strtotime($row['Date_Birth']));
      
      $data[] = '<a href="JavaScript:void(0);" onclick="editFunction('.$empID.')" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>';

		  $result[] = $data;
      
    $i++;
   }
   $fulljson=array_merge($result);
   echo json_encode(array('data'=>$fulljson));
   exit;
?>