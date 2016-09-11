<!DOCTYPE html>
<?php session_start();
$_SESSION['back'] = "pdocs";
require 'commands.php';

if(isset($_GET['view']) && $_GET['view'] == 'View')
{
	$_SESSION['title'] = $_GET['title'];
	$fid = $_GET['fid'];
}



$userid = $_SESSION['userid'];
$_GET['viewpdocs'] = 'View my Physical Docs';
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
		<h3 >VIEW FLOW</h3>
			<div class="row">
			<br>
			
				<?php 
				

					//$userid = $_SESSION['userid'];
				
					$conn = new mysqli('localhost', 'root', 'usbw', 'docdb');
					
					/*if(isset($_SESSION['position']) && $_SESSION['position'] == 'Admin' || $_SESSION['position'] == 'Developer')
					{
						$sql = "select * from p_doc where user_id";
					}
					else
					{
						$sql = "select * from p_doc where user_id = '$userid' ";
					}
					*/
					$fid = $_GET['fid'];
					
					$sql = "select * from flowdetails where flowid = $fid";
					
					$res = $conn->query($sql);
					$command = new Command();
					
					$co = mysqli_num_rows($res);
				?>
				
				<div class="pricing-wrapper col-md-12">
				
				<?php
					$x = 0;
					while($data = $res->fetch_assoc())	
					{
					
					
					
					$sendto = $data['sendto'];
					$user = $command->getuser($sendto);
					
				
				?>
				
					
        				<!-- Creation of Qr code -->
						<div class="row">
							<div class="col-sm-12">
								<div class="pricing-plan" style="right: -30%; width: 35%; height: 200px;">
									
									<h2 class="pricing-plan-title"><?php echo $user->getfirstname(); ?></h2>
									
									<?php echo $data['comment'];?>
								</div>
								
								
							</div>
							
							<?php 
							
							
							if($x != $co-1)
							{
							?>
							<div class="col-md-4 col-md-offset-5">
							<img src="img/arrow_down.png">
							</div>
							<?php 
							}
							
							?>
							
						
						</div>
						
				
						


				
				
				
				
				<?php 
					 $x++;
					 } 
				
				
				
				?>
				<a align = "center" href="flows.php" class="btn" style=" width: 20%; padding: 14px 20px; border: none; border-radius: 4px;">Back</a>
				</div>
			
			
			
			
			
			
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