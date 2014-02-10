<?php

class App_model{

	function __construct(){

	}

	function getUserByID($f3,$params){
$user=new DB\SQL\Mapper($f3->get('dB'),'userwine');
    return $this->mapper->load(array('userid=?'.$params));

  
	}

}