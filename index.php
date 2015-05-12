<?php
require 'dbc.php';
require 'sanitize.php';
include 'class.php';

if(isset($_POST['strusername']) && isset($_POST['strpassword'])){
    $myusername= trim($_POST['strusername']);
    $mypassword= trim($_POST['strpassword']);
    
    if(empty($myusername)){
        echo "<script type=text/javascript>alert('Username Cannot be Empty!');</script>";
    }elseif(empty($mypassword)){
         echo "<script type=text/javascript>alert('Password Cannot be Empty!');</script>";
    }else{
        $UserAccount = new user();
        $UserAccount ->getUser($myusername,$mypassword);
        $UserAccount->login();
       
        Session_start();
            $_SESSION['successfull_login'] = $UserAccount->start;
            $_SESSION['servicetracker_fullname']        = $UserAccount->fullname;
            $_SESSION['servicetracker_username']        = $UserAccount->username;
            $_SESSION['servicetracker_company']         =$UserAccount->company;
            $_SESSION['servicetracker_department']      =$UserAccount->dept;
            $_SESSION['servicetracker_location']        =$UserAccount->loc;
            $_SESSION['servicetracker_position']        =$UserAccount->position;
            $_SESSION['servicetracker_authorization']   = $UserAccount->authorization;
            $_SESSION['servicetracker_role']            = $UserAccount->role;
            $_SESSION['servicetracker_emailadd']        =$UserAccount->emailadd; 
            $_SESSION['servicetracker_costcent']        =$UserAccount->costcent; 
            $_SESSION['servicetracker_telephone']       = $UserAccount->telephone;

    }//End Else If
}// End If

/*
    echo $_SERVER['PHP_SELF'];
    echo "<br/>";
    echo $_SERVER['SERVER_NAME'] .$_SERVER['PHP_SELF'];
    echo "<br/>";
    echo $_SERVER['SERVER_PROTOCOL']."test";
    echo "<br/>";
    echo $protocol = $_SERVER['SERVER_PROTOCOL'];
    echo "<br/>";
    echo $ip = $_SERVER['REMOTE_ADDR']." ->IP";
    echo "<br/>";
    echo $port = $_SERVER['REMOTE_PORT']." ->PORT";
    echo "<br/>";
    echo $agent = $_SERVER['HTTP_USER_AGENT']." ->BROWSER";
    echo "<br/>";
    echo $ref = $_SERVER['HTTP_REFERER']." ->link";
    echo "<br/>";
    echo $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
   
*/



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
        title('Making Things Easy!');
    ?>
</head>


<body>
    <!-- Container -->
    <div class="container">
        
        <section class="row top40">
          
            <div class="col-lg-6 col-md-6 col-sm-4">
                <img class="img-responsive" src="img/login/servicelogo.png">
            </div>

             <div class="col-lg-4 col-md-4 col-sm-4">
                <h3><i class="fa fa-cog fa-spin"></i> Login</h3>
                <form name="login_frm" method="POST" action="">
                    <table class="table">
                        <tr><!--utocomplete="off"-->
                            <td><h5>User Name</h5></td>
                            <td><input type="text" class="form-control" required placeholder="Username" name="strusername" id="strusername" /></td>
                        </tr>  

                        <tr>
                            <td><h5>Password</h5></td>
                            <td><input type="password" class="form-control"  required placeholder="password" name="strpassword" id="strpassword" /></td>
                        </tr>  

                        <tr>
                            <td colspan="2" align="right">
                                <button type="submit" class="btn btn-info">SIGN-IN  <i class="fa fa-arrow-circle-right"></i></button>
                                <button type="button" class="btn btn-info">CLEAR <i class="fa fa-times-circle"></i></button>
                            </td>
                        </tr>  
                    </table>    
                </form>
            </div>
       
        </section>


        <!-- Footer -->
        <?php include('footer.php');?>
          
    </div>    <!-- /.container -->

</body>
</html>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
