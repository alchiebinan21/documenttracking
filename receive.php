<!DOCTYPE html>
<?php session_start();
include_once('commands.php');
include "query_functions.php";
$_SESSION['back'] = "receive";
$userid = $_SESSION['userid'];

$command = new Command();
$user = $command->getuser($userid);
$first = $user->getfirstname();
$last = $user->getlastname();
echo $flname = $first." ".$last;


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
        			echo "<script>window.location='page-login.php';</script>";
        		} 

        ?>
		

        <div id="fadein" class="container">
		<h1>RECEIVED DOCUMENTS</h1>
			<div class="row">
			<br>
			<label for="title" style="width: 20%">Title</label> <label for="description" style="width: 20%;">Description</label> <label for="author">Author</label>
				<?php 
				
					$counter = 0;
				
					$result = select_pdoc_flow($flname);
					
					
					foreach($result as $data)
					{
						$counter++;
				
				?>
				<form method="post" action="p_view.php">
				<input type="hidden" name="pid" value="<?php echo $data['pd_id'] ?>" readonly>
				<input type="text" name="title" value = '<?php echo $data['title'] ?>' readonly>
				<input type="text" name="description" value = '<?php echo $data['description'] ?>' readonly>
				<input type="text" name="author" value = '<?php echo $data['author'] ?>' readonly>
				<input type="submit" name="view" style="background-color: maroon;" value="View">
				<input type="submit" class="btnmod" name="receive" value="Receive">
				</form>
				<?php 
				
				} 
				
				if($counter <= 0)
				{
					
					echo "<br><br><br><br><br>";
					echo "<font size='4'><i>NO DOCUMENT/S AVAILABLE!</i></font>";
					
					
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