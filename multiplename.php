<?php

	if(isset($_POST['share']) && $_POST['share'] == 'share')
		{
			$fname = $_POST['fname'];
			
			
			$conn = new mysqli('localhost','root','usbw','docdb');
			
			$sql = "UPDATE user SET username = '$fname' where user_id = 4  ";
			
			if($conn->query($sql) == true)
			{
				echo "success!";
			}
			
			
		}



?>