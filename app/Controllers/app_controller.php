<?php
class App_controller extends Controller{

	public function __construct($f3){
		parent::__construct();
		$f3->set('CACHE','memcache=localhost');
		//new Session();
		session_start();
		$f3->set('error', '');	
		$f3->set('message','');
		$f3->set('color','');
	}

	//page d'accueil
	public function home($f3){
		$f3->set('content','home.htm');
	}



	//page de notification
	public function getNotification($f3){
		$f3->set('content','notif.htm');
	}

	//page de profil
	public function getMember($f3){
		$f3->set('content','Member.htm');
	}

	//page de vision d'un utilisateur
	public function getUsers($f3){
		$f3->set('content','Users.htm');
	}

	//page de résultat
	public function getResults($f3){
		$f3->set('content','Results.htm');	
	}


	public function getTestThib($f3){
		//echo 'ok';
		$result = $this->model->getResultTestThib($f3->get('PARAMS.beta'));
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
	}

	/**************************************************************************************************/
	/**************************************** Code Kévin ***************************************************/
	/**************************************************************************************************/

	public 	function getTestKev($f3){
		$f3->set('content','PageKev.htm');	
	}

	/* page d'accueil en loggé */
	public function homeLog($f3){
		if(!$f3->get('SESSION.ID')){
			$f3->reroute('/');
		}else{
			$f3->set('content','homeLog.htm');
		}
	}

