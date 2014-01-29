<?php
class App_controller{



  function __construct(){
    
  }
  
  function home(){
    echo View::instance()->render('main.html');
  } 
}
?>