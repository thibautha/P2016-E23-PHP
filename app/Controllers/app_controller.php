<?php
class App_controller extends Controller{


	public function __construct($f3){
		parent::__construct();
		session_start();
		$f3->set('error', '');	
		$f3->set('message','');
		$f3->set('color','');
		$f3->set('fav','favNo');
	}

	//page d'accueil
	public function home($f3){

		// Ajout fonction d'Améziane : afficher un vin aléatoire 
		$f3->set('randomWine', $this->getRandomWine());
		
		if(!$f3->get('SESSION.mail')){
			$f3->set('lastWines', $this->getLastWines());
			$f3->set('content','home.htm');
		}else{
			$f3->set('lastWines', $this->getFavoriteUsersLastWines($f3->get('SESSION.ID')));
			$f3->set('content','homeLog.htm');
		}
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
	/*public function homeLog($f3){
		$f3->set('randomWine', $this->getRandomWine());
		if(!$f3->get('SESSION.mail')){
			$f3->set('lastWines', $this->getLastWines());
			$f3->reroute('/');
		}else{
			print_r($f3->get('SESSION.mail'));
			print_r($f3->get('SESSION.ID'));
			$f3->set('lastFavWines', $this->getFavoriteUsersLastWines($f3->get('SESSION.ID')));
			$f3->set('content','homeLog.htm');
		}
	}*/

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
								//print_r($ajout['user_mail']);
								if(!$ajout){
									$f3->set('error', $f3->get('loginSingUpError'));
									$f3->set('content','signup.htm');
								}else{
									$user=array('mail'=>$ajout['user_mail'],'firstname'=>$ajout['user_firstname'],'lastname'=>$ajout['user_lastname'],'ID'=>$ajout['user_id']);
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
		          	$user=array('mail'=>$userSign['user_mail'],'firstname'=>$userSign['user_firstname'],'lastname'=>$userSign['user_lastname'],'ID'=>$userSign['user_id']);
					$f3->set('SESSION',$user);
					$f3->set('identifiant',$userSign['user_id']);
					$f3->reroute('/');
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
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			$userProfil = $this->model->getUserProfil($f3->get('SESSION.mail'));
			$f3->set('result',$userProfil);
			$f3->set('content','profil.htm');
		}
	}

