<?php
session_start();
ini_set("display_errors","0");
include('include/configinc.php');
include('include/session.php');
include('include/functions.php');
/******Get user and Hospital Deatils********/

   if (isset($_GET['claimID'] ) && !empty($_GET['claimID'])) {
		$ClaimID = $_GET['claimID'];
		$query = "SELECT * FROM patient_details AS PT JOIN hospital_details AS HD ON PT.Claim_ID = HD.Claim_ID JOIN patient_diagnosis_details AS PD ON PT.Claim_ID = PD.Claim_ID JOIN non_network_hospital AS NH ON NH.Claim_ID = PT.Claim_ID WHERE PT.Claim_ID=$ClaimID";
		$results = mysql_query($query);
		$result = mysql_fetch_assoc($results);
		$Total_Claimed_Amount = $result['Total_Claimed_Amount'];
	}

	 function cleanData($a) {
       return str_replace("," , "" , $a);
     }
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>eTPA - Adjudication</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/planpiper.css">
		<link rel="stylesheet" type="text/css" href="fonts/font.css">
		<link rel="shortcut icon" href="images/planpipe_logo.png"/>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link type="text/css" href="css/bootstrap-timepicker.min.css" />
		<style type="text/css">
		.glyphicon-ok{color: green;margin-right: 100px;}
		.glyphicon-remove{color: red;margin-right: 100px;}
		.glyphicon-arrow-up{
           color: red;
          margin-right: 100px;
         }
		.radio label, .checkbox label {font-weight: bold;}
		.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {vertical-align: middle;text-align:center;}
		#plantitle button {
		background-color: #004F35;
		color: #ffffff;
		border: 1px solid #000000;
		}
		.nav-tabs > li > a {
		margin-right: 0px;
		}
		.modal .modal-dialog {
		max-width: 715px;
		}
		input.amount1{
			  text-align: right;
			  padding-right: 15px;
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

	<div id="plantitle" style="font-family:RalewayRegular;font-size: 1.8em;">

		<?php if($result['Adjudicate_Status'] == 0){?>

	  	<a href="#addCode" data-toggle="modal" style="    margin-left: 16px; float:left;"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Adjudicate</button>
        </a>

      <?php } else{ ?>


      	<a href="#" style="margin-left: 16px; float:left;"><button type="button" class="btn btn-success btn-sm" style="background-color: gray;
    color: #ffffff;
    border: 1px solid gray;"><i class="fa fa-plus"></i> Adjudicate</button>
        </a>


      <?php } ?>

		<span style="margin-left:25px;float:left;">Claim ID -  <?php echo $_GET['claimID'];?>
        </span>

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

			<?php if($result['Network_Type']==0){ ?>
			<li class="navbar_li">
				<a class="navbar_href" data-toggle="tab" href="#menu5">Non Network Hospital</a>
			</li>
            <?php } ?>
			<li class="navbar_li">
				<a class="navbar_href" data-toggle="tab" href="#menu9">Insurance Coverage</a>
			</li>
			
			<li class="navbar_li">
				<a class="navbar_href" data-toggle="tab" href="#menu8">Adjudication</a>
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
    </div>

	 <div class="form-group col-sm-6">
	    <label>Patient First Name </label>
	    <input type="text" class="form-control" name="Patient_Name" value="<?php echo $result['Patient_Name'];?>">
    </div>

	<div class="form-group col-sm-6">
	    <label>Patient Last Name </label>
	    <input type="text" class="form-control" name="Patient_Last_Name" value="<?php echo $result['Patient_Last_Name'];?>">
    </div>

    <div class="form-group col-sm-3">
	    <label>Insurance Policy Number</label>
	    <input type="text" class="form-control" id="IP_Registration" name="IP_Registration" value="<?php echo $result['Policy_No'];?>">
    </div>

    <div class="form-group col-sm-3">


				<!--  <?php if($result['Status'] == 2){  
				echo '<span style="color:red;">Under Review</span>';
				}?> -->

				<?php if($result['Status'] == 0){  ?>
				<!-- <button id="review" type="button" class="btn btn-warning btn-md" style="margin-top:-4px;">
				Review
				</button> -->
				<?php } ?>

				<?php if($result['Status'] == 0 || $result['Status'] == 2){?>
				<!-- <button id="reject" type="button" class="btn btn-danger btn-md" style="margin-top:-4px;">
				Reject
				</button> -->
				<?php } ?>

             <?php if($result['Status'] == 3){ ?>
				 	
				<span id="success_reject">
					<span style="margin-right:13px;width:13px;margin-top:23px;"class="glyphicon glyphicon-remove">
					</span>
				</span>

				<button id="verify_reject" type="button" class="btn btn-danger btn-md" style="margin-right: 11px;margin-top: 23px;">
					Patient Not Found <br> Claim rejected
				</button>

			 <?php  } ?>

             <?php if($result['Status'] == 1 || $result['Policy_Status'] == 1){ ?>
					<span id="success_ok">
						<span style="margin-right: 14px;
					width: 13px;margin-top: 31px;" class="glyphicon glyphicon-ok"></span>
					</span>
					<input id="status_value" type="hidden" value="<?php echo $result['Status'];?>">
				 <?php } else{ ?>
         			   <input id="status_value" type="hidden" value="0">
			<?php } ?>


		     <span id="success_veryfy" style="display:none;">
			   <span style="margin-right:13px;width:13px;margin-top:23px;"class="glyphicon glyphicon-ok"></span>
		     </span>


		    <?php if($result['Status'] != 3 || $result['Policy_Status'] == 1 ){ ?>

				<button id="verify" type="button" class="btn btn-success btn-md" style="margin-right: 11px; <?php
				if($result['Policy_Status'] ==1){ echo 'margin-top: 0px;';}else{echo 'margin-top: 23px;';}?>">
				<?php
				if($result['Policy_Status'] ==1){ echo 'Verified';}else{echo 'Verify';} 
				?>
				</button>

		    <?php } ?>


			 <span id="success_reject" style="display:none;">
			   <span style="margin-right:13px;width:13px;margin-top:23px;"class="glyphicon glyphicon-remove"></span>
		     </span>

			<button id="verify_reject" type="button" class="btn btn-danger btn-md" style="display:none;margin-right: 11px; <?php
			if($result['Status'] ==1){ echo 'margin-top: 0px;';}else{echo 'margin-top: 23px;';}?>">
			    Patient Not Found <br>
			    Claim rejection email sent
			</button>

           <input type="hidden" name="claimID" id="claimID" value="<?php echo $_GET['claimID']?>">

           <input type="hidden" name="submitterID" id="submitterID" value="<?php echo $result['CreatedBy'];?>">
    
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
			
			<!-- <input type="text" class="form-control" name="DateofAdmission" id="DateofAdmission" value="<?php if($result['Date_of_Admission']){echo date('d-m-Y',strtotime($result['Date_of_Admission']));}?>"> -->
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
			<!-- <input type="text" class="form-control" name="DateofDelivery" id="DateofDelivery" value="<?php if($result['Date_of_Delivery']){echo date('m-d-Y',strtotime($result['Date_of_Delivery']));}?>"> -->
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
            $r = 0; 
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
						<?php $r++;} ?>
			     </div>
		<?php
		   $i++;
			}
	    ?>


	<div class="form-group col-sm-6">

		<?php  if($result['Status'] == 3){    ?>

			<span style="color:red; font-size: 20px;font-weight:bold;">Patient not found claim rejected</span>

		<?php  } else { if( $r >0){ ?>

			<button id="review_diagnosed" type="button" class="btn btn-success btn-md" style="margin-top:-4px;margin-left: 10px;">Verify</button>

		<?php } else{ ?>

			<button id="claim_process" type="button" class="btn btn-success btn-md" style="margin-top:-4px;margin-left: 10px;">Verify</button>

		<?php }  } ?>

	</div>	

    <div class="form-group col-sm-6">
    	
    </div>	

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
	   

		<?php

			if (isset($_GET['claimID'] ) && !empty($_GET['claimID'])){
				$ClaimID1 = $_GET['claimID'];
			    $patient_claim_details = "SELECT * FROM patient_claim_details WHERE Claim_ID =$ClaimID1";
				$details1 = mysql_query($patient_claim_details);
				$claimresult = mysql_fetch_assoc($details1);
			}

		$policy_id = $result['Policy_No'];

		$policy_id_query = "SELECT * FROM customer_setup_details AS CSD JOIN employee_details AS EMP ON CSD.Cust_ID = EMP.	Customer_Code WHERE EMP.PolicyID = $policy_id";

		$policy_id_result = mysql_query($policy_id_query);

		if(mysql_num_rows($policy_id_result) > 0) {
			$customer_expenses = mysql_fetch_assoc($policy_id_result);
		}

		$currency = $customer_expenses['Currency'];

		?>

		<div id="pageheading" class="col-sm-12">
			<div class="col-sm-6" style="text-align:left;">
				DETAILS OF CLAIM
		    </div>
			<div class="col-sm-6">
				Total Claimed Amount &nbsp;<?php if($currency !=''){echo $currency;}else{}?>
				<input id="TotalClaimedAmount" type="text" value="<?php echo $Total_Claimed_Amount;?>" name="ClaimedAmount" style="margin-top: -3px;">
			</div>
		</div>

		<div class="form-group col-md-12 col-sm-12">
			<label for="email">
			Details of treatment expenses claimed
			</label>
		</div>

		<div class="form-group col-sm-3 col-md-3">
			<label for="address" class="control-label text-left">
				Health Check-Up Cost
			   <?php 
				if( $customer_expenses['Health_CheckUp_Cost'] !=''){ 
						echo '( Max ₹'. $customer_expenses['Health_CheckUp_Cost'].' )'; 
				}else{ }
			   ?>	
			</label>

			<div class="input-group"> 
				 <span class="input-group-addon">₹</span>
				 <input value="<?php echo $claimresult['Health_CheckUp_Cost'];?>" type="text" class="form-control input-sm expenses numberonly" id="Health_CheckUp_Cost" name="Health_CheckUp_Cost">
			</div>

		</div>

		 <?php if($claimresult['Health_CheckUp_Cost'] != ''){ ?>

		<div class="form-group col-sm-1 col-md-1">
			<?php 

			if( $customer_expenses['Health_CheckUp_Cost'] !=''){

			if(cleanData($claimresult['Health_CheckUp_Cost'])  <= cleanData($customer_expenses['Health_CheckUp_Cost']) ){ ?>
				<span style="margin-right: 14px;width: 13px;margin-top: 31px;" class="glyphicon glyphicon-ok">	
			    </span>
			<?php }else{ ?>
				<span style="margin-right: 14px;width: 13px;margin-top: 31px;" class="glyphicon glyphicon-arrow-up">	
			    </span>
			 <?php } } ?>
		</div>
	   <?php }  ?>

        <div class="form-group col-sm-4 col-md-4">
        <label for="address" class="control-label text-left">
        	Pre Hospitalization Expenses  <!-- &nbsp;<?php if($currency !=''){echo $currency;}else{}?> -->
        	   <?php 
				if( $customer_expenses['Pre_Hospitalization_Expenses'] !=''){ 
						echo '( Max ₹'. $customer_expenses['Pre_Hospitalization_Expenses'].' )'; 
				}else{ }
			   ?>
        </label>

               <div class="input-group"> 
				 <span class="input-group-addon">₹</span>
				  <input value="<?php echo $claimresult['Pre_Hospitalization_Expenses'];?>" type="text" class="form-control input-sm expenses numberonly" id="Pre_Hospitalization_Expenses" name="Pre_Hospitalization_Expenses">
			   </div>
       
     </div>


      <?php if($claimresult['Pre_Hospitalization_Expenses'] != ''){ ?>

        <div class="form-group col-sm-1 col-md-1">
			<?php 
			if( $customer_expenses['Pre_Hospitalization_Expenses'] !=''){ 
			if(cleanData($claimresult['Pre_Hospitalization_Expenses']) <= cleanData($customer_expenses['Pre_Hospitalization_Expenses']) )
			{ ?>
				<span style="margin-right: 14px;width: 13px;margin-top: 31px;" class="glyphicon glyphicon-ok">	
			    </span>
			<?php }else{ ?>
				<span style="margin-right: 14px;width: 13px;margin-top: 31px;" class="glyphicon glyphicon-arrow-up">	
			    </span>
			 <?php }  } ?>
		</div><div style="clear: both;"><br></div>
	 <?php } ?>

        <div class="form-group col-sm-3 col-md-3">
          <label for="address" class="control-label text-left">Ambulance Charges <!--  &nbsp;<?php if($currency !=''){echo $currency;}else{}?> -->
          	  <?php 
				if( $customer_expenses['Ambulance_Charges'] !=''){ 
						echo '( Max ₹'. $customer_expenses['Ambulance_Charges'].' )'; 
				}else{ }
			   ?>
          </label>

               <div class="input-group"> 
				 <span class="input-group-addon">₹</span>
				  <input value="<?php echo $claimresult['Ambulance_Charges'];?>" type="text" class="form-control input-sm expenses numberonly" id="Ambulance_Charges" name="Ambulance_Charges">
			   </div>

        </div>


         <?php if($claimresult['Ambulance_Charges'] != ''){ ?>

        <div class="form-group col-sm-1 col-md-1">
			<?php 
			if( $customer_expenses['Ambulance_Charges'] !=''){ 
			if(cleanData($claimresult['Ambulance_Charges']) <= cleanData($customer_expenses['Ambulance_Charges']) )
			{ ?>
				<span style="margin-right: 14px;width: 13px;margin-top: 31px;" class="glyphicon glyphicon-ok">	
			    </span>
			<?php }else{ ?>
				<span style="margin-right: 14px;width: 13px;margin-top: 31px;" class="glyphicon glyphicon-arrow-up">	
			    </span>
			 <?php } } ?>
		</div>
	   <?php }  ?>

      <div class="form-group col-sm-6 col-md-6">
          <label for="address">Hospitalization Accommodation 
          	   <?php 
				if( $customer_expenses['Hospitalization_Accnmmodation'] !=''){ 
						echo '( Max ₹ '. $customer_expenses['Hospitalization_Accnmmodation'].' )'; 
				}else{ }
			   ?>
          </label>

		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 col-form-label">Days</label>
			<div class="col-sm-4">
			<input value="<?php echo $claimresult['Accnmmodation_Days'];?>" type="text" class="form-control input-sm" id="Accnmmodation_Days" name="Accnmmodation_Days">
			</div>
		</div>


		<div class="form-group" style="margin-top: -15px;">
			<label for="inputEmail" class="col-sm-2 col-form-label">Charges</label>
			<div class="col-sm-4">
			<div class="input-group"> 
				 <span class="input-group-addon">₹</span>
				  <input value="<?php echo $claimresult['Accnmmodation_Charges'];?>" type="text" class="form-control input-sm expenses numberonly" id="Accnmmodation_Charges" name="Accnmmodation_Charges">
			   </div>
			</div>
		</div>

	</div>

	<?php if($claimresult['Accnmmodation_Charges'] != ''){ ?>
			<div class="form-group col-sm-1 col-md-1">
			<?php 
				if( $customer_expenses['Hospitalization_Accnmmodation'] !=''){ 
			if(cleanData($claimresult['Accnmmodation_Charges']) <= cleanData($customer_expenses['Hospitalization_Accnmmodation']))
			{ ?>
				<span style="margin-right: 14px;width: 13px;margin-top: 31px;" class="glyphicon glyphicon-ok">	
			    </span>
			<?php }else{ ?>
				<span style="margin-right: 14px;width: 13px;margin-top: 31px;" class="glyphicon glyphicon-arrow-up">	
			    </span>
			 <?php } } ?>
			</div>
	<?php } ?>
     

      <div class="form-group col-sm-6 col-md-6">
          <label for="address">
          Consultant  Fees
              <?php 
				if( $customer_expenses['Consuitant'] !=''){ 
						echo '( Max ₹ '. $customer_expenses['Consuitant'].' )'; 
				}else{ }
			   ?>
          </label>


          <div class="form-group">
			<label for="inputEmail" class="col-sm-2 col-form-label">Days</label>
			<div class="col-sm-4">
			 <input value="<?php echo $claimresult['Consultant_Days'];?>" type="text" class="form-control input-sm" id="Consultant_Days" name="Consultant_Days">
			</div>
		  </div>


		<div class="form-group" style="margin-top: -15px;">
			<label for="inputEmail" class="col-sm-2 col-form-label">Charges</label>
			<div class="col-sm-4">
			<div class="input-group"> 
				 <span class="input-group-addon">₹</span>
				  <input value="<?php echo $claimresult['Consultant_Charges'];?>" type="text" class="form-control input-sm expenses numberonly" id="Consultant_Charges" name="Consultant_Charges">
			    </div>
			</div>
		</div>  
		 
      </div>


       <?php if($claimresult['Consultant_Charges'] != ''){ ?>
		   <div class="form-group col-sm-1 col-md-1">
				<?php 
				if( $customer_expenses['Consuitant'] !=''){ 
				if(cleanData($claimresult['Consultant_Charges']) <= cleanData($customer_expenses['Consuitant']) )
				{ ?>
					<span style="margin-right: 14px;width: 13px;margin-top:30px;" class="glyphicon glyphicon-ok">	
				    </span>
				<?php }else{ ?>
					<span style="margin-right: 14px;width: 13px;margin-top: 30px;" class="glyphicon glyphicon-arrow-up">	
				    </span>
				 <?php } } ?>
			</div>
		 <?php } ?>

      <div class="form-group col-sm-3 col-md-3">
        <label for="address" class="control-label text-left">Routine Investigations
    	  <?php 
			if( $customer_expenses['Routine_Investigations'] !=''){ 
					echo '( Max ₹ '. $customer_expenses['Routine_Investigations'].' )'; 
			}else{ }
		   ?>
        </label>

            <div class="input-group"> 
			 <span class="input-group-addon">₹</span>
			  <input value="<?php echo $claimresult['Routine_Investigations'];?>" type="text" class="form-control input-sm expenses numberonly" id="Routine_Investigations" name="Routine_Investigations">
		    </div>

      </div>

		  <?php if($claimresult['Routine_Investigations'] != ''){ ?>
		   <div class="form-group col-sm-1 col-md-1">
				<?php 
				if( $customer_expenses['Routine_Investigations'] !=''){ 
				if(cleanData($claimresult['Routine_Investigations']) <= cleanData($customer_expenses['Routine_Investigations']) )
				{ ?>
					<span style="margin-right: 14px;width: 13px;margin-top: 30px;" class="glyphicon glyphicon-ok">	
				    </span>
				<?php }else{ ?>
					<span style="margin-right: 14px;width: 13px;margin-top: 30px;" class="glyphicon glyphicon-arrow-up">	
				    </span>
				 <?php } }?>
			</div>
		   <?php } ?>

      <div class="form-group col-sm-3 col-md-3">
			<label for="address" class="control-label text-left">
			Medicine & Drugs
			<?php 
				if( $customer_expenses['Medicicne_Drugs'] !=''){ 
				echo '( Max ₹ '. $customer_expenses['Medicicne_Drugs'].' )'; 
				}else{ }
			?>
			</label>

			 <div class="input-group"> 
			 <span class="input-group-addon">₹</span>
			   <input value="<?php echo $claimresult['Medicicne_Drugs'];?>" type="text" class="form-control input-sm expenses numberonly" id="Medicicne_Drugs" name="Medicicne_Drugs">
		    </div>

      </div>

       <?php if($claimresult['Medicicne_Drugs'] != ''){ ?>

	        <div class="form-group col-sm-1 col-md-1">
				<?php 
				if( $customer_expenses['Medicicne_Drugs'] !=''){ 

				if(cleanData($claimresult['Medicicne_Drugs']) <= cleanData($customer_expenses['Medicicne_Drugs'])) 
				{ 
					?>
					<span style="margin-right: 14px;width: 13px;margin-top: 30px;" class="glyphicon glyphicon-ok">	
				    </span>
				<?php }else{ ?>
					<span style="margin-right: 14px;width: 13px;margin-top:30px;" class="glyphicon glyphicon-arrow-up">	
				    </span>
				 <?php } }?>
			</div>
		 <?php } ?>

        <div class="form-group col-sm-4 col-md-4">
	        <label for="address" class="control-label text-left">
	        	Major Surgical Operation
		        <?php 
					if( $customer_expenses['Major_Surgical'] !=''){ 
							echo '( Max ₹ '. $customer_expenses['Major_Surgical'].' )'; 
					}else{ }
			    ?>
	        </label>

	        <div class="input-group"> 
			  <span class="input-group-addon">₹</span>
			  <input value="<?php echo $claimresult['Major_Surgical'];?>" type="text" class="form-control input-sm expenses numberonly" id="Major_Surgical" name="Major_Surgical">
		    </div>

       </div>

        <?php if($claimresult['Major_Surgical'] != ''){ ?>

        <div class="form-group col-sm-1 col-md-1">
			<?php 
			if( $customer_expenses['Major_Surgical'] !=''){ 
			if(cleanData($claimresult['Major_Surgical']) <= cleanData($customer_expenses['Major_Surgical']) )
			{ ?>
				<span style="margin-right: 14px;width: 13px;margin-top: 28px;" class="glyphicon glyphicon-ok">	
			    </span>

			<?php }else{ ?>
				<span style="margin-right: 14px;width: 13px;margin-top: 28px;" class="glyphicon glyphicon-arrow-up">	
			    </span>
			 <?php } } ?>
		</div>  <div style="clear: both;"></div>
	   <?php }  ?>  


      <div class="form-group col-sm-4 col-md-4">
        <label for="address" class="control-label text-left">
        	Intermediate Surg. Operation<!-- <br>  &nbsp;<?php if($currency !=''){echo $currency;}else{}?> -->
        	<?php 
				if( $customer_expenses['Intermediate_Surgical'] !=''){ 
				echo '( Max ₹ '. $customer_expenses['Intermediate_Surgical'].' )'; 
				}else{ }
	        ?>
        </label>


            <div class="input-group"> 
			  <span class="input-group-addon">₹</span>
			  <input value="<?php echo $claimresult['Intermediate_Surgical'];?>" type="text" class="form-control input-sm expenses numberonly" id="Intermediate_Surgical" name="Intermediate_Surgical">
		    </div>

      </div>

        <?php if($claimresult['Intermediate_Surgical'] != ''){ ?>

		      <div class="form-group col-sm-1 col-md-1">
					<?php 
					if( $customer_expenses['Intermediate_Surgical'] !=''){ 
					if(cleanData($claimresult['Intermediate_Surgical']) <= cleanData($customer_expenses['Intermediate_Surgical']) )
					{ ?>
						<span style="margin-right: 14px;width: 13px;margin-top:30px;" class="glyphicon glyphicon-ok">	
					    </span>

					<?php }else{ ?>
						<span style="margin-right: 14px;width: 13px;margin-top: 30px;" class="glyphicon glyphicon-arrow-up">	
					    </span>
					 <?php } } ?>
				</div>

		 <?php }  ?>

 
      <div class="form-group col-sm-3 col-md-3">
        <label for="address" class="control-label text-left">
	        Ancillary Services 
	        <?php 
				if( $customer_expenses['Ancillary_Services'] !=''){ 
			echo '( Max ₹ '. $customer_expenses['Ancillary_Services'].' )'; 
			}else{ }
		    ?>
        </label>

		<div class="input-group"> 
		   <span class="input-group-addon">₹</span>
		   <input value="<?php echo $claimresult['Ancillary_Services'];?>" type="text" class="form-control input-sm expenses numberonly" id="Ancillary_Services" name="Ancillary_Services">
		</div>

      </div>

       <?php if($claimresult['Ancillary_Services'] != ''){ ?>

      <div class="form-group col-sm-1 col-md-1">
			<?php 
			if( $customer_expenses['Ancillary_Services'] !=''){
			 if(cleanData($claimresult['Ancillary_Services']) <= cleanData($customer_expenses['Ancillary_Services']) )
			 { ?>
				<span style="margin-right: 14px;width: 13px;margin-top:32px;" class="glyphicon glyphicon-ok">	
			    </span>

			<?php }else{ ?>
				<span style="margin-right: 14px;width: 13px;margin-top:32px;" class="glyphicon glyphicon-arrow-up">	
			    </span>
			 <?php } } ?>
		</div>
        <div style="clear: both;"></div>
     <?php } ?>
    
      <div class="form-group col-sm-4 col-md-4">
        <label for="address" class="control-label text-left">Post Hospitalization Expenses

        <?php 
			if( $customer_expenses['Post_Hospitalization_Expenses'] !=''){ 
		echo '( Max ₹ '. $customer_expenses['Post_Hospitalization_Expenses'].' )'; 
		}else{ }
	    ?>
        </label>


         <div class="input-group"> 
			   <span class="input-group-addon">₹</span>
			    <input value="<?php echo $claimresult['Post_Hospitalization_Expenses'];?>" type="text" class="form-control input-sm expenses numberonly" id="Post_Hospitalization_Expenses" name="Post_Hospitalization_Expenses">
		 </div>


      </div>


       <?php if($claimresult['Post_Hospitalization_Expenses'] != ''){ ?>

        <div class="form-group col-sm-1 col-md-1">
			<?php 
			if( $customer_expenses['Post_Hospitalization_Expenses'] !=''){
			if(cleanData($claimresult['Post_Hospitalization_Expenses']) <= cleanData($customer_expenses['Post_Hospitalization_Expenses']) )
			{ ?>
				<span style="margin-right: 14px;width: 13px;margin-top:30px;" class="glyphicon glyphicon-ok">	
			    </span>
			<?php }else{ ?>
				<span style="margin-right: 14px;width: 13px;margin-top:30px;" class="glyphicon glyphicon-arrow-up">	
			    </span>
			 <?php } }?>
		</div>
		 <?php } ?>
		<div style="clear: both;"></div>
	      <div class="form-group col-md-3 col-sm-3 col-lg-offset-5">
	        <label for="address">Total Treatment Expenses</label>

	         <div class="input-group"> 
			   <span class="input-group-addon">₹</span>
			     <input value="<?php echo $claimresult['Total_Treatment_Expenses'];?>" readonly type="text" class="form-control input-sm numberonly cash_total" id="Total_Treatment_Expenses" name="Total_Treatment_Expenses" value="0">
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
            <label for="DOB">Amount<!-- <?php if($currency !=''){echo $currency;}else{}?> --></label>

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
      <?php 
          }
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

				           if( $doc_name != 'Any other, please specify' && $doc_name != '' ){

				            $documents  = explode(',',$Docs);
				            for ($i=0; $i < count($documents); $i++) {
								$doc_url = $documents[$i];
								$new_name = explode("@",$doc_url); 
								$displayname = $new_name[1];
								?>
								<a style="color: #004F35;font-size: 15px;font-weight: bold;" target="_blank" href="uploads/docs/<?php echo $doc_url;?>"><span><?php echo $displayname;?></span></a><br>
                           <?php        
				            }
        			 	    }else{
        			 	    	echo $attachments['Any_Other'];
        			 	    }
				           ?>
	                   </div>
        		  <?php 
        		    }
        		}	else{ ?>

					<div class="form-group col-sm-12" style="text-align: center;
					font-size: 20px;
					font-weight: bold;">
					<span style="color:red;">Document not found.</span>
					</div>
        	  <?php }
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
				<input value="<?php if($result['AreaCode'] != 0 ) {echo $result['AreaCode'];} ?>"  type="text" placeholder="Area Code" class="form-control" maxlength="3" name="areacode" id="areacode">
			</div>

			<div class="col-sm-4">
				<input value="<?php if($result['PhoneNo'] != 0) {echo $result['PhoneNo'];} ?>"  type="text" placeholder="Phone No" maxlength="8" class="form-control" name="phoneno" id="phoneno">
			</div>
      </div>

        <div class="col-sm-4">
		   <label>Registration No. with State Code</label>
			<input value="<?php echo $result['Registration_No'];?>" type="text" class="form-control" name="RegistrationCode">
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

    <div id="menu8" class="tab-pane fade">
        <div style="clear:both;"><br></div>
        <div id="pageheading" style="text-align: left;">
        	ADJUDICATION DETAILS
        </div>
        <div class="col-sm-4">
			<label>Adjudication Date</label>
			<input class="form-control" name="adjudication_date" value="<?php if($result['Adjudication_Date'] != '0000-00-00 00:00:00' && $result['Adjudication_Date'] != ''){echo date('d-m-Y',strtotime($result['Adjudication_Date']));
			}else{}?>">

		</div>
		<div class="col-sm-4">
			<label>Amount</label>

			<div class="input-group"> 
				 <span class="input-group-addon">₹</span>
				 <input class="form-control" name="amount" value="<?php echo $result['Amount'];?>">	
			</div>

		</div>
		<div class="col-sm-12">
			<label>Adjudication Notes</label>
			<textarea class="form-control"><?php echo $result['Amount_Notes'];?></textarea>	
		</div>
	    </div>


  <div id="menu9" class="tab-pane fade">

        <div style="clear:both;"><br></div>

        <div id="pageheading" style="text-align:left;">Insurance Coverage</div>


        <?php 
            $Policy_No = $result['Policy_No'];
			$policy_query = "SELECT * FROM customer_setup_details AS CSD JOIN employee_details AS EMP ON CSD.Cust_ID = EMP.	Customer_Code WHERE EMP.PolicyID = $Policy_No";
			$policy_result = mysql_query($policy_query);

            if(mysql_num_rows($policy_result) > 0) {
			$cusomer = mysql_fetch_assoc($policy_result);

         ?>

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
	   <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Annual Coverage <!-- <?php if($currency !=''){echo $currency;}else{}?> --></label>
	   <div class="col-sm-6 col-md-6">


	   	    <div class="input-group"> 
				<span class="input-group-addon">₹</span>
				<input value="<?php echo $cusomer['Annual_Coverage_Medical'];?>" type="text" class="form-control input-sm numberonly" id="medical_coverage" name="medical_coverage" placeholder="">
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
	   <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Annual Coverage <!-- <?php if($currency !=''){echo $currency;}else{}?> --></label>
	   <div class="col-sm-6 col-md-6"> 

	   	   <div class="input-group"> 
				<span class="input-group-addon">₹</span>
				<input value="<?php echo $cusomer['Annual_Coverage_Dental'];?>" type="text" class="form-control input-sm numberonly" id="dental_coverage" name="dental_coverage" placeholder="">
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
	   <label for="happy" class="col-sm-5 col-md-5 control-label text-left">Annual Coverage <!-- <?php if($currency !=''){echo $currency;}else{}?> --></label>
	   <div class="col-sm-6 col-md-6"> 

	   	    <div class="input-group"> 
				<span class="input-group-addon">₹</span>
				 <input value="<?php echo $cusomer['Annual_Coverage_Vision'];?>" type="text" class="form-control input-sm numberonly" id="vision_coverage" name="vision_coverage" placeholder="">
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
		<input value="<?php echo  date('d-m-Y',strtotime($cusomer['Period_Of_Insurance']));?>"  type="text" class="form-control input-sm numberonly" id="period_insurance" name="period_insurance" placeholder="">
		</div>
	</div>
  </div>

  <div class="col-md-4 col-sm-4">
	<div class="form-group">
		<label for="happy" class="col-sm-6 col-md-6 control-label text-left">To Midnight Of</label>
		<div class="col-sm-6 col-md-6"> 
		<input value="<?php echo date('d-m-Y',strtotime($cusomer['To_Midnight_Of']));?>" type="text" class="form-control input-sm" id="to_midnight" name="to_midnight" placeholder="">
		</div>
	</div>
  </div>
  
  <!-- <div class="col-md-12 col-sm-12">
     <label for="years">Expense Limits</label>
  </div> -->

	<!-- <div class="col-md-4 col-sm-4">
	  <div class="form-group">
	      <label for="name">Room Rent / Boarding/ Nursing Expenses per day </label>
	      <input value="<?php echo $cusomer['Roomrent_Boarding_Nursing'];?>" type="text" class="form-control input-sm numberonly" id="room_rent" name="room_rent">
	  </div>
	</div> -->

	<!-- <div class="col-md-4 col-sm-4">
	  <div class="form-group">
	      <label for="name">ICU per day charges</label>
	      <input value="<?php echo $cusomer['ICU_Charges'];?>" type="text" class="form-control input-sm numberonly" id="icu_rent" name="icu_rent">
	  </div>
	</div> -->

	<!-- <div class="col-md-4 col-sm-4">
	  <div class="form-group">
	      <label for="name">Cataract Claims</label>
	      <input type="text" value="<?php echo $cusomer['Cataract_Claims'];?>" class="form-control input-sm numberonly" id="cataract_claims" name="cataract_claims">
	  </div>
	</div> -->

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

   <!-- <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Re-imbursement of health checkup costs</label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Re_Imbursement_Costs_Status'] == 1){ echo 'checked';}else{}?> type="radio" name="Re_imbursement" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Re_Imbursement_Costs_Status'] == 0){ echo 'checked';}else{}?> type="radio" name="Re_imbursement" value="0">No
      </label>
      </div>
   </div>
   <div class="clearfix"></div> -->

   <!-- <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Domicialary Hospitalization</label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Domicialary_Hospitalization_Status'] == 1){ echo 'checked';}else{}?> type="radio" name="Domicialary" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Domicialary_Hospitalization_Status'] == 0){ echo 'checked';}else{}?> type="radio" name="Domicialary" value="0">No
      </label>
      </div>
   </div>
   <div class="clearfix"></div> -->

   <!-- <div class="form-group">
      <label for="happy" class="col-sm-6 col-md-6 control-label text-left">Pre & Post Hospitalization Cover</label>
      <div class="col-sm-6 col-md-6">
      <label class="radio-inline">
      <input <?php if($cusomer['Pre_Post_Hospitalization_Status'] == 1){ echo 'checked';}else{}?> type="radio" name="Hospitalization_Cover" value="1">Yes
      </label>
      <label class="radio-inline">
      <input <?php if($cusomer['Pre_Post_Hospitalization_Status'] == 0){ echo 'checked';}else{}?> type="radio" name="Hospitalization_Cover" value="0">No
      </label>
      </div>
   </div>
   <div class="clearfix"></div> -->
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
<?php } else { ?>

 <div class="form-group col-sm-12" style="text-align: center;
    font-size: 20px;
    font-weight: bold;">
	<span style="color:red;">Insurance 
	coverage not found</span>
 </div>

<?php } ?>
    </div>

	</div>

   </form>
   
