<?php 

class Instructor{
	private $fname;
	private $mname;
	private $lname;
	private $department;
	private $instid;

	public function __construct()
	{
		$this->db = mysqli_connect('localhost', 'root', '', 'scheduling_system');
	}
//add instructor === controller_facultymanagement.php
	public function addInstructor($post)
	{
		$this->fname = $post['f_name'];
		$this->mname = $post['m_name'];
		$this->lname = $post['l_name'];
		$this->subjtaken = $post['subj_taken'];
		$this->department = $post['i_department'];
		return $query = mysqli_query($this->db, "INSERT INTO `instructor`(`fname`, `mname`, `lname`, `department`, `subj_taken`) 
								VALUES ('$this->fname','$this->mname','$this->lname','$this->department','$this->subjtaken')");		
	}
//view by department instructor ===	controller_facultymanagement.php
	public function selectInstructor()
	{
		$query =  mysqli_query($this->db, "SELECT * FROM `instructor`");
		while($row = mysqli_fetch_assoc($query)){
			$data[] =$row;
		}
			if (!empty($data)){
			return $data;
		}
	}
//view all professor === controller_faculty.php
	public function selectProf()
	{
		$query =  mysqli_query($this->db, "SELECT * FROM `instructor` ");
		while($row = mysqli_fetch_assoc($query)){
			$data[] =$row;
		}
			if (!empty($data)){
			return $data;
		}
	}
//search professor ===	controller_faculty.php /controller_facultymanagement.php
	public function searchProfessor($get)
	{
		if(isset($get['s']) and($get['r']))
		{
			$search = $get['s'];
			$row = $get['r'];
			$query =  mysqli_query($this->db, "SELECT * FROM instructor WHERE $row LIKE '%$search%'");
			while($row = mysqli_fetch_assoc($query)){
				$data[] =$row;
			}
				if (!empty($data)){
				return $data;
			}

		}
		
	}
//view selected instructor to delete and update === view_facultymanagement.html
	public function selectedInstructor($get,$route)
	{
		$id = $get[$route];
	    $query = mysqli_query($this->db, "SELECT * FROM `instructor` WHERE instructor_id=$id");
	 	return $row = mysqli_fetch_assoc($query);
	 
	}
//delete instructor === controller_facultymanagement.php
	public function deleteInst($get)
	{
		$instId = $get['del_instructor'];
		$query = mysqli_query($this->db, "DELETE FROM `instructor` WHERE instructor_id=$instId");
		return $delete = mysqli_query($query);
	}
//edit subject ==== controller_facultymanagement.php
	public function editSubj($post)
	{
		$this->instid = $post['e_id'];
		$this->fname = $post['e_fname'];
		$this->mname = $post['e_mname'];
		$this->lname = $post['e_lname'];
		$this->subjtaken = $post['subj_taken'];
		$this->department = $post['e_department'];
		return $query = mysqli_query($this->db, "UPDATE `instructor` SET `fname`='$this->fname',`mname`='$this->mname',`lname`='$this->lname',`department`='$this->department',`subj_taken`='$this->subjtaken' WHERE instructor_id=$this->instid");
		
	}
// view professor schedule  === controller_facultymanagement.php
	public function viewProfsched($get)
	{
		if (isset($get['view'])){
			$profid = $get['view'];
			$query =  mysqli_query($this->db, "SELECT * FROM `schedule` WHERE professor='$profid' ORDER BY time_start ASC");
			while($row = mysqli_fetch_assoc($query)){
				$data[] =$row;
			}
			if (!empty($data)){
				return $data;
			}


		}
		
	}
// get total Units ===dsfsafsafsdfsdf
	public function getTotalunits($prof)
	{
		return $querysubj = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT sum(units) as loading_units FROM `schedule` WHERE professor='$prof' "));

	}
// get total hours ===dsfsafsafsdfsdf
	public function getTotalhours($prof)
	{
		return $querysubj = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT sum(hours) as loading_hours FROM `schedule` WHERE professor='$prof' "));

	}
//convert subject id to subject code === view_facultymanagement.html --view course schedule form
	public function idtoName($subjid)
	{
		return $querysubj = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM `subjects` WHERE subject_id='$subjid' "));
	}
//convert room id to room name === view_facultymanagement.html --view course schedule form
	public function roomidtoName($subjid)
	{
		return $querysubj = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM `room` WHERE room_id='$subjid' "));
	}




}
?>