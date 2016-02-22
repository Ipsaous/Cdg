$(document).ready(function(){

    //----------------Partie pour afficher la search Box
    var searchBox = $("#searchBlock");

    $(document).mouseup(function (e) {
        if (!searchBox.is(e.target) // if the target of the click isn't the searhBox...
            && searchBox.has(e.target).length === 0) // ... nor a descendant of the searhBox
        {
            e.preventDefault();
            document.getElementById('mainContent').style.pointerEvents = 'visible';
            searchBox.fadeOut("fast");
            $("body").css("position","static");
            $("#leftSidebar").css("overflow-y", "auto");
            $("#overlay").css("opacity", "1");
            $("#searchButton").css("background-color", "transparent");

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