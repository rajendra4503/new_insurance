<?php
session_start();

ini_set("display_errors","0");

include('include/configinc.php');

include('include/session.php');

include('include/functions.php');

require('library/php-excel-reader/excel_reader2.php');

require('library/SpreadsheetReader.php');

  $logged_userid = $_SESSION['logged_userid'];

  function escapeString($string) {
    return mysql_real_escape_string($string);
  }

  if (!empty($_GET['CostId']) != '') {
      $CostId = $_REQUEST['CostId'];
      $seqno = $_REQUEST['seqno'];
      $query = "SELECT c.Company_Name,c.Cust_ID,cp.plan_name,cp.  plan_sequence_number FROM  customer_setup_details AS c JOIN customer_plan AS cp ON c.Cust_ID = cp.Cust_ID WHERE cp.Cust_ID = '$CostId' AND cp.plan_sequence_number = $seqno ";
      $sel_exeid=mysql_query($query);
      $customer = mysql_fetch_array( $sel_exeid);
   }

   $uniquesavename=date("Y-m-d").'_'.rand(1000,9999);

   if(isset($_POST["Import"])){

    $logged_userid = $_SESSION['logged_userid'];

    $CostId = $_REQUEST['CostId'];

    $seqno = $_REQUEST['seqno'];

    $mimes = array('application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    $filename=$_FILES["file"]["tmp_name"];

    if(in_array($_FILES["file"]["type"],$mimes)) {

       $targetPath = 'uploads/employee/'.$uniquesavename.'_'.$_FILES['file']['name'];

       move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

       $Reader = new SpreadsheetReader($targetPath);

       $totalSheet = count($Reader->sheets());

       $j = 0;

       $err = 1;

       for($i=0;$i<$totalSheet;$i++) {

        $Reader->ChangeSheet($i);

        foreach ($Reader as $emapData) {

        if($j != 0){

           if($emapData[1] != '' && $emapData[2] != '' && $emapData[3] != '') {

                $PolicyID = $CostId.$seqno.$emapData[1];

                $CostId = $_GET['CostId'];

                $query_1 = mysql_query("SELECT * FROM employee_details WHERE Employee_Number = '".$emapData[1]."' AND Customer_Code = '$CostId' ");

                if (mysql_num_rows($query_1) > 0) {
                    $msg  = $msg. "Employee Number <span style='color:#F61717'>".$emapData[1]." </span>Already Exist In Our Record In Row $err <br>";
                    $err ++;
                    continue;
                }

                $query = "INSERT INTO `employee_details` (`Customer_Code`,`plan_sequence_number`, `Employee_Number`,`PolicyID`,`First_Name`, `Last_Name`, `Date_Of_Birth`, `Sex`, `Mobile`, `Email_Id`, `Address_Line1`, `Adress_Line2`, `City`, `State`, `Postal_Code`, `Country`, `Created_Date`, `Created_By`,`Effective_Date`) VALUES ('$CostId','$seqno','$emapData[1]','$PolicyID','$emapData[2]','$emapData[3]', '$emapData[4]', '$emapData[5]', '$emapData[6]','$emapData[7]', '$emapData[8]', '$emapData[9]', '$emapData[10]','$emapData[11]','$emapData[12]','$emapData[13]',now(),'$CostId',now())";

                $result = mysql_query($query);

                if ($result > 0) {

                  $EmpCode_ID = mysql_insert_id();

                  if($emapData[14] != '') {
                    $policyid1 = $PolicyID.'1';
                    $query1= mysql_query("INSERT INTO `employee_dependent` (`Customer_Code`,`plan_sequence_number`,`PolicyID`,`Employee_Number`, `Last_Name`, `First_Name`, `Date_Birth`,`Gender`,`Created_Date`, `Created_By`) VALUES ('$CostId','$seqno','$policyid1','$emapData[1]','$emapData[14]','$emapData[15]','$emapData[16]','$emapData[17]',now(),'$CostId')");
                   }

                  if($emapData[18] != '') {
                    $policyid2 = $PolicyID.'2';
                    $query2= mysql_query("INSERT INTO `employee_dependent` (`Customer_Code`,`plan_sequence_number`,`PolicyID`,`Employee_Number`, `Last_Name`, `First_Name`, `Date_Birth`,`Gender`,`Created_Date`, `Created_By`) VALUES ('$CostId','$seqno','$policyid2','$emapData[1]','$emapData[18]','$emapData[19]','$emapData[20]','$emapData[21]',now(),'$CostId')");
                  }

                  if($emapData[22] != '') {
                    $policyid3 = $PolicyID.'3';
                    $query3= mysql_query("INSERT INTO `employee_dependent` (`Customer_Code`,`plan_sequence_number`,`PolicyID`,`Employee_Number`, `Last_Name`, `First_Name`, `Date_Birth`,`Gender`,`Created_Date`, `Created_By`) VALUES ('$CostId','$seqno','$policyid3','$emapData[1]','$emapData[1]','$emapData[22]','$emapData[23]','$emapData[24]','$emapData[25]',now(),'$CostId')");
                  }

                  if($emapData[26] != '') {
                      $policyid4 = $PolicyID.'4';
                      $query4= mysql_query("INSERT INTO `employee_dependent` (`Customer_Code`,`plan_sequence_number`,`PolicyID`,`Employee_Number`, `Last_Name`, `First_Name`, `Date_Birth`,`Gender`,`Created_Date`, `Created_By`) VALUES ('$CostId','$seqno','$policyid4','$emapData[1]','$emapData[26]','$emapData[27]','$emapData[28]','$emapData[29]',now(),'$CostId')");
                  }

                  if($emapData[30] != '') {
                    $policyid5 = $PolicyID.'5';
                    $query5= mysql_query("INSERT INTO `employee_dependent` (`Customer_Code`,`plan_sequence_number`,`PolicyID`,`Employee_Number`, `Last_Name`, `First_Name`, `Date_Birth`,`Gender`,`Created_Date`, `Created_By`) VALUES ('$CostId','$seqno','$policyid5','$emapData[1]','$emapData[30]','$emapData[31]','$emapData[32]','$emapData[33]',now(),'$CostId')");
                  }

                  if($emapData[34] != '') {
                    $policyid6 = $PolicyID.'6';
                    $query6= mysql_query("INSERT INTO `employee_dependent` (`Customer_Code`,`plan_sequence_number`,`PolicyID`,`Employee_Number`, `Last_Name`, `First_Name`, `Date_Birth`,`Gender`,`Created_Date`, `Created_By`) VALUES ('$CostId','$seqno','$policyid6','$emapData[1]','$emapData[34]','$emapData[35]','$emapData[36]','$emapData[37]',now(),'$CostId')");
                  }       
               }
        } 
       } else{}         
      $j++;}  // END FOR EACH LOOP
    } //END FOR LOOP   
    $msg .= "CSV File has been successfully Imported."; } // END IF CONDITION
}
 
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Add Employee Details</title>
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
    <link href="css/component-chosen.css" rel="stylesheet">
    <style type="text/css">
    .error{color: #ed0716;font-size: 15px;font-weight: bold;}
    input.amount{text-align: right;padding-right: 15px;}
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

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="mainplanlistdiv" style="height: 680px; margin-top: 10px;">

      <ul class="nav nav-pills nav-justified">
          <li role="presentation" class="navbartoptabs">
            <a href="customer_edit.php?CostId=<?php echo $_REQUEST['CostId'];?>">Customer Setup</a>
          </li>

          <li role="presentation" class="active navbartoptabs">
             <a href="customer_new.php?CostId=<?php echo $_REQUEST['CostId'];?>">Customer Plan</a>
          </li>

          <!-- <li role="presentation" class="navbartoptabs">
            <a href="inclusions_exclusions.php ?CostId=<?php echo $_REQUEST['CostId'];?>&seqno=<?php echo $_REQUEST['seqno'];?>">Plan Risk Coverage</a>
          </li>

          <li role="presentation" class="active navbartoptabs">
             <a href="customer_addemployee.php?CostId=<?php echo $_REQUEST['CostId'];?>&seqno=<?php echo $_REQUEST['seqno'];?>">Employee Upload</a>
          </li> -->
          
      </ul>

    <form action="#"  name="basicform" id="basicform" method="post" enctype="multipart/form-data">

      <div class="col-md-6">
            <div class="form-group">
                <label for="name">Customer Name</label>
                <input type="text" class="form-control input-sm" value="<?php echo $customer['Company_Name'];?>" readonly>
            </div>
       </div>

      <div class="col-md-6">
        <div class="form-group">
            <label for="name">Customer Code</label>
            <input type="text" class="form-control input-sm" name="Cost_Code" value="<?php echo $_REQUEST['CostId'];?>" readonly>
        </div>
      </div>

       <div class="col-md-6">
          <div class="form-group">
              <label for="name">Plan Sequence Number</label>
              <input type="text" class="form-control input-sm" name="seq_no" value="<?php echo $customer['plan_sequence_number'];?>" readonly>
          </div>
       </div>

       <div class="col-md-6">     
          <div class="form-group">
              <label for="name">Plan Name</label>
              <input type="text" class="form-control input-sm" value="<?php echo $customer['plan_name'];?>" readonly>
          </div>
       </div>

      <div class="col-md-6">
      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2"> 
         <a href="#addCode" data-toggle="modal">
          <button style="width: 190px;" type="button" class="btn btn-primary btn-sm">   Upload Excel
          </button>
         </a>
        </div>
      </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <div class="col-lg-5 col-lg-offset-2">
          <button style="width: 190px;" class="btn btn-primary" type="button">Cancel</button> 
          <img src="images/spinner.gif" alt="" id="loader" style="display: none">
          </div>
        </div>
      </div>

    </form> 
   </div>
  </section>
 </div>
</div>  
</div>



  <div id="addCode" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>?CostId=<?php echo $_REQUEST['CostId'];?>&seqno=<?php echo $seqno;?>" name="addCodeForm" id="addCodeForm" method="post" enctype="multipart/form-data">
          <div class="modal-header">            
            <h4 class="modal-title">Upload Employee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
           <div class="modal-body">          
            <div class="form-group">
             <input type="file" name="file" id="file" class="input-large" accept=".xls,.xlsx,.csv">
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
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.6/chosen.jquery.min.js"></script>

       <?php if($msg != '') {?> 
          <script type="text/javascript">
                var costid = "<?php echo $CostId; ?>";
                var sequence = "<?php echo $seqno;?>";
                bootbox.alert({
                message: "<?php echo $msg;?>",
                callback: function(){ 
                 window.location.href = 'customer_new.php?CostId='+costid;
                }
                });
          </script>
       <?php } ?>

    <script type="text/javascript">

     $(document).ready(function() {
        var w = window.innerWidth;
        var h = window.innerHeight;
        var total = h - 150;
        var each = total/12;
        $('.navbar_li').height(each);
        $('.navbar_href').height(each/2);
        $('.navbar_href').css('padding-top', each/4.9);
        var currentpage = "customer";
        $('#'+currentpage).addClass('active');
        $('#plapiper_pagename').html("Plan for Customer");
        var windowheight = h;
        var available_height = h - 100;
        $('#mainplanlistdiv').height(available_height);
        var sidebarflag = 1;
        $('#topbar-leftmenu').click(function(){
          if(sidebarflag == 1){
              $('#sidebargrid').hide("slow","swing");
              $('#content_wrapper').removeClass("col-sm-10");
              sidebarflag = 0;
          } else {
              $('#sidebargrid').show("slow","swing");
              $('#content_wrapper').addClass("col-sm-10");
              sidebarflag = 1;
          }
        });
        var merchant = '<?php echo $logged_merchantid;?>';
        <?php include('js/notification.js');?>
  });
</script>
</body>
</html>