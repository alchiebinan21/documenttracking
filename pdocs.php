<!DOCTYPE html>
<?php session_start();
include "query_functions.php";
$_SESSION['back'] = "pdocs";

$userid = $_SESSION['userid'];
$_POST['viewpdocs'] = 'View my Physical Docs';
 ?>
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
		<h1>MY PHYSICAL DOCUMENTS WITH QR CODE</h1>
		<br>
		<a href="myfiles.php" class="btn">Previous Page</a>
		<br><br>
		<i style="color: black;">This page lets you view or send the physical document.<br> click <b>"VIEW" BUTTON</b> to view the physical document details.<br> click <b>"DIRECT SEND" BUTTON</b> to send it directly to a person without a flow.<br> click <b>"SEND BACK" BUTTON</b> to directly send it back to the first holder.</i>
			<div class="row">
			<br>
			<label for="title" style="width: 20%">TITLE</label> <label for="description" style="width: 20%;">DESCRIPTION</label> <label for="author">AUTHOR</label>
			
				<?php if(isset($_POST['viewpdocs']) && $_POST['viewpdocs'] == 'View my Physical Docs' || isset($_POST['back']) && $_GET['back'] == 'Back' ) 
				
				{ 

					$counter = 0;
					
					
					$result = select_pdoc_holder($userid);
					
						
						foreach($result as $data)
						{
							$counter++;
			
				?>
				
				<form method="post" action="p_view.php">
				<input type="hidden" name="comment" id="comment" value="test" required>
				<input type="hidden" name="sendb" id="sendb" value="">
				
				<input type="hidden" name="pid" value="<?php echo $data['pd_id'] ?>" readonly>
				<input type="text" name="title" value = '<?php echo $data['title'] ?>' readonly>
				<input type="text" name="description" value = '<?php echo $data['description'] ?>' readonly>
				<input type="text" name="author" value = '<?php echo $data['author'] ?>' readonly>
				<input type="submit" name="view" style="background-color: maroon;" value="View">
				<?php if($data['sent'] ==  1) 
				{
					?>
				<input type="submit" class="btnmod" name="cancel" value="Cancel Send" onClick="getInput();">
				<?php 
				}
				else{
				?>
				<input type="submit" class="btnmod" name="send" value="Direct Send">
				<?php 
				}?>

				<?php 

						$pid = $data['pd_id'];

						$conn = new mysqli('localhost','root','usbw','docdb');

						$sql = "select * from history where pd_id = '$pid'";

						$res = $conn->query($sql);

						$data = $res->fetch_assoc();

						if($data['type'] == 'Send')
						{
				 ?>
				<input type="submit" class="btnmod" name="send_back" value="Send Back" onClick="getInputSendBack();" style="background-color: grey;">

				<?php } ?>
				
				</form>
				
				
				
				
				
				<?php 
				
					 } 
					 
					 if($counter <= 0)
					 {
						 
						 echo "<br><br><br><br><br>";
						 echo "<font size='4'><i>NO DOCUMENT/S AVAILABLE! WANT TO CREATE QR CODE FOR PHYSICAL DOCUMENT?</i></font>&nbsp;";
						 echo "<a href='p_createqr.php'>click me :)</a>";
					 }
				
				}
				
				?>
			
			
			
			
			</div>
		</div>
		
		
		
	<style>
input[type=text], select {
    width: 20%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 10%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btnmod
{
	 width: 10%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.btnmod:hover
{
	background-color: #45a049;
}

input[type=submit]:hover {
    background-color: #45a049;
}


</style>
		
				
<script>
	function getInput()
	{
		answer = confirm('Are you sure to cancel Sending?');
		if(answer)
		{
		value = prompt('Comment?');
		$('#comment').val(value);
		}
		else
		{
			return false;
		}

		
		
	}
	
	function getInputSendBack()
	{
		answer = confirm('Do you want to send it back directly?');
		if(answer)
		{
		value = prompt('Comment?');
		$('#comment').val(value);
		}
		else
		{
			return false;
		}


	}

</script>

	    

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