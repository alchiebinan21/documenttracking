<!DOCTYPE html>
<?php session_start();
require 'commands.php';	

$command = new Command();
$currentuser = $_SESSION['userid'];
$title = $_SESSION['title'];
$description = $_SESSION['description'];
$author = $_SESSION['author'];
$eid = $_SESSION['eid'];


	
	




if(isset($_GET['share']) && $_GET['share'] == 'Share') {
	

				$conn = new mysqli('localhost','root','usbw','docdb');
	
				//get the names of the members that the edocs will be shared to
				$holder = $_GET['fullname'];
				
				//put it in an array
				$arr = explode(' ',trim($holder,', '));
				

				print_r($arr);

				$length = count($arr);


						$comment = $_GET['comment'];


						//add it in history
						$command = new Command();

						$command->AddHistoryEdoc($currentuser,$eid,$comment,$holder,"Share");

			

				for ($i = 0; $i < $length; $i=$i+2) {
					

					$n =  $arr[$i];

					$l = $arr[$i+1];

					$l = trim($l,', ');

  					$sql = "select COUNT(*) as total from user where firstname = '$n' and lastname = '$l'";
				
					
					$res = $conn->query($sql);

					$data = $res->fetch_assoc();

					if($data['total'] > 0)
					{

						$sql = "select * from user where firstname = '$n' and lastname = '$l'";

						$res = $conn->query($sql);

						$data = $res->fetch_assoc();

						$sh_mem = $data['user_id'];




						$sql2 = "insert into sharedocs (ed_id,sharedmem,receive_edoc,date) values ('$eid','$sh_mem',false,now()) ";

						if($conn->query($sql2) == true)
						{
							echo "SUCCESS! SHARED!";
						}

					}
  					
					

				}

				

	}



 ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
		
		

        <div id="fadein" class="container">
		<h1>SHARE DOCUMENT </h1>
			<div class="row">
			
				<form method="get" action="share_edocs.php">
				 <label for="title" style="width: 7%;"><b>Title:</b></label>
				<input type="text" name="title" id="title" value="<?php echo $title;?>" style="width: 30%" disabled><br>
				
				 <label for="description" style="width: 7%;"><b>Description:</b></label>
				<input type="text" name="description" id="description" value="<?php echo $description;?>" style="width: 30%" disabled><br>
				
				 <label for="author" style="width: 7%;">Author:</label>
				<input type="text" name="author" id="author" value="<?php echo $author;?>" style="width: 30%" disabled><br>
				
				
				<label for="fullname" style="width: 7%;">Share to: </label>
				<input id="fullname" type="text" name="fullname" size="50" required>
				
				
				<br>
				<label for="comment" style="width: 7%;">Comment: </label>
				<input type="text" name="comment" id="comment" required><br>
				<input type="submit" name="share" style="background-color: blue;" value="Share" onclick = "return confirm('Are you sure to share the document?');" style="width: 20%; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px;">
				
				</form>
			
			<form method="post" action="edocs.php">
			
			<input type="submit" name="back" value="Back">
			
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
    width: 20%;
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
		
		<!-- JQUERY FOR MULTIPLE RECIPIENTS -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		<!-- Autocomplete Multiple Values -->
		<script>
		$(function() {
			function split( val ) {
				return val.split( /,\s*/ );
			}
			function extractLast( term ) {
				return split( term ).pop();
			}
			
			$( "#fullname" ).bind( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB &&
					$( this ).autocomplete( "instance" ).menu.active ) {
					event.preventDefault();
				}
			})
			.autocomplete({
				minLength: 1,
				source: function( request, response ) {
					// delegate back to autocomplete, but extract the last term
					$.getJSON("autocomplete.php", { term : extractLast( request.term )},response);
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					var terms = split( this.value );
					// remove the current input
					terms.pop();
					// add the selected item
					terms.push( ui.item.value );
					// add placeholder to get the comma-and-space at the end
					terms.push( "" );
					this.value = terms.join( ", " );
					return false;
				}
			});
		});
		</script>
		
		

    </body>
</html>