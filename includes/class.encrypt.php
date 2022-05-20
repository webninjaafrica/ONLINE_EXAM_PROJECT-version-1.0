<?php
include_once("autoload.php");

class encrypt
{
	var $iv,$key,$data,$hide,$show;
	function __construct(){
		$this->key=hash('sha1', md5('admin4736'));
		$this->iv=substr($this->key, 0,16);
		
	}
	public function show($data){
		return openssl_decrypt(base64_decode($data),"AES-256-CBC",$this->key,0,$this->iv);
	}
	public function hide($data){
		$y=openssl_encrypt($data,"AES-256-CBC",$this->key,0, $this->iv);
		return base64_encode($y);
	}
}
 ?>