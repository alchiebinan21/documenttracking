<?php

class user
{
	private $user_id;
	private $firstname;
	private $lastname;
	private $username;
	private $password;
	private $email;
	private $position;
	private $department;
	
	public function __construct($dbRow)
	{
		$this->user_id = $dbRow['user_id'];
		$this->firstname = $dbRow['firstname'];
		$this->lastname = $dbRow['lastname'];
		$this->username = $dbRow['username'];
		$this->password = $dbRow['password'];
		$this->email = $dbRow['email'];
		$this->position = $dbRow['position'];
		$this->department = $dbRow['department'];
	}
	
	public function getuser_id()
	{
		return $this->user_id;
	}
	
	public function getfirstname()
	{
		return $this->firstname;
	}
	
	public function getlastname()
	{
		return $this->lastname;
	}
	
	public function getusername()
	{
		return $this->username;
	}
	
	public function getpassword()
	{
		return $this->password;
	}
	
	public function getemail()
	{
		return $this->email;
	}
	public function getposition()
	{
		return $this->position;
	}
	public function getdepartment()
	{
		return $this->department;
	}
}