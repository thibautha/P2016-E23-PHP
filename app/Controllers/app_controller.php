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

function getMember($f3){
		$f3->set('content','partials/Member.htm');
		$template=new Template;
		echo $template->render('layout.htm');
}

function getUsers($f3){
		$f3->set('content','partials/Users.htm');
		$template=new Template;
		echo $template->render('layout.htm');	
}

function getResults($f3){
		$f3->set('content','partials/Results.htm');
		$template=new Template;
		echo $template->render('layout.htm');	
}

}