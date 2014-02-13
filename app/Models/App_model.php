<?php

class App_model{

	function __construct(){

	}


	function getResultTestThib($f3,$params){
	$result=new DB\SQL\Mapper($f3->get('dB'),'wine');
	return $result->load(array('wine_id=?',$params));
	$lien= new DB\SQL\Mapper($f3->get('dB'),'userwine');
	return $lien->load(array('user_id=?',$result['user_wine_id']));

	//$proprio=new DB\SQL\Mapper($f3->get('dB'),'userwine');
	//return $proprio->load
//array('beta'=>'5'),0
	}

	function getResultTestKev($f3,$params){

	}


	function getResultTestAmez($f3,$params){

	}

}


