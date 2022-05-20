<?php
include_once("autoload.php");
class subject extends connection
{
	var $subject_id,$no_of_subjects,$subject_exists,$subject_details,$user_id;
	function __construct($subject_id="",$user_id="p"){
		$this->subject_id=$subject_id;
		$this->user_id=$user_id;
		parent::__construct();
		$q="select *from subjects where id=:subject and user_id=:user_id";
		if ($user_id=="p") {
			$q="select *from subjects where id=:subject";
		}
		$stmt=$this->con->prepare($q);

		
		$stmt->bindParam(":subject",$this->subject_id);
	if ($user_id !=="p") {
		$stmt->bindParam(":user_id",$user_id);
	}
		$stmt->execute();
		$this->subject_exists=$stmt->rowCount();
		$this->subject_details=$stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function create($subject,$user_id,$category,$code){
		$error="";

		$qx=new subject($subject,$user_id);
		if ($qx->subject_exists >0) {
			$error="failed! subject already exists.";
		}else{
		$q="insert into subjects(subjectc,user_id,categoryc,subject_code) values(:subject,:user_id,:category,:subject_code)";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":subject",$subject);
		$stmt->bindParam(":user_id",$user_id);
		$stmt->bindParam(":category",$category);
		$stmt->bindParam(":subject_code",$code);
		$stmt->execute();
		$error="success";
	}
	return $error;
	}




	public function update($id,$subject,$category,$subject_code,$username=""){
		$error="";
		
		$q=new subject($id,$username);
		if ($q->subject_exists <1) {
			$error="failed! subject/unit id does NOT exist.";
		}else{
$qv="update subjects set subjectc=:sx, categoryc=:cy, subject_code=:sc WHERE id=:vid";
		$stmt=$this->con->prepare($qv);
		$stmt->bindParam(":sx",$subject);
		$stmt->bindParam(":cy:",$category);
		$stmt->bindParam(":sc",$subject_code);
		$stmt->bindParam(":vid",$id);
		#print_r($stmt);
		$stmt->execute();
		$error="success";

	}
	return $error;
	}



	public function remove($subject_id){
		$error="";
		$q=new subject($subject_id);
		if ($q->subject_exists <1) {
			$error="failed! subject name does exists.";
		}else{
		$q="delete from subjects where id=:subject_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":subject_id",$subject_id);
		$stmt->execute();
		$error="success";
	}
	return $error;
	}



	public function listMySubjects($user_id=""){
		$return=array();
		$q="select *from subjects";
		if (!empty($user_id)) {
		$q="select *from subjects where user_id=:user_id";
	}
		$stmt=$this->con->prepare($q);
		if (!empty($user_id)) {
			
		$stmt->bindParam(":user_id",$user_id);
		}
		$stmt->execute();
		$rows=$stmt->rowCount();
		while($y=$stmt->fetch(PDO::FETCH_ASSOC)){
			$d=array();
			
			$d['id']=$y['id'];
			$d['date_created']=$y['date_created'];
			$d['subject']=$y['subjectc'];
			$d['category']=$y['categoryc'];
			$d['subject_code']=$y['subject_code'];
			array_push($return, $d);
		}
		return $return;
	}
}



 ?>