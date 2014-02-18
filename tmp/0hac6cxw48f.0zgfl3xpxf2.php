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
<body class="clearfix">
	<p>Layout</p>
	<?php echo $this->render('partials/header.htm',$this->mime,get_defined_vars()); ?>

	<?php echo $this->render($content,$this->mime,get_defined_vars()); ?>

	<?php echo $this->render('partials/footer.htm',$this->mime,get_defined_vars()); ?>
</body>
</html>