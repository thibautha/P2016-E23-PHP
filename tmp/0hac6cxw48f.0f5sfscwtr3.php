		<script>
		  $(function() {
		    $( "#slider-range" ).slider({
		      range: true,
		      min: 0,
		      max: 2014,
		      values: [ 75, 300 ],
		      slide: function( event, ui ) {
		        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		      }
		    });
		    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
		      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
		  });
		  </script>
		  <article id="filtre-results">
							<p class="filtre-choice">Type</p>
								
								<!-- formulaire type de vin -->
								<form>
								<p>
									<input type="checkbox" name="type" id="rouge" />
									<label for="rouge">Rouge</label>
								</p>
								<p>	
									<input type="checkbox" name="type" id="blanc" />
									<label for="blanc">Blanc</label>
								</p>
								<p>
									<input type="checkbox" name="type" id="rosé" />
									<label for="rosé">Rosé</label>
								</p>
								</form>
								<!-- fin formulaire type -->
							
							<p class="filtre-choice">Région</p>
							
							
								<!-- formulaire région -->
								<form>
								<p>
									<input type="checkbox" name="region" id="Alsace"  />
									<label for="Alsace">Alsace</label>
								</p>
								<p>
									<input type="checkbox" name="region" id="Bordeaux"  />
									<label for="Bordeaux">Bordeaux</label>
								</p>
								<p>
									<input type="checkbox" name="region" id="Bourgogne" />
									<label for="Bourgogne">Bourgogne</label>
								</p>
								<p>
									<input type="checkbox" name="region" id="Champagne"  />
									<label for="Champagne">Champagne</label>
								</p>
								<p>
									<input type="checkbox" name="region" id="Corse" />
									<label for="Corse">Corse</label>
								</p>
								<p>
									<input type="checkbox" name="region" id="Côtes du Rhône" />
									<label for="Côtes du Rhône">Côtes du Rhône</label>
								</p>
								<p>
									<input type="checkbox" name="region" id="Languedoc-Roussillon" />
									<label for="Languedoc-Roussillon">Languedoc-Roussillon</label>
								</p>
								<p>
									<input type="checkbox" name="region" id="Loire"  />
									<label for="Loire">Loire</label>
								</p>
								<p>
									<input type="checkbox" name="region" id="Provence" />
									<label for="Provence">Provence</label>
								</p>
								<p>
									<input type="checkbox" name="region" id="Sud Ouest" />
									<label for="Sud Ouest">Sud Ouest</label>
								</p>
								<p>
									<input type="checkbox" name="region" id="International" />
									<label for="International">International</label>
								</p>
								</form>
								
							
							<p class="filtre-choice">Millésime</p>
								<p>
								  <label for="amount">Price range:</label>
								  <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;">
								</p>
 							<div id="slider-range"></div>
							<!-- METTRE UN SLIDER JQUERY -->
							
						</article>