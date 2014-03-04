<h2>Les derniers vins de vos utilisateurs favoris</h2>

<?php if ($lastWines!=0): ?>
	
		<?php foreach (($lastWines?:array()) as $wine): ?>

			<div class="result-wine" style="width=100px; height=200px; display:inline-block; padding:20px; border:1px solid;">
				
				<span><a href="./user/<?php echo $wine['user_id']; ?>"><?php echo $wine['user_firstname']; ?></a> a ajouté :</span><br/>
				
				<a href="./wine/<?php echo $wine['wine_id']; ?>"><img src="./avatars/<?php echo $wine['wine_img']; ?>" alt="<?php echo $wine['wine_img']; ?>" width="100px" height="150px"></a><br/>

				<span><a href="./wine/<?php echo $wine['wine_id']; ?>"><?php echo $wine['wine_name']; ?></a></span><br/>
				
				<a href="#">Voir la fiche</a><br/>
				<a href="./proposition/<?php echo $wine['wine_id']; ?>">Faire une proposition</a><br/>

			</div>

		<?php endforeach; ?>
	
	<?php else: ?>
		Il n'y a pas encore de vins rajoutés pour le moment. 	
	
<?php endif; ?>