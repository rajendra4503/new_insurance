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

if (!empty($_GET['EmpNo']) != '') {

    $EmpNo = $_GET['EmpNo'];

    $CostId = $_GET['CostId'];

    $PlanSeq1 = $_GET['PlanSeq'];

    $query = "SELECT * FROM employee_details WHERE Employee_Number = '$EmpNo' AND Customer_Code = '$CostId' AND plan_sequence_number = $PlanSeq1";

    $result = mysql_query($query);

    $employee = mysql_fetch_assoc($result);

    $CostId = $employee['Customer_Code'];

    $PlanSeq = $employee['plan_sequence_number'];


    $EmpID =  $employee['Emp_ID'];

    $Employee_Number =  $employee['Employee_Number'];



    $PolicyID =  $employee['PolicyID'];  
} 
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>eTPA - Employee Details</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/planpiper.css">
    <link rel="stylesheet" type="text/css" href="fonts/font.css">
    <link rel="shortcut icon" href="images/planpipe_logo.png"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootbox.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="js/bootstrap3-typeahead.min.js"></script>
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
          <span>Customer ID :<?php echo $CostId;?></span>
          <span>&nbsp;Employee Number : <?php echo $Employee_Number?> </span>  &nbsp; &nbsp; Policy ID : <?php echo $PolicyID; ?>  &nbsp; &nbsp;
        </div>
    </div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="mainplanlistdiv" style="height: 680px;">

<form action="customer_employee_details.php?CostId=<?php echo $CostId;?>&seqno=<?php echo $PlanSeq;?>" name="basicform" id="basicform" method="post" enctype="multipart/form-data">

<input type="hidden" name="type" value="update">

<input type="hidden" name="EmpNo" value="<?php echo $EmpNo;?>">

<input type="hidden" name="CostId" value="<?php echo $CostId;?>">

<input type="hidden" name="PlanSeq" value="<?php echo $PlanSeq;?>">


  <div class="col-md-6 col-sm-6">

        <div class="form-group">
            <label for="name">Employee Number *</label>
            <input disabled value="<?php echo $employee['Employee_Number'];?>" type="text" class="form-control input-sm" id="employee_number" name="employee_number" required>
        </div>

        <div class="form-group">
            <label for="name">Last Name *</label>
            <input value="<?php echo $employee['Last_Name'];?>" type="text" class="form-control input-sm" id="last_name" name="last_name" placeholder="" required>
        </div>

        <div class="form-group">
            <label for="name">First Name *</label>
            <input value="<?php echo $employee['First_Name'];?>" type="text" class="form-control input-sm" id="first_name" name="first_name" placeholder="" required>
        </div>

        <div class="form-group">
            <label for="name">Date of Birth *</label>
            <input value="<?php if($employee['Date_Of_Birth'] != '0000-00-00' && $employee['Date_Of_Birth'] != ''){  echo date("d-m-Y", strtotime($employee['Date_Of_Birth']));}else{}?>" type="text" class="form-control input-sm" id="date_birth" name="date_birth" required>
        </div>



        <div class = "form-group">
            <label for="years">Gender *</label>  
            <select class="form-control input-sm" name="sex" id="sex" required>
            <option>-- Select --</option>
            <option <?php if($employee['Sex'] == 'Male'){ echo 'selected';}?> value="Male">Male</option>
            <option <?php if($employee['Sex'] == 'Female'){ echo 'selected';}?> value="Female">Female</option>
            <option <?php if($employee['Sex'] == 'Transgender'){ echo 'selected';}?> value="Transgender">Transgender</option>
            </select>
        </div>

        <div class="form-group">
            <label for="gender">Mobile Number</label>
            <input value="<?php echo $employee['Mobile'];?>"  type="text" class="form-control input-sm numberonly" id="mobile_number" name="mobile_number" placeholder="" required>
        </div>

        <div class="form-group">
            <label for="name">Email ID *</label>
            <input value="<?php echo $employee['Email_Id'];?>" type="email" class="form-control input-sm" id="email" name="email" placeholder="" required>
        </div>
  </div>

  <div class="col-md-6 col-sm-6">

      <div class="form-group">
         <label for="address">Address Line 1</label>
         <input value="<?php echo $employee['Address_Line1'];?>" type="text" class="form-control input-sm" name="address_1" id="address_1" required>
       </div>

       <div class="form-group">
         <label for="address">Address Line 2</label>
         <input value="<?php echo $employee['Adress_Line2'];?>" type="text" class="form-control input-sm" name="address_2"  id="address_2" required>
       </div>

       <div class="form-group">
          <label for="country">Country *</label>
          <input value="<?php echo $employee['Country'];?>" type="text" class="form-control input-sm" id="country" name="country" placeholder="" required>
       </div>

      <div class="form-group">
          <label for="state">State *</label>
          <input value="<?php echo $employee['State'];?>" type="text" class="form-control input-sm" id="state" name="state" placeholder="" required>
      </div>

      <div class="form-group">
          <label for="city">City *</label>
          <input value="<?php echo $employee['City'];?>" type="text" class="form-control input-sm" id="city" name="city" placeholder="" required>
      </div>

      <div class="form-group">
          <label for="pincode">Postal Code *</label>
          <input value="<?php echo $employee['Postal_Code'];?>" type="text" class="form-control input-sm numberonly" id="postal_code" name="postal_code" placeholder="" required>
      </div>
 </div>

  <div class="form-group">
    <div class="col-lg-10 col-lg-offset-6">
    <button class="btn btn-primary open1" type="button">Update</button> 
    <img src="images/spinner.gif" alt="" id="loader" style="display: none">
    </div>
  </div>
  </form>

  <div class="col-sm-6">
     <a href="#addCode" data-toggle="modal">
      <button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Dependent</button>
     </a>
  </div>

 <div class="col-md-12 col-sm-12">

     <table id="example" class="display" style="width:100%;">
      <thead>
          <tr>
              <th>#</th>
              <th>Last Name</th>
              <th>First Name</th>
              <th>Gender</th>
              <th>Date Of Birth</th>
              <th>Action</th>
          </tr>
      </thead>
    </table>

 </div>	

  </div>
  </section>
 </div>
