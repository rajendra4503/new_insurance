<?php
session_start();
ini_set("display_errors","0");
include('../include/configinc.php');
include('../include/session.php');
$logged_userid = $_SESSION['logged_userid'];

if($_REQUEST['EmpNo'] != '' && $_REQUEST['last_name1'] != ''){ 
    $EmpNo     = $_REQUEST['EmpNo'];
    $last_name1  = $_REQUEST['last_name1'];
    $first_name1 = $_REQUEST['first_name1'];
    $PlanSeq = $_REQUEST['PlanSeq'];
    $CostId =    $_REQUEST['CostId'];
    $date_birth1 = date('Y-m-d',strtotime($_REQUEST['date_birth1']));
    $gender1    =    $_REQUEST['gender1'];
    $query = mysql_query("INSERT INTO `employee_dependent` (`Customer_Code`, `plan_sequence_number`,`PolicyID`,`Employee_Number`, `Last_Name`, `First_Name`, `Gender`, `Date_Birth`, `Created_Date`, `Created_By`) VALUES ('$CostId','$PlanSeq', '', '$EmpNo','$last_name1', '$first_name1','$gender1','$date_birth1',now(),'$CostId')");

    if($query){
      $data = array();
      $data['status'] = "ok";
    }
     echo json_encode($data);
     exit;
 }
?>