<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Projet PHP</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body class="clearfix">
	<p>Layout</p>
<?php echo $this->render($content,$this->mime,get_defined_vars()); ?>
</body>
</html>