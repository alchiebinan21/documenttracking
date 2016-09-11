<!DOCTYPE html>
<?php session_start();
$_SESSION['back'] = "pdocs";

if(isset($_POST['delete']) && $_POST['delete'] == 'Delete')
{
	echo "wa";
}


$userid = $_SESSION['userid'];
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
		

        <div class="container">
		<h3>VIEW FLOW</h3>
			<div class="row">
			<br>
			<label for="title" style="width: 50%">Title</label> 
			
				<?php 
				

					//$userid = $_SESSION['userid'];
				
					$conn = new mysqli('localhost', 'root', 'usbw', 'docdb');
					
					/*if(isset($_SESSION['position']) && $_SESSION['position'] == 'Admin' || $_SESSION['position'] == 'Developer')
					{
						$sql = "select * from p_doc where user_id";
					}
					else
					{
						$sql = "select * from p_doc where user_id = '$userid' ";
					}
					*/
					
					$sql = "select * from flow where creatorid = $userid";
					
					$res = $conn->query($sql);
					
					while ($data = $res->fetch_assoc())
					{
				
				
				?>
				
				<form method="get" action="f_view.php">
				<input type="hidden" name="fid" value="<?php echo $data['flowid'] ?>" readonly>
				<input type="text" name="title" style="width: 40%" value = '<?php echo $data['title'] ?>' readonly>
				<input type="submit" name="view" value="View">
				
				<a onclick="EditFlow(<?php echo $data['flowid'];?>)"; class="btn" style="width: 10%; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; background-color: blue;">Edit</a>

				<a onclick="confirmDeleteFlow(<?php echo $data['flowid'];?>)"; class="btn" style="width: 10%; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; background-color: orange;">Delete</a>
				<br>
				</form>
				<?php 
				
					 } 
				
				
				
				?>
			
			<a href="flows.php" class="btn" style="width: 20%; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;">Back</a>
			
			
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
		function confirmDeleteFlow(flow) {
		answer = confirm('Are you sure to Delete this flow?');
		if(answer){
			location.href = "deleteflow.php?fid="+flow;
		} else {
			return;
			}
		}
		</script>
		
		<script>
		function EditFlow(flow) {
			location.href = "editflow.php?fid="+flow;
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

