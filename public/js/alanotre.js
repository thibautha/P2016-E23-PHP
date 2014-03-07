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
	
		var nomVinActuel = $("#random h3").html();

		$.ajax({   
		   type: "GET",
		   url: "./public/ajax/autreVin.php",
		   data: {nomVinActuel : nomVinActuel},
		   dataType:'json',
		   success:function(autreVin){
		   		console.log(autreVin);
		   		//nomVinActuel.empty().html(listeVins);
		   }
		});
	});

});

