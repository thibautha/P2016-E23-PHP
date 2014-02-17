<p>Profil</p>
<a href="loggout">Déconnecter</a>
<br/>
<a href="homeLog">Retour page d'accueil</a>
<br/>
<a href="maCave">ma cave</a>
<div id="user">
	<?php foreach (($result?:array()) as $item): ?>
		<span>Votre prénom : <?php echo $item['user_firstname']; ?></span>
	    <br/>
	    <span>Votre nom : <?php echo $item['user_lastname']; ?></span>
	    <br/>
	    <div class="img" style="height:100px;width:100px;overflow:hidden;">
	    	<img style="height:120px;width:120px;" src="./avatars/<?php echo $item['user_img']; ?>" alt="<?php echo $item['user_img']; ?>"/>
	    </div>
	    <br/>
	    <span>Votre adresse mail : <?php echo $item['user_mail']; ?></span>
	    <br/>
	    <p>Votre adresse :</p>
	    <span><?php echo $item['user_street']; ?></span>
	    <br/>
	    <span><?php echo $item['user_cp']; ?></span>
	    <br/>
	    <span><?php echo $item['user_town']; ?></span>
	<?php endforeach; ?>
</div>
<a href="formProfilModif">Complétez ou modifiez votre profil !</a>