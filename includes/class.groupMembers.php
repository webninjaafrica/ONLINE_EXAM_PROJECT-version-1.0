<?php include_once("autoload.php");
class groupMembers extends connection
{
	var $group_id,$group_info,$member_info,$user_id,$total_members;
	function __construct($group_id=""){
		$this->group_id=$group_id;
		parent::__construct();
		$this->group_info=new group($this->group_id);
		$q="select * from groupmembers where group_id=:group_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":group_id",$this->group_id);
		$stmt->execute();

		$this->total_members=$stmt->rowCount();
	}

	public function listMembers(){
		$q="select * from groupmembers where group_id=:group_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":group_id",$this->group_id);
		$stmt->execute();
		$data=array();
		while ($d=$stmt->fetch(PDO::FETCH_ASSOC)) {

			$member_info=new login($d['user_id']);
			$mdet=$member_info->details;
			$ar=array();
			$ar['names']=$mdet['first_name']." ".$mdet['last_name'];
			$ar['added_on']=$d['date'];
			$ar['picture']=$mdet['picture'];
			$ar['status']="";
			$ar['user_id']=$mdet['id'];
			array_push($data, $ar);
		}
		return $data;

	}
	public function addMember($user_id,$added_by){
		if ($this->group_info->group_exists >0) {
			$q="insert into groupmembers(group_id,user_id,added_by) values(:group_id,:user_id,:added_by)";
			$stmt=$this->con->prepare($q);
			$stmt->bindParam(":group_id",$this->group_id);
			$stmt->bindParam(":user_id",$user_id);
			$stmt->bindParam(":added_by",$added_by);
			$stmt->execute();
			$member_info=new login($user_id);
			$mdet=$member_info->details;
			$notification=new notification();
		$message="<p>New Member <b>".$mdet['first_name']."</b> Was added.</p>";
		$title="New Member added";
		$receiver=$this->username;
		$notification->send("G-".$this->group_id,$title,$message);

		$gdet=$this->group_info->details;
		$notification=new notification();
		$message="<p>You were added to <b>".$gdet['group_name']."</b> You can now access the group profile or participate into its activities.</p>";
		$title="Added into '".$gdet['group_name']."' Group";
		$notification->send($user_id,$title,$message,$gdet['group_name'],"group_notification");
			$error="success";
		}else{
			$error="failed. group does not exist.";
		}
		return $error;
	}


	public function removeMember($user_id){
		$q="delete from groupmembers where group_id=:group_id and user_id=:user_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":group_id",$this->group_id);
		$stmt->bindParam(":user_id",$user_id);
		$stmt->execute();
		$gdet=$this->group_info->details;
		$notification=new notification();
		$message="<p>You were removed from <b>".$gdet['group_name']."</b> You will not be able to access the group profile or activities until the group administrator consinders you again.</p>";
		$title="Demoted Group Membership";
		$notification->send($user_id,$title,$message,$gdet['group_name'],"group_notification");
		return "success";
	}
}
?>