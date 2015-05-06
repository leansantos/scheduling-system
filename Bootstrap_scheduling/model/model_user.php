<?php 

class User {
	private $username;
	private $password;
	private $type;
	private $description;
	
	public function __construct()
	{
		$this->db = mysqli_connect('localhost', 'root', '', 'scheduling_system');
	}

//authentication of user === controller_homepage.php
	public function authenticateUser($var)
	{
		$this->username = $var['uname'];
		$this->password = $var['pword'];
	

		$query = mysqli_query($this->db, "SELECT * FROM user WHERE username='$this->username' and password='$this->password' ") or die (mysql_error());
		$data = mysqli_fetch_object($query);
		if(mysqli_num_rows($query) == 1){
			return $data;
		}
		return null;
	}
//view all user ===	 controller_usermanagement.php
	public function viewUser()
	{
		$query =  mysqli_query($this->db, "SELECT * FROM `user`");
		while($row = mysqli_fetch_assoc($query)){
			$data[] =$row;
		}
			if (!empty($data)){
			return $data;
		}
	}
//select delete user === controller_usermanagement.php
	public function viewDelete($get,$route)
	{
		$id = $get[$route];
		$query =  mysqli_query($this->db, "SELECT * FROM `user` WHERE user_id = '$id' ");
		return $row = mysqli_fetch_assoc($query);
	}
//delete User === controller_usermanagement.php
	public function deleteUser($get)
	{
		$id = $get['del'];
		$query = mysqli_query($this->db, "DELETE FROM `user` WHERE user_id=$id");
		return $delete = mysqli_query($query);
	}
//authentication username === controllermanagement.php
	public function authUsername($post)
	{
		$this->username = $post['username'];
		$query = mysqli_query($this->db, "SELECT * FROM user WHERE username='$this->username' ") or die (mysql_error());
		$data = mysqli_fetch_object($query);
		if(mysqli_num_rows($query) == 1){
			return $data;
		}
		return null;
	}
//add User === controller_usermanagement.php
	public function addUser($post)
	{
		$this->username = $post['username'];
		$this->password = $post['password'];
		$this->type = $post['type'];
		$this->description = $post['description'];
		return $query = mysqli_query($this->db, "INSERT INTO `user`(`username`, `password`, `type`, `description`) 
									VALUES ('$this->username','$this->password','$this->type','$this->description')");		
		
	}
//edit user ==== controller_usermanagement.php
	public function editUser($post)
	{
		$id = $post['e_id'];
		$this->username = $post['e_username'];
		$this->password = $post['e_password'];
		$this->type = $post['e_type'];
		$this->description = $post['e_description'];
		return $query = mysqli_query($this->db, "UPDATE `user` SET `username`='$this->username',`password`='$this->password',`type`='$this->type',`description`='$this->description' WHERE user_id=13 ");
		
	}
	public function getUsername()
	{
		return $this->username;
	}
//log out === controller_homepage.php
	public function logout()
	{
		session_start();
		session_destroy();
		header("location:controller_homepage.php");
	}



}
?>
