<?php

$f3=require('lib/base.php');
$f3->config('config/config.ini');
$f3->config('config/routes.ini');

//$f3->set('dB',new DB\SQL('mysql:host=localhost;port=8889;dbname=alanotre','root','root'));
$f3->set('dB',new DB\SQL('mysql:host=localhost;port=3306;dbname=alanotre','root',''));


$f3->run();
