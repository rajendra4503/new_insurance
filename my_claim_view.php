<?php
session_start();
include('include/configinc.php');
include('include/session.php');
include('include/functions.php');

/******Get user and Hospital Deatils********/

	if (isset($_GET['claimID'] ) && !empty($_GET['claimID'])){

		$ClaimID = $_GET['claimID'];

		$query = "SELECT * FROM patient_details AS PT JOIN hospital_details AS HD ON PT.Claim_ID = HD.Claim_ID JOIN patient_diagnosis_details AS PD ON PT.Claim_ID = PD.Claim_ID JOIN non_network_hospital AS NH ON NH.Claim_ID = PT.Claim_ID WHERE PT.Claim_ID=$ClaimID AND PT.CreatedBy = $logged_userid";

		$results = mysql_query($query);

		$result = mysql_fetch_assoc($results);

			$Total_Claimed_Amount = $result['Total_Claimed_Amount'];
	}
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>eTPA - Plan Users</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/planpiper.css">
		<link rel="stylesheet" type="text/css" href="fonts/font.css">
		<link rel="shortcut icon" href="images/planpipe_logo.png"/>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link type="text/css" href="css/bootstrap-timepicker.min.css" />
		<style type="text/css">
			.glyphicon-ok{color: green;margin-right: 100px;}
            .glyphicon-remove{color: red;margin-right: 100px;}
            .radio label, .checkbox label {font-weight: bold;}
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
	        <div id="plantitle" style="font-family:RalewayRegular;font-size: 1.8em;">
				<span style="margin-left: 155px; float:left;">
					Claim ID -  <?php echo $_GET['claimID'];  ?></span>
				<span style="padding-left:0px;">
				    Patient Name - <?php echo $result['Patient_Name'].' '.$result['Patient_Last_Name'];?>
				</span>
			</div>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="mainplanlistdiv">
		  <ul id="navigation_tab" class="nav nav-tabs">
			<li class="active navbar_li">
				<a class="navbar_href" data-toggle="tab" href="#menu1">Details of Hospital</a>
			</li>
			<li class="navbar_li">
				<a class="navbar_href" data-toggle="tab" href="#menu2">Details of Patient</a>
			</li>
			<li class="navbar_li">
				<a class="navbar_href" data-toggle="tab" href="#menu3">Diagnosis & Procedures</a>
			</li>
			<li class="navbar_li">
				<a class="navbar_href" data-toggle="tab" href="#menu6">Details of Claim</a>
			</li>
			<li class="navbar_li">
				<a class="navbar_href" data-toggle="tab" href="#menu7">Details of Bills</a>
			</li>
			<li class="navbar_li">
				<a class="navbar_href" data-toggle="tab" href="#menu4">Claim Documents</a>
			</li>
			<li class="navbar_li">
				<a class="navbar_href" data-toggle="tab" href="#menu5">Details of Non Network Hospital</a>
			</li>
		 </ul>

       <form name="frm_assign_incurance" id="frm_assign_incurance" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">

        <div class="tab-content">

	       <div id="menu1" class="tab-pane fade in active"> <br>

	        <div id="pageheading" style="text-align: left;">DETAILS OF HOSPITAL</div>

				<div class="form-group col-sm-12">
					<label>Name of the Hospital</label>
					<input type="text" class="form-control" name="Hospital_Name" value="<?php echo $result['Hospital_Name'];?>">
				</div>

				<div class="form-group col-sm-6">
					<label>Hospital ID </label>
					<input type="text" class="form-control" name="Hospital_ID" value="<?php echo $result['Hospital_ID'];?>">
				</div>

				<div class="form-group col-sm-6">
				<label>Type of Hospital</label>
					<div class="form-check">
						<input <?php if($result['Network_Type']==1){ echo 'checked';}?> class="form-check-input" type="radio" name="hospital_type" value="1">
						<label class="form-check-label" for="gridCheck">
							Network
						</label>
						&nbsp;&nbsp;
						<input <?php if($result['Network_Type']==0){ echo 'checked';}?>  class="form-check-input" type="radio" name="hospital_type" value="0">
						<label class="form-check-label" for="gridCheck">
						Non Network 
						</label>
					</div>
				</div>

    			<div class="clearfix"></div>

				<div class="form-group col-sm-6">
					<label>Name of the treating Doctor</label>
					<input type="text" class="form-control" name="Doctor_Name" value="<?php echo $result['Doctor_Name'];?>">
				</div>

				<div class="form-group col-sm-6">
					<label>Qualification </label>
					<input type="text" class="form-control" name="Qualification" value="<?php echo $result['Qualification'];?>">
				</div>

				<div class="form-group col-sm-6">
					<label>Registration No. with state code </label>
					<input type="text" class="form-control" name="Registration_No" id="Registration_No" value="<?php echo $result['Registration_No'];?>">
				</div>

				<div class="form-group col-sm-6">
					<label>Mobile No.</label>
					<div class="clearfix"></div>
					<div class="col-sm-2" style="margin-left:-15px;">
					<input type="text" maxlength="3" value="<?php echo $result['Country_Code'];?>" class="form-control" name="cont_code" id="cont_code">
					</div>


					<div class="col-sm-3">
					<input value="<?php if($result['Area_Code'] != 0 ) {echo $result['Area_Code'];} ?>"  type="text" placeholder="Area Code" class="form-control" maxlength="3" name="area_code" id="area_code">
					</div>

					<div class="col-sm-3">
					<input value="<?php if($result['Phone_No'] != 0) {echo $result['Phone_No'];} ?>"  type="text" placeholder="Phone No" maxlength="8" class="form-control" name="phone_no" id="phone_no">
					</div>
				</div>
			</div>

