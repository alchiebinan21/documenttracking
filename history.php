<?php

class history
{
	private $historyid;
	private $sender;
	private $pd_id;
	private $comment;
	private $date;
	private $sendto;
	private $type;
	private $flow;

	public function __construct($dbRow)
	{
		$this->historyid = $dbRow['historyid'];
		$this->pd_id = $dbRow['pd_id'];
		$this->comment = $dbRow['comment'];
		$this->date = $dbRow['date'];
		$this->sender = $dbRow['sender'];
		$this->sendto = $dbRow['sendto'];
		$this->type = $dbRow['type'];
		$this->flow = $dbRow['flow'];
		
	}
	
	public function gethistoryid()
	{
		return $this->historyid;
	}
	
	public function getsender()
	{
		return $this->sender;
	}
	
	public function getpd_id()
	{
		return $this->pd_id;
	}
	
	public function getcomment()
	{
		return $this->comment;
	}
	
	public function getdate()
	{
		return $this->date;
	}

	public function getsendto()
	{
		return $this->sendto;
	}
	public function gettype()
	{
		return $this->type;
	}
	public function getflow()
	{
		return $this->flow;
	}
	
}