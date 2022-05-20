<?php
include_once("autoload.php");
class performance extends connection
{
	var $performance_id,$no_of_scores,$performance_exists,$performance_details,$user_id;
	function __construct($performance_id="",$user_id=""){
		$this->performance_id=$performance_id;
		$this->user_id=$user_id;
		parent::__construct();
		$q="select *from scores where quiz_id=:performance and user_id=:user_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":performance",$this->performance_id);
		$stmt->bindParam(":user_id",$user_id);
		$stmt->execute();
		$this->performance_exists=$stmt->rowCount();
		$this->performance_details=$stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function create($quiz_id,$user_id,$total_score){
		$error="";

		$qx=new performance($quiz_id,$user_id);
		if ($qx->performance_exists >0) {
			$error="failed! performance already exists.";
		}else{
		$q="insert into scores(quiz_id,user_id,total_score) values(:quiz_id,:user_id,:total_score)";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_id",$quiz_id);
		$stmt->bindParam(":user_id",$user_id);
		$stmt->bindParam(":total_score",$total_score);
		$stmt->execute();
		$error="success";
	}
	return $error;
	}




	public function update($quiz_id,$user_id,$totlal_score){
		$error="";
		
		$q=new performance($performance_name);
		if ($q->performance_exists <1) {
			$error="failed! performance name does NOT exist.";
		}else{
$q="update scores set quiz_id=:quiz_id,user_id=:user_id,total_score=:total_score  where tid=:performance_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_id",$quiz_id);
		$stmt->bindParam(":user_id",$user_id);
		$stmt->bindParam(":total_score",$total_score);
		$stmt->bindParam(":tid",$this->performance_id);
		$stmt->execute();
		$error="success";
	}
	return $error;
	}



	public function remove($performance_id){
		$error="";
		$q=new performance($performance_id);
		if ($q->performance_exists <1) {
			$error="failed! performance name does exists.";
		}else{
		$q="delete from scores where tid=:performance_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":performance_id",$performance_id);
		$stmt->execute();
		$error="success";
	}
	return $error;
	}

	public function listPerformance($quiz_id=""){
		$return=array();
		$q="select *from scores where quiz_id=:quiz_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_id",$quiz_id);
		$stmt->execute();
		$rows=$stmt->rowCount();
		while($y=$stmt->fetch(PDO::FETCH_ASSOC)){
			$d=array();
		
			$d['user_id']=$y['user_id'];
			$d['score']=$y['total_score'];
			$d['date']=$y['date'];
			array_push($return, $d);
		}
		return $return;
	}


	public function listMyQuizes($user_id=""){
		$return=array();
		$q="select *from scores where user_id=:quiz_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_id",$user_id);
		$stmt->execute();
		$rows=$stmt->rowCount();
		while($y=$stmt->fetch(PDO::FETCH_ASSOC)){
			$d=array();
			
			$d['quiz_id']=$y['quiz_id'];
			$d['user_id']=$y['user_id'];
			$d['score']=$y['total_score'];
			$d['date']=$y['date'];
			array_push($return, $d);
		}
		return $return;
	}
}



 ?>