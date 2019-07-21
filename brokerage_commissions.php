<?php
session_start();
ini_set("display_errors","0");
include('include/configinc.php');
include('include/session.php');
include('include/functions.php');
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Brokerage & Commissions</title>
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
        .glyphicon { 
        color: #FFC107 !important;
        top: -6px;
        }
        td a.delete {
        color: #F44336;
        } 
        .btn-success {background-color: #004F35;
        border-color: #004F35;font-size: 17px;}
        .btn-success span{
        font-size: 17px;
        }
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

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0">
        <div id="plantitle">
          <span>Brokerage & Commissions</span>
        </div>
    </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0" style="margin-top:5px;" id="mainplanlistdiv">


           <div class="col-sm-6"> 
              <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
              <label style="width:110px;" for="inputEmail">Customer Name</label>
              <input name="customer_name" class="form-control" type="text" aria-label="Search" style="width: 300px;" required>
              <button name="PatientInsIdSubmit" class="btn btn-primary" type="submit">Search</button>
              </form>
           </div>

          <div class="col-sm-6"> 
              <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
              <label style="width:110px;" for="inputEmail">Customer Code</label>
              <input name="customer_code" class="form-control" type="text" aria-label="Search" style="width: 300px;" required>
              <button name="PatientInsIdSubmit" class="btn btn-primary" type="submit">Search</button>
              </form>
          </div>

          <div>&nbsp;</div>

          <div class="col-sm-6"> 
              <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
              <label style="width:110px;" for="inputEmail">Contract Code</label>
              <input name="contract_code" class="form-control" type="text" aria-label="Search" style="width: 300px;" required>
              <button name="PatientInsIdSubmit" class="btn btn-primary" type="submit">Search</button>
              </form>
          </div>

          <div class="col-sm-6"> 
              <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
              <label style="width:110px;" for="inputEmail">Status</label>
              <select name="status" id="status" class="form-control" style="width: 300px;" required>
              <option>Select Status</option>
              <option value="1">Active</option>
              <option value="0">InActive</option>
              </select>
              <button name="HospitalNameSubmit" class="btn btn-primary" type="submit">Search</button>
              </form>
          </div>

          <div>&nbsp;</div>

           <div class="col-sm-6"> 
              <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
              <label style="width:110px;" for="inputEmail">Agent / Broker</label>
              <select name="agent" id="agent" class="form-control" style="width: 300px;" required>
                <option value=''>Select Agent / Broker</option>
                <?php 
                $query = "SELECT * FROM agent_broker_details";
                $results = mysql_query($query);
                while($row = mysql_fetch_assoc($results)){ ?>
                <option value="<?php echo $row['Agent_ID']; ?>"><?php echo $row['First_Name'].' '.$row['Last_Name']; ?></option>
                <?php  } ?>
              </select>
              <button name="HospitalNameSubmit" class="btn btn-primary" type="submit">Search</button>
              </form>
          </div>

           <div class="col-sm-6"> 
              <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
              <label style="width:110px;" for="inputEmail">Marketing Officer</label>
              <select name="officer" id="officer" class="form-control" style="width: 300px;" required>
                <option value=''>Select Marketing Officer Name</option>
                <?php 
                $query = "SELECT * FROM marketing_officer_details";
                $results = mysql_query($query);
                while($row = mysql_fetch_assoc($results)){ ?>
                <option value="<?php echo $row['Officer_ID']; ?>"><?php echo $row['First_Name'].' '.$row['Last_Name']; ?></option>
                <?php  } ?>
              </select>
              <button name="HospitalNameSubmit" class="btn btn-primary" type="submit">Search</button>
              </form>
          </div>


           <div style="clear: both;">&nbsp;&nbsp;&nbsp;</div>

       <div class="col-sm-12 col-md-offset-1">
          <label class="col-sm-2" for="inputEmail" style="margin-top:10px;">Search By Date  :</label>
          <div class="col-sm-10">
          <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
               <label for="inputEmail">From&nbsp;&nbsp;</label>
               <input name="admission_from" id="admission_from" class="form-control" type="text" aria-label="Search" style="width: 200px;" required>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label for="inputEmail">To&nbsp;&nbsp;</label>
                <input name="admission_to" id="admission_to" class="form-control" type="text" aria-label="Search" style="width: 200px;" required>
              <button name="AdmissionSubmit" class="btn btn-primary" type="submit">Search</button>
          </form>
        </div>
        </div>

          <div class="table-responsive">
              <table id="example" class="table table-bordered" style="width:100%">
              <thead>
              <tr class="tableheadings">
                  <th>#</th>
                  <th>Customer Name</th>
                  <th>Customer Code</th>
                  <th>Contract Code</th>
                  <th>Contract Date</th>
                  <th>Agent Name / Broker Name</th>
                  <th>Marketing /Officer Name</th>
                  <th>No Of Employees</th>
                  <th>Customer Status</th>
              </tr>
            </thead>
            <tbody>
                  <?php 

                  $query = "SELECT * FROM customer_setup_details";

                  if (isset($_POST['customer_name']) !='') {
                    $customer_name = $_POST['customer_name'];
                    $query .= " WHERE Company_Name LIKE '%".$customer_name."%'";
                  }elseif($_POST['customer_code'] !='') {
                      $customer_code = $_POST['customer_code'];
                      $query .= " WHERE Cust_ID = '$customer_code'";
                  }elseif($_POST['agent'] !='') {
                      $agent = $_POST['agent'];
                      $query .= " WHERE AgentName_BrokerName = $agent";
                  }elseif($_POST['officer'] !='') {
                      $officer = $_POST['officer'];
                      $query .= " WHERE Marketing_OfficerName = $officer";
                  }elseif($_POST['officer'] !='') {
                      $officer = $_POST['officer'];
                      $query .= " WHERE Marketing_OfficerName = $officer";
                  }elseif(isset($_POST['contract_code']) !='') {
                   $contract_code1 = $_POST['contract_code'];
                   $query .= " AS CUST JOIN customer_payment AS CP ON CUST.Cust_ID = CP.Cust_ID WHERE CP.Contract_Code = '$contract_code1'";
                  }

                  $result = mysql_query($query);
                  $i=1;
                  if(mysql_num_rows($result) > 0)
                  {
                  while($row = mysql_fetch_assoc($result))
                  {  

                  $Agent_ID    = $row['AgentName_BrokerName'];

                  $Officer_ID  = $row['Marketing_OfficerName'];

                  $Cust_ID = $row['Cust_ID'];

                $query1 = "SELECT First_Name,Last_Name FROM agent_broker_details WHERE Agent_ID = $Agent_ID";
                $result1 = mysql_query($query1);
                $test1 = mysql_fetch_assoc($result1);
                $agent_broker = $test1['First_Name'].' '.$test1['Last_Name'];


                $query2 = "SELECT First_Name,Last_Name FROM marketing_officer_details WHERE Officer_ID = $Officer_ID";
                $result2 = mysql_query($query2);
                $test2 = mysql_fetch_assoc($result2);
                $marketing_officer = $test2['First_Name'].' '.$test2['Last_Name'];



                $sel_id= "SELECT COUNT(Employee_Number) AS allemp from employee_details WHERE Customer_Code = '$Cust_ID'";
                $sel_exeid=mysql_query($sel_id);
                $empid= mysql_fetch_array($sel_exeid);
                $allemp =  $empid['allemp'];


                $contract_query = mysql_query("SELECT * from customer_payment WHERE Cust_ID = '$Cust_ID'");

                $contract = mysql_fetch_array($contract_query);
                $contract_code =  $contract['Contract_Code'];
                if($contract['Created_Date'] != ''){
                  $contract_date = date('d-m-Y',strtotime($contract['Created_Date']));
                }else{
                  $contract_date = '';
                }

                  ?>
                    <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $row['Company_Name'];?></td>
                      <td><?php echo $Cust_ID;?></td>
                      <td><?php echo $contract_code;?></td>
                      <td><?php echo $contract_date;?></td>
                      <td> 
                        <a href="brokerage_commissions_agent.php?AgentId=<?php echo $Agent_ID;?>">
                        <?php echo $agent_broker;?>
                        </a>
                      </td>
                      <td>
                        <a href="brokerage_commissions_officer.php?MarkId=<?php echo $Officer_ID;?>">
                        <?php echo $marketing_officer;?>
                        </a>
                      </td>
                      <td><?php echo $allemp;?></td>
                      <td></td>
                    </tr>
                  <?php 
                  $i++;
                  } }?>
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
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>

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

$("#admission_from").keypress(function(event) {event.preventDefault();});
$("#admission_to").keypress(function(event) {event.preventDefault();});
  $(function() {
        $( "#admission_from" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+10',
           
        });

        $( "#admission_to" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+10',
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
        var currentpage = "Brokerage_Commissions";
        $('#'+currentpage).addClass('active');
        $('#plapiper_pagename').html("Brokerage & Commissions");

        var windowheight = h;
        var available_height = h - 150;
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