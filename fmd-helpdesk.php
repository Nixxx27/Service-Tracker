<?php
    require 'sec_access.php';
    require 'sanitize.php';
    require 'dbc.php';
    require 'library.php';
    require 'class.php';

    //For auto JRF #
        $yearnow =  date("y");
        $monthnow =  date("m");

        $sql = "SELECT ID from jrf_tbl ORDER BY ID DESC LIMIT 1";
        $stmt = $db->query($sql);
        $stmt->execute();
            if($stmt->rowCount()){
                while($row=$stmt->fetch(PDO::FETCH_OBJ)){
                    $lastid = $row->ID;
                    $lastid_last =   $lastid + 1;
                    $lastid= sprintf('%03d', $lastid_last);
                    $strjrfnum = "$monthnow$yearnow-$lastid";
               }//while
            }else{
                    $lastid= sprintf('%03d', 1);
                    $strjrfnum = "$monthnow$yearnow-$lastid";
            }// end if

         $_SESSION['set_jrf_num']=$strjrfnum;

    //GLOBAL VARIABLES
        $strusername    = trim($global_user_fullname);
        $strusereadd    = trim($global_emailadd);
        $strcompany     = trim($global_company);
        $strdepartment  = trim($global_department);
        $strloc         = trim($global_location);
        $strposition    = trim($global_position);
        $strtelephone   = trim($global_telephone);
        $strcostcent    = trim($global_costcent);


if(isset($_POST['request']) && isset($_POST['strarea']) && isset($_POST['strdescript']) ){
    $strdate=date("m/d/Y");    //date now

    $due_date=date_create("$strdate"); //due date plus 7 days, P3 default priority
    date_add($due_date,date_interval_create_from_date_string("7 days"));
    $strduedate = date_format($due_date,"m/d/Y");
    trim($strduedate);

    $strmon=date("m");        //month now
    $stryear=date("Y");        //year now

    switch ($strmon) {        //quarter
            case '01':
                $strquarter="Q1";
                break;
            case '02':
                $strquarter="Q1";
                break;
            case '03':
                $strquarter="Q1";
                break;
            case '04':
                $strquarter="Q2";
                break;
            case '05':
                $strquarter="Q2";
                break;
            case '06':
                $strquarter="Q2";
                break;
            case '07':
                $strquarter="Q3";
                break;
            case '08':
                $strquarter="Q3";
                break;
            case '09':
                $strquarter="Q3";
                break;
            case '10':
                $strquarter="Q4";
                break;
            case '11':
                $strquarter="Q4";
                break;    
            case '12':
                $strquarter="Q4";
                break;    
            default:
                $strquarter="";
                break;
        };

        $strtime        = date('H:i');
        $strtime = trim($strtime); 
        
        $strsubject     = $_POST['strsubject'];
        $strsubject = trim($strsubject); 
        $strsubject = htmlspecialchars($strsubject);
         
        $strnature      = $_POST['strnature'];
        $strnature = htmlspecialchars($strnature); 
        
        $strarea        = $_POST['strarea'];
        $strarea = trim($strarea); 
        $strarea = htmlspecialchars($strarea); 
       
        $strdescript    = $_POST['strdescript'];
        $strdescript = trim($strdescript); 
        $strdescript = htmlspecialchars($strdescript); 
        
        $strattach = basename($_FILES['uploaded']['name']); 
        
        $strpriority    = "P3";
        $strstatus      = "New";

    if(empty($strarea) || empty($strdescript)){
          echo "<script type=text/javascript>alert('Please Complete Required Fields!');</script>";
    }else{
    
        $fields = array(
            'strjrfnum' => $strjrfnum,
            'strquarter'=> $strquarter,
            'strmon'=>$strmon,
            'stryear'=>$stryear,
            'strdate'=>$strdate,
            'strtime'=>$strtime,
            'strusername'=>$strusername,
            'strusereadd'=>$strusereadd,
            'strcompany'=>$strcompany,
            'strdepartment'=>$strdepartment,
            'strloc'=>$strloc,
            'strposition'=>$strposition,
            'strtelephone'=>$strtelephone,
            'strcostcent'=>$strcostcent,
            'strsubject'=>$strsubject,
            'strnature'=>$strnature,
            'strarea'=>$strarea,
            'strdescript'=>$strdescript,
            'strattach'=>$strattach,
            'strpriority'=>$strpriority,
            'strduedate'=>$strduedate,
            'strstatus'=>$strstatus,
            'strdescript' =>$strdescript
            );
        
        $addRecord = new Record();
        $addRecord->addRecord($fields);

        //upload attachment
        $strattach = "upload/";
 
        $strattach = $strattach . basename( $_FILES['uploaded']['name']); 
        
        if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $strattach)) 
                {
        //   echo "The file ".  basename( $_FILES['uploaded']['name']). 
            " has been uploaded";
                } 
         
   
