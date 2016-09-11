<?php
require('user.php');
require('connection.php');
require('flowobj.php');
require('flowdetails.php');
require('physical.php');
require('history.php');
class Command{
	
	private $db;
	
	public function __construct(){
		$this->db = new Connection();
		$this->db = $this->db->dbConnect();
	}


	
	
	public function AddEvent($title,$description){
			$st = $this->db->prepare("INSERT INTO `event`(name, description) VALUES (?,?)");
			$st->bindParam(1,$title);
			$st->bindParam(2,$description);
			$st->execute();

	}
	
	public function AddHistory($userid,$pid,$comment,$sendto,$type){
			$st = $this->db->prepare("insert into history(sender,pd_id,comment,date,sendto,type) values (?,?,?,now(),?,?)");
			$st->bindParam(1,$userid);
			$st->bindParam(2,$pid);
			$st->bindParam(3,$comment);
			$st->bindParam(4,$sendto);
			$st->bindParam(5,$type);
			$st->execute();

			 print_r($st->errorInfo());
	}
	
	public function AddHistoryWithFlow($userid,$pid,$comment,$sendto,$type,$flow){
			$st = $this->db->prepare("insert into history(sender,pd_id,comment,date,sendto,type,flow) values (?,?,?,now(),?,?,?)");
			$st->bindParam(1,$userid);
			$st->bindParam(2,$pid);
			$st->bindParam(3,$comment);
			$st->bindParam(4,$sendto);
			$st->bindParam(5,$type);
			$st->bindParam(6,$flow);
			$st->execute();

			 print_r($st->errorInfo());
	}

	public function AddHistoryEdoc($userid,$eid,$comment,$sendto,$type){
			$st = $this->db->prepare("insert into history(sender,ed_id,comment,date,sendto,type) values (?,?,?,now(),?,?)");
			$st->bindParam(1,$userid);
			$st->bindParam(2,$eid);
			$st->bindParam(3,$comment);
			$st->bindParam(4,$sendto);
			$st->bindParam(5,$type);
			$st->execute();

			 print_r($st->errorInfo());
	}
	
	public function AddFlow($creatorid,$title){
			$st = $this->db->prepare("INSERT INTO flow(creatorid,title) VALUES (?,?)");
			$st->bindParam(1,$creatorid);
			$st->bindParam(2,$title);
			$st->execute();
			 print_r($st->errorInfo());
	}
	
	public function AddFlowDetails($flowid,$sendto,$countpos,$comment){
			$st = $this->db->prepare("INSERT INTO flowdetails(flowid,sendto,countpos,comment) VALUES (?,?,?,?)");
			$st->bindParam(1,$flowid);
			$st->bindParam(2,$sendto);
			$st->bindParam(3,$countpos);
			$st->bindParam(4,$comment);
			$st->execute();
			 print_r($st->errorInfo());
	}
	
	public function send($sento, $received, $sent,$pd_id)
	{
		$st = $this->db->prepare("Update p_doc SET sento = ?,received = ?, sent = ? where pd_id = ?");
		$st->bindParam(1,$sento);
		$st->bindParam(2,$received);
		$st->bindParam(3,$sent);
		$st->bindParam(4,$pd_id);
		$st->execute();
		
		print_r($st->errorInfo());
	}
	
	public function sendbyflow($sento, $received, $sent,$pd_id)
	{
		$st = $this->db->prepare("Update p_doc SET sento = ?,received = ?, sent = ? ,flowsent = 1 where pd_id = ?");
		$st->bindParam(1,$sento);
		$st->bindParam(2,$received);
		$st->bindParam(3,$sent);
		$st->bindParam(4,$pd_id);
		$st->execute();
		
		print_r($st->errorInfo());
	}
	
	public function sendback($sento, $received, $sent,$pd_id)
	{
		$st = $this->db->prepare("Update p_doc SET sento = ?,received = ?, sent = ? ,flowsent = -1 where pd_id = ?");
		$st->bindParam(1,$sento);
		$st->bindParam(2,$received);
		$st->bindParam(3,$sent);
		$st->bindParam(4,$pd_id);
		$st->execute();
		
		print_r($st->errorInfo());
	}
	
	
	
	public function receive($id,$sento, $received, $sent,$pd_id)
	{
		$st = $this->db->prepare("Update p_doc SET holder = ?,sento = ?,received = ?, sent = ? where pd_id = ?");
		$st->bindParam(1,$id);
		$st->bindParam(2,$sento);
		$st->bindParam(3,$received);
		$st->bindParam(4,$sent);
		$st->bindParam(5,$pd_id);
		$st->execute();
		
		print_r($st->errorInfo());
	}
	
	public function receivebyflow($id,$sento, $received, $sent, $count, $pd_id)
	{
		$st = $this->db->prepare("Update p_doc SET holder = ?,sento = ?,received = ?, sent = ? ,count = ?, flowsent = 0 where pd_id = ?");
		$st->bindParam(1,$id);
		$st->bindParam(2,$sento);
		$st->bindParam(3,$received);
		$st->bindParam(4,$sent);
		$st->bindParam(5,$count);
		$st->bindParam(6,$pd_id);
		$st->execute();
		
		print_r($st->errorInfo());
	}
	
	public function changeFlow($flow,$pid)
	{
		$st = $this->db->prepare("Update p_doc SET flow = ?,count = 0 where pd_id = ?");
		$st->bindParam(1,$flow);
		$st->bindParam(2,$pid);
		$st->execute();
		
		print_r($st->errorInfo());
	}
	
	
	public function viewdata(){
		
		$st = $this->db->prepare("select * from user");
		$st->execute();
		while ($f = $st->fetch())
		{
			$dataSet[] = new user($f);
		}
		
		if(!empty($dataSet))
			return $dataSet;
		
		else
			return null;
	}
	