<div id="menu2" class="tab-pane fade">

    <div style="clear: both;"><br></div>
    <div id="pageheading" style="text-align: left;">
    	DETAILS OF PATIENT ADMITTED
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <!--        <?php 
				if($result['Status'] == 1){ ?>
         			<span id="success_ok">
         			   	<span style="margin-right:13px;" class="glyphicon glyphicon-ok"></span>
         			</span>
         	    <input id="status_value" type="hidden" value="<?php echo $result['Status'];?>">
				 <?php } else{ ?>
					   <span id="success_not">
         			   		<span style="margin-right:44px;" class="glyphicon glyphicon-ok1"></span>
         			   </span>
         			   <input id="status_value" type="hidden" value="0">
				<?php }?>

              <button id="verify" type="button" class="btn btn-success btn-md" style="margin-top:-4px;">
               <?php
				if($result['Status'] ==1){ echo 'Verified';}else{echo 'Verify';} 
				?>
              </button>

         <input type="hidden" name="claimID" id="claimID" value="<?php echo $_GET['claimID']?>"> -->
    </div>

	 <div class="form-group col-sm-6">
	    <label>Patient First Name </label>
	    <input type="text" class="form-control" name="Patient_Name" value="<?php echo $result['Patient_Name'];?>">
    </div>

	<div class="form-group col-sm-6">
	    <label>Patient Last Name </label>
	    <input type="text" class="form-control" name="Patient_Last_Name" value="<?php echo $result['Patient_Last_Name'];?>">
    </div>

    <div class="form-group col-sm-4">
	    <label>Insurance Policy Number</label>
	    <input type="text" class="form-control" name="IP_Registration" value="<?php echo $result['Policy_No'];?>">
    </div>

    <div class="form-group col-sm-6">
	    <label>Gender </label>
			<div class="form-check">
				<input <?php if($result['Gender']=='M'){ echo 'checked';}?> class="form-check-input" type="radio" name="gender" value="M" >
				<label class="form-check-label" for="gridCheck">
					Male
				</label>
				&nbsp;&nbsp;
				<input <?php if($result['Gender']=='F'){ echo 'checked';}?> class="form-check-input" type="radio" name="gender" value="F">
				<label class="form-check-label" for="gridCheck">
				    Female
				</label>
				&nbsp;&nbsp;
				<input <?php if($result['Gender']=='T'){ echo 'checked';}?> class="form-check-input" type="radio" name="gender" value="T">
				<label class="form-check-label" for="gridCheck">
				    Transgender
				</label>
			</div>
    </div>

    <div style="clear:both;"></div>

    <div class="form-group col-sm-2">
		<label>Age :</label>
		<?php
		if($result['Date_of_Birth'] !='' && $result['Date_of_Birth'] !='0000-00-00'){
			$userDob = $result['Date_of_Birth'];
			$dob = new DateTime($userDob);
			$now = new DateTime();
			$difference = $now->diff($dob);
			$year  = $difference->y;
			$month = $difference->m;
			echo $year.'.'.$month.' Years';
		 }
		?>
    </div>
		<div class="col-sm-2">
			<label>Date of Birth</label>
			<input type="text" class="form-control" name="DateofBirth" id="DateofBirth" value="<?php if($result['Date_of_Birth'] != '0000-00-00' && $result['Date_of_Birth'] != ''){echo date('d-m-Y',strtotime($result['Date_of_Birth']));
			}else{}?>">
		</div>
        <div class="form-group col-sm-2">
	        <label>Date of Admission</label>

			<input type="text" class="form-control" name="DateofAdmission" id="DateofAdmission" value="<?php if($result['Date_of_Admission'] != '0000-00-00' && $result['Date_of_Admission'] != ''){echo date('d-m-Y',strtotime($result['Date_of_Admission']));
			}else{}?>">
       </div>

		<div class="form-group col-sm-2">
			<label>Time</label>
			<input id="DateofTime" name="DateofTime" type="text" class="form-control input-small" value="<?php echo $result['Time_of_Admission'];?>">
		</div>

		<div class="form-group col-sm-2">
			<label>Date of Discharge</label>
			<!-- <input type="text" class="form-control" name="DateofDischarge" id="DateofDischarge" value="<?php echo date('d-m-Y',strtotime($result['Date_of_Discharge']));?>"> -->
			<input type="text" class="form-control" name="DateofDischarge" id="DateofDischarge" value="<?php if($result['Date_of_Discharge'] != '0000-00-00' && $result['Date_of_Discharge'] != ''){echo date('d-m-Y',strtotime($result['Date_of_Discharge']));
			}else{}?>">
		</div>

		<div class="form-group col-sm-2">
			<label>Time</label>
			<input name="TimeofDischarge" id="TimeofDischarge" type="text" class="form-control input-small" value="<?php echo $result['Time_of_Discharge'];?>">
		</div>
		<div style="clear:both;"></div>
		<div class="form-group col-sm-6">
			<label>Type of Admission</label>
			
				<div class="form-check">
					<input <?php if($result['Type_of_Admission']=='E'){ echo 'checked';}?> class="form-check-input" type="radio" name="type_admission" value="E">
					<label class="form-check-label" for="gridCheck">
						Emergency
					</label>
					&nbsp;
					<input <?php if($result['Type_of_Admission']=='P'){ echo 'checked';}?> class="form-check-input" type="radio" name="type_admission" value="P">
					<label class="form-check-label" for="gridCheck">
						Planned
					</label>
					&nbsp;
					<input <?php if($result['Type_of_Admission']=='D'){ echo 'checked';}?> class="form-check-input" type="radio" name="type_admission" value="D">
					<label class="form-check-label" for="gridCheck">
						Day Care
					</label>
					&nbsp;
					<input <?php if($result['Type_of_Admission']=='M'){ echo 'checked';}?> class="form-check-input" type="radio" name="type_admission" value="M">
					<label class="form-check-label" for="gridCheck">
						Maternity
					</label>
				</div>
		</div>

       <div style="clear:both;"></div>

	    <div class="form-group col-sm-12">
		    <label>If Maternity :</label>
		</div>

		<div class="col-sm-2">
			<label>Date of Delivery</label>
			<input type="text" class="form-control" name="DateofDelivery" id="DateofDelivery" value="<?php if($result['Date_of_Delivery'] != '0000-00-00'){echo date('d-m-Y',strtotime($result['Date_of_Delivery']));
			}else{}?>">
		</div>

		<div class="col-sm-2">
			<label>Gravida Status</label>
			<input type="text" class="form-control" name="GravidaStatus" value="<?php echo $result['Gravida_Status'];?>">
		</div>

    <div class="form-group col-sm-8">
	        <label>Status at time of Discharge</label>
			<div class="form-check">
				<input <?php if($result['Status_Time_of_Discharge']=='H'){ echo 'checked';}?> class="form-check-input" type="radio" name="status_time" value="H">
				<label class="form-check-label" for="gridCheck">
					Discharged at Home
				</label>
				&nbsp;
				<input <?php if($result['Status_Time_of_Discharge']=='AH'){ echo 'checked';}?> class="form-check-input" type="radio" name="status_time" value="AH">
				<label class="form-check-label" for="gridCheck">
				   Discharged to Another Hospital
				</label>
				&nbsp;
				<input <?php if($result['Status_Time_of_Discharge']=='DC'){ echo 'checked';}?> class="form-check-input" type="radio" name="status_time" value="DC">
				<label class="form-check-label" for="gridCheck">
				    Day Care
				</label>
				&nbsp;
				<input <?php if($result['Status_Time_of_Discharge']=='D'){ echo 'checked';}?> class="form-check-input" type="radio" name="status_time" value="D">
				<label class="form-check-label" for="gridCheck">
				    Deceased
				</label>
	    </div>
    </div>
 </div>

   <div id="menu3" class="tab-pane fade">

    <div style="clear:both;"><br></div>
	    <div id="pageheading" style="text-align: left;"> 
	    		DETAILS OF AILMENT DIAGNOSED (PRIMARY)
	    </div>
			<label class="col-sm-6 col-form-label"> Diagnosis</label>

			<label class="col-sm-6 col-form-label"> Procedure</label>
	    <?php 

			if (isset($_GET['claimID'] ) && !empty($_GET['claimID'])) {
				$icdcm = [];
				$icdpcs = [];
				$allow_diagnosis_code = "SELECT DISTINCT ICD10_CM_CODE FROM allow_diagnosis_code";
				$result_m = mysql_query($allow_diagnosis_code);
				while ($result_q = mysql_fetch_array($result_m))  
				{
					array_push($icdcm,$result_q["ICD10_CM_CODE"]);
				}
				$allow_diagnosis_procedure_code = "SELECT DISTINCT 	ICD10_PCS_CODE FROM allow_diagnosis_procedure_code";
				$result_pc = mysql_query($allow_diagnosis_procedure_code);
				while ($result_r = mysql_fetch_array($result_pc))  
				{
					array_push($icdpcs,$result_r["ICD10_PCS_CODE"]);
				}
				$icdcm_l  =  array_unique($icdcm);
				$icdpcs_l =  array_unique($icdpcs);

				$PClaimID = $_GET['claimID'];

				$pcquery = "SELECT DISTINCT C.Claim_ID,C.ICD10CM,C.ICD10PCS,D.ICD10_CM_CODE_DESCRIPTION,P.ICD10_PCS_CODE_DESCRIPTION FROM claim_diagnosis_procedure AS C JOIN diagnosis_code AS D ON C.ICD10CM = D.ICD10_CM_CODE JOIN diagnosis_procedure_code AS P ON C.ICD10PCS = P.ICD10_PCS_CODE WHERE C.Claim_ID = '$PClaimID'";

				$resultq1 = mysql_query($pcquery);

			}
            $i = 1;
	        while ($row = mysql_fetch_array($resultq1))  
			{
		?>

			<div class="col-sm-5">
				<input value="<?php echo $row["ICD10CM"]; ?>" type="text" class="form-control">
				<p>
				<?php echo $row["ICD10_CM_CODE_DESCRIPTION"]; ?>
				</p>
			</div>
			<div class="col-sm-1">	
					<?php
						if (in_array($row["ICD10CM"],$icdcm_l)){ ?>
						<span class="glyphicon glyphicon-ok"></span>
						<?php } else{ ?>

						<span class="glyphicon glyphicon-remove"></span>

					<?php } ?>
			  </div>
            
			   <div class="col-sm-5">

					 <input value="<?php echo $row["ICD10PCS"]; ?>" type="text" class="form-control">
					 <p>
					 <?php echo $row["ICD10_PCS_CODE_DESCRIPTION"]; ?>
					 </p>
			    </div>
			    <div class="col-sm-1">	 
						<?php 
						if (in_array($row["ICD10PCS"],$icdpcs_l)){ ?>
						<span class="glyphicon glyphicon-ok"></span>
						<?php } else{ ?>
						<span class="glyphicon glyphicon-remove"></span>
						<?php } ?>
			     </div>
		<?php
		   $i++;
			}
	    ?>

    	<div class="form-group col-sm-6">
		    <label>Pre Authorization Obtained</label>
				<div class="form-check">
					<input <?php if($result['Authorization_Obtained']==1){ echo 'checked';}?>   class="form-check-input" type="radio" value='1' name="auth">
					<label class="form-check-label" for="gridCheck">
					Yes
					</label>
					&nbsp;
					<input <?php if($result['Authorization_Obtained']==0){ echo 'checked';}?> class="form-check-input" type="radio" name="auth" value='0'>
					<label class="form-check-label" for="gridCheck">
					No
					</label>
				</div>
	    </div>


	    <div class="form-group col-sm-6">
		   <label>Pre Authorization Number</label>
		   <input type="text" class="form-control" name="auth_number" value="<?php echo $result['Authorization_Number']; ?>">
        </div>


    	<div class="form-group col-sm-12">
	    	<label>If Authorization By Network Hospital not Obtained ,Give Reason </label>
	    	<textarea  class="form-control"><?php echo $result['Authorization_Reason'];?></textarea>
    	</div>


    	<div class="form-group col-sm-3">

		    <label>Hospitalization due to injury</label>
		 
				<div class="form-check">
					<input <?php if($result['Hospitalization_Injury']==1){ echo 'checked';}?> class="form-check-input" type="radio" name="injury" value="1">
					<label class="form-check-label" for="gridCheck">
						Yes
					</label>
					&nbsp;
					<input <?php if($result['Hospitalization_Injury']==0){ echo 'checked';}?> class="form-check-input" type="radio" name="injury" value="0">
					<label class="form-check-label" for="gridCheck">
					   No
					</label>
		    </div>

	    </div>

	    <div class="form-group col-sm-9">
		    <label>If yes,give cause</label>
		   
				<div class="form-check">
					<input <?php if($result['Give_Cause']=='S'){ echo 'checked';}?> class="form-check-input" type="radio" name="cause" value="S">
					<label class="form-check-label" for="gridCheck">
						Self Inflicted
					</label>
					&nbsp;
					<input <?php if($result['Give_Cause']=='R'){ echo 'checked';}?> class="form-check-input" type="radio" name="cause" value="R">
					<label class="form-check-label" for="gridCheck">
					   Road Traffic Accident
					</label>

					&nbsp;
					<input <?php if($result['Give_Cause']=='SC'){ echo 'checked';}?> class="form-check-input" type="radio" name="cause" value="SC">
					<label class="form-check-label" for="gridCheck">
					  Substance abuse / alcohol consumption
					</label>
		    </div>
	    </div>


	    <div class="form-group col-sm-7">
		    <label>If injurydue to Substance abuse / alcohol consumption, Test Conducted to establish this.</label>
			<div class="form-check">
				<input <?php if($result['Test_Conducted']==1){ echo 'checked';}?> class="form-check-input" type="radio" name="injury_reason" value="1">
				<label class="form-check-label" for="gridCheck">
					Yes
				</label>
				&nbsp;
				<input <?php if($result['Test_Conducted']==0){ echo 'checked';}?> class="form-check-input" type="radio" name="injury_reason" value="0">
				<label class="form-check-label" for="gridCheck">
				   No
				</label>
				<label class="form-check-label" for="gridCheck">
				    &nbsp; &nbsp;(if yesy , attach reports)
				</label>
			</div>
	    </div>

    	<div class="form-group col-sm-5">
		    <label>If Medico Legal.</label>
			<div class="form-check">
				<input <?php if($result['Medico_Legal']==1){ echo 'checked';}?> class="form-check-input" type="radio" name="medico" value="1">
				<label class="form-check-label" for="gridCheck">
					Yes
				</label>
				&nbsp;
				<input <?php if($result['Medico_Legal']==0){ echo 'checked';}?> class="form-check-input" type="radio" name="medico" value="0">
				<label class="form-check-label" for="gridCheck">
				   No
				</label>
			</div>
	    </div>

	    <div class="form-group col-sm-3">
		     <label>Reported to Police.</label>
			 <div class="form-check">
				<input <?php if($result['Reported_Police']==1){ echo 'checked';}?> class="form-check-input" type="radio" name="police" value="1">
				<label class="form-check-label" for="gridCheck">
					Yes
				</label>
				&nbsp;
				<input <?php if($result['Reported_Police']==0){ echo 'checked';}?> class="form-check-input" type="radio" name="police" value="0">
				<label class="form-check-label" for="gridCheck">
				   No
				</label>
			</div>
	    </div>

    	<div class="form-group col-sm-3">
		   <label>Fir No.</label>
		   <input type="text" class="form-control" value="<?php echo $result['Fir_No'];?>">
        </div>

	    <div class="col-sm-12">
			<label>If not Reported to  Police,give reason.</label>
			<textarea class="form-control" name="report_reason"><?php echo $result['Reported_Reason'];?></textarea>
	    </div>