require_once("phpmailer/class.phpmailer.php");

$email=$strusereadd;//"nikko.zabala@skygroup.com.ph";//"hr@skygroup.com.ph";
$bcc ="ict@skygroup.com.ph";
$feedback= 'Thanks for the worthless Email';
$subject = "A Work Order JRF#:" . $strjrfnum . " " . "has been Received";

$message=<<<EMAIL

Hello  $strusername,

Thank you for contacting the Helpdesk. Your request has been received and is in the process of being assigned to the appropriate team.

Your Ticket Number: JRF#: $strjrfnum

Your Request Information:
Request Type : $strnature
Subject : $strsubject 
Location: $strarea
Description: $strdescript 


Your Workorder Status: 
To check the status of your request,

---------------------------------------------------------------------------
Please click this link : http://www.skygroup.com.ph/servicetracker/jrf_tbledit.php?ID=$lastid_last
----------------------------------------------------------------------------

or call the Helpdesk and provide:  JRF#:$strjrfnum


Please keep a copy of this information for your reference.     

Kind regards,
Helpdesk                                                                                              


EMAIL;


$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = 'ssl://smtp.gmail.com:465';
$mailer->SMTPAuth = TRUE;
$mailer->Username = 'mail.manager27@gmail.com';  // Change this to your gmail adress
$mailer->Password = 'nikkoz06';  // Change this to your gmail password
$mailer->From = 'mail.manager27@gmail.com';  // This HAVE TO be your gmail adress
$mailer->FromName = 'Helpdesk'; // This is the from name in the email, you can put anything you like here
$mailer->Subject = $subject;
$mailer->Body = $message;
$mailer->AddAddress($email);
$mailer->AddBCC($bcc);
//$mailer->AddAttachment($target);


if(!$mailer->Send())
    {
       echo "<script>alert('Your Application Sending Failed.');'</script>";
    }
    else
    {
      echo "<script type=text/javascript>alert('Request was sent successfully, please check your email for additional info!');window.location.href='fmd-helpdesk.php';</script>";
    }

}//if isset

}//endIf not Empty

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
        title('FMD Help Desk');
    ?>
</head>

