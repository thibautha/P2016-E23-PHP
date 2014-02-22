<p>Home loggé</p>
<p>Vous êtes loggé</p>
<a href="loggout">Déconnecter</a>
<br/>
<a href="profil">Profil</a>
<br/>
<a href="maCave">Cave</a>
<br/>
<a href="otherUsers">Les autres</a>

<?php echo $this->render('./partials/SearchWine.htm',$this->mime,get_defined_vars()); ?>
<?php echo $this->render('./partials/WineShuffle.htm',$this->mime,get_defined_vars()); ?>
<?php echo $this->render('./partials/LastUsrFavoritWine.htm',$this->mime,get_defined_vars()); ?>