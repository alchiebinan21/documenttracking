<!DOCTYPE html>
<?php session_start();
include "query_functions.php";
require 'commands.php';

$userid = $_SESSION['userid'];
//if user  wants to send documents
if(isset($_POST['send']) && $_POST['send'] == 'Direct Send')
{
	$_SESSION['title'] = $_POST['title'];
	$_SESSION['description'] = $_POST['description'];
	$_SESSION['author'] = $_POST['author'];
	$_SESSION['pid'] = $_POST['pid'];
	
	echo '<script type="text/javascript">location.href="send.php";</script>';
}


//If user received documents
if(isset($_POST['receive']) && $_POST['receive'] == 'Receive')
{
	
	$_SESSION['title'] = $_POST['title'];
	$_SESSION['description'] = $_POST['description'];
	$_SESSION['author'] = $_POST['author'];
	$_SESSION['pid'] = $_POST['pid'];
	
	$pid = $_POST['pid'];
	$command = new Command();
	$pdoc = $command->getpdoc($pid);
	echo $flowsent = $pdoc->getflowsent();
	$count = $pdoc->getcount();
	
	if($flowsent == 0)
	{
	$command->receive($userid,"",1,0,$pid);
	}
	else if($flowsent == 1)
	{
	$newcount = $count+1;
	$command->receivebyflow($userid,"",1,0,$newcount,$pid);
	}
	else if($flowsent == -1)
	{
	$newcount = $count-1;
	$command->receivebyflow($userid,"",1,0,$newcount,$pid);
	}
	echo '<script type="text/javascript">location.href="receive.php";</script>';
}

//If user wants to cancel the sending of documents
if(isset($_POST['cancel']) && $_POST['cancel'] == 'Cancel Send')
{
		$pid = $_POST['pid'];
		$command = new Command();
		
				$comment = $_POST['comment'];
				$command->send("",1,0,$pid);
				$command->AddHistory($userid,$pid,$comment,"","Cancel");
				echo "<script>alert('Sending Cancelled')</script>";
				echo '<script type="text/javascript">location.href="pdocs.php";</script>';
				
}

//directly send back to the one who sent you the document
if(isset($_POST['send_back']) && $_POST['send_back'] == 'Send Back')
{
	$conn = new mysqli('localhost','root','usbw','docdb');
	
	$pid = $_POST['pid'];
	$comment = $_POST['comment'];
	
	
	
	
	
	//get the sender
	$sql = "select * from history where pd_id = '$pid' and type = 'Send'";
	
	$res = $conn->query($sql);
	
	
	
	while($data = $res->fetch_assoc())
	{
		$sender = $data['sender'];
	}
	
	if($sender <= 0)
	{
		echo "<script>alert('CANNOT SEND IT BACK!'); window.location='pdocs.php';</script>";
		break;
	}
	
		$sql2 = "select * from user where user_id = '$sender'";
	
		$res = $conn->query($sql2);
		
		$data = $res->fetch_assoc();
		
		//fullname of the sender
		$fn = $data['firstname'];
		$ln = $data['lastname'];
		
		
	$command = new Command();
	
	
	$sento = $fn." ".$ln;
	
	
	
	$command->AddHistory($userid,$pid,$comment,$sento,"Send");
	$command->send($sento,0,1,$pid);
	$command->notif("Balik sa imuha",$userid,$sender,0,1,0);
	
	echo "<script>alert('SUCCESS! sent document back!');window.location='pdocs.php';</script>";
}
 ?>
 
 
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
		<br>
		<br>
		
		
		
		 <?php if(!isset($_SESSION['access']))
        		{
        			//if not logged on, user will be directed to the page login
					$_SESSION['reqlogin'] = true;
        			echo "<script>window.location='page-login.php';</script>";
        		} 

        ?>

        <div id="fadein" class="container">
		
			<div class="row">
			
				<?php 
				
				if(isset($_POST['view']) && $_POST['view'] == 'View')
				{
				
					$id = $_POST['pid'];
					$_SESSION['pid'] = $id;
					
					$result = select_specific_pdoc($id);
				
					foreach($result as $data)	
					{
						
						$qr = $data['qrcode'];
						
						$filename = 'qrpics/'.$qr;

				?>
				
				<form method="post" action="success.php">
				<label for="title" >Title</label>
				<input type="text" name="title" style="display: block;" value='<?php echo $data['title'] ?>' readonly><br>
				
				<label for="description" >Description</label>
				<input type="text" name="description" style="display: block;" value='<?php echo $data['description'] ?>' readonly><br>
				
				<label for="author" >Author</label>
				<input type="text" name="author" style="display: block;" value='<?php echo $data['author'] ?>' readonly><br>
				
				
				
				<div class="right">
				<?php echo '<img src="data:image/png;base64,' . base64_encode($data['qrcode']) . '" width="250" height="250" onClick="printme(event)">'; ?>
				<br><i>click qr pic to print</i>
				</div>
				
				
				
				
				<?php echo '<img style="position: absolute; right: 27%; top: 100px;" class="pic" src="data:image/png;base64,' . base64_encode($data['image']) . '" width="250" height="250">'; ?>
				<?php echo '<img style="right: 27%; top: 100px;" class="picbig" src="data:image/png;base64,' . base64_encode($data['image']) . '" >'; ?>
				
				
				</form>
				
				
			
				<?php } } ?>
			
			
			</div>
			
			<?php if($_SESSION['back'] == "pdocs" || $_SESSION['back'] == "receive")
			{ 
		?>
				<form method="get" action="success.php">
				<input type="submit" name="view" value="View History"  style= "width: 20%; padding: 14px 20px; border: none; border-radius: 4px; background-color: red;">
				<br>
				<input type="submit" name="back" value="Back" style= "width: 20%;">
				
				</form>
				<?php
			}
			?>
		</div>
		
		
		


		
		
	<style>
input[type=text], select {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 50%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.right {
    position: absolute;
    right: 5%;
	top: 100px;
    <!--border: 10px solid #73AD21;-->
    padding: 10px;
}

.pic {
width: 250px;
height: 250px;
}
			
.picbig {
position: absolute;
width: 0px;
-webkit-transition:width 0.3s linear 0s;
transition:width 0.3s linear 0s; z-index:10;
}
			
.pic:hover + .picbig {
width: 25%;
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
		
		
		<!-- print qr code-->
		<?php include "printqr.php" ?>

    </body>
</html>