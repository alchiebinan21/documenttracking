<!DOCTYPE html>
<?php session_start();
include "query_functions.php"; ?>
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
		
		<?php if(!isset($_SESSION['access']))
        		{
        			//if not logged on, user will be directed to the page login
					$_SESSION['reqlogin'] = true;
        			echo "<script>window.location='page-login.php';</script>";
        		} 

        ?>
		
		<br>
		<br>
		<br>
		<br>
        <!-- Page Title -->
		<div id="fadein" class="section section-breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
					
					<div class="col-md-12">
					<!-- login first to access the page -->
					<?php if(isset($_SESSION['reqlogin']) && $_SESSION['reqlogin'] == true) {

					  
						  $_SESSION = array();
						  session_destroy();
						 
					?>
				
					<div class="alert alert-warning">
					<strong>Please login first!</strong>
					</div>
					
					<!-- If incorrect credentials-->
					<?php } elseif(isset($_SESSION['duplicatedata'])) {
						  						
					?>
					
					<div class="alert alert-warning">
					<strong>Duplicate Data!</strong>
					</div>
					
					<?php unset($_SESSION['duplicatedata']); } 

					elseif(isset($_SESSION['accountcreated'])) { ?>
					
					<div class="alert alert-success">
					<strong>Success!</strong> Account Created.
					</div>
						
					<?php unset($_SESSION['accountcreated']); }

					elseif(isset($_SESSION['reenterpass'])) {?>
					
					<div class="alert alert-warning">
					<strong>Failed!</strong> Please re enter the password correctly
					</div>
					
					<?php unset($_SESSION['reenterpass']); } ?>
					
					
						<h1>Edit user data</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
        
        <?php if(isset($_POST['submit']) && $_POST['submit'] == 'edit') {
			
			$user_id = $_POST['user_id'];
			
			$result = select_specific_user($user_id);
			
			foreach($result as $data)
			{
			
		?>
		
		<div id="fadein" class="section">
	    	<div class="container">
				<div class="row">
					<div class="col-sm-5">
						<div class="basic-login">
							<form role="form" method="post" action="success.php">
								<div class="form-group">
		        				 	<label for="register-username"><i class="icon-user"></i> <b>Firstname</b></label>
									<input class="form-control" id="register-username" name="fn" type="text" value="<?php echo $data['firstname']; ?>" required> 
								</div>
								<div class="form-group">
		        				 	<label for="register-username"><i class="icon-user"></i> <b>Lastname</b></label>
									<input class="form-control" id="register-username" name="ln"type="text" value="<?php echo $data['lastname']; ?>" required>
								</div>

								<div class="form-group">
		        				 	<label for="register-username"><i class="icon-user"></i> <b>Position</b></label>
		        				 	<input class="form-control" id="register-username" name="position" type="text" value="<?php echo $data['position']; ?>" required> 
								</div>
								<div class="form-group">
		        				 	<label for="register-username"><i class="icon-user"></i> <b>Department</b></label>
		        				 	<input class="form-control" id="register-username" name="department" type="text" value="<?php echo $data['department']; ?>" required> 
								</div>
								<div class="form-group">
		        				 	<label for="register-username"><i class="icon-user"></i> <b>Username</b></label>
									<input class="form-control" id="register-username" name="un"type="text" value="<?php echo $data['username']; ?>" required>
								</div>
								<div class="form-group">
		        				 	<label for="register-username"><i class="icon-user"></i> <b>Email</b></label>
									<input class="form-control" id="register-username" name="email" type="email" value="<?php echo $data['email']; ?>" required>
								</div>
								<div class="form-group">
		        				 	<label for="register-password"><i class="icon-lock"></i> <b>Password</b></label>
									<input class="form-control" id="register-password" name="password" type="password" value="<?php echo $data['password']; ?>" required>
								</div>
								<div class="form-group">
		        				 	<label for="register-password2"><i class="icon-lock"></i> <b>Re-enter Password</b></label>
									<input class="form-control" id="register-password2" name="repassword" type="password" value="<?php echo $data['password']; ?>" required>
								</div>
								<div class="form-group">
									<button type="submit" name="submit" class="btn pull-right" value="Edit" >Edit</button>
									<div class="clearfix"></div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-sm-6 col-sm-offset-1 social-login">
						<p>You can use your Facebook or Twitter for registration</p>
						<div class="social-login-buttons">
							<a href="http://www.facebook.com" class="btn-facebook-login">Use Facebook</a>
							<a href="http://www.twitter.com" class="btn-twitter-login">Use Twitter</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php } } ?>

	   <?php 

	   		//footer design
			include "design/footer.php";
		?>

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