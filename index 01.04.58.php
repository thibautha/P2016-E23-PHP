<?php
$f3=require('lib/base.php');
$f3->config('config/config.ini');
$f3->config('config/routes.ini');

//$f3->set('dB',new DB\SQL('mysql:host=localhost;port=8889;dbname=wtfay','root','root'));


$f3->run();
?>
