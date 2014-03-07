$(function() {
	/*var availableTags = [
		"ActionScript",
		"AppleScript",
		"Asp",
		"BASIC",
		"C",
		"C++",
		"Clojure",
		"COBOL",
		"ColdFusion",
		"Erlang",
		"Fortran",
		"Groovy",
		"Haskell",
		"Java",
		"JavaScript",
		"Lisp",
		"Perl",
		"PHP",
		"Python",
		"Ruby",
		"Scala",
		"Scheme"
	];*/

	/*

	AUTOCOMPLETION

	var vinsDisponibles;

	$.ajax({
        type: "POST",
        url: "./public/ajax/vinsDisponibles.php",
        dataType: "json",
        data:{vinsDisponibles : },
        success: function(data, status) {

        },
      	error: function(xhr, desc, err) {
        	console.log(xhr);
       		console.log("Details: " + desc + "\nError:" + err);
        }
    });

	var $searchWine = $('#search-wine');


	$searchWine.on('focus', function(){
		$(this).autocomplete({
			source: vinsDisponibles
		});
	});*/

	/* UN AUTRE VIN */

	$('.autre-vin').on('click', function(){

		var nomVin = $("#random-wine">h3).val();

		$.get(({
			'./public/ajax/autreVin.php', // Le fichier cible côté serveur
	        { nomVinActuel = $("#random-wine" > h3).val(); }, // Récupération du nom du vin 
	        function(listeVins){

	        }, //la fonction qui va traiter nos résultats
	        'text' // Format des données reçues
			}
   		});
	});
		
});