</div>

<div id="menu6" class="tab-pane fade">
    <div style="clear: both;"><br></div>

    <div id="pageheading" class="col-sm-12">
		<div class="col-sm-6" style="text-align:left;">
			DETAILS OF CLAIM
	    </div>
		<div class="col-sm-6">
			Total Claimed Amount
			<input id="TotalClaimedAmount" type="text" value="<?php echo $Total_Claimed_Amount;?>" name="ClaimedAmount" style="margin-top: -3px;">
		</div>
	</div>
    <?php
	    if (isset($_GET['claimID'] ) && !empty($_GET['claimID'])){
			$ClaimID1 = $_GET['claimID'];
		    $patient_claim_details = "SELECT * FROM patient_claim_details WHERE Claim_ID =$ClaimID1 AND CreatedBy = $logged_userid";
			$details1 = mysql_query($patient_claim_details);
			$claimresult = mysql_fetch_assoc($details1);
		}
    ?>
    
    <div class="form-group col-md-12 col-sm-12">
      <label for="email">
         Details of treatment expenses claimed
      </label>
    </div>



      <div class="form-group col-sm-4 col-md-4">
          <label for="address" class="control-label text-left">Health Check-Up Cost</label>

			<div class="input-group"> 
			<span class="input-group-addon">₹</span>
			<input value="<?php echo $claimresult['Health_CheckUp_Cost'];?>" type="text" class="form-control input-sm expenses numberonly" id="Health_CheckUp_Cost" name="Health_CheckUp_Cost">
			</div>
      </div>

     <div class="form-group col-sm-4 col-md-4 ">
        <label for="address" class="control-label text-left">Pre Hospitalization Expenses</label>

        <div class="input-group"> 
			<span class="input-group-addon">₹</span>
			 <input value="<?php echo $claimresult['Pre_Hospitalization_Expenses'];?>" type="text" class="form-control input-sm expenses numberonly" id="Pre_Hospitalization_Expenses" name="Pre_Hospitalization_Expenses">
			</div>
       
     </div>

  
      <div class="form-group col-sm-4 col-md-4 ">
          <label for="address" class="control-label text-left">Ambulance Charges</label>

          <div class="input-group"> 
			<span class="input-group-addon">₹</span>
			  <input value="<?php echo $claimresult['Ambulance_Charges'];?>" type="text" class="form-control input-sm expenses numberonly" id="Ambulance_Charges" name="Ambulance_Charges">

			</div>


         

      </div> 

      <div class="form-group col-sm-4 col-md-4">
          <label for="address" class="control-label text-left">Hospitalization Accommodation</label>

		  <div class="form-group col-sm-6 col-md-6">
		     <label for="address" class="control-label text-left">Days</label>
		     <input value="<?php echo $claimresult['Accnmmodation_Days'];?>" type="text" class="form-control input-sm" id="Accnmmodation_Days" name="Accnmmodation_Days">
		  </div>
		     
		  <div class="form-group col-sm-6 col-md-6">
		  	  <label for="address" class="control-label text-left">
		  	  Charges</label>

				<div class="input-group"> 
				<span class="input-group-addon">₹</span>
				<input value="<?php echo $claimresult['Accnmmodation_Charges'];?>" type="text" class="form-control input-sm expenses numberonly" id="Accnmmodation_Charges" name="Accnmmodation_Charges">
				</div>

		  </div>
      </div>

      <div class="form-group col-sm-4 col-md-4">
          <label style="margin-left: -104px;" for="address" class="control-label text-left">Consultant  Fees</label>

		   <div class="form-group col-sm-6 col-md-6">
		     <label style="margin-top: 25px;" for="address" class="control-label text-left">Days</label>
		     <input value="<?php echo $claimresult['Consultant_Days'];?>" type="text" class="form-control input-sm" id="Consultant_Days" name="Consultant_Days">
		  </div>

		  <div class="form-group col-sm-6 col-md-6">
		  	 <label for="address" class="control-label text-left">
		  	  Charges</label>
				<div class="input-group"> 
					<span class="input-group-addon">₹</span>
					<input value="<?php echo $claimresult['Consultant_Charges'];?>" type="text" class="form-control input-sm expenses numberonly" id="Consultant_Charges" name="Consultant_Charges">
				</div>
		  </div>

      </div>
     <div class="clearfix"></div>

      <div class="form-group col-sm-4 col-md-4">
        <label for="address" class="control-label text-left">Routine Investigations</label>


        <div class="input-group"> 
					<span class="input-group-addon">₹</span>
					<input value="<?php echo $claimresult['Routine_Investigations'];?>" type="text" class="form-control input-sm expenses numberonly" id="Routine_Investigations" name="Routine_Investigations">
				</div>
      </div>

      <div class="form-group col-sm-4 col-md-4">
	        <label for="address" class="control-label text-left">Medicine & Drugs</label>


	        <div class="input-group"> 
			<span class="input-group-addon">₹</span>
			  <input value="<?php echo $claimresult['Medicicne_Drugs'];?>" type="text" class="form-control input-sm expenses numberonly" id="Medicicne_Drugs" name="Medicicne_Drugs">
		   </div>

      </div>


      <div class="form-group col-sm-4 col-md-4">
        <label for="address" class="control-label text-left">Major Surgical Operation</label>

         <div class="input-group"> 
			<span class="input-group-addon">₹</span>
			   <input value="<?php echo $claimresult['Major_Surgical'];?>" type="text" class="form-control input-sm expenses numberonly" id="Major_Surgical" name="Major_Surgical">
		   </div>
      </div>


      <div class="form-group col-sm-4 col-md-4">
        <label for="address" class="control-label text-left">
        	Intermediate Surg. Operation
        </label>

        <div class="input-group"> 
			<span class="input-group-addon">₹</span>
			<input value="<?php echo $claimresult['Intermediate_Surgical'];?>" type="text" class="form-control input-sm expenses numberonly" id="Intermediate_Surgical" name="Intermediate_Surgical">
		</div>

      </div>

 
      <div class="form-group col-sm-4 col-md-4">
        <label for="address" class="control-label text-left">Ancillary Services</label>

        <div class="input-group"> 
			<span class="input-group-addon">₹</span>
			  <input value="<?php echo $claimresult['Ancillary_Services'];?>" type="text" class="form-control input-sm expenses numberonly" id="Ancillary_Services" name="Ancillary_Services">
		</div>
      </div>

    
      <div class="form-group col-sm-4 col-md-4">
        <label for="address" class="control-label text-left">Post Hospitalization Expenses</label>

         <div class="input-group"> 
			<span class="input-group-addon">₹</span>
			  <input value="<?php echo $claimresult['Post_Hospitalization_Expenses'];?>" type="text" class="form-control input-sm expenses numberonly" id="Post_Hospitalization_Expenses" name="Post_Hospitalization_Expenses">
		</div>

      </div>

     <div class="form-group col-md-3 col-sm-3">
        <label for="address">Total Treatment Expenses</label>

        <div class="input-group"> 
			<span class="input-group-addon">₹</span>
			  <input value="<?php echo $claimresult['Total_Treatment_Expenses'];?>" readonly type="text" class="form-control input-sm numberonly cash_total" id="Total_Treatment_Expenses" name="Total_Treatment_Expenses">
		</div>
        
      </div>

