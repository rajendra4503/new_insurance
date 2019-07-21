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
		<title>Summary Data of Subscribers</title>
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
    
     .critical{
      color: red;
     }

    input.amount{
      text-align: right;
      padding-right: 15px;
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

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0" style="margin-top:10px;" id="mainplanlistdiv">

    <ul class="nav nav-pills nav-justified">

        <li role="presentation" class="active navbartoptabs">
            <a href="premium_calculator.php?CostId=<?php echo $CostId;?>">Premimum Calculations</a>
        </li>

        <li disabled role="presentation" class="navbartoptabs">
            <a href="Payment_Schedule.php?CostId=<?php echo $CostId;?>">Payment Schedule</a>
        </li>

    </ul>

<div><b>Summary Data of Subscribers </b></div>
 <table id="example" class="table table-bordered" style="width:100%">
  <thead>
     <tr class="tableheadings">
      <th colspan="0">Plan Name</th>
      <th colspan="0">Annual Coverage</th>
      <th colspan="2">0-10</th>
      <th colspan="2">11-17</th>
      <th colspan="2">18-30</th>
      <th colspan="2">31-45</th>
      <th colspan="2">46-60</th>
      <th colspan="2">60+</th>
      <th colspan="2">Total</th>
    </tr>
    <tr class="tableheadings">
      <th></th>
      <th></th>
      <th>M</th>
      <th>F</th>
      <th>M</th>
      <th>F</th>
      <th>M</th>
      <th>F</th>
      <th>M</th>
      <th>F</th>
      <th>M</th>
      <th>F</th>
      <th>M</th>
      <th>F</th>
      <th>M</th>
      <th>F</th>
    </tr>
  </thead>
  <tbody>

      <?php 
      $CostId = $_REQUEST['CostId'];
      $i=1;
      $query = "SELECT * FROM customer_plan WHERE Cust_ID = '$CostId'";
      $result = mysql_query($query);
      while($row = mysql_fetch_assoc($result)) {

      $psn = $row['plan_sequence_number'];

      $customer_code = $row['Cust_ID'];

      ?>

    <tr>
      <td><?php echo $row['plan_name'];?></td>
      <td><?php echo $row['annual_limit_plan'];?></td>

        <?php 
          $query1 = "SELECT COUNT(CASE WHEN employee_details.Sex='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_details.Sex='Female' THEN 1 END) AS female FROM employee_details WHERE employee_details.Customer_Code = '$CostId' AND employee_details.plan_sequence_number = $psn AND TIMESTAMPDIFF(YEAR,employee_details.Date_Of_Birth,CURDATE()) >= 0 AND TIMESTAMPDIFF(YEAR,employee_details.Date_Of_Birth,CURDATE()) <= 10";
          $totalquery1 = mysql_query($query1);
          $total = mysql_fetch_array($totalquery1);


          $query_dep1 = "SELECT COUNT(CASE WHEN employee_dependent.Gender='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_dependent.Gender='Female' THEN 1 END) AS female FROM employee_dependent WHERE employee_dependent.Customer_Code = '$CostId' AND employee_dependent.plan_sequence_number = $psn AND TIMESTAMPDIFF(YEAR,employee_dependent.Date_Birth,CURDATE()) >= 0 AND TIMESTAMPDIFF(YEAR,employee_dependent.Date_Birth,CURDATE()) <= 10";
          $totalquery_dep1 = mysql_query($query_dep1);
          $total_dep1 = mysql_fetch_array($totalquery_dep1);

        ?>

             <td>
                <?php 
                if($total['male'] > 0 || $total_dep1['male']) {
                echo $total['male']+$total_dep1['male']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>

             <td>
                <?php 
                if($total['female'] > 0 || $total_dep1['female']) {
                echo $total['female']+$total_dep1['female']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>

      <?php 

            $query2 = "SELECT COUNT(CASE WHEN employee_details.Sex='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_details.Sex='Female' THEN 1 END) AS female FROM employee_details WHERE employee_details.Customer_Code = '$CostId' AND employee_details.plan_sequence_number = $psn AND TIMESTAMPDIFF(YEAR,employee_details.Date_Of_Birth,CURDATE()) >= 11 AND TIMESTAMPDIFF(YEAR,employee_details.Date_Of_Birth,CURDATE()) <= 17";
            $totalquery2 = mysql_query($query2);
            $tota2 = mysql_fetch_array($totalquery2);
            $tota2['female'];



          $query_dep2 = "SELECT COUNT(CASE WHEN employee_dependent.Gender='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_dependent.Gender='Female' THEN 1 END) AS female FROM employee_dependent WHERE employee_dependent.Customer_Code = '$CostId' AND employee_dependent.plan_sequence_number = $psn AND TIMESTAMPDIFF(YEAR,employee_dependent.Date_Birth,CURDATE()) >= 0 AND TIMESTAMPDIFF(YEAR,employee_dependent.Date_Birth,CURDATE()) <= 10";
          $totalquery_dep2 = mysql_query($query_dep2);
          $total_dep2 = mysql_fetch_array($totalquery_dep2);
        ?>

            <td>
                <?php 
                if($tota2['male'] > 0 || $total_dep2['male']) {
                echo $tota2['male']+$total_dep2['male']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>

            <td>
                <?php 
                if($tota2['female'] > 0 || $total_dep2['female']) {
                echo $tota2['female']+$total_dep2['female']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>

      <?php 
            $query3 = "SELECT COUNT(CASE WHEN employee_details.Sex='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_details.Sex='Female' THEN 1 END) AS female FROM employee_details WHERE employee_details.Customer_Code = '$CostId' AND employee_details.plan_sequence_number = $psn AND TIMESTAMPDIFF(YEAR,employee_details.Date_Of_Birth,CURDATE()) >= 18 AND TIMESTAMPDIFF(YEAR,employee_details.Date_Of_Birth,CURDATE()) <= 30";
            $totalquery3 = mysql_query($query3);
            $tota3 = mysql_fetch_array($totalquery3);
            $tota3['female'];


          $query_dep3 = "SELECT COUNT(CASE WHEN employee_dependent.Gender='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_dependent.Gender='Female' THEN 1 END) AS female FROM employee_dependent WHERE employee_dependent.Customer_Code = '$CostId' AND employee_dependent.plan_sequence_number = $psn AND TIMESTAMPDIFF(YEAR,employee_dependent.Date_Birth,CURDATE()) >= 18 AND TIMESTAMPDIFF(YEAR,employee_dependent.Date_Birth,CURDATE()) <= 30";

          $totalquery_dep3 = mysql_query($query_dep3);

          $total_dep3 = mysql_fetch_array($totalquery_dep3);

        ?>

            <td>
                <?php 
                if($tota3['male'] > 0 || $total_dep3['male'] > 0) {
                echo $tota3['male']+$total_dep3['male']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>

             <td>
                <?php 
                if($tota3['female'] > 0 || $total_dep3['female'] > 0) {
                echo $tota3['female']+$total_dep3['female']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>

      <?php 
            $query4 = "SELECT COUNT(CASE WHEN employee_details.Sex='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_details.Sex='Female' THEN 1 END) AS female FROM employee_details WHERE employee_details.Customer_Code = '$CostId' AND employee_details.plan_sequence_number = $psn AND TIMESTAMPDIFF(YEAR,employee_details.Date_Of_Birth,CURDATE()) >= 31 AND TIMESTAMPDIFF(YEAR,employee_details.Date_Of_Birth,CURDATE()) <= 45";
            $totalquery4 = mysql_query($query4);
            $tota4 = mysql_fetch_array($totalquery4);
            $tota4['female'];


             $query_dep4 = "SELECT COUNT(CASE WHEN employee_dependent.Gender='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_dependent.Gender='Female' THEN 1 END) AS female FROM employee_dependent WHERE employee_dependent.Customer_Code = '$CostId' AND employee_dependent.plan_sequence_number = $psn AND TIMESTAMPDIFF(YEAR,employee_dependent.Date_Birth,CURDATE()) >= 31 AND TIMESTAMPDIFF(YEAR,employee_dependent.Date_Birth,CURDATE()) <= 45";

             $totalquery_dep4 = mysql_query($query_dep4);

             $total_dep4 = mysql_fetch_array($totalquery_dep4);
        ?>

            <td>
                <?php 
                if($tota4['male'] > 0 || $total_dep4['male'] > 0) {
                echo $tota4['male']+$total_dep4['male']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>

             <td>
                <?php 
                if($tota4['female'] > 0 || $total_dep4['female'] > 0) {
                echo $tota4['female']+$total_dep4['female']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>


      <?php 
            $query5 = "SELECT COUNT(CASE WHEN employee_details.Sex='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_details.Sex='Female' THEN 1 END) AS female FROM employee_details WHERE employee_details.Customer_Code = '$CostId' AND employee_details.plan_sequence_number = $psn AND TIMESTAMPDIFF(YEAR,employee_details.Date_Of_Birth,CURDATE()) >= 46 AND TIMESTAMPDIFF(YEAR,employee_details.Date_Of_Birth,CURDATE()) <= 60";
            $totalquery5 = mysql_query($query5);
            $tota5 = mysql_fetch_array($totalquery5);
            $tota5['female'];


            $query_dep5 = "SELECT COUNT(CASE WHEN employee_dependent.Gender='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_dependent.Gender='Female' THEN 1 END) AS female FROM employee_dependent WHERE employee_dependent.Customer_Code = '$CostId' AND employee_dependent.plan_sequence_number = $psn AND TIMESTAMPDIFF(YEAR,employee_dependent.Date_Birth,CURDATE()) >= 46 AND TIMESTAMPDIFF(YEAR,employee_dependent.Date_Birth,CURDATE()) <= 60";

             $totalquery_dep5 = mysql_query($query_dep5);

             $total_dep5 = mysql_fetch_array($totalquery_dep5);
        ?>


            <td>
                <?php 
                if($tota5['male'] > 0 || $total_dep5['male'] > 0) {
                echo $tota5['male']+$total_dep5['male']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>

             <td>
                <?php 
                if($tota5['female'] > 0 || $total_dep5['female'] > 0) {
                echo $tota5['female']+$total_dep5['female']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>

       <?php 
            $query6 = "SELECT COUNT(CASE WHEN employee_details.Sex='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_details.Sex='Female' THEN 1 END) AS female FROM employee_details WHERE employee_details.Customer_Code = '$CostId' AND employee_details.plan_sequence_number = $psn AND TIMESTAMPDIFF(YEAR,employee_details.Date_Of_Birth,CURDATE()) > 60";
            $totalquery6 = mysql_query($query6);
            $tota6 = mysql_fetch_array($totalquery6);
            $tota6['female'];

             $query_dep6 = "SELECT COUNT(CASE WHEN employee_dependent.Gender='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_dependent.Gender='Female' THEN 1 END) AS female FROM employee_dependent WHERE employee_dependent.Customer_Code = '$CostId' AND employee_dependent.plan_sequence_number = $psn AND TIMESTAMPDIFF(YEAR,employee_dependent.Date_Birth,CURDATE()) > 60";
             $totalquery_dep6 = mysql_query($query_dep6);
             $total_dep6 = mysql_fetch_array($totalquery_dep6);


        ?>


            <td>
                <?php 
                if($tota6['male'] > 0 || $total_dep6['male'] > 0) {
                echo $tota6['male']+$total_dep6['male']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>

            <td>
                <?php 
                if($tota6['female'] > 0 || $total_dep6['female'] > 0) {
                echo $tota6['female']+$total_dep6['female']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>


       <?php 
          $query7 = "SELECT COUNT(CASE WHEN employee_details.Sex='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_details.Sex='Female' THEN 1 END) AS female FROM employee_details WHERE employee_details.Customer_Code = '$CostId' AND employee_details.plan_sequence_number = $psn";
            $totalquery7 = mysql_query($query7);
            $tota7 = mysql_fetch_array($totalquery7);
            $tota7['female'];


          $query_dep7 = "SELECT COUNT(CASE WHEN employee_dependent.Gender='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_dependent.Gender='Female' THEN 1 END) AS female FROM employee_dependent WHERE employee_dependent.Customer_Code = '$CostId' AND employee_dependent.plan_sequence_number = $psn";

          $totalquery_dep7 = mysql_query($query_dep7);
          $total_dep7 = mysql_fetch_array($totalquery_dep7);

        ?>

            <td>
                <?php 
                if($tota7['male'] > 0 || $total_dep7['male'] > 0) {
                echo $tota7['male']+$total_dep7['male']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>

             <td>
                <?php 
                if($tota7['female'] > 0 || $total_dep7['female'] > 0) {
                echo $tota7['female']+$total_dep7['female']; 
                ?>
                (<span class="critical">0</span>)
                <?php } else{}?>
            </td>

    </tr>

     <?php $i++; } ?>
    
  </tbody>
</table>

<div><b>Premium Calculator </b></div>


    <div class="table-responsive">
          <table id="example" class="table table-bordered" style="width:100%">
            <thead>
            <tr class="tableheadings">
                 <th colspan="0">Plan Name</th>
                 <th colspan="0">Annual Coverage</th>
                 <th colspan="2">Total</th>
                 <th colspan="0">Enter Premium</th>
                 <th colspan="0">Total Amount Payable</th>
            </tr>
                <tr class="tableheadings">
                <th></th>
                <th></th>
                <th>M</th>
                <th>F</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>

                <?php 
                    $CostId = $_REQUEST['CostId'];
                    $query = "SELECT * FROM customer_plan WHERE Cust_ID = '$CostId'";
                    $result = mysql_query($query);
                    while($row = mysql_fetch_assoc($result)) {
                    $psn = $row['plan_sequence_number'];
                ?>

                <tr>
                    <td><?php echo $row['plan_name'];?></td>
                    <td><?php echo $row['annual_limit_plan'];?></td>
                    <?php 
                          $query7 = "SELECT COUNT(CASE WHEN employee_details.Sex='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_details.Sex='Female' THEN 1 END) AS female FROM employee_details WHERE employee_details.Customer_Code = '$CostId' AND employee_details.plan_sequence_number = $psn";
                          $totalquery7 = mysql_query($query7);
                          $tota7 = mysql_fetch_array($totalquery7);
                          $tota7['female'];


                          $query_dep7 = "SELECT COUNT(CASE WHEN employee_dependent.Gender='Male' THEN 1 END) AS male,COUNT(CASE WHEN employee_dependent.Gender='Female' THEN 1 END) AS female FROM employee_dependent WHERE employee_dependent.Customer_Code = '$CostId' AND employee_dependent.plan_sequence_number = $psn";

                          $totalquery_dep7 = mysql_query($query_dep7);
                          $total_dep7 = mysql_fetch_array($totalquery_dep7);
                    ?>

                      <td>
                          <?php 
                          if($tota7['male'] > 0 || $total_dep7['male'] > 0) {
                          echo $tota7['male']+$total_dep7['male']; 
                          ?>
                          (<span class="critical">0</span>)
                          <?php } else{}?>
                      </td>

                       <td>
                          <?php 
                          if($tota7['female'] > 0 || $total_dep7['female'] > 0) {
                          echo $tota7['female']+$total_dep7['female']; 
                          ?>
                          (<span class="critical">0</span>)
                          <?php } else{}?>
                      </td>
                    
                    <td>


                      <div class="input-group"> 
                      <span class="input-group-addon">₹</span>
                       <input type="text" class="form-control enter_value amount" id="<?php echo $customer_code.'_'.$psn;?>" placeholder="Enter Value" value="<?php if($row['premium_amount'] != ''){echo $row['premium_amount'];}?>">
                      </div>

                 
                    </td>
                    <td>
                      <div id="amount_<?php echo $customer_code.'_'.$psn;?>">
                      <?php if($row['amount_payable'] != ''){echo number_format($row['amount_payable']);}?>
                      </div>
                  </td>
                </tr>
                <?php } ?>

            </tbody>
          </table>
     </div>

         <div class="form-group col-sm-4"></div>

         <div class="form-group col-sm-4"></div>

         <?php 

         $CostId1 = $_REQUEST['CostId'];

          $total_query = mysql_query("SELECT SUM(amount_payable) total FROM customer_plan WHERE Cust_ID = '$CostId1'");
          $total_result = mysql_fetch_array($total_query);
          $total_value = $total_result['total'];

          $formatted = number_format($total_value);
         ?>

         <div class="form-group col-sm-4">
          <label>Grand Total Estimated Premium </label>
          <div class="input-group"> 
            <span class="input-group-addon">₹</span>
            <input type="text" class="form-control amount" name="Grand_Total" id="Grand_Total" value="<?php echo $formatted;?>" readonly>
            </div> 
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

     $('input.amount').keyup(function(event) {
    if(event.which >= 37 && event.which <= 40) return;
    $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      ;
    });
  });

  $(document).ready(function() {

    $(document).on('keyup', '.enter_value', function() {

       var value = this.value;
       var id = this.id;
       var res = id.split("_");
       var dataString = "customer_code="+res[0]+"&seq_no="+res[1]+"&value="+value;

       $.ajax({
        type: 'POST',
        url: 'ajax/update_premimum_amount.php',
        data    : dataString,
        datatype: 'json',
        cache: false,
        success: function (data) {
            var data1 = $.parseJSON(data);
               if(data1.status == 'ok'){
                  $('#amount_'+id).html(data1.result.amount_payable);

                  $('#Grand_Total').val(data1.result.Grand_Total);
                  
                }else{
                    // bootbox.alert({
                    //    message: "Something wrong contact us.",
                    //    size: 'small'
                    // });
                } 
           }
       });

    });




  $("#addCodeForm").validate({
        rules:{
            code:{required: true},
            code_description:{required: true},
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        messages:{
            code:{
                required: "This field is required"
            },
            code_description:{
                required: "This field is required"
            },
        },
         submitHandler: function(form,e) {
            e.preventDefault();
            console.log('Form submitted');
            $.ajax({
                type: 'POST',
                url: 'ajax/icd_code_insert.php',
                dataType: "html",
                data: $('form').serialize(),
                success: function(result) {
                   var data = $.parseJSON(result);
                    if(data.status == 'ok'){
                        $('#addCode').modal('hide');
                        $('#addCodeForm')[0].reset();
                        bootbox.alert({
                         message: "ICD 10 Code Added Successfully.",
                         size: 'small'
                        });

                    }else{
                      bootbox.alert({
                      message: "Something wrong contact us.",
                      size: 'small'
                      });
                    } 
                },
                error : function(error) {

                }
            });
            return false;
        }
    });
});


 function editFunction(id){

    var codeId = id;

    var dataString = "codeId="+codeId;

    $.ajax({
        type: 'POST',
        url: 'ajax/icd_code_edit.php',
        data    : dataString,
        datatype: 'json',
        cache: false,
        success: function (data) {
            var data1 = $.parseJSON(data);
               if(data1.status == 'ok'){
                  $('#code_edit').val(data1.result.code);
                  $('#edit_code_desc').val(data1.result.desc);
                  $('#edit_code_id').val(data1.result.codeId);
                  $('#editCode').modal('show');  
                }else{
                    bootbox.alert({
                       message: "Something wrong contact us.",
                       size: 'small'
                    });
                } 
           }
       });
  }

   $(document).ready(function() {

   $('#update_code').click(function(e){

      var icd_code      = $('#code_edit').val();

      var icd_desc      = $('#edit_code_desc').val();

      var edit_code_id  = $('#edit_code_id').val();

      var dataString    = "codeId="+edit_code_id+"&icd_code="+icd_code+"&icd_desc="+icd_desc;
      e.preventDefault();
      $.ajax({
          type: 'POST',
          url: 'ajax/icd_code_update.php',
          data : dataString,
          datatype:'json',
          cache: false,
          success: function (data) {
              var data1 = $.parseJSON(data);
                 if(data1.status == 'ok'){
                     $('#codeeditform')[0].reset();
                     $('#editCode').modal('hide');
                     bootbox.alert({
                         message: "ICD 10 Code Updated Successfully.",
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
        var w = window.innerWidth;
        var h = window.innerHeight;
        var total = h - 150;
        var each = total/12;
        $('.navbar_li').height(each);
        $('.navbar_href').height(each/2);
        $('.navbar_href').css('padding-top', each/4.9);
        var currentpage = "premimum_payment";
        $('#'+currentpage).addClass('active');
        $('#plapiper_pagename').html("Summary Data of Subscribers");

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