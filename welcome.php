<?php 
include 'sec_access.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
      <?php

        include('library.php');
        style();
        title('Welcome!');
    ?>
</head>

<body onload="buttonFade()">
        <!-- NAV TOP -->
        <?php include('nav-simple.php'); ?>    

    <!-- Container -->
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12"><h1>Select Department</h1>
                    <table cellspacing="2" cellpadding="2" class="pull-right">
                    <tr>
                        <td>
                            <button type="submit" class="btn btn-default btn-sm" onclick="javascript:location.href='admin_verify.php'" title="Admin Page"><i class="fa fa-cog fa-spin"></i>  Admin Panel</button>
                        </td>
                        <td>
                           <button type="button" class="btn btn-default btn-sm"  data-toggle='modal' data-target='#pass_id' title="Change password"><i class="fa fa-lock"></i> Password</button>
                        </td>
                        <td style="padding-left:2px">
                            <button type="button" class="btn btn-default btn-sm" onclick="ConfirmLogout()" title="Log-out"><i class="fa fa-sign-out"></i> Log-Out</button>
                        </td>
                    </tr>
                    
                </table>
            </div>
        <hr>

        <div class="row">
            <div  class="col-lg-12 col-md-12 col-sm-12" id="div1" style="display:none;">
                <i onclick="javascript:location.href='index.php'" class="fa fa-chevron-circle-left fa-3x" data-toggle="popover" data-content="Go Back" style="cursor: pointer;">
                </i>
            </div>
        </div> 
         <hr>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12" id="div2" style="display:none;">
                <button class="btn btn-primary"><h4><i class="fa fa-chevron-circle-right"></i> Info & Comm Tech</h4></button>
            </div>
        </div>
        <hr>

        <div class="row">
            <div  class="col-lg-12 col-md-12 col-sm-12" id="div3" style="display:none;">
                <button onclick="javascript:location.href='fmd-helpdesk.php'" class="btn btn-success"><h4><i class="fa fa-chevron-circle-right"></i> Facilities & Maintenance</h4></button>
            </div>
        </div>    
        <hr>

        <div class="row">
            <div  class="col-lg-12 col-md-12 col-sm-12" id="div4" style="display:none;">
                <button onclick="javascript:location.href='fmd-helpdesk.php'" class="btn btn-info"><h4><i class="fa fa-chevron-circle-right"></i> Human Resources</h4></button>
            </div>
        </div>    
        <hr>

         <div class="row">
            <div  class="col-lg-12 col-md-12 col-sm-12" id="div5" style="display:none;">
                <button onclick="javascript:location.href='fmd-helpdesk.php'" class="btn btn-danger"><h4><i class="fa fa-chevron-circle-right"></i> Finance & Accounting</h4></button>
            </div>
        </div>    
        <hr>
    
        <?php include ('notify.php'); ?>
    <!-- Footer -->
        <?php include('footer.php');?>
       <!--  <h5 align="left"><small> This site is optimized for <img src="img\system\buttons\chrome.png" height="20px" width="auto"> Chrome & <img src="img\system\buttons\firefox.png" height="20px" width="auto"> Firefox  and is best viewed with screen resolution of 1024 x 768 or higher. </small></h5> 
        -->

    </div> <!-- /.container -->



</body>
</html>

<?php
require 'class.php';

 $u_name = $global_username;
 $c_pword = $_POST['c_pword'];
 $n_pword = $_POST['n_pword'];


if(isset($_POST['change_password'])){

    if(empty($c_pword) || empty($n_pword )){
        echo "<script>alert('Please provide needed Fields')</script>";   
    }else{
        $action = "Changed Password!";
        $password = new changePword();
        $password->get_pword($u_name,$c_pword,$n_pword,$global_user_fullname,$global_authorization,$action);
        $password->checkPassword();
    }   
    
}//IF ISSET

?>
<form name="form_password" id="form_password" method="POST" action="">   
<!-- Change Password -->
<div class="modal fade" id="pass_id" role="dialog" aria-labelledby="pass_id_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
               <i class="fa fa-question-circle fa-lg"></i>
            </div>
            <div class="pull-right">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>
                            <label label for="c_pword"> Current Password</label>
                        </td>
                        <td>
                            <input type="password" class="form-control" required name="c_pword" id="c_pword" autocomplete="off">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label label for="n_pword"> New Password</label>
                        </td>
                        <td>
                            <input type="password" class="form-control" required name="n_pword" id="n_pword"  autocomplete="off">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to SEND this Request?')" name="change_password" value="Change Password">
                        <td>       
                    </tr>
                </table>
                
            </div>  
            <div class="modal-footer">
                    <i class="fa fa-link fa-spin fa-2x pull-left" id="linkspin_finish"></i>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div><!--end finish-->
</form>



    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        // TITLE HOVER 
        $('[data-toggle="popover"]').popover({
            trigger: 'hover',
                'placement': 'top'
        });

        function buttonFade() {
            //$("#div1").fadeIn();
            $("#div1").fadeIn("slow");
            $("#div2").fadeIn(2000);
            $("#div3").fadeIn(3500);
            $("#div4").fadeIn(4500);
            $("#div5").fadeIn(5000);
        }

        function ConfirmLogout()
        {
          var x = confirm("Are you sure you want to Log-out?");
          if (x)
              window.location.href="logout.php";
          else
            return false;
        }
       
    </script>


    <link rel="stylesheet" type="text/css" href="js/lib/jquery-ui.css" />
    <script type="text/javascript" src="js/lib/jquery.min.js"></script>
    <script type="text/javascript" src="js/lib/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/src/jquery.floatingmessage.js"></script>
