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

		 <?php if(!isset($_SESSION['access']))
        		{
        			//if not logged on, user will be directed to the page login
        			echo "<script>window.location='page-login.php';</script>";
        		} 

        ?>


		<?php if(isset($_SESSION['access']) && $_SESSION['access'] == true) { ?>
		
		<!-- Menu -->
	    <div class="section">
	    	<div class="container">
	    		<h2>Pricing</h2>
	        	<div class="row">
	        		<!-- Pricing Plans Wrapper -->
	        		<div class="pricing-wrapper col-md-12">
        				<!-- Pricing Plan -->
			
						<form method="post" action="send.php">
						<div style="right: -13%; width: 35%; height: 100px;"> </div>
						<div class="pricing-plan" style="right: -13%; width: 35%; height: 400px;">
							<!-- Physical Documents-->
							<h2 class="pricing-plan-title">Send to One</h2>
							<p><img src="img/1.png"></p>
							<!-- Pricing Plan Features -->
							<ul class="pricing-plan-features">
								List of Physical Documents
							</ul>
							
							<input type = 'submit' name='viewpdocs' class='btn' style="width: 50%;" value='Click me'>
							
						</div>
						
						</form>
						<!-- Electronic Documents  -->
					    <div class="pricing-plan" style="right: -18%; width: 35%; height: 400px;">
							<h2 class="pricing-plan-title">Send to Many</h2>
							<p> <img src="img/many.png"></p>
								<ul class="pricing-plan-features">
									List of Electronic Documents
								</ul>
							<a href="edocs.php" class="btn" style="width: 50%;">Click me</a>
					    </div>
					    
	        		</div>
	        		<!-- End Pricing Plans Wrapper -->
	        	</div>
	    	</div>
	    </div>
	    <!-- End Menu -->
		
		
		<?php } ?>
	
		
		

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

    </body>
</html>