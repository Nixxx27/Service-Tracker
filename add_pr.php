 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Service Tracker System</title>

        <?php

        include('library.php');
        style();
        title('Help Desk');
    ?>
</head>

<body> 
    <!-- Container -->
    <div class="container">
        <?php include('menu.php');?>

<?php   
include('dbc.php');

if(isset($_POST['save'])){

$strjrfnum ="JRF";

$i = 0; 
foreach($_POST['boxes'] as $textbox){
    $strquantity= $textbox;
    $stritmname = $_POST['stritmname'][$i];
    $strunit = $_POST['strunit'][$i];
    $stritmdesc  = $_POST['stritmdesc'][$i];
    $AddQuery ="INSERT INTO pr_tbl (strjrfnum,strquantity,stritmname,strunit,stritmdesc)VALUES ('$strjrfnum','$strquantity','$stritmname','$strunit','$stritmdesc')";
    mysql_query($AddQuery, $con);
    $i++;

} // for each


if(mysql_query)
{
    echo "<script type=text/javascript>alert('Record Successfully Added!');window.location.href='position-training.php';</script>";
}


}// if isset
?>
<br/>
    <table>
        <tr>
            <td>
             <img  class="onhover cursorpointer" onclick="goBack()" src="img/system/buttons/back.png" title="Back" height="40px" width="40px">
            </td>
            <td>
                <a href=""><img class="onhover"  src="img\system\buttons\viewall-addtraining.png" width="40px" height="40px" title="View All Records"></a>
            </td>
            <td>
                <a href="tms_notifysrch.php"><img class="onhover"  src="img\system\buttons\advanced_search.png" width="40px" height="40px" title="Advanced Search"></a>
            </td>
        </tr>
    </table>
    <hr>

   <div class="my-form">
    <h3><strong><i class="fa fa-cubes"></i> Add New Training</strong><small> Please fill-up correctly <i class="fa fa-question-circle cursorpointer" onclick="javascript:alert('You cant Add Position, it is encoded by HR. \n\n If you do not Remove empty fields it will be save to Database.')" title="Help"></i></small></h3>
    <hr>
        <form role="form" method="post" action="">
           
            <p>
                <label for="position">Position:&nbsp;&nbsp;&nbsp;</label>
                
                <select name="strposition" class="selectbox" required="required" value = "<?php echo isset($_POST['strposition'])?$_POST['strposition']:"" ?>">
                            <option id="0">Select Position</option>
                        <?php
                            $con = mysql_connect("localhost","root","nikkoz06");
                                if (!$con){
                                die("Can not connect: " . mysql_error());
                                }
                                mysql_select_db("slpi",$con);

                            $selected_pos=isset($_POST['strposition'])?$_POST['strposition']:"";
                            $getallpos =  mysql_query("SELECT pos, COUNT(*) as total FROM depttable GROUP BY pos");
                            while($viewallpos = mysql_fetch_array($getallpos)){
                            $selectpos="";
                            if($selected_pos==$viewallpos['pos'] ){

                            $selectpos="selected='selected'";
                        }

                        ?>
                            <option id="<?php echo $viewallpos['ID']; ?>" <?php echo $selectpos ?> >
                        <?php 
                            echo $viewallpos['pos'] ?> </option>
                        <?php } ?>
                        </select>

                        <?php
                            require("dbc.php");
                            if(isset($_POST)){
                            $takepos = mysql_real_escape_string($_POST['strposition']);     
                        {

                        ?>
                        <?php } 
                        }?>
                </p>          
                <p class="text-box">
                    <label for="box1">Item: <span class="box-number">1</span></label>
                    <input type="text" size="5" name="boxes[]" placeholder="Quantity" value="" id="box1" />
                    <input type="text" size="10"  name="stritmname[]" placeholder="&nbsp;Item Name" value="" id="stritmname" />
                    <input type="text" size="5"  name="strunit[]" placeholder="&nbsp;Unit" value="" id="strunit" />
                    <input type="text" size="25"  name="stritmdesc[]" placeholder="&nbsp;Item Description" value="" id="stritmdesc" />
                    

                    
                </p>

            <p>
                <button type="submit" Onclick="return ConfirmSave();" name="save" class="btn btn-info btn-sm">&nbsp;&nbsp;<i class="fa fa-floppy-o"></i> Save&nbsp;&nbsp;</button>
                <button type="button" class="add-box btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Add More</button>
            </p>
        </form>
    </div>


<!-- Footer -->
  <?php include('footer.php');?>

       
    </div>    <!-- /.container -->

</body>
</html>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


    <script>
        // TITLE HOVER 
        $('[data-toggle="popover"]').popover({
            trigger: 'hover',
                'placement': 'top'
        });
    </script>

    <script type="text/javascript">
jQuery(document).ready(function($){
    $('.my-form .add-box').click(function(){
        var n = $('.text-box').length + 1;
        if( 30 < n ) {
            alert('Stop it!');
            return false;
        }
        var box_html = $('<p class="text-box"><label for="box' + n + '">Item:   <span class="box-number">' + n + '</span></label> <input type="text" placeholder="Quantity" size="5" name="boxes[]" value="" id="box' + n + '" /> <input type="text" placeholder="Item Name" name="stritmname[]" size="10"  value="" id="stritmname' + n + '" /> <input type="text" placeholder="Unit" name="strunit[]" size="5"  value="" id="strunit' + n + '" /> <input type="text" placeholder="Item Description" name="stritmdesc[]" size="25"  value="" id="stritmdesc' + n + '" />&nbsp;<button type="button" class="remove-box  btn btn-danger btn-sm"><i class="fa fa-times"></i> Remove&nbsp;&nbsp;&nbsp;</button></p>');
        box_html.hide();
        $('.my-form p.text-box:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });
    $('.my-form').on('click', '.remove-box', function(){
        $(this).parent().css( 'background-color', '#FF6C6C' );
        $(this).parent().fadeOut("slow", function() {
            $(this).remove();
            $('.box-number').each(function(index){
                $(this).text( index + 1 );
            });
        });
        return false;
    });
});
</script>




<script>
    function ConfirmSave()
    {
      var x = confirm("Are you sure you want to Save Training?");
      if (x)
          return true;
      else
        return false;
    }
</script>  

<script>
function goBack() {
    window.history.back()
}
</script> 


   