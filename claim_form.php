<!DOCTYPE html>
<html lang="en">
<head>
      <title>Bootstrap Form</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="col-md-12 col-sm-12" style="margin:20px;">
<form>

  <div class="col-md-12 col-sm-12">

      <div class="form-group col-md-12 col-sm-12">
          <label for="name">Name of Hospital where Admitted</label>
          <input type="text" class="form-control input-sm" id="Hospital_Admitted">
      </div>

      <div class="form-group col-md-12 col-sm-12">
          <label for="email">Room Category occupied</label>
      </div>

      <div class="form-group col-md-12 col-sm-12">
          <label class="checkbox-inline">
          <input name="Day_Care" type="checkbox" value="Day Care">Day Care
          </label>
          <label class="checkbox-inline">
          <input name="Single_Occupancy" type="checkbox" value="Single Occupancy">Single Occupancy 
          </label>
          <label class="checkbox-inline">
          <input name="Twin_Sharing" type="checkbox" value="Twin Sharing">Twin Sharing
          </label>
          <label class="checkbox-inline">
          <input name="more_beds" type="checkbox" value="more beds">3 or more beds per room
          </label>
       </div>

       <div class="form-group col-md-12 col-sm-12">
          <label for="email">Hospitalisation due to</label>
       </div>
       <div class="form-group col-md-12 col-sm-12">
          <label class="checkbox-inline">
          <input name="Injury" type="checkbox" value="Injury">Injury
          </label>
          <label class="checkbox-inline">
          <input name="Illness" type="checkbox" value="Illness">Illness 
          </label>
          <label class="checkbox-inline">
          <input name="Maternity" type="checkbox" value="Maternity">Maternity
          </label>
       </div>

     <div class="form-group col-md-4 col-sm-4">
        <label for="address">Date of Injury/Date Disease first detected/Date of Delivery</label>
         <input type="text" class="form-control input-sm" id="Date_Injury" name="Date_Injury" placeholder="">
     </div>

     <div class="form-group col-md-3 col-sm-3">
        <label for="address">Date of Admission</label>
         <input type="text" class="form-control input-sm" id="Date_Admission" name="Date_Admission" placeholder="">
     </div>

     <div class="form-group col-md-3 col-sm-3">
        <label for="address">Time of Admission</label>
         <input type="text" class="form-control input-sm" id="Time_Admission" name="Time_Admission" placeholder="">
     </div>

     <div class="form-group col-md-3 col-sm-3">
        <label for="address">Date of Discharge</label>
         <input type="text" class="form-control input-sm" id="Date_Discharge" name="Date_Discharge" placeholder="">
     </div>

     <div class="form-group col-md-3 col-sm-3">
        <label for="address">Time of Discharge</label>
         <input type="text" class="form-control input-sm" id="Time_Discharge" name="Time_Discharge" placeholder="">
     </div>

       <div class="form-group col-md-12 col-sm-12">
          <label for="email"> If Injury, give cause</label>
       </div>
       <div class="form-group col-md-12 col-sm-12">
          <label class="checkbox-inline">
          <input name="Self_Inflicted" type="checkbox" value="Self Inflicted">Self Inflicted
          </label>
          <label class="checkbox-inline">
          <input name="Road_Traffic_Accident" type="checkbox" value="Road Traffic Accident">Road Traffic Accident 
          </label>
          <label class="checkbox-inline">
          <input name="Substance_Consumption " type="checkbox" value="Substance Abuse/Alcohol Consumption">Substance Abuse/Alcohol Consumption 
          </label>
       </div>

       <div class="form-group col-md-4 col-sm-4">
            <label for="address">If Medico Legal &nbsp;&nbsp;</label>
            <label class="radio-inline">
            <input type="radio" name="Medico_Legal" value="1">Yes
            </label>
            <label class="radio-inline">
            <input type="radio" name="Medico_Legal" value="0">No
            </label>
       </div>

       <div class="form-group col-md-4 col-sm-4">
          <label for="address">Reported to Police &nbsp;&nbsp;</label>
          <label class="radio-inline">
          <input type="radio" name="Reported_Police" value="1">Yes
          </label>
           <label class="radio-inline">
          <input type="radio" name="Reported_Police" value="0">No
          </label>
       </div>

        <div class="form-group col-md-4 col-sm-4">
            <label for="address"> MLC Report & Police FIR attached &nbsp;&nbsp;</label>
            <label class="radio-inline">
            <input type="radio" name="Police_FIR_Attached" value="1">Yes
            </label>
            <label class="radio-inline">
            <input type="radio" name="Police_FIR_Attached" value="0">No
            </label>
        </div>

        <div class="form-group col-md-3 col-sm-3">
           <label for="address">System of Medicine</label>
           <input type="text" class="form-control input-sm" id="System_Medicine" name="System_Medicine" placeholder="">
        </div>


    <div class="form-group col-md-12 col-sm-12">
      <label for="email">
         Details of treatment expenses claimed
      </label>
    </div>

    <div class="form-group col-md-12 col-sm-12">

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Pre Hospitalization Expenses</label>
        <input type="text" class="form-control input-sm" id="Pre_Hospitalization_Expenses" name="Pre_Hospitalization_Expenses" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Hospitalization Expenses</label>
        <input type="text" class="form-control input-sm" id="Hospitalization_Expenses" name="Hospitalization_Expenses" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Post Hospitalization Expenses</label>
        <input type="text" class="form-control input-sm" id="Post_Hospitalization_Expenses" name="Post_Hospitalization_Expenses" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Health Check-Up Cost</label>
        <input type="text" class="form-control input-sm" id="Health_CheckUp_Cost" name="Health_CheckUp_Cost" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Ambulance Charges</label>
        <input type="text" class="form-control input-sm" id="Ambulance_Charges" name="Ambulance_Charges" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Others (code)</label>
        <input type="text" class="form-control input-sm" id="Expenses_Claimed_Others_Code" name="Expenses_Claimed_Others_Code" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Total</label>
        <input type="text" class="form-control input-sm" id="Expenses_Claimed_Total" name="Expenses_Claimed_Total" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Pre Hospitalization Period</label>
        <input type="text" class="form-control input-sm" id="Pre_Hospitalization_Period" name="Pre_Hospitalization_Period" placeholder="Days">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Pro Hospitalization Period</label>
        <input type="text" class="form-control input-sm" id="Pro_Hospitalization_Period" name="Pro_Hospitalization_Period" placeholder="Days">
      </div>

    </div>

    <div class="form-group col-md-12 col-sm-12">
        <label for="email">
        Claim for Domiciliary Hospitalization &nbsp;&nbsp;
        </label>
        <label class="radio-inline">
        <input type="radio" name="Domiciliary_Hospitalization" value="1">Yes
        </label>
        <label class="radio-inline">
        <input type="radio" name="Domiciliary_Hospitalization" value="0">No
        </label>
        <label for="email">&nbsp;&nbsp;
        (if yes, provide details in annexure)
        </label>
    </div>

    <div class="col-md-12 col-sm-12">
      <label for="email">
        Details of Lump sum / cash benefit claimed
      </label>
    </div>

    <div class="col-md-12 col-sm-12">

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Hospital Daily Cash</label>
        <input type="text" class="form-control input-sm" id="Hospital_Daily_Cash" name="Hospital_Daily_Cash" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Surgical Cash</label>
        <input type="text" class="form-control input-sm" id="Surgical_Cash" name="Surgical_Cash" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Critical Illness Benefit</label>
        <input type="text" class="form-control input-sm" id="Critical_Illness_Benefit" name="Critical_Illness_Benefit" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Convalescence</label>
        <input type="text" class="form-control input-sm" id="Convalescence" name="Convalescence" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Pre/Post hosp Lump sum benefit</label>
        <input type="text" class="form-control input-sm" id="Hosp_Lump_Sum_Benefit" name="Hosp_Lump_Sum_Benefit" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Others</label>
        <input type="text" class="form-control input-sm" id="Lump_Sum_Others" name="Lump_Sum_Others" placeholder="">
      </div>

      <div class="form-group col-md-3 col-sm-3">
        <label for="address">Total</label>
        <input type="text" class="form-control input-sm" id="Lump_Sum_Total" name="Lump_Sum_Total" placeholder="">
      </div>

    </div>

    <div class="col-md-12 col-sm-12">
      <label for="email">
        Claim Documents Submitted- Check List
      </label>
    </div>

    <div class="form-group col-md-12 col-sm-12">

      <div class="form-group col-md-4 col-sm-4">
        <label class="col-md-8 col-sm-8" for="address">
            Claim Form Duly signed
        </label>
        <div class="col-md-4 col-sm-4">
            <input name="Claim_Form_Duly_signed" type="checkbox" value="">
        </div>
      </div>

      <div class="form-group col-md-4 col-sm-4">
        <label class="col-md-8 col-sm-8" for="address">
            Copy of the claim intimation, if any
        </label>
        <div class="col-md-4 col-sm-4">
            <input name="Claim_Intimation" type="checkbox" value="">
        </div>
      </div>








     </div>


      <div class="col-md-12 col-sm-12">
        <div class="form-group col-md-3 col-sm-3 pull-right" >
            <input type="submit" class="btn btn-primary" value="Submit"/>
        </div>
      </div>

</div>
</form>
</div>
</body>
</html>