<?php
session_start();
ini_set("display_errors","0");
include('include/configinc.php');
include('include/session.php');
include('include/functions.php');

$logged_userid = $_SESSION['logged_userid'];

function escapeString($string) {
    return mysql_real_escape_string($string);
}

$msg = '';

if($_POST['type'] == 'update' && $_POST['last_name'] != '' && $_POST['first_name'] != '' && $_POST['mobile_number'] != ''){

  $Emp_ID2 = $_POST['EmpID'];

  //$employee_number = escapeString($_POST['employee_number']);

  $date_birth = date("Y-m-d", strtotime($_POST['date_birth']));

  $sex = escapeString($_POST['sex']);
  $last_name = escapeString($_POST['last_name']);
  $first_name = escapeString($_POST['first_name']);

  $mobile_number = escapeString($_POST['mobile_number']);
  $email = escapeString($_POST['email']);
  $address_1 = escapeString($_POST['address_1']);
  $address_2 = escapeString($_POST['address_2']);
  $country = escapeString($_POST['country']);
  $state = escapeString($_POST['state']);
  $city = escapeString($_POST['city']);
  $postal_code = escapeString($_POST['postal_code']);

  $query = "UPDATE `employee_details` SET `First_Name` = '$first_name', `Last_Name` = '$last_name', `Date_Of_Birth` = '$date_birth', `Sex` = '$sex', `Mobile` = '$mobile_number', `Email_Id` = '$email', `Address_Line1` = '$address_1', `Adress_Line2` = '$address_2', `City` = '$city', `State` = '$state', `Postal_Code` = '$postal_code', `Country` = '$country', `Updated_Date` = now(),`Updated_By` = '$logged_userid' WHERE `Emp_ID` = $Emp_ID2";


    if(mysql_query($query)){
       $msg = "Employee Updated Successfully";
    }
 }

if( $_POST['type'] == 'insert' && $_POST['last_name'] != '' && $_POST['first_name'] != '' && $_POST['mobile_number'] != ''){

  $employee_number = escapeString($_POST['employee_number']);


  $date_birth = date("Y-m-d", strtotime($_POST['date_birth']));

  $sex = escapeString($_POST['sex']);
  $last_name = escapeString($_POST['last_name']);
  $first_name = escapeString($_POST['first_name']);
  $mobile_number = escapeString($_POST['mobile_number']);
  $email = escapeString($_POST['email']);
  $address_1 = escapeString($_POST['address_1']);
  $address_2 = escapeString($_POST['address_2']);
  $country = escapeString($_POST['country']);
  $state = escapeString($_POST['state']);
  $city = escapeString($_POST['city']);
  $postal_code = escapeString($_POST['postal_code']);


  $PolicyID = $logged_userid.$employee_number;

  $query = "INSERT INTO `employee_details` (`Customer_Code`, `Employee_Number`,`PolicyID`,`First_Name`, `Last_Name`, `Date_Of_Birth`, `Sex`, `Mobile`, `Email_Id`, `Address_Line1`, `Adress_Line2`, `City`, `State`, `Postal_Code`, `Country`, `Created_Date`, `Created_By`,`Effective_Date`) VALUES ('$logged_userid', '$employee_number','$PolicyID','$first_name','$last_name', '$date_birth', '$sex', '$mobile_number', '$email', ' $address_1', '$address_2', '$city', '$state', '$postal_code','$country',now(),'$logged_userid',now())";

    if(mysql_query($query)){

      $emp_id = mysql_insert_id();

      for($i = 0 ; $i < count($_POST['dep_last_name']) ; $i++){

      $last_name = mysql_real_escape_string($_POST['dep_last_name'][$i]);
      $first_name = mysql_real_escape_string($_POST['dep_first_name'][$i]);
      $gender  = mysql_real_escape_string( $_POST['dep_gender'][$i] );
      $date_birth = date("Y-m-d", strtotime($_POST['dep_date_birth'][$i]));

      //$date_birth = mysql_real_escape_string($_POST['dep_date_birth'][$i]);

      //$date_birth  = '2019-05-08';
      $emp_query = "INSERT INTO `employee_dependent` (`Emp_Code`,`Employee_Number`,`Last_Name`, `First_Name`, `Gender`, `Date_Birth`, `Created_Date`,`Created_By`) VALUES ('$emp_id','$employee_number','$last_name','$first_name','$gender','$date_birth',now(),'$logged_userid')";
      mysql_query($emp_query) or exit(mysql_error());

    } 
       $msg = "Employee Added Successfully";
    }
 }

