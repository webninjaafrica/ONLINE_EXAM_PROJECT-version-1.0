<?php 
spl_autoload_register(function($class){
	include_once "includes/class.".$class.".php";
}); ?>