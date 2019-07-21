<?php
session_start();
ini_set("display_errors","0");
include('../include/configinc.php');
include('../include/session.php');
$logged_userid = $_SESSION['logged_userid'];

  $IDcode = $_REQUEST['codeId'];

  $query = mysql_query("SELECT * FROM employee_dependent WHERE ID = $IDcode");

  $result = mysql_fetch_array($query);

  $data = array();

  $data['status'] = "ok";

  $Date_Birth = date('d-m-Y',strtotime($result['Date_Birth']));

  $data['result'] = ['first_name' =>$result['First_Name'],'last_name'=>$result['Last_Name'],'gender'=>$result['Gender'],'date_birth'=>$Date_Birth,'IDcode'=> $IDcode];

  echo json_encode($data);
  exit;
?>