	public function viewdatadept($dept){
		
		$st = $this->db->prepare("select * from user where department = ?");
		$st->bindParam(1,$dept);
		$st->execute();
		while ($f = $st->fetch())
		{
			$dataSet[] = new user($f);
		}
		
		if(!empty($dataSet))
			return $dataSet;
		
		else
			return null;
	}
	
	
	
	public function getuser($id)
	{
		$st = $this->db->prepare("SELECT * from user where user_id = ?");
		$st->bindParam(1,$id);
		$st->execute();
		$f = $st->fetch();
		$data = new user($f);
		if(!empty($data))
			return $data;
		else
			return null;

	}
	
	public function getflow($title)
	{
		$st = $this->db->prepare("SELECT * from flow where title = ?");
		$st->bindParam(1,$title);
		$st->execute();
		$f = $st->fetch();
		$data = new flow($f);
		if(!empty($data))
			return $data;
		else
			return null;

	}
	
	public function getflowtitle($fid)
	{
		$st = $this->db->prepare("SELECT * from flow where flowid = ?");
		$st->bindParam(1,$fid);
		$st->execute();
		$f = $st->fetch();
		$data = new flow($f);
		if(!empty($data))
			return $data;
		else
			return null;

	}
	
	public function getflowdetails($fid,$countpos)
	{
		$st = $this->db->prepare("SELECT * from flowdetails where flowid = ? and countpos = ?");
		$st->bindParam(1,$fid);
		$st->bindParam(2,$countpos);
		$st->execute();
		$f = $st->fetch();
		$data = new flowdetails($f);
		if(!empty($data))
			return $data;
		else
			return null;

	}
	
	public function countflowdetails($fid)
	{
		$st = $this->db->prepare("SELECT * from flowdetails where flowid = ?");
		$st->bindParam(1,$fid);
		$st->execute();
		while ($f = $st->fetch())
		{
			$dataSet[] = new flowdetails($f);
		}
		
		if(!empty($dataSet))
			return $dataSet;
		else
			return null;
		print_r($st->errorInfo());
	}
	
	public function getallflows($userid)
	{
		$st = $this->db->prepare("SELECT * from flow where creatorid = ?");
		$st->bindParam(1,$userid);
		$st->execute();
		while ($f = $st->fetch())
		{
			$dataSet[] = new flow($f);
		}
		
		if(!empty($dataSet))
			return $dataSet;
		else
			return null;
		print_r($st->errorInfo());
	}
	
	public function getHistory($pid)
	{
		$st = $this->db->prepare("SELECT * from history where pd_id = ? order by date DESC");
		$st->bindParam(1,$pid);
		$st->execute();
		while ($f = $st->fetch())
		{
			$dataSet[] = new history($f);
		}
		
		if(!empty($dataSet))
			return $dataSet;
		else
			return null;
		print_r($st->errorInfo());
	}

	public function getHistoryEdoc($eid)
	{
		$st = $this->db->prepare("SELECT * from history where ed_id = ? order by date DESC");
		$st->bindParam(1,$eid);
		$st->execute();
		while ($f = $st->fetch())
		{
			$dataSet[] = new history($f);
		}
		
		if(!empty($dataSet))
			return $dataSet;
		else
			return null;
		print_r($st->errorInfo());
	}
	
	
	
	public function getuserName($first,$last)
	{
		$st = $this->db->prepare("SELECT * from user where firstname = ? and lastname = ?");
		$st->bindParam(1,$first);
		$st->bindParam(2,$last);
		$st->execute();
		$f = $st->fetch();
		$data = new user($f);
		if(!empty($data))
			return $data;
		else
			return null;
	}
	
	public function getpdoc($pid)
	{
		$st = $this->db->prepare("SELECT * from p_doc where pd_id = ?");
		$st->bindParam(1,$pid);
		$st->execute();
		$f = $st->fetch();
		$data = new pdoc($f);
		if(!empty($data))
			return $data;
		else
			return null;
	}
	
	public function deleteFlow($fid){
		
		$st = $this->db->prepare("DELETE FROM flow WHERE flowid = ?");
		$st->bindParam(1,$fid);
		$st->execute();
		
	}
	
	public function notif($msg,$user_id,$rec,$rmsg,$phy,$elect)
	{
		$st = $this->db->prepare("INSERT INTO notification (message, date, user_id, recepient, readmsg, physical, electronic) VALUES (?,now(),?,?,?,?,?)");
		$st->bindParam(1,$msg);
		$st->bindParam(2,$user_id);
		$st->bindParam(3,$rec);
		$st->bindParam(4,$rmsg);
		$st->bindParam(5,$phy);
		$st->bindParam(6,$elect);
		$st->execute();
		print_r($st->errorInfo());
	}
	
	public function e_receive($rec_edoc, $sh)
	{
		$st = $this->db->prepare("Update sharedocs SET receive_edoc = ? where sharedmem = ? ");
		$st->bindParam(1,$rec_edoc);
		$st->bindParam(2,$sh);
		$st->execute();
		
		print_r($st->errorInfo());
	}
	
	public function e_share($holder, $received, $share,$ed_id)
	{
		$st = $this->db->prepare("Update e_doc SET holder = ?,received = ?, share = ? where ed_id = ?");
		$st->bindParam(1,$holder);
		$st->bindParam(2,$received);
		$st->bindParam(3,$share);
		$st->bindParam(4,$ed_id);
		$st->execute();
		
		print_r($st->errorInfo());
	}
	
	
}








?>