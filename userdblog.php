<!DOCTYPE html>
<?php session_start(); 
include "query_functions.php";
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
		<br>
		<br>
		

        <?php if(!isset($_SESSION['access']))
        		{
        			//if not logged on, user will be directed to the page login
        			echo "<script>window.location='page-login.php';</script>";
        		} 

        ?>
	
  <table id="fadein">
  
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Position</th>
  </tr>
  
  <!-- call users from database and display it on table-->
  <?php 

		$result = select_all_users();
		
		
  	
  		foreach($result as $data)
			{
				$fn = $data['firstname']." ".$data['lastname'];

   ?>

   <tr>
    <form method="post" action=" edit_user.php">
		<input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
		<td><?php echo $fn; ?></td>
		<td><?php echo $data['email']; ?></td>
		<td><?php echo $data['position'] ?></td>
		<td><input type="submit" name="submit" style="width: 100px;" value="edit"></td>
		<td><input type="submit" name="submit" style="background-color: red;" value="remove"></td>
	</form>
   </tr>

	<?php } ?>
  
</table>

		
		
		
		
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

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
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