<?php

class App_model{

	function __construct(){

	}


	function getResultTestThib($f3,$params){
	$result=new DB\SQL\Mapper($f3->get('dB'),'userwine');
	return $result->find('user_lastname like "'.$params['beta'].'%"');
	}

	function getResultTestKev($f3,$params){

	}


	function getResultTestAmez($f3,$params){

	}

}