$uniquesavename=date("Y-m-d").'_'.rand(1000,9999);

if(isset($_POST["Import"])){

  $logged_userid = $_SESSION['logged_userid'];

  $CostId = $_GET['CostId'];

  $filename=$_FILES["file"]["tmp_name"];

   if ($_FILES["file"]["type"]=='application/vnd.ms-excel') {


  $targetPath ='uploads/employee/'.$uniquesavename.'_'.$_FILES['file']['name'];

    move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

     if($_FILES["file"]["size"] > 0)
     {

        $file = fopen($targetPath, "r");

           $i = 0;

           $c = 0;

           $err = 0;

      while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
            
      if($i > 0){

        if($emapData[1] != '' && $emapData[2] != '' && $emapData[3] != ''){

         $PolicyID = $logged_userid.$emapData[1];

         $query_1 = mysql_query("SELECT * FROM employee_details WHERE `Employee_Number` = '".$emapData[1]."'");

         if (mysql_num_rows($query_1) > 0) {
            $err ++;
        $msg  = $msg. "Employee Number <span style='color:#F61717'>".$emapData[1]." </span>Already Exist In Our Record In Row $i <br>";
          }

          $query = "INSERT INTO `employee_details` (`Customer_Code`, `Employee_Number`,`PolicyID`,`First_Name`, `Last_Name`, `Date_Of_Birth`, `Sex`, `Mobile`, `Email_Id`, `Address_Line1`, `Adress_Line2`, `City`, `State`, `Postal_Code`, `Country`, `Created_Date`, `Created_By`,`Effective_Date`) VALUES ('$logged_userid', '$emapData[1]','$PolicyID','$emapData[2]','$emapData[3]', '$emapData[4]', '$emapData[5]', '$emapData[6]','$emapData[7]', '$emapData[8]', '$emapData[9]', '$emapData[10]','$emapData[11]','$emapData[12]','$emapData[13]',now(),'$logged_userid',now())";

          $result = mysql_query($query);

          if ($result > 0) {


        $EmpCode_ID = mysql_insert_id();

        if($emapData[14] != '') {
         $query1= mysql_query("INSERT INTO `employee_dependent` (`Emp_Code`,`Employee_Number`, `Last_Name`, `First_Name`, `Date_Birth`,`Gender`,`Created_Date`, `Created_By`) VALUES ('$EmpCode_ID','$emapData[1]','$emapData[14]','$emapData[15]','$emapData[16]','$emapData[17]',now(),'$logged_userid')");
         }

        if($emapData[18] != '') {
        $query2= mysql_query("INSERT INTO `employee_dependent` (`Emp_Code`,`Employee_Number`,`Last_Name`, `First_Name`, `Date_Birth`,`Gender`,`Created_Date`, `Created_By`) VALUES ('$EmpCode_ID','$emapData[1]','$emapData[18]','$emapData[19]','$emapData[20]','$emapData[21]',now(),'$logged_userid')");
        }

       if($emapData[22] != '') {
       $query3= mysql_query("INSERT INTO `employee_dependent` (`Emp_Code`,`Employee_Number`, `Last_Name`, `First_Name`, `Date_Birth`,`Gender`,`Created_Date`, `Created_By`) VALUES ('$EmpCode_ID','$emapData[1]','$emapData[1]','$emapData[22]','$emapData[23]','$emapData[24]','$emapData[25]',now(),'$logged_userid')");
        }

       if($emapData[26] != '') {
       $query4= mysql_query("INSERT INTO `employee_dependent` (`Emp_Code`,`Employee_Number`, `Last_Name`, `First_Name`, `Date_Birth`,`Gender`,`Created_Date`, `Created_By`) VALUES ('$EmpCode_ID','$emapData[1]','$emapData[26]','$emapData[27]','$emapData[28]','$emapData[29]',now(),'$logged_userid')");
        }


       if($emapData[30] != '') {
       $query5= mysql_query("INSERT INTO `employee_dependent` (`Emp_Code`,`Employee_Number`, `Last_Name`, `First_Name`, `Date_Birth`,`Gender`,`Created_Date`, `Created_By`) VALUES ('$EmpCode_ID','$emapData[1]','$emapData[30]','$emapData[31]','$emapData[32]','$emapData[33]',now(),'$logged_userid')");
      }

      if($emapData[34] != '') {
      $query6= mysql_query("INSERT INTO `employee_dependent` (`Emp_Code`,`Employee_Number` ,`Last_Name`, `First_Name`, `Date_Birth`,`Gender`,`Created_Date`, `Created_By`) VALUES ('$EmpCode_ID','$emapData[1]','$emapData[34]','$emapData[35]','$emapData[36]','$emapData[37]',now(),'$logged_userid')");
      }

    }

    }

    if(! $result )
    {
        //$msg .= "Invalid File:Please Upload CSV File";
    }

    } 
        $i++;
    }

    fclose($file);

      $msg .= "CSV File has been successfully Imported.";

    }

   } else{
      $msg = "Invalid File:Please Upload CSV File";
   }

  }  
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Employee Details</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="fonts/font.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/planpiper.css">
		<link rel="shortcut icon" href="images/planpipe_logo.png"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" href="css/bootstrap-timepicker.min.css" />
    <style type="text/css">
      .toolbar {
      float: left;
      }
      .dataTables_filter {
      text-align: center !important;
      }
      td a.edit i {
    color: #FFC107 !important;
    }

    td a.delete {
    color: #F44336;
    } 
       /* Modal styles */
    .modal .modal-dialog {
    max-width: 400px;
    }
    .modal .modal-header, .modal .modal-body, .modal .modal-footer {
    padding: 20px 30px;
    }
    .modal .modal-content {
    border-radius: 3px;
    }
    .modal .modal-footer {
    background: #ecf0f1;
    border-radius: 0 0 3px 3px;
    }
    .modal .modal-title {
    display: inline-block;
    }
    .modal .form-control {
    border-radius: 2px;
    box-shadow: none;
    border-color: #dddddd;
    }
    .modal textarea.form-control {
    resize: vertical;
    }
    .modal .btn {
    border-radius: 2px;
    min-width: 100px;
    } 
    .modal form label {
    font-weight: normal;
    }

    .btn-success {background-color: #004F35;
    border-color: #004F35;font-size: 17px;}
    .btn-success span{
      font-size: 17px;
    }
    .glyphicon { 
    color: #FFC107 !important;
    }
    .largeWidth {
     margin: 0 auto;
     width: 150%;
    }
     .bootbox-body{
      text-align: left !important;
     }
    </style>  
	</head>
	<body style="overflow:hidden;">
	<div id="planpiper_wrapper">
	  	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0" style="height:100%;">
	  	 <div class="col-sm-2 paddingrl0"  id="sidebargrid">
		  	<?php include("sidebar.php");?>
		 </div>
		 <div class="col-sm-10 paddingrl0" id="content_wrapper">
		 	<?php include_once('top_header.php');?>
		 	<section>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0">
        <div id="plantitle">
          <span>Employee Details</span>  &nbsp; &nbsp; &nbsp; &nbsp;<span>Customer ID :  &nbsp; &nbsp;<?php echo $logged_userid;?></span>
        </div>
    </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0" style="margin-top:5px;" id="mainplanlistdiv">

    <a href="add_employee.php" style="margin-left: 16px;"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New Employee</button>
    </a>

    <a href="#addCode" data-toggle="modal"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Upload Excel</button>
    </a>

     

          <div class="table-responsive">
              <table id="example" class="table table-bordered" style="width:100%">
              <thead>
              <tr class="tableheadings">
                  <th>#</th>
                  <th>Employee Name</th>
                  <th>Employee Number</th>
                  <th>Policy ID</th>
                  <th>Mobile Number</th>
                  <th>Email Id</th>
                  <th>City</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php

               $CostId3 = $_GET['CostId'];

                  $query = "SELECT * FROM employee_details WHERE  Created_By= '$logged_userid'";
                  $result = mysql_query($query);
                  $i=1;
                  if(mysql_num_rows($result) > 0){
                  while($row = mysql_fetch_assoc($result)){

                      $Emp_ID = $row['Emp_ID'];
               ?>
               <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $row['First_Name'].' '.$row['Last_Name'];?></td>
                  <td><?php echo $row['Employee_Number'];?></td>
                  <td><?php echo $row['PolicyID'];?></td>
                  <td><?php echo $row['Mobile'];?></td>
                  <td><?php echo $row['Email_Id'];?></td>
                  <td><?php echo $row['City'];?></td>
                  <td><a href="edit_employee.php?EmpId=<?php echo $Emp_ID ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a></td>
              </tr>
             <?php 
                 $i++;
                } 
              }  
             ?>
            </tbody>
          </table>
          </div>
        </div>
		 	</section>
		 </div>
		</div>

  <!-- Add Code -->

  <div id="addCode" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="employee_details.php" name="addCodeForm" id="addCodeForm" method="post" enctype="multipart/form-data">
          <div class="modal-header">            
            <h4 class="modal-title">Upload Employee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
           <div class="modal-body">          
            <div class="form-group">
             <input type="file" name="file" id="file" class="input-large" accept=".csv">
            </div>  
           </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-success btn-sm" data-dismiss="modal" value="Cancel">
            <input id="submit_code" name="Import" type="submit" class="btn btn-success btn-sm" value="Upload">
          </div>
        </form>
      </div>
    </div>
  </div>


	</div><!-- big_wrapper ends -->
      
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/bootbox.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>

  <?php if($msg != '') {?>
       <script type="text/javascript">
          bootbox.alert("<?php echo $msg;?>").find("div.modal-content").addClass("largeWidth");
       </script>
  <?php } ?>

  <script type="text/javascript">
$(document).ready(function() {

    $('#example').DataTable({
        'select': true,
        'ordering': false,
        'info': true,
        'scrollY': 350,
        'scrollX': true,
        'scrollCollapse': true,
        "paging":false,
        "dom": '<"toolbar">frtip',
        "searching": true,
        'language': {
          searchPlaceholder: "Search By Name or Mobile or Email",
          search: "_INPUT_"
        },
         "initComplete": function () {
          $('.dataTables_filter input[type="search"]').css({ 'width': '310px','float': 'left' ,'display': 'inline-block' })
          }
    });
});   

	$(document).ready(function() {
        var w = window.innerWidth;
        var h = window.innerHeight;
        var total = h - 150;
        var each = total/12;
        $('.navbar_li').height(each);
        $('.navbar_href').height(each/2);
        $('.navbar_href').css('padding-top', each/4.9);
        var currentpage = "employee_management";
        $('#'+currentpage).addClass('active');
        $('#plapiper_pagename').html("Employee Management");

        var windowheight = h;
        var available_height = h - 150;
        $('#mainplanlistdiv').height(available_height);

        $('.deactivatethisuser').click(function(){
          var userid = $(this).attr('id');
          //bootbox.alert(userid);
          var merchantid = '<?php echo $logged_merchantid;?>';
          //bootbox.alert(merchantid);
          var deact = confirm("This patient will be deactivated. Click OK to continue");
          if(deact == true){
          var dataString = "type=deactivate_plan_user&userid="+userid+"&merchantid="+merchantid;
          $.ajax({
              type    : 'POST', 
              url     : 'ajax_validation.php', 
              crossDomain : true,
              data    : dataString,
              dataType  : 'json', 
              async   : false,
              success : function (response)
                { 
                  alert("Patient successfully deactivated.");
                  window.location.href = "plan_users.php";
                },
              error: function(error)
              {
                
              }
            }); 
          } else{
            
          }
        });
        var sidebarflag = 1;
        $('#topbar-leftmenu').click(function(){

          if(sidebarflag == 1){
              //$('#sidebargrid').hide(150);
              $('#sidebargrid').hide("slow","swing");
              //$('#content_wrapper').addClass("col-sm-12");
              $('#content_wrapper').removeClass("col-sm-10");
              sidebarflag = 0;
          } else {
              $('#sidebargrid').show("slow","swing");
              $('#content_wrapper').addClass("col-sm-10");
              //$('#content_wrapper').removeClass("col-sm-12");
              sidebarflag = 1;
          }
          
        });
        var merchant = '<?php echo $logged_merchantid;?>';
        <?php include('js/notification.js');?>
	     });
</script>
</body>
</html>