</div>

<div id="menu7" class="tab-pane fade">
    <div style="clear: both;"><br></div>
 	<div id="pageheading" style="text-align:left;">DETAILS OF BILLS</div>


    <?php
 	if(isset($_GET['claimID'] ) && !empty($_GET['claimID'])){
		$claimIDBill = $_GET['claimID'];
        $bill_query = mysql_query("SELECT * FROM patient_claim_bill_enclosed  WHERE Claim_ID ='$claimIDBill'");
        	if(mysql_num_rows($bill_query) >0){

        		while ($bill_details = mysql_fetch_array($bill_query)) { ?>

     <div class="col-md-12 col-sm-12" style="border:1px solid #004F35; margin-top:15px;">

        <div class="form-group col-md-3 col-sm-3">
            <label for="name">Bill No.</label>
            <input type="text" class="form-control input-sm" name="billno[]" value="<?php echo $bill_details['Bill_No'];?>">
        </div>

        <div class="form-group col-md-3 col-sm-3">
            <label for="gender">Date</label>
            <input type="text" class="form-control input-sm datepicker" name="billdate[]" value="<?php if($bill_details['Bill_Date'] != '0000-00-00' && $bill_details['Bill_Date'] != ''){echo date('d-m-Y',strtotime($bill_details['Bill_Date']));}else{}?>">
        </div>

        <div class="form-group col-md-3 col-sm-3">
          <label for="age">Issued By</label>
         <input type="text" class="form-control input-sm" name="billissued[]" value="<?php echo $bill_details['Bill_Issued'];?>">
        </div>

        <div class="form-group col-md-3 col-sm-3">
            <label for="DOB">Towards</label>
            <input type="text" class="form-control input-sm" name="billtowards[]" value="<?php echo $bill_details['Bill_Towards'];?>">
        </div>

         <div class="form-group col-md-3 col-sm-3">
            <label for="DOB">Amount</label>
			<div class="input-group"> 
				<span class="input-group-addon">₹</span>
				<input type="text" class="form-control input-sm" name="billamount[]" value="<?php echo $bill_details['Bill_Amount'];?>">
			</div>
        </div>
		<?php

            if($bill_details['Bill'] != ''){
            
			$new_name = explode("@",$bill_details['Bill']);

			$displayname = $new_name[1];
		?>
		<div class="form-group col-md-6 col-sm-6">
			<label for="Bill"></label><br>
			<a style="color: #004F35;font-size: 15px;font-weight: bold;" target="_blank" href="uploads/bills/<?php echo $bill_details['Bill'];?>"><span><?php echo $displayname;?></span></a>
		</div>

	  <?php } ?>


	</div>


       <?php }
            }	
         }
       ?>
