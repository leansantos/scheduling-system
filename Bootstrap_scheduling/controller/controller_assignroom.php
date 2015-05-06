<?php 

session_start();
if(($_SESSION['user_id']->type == 'cite')or($_SESSION['user_id']->type == 'cba')or($_SESSION['user_id']->type == 'chm')or($_SESSION['user_id']->type == 'cla')or($_SESSION['user_id']->type == 'coed')or($_SESSION['user_id']->type == 'cams'))
{
include('../model/model_schedule.php');
$sched = new Schedule();

if ($sched->roomConflictoftime($_GET)==0) 
	{
		$sched->assignRoom($_GET);
		header('location:controller_schedulemanagement.php?room_assigned=1&cou='.$_GET['cou']. '&sem='. $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);
	}else{header('location:controller_schedulemanagement.php?room_conflict=1&cou='.$_GET['cou']. '&sem='. $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);}


/*
if(($sched->roomConflictoftime($_GET,'days','time_start','days')==0) AND ($sched->roomConflictoftime($_GET,'days','time_start','optional_day')==0) AND ($sched->roomConflictoftime($_GET,'optional_day','time_start','days')==0) AND ($sched->roomConflictoftime($_GET,'optional_day','time_start','optional_day')==0))
	{
		if(($sched->roomConflictoftime($_GET,'days','time_end','days')==0) AND ($sched->roomConflictoftime($_GET,'days','time_end','optional_day')==0) AND ($sched->roomConflictoftime($_GET,'optional_day','time_end','days')==0) AND ($sched->roomConflictoftime($_GET,'optional_day','time_end','optional_day')==0))
		{

			if((($sched->roomConflictoftimestartend($_GET,'days','days')==0) AND ($sched->roomConflictoftimestartend($_GET,'days','optional_day')==0) AND ($sched->roomConflictoftimestartend($_GET,'optional_day','days')==0) AND ($sched->roomConflictoftimestartend($_GET,'optional_day','optional_day')==0)))
			{
				$sched->assignRoom($_GET);
				header('location:controller_schedulemanagement.php?room_assigned=1&cou='.$_GET['cou']. '&sem='. $_GET['sem']);
				
			}else{header('location:controller_schedulemanagement.php?room_conflict=1&cou='.$_GET['cou']. '&sem='. $_GET['sem']);}

		}else{header('location:controller_schedulemanagement.php?room_conflict=1&cou='.$_GET['cou']. '&sem='. $_GET['sem']);}
			
	}else{header('location:controller_schedulemanagement.php?room_conflict=1&cou='.$_GET['cou']. '&sem='. $_GET['sem']);}
*/
}


else
{
	 header('location:../controller/controller_homepage.php');
}


?>
