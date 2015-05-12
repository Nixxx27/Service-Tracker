<?php 
include 'sec_access.php';
require 'class.php';
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
        title('Help Desk');
    ?>

    <link href="http://www.skygroup.com.ph/servicetracker/css/forms/jrform.css" rel="stylesheet">
</head>

<body>

<?php
	$set_ID =$_GET['ID'] ;
	$view_record = new Record();
    $view_record->viewRecord($set_ID);
?>	
 	
 	<table class="nottoprint">
    	<tr>
            <td>
                <button onclick="goBack();" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Back </button> 
                <button onclick="window.print();" class="btn btn-info"><i class="fa fa-print"></i> Print Form </button> 
            </td>
        </tr>
                    
    </table>

	<div class="form-container">
		<div class="header">
			<div class="header-left">
				<h4><strong>Facilities and Maintenance Division</strong></h4>
				<h5><?php echo $view_record->strcategory; ?></h5>
			</div><!-- header-left -->

			<div class="header-right">
				<span id="jrf-num"> 
					JRF # <?php echo $view_record->strjrfnum; ?>
				</span>
			</div><!-- header-right -->

		</div><!-- header -->

		<div class="workorder-label">
			<span style="margin-left:3in;font-weight:bold">WORK ORDER FORM</span>
		</div><!-- workorder-label -->

		<div class="partone">
			<table class="table-left">
				<tr>
					<td colspan="2"><strong>1. Work Request Details : </strong></td>
				</tr>
				<tr>
					<td align="right">Work Category : </td>
					<td class="td-value"><?php echo $view_record->strcategory; ?></td>
				</tr>
				<tr>
					<td align="right">Requester : </td>
					<td class="td-value"><?php echo $view_record->strusername; ?></td>
				</tr>

				<tr>
					<td align="right">Location : </td>
					<td class="td-value"><?php echo $view_record->strloc; ?></td>
				</tr>

			</table>

			<table class="table-right">
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
			
				<tr>
					<td align="right">Date Received : </td>
					<td class="td-value"><?php echo $view_record->strdate; ?></td>
				</tr>
				<tr>
					<td align="right">Status : </td>
					<td class="td-value"><?php echo $view_record->strstatus; ?></td>
				</tr>
				<tr>
					<td align="right">Priority : </td>
					<td class="td-value">
						<?php 
						$strpriority = $view_record->strpriority;
							switch ($strpriority ) {
								case 'P1':
									$strpriority ="P1 - Emergency 1day";
									break;
								case 'P2':
									$strpriority ="P2 - Urgent 3days";
									break;
								case 'P3':
									$strpriority ="P3 - Regular 7days";
									break;
								case 'P4':
									$strpriority ="P4 - Scheduled 31days";
									break;
								case 'P5':
									$strpriority ="P5 - In excess of 31days";
									break;

								default:
									$strpriority = "";
									break;
							}
							
							echo $strpriority;
						?>


					</td>
				</tr>
			</table>

			<table class="partone-table-bottom">
				<tr>
					<td><strong>Work Request Description : </strong></td>
				</tr>
				<tr>
					<td>
						<span id="partone-textarea" readonly><?php echo $view_record->strdescript; ?></span>
					</td>
				</tr>
			</table>
		</div><!-- part one -->

		<div class="divider"></div>
		
		<div class="parttwo">
			<table class="table-left">
				<tr>
					<td colspan="2"><strong>2. Job Estimate Report: </strong></td>
				</tr>
				<tr>
					<td align="right">Estimated By : </td>
					<td class="td-value"><?php echo $view_record->strassigned; ?></td>
				</tr>
				<tr>
					<td align="right">Start Date: </td>
					<td class="td-value"><?php echo $view_record->strdate , " / " , $view_record->strtime; ?></td>
				</tr>
			</table>

			<table class="table-right">
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td align="right">Target Completion Date : </td>
					<td class="td-value"><?php echo $view_record->strduedate, " / " , $view_record->strtime; ?></td>
				</tr>
			</table>
		</div><!-- Part Two -->

		<div class="divider"></div>

		<div class="partthree">
			<table>
				<tr>
					<td><strong>3. Job Completion Report : </strong></td>
				</tr>
				<tr>
					<td>
						<div class="square">Cause Description :</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="square">Action Taken :</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="square-sm ">Additional Information :</div>
					</td>
				</tr>
			</table>
		</div><!-- Part Three -->

		<div class="divider"></div>
		
		<div class="partfour">
			<table>
				<tr>
					<td><strong>4. Labor and Parts/Materials : </strong></td>
				</tr>
			</table>
			<table style="padding-left:30px">
	            <thead>
	                <tr> 
	                    <th class="sm">#</th> 
	                    <th class="sm">QTY</th>
	                    <th class="md">UNIT</th>
	                    <th class="lg">NAME</th>
	                    <th class="xl">DESCRIPTION</th>
	                </tr>
	            </thead>   
	            <tbody>
	                <?php 
	                	$strjrfnum =  $view_record->strjrfnum;  
	                    $prview = new PR($set_ID);
	                    $prview->forviewPR($strjrfnum);
	                ?>
	            </tbody> 
        	</table>
        	<?php echo  $prview->div; ?>
        	
        	<table style="padding-left:30px">
				 <thead>
	                <tr> 
	                	<th>#</th> 
	                    <th class="xl" style="text-align:center">PERSONNEL</th> 
	                    <th class="md" style="text-align:center">DATE</th>
	                    <th class="md" style="text-align:center">START</th>
	                    <th class="md" style="text-align:center">END</th>
	                    <th class="md" style="text-align:center">MANHOURS</th>
	                </tr>
	            </thead>
	            <tbody>
	            	<tr>
	            		<td><label>1</label></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            	</tr>

	            	<tr>
	            		<td><label>2</label></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            	</tr>

	            	<tr>
	            		<td><label>3</label></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            	</tr>

	            	<tr>
	            		<td><label>4</label></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            		<td class="view-td-btm"></td>
	            	</tr>

	            	<tr>
	            		<td colspan="5" align="right"><label>Total Manhour: </label></td>
	            		<td class="view-td-btm"></td>
	            	</tr>

	            	<tr>
	            		<td colspan="5" align="right"><label>Labor Cost : </label></td>
	            		<td class="view-td-btm"></td>
	            	</tr>

	            	<tr>
	            		<td colspan="5" align="right"><label>Total Cost (Materials and Labor) : </label></td>
	            		<td class="view-td-btm"></td>
	            	</tr>
				</tbody>
			</table>
			<hr style="margin-top:10px;margin-bottom:15px;border:0px none">

			<table class="table-left">
				<tr>
					<td colspan="2"><strong>Prepared By: </strong></td>
				</tr>
				<tr>
					<td  class="view-td-btm"></td>
				</tr>
				<tr>
					<td>Signature Over Printed Name,Position/Date</td>
				</tr>
			</table>

			<table class="table-right">
				<tr>
					<td colspan="2"><strong>Reviewed By: </strong></td>
				</tr>
				<tr>
					<td  class="view-td-btm"></td>
				</tr>
				<tr>
					<td>Signature Over Printed Name,Position/Date</td>
				</tr>
			</table>
		</div><!-- partfour -->

		<div class="partfive">
			<table>
				<tr>
					<td colspan="4" algin><label>5. Job Acceptance:</label></td>
				</tr>
				<tr>
					<td style="padding-left:20px"><label>Job Completion Accepted By:</label></td>
					<td class="view-td-btm-size"></td>
					<td style="padding-left:20px"><label>Date/Time:</label></td>
					<td class="view-td-btm-size"></td>
				</tr>
			
			
			
			</table>
			
		</div>
        
	
	</div><!-- form-container -->


	
</body>
</html>

    <script>
        function goBack() {
            window.history.back()
        }
    </script>