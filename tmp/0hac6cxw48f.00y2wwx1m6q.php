
		<!-- début main -->
		<section class="main">
		
			<!-- début wrap -->
			<section class="wrap">
			
					<article id="display-results">
						<div class="layout">
										<p>Les résultats de votre recherche (7)</p>
						</div>
					</article>

				<section id="wrapper">
				
						<!-- début layout -->
						<div class="layout">
		
										
								<?php echo $this->render('./partials/ResultFilter.htm',$this->mime,get_defined_vars()); ?>


					
						<!-- début wine results -->
						<article id="wine-results">

<?php if ($results!=0): ?>
	
		<?php foreach (($results?:array()) as $wine): ?>

							<!-- debut wine result -->
						<div class="wine-result">
							
								<!-- debut infos -->
								<div class="infos">

		    <h1><a href="./vin/<?php echo $wine['wine_id']; ?>"><?php echo $wine['wine_name']; ?></a></h1>


		    	<p>proposé par  <a href="./user/<?php echo $wine['user_wine_id']; ?>"><?php echo $wine['user_firstname']; ?></a></p>

		    		<ul>
				<li>
					<p>
					<span class="title-info">Millésime :</span>  <?php echo $wine['wine_millesime']; ?></p>
</li>


				<li><p>
														<span class="title-info">Cépage : </span><?php echo $wine['wine_cepage']; ?></p></li>
				<li><p>
														<span class="title-info">Région : </span><?php echo $wine['wine_origin']; ?></p></li>
																											<li>
														<p>
														<span class="title-info">Le ptit conseil :</span>
														<?php echo $wine['wine_conseil']; ?>
														</p>
													</li>
													<li>
														<p>
														<span class="title-info">Valeur estimée :</span>
														<?php echo $wine['wine_value']; ?> €
														</p>
													</li>
			</ul>

															<div class="proposition"><input type="submit" value="Faire une proposition" /></div>
												
										</div>
										<!-- fin infos -->
								</div>
								<!-- fin wine result -->
		<?php endforeach; ?>
	
	<?php else: ?>
		Aucun résultat.
	
<?php endif; ?> 

											
									

								
									
								
															
						</article>
						<!-- fin wine results -->
						</div> 
						<!-- fin layout -->
						
						
						
			</section>
			<!-- fin wrap -->
			
		</section>
		<!-- fin main -->
		
		