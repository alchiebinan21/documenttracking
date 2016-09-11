<?php

class flow
{
	private $flowid;
	private $creatorid;
	private $title;
	
	
	public function __construct($dbRow)
	{
		$this->flowid = $dbRow['flowid'];
		$this->creatorid = $dbRow['creatorid'];
		$this->title = $dbRow['title'];
	}
	
	public function getflowid()
	{
		return $this->flowid;
	}
	
	public function getcreatorid()
	{
		return $this->creatorid;
	}
	
	public function gettitle()
	{
		return $this->title;
	}

}