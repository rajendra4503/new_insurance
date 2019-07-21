<?php
session_start();
ini_set("display_errors","0");
include('include/configinc.php');
include('include/session.php');
include('include/functions.php');

  if (!empty($_GET['CostId']) != '') {
     $CostId = $_REQUEST['CostId'];
   }

  if (!empty($_GET['CostId']) != '') {
    $CostId = $_REQUEST['CostId'];
    $query = "SELECT * FROM customer_setup_details WHERE Cust_ID = '$CostId'";
    $result = mysql_query($query);
    $customer = mysql_fetch_assoc($result);
  }
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Customer Plan List</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/planpiper.css">
		<link rel="stylesheet" type="text/css" href="fonts/font.css">
		<link rel="shortcut icon" href="images/planpipe_logo.png"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link type="text/css" href="css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        td a.edit i {color: #FFC107 !important;}
        td a.delete {color: #F44336;} 
        .btn-success {background-color: #004F35;border-color: #004F35;font-size: 17px;}
        .btn-success span{font-size: 17px;}
         #example td {
        padding: 10px;
        text-align: left;
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


      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0" style="margin-top:10px;" id="mainplanlistdiv">

              <ul class="nav nav-pills nav-justified">

                <li role="presentation" class="navbartoptabs">
                  <a href="customer_edit.php?CostId=<?php echo $_REQUEST['CostId'];?>">Customer Setup</a>
                </li>

                <li role="presentation" class="active navbartoptabs">
                  <a href="customer_new.php?CostId=<?php echo $_REQUEST['CostId'];?>">Customer Plan</a>
                </li>

                <!-- <li role="presentation" class="navbartoptabs">
                  <a href="#">Plan Risk Coverage</a>
                </li>

                <li role="presentation" class="navbartoptabs">
                  <a href="#">Employee Upload</a>
                </li> -->
             </ul>
 
          <div class="col-sm-6"> 
            <form class="form-inline" action="#" method="post">
              <label style="width:110px;" for="inputEmail">Customer Name:</label>
              <input name="ClaimID" class="form-control" type="text" aria-label="Search" style="width: 300px;" value="<?php echo $customer['Company_Name'];?>" readonly>
            </form>
          </div>

          <div class="col-sm-6"> 
            <form class="form-inline" action="#" method="post">
              <label style="width:110px;" for="inputEmail">Customer Code :</label>
              <input name="PatientName" class="form-control" type="text" aria-label="Search" style="width: 300px;" value="<?php echo $customer['Cust_ID'];?>" readonly>
            </form>
          </div>

          <div>&nbsp;</div>

          <div class="col-sm-6"> 
              <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>?CostId=<?php echo $_REQUEST['CostId'];?>" method="post">
              <label style="width:95px;" for="inputEmail">Plan Name:</label>
              <input name="planname" class="form-control" type="text" aria-label="Search" style="width: 300px;">
              <button name="PatientInsIdSubmit" class="btn btn-primary" type="submit">Search</button>
              </form>
          </div>

          <div class="col-sm-6"> 
              <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>?CostId=<?php echo $_REQUEST['CostId'];?>" method="post">
                <label style="width:70px;" for="inputEmail">Status :</label>
                <select name="status" id="status" class="form-control" style="width: 175px;">
                <option>Select Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">InActive</option>
                </select>
                <button name="HospitalNameSubmit" class="btn btn-primary" type="submit">Search</button>
              </form>
          </div>

       <div style="clear: both;">&nbsp;&nbsp;&nbsp;</div>

       <div class="col-sm-12 col-md-offset-1">
          <label class="col-sm-2" for="inputEmail" style="margin-top:10px;">Search By Date  :</label>
          <div class="col-sm-10">
          <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>?CostId=<?php echo $_REQUEST['CostId'];?>" method="post">
               <label for="inputEmail">From&nbsp;&nbsp;</label>
               <input name="admission_from" id="admission_from" class="form-control" type="text" aria-label="Search" style="width: 200px;" required>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label for="inputEmail">To&nbsp;&nbsp;</label>
                <input name="admission_to" id="admission_to" class="form-control" type="text" aria-label="Search" style="width: 200px;" required>
              <button name="AdmissionSubmit" class="btn btn-primary" type="submit">Search</button>
          </form>
        </div>
        </div>
       
      <div style="clear: both;">&nbsp;&nbsp;</div>

      <a href="add_customer_plan.php?CostId=<?php echo $_REQUEST['CostId'];?>" style="margin-left: 16px;">

        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New Plan for this Customer</button>
        
      </a>

  <div class="table-responsive">

      <table id="example" class="table table-bordered" style="width:100%">
          <thead>
            <tr class="tableheadings">
                <th>#</th>
                <th>Plan Name</th>
                <th>Description</th>
                <th>No of Employees</th>
                <th>Status</th>
                <th>Last Action Date</th>
                <th>Action</th>
            </tr>
            </thead>
               <tbody>
                  <?php 
                  if (!empty($_GET['CostId']) != '') {
                    $i=1;
                    $CostId = $_REQUEST['CostId'];

                    $query = "SELECT * FROM customer_plan WHERE Cust_ID = '$CostId'";
                    if (isset($_POST['planname']) !='') {
                      $planname = $_POST['planname'];
                      $query .= " AND plan_name LIKE '%".$planname."%'";
                    }elseif ($_POST['status'] != 'Select Status' && $_POST['status'] !='') {
                       $status = $_POST['status'];
                      $query .= " AND plan_status = '$status'";
                    }
                    //echo $query;
                   $result = mysql_query($query);
                   while($row = mysql_fetch_assoc($result)) {
                   $plan_sequence_number = $row['plan_sequence_number'];
                  ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['plan_name'];?></td>
                    <td><?php echo $row['plan_description'];?></td>
                    <td>
                          <?php 
                            $sel_id= "SELECT COUNT(Employee_Number) AS allemp from employee_details WHERE Customer_Code = '$CostId' AND   plan_sequence_number = $plan_sequence_number";
                            $sel_exeid=mysql_query($sel_id);
                            $empid= mysql_fetch_array($sel_exeid);
                            echo $empid['allemp'];
                          ?>
                    </td>
                    <td><?php echo $row['plan_status'];?></td>
                    <td><?php echo date('d-m-Y',strtotime($row['Created_Date']));?></td>
                    <td id="<?php echo $result['Claim_ID']?>" title='Add Employees' class='reviewuser' style="cursor:pointer;">
                    
                    <a href="customer_employee_details.php?CostId=<?php echo $CostId ;?>&seqno=<?php echo $plan_sequence_number;?>" class="edit" data-toggle="modal"><img style="width:25px;" src="images/Upload-File-Icon-01.png"></a>
                    &nbsp;&nbsp;
                    <a href="inclusions_exclusions_edit.php?CostId=<?php echo $CostId ;?>&seqno=<?php echo $plan_sequence_number;?>" class="edit" data-toggle="modal"><img style="width:30px;" src="images/Inclusion-Exclsuion-01.png"></a>

                    </td>
               </tr>
             <?php $i++; } } ?>
              </tbody>
          </table>
          </div>
        </div>
		 	</section>
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
  <script type="text/javascript">

    $(function() {
        $( "#submission_from" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+10'
        });
    });

    $(function() {
        $( "#submission_to" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+10'
        });
    });

    $(function() {
        $( "#admission_from" ).datepicker({
          dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+10'
        });
    });

    $(function() {
        $( "#admission_to" ).datepicker({
          dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+10'
        });
    });
 
    $('#example').DataTable({
        'select': true,
        'ordering': false,
        'info': false,
        'scrollY':220,
        'scrollCollapse': true,
        "paging":false,
        "dom": '<"toolbar">frtip',
        "searching": false,
        'language': {
          searchPlaceholder: "Search Patients By Patient Name Or Email.<?php if(isset($SearchPatients) &&  $SearchPatients !=''){echo '('.$SearchPatients.')';}?>",
          search: "_INPUT_"
        },
         "initComplete": function () {
          $('.dataTables_filter input[type="search"]').css({ 'width': '310px', 'display': 'inline-block' })
          }
    });

	$(document).ready(function() {
        var w = window.innerWidth;
        var h = window.innerHeight;
        var total = h - 150;
        var each = total/12;
        $('.navbar_li').height(each);
        $('.navbar_href').height(each/2);
        $('.navbar_href').css('padding-top', each/4.9);
        var currentpage = "patients_claim";
        $('#'+currentpage).addClass('active');
        $('#plapiper_pagename').html("Claim Search");

        var windowheight = h;
        var available_height = h - 110;
        $('#mainplanlistdiv').height(available_height);
        
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