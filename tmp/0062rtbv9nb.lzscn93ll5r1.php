<<<<<<< HEAD
<p>home</p>
<?php echo $this->render('./partials/WineShuffle.htm',$this->mime,get_defined_vars()); ?>
<?php echo $this->render('./partials/LastUsrFavoritWine.htm',$this->mime,get_defined_vars()); ?>


=======
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  
	<title>&Aacute; la notre !</title>
	<meta name="description" content="">
  	<base href="<?php echo $BASE; ?>/" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
  	<link href="style.css" rel="stylesheet" type="text/css" />
</head>
	<body>
		<p>home</p>
		<div class="trait"></div>
		<p>Loggin</p>
		<div class="error"><?php echo $error; ?></div>
		<form method="post" action="signin">
			<label>Mail : </label><input type="text" name="mail"/>
			<label>Mdp : </label><input type="password" name="mdp"/>
			<input type="submit" value="Sign in"/>
		</form>
		<div class="trait"></div>
		<a href="signup">Sign</a>
	</body>
</html>
>>>>>>> c162ae1cbf0ecdcb467d25b7ba38c5db500372de
