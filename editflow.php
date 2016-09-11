<!DOCTYPE html>
<?php session_start(); 
require 'commands.php';

$command = new Command();
$_SESSION['flow'] = false;
$userid = $_SESSION['userid'];


if(isset($_GET['fid']))
{
	$fid = $_GET['fid'];
	if(!isset($_SESSION['fid']))
	{
		$_SESSION['fid'] = $_GET['fid'];
	}
}

if(isset($_SESSION['fid']))
{
	$fid = $_SESSION['fid'];
}

$flowdetails = $command->countflowdetails($fid);


function string($number)
{
	if($number == 1)
	{
		return "1st";
	}
	else if($number == 2)
	{
		return "2nd";
	}
	else if($number == 3)
	{
		return "3rd";
	}
	else if($number == 4)
	{
		return "4th";
	}
	else if($number == 5)
	{
		return "5th";
	}
	else if($number == 6)
	{
		return "6th";
	}
	else if($number == 7)
	{
		return "7th";
	}
	else if($number == 8)
	{
		return "8th";
	}
	else if($number == 9)
	{
		return "9th";
	}else if($number == 10)
	{
		return "10th";
	}
}

if(isset($_GET['back']) && $_GET['back'] == "Back")
{
	unset($_SESSION['fid']);
	
	header("Location: viewflow.php");
}

//EDIT editflowdetails //
if(isset($_GET['flow']) && $_GET['flow'] == "Submit")
{
	$var = 1;
	foreach($flowdetails as $flow)
	{
		if($_GET['person'.$var] != "")
		{
		$per = $_GET['person'.$var];
		$sp = explode(" ",$per);
		
		$first = $sp[0];
		$last = $sp[1];
		
		$getu = $command->getuserName($first,$last);
		$getuserid = $getu->getuser_id();
		
		
		$flowdetid = $flow->getflowdetailsid();
		
		$com = $_GET['comment'.$var];
		
		$command->editflowdetails($getuserid,$com,$flowdetid);
		$var += 1;
		}
	}
}
//EDIT editflowdetails //

?>

<html class="no-js">
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
        			echo "<script>window.location='page-login.php';</script>";
        		} 

        ?>
		
        <div class="container">
		
			<div class="row">
			
				<form method="get" action="editflow.php" enctype="multipart/form-data">
				
			
					<div class="form-group col-md-offset-1">
					<h3></h3>
					</div>
			
			
			<div class="container">
			
			<?php 
							
							$var = 1;
							foreach($flowdetails as $flow)
							{
							?>
				<div class="form-group form-inline panel-group">
					<div class="panel panel-info ">
						<div class="panel-body ">
							
							<?php 
							$sendto = $flow->getsendto();
							$getuser = $command->getuser($sendto);	
							$getdepartment = $getuser->getdepartment();
							
							
							?>
							
							<label for="text">Department</label>
							<select name="department<?php echo $var;?>" id="department" class="form-control" style="width: 15%;)" onchange="this.form.submit()">
							 <?php if(!isset($_GET['department'.$var])){?>
							 <option selected="selected" hidden><?php echo $getdepartment;?></option>
							 <?php 
							 }
							 else{
							 ?>
							 <option selected="selected" hidden><?php echo $_GET['department'.$var];?></option>
							 <?php
							 }
							 ?>
							 
							 <!-- TO BE CHANGED SELECT ALL DEPARTMENT IN DEPARTMENT--> 
							 <option>CS</option>
							 <option>HR</option>
							 <option>VP</option>
							</select>
							<!-- TO BE CHANGED ALL DEPARTMENT IN DEPARTMENT--> 
							
							
							<br>
							<label for="text"><?php echo string($var)." ";?>Person </label>
							<?php 
							$command = new Command();
							if(isset($_GET['department'.$var]))
							{
							$department = $_GET['department'.$var];
							$users = $command->viewdatadept($department);
							}
							else
							{
								$users = $command->viewdatadept($getdepartment);
							}
							?>
							<select name="person<?php echo $var;?>" id="person" class="form-control" style="width: 15%;)">
							<?php
							if(!isset($_GET['person'.$var]))
							{
										?>
										 <option selected="selected" hidden><?php echo $getuser->getfirstname()." ".$getuser->getlastname();?></option>
										<?php
									  if($users)
									  {
										  foreach($users as $user)
										  {
													  ?>
													  <option>
													  <?php echo $user->getfirstname()." ".$user->getlastname();
													  $first = $user->getfirstname();
													  $last = $user->getlastname();
													  ?></option>
													  <?php

											  }
									  }
							}
							else
							{
								?><option selected ="selected" hidden><?php echo $_GET['person'.$var];?><option><?php
								if($users)
									  {
										  foreach($users as $user)
										  {
													  ?>
													  <option><?php echo $user->getfirstname()." ".$user->getlastname();
													  $first = $user->getfirstname();
													  $last = $user->getlastname();
													  ?></option>
													  
													  <?php

											  }
										 }
							}
							?>						  
													 
							
							</select>
							<br>
							<label for="comment<?php echo $var;?>">Comment &nbsp </label>
							
							
							<?php if(!isset($_GET['comment'.$var]))
							{?>
							<input type="text" name="comment<?php echo $var;?>" value="<?php echo $flow->getcomment();?>"></input>
							<?php 
							}
							else{?>
							<input type="text" name="comment<?php echo $var;?>" value="<?php echo $_GET['comment'.$var]?>"></input>
							<?php }?>
						</div>
					</div>
				</div>
			
				<?php 
				$var += 1;
					}
					
					?>
			</div>
			
				
				
				<input type="submit" name="flow" value="Submit" style="width: 20%; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;">
				<br>
				<input type="submit" name="back" value="Back" style="width: 20%; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;">
				
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
		
		.boxed {
		  border: 1px solid green ;
		}
	</style>
		
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