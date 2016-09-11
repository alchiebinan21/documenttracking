<!DOCTYPE html>
<?php session_start();
$_SESSION['back'] = "pdocs";

require 'commands.php';

$userid = $_SESSION['userid'];
$command = new Command();

$pid = $_SESSION['pid'];


$pdoc = $command->getpdoc($pid);

$count = $pdoc->getcount();

$fid = $pdoc->getflow();

if(isset($_GET['title']))
{
	$getflow = $command->getflow($_GET['title']);
	$fid = $getflow->getflowid();
}

$howmany = $command->countflowdetails($fid);
$countflow = count($howmany);


$received = $pdoc->getreceived();

$flow = $command->getflowtitle($fid);

$flow->gettitle();

$userid = $_SESSION['userid'];

$pdoc = $command->getpdoc($pid);
$received = $pdoc->getreceived();

$all = $command->getallflows($userid);

if(isset($_GET['change']) && $_GET['change'] == "Change Flow")
{
	$title = $_GET['title'];
	$flowbytit = $command->getflow($title);
	$flowtit = $flowbytit->getflowid();
	
	$command->changeFlow($flowtit,$pid);
	$command->AddHistoryWithFlow($userid,$pid,"","","Change",$flowtit);
	
	header("Location: sendflow.php");
}

if(isset($_GET['change']) && $_GET['change'] == "Remove Flow")
{
	
	$command->changeFlow(0,$pid);
	$command->AddHistoryWithFlow($userid,$pid,"","","Remove Flow",0);
	
	header("Location: sendflow.php");
}

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
		<h3 class="col-md-offset-5" ><b>CHANGE FLOW</b></h3>
		

			<div class="row">
			
			<br>
			
				<?php 
				

					
				
					$conn = new mysqli('localhost', 'root', 'usbw', 'docdb');
					
					
					
					$sql = "select * from flowdetails where flowid = $fid";
					
					$res = $conn->query($sql);
					
					if(!empty($res)){
					$command = new Command();
					
					$co = mysqli_num_rows($res);
				?>
				
				<div class="pricing-wrapper col-md-12">
				
				<?php
					$x = 0;
					while($data = $res->fetch_assoc())	
					{
					$countda = $data['countpos'];
					?>

						
						
						<style>
						.pricing-plan<?php echo$countda;?> {
						  -webkit-box-shadow: 0 0 8px #333;
						  -moz-box-shadow: 0 0 8px #333;
						  box-shadow: 0 0 8px #333;
						  color: 0 0 8px #333;
						  z-index: 5;
						}
						  .pricing-plan<?php echo$countda;?>{
						  float: left;
						  text-align: center;
						  background: #fafafa;
						  position: relative;
						  width: 48%;
						  margin: 10px 1% 10px 0;
						  padding: 20px;
						  -webkit-border-radius: 7px;
						  -webkit-background-clip: padding-box;
						  -moz-border-radius: 7px;
						  -moz-background-clip: padding;
						  border-radius: 7px;
						  background-clip: padding-box;
						  -webkit-box-sizing: border-box;
						  -moz-box-sizing: border-box;
						  box-sizing: border-box;
						  -webkit-box-shadow: 0 1px 8px rgba(0, 0, 0, 0.4);
						  -moz-box-shadow: 0 1px 8px rgba(0, 0, 0, 0.4);
						  box-shadow: 0 1px 8px rgba(0, 0, 0, 0.4);
						  color: 0 1px 8px rgba(0, 0, 0, 0.4);
						  -webkit-transition: -webkit-box-shadow .25s linear;
						  -moz-transition: -moz-box-shadow .25s linear;
						  -o-transition: box-shadow .25s linear;
						  -ms-transition: box-shadow .25s linear;
						  transition: box-shadow .25s linear;
						}
						</style>
						
						

					<?php
					$sendto = $data['sendto'];
					$user = $command->getuser($sendto);
					
				
				?>
				
					
        				<!-- Creation of Qr code -->
						<div class="row">
						
							<div class="col-sm-12 col-md-offset-3">
							
								<div class="pricing-plan<?php echo $countda;?>" style="right: -32%; width: 35%; height: 200px;">
									
									<h2 class="pricing-plan-title"><?php echo $user->getfirstname(); ?></h2>
									<br>
									<?php echo $data['comment'];?>
								</div>
								
								
							</div>
							
							<?php 
							
							
							if($x != $co-1)
							{
							?>
							<div class="col-md-4 col-md-offset-8">
							<img src="img/arrow_down.png">
							</div>
							<?php 
							}
							
							?>
							
						
						</div>
						
				
				<?php 
					 $x++;
					 } 
				
				 }
				
				
				?>
			
			
			<div style = "">
			<form action = "changeflow.php">
			<i>If no flow is available, click <a href="flows.php">here</a> to create a flow.</i>
			
			<label for="title"  style= "position: fixed; top: 215px;left: 200px;">Title:</label>
			<select name="title" id="department" class="form-control" style= "position: fixed; top: 200px;left: 240px; width: 20%" onchange="this.form.submit()">
			<option selected ="selected" hidden><?php echo $flow->gettitle();?><option>
				<?php 
				if(!empty($all))
				{
					foreach($all as $one)
					{
					?>
					<option><?php echo $one->gettitle();?></option>
					<?php
					} 
					?>
					</select>
					
					<?php
				}
					if(!empty($_GET['title']))
					{
					?>
						<input type="submit" name="change" value="Change Flow" class="btn btn-danger" style= "position: fixed; top: 250px;left: 239px; width: 10%; padding: 14px 20px; border: none; border-radius: 4px;" onClick="return confirm('Are you sure you want to change Flow?');">
					<?php
					}
					else
					{
					?>
					<input type="submit" name="change" value="Remove Flow" class="btn btn-danger" style= "position: fixed; top: 250px;left: 239px; width: 10%; padding: 14px 20px; border: none; border-radius: 4px;" onClick="return confirm('Are you sure you want to remove Flow?');">
					<?php 
					}
				?>
			</form>
			
			
			<form>
			
			</form>
			
			<!--<a align = "center" href="sendmenu.php" class="btn" style=" position: fixed;top: 325px;left: 200px; width: 20%; padding: 14px 20px; border: none; border-radius: 4px;">Edit Flow</a>
			<a align = "center" href="sendmenu.php" class="btn" style=" position: fixed;top: 500px;left: 200px; width: 20%; padding: 14px 20px; border: none; border-radius: 4px;">Back</a>-->
			
			</div>
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