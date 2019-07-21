<?php
session_start();
ini_set("display_errors","0");
include('include/configinc.php');
include('include/session.php');
include('include/functions.php');
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Marketing Officer Management</title>
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

    .btn-success {background-color: #004F35;
    border-color: #004F35;font-size: 17px;}
    .btn-success span{
      font-size: 17px;
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


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0">
        <div id="plantitle">
          <span>Marketing Officer Details</span>
        </div>
    </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0" style="margin-top:5px;" id="mainplanlistdiv">


<a href="add_marketing_officer.php" style="margin-left: 16px;"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Marketing Officer</button>
</a>

          <div class="table-responsive">
              <table id="example" class="table table-bordered" style="width:100%">
              <thead>
              <tr class="tableheadings">
                  <th>#</th>
                  <th>Name</th>
                  <th>Mobile Number</th>
                  <th>Email Id</th>
                  <th>City</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
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

  $(document).ready(function() {

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
    $.fn.dataTable.ext.errMode = 'none';
    $('#example').DataTable({
        'ajax' : 'ajax/marketing_officer_list.php',
        'select': true,
        'ordering': false,
        'info': true,
        'scrollY': 350,
        'scrollX': true,
        'scrollCollapse': true,
        "paging":false,
        "dom": '<"toolbar">frtip',
        "searching": true,
        'language': {
          searchPlaceholder: "Search By Name or Mobile or Email",
          search: "_INPUT_"
        },
         "initComplete": function () {
          $('.dataTables_filter input[type="search"]').css({ 'width': '310px','float': 'left' ,'display': 'inline-block' })
          }
    });
});   

	$(document).ready(function() {
        var w = window.innerWidth;
        var h = window.innerHeight;
        var total = h - 150;
        var each = total/9;
        $('.navbar_li').height(each);
        $('.navbar_href').height(each/2);
        $('.navbar_href').css('padding-top', each/4.9);
        var currentpage = "marketing";
        $('#'+currentpage).addClass('active');
        $('#plapiper_pagename').html("Marketing Officer Management");

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