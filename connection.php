<?php

class Connection
{

	public function dbConnect(){
		return new PDO("mysql:host=localhost:3307;dbname=docdb", "root", "usbw");
	}
	
}
?>