<?php
class Model{
  
private $dB;
  
  function __construct(){
    $f3=\Base::instance();
    $this->dB=new \DB\SQL('mysql:host='.$f3->get('db_host').';port=8889;dbname='.$f3->get('db_server'),$f3->get('db_login'),$f3->get('db_password'));
  }
  
  function getMapper($table){
    return new \DB\SQL\Mapper($this->dB,$table);
  }
  
}

?>