<?php class session
{
	var $session_name;
	function __construct($session_name="")
	{
		$this->session_name=$session_name;
		
	}

	public function setValue($value){
		$_SESSION[$this->session_name]=$value;
	}

	public function begin(){
		session_start();
	}

	public function listSesions(){
		return $this->json_format=json_encode($_SESSION);
	}
	public function _end(){
		session_destroy();
	}

	public function unsetAll(){

		$ses=$_SESSION;
		foreach($ses as $key=>$val){
			$session=$key;
			unset($_SESSION[$session]);
		}
		session_destroy();
	}
	public function setHeader($content){
		header($content);

	}


}
?>