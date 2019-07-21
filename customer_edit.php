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
        $query = "SELECT * FROM customer_setup_details WHERE Cust_ID = '$CostId'";
        $result = mysql_query($query);
        $cusomer = mysql_fetch_assoc($result);
      }
      $msg = '';
      if($_POST['company_name'] != '' && $_POST['agent_name'] != '' && $_POST['officer_name'] != ''){

        $CostId   = escapeString($_POST['CostId']);
        $agent_name   = escapeString($_POST['agent_name']);
        $officer_name = escapeString($_POST['officer_name']);
        $company_name = escapeString($_POST['company_name']);
        $address_1 = escapeString($_POST['address_1']);
        $address_2 = escapeString($_POST['address_2']);
        $city = escapeString($_POST['city']);
        $state = escapeString($_POST['state']);
        $postal_code = escapeString($_POST['postal_code']);
        $country = escapeString($_POST['country']);
        $date_format = escapeString($_POST['date_format']);
        $currency = escapeString($_POST['currency']);
        $proposer_industry_type = escapeString($_POST['proposer_industry_type']);
        $customer_type = escapeString($_POST['customer_type']);
        $paid_up_capital = escapeString($_POST['paid_up_capital']);
        $last_name = escapeString($_POST['last_name']);
        $first_name = escapeString($_POST['first_name']);
        $mobile_number = escapeString($_POST['mobile_number']);
        $email = escapeString($_POST['email']);
        $phone_number = escapeString($_POST['phone_number']);
        $Fax = escapeString($_POST['Fax']);
        $business_constiution = escapeString($_POST['business_constiution']);
        $pan = escapeString($_POST['pan']);
        $gstin = escapeString($_POST['gstin']);

      //   $medical = escapeString($_POST['medical']);
      //   $medical_coverage = escapeString($_POST['medical_coverage']);
      //   $dental  = escapeString($_POST['coverage']);
      //   $dental_coverage  = escapeString($_POST['dental_coverage']);
      //   $vision  = escapeString($_POST['vision']);
      //   $vision_coverage  = escapeString($_POST['vision_coverage']);

      // $period_insurance  = date('Y-m-d',strtotime($_POST['period_insurance']));

      // $to_midnight = date('Y-m-d',strtotime($_POST['to_midnight']));

      //   $room_rent  = escapeString($_POST['room_rent']);
      //   $icu_rent  = escapeString($_POST['icu_rent']);
      //   $cataract_claims  = escapeString($_POST['cataract_claims']);
      //   $Maternity = escapeString($_POST['Maternity']);
      //   $Pre_existing_Diseases = escapeString($_POST['Pre_existing_Diseases']);
      //   $Re_imbursement = escapeString($_POST['Re_imbursement']);
      //   $Domicialary = escapeString($_POST['Domicialary']);
      //   $Hospitalization_Cover = escapeString($_POST['Hospitalization_Cover']);
      //   $cancer = escapeString($_POST['cancer']);
      //   $heart_attack = escapeString($_POST['heart_attack']);
      //   $chest_coronary = escapeString($_POST['chest_coronary']);
      //   $heart_replacement = escapeString($_POST['heart_replacement']);
      //   $specified_severity = escapeString($_POST['specified_severity']);
      //   $kidney_failure = escapeString($_POST['kidney_failure']);
      //   $stroke_resulting = escapeString($_POST['stroke_resulting']);
      //   $marrow_transplant = escapeString($_POST['marrow_transplant']);
      //   $permanent_paralysis = escapeString($_POST['permanent_paralysis']);
      //   $permanent_symptoms = escapeString($_POST['permanent_symptoms']);
      //   $persisting_symptoms = escapeString($_POST['persisting_symptoms']);


      //   $plan = escapeString($_POST['plan']);
      //   $Health_CheckUp_Cost = escapeString($_POST['Health_CheckUp_Cost']);
      //   $Pre_Hospitalization_Expenses = escapeString($_POST['Pre_Hospitalization_Expenses']);
      //   $Ambulance_Charges = escapeString($_POST['Ambulance_Charges']);
      //   $Hospitalization_Accnmmodation = escapeString($_POST['Hospitalization_Accnmmodation']);
      //   $Consuitant = escapeString($_POST['Consuitant']);
      //   $Routine_Investigations = escapeString($_POST['Routine_Investigations']);
      //   $Medicicne_Drugs = escapeString($_POST['Medicicne_Drugs']);
      //   $Major_Surgical = escapeString($_POST['Major_Surgical']);
      //   $Intermediate_Surgical = escapeString($_POST['Intermediate_Surgical']);
      //   $Ancillary_Services = escapeString($_POST['Ancillary_Services']);
      //   $Post_Hospitalization_Expenses = escapeString($_POST['Post_Hospitalization_Expenses']);

      $update_query = "UPDATE `customer_setup_details` SET `AgentName_BrokerName` = '$agent_name', `Marketing_OfficerName` = '$officer_name', `Company_Name` = '$company_name', `Address_Line1` = ' $address_1', `Address_Line2` = '$address_1', `City` = '$city', `State` = '$state', `PostalCode` = '$postal_code', `First_Name` = '$first_name', `Last_Name` = '$last_name', `Mobile` = '$mobile_number', `Email_Id` = '$email', `Country` = '$country', `Phone` = '$phone_number',`Fax` = '$Fax', `Date_Format` = '$date_format', `Currency` = '$currency', `Proposed_Industrytype` = '$proposer_industry_type', `Business_Constitution` = '$business_constiution', `Customer_Type` = '$customer_type',`PAN` = '$pan', `GSTIN` = '$gstin', `Paidup_Capital` = '$paid_up_capital',`Updated_Date` = 'now()', `Updated_By` = '$logged_userid' WHERE `customer_setup_details`.`Cust_ID` = '$CostId'";

        if(mysql_query($update_query)){
			     //$msg = 'Customer Updated Successfully.';
           header("location:customer_new.php?CostId=$CostId");
        }
     }
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>eTPA - Customer Users</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/planpiper.css">
		<link rel="stylesheet" type="text/css" href="fonts/font.css">
		<link rel="shortcut icon" href="images/planpipe_logo.png"/>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css" rel="stylesheet" />
         <style type="text/css">
      input.amount{
        text-align: right;
        padding-right: 15px;
      }
      #ui-datepicker-div{
           z-index: 9999;
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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="mainplanlistdiv" style="height: 680px; margin-top: 10px;">

       <ul class="nav nav-pills nav-justified">

            <li role="presentation" class="active navbartoptabs">
              <a href="customer_edit.php?CostId=<?php echo $CostId;?>">Customer Setup</a>
            </li>

            <li role="presentation" class="navbartoptabs">
              <a href="customer_new.php?CostId=<?php echo $CostId;?>">Customer Plan</a>
            </li>

            <!-- <li role="presentation" class="navbartoptabs">
              <a href="#">Plan Risk Coverage</a>
            </li>

            <li role="presentation" class="navbartoptabs">
              <a href="#">Employee Upload</a>
            </li> -->

          </ul>

