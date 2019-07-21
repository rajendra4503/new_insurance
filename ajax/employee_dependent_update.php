<?php
session_start();
ini_set("display_errors","0");
include('../include/configinc.php');
include('../include/session.php');
$logged_userid = $_SESSION['logged_userid'];

  if($_REQUEST['IDcode3'] != '' && $_REQUEST['last_name3'] != ''){

		$IDcode = $_REQUEST['IDcode3'];

		$last_name = $_REQUEST['last_name3'];

		$first_name = $_REQUEST['first_name3'];

		$gender = $_REQUEST['gender3'];

		$date_birth = date('Y-m-d',strtotime($_REQUEST['date_birth3']));


		$query = mysql_query("UPDATE `employee_dependent` SET `Last_Name` = '$last_name', `First_Name` = '$first_name', `Gender` = '$gender', `Date_Birth` = '$date_birth' ,`Updated_By` = '$logged_userid', `Updated_Date` = now() WHERE `ID` = $IDcode");

		if($query){

			$data = array();
	        $data['status'] = "ok";
		}
		echo json_encode($data);
        exit;
    }
?>