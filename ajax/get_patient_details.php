<?php
include('../include/configinc.php');

$data = array();

if ($_REQUEST['Policy_No'] != '') {
    $username = $_POST["Policy_No"];
	$statement = mysql_query("SELECT * FROM employee_details WHERE   PolicyID ='$username'");
	if(mysql_num_rows($statement) > 0){
		$result = mysql_fetch_array($statement);

		$Date_Of_Birth = date('d-m-Y',strtotime($result['Date_Of_Birth']));
		$age = '';
		if($result['Date_Of_Birth'] !='' && $result['Date_Of_Birth'] !='0000-00-00'){
			$userDob = $result['Date_Of_Birth'];
			$dob = new DateTime($userDob);
			$now = new DateTime();
			$difference = $now->diff($dob);
			$year  = $difference->y;
			$month = $difference->m;
			$age = $year.'.'.$month.' Years';
		 }


        $data['status'] = "ok";
        $data['result'] = [
	        'First_Name' => $result['First_Name'],
	        'Last_Name' => $result['Last_Name'],
	        'Sex' => $result['Sex'],
	        'Date_Of_Birth' => $Date_Of_Birth,
	        'Age'=>$age
        ];

	}else{

		$data['status'] = "no";
	}
	echo json_encode($data);
}	
    exit;
?>