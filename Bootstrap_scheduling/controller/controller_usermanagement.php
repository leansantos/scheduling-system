<?php 
include('../model/model_user.php');
session_start();
$user = new User();
$users = $user->viewUser();


if(isset($_POST['add_user']))
{
	if($user->authUsername($_POST))
	{
		header('location:controller_usermanagement.php?uservalid=1');
		
	}else{
		$user->addUser($_POST);
		header('location:controller_usermanagement.php?success=1');
	}
	
}
if(isset($_POST['delete_user']))
{
	$user->deleteUser($_GET);
	header('location:controller_usermanagement.php?del_user=1');
}
if(isset($_POST['update_user']))
{
	$user->editUser($_POST);
	header('location:controller_usermanagement.php?update_user=1');
}

include('../view/view_usermanagement.html');

 ?>