</div>   
</section>
</div>
</div>



<!-- MODEL FOR POPUP Review    -->

	<div class="modal fade" id="sucessfully" role="dialog">

	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title">Claim Processing</h4>
	    </div>
	    <div class="modal-body" id="content_1" >
                 
	    	<p><h4 style="text-align: center;">All procedures are approved. Claim can be sent for payment processing</h4></p>

	    </div>
	    <div class="modal-footer">

	      <button style="width: 150px;
    margin-top: 10px;" id="PaymentProcess" type="button" class="btn btn-primary">
	      	Payment Process
          </button>
         
	      <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel
	      </button>
	    </div>
	  </div>
	</div>
	</div>


  <!-- Add Code -->

  <div id="addCode" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form name="addCodeForm" id="addCodeForm" method="post">
        	<input value="<?php echo $_GET['claimID'];?>" type="hidden" name="claimid" id="claimid">
          <div class="modal-header">            
            <h4 class="modal-title">Enter Payment Amount</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
           <div class="modal-body">          
            <div class="form-group">
              <label>Amount</label>

              <div class="input-group"> 
				 <span class="input-group-addon">₹</span>
				 <input id="amount" name="amount" type="text" class="form-control amount1" required>
			  </div>
             
            </div>
            <div class="form-group">
              <label>Adjudication Notes</label>
              <textarea class="form-control"  id="amount_notes" name="amount_notes" required></textarea>
              
            </div>   
           </div>
          <div class="modal-footer">

            <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancel">

            <input style="margin-top: -1px;" id="submit_code" type="submit" class="btn btn-primary" value="Update">

          </div>
        </form>
      </div>
    </div>
  </div>

