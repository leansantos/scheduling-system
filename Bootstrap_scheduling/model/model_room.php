<?php 
class Room{
	private $rid;
	private $rname;
	private $rtype;
	private $rcampus;
	private $rbuilding;

	public function __construct()
	{
		$this->db = mysqli_connect('localhost', 'root', '', 'scheduling_system');
	}
//add room === controller_roommanagement.php
	public function addRoom($post)
	{
		$this->rname = $post['r_name'];
		$this->rtype = $post['r_type'];
		$this->rcampus = $post['r_campus'];
		$this->rbuilding = $post['r_building'];
		return $query = mysqli_query($this->db, "INSERT INTO `room`(`room_name`, `room_type`, `campus`, `building`) 
									VALUES ('$this->rname','$this->rtype','$this->rcampus','$this->rbuilding')");		 
	}
//authentication room === controller_roommangement.php
	public function authRoom($post)
	{
		$this->rname = $post['r_name'];
		$query = mysqli_query($this->db, "SELECT * FROM `room` WHERE room_name='$this->rname' ") or die (mysql_error());
		$data = mysqli_fetch_object($query);
		if(mysqli_num_rows($query) == 1){
			return $data;
		}
		return null;
	}
//sorted Rooms ===	controller_roommanagement.php / controller_schedulemanagement.php
	public function selectRoom($sort)
	{
		$query =  mysqli_query($this->db, "SELECT * FROM `room` ORDER BY $sort ASC");
		while($row = mysqli_fetch_assoc($query)){
			$data[] =$row;
		}
			if (!empty($data)){
			return $data;
		}
	}
//view selected room to delete and update === view_roommanagement.html
	public function selectedRoom($get,$route)
	{
		$id = $get[$route];
	    $query = mysqli_query($this->db, "SELECT * FROM `room` WHERE room_id=$id");
	 	return $row = mysqli_fetch_assoc($query);
	 
	}
//delete room === controller_roommanagement.php
	public function deleteRoom($get)
	{
		$roomId = $get['del_room'];
		$query = mysqli_query($this->db, "DELETE FROM `room` WHERE room_id=$roomId");
		return $delete = mysqli_query($query);
	}
//edit room ==== controller_roommanagement.php
	public function editRoom($post)
	{
		$this->rid = $post['e_id'];
		$this->rname = $post['e_rname'];
		$this->rtype = $post['e_rtype'];
		$this->rcampus = $post['e_campus'];
		$this->rbuilding = $post['e_building'];
		return $query = mysqli_query($this->db, "UPDATE `room` SET `room_name`='$this->rname',`room_type`='$this->rtype',`campus`='$this->rcampus',`building`='$this->rbuilding' 
										WHERE room_id = $this->rid");		
	}
//view all room ===	 controller_room.php
	public function selectR()
	{
		$query =  mysqli_query($this->db, "SELECT * FROM `room`");
		while($row = mysqli_fetch_assoc($query)){
			$data[] =$row;
		}
			if (!empty($data)){
			return $data;
		}
	}
//search room ===	controller_room.php
	public function searchR($get)
	{
		if(isset($get['s']) and($get['r']))
		{
			$search = $get['s'];
			$row = $get['r'];
			$query =  mysqli_query($this->db, "SELECT * FROM room WHERE $row LIKE '%$search%'");
			while($row = mysqli_fetch_assoc($query)){
				$data[] =$row;
			}
				if (!empty($data)){
				return $data;
			}

		}
		
	}
// view room schedule  === controller_roommanagement.php
	public function viewRoomsched($get)
	{
		if (isset($get['view'])){
			$roomid = $get['view'];
			$query =  mysqli_query($this->db, "SELECT * FROM `schedule` WHERE room='$roomid' ORDER BY time_start ASC");
			while($row = mysqli_fetch_assoc($query)){
				$data[] =$row;
			}
			if (!empty($data)){
				return $data;
			}


		}
		
	}
//convert professor id to name code === view_roommanagement.html --view course schedule form
	public function idtoName($profid)
	{
		return $querysubj = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM `instructor` WHERE instructor_id='$profid' "));
	}

	
}
?>