<?php 

session_start();
if(($_SESSION['user_id']->type == 'cite')or($_SESSION['user_id']->type == 'cba')or($_SESSION['user_id']->type == 'chm')or($_SESSION['user_id']->type == 'cla')or($_SESSION['user_id']->type == 'coed')or($_SESSION['user_id']->type == 'cams'))
{
include('../model/model_schedule.php');
$sched = new Schedule();


if ($sched->profConflictoftime($_GET)==0) 
	{
		$sched->assignProf($_GET);
		header('location:controller_schedulemanagement.php?prof_assigned=1&cou='.$_GET['cou']. '&sem='. $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);
	}else{header('location:controller_schedulemanagement.php?prof_conflict=1&cou='.$_GET['cou']. '&sem='. $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);}

/**
if(($sched->profConflictoftime($_GET,'days','time_start','days')==0) AND ($sched->profConflictoftime($_GET,'days','time_start','optional_day')==0) AND ($sched->profConflictoftime($_GET,'optional_day','time_start','days')==0) AND ($sched->profConflictoftime($_GET,'optional_day','time_start','optional_day')==0))
	{
		if(($sched->profConflictoftime($_GET,'days','time_end','days')==0) AND ($sched->profConflictoftime($_GET,'days','time_end','optional_day')==0) AND ($sched->profConflictoftime($_GET,'optional_day','time_end','days')==0) AND ($sched->profConflictoftime($_GET,'optional_day','time_end','optional_day')==0))
		{

			if((($sched->profConflictoftimestartend($_GET,'days','days')==0) AND ($sched->profConflictoftimestartend($_GET,'days','optional_day')==0) AND ($sched->profConflictoftimestartend($_GET,'optional_day','days')==0) AND ($sched->profConflictoftimestartend($_GET,'optional_day','optional_day')==0)))
			{
				$sched->assignProf($_GET);
				header('location:controller_schedulemanagement.php?prof_assigned=1&cou='.$_GET['cou']. '&sem='. $_GET['sem']);
			}else{header('location:controller_schedulemanagement.php?prof_conflict=1&cou='.$_GET['cou']. '&sem='. $_GET['sem']);}

		}else{header('location:controller_schedulemanagement.php?prof_conflict=1&cou='.$_GET['cou']. '&sem='. $_GET['sem']);}
			
	}else{header('location:controller_schedulemanagement.php?prof_conflict=1&cou='.$_GET['cou']. '&sem='. $_GET['sem']);}
	
	*/
}


else
{
	 header('location:../controller/controller_homepage.php');
}


?>
