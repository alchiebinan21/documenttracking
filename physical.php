<?php

class pdoc
{
	private $pd_id;
	private $title;
	private $description;
	private $author;
	private $holder;
	private $image;
	private $qrcode;
	private $unique_id;
	private $flow;
	private $count;
	private $received;
	private $sent;
	private $flowsent;

	
	public function __construct($dbRow)
	{
		$this->pd_id = $dbRow['pd_id'];
		$this->title = $dbRow['title'];
		$this->description = $dbRow['description'];
		$this->author = $dbRow['author'];
		$this->image = $dbRow['image'];
		$this->qrcode = $dbRow['qrcode'];
		$this->unique_id = $dbRow['unique_id'];
		$this->flow = $dbRow['flow'];
		$this->count = $dbRow['count'];
		$this->received = $dbRow['received'];
		$this->sent = $dbRow['sent'];
		$this->flowsent = $dbRow['flowsent'];

	}
	
	public function getpd_id()
	{
		return $this->pd_id;
	}
	
	public function gettitle()
	{
		return $this->title;
	}
	
	public function getdescription()
	{
		return $this->description;
	}
	
	public function getauthor()
	{
		return $this->author;
	}
	
	public function getimage()
	{
		return $this->image;
	}
	
	public function getqrcode()
	{
		return $this->qrcode;
	}
	public function getunique_id()
	{
		return $this->unique_id;
	}
	public function getflow()
	{
		return $this->flow;
	}
	public function getcount()
	{
		return $this->count;
	}
	public function getreceived()
	{
		return $this->received;
	}
	public function getsent()
	{
		return $this->sent;
	}
	public function getflowsent()
	{
		return $this->flowsent;
	}
	
}