<?php

    require('dbc.php');
    
    // count over due request
    $query = "SELECT COUNT(*) AS total_over_due FROM jrf_tbl WHERE strifoverdue='overdue' ORDER BY ID DESC";
    $result = mysql_query($query); 
    $values = mysql_fetch_assoc($result); 
    $num_total_over_due = $values['total_over_due'];  

    // count new request
    $query = "SELECT COUNT(*) AS total_new FROM jrf_tbl WHERE strstatus='New'  ORDER BY ID DESC";
    $result = mysql_query($query); 
    $values = mysql_fetch_assoc($result); 
    $num_total_new = $values['total_new'];  


    // count for ogm approval jobs
    $query = "SELECT COUNT(*) AS total_for_ogm FROM jrf_tbl WHERE strstatus='For GM Approval'  ORDER BY ID DESC";
    $result = mysql_query($query); 
    $values = mysql_fetch_assoc($result); 
    $num_total_for_ogm_approval = $values['total_for_ogm']; 

    // count for In-Progress jobs
    $query = "SELECT COUNT(*) AS total_In_Progress FROM jrf_tbl WHERE strstatus='In-Progress'  ORDER BY ID DESC";
    $result = mysql_query($query); 
    $values = mysql_fetch_assoc($result); 
    $num_total_In_Progress = $values['total_In_Progress']; 

    // count for encoding to SAP jobs
    $query = "SELECT COUNT(*) AS total_for_sap FROM jrf_tbl WHERE strstatus='For Encoding to SAP'  ORDER BY ID DESC";
    $result = mysql_query($query); 
    $values = mysql_fetch_assoc($result); 
    $num_total_for_sap = $values['total_for_sap']; 

     // count Encoded to SAP jobs
    $query = "SELECT COUNT(*) AS total_encoded_sap FROM jrf_tbl WHERE strstatus='Encoded to SAP'  ORDER BY ID DESC";
    $result = mysql_query($query); 
    $values = mysql_fetch_assoc($result); 
    $num_total_total_encoded_sap = $values['total_encoded_sap']; 

    // count cancelled jobs
    $query = "SELECT COUNT(*) AS total_cancelled FROM archv_finished WHERE strstatus='cancelled'  ORDER BY ID DESC";
    $result = mysql_query($query); 
    $values = mysql_fetch_assoc($result); 
    $num_total_cancelled = $values['total_cancelled']; 
  
    // count finish jobs
    $query = "SELECT COUNT(*) AS total_finish FROM archv_finished";
    $result = mysql_query($query); 
    $values = mysql_fetch_assoc($result); 
    $num_total_finished = $values['total_finish']; 
