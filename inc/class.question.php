<?php
include_once("autoload.php");
class question extends connection
{
	var $question_id,$no_of_questions,$question_exists,$question_details,$question_exists_by_id,$question_details_by_id;
	function __construct($question_id=""){
		$this->question_id=$question_id;
		parent::__construct();
		$q="select *from questions where question_name=:question_name";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":question_name",$this->question_id);
		$stmt->execute();
		$this->question_exists=$stmt->rowCount();
		$this->question_details=$stmt->fetch(PDO::FETCH_ASSOC);


		$qid="select *from questions where question_id=:question_id";
		$stmtid=$this->con->prepare($qid);
		$stmtid->bindParam(":question_id",$this->question_id);
		$stmtid->execute();
		$this->question_exists_by_id=$stmtid->rowCount();
		$this->question_details_by_id=$stmtid->fetch(PDO::FETCH_ASSOC);
	}

	public function create($question,$option_1,$option_2,$option_3,$option_4,$correct_answer,$quiz_id,$correct_answer,$created_by,$diagrams=""){
		$error="";

		$qx=new question($this->question_id);
		if ($qx->question_exists >0) {
			$error="failed! question already exists.";
		}else{
		$q="insert into questions(question,option_1,option_2,option_3,option_4,correct_answer,quiz_id,diagrams,created_by) values(:question,:option_1,:option_2,:option_3,:option_4,:correct_answer,:quiz_id,:diagrams,:created_by)";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":question",$question);
		$stmt->bindParam(":option_1",$option_1);
		$stmt->bindParam(":option_2",$option_2);
		$stmt->bindParam(":option_3",$option_3);
		$stmt->bindParam(":option_4",$option_4);
		$stmt->bindParam(":quiz_id",$quiz_id);
		$stmt->bindParam(":correct_answer",$correct_answer);
		$stmt->bindParam(":diagrams",$diagrams);
		$stmt->bindParam(":created_by",$created_by);
		$stmt->execute();
		$error="success";
	}
	return $error;
	}




	public function update($question,$option_1,$option_2,$option_3,$option_4,$correct_answer,$quiz_id,$correct_answer,$created_by,$diagrams=""){
		$error="";
		
		$q=new question($question_name);
		if ($q->question_exists <1) {
			$error="failed! question name does NOT exist.";
		}else{
$q="insert into questions set question=:question,option_1=:option_1,option_2=:option_2,option_3=:option_3,option_4=:option_4,correct_answer=:correct_answer,diagrams=:diagrams where question_id=:question_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":question",$question);
		$stmt->bindParam(":option_1",$option_1);
		$stmt->bindParam(":option_2",$option_2);
		$stmt->bindParam(":option_3",$option_3);
		$stmt->bindParam(":option_4",$option_4);
		$stmt->bindParam(":correct_answer",$correct_answer);
		$stmt->bindParam(":diagrams",$diagrams);
		$stmt->bindParam(":created_by",$created_by);
		$stmt->bindParam(":question_id",$this->question_id);
		$stmt->execute();
		$error="success";
	}
	return $error;
	}



	public function remove($question_id){
		$error="";
		$q=new question($question_id);
		if ($q->question_exists <1) {
			$error="failed! question name does exists.";
		}else{
		$q="delete from questions where question_id=:question_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":question_id",$question_id);
		$stmt->execute();
		$error="success";
	}
	return $error;
	}

	public function listQuestions($quiz_id=""){
		$return=array();
		$q="select *from questions where quiz_id=:quiz_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":quiz_id",$quiz_id);
		$stmt->execute();
		$rows=$stmt->rowCount();
		while($y=$stmt->fetch(PDO::FETCH_ASSOC)){
			$d=array();
			$d['question']=$y['question'];
			$d['question_id']=$y['question_id'];
			$d['question_id']=$y['question_id'];
			$d['option_1']=$y['option_1'];
			$d['option_2']=$y['option_2'];
			$d['option_3']=$y['option_3'];
			$d['option_3']=$y['option_3'];
			$d['option_4']=$y['option_4'];
			$d['date']=$y['date'];
			$d['answer']=$y['correct_answer'];
			array_push($return, $d);
		}
		return $return;
	}
}



 ?>