<?php 
class Schedule{
	private $course;
	private $semester;
	private $startyear;
	private $endyear;
	private $subject;
	private $starttime;
	private $endtime;
	private $day;
	private $optday;
	private $unit;
	private $hours;

	private $assignroom;
	private $roomid;

	private $assignprof;
	private $profid;

	public function __construct()
	{
		$this->db = mysqli_connect('localhost', 'root', '', 'scheduling_system');
	}
//view all Sched === controller_schedulemanagement.php
	public function selectSchedule()
	{
		$query =  mysqli_query($this->db, "SELECT * FROM `schedule`");
		while($row = mysqli_fetch_assoc($query)){
			$data[] =$row;
		}
			if (!empty($data)){
			return $data;
		}
	}
/*
//default view subject sched === controller_schedulemanagement.php
	public function defaultViewsched($course,$semester)
	{
		$query =  mysqli_query("SELECT * FROM `schedule` WHERE course='$course' AND semester='$semester'  ORDER BY subjects DESC");
		while($row = mysqli_fetch_assoc($query)){
			$data[] =$row;
		}
			if (!empty($data)){
			return $data;
		}
	}
*/
//Search view subject sched === controller_schedulemanagement.php
	public function searchSched($get)
	{
		if((isset($get['cou']))and(isset($get['sem']))){
			$this->course = $get['cou'];
			$this->semester = $get['sem'];
			$this->startyear =  $get['s_year'];
			$this->endyear = $get['e_year'];
			$query =  mysqli_query($this->db, "SELECT * FROM `schedule` WHERE course='$this->course' AND semester='$this->semester' AND start_year='$this->startyear' AND end_year='$this->endyear' ORDER BY time_start ASC");
			while($row = mysqli_fetch_assoc($query)){
				$data[] =$row;
			}
				if (!empty($data)){
				return $data;
			}
		}
		
	}
//Search view subject sched === controller_schedulemanagement.php
	public function searchSched2($get)
	{
		if((isset($get['cou']))and(isset($get['sem']))){
			$this->course = $get['cou'];
			$this->semester = $get['sem'];
			
			$query =  mysqli_query($this->db, "SELECT * FROM `schedule` WHERE course='$this->course' AND semester='$this->semester' ORDER BY time_start ASC");
			while($row = mysqli_fetch_assoc($query)){
				$data[] =$row;
			}
				if (!empty($data)){
				return $data;
			}
		}
		
	}
//delete subject to schedule === controller_roommanagement.php
	public function deleteSubjtosched($get)
	{
		$subjId = $get['delete_sched'];
		$query = mysqli_query($this->db, "DELETE FROM `schedule` WHERE subj_no='$subjId' ");
		return $delete = mysqli_query($query);
	}
//view selected subject to delete and update === view_roommanagement.html
	public function selectedSched($get,$route)
	{
		$id = $get[$route];
	    $query = mysqli_query($this->db, "SELECT * FROM `schedule` WHERE subj_no='$id' ");
	 	return $row = mysqli_fetch_assoc($query);
	 
	}
//convert subject id to subject code === view_schedulemanagement.html --view course schedule form
	public function idtoName($subjid)
	{
		return $querysubj = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM `subjects` WHERE subject_id='$subjid' "));
	}
//convert room id to room name === view_schedulemanagement.html --view course schedule form
	public function roomidtoName($subjid)
	{
		return $querysubj = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM `room` WHERE room_id='$subjid' "));
	}
//convert professor id to professor name === view_schedulemanagement.html --view course schedule form
	public function profidtoName($subjid)
	{
		return $querysubj = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM `instructor` WHERE instructor_id='$subjid' "));
	}
//select the highest end_time ==== view_schedulemanagement.html
	public function gethighestTime($get)
	{
		$this->course = $get['cou'];
		$this->semester = $get['sem'];
		return $querysubj = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM `schedule` WHERE course='$this->course' AND semester='$this->semester' ORDER BY time_end DESC"));
	}
//add subject to course/semester selected === controller_schedulemanagement.php
	public function addsubjSched($post,$get)
	{
		$this->subject = $post['subject'];
		$querysubj = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM `subjects` WHERE course_code='$this->subject' "));
		$selectedsubj = $querysubj['subject_id'];
		$this->starttime = $post['start_t'];
		$this->endtime = $post['end_t'];
		$this->day = $post['day'];
		$this->optday = $post['opt_day'];
		$this->course = $get['cou'];
		$this->semester = $get['sem'];
		$this->startyear = $get['s_year'];
		$this->endyear = $get['e_year'];
		$this->unit = $querysubj['total_unit'];
		$this->hours = $querysubj['total_hours'];

		return $query = mysqli_query($this->db, "INSERT INTO `schedule`(`subjects`, `days`, `optional_day`, `time_start`, `time_end`, `units`, `hours`, `course`, `semester`, `start_year`, `end_year`) 
									VALUES ('$selectedsubj','$this->day','$this->optday','$this->starttime','$this->endtime','$this->unit', '$this->hours','$this->course','$this->semester','$this->startyear','$this->endyear')");
	}
//edit subject to course/semester selected === controller_schedulemanagement.php
	public function editsubjSched($post,$get)
	{
		$id = $_GET['update_sched'];
		$this->subject = $post['e_subject'];
		$querysubj = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM `subjects` WHERE course_code='$this->subject' "));
		$selectedsubj = $querysubj['subject_id'];
		$this->starttime = $post['e_start_t'];
		$this->endtime = $post['e_end_t'];
		$this->day = $post['e_day'];
		$this->optday = $post['e_opt_day'];
		$this->course = $get['cou'];
		$this->semester = $get['sem'];
		$this->unit = $querysubj['total_unit'];

		return $query = mysqli_query($this->db, "UPDATE `schedule` SET `subjects`='$selectedsubj',`room`=null,`professor`=null,`days`='$this->day',`optional_day`='$this->optday',`time_start`='$this->starttime',`time_end`='$this->endtime' WHERE subj_no='$id' ");
	}
//view all subjects to modal subject textbox === controller_subjectmanagement.php
	public function selectSubject()
	{
		$query =  mysqli_query($this->db, "SELECT * FROM `subjects` ORDER BY course_code ASC");
		while($row = mysqli_fetch_assoc($query)){
			$data[] =$row;
		}
			if (!empty($data)){
			return $data;
		}
	}
//authentication of adding subject to sched === controller_schedulemanagement.php
	public function autSubject($post,$subj)
	{
		$this->subject = $post[$subj];
		$query = mysqli_query($this->db, "SELECT * FROM `subjects` WHERE course_code='$this->subject' ") or die (mysql_error());
		$data = mysqli_fetch_object($query);
		if(mysqli_num_rows($query) == 1){
			return $data;
		}
		return null;
	}
//authentication if the subject is already insert === controller_schedulemanagement.php
	public function autSched($post,$get,$subj)
	{
		$this->subject = $post[$subj];
		$querysubj = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM `subjects` WHERE course_code='$this->subject' "));
		$selectedsubj = $querysubj['subject_id'];
		$this->course = $get['cou'];
		$this->semester = $get['sem'];
		$query = mysqli_query($this->db, "SELECT * FROM `schedule` WHERE subjects='$selectedsubj' AND course='$this->course' AND semester='$this->semester' ") or die (mysql_error());
		return mysqli_num_rows($query);
	
	}


//
//ROOM CONFLICT
//assign room == controller_assignroom.php
	public function assignRoom($get)
	{
		$this->assignroom = $get['room_id'];
		$this->subjno = $get['assign_room'];

		return $query = mysqli_query($this->db, "UPDATE `schedule` SET `room`='$this->assignroom' WHERE subj_no='$this->subjno' ");

	}
//professor conflict === controller_assignprofessor.php
	public function roomConflictoftime($get)
		{
			$this->assignroom = $get['assign_room'];
			$querysubjno =	mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM `schedule` WHERE subj_no='$this->assignroom' "));
			$getdays = $querysubjno['days'];
			$getoptday = $querysubjno['optional_day'];
			$start_t1 = date('H:i:s', strtotime("+1 seconds", strtotime($querysubjno['time_start'])));
			$end_t1 = date('H:i:s', strtotime("-1 seconds", strtotime($querysubjno['time_end'])));
			$start_t2 = date('H:i:s', strtotime("+0 seconds", strtotime($querysubjno['time_start'])));
			$end_t2 = date('H:i:s', strtotime("-0 seconds", strtotime($querysubjno['time_end'])));
			$this->roomid = $get['room_id'];
			$this->semester = $get['sem'];
			$this->startyear = $get['s_year'];
			$this->endyear = $get['e_year'];
			$query = mysqli_query($this->db, "SELECT * FROM `schedule` WHERE 
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getdays' and time_end BETWEEN '$start_t1' and '$end_t1' and time_start NOT BETWEEN '$start_t1' and '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getoptday' and time_end BETWEEN '$start_t1' and '$end_t1' and time_start NOT BETWEEN '$start_t1' and '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getoptday' and time_end BETWEEN '$start_t1' and '$end_t1' and time_start NOT BETWEEN '$start_t1' and '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getdays' and time_end BETWEEN '$start_t1' and '$end_t1' and time_start NOT BETWEEN '$start_t1' and '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getdays' and time_start BETWEEN '$start_t1' and '$end_t1' and time_end NOT BETWEEN '$start_t1' and '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getoptday' and time_start BETWEEN '$start_t1' and '$end_t1' and time_end NOT BETWEEN '$start_t1' and '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getoptday' and time_start BETWEEN '$start_t1' and '$end_t1' and time_end NOT BETWEEN '$start_t1' and '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getdays' and time_start BETWEEN '$start_t1' and '$end_t1' and time_end NOT BETWEEN '$start_t1' and '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getdays' and time_start < '$start_t1' and time_end > '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getoptday' and time_start < '$start_t1' and time_end > '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getoptday' and time_start < '$start_t1' and time_end > '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getdays' and time_start < '$start_t1' and time_end > '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getdays' and time_start > '$start_t1' and time_end < '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getoptday' and time_start > '$start_t1' and time_end < '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getoptday' and time_start > '$start_t1' and time_end < '$end_t1') OR
								(room='$this->roomid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getdays' and time_start > '$start_t1' and time_end < '$end_t1')
								") or die (mysql_error());
			return mysqli_num_rows($query);
		}

//
//PROFESSOR CONFLICT

//view all instructor === controller_schedulemanagment.php
	public function selectProf($sort)
	{
		$query =  mysqli_query($this->db, "SELECT * FROM `instructor` ORDER BY $sort ASC ");
	
		while($row = mysqli_fetch_assoc($query)){
			$data[] =$row;
		}
			if (!empty($data)){
			return $data;
		}
	}	
//assign professor == controller_assignprofessor.php
	public function assignProf($get)
	{
		$this->assignprof = $get['prof_id'];
		$this->subjno = $get['assign_prof'];
		return $query = mysqli_query($this->db, "UPDATE `schedule` SET `professor`='$this->assignprof' WHERE subj_no='$this->subjno' ");

	}
//professor conflict === controller_assignprofessor.php
	public function profConflictoftime($get)
		{
			$this->assignprof = $get['assign_prof'];
			$querysubjno =	mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM `schedule` WHERE subj_no='$this->assignprof' "));
			$getdays = $querysubjno['days'];
			$getoptday = $querysubjno['optional_day'];
			$start_t1 = date('H:i:s', strtotime("+1 seconds", strtotime($querysubjno['time_start'])));
			$end_t1 = date('H:i:s', strtotime("-1 seconds", strtotime($querysubjno['time_end'])));
			$start_t2 = date('H:i:s', strtotime("+0 seconds", strtotime($querysubjno['time_start'])));
			$end_t2 = date('H:i:s', strtotime("-0 seconds", strtotime($querysubjno['time_end'])));
			$this->profid = $get['prof_id'];
			$this->semester = $get['sem'];
			$this->startyear = $get['s_year'];
			$this->endyear = $get['e_year'];
			$query = mysqli_query($this->db, "SELECT * FROM `schedule` WHERE 
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getdays' and time_end BETWEEN '$start_t1' and '$end_t1' and time_start NOT BETWEEN '$start_t1' and '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getoptday' and time_end BETWEEN '$start_t1' and '$end_t1' and time_start NOT BETWEEN '$start_t1' and '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getoptday' and time_end BETWEEN '$start_t1' and '$end_t1' and time_start NOT BETWEEN '$start_t1' and '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getdays' and time_end BETWEEN '$start_t1' and '$end_t1' and time_start NOT BETWEEN '$start_t1' and '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getdays' and time_start BETWEEN '$start_t1' and '$end_t1' and time_end NOT BETWEEN '$start_t1' and '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getoptday' and time_start BETWEEN '$start_t1' and '$end_t1' and time_end NOT BETWEEN '$start_t1' and '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getoptday' and time_start BETWEEN '$start_t1' and '$end_t1' and time_end NOT BETWEEN '$start_t1' and '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getdays' and time_start BETWEEN '$start_t1' and '$end_t1' and time_end NOT BETWEEN '$start_t1' and '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getdays' and time_start < '$start_t1' and time_end > '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getoptday' and time_start < '$start_t1' and time_end > '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getoptday' and time_start < '$start_t1' and time_end > '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getdays' and time_start < '$start_t1' and time_end > '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getdays' and time_start > '$start_t1' and time_end < '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and days='$getoptday' and time_start > '$start_t1' and time_end < '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getoptday' and time_start > '$start_t1' and time_end < '$end_t1') OR
								(professor='$this->profid' and semester='$this->semester' and start_year='$this->startyear' and end_year='$this->endyear' and optional_day='$getdays' and time_start > '$start_t1' and time_end < '$end_t1')
								") or die (mysql_error());
			return mysqli_num_rows($query);
		}




}

?>