<form action="<?php echo $_SERVER['PHP_SELF'];?>?CostId=<?php echo $_REQUEST['CostId'];?>"  name="basicform" id="basicform" method="post" enctype="multipart/form-data">

    <input  value="<?php echo $_REQUEST['CostId'];?>" type="hidden" class="form-control input-sm" name="CostId">

<div id="sf1" class="frm">
<fieldset>
<div id="menu1"><br>
	<div class="form-group col-md-6 col-sm-6">
      <label for="name">Agent / Broker Name</label>
      <select class="form-control input-sm" id="agent_name" name="agent_name" required>
       <option value=''>Select Agent / Broker Name</option>
		<?php 
		$query = "SELECT * FROM agent_broker_details";
		$results = mysql_query($query);
		while($row = mysql_fetch_assoc($results)){ 
             if($cusomer['AgentName_BrokerName'] == $row['Agent_ID']){ ?>
             	<option selected value="<?php echo $row['Agent_ID']; ?>"><?php echo $row['First_Name'].' '.$row['Last_Name']; ?></option>
              <?php  } else { ?>
			<option value="<?php echo $row['Agent_ID']; ?>"><?php echo $row['First_Name'].' '.$row['Last_Name']; ?></option>
		<?php  }  }?>
      </select>
    </div>
    <div class="form-group col-md-6 col-sm-6">
      <label for="email">Marketing Officer Name</label>
      <select class="form-control input-sm" id="officer_name" name="officer_name" required>
        <option value=''>Select Marketing Officer Name</option>
          <?php 
          $query = "SELECT * FROM marketing_officer_details";
          $results = mysql_query($query);
          while($row = mysql_fetch_assoc($results)){ 
          if($cusomer['Marketing_OfficerName'] == $row['Officer_ID']){ ?>
          <option selected value="<?php echo $row['Officer_ID']; ?>"><?php echo $row['First_Name'].' '.$row['Last_Name']; ?></option>
          <?php } else{?>
          <option value="<?php echo $row['Officer_ID']; ?>"><?php echo $row['First_Name'].' '.$row['Last_Name']; ?></option>
          <?php } } ?>
      </select>
  </div>

  <div class="col-md-6 col-sm-6">
      <div class="form-group">
          <label for="name">Company Name * </label>
          <input value="<?php echo $cusomer['Company_Name'];?>" type="text" class="form-control input-sm" id="company_name" name="company_name" required>
      </div>

       <div class="form-group">
         <label for="address">Address Line 1</label>
         <input value="<?php echo $cusomer['Address_Line1'];?>" type="text" class="form-control input-sm" name="address_1" id="address_1" required>
       </div>

       <div class="form-group">
         <label for="address">Address Line 2</label>
         <input value="<?php echo $cusomer['Address_Line2'];?>" type="text" class="form-control input-sm" name="address_2"  id="address_2" required>
       </div>

       <div class="form-group">
          <label for="city">City *</label>
          <input value="<?php echo $cusomer['City'];?>" type="text" class="form-control input-sm" id="city" name="city" placeholder="" required>
       </div>

      <div class="form-group">
          <label for="state">State *</label>
          <input value="<?php echo $cusomer['State'];?>" type="text" class="form-control input-sm" id="state" name="state" placeholder="" required>
      </div>

      <div class="form-group">
          <label for="pincode">Postal Code *</label>
          <input value="<?php echo $cusomer['PostalCode'];?>" type="text" class="form-control input-sm numberonly" id="postal_code" name="postal_code" placeholder="" required>
      </div>

      <div class="form-group">
          <label for="country">Country *</label>
          <input value="<?php echo $cusomer['Country'];?>" type="text" class="form-control input-sm" id="country" name="country" placeholder="" required>
      </div>

      <div class = "form-group">
          <label for="years">Date Format</label>  
          <select class="form-control input-sm" name="date_format" id="date_format">
          <option value=''>Select Date Format</option>
          <option <?php if($cusomer['Date_Format'] == 'dd/mm/ccyy'){ echo 'selected';}else{}?>  value="dd/mm/ccyy">dd/mm/ccyy</option>
          <option <?php if($cusomer['Date_Format'] == 'mm/dd/ccyy'){ echo 'selected';}else{}?>  value="mm/dd/ccyy">mm/dd/ccyy</option>
          <option <?php if($cusomer['Date_Format'] == 'ccyy/mm/dd'){ echo 'selected';}else{}?> value="ccyy/mm/dd">ccyy/mm/dd</option>
          </select>
      </div>

      <div class = "form-group">
          <label for="years">Currency</label>
          <select class="form-control input-sm" name="currency" id="currency" required>
          <option value=''>Select Currency</option>
          <!-- <option <?php if($cusomer['Currency'] == '৳'){ echo 'selected';}else{}?> value="৳">৳</option> -->
          <option <?php if($cusomer['Currency'] == '₹'){ echo 'selected';}else{}?> value="₹">₹</option>
         <!--  <option <?php if($cusomer['Currency'] == '$'){ echo 'selected';}else{}?> value="$">$</option> -->
          </select>

      </div>

      <div class = "form-group">
          <label for="years">Proposer Industry Type *</label>  
          <select class="form-control input-sm" name="proposer_industry_type" id="proposer_industry_type" required>
          <option value=''>Select Industry Type</option>
		  <option <?php if($cusomer['Proposed_Industrytype'] == 'Partnership'){ echo 'selected';}else{}?> value="Partnership">Partnership</option>
		  <option <?php if($cusomer['Proposed_Industrytype'] == 'Company'){ echo 'selected';}else{}?> value="Company">Company</option>
		  <option <?php if($cusomer['Proposed_Industrytype'] == 'Government'){ echo 'selected';}else{}?> value="Government">Government</option>
		  <option <?php if($cusomer['Proposed_Industrytype'] == 'Others'){ echo 'selected';}else{}?> value="Others">Others</option>
          </select>
      </div>

      <div class = "form-group">
          <label for="years">Customer Type *</label>  
          <select class="form-control input-sm" name="customer_type" id="customer_type" required>
          <option value=''>Select Customer Type</option>
          <option <?php if($cusomer['Customer_Type'] == 'General'){ echo 'selected';}else{}?> value="General">General</option>
          <option <?php if($cusomer['Customer_Type'] == 'EOU/STP/EHTP'){ echo 'selected';}else{}?> value="EOU/STP/EHTP">EOU/STP/EHTP</option>
          <option <?php if($cusomer['Customer_Type'] == 'Government'){ echo 'selected';}else{}?> value="Government">Government</option>
          <option <?php if($cusomer['Customer_Type'] == 'Overseas Related Parties'){ echo 'selected';}else{}?> value="Overseas Related Parties">Overseas Related Parties</option>
          <option <?php if($cusomer['Customer_Type'] == 'SEZ'){ echo 'selected';}else{}?> value="SEZ">SEZ</option>
          <option <?php if($cusomer['Customer_Type'] == 'Others'){ echo 'selected';}else{}?> value="Others">Others</option>
          </select>
      </div>

      <div class = "form-group">
          <label for="years">Paid-up Capital *</label>

           <div class="input-group"> 
        <span class="input-group-addon">₹</span>
         <input value="<?php echo $cusomer['Paidup_Capital'];?>" type="text" class="form-control input-sm amount" name="paid_up_capital" id="paid_up_capital" placeholder="In Million" required>
      </div>

         
      </div>
  </div>

  <div class="col-md-6 col-sm-6">

        <div class="form-group">
            <label for="name">Contact Person at this location</label>
        </div>

        <div class="form-group">
            <label for="name">Last Name *</label>
            <input value="<?php echo $cusomer['Last_Name'];?>" type="text" class="form-control input-sm" id="last_name" name="last_name" placeholder="" required>
        </div>

        <div class="form-group">
            <label for="name">First Name *</label>
            <input value="<?php echo $cusomer['First_Name'];?>" type="text" class="form-control input-sm" id="first_name" name="first_name" placeholder="" required>
        </div>

        <div class="form-group">
            <label for="gender">Mobile Number</label>
             <span class="help-block">Enter number with area code,Country code not necessary</span>
            <input value="<?php echo $cusomer['Mobile'];?>" type="text" class="form-control input-sm numberonly" id="mobile_number" name="mobile_number" placeholder="">
        </div>

        <div class="form-group">
            <label for="name">Email ID *</label>
            <input value="<?php echo $cusomer['Email_Id'];?>"  type="email" class="form-control input-sm" id="email" name="email" placeholder="" required>
        </div>

        <div class="form-group">
            <label for="gender">Phone Number</label>
             <span class="help-block">Enter number with area code,Country code not necessary</span>
            <input value="<?php echo $cusomer['Phone'];?>" type="text" class="form-control input-sm numberonly" id="phone_number" name="phone_number" placeholder="">
        </div>

        <div class="form-group">
            <label for="gender">Fax Number</label>
             <span class="help-block">Enter number with area code,Country code not necessary</span>
            <input value="<?php echo $cusomer['Fax'];?>" type="text" class="form-control input-sm numberonly" id="Fax" name="Fax" placeholder="">
        </div>

        <div class = "form-group">
          <label for="years">Business Constitution *</label>  
          <select class="form-control input-sm" name="business_constiution" id="business_constiution" required>
          <option disabled="disabled">-- Select --</option>

          <option  <?php if($cusomer['Business_Constitution'] == 'Non Resident Entity'){ echo 'selected';}else{}?> value="Non Resident Entity">Non Resident Entity</option>

          <option <?php if($cusomer['Business_Constitution'] == 'Foreign Registered Company'){ echo 'selected';}else{}?> value="Foreign Registered Company">Foreign Registered Company</option>

          <option <?php if($cusomer['Business_Constitution'] == 'Foreign LLP'){ echo 'selected';}else{}?> value="Foreign LLP">Foreign LLP</option>

          <option <?php if($cusomer['Business_Constitution'] == 'Government'){ echo 'selected';}else{}?>  value="Government">Government</option>

          <option <?php if($cusomer['Business_Constitution'] == 'Department'){ echo 'selected';}else{}?> value="Department">Department</option>

          <option <?php if($cusomer['Business_Constitution'] == 'LLP Partnership'){ echo 'selected';}else{}?> value="LLP Partnership">LLP Partnership</option>
          <option <?php if($cusomer['Business_Constitution'] == 'Local Authorities'){ echo 'selected';}else{}?> value="Local Authorities">Local Authorities</option>

          <option <?php if($cusomer['Business_Constitution'] == 'Partnership'){ echo 'selected';}else{}?> value="Partnership">Partnership</option>

          <option <?php if($cusomer['Business_Constitution'] == 'Private Limited Company'){ echo 'selected';}else{}?> value="Private Limited Company">Private Limited Company</option>

          <option <?php if($cusomer['Business_Constitution'] == 'Proprietorship'){ echo 'selected';}else{}?> value="Proprietorship">Proprietorship</option>

          <option <?php if($cusomer['Business_Constitution'] == 'Public Ltd Co'){ echo 'selected';}else{}?> value="Public Ltd Co">Public Ltd Co</option>

          <option <?php if($cusomer['Business_Constitution'] == 'Others'){ echo 'selected';}else{}?> value="Others">Others</option>
          </select>
      </div>

      <div class = "form-group">
        <label for="years">PAN *</label>  
        <input type="text" maxlength="10" class="form-control input-sm" id="pan" name="pan" placeholder="" value="<?php echo $cusomer['PAN'];?>"  required>
      </div>

      <div class = "form-group">
          <label for="years">GSTIN *</label>
          <input maxlength="15" value="<?php echo $cusomer['GSTIN'];?>" type="text" class="form-control input-sm" id="gstin" name="gstin" placeholder="Enter exactly 15 characters text" required>
      </div>

