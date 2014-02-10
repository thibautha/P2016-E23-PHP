<?php

class App_model{

	function __construct(){

	}

	function getUserByID($f3,$params){
$user=new DB\SQL\Mapper($f3->get('dB'),'userwine');
    return $user->load(array('user_id=?',$params));
	}

	function getResultTest($f3,$params){
		$result=new DB\SQL\Mapper($f3->get('dB'),'userwine');
		return $result->find(array('user_id=?','2'));
	}
}

