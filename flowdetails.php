<?php

class flowdetails
{
	private $flowdetailsid;
	private $flowid;
	private $sendto;
	private $countpos;
	private $comment;
	
	
	public function __construct($dbRow)
	{
		$this->flowdetailsid = $dbRow['flowdetailsid'];
		$this->flowid = $dbRow['flowid'];
		$this->sendto = $dbRow['sendto'];
		$this->countpos = $dbRow['countpos'];
		$this->comment = $dbRow['comment'];
	}
	
	public function getflowdetailsid()
	{
		return $this->flowdetailsid;
	}
	
	public function getflowid()
	{
		return $this->flowid;
	}
	
	public function getsendto()
	{
		return $this->sendto;
	}
	
	public function getcountpos()
	{
		return $this->countpos;
	}
	
	public function getcomment()
	{
		return $this->comment;
	}
}