<!-- MODEL FOR POPUP Review    -->

	<div class="modal fade" id="myreview" role="dialog">

	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title">Claim Processing</h4>
	    </div>
	    <div class="modal-body" id="content_1" >
                 
	    	<p><h4 style="text-align: center;">Certain Procedures are not covered in this claim.</h4></p>
	    	<p><h4 style="text-align: center;">
	    	Click <a href="javascript:void(0)" id="view_mail">View Mail</a> to View/Print/Email the response letter to the submitter</h4>
	        </p>


	    </div>
	    <div class="modal-footer">
	      <button style="width: 150px;
    margin-top: 10px;" id="review" type="button" class="btn btn-primary">
	      	View response mail
          </button>
         
	      <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel
	      </button>
	    </div>
	  </div>
	</div>
	</div>


<!-- MODEL FOR POPUP    -->

	<div class="modal fade" id="myModal" role="dialog">

	    <?php 

		$ID = $_GET['claimID'];

		$status = $result['Status'];

		$submitterID = $result['CreatedBy'];

		$submitter_query = mysql_query("SELECT A.EmailID,A.MobileNo,D.FirstName,D.LastName FROM USER_ACCESS AS A JOIN USER_DETAILS AS D ON A.UserID = D.UserID WHERE A.UserID = $submitterID");

		$result = mysql_fetch_assoc($submitter_query);
		$submitter_email = $result['EmailID'];
		$submitter_mobile = $result['MobileNo'];
		$submitter_name = $result['FirstName'].' '.$result['LastName'];


		$patient_query = mysql_query("SELECT Patient_Name,Patient_Last_Name,Policy_No FROM patient_details WHERE Claim_ID = $ID");

		$pat_result = mysql_fetch_assoc($patient_query);

		$pat_name = $pat_result['Patient_Name'].' '.$pat_result['Patient_Last_Name'];

		$pat_policyNo = $pat_result['Policy_No'];

		$hos_query = mysql_query("SELECT Declaration_Date FROM hospital_details WHERE Claim_ID = $ID");

		$hos_result = mysql_fetch_assoc($hos_query);

		$claimfilingDate = date("d-m-Y", strtotime($hos_result['Declaration_Date']));

		?>

	<div class="modal-dialog modal-lg">

	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title">Claim Processing Review</h4>
	    </div>
	    <div class="modal-body" id="content_2" >
	        <!DOCTYPE html>
