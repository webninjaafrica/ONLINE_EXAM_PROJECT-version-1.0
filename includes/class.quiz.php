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

	public function create($created_by,$deadline_date,$category_id="0",$subjectc='0',$quiz_type="EXAM",$attachments="",$command="create"){
		$error="";

		$qx=new quiz($this->quiz_id);
		if ($qx->quiz_exists >0) {
			$error="failed! quiz name already exists.";
		}else{
		$q="insert into quiz_type(quiz_name,created_by,deadline_date,category_id,subjectc,quiz_type,attachments) values(:quiz_name,:created_by,:deadline_date,:category_id,:subjectc,:quiz_type,:attachments)";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_name",$this->quiz_id);
		$stmt->bindParam(":created_by",$created_by);
		$stmt->bindParam(":deadline_date",$deadline_date);
		$stmt->bindParam(":category_id",$category_id);
		$stmt->bindParam(":subjectc",$subjectc);
		$stmt->bindParam(":quiz_type",$quiz_type);
		$stmt->bindParam(":attachments",$attachments);
		$stmt->execute();
		$error="success";
	}
	return $error;
	}




	public function update($quiz_name,$deadline_date,$category_id="0",$subjectc="0",$e="HOMEWORK",$attachments=""){
		$error="";
		
		$q=new quiz($quiz_name);
		if ($q->quiz_exists <1) {
			$error="failed! quiz name does NOT exist.";
		}else{
$q="update quiz_type set quiz_name=:quiz_name,deadline_date=:deadline_date,category_id=:category_id, subjectc=:subjectc, attachments=:attachments where quiz_id=:quiz_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_name",$quiz_name);
		$stmt->bindParam(":deadline_date",$deadline_date);
		$stmt->bindParam(":category_id",$category_id);
		$stmt->bindParam(":quiz_id",$this->quiz_id);
		$stmt->bindParam(":subjectc",$subjectc);
		$stmt->bindParam(":attachments",$attachments);
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
		$typ="EXAM";
		if (!empty($created_by)) {
			$q="select *from quiz_type where created_by=:created_by and quiz_type=:quiz_type";
		}
		$stmt=$this->con->prepare($q);
		if (!empty($created_by)) {
			$stmt->bindParam(":created_by",$created_by);
		}
		$stmt->bindParam(":quiz_type",$typ);
		$stmt->execute();
		$rows=$stmt->rowCount();
		while($y=$stmt->fetch(PDO::FETCH_ASSOC)){
			$q=new subject($y['subjectc'],$created_by);
			$p=$q->subject_details;
			$d=array();
			$d['name']=$y['quiz_name'];
			$d['id']=$y['quiz_id'];
			$d['owner']=$y['created_by'];
			$d['created']=$y['created_date'];
			$d['deadline']=$y['deadline_date'];
			$d['class']=$y['category_id'];
			$d['subjectc']=$p['subjectc'];
			array_push($return, $d);
		}
		return $return;
	}



	public function listHWTypes($created_by=""){
		$return=array();
		$q="select *from quiz_type";
		$typ="HOMEWORK";
		if (!empty($created_by)) {
			$q="select *from quiz_type where created_by=:created_by and quiz_type=:quiz_type";
		}
		$stmt=$this->con->prepare($q);
		if (!empty($created_by)) {
			$stmt->bindParam(":created_by",$created_by);
		}
		$stmt->bindParam(":quiz_type",$typ);
		$stmt->execute();
		$rows=$stmt->rowCount();
		while($y=$stmt->fetch(PDO::FETCH_ASSOC)){
			$q=new subject($y['subjectc'],$created_by);
			$p=$q->subject_details;
			$d=array();
			$d['name']=$y['quiz_name'];
			$d['id']=$y['quiz_id'];
			$d['owner']=$y['created_by'];
			$d['created']=$y['created_date'];
			$d['deadline']=$y['deadline_date'];
			$d['class']=$y['category_id'];
			$d['subjectc']=$p['subjectc'];
			array_push($return, $d);
		}
		return $return;
	}




	public function listHomeWork($class,$student=""){
		$return=array();
		$q="select *from quiz_type where category_id=:category_id and quiz_type=:quiz_type";
		$quiz_type="HOMEWORK";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":category_id",$class);
		$stmt->bindParam(":quiz_type",$quiz_type);
		$stmt->execute();
		$rows=$stmt->rowCount();
		#echo $rows;
		while($y=$stmt->fetch(PDO::FETCH_ASSOC)){
			$q=new subject($y['subjectc'],"p");
			$p=$q->subject_details;
			$d=array();
			$d['name']=$y['quiz_name'];
			$d['id']=$y['quiz_id'];
			$d['owner']=$y['created_by'];
			$d['created']=$y['created_date'];
			$d['deadline']=$y['deadline_date'];
			$d['class']=$y['category_id'];
			$d['subject']=$p['subjectc'];
			$d['attachments']=$y['attachments'];
			array_push($return, $d);
		}
		return $return;
	}



	public function listEWork($class,$student=""){
		$return=array();
		$q="select *from quiz_type where category_id=:category_id and quiz_type=:quiz_type";
		$quiz_type="EXAM";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":category_id",$class);
		$stmt->bindParam(":quiz_type",$quiz_type);
		$stmt->execute();
		$rows=$stmt->rowCount();
		#echo $rows;
		while($y=$stmt->fetch(PDO::FETCH_ASSOC)){
			$q=new subject($y['subjectc'],"p");
			$p=$q->subject_details;
			$d=array();
			$d['name']=$y['quiz_name'];
			$d['id']=$y['quiz_id'];
			$d['owner']=$y['created_by'];
			$d['created']=$y['created_date'];
			$d['deadline']=$y['deadline_date'];
			$d['class']=$y['category_id'];
			$d['subject']=$p['subjectc'];
			array_push($return, $d);
		}
		return $return;
	}






	public function listQuizTypesByType($created_by="",$e="HOMEWORK"){
		$return=array();
		$q="select *from quiz_type";
		
		if (!empty($created_by)) {
			$q="select *from quiz_type where created_by=:created_by and quiz_type=:quiz_type";
		}
		$stmt=$this->con->prepare($q);
		if (!empty($created_by)) {
			$stmt->bindParam(":created_by",$created_by);
			$stmt->bindParam(":quiz_type",$e);
		}
		$stmt->execute();
		$rows=$stmt->rowCount();
		while($y=$stmt->fetch(PDO::FETCH_ASSOC)){
			$q=new subject($y['subjectc'],$created_by);
			$p=$q->subject_details;
			$d=array();
			$d['quiz_name']=$y['quiz_name'];
			$d['quiz_id']=$y['quiz_id'];
			$d['owner']=$y['created_by'];
			$d['created']=$y['created_date'];
			$d['deadline']=$y['deadline_date'];
			$d['class']=$y['category_id'];
			$d['subjectc']=$p['subjectc'];
			array_push($return, $d);
		}
		return $return;
	}
}



 ?>