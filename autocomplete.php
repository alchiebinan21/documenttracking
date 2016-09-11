<?php
    
    session_start();
	$conn = new mysqli('localhost','root','usbw','docdb');
	
	$sql = "select * from user";
	
	$res = $conn->query($sql);
	
	while($data = $res->fetch_assoc())
	{
		if($_SESSION['userid'] == $data['user_id'])
		{

		}
		else
		{
			$arr[] = $data['firstname']." ".$data['lastname'];
			
		}
		
		
	}
	
	
    echo json_encode($arr);
	
?>