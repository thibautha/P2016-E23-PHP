<?php

$f3=require('lib/base.php');
$f3->set('CACHE',FALSE);
$f3->config('config/config.ini');
$f3->config('config/routes.ini');

$f3->run();

?>