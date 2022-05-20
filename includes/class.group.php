<?php
include_once("autoload.php");
class group extends connection
{
	var $group_id,$details,$group_exists;
	function __construct($group_id=""){
		parent::__construct();
		$this->group_id=$group_id;
		$q="select *from groups where group_id=:group_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":group_id",$this->group_id);
		$stmt->execute();
		$this->group_exists=$stmt->rowCount();
		$this->details=$stmt->fetch(PDO::FETCH_ASSOC);
	}
	public function create($group_name,$created_by,$group_meta=""){
		$q="insert into groups(group_name,created_by,group_meta) values(:group_name,:created_by,:group_meta)";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":group_name",$group_name);
		$stmt->bindParam(":created_by",$created_by);
		$stmt->bindParam(":group_meta",$group_meta);
		$stmt->execute();
		return "success";
	}

	public function user_admin_groups($user){
		$q="select * from groups where created_by=:created_by";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":created_by",$created_by);
		$stmt->execute();
		$rows=$stmt->rowCount();
		$data=array();
		$data['groups']=array();
		$data['groups_exists']=$rows;
		while ($da=$stmt->fetch(PDO::FETCH_ASSOC)) {
			array_push($data['groups'], $da['group_id']);
		}

		return $data;
	}

	public function deleteGroup(){
		$q="delete from groups where group_id=:group_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":group_id",$this->group_id);
		$stmt->execute();
		return "success";
	}
}


 ?>