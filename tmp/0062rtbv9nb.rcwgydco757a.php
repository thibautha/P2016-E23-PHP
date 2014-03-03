<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>À la notre - Accueil</title>
  <meta name="description" content="A la notre est une plate-forme d'échange de vin entre particuliers.">
  <base href="<?php echo $BASE; ?>/" />
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="./public/css/style.css" rel="stylesheet" type="text/css" />
  <link href="./public/css/reset.css" rel="stylesheet" type="text/css" >
</head>

<body class="clearfix">
	<!--<p>Layout</p>-->
	
	<?php echo $this->render('partials/header.htm',$this->mime,get_defined_vars()); ?>

	<?php echo $this->render($content,$this->mime,get_defined_vars()); ?>

	<?php echo $this->render('partials/footer.htm',$this->mime,get_defined_vars()); ?>

</body>
</html>