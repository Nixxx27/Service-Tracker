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
        title('Help Desk');
    ?>
</head>

<body onload="buttonFade()">
        <!-- NAV TOP -->
        <?php include('nav-simple.php'); ?>

    <!-- Container -->
    <div class="container">
        <span  style="text-align:center"> 
            <h3><strong><button class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button> System Detect that you are not LOGIN!</strong></h3>
            <h4><button class="btn btn-info btn-sm" onclick="javascript:location.href='index.php'">Goto Log-In Page</button></h4>
        </span>
        

    
    <!-- Footer -->
        <?php include('footer.php');?>

    </div> <!-- /.container -->

</body>
</html>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery.min.js"></script>

    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    
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
            


       
    </script>
