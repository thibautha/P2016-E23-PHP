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

	//Lorsqu'on clique sur le bouton "autre vin"
	$('.autre-vin').on('click', function(){
		
		// On récupère son nom
		var nomVinActuel = $("#random h3").html();

		/*On éxécute une requête asynchrone pour nous afficher un autre vin */
		
		$.ajax({   
		   type: "GET",
		   contentType: 'application/json; charset=UTF-8',
		   url: "./public/ajax/autreVin.php",
		   data: {nomVinActuel : nomVinActuel},
		   dataType:'json',
		   success:function(autreVin){
		   		var vinId = autreVin["wine_id"];
            	$("#random h3").animate('easeOut', 1000).replaceWith('<h3>'+autreVin["wine_name"]+'</h3>'); 
            	vinImg = autreVin["wine_img"],
            	vinO = autreVin["wine_origine"]
            	vinC = autreVin["wine_cepage"]
            	vinM = autreVin["wine_millesime"];

		   }
		});
	});

});

