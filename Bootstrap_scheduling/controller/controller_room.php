<?php 
include("../model/model_room.php");
session_start();
$allRoom = new Room();

$viewRoom = $allRoom->selectR();
$searchRoom = $allRoom->searchR($_GET);
$roomSched = $allRoom->viewRoomsched($_GET);
if(isset($_POST['search_room']))
{
	header('location:controller_room.php?s='. $_POST['search1']. '&r='. $_POST['search2']);
}
include("../view/view_room.html");
 ?>