</div>
	  <div class="form-group">
    <div class="col-lg-10 col-lg-offset-5">
    <button class="btn btn-primary open3" type="button">Update </button> 
    <img src="images/spinner.gif" alt="" id="loader" style="display: none">
    </div>
  </div>
</div>
</fieldset>
</div>

<!-- <div id="sf2" class="frm" style="display: none;">
<fieldset>
<div id="menu2">

 <div class="col-md-12 col-sm-12">
     <label for="years">Type of Insurance Selected</label>
 </div>

 <div class="col-md-4 col-sm-4">

  <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Medical</label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Medical_Status'] == 1){ echo 'checked';}else{}?>  type="radio" name="medical" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Medical_Status'] == 0){ echo 'checked';}else{}?> type="radio" name="medical" value="0">No
      </label>
      </div>
   </div>
   <div class="clearfix"></div>
   <div class = "form-group">
	   <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Annual Coverage</label>
	   <div class="col-sm-6 col-md-6">

             <div class="input-group"> 
              <span class="input-group-addon">₹</span>
                <input value="<?php echo $cusomer['Annual_Coverage_Medical'];?>" type="text" class="form-control input-sm amount" id="medical_coverage" name="medical_coverage" placeholder="">
            </div>

	  </div>
	</div>
</div>

