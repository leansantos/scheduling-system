<?php 
include("../model/model_instructor.php");
session_start();
$allProf = new Instructor();
$viewProf = $allProf->selectProf();
$serchProf = $allProf->searchProfessor($_GET);
$profSched = $allProf->viewProfsched($_GET);


if(isset($_POST['search_subject']))
{
	header('location:controller_faculty.php?s='. $_POST['search1']. '&r='. $_POST['search2']);
}

include("../view/view_faculty.html");
 ?>