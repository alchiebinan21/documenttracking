<?php

	$conn = new mysqli('localhost','root','usbw','docdb');

					
	$sql = "select * from e_doc where ed_id = (select ed_id from sharedocs where sharedmem = 2)";
					
	$res = $conn->query($sql);

	$data = $res->fetch_assoc();

	echo $data['ed_id'];


?>