?>
<!-- <span class="badge">&nbsp;<?php //echo $num_total_finished; ?>&nbsp;</span> -->

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Nav Mobile Display-->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img id="welcomelogosmall" src="img/welcome/topimage.png"></a>
            </div>
            <!-- Toggling all nav links -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <a href="welcome.php"><span style="font-size:14px"><i class="fa fa-chevron-circle-left"></i> Back</span></a>
                    </li>
                
                    <!--<li>
                        <a href="fmd_admin_page.php"><span style="font-size:14px"><i class="fa fa-home"></i> Home</span></a>
                    </li>-->

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span style="font-size:14px"><i class="fa fa-wrench"></i> Job Request</span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="jrf_tbllist.php?cmd=reset" title='view all Job Request'><span style="font-size:14px"><i class="fa fa-chevron-circle-right"></i> View All Job Request</a>
                            </li>

                            <li>
                                <a href="jrf_tbllist.php?x_strstatus=new&z_strstatus=LIKE" title='view new job'><span style="font-size:14px"><i class="fa fa-chevron-circle-right"></i> New Job <span class="badge">&nbsp;<?php echo $num_total_new; ?>&nbsp;</span></span></a>
                            </li>

                            <li>
                                <a href="jrf_tbllist.php?x_strstatus=In-Progress&z_strstatus=LIKE" title='view job in-progress'><span style="font-size:14px"><i class="fa fa-chevron-circle-right"></i> In-Progress <span class="badge">&nbsp;<?php echo $num_total_In_Progress; ?>&nbsp;</span></span></a>
                            </li>

                            <li>
                                <a href="jrf_tbllist.php?x_strifoverdue=overdue&z_strifoverdue=LIKE" title='view overdue request'><span style="font-size:14px"><i class="fa fa-chevron-circle-right"></i> Over Due Request <span class="badge">&nbsp;<?php echo $num_total_over_due; ?>&nbsp;</span></span></a>
                            </li>

                            <li>
                                <a href="jrf_tbllist.php?x_strstatus=For+GM+Approval&z_strstatus=LIKE" title='view for GM approval request'><span style="font-size:14px"><i class="fa fa-chevron-circle-right"></i> For GM Approval <span class="badge">&nbsp;<?php echo $num_total_for_ogm_approval; ?>&nbsp;</span></span></a>
                            </li>

                            <li>
                                <a href="jrf_tbllist.php?x_strstatus=For+Encoding+to+SAP&z_strstatus=LIKE" title='view all for encoding to SAP'><span style="font-size:14px"><i class="fa fa-chevron-circle-right"></i> For Encoding to SAP <span class="badge">&nbsp;<?php echo $num_total_for_sap; ?>&nbsp;</span></span></a>
                            </li>

                            <li>
                                <a href="jrf_tbllist.php?x_strstatus=Encoded+to+SAP&z_strstatus=LIKE" title='view all Encoded to SAP'><span style="font-size:14px"><i class="fa fa-chevron-circle-right"></i> Encoded to SAP <span class="badge">&nbsp;<?php echo $num_total_total_encoded_sap; ?>&nbsp;</span></span></a>
                            </li>

                            <li>
                                <a href="archv_finishedlist.php?x_strstatus=cancelled&z_strstatus=LIKE" title='view all Cancelled Job Request'><span style="font-size:14px"><i class="fa fa-chevron-circle-right"></i> Cancelled Jobs <span class="badge">&nbsp;<?php echo $num_total_cancelled; ?>&nbsp;</span></span></a>
                            </li>


                            <li>
                                <a href="archv_finishedlist.php?x_strstatus=finished&z_strstatus=LIKE" title='view all Finished Job Request'><span style="font-size:14px"><i class="fa fa-chevron-circle-right"></i> Finished Jobs <span class="badge">&nbsp;<?php echo $num_total_finished; ?>&nbsp;</span></span></a>
                            </li>
   
                            <li>
                                <a href="jrf_tblsrch.php" title='Advanced Search'><i class="fa fa-search"></i> <span style="font-size:14px">Advanced Search</span></a>
                            </li>
                        </ul>
                    </li>

                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span style="font-size:14px"><i class="fa fa-cogs"></i> Config </span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="nature_tbllist.php"><span style="font-size:14px"><i class="fa fa-chevron-circle-right"></i> Add Nature of Job</span></a>
                            </li>

                            <li>
                                <a href="category_tbllist.php"><span style="font-size:14px"><i class="fa fa-chevron-circle-right"></i> Add Category of Job</span></a>
                            </li>

                            <li>
                                <a href="techician_tbllist.php"><span style="font-size:14px"><i class="fa fa-chevron-circle-right"></i> Add Technicians</span></a>
                            </li>

                            <li>
                                <a href="logslist.php?cmd=reset"><span style="font-size:14px"><i class="fa fa-book"></i> View Logs History</span></a>
                            </li>

                            
                        </ul>
                    </li>

                    

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span style="font-size:14px">Account</span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#"><span style="font-size:14px">View Profile</span></a>
                            </li>
                            <li>
                                <a href="#"<span style="font-size:14px">Change Password</span></a>
                            </li>

                            <li>
                                <a><span style="font-size:14px" onclick="ConfirmLogout()" class="cursorpointer">Log-Out</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>



    <script>
     function ConfirmLogout()
        {
          var x = confirm("Are you sure you want to Log-out?");
          if (x)
              window.location.href="logout.php";
          else
            return false;
        }
</script>