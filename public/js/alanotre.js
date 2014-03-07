$(function() {
	
	/* UN AUTRE VIN */

	//Lorsqu'on clique sur le bouton "autre vin"
	$('.autre-vin').on('click', function(){
		
		// On récupère son nom
		var nomVinActuel = $("#random h3").html();

		// On éxécute une requête asynchrone pour nous afficher un autre vin
		$.ajax({  
		   type: "GET", //type de requête : get 
		   contentType: 'application/json; charset=UTF-8', //encodage 
		   url: "./public/ajax/autreVin.php", //url du fichier php qui traite la requête
		   data: {nomVinActuel : nomVinActuel}, // donnée à envoyer dans la requête
		   dataType:'json', //type de données récupérées 

		   // Quand on a récupéré les données 
		   success:function(autreVin){ 
		   		
				// On modifie :
		   		// - le titre du vin 
            	$("#random h3")
            	.fadeOut(100, function(){ $(this).html('')})
            	.fadeIn(100, function(){$(this).html('<h3>'+autreVin["wine_name"]+'</h3>')});
            	
            	// - l'attribue alt de l'image
            	$("#random img").attr('alt', autreVin["wine_img"]);
            	
            	// - l'url de l'image
            	var nouvelleUrlImg = "./public/img/avatars/" + autreVin["wine_img"];
            	$("#random img").attr('src', nouvelleUrlImg);
            	
            	// - le millesime du vin 
            	$("#random #millesime").html(autreVin["wine_millesime"]);
            	
            	// - le cepage du vin 
            	$("#random #cepage").html(autreVin["wine_cepage"]);
            	
            	//- le millesime du vin 
            	$("#random #region").html(autreVin["wine_origin"]);

            	//- le conseil
            	$("#ptit-conseil p").html('Conseil : '+autreVin["wine_conseil"]);
		   }
		});
	});

});

