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
		<title>Customer Activation/De-activation</title>
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
        .glyphicon-ok{
          color: green;
        }
        .glyphicon-remove{
          color: red;
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

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0">
      <div id="plantitle">
          <span>Customer Activation/De-activation</span>
      </div>
     </div>

  <div class="table-responsive">

      <table id="example" class="table table-bordered" style="width:100%">
          <thead>
            <tr class="tableheadings">
                <th>#</th>
                <th>Plan Name</th>
                <th>Description</th>
                <th>No of Employees</th>
                <th>Plan Status</th>
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
                    <td class='reviewuser'>

                      <a href="JavaScript:void(0);" onclick="activate_plan('Active','<?php echo $plan_sequence_number;?>','<?php echo $CostId;?>')" class="edit" data-toggle="modal">
                      <span class="glyphicon glyphicon-ok"></span>
                      </a>

                      &nbsp;&nbsp;
                      <a href="JavaScript:void(0);" onclick="deactivate_plan('Inactive','<?php echo $plan_sequence_number;?>','<?php echo $CostId;?>')" class="edit"><span class="glyphicon glyphicon-remove"></span></a>

                   
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


  <!-- Activate Code HTML -->
  <div id="activateplan" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form name="activateplanform" id="activateplanform" method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Enter Activation Date</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <div class="form-group">
              <label>Date</label>
              <input id="activate_date" name="activate_date" type="text" class="form-control">
            </div>
            <div class="form-group">
              <label>Comments</label>
              <input id="activate_desc" name="activate_desc" type="text" class="form-control">
            </div>   
          </div>
          <input type="hidden" name="activate_seqno" id="activate_seqno" value="">
          <input type="hidden" name="activate_status" id="activate_status" value="">
          <input type="hidden" name="activate_custId" id="activate_custId" value="">
          <div class="modal-footer">
            <input type="hidden" name="edit_code_id" id="edit_code_id" value="">
            <input type="button" class="btn btn-success btn-sm" data-dismiss="modal" value="Cancel">
            <input id="activate_submit" type="submit" class="btn btn-success btn-sm" value="Submit">
          </div>
        </form>
      </div>
    </div>
  </div>



    <!-- Activate Code HTML -->
  <div id="inactivateplan" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form name="inactivateplanform" id="inactivateplanform" method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Enter De-Activation Date</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <div class="form-group">
              <label>Date</label>
              <input id="inactivate_date" name="inactivate_date" type="text" class="form-control">
            </div>
            <div class="form-group">
              <label>Comments</label>
              <input id="inactivatedesc" name="inactivatedesc" type="text" class="form-control">
            </div>   
          </div>
      <input type="hidden" name="inactivate_seqno" id="inactivate_seqno" value="">
      <input type="hidden" name="inactivate_status" id="inactivate_status" value="">
      <input type="hidden" name="inactivate_custId" id="inactivate_custId" value="">
          <div class="modal-footer">
            <input type="hidden" name="edit_code_id" id="edit_code_id" value="">
            <input type="button" class="btn btn-success btn-sm" data-dismiss="modal" value="Cancel">
            <input id="inactivate_submit" type="submit" class="btn btn-success btn-sm" value="Submit">
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
  <script type="text/javascript">


    $(function() {
        $( "#inactivate_date" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+10'
        });
    });

    $(function() {
        $( "#activate_date" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+10'
        });
    });


      function deactivate_plan(status,planseq,cust_id){

          $('#inactivate_seqno').val(planseq); 

          $('#inactivate_status').val(status); 

          $('#inactivate_custId').val(cust_id);

          $('#inactivateplan').modal('show');
      }


    function activate_plan(status,planseq,cust_id){

          $('#activate_seqno').val(planseq); 

          $('#activate_status').val(status); 

          $('#activate_custId').val(cust_id);

          $('#activateplan').modal('show');
    }

  $(document).ready(function() {

   $('#activate_submit').click(function(e){

      var date     =   $('#activate_date').val();

      var desc     =   $('#activate_desc').val();

      var seqno    =   $('#activate_seqno').val(); 

      var status   =   $('#activate_status').val(); 

      var cust_id  =   $('#activate_custId').val();

      var dataString    = "date="+date+"&desc="+desc+"&seqno="+seqno+"&status="+status+"&cust_id="+cust_id;

      e.preventDefault();
      $.ajax({
          type: 'POST',
          url: 'ajax/plan_acivate.php',
          data : dataString,
          datatype:'json',
          cache: false,
          success: function (data) {
              var data1 = $.parseJSON(data);
                 if(data1.status == 'ok'){
                     $('#activateplanform')[0].reset();
                     $('#activateplan').modal('hide');
                     bootbox.alert({
                         message: "Activation Date Updated Successfully.",
                         size: 'small'
                      });
                  }else{
                      bootbox.alert({
                         message: "Something wrong contact us.",
                         size: 'small'
                      });
                  } 
             }
         });
    });

 });


 $(document).ready(function() {

      $('#inactivateplanform').click(function(e){

      var date     =   $('#inactivate_date').val();

      var desc     =   $('#inactivatedesc').val();

      var seqno    =   $('#inactivate_seqno').val(); 

      var status   =   $('#inactivate_status').val(); 

      var cust_id  =   $('#inactivate_custId').val();

      var dataString    = "date="+date+"&desc="+desc+"&seqno="+seqno+"&status="+status+"&cust_id="+cust_id;

      e.preventDefault();
      $.ajax({
          type: 'POST',
          url: 'ajax/plan_inacivate.php',
          data : dataString,
          datatype:'json',
          cache: false,
          success: function (data) {
              var data1 = $.parseJSON(data);
                 if(data1.status == 'ok'){
                     $('#inactivateplanform')[0].reset();
                     $('#inactivateplan').modal('hide');
                     bootbox.alert({
                         message: "InActivation Date Updated Successfully.",
                         size: 'small'
                      });
                  }else{
                      bootbox.alert({
                         message: "Something wrong contact us.",
                         size: 'small'
                      });
                  } 
             }
         });
    });

  });  



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
        'scrollY':380,
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
        $('#plapiper_pagename').html("Customer Activation/De-activation");

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