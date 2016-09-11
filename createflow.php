<!DOCTYPE html>
<?php session_start(); 
require 'commands.php';

$command = new Command();
$_SESSION['flow'] = false;
$userid = $_SESSION['userid'];

$pid = $_SESSION['pid'];


$pdoc = $command->getpdoc($pid);

$count = $pdoc->getcount();

$fid = $pdoc->getflow();

$flow = $command->getflowtitle($fid);



if(isset($_GET['create']) && $_GET['create'] == 'Create')
{
	if($_GET['number'] != "No. of Person")
		{
			echo strlen($_GET['title']);
			if(strlen($_GET['title']) == 0)
			{
				echo "<script>alert('Pls put a title')</script>";
			}
			else
			{
				$_SESSION['flow'] = true;
				$_SESSION['number'] = $_GET['number'];
				$_SESSION['title'] = $_GET['title'];
				
				$command->AddFlow($userid,$_SESSION['title']);
			}
		}
	else
	{
		echo "<script>alert('Pls indicate the no. of Person')</script>";
	}
}

if(isset($_SESSION['number']))
{
	
	for($y = 0;$y < $_SESSION['number']; $y++)
	{
		
		$var2 = (string) $y+1;
		if(isset($_GET['department'.$var2]) && $_GET['department'.$var2] != 'Department')
		{
			$_SESSION['department'.$var2] = $_GET['department'.$var2];
		}
		if(isset($_GET['person'.$var2]) && $_GET['person'.$var2] != 'Send to' &&  $_GET['person'.$var2] != "")
		{
			$_SESSION['person'.$var2] = $_GET['person'.$var2];
		}
		if(isset($_GET['comment'.$var2]) && $_GET['comment'.$var2] != 'Send to' &&  $_GET['comment'.$var2] != "")
		{
			$_SESSION['comment'.$var2] = $_GET['comment'.$var2];
		}
	}
}

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
}

if(isset($_GET['back']) && $_GET['back'] == 'Back')
{
	
	

	if(isset($_SESSION['number']))
	{
		for($y = 0;$y < $_SESSION['number']; $y++)
		{
			
			$var2 = (string) $y+1;
			unset($_SESSION['department'.$var2]);
			unset($_SESSION['person'.$var2]);
			unset($_SESSION['comment'.$var2]);
			unset($_SESSION['title']);
		}
	}
	
	unset($_SESSION['number']);
	unset($_SESSION['flow']);
	
}

$error = 0;
if(isset($_GET['flow']) && $_GET['flow'] == 'Submit')
{
	
	
	for($y = 0;$y < $_SESSION['number']; $y++)
	{
		if(!isset($_SESSION['department'.$var2]) || $_SESSION['department'.$var2] == 'Department' || !isset($_SESSION['person'.$var2]) || $_SESSION['person'.$var2] == 'Send to' ||  $_SESSION['person'.$var2] == "" || !isset($_GET['comment'.$var2]) || $_SESSION['comment'.$var2] == 'Send to' ||  $_SESSION['comment'.$var2] == "") 
		{
			echo $error += 1;
		}
		if($error == 0)
		{
				$num = $y+1;
				$var2 = (string) $y+1;
				$sendto = $_SESSION['person'.$var2];
				
				$test = explode(" ",$_SESSION['person'.$var2]);
				$user = $command->getuserName($test[0],$test[1]);
				$useid = $user->getuser_id();
				$title = $_SESSION['title'];
				
				$comment = $_SESSION['comment'.$var2];
				
				$flow = $command->getflow($title);
				$fid = $flow->getflowid($title);
				$command->AddFlowDetails($fid,$useid,$num,$comment);
				
				echo "<script>alert('Successfully created the flow')</script>";
				
				$_SESSION['success'] = true;
				
				echo "<script>window.location.href = 'createflow.php';</script>";
		}
	}
	if($error > 0)
		{
			echo "<script>alert('Pls check your input')</script>";
		}
}

