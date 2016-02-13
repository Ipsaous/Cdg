$(document).ready(function(){

    function ajaxQuery(method, url, dataString, params){
        $.ajax({
            type:method,
            url:url,
            data:dataString,
            dataType:'json',
            success: function(data){

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
        if(inputSearch.value.trim() != ""){
            if(stringData == ""){
                stringData += "query="+inputSearch.value.trim();
            }else{
                stringData += "&query="+inputSearch.value.trim();
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
            console.log(selectStyle);
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
        console.log(data);
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

    //Lancement des fonctions
    disableInput();
    $("#selectDifficulty, #selectProf, #selectStyle, #selectTypeguitare, #selectTypetuto, #selectTypejeu").change(function(){        
        ajaxQuery("GET", './', buildDataString(), 'tutos');
    });

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
        ajaxQuery("GET", './', buildDataString(), 'tutos');
    });

    //Lancement de la recherche
    $("#search").keypress(function(e){
        if(e.which == 13){
            var query = $(this).val().trim();
            ajaxQuery("GET", './', "query="+query, 'tutos');
            resetAllSelect();
        }
    });


});