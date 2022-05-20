<?php
include_once("autoload.php");
class answer extends connection
{
	var $performance_id,$no_of_answers,$performance_exists,$performance_details,$user_id;
	function __construct($performance_id="",$u=""){
		$this->user_id=$u;
		$this->performance_id=$performance_id;
		parent::__construct();
		$q="select *from answers where question_id=:performance and user_id=:user_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":performance",$this->performance_id);
		$stmt->bindParam(":user_id",$u);
		$stmt->execute();
		$this->performance_exists=$stmt->rowCount();
		$this->performance_details=$stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function create($question_id,$user_id,$answer,$score,$file,$quiz_id=""){
		$error="";

		$qx=new answer($question_id,$user_id);
		if ($qx->performance_exists >0) {
			$error="failed! performance already exists.";
		}else{
		$q="insert into answers(question_id,user_id,answer,score,files,quiz_id) values(:question_id,:user_id,:answer,:score,:files,:quiz_id)";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":question_id",$question_id);
		$stmt->bindParam(":user_id",$user_id);
		$stmt->bindParam(":answer",$answer);
		$stmt->bindParam(":score",$score);
		$stmt->bindParam(":files",$file);
		$stmt->bindParam(":quiz_id",$quiz_id);
		$stmt->execute();
		$error="success";
	}
	return $error;
	}



	public function listAnswers($user_id,$quiz_id){
		$q="select *from answers where quiz_id=:quiz_id and user_id=:user_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_id",$quiz_id);
		$stmt->bindParam(":user_id",$user_id);
		$stmt->execute();
		$data=array();
		while ($x=$stmt->fetch(PDO::FETCH_ASSOC)) {
			array_push($data, $x);
		}
		return $data;
	}



	public function updateMarks($user_id,$quiz_id,$question_id,$score){
		$mark_status="TOBE_MARKED_BY_TEACHER";
		$q="update answers set score=:score where quiz_id=:quiz_id and user_id=:user_id and question_id=:question_id and mark_status=:mark_status";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_id",$quiz_id);
		$stmt->bindParam(":user_id",$u);
		$stmt->bindParam(":question_id",$question_id);
		$stmt->bindParam(":score",$score);
		$stmt->bindParam(":mark_status",$mark_status);
		$stmt->execute();
		
	}





	public function listUserAnswers($quiz_id){
		$q="select distinct(user_id), quiz_id as pp from answers where quiz_id=:quiz_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_id",$quiz_id);
		$stmt->execute();
		$data=array();
		while ($x=$stmt->fetch(PDO::FETCH_ASSOC)) {
			array_push($data, $x);
		}
		return $data;
	}






	
}



 ?>