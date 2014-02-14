<?php
class App_controller{

	function __construct($f3){
		$f3->set('CACHE','memcache=localhost');
		//new Session();
		session_start();
		$f3->set('error', '');	
		$f3->set('message','');
		$f3->set('color','');
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
		$result = $model->getResultTestThib($f3,$f3->get('PARAMS.beta'));
 		//$f3->set('users',$model->getUsers($f3,array('alpha'=>$f3->get('PARAMS.alpha'))));
 		//$model->getResultTest($f3,$f3->get('PARAMS.beta'));
		$f3->set('plop',$f3->get('PARAMS.beta'));
		//$lien=new array;
		$f3->set('result',$result);
				//	$f3->set('lien',$lien);

		//echo Template::instance()->render('PageThib.htm');
		//$f3->set('result',$f3->get('dB')->exec('SELECT user_lastname FROM userwine'));
		//echo Template::instance()->render('abc.htm');
		$f3->set('content','PageThib.htm');
		$template=new Template;
		echo $template->render('layout.htm');

	}

	/**************************************************************************************************/
	/**************************************** Code Kévin ***************************************************/
	/**************************************************************************************************/

	function getTestKev($f3){
		$f3->set('content','PageKev.htm');
		$template=new Template;
		echo $template->render('layout.htm');	
	}

	/* page d'accueil en loggé */
	function homeLog($f3){
		if(!$f3->get('SESSION.ID')){
			$f3->reroute('/');
		}else{
			$f3->set('content','homeLog.htm');
			$template=new Template;
			echo $template->render('layout.htm');
		}
	}

