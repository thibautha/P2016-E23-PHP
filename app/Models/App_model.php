<?php

class App_model extends Model{

	function __construct(){
		parent::__construct();
		$this->mapperUser=$this->getMapper('userwine');
		$this->mapperWine=$this->getMapper('wine');
		$this->mapperFavUser=$this->getMapper('favoris_user');
		$this->mapperFavWine=$this->getMapper('favoris_wine');
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
		$user = $this->mapperUser->load(array('user_mail=?',$mail));
		if(!$user){
			$this->mapperUser->user_mail=$mail;
			$this->mapperUser->user_mdp=$mdp;
			$this->mapperUser->user_img="avatar.png";
			$this->mapperUser->save();
			$user = $this->mapperUser->load(array('user_mail=?',$mail));
			return $user;
		}else{
			return $user;
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
		$user = $this->mapperUser->load(array('user_mail=?',$mail));
		$user->user_lastname = $nom;
		$user->user_firstname = $prenom;
		$user->user_street = $street;
		$user->user_town = $town;
		$user->user_cp = $cp;
		$user->save();
		return $this->dB->exec('SELECT user_mail, user_firstname, user_lastname FROM userwine WHERE user_mail="'.$mail.'"');
	}

	/* modifier l'adresse mail (identifiant) */
	function changeMail($oldMail,$newMail){
		$user=$this->mapperUser->load(array('user_mail=?',$oldMail));
		if($user['user_mail']==$oldMail){
			if($user['user_mail']!=$newMail){
				$user->user_mail = $newMail;
				$user->save();
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
				$user->user_mdp=$newMdp;
				$user->save();
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}

	function addAvatar($mail, $image){
		//$this->dB->exec('UPDATE userwine SET user_img="'.$image.'" WHERE user_mail = "'.$mail.'"');
		$user=$this->mapperUser->load(array('user_mail=?',$mail));
		$user->user_img=$image;
		$user->save();
	}

	function getNbWine($mail){
		$user=$this->mapperUser->load(array('user_mail=?',$mail));
		return $this->mapperWine->count(array('user_wine_id=?',$user["user_id"]));
	}

	function getOtherUsers($mail){
		//return $this->mapperUser->load(array('user_mail!=?',$mail));
		return $this->dB->exec('SELECT user_firstname, user_lastname, user_img, user_id FROM userwine WHERE user_mail!="'.$mail.'" ORDER BY user_lastname DESC');
	}

	function addFavUser($mail,$otherID){
		$currentUser = $this->mapperUser->load(array('user_mail=?',$mail));
		$fav = $this->mapperFavUser->load(array('user_id=?',$currentUser['user_id']));
		if($fav['favori_id']==$otherID){
			$fav->erase();
			return false;
		}else{
			$this->dB->exec('INSERT INTO favoris_user(user_id, favori_id) VALUES ("'.$currentUser["user_id"].'","'.$otherID.'")');
			/*$this->mapperFavUser->user_id=$currentUser['user_id'];
			$this->mapperFavUser->favori_id=$otherID;
			$this->mapperFavUser->save();*/
			return true;
		}
	}

	function checkFav($mail, $otherID){
		$currentUser = $this->mapperUser->load(array('user_mail=?',$mail));
		//$fav = $this->mapperFavUser->load(array('user_id=?',$currentUser['user_id']));
		$fav = $this->dB->exec('SELECT favori_id FROM favoris_user WHERE user_id="'.$currentUser['user_id'].'"');
		$rep = "No";
		for($i=0; $i<sizeof($fav);$i++){
			if($fav[$i]['favori_id']==$otherID){
				$rep = "Yes";
			}
		}
		return $rep;
		print_r($fav);
	}

	function getUserWines($mail){
		$user=$this->mapperUser->load(array('user_mail=?',$mail));
		//$wines=$this->mapperWine->load(array('user_wine_id=?',$user['user_id']));
		$wines = $this->dB->exec('SELECT * FROM wine WHERE user_wine_id="'.$user['user_id'].'" ORDER BY wine_time_add DESC');
		return array('wines'=>$wines, 'proprio'=>$user);
	}

	function getUserWine($wineId){
		return $this->dB->exec('SELECT * FROM wine WHERE wine_id="'.$wineId.'"');
	}

	function addWine($mail,$wineName,$origin,$cepage,$millesim,$quantitee,$conseil,$wineImg){
		$user=$this->mapperUser->load(array('user_mail=?',$mail));
		$this->mapperWine->wine_name=$wineName;
		$this->mapperWine->wine_time_add=date("Y-m-d H:i:s");
		$this->mapperWine->wine_origin=$origin;
		$this->mapperWine->wine_cepage=$cepage;
		$this->mapperWine->wine_millesime=$millesim;
		$this->mapperWine->wine_quantitee=$quantitee;
		$this->mapperWine->wine_conseil=$conseil;
		$this->mapperWine->wine_img=$wineImg;
		$this->mapperWine->user_wine_id=$user['user_id'];
		$this->mapperWine->save();
	}

	function deleteWine($wineID){
		$wine = $this->mapperWine->load(array('wine_id=?',$wineID));
		$wineImg = $wine['wine_img'];
		$wine->erase();
		return $wineImg;
	}

	function modifyWine($wineID,$wineName,$wineOrigin,$wineCepage,$wineMillesim,$wineNb,$wineConseil){
		$wine=$this->mapperWine->load(array('wine_id=?',$wineID));
		$wine->wine_name=$wineName;
		$wine->wine_origin=$wineOrigin;
		$wine->wine_cepage=$wineCepage;
		$wine->wine_millesime=$wineMillesim;
		$wine->wine_quantitee=$wineNb;
		$wine->wine_conseil=$wineConseil;
		$wine->save();
	}

	function changeAvatarWine($wineID, $img){
		$wine=$this->mapperWine->load(array('wine_id=?',$wineID));
		$wine->wine_img=$img;
		$wine->save();
	}

	function getOtherWines($mail){
		//return $this->mapperUser->load(array('user_mail!=?',$mail));
		$currentUser = $this->mapperUser->load(array('user_mail!=?',$mail));
		return $this->dB->exec('SELECT wine_name, wine_img, wine_id FROM wine WHERE user_wine_id!="'.$currentUser['user_id'].'" ORDER BY wine_name DESC');
	}

	function addFavWine($mail,$otherWineID){
		$currentUser = $this->mapperUser->load(array('user_mail=?',$mail));
		$favWine = $this->mapperFavWine->find(array('user_id=?',$currentUser['user_id']));
		$val=1;
		$pos=0;
		for($i=0;$i<sizeof($favWine);$i++){
			if($favWine[$i]['wine_id']==$otherWineID){
				$val=0;
				$pos=$i;
			}
		}
		if($val==0){
			$favWine[$pos]->erase();
			return false;
		}else{
			$this->dB->exec('INSERT INTO favoris_wine(wine_id, user_id) VALUES ("'.$otherWineID.'", "'.$currentUser["user_id"].'")');
			/*$this->mapperFavUser->user_id=$currentUser['user_id'];
			$this->mapperFavUser->favori_id=$otherID;
			$this->mapperFavUser->save();*/
			return true;
		}
	}

	function checkFavWine($mail, $otherWineID){
		$currentUser = $this->mapperUser->load(array('user_mail=?',$mail));
		//$fav = $this->mapperFavUser->load(array('user_id=?',$currentUser['user_id']));
		$favWine = $this->dB->exec('SELECT wine_id FROM favoris_wine WHERE user_id="'.$currentUser['user_id'].'"');
		//print_r("ça passe");
		//print_r($favWine[0]['wine_id']);
		//print_r($otherWineID);
		$rep = "No";
		for($i=0; $i<sizeof($favWine);$i++){
			if($favWine[$i]['wine_id']==$otherWineID){
				$rep = "Yes";
			}
		}
		return $rep;
	}
	/***********************************************************************************************************/
	/******************************************** Fin code kévin **************************************************/
	/**********************************************************************************************************/



	/************************  Code d'améziane *****************************/

	/*rechercher un vin*/
	function search($searchedWine){

		// On récupère dans la BD le(s) vin(s) correspondants
		$results=$this->dB->exec('SELECT * FROM wine, userwine WHERE wine.user_wine_id = userwine.user_id AND wine_name="'.$searchedWine.'"');
		
		//si aucun vin n'a été trouvé 
		if(!$results){
			// on retourne le chiffre 0
			return 0;
		//sinon on retourne les résultats 
		}else{
			return $results;
		}
	}


	/* Afficher les derniers vins*/
	function getLastWines(){
		$lastWines = $this->dB->exec('
			SELECT wine_id, wine_name, wine_img, user_wine_id, user_firstname 
			FROM wine, userwine 
			WHERE wine.user_wine_id = userwine.user_id
			ORDER BY wine_time_add DESC 
			LIMIT 5
			');

		return $lastWines;
	}

	/* Afficher les derniers vins de nos utilisateurs favoris */
	function getFavoriteUsersLastWines($id){

		//On récupère et stocke les 5 derniers vins de nos utilisateurs favoris dans la variable suivante : 
		$results = $this->dB->exec('
			SELECT us.user_id, us.user_firstname, wine_id, wine_name, wine_img
			FROM favoris_user fa
			INNER JOIN userwine us ON fa.favori_id = us.user_id
			INNER JOIN wine ON us.user_id = wine.user_wine_id
			WHERE fa.user_id ="'.$id.'"
			ORDER BY wine_time_add DESC
			LIMIT 5 
		');
		//On retourne celle-ci : 
		return $results;
	}

	/* Afficher un vin aléatoirement*/
	function getRandomWine(){

		// On sélectionne un vin aléatoirement dans la base de données  
		// On stocke ses données dans la variable $randomWine qui est un array
		$randomWine = $this->dB->exec('SELECT * FROM wine ORDER BY RAND() LIMIT 1');
		// Cette variable contient l'array avec toutes les informations sur le vin
		// On retourne celui-ci
		return $randomWine[0];
	}


	/* afficher un vin en single view*/
	function getWine($id){
		//on récupère les informations sur le vin avec l'id correspondant dans un array $wine
		$wine = $this->dB->exec('SELECT * FROM wine, userwine WHERE wine.user_wine_id = userwine.user_id AND wine_id="'.$id.'"');
		// On retourne le résultat
		return $wine[0];
	}
	/************************** Fin code améziane **********************************/

}


