<?php

class App_model extends Model{

	function __construct(){
		parent::__construct();
		$this->mapperUser=$this->getMapper('userwine');
		$this->mapperWine=$this->getMapper('wine');
	}


	function getResultTestThib($params){
	return $this->mapperWine->load(array('wine_id=?',$params));
	return $this->mapperUser->load(array('user_id=?',$result['user_wine_id']));

	//$proprio=new DB\SQL\Mapper($f3->get('dB'),'userwine');
	//return $proprio->load
//array('beta'=>'5'),0
	}

	function getResultTestKev($f3,$params){

	}


	function getResultTestAmez($f3,$params){

	}

	/***********************************************************************************************************/
	/******************************************** Code kévin **************************************************/
	/**********************************************************************************************************/

	/* enregistrer un user */
	function signUpUser($mail,$mdp){
		$user = $this->dB->exec('SELECT * FROM userwine WHERE user_mail="'.$mail.'"');
		if(!$user){
			$this->dB->exec('INSERT INTO userwine (user_id,user_firstname,user_lastname,user_mail,user_mdp,user_street,user_town,user_cp,user_img) 
								VALUES ("","","","'.$mail.'","'.$mdp.'","","","","")');
			$user = $this->dB->exec('SELECT * FROM userwine WHERE user_mail="'.$mail.'"');
			return $user[0];
		}else{
			return $user[0];
		}
	}

	/* connecter un user */
	function signInUser($mail,$mdp){
		$auth = new \Auth($this->mapperUser, array('id'=>'user_mail', 'pw'=>'user_mdp'));
		$login_result = $auth->login($mail,$mdp);
		if($login_result==1){
			$userSign = $this->dB->exec('SELECT * FROM userwine WHERE user_mail="'.$mail.'"');
			return $userSign[0];
		}else{
			$userSign = $this->dB->exec('SELECT * FROM userwine WHERE user_mail="'.$mail.'"');
			return 0;
		}
	}

	/* obtenir les infos du user pour le profil */
	function getUserProfil($mail){
		return $this->dB->exec('SELECT * FROM userwine WHERE user_mail="'.$mail.'"');
	}

	/* modifier les infos du user (profil) */
	function modifyUserProfil($mail, $nom, $prenom, $street, $town, $cp){
		$this->dB->exec('UPDATE userwine SET user_lastname="'.$nom.'", user_firstname="'.$prenom.'", user_street = "'.$street.'", user_town = "'.$town.'", user_cp = "'.$cp.'" WHERE user_mail = "'.$mail.'"');
		return $this->dB->exec('SELECT user_mail, user_firstname, user_lastname FROM userwine WHERE user_mail="'.$mail.'"');
	}

	/* modifier l'adresse mail (identifiant) */
	function changeMail($oldMail,$newMail){
		$user=$this->mapperUser->load(array('user_mail=?',$oldMail));
		if($user['user_mail']==$oldMail){
			if($user['user_mail']!=$newMail){
				$this->dB->exec('UPDATE userwine SET user_mail="'.$newMail.'" WHERE user_mail = "'.$oldMail.'"');
				$user=$this->dB->exec('SELECT * FROM userwine '.'WHERE user_mail="'.$newMail.'"');
				return array('confirm'=>1, 'user'=>$user);
			}else{
				return array('confirm'=>0, 'user'=>$user);
			}
		}else{
			return array('confirm'=>0, 'user'=>$user);
		}
	}

	/* modifier le mot de passe */
	function changeMdp($mail,$oldMdp,$newMdp){
		$user=$this->mapperUser->load(array('user_mail=?',$mail));
		if($user['user_mdp']==$oldMdp){
			if($user['user_mdp']!=$newMdp){
				$this->dB->exec('UPDATE userwine SET user_mdp="'.$newMdp.'" WHERE user_mail = "'.$mail.'"');
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	/***********************************************************************************************************/
	/******************************************** Fin code kévin **************************************************/
	/**********************************************************************************************************/



	/************************  Code d'améziane *****************************/

	function getRandomWine($id){
		$randomWine = $this->dB->exec('SELECT * FROM wine WHERE wine_id="'.$id.'"');
		//print_r($randomWine[0]);
		return $randomWine[0];
	}

	/************************** Fin code améziane **********************************/

}


