$(document).ready(function(){

    //Activation des tooltip
    $('[data-toggle="tooltip"]').tooltip();

    //Variable globale
    var requete = "";
    var offset = 0;
    var limit = 24;
    var showMore = false;
    var loader = $("#loader");
    var mainUrl = "./ajax";


    function ajaxQuery(method, url, dataString, params){

        //Si j'ai pas cliqué sur afficher plus, je vide le container
        if(!showMore){
            $('#itemContainer').empty();
        }
        loader.show();
        console.log(url);
        $.ajax({
            type:method,
            url:url,
            data:dataString,
            dataType:'json',
            success: function(data){

                var loader = $("#loader");
                loader.hide();
                $("#loadingMore").hide();
                console.log(params);
                if(params == "tutos"){
                    affichage(data);
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

    function affichage(data){

        loader.hide();
        var container = $('#itemContainer');
        var results = data.data;
        var topMois = $('#topMois');
        if(results.length > 0){
            for(var j=0; j < results.length; j++) {
                var flag = recupFlag(results[j].langue);
                var titre = shorter(results[j].titre);
                var artiste = shorter(results[j].artiste);
                var prof = shorter(results[j].prof);

                container.append('<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 tutoVignette"><img class="flag" src="'+flag+'"/><a href="./tuto/' + results[j].slug + '-' + results[j].tutoid + '"><div class="thumbnail class-' + results[j].id + '"><img src="http://img.youtube.com/vi/' + results[j].lientuto + '/mqdefault.jpg"  class="img-responsive vignette" alt="' + results[j].titre + '"><ul class="info"><li class="fonce-' + results[j].id + '"></li><li class="titre">' + titre + '</li><li class="artiste">' + artiste + '</li><li class="prof">' + prof + '</li></ul></div></a></div>');

                $('#itemContainer .tutoVignette').slice(offset, offset + limit).hide();
            }
        }
        showDiv();

        //Affichage du bouton "afficher plus"
        if(results.length >= 24){ // si j'ai plus de 24 résultats, j'affiche le bouton
            $("#seeMore").show();
        }else{
            $("#seeMore").hide();
        }
    }
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

    function resetAllSelect(){
        var allFilters = document.querySelector('#allFilters');
        var items = allFilters.querySelectorAll(allFilters.getAttribute('data-select'));
        for(var i = 0; i < items.length; i++){
           items[i].value = "Choisir";
        }
        var langue = $("#selectLangue").val();
        if(langue == "Choisir"){
            langue = "";
        }
        ajaxQuery("GET", './ajax', "langue="+langue , 'profs');
        disableInput();
    }
    //Récupération des drapeaux
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
    function shorter(string){
        if(string.length > 18){
            string = string.substr(0,18);
            string += '...';
        }
        return string;
    }

    //Ouverture de la sidebar filtre pour les mobiles
    function handleMenuFiltresResponsive(){

        $("#menuHamburger").click(function(){
            var sidebar = $("#leftSidebar");
            sidebar.addClass("filtresOpen");
            $('body').css("overflow", "hidden");
        });

        $("#closeFiltre").click(function(){
            var sidebar = $("#leftSidebar");
            sidebar.removeClass("filtresOpen");
            $('body').css("overflow", "visible");
        });
    }

    //Fonction pour afficher les vignettes en Fade in
    function showDiv() {
        // If there are hidden divs left
        if($('.tutoVignette:hidden').length) {
            // Fade the first of them in
            $('.tutoVignette:hidden:first').fadeIn();
            // And wait one second before fading in the next one
            setTimeout(showDiv, 30);
        }
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
            var query = $(this).val().trim();
            if(query != ""){
                requete = query;
                ajaxQuery("GET", mainUrl, "query="+query, 'tutos');
                resetAllSelect();
                $(this).val("");
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
        $("#selectTab").attr("checked", false);
        resetAllSelect();
        ajaxQuery("GET", mainUrl, "", 'tutos');
    });

    //Gestion de l'ouverture des filtres pour les mobiles
    handleMenuFiltresResponsive();




});