<div class="col-md-4 col-sm-4">
  <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Dental</label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Dental_Status'] == 1){ echo 'checked';}else{}?>  type="radio" name="dental" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Dental_Status'] == 0){ echo 'checked';}else{}?> type="radio" name="dental" value="0">No
      </label>
      </div>
   </div>
   <div class="clearfix"></div>
   <div class = "form-group">
	   <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Annual Coverage</label>
	   <div class="col-sm-6 col-md-6">

            <div class="input-group"> 
              <span class="input-group-addon">₹</span>
                 <input value="<?php echo $cusomer['Annual_Coverage_Dental'];?>" type="text" class="form-control input-sm amount" id="dental_coverage" name="dental_coverage" placeholder="">
            </div>
	  </div>
	</div>
</div>

<div class="col-md-4 col-sm-4">
  <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Vision</label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Vision_Status'] == 1){ echo 'checked';}else{}?> type="radio" name="vision" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Vision_Status'] == 0){ echo 'checked';}else{}?>  type="radio" name="vision" value="0">No
      </label>
      </div>
   </div>
   <div class="clearfix"></div>
    <div class = "form-group">
	   <label for="happy" class="col-sm-5 col-md-5 control-label text-left">Annual Coverage</label>
	   <div class="col-sm-6 col-md-6">


            <div class="input-group"> 
              <span class="input-group-addon">₹</span>
                 <input value="<?php echo $cusomer['Annual_Coverage_Vision'];?>" type="text" class="form-control input-sm amount" id="vision_coverage" name="vision_coverage" placeholder="">
            </div>

	   
	  </div>
	</div>
