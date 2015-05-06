<?php 
session_start();
include('../model/model_instructor.php');
$instructor = new Instructor();

$profSched = $instructor->viewProfsched($_GET);
$inst = $instructor->selectInstructor();
$serchProf = $instructor->searchProfessor($_GET);

 
if(isset($_POST['search_prof']))
{
	header('location:controller_facultymanagement.php?s='. $_POST['search1']. '&r='. $_POST['search2']);
}

if(isset($_POST['addinstructor']))
{
	$instructor->addInstructor($_POST);
	header('location:controller_facultymanagement.php?success=1');
}
if(isset($_POST['delete_inst']))
{
	$instructor->deleteInst($_GET);
	header('location:controller_facultymanagement.php?deleted=1');
}
if(isset($_POST['update']))
{
	$instructor->editSubj($_POST);
	header('location:controller_facultymanagement.php?updated=1');
}

include('../view/view_facultymanagement.html');
 ?>