<?php

		
	
		function select_edoc_holder($userid)
		{
			$conn = new mysqli('localhost','root','usbw','docdb');
			
			$sql = "select * from e_doc where holder = '$userid' ";
			$result = $conn->query($sql);
			$resArr = array(); //create the result array

			while($data = $result->fetch_assoc())
			{ //loop the rows returned from db
			  $resArr[] = $data; //add row to array
			}
			return $resArr;   
    
		}
		
		function select_pdoc_holder($userid)
		{
			$conn = new mysqli('localhost','root','usbw','docdb');
			
			$sql = "select * from p_doc where holder = $userid";
			$result = $conn->query($sql);
			$resArr = array(); //create the result array

			while($data = $result->fetch_assoc())
			{ //loop the rows returned from db
			  $resArr[] = $data; //add row to array
			}
			return $resArr;   
    
		}
		
		function select_all_users()
		{
			$conn = new mysqli('localhost','root','usbw','docdb');
			
			$sql = "select * from user";
			$result = $conn->query($sql);
			$resArr = array(); //create the result array

			while($data = $result->fetch_assoc())
			{ //loop the rows returned from db
			  $resArr[] = $data; //add row to array
			}
			return $resArr;   
    
		}
		
		function insert_user($fn,$ln,$ur,$pw,$em,$pos,$dep)
		{
			$conn = new mysqli('localhost','root','usbw','docdb');
			
			$sql = "insert into user (firstname,lastname,username,password,email,position,department) values ('$fn','$ln','$ur','$pw','$em','$pos','$dep')";
			$conn->query($sql);
			
			return $conn;   
    
		}
		
		function select_sharedmem($userid)
		{
			$conn = new mysqli('localhost','root','usbw','docdb');
			
			$sql = "select * from sharedocs where sharedmem = '$userid'";
			$result = $conn->query($sql);
			$resArr = array(); //create the result array

			while($data = $result->fetch_assoc())
			{ //loop the rows returned from db
			  $resArr[] = $data; //add row to array
			}
			return $resArr;   
    
		}
		
		function select_specific_edoc($ed)
		{
			$conn = new mysqli('localhost','root','usbw','docdb');
			
			$sql = "select * from e_doc where ed_id = '$ed'";
			$result = $conn->query($sql);
			$resArr = array(); //create the result array

			while($data = $result->fetch_assoc())
			{ //loop the rows returned from db
			  $resArr[] = $data; //add row to array
			}
			return $resArr;   
    
		}
		
		function select_specific_pdoc($pd)
		{
			$conn = new mysqli('localhost','root','usbw','docdb');
			
			$sql = "select * from p_doc where pd_id = '$pd' ";
			$result = $conn->query($sql);
			$resArr = array(); //create the result array

			while($data = $result->fetch_assoc())
			{ //loop the rows returned from db
			  $resArr[] = $data; //add row to array
			}
			return $resArr;   
    
		}
		
		function select_pdoc_flow($flow)
		{
			$conn = new mysqli('localhost','root','usbw','docdb');
			
			$sql = "select * from p_doc where sento = '$flow'";
			$result = $conn->query($sql);
			$resArr = array(); //create the result array

			while($data = $result->fetch_assoc())
			{ //loop the rows returned from db
			  $resArr[] = $data; //add row to array
			}
			return $resArr;   
    
		}
		
		function select_all_pdocs()
		{
			$conn = new mysqli('localhost','root','usbw','docdb');
			
			$sql = "select * from p_doc";
			$result = $conn->query($sql);
			$resArr = array(); //create the result array

			while($data = $result->fetch_assoc())
			{ //loop the rows returned from db
			  $resArr[] = $data; //add row to array
			}
			return $resArr;   
    
		}
		
		function select_all_edocs()
		{
			$conn = new mysqli('localhost','root','usbw','docdb');
			
			$sql = "select * from e_doc";
			$result = $conn->query($sql);
			$resArr = array(); //create the result array

			while($data = $result->fetch_assoc())
			{ //loop the rows returned from db
			  $resArr[] = $data; //add row to array
			}
			return $resArr;   
    
		}
		
		function select_specific_user($userid)
		{
			$conn = new mysqli('localhost','root','usbw','docdb');
			
			$sql = "select * from user where user_id = '$userid'";
			$result = $conn->query($sql);
			$resArr = array(); //create the result array

			while($data = $result->fetch_assoc())
			{ //loop the rows returned from db
			  $resArr[] = $data; //add row to array
			}
			return $resArr;   
    
		}

		function insert_sharedmem($eid,$sm_id)
		{
			$conn = new mysqli('localhost','root','usbw','docdb');
			
			$sql = "insert into sharedocs (ed_id,sharedmem,receive_edoc,date) values ('$eid','$sm_id',false,now()) ";
			$conn->query($sql);
			
			return $conn;   
    
		}
		
		
		
		
		
		


?>