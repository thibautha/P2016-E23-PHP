<p>Profil</p>
<a href="loggout">Déconnecter</a>
<br/>
<a href="homeLog">Retour page d'accueil</a>
<br/>
<a href="maCave">ma cave</a>



		
		<!-- début main -->
		<section class="main">
		
			<!-- début wrap -->
			<section class="wrap">
			
					<article id="display-profil">
						<div class="layout">
										<article id="profil">
												<?php foreach (($result?:array()) as $item): ?>

											<div class="roundedImage">
												<img src="./public/img/avatars/<?php echo $item['user_img']; ?>" alt="<?php echo $item['user_img']; ?>" />
											</div>
											<h3><?php echo $item['user_firstname']; ?> <?php echo $item['user_lastname']; ?></h3>
												<div id="profil-infos">
													<p>Pseudo : TEXTE EN DUR</p>
													
													<p>Adresse postale : <?php echo $item['user_street']; ?></p>
													<p>Adresse mail : <?php echo $item['user_mail']; ?></p>
													<p>Ville : <?php echo $item['user_cp']; ?> <?php echo $item['user_town']; ?></p>
												</div>
											<a href="formProfilModif">Modifier mes informations</a>
												<?php endforeach; ?>

										</article>
						</div>
					</article>

				<section id="wrapper">
				
						<!-- début layout -->
						<div class="layout">
							
							<section id="my-cave">
								
								<h2>Ma cave</h2>
								
								<p>Je possède actuellement 7 vins dans ma cave</p>
								
									<article id="display-cave">
									
										<div id="add-wine">
											<div id="add">
												<input type="submit" name="ajout-vin" value="+"/>
												<a href="#">Ajouter un vin</a>
											</div>
										</div>
										<!-- fin add wine -->
										
										<div class="display-wine">
										 <h1>Romanée St Vivant</h1>
										 	<div class="display-wine-infos">
										 		<img src="#" alt="photo du vin" />
										 		
										 		<ul>
													<li>
														<p>
															<span class="title-info">Millésime :</span> 
															2005
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Cêpage :</span>
														 pinot noir
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Région :</span>
														bourgogne
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Le ptit conseil :</span>
														A déguster avec des chaires fines et des viandes blancs
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Valeur estimée :</span>
														<a href="#">2500 points</a>
														</p>
													</li>
													
												
											</ul>
										 	
										 	</div>
										 	<!-- fin wine infos -->
										 	
										 	<input type="submit" type="text" value="modifier" />
										 	<input type="submit" type="text" value="supprimer" />
										 	
										</div>
										<div class="display-wine">
										 <h1>Romanée St Vivant</h1>
										 	<div class="display-wine-infos">
										 		<img src="#" alt="photo du vin" />
										 		
										 		<ul>
													<li>
														<p>
															<span class="title-info">Millésime :</span> 
															2005
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Cêpage :</span>
														 pinot noir
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Région :</span>
														bourgogne
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Le ptit conseil :</span>
														A déguster avec des chaires fines et des viandes blancs
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Valeur estimée :</span>
														<a href="#">2500 points</a>
														</p>
													</li>
													
												
											</ul>
										 	
										 	</div>
										 	<!-- fin wine infos -->
										 	
										 	<input type="submit" type="text" value="modifier" />
										 	<input type="submit" type="text" value="supprimer" />
										 	
										</div>
										<div class="display-wine">
										 <h1>Romanée St Vivant</h1>
										 	<div class="display-wine-infos">
										 		<img src="#" alt="photo du vin" />
										 		
										 		<ul>
													<li>
														<p>
															<span class="title-info">Millésime :</span> 
															2005
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Cêpage :</span>
														 pinot noir
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Région :</span>
														bourgogne
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Le ptit conseil :</span>
														A déguster avec des chaires fines et des viandes blancs
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Valeur estimée :</span>
														<a href="#">2500 points</a>
														</p>
													</li>
													
												
											</ul>
										 	
										 	</div>
										 	<!-- fin wine infos -->
										 	
										 	<input type="submit" type="text" value="modifier" />
										 	<input type="submit" type="text" value="supprimer" />
										 	
										</div>
										<div class="display-wine">
										 <h1>Romanée St Vivant</h1>
										 	<div class="display-wine-infos">
										 		<img src="#" alt="photo du vin" />
										 		
										 		<ul>
													<li>
														<p>
															<span class="title-info">Millésime :</span> 
															2005
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Cêpage :</span>
														 pinot noir
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Région :</span>
														bourgogne
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Le ptit conseil :</span>
														A déguster avec des chaires fines et des viandes blancs
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Valeur estimée :</span>
														<a href="#">2500 points</a>
														</p>
													</li>
													
												
											</ul>
										 	
										 	</div>
										 	<!-- fin wine infos -->
										 	
										 	<input type="submit" value="modifier" />
										 	<input type="submit" value="supprimer" />
										 	
										</div>
										
										<!-- fin display-wine -->
								
									
									</article>
									<!-- fin display-cave -->
									
									
							
									
							</section>
							<!-- fin my cave -->
							
									<section id="my-friend">
										<h2>J'aime leurs vins</h2>
										<p>14 utilisateurs favoris>
										<section id="display-friend">
										
											<div class="friend">
											<img src="#" alt="photo d'ami" />
											<a href="#">Frederico</a>
											</div>
											<!-- fin friend -->
											
											<div class="friend">
											<img src="#" alt="photo d'ami" />
											<a href="#">Frederico</a>
											</div>
											<!-- fin friend -->
											
											<div class="friend">
											<img src="#" alt="photo d'ami" />
											<a href="#">Frederico</a>
											</div>
											<!-- fin friend -->
											
										</section>
										<!-- fin display friend -->
									
									</section>
									<!-- fin my friend -->
						</div> 
						<!-- fin layout -->
						
						
						<footer>
						</footer></section>
						<!-- fin wrapper -->
						
						
			</section>
			<!-- fin wrap -->
			
		</section>
		<!-- fin main -->
		
		
		
		
		
		
		
		
		
		
		
	</body>
	
</html>