</div>
   
  <div class="col-md-12 col-sm-12">
     <label for="years">Risk Details</label>
  </div>

  <div class="col-md-4 col-sm-4">
	<div class="form-group">
		<label for="happy" class="col-sm-6 col-md-6 control-label text-left">Period of Insurance</label>
		<div class="col-sm-6 col-md-6"> 
		<input value="<?php echo date('d-m-Y',strtotime($cusomer['Period_Of_Insurance']));?>"  type="text" class="form-control input-sm numberonly" id="period_insurance" name="period_insurance" placeholder="">
		</div>
	</div>
  </div>

  <div class="col-md-4 col-sm-4">
	<div class="form-group">
		<label for="happy" class="col-sm-6 col-md-6 control-label text-left">To Midnight Of</label>
		<div class="col-sm-6 col-md-6"> 
		<input value=" <?php echo date('d-m-Y',strtotime($cusomer['To_Midnight_Of']));?>" type="text" class="form-control input-sm" id="to_midnight" name="to_midnight" placeholder="">
		</div>
	</div>
  </div>
  
  <div class="col-md-12 col-sm-12">
     <label for="years">Expense Limits</label>
  </div>


    <div class="col-md-12 col-sm-12">
      <div class="form-group">
        <label for="happy" class="col-sm-4 col-md-4 control-label text-left">Plan Selected</label>
        <div class="col-sm-6 col-md-6">
              <label class="radio-inline" style="font-size: 14px;
              font-weight: bold;">
              <input <?php if($cusomer['Selected_Plan'] == 1){ echo 'checked';}else{}?> type="radio" class="Plan_Selected" name="plan" value="1">Basic Plan
              </label>
              <label class="radio-inline" style="font-size: 14px;
              font-weight: bold;">
              <input <?php if($cusomer['Selected_Plan'] == 2){ echo 'checked';}else{}?> type="radio" class="Plan_Selected" name="plan" value="2">Standard Plan
              </label>
              <label class="radio-inline" style="font-size: 14px;
              font-weight: bold;">
              <input <?php if($cusomer['Selected_Plan'] == 3){ echo 'checked';}else{}?> type="radio" class="Plan_Selected" name="plan" value="3">Super Plan
              </label>
              <label class="radio-inline" style="font-size: 14px;
              font-weight: bold;">
              <input <?php if($cusomer['Selected_Plan'] == 4){ echo 'checked';}else{}?> type="radio" class="Plan_Selected" name="plan" value="4">Custom Plan
              </label>
        </div>
       </div>
   </div><div class="clearfix"></div>

    <div class="col-sm-12 col-md-12" style="margin-top: 10px;"> 
      <div class="form-group">
          <label for="address" class="col-sm-6 col-md-6 control-label text-left">Health Check-Up Cost</label>
          <div class="col-sm-4 col-md-4">

            <div class="input-group"> 
              <span class="input-group-addon">₹</span>
                <input value="<?php echo $cusomer['Health_CheckUp_Cost'];?>" type="text" class="form-control input-sm amount" id="Health_CheckUp_Cost" name="Health_CheckUp_Cost">
            </div>

          </div>
      </div>
    </div>


    <div class="col-sm-12 col-md-12" style="margin-top: 10px;"> 
        <div class="form-group">
          <label for="address" class="col-sm-6 col-md-6 control-label text-left">Pre Hospitalization Expenses</label>
        <div class="col-sm-4 col-md-4">

          <div class="input-group"> 
              <span class="input-group-addon">₹</span>
              <input value="<?php echo $cusomer['Pre_Hospitalization_Expenses'];?>" type="text" class="form-control input-sm amount" id="Pre_Hospitalization_Expenses" name="Pre_Hospitalization_Expenses">
          </div>

        </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12" style="margin-top: 10px;"> 
      <div class="form-group">
          <label for="address" class="col-sm-6 col-md-6 control-label text-left">Ambulance Charges</label>
          <div class="col-sm-4 col-md-4"> 

             <div class="input-group"> 
              <span class="input-group-addon">₹</span>
             <input value="<?php echo $cusomer['Ambulance_Charges'];?>" type="text" class="form-control input-sm amount" id="Ambulance_Charges" name="Ambulance_Charges">
            </div>

          </div>
      </div> 
    </div>    

      <div class="col-sm-12 col-md-12" style="margin-top: 10px;"> 
         <div class="form-group">
          <label for="address" class="col-sm-6 col-md-6 control-label text-left">Hospitalization Accommodation ( including all room services and telephone charges)</label>
           <div class="col-sm-4 col-md-4"> 

             <div class="input-group"> 
              <span class="input-group-addon">₹</span>
              <input value="<?php echo $cusomer['Hospitalization_Accnmmodation'];?>" type="text" class="form-control input-sm amount" id="Hospitalization_Accnmmodation" name="Hospitalization_Accnmmodation">
            </div>

           </div>
        </div>
      </div>

      <div class="col-sm-12 col-md-12" style="margin-top: 10px;"> 
        <div class="form-group">
          <label for="address" class="col-sm-6 col-md-6 control-label text-left">Consultant's Fee</label>
           <div class="col-sm-4 col-md-4">

            <div class="input-group"> 
              <span class="input-group-addon">₹</span>
               <input value="<?php echo $cusomer['Consuitant'];?>" type="text" class="form-control input-sm amount" id="Consuitant" name="Consuitant">
            </div> 

           </div>
        </div>
      </div>

      <div class="col-sm-12 col-md-12" style="margin-top: 10px;"> 
        <div class="form-group">
            <label for="address" class="col-sm-6 col-md-6 control-label text-left">Routine Investigations</label>
            <div class="col-sm-4 col-md-4">


            <div class="input-group"> 
              <span class="input-group-addon">₹</span>
               <input value="<?php echo $cusomer['Routine_Investigations'];?>" type="text" class="form-control input-sm amount" id="Routine_Investigations" name="Routine_Investigations">
            </div> 

            </div>
        </div>
      </div>

      <div class="col-sm-12 col-md-12" style="margin-top: 10px;"> 
        <div class="form-group">
            <label for="address" class="col-sm-6 col-md-6 control-label text-left">Medicine & Drugs Prescribed by The Consultant</label>
            <div class="col-sm-4 col-md-4">

            <div class="input-group"> 
              <span class="input-group-addon">₹</span>
               <input value="<?php echo $cusomer['Medicicne_Drugs'];?>" type="text" class="form-control input-sm amount" id="Medicicne_Drugs" name="Medicicne_Drugs">
            </div> 

            </div>
        </div>
      </div>

      <div class="col-sm-12 col-md-12" style="margin-top: 10px;"> 
        <div class="form-group">
            <label for="address" class="col-sm-6 col-md-6 control-label text-left">Major Surgical Operation</label>
            <div class="col-sm-4 col-md-4">


            <div class="input-group"> 
              <span class="input-group-addon">₹</span>
               <input value="<?php echo $cusomer['Major_Surgical'];?>" type="text" class="form-control input-sm amount" id="Major_Surgical" name="Major_Surgical">
            </div> 

            </div>
        </div>
      </div>


      <div class="col-sm-12 col-md-12" style="margin-top: 10px;"> 
        <div class="form-group">
            <label for="address" class="col-sm-6 col-md-6 control-label text-left">Intermediate Surgical Operation</label>
            <div class="col-sm-4 col-md-4">

            <div class="input-group"> 
              <span class="input-group-addon">₹</span>
                <input value="<?php echo $cusomer['Intermediate_Surgical'];?>" type="text" class="form-control input-sm amount" id="Intermediate_Surgical" name="Intermediate_Surgical">
            </div> 

            </div>
        </div>
      </div>

      <div class="col-sm-12 col-md-12" style="margin-top: 10px;"> 
        <div class="form-group">
            <label for="address" class="col-sm-6 col-md-6 control-label text-left">Ancillary Services</label>
            <div class="col-sm-4 col-md-4">


              <div class="input-group"> 
                <span class="input-group-addon">₹</span>
                 <input value="<?php echo $cusomer['Ancillary_Services'];?>" type="text" class="form-control input-sm amount" id="Ancillary_Services" name="Ancillary_Services">
              </div>

            </div>
        </div>
      </div>

      <div class="col-sm-12 col-md-12" style="margin-top: 10px;"> 
        <div class="form-group">
            <label for="address" class="col-sm-6 col-md-6 control-label text-left">Post Hospitalization Expenses</label>
            <div class="col-sm-4 col-md-4">

               <div class="input-group"> 
                  <span class="input-group-addon">₹</span>
                    <input value="<?php echo $cusomer['Post_Hospitalization_Expenses'];?>" type="text" class="form-control input-sm amount" id="Post_Hospitalization_Expenses" name="Post_Hospitalization_Expenses">
                </div>

            </div>
        </div>
      </div>

 <div class="form-group">
	<div class="col-lg-10 col-lg-offset-5">
		<button class="btn btn-warning back2" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
		<button class="btn btn-primary open2" type="button">Next <span class="fa fa-arrow-right"></span></button> 
	</div>
 </div>

   </div>
  </fieldset>
