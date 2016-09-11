<!DOCTYPE html>
<?php session_start();
require 'commands.php';	


$command = new Command();
$currentuser = $_SESSION['userid'];
$title = $_SESSION['title'];
$description = $_SESSION['description'];
$author = $_SESSION['author'];
$pid = $_SESSION['pid'];

// FOR SENDING //
if(isset($_GET['department']))
{
	$department = $_GET['department'];
	$users = $command->viewdatadept($department);
}


if(isset($_GET['send'])) {
	if($_GET['send']=='Send') {
		
				//$getuserid = $_GET['sent'];
				//$getuser = $command->getuser($getuserid);
				
				$us = $command->getuserName($_SESSION['fn'],$_SESSION['ln']);
				$getu_id= $us->getuser_id();
				
				
				$sento = $_GET['sent'];
				$comment = $_GET['comment'];
				
				

				$command->AddHistory($currentuser,$pid,$comment,$sento,"Send");
				$command->send($sento,0,1,$pid);
				$command->notif("Sample message",$currentuser,$getu_id,0,1,0);
				
			
	}
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
		

        <div class="container">
		
			<div class="row">
				
				<form method="get" action="send.php">
				<div class = "col-md-10">
				<label align = "center" for="title" style="width: 9%">Title: </label>
				<input type="text" name="title" id="title" value="<?php echo $title;?>" style="width: 30%" disabled><br>
				</div>
				<div class = "col-md-10">
				<label for="title" >Description: </label>
				<input type="text" name="desc" id="title" value="<?php echo $description;?>" style="width: 30%" disabled><br>
				</div>
				<div class = "col-md-10">
				<label for="title" align="center" style="width: 9%">Author: </label>
				<input type="text" name="author" id="title" value="<?php echo $author;?>" style="width: 30%" disabled><br>
				</div>
				
				
				<div class = "col-md-10">
						<div class="row">

							
							<div class = "col-md-12">
							<label align="left" for="department">Department: </label>
							<select name="department" id="department" class="form-control" align="center" style="width: 20%;" onchange="this.form.submit()">
							  <?php if(!isset($_GET['department'])){?>
							  <option selected="selected" hidden>Department</option>
							  <?php }else
							  {?>
							  <option selected ="selected" hidden><?php echo $_GET['department'];?>
							  <?php }?>
							  <option>CS</option>
							  <option>HR</option>
							  <option>VP</option>
							</select>
							</div>
						</div>
				
				
				</div>
				
				<div class = "col-md-10">
				<select name="sent" id="sent" class="form-control" style="width: 30%;)" required>
					  
					  <?php if($users)
					  {
					  foreach($users as $user)
					  {
					  ?>
					  <option>
					  <?php echo $user->getfirstname()." ".$user->getlastname();
					  $_SESSION['fn'] = $user->getfirstname();
					  $_SESSION['ln'] = $user->getlastname();
					  ?></option>
					  
					  <?php
					  }
					  }
					  ?>
					 
				</select>	
				</div>
				
				<div class = "col-md-10">
				<label align="left" for="comment">Comment: </label>
				<input type="text" name="comment" id="comment" placeholder="Comment" required><br>
				</div>
				<input type="submit" name="send" value="Send" onclick = "return confirm('Are you sure to send the document?');" style="width: 20%; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;">
				
				</form>
			
			<form method="post" action="pdocs.php">
			
			<input type="submit" name="back" value="Back">
			
			</form>

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