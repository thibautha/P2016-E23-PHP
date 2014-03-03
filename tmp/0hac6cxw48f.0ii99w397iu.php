				<article id="last-wines">
					<h2>Les derniers vins de vos utilisateurs favoris</h2>

<?php if ($lastWines!=0): ?>
	
		<?php foreach (($lastWines?:array()) as $wine): ?>

			<div class="last-wine">
				<a href="./user/<?php echo $wine['user_wine_id']; ?>"><?php echo $wine['user_firstname']; ?></a> a ajouté :
				<div id="display-last-wine">

				<a href="<?php echo $wine['wine_id']; ?>"><img src="./avatars/<?php echo $wine['wine_img']; ?>" alt="<?php echo $wine['wine_img']; ?>"></a>

				<h3><a href="./wine/<?php echo $wine['wine_id']; ?>"><?php echo $wine['wine_name']; ?></a></h3>
				</div>

				<a href="./wine/<?php echo $wine['wine_id']; ?>">Voir la fiche</a>
				<a href="#">Proposition</a>
			</div>

		<?php endforeach; ?>
	
	<?php else: ?>
		Il n'y a pas encore de vins rajoutés pour le moment. 	
	
<?php endif; ?>

						</ul>
				</article>				

						
