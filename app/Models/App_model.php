<?php

class App_model{

	function __construct(){

	}


	function getResultTestThib($f3,$params){
	$result=new DB\SQL\Mapper($f3->get('dB'),'wine');
	return $result->load(array('wine_id=?',$params));
	$lien= new DB\SQL\Mapper($f3->get('dB'),'userwine');
	return $lien->load(array('user_id=?',$result['user_wine_id']));

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
	function signUpUser($f3,$mail,$mdp){
		$user = $f3->get('dB')->exec('SELECT * FROM userwine WHERE user_mail="'.$mail.'"');
		if(empty($user)!=1){
	    	return array('confirm'=>0, 'user'=>$user);
		}else{
			$f3->get('dB')->exec('INSERT INTO userwine (user_id,user_firstname,user_lastname,user_mail,user_mdp,user_street,user_town,user_cp,user_img) 
								VALUES ("","","","'.$mail.'","'.$mdp.'","","","","")');
			$user = $f3->get('dB')->exec('SELECT * FROM userwine WHERE user_mail="'.$mail.'"');
			return array('confirm'=>1, 'user'=>$user);
		}
	}

	/* connecter un user */
	function signInUser($f3,$mail,$mdp){
		$user = new \DB\SQL\Mapper($f3->get('dB'), 'userwine');
		$auth = new \Auth($user, array('id'=>'user_mail', 'pw'=>'user_mdp'));
		$login_result = $auth->login($mail,$mdp);
		if($login_result==1){
			$userSign = $f3->get('dB')->exec('SELECT * FROM userwine WHERE user_mail="'.$mail.'"');
			return array('confirm'=>1, 'user'=>$userSign);
		}else{
			$userSign = $f3->get('dB')->exec('SELECT * FROM userwine WHERE user_mail="'.$mail.'"');
			return array('confirm'=>0, 'user'=>$userSign);
		}

		/*
		$user=$f3->get('dB')->exec('SELECT * FROM userwine '.'WHERE user_mail="'.$mail.'"');
		if($user[0]['user_mdp']==$mdp){
			return true;
		}else{
			return false;
		}
		*/
	}

	/* obtenir les infos du user pour le profil */
	function getUserProfil($f3, $mail){
		$result=$f3->get('dB')->exec('SELECT * FROM userwine WHERE user_mail="'.$mail.'"');
		return $result;
	}

	/* modifier les infos du user (profil) */
	function modifyUserProfil($f3, $mail, $nom, $prenom, $street, $town, $cp){
		$f3->get('dB')->exec('UPDATE userwine SET user_lastname="'.$nom.'", user_firstname="'.$prenom.'", user_street = "'.$street.'", user_town = "'.$town.'", user_cp = "'.$cp.'" WHERE user_mail = "'.$mail.'"');
		$userNew=$f3->get('dB')->exec('SELECT * FROM userwine '.'WHERE user_mail="'.$mail.'"');
		return $userNew;
	}

	/* modifier l'adresse mail (identifiant) */
	function changeMail($f3,$oldMail,$newMail){
		$userTable=new DB\SQL\Mapper($f3->get('dB'),'userwine');
		$user=$userTable->load(array('user_mail=?',$oldMail));
		if($user['user_mail']==$oldMail){
			if($user['user_mail']!=$newMail){
				$f3->get('dB')->exec('UPDATE userwine SET user_mail="'.$newMail.'" WHERE user_mail = "'.$oldMail.'"');
				$user=$f3->get('dB')->exec('SELECT * FROM userwine '.'WHERE user_mail="'.$newMail.'"');
				return array('confirm'=>1, 'user'=>$user);
			}else{
				return array('confirm'=>0, 'user'=>$user);
			}
		}else{
			return array('confirm'=>0, 'user'=>$user);
		}
	}

	/* modifier le mot de passe */
	function changeMdp($f3,$mail,$oldMdp,$newMdp){
		$userTable=new DB\SQL\Mapper($f3->get('dB'),'userwine');
		$user=$userTable->load(array('user_mail=?',$mail));
		if($user['user_mdp']==$oldMdp){
			if($user['user_mdp']!=$newMdp){
				$f3->get('dB')->exec('UPDATE userwine SET user_mdp="'.$newMdp.'" WHERE user_mail = "'.$mail.'"');
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

	function getRandomWine($f3, $id){
		$randomWine = $f3->get('dB')->exec('SELECT * FROM wine WHERE wine_id="'.$id.'"');
		return $randomWine;
	}

	/************************** Fin code améziane **********************************/

}


