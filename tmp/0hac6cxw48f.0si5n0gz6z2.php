<p>home</p>
<?php echo $this->render('./partials/WineShuffle.htm',$this->mime,get_defined_vars()); ?>
<?php echo $this->render('./partials/LastUsrFavoritWine.htm',$this->mime,get_defined_vars()); ?>
<p>home</p>
<p>Loggin</p>
<div class="error"><?php echo $error; ?></div>
<form method="post" action="signin">
	<label>Mail : </label><input type="text" name="mail"/>
	<label>Mdp : </label><input type="password" name="mdp"/>
	<input type="submit" value="Sign in"/>
</form>
<div class="trait"></div>
<a href="signup">Sign</a>