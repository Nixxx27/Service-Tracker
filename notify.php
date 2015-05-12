<link rel="stylesheet" type="text/css" href="js/lib/jquery-ui.css" />
<script type="text/javascript" src="js/lib/jquery.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/src/jquery.floatingmessage.js"></script>

	<script type="text/javascript">
            $(document.body).ready(function(){
             
                a =  $("<div><h4>Welcome, <?php echo $_SESSION['servicetracker_fullname']?>!</h4></div></a>").floatingMessage({
                    position : "top-right",
                    className : "ui-state-error"
                });  setTimeout(function(){
                    a.floatingMessage("destroy");
                },5000);
             
		
            });
        </script>
