$(document).ready(function(){

	//Déclaration des variables
	number = 24;
	offset = 0;
	processing = false; //Pour empecher les multiclick
	propagation = false;

	//Fonction qui récupère les résultats

	function getParam(langue, prof, style){

		number = 24;
		offset = 0;
		difficulty = $('#selectDifficulty option:selected').val();
		style = style;
		prof = prof;
		typeguitare = $('#selectTypeguitare option:selected').val();
		typejeu = $('#selectTypejeu option:selected').val();
		langue = langue;
		tablature = $("#tablature input:checked").val();
		query = $('#search').val();
		typetuto = $('#selectTypetuto option:selected').val();

		//On change tous les trucs par "" 			
		if(prof == "Tous les profs"){
			prof ="";
		}
		if(typeguitare == "Tous types de guitares"){
			typeguitare ="";
		}
		if(typejeu == "Tous types de jeux"){
			typejeu ="";
		}
		if(difficulty == "Toutes les difficultés"){
			difficulty = "";			
		}
		if(langue == "Toutes les langues"){
			langue ="";
		}
		if(tablature != 1){
			tablature = "";
		}		
		//Disable des input Style chanson et style technique
		if(typetuto == 1){			
			$('#selectStyle').attr('disabled', false);
			$('#selectTypejeu').attr('disabled', false);
		}
		if(typetuto == 2 ){			
			if(typejeu != "Tous types de jeu"){
				$('#selectTypejeu option[value="Tous types de jeu"]').attr('selected',true);				
			}

			typejeu = "";
			query = "";
			$('#selectStyle').attr('disabled', false);				
			$('#selectTypejeu').attr('disabled', true);

		}			
		if(typetuto == "Tous types de tutos"){	
			$('#selectTypejeu').attr('disabled', true);
			$('#selectStyle').attr('disabled', true);
			$('#selectTypejeu option[value="Tous types de jeu"]').attr('selected',true);			
			style = "";
			styletechnique = "";
			typejeu = "";
		}

		//Fin des disable
		//-----------------------------------//
		if(style == "Tous les styles"){
			style ="";
		}	
		if(typetuto == "Tous types de tutos"){
			typetuto ="";
		}
		if(typejeu == "Tous types de jeu"){
			typejeu ="";
		}

		$('#seemore').hide();
		$('#itemContainer').empty();
		$('.noresult').hide();
		$('#loading').show();//Affiche le loader

		$.ajax({
			type:'GET',
			url:"./",
			data:'Difficulty='+difficulty+'&Style='+style+'&Prof='+prof+'&Typeguitare='+typeguitare+'&Typejeu='+typejeu+'&Langue='+langue+'&Tablature='+tablature+'&Query='+query+'&Typetuto='+typetuto+'&number='+number+'&offset='+offset,
			dataType:'json',			
				
			success: function(data){
				//Affichage des résultats
                console.log(data);
                results = data.data;
                if(results.length > 0){
                    console.log(" supérieur a 0" );
                    for (var j = 0 ; j < results.length; j++){

                        //récup des drapeaux
                        flag = recupFlag(results[j].langue);

                        //Rajout des '...' //
                        titre = shorter(results[j].titre);
                        artiste = shorter(results[j].artiste);
                        prof = shorter(results[j].prof);
                        console.log(results[j]);

                        $('#itemContainer').append('<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 record"><div class="flag"><img src="'+flag+'"></div><a href="./tuto/'+results[j].slug+'-'+results[j].tutoid+'"><div class="thumbnail class-'+results[j].id_difficulty+'"><div class="fonce-'+results[j].id_difficulty+'"></div><img src="http://img.youtube.com/vi/'+results[j].lientuto+'/mqdefault.jpg"  class="img-responsive vignette" alt="'+results[j].titre+'"><ul class="info"><li class="titre">'+titre+'</li><li class="artiste">'+artiste+'</li><li class="prof">'+prof+'</li></ul></div></a><ul class="favoris"><li class="li-favoris" id="'+results[j].tutoid+'" data-toggle="modal" data-target="#favModal">Ajouter aux Favoris</li></ul></div>');

                    }
                }

			    //affichage(data);
			},
			error: function(xhr, status, error) {
			  /*var err = eval("(" + xhr.responseText + ")");
			  console.log(err.Message);
			  */
			}
		});
	}

//Creation de la fonction affichage des resultats

	function affichage(data){

		$('.noresult').hide();
			if(data != ""){	
				results = data.results;
				favs = data.favs;				
				
				$('#loading').hide();
				$('#loadingmore').hide();

				if(results.length > 0){
					for (var j = 0 ; j <results.length; j++){
				
				//récup des drapeaux
					flag = recupFlag(results[j].langue);

					//Rajout des '...' //
					titre = shorter(results[j].titre);
					artiste = shorter(results[j].artiste);
					prof = shorter(results[j].prof);

						$('#itemContainer').append('<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 record"><div class="flag"><img src="'+flag+'"></div><a href="./tuto/'+results[j].slug+'-'+results[j].tutoid+'"><div class="thumbnail class-'+results[j].id+'"><div class="fonce-'+results[j].id+'"></div><img src="http://img.youtube.com/vi/'+results[j].lientuto+'/mqdefault.jpg"  class="img-responsive vignette" alt="'+results[j].titre+'"><ul class="info"><li class="titre">'+titre+'</li><li class="artiste">'+artiste+'</li><li class="prof">'+prof+'</li></ul></div></a><ul class="favoris"><li class="li-favoris" id="'+results[j].tutoid+'" data-toggle="modal" data-target="#favModal">Ajouter aux Favoris</li></ul></div>');
						$('#itemContainer .record').slice(offset, offset + number).hide();
					}
                }
                showDiv();

			}

		//Affichage du message " Pas de résultat"
			if(data.results.length === 0){
				$('.noresult').show();
			}
		//Rajout de la classe active pour les favoris déjà ajoutés.
			if(favs && favs.length > 0){
				$('.li-favoris').each(function(){
					favid = $(this).attr('id');

					for(var f = 0; f < favs.length; f++){
						if(favid == favs[f]){
							$(this).addClass('fav-active');
							$(this).text('');
							$(this).addClass('glyphicon glyphicon-star');
						}
					}
				});

			}	

		//AJOUT FAVORIS				
			$('.li-favoris').click(function(){						
				$('#messageFav').empty();
				checkclass = $(this).hasClass('fav-active');
				id = $(this).attr('id');
				
				if(favs){
					$(this).addClass('fav-active');
					$(this).text('');
					$(this).fadeIn().addClass('glyphicon glyphicon-star');
				}
				
				if(checkclass == true || propagation == true){
					return false;
				}else{
					addFav(id);
				}							
			});	
				
		//SEE MORE PAGINATION SI PLUS DE 24 RESULTATS
			if(results){	
				if(results.length >= 24){	
					$('#seemore').show();
				}else{
					$('#seemore').hide();
				}
			}
	} // Fin de la fonction d'affichage

	//Fonction rajout aux favoris
	function addFav(id){	

		$('.modal-content').css('background-color','');	
		$('#messageFav').empty();
		$('#messageFav').fadeIn();

		$.ajax({
			type:'GET',
			url:'./ajax/favorisajax.php',
			data:'favid='+id,
			dataType:'html',
			success: function(test){
				if (test == "Favoris ajouté"){				
					$('.modal-content').css('background-color','rgb(180, 255, 180)');
					$('#messageFav').append(test);							
				}else{					
					$('.modal-content').css('background-color','rgb(255, 151, 151)');
					$('#messageFav').append("Vous devez vous connecter pour ajouter un tuto aux favoris");
					propagation = true;				
				}

				$('.close').click(function(){
					$('.modal-content').css('background-color','');		
					$('#favModal').modal('hide');
				});	
			},
			error : function(){
				console.log('impossible de rajouter aux favoris');				
			}
		});
	}

	function getStyle(){

		typetuto = $('#selectTypetuto option:selected').val();  
		if(typetuto === "Tous types de tutos"){
			typetuto = "";
		}
		$.ajax({	
			url:"./ajax/langueajax.php",
			type:"GET",
			data:"Typetuto="+typetuto,
			datatype:"html",
			success: function(data){			
				$('#selectStyle').html(data);
			},
			error : function(){
				console.log("NOT OKI");
			}

		});
	}

	function getSearch(query){

		number = 24;
		offset = 0;
		query = $('#search').val();
		langue = $('#selectLangue option:selected').val();

		if(langue == "Toutes les langues"){
			langue = "";
		}

		$('#loading').show();//Affiche le loader
		$('.noresult').hide();	
		$('#itemContainer').empty();//Vide les résultats
		
			$.ajax({
				type:'GET',
				url:'./ajax/ajax.php',
				data:'Query='+query+'&Langue='+langue,
				dataType:'json',
			success: function(data){
				affichage(data);	
			},
			error : function(){
				console.log("ca marche pas");
			}
		});
	}

	function getProf(){

		langue = $('#selectLangue option:selected').val();
		prof = $('#selectProf option:selected').val();

		if(langue == "Toutes les langues"){
			langue = "";
		}
		if(prof == "Tous les profs"){
			prof ="";
		}
		$.ajax({	
			url:"./ajax/langueajax.php",
			type:"GET",
			data:"Langue="+langue,
			datatype:"html",
			success: function(data){				
				$('#selectProf').html(data);
			},
			error : function(){
				console.log("NOT OKI");
			}
		});
	}

	//Function pour reset au lancement d'une recherche
	function resetAfterSearch(suppr){

		offset = 0;
		number = 24;		
		//Je regarde combien j'ai d'options dans le select pour savoir si y'a une préselection de l'user
		//Si il y en a plus d'une, je peux faire un reste des langues
		optionLangue = $('#selectLangue option').length;

		if(optionLangue > 1){
			$('#selectLangue').val('Toutes les langues');
				getProf();
		}
		if(suppr == true){
			$('#search').val('');
			getParam($("#selectLangue option:selected").val(), '', $('#selectStyle option:selected').val());
		}
		$('#selectDifficulty').val("Toutes les difficultés");
		$('#selectStyle').val("Tous les styles");	
		$('#selectProf').val("Tous les profs");
		$('#selectTypeguitare').val("Tous types de guitares");
		$('#selectTypejeu').val("Tous types de jeux");		
		$("#selectTypetuto").val("Tous types de tutos");
		$('#selectTab').removeAttr('checked');
		$('#selectStyle').attr('disabled', true);	
		$('#selectTypejeu').attr('disabled', true);
		$('#choice .options').text('');

		

		if(suppr == false){
			getSearch();			
		}

	}

	function getMore(offset){
				
		difficulty = $('#selectDifficulty option:selected').val();
		style = $('#selectStyle option:selected').val();
		prof = $('#selectProf option:selected').val();
		typeguitare = $('#selectTypeguitare option:selected').val();
		typejeu = $('#selectTypejeu option:selected').val();
		langue = $("#selectLangue option:selected").val();
		tablature = $("#tablature input:checked").val();
		query = $('#search').val();
		typetuto = $('#selectTypetuto option:selected').val();		
		
		//On change tous les trucs par "" 			
		if(prof == "Tous les profs"){
			prof ="";
		}
		if(typeguitare == "Tous types de guitares"){
			typeguitare ="";
		}
		if(typejeu == "Tous types de jeux"){
			typejeu ="";
		}
		if(difficulty == "Toutes les difficultés"){
			difficulty = "";			
		}
		if(langue == "Toutes les langues"){
			langue ="";
		}
		if(tablature != 1){
			tablature = "";
		}		
		//Disable des input Style chanson et style technique
		if(typetuto == 1){			
			$('#selectStyle').attr('disabled', false);
			$('#selectTypejeu').attr('disabled', false);
			
		}
		if(typetuto == 2 ){			
			if(typejeu != "Tous types de jeu"){					
				$('#selectTypejeu option[value="Tous types de jeu"]').attr('selected',true);				
			}
			typejeu = "";
			query = "";
			$('#selectStyle').attr('disabled', false);				
			$('#selectTypejeu').attr('disabled', true);
		}
			
			if(typetuto == "Tous types de tutos"){		
				$('#selectTypejeu').attr('disabled', true);
				$('#selectStyle').attr('disabled', true);	
				$('#selectTypejeu option[value="Tous types de jeu"]').attr('selected',true);			
				style = "";
				styletechnique = "";
				typejeu = "";
			}

		//Fin des disable

		//-----------------------------------//
		if(style == "Tous les styles"){
			style ="";
		}	
		if(typetuto == "Tous types de tutos"){
			typetuto ="";
		}
		if(typejeu == "Tous types de jeu"){
			typejeu ="";
		}
		$.ajax({
			type:'GET',
			url:'./ajax/ajax.php',
			data:'Difficulty='+difficulty+'&Style='+style+'&Prof='+prof+'&Typeguitare='+typeguitare+'&Typejeu='+typejeu+'&Langue='+langue+'&Tablature='+tablature+'&Query='+query+'&Typetuto='+typetuto+'&number='+number+'&offset='+offset,
			dataType:'json',
			success: function(data){
				if(data.results != ""){
					if(data.results.length < 24){
						$('#seemore').hide();
					}

					affichage(data);
					offset = offset + number;
					
				}else{
					$('#seemore').hide();
					$('#loadingmore').hide();
				}
			},
			error : function(){
				console.log("ca marche pas");
			}
		});
	}

	function shorter(string){
		if(string.length > 18){
			string = string.substr(0,18);
			string += '...';			
		}
		return string;
	}

	//Lancement des fonctions par défaut
	getParam($("#selectLangue option:selected").val(), $('#selectProf option:selected').val(), $('#selectStyle option:selected').val());
	getStyle();
	getProf();

	//Sélection des différents filtres
	$('#selectDifficulty, #selectProf, #selectTypejeu, #selectTypeguitare, #selectStyle').change(function(){
		getParam($("#selectLangue option:selected").val(), $('#selectProf option:selected').val(), $('#selectStyle option:selected').val());		
	});	
	$('#selectTab').change(function(){		
		getParam($("#selectLangue option:selected").val(), $('#selectProf option:selected').val(), $('#selectStyle option:selected').val());
	});
	$('#selectLangue').change(function(){			
			getParam($("#selectLangue option:selected").val(), '', $('#selectStyle option:selected').val());
	});
	$('#selectTypetuto').change(function(){				
			getParam($("#selectLangue option:selected").val(), $('#selectProf option:selected').val(), '');
	});
	//Récupération des styles en fonction du type de tuto choisit
	$('#selectTypetuto').change(function(){
		getStyle();
	});
	//Changemet des profs en fonction de la langue choisie
	$('#selectLangue').change(function(){			
		getProf();
	});

	//Lancement de la recherche et Reset
	$('#search').keypress(function(e){		
		if(e.which == 13) {
			resetAfterSearch(false);
		}
	});
	$('.pushsearch').click(function(){
		resetAfterSearch(false);
	});	
	//Si touche suppr je reset seulement
	$('#search').keyup(function(e){
		if(e.which == 46){
			resetAfterSearch(true);
		}
	});
	//Gestion du bouton reset
	$('.reset').on('click',function(){

		var offset = 0;
		var number = 24;
		//Je regarde combien j'ai d'options dans le select pour savoir si y'a une préselection de l'user
		//Si il y en a plus d'une, je peux faire un reste des langues
		var optionLangue = $('#selectLangue option').length;
		if(optionLangue > 1){
			$('#selectLangue').val('Toutes les langues');
			getProf();
		}
		$('#search').val('');
		$('#selectDifficulty').val("Toutes les difficultés");
		$('#selectStyle').val("Tous les styles");	
		$('#selectProf').val("Tous les profs");
		$('#selectTypeguitare').val("Tous types de guitares");
		$('#selectTypejeu').val("Tous types de jeux");		
		$("#selectTypetuto").val("Tous types de tutos");
		$('#selectTab').removeAttr('checked');
		$('#selectStyle').attr('disabled', true);	
		$('#selectTypejeu').attr('disabled', true);
		$('#choice .options').text('');

		getParam($("#selectLangue option:selected").val(), $('#selectProf option:selected').val(), $('#selectStyle option:selected').val());

});
		

	//Appel à la fonctio getMore et function du bouton
	//je cache le loader afficher plus 
	$('#loadingmore').hide();
	//Bouton pour afficher plus. Augmentation de l'offset.
	$('#seemore').click(function(){
		$('#seemore').hide();
		$('#loadingmore').show();
		offset = offset + number;
		getMore(offset);

		//reset de l'offset au changement des select ou clik + recherche.
		$('#selectDifficulty, #selectProf, #selectTypejeu, #selectTypeguitare, #selectStyle, #selectTab, #selectTypetuto, #selectLangue').change(function(){
			offset = 0;
		});
		$('.reset').on('click',function(){
			offset = 0;
		});
		$('#search').keypress(function(e){		
			if(e.which == 13) {
				offset=0;
			}
		});
		$('.pushsearch').click(function(){
			offset = 0;
		});
	});

	function addLabel(idChoice, option, defaultValue){

		$(idChoice).change(function(){

			choice =  $(idChoice+' option:selected').html();
			console.log(choice);
			console.log(defaultValue);
			if(choice !== defaultValue ){
				$(option).empty();
				$(option).append('<span class="label label-default">'+choice+'</span>');
			}else{
				$(option).text('');
			}
		});
	}

	//Rajout des labels
	addLabel('#selectDifficulty', '#optiondifficulty', 'Toutes les difficultés');
	addLabel('#selectProf', '#optionprof', 'Tous les profs');
	addLabel('#selectStyle', '#optionstyle', 'Tous les styles');
	addLabel('#selectTypeguitare', '#optiontypesguitares', 'Tous types de Guitares');
	addLabel('#selectTypejeu', '#optiontypesjeu', 'Tous types de jeu');

	//Cas particulier pour la tablature et la langue
	$('#selectTab').change(function(){

		selectchoice = $('#selectTab');	

		if($(selectchoice).is(':checked')){
			$('#optiontablature').empty();
			$('#optiontablature').append('<span class="label label-default">Tablature</span>');
		}else{
			$('#optiontablature').text('');
		}
	});
	$('#selectLangue').change(function(){

		selectchoice = $('#selectLangue option:selected').html();

		//si plusieurs résultats dans le select Langue
		optionLangue = $('#selectLangue option').length;

		if(optionLangue > 1){
			if(selectchoice != "Toutes les langues"){
				$('#optionprof').empty();
				$('#optionprof').text('');
				$('#optionlangue').empty();
				$('#optionlangue').append('<span class="label label-default">'+selectchoice+'</span>');
			}else{
				$('#optionlangue').text('');
			}
		}
	});

	//Reset du style si je change de type tutos
	$('#selectTypetuto').change(function(){	
		$('#optionstyle').text('');	
	});

	//Récupération des drapeaux
	function recupFlag(langue){

		if(langue == 'Anglais'){
			return lien = './public/images/uk.jpg';
		}
		if(langue == 'Français'){
			return lien = './public/images/france.jpg';
		}
		if(langue == 'Portuguais'){
			return lien = './public/images/brazil.jpg';
		}
		if(langue == 'Allemand'){
			return lien = './public/images/deutsch.jpg';
		}
		if(langue == 'Espagnol'){
			return lien = './public/images/spain.jpg';
		}
		if(langue == "Arabe"){
			return lien = './public/images/arabe.jpg';
		}
		if(langue == "Italien"){
			return lien = './public/images/italie.jpg';
		}
	}

	/***************************************************************\
	          Function autocompletion TYPEAHEAD
/***************************************************************/

	// constructs the suggestion engine
		var artistes = new Bloodhound({
		   datumTokenizer: function (datum) {
		        return Bloodhound.tokenizers.whitespace(datum.artiste);
		    },
		  queryTokenizer: Bloodhound.tokenizers.whitespace,
		  // `states` is an array of state names defined in "The Basics"
		  remote: {
		  	url : './ajax/ajax_for_typeahead.php?artiste=%QUERY',		  	
		  	wildcard : '%QUERY'
		  	}
		});	
		var titres = new Bloodhound({
		   datumTokenizer: function (datum) {
		        return Bloodhound.tokenizers.whitespace(datum.titre);
		    },
		  queryTokenizer: Bloodhound.tokenizers.whitespace,
		  // `states` is an array of state names defined in "The Basics"
		  remote: {
		  	url : './ajax/ajax_for_typeahead.php?titre=%QUERY',		  	
		  	wildcard : '%QUERY'
		  	}
		});	

		var profs = new Bloodhound({
		   datumTokenizer: function (datum) {
		        return Bloodhound.tokenizers.whitespace(datum.prof);
		    },
		  queryTokenizer: Bloodhound.tokenizers.whitespace,
		  // `states` is an array of state names defined in "The Basics"
		  remote: {
		  	url : './ajax/ajax_for_typeahead.php?prof=%QUERY',		  	
		  	wildcard : '%QUERY'
		  	}
		});			

		artistes.initialize();
		titres.initialize();
		profs.initialize();
		$('#search').typeahead({
		  hint: false,
		  highlight: true,
		  minLength: 1
		},
		{
		  name: 'artistes',		  
		  displayKey: 'artiste',
		  source: artistes.ttAdapter(),
		  limit:5,
		  templates:{
		  	header:'<h5>Artiste(s)</h5>'
		  	}
		},
		{
		  name: 'titres',
		  displayKey: 'titre',
		  source: titres.ttAdapter(),
		  limit:5,
		  templates:{
		  	header:'<h5>Titre(s)</h5>'
		  	}
		},
		{
		  name: 'profs',
		  displayKey: 'prof',
		  source: profs.ttAdapter(),
		  limit:5,
		  templates:{
		  	header:'<h5>Prof(s)</h5>'
		  	}
		});

		//Fonction pour afficher en fadeIn les vignettes
	function showDiv() {
    // If there are hidden divs left
   		 if($('.record:hidden').length) {
	        // Fade the first of them in
	        $('.record:hidden:first').fadeIn();
	        // And wait one second before fading in the next one
	        setTimeout(showDiv, 15);
    	}
	}
});

