<?php 
include('../model/model_room.php');
$room = new Room();
$rooms = $room->selectR();
$searchRoom = $room->searchR($_GET);
$roomSched = $room->viewRoomsched($_GET);
if(isset($_POST['search_room']))
{
	header('location:controller_roommanagement.php?s='. $_POST['search1']. '&r='. $_POST['search2']);
}

if(isset($_POST['addroom']))
{
	if($room->authRoom($_POST)){
		
		header('location:controller_roommanagement.php?room_auth=1');
	}else{
		$room->addRoom($_POST);
		header('location:controller_roommanagement.php?success=1');
	}
	
	
}
if(isset($_POST['delete_room']))
{
	$room->deleteRoom($_GET);
	header('location:controller_roommanagement.php?deleted=1');
}
if(isset($_POST['update']))
{
	$room->editRoom($_POST);
	header('location:controller_roommanagement.php?updated=1');
}
include('../view/view_roommanagement.html');
 ?>