</div>

    <div id="menu4" class="tab-pane fade">
      <div style="clear: both;"><br></div>
      <div id="pageheading" style="text-align: left;">
      		CLAIM DOCUMENTS SUBMITTED
      </div>

              <?php

				   if (isset($_GET['claimID'] ) && !empty($_GET['claimID'])) {
					$new_ID = $_GET['claimID'];
        			$attachment_query = mysql_query("SELECT *  FROM patient_claim_fles  WHERE Claim_ID ='$new_ID'");

        			if(mysql_num_rows($attachment_query) >0){
        				while ($attachments = mysql_fetch_array($attachment_query)) {
        			 	   $doc_name  = $attachments['Doc_Name'];
        			 	   $Docs = $attachments['Docs'];
        			 ?>
        			  <div class="form-group col-sm-6">
        			  	<h3> <?php echo  $doc_name; ?></h3>
				        <?php

				           if( $doc_name != 'Any other, please specify'){
				            $documents  = explode(',',$Docs);
				            for ($i=0; $i < count($documents); $i++) {
								$doc_url = $documents[$i];
                                  
                                 if($doc_url != '') {

								$new_name = explode("@",$doc_url); 
								$displayname = $new_name[1];

								?>
								<a style="color:#004F35" target="_blank" href="uploads/docs/<?php echo $doc_url;?>"><span><?php echo $displayname;?></span></a><br>
                           <?php
                              }       
				            }
        			 	    }else{
        			 	    	echo $attachments['Any_Other'];
        			 	    }
				           ?>
	                   </div>
        		  <?php 
        		    }
        		}	else{
        		  echo 'No Document.';
        	  }
	     }
    ?>
    <div style="clear: both;"><br></div>
     </div>
	<div id="menu5" class="tab-pane fade">

        <div style="clear: both;"><br></div>

        <div id="pageheading" style="text-align: left;">
        	DETAILS IN CASE OF NON NETWORK HOSPITAL (ONLY FILL IN CASE OF NON NETWORK HOSPITAL)
        </div>

		<div class="col-sm-12">
			<label>Address of the hospital </label>
			<input class="form-control" name="AddressHospital" value="<?php echo $result['Hospital_Address'];?>">	
		</div>

		<div style="clear: both;"><br></div>

		<div class="col-sm-4">
			<label>City</label>
			<input value="<?php echo $result['City'];?>" type="text" class="form-control" name="city">
		</div>

        <div class="col-sm-4">
		   <label>State</label>
		   <input value="<?php echo $result['State'];?>" type="text" class="form-control" name="state">
        </div>

        <div class="col-sm-4">
		   <label>Pin Code</label>
		   <input value="<?php if($result['Pin_Code'] != 0){ echo $result['Pin_Code'];}?>" type="text" class="form-control" name="PinCode">
        </div>

       <div style="clear: both;">&nbsp;</div>

       <div class="col-sm-4">
			<label>Mobile No.</label>
			<div style="clear: both;"></div>

			<div class="col-sm-3" style="margin-left: -15px;">
			<input value="<?php echo $result['CountryCode'];?>" type="text" maxlength="3" class="form-control" name="contcode" id="contcode">
			</div>

			<div class="col-sm-4">
			<input value="<?php if($result['AreaCode'] != 0){ echo $result['AreaCode'];}?>" type="text" placeholder="Area Code" class="form-control" maxlength="3" name="areacode" id="areacode">
			</div>

			<div class="col-sm-4">
			<input value="<?php if($result['PhoneNo'] != 0){echo $result['PhoneNo'];} ?>" type="text" placeholder="Phone No" maxlength="8" class="form-control" name="phoneno" id="phoneno">
			</div>
      </div>

        <div class="col-sm-4">
		   <label>Registration No. with State Code</label>
			<input value="<?php if($result['Registration_No'] != 0){echo $result['Registration_No'];} ?>" type="text" class="form-control" name="RegistrationCode">
        </div>

        <div class="col-sm-4">
		   <label>Hospital PAN</label>
		   <input value="<?php echo $result['Hospital_PAN'];?>" type="text" class="form-control" name="HospitalPAN">
        </div>

        <div style="clear: both;"><br></div>

        <div class="col-sm-4">
		   <label>Number of Patient Beds</label>
		   <input value="<?php if($result['Beds'] != 0) {echo $result['Beds'];} ?>" type="text" class="form-control" name="PatientBeds">
        </div>

        <div style="clear: both;"><br></div>

         <div class="col-sm-12">
           <label> Facilities available in the hospital</label>
         </div>

         <div style="clear: both;"><br></div>

         <div class="form-group col-sm-4" style="margin-left: -15px;">
		    <label for="inputPassword3" class="col-sm-2 col-form-label"> OT :</label>
		    <div class="col-sm-5">
			<div class="form-check">
				<input <?php if($result['OT']==1){ echo 'checked';}?> class="form-check-input" type="radio" name="OT" value="1">
				<label class="form-check-label" for="gridCheck">
				  Yes
				</label>
				&nbsp;
				<input <?php if($result['OT']==0){ echo 'checked';}?> class="form-check-input" type="radio" name="OT" value="0">
				<label class="form-check-label" for="gridCheck">
				   No
				</label>
			  </div>
		    </div>
	     </div>

	    <div class="form-group col-sm-4">
		 <label for="inputPassword3" class="col-sm-3 col-form-label"> ICU :</label>
			<div class="col-sm-5">
			<div class="form-check">
				<input <?php if($result['ICU']==1){ echo 'checked';}?> class="form-check-input" type="radio" name="icu" value="1">
				<label class="form-check-label" for="gridCheck">
					Yes
				</label>
				&nbsp;
				<input <?php if($result['ICU']==0){ echo 'checked';}?> class="form-check-input" type="radio" name="icu" value="0">
				<label class="form-check-label" for="gridCheck">
				   No
				</label>
			</div>
			</div>
	     </div>


	    <div class="col-sm-12">
		   <label>Others</label>
			<input value="<?php echo $result['Others'];?>" type="text" class="form-control" name="others">
        </div>
		<div style="clear: both;"><br></div>
			<div id="pageheading" style="text-align: left;">DECLARATION BY THE HOSPITAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Please read very carefully)</div>

			<p style="font-size: 17px;font-style: bold;">We hereby declare that the information furnished in this Claim Form is true & correct to the best of our knowledge and belief. If we have made any false or untrue statement, suppress or concealment of anu material fact, our right to claim under this claim shall be forfeited.</p>

			<div class="col-sm-6">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Date:</label>
					<div class="col-sm-10">
					
					<!-- <input value="<?php echo date('m-d-Y',strtotime($result['Declaration_Date']));?>" type="text" class="form-control" name="date"> -->
					<input type="text" class="form-control" name="date" id="date" value="<?php if($result['Declaration_Date'] != '0000-00-00' && $result['Declaration_Date'] != ''){echo date('d-m-Y',strtotime($result['Declaration_Date']));
			}else{}?>">
					</div>
			</div>

			<div class="col-sm-6">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Place:</label>
					<div class="col-sm-10">
					<input value="<?php echo $result['Declaration_Place'] ;?>" type="text" class="form-control" name="place">
					</div>
			</div>
       </div>

		</div>						
        </form> 
	   </div>   
	 </section>
   </div>
