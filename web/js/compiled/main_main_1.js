$(document).ready(function(){

    //Activation des tooltip
    $('[data-toggle="tooltip"]').tooltip();

    //Déclaration de quelques variables globales
    var requete = "";
    var offset = 0;
    var limit = 24;
    var showMore = false;
    var loader = $("#loader");
    var mainUrl = "./ajax";

    /**
     * Fonction qui effectue les requête ajax. Récupération de différents
     * types de données selon la requete. (Tutos, profs, styles, stylestechnique)
     * @param method
     * @param url
     * @param dataString
     * @param params
     */
    function ajaxQuery(method, url, dataString, params){

        //Si j'ai pas cliqué sur afficher plus, je vide le container
        var type = 'json';
        if(params == "tutos"){
            type = 'html';
        }
        if(!showMore){
            $('#itemContainer').empty();
        }

        loader.show();
        $.ajax({
            type:method,
            url:url,
            data:dataString,
            dataType: type,
            success: function(data){

                var loader = $("#loader");
                loader.hide();
                $("#loadingMore").hide();
                if(params == "tutos"){
                    //affichage(data);
                    affichageTest(data);
                }else if(params == "profs"){
                    fillSelectAjax(data.profs, "prof", "#selectProf", "Tous les profs");
                }else if(params == "styles"){
                    fillSelectAjax(data.styles, "style", "#selectStyle", "Tous les styles");
                }else if(params == "stylestechniques"){
                    fillSelectAjax(data.stylestechniques, "styletechnique", "#selectStyle", "Tous les styles");
                }
                //Je remet showMore a false;
                showMore = false;
            },
            error : function(){
                console.log("Une erreur est survenue");
                loader.hide();
                $("#loadingMore").hide();
            }
        });
    }

    /**
     * Fonction qui construit la requete que j'envoie en GET
     * @returns {string}
     */
    function buildDataString(){

        var stringData = "";
        var allFilters = document.querySelector('#allFilters');
        var items = allFilters.querySelectorAll(allFilters.dataset.select);
        for(var i = 0; i < items.length; i++){
            if(items[i].value != "Choisir") {
                if (stringData == "") {
                    stringData += items[i].getAttribute('data-name') + "=" + items[i].value;
                } else {
                    stringData += "&" + items[i].getAttribute('data-name') + "=" + items[i].value;
                }
            }
        }
        //Cas particulier pour la recherche
        var inputSearch = document.querySelector("#search");
        //Je je n'ai pas encore fait de requete
        if(requete == "") {
            if (inputSearch.value.trim() != "") {
                if (stringData == "") {
                    stringData += "query=" + inputSearch.value.trim();
                } else {
                    stringData += "&query=" + inputSearch.value.trim();
                }
            }
        //Autrement, j'ai déjà fait une requete et donc je continue à rajouter les filtres par dessus la query
        }else{
            if (stringData == "") {
                stringData += "query=" + requete;
            } else {
                stringData += "&query=" + requete;
            }
        }
        //Cas particulier pour la tablature
        var checkBoxTab = document.querySelector("#selectTab");
        if(checkBoxTab.checked){
            if(stringData == ""){
                stringData += "tablature="+1;
            }else{
                stringData += "&tablature="+1;
            }
        }

        console.log(stringData);
        return stringData;
    }

    /**
     * Fonction qui disable les selects en fonction du typetuto sélectionné
     */
    function disableInput(){

        var selectTypetuto = document.querySelector('#selectTypetuto');
        var selectTypejeu = document.querySelector('#selectTypejeu');
        var selectStyle = document.querySelector('#selectStyle');

        selectTypejeu.disabled = true;
        selectStyle.disabled = true

        $(selectTypetuto).change(function(){
           if($(this).val() == 1){
               selectTypejeu.disabled = false;
               selectStyle.disabled = false;
           }else if($(this).val() == 2){
               selectTypejeu.disabled = true;
               selectStyle.disabled = false;
           }else{
               selectTypejeu.disabled = true;
               selectStyle.disabled = true
           }
        });
    }

    ///**
    // * Fonction qui gère l'affichage du retour de la requete ajax récupérant les tutos
    // * @param data
    // */
    //function affichage(data){
    //
    //    loader.hide();
    //    var container = $('#itemContainer');
    //    var results = data.data;
    //    var topMois = $('#topMois');
    //    if(results.length > 0){
    //        for(var j=0; j < results.length; j++) {
    //            var flag = recupFlag(results[j].langue);
    //            var titre = shorter(results[j].titre);
    //            var artiste = shorter(results[j].artiste);
    //            var prof = shorter(results[j].prof);
    //
    //            container.append('<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 tutoVignette"><img class="flag" src="'+flag+'"/><a href="./tuto/' + results[j].slug + '-' + results[j].tutoid + '"><div class="thumbnail class-' + results[j].id + '"><img src="http://img.youtube.com/vi/' + results[j].lientuto + '/mqdefault.jpg"  class="img-responsive vignette" alt="' + results[j].titre + '"><ul class="info"><li class="fonce-' + results[j].id + '"></li><li class="titre">' + titre + '</li><li class="artiste">' + artiste + '</li><li class="prof">' + prof + '</li></ul></div></a></div>');
    //
    //            $('#itemContainer .tutoVignette').slice(offset, offset + limit).hide();
    //        }
    //    }
    //    showDiv();
    //
    //    //Affichage du bouton "afficher plus"
    //    if(results.length >= 24){ // si j'ai plus de 24 résultats, j'affiche le bouton
    //        $("#seeMore").show();
    //    }else{
    //        $("#seeMore").hide();
    //    }
    //}

    /**
     * Methode qui gère l'affichage des vignettes
     * Remplace la methode affichage qui récupérer la réponse en json et construisait le html a partir de la
     * cette methode utilise directement une réponse html renvoyé en utilisant un template twig
     * @param data
     */
    function affichageTest(data){
        //TODO Changer le nom de la méthode une fois que j'aurais suffisamment testé
        loader.hide();
        var container = $('#itemContainer');

        container.append(data);

        $('#itemContainer .tutoVignette').slice(offset, offset + limit).hide();
        //Fonction qui permet d'afficher les vignettes en fadeIn
        showDiv();

        //Nombre de résultats
        var numberResults = $("#numberResults").val();
        if(numberResults == 0 && showMore == false){
            $("#itemContainer").append("<h2>Aucun Résultat Trouvé</h2>")
        }
        //Affichage du bouton "afficher plus"
        if(numberResults == undefined){ // si j'ai plus de 24 résultats, j'affiche le bouton
            $("#seeMore").show();
        }else{
            $("#seeMore").hide();
        }
    }

    /**
     * Fonction qui rempli les select en ajax ( langue -> prof etc )
     * @param data
     * @param type
     * @param div
     * @param text
     */
    function fillSelectAjax(data, type, div, text){
        if(data != null) {
            var length = data.length;
            var element = $(div);
            if (length > 0) {
                element.html("");
                element.append('<option value="Choisir">' + text + '</option>');
                for (var i = 0; i < length; i++) {
                    element.append('<option value=' + data[i].id + '>' + data[i][type] + '</option>');
                }
            }
        }
    }


    /**
     * Fonction qui reset les selects
     */
    function resetAllSelect(){
        var allFilters = document.querySelector('#allFilters');
        var items = allFilters.querySelectorAll(allFilters.getAttribute('data-select'));
        for(var i = 0; i < items.length; i++){
            if(items[i].classList.contains("langue")){
                if($('#selectLangue option').length > 1){
                    var langue = "";
                    ajaxQuery("GET", './prof', "langue="+langue , 'profs');
                    items[i].value = "Choisir"
                }
            }else{
                items[i].value = "Choisir";
            }
        }
        disableInput();
    }

    /**
     * Fonction qui récupère les images pour les drapeaux
     * @param langue
     * @returns {string}
     */
    function recupFlag(langue){

        if(langue == 'Anglais'){
            return lien = path+'/uk.jpg';
        }
        if(langue == 'Français'){
            return lien = path+'/france.jpg';
        }
        if(langue == 'Portuguais'){
            return lien = path+'/brazil.jpg';
        }
        if(langue == 'Allemand'){
            return lien = path+'/deutsch.jpg';
        }
        if(langue == 'Espagnol'){
            return lien = path+'/spain.jpg';
        }
        if(langue == "Arabe"){
            return lien = path+'/arabe.jpg';
        }
        if(langue == "Italien"){
            return lien = path+'/italie.jpg';
        }
    }

    /**
     * Fonction qui raccourcie une chaine de caractere
     * @param string
     * @returns {*}
     */
    function shorter(string){
        if(string.length > 18){
            string = string.substr(0,18);
            string += '...';
        }
        return string;
    }
    /**
     * Fonction qui appelle la fonction du menu filtre responsive
     */
    function handleMenuFiltresResponsive(){

        $("#menuHamburger").click(function(){
           toggleFiltres();
        });
    }

    /**
     * Fonction qui ferme les filtres
     */
    function closeFiltre(){
        var sidebar = $("#leftSidebar");
        if(sidebar.hasClass("filtresOpen")){
            sidebar.removeClass("filtresOpen");
            $('body').css("overflow", "visible");
            $("#menuHamburger").css("background-color", "transparent");
        }
    }

    /**
     * Fonction qui permet d'afficher/cacher les filtres pour les mobiles
     */
    function toggleFiltres(){
        var sidebar = $("#leftSidebar");
        var tutoContainer = $("#tutoContainer");
        if(sidebar.hasClass("filtresOpen")){
            sidebar.removeClass("filtresOpen");
            $('body').css("overflow", "visible");
            $("#menuHamburger").css("background-color", "transparent");
            tutoContainer.css("opacity", "1");

        }else{
            sidebar.addClass("filtresOpen");
            $("#menuHamburger").css("background-color", "rgb(255, 165, 0)");
            $('body').css("overflow", "hidden");
            tutoContainer.css("opacity", "0.05");

        }
    }

    /**
     * Fonction qui affiche les vignettes en Fade In
     */
    function showDiv() {
        // If there are hidden divs left
        if($('.tutoVignette:hidden').length) {
            // Fade the first of them in
            $('.tutoVignette:hidden:first').fadeIn();
            // And wait one second before fading in the next one
            setTimeout(showDiv, 30);
        }
    }


    /**
     * Fonction qui affiche/cache le block recherche
     */
    function toggleSearch(){
        var searchBlock = $("#searchBlock");
        if(searchBlock.css("display") == "none"){
            $("#search").val("");
            searchBlock.fadeIn("fast");
            $("body").css("position","fixed");
            $("#leftSidebar").css("overflow-y", "hidden");
            $("#overlay").css("opacity", "0.05");
            $("#searchButton").css("background-color", "rgb(255, 165, 0)");
        }else{
            $("#search").val("");
            searchBlock.fadeOut("fast");
            $("body").css("position","static");
            $("#leftSidebar").css("overflow-y", "auto");
            $("#overlay").css("opacity", "1");
            $("#searchButton").css("background-color", "transparent");
        }
    }

    /**
     * Fonction qui vérifie qu'une chaine de caractère est valide
     * @param string
     * @returns {boolean}
     */
    function isStringValid(string){
        if(string.search(/^[a-zA-Z0-9\-\/ _.'&âçêôüîïëàèùé]+$/) !== -1){
            return true;
        }
        return false;

    }

    /**
     * Fonction qui permet de cache le block recherche si je click en dehors de la div
     */
    function hideSearchBlockOnClickOutside() {
        var searchBox = $("#searchBlock");

        $(document).mouseup(function (e) {
            if (!searchBox.is(e.target) // if the target of the click isn't the searhBox...
                && searchBox.has(e.target).length === 0) // ... nor a descendant of the searhBox
            {
                e.preventDefault();
                document.getElementById('mainContent').style.pointerEvents = 'visible';
                searchBox.fadeOut("fast");
                $("body").css("position", "static");
                $("#leftSidebar").css("overflow-y", "auto");
                $("#overlay").css("opacity", "1");
                $("#searchButton").css("background-color", "transparent");

            }
        });
    }


    //------------------- FIN DES FONCTIONS ------------------------//

    //Lancement des fonctions
    disableInput();
    $("#selectDifficulty, #selectProf, #selectStyle, #selectTypeguitare, #selectTypetuto, #selectTypejeu, #selectTab").change(function(){
        offset = 0;
        ajaxQuery("GET", mainUrl, buildDataString(), 'tutos');

    });
    //Requete en arrivant sur la page
    ajaxQuery("GET", mainUrl, buildDataString(), 'tutos');


    $("#selectTypetuto").change(function(){
        offset = 0;
        var typetuto = $(this).val();
        if(typetuto == 1){
            type = "styles";
        }else if(typetuto == 2){
            type = "stylestechniques";
            //Reset le type de jeu
            var selectTypejeu = document.querySelector("#selectTypejeu");
            selectTypejeu.disabled = true;
            selectTypejeu.value = "Choisir";

        }else{
            typetuto = "";
            var selectStyle = document.querySelector("#selectStyle");
            selectStyle.disabled = true;
            selectStyle.value = "Choisir";
        }
        if(typetuto != ""){
            ajaxQuery("GET", './style', "typetuto="+typetuto, type);
        }

    });

    $("#selectLangue").change(function(){
        offset = 0;
        var langue = $(this).val();
        if(langue == "Choisir"){
            langue = "";
        }
        ajaxQuery("GET", './prof', "langue="+langue , 'profs');
        ajaxQuery("GET", mainUrl , buildDataString(), 'tutos');
    });

    //Lancement de la recherche
    $("#search").keypress(function(e){        
        offset = 0;
        if(e.which == 13){
            if(isStringValid($(this).val())){
                var query = $(this).val().trim();
                if(query != ""){
                    requete = query;
                    ajaxQuery("GET", mainUrl, "query="+query, 'tutos');
                    resetAllSelect();
                    $(this).val("");
                    $('#search').typeahead('destroy');
                    toggleSearch();
                    initialiseTypeahead();
                    closeFiltre();
                    $("body").css("overflow", "visible");
                }
            }else{
                console.log("Recherche non valide");
            }
        }
        
    });

    //Gestion de la pagination
    $("#seeMore").click(function(){
        $(this).hide();
        $("#loadingMore").show();
        offset = offset + limit;
        showMore = true;
        var toAppend = "&offset="+offset+"&limit="+limit;
        if(buildDataString() == ""){
            toAppend = "offset="+offset+"&limit="+limit;
        }
        var stringRequest = buildDataString()+toAppend;
        //console.log(stringRequest);
        ajaxQuery("GET", mainUrl, stringRequest, 'tutos');

    });

    //Gestion du bouton Reset
    $(".reset").click(function(){
        //Je check si j'ai une langue dans les options
        requete = "";
        $("#selectTab").attr("checked", false);
        resetAllSelect();
        ajaxQuery("GET", mainUrl, "", 'tutos');
        closeFiltre();
        $("body").css("overflow", "visible");
        $("#tutoContainer").css("opacity", "1");

    });

    //Gestion de l'ouverture des filtres pour les mobiles
    handleMenuFiltresResponsive();

    //Affichage de l'input de la recherche
    $("#searchButton").click(function(){
        toggleSearch();
        $("#search").focus();
    });

    //********************** TYPEAHEAD *************************//
    var titres = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum.titre);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url :'./typeahead?titre=%QUERY',
            wildcard : '%QUERY'
        }
    });
    var profs = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum.prof);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url :'./typeahead?prof=%QUERY',
            wildcard : '%QUERY'
        }
    });
    var artistes = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum.artiste);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url :'./typeahead?artiste=%QUERY',
            wildcard : '%QUERY'
        }
    });

    titres.initialize();
    profs.initialize();
    artistes.initialize();
    initialiseTypeahead();
    function initialiseTypeahead(){        
        $('#search').typeahead({
                hint: false,
                highlight: true,
                minLength: 1
            },
            {
                name: 'titres',
                displayKey: 'titre',
                source: titres.ttAdapter(),
                limit:3,
                templates:{
                    header:'<h5>Titre(s)</h5>'
                }
            },
            {
                name: 'artistes',
                displayKey: 'artiste',
                source: artistes.ttAdapter(),
                limit:3,
                templates:{
                    header:'<h5>Artiste(s)</h5>'
                }
            },
            {
                name: 'profs',
                displayKey: 'prof',
                source: profs.ttAdapter(),
                limit:3,
                templates:{
                    header:'<h5>Prof(s)</h5>'
                }
        });
        
    }


    $("#search").bind("typeahead:select", function(ev, suggestions){
        var suggestion = "";
        if(suggestions.prof != null){
            suggestion = suggestions.prof;
        }else if(suggestions.titre != null){
            suggestion = suggestions.titre;
        }else if(suggestions.artiste != null){
            suggestion = suggestions.artiste;
        }
        if(suggestion != "") {
            requete = suggestion;
            ajaxQuery("GET", mainUrl, "query="+suggestion, 'tutos');
            resetAllSelect();
            $(this).val("");
            $('#search').typeahead('destroy');
            toggleSearch();
            initialiseTypeahead();
            closeFiltre();
            $("body").css("overflow", "visible");

        }
    });

    //********************** FIN TYPEAHEAD *********************//

});