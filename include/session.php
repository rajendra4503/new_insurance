<?php
include_once('include/configinc.php');
date_default_timezone_set("Asia/Kolkata");
//echo "<pre>";print_r($_SESSION);exit;
if(isset($_SESSION['logged_email']))
{
      $logged_userid                      = $_SESSION['logged_userid'];
      $logged_merchantid                  = $_SESSION['logged_merchantid'];
      $logged_companyname                 = $_SESSION['logged_companyname'];
      $logged_mobile                      = $_SESSION['logged_mobile'];
      $logged_email                       = $_SESSION['logged_email'];  
      $logged_usertype                    = $_SESSION['logged_usertype'];   
      $logged_roleid                      = $_SESSION['logged_roleid'];
      $logged_firstname                   = $_SESSION['logged_firstname'];
      $logged_lastname                    = $_SESSION['logged_lastname'];
      $logged_userstatus                  = $_SESSION['logged_userstatus'];
      $logged_companycountryid            = $_SESSION['logged_companycountryid'];
      $logged_userdp                      = $_SESSION['logged_userdp'];
      $plan_to_customize                  = (empty($_SESSION['current_assigned_plan_code']))      ? '' : $_SESSION['current_assigned_plan_code'];
} 
else
{
  header("Location:login.php");
}
?>