<br/>
<span style="color:<?php echo $color; ?>;"><?php echo $message; ?></span>
<?php foreach (($result?:array()) as $item): ?>
	<form method="post" action="modifyProfil">
		<p>Modifier ou complétez votre profil : </p>
		<label>Votre prénom : </label><input type="text" name="prenom"/><span>Ancien : (<?php echo $item['user_firstname']; ?>)</span><br/>
		<label>Votre nom : </label><input type="text" name="nom"/><span>Ancien : (<?php echo $item['user_lastname']; ?>)</span><br/>
		<label>Votre adresse : </label><br/>
		<label>Rue et numéro : </label><input type="text" name="street"/><span>Ancien : (<?php echo $item['user_street']; ?>)</span><br/>
		<label>Code postale : </label><input type="text" name="cp"/><span>Ancien : (<?php echo $item['user_cp']; ?>)</span><br/>
		<label>Ville : </label><input type="text" name="town"/><span>Ancien : (<?php echo $item['user_town']; ?>)</span><br/>
		<input type="submit" value="Enregistrer profil"/>
	</form>
	<form method="post" action="uploadAvatar" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<label>Votre image d'avatar : </label><input type="file" name="img" /><br/>
		<input type="submit" value="Enregistrer profil"/>
	</form>
	<form method="post" action="modifyMail">
		<p>Modifier votre identifiant (mail) :</p>
		<label>Votre ancienne adresse mail : </label><input type="text" name="mail1"/><br/>
		<label>Votre nouvelle adresse mail: </label><input type="text" name="mail2"/><br/>
		<label>Confirmer votre nouvelle adresse mail : </label><input type="text" name="mail3"/><br/>
		<input type="submit" value="Enregistrer mail"/>
	</form>
	<form method="post" action="modifyMDP">
		<p>Modifier votre mot de passe :</p>
		<label>Votre ancien mot de passe : </label><input type="password" name="mdp1"/><br/>
		<label>Votre nouveau mot de passe : </label><input type="password" name="mdp2"/><br/>
		<label>Confirmer votre nouveau mot de passe : </label><input type="password" name="mdp3"/><br/>
		<input type="submit" value="Enregistrer MDP"/>
	</form>
<?php endforeach; ?>
<a href="profil">Retour sur votre profil</a>