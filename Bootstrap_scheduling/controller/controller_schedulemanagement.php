<?php 

include('../model/model_schedule.php');
session_start();
$sched = new Schedule();
$selectSubj = $sched->selectSubject();

	//if (isset($_GET['cou'])==null)
	//{
	//	$scheds = $sched->defaultViewsched('BSIT-1',"1st semester");
	//}else{
$scheds = $sched->searchSched($_GET);
	//}
if (isset($_POST['search_sched']))
{
	header("location:controller_schedulemanagement.php?cou=". $_POST['course']. "&sem=". $_POST['semester']. "&s_year=". $_POST['year_start']. "&e_year=". $_POST['year_end']);
}
if (isset($_POST['addsubj']))
{

	if($_POST['year_start']<$_POST['year_end'])
	{
		$year = $_POST['year_start']+1;
		if($_POST['year_end']>$year)
		{
			header("location:controller_schedulemanagement.php?year_not_valid=1". "&cou=". $_POST['course']. "&sem=". $_POST['semester']. "&s_year=". $_POST['year_start']. "&e_year=". $_POST['year_end']);

		}else{header("location:controller_schedulemanagement.php?add_subj_modal=1". "&cou=". $_POST['course']. "&sem=". $_POST['semester']. "&s_year=". $_POST['year_start']. "&e_year=". $_POST['year_end']);}
		

	}else{header("location:controller_schedulemanagement.php?year_not_valid=1". "&cou=". $_POST['course']. "&sem=". $_POST['semester']. "&s_year=". $_POST['year_start']. "&e_year=". $_POST['year_end']);}
	
}
if (isset($_POST['delete_subjsched']))
{
	$sched->deleteSubjtosched($_GET);
	header("location:controller_schedulemanagement.php?subjtosched_deleted=1&cou=". $_GET['cou']. "&sem=". $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);
}
if (isset($_POST['confirm_addsubj']))
{
	if ($sched->autSubject($_POST,'subject')) {
		if ($sched->autSched($_POST,$_GET,'subject')==0){
			if ($_POST['start_t'] <= $_POST['end_t']) {
				if ($_POST['day'] != $_POST['opt_day']){
				$sched->addsubjSched($_POST,$_GET);
				header("location:controller_schedulemanagement.php?success=1&cou=". $_GET['cou']. "&sem=". $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);
				}else{header("location:controller_schedulemanagement.php?not_valid_day=1&cou=". $_GET['cou']. "&sem=". $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);}
			
			}else{header("location:controller_schedulemanagement.php?not_valid_time=1&cou=". $_GET['cou']. "&sem=". $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);}
		}else{header("location:controller_schedulemanagement.php?not_valid_subj2=1&cou=". $_GET['cou']. "&sem=". $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);}
		
	
	}
	else{header("location:controller_schedulemanagement.php?not_valid_subj=1&cou=". $_GET['cou']. "&sem=". $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);
	}
		
}


if(isset($_POST['edit_subjtosched']))
{
	if ($sched->autSubject($_POST,'e_subject')) {
		
			if ($_POST['e_start_t'] <= $_POST['e_end_t']) {
				if ($_POST['e_day'] != $_POST['e_opt_day']){
					$sched->editsubjSched($_POST,$_GET);
					header("location:controller_schedulemanagement.php?subj_updated=1&cou=". $_GET['cou']. "&sem=". $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);
				}else{header("location:controller_schedulemanagement.php?not_valid_day=1&cou=". $_GET['cou']. "&sem=". $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);}
			
			}else{header("location:controller_schedulemanagement.php?not_valid_time=1&cou=". $_GET['cou']. "&sem=". $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);}
		
	}
	else{header("location:controller_schedulemanagement.php?not_valid_subj=1&cou=". $_GET['cou']. "&sem=". $_GET['sem']. "&s_year=". $_GET['s_year']. "&e_year=". $_GET['e_year']);
	}
	
	
}


		
//assign room---
include('../model/model_room.php');
$room = new Room();
if(isset($_GET['sort_room'])==null)
	{
	$rooms = $room->selectRoom('room_id');
}else{$rooms = $room->selectRoom($_GET['sort_room']);}

//assign professor---
if(isset($_GET['sort_prof'])==null)
{
	$viewProf = $sched->selectProf('instructor_id');
}else{$viewProf = $sched->selectProf($_GET['sort_prof']);}

include('../view/view_schedulemanagement.html');




 ?>