</div> -->

<!-- <div id="sf3" class="frm" style="display: none;">
<fieldset>
<div id="menu3">

  <div class="col-md-12 col-sm-12">

   <div class="form-group">
       <label  class="col-sm-6 col-md-6 control-label text-center" for="name">Additional Benefits Selected</label>
   </div>

   <div class="clearfix"></div>

    <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Maternity Benefits</label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Maternity_Benefits_Status'] == 1){ echo 'checked';}else{}?> type="radio" name="Maternity" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Maternity_Benefits_Status'] == 0){ echo 'checked';}else{}?> type="radio" name="Maternity" value="0">No
      </label>
      </div>
   </div>
   <div class="clearfix"></div>

   <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Pre-existing Diseases</label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Preexisting_Diseases_Status'] == 1){ echo 'checked';}else{}?> type="radio" name="Pre_existing_Diseases" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Preexisting_Diseases_Status'] == 0){ echo 'checked';}else{}?> type="radio" name="Pre_existing_Diseases" value="0">No
      </label>
      </div>
   </div>
   <div class="clearfix"></div>
 </div>

  <div class="col-md-12 col-sm-12">

	<div class="form-group">
	     <label  class="col-sm-6 col-md-6 control-label text-center" for="years">Criticalcare Benefits Selected </label>
	</div>
    <div class="clearfix"></div>

	<div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Cancer</label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Cancer_Status'] == 1){ echo 'checked';}else{}?> type="radio" name="cancer" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Cancer_Status'] == 0){ echo 'checked';}else{}?> type="radio" name="cancer" value="0">No
      </label>
      </div>
   </div>
   <div class="clearfix"></div>

  <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left"> First Heart attack of specified severity </label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['First_Heart_Attack'] == 1){ echo 'checked';}else{}?> type="radio" name="heart_attack" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['First_Heart_Attack'] == 0){ echo 'checked';}else{}?> type="radio" name="heart_attack" value="0">No
      </label>
      </div>
  </div>
  <div class="clearfix"></div>

  <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Open chest Coronary artery bypass grafting</label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Chest_Coronary_Bypass'] == 1){ echo 'checked';}else{}?> type="radio" name="chest_coronary" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Chest_Coronary_Bypass'] == 0){ echo 'checked';}else{}?> type="radio" name="chest_coronary" value="0">No
      </label>
      </div>
  </div>
  <div class="clearfix"></div>

  <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Open Heart replacement or repair of Heart valves</label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">

      <input <?php if($cusomer['Open_Heart_Replacement'] == 1){ echo 'checked';}else{}?> type="radio" name="heart_replacement" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Open_Heart_Replacement'] == 0){ echo 'checked';}else{}?> type="radio" name="heart_replacement" value="0">No
      </label>
      </div>
  </div>
  <div class="clearfix"></div>

  <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Coma of specified severity </label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Coma_Specified'] == 1){ echo 'checked';}else{}?> type="radio" name="specified_severity" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Coma_Specified'] == 0){ echo 'checked';}else{}?> type="radio" name="specified_severity" value="0">No
      </label>
      </div>
  </div>
  <div class="clearfix"></div>

  <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Kidney failure requiring regular dialysis </label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Kidney_Dialysis'] == 1){ echo 'checked';}else{}?> type="radio" name="kidney_failure" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Kidney_Dialysis'] == 0){ echo 'checked';}else{}?> type="radio" name="kidney_failure" value="0">No
      </label>
      </div>
  </div>
  <div class="clearfix"></div>

  <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Stroke resulting in permanent symptoms</label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Stroke_Symptoms_Status'] == 1){ echo 'checked';}else{}?> type="radio" name="stroke_resulting" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Stroke_Symptoms_Status'] == 0){ echo 'checked';}else{}?> type="radio" name="stroke_resulting" value="0">No
      </label>
      </div>
  </div>
  <div class="clearfix"></div>

  <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Major organ / bone marrow transplant</label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Major_Organ_Bone'] == 1){ echo 'checked';}else{}?> type="radio" name="marrow_transplant" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Major_Organ_Bone'] == 0){ echo 'checked';}else{}?> type="radio" name="marrow_transplant" value="0">No
      </label>
      </div>
  </div>
  <div class="clearfix"></div>

  <div class="form-group">
    <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Permanent paralysis of limbs </label>
    <div class="col-sm-6 col-md-6">
    <label class="radio-inline">
    <input <?php if($cusomer['Permanent_Limbs_Status'] == 1){ echo 'checked';}else{}?> type="radio" name="permanent_paralysis" value="1">Yes
    </label>
    <label class="radio-inline">
    <input <?php if($cusomer['Permanent_Limbs_Status'] == 0){ echo 'checked';}else{}?> type="radio" name="permanent_paralysis" value="0">No
    </label>
    </div>
  </div>
  <div class="clearfix"></div>

  <div class="form-group">
    <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Motor neurone disease with permanent symptoms</label>
    <div class="col-sm-6 col-md-6">
    <label class="radio-inline">
    <input <?php if($cusomer['Motor_Neurone_Status'] == 1){ echo 'checked';}else{}?> type="radio" name="permanent_symptoms" value="1">Yes
    </label>
    <label class="radio-inline">
    <input <?php if($cusomer['Motor_Neurone_Status'] == 0){ echo 'checked';}else{}?> type="radio" name="permanent_symptoms" value="0">No
    </label>
    </div>
  </div>
  <div class="clearfix"></div>

  <div class="form-group">
    <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Multiple sclerosis with persisting symptoms</label>
    <div class="col-sm-6 col-md-6">
    <label class="radio-inline">
    <input <?php if($cusomer['Multiple_Sclerosis_Status'] == 1){ echo 'checked';}else{}?> type="radio" name="persisting_symptoms" value="1">Yes
    </label>
    <label class="radio-inline">
    <input <?php if($cusomer['Multiple_Sclerosis_Status'] == 0){ echo 'checked';}else{}?> type="radio" name="persisting_symptoms" value="0">No
    </label>
    </div>
  </div>
  <div class="clearfix"></div>
  </div>

	<div class="form-group">
		<div class="col-lg-10 col-lg-offset-5">
		<button class="btn btn-warning back3" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
		<button class="btn btn-primary open3" type="button">Submit </button> 
		<img src="images/spinner.gif" alt="" id="loader" style="display: none">
		</div>
	</div>

  </div>
 </fieldset>
