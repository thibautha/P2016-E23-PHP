<p>Ma cave</p>
<a href="addWine">Ajouter un vin !</a>
<span style="color:<?php echo $color; ?>;"><?php echo $message; ?></span>
<div class="wine">
	<?php foreach (($resultat?:array()) as $item): ?>
		<div style="border:1px solid black;">
			<span>Nom : <?php echo $item['wine_name']; ?></span>
		    <br/>
		    <span>Date d'ajout : <?php echo $item['wine_date_add']; ?></span>
		    <br/>
		    <div class="img" style="height:100px;width:100px;overflow:hidden;">
		    	<img style="height:120px;width:120px;" src="./avatars/<?php echo $item['wine_img']; ?>" alt="<?php echo $item['wine_img']; ?>"/>
		    </div>
		    <br/>
		    <span>Origine : <?php echo $item['wine_origin']; ?></span>
		    <br/>
		    <span>Cépage : <?php echo $item['wine_cepage']; ?></span>
		    <br/>
		    <span>Millésime : <?php echo $item['wine_millesime']; ?></span>
		    <br/>
		    <span>Nombre de bouteilles disponibles : <?php echo $item['wine_quantitee']; ?></span>
		    <br/>
		    <span>Commentaires et/ou conseil de dégustation : </span><br/>
		    <span><?php echo $item['wine_conseil']; ?></span>
		</div>
	<?php endforeach; ?>
</div>