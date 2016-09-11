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
			<h1>CREATE QR CODE FOR ELECTRONIC DOCUMENT</h1>
			<div class="row">
			
				<!-- ------------------------------------------------------------------------------------- -->
				<!-- alert Successful qr generate-->
				<?php if(isset($_SESSION['gedoc'])) { ?>
				<div class="alert alert-success">
				<strong>Success!</strong> QR generated for electronic document. To view the file, click <a href="edocs.php">here</a>.
				</div>
				 
				<?php unset($_SESSION['gedoc']); } ?>
				
				<!-- alert failed qr generate-->
				<?php if(isset($_SESSION['fedoc'])) { ?>
				<div class="alert alert-danger">
				<strong>Failed!</strong> QR for electronic document not generated.
				</div>
				 
				<?php unset($_SESSION['fedoc']); } ?>
				<!-- ------------------------------------------------------------------------------------- -->
				<br>
				<i style="color: red;">please fill up all the information to generate qr code</i>
				
				<form method="post" action="success.php" enctype="multipart/form-data">
				<input type="hidden" name="un" value='<?php echo $_SESSION['userid'] ?>' readonly> <br>
				
				<label for="male"  style="width: 17.2%;"><i>Title of the document:</i></label>
				<input type="text" id="text3" name="title" required><br>
				
				<label for="male" ><i>Description of the document:</i></label>
				<input type="text" id="text3" name="description" required><br>
				
				<label for="male" style="width: 17%;"><i>Author of the document:</i></label>
				<input type="text" id="text3" name="author"required><br><br>
				
				<label for="male">File To Upload</label> <i>(Upload only file that is in pdf format)</i>
				<input type="file" name="fileToUpload" id="fileToUpload" accept=".pdf" required><br><br>
				
				<label for="male">Source of document: &nbsp;</label>
					Physical
					<input type="radio" name="radio_pdoc" id="r1" value="Show_list_pdoc">&nbsp;
					Electronic
					<input type="radio" name="radio_edoc" id="r2" value="Show_list_edoc">&nbsp;
					None
					<input type="radio" name="radio_none" id="r3" value="No Source">
					<br>
					<!-- Dropdrow for the list of pdocs-->
					<div class="p_drop">
					<b>List of Physical Documents:</b> 
					<?php

							$result = select_all_pdocs();
							
					?>
						
					<select name="list_pdoc">
					<?php foreach($result as $data) { ?>
						  <option value="<?php echo $data['title'] ?>"><?php echo $data['title'] ?></option>
					<?php } ?>
					</select>
					
					</div>
					
					<!-- Dropdrow for the list of edocs-->
					<div class="e_drop">
					<b>List of Electronic Documents:</b> 
					<?php

							$result = select_all_edocs();
							
					?>
						
					<select name="list_edoc">
					<?php foreach($result as $data) { ?>
						  <option value="<?php echo $data['title'] ?>"><?php echo $data['title'] ?></option>
					<?php } ?>
					</select>
					
					</div>
					
					
					
				<label for="male">Date: </label>
				<input type="date" name="date" required=><br><br>
				<input type="submit" name="e_generateqr" value="Create" style="width: 20%; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;">
				</form>
			
			
				<a href="createdoc.php" class="btn" style="width: 20%; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;">Back</a>

				
			
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
		
		<!-- jquery for textbox display if radio button is checked-->
		<script>
			$(document).ready(function () 
			{
				$(".p_drop").hide();
				$(".e_drop").hide();
				$("#r1").click(function () {
					$(".p_drop").show();
					$(".e_drop").hide();
					$("#r2").prop('checked', false);
					$("#r3").prop('checked', false);
				});
				$("#r2").click(function () {
					$(".e_drop").show();
					$(".p_drop").hide();
					$("#r1").prop('checked', false);
					$("#r3").prop('checked', false);
				});
				$("#r3").click(function () {
					$(".e_drop").hide();
					$(".p_drop").hide();
					$("#r1").prop('checked', false);
					$("#r2").prop('checked', false);
				});
			
			});
		</script>

    </body>
</html>