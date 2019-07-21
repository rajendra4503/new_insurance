<?php
session_start();
ini_set("display_errors","0");
include('include/configinc.php');
include('include/session.php');
include('include/functions.php');
if (!empty($_GET['MarkId']) != '') {
         $MarkId = $_REQUEST['MarkId'];
       }
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
          <span>Brokerage & Commissions Report</span>
        </div>
    </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0" style="margin-top:5px;" id="mainplanlistdiv">


           <div class="col-sm-12"> 
                <?php

                $MarkId = $_REQUEST['MarkId']; 

                $query2 = "SELECT First_Name,Last_Name FROM marketing_officer_details WHERE Officer_ID = $MarkId";

                $result2 = mysql_query($query2);

                $test2 = mysql_fetch_assoc($result2);

                $marketing_officer = $test2['First_Name'].' '.$test2['Last_Name'];

                ?>
                <label class="col-sm-3" for="inputEmail">Brokerage & Commissions Report For</label>
                <input name="PatientInsId" class="form-control col-sm-6" type="text" aria-label="Search" style="width: 400px;" value="<?php echo $marketing_officer;?>">
          </div>


           <div style="clear: both;">&nbsp;&nbsp;&nbsp;</div>

       
          <div class="table-responsive">
              <table id="example" class="table table-bordered" style="width:100%">
              <thead>
              <tr class="tableheadings">
                  <th>#</th>
                  <th>Customer Name</th>
                  <th>Customer Code</th>
                  <th>Contract Code</th>
                  <th>Contract Date</th>
                  <th>Name</th>
                  <th>Brokerage / Commissions</th>
              </tr>
            </thead>
            <tbody>
                  <?php 

                  $MarkId = $_REQUEST['MarkId']; 

                  $query = "SELECT * FROM customer_setup_details WHERE Marketing_OfficerName = $MarkId";
                  $result = mysql_query($query);
                  $i=1;
                  if(mysql_num_rows($result) > 0)
                  {
                  while($row = mysql_fetch_assoc($result))
                  {  

                  $Agent_ID    = $row['AgentName_BrokerName'];

                  $Officer_ID  = $row['Marketing_OfficerName'];

                  $Cust_ID = $row['Cust_ID'];

              
                  $query2 = "SELECT First_Name,Last_Name,Commission_Percentage FROM marketing_officer_details WHERE Officer_ID = $Officer_ID";
                  $result2 = mysql_query($query2);
                  $test2 = mysql_fetch_assoc($result2);
                  $marketing_officer = $test2['First_Name'].' '.$test2['Last_Name'];
                  $Commission_Percentage = $test2['Commission_Percentage'];


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
                        <?php echo $marketing_officer;?>
                      </td>
                      <td>
                        <?php echo $Commission_Percentage;?>
                      </td>
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