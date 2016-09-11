<!DOCTYPE html>
<html>
<?php session_start();
include "query_functions.php";
require 'commands.php';

$userid = $_SESSION['userid'];
//if user  wants to share documents
if(isset($_POST['share']) && $_POST['share'] == 'Share')
{
	$_SESSION['title'] = $_POST['title'];
	$_SESSION['description'] = $_POST['description'];
	$_SESSION['author'] = $_POST['author'];
	$_SESSION['eid'] = $_POST['eid'];
	
	echo '<script type="text/javascript">location.href="share_edocs.php";</script>';
}


//If user is being shared with a document
if(isset($_POST['receive']) && $_POST['receive'] == 'Receive')
{
	
	$_SESSION['title'] = $_POST['title'];
	$_SESSION['description'] = $_POST['description'];
	$_SESSION['author'] = $_POST['author'];
	$_SESSION['eid'] = $_POST['eid'];
	$cu = $_POST['currentuser'];
	$h = $_POST['holder'];
	
	$eid = $_POST['eid'];
	$command = new Command();
	
	$command->e_receive(true,$cu);
	$command->notif("Received notification",$cu,$h,0,0,1);
	echo '<script type="text/javascript">location.href="e_receive.php";</script>';
}

//If user wants to cancel share of documents
if(isset($_POST['cancel']) && $_POST['cancel'] == 'Cancel Share')
{
		$eid = $_POST['eid'];
		$command = new Command();
		echo "hu";
				//$command->AddHistory($currentuser,$pid,$comment);
				$command->e_share("",1,0,$eid);
				echo "<script>alert('Share Cancelled')</script>";
				echo '<script type="text/javascript">location.href="edocs.php";</script>';
}

//if user wants to share all edocs
if(isset($_POST['share']) && $_POST['share'] == 'Share To All')
{
	$eid = $_POST['eid'];

	$result = select_all_users();

	foreach($result as $data)
	{
			$user_id = $data['user_id'];
			$res = insert_sharedmem($eid,$user_id);


	}

	echo "<script>alert('SUCCESS! Shared to all members'); window.location='edocs.php'; </script>";

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
					
					$conn = new mysqli('localhost','root','usbw','docdb');
					
					$id = $_POST['eid'];
					$_SESSION['eid'] = $id;
					
					$result = select_specific_edoc($id);
				
					foreach($result as $data)
					{
						
						$qr = $data['qrcode'];
						
						$filename = 'qrpics/'.$qr;

				?>
				
				<form method="post" action="success.php">
				<input type="hidden" name="id" value='<?php echo $data['ed_id'] ?>' readonly><br>
				<label for="title" >Title</label>
				<input type="text" name="title" style="display: block;" value='<?php echo $data['title'] ?>' readonly><br>
				
				<label for="title" >Description</label>
				<input type="text" name="description" style="display: block;" value='<?php echo $data['description'] ?>' readonly><br>
				
				<label for="title" >Author</label>
				<input type="text" name="author" style="display: block;" value='<?php echo $data['author'] ?>' readonly><br>
				
				<input type="submit" style="background-color: blue;" name="readpdf" formtarget="_blank" value="View PDF">
				
				<!--<div class="right">
				<?php //echo '<img src="data:image/png;base64,' . base64_encode($data['qrcode']) . '" width="250" height="250">'; ?>
				</div>-->
				
				</form>
				
				
					
					
			
				<?php } } ?>
				
				<?php if($_SESSION['back'] == "edocs" || $_SESSION['back'] == "e_receive")
			{ 
		?>
				<form method="get" action="success.php">
				<input type="submit" name="view_edoc" value="View History"  style= "width: 20%; padding: 14px 20px; border: none; border-radius: 4px; background-color: red;">
				<br>
				<input type="submit" name="back_edoc" value="Back" style= "width: 20%;">
				
				</form>
				<?php
			}
			?>
			
			
			</div>
			
			
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
    width: 20%;
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
    border: 10px solid #73AD21;
    padding: 10px;
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