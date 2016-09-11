<!DOCTYPE html>
<?php session_start(); ?>
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
        <!-- Page Title -->
		<div id="fadein" class="section section-breadcrumbs">
			<div class="container">
				<div class="row">
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
					<?php } elseif(isset($_SESSION['incpass'])) {
						  $_SESSION = array();
						  session_destroy();						
					?>
					
					<div class="alert alert-warning">
					<strong>Incorrect Password or Username!</strong>
					</div>
					<?php } ?>
					
						<h1>Login</h1>
						
					</div>
				</div>
			</div>
		</div>
        
        <div id="fadein" class="section">
	    	<div class="container">
				<div class="row">
					<div class="col-sm-5">
						<div class="basic-login">
							<form role="form" role="form" method="post" action="success.php">
								<div class="form-group">
		        				 	<label for="login-username"><i class="icon-user"></i> <b>Username</b></label>
									<input class="form-control" id="login-username" name="user" type="text" placeholder="">
								</div>
								<div class="form-group">
		        				 	<label for="login-password"><i class="icon-lock"></i> <b>Password</b></label>
									<input class="form-control" id="login-password" name="password" type="password" placeholder="">
								</div>
								<div class="form-group">
									<label class="checkbox">
										<input type="checkbox"> Remember me
									</label>
									<a href="page-password-reset.html" class="forgot-password">Forgot password?</a>
									<button type="submit" name="login" class="btn pull-right" value="Login">Login</button>
									<div class="clearfix"></div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-sm-7 social-login">
						<p>Or login with your Facebook or Twitter</p>
						<div class="social-login-buttons">
							<a href="#" class="btn-facebook-login">Login with Facebook</a>
							<a href="#" class="btn-twitter-login">Login with Twitter</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	    <!-- Footer -->
	    <div class="footer">
	    	<div class="container">
		    	<div class="row">
		    		
		    		<div class="col-footer col-md-4 col-xs-6" style="right: -20%;">
		    			<h3>Contacts</h3>
		    			<p class="contact-us-details">
	        				<b>Address:</b> Acacia St., Davao City<br/>
	        				<b>Phone:</b> 09103251325 <br/>
	        				<b>Fax:</b> 223 5689<br/>
	        				<b>Email:</b> <a href="addocutracking.site88.net">addocutracking.site88.net.com</a>
	        			</p>
		    		</div>
		    		<div class="col-footer col-md-2 col-xs-6" style="right: -30%;">
		    			<h3>Stay Connected</h3>
		    			<ul class="footer-stay-connected no-list-style">
		    				<li><a href="fb.com" class="facebook"></a></li>
		    				<li><a href="twitter.com" class="twitter"></a></li>
		    				<li><a href="google.com" class="googleplus"></a></li>
		    			</ul>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="footer-copyright">&copy; Addocutracking. All rights reserved.</div>
		    		</div>
		    	</div>
		    </div>
	    </div>

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
        <script src="js/jquery-alert.js"></script>

    </body>
</html>