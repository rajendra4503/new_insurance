<?php
//ini_set("display_errors","0");
include_once('include/configinc.php');
include_once('include/session.php');
$userdp = "";
if(($logged_userdp != "")&&($logged_userdp != NULL)){
  $userdp = "uploads/profile_pictures/".$logged_userdp;
}else {
  $userdp = "images/dp.png";
}
?>
<style type="text/css">
#styled-select select {margin-top: 10px;background: transparent;background-color:#004F35;color: #f2bd43;width: 218px;padding: 5px;line-height: 1;border: 0;border-radius: 0;height: 34px;-webkit-appearance: none;
}
#styled-select select:hover {background-color:#004F35;}

#rolediv {
    color: #fff;
    font-size: 20px;
    line-height: 40px;
    letter-spacing: 2px;
    text-transform: capitalize;
}
#namediv {
    color: #fff;
    font-family: Freestyle;
    font-size: 35px;
    line-height: 40px;
    letter-spacing: 2px;
    text-transform: capitalize;
    margin-bottom: 0px;
}
</style>

      <div class="sidebar-nav" style="height:100%;">
      <div class="navbar navbar-default" role="navigation" style="height: 100%;">
        <div class="navbar-header">
        <div align="left">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
          <!--<span class="visible-xs navbar-brand">Menu</span>-->
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="nav navbar-nav sidebarsmallscreen">
            <li id="navusername" style="text-transform:uppercase;" class="hidden-xs">
              <div style="width:100%;" align="center">
                <div id="dpdiv" align="center"><img src="<?php echo  $userdp;?>"  style="width:100%;height:auto;" id="dpdivimg"></div>
              </div>
              <div id="namediv" align="center">
            <?php echo $logged_firstname." ".$logged_lastname;?>
           </div>

           <div id="rolediv" align="center">
             <?php 
             if($logged_roleid == 1){
                 echo 'Administrator';
              }elseif ($logged_roleid == 2) {
                  echo 'Claim Submitter';
              }elseif ($logged_roleid == 3) {
                  echo 'Adjudicator';
              }elseif ($logged_roleid == 4) {
                  echo 'Customer HR';
              }
              ?>
           </div>

            </li>

            <li id="profile" class="navbar_li">
                <a href="profile.php" class="navbar_href">
                    Profile Management
                </a>
            </li>


              <?php if($logged_roleid == 1){?>

                <li id="diagnosis_code" class="navbar_li">
                  <a href="diagnosis_code.php" class="navbar_href">ICD-10 Codes</a>
                </li>

                <li id="diagnosis_procedure_code" class="navbar_li">
                  <a href="diagnosis_procedure_code.php" class="navbar_href">Procedure Codes</a>
                </li>

                <li id="customer" class="navbar_li">
                   <a href="corporate_customer.php" class="navbar_href">Customer Setup / Edits</a>
                </li>

                <li id="premimum_payment" class="navbar_li">
                   <a href="premimum_payment.php" class="navbar_href">Premimum & Payment</a>
                </li>

                <li id="activate_deactivate" class="navbar_li">
                   <a href="activate_deactivate.php" class="navbar_href">Activate / Deactivate</a>
                </li> 


                <li id="marketing" class="navbar_li">
                  <a href="marketing_officer_details.php" class="navbar_href">Marketing Officer Management</a>
                </li>

                <li id="agent" class="navbar_li">
                  <a href="agent_broker_details.php" class="navbar_href">Agent /Broker Management</a>
                </li>

                 <li id="Brokerage_Commissions" class="navbar_li">
                  <a href="brokerage_commissions.php" class="navbar_href">Brokerage & Commissions</a>
                </li>
                
            <?php } ?>

            <?php if($logged_roleid == 2){?>

              <li id="claim_form1" class="navbar_li">
                 <a href="claim_form1.php" class="navbar_href">Claim Submission</a>
              </li>

              <li id="patients_claim" class="navbar_li">
                <a href="my_claim.php" class="navbar_href">
                  Claim Search
                </a>
              </li>

            <?php }?>

            <?php if($logged_roleid == 3){?>
                <li id="patients_claim" class="navbar_li">
                  <a href="patients_claim.php" class="navbar_href">Adjudication</a>
                </li>
            <?php }?>

             <?php if($logged_roleid == 4){?>

                <li id="employee_management" class="navbar_li">
                  <a href="employee_details.php" class="navbar_href">Employee Management</a>
                </li>

             <?php } ?>


            <li id="logout" class="navbar_li"><a href="logout.php" class="navbar_href">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
