<p>home</p>

<p>Loggin</p>
<div class="error"><?php echo $error; ?></div>
<form method="post" action="signin">
	<label>Mail : </label><input type="text" name="mail"/>
	<label>Mdp : </label><input type="password" name="mdp"/>
	<input type="submit" value="Sign in"/>
</form>
<div class="trait"></div>
<a href="signup">Sign</a>


		
		
		<!-- début main -->
		<section class="main">
		
			<!-- début wrap -->
			<section class="wrap">
			
			
			
		
			
			<!-- Début display d'accueil -->
			<section id="display-home">	
				
				
				
				<!-- début message home -->
				<article id="message-home">
					
					<!-- message d'accueil -->
					<h1>ALANOTRE est une plate-forme d’échange de bouteille de vin de particuliers à particuliers.
Tapez le nom de votre vin préféré et découvrez si un autre parisien souhaite l’échanger !</h1>

				</article>
				<!-- fin message home -->
				
				
				
		<?php echo $this->render('./partials/SearchWine.htm',$this->mime,get_defined_vars()); ?>

				
					</div>
					<!-- fin layout -->
			</section>
			<!-- fin display d'accueil -->
				<!-- Début sous-home -->
			<section id="under-home">
			
			<!-- début layout -->
			<div class="layout">
			

				<?php echo $this->render('./partials/LastWines.htm',$this->mime,get_defined_vars()); ?>
				<?php echo $this->render('./partials/WineShuffle.htm',$this->mime,get_defined_vars()); ?>
			</div>
			<!-- fin layout -->
			</section>
			<!-- fin sous home -->
			</section>
			<!-- fin wrap -->
			
		</section>
		<!-- fin main -->