	/* formulaire de modification des données du profil si on est loggé sinon retour home non loggé */
	public function formProfilModif($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			$userProfil = $this->model->getUserProfil($f3->get('SESSION.mail'));
			$f3->set('result',$userProfil);
			$f3->set('content','formProfilModif.htm');
		}

	}

	/* modification des données utlisateurs : renvoie sur le formulaire pour modifier les données */
	public function modifyProfil($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			if($f3->get('POST.prenom')!="" || $f3->get('POST.nom')!="" || $f3->get('POST.street')!="" || $f3->get('POST.town')!=""  || $f3->get('POST.cp')!=""){

				$userOld = $this->model->getUserProfil($f3->get('SESSION.mail'));

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

				$userNew = $this->model->modifyUserProfil($f3->get('SESSION.mail'),$f3->get('nom'),$f3->get('prenom'),$f3->get('street'),$f3->get('town'),$f3->get('cp'));
				$user=array('mail'=>$userNew[0]['user_mail'],'firstname'=>$userNew[0]['user_firstname'],'lastname'=>$userNew[0]['user_lastname'],'ID'=>$userNew[0]['user_id']);
				$f3->set('SESSION',$user);

				$userProfil = $this->model->getUserProfil($f3->get('SESSION.mail'));
				$f3->set('result',$userProfil);
				$f3->set('message',$f3->get('modificationValid'));
				$f3->set('color','green');
				$f3->set('content','formProfilModif.htm');

			}else{
				$userProfil = $this->model->getUserProfil($f3->get('SESSION.mail'));
				$f3->set('result',$userProfil);
				$f3->set('color','red');
				$f3->set('message',$f3->get('modificationError'));
				$f3->set('content','formProfilModif.htm');
			}
		}
	}

	/* upload avatar */
	public function uploadAvatar($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			if($_FILES['img']['size']==0){
				$user = $this->model->getUserProfil($f3->get('SESSION.mail'));
				$f3->set('result',$user);
				$f3->set('message',$f3->get('imageError'));
				$f3->set('color','red');
				$f3->set('content','formProfilModif.htm');
			}else{
				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
				$extension_upload = strtolower(  substr(  strrchr($_FILES['img']['name'], '.')  ,1)  );
				if ( in_array($extension_upload,$extensions_valides) ){

					$user = $this->model->getUserProfil($f3->get('SESSION.mail'));
					$_FILES['img']['name']=$user[0]['user_id'].".".$extension_upload;

			        \Web::instance()->receive(function($file){},true,true);

			        $this->model->addAvatar($f3->get('SESSION.mail'), $_FILES['img']['name']);

					$f3->set('result',$user);
					$f3->set('message',$f3->get('modificationValid'));
					$f3->set('color','green');
					$f3->set('content','formProfilModif.htm');
				}else{
					$user = $this->model->getUserProfil($f3->get('SESSION.mail'));
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
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			if($f3->get('POST.mail1')!="" && $f3->get('POST.mail2')!="" && $f3->get('POST.mail3')!=""){
				if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $f3->get('POST.mail1')) && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $f3->get('POST.mail2')) && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $f3->get('POST.mail3'))){
					if($f3->get('POST.mail2')==$f3->get('POST.mail3')){
						$changeMdp = $this->model->changeMail($f3->get('SESSION.mail'),$f3->get('POST.mail2'));
						if($changeMdp['confirm']==1){
							$f3->set('SESSION.mail',$changeMdp['user'][0]['user_mail']);
							$userProfil = $this->model->getUserProfil($f3->get('SESSION.mail'));
							$f3->set('result',$userProfil);
							$f3->set('color','green');
							$f3->set('message',$f3->get('modificationValid'));
							$f3->set('content','formProfilModif.htm');
						}else{
							$userProfil = $this->model->getUserProfil($f3->get('SESSION.mail'));
							$f3->set('result',$userProfil);
							$f3->set('color','red');
							$f3->set('message',$f3->get('modificationError'));
							$f3->set('content','formProfilModif.htm');
						}
					}else{
						$userProfil = $this->model->getUserProfil($f3->get('SESSION.mail'));
						$f3->set('result',$userProfil);
						$f3->set('color','red');
						$f3->set('message',$f3->get('uniqueMailError'));
						$f3->set('content','formProfilModif.htm');
					}
				}else{
					$userProfil = $this->model->getUserProfil($f3->get('SESSION.mail'));
					$f3->set('result',$userProfil);
					$f3->set('color','red');
					$f3->set('message',$f3->get('adMailError'));
					$f3->set('content','formProfilModif.htm');
				}
			}else{
				$userProfil = $this->model->getUserProfil($f3->get('SESSION.mail'));
				$f3->set('result',$userProfil);
				$f3->set('color','red');
				$f3->set('message',$f3->get('fieldsError'));
				$f3->set('content','formProfilModif.htm');
			}
		}
	}

	/* modifier le mot de passe, retourne 1 si c'est bon, 0 si il y a une erreure */
	public function modifyMDP($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			if($f3->get('POST.mdp1')!="" && $f3->get('POST.mdp2')!="" && $f3->get('POST.mdp3')!=""){
				if($f3->get('POST.mdp2')==$f3->get('POST.mdp3')){
					$changeMdp = $this->model->changeMdp($f3->get('SESSION.mail'),sha1($f3->get('POST.mdp1')),sha1($f3->get('POST.mdp2')));

					if($changeMdp==1){
						$userProfil = $this->model->getUserProfil($f3->get('SESSION.mail'));
						$f3->set('result',$userProfil);
						$f3->set('color','green');
						$f3->set('message',$f3->get('modificationValid'));
						$f3->set('content','formProfilModif.htm');
					}else{
						$userProfil = $this->model->getUserProfil($f3->get('SESSION.mail'));
						$f3->set('result',$userProfil);
						$f3->set('color','red');
						$f3->set('message',$f3->get('modificationError'));
						$f3->set('content','formProfilModif.htm');
					}

				}else{
					$userProfil = $this->model->getUserProfil($f3->get('SESSION.mail'));
					$f3->set('result',$userProfil);
					$f3->set('color','red');
					$f3->set('message',$f3->get('uniqueMDPError'));
					$f3->set('content','formProfilModif.htm');
				}
			}else{
				$userProfil = $this->model->getUserProfil($f3->get('SESSION.mail'));
				$f3->set('result',$userProfil);
				$f3->set('color','red');
				$f3->set('message',$f3->get('fieldsError'));
				$f3->set('content','formProfilModif.htm');
			}
		}
	}

	public function otherUsers($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			$others = $this->model->getOtherUsers($f3->get('SESSION.mail'));

			foreach ($others as &$other) {
			    $other['fav'] = $this->model->checkFav($f3->get('SESSION.mail'), $other['user_id']);
			}
			unset($other);

			$f3->set('result',$others);
			$f3->set('content','listUsers.htm');
		}
	}

	public function addFavUser($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			$this->model->addFavUser($f3->get('SESSION.mail'),$f3->get('PARAMS.otherUserId'));
			$f3->reroute('/otherUsers');
		}
	}

	public function maCave($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			$wines = $this->model->getUserWines($f3->get('SESSION.mail'));
			if(isset($wines['wines'])){
				for($i=0; $i<count($wines['wines']); $i++){
					$wines['wines'][$i]['wine_time_add']=date("d/m/Y", strtotime(substr($wines['wines'][$i]['wine_time_add'],0,10)));
				}
			}
			
			$f3->set('proprietaire', $wines['proprio']['user_firstname'].' '.$wines['proprio']['user_lastname']);
			$f3->set('resultat',$wines['wines']);
			$f3->set('content','maCave.htm');
		}
	}

	public function addWine($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			switch($f3->get('VERB')){
				case 'GET':
					$f3->set('content','addWine.htm');
				break;
				case 'POST':
					if($f3->exists('POST.wineName') && $f3->exists('POST.origin') && $f3->exists('POST.cepage') && $f3->exists('POST.millesim') && $f3->exists('POST.quantitee') && $f3->exists('POST.conseil') /*&& $f3->exists($_FILES['img'])*/){
						if($f3->get('POST.wineName')!="" && $f3->get('POST.origin')!="" && $f3->get('POST.cepage')!="" && $f3->get('POST.millesim')!="" && $f3->get('POST.quantitee')!="" && $f3->get('POST.conseil')!="" /*&& $_FILES['img']['size']!=0*/){
							$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
							$extension_upload = strtolower(  substr(  strrchr($_FILES['wineImg']['name'], '.')  ,1)  );
							if ( in_array($extension_upload,$extensions_valides) ){

								$nbWine = $this->model->getNbWine($f3->get('SESSION.mail'));

								$user = $this->model->getUserProfil($f3->get('SESSION.mail'));
								$_FILES['wineImg']['name']="wine".$user[0]['user_id'].$nbWine.".".$extension_upload;

						        \Web::instance()->receive(function($file){},true,true);
						    }else{
						    	$_FILES['wineImg']['name']="avatarWine.png";
						    }
							
							$this->model->addWine($f3->get('SESSION.mail'),$f3->get('POST.wineName'),$f3->get('POST.origin'),$f3->get('POST.cepage'),$f3->get('POST.millesim'), $f3->get('POST.quantitee'), $f3->get('POST.conseil'),$_FILES['wineImg']['name']);
							
							$f3->reroute('/maCave');
						}else{
							$f3->set('color','red');
							$f3->set('message',$f3->get('fieldsError'));
							$f3->set('content','addWine.htm');
						}
					}else{
						$f3->set('color','red');
						$f3->set('message',$f3->get('fieldsErrorExist'));
						$f3->set('content','addWine.htm');
					}
				break;
			}
		}
	}

	public function deleteWine($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			$wineDelete = $this->model->deleteWine($f3->get('PARAMS.wineID'));
			if($wineDelete!='avatarWine.png'){
				$img = './avatars/'.$wineDelete;
				unlink($img);
			}
			$f3->reroute('/maCave');
		}
	}

	public function modifyWine($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			switch($f3->get('VERB')){
				case 'GET':
					$wine = $this->model->getUserWine($f3->get('PARAMS.wineID'));
					$f3->set('resultWine', $wine);
					$f3->set('content','formModifyWine.htm');
				break;
				case 'POST':
					$wineOld = $this->model->getUserWine($f3->get('PARAMS.wineID'));
					if($f3->exists('POST.wineName')!="" || $f3->exists('POST.wineOrigin')!="" || $f3->exists('POST.wineCepage')!="" || $f3->exists('POST.wineMillesim')!=""  || $f3->exists('POST.wineNb')!="" || $f3->exists('POST.wineConseil')!=""){
						if($f3->get('POST.wineName')!="" || $f3->get('POST.wineOrigin')!="" || $f3->get('POST.wineCepage')!="" || $f3->get('POST.wineMillesim')!=""  || $f3->get('POST.wineNb')!="" || $f3->get('POST.wineConseil')!=""){
							
							if($f3->get('POST.wineName')!=""){
								$f3->set('wineName',$f3->get('POST.wineName'));
							}else{
								$f3->set('wineName',$wineOld[0]['wine_name']);
							}

							if($f3->get('POST.wineOrigin')!=""){
								$f3->set('wineOrigin',$f3->get('POST.wineOrigin'));
							}else{
								$f3->set('wineOrigin',$wineOld[0]['wine_origin']);
							}

							if($f3->get('POST.wineCepage')!=""){
								$f3->set('wineCepage',$f3->get('POST.wineCepage'));
							}else{
								$f3->set('wineCepage',$wineOld[0]['wine_cepage']);
							}

							if($f3->get('POST.wineMillesim')!=""){
								$f3->set('wineMillesim',$f3->get('POST.wineMillesim'));
							}else{
								$f3->set('wineMillesim',$wineOld[0]['wine_millesime']);
							}

							if($f3->get('POST.wineNb')!=""){
								$f3->set('wineNb',$f3->get('POST.wineNb'));
							}else{
								$f3->set('wineNb',$wineOld[0]['wine_quantitee']);
							}

							if($f3->get('POST.wineConseil')!=""){
								$f3->set('wineConseil',$f3->get('POST.wineConseil'));
							}else{
								$f3->set('wineConseil',$wineOld[0]['wine_conseil']);
							}

							$wineNew = $this->model->modifyWine($f3->get('PARAMS.wineID'),$f3->get('wineName'),$f3->get('wineOrigin'),$f3->get('wineCepage'),$f3->get('wineMillesim'),$f3->get('wineNb'),$f3->get('wineConseil'));

							$wine = $this->model->getUserWine($f3->get('PARAMS.wineID'));
							$f3->set('resultWine',$wine);
							$f3->set('message',$f3->get('modificationValid'));
							$f3->set('color','green');
							$f3->set('content','formModifyWine.htm');

						}else{
							$f3->set('resultWine',$wineOld);
							$f3->set('color','red');
							$f3->set('message',$f3->get('modificationError'));
							$f3->set('content','formModifyWine.htm');
						}
					}else{
							$f3->set('resultWine',$wine);
							$f3->set('color','red');
							$f3->set('message',$f3->get('fieldsErrorExist'));
							$f3->set('content','formModifyWine.htm');
					}
				break;
			}
		}
	}

	function changeAvatarWine($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			if($_FILES['imgWine']['size']>=0){
				$wine = $this->model->getUserWine($f3->get('PARAMS.wineID'));

				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
				$extension_upload = strtolower(  substr(  strrchr($_FILES['imgWine']['name'], '.')  ,1)  );
				if ( in_array($extension_upload,$extensions_valides) ){

					if($wine[0]['wine_img']!="avatarWine.png"){

						$_FILES['imgWine']['name']=$wine[0]['wine_img'];
						\Web::instance()->receive(function($file){},true,true);

					}else{
						$nbWine = $this->model->getNbWine($f3->get('SESSION.mail'));
						$user = $this->model->getUserProfil($f3->get('SESSION.mail'));

						$_FILES['imgWine']['name']="wine".$user[0]['user_id'].$nbWine.".".$extension_upload;

						$this->model->changeAvatarWine($f3->get('PARAMS.wineID'), $_FILES['imgWine']['name']);

						\Web::instance()->receive(function($file){},true,true);
					}

					$wine = $this->model->getUserWine($f3->get('PARAMS.wineID'));
					$f3->set('resultWine',$wine);
					$f3->set('message',$f3->get('modificationValid'));
					$f3->set('color','green');
					$f3->set('content','formModifyWine.htm');
			    }
			}else{
				$f3->set('resultWine',$wine);
				$f3->set('color','red');
				$f3->set('message',$f3->get('imageError'));
				$f3->set('content','formModifyWine.htm');
			}
	    }  	
	}

	public function otherWines($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			$otherWines = $this->model->getOtherWines($f3->get('SESSION.mail'));

			foreach ($otherWines as &$otherWine) {
			    $otherWine['fav'] = $this->model->checkFavWine($f3->get('SESSION.mail'), $otherWine['wine_id']);
			}
			unset($otherWine);

			$f3->set('result',$otherWines);
			$f3->set('content','listWines.htm');

		}
	}

	public function addFavWine($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->reroute('/');
		}else{
			$test = $this->model->addFavWine($f3->get('SESSION.mail'),$f3->get('PARAMS.otherWineId'));
			$f3->reroute('/otherWines');
		}
	}

	public function getAlertsPage($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->set('randomWine', $this->getRandomWine());
			$f3->set('lastWines', $this->getLastWines());
			$f3->reroute('/');
		}else{
			$f3->set('content','alert.htm');
		}
	}

	public function getPropositionPage($f3){
		if(!$f3->get('SESSION.mail')){
			$f3->set('randomWine', $this->getRandomWine());
			$f3->set('lastWines', $this->getLastWines());
			$f3->reroute('/');
		}else{
			$f3->set('wineDemand',$this->getWineDemand($f3->get('PARAMS.wineId')));
			$f3->set('content','proposition.htm');
		}
	}

	public function getWineDemand($wineDemand){
		$wine = $this->model->getWineDemand($wineDemand);
		return $wine[0];
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

	/*Rechercher un vin */
	public function search($f3){

		//si le champ 'wine' n'est pas vide
		/*if(($f3->get('POST.wine'))!=""){*/
			//alors on récupère le nom du vin rentré
			$wine=$f3->get('POST.wine');
			//on récupère le ou les vins correspondants
			$f3->set('results', $this->model->search($wine));

			$f3->set('content','Results.htm');
		/*}
		//Sinon on affiche un message d'erreur et restons sur la page d'accueil
		else{
			echo "Vous devez rentrer le nom d'un vin !";
			$f3->set('content','Results.htm');
		}*/
	}

	/* Récupérer les derniers vins */
	public function getLastWines(){

		$lastWines = $this->model->getLastWines();
		return $lastWines;
	}


	/*Récupérer les 5 derniers vins de nos utilisateurs favoris*/
	public function getFavoriteUsersLastWines($id){
			$results = $this->model->getFavoriteUsersLastWines($id);
			return $results;
	}


	//Afficher un vin aléatoire
	public function getRandomWine(){
    	$randomWine=$this->model->getRandomWine();
		return $randomWine;
	}

	public function getWine($f3){
		$wine=$f3->set('wine', $this->model->getWine($f3->get('PARAMS.id')));
		$f3->set('content','Wine.htm');
	}

	/***************** Fin code Améziane ******************/


}
?>