<body onload="buttonFade();clock()">
        <!-- NAV TOP -->
        <?php include('nav-simple.php'); ?>

    <!-- Container -->
    <div class="container">
        <!-- Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
             
                <ol class="breadcrumb">
                    <li>
                        <div id="div1" style="display:none;">
                            <h5>
                                <i onclick="javascript:location.href='welcome.php'" class="fa fa-chevron-circle-left fa-3x" data-toggle="popover" data-content="Go Back" style="cursor: pointer;">
                            </i>
                            </h5>
                        </div>
                    </li>
                    <li><a href="welcome.php">Home</a></li>
                    <li class="active">FMD Help-Desk</li>
                </ol>   
                <span class="pull-right"><button class="btn btn-default btn-sm" onclick="ConfirmLogout()" title="Log-out"><i class="fa fa-sign-out"></i> Log-Out</button></span>
            </div>
        </div>
        <!-- /.row -->


        <!-- TOP TEXT --> 
        <div class="row">
            <div  class="text-center">
                <div class="col-md-9 col-sm-9">
                    <h5><strong>GROUND EQUIPMENT MANAGEMENT AND SERVICES FACILITIES MANAGEMENT</strong></h5>
                    <h4><small>ENGINEERING GROUP</small></h4>
                        <h3 style="color:#c80909"><strong>CUSTOMER JOB REQUEST FORM</strong></h3>
                            <h4><strong>Job Request Form # <?php echo  $_SESSION['set_jrf_num'];  ?> <small><i class="fa fa-question-circle cursorpointer" title="Please take note of your JRF# <?php echo $_SESSION['set_jrf_num'];?>"></i></small></strong></h4>
                        <div id="loading" style="display:none">
                            <p style="font-style:italic">Email Sending Please Wait... <i class="fa fa-spinner fa-spin fa-2x"></i></p>
                        </div>
                </div>
            </div>  
        </div>   
           <!-- <div class="col-md-4 col-sm-4">                    
                <script language="javascript" type="text/javascript">
                    var day_of_week = new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
                    var month_of_year = new Array('January','February','March','April','May','June','July','August','September','October','November','December');

                    //  DECLARE AND INITIALIZE VARIABLES
                    var Calendar = new Date();

                    var year = Calendar.getFullYear();     // Returns year
                    var month = Calendar.getMonth();    // Returns month (0-11)
                    var today = Calendar.getDate();    // Returns day (1-31)
                    var weekday = Calendar.getDay();    // Returns day (1-31)

                    var DAYS_OF_WEEK = 7;    // "constant" for number of days in a week
                    var DAYS_OF_MONTH = 31;    // "constant" for number of days in a month
                    var cal;    // Used for printing

                    Calendar.setDate(1);    // Start the calendar day at '1'
                    Calendar.setMonth(month);    // Start the calendar month at now


                    /* VARIABLES FOR FORMATTING
                    NOTE: You can format the 'BORDER', 'BGCOLOR', 'CELLPADDING', 'BORDERCOLOR'
                          tags to customize your caledanr's look. */

                    var TR_start = '<TR>';
                    var TR_end = '</TR>';
                    var highlight_start = '<TD WIDTH="30"><TABLE CELLSPACING=0 BORDER=0 BGCOLOR=DEDEFF BORDERCOLOR=CCCCCC><TR><TD WIDTH=20><B><CENTER>';
                    var highlight_end   = '</CENTER></TD></TR></TABLE></B>';
                    var TD_start = '<TD WIDTH="30"><CENTER>';
                    var TD_end = '</CENTER></TD>';

                    /* BEGIN CODE FOR CALENDAR
                    NOTE: You can format the 'BORDER', 'BGCOLOR', 'CELLPADDING', 'BORDERCOLOR'
                    tags to customize your calendar's look.*/

                    cal =  '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 BORDERCOLOR=BBBBBB><TR><TD>';
                    cal += '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2>' + TR_start;
                    cal += '<TD COLSPAN="' + DAYS_OF_WEEK + '" BGCOLOR="#EFEFEF"><CENTER><B>';
                    cal += month_of_year[month]  + '   ' + year + '</B>' + TD_end + TR_end;
                    cal += TR_start;

                    //   DO NOT EDIT BELOW THIS POINT  //

                    // LOOPS FOR EACH DAY OF WEEK
                    for(index=0; index < DAYS_OF_WEEK; index++)
                    {

                    // BOLD TODAY'S DAY OF WEEK
                    if(weekday == index)
                    cal += TD_start + '<B>' + day_of_week[index] + '</B>' + TD_end;

                    // PRINTS DAY
                    else
                    cal += TD_start + day_of_week[index] + TD_end;
                    }

                    cal += TD_end + TR_end;
                    cal += TR_start;

                    // FILL IN BLANK GAPS UNTIL TODAY'S DAY
                    for(index=0; index < Calendar.getDay(); index++)
                    cal += TD_start + '  ' + TD_end;

                    // LOOPS FOR EACH DAY IN CALENDAR
                    for(index=0; index < DAYS_OF_MONTH; index++)
                    {
                    if( Calendar.getDate() > index )
                    {
                      // RETURNS THE NEXT DAY TO PRINT
                      week_day =Calendar.getDay();

                      // START NEW ROW FOR FIRST DAY OF WEEK
                      if(week_day == 0)
                      cal += TR_start;

                      if(week_day != DAYS_OF_WEEK)
                      {

                      // SET VARIABLE INSIDE LOOP FOR INCREMENTING PURPOSES
                      var day  = Calendar.getDate();

                      // HIGHLIGHT TODAY'S DATE
                      if( today==Calendar.getDate() )
                      cal += highlight_start + day + highlight_end + TD_end;

                      // PRINTS DAY
                      else
                      cal += TD_start + day + TD_end;
                      }

                      // END ROW FOR LAST DAY OF WEEK
                      if(week_day == DAYS_OF_WEEK)
                      cal += TR_end;
                      }

                      // INCREMENTS UNTIL END OF THE MONTH
                      Calendar.setDate(Calendar.getDate()+1);

                    }// end for loop

                    cal += '</TD></TR></TABLE></TABLE>';

                    //  PRINT CALENDAR
                    document.write(cal);

                    //  End
            </script>
             
            </div>-->
         