	/* formulaire d'inscription et inscription : envoie sur la page profil */
	function signup($f3){
		switch($f3->get('VERB')){
			case 'GET':
				$f3->set('content','signup.htm');
				$template=new Template;
				echo $template->render('layout.htm');
			break;
			case 'POST':
				if($f3->get('POST.mail')!="" && $f3->get('POST.mdp1')!="" && $f3->get('POST.mdp2')!=""){
					if($f3->get('POST.majority')=="majeur"){
						if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $f3->get('POST.mail'))){
							if($f3->get('POST.mdp1')==$f3->get('POST.mdp2')){
								$model = new App_model();
								$ajout = $model->signUpUser($f3,$f3->get('POST.mail'), sha1($f3->get('POST.mdp1')));
								//print_r($ajout['user'][0]['user_mail']);
								if($ajout['confirm']==1){
									$user=array('ID'=>$ajout['user'][0]['user_mail'],'firstname'=>$ajout['user'][0]['user_firstname'],'lastname'=>$ajout['user'][0]['user_lastname']);
									$f3->set('SESSION', $user);
									$f3->reroute('/profil');
									//print_r($f3->get('SESSION.ID'));
								}else{
									$f3->set('error', $f3->get('loginSingUpError'));
									$f3->set('content','signup.htm');
									$template=new Template;
									echo $template->render('layout.htm');
								}
							}else{
								$f3->set('error', $f3->get('uniqueMDPError'));
								$f3->set('content','signup.htm');
								$template=new Template;
								echo $template->render('layout.htm');
							}
						}else{
							$f3->set('error', $f3->get('adMailError'));
							$f3->set('content','signup.htm');
							$template=new Template;
							echo $template->render('layout.htm');
						}
					}else{
						$f3->set('error', $f3->get('majorityError'));
						$f3->set('content','signup.htm');
						$template=new Template;
						echo $template->render('layout.htm');
					}
				}else{
					$f3->set('error', $f3->get('fieldsError'));
					$f3->set('content','signup.htm');
					$template=new Template;
					echo $template->render('layout.htm');
				}
			break;
		}
	}

	/* sign in : renvoie sur la page home en loggé (homeLog) */
	function signin($f3){
		if($f3->get('POST.mail')!="" && $f3->get('POST.mdp')!=""){
			if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $f3->get('POST.mail'))){
				$model = new App_model();
				$userSign = $model->signInUser($f3,$f3->get('POST.mail'),sha1($f3->get('POST.mdp')));
				//print_r($userSign);
				if($userSign['confirm']==1){
					$user=array('ID'=>$userSign['user'][0]['user_mail'],'firstname'=>$userSign['user'][0]['user_firstname'],'lastname'=>$userSign['user'][0]['user_lastname']);
					$f3->set('SESSION',$user);
					$f3->set('content','homeLog.htm');
					$template=new Template;
					echo $template->render('layout.htm');
				}else{
					$f3->set('error', $f3->get('mdpError'));
					$f3->set('content','home.htm');
					$template=new Template;
					echo $template->render('layout.htm');
				}
			}else{
				$f3->set('error', $f3->get('adMailError'));
				$f3->set('content','home.htm');
				$template=new Template;
				echo $template->render('layout.htm');
			}
		}else{
			$f3->set('error', $f3->get('fieldsError'));
			$f3->set('content','home.htm');
			$template=new Template;
			echo $template->render('layout.htm');
		}
	}


	/* page profil si on est loggé sinon retour sur home non loggé */
	function getProfil($f3){
		if(!$f3->get('SESSION.ID')){
			$f3->reroute('/');
		}else{
			$model = new App_model();
			$userProfil = $model->getUserProfil($f3,$f3->get('SESSION.ID'));
			$f3->set('result',$userProfil);
			$f3->set('content','profil.htm');
			$template=new Template;
			echo $template->render('layout.htm');
		}
	}

	/* formulaire de modification des données du profil si on est loggé sinon retour home non loggé */
	function formProfilModif($f3){
		if(!$f3->get('SESSION.ID')){
			$f3->reroute('/');
		}else{
			$model = new App_model();
			$userProfil = $model->getUserProfil($f3,$f3->get('SESSION.ID'));
			$f3->set('result',$userProfil);
			$f3->set('content','formProfilModif.htm');
			$template=new Template;
			echo $template->render('layout.htm');
		}

	}

	/* modification des données utlisateurs : renvoie sur le formulaire pour modifier les données */
	function modifyProfil($f3){
		if(!$f3->get('SESSION.ID')){
			$f3->reroute('/');
		}else{
			if($f3->get('POST.prenom')!="" || $f3->get('POST.nom')!="" || $f3->get('POST.street')!="" || $f3->get('POST.town')!=""  || $f3->get('POST.cp')!=""){

				$model = new App_model();
				$userOld = $model->getUserProfil($f3,$f3->get('SESSION.ID'));

				if($f3->get('POST.nom')!=""){
					$f3->set('nom',$f3->get('POST.nom'));
				}else{
					$f3->set('nom',$userOld[0]['user_lastname']);
				}

				if($f3->get('POST.prenom')!=""){
					$f3->set('prenom',$f3->get('POST.prenom'));
				}else{
					$f3->set('prenom',$userOld[0]['user_firstname']);
				}

				if($f3->get('POST.street')!=""){
					$f3->set('street',$f3->get('POST.street'));
				}else{
					$f3->set('street',$userOld[0]['user_street']);
				}

				if($f3->get('POST.cp')!=""){
					$f3->set('cp',$f3->get('POST.cp'));
				}else{
					$f3->set('cp', $userOld[0]['user_cp']);
				}

				if($f3->get('POST.town')!=""){
					$f3->set('town',$f3->get('POST.town'));
				}else{
					$f3->set('town',$userOld[0]['user_town']);
				}

				$userNew = $model->modifyUserProfil($f3,$f3->get('SESSION.ID'),$f3->get('nom'),$f3->get('prenom'),$f3->get('street'),$f3->get('town'),$f3->get('cp'));
				$f3->set('SESSION.ID',$userNew[0]['user_mail']);

				$userProfil = $model->getUserProfil($f3,$f3->get('SESSION.ID'));
				$f3->set('result',$userProfil);
				$f3->set('message',$f3->get('modificationValid'));
				$f3->set('color','green');
				$f3->set('content','formProfilModif.htm');
				$template=new Template;
				echo $template->render('layout.htm');

			}else{
				$model = new App_model();
				$userProfil = $model->getUserProfil($f3,$f3->get('SESSION.ID'));
				$f3->set('result',$userProfil);
				$f3->set('color','red');
				$f3->set('message',$f3->get('modificationError'));
				$f3->set('content','formProfilModif.htm');
				$template=new Template;
				echo $template->render('layout.htm');
			}
		}
	}

	/* en cours */
	function modifyMDP($f3){
		if(!$f3->get('SESSION.ID')){
			$f3->reroute('/');
		}else{
			if($f3->get('POST.mdp1')!="" && $f3->get('POST.mdp2')!="" && $f3->get('POST.mdp3')!=""){
				if($f3->get('POST.mdp2')==$f3->get('POST.mdp3')){
					$model = new App_model();
					$changeMdp = $model->changeMdp($f3,$f3->get('SESSION.ID'),sha1($f3->get('POST.mdp1')),sha1($f3->get('POST.mdp2')));

					if($changeMdp==1){

					}else{
						
					}

					/*
					$userNew = $model->modifyUserProfil($f3,$f3->get('SESSION.ID'),$f3->get('nom'),$f3->get('prenom'),$f3->get('street'),$f3->get('town'),$f3->get('cp'));
					$f3->set('SESSION.ID',$userNew[0]['user_mail']);

					$f3->reroute('/formProfilModif');
					*/

				}else{
					$model = new App_model();
					$userProfil = $model->getUserProfil($f3,$f3->get('SESSION.ID'));
					$f3->set('result',$userProfil);
					$f3->set('color','red');
					$f3->set('message',$f3->get('uniqueMDPError'));
					$f3->set('content','formProfilModif.htm');
					$template=new Template;
					echo $template->render('layout.htm');
				}
			}else{
				$model = new App_model();
				$userProfil = $model->getUserProfil($f3,$f3->get('SESSION.ID'));
				$f3->set('result',$userProfil);
				$f3->set('color','red');
				$f3->set('message',$f3->get('fieldsError'));
				$f3->set('content','formProfilModif.htm');
				$template=new Template;
				echo $template->render('layout.htm');
			}
		}
	}

	/* sign out */
	function loggout($f3){
		session_destroy();
    	$f3->reroute('/');
	}

	/**************************************************************************************************/
	/**************************************** Fin code Kévin ***************************************************/
	/**************************************************************************************************/



	function getTestAmez($f3){
		$f3->set('content','PageAmez.htm');
		$template=new Template;
		echo $template->render('layout.htm');	
	}



}
?>