</div> -->
	</div>
	</form> 
	</div>
	</section>
 </div>
</div>	
</div>
</div><!-- big_wrapper ends -->   
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>

  <?php if($msg != '') {?> 
  <script type="text/javascript">
        bootbox.alert({
        message: "<?php echo $msg;?>",
        callback: function(){ 
          window.location.href = 'corporate_customer.php';
        }
        });
  </script>
  <?php } ?>

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

  $(".Plan_Selected").on('change', function(e){ 
    var PlanValue = $("input[name='plan']:checked").val();
    var dataString = "PlanValue="+PlanValue;
    $.ajax({
          type: 'POST',
          url: 'ajax/add_master_plan_value.php',
          data    : dataString,
          datatype: 'json',
          cache: false,
          success: function (data) {
              var data1 = $.parseJSON(data);
                 if(data1.status == 'ok'){

                        $('#Health_CheckUp_Cost').val(data1.result.Health_CheckUp_Cost);

                        $('#Pre_Hospitalization_Expenses').val(data1.result.Pre_Hospitalization_Expenses);

                        $('#Ambulance_Charges').val(data1.result.Ambulance_Charges);

                        $('#Hospitalization_Accnmmodation').val(data1.result.Hospitalization_Accnmmodation);

                        $('#Consuitant').val(data1.result.Consuitant);

                        $('#Routine_Investigations').val(data1.result.Routine_Investigations);

                        $('#Medicicne_Drugs').val(data1.result.Medicicne_Drugs);

                        $('#Major_Surgical').val(data1.result.Major_Surgical);

                        $('#Intermediate_Surgical').val(data1.result.Intermediate_Surgical);

                        $('#Ancillary_Services').val(data1.result.Ancillary_Services);

                        $('#Post_Hospitalization_Expenses').val(data1.result.Post_Hospitalization_Expenses);

                  }else{
                      bootbox.alert({
                         message: "Something wrong contact us.",
                         size: 'small'
                      });
                  } 
             }
         });
    });


  $('.numberonly').bind('keyup paste', function(){
      this.value = this.value.replace(/[^0-9]/g, '');
  });

  $(function() {
        $( "#period_insurance" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });

        $( "#to_midnight" ).datepicker({
            dateFormat : 'dd-mm-yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+15',
            // maxDate: '-1d'
        });
    });

  jQuery().ready(function() {

    var v = jQuery("#basicform").validate({

          rules: {
          agent_name: "required",
          officer_name : "required",
          company_name : "required",
          last_name : "required",
          address_1: "required",
          first_name: "required",
          address_2:"required",
          mobile_number:{digits: true},
          city:"required",
          state:"required",
          postal_code:{required: true,digits: true},
          country : "required",
          currency : "required",
          business_constiution : "required",
          pan:{required: true,maxlength:10,minlength:10},
          proposer_industry_type:"required",
          gstin: {required: true,maxlength:15,minlength:15},
          customer_type:"required",
          room_rent:{digits: true},
          icu_rent:{digits: true},
          cataract_claims:{digits: true}
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

    // $(".open1").click(function() {
    //   if (v.form()) {
    //     $(".frm").hide("fast");
    //     $("#sf2").show("slow");
    //   }
    // });

    // $(".open2").click(function() {
    //   if (v.form()) {
    //     $(".frm").hide("fast");
    //     $("#sf3").show("slow");
    //   }
    // });

    $(".open3").click(function() {
      if (v.form()) {
        $("#loader").show();
         setTimeout(function(){
           $( "#basicform" ).submit();
         }, 1000);
        return false;
      }
    });
    
    // $(".back2").click(function() {
    //   $(".frm").hide("fast");
    //   $("#sf1").show("slow");
    // });

    // $(".back3").click(function() {
    //   $(".frm").hide("fast");
    //   $("#sf2").show("slow");
    // });

  });

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
        $('#plapiper_pagename').html("Corporate Customer Setup");
        var windowheight = h;
        var available_height = h - 80;
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