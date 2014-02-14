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
	function modifyUserProfil($f3, $mailOld, $nom, $prenom, $street, $town, $cp){
		$user=$f3->get('dB')->exec('SELECT * FROM userwine '.'WHERE user_mail="'.$mailOld.'"');
		$result = $f3->get('dB')->exec('UPDATE userwine SET user_lastname="'.$nom.'", user_firstname="'.$prenom.'", user_mail="'.$mailOld.'", user_mdp="'.$user[0]['user_mdp'].'", user_street = "'.$street.'", user_town = "'.$town.'", user_cp = "'.$cp.'" WHERE user_mail = "'.$mailOld.'"');
		$userNew=$f3->get('dB')->exec('SELECT * FROM userwine '.'WHERE user_mail="'.$mailOld.'"');
		return $userNew;
	}

	/* modifier le mot de passe */
	function checkMdp($f3,$mail,$oldMdp){
		$user=new DB\SQL\Mapper($f3->get('dB'),'userwine');
		return $user->load(array('user_mail=?',$mail));
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


