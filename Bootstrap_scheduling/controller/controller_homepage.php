<?php 
include("../model/model_user.php");
$user = new user();
session_start();
if (isset($_POST['submit']))
{
	
	if($user->authenticateUser($_POST))
		{
			$_SESSION['user_id'] = $user->authenticateUser($_POST);
		
		}
		else
		{
			header("location:controller_homepage.php?err=1");
		}
}

if (isset($_GET['logout']) == 1)
  {
    $user->logout();
  }


include("../view/view_homepage.html");
 ?>