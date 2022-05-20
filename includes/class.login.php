<?php
include_once("autoload.php");

class login extends connection
{
	var $username,$user_exists,$details;
	function __construct($username="")
	{	$this->username=$username;
		parent::__construct();
		$q="select *from users where username=:username";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":username",$username);
		$stmt->execute();
		$this->user_exists=$stmt->rowCount();
		$this->details=$stmt->fetch(PDO::FETCH_ASSOC);

	}
	public function checkLogin($password){
		$password=sha1($password);
		$logged_in="ERROR";
		if ($password==$this->details['password']) {
			$logged_in="SUCCESS";
		}
		return $logged_in;
	}
	public function updateLastLogin(){
		$q="update users set last_login=:last_login where username=:username";
		$time=date("Y-m-d H:i:s");
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":username",$this->username);
		$stmt->bindParam(":last_login",$time);
		$stmt->execute();
		return true;
	}

	public function activate($id){
			$q="update users set status=:last_login where username=:username";
		$time=date("Y-m-d H:i:s");
		$a="YES";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":username",$id);
		$stmt->bindParam(":last_login",$a);
		$stmt->execute();
		$notification=new notification();
		$message="Your account was successifully activated. You can now do various tests, access revision materials and many other benefits.If You have any queries, feel free to inbox us at <a href='mailto:admin@webninjaafrica.com'>admin@webninjaafrica.com</a>, any time. <p>Regards,<br>ADMINISTRATOR";
		$title="Account Activated! ";
		$receiver=$this->username;
		$notification->send($receiver,$title,$message,"ADMINISTRATOR");
		return true;
	}



	public function showusers($role="",$status=""){
		$adata=array();
		$q="select *from users where  user_type=:role";
		if (!empty($status)) {
			$q="select *from users where  user_type=:role and added_by=:status";
		}
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":role",$role);

				if (!empty($status)) {
			$stmt->bindParam(":status",$status);
		}
		$stmt->execute();
		while ($s=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$e=array();
			$e["names"]=$s['first_name']." ".$s['other_names']." ".$s['last_name'];
			$e['last_login']=$s['last_login'];
			$e['id']=$s['id'];
			$e['email']=$s['email'];
			$e['tel']=$s['tel'];
			$e['username']=$s['username'];
			$e['country']=$s['country'];
			$e['activation_code']=$s['activation_code'];
			$e['status']=$s['status'];
			$e['class']=$s['classf'];
			array_push($adata, $e);
		}
		return $adata;
	}


	public function registerForLogin($username,$first_name,$last_name,$other_names,$email,$password,$user_type,$tel,$country,$classf,$county,$added_by="SELF REGISTERED"){
		$password=sha1($password);
		$u=new login($username);
		$rows=$u->user_exists;
		$error="invalid algorithim";
		if ($rows >0) {
			$error="failed. user already exists";
		}else{
		$q="insert into users (last_login,username,first_name,last_name,other_names,email,password,user_type,tel,country,classf,county,added_by) values(:last_login,:username,:first_name,:last_name,:other_names,:email,:password,:user_type,:tel,:country,:classf,:county,:added_by)";
		$time=date("Y-m-d H:i:s");
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":username",$this->username);
		$stmt->bindParam(":county",$county);
		$stmt->bindParam(":last_login",$time);
		$stmt->bindParam(":first_name",$first_name);
		$stmt->bindParam(":last_name",$last_name);
		$stmt->bindParam(":other_names",$other_names);
		$stmt->bindParam(":email",$email);
		$stmt->bindParam(":password",$password);
		$stmt->bindParam(":user_type",$user_type);
		$stmt->bindParam(":country",$country);
		$stmt->bindParam(":tel",$tel);
		$stmt->bindParam(":classf",$classf);
		$stmt->bindParam(":added_by",$added_by);
		$stmt->execute();
		$notification=new notification();
		$message="Your account was successifully created.";
		$title="Account Created";
		$receiver=$username;
		$notification->send($receiver,$title,$message);
		$error="successiful registration";
		}
		return $error;
	}

	public function updatePic($path){
		$q="update users set picture=:picture where username=:username";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":username",$this->username);
		$stmt->bindParam(":picture",$path);
		$stmt->execute();
		$notification=new notification();
		$message="Your profile picture was successifully updated.";
		$title="You updated your profile photo";
		$receiver=$this->username;
		$notification->send($receiver,$title,$message);
		return "photo updated successifully";
	}

	public function UpdateRegister($first_name,$last_name,$other_names,$email,$user_type,$id,$tel,$country){
		$q="update users set first_name=:first_name, last_name=:last_name,other_names=:other_names, email=:email, user_type=:user_type,tel=:tel,country=:country where id=:id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":first_name",$first_name);
		$stmt->bindParam(":last_name",$last_name);
		$stmt->bindParam(":other_names",$other_names);
		$stmt->bindParam(":email",$email);
		$stmt->bindParam(":user_type",$user_type);
		$stmt->bindParam(":id",$id);
		$stmt->bindParam(":country",$country);
		$stmt->bindParam(":tel",$tel);
		$stmt->execute();
		$notification=new notification();
		$message="Your details were successifully updated.";
		$title="Account Details Updated";
		$receiver=$this->username;
		$notification->send($receiver,$title,$message);
		return "successifully updated!";

	}
}
 ?>