</div>  
</div>
</div><!-- big_wrapper ends -->

  <!-- Add Code -->
  <div id="addCode" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form name="addCodeForm" id="addCodeForm">
          <div class="modal-header">            
            <h4 class="modal-title">Add Dependent</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">

              <input hidden type="text" name="EmpNo" id="EmpNo" value="<?php echo $EmpNo;?>">

              <input hidden type="text" name="CostId" id="CostId" value="<?php echo $CostId;?>">

              <input hidden type="text" name="PlanSeq" id="PlanSeq" value="<?php echo $PlanSeq;?>">

            <div class="form-group">
              <label>Last Name</label>
              <input name="last_name1" id="last_name1" type="text" class="form-control" required>
            </div>

            <div class="form-group">
              <label>First Name</label>
              <input name="first_name1" id="first_name1" type="text" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Gender</label>
              <select class="form-control" name="gender1" id="gender1">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Transgender">Transgender</option>
              </select>
            </div>

            <div class="form-group">
              <label>Date of Birth*</label>
              <input name="date_birth1" type="text" class="form-control" id="date_birth1">
            </div>

          </div>
          <div class="modal-footer">
              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
              <input id="submit_code" type="submit" class="btn btn-success" value="Add">
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Edit Code HTML -->
  <div id="editCode" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form name="update_code_form" id="update_code_form">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Emp</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <input hidden type="text" name="IDcode3" id="IDcode3">
            <div class="form-group">
              <label>Last Name</label>
              <input name="last_name3" id="last_name3" type="text" class="form-control" required>
            </div>

            <div class="form-group">
              <label>First Name</label>
              <input name="first_name3" id="first_name3" type="text" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Gender</label>
              <select class="form-control" name="gender3" id="gender3">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Transgender">Transgender</option>
              </select>
            </div>

            <div class="form-group">
              <label>Date of Birth*</label>
              <input name="date_birth3" type="text" class="form-control" id="date_birth3">
            </div>

          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input id="update_code"  type="submit" class="btn btn-info" value="Update">
          </div>
        </form>
      </div>
    </div>
  </div>