<html>
<head>
<title>Insurance Policy</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css"> 
    body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
    table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} 
    img{-ms-interpolation-mode: bicubic;}
    img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
    table{border-collapse: collapse !important;}
    body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }
    @media screen and (max-width: 525px) {
        .wrapper {
          width: 100% !important;
            max-width: 100% !important;
        }
        .logo img {
          margin: 0 auto !important;
        }
        .mobile-hide {
          display: none !important;
        }
        .img-max {
          max-width: 100% !important;
          width: 100% !important;
          height: auto !important;
        }
        .responsive-table {
          width: 100% !important;
        }
        .padding {
          padding: 10px 5% 15px 5% !important;
        }
        .padding-meta {
          padding: 30px 5% 0px 5% !important;
          text-align: center;
        }
        .padding-copy {
             padding: 10px 5% 10px 5% !important;
          text-align: center;
        }
        .no-padding {
          padding: 0 !important;
        }

        .section-padding {
          padding: 50px 15px 50px 15px !important;
        }
        .mobile-button-container {
            margin: 0 auto;
            width: 100% !important;
        }
        .mobile-button {
            padding: 15px !important;
            border: 0 !important;
            font-size: 16px !important;
            display: block !important;
        }
    }
    div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
</head>
<body style="margin: 0 !important; padding: 0 !important;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#ffffff" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="wrapper">
                <tr>
                    <td align="center" valign="top" style="padding: 15px 0;" class="logo">

						<p>ABC Insurance Company<br>
						PO Box 123456<br>
						Bangalore,560001</P>
                        
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 15px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 795px;" class="responsive-table">
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>
              <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">

					<p><strong>Ref : </strong>Patient Name : <span style="margin-left: 74px;"><?php echo $pat_name; ?></span></p>
					<p style="margin-left:40px;">Claim id :  <span style="margin-left:112px;"><?php echo $ID; ?></span></p>
					<p style="margin-left:40px;">Policy Number : <span style="    margin-left:65px;"><?php echo $pat_policyNo; ?>
					</span></p>
					<p style="margin-left:40px;">Subscriber Number : <span style="margin-left: 29px;"><?php echo $pat_policyNo; ?></span></P>
					<p style="margin-left:40px;">Date of Claim Filing :<span style="margin-left:33px;"><?php echo $claimfilingDate; ?></span></p>

              </td>
           </tr>

        <tr>
            <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
              <strong>Dear <?php echo $submitter_name ;?></strong>
            </td>
        </tr>
        <tr>
          <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
              <p>
              The claim <strong><?php echo $ID ;?></strong>, submitted for <strong><?php echo $pat_name ;?></strong>, was processed and the following procedures/charges have been denied-
              </p>
          </td>
        </tr>
        <tr>
           <td>
              <table class="table table-bordered dataTable no-footer" role="grid" style="width:100%;border:1px solid #000;text-align:center;" border="1">
              <thead>
                <tr>
                  <th>S. No.</th>
                  <th>Procedure/Charges</th>
                  <th>Description of the procedure </th>
                </tr>
              </thead>
              <tbody>
             <?php 

			if (isset($_GET['claimID'] ) && !empty($_GET['claimID'])) {
				$query_master = "SELECT DISTINCT ICD10CM, ICD10PCS FROM diagnosis_master";
				$result_m = mysql_query($query_master);
				$icdcm = [];
				$icdpcs = [];
				while ($result_q = mysql_fetch_array($result_m))  
				{
					array_push($icdcm,$result_q["ICD10CM"]);
					array_push($icdpcs,$result_q["ICD10PCS"]);
				}
				$icdcm_l  =   array_unique($icdcm);
				$icdpcs_l =   array_unique($icdpcs);
				$PClaimID = $_GET['claimID'];
				$pcquery = "SELECT DISTINCT C.Claim_ID,C.ICD10CM,C.ICD10PCS,D.ICD10_CM_CODE_DESCRIPTION,P.ICD10_PCS_CODE_DESCRIPTION FROM claim_diagnosis_procedure AS C JOIN diagnosis_code AS D ON C.ICD10CM = D.ICD10_CM_CODE JOIN diagnosis_procedure_code AS P ON C.ICD10PCS = P.ICD10_PCS_CODE WHERE C.Claim_ID = '$PClaimID'";
				$resultq1 = mysql_query($pcquery);
			}
            $i = 1;
	        while ($row = mysql_fetch_array($resultq1))  
			{
                if (!in_array($row["ICD10PCS"],$icdpcs_l)){ 
                  ?>
	                  <tr>
	                  	  <td><?php echo $i; ?></td>
	                  <td>
						<?php echo $row["ICD10PCS"].'-'.$row["ICD10_PCS_CODE_DESCRIPTION"];?>
                      </td>
                      <td>Procedure not covered</td>
                      </tr>
		       <?php
		        }
		   	   $i++;
		    }
	      ?>
              </tbody>
            </table>
           </td>
        </tr>
        <tr>
          <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
              <p>
             In case you wish to contest this denial, then an appeal may be filed citing the claim id and providing appropriate proof of medical necessity within the next 30 days.
              </p>
          </td>
        </tr>
        <tr>
          <td align="left" style="padding:0 0 0 0; font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
           &nbsp;  &nbsp;
	          <p> With best regards.</p>
	          <p>
	          <strong>Claim Administrator</strong>
	          <br>
	          <strong>ABC Insurance Company</strong>
	          </p>
          </td>
        </tr>
        </table>
        </td>
    </tr>
