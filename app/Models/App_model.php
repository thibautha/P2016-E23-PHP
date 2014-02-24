<?php

class App_model extends Model{

	function __construct(){
		parent::__construct();
		$this->mapperUser=$this->getMapper('userwine');
		$this->mapperWine=$this->getMapper('wine');
		$this->mapperFavUser=$this->getMapper('favoris_user');
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
			$this->mapperFavUser->user_id=$currentUser['user_id'];
			$this->mapperFavUser->favori_id=$otherID;
			$this->mapperFavUser->save();
			return true;
		}
	}
	function checkFav($mail, $otherID){
		$currentUser = $this->mapperUser->load(array('user_mail=?',$mail));
		$fav = $this->mapperFavUser->load(array('user_id=?',$currentUser['user_id']));
		if($fav['favori_id']==$otherID){
			return 1;
		}else{
			return 0;
		}
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
	/***********************************************************************************************************/
	/******************************************** Fin code kévin **************************************************/
	/**********************************************************************************************************/



	/************************  Code d'améziane *****************************/

	/* afficher un vin aléatoirement*/
	function getRandomWine(){

		// On sélectionne un vin aléatoirement dans la base de données  
		// On stocke ses données dans la variable $randomWine qui est un array
		$randomWine = $this->dB->exec('SELECT * FROM wine ORDER BY RAND() LIMIT 1');
		// Cette variable contient elle-même un array avec toutes les informations sur le vin
		// ON retourne celui-ci
		return $randomWine[0];
	}


	/*rechercher un vin*/
	function search($searchedWine){

		// On récupère dans la BD le(s) vin(s) correspondants
		$results=$this->dB->exec('SELECT * FROM wine WHERE wine_name="'.$searchedWine.'"');
		
		//si aucun vin n'a été trouvé 
		if(!$results){
			// on retourne le chiffre 0
			return 0;
		//sinon
		}else{
			//pour chaque vin trouvé, soit pour chaque array 'wine' dans le array 'results'
			foreach($results as &$wine){

				// on récupère le nom du propriétaire dans la bdd 
				$user_firstname= $this->dB->exec('SELECT user_firstname FROM userwine, wine WHERE userwine.user_id=wine.user_wine_id AND wine.wine_id="'.$wine['wine_id'].'"');

				// et on l'ajoute à l'array 'wine'
				$wine['user_firstname'] = $user_firstname[0]['user_firstname'];

			}

			//On retourne les résultats
			return $results;
		}
	}


	/* afficher un vin en single view*/
	function getWine($id){
		//on récupère les informations sur le vin avec l'id correspondant dans un array $wine
		$wine = $this->dB->exec('SELECT * FROM wine WHERE wine_id="'.$id.'"');
		//on récupère le prénom de son possesseur dans un array $user_firstname
		$user_firstname= $this->dB->exec('SELECT user_firstname FROM userwine, wine WHERE userwine.user_id=wine.user_wine_id AND wine.wine_id="'.$id.'"');
		//On l'ajoute dans l'array $wine
		$wine[0]['user_firstname'] = $user_firstname[0]['user_firstname'];
		// On retourne le tableau
		return $wine[0];
	}
	/************************** Fin code améziane **********************************/

}