<script type="text/javascript">

  $.fn.dataTable.ext.errMode = 'none';

  $('.numberonly').bind('keyup paste', function(){
      this.value = this.value.replace(/[^0-9]/g, '');
  });

  $("#date_birth").keypress(function(event) {event.preventDefault();});
  $("#date_birth3").keypress(function(event) {event.preventDefault();});
  $("#date_birth1").keypress(function(event) {event.preventDefault();});

  $(function() {
        $( "#date_birth" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });

        $( "#date_birth3" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });

         $( "#date_birth1" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });

  $(document).ready(function() {

    oTable = $('#example').DataTable( {
          "processing": true,
          "ajax": {
            "url": "ajax/employee_dependent_list.php",
            "type": "POST",
            "data" : {
              "EmpNo":"<?php echo $_GET['EmpNo'];?>",
              "CostId":"<?php echo $_GET['CostId'];?>",
              "PlanSeq":"<?php echo $_GET['PlanSeq'];?>"
            },
          },
          "scrollY":"300px",
          "scrollCollapse": true,
          "paging":false,
          "ordering": false,
          "info":     true
    });

     $('#emp_code').on('keyup change', function(){
       oTable.search($(this).val()).draw();
     });

     $('#emp_name').on('keyup change', function(){
       oTable.search($(this).val()).draw();
     });
     
});

  $(document).ready(function() {
      $("#addCodeForm").validate({
        rules:{
            first_name1:{required: true},
            last_name1:{required: true},
            date_birth1:{required: true},
            gender1:{required: true},
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
         submitHandler: function(form,e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'ajax/employee_dependent_insert.php',
                dataType: "html",
                data: $('#addCodeForm').serialize(),
                success: function(result) {
                  var data1 = $.parseJSON(result);
                  if(data1.status == 'ok'){
                   $('#addCode').modal('hide');
                   $('#addCodeForm')[0].reset();
                    bootbox.alert({
                       message: "Employee Dependent Added Successfully.",
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


 $(document).ready(function() {
      $("#update_code_form").validate({
        rules:{
            last_name3:{required: true},
            first_name3:{required: true},
            gender3:{required: true},
            date_birth3:{required: true},
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
         submitHandler: function(form,e) {
            e.preventDefault();
            console.log('Form submitted');
            $.ajax({
                type: 'POST',
                url: 'ajax/employee_dependent_update.php',
                dataType: "html",
                data: $('#update_code_form').serialize(),
                success: function(result) {
                  var data1 = $.parseJSON(result);
                  if(data1.status == 'ok'){
                   $('#editCode').modal('hide');
                   $('#update_code_form')[0].reset();
                    bootbox.alert({
                       message: "Employee Dependent Updated Successfully.",
                       size: 'small'
                    });
                  }else{
                    bootbox.alert({
                       message: "Something Wrong Contact Us.",
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
    var codeId = {
        codeId : id,
    };
    $.ajax({
        type: 'POST',
        url: 'ajax/employee_dependent_edit.php',
        data: codeId,
        success: function (data) {
            var data1 = $.parseJSON(data);
               if(data1.status == 'ok'){
                    $('#first_name3').val(data1.result.first_name);
                    $('#last_name3').val(data1.result.last_name);
                    $('#IDcode3').val(data1.result.IDcode);
                    var gendervalue = data1.result.gender;
                    $('#gender3 option[value='+gendervalue+']').attr('selected',true);
                    $('#date_birth3').val(data1.result.date_birth);                   
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


  jQuery().ready(function() {

    var v = jQuery("#basicform").validate({
        rules: {
          employee_number : "required",
          last_name : "required",
          address_1: "required",
          first_name: "required",
          date_birth:{
              required: true
          },
          address_2:"required",
          mobile_number:{
              required: true,
              digits: true
              },
          email:{
                 required: true,
                 email: true,
          },
          country : "required",
          state:"required",
          city:"required",
          postal_code:{
              required: true,
              digits: true
          },
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
          error.addClass( "help-block" );
          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
          } else {
            error.insertAfter( element );
          }
        },
        highlight: function ( element, errorClass, validClass ) {
        },
        unhighlight: function (element, errorClass, validClass) {
        }
    });

    $(".open1").click(function() {
      if (v.form()) {
        $("#loader").show();
         setTimeout(function(){
           $( "#basicform" ).submit();
         }, 1000);
        return false;
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
        var available_height = h - 120;
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