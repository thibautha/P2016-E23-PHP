<p>Ma cave</p>
<a href="addWine">Ajouter un vin !</a>
<span style="color:<?php echo $color; ?>;"><?php echo $message; ?></span>
<br/>
<div class="wine">
	<?php if ($resultat != 0): ?>
		
			<?php foreach (($resultat?:array()) as $item): ?>
				<div style="border:1px solid black;width:350px;display:inline-block;vertical-align:top;">
					<span>Nom : <?php echo $item['wine_name']; ?></span>
				    <br/>
				    <span>Date d'ajout : <?php echo $item['wine_time_add']; ?></span>
				    <br/>
				    <span>Propriétaire : <?php echo $proprietaire; ?></span>
				    <br/>
				    <div class="img" style="height:100px;width:100px;overflow:hidden;">
				    	<img style="height:120px;width:120px;" src="./public/avatars/<?php echo $item['wine_img']; ?>" alt="<?php echo $item['wine_img']; ?>"/>
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
				    <br/>
				    <a href="delete/<?php echo $item['wine_id']; ?>">Supprimer le vin</a>
				    <a href="modifyWine/<?php echo $item['wine_id']; ?>">Modifier le vin</a>
				</div>
			<?php endforeach; ?>
		
		<?php else: ?>
			<p>Vous n'avez pas encore ajouté de vin.</p>	
		
	<?php endif; ?>
</div>