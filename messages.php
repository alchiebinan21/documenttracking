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
    <body >
	
	<?php if(isset($_POST['readmessage']) && $_POST['readmessage'] == 'readmessage') {

		  $conn = new mysqli('localhost','root','usbw','docdb');
		  
		  $msg_id = $_POST['msg_id'];
		  
		  $sql = "UPDATE notification SET readmsg = 1 where msg_id = '$msg_id' ";
		  
		  $conn->query($sql);
		  
	}



	?>
        
		
        
        <!--navbar design ang login session -->
        <?php include "design/navlogsession.php"; ?>

        <!--not logged on and homeslider design -->
        <?php include "design/homeslider.php"; ?>
		
		<br>
		<br>
		<br>
		<br>
		<br>

		
		<!-- if login is true -->
		<?php if(isset($_SESSION['access']) && $_SESSION['access'] == true)

			 { 
		
				include "design/inboxUI.php";
		
		
			} 

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
        <script src="js/jquery-alert.js"></script>
        <script src="js/main-menu.js"></script>
        <script src="js/template.js"></script>
		
		

    </body>
</html>