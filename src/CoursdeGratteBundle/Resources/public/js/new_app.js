$(document).ready(function(){

    function getTutos(langue){

        var url = './';
        var dataString = buildDataString();

        //$.ajax({
        //    type:'GET',
        //    url:'./',
        //    data:dataString,
        //    dataType:'json',
        //    success: function(data){
        //        console.log(data);
        //    },
        //    error : function(){
        //        console.log("ca marche pas");
        //    }
        //});
    }

    function ajaxQuery(method, url, dataString, params){
        $.ajax({
            type:method,
            url:url,
            data:dataString,
            dataType:'json',
            success: function(data){

                if(params == "tutos"){

                    console.log("j'affiche les tutos");

                }else if(params == "profs"){
                    console.log("je remplace les profs");
                    fillProfSelect(data);
                }

            },
            error : function(){
                console.log("ca marche pas");
            }
        });
    }

    function buildDataString(){

        var stringData = "";
        var allFilters = document.querySelector('#allFilters');
        var items = allFilters.querySelectorAll(allFilters.getAttribute('data-select'));
        for(var i = 0; i < items.length; i++){
            if(items[i].value != "Choisir") {
                if (stringData == "") {
                    stringData += items[i].getAttribute('data-name') + "=" + items[i].value;
                } else {
                    stringData += "&" + items[i].getAttribute('data-name') + "=" + items[i].value;
                }
            }
        }
        console.log(stringData);
        return stringData;
    }
    function disableInput(){

        var selectTypetuto = document.querySelector("#selectTypetuto");
        var selectTypejeu = document.querySelector("#selectTypejeu");
        var selectStyle = document.querySelector("#selectStyle");

        selectTypejeu.disabled = true;
        selectStyle.disabled = true;

        $(selectTypetuto).change(function(){
           if($(this).val() == 1){
               selectTypejeu.disabled = false;
               selectStyle.disabled = false;
           }else if($(this).val() == 2){
               selectTypejeu.disabled = true;
               selectStyle.disabled = false;
           }else{
               selectTypejeu.disabled = true;
               selectStyle.disabled = true;
           }
        });
    }

    function affichage(){

    }

    function fillProfSelect(data){
        var profs = data.profs;
        var length = profs.length;
        if(length > 0){
            var selectProf = $("#selectProf");
            selectProf.html("");
            selectProf.append('<option value= Choisir>Tous les profs</option>');
            for(var i = 0; i < length; i++){
                selectProf.append('<option value=' + profs[i].id + '>' + profs[i].prof + '</option>');
            }
        }
    }

    //Lancement des fonctions
    disableInput();
    $("#selectDifficulty, #selectProf, #selectStyle, #selectTypeguitare, #selectTypetuto, #selectTypejeu").change(function(){
        //getTutos();
        ajaxQuery("GET", './', buildDataString(), 'tutos');
    });

    $("#selectLangue").change(function(){
        var langue = $(this).val();
        ajaxQuery("GET", './ajax', "langue="+langue , 'profs');
        ajaxQuery("GET", './', buildDataString(), 'tutos');
    });

});