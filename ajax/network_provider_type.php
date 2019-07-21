<?php
include('../include/configinc.php');

$request = $_GET['query'];

$query = "SELECT * FROM network_provider_table WHERE Provider_Name LIKE '%".$request."%' OR Provider_ID LIKE '%".$request."%' ";

$result = mysql_query($query);
if(mysql_num_rows($result) > 0)
{
 while($row = mysql_fetch_assoc($result))
 {
    $data[] = array(
      'Provider_ID' => $row['Provider_ID'], 
      'Provider_Name' => $row['Provider_Name'],
      'Registration_No' => $row['Registration_No'],
      'Doctor_Name' => $row['Doctor_Name'],
      'Qualification' => $row['Qualification'],
      'CountryCode' => $row['CountryCode'],
      'AreaCode' => $row['AreaCode'],
      'PhoneNo' => $row['PhoneNo'],
      'desc' => $row['Provider_ID'].' '.$row['Provider_Name'].' '.$row['Doctor_Name']
      );
 }
  echo json_encode($data);
}
exit;
?>