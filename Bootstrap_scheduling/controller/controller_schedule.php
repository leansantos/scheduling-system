<?php 
include("../model/model_schedule.php");
session_start();
$schedule = new Schedule();
$citeSched = $schedule->searchSched2($_GET);
if(isset($_GET['department'])==null){
	include("../view/view_schedule.html");	
}elseif ($_GET['department']=='cite') {

	if(isset($_POST['search_cite_schedule']))
	{
		header('location:controller_schedule.php?department=cite&cou='. $_POST['s_course']. '&sem='. $_POST['s_semester']);
	}
	include("../view/view_cite_schedule.html");	
}elseif ($_GET['department']=='cams') {

	if(isset($_POST['search_cams_schedule']))
	{
		header('location:controller_schedule.php?department=cams&cou='. $_POST['s_course']. '&sem='. $_POST['s_semester']);
	}
	include("../view/view_cams_schedule.html");	
}elseif ($_GET['department']=='cba') {

	if(isset($_POST['search_cba_schedule']))
	{
		header('location:controller_schedule.php?department=cba&cou='. $_POST['s_course']. '&sem='. $_POST['s_semester']);
	}
	include("../view/view_cba_schedule.html");	

}elseif ($_GET['department']=='coed') {

	if(isset($_POST['search_coed_schedule']))
	{
		header('location:controller_schedule.php?department=coed&cou='. $_POST['s_course']. '&sem='. $_POST['s_semester']);
	}
	include("../view/view_coed_schedule.html");	

}elseif ($_GET['department']=='chm') {

	if(isset($_POST['search_chm_schedule']))
	{
		header('location:controller_schedule.php?department=chm&cou='. $_POST['s_course']. '&sem='. $_POST['s_semester']);
	}
	include("../view/view_chm_schedule.html");	
}elseif ($_GET['department']=='cla') {

	if(isset($_POST['search_cla_schedule']))
	{
		header('location:controller_schedule.php?department=cla&cou='. $_POST['s_course']. '&sem='. $_POST['s_semester']);
	}
	include("../view/view_cla_schedule.html");	
}

 ?>