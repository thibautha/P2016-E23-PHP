<?php
class App_controller{

	function __construct(){

	}

	function home($f3){
		$f3->set('content','partials/home.htm');
		$template=new Template;
		echo $template->render('layout.htm');
		//echo View::instance()->render('layout.htm');
	}

	function getNotification($f3){
		$f3->set('content','partials/notif.htm');
		$template=new Template;
		echo $template->render('layout.htm');
		//echo View::instance()->render('layout.htm');
	}


}