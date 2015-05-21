<?php 
class Subject{
	private $subjid;
	private $coursecode;
	private $descriptive;
	private $lecunits;
	private $labunits;
	private $prereq;
	private $db;

	public function __construct()
	{
		$this->db = mysqli_connect('localhost', 'root', '', 'scheduling_system');
	}
//add subject === controller_subjectmanagement.php
	public function addSubject($post,$totalUnits,$totalHours)
	{
		$this->coursecode = $post['c_code'];
		$this->descriptive = $post['d_title'];
		$this->lecunits = $post['lec_units'];
		$this->labunits = $post['lab_units'];
		$this->prereq = $post['prereq'];
		
		return $query = mysqli_query($this->db, "INSERT INTO `subjects`(`course_code`, `descriptive_title`, `lecture_unit`, `laboratory_unit`, `total_unit`, `pre_req`, `total_hours`) 
									VALUES ('$this->coursecode','$this->descriptive','$this->lecunits','$this->labunits','$totalUnits','$this->prereq','$totalHours')");		 
	}
//authentication subject === controller_subjectmanagement.php
	public function authSubj($post)
	{
		$this->coursecode = $post['c_code'];
		$query = mysqli_query($this->db, "SELECT * FROM `subjects` WHERE course_code='$this->coursecode' ") or die (mysql_error());
		$data = mysqli_fetch_object($query);
		if(mysqli_num_rows($query) == 1){
			return $data;
		}
		return null;
	}
//view all subjects ===	controller_subjectmanagement.php and controller_subject.php
	public function selectSubject()
	{
		$query =  mysqli_query($this->db, "SELECT * FROM `subjects`");
		while($row = mysqli_fetch_assoc($query)){
			$data[] =$row;
		}
			if (!empty($data)){
			return $data;
		}
	}
//search subjects ===	controller_subject.php
	public function searchSubject($get)
	{
		if(isset($get['s']) and($get['r']))
		{
			$search = $get['s'];
			$row = $get['r'];
			$query =  mysqli_query($this->db, "SELECT * FROM subjects WHERE $row LIKE '%$search%'");
			while($row = mysqli_fetch_assoc($query)){
				$data[] =$row;
			}
				if (!empty($data)){
				return $data;
			}

		}
		
	}
//edit subject ==== controller_subjectmanagement.php
	public function editSubj($post,$totalUnits,$totalHours)
	{
		$this->subjid = $post['e_id'];
		$this->coursecode = $post['e_c_code'];
		$this->descriptive = $post['e_d_title'];
		$this->lecunits = $post['e_lec_units'];
		$this->labunits = $post['e_lab_units'];
		$this->prereq = $post['e_prereq'];
		return $query = mysqli_query($this->db, "UPDATE `subjects` 
									SET `course_code`='$this->coursecode',`descriptive_title`='$this->descriptive',`lecture_unit`='$this->lecunits',`laboratory_unit`='$this->labunits',`total_unit`=$totalUnits,`pre_req`='$this->prereq',`total_hours`=$totalHours
									WHERE subject_id ='$this->subjid' ");
		
	}
//view selected to delete and edit === view_subjectmanagement.html
	public function subjTodelete($get,$route)
	{
		$id = $get[$route];
	    $query = mysqli_query($this->db, "SELECT * FROM `subjects` WHERE subject_id=$id");
	 	return $row = mysqli_fetch_assoc($query);
	 
	}
//delete subject === controller_subjectmanagement.php
	public function deleteSubj($get)
	{
		$subjId = $get['del_subject'];
		$query = mysqli_query($this->db, "DELETE FROM `subjects` WHERE subject_id=$subjId");
		return $delete = $this->query($query);
	}


}
?>