	/* formulaire d'inscription et inscription : envoie sur la page profil */
	public function signup($f3){
		switch($f3->get('VERB')){
			case 'GET':
				$f3->set('content','signup.htm');
			break;
			case 'POST':
				if($f3->get('POST.mail')!="" && $f3->get('POST.mdp1')!="" && $f3->get('POST.mdp2')!=""){
					if($f3->get('POST.majority')=="majeur"){
						if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $f3->get('POST.mail'))){
							if($f3->get('POST.mdp1')==$f3->get('POST.mdp2')){
								$ajout = $this->model->signUpUser($f3->get('POST.mail'), sha1($f3->get('POST.mdp1')));
								if(!$ajout){
									$f3->set('error', $f3->get('loginSingUpError'));
									$f3->set('content','signup.htm');
								}else{
									$user=array('ID'=>$ajout['user_mail'],'firstname'=>$ajout['user_firstname'],'lastname'=>$ajout['user_lastname']);
									$f3->set('SESSION', $user);
									$f3->reroute('/profil');
								}
							}else{
								$f3->set('error', $f3->get('uniqueMDPError'));
								$f3->set('content','signup.htm');
							}
						}else{
							$f3->set('error', $f3->get('adMailError'));
							$f3->set('content','signup.htm');
						}
					}else{
						$f3->set('error', $f3->get('majorityError'));
						$f3->set('content','signup.htm');
					}
				}else{
					$f3->set('error', $f3->get('fieldsError'));
					$f3->set('content','signup.htm');
				}
			break;
		}
	}

	/* sign in : renvoie sur la page home en loggé (homeLog) */
	public function signin($f3){
		if($f3->get('POST.mail')!="" && $f3->get('POST.mdp')!=""){
			if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $f3->get('POST.mail'))){
				$userSign = $this->model->signInUser($f3->get('POST.mail'),sha1($f3->get('POST.mdp')));
		        if(!$userSign){
			        $f3->set('error', $f3->get('mdpError'));
					$f3->set('content','home.htm');
		        }else{
		          	$user=array('ID'=>$userSign['user_mail'],'firstname'=>$userSign['user_firstname'],'lastname'=>$userSign['user_lastname']);
					$f3->set('SESSION',$user);
					$f3->set('content','homeLog.htm');
		        }
			}else{
				$f3->set('error', $f3->get('adMailError'));
				$f3->set('content','home.htm');
			}
		}else{
			$f3->set('error', $f3->get('fieldsError'));
			$f3->set('content','home.htm');
		}
	}


	/* page profil si on est loggé sinon retour sur home non loggé */
	public function getProfil($f3){
		if(!$f3->get('SESSION.ID')){
			$f3->reroute('/');
		}else{
			$userProfil = $this->model->getUserProfil($f3->get('SESSION.ID'));
			$f3->set('result',$userProfil);
			$f3->set('content','profil.htm');
		}
	}

	/* formulaire de modification des données du profil si on est loggé sinon retour home non loggé */
	public function formProfilModif($f3){
		if(!$f3->get('SESSION.ID')){
			$f3->reroute('/');
		}else{
			$userProfil = $this->model->getUserProfil($f3->get('SESSION.ID'));
			$f3->set('result',$userProfil);
			$f3->set('content','formProfilModif.htm');
		}

	}

	/* modification des données utlisateurs : renvoie sur le formulaire pour modifier les données */
	public function modifyProfil($f3){
		if(!$f3->get('SESSION.ID')){
			$f3->reroute('/');
		}else{
			if($f3->get('POST.prenom')!="" || $f3->get('POST.nom')!="" || $f3->get('POST.street')!="" || $f3->get('POST.town')!=""  || $f3->get('POST.cp')!=""){

				$userOld = $this->model->getUserProfil($f3->get('SESSION.ID'));

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

				$userNew = $this->model->modifyUserProfil($f3->get('SESSION.ID'),$f3->get('nom'),$f3->get('prenom'),$f3->get('street'),$f3->get('town'),$f3->get('cp'));
				$user=array('ID'=>$userNew[0]['user_mail'],'firstname'=>$userNew[0]['user_firstname'],'lastname'=>$userNew[0]['user_lastname']);
				$f3->set('SESSION',$user);

				$userProfil = $this->model->getUserProfil($f3->get('SESSION.ID'));
				$f3->set('result',$userProfil);
				$f3->set('message',$f3->get('modificationValid'));
				$f3->set('color','green');
				$f3->set('content','formProfilModif.htm');

			}else{
				$userProfil = $this->model->getUserProfil($f3->get('SESSION.ID'));
				$f3->set('result',$userProfil);
				$f3->set('color','red');
				$f3->set('message',$f3->get('modificationError'));
				$f3->set('content','formProfilModif.htm');
			}
		}
	}

	/* upload avatar */
	public function uploadAvatar($f3){
		if(!$f3->get('SESSION.ID')){
			$f3->reroute('/');
		}else{
			if($_FILES['img']['size']==0){
				$user = $this->model->getUserProfil($f3->get('SESSION.ID'));
				$f3->set('result',$user);
				$f3->set('message',$f3->get('imageError'));
				$f3->set('color','red');
				$f3->set('content','formProfilModif.htm');
			}else{
				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
				$extension_upload = strtolower(  substr(  strrchr($_FILES['img']['name'], '.')  ,1)  );
				if ( in_array($extension_upload,$extensions_valides) ){

					$user = $this->model->getUserProfil($f3->get('SESSION.ID'));
					$_FILES['img']['name']=$user[0]['user_id'].".".$extension_upload;
					
			        \Web::instance()->receive(function($file){},true,true);

			        $imgAdd = $this->model->addAvatar($f3->get('SESSION.ID'), $_FILES['img']['name']);
			        print_r($imgAdd);

					$f3->set('result',$user);
					$f3->set('message',$f3->get('modificationValid'));
					$f3->set('color','green');
					$f3->set('content','formProfilModif.htm');
				}else{
					$user = $this->model->getUserProfil($f3->get('SESSION.ID'));
					$f3->set('result',$user);
					$f3->set('message',$f3->get('imageExtensionError'));
					$f3->set('color','red');
					$f3->set('content','formProfilModif.htm');
				}
			}
	    }     
	}

	/* modifier l'adresse mail (identifiant), retourne 1 si c'est bon, 0 si il y a une erreure */
	public function modifyMail($f3){
		if(!$f3->get('SESSION.ID')){
			$f3->reroute('/');
		}else{
			if($f3->get('POST.mail1')!="" && $f3->get('POST.mail2')!="" && $f3->get('POST.mail3')!=""){
				if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $f3->get('POST.mail1')) && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $f3->get('POST.mail2')) && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $f3->get('POST.mail3'))){
					if($f3->get('POST.mail2')==$f3->get('POST.mail3')){
						$changeMdp = $this->model->changeMail($f3->get('SESSION.ID'),$f3->get('POST.mail2'));
						//print_r($changeMdp);
						if($changeMdp['confirm']==1){
							$f3->set('SESSION.ID',$changeMdp['user'][0]['user_mail']);
							$userProfil = $this->model->getUserProfil($f3->get('SESSION.ID'));
							$f3->set('result',$userProfil);
							$f3->set('color','green');
							$f3->set('message',$f3->get('modificationValid'));
							$f3->set('content','formProfilModif.htm');
						}else{
							$userProfil = $this->model->getUserProfil($f3->get('SESSION.ID'));
							$f3->set('result',$userProfil);
							$f3->set('color','red');
							$f3->set('message',$f3->get('modificationError'));
							$f3->set('content','formProfilModif.htm');
						}
					}else{
						$userProfil = $this->model->getUserProfil($f3->get('SESSION.ID'));
						$f3->set('result',$userProfil);
						$f3->set('color','red');
						$f3->set('message',$f3->get('uniqueMailError'));
						$f3->set('content','formProfilModif.htm');
					}
				}else{
					$userProfil = $this->model->getUserProfil($f3->get('SESSION.ID'));
					$f3->set('result',$userProfil);
					$f3->set('color','red');
					$f3->set('message',$f3->get('adMailError'));
					$f3->set('content','formProfilModif.htm');
				}
			}else{
				$userProfil = $this->model->getUserProfil($f3->get('SESSION.ID'));
				$f3->set('result',$userProfil);
				$f3->set('color','red');
				$f3->set('message',$f3->get('fieldsError'));
				$f3->set('content','formProfilModif.htm');
			}
		}
	}

	/* modifier le mot de passe, retourne 1 si c'est bon, 0 si il y a une erreure */
	public function modifyMDP($f3){
		if(!$f3->get('SESSION.ID')){
			$f3->reroute('/');
		}else{
			if($f3->get('POST.mdp1')!="" && $f3->get('POST.mdp2')!="" && $f3->get('POST.mdp3')!=""){
				if($f3->get('POST.mdp2')==$f3->get('POST.mdp3')){
					$changeMdp = $this->model->changeMdp($f3->get('SESSION.ID'),sha1($f3->get('POST.mdp1')),sha1($f3->get('POST.mdp2')));

					if($changeMdp==1){
						$userProfil = $this->model->getUserProfil($f3->get('SESSION.ID'));
						$f3->set('result',$userProfil);
						$f3->set('color','green');
						$f3->set('message',$f3->get('modificationValid'));
						$f3->set('content','formProfilModif.htm');
					}else{
						$userProfil = $this->model->getUserProfil($f3->get('SESSION.ID'));
						$f3->set('result',$userProfil);
						$f3->set('color','red');
						$f3->set('message',$f3->get('modificationError'));
						$f3->set('content','formProfilModif.htm');
					}

				}else{
					$userProfil = $this->model->getUserProfil($f3->get('SESSION.ID'));
					$f3->set('result',$userProfil);
					$f3->set('color','red');
					$f3->set('message',$f3->get('uniqueMDPError'));
					$f3->set('content','formProfilModif.htm');
				}
			}else{
				$userProfil = $this->model->getUserProfil($f3->get('SESSION.ID'));
				$f3->set('result',$userProfil);
				$f3->set('color','red');
				$f3->set('message',$f3->get('fieldsError'));
				$f3->set('content','formProfilModif.htm');
			}
		}
	}

	/* sign out */
	public function loggout($f3){
		session_destroy();
    	$f3->reroute('/');
	}

	/**************************************************************************************************/
	/**************************************** Fin code Kévin ***************************************************/
	/**************************************************************************************************/





	/***************** Code Améziane ******************/

	public function homeAmeziane($f3){

		//$app_controller = new App_controller();

		//Affichage d'un vin aléatoire 
    	$f3->set('randomWine', $this->getRandomWine($f3));
		$f3->set('content','pageAmez.htm');
	}

	//Afficher un vin aléatoire
	public function getRandomWine($f3){

    	$id = rand(1,10);
    	//print_r($id);

    	$randomWine=$this->model->getRandomWine($id);

		return $randomWine;

	}

	/***************** Code Améziane ******************/


}
?>