<form name="fmd-jrf-form" id="fmd-jrf-form" method="POST" action="" onsubmit="$('#loading').show();" enctype="multipart/form-data">

<span class='onhover cursorpointer' title="Show your information" id="show">   
    <h5><i class="fa fa-plus-square-o"></i> <strong><span style="font-family:arial;font-size:10px"> user info </span></strong></h5> 
</span> 

<span class='onhover cursorpointer' title="hide your information"  id="hide">   
    <h5> <i class="fa fa-minus-square-o"></i>  <strong><span style="font-family:arial;font-size:10px"> hide user info </span></strong></h5>
</span> 

<hr>
         
<div id="view_info">  
    <div class="row">  
        <div class="col-sm-5 col-md-5">   
            <table>
                <tr>
                    <td title="User Name">Name <label>: <?php echo $strusername; ?></label></td>
                </tr>

                <tr>
                    <td title="Company"> Company <label>: <?php echo $strcompany; ?></label></td>
                </tr>
                
                <tr>
                    <td title="Department"> Department <label>: <?php echo $strdepartment; ?></label></td>
                </tr>

                <tr>
                    <td title="Position"> Position <label>: <?php echo $strposition; ?></label></td>
                </tr>
            </table>
        </div>

        <div class="col-sm-5 col-md-5">   
            <table border="0" cellpadding="3" cellspacing="1">
                <tr>
                    <td title="Email Address">E.Add <label>: <?php echo $strusereadd; ?></label></td>
                </tr>

                <tr>
                    <td title="Cost Center"> Cost Center <label>: <?php echo $strcostcent; ?></label></td>
                </tr>
                
                <tr>
                    <td title="Phone Number"> Telephone <label>: <?php echo $strtelephone; ?></label></td>
                </tr>

                <tr>
                    <td title="User Location"> Location <label>: <?php echo $strloc; ?></label></td>
                </tr>
            </table>
        </div>
        <hr>
        <div class="col-lg-12">
            <h4><strong>Details</strong> <small>(pls. fill-up fields accordingly.)</small></h4>
        </div>
    </div>    
  
</div><!--view_info-->
    <div class="row margintop">   
    <!-- SUBJECT -->
        <div class="col-sm-2 col-md-2">
            <label>SUBJECT</label>
        </div>
         <div class="col-sm-6 col-md-6">
            <input type="text" placeholder="e.g water leakage in ceiling" name="strsubject" id="strsubject" autocomplete="off" class="form-control">
        </div>
    </div><!--ROW--> 

    <div class="row margintop">
        <!-- SUBJECT -->
        <div class="col-sm-2 col-md-2">
            <label> NATURE</label>
        </div>
         <div class="col-sm-6 col-md-6">
            <select name="strnature"  class="form-control">
                <option>Please Select</option>
                <?php  
                    require 'dbc.php';
                    $sql = "SELECT DISTINCT strnature FROM nature_tbl GROUP BY strnature";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                        if($stmt->rowCount()){
                            while ($rows=$stmt->fetch(PDO::FETCH_OBJ)){
                            echo "<option>$rows->strnature</option>";
                            }//while
                    }else{
                        echo "<option>No Records on the Database</option>";
                    }//endif
                ?>
            </select>    