</table>
</td>
</tr>
</table>
</body>
</html>
	    </div>
	    <div class="modal-footer">
	      <button style="margin-top: 10px;" id="send_review_mail" type="button" class="btn btn-primary">Mail
          </button>
          <input class="btn btn-primary" type="button" onclick="printDiv('content_2')" value="Print"/>
	      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	</div>
	</div>


</div><!-- big_wrapper ends -->
      
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>

	<script type="text/javascript" src="js/bootstrap.min.js"></script>

	<script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>

	<script src="js/jquery-ui.js"></script>

	<script src="js/jspdf.min.js"></script>

	<script src="js/jquery.validate.js"></script>

	<script type="text/javascript" src="js/bootbox.min.js"></script>

   <script type="text/javascript">

   	$('input.amount1').keyup(function(event) {
	  if(event.which >= 37 && event.which <= 40) return;
	  $(this).val(function(index, value) {
	    return value
	    .replace(/\D/g, "")
	    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
	    ;
	  });
  });

	$('form *').prop('disabled', true);
	$('#amount').prop('disabled', false);

	$("#amount_notes").prop( "disabled", false );

	$("#amount_notes").attr("disabled",false);

	$("#claimid").attr("disabled",false);

	$("#claimid").prop( "disabled", false );

	$('.btn').prop('disabled', false);


    $(document).ready(function() {

      $("#addCodeForm").validate({
        rules:{
            amount:{required: true},
            amount_notes:{required: true},
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        messages:{
            amount:{
                required: "This field is required"
            },
            amount_notes:{
                required: "This field is required"
            },
        },
         submitHandler: function(form,e) {
            e.preventDefault();
            console.log('Form submitted');
            $.ajax({
                type: 'POST',
                url: 'ajax/adjudication_amount_insert.php',
                dataType: "html",
                data: $('form').serialize(),
                success: function(result) {
                   var data = $.parseJSON(result);
                    if(data.status == 'ok'){
                        $('#addCode').modal('hide');
                        $('#addCodeForm')[0].reset();
                        bootbox.alert({
                         message: "Payment Amount Added Successfully.",
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


 	     $('#verify').on('click',function() {
            var claimId = $('#claimID').val();
            var statusvalue = $('#status_value').val();
            var submitterID = $('#submitterID').val();
            var IP_Registration = $('#IP_Registration').val();
            $.ajax({
                type: "POST",
                url: "verification_patient.php",
                data: {"type" :'checked',"claimId":claimId,"status":statusvalue,"submitterID":submitterID,"IPRegistration":IP_Registration},
                success: function(data) {

            	  if(data == 'alreay'){
            	  	    
            	  	   alert('Patient Already Verified Successfully.');
            	  }
                  else if(data == 'OK'){
                    $('#success_veryfy').show();
                    $('#verify').html('Verified');         

                    }else{
                    	$('#verify').hide();
                    	$('#success_reject').show();
                    	$('#verify_reject').show();
                    }
                },
                 error: function() {
                    alert('it broke');
                }
            });
         });


          $('#review').on('click',function() {
          	  $('#myreview').modal('hide');
          	  $('#myModal').modal('show');
          });

          $('#review_diagnosed').on('click',function() {
          	  $('#myreview').modal('show');
          });

           $('#view_mail').on('click',function() {
          	  $('#myreview').modal('hide');
          	  $('#myModal').modal('show');
          });

          $('#claim_process').on('click',function() {
          	  $('#sucessfully').modal('show');
          });

           $('#PaymentProcess').on('click',function() {
          	  $('#sucessfully').modal('hide');


				var claimId = $('#claimID').val();
				var statusvalue = $('#status_value').val();
				var submitterID = $('#submitterID').val();
				$.ajax({
					type: "POST",
					url: "verification_patient.php",
					data: {"type" :'sucess',"claimId":claimId,"status":statusvalue,"submitterID":submitterID},
					success: function(data) {
						alert(data);
					},
					error: function() {
						alert('it broke');
					}
				});
          });

	function printDiv(divName) {
					
				var claimId = $('#claimID').val();
				var statusvalue = $('#status_value').val();
				var submitterID = $('#submitterID').val();
				$.ajax({
					type: "POST",
					url: "verification_patient.php",
					data: {"type" :'review',"claimId":claimId,"status":statusvalue,"submitterID":submitterID},
					success: function(data) {
					},
					error: function() {
						alert('it broke');
					}
				});

		        var printContents = document.getElementById(divName).innerHTML;
		        w=window.open();
		        w.document.write(printContents);
		        w.print();
		        w.close();
		    }



 	     $('#send_review_mail').on('click',function() {
            var claimId = $('#claimID').val();
            var statusvalue = $('#status_value').val();
            var submitterID = $('#submitterID').val();
            $.ajax({
                type: "POST",
                url: "verification_patient.php",
                data: {"type" :'review',"claimId":claimId,"status":statusvalue,"submitterID":submitterID},
                success: function(data) {
                	//$('#myModal').modal('hide');
                    alert(data);
                    //$('#review').html('Review');
                },
                 error: function() {
                    alert('it broke');
                }
            });
        });

 	     $('#reject').on('click',function() {

            var claimId = $('#claimID').val();
            var statusvalue = $('#status_value').val();
            var submitterID = $('#submitterID').val();
            $.ajax({
                type: "POST",
                url: "verification_patient.php",
                data: {"type" :'reject',"claimId":claimId,"status":statusvalue,"submitterID":submitterID},
                success: function(data) {
                    alert(data);
                    // $('#success_not').html('<span style="margin-right:13px;" class="glyphicon glyphicon-ok"></span>');

                    $('#reject').html('Reject');
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
        $('#plapiper_pagename').html("Adjudication");

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