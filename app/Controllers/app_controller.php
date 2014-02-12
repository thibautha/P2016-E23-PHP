<?php
class App_controller{

	function __construct(){

	}

	//page d'accueil
	function home($f3){
		$f3->set('content','home.htm');
		$template=new Template;
		echo $template->render('layout.htm');
	}

	//page de notification
	function getNotification($f3){
		$f3->set('content','notif.htm');
		$template=new Template;
		echo $template->render('layout.htm');
	}

	//page de profil
	function getMember($f3){
		$f3->set('content','Member.htm');
		$template=new Template;
		echo $template->render('layout.htm');
	}

	//page de vision d'un utilisateur
	function getUsers($f3){
		$f3->set('content','Users.htm');
		$template=new Template;
		echo $template->render('layout.htm');	
	}

	//page de résultat
	function getResults($f3){
		$f3->set('content','Results.htm');
		$template=new Template;
		echo $template->render('layout.htm');	
	}


	function getTestThib($f3){
		//echo 'ok';
		$model=new App_model();
		$f3->set('result',$model->getResultTest($f3,array('beta'=>$f3->get('PARAMS.beta'))));
 		//$f3->set('users',$model->getUsers($f3,array('alpha'=>$f3->get('PARAMS.alpha'))));
 		//$model->getResultTest($f3,$f3->get('PARAMS.beta'));
		$f3->set('beta',$f3->get('PARAMS.beta'));
		//$f3->set('result',$result);
		echo Template::instance()->render('abc.htm');
		//$f3->set('result',$f3->get('dB')->exec('SELECT user_lastname FROM userwine'));
		//echo Template::instance()->render('abc.htm');

	}

	function getTestKev($f3){
		$f3->set('content','PageKev.htm');
		$template=new Template;
		echo $template->render('layout.htm');	
	}




	function getTestAmez($f3){
		$f3->set('content','PageAmez.htm');
		$template=new Template;
		echo $template->render('layout.htm');	
	}


}










