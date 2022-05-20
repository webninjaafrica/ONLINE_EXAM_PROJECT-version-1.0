<?php
include_once("autoload.php");
class quiz extends connection
{
	var $quiz_id,$no_of_questions,$quiz_exists,$quiz_details,$quiz_exists_by_id,$quiz_details_by_id;
	function __construct($quiz_id=""){
		$this->quiz_id=$quiz_id;
		parent::__construct();
		$q="select *from quiz_type where quiz_name=:quiz_name";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_name",$this->quiz_id);
		$stmt->execute();
		$this->quiz_exists=$stmt->rowCount();
		$this->quiz_details=$stmt->fetch(PDO::FETCH_ASSOC);


		$qid="select *from quiz_type where quiz_id=:quiz_id";
		$stmtid=$this->con->prepare($qid);
		$stmtid->bindParam(":quiz_id",$this->quiz_id);
		$stmtid->execute();
		$this->quiz_exists_by_id=$stmtid->rowCount();
		$this->quiz_details_by_id=$stmtid->fetch(PDO::FETCH_ASSOC);
	}

	public function create($created_by,$deadline_date,$category_id="0",$command="create"){
		$error="";

		$qx=new quiz($this->quiz_id);
		if ($qx->quiz_exists >0) {
			$error="failed! quiz name already exists.";
		}else{
		$q="insert into quiz_type(quiz_name,created_by,deadline_date,category_id) values(:quiz_name,:created_by,:deadline_date,:category_id)";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_name",$this->quiz_id);
		$stmt->bindParam(":created_by",$created_by);
		$stmt->bindParam(":deadline_date",$deadline_date);
		$stmt->bindParam(":category_id",$category_id);
		$stmt->execute();
		$error="success";
	}
	return $error;
	}




	public function update($quiz_name,$deadline_date,$category_id="0"){
		$error="";
		
		$q=new quiz($quiz_name);
		if ($q->quiz_exists <1) {
			$error="failed! quiz name does NOT exist.";
		}else{
$q="update quiz_type set quiz_name=:quiz_name,deadline_date=:deadline_date,category_id=:category_id where quiz_id=:quiz_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_name",$quiz_name);
		$stmt->bindParam(":deadline_date",$deadline_date);
		$stmt->bindParam(":category_id",$category_id);
		$stmt->bindParam(":quiz_id",$this->quiz_id);
		$stmt->execute();
		$error="success";
	}
	return $error;
	}



	public function remove($quiz_name){
		$error="";
		$q=new quiz($quiz_name);
		if ($q->quiz_exists <1) {
			$error="failed! quiz name does exists.";
		}else{
		$q="delete from quiz_type where quiz_id=:quiz_name";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_name",$quiz_name);
		$stmt->execute();
		$error="success";
	}
	return $error;
	}

	public function listQuizTypes($created_by=""){
		$return=array();
		$q="select *from quiz_type";
		if (!empty($created_by)) {
			$q="select *from quiz_type where created_by=:created_by";
		}
		$stmt=$this->con->prepare($q);
		if (!empty($created_by)) {
			$stmt->bindParam(":created_by",$created_by);
		}
		$stmt->execute();
		$rows=$stmt->rowCount();
		while($y=$stmt->fetch(PDO::FETCH_ASSOC)){
			$d=array();
			$d['name']=$y['quiz_name'];
			$d['id']=$y['quiz_id'];
			$d['owner']=$y['created_by'];
			$d['created']=$y['created_date'];
			$d['deadline']=$y['deadline_date'];
			$d['class']=$y['category_id'];
			array_push($return, $d);
		}
		return $return;
	}
}



 ?>