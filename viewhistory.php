<!DOCTYPE html>
<?php session_start();

require 'commands.php';

error_reporting(0);
$pid = $_SESSION['pid'];
$eid = $_SESSION['eid'];

$userid = $_SESSION['userid'];


 ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="favicon.ico" />
        <title>Document Tracking</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/icomoon-social.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/leaflet.css" />
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="css/leaflet.ie.css" />
		<![endif]-->
		<link rel="stylesheet" href="css/main.css">

        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        
        <!--navbar design ang login session -->
        <?php include "design/navlogsession.php"; ?>
		
		<br>
		<br>
		<br>
		<br>
		<br>
		

		 <?php if(!isset($_SESSION['access']))
        		{
        			//if not logged on, user will be directed to the page login
					$_SESSION['reqlogin'] = true;
        			echo "<script>window.location='page-login.php';</script>";
        		} 

        ?>
		

        <div class="container">
		<h3 class="col-md-offset-5" >VIEW HISTORY</h3>
			<div class="row">
			<br>
			
				<?php 
				$command = new Command();
				$history = $command->getHistory($pid);
				$history_edoc = $command->getHistoryEdoc($eid);
				
				
				?>
												<!-- IF PDOC -->
				<div class="pricing-wrapper col-md-12">
				
				<?php
					$x = 0;
					if(!empty($history))
					{
					foreach($history as $his)
					{

					
					
				
				?>
				
					
        				<!-- Creation of Qr code -->
						<div class="row">
								
							<div class="col-sm-12">

								
								<div class="pricing-plan" style="right: -30%; width: 35%; height: 300px;">
									
									<h2 class="pricing-plan-title"><b><?php echo $his->getdate();?></b></h2>
									
									<?php 
									$type = $his->gettype();
									$sentby = $his->getsender();
									$sender = $command->getuser($sentby);
									$first = $sender->getfirstname();
									$last = $sender->getlastname();
									$full = $first." ".$last;
									
									if($type == "Send")
									{
									?>
									<div class="col-md-8 col-md-offset-0" align="left">
									<b>Direct Send to: </b> <?php echo $his->getsendto();?><br>
									<b>Sent by: </b><?php echo $full;?> <br>
									<br><br>	
									<label for="comment">Comment:</label>
									<textarea rows="4" cols="40" name="comment" form="test" readonly><?php echo $his->getcomment();?></textarea>
									</div>
									<?php 
									}
									else if($type == "SendR")
									{?>
									<div class="col-md-12 col-md-offset-0" align="left">
									<b>Sent to Next Recipent: </b> <?php echo $his->getsendto();?><br>
									<b>Sent by: </b><?php echo $full;?> <br>
									
									<br><br>
									<label for="comment">Comment:</label>
									<textarea rows="4" cols="40" name="comment" form="test" readonly><?php echo $his->getcomment();?></textarea>
									
									</div>
									<?php
									}
									else if($type == "Cancel")
									{
									?>
									
									<div class="col-md-12 col-md-offset-0" align="left">
									<b>Sending Cancelled by: </b> <?php echo $full;?><br>
									<br><br>
									<label for="comment">Comment:</label>
									<textarea rows="4" cols="40" name="comment" form="test" readonly><?php echo $his->getcomment();?></textarea>
									</div>
									<?php 
									}
									else if($type == "Change")
									{
									?>
									<div class="col-md-12 col-md-offset-0" align="left">
									<b><?php echo $full;?></b> Changed the Flow<br>
									<br><br>
									<label for="comment">Comment:</label>
									<textarea rows="4" cols="40" name="comment" form="test" readonly><?php echo $his->getcomment();?></textarea>
									</div>
									
									<?php
									}
									else if($type == "Remove Flow")
									{
									?>
									<div class="col-md-12 col-md-offset-0" align="left">
									<b><?php echo $full;?></b> Removed Flow<br>
									<br><br>
									<label for="comment">Comment:</label>
									<textarea rows="4" cols="40" name="comment" form="test" readonly><?php echo $his->getcomment();?></textarea>
									</div>
									
									<?php
									}

									 ?>
								</div>
								
								
							</div>

						
						</div>
						
				
				<!-- IF PDOC -->
				<?php 
					 $x++;
					 }

					}

					else if(!empty($history_edoc))
					{

						foreach($history_edoc as $his_ed)
						{
				
				
				
				?>

				<div class="row">
								
							<div class="col-sm-12">

								
								<div class="pricing-plan" style="right: -30%; width: 35%; height: 300px;">
									
									<h2 class="pricing-plan-title"><b><?php echo $his_ed->getdate();?></b></h2>
									
									<?php 
									$type = $his_ed->gettype();
									$sentby = $his_ed->getsender();
									$sender = $command->getuser($sentby);
									$first = $sender->getfirstname();
									$last = $sender->getlastname();
									$full = $first." ".$last;
									
									
									if($type == "Share")
									{

									?>

									<div class="col-md-12 col-md-offset-0" align="left">
									<b><?php echo $full;?></b> Shared electronic document to<br>
									<?php echo $his_ed->getsendto()?>
									<br><br>
									<label for="comment">Comment:</label>
									<textarea rows="4" cols="40" name="comment" form="test" readonly><?php echo $his_ed->getcomment();?></textarea>
									</div>


									<?php
									 } 

									 ?>
								</div>
								
								
							</div>

						
						</div>


				<?php } } ?>

				<?php if($_SESSION['back'] == "pdocs" || $_SESSION['back'] == "receive")
			{ 
			?>
				<form method="get" action="success.php">
				
				<br>
				<input type="submit" name="back" value="Back" style= "width: 20%;">
				
				</form>
				<?php
			}
			?>
			
			
			
			
			
			
		</div>
				
	<style>
input[type=text], select {
    width: 20%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 10%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btnmod
{
	 width: 10%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.btnmod:hover
{
	background-color: #45a049;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.arrow-down {
  width: 0; 
  height: 0; 
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;
  
  border-top: 20px solid #f00;
}

</style>


	    

        <!-- Javascripts -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
        <script src="js/jquery.fitvids.js"></script>
        <script src="js/jquery.sequence-min.js"></script>
        <script src="js/jquery.bxslider.js"></script>
        <script src="js/main-menu.js"></script>
        <script src="js/template.js"></script>

    </body>
</html>