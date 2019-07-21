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
  if (!empty($_GET['CostId']) != '') {
     $CostId = $_REQUEST['CostId'];
   }

   if($_POST['Contract_Code'] != '' && $_POST['Negotiated_Amount'] != ''){


      $Contract_Code   = escapeString($_POST['Contract_Code']);

      $Negotiated_Amount = escapeString($_POST['Negotiated_Amount']);

      $CostId   = escapeString($_POST['CostId']);

      $Instalments   = escapeString($_POST['Instalments']);

      

      mysql_query("DELETE FROM `customer_payment` WHERE `Cust_ID` ='$CostId'");

      mysql_query("DELETE FROM `customer_payment_schedule` WHERE `Cust_ID` ='$CostId'");

      $query = "INSERT INTO `customer_payment` (`Cust_ID`,`Contract_Code`, `Negotiated_Amount`,`Instalments`,`Created_Date`, `Created_By`) VALUES ('$CostId', '$Contract_Code','$Negotiated_Amount','$Instalments',now(),'$CostId')";


       if(mysql_query($query)){

           for($i = 0 ; $i < count($_POST['Payment_Amount']) ; $i++){

            $Payment_Amount = mysql_real_escape_string($_POST['Payment_Amount'][$i]);

            $Payable_Date = date("Y-m-d", strtotime($_POST['Payable_Date'][$i]));

            $Payment_Query = "INSERT INTO `customer_payment_schedule` (`Cust_ID`, `Amount`, `Payable_Date`, `Created_Date`, `Created_By`) VALUES ('$CostId', '$Payment_Amount', '$Payable_Date',now(),'$CostId')";

            mysql_query($Payment_Query);

          }
       }   
   }
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>eTPA - Payment Schedule</title>
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
    <script src="js/bootstrap3-typeahead.min.js"></script>
    <style type="text/css">.error{
     color: #ed0716;
     font-size: 15px;
     font-weight: bold;
}input.amount{
        text-align: right;
        padding-right: 15px;
      }</style>
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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="mainplanlistdiv" style="height: 680px;margin-top:10px;">


    <ul class="nav nav-pills nav-justified">

        <li role="presentation" class="navbartoptabs">
            <a href="premium_calculator.php?CostId=<?php echo $CostId;?>">Premimum Calculations</a>
        </li>

        <li disabled role="presentation" class="active navbartoptabs">
            <a href="Payment_Schedule.php?CostId=<?php echo $CostId;?>">Payment Schedule</a>
        </li>

    </ul>

