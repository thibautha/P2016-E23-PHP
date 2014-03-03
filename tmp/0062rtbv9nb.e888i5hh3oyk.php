	<!-- début random wine -->
				<article id="random">
				
					<h2>Un vin aléatoire</h2>
						
						<div id="random-wine">

	<h3><?php echo $randomWine['wine_name']; ?></h3>
	<a href="./wine/<?php echo $randomWine['wine_id']; ?>"><img src="./avatars/<?php echo $randomWine['wine_img']; ?>" alt="<?php echo $randomWine['wine_img']; ?>"></a>
									<!-- cépage millésime région -->
		<ul>
		<li><p>Millésime : <?php echo $randomWine['wine_millesime']; ?></p></li>
		<li><p>Cépage : <?php echo $randomWine['wine_cepage']; ?></p></li>
		<li><p>Région : <?php echo $randomWine['wine_origin']; ?></p></li>
			</ul>

								<!-- conseil sur le vin -->
								<div id="ptit-conseil"><p>Conseil : <?php echo $randomWine['wine_conseil']; ?></p>			</div>
								<!-- fin conseil -->

						</div>
						<!-- fin random wine -->
					
					
<button class="autre-vin">Un autre !</button>

					
				
					<script src="../public/js/wineshuffle.js"></script>
				
					
				</article>
				<!-- fin random -->