if(isset($_SESSION['success']) && $_SESSION['success'] == true)
{
		for($y = 0;$y < $_SESSION['number']; $y++)
		{
			
			$var2 = (string) $y+1;
			unset($_SESSION['department'.$var2]);
			unset($_SESSION['person'.$var2]);
			unset($_SESSION['comment'.$var2]);
			unset($_SESSION['title']);
		}
		
	unset($_SESSION['number']);
	unset($_SESSION['flow']);
	
	$_SESSION['success'] = false;
}
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
			
				<?php

				 ?>

				<form method="get" action="createflow.php" enctype="multipart/form-data">
				
				<input type="hidden" name="un" value='<?php echo $_SESSION['userid'] ?>' readonly> <br>
				
				<?php if(!isset($_SESSION['flow']) || !isset($_SESSION['number']))
				{
				?>
				
				
				<label for="title"><b>Title</b></label>
				<input type="text" name="title"></input>
				<br>
				
				<div class = "form-group form-inline"">
				<label for="title"><b>Flow</b></label>
				<select name="number" id="number" class="form-control" style="width: 15%;)">
					  <option selected="selected" hidden>No. of Person</option>
					  <option>1</option>
					  <option>2</option>
					  <option>3</option>
					  <option>4</option>
					  <option>5</option>
				</select>
				</div>
				<input type="submit" name="create" value="Create" style	="width: 20%; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;">
				<br>
				<a href="flows.php" class="btn" style="width: 20%; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;">Back</a>
				
				<?php 
				}else{
					?>
					<div class="form-group col-md-offset-1">
					<h3><?php echo $_SESSION['title']?></h3>
					</div>
					<?php
					for($x=0;$x<$_SESSION['number'];$x++)
					{
				?>
		
			<div class="container">
				<div class="form-group form-inline panel-group">
					<div class="panel panel-info ">
						<div class="panel-body ">
							
							
							
							<label for="text">Department</label>
							<select name="department<?php echo $x+1;?>" id="department" class="form-control" style="width: 15%;)" onchange="this.form.submit()">
							  <?php 
							  $var1 = (string) $x+1;
							  if(!isset($_SESSION['department'.$var1])){?>
							  
							  <option selected="selected" hidden>Department</option>
							  <?php }else
							  {?>
							  <option selected ="selected" hidden><?php echo $_SESSION['department'.$var1];?>
							  <?php }?>
							 <option>CS</option>
							 <option>HR</option>
							 <option>VP</option>
							</select>
							<br>
							<label for="text"><?php echo string($x+1);?> Person </label>
							<?php 
							$command = new Command();
							if(isset($_SESSION['department'.$var1]))
							{
							$department = $_SESSION['department'.$var1];
							$users = $command->viewdatadept($department);
							}
							?>
							<select name="person<?php echo $x+1;?>" id="person" class="form-control" style="width: 15%;)">
							<?php
							if(!isset($_SESSION['person'.$var1]))
							{
										?>
										  <option selected="selected" hidden>Send to</option>
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
									  else
									  {
										  ?><option selected="selected" hidden>Send to</option><?php
									  }
							}
							else
							{
								?><option selected ="selected" hidden><?php echo $_SESSION['person'.$var1];?><option><?php
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
							<label for="comment">Comment &nbsp </label>
							<?php if(!isset($_SESSION['comment'.$var1]))
							{?>
							<input type="text" name="comment<?php echo $x+1;?>"></input>
							<?php 
							}
							else{?>
							<input type="text" name="comment<?php echo $x+1;?>" value="<?php echo $_SESSION['comment'.$var1]?>"></input>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
				<?php 
					}
					
					?>
				
				
				<input type="submit" name="flow" value="Submit" style="width: 20%; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;">
				<br>
				<input type="submit" name="back" value="Back" style="width: 20%; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;">
				<?php 
					
				}
				?>
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