</div>		
</div><!-- big_wrapper ends -->
      
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">


	$('form *').prop('disabled', true);
	$('#amount').prop('disabled', false);

	$("#amount_notes").prop( "disabled", false );

	$("#amount_notes").attr("disabled",false);

	$("#claimid").attr("disabled",false);

	$("#claimid").prop( "disabled", false );

	$('.btn').prop('disabled', false);


 	$('#verify').on('click',function() {

            var claimId = $('#claimID').val();

            var statusvalue = $('#status_value').val();

            $.ajax({
                type: "POST",
                url: "verification_patient.php",
                data: {"type" :'checked',"claimId":claimId,"status":statusvalue},
                success: function(data) {
                    alert(data);
                    $('#success_not').html('<span style="margin-right:13px;" class="glyphicon glyphicon-ok"></span>');
                    $('#verify').html('Verified');
                },
                 error: function() {
                    alert('it broke');
                }
            });

      });


	window.onscroll = function() {myFunction()};

	var navbar = document.getElementById("navigation_tab");
	var sticky = navbar.offsetTop;

	function myFunction() {
	  if (window.pageYOffset >= sticky) {
	    navbar.classList.add("sticky")
	  } else {
	    navbar.classList.remove("sticky");
	  }
	}

 	$('.nav-tabs a').click(function(){
    	$(this).tab('show');
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