<form action="<?php echo $_SERVER['PHP_SELF'];?>?CostId=<?php echo $CostId;?>"  name="basicform" id="basicform" method="post" enctype="multipart/form-data">

      <?php 

        $CostId1 = $_REQUEST['CostId'];

          $query = mysql_query("SELECT * FROM customer_setup_details WHERE Cust_ID = '$CostId1'");

          if(mysql_num_rows($query) > 0)
          {
            $row = mysql_fetch_assoc($query);

            $Company_Name = $row['Company_Name'];

            $CostId = $row['Cust_ID'];

          }

      ?>

       <input type="hidden" class="form-control input-sm" id="CostId" name="CostId" value="<?php echo $CostId;?>">

      <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label for="name">Customer Name</label>
            <input type="text" class="form-control input-sm" id="Customer_Name" name="Customer_Name" value="<?php echo $Company_Name;?>" readonly>
        </div>
     </div>

     <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label for="name">Customer Code</label>
            <input type="text" class="form-control input-sm" id="Customer_Code" name="Customer_Code" value="<?php echo $CostId;?>" readonly>
        </div>
      </div>

      <div class="col-md-6 col-sm-6">

        <?php 
        $cost_Id = $_REQUEST['CostId'];
        $total_query = mysql_query("SELECT SUM(amount_payable) total FROM customer_plan WHERE Cust_ID = '$cost_Id'");
        $total_result = mysql_fetch_array($total_query);
        $total_value = $total_result['total'];
        $formatted = number_format($total_value);

        ?>

        <div class="form-group">
            <label for="gender">Calculated Amount</label>
            <div class="input-group"> 
            <span class="input-group-addon">₹</span>
            <input type="text" class="form-control input-sm amount" id="Calculated_Amount" name="Calculated_Amount" value="<?php echo $formatted;?>" readonly>
            </div> 
        </div>
      </div>


      <?php 

          $cost_Id = $_REQUEST['CostId'];

          $query1 = mysql_query("SELECT * FROM customer_payment WHERE Cust_ID = '$cost_Id'");

          if(mysql_num_rows($query1) > 0)
          {
            $row = mysql_fetch_assoc($query1);

            $Negotiated_Amount = $row['Negotiated_Amount'];

            $Contract_Code = $row['Contract_Code'];

            $Instalments = $row['Instalments'];

          }

      ?>

      <div class="col-md-6 col-sm-6">

        <div class="form-group">
            <label for="name">Contract Code</label>
            <input type="text" class="form-control input-sm" id="Contract_Code" name="Contract_Code" value="<?php if($Contract_Code != ''){ echo $Contract_Code;}else{}?>">
        </div>
      </div>

      <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label for="gender">Negotiated Amount</label>
            <div class="input-group"> 
              <span class="input-group-addon">₹</span>
              <input type="text" class="form-control input-sm amount" id="Negotiated_Amount" name="Negotiated_Amount" value="<?php if($Negotiated_Amount != ''){ echo $Negotiated_Amount;}else{}?>">
            </div>
        </div>
     </div>

      <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label for="gender">Instalments</label>
              <select class="form-control input-sm" name="Instalments" id="Instalments">
              <option>Select Number</option>
                  <option <?php if($Instalments==1){echo 'selected';}?> value='1'>1</option>
                  <option <?php if($Instalments==2){echo 'selected';}?> value='2'>2</option>
                  <option <?php if($Instalments==3){echo 'selected';}?> value='3'>3</option>
                  <option <?php if($Instalments==4){echo 'selected';}?> value='4'>4</option>
                  <option <?php if($Instalments==5){echo 'selected';}?> value='5'>5</option>
                  <option <?php if($Instalments==6){echo 'selected';}?> value='6'>6</option>
                  <option <?php if($Instalments==7){echo 'selected';}?> value='7'>7</option>
                  <option <?php if($Instalments==8){echo 'selected';}?> value='8'>8</option>
                  <option <?php if($Instalments==9){echo 'selected';}?> value='9'>9</option>
                  <option <?php if($Instalments==10){echo 'selected';}?> value='10'>10</option>
              </select>
        </div>
      </div>

      <div class="col-md-12 col-sm-12">
            <label for="gender">Payment Schedule</label>
      </div> 


        <?php 

          $cost_Id1 = $_REQUEST['CostId'];

          $query1 = mysql_query("SELECT * FROM `customer_payment_schedule` WHERE Cust_ID = '$cost_Id1'");

          if(mysql_num_rows($query1) > 0)
          {

            while($row = mysql_fetch_assoc($query1)){

            $Amount = $row['Amount'];

            $Payable_Date = date("d-m-Y", strtotime($row['Payable_Date'])); 
            ?>

          <div class="col-md-12 col-sm-12">
              <div class="col-md-4 col-md-offset-2">
                  <div class="form-group">
                    <label for="address">Enter Amount</label>
                    <div class="input-group"> 
                    <span class="input-group-addon">₹</span>
                    <input type="text" class="form-control input-sm amount" name="Payment_Amount[]" value="<?php echo $Amount;?>">
                    </div>
                  </div>
              </div> 
              <div class="col-md-4 col-sm-4">
                  <div class="form-group">
                  <label for="address">Payable on date</label>
                  <input type="text" class="form-control input-sm payable_date" name="Payable_Date[]" value="<?php echo $Payable_Date;?>">
                  </div>
              </div>
          </div>

           <?php  }

          }

      ?>


         <div class="field_wrapper">

             

        </div>  

  <div class="form-group">
		<div class="col-lg-10 col-lg-offset-6">
    <button class="btn btn-primary open1" type="button">Submit </button> 
    <img src="images/spinner.gif" alt="" id="loader" style="display: none">
		</div>
  </div>

	</form> 
	</div>
	</section>
 </div>
</div>	
</div>
</div><!-- big_wrapper ends -->   
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


  $('body').on('keyup',".amount", function(event){
      if(event.which >= 37 && event.which <= 40) return;
      $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      ;
      });
  });


  $("#Instalments").change(function() {
      var elem = $('.field_wrapper').empty();
      var val = $(this).val();
      for (var x = 0; x < val; x++) {
        var fieldHTML = '<div class="col-md-12 col-sm-12"><div class="col-md-4 col-md-offset-2"><div class="form-group"><label for="address">Enter Amount</label><div class="input-group"> <span class="input-group-addon">₹</span><input type="text" class="form-control input-sm amount" name="Payment_Amount[]"></div></div></div> <div class="col-md-4 col-sm-4"><div class="form-group"><label for="address">Payable on date</label><input type="text" class="form-control input-sm payable_date" name="Payable_Date[]"></div></div></div>';
        $(elem).append(fieldHTML); 
      }
  });


   $('body').on('focus',".payable_date", function(){
      $(this).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+10'
        });
    });


    $('.numberonly').bind('keyup paste', function(){
      this.value = this.value.replace(/[^0-9]/g, '');
    });

  jQuery().ready(function() {

    var v = jQuery("#basicform").validate({
      	rules: {
					Contract_Code : "required",
					Negotiated_Amount: "required",
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
        var currentpage = "premimum_payment";
        $('#'+currentpage).addClass('active');
        $('#plapiper_pagename').html("Payment Schedule");
        var windowheight = h;
        var available_height = h - 170;
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