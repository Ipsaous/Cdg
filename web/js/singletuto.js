$(document).ready(function(){
    var pathYoutube = "//www.youtube.com/embed/";
    var actualVideo = $("#actualVideo").attr("data-videoId");
    var links = $("#linkContainer > li");
    for (var i = 0; i < links.length; i++) {
        if ($(links[i]).attr("data-videoId") === actualVideo) {
            $(links[i]).find("i").css("display", "inline-block");
            $(links[i]).addClass("activePart");
        }
    }
    $("#linkContainer").on("click", ".videoLink", function () {
        links.removeClass("activePart");
        links.find("i").css("display", "none");
        var videoId = $(this).attr("data-videoId");
        $(this).find("i").css("display", "inline-block");
        $(this).addClass("activePart");
        $("#actualVideo").attr("src", pathYoutube + videoId);
    });

    $("#menuHamburgerTuto").on("click", function () {
//                $("#navSingleTuto").toggleClass("navSingleTutoOpen");
        toggleNavTuto();
    });

    /**
     * Fonction qui affiche/cache le block recherche
     */
    function toggleNavTuto(){
        var navSingleTuto = $("#navSingleTuto");
        var overflowTuto = $("#overlayTuto");
        if(navSingleTuto.hasClass("navSingleTutoOpen")){
            navSingleTuto.removeClass("navSingleTutoOpen");
            navSingleTuto.fadeOut("fast");
            $('body').css("overflow", "visible");
            $("#menuHamburgerTuto").css("background-color", "transparent");
            overflowTuto.css("opacity", "1");

        }else{
            navSingleTuto.fadeIn("fast");
            navSingleTuto.addClass("navSingleTutoOpen");
            $("#menuHamburgerTuto").css("background-color", "rgb(255, 165, 0)");
            $('body').css("overflow", "hidden");
            overflowTuto.css("opacity", "0.05");

        }
    }

    /**
     * Fonction pour agrandir la description
     */
    function showMoreDescription(text){
        var contentDescription = $("#contentDescription");
        if(text <= 400){
            $('#afficherPlus').hide();
            $('#sepDescription').hide();

        }else{
            contentDescription.css('height','165px');
        }

        $('#afficherPlus').click(function(){

            var css = contentDescription.css('overflow');
            console.log(css);

            if(css == 'visible'){
                contentDescription.css('overflow','hidden');
                contentDescription.css('height','158px');
                $('#afficherPlus').text('Plus');

            }else{
                contentDescription.css('overflow','visible');
                contentDescription.css('height','auto');
                $('#afficherPlus').text('Moins');
            }

        });
    }

    showMoreDescription($("#contentDescription").text());

    /**
     * TODO A SUPPRIMER
     */
    function getAllPlaylist(){
        var loader = $("#loaderPlaylist");
        var mainUrl = "../../ajax/playlist";

        $("#favIcon").on("click", function(){
            loader.show().css("display", "block");
            $("#playlistContainer").empty();
            if(userId !== ""){
                $.ajax({
                    type:"POST",
                    url:mainUrl,
                    data: "id="+userId,
                    dataType: "json",
                    success: function(data){
                        console.log(data);
                        loader.hide();
                        for(var i = 0; i < data.length; i++) {
                            $("#playlistContainer").append(
                                "<div id='checkbox'><label><input type='hidden' value='"+data[i].id+"'/><input type='checkbox'/>"+data[i].name+"</label></div>");
                        }

                    },
                    error : function(){
                        console.log("Une erreur est survenue");
                        loader.hide();
                    }
                });

            }

        });
    }

});