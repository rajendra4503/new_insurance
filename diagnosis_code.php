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
		<title>Diagnosis Code</title>
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
    .modal .modal-dialog {
    max-width: 615px;
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
      <?php
      if($logged_usertype=='I')
      {
        $title = "Member List";
        $button="Add a Family Member";
      }
      else
      {
        $title = "ICD 10 Codes";
        $button="Add a New Patient";
      }
      ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0">
        <div id="plantitle">
          <span><?php echo $title;?>  <?php if(isset($PatientList) &&  $PatientList !=''){echo '('.$PatientList.')';}?>  </span>
      </div>
     </div>


  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingrl0" style="margin-top:5px;" id="mainplanlistdiv">

    <a href="#addCode" data-toggle="modal" style="    margin-left: 16px;"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Code</button>
    </a>

          <div class="table-responsive">
              <table id="example" class="table table-bordered" style="width:100%">
              <thead>
              <tr class="tableheadings">
                  <th>#</th>
                  <th>ICD 10 Code</th>
                  <th>Description</th>
                  <th>Created By</th>
                  <th>Modified By</th>
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

  <!-- Add Code -->

  <div id="addCode" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form name="addCodeForm" id="addCodeForm">
          <div class="modal-header">            
            <h4 class="modal-title">Add Code</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
           <div class="modal-body">          
            <div class="form-group">
              <label>Code</label>
              <input id="code" name="code" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Description</label>
              <input id="code_description" name="code_description" type="text" class="form-control" required>
            </div>   
           </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-success btn-sm" data-dismiss="modal" value="Cancel">
            <input id="submit_code" type="submit" class="btn btn-success btn-sm" value="Add">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Code HTML -->
  <div id="editCode" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form name="codeeditform" id="codeeditform" method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Code</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <div class="form-group">
              <label>Code</label>
              <input id="code_edit" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Description</label>
              <input id="edit_code_desc" type="text" class="form-control" required>
            </div>   
          </div>
          <div class="modal-footer">
            <input type="hidden" name="edit_code_id" id="edit_code_id" value="">
            <input type="button" class="btn btn-success btn-sm" data-dismiss="modal" value="Cancel">
            <input id="update_code" type="submit" class="btn btn-success btn-sm" value="Update">
          </div>
        </form>
      </div>
    </div>
  </div>
      
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/bootbox.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>

  <script src="js/bootstrap3-typeahead.min.js"></script>

  <script type="text/javascript">

/**************************diagnosis********************/

  $('#code').typeahead({
    displayText: function(item) {
    return item.label
    },
    afterSelect: function(item) {
    this.$element[0].value = item.value;
    },
    source: function (query, process) {
    return $.getJSON('ajax_diagnosis_code.php', { query: query }, function(data) {
    process(data)
    })
    },
    updater: function (item) {
    $('#code_description').val(item.desc);
        return item;
      }
    });

  $('#code_edit').typeahead({
    displayText: function(item) {
    return item.label
    },
    afterSelect: function(item) {
    this.$element[0].value = item.value;
    },
    source: function (query, process) {
    return $.getJSON('ajax_diagnosis_code.php', { query: query }, function(data) {
    process(data)
    })
    },
    updater: function (item) {
    $('#edit_code_desc').val(item.desc);
        return item;
      }
    });

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

    $('#example').DataTable({
        'ajax' : 'ajax/diagnosis_code_ajax.php',
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
          searchPlaceholder: "Search By ICD 10 Code Or Description",
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
        var each = total/12;
        $('.navbar_li').height(each);
        $('.navbar_href').height(each/2);
        $('.navbar_href').css('padding-top', each/4.9);
        var currentpage = "diagnosis_code";
        $('#'+currentpage).addClass('active');
        $('#plapiper_pagename').html("ICD 10 Code");

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