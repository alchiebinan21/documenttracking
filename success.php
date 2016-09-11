<?php

session_start();
include "query_functions.php";


//P-VIEW//
if(isset($_GET['back']) && $_GET['back'] == 'Back')
{
	header("Location: pdocs.php");
}

if(isset($_GET['back']) && $_SESSION['back'] == 'receive')
{
	header("Location: receive.php");
}

if(isset($_GET['view']) && $_GET['view'] == 'View History')
{
	header("Location: viewhistory.php");
}

//PvIEW

//E-VIEW//
if(isset($_GET['back_edoc']) && $_GET['back_edoc'] == 'Back')
{
	header("Location: edocs.php");
}

if(isset($_GET['back_edoc']) && $_SESSION['back_edoc'] == 'receive')
{
	header("Location: e_receive.php");
}

if(isset($_GET['view_edoc']) && $_GET['view_edoc'] == 'View History')
{
	header("Location: viewhistory.php");
}

//EvIEW

	//login connection from page-login.php
	if(isset($_POST['login']) && $_POST['login'] == 'Login')
	{
		
		
		$nm = $_POST['user'];
		$pw = $_POST['password'];
		
		
		$cnt = 0;
		$fn = "";
		$ln = "";
		$em = "";
		$pos = "";
		$jej = "";
		$userid = "";
		
		
		//get all data of users
		$result = select_all_users();
		
		foreach($result as $data)
		{
			if($data['username'] == $nm && $data['password'] == $pw)
			{
				$fn = $data['firstname'];
				$ln = $data['lastname'];
				$em = $data['email'];
				$pos = $data['position'];
				$userid = $data['user_id'];
				$_SESSION['userid'] = $userid;
				$cnt++;
			}
			
			
		}
		
		//if credentails are correct
		if($cnt > 0)
		{
			$_SESSION['access'] = true;
			$_SESSION['time'] = time();
			$_SESSION['email'] = $em;
			$_SESSION['position'] = $pos;
			$_SESSION['userid'] = $userid;
			$_SESSION['name'] = $fn . " " . $ln;
			echo "<script> window.location='index.php';</script>";
			
			
		}
		
		//if wrong credentials
		else
		{
			$_SESSION['logaccess'] = true;
			$_SESSION['logtime'] = time();
			$_SESSION['incpass'] = true;
			echo "<script> window.location='page-login.php'; </script>";
		}
		
		
		
	}
	
	//create account for possible users of the system
	elseif(isset($_POST['submit']) && $_POST['submit'] == 'Register')
	{
		
		$fn = $_POST['fn'];
		$ln = $_POST['ln'];
		$pos = $_POST['position'];
		$ur = $_POST['un'];
		$em = $_POST['email'];
		$pw = $_POST['password'];
		$repw = $_POST['repassword'];
		$dep = $_POST['department'];
		$dup = 0;
		
		
		//$pw = md5($pw);

		if($pw != $repw)
		{
			$_SESSION['reenterpass'] = true;
			echo "<script>window.location='page-register.php';</script>";
			break;
		}

		//get all data of users
		$result = select_all_users();

		//data validation if there is existing
		foreach($result as $data)
		{
			if($data['username'] == $ur || ($data['firstname'] == $fn && $data['lastname'] == $ln) || $data['email'] == $em)
			{
				$dup++;
				
			}


		}

		if($dup > 0)
		{
			$_SESSION['duplicatedata'] = true;
			echo "<script>window.location='page-register.php';</script>";
		}
		
		//if no duplicate data
		else
		{
				
			$result = insert_user($fn,$ln,$ur,$pw,$em,$pos,$dep);
		
			if($result == true)
			{
				$_SESSION['accountcreated'] = true;
				echo "<script>window.location='page-register.php'; </script>";
			}

			else
			{
				echo "<script>alert('Error Registration!'); window.location='page-register.php';</script>";
			}
		}
		
		
	}
	
	//logout 
	elseif(isset($_POST['lo']) && $_POST['lo'] == 'Logout')
	{
		$_SESSION = array();
		session_destroy();
		echo "<script>window.location='index.php';</script>";
	}
	
	
	//generate qr code for physical document
	elseif(isset($_POST['p_generateqr']) && $_POST['p_generateqr'] == 'Create')
	{
	
		$conn = new mysqli('localhost', 'root', 'usbw', 'docdb');
		
		include('phpqrcode/qrlib.php'); 
	
		$title = $_POST['title'];
		$author = $_POST['author'];
		$desc = $_POST['description'];
		$date = $_POST['date'];
		$un = $_POST['un'];
		$received = 0;
		
		
		if(isset($_POST['radio_none']))
		{
			$src = $_POST['radio_none'];
		}
		
		elseif(isset($_POST['radio_pdoc']))
		{
			$src = $_POST['list_pdoc'];
		}
		
		elseif(isset($_POST['radio_edoc']))
		{
			$src = $_POST['list_edoc'];
		}
		
		$im = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
		
		$sql = "insert into p_doc (title, description, author, image, date, holder, received, source_file) values ('$title', '$desc', '$author', '$im', '$date', '$un', '$received','$src')";
		
		if($conn->query($sql) == true)
		{
			$sql = "select pd_id from p_doc where title = '$title' ";
			
			$res = $conn->query($sql);
			
			$data = $res->fetch_assoc();
			
			$pId = $data['pd_id'];
			
			$unique = $pId."_".$title;
			
			$filename = $unique.".png";
			
			// creation of qr code
			QRcode::png($unique, 'qrpics/'.$filename);

			$fn = addslashes(file_get_contents('qrpics/'.$filename));
			
			$sql = "Update p_doc set unique_id = '$unique', qrcode = '$fn' where pd_id = '$pId'";
			
			if($conn->query($sql) == true)
			{
				$_SESSION['gpdoc'] = true;
				echo "<script> window.location='p_createqr.php'</script>";
			}
			
			else
			{
				$_SESSION['fpdoc'] = true;
				echo "<script>window.location='p_createqr.php'</script>";
			}
			
			
		}
		
		else
		{
			echo "<script>alert('query failed'); window.location='p_createqr.php'</script>";
		}
		
		
		
	}




	//generate  qr code for electronic document
	elseif(isset($_POST['e_generateqr']) && $_POST['e_generateqr'] == 'Create')
	{
	
		$conn = new mysqli('localhost', 'root', 'usbw', 'docdb');
		
		include('phpqrcode/qrlib.php');
		require ('fpdf/fpdf.php');
		require_once('fpdi/fpdi.php');		
		
		$pdf = new FPDI();
	
		$title = $_POST['title'];
		$author = $_POST['author'];
		$desc = $_POST['description'];
		$date = $_POST['date'];
		$un = $_POST['un'];
		
		if(isset($_POST['radio_none']))
		{
			$src = $_POST['radio_none'];
		}
		
		elseif(isset($_POST['radio_pdoc']))
		{
			$src = $_POST['list_pdoc'];
		}
		
		elseif(isset($_POST['radio_edoc']))
		{
			$src = $_POST['list_edoc'];
		}
		
		//copy and move file to pdf folder------------------------------------------------------------------------------
		if (file_exists("/files/".$_FILES["fileToUpload"]["name"]))
		{
		echo $_FILES["file"]["name"] . " already exists. No joke-- this error is almost <i><b>impossible</b></i> to get. Try again, I bet 1 million dollars it won't ever happen again.";
		}
		else
		{
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"pdf/".$_FILES["fileToUpload"]["name"]);
		}
		//--------------------------------------------------------------------------------------------------------------

		$filepdf = $_FILES["fileToUpload"]["name"];
		
		//Make the pdf as a template-----------------------------
		$pdf->setSourceFile("pdf/$filepdf");
		$pagecount = $pdf->setSourceFile("pdf/$filepdf");
		//-------------------------------------------------------
		
		
		//$pdf = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
		
		$sql = "insert into e_doc (title, description, author, date, holder, source_file) values ('$title', '$desc', '$author', '$date', '$un','$src')";
		
		if($conn->query($sql) == true)
		{
			$sql = "select ed_id from e_doc where title = '$title' ";
			
			$res = $conn->query($sql);
			
			$data = $res->fetch_assoc();
			
			$eId = $data['ed_id'];
			
			$unique = $eId."_".$title;
			
			$filename = $unique.".png";
			
			// creation of qr code
			QRcode::png($unique, 'qrpics/'.$filename);

			$fn = addslashes(file_get_contents('qrpics/'.$filename));
			
			//insert qr code on the pdf-------------------------------------------------------------------------------------
			for($x = 1; $x <= $pagecount; $x++)
			{
			$tplIdx = $pdf->importPage($x);
			$pdf->addPage();
			$pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
			if ($x == 1)
			{
				$pdf->Image("qrpics/$filename",180,0,25);
			}
		
			
			}
		
			$file = $pdf->Output("$filename", "S");
			
			$file = addslashes($file);
			//-------------------------------------------------------------------------------------------------------------
			
			$sql = "Update e_doc set unique_id = '$unique', qrcode = '$fn', pdf = '$file' where ed_id = '$eId'";
			
			if($conn->query($sql) == true)
			{
				$_SESSION['gedoc'] = true;
				echo "<script>window.location='e_createqr.php'</script>";
			}
			
			else
			{
				$_SESSION['fedoc'] = true;
				echo "<script>window.location='e_createqr.php'</script>";
			}
			
			
		}
		
		else
		{
			echo "<script>alert('query failed'); window.location='e_createqr.php'</script>";
		}
		
		
		
	}
	
	//display pdf from blob
	elseif(isset($_POST['readpdf']) && $_POST['readpdf'] == 'View PDF')
	{
		$conn = new mysqli('localhost','root','usbw','docdb');
		$id = $_POST['id'];
		$title = $_POST['title'];
		$sql = "select pdf from e_doc where ed_id = $id";
  
		$res =  $conn->query($sql);
  
		$data = $res->fetch_assoc();
  
		$file  = $data['pdf'];
  
		header("Content-type: application/pdf");
		header("Cache-Control: no-cache");
		header("Pragma: no-cache");
		header("Content-disposition: inline; filename='$title.pdf'");
		header("Content-length: ".strlen($file));
		echo $file;
		
	}
	

?>

