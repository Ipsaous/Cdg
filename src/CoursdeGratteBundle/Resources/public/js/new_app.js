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
        loader.show();
        $.ajax({
            type:method,
            url:url,
            data:dataString,
            dataType:'json',
            success: function(data){

                var loader = $("#loader");
                loader.hide();
                if(params == "tutos"){
                    affichage(data);
                }else if(params == "profs"){
                    fillSelectAjax(data.profs, "prof", "#selectProf", "Tous les profs");
                }else if(params == "styles"){
                    fillSelectAjax(data.styles, "style", "#selectStyle", "Tous les styles");
                }else if(params == "stylestechniques"){
                    fillSelectAjax(data.stylestechniques, "styletechnique", "#selectStyle", "Tous les styles");
                }

            },
            error : function(){
                console.log("Une erreur est survenue");
                loader.hide();
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
        var results = data.data;
        var container = $('#itemContainer');
        var topMois = $('#topMois');
        if(!showMore){
            container.empty();
        }
        if(results.length > 0){
            for(var j=0; j < results.length; j++) {
                var flag = recupFlag(results[j].langue);
                var titre = shorter(results[j].titre);
                var artiste = shorter(results[j].artiste);
                var prof = shorter(results[j].prof);

                container.append('<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 tutoVignette"><img class="flag" src="'+flag+'"/><a href="./tuto/' + results[j].slug + '-' + results[j].tutoid + '"><div class="thumbnail class-' + results[j].id + '"><div class="fonce-' + results[j].id + '"></div><img src="http://img.youtube.com/vi/' + results[j].lientuto + '/mqdefault.jpg"  class="img-responsive vignette" alt="' + results[j].titre + '"><ul class="info"><li class="titre">' + titre + '</li><li class="artiste">' + artiste + '</li><li class="prof">' + prof + '</li></ul></div></a></div>');

            }
        }
    }
    function fillSelectAjax(data, type, div, text){
        var length = data.length;
        var element = $(div);
        if(length > 0){
            element.html("");
            element.append('<option value="Choisir">'+text+'</option>');
            for(var i = 0; i < length; i++){
                element.append('<option value=' + data[i].id + '>' + data[i][type] + '</option>');
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


    //------------------- FIN DES FONCTIONS ------------------------//

    //Lancement des fonctions
    disableInput();
    $("#selectDifficulty, #selectProf, #selectStyle, #selectTypeguitare, #selectTypetuto, #selectTypejeu, #selectTab").change(function(){
        ajaxQuery("GET", mainUrl, buildDataString(), 'tutos');
    });
    //Requete en arrivant sur la page
    ajaxQuery("GET", mainUrl, buildDataString(), 'tutos');

    $("#selectTypetuto").change(function(){
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
        var langue = $(this).val();
        if(langue == "Choisir"){
            langue = "";
        }
        ajaxQuery("GET", './ajax', "langue="+langue , 'profs');
        ajaxQuery("GET", mainUrl , buildDataString(), 'tutos');
    });

    //Lancement de la recherche
    $("#search").keypress(function(e){
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


});