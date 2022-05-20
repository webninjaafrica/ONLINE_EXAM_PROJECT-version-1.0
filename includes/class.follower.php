<?php include_once("autoload.php");
class follower extends connection
{
	var $user_id,$total_followers;
	function __construct($user_id=""){
		$this->user_id=$user_id;
		parent::__construct();
		$q="select * from follower where user_id=:user_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":user_id",$this->user_id);
		$stmt->execute();

		$this->total_followers=$stmt->rowCount();
	}



	public function whoIFollow(){
		$q="select * from follower where follower_id=:user_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":user_id",$this->user_id);
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


	public function listFollowers(){
		$q="select * from follower where user_id=:user_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":user_id",$this->user_id);
		$stmt->execute();
		$data=array();
		while ($d=$stmt->fetch(PDO::FETCH_ASSOC)) {

			$member_info=new login($d['follower_id']);
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


	public function follow($follower_id){
		$error="error";
		$q="insert into follower(follower_id,user_id) values(follower_id,user_id)";
		$qp="select * from follower where follower_id=:follower_id and user_id=:user_id";
		$stmtp=$this->con->prepare($qp);
		$stmtp->bindParam(":user_id",$this->user_id);
		$stmtp->bindParam(":follower_id",$follower_id);
		$stmtp->execute();
		$rc=$stmtp->rowCount();
		if ($rc >0) {
			$error="failed. You are already following this person.";
		}else{
			$stmt=$this->con->prepare($q);
			$stmt->bindParam(":user_id",$this->user_id);
			$stmt->bindParam(":follower_id",$follower_id);
			$stmt->execute();
			$error="follow successiful.";
		}
		return $error;
	}


	public function unfollow($follower_id){
		$q="delete from follower where follower_id=:follower_id and user_id=:user_id";
		
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":user_id",$this->user_id);
		$stmt->bindParam(":follower_id",$follower_id);
		$stmt->execute();
	}


}

$r=new follower("");
echo json_encode($r->whoIFollow());
?>