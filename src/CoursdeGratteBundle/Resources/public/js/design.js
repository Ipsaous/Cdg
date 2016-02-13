$(document).ready(function(){

    //----------------Partie pour afficher la search Box
    var searhBox = $("#searchBox");
    $("#searchIcon").click(function(){
        if($('#searchBox').css('display') == "none"){
            $("#searchBox").fadeIn("fast");
            $("#mainContent").css('opacity', "0.02");
            document.getElementById('mainContent').style.pointerEvents = 'none';
        }else if($('#searchBox').css('display') == "block"){
            $("#searchBox").fadeOut("fast");
            $("#mainContent").css('opacity', "1.0");
            document.getElementById('mainContent').style.pointerEvents = 'visible';
        }

    });

    $(document).mouseup(function (e) {
        if (!searhBox.is(e.target) // if the target of the click isn't the searhBox...
            && searhBox.has(e.target).length === 0) // ... nor a descendant of the searhBox
        {
            $("#mainContent").css('opacity', "1.0");
            document.getElementById('mainContent').style.pointerEvents = 'visible';
            searhBox.fadeOut("fast");
        }
    });

    //------------------Fin partie gérant la searchBox

    //---------- PARTIE FIX SIDEBAR ---------------//

    $(window).scroll(function(){
        var windowTop = $(window).scrollTop()+80;
        $('#allFilters').css('top',windowTop);
    });


    //----------- END PARTIE FIX SIDEBAR --------------//


});