</div>    
    </div><!--ROW--> 

     <div class="row margintop">   
    <!-- LOCATION -->
        <div class="col-sm-2 col-md-2">
            <label>AREA</label>
        </div>
         <div class="col-sm-6 col-md-6">
            <input type="text" placeholder="e.g Canteen near elevator" name="strarea" id="strarea" class="form-control" autocomplete="off" required>
        </div>
    </div><!--ROW-->   
 
    <div class="row">
        <!-- PROBLEM DESCRIPTION -->
        <div class="col-sm-12 col-md-12">
            <h5><strong><i class="fa fa-list-ul"></i> DESCRIPTION</strong></h5>
        </div>  
    </div><!--3 ROW-->   

    <div class="row">
        <div class="col-sm-8 col-md-8">
           <textarea  class="form-control" name="strdescript" rows="5" required></textarea>
        </div>   
    </div>  

    <div class="row margintop">
        <div class="col-sm-4 col-md-4" >
            <table>
                <tr>
                    <td>
                       <abbr title="Include attachment"> <i class="fa fa-file-word-o"></i> A:</abbr> 
                    </td>
                    <td>
                        <input name="uploaded" type="file"/>
                    </td>
                </tr>
            </table>
          
        </div>
    </div>
    
    <div class="row">
        <!-- NOTE -->
        <div class="col-sm-9 col-md-9">
            <h5><i class="fa fa-cog fa-spin"></i><small><strong> Note:</strong> Detailed repair work needed will be indicated at Inspection Checklist and may vary upon actual work.</small></h5>
            <p>
                <small>
                   <!-- <input type="checkbox" name="straccept" required="required">-->
                    I hereby authorized the repair work for the problem described above along with the necessary materials
                    and agree that GEMS and FMD are not responsible for loss or damage to the equipment in case of fire, theft or
                    any other cause beyond your control or for any delays caused by unavailability of parts or delays in parts delivery
                    by supplier or transporter. I hereby grant GEMS or FMD personnel to operate the equipment for testing and or inspection.
                </small>
            </p>
        </div>

        <!-- BUTTON -->
        <div class="col-sm-12 col-md-12">
            <input type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to SEND this Request?')" name="request" value="Send Request">
            <button type="button" class="btn btn-primary" onclick="clearForm();"><i class="fa fa-times"></i> Clear</button>
        </div>
    </div>

</form>
           

<script type="text/javascript">
function clock() {
   var now = new Date();
   var outStr = now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();
   document.getElementById('clockDiv').innerHTML=outStr;
   setTimeout('clock()',1000);
}
clock();
</script>   

<!--<div id="clockDiv"></div>-->

    <!-- Footer -->
        <?php include('footer.php');?>

    </div> <!-- /.container -->

</body>
</html>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>
    
    <script>
      $(function() {
        $( "#datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true
        });
      });
      </script>

    <script>
        // TITLE HOVER 
        $('[data-toggle="popover"]').popover({
            trigger: 'hover',
                'placement': 'top'
        });

        $('[data-toggle="bottom"]').popover({
            trigger: 'hover',
                'placement': 'bottom'
        });

        function buttonFade() {
            //$("#div1").fadeIn();
            $("#div1").fadeIn("slow");
            $("#div2").fadeIn(2000);
            $("#div3").fadeIn(4000);
            $("#footerfade").fadeIn(4000);
        }


        function clearForm()
        {
            document.getElementById("fmd-jrf-form").reset();
        }
            

        function ConfirmLogout()
        {
          var x = confirm("Are you sure you want to Log-out?");
          if (x)
              window.location.href="logout.php";
          else
            return false;
        }



        function timenow()
        {
            $(this).click(function(){
            document.getElementById("timevalue").value="<?php echo $timenow = date('h:i A'); ?>";
        });
        
        }
         



       
    </script>



    <script>
    $(document).ready(function(){
        $("#view_info").hide();
        $("#hide").hide();
     
        $("#hide").click(function(){
            $("#view_info").hide();

            $("#hide").hide();  
            $("#show").show();
        });
        $("#show").click(function(){
            $("#view_info").show();

            $("#show").hide();  
            $("#hide").show();
        });
    });
</script>
