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
    //Partie qui gère les tutos en plusieurs parties et load l'id youtube correspondant
    $("#linkContainer").on("click", ".videoLink", function () {
        links.removeClass("activePart");
        links.find("i").css("display", "none");
        var videoId = $(this).attr("data-videoId");
        $(this).find("i").css("display", "inline-block");
        $(this).addClass("activePart");
        $("#actualVideo").attr("src", pathYoutube + videoId);
    });

    //Gère l'affichage de la sidebar avec les tutos d'un meme artiste/meme chanson
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
        var height = contentDescription.css("height");
        console.log(contentDescription.css("height"));

        if(height < "165px"){
            $('#afficherPlus').hide();
            $('#sepDescription').hide();
            contentDescription.css('height','auto');

        }
        else{
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

    var playlistContainer = $("#playlistContainer");
    var checkboxes = playlistContainer.find(".checkbox");
    var favorisForm = $('form[name="favoris"]');

    //Je boucle pour pouvoir rajouter l'appel ajax sur mes "radios"
    checkboxes.each(function(i){
        var input = $(checkboxes[i]).find('input[type="radio"]');
        $(input).change(function(){
            $("#loaderPlaylist").show().css("display", "inline-block");
            addFavoris(favorisForm);
        });
    });

    /**
     * Function permettant de faire un appel ajax pour rajouter un favoris dans une playlist existante
     * ou d'en rajouter un dans une playlist nouvellement crée
     * @param form
     */
    function addFavoris(form){
        var url = form.attr("action");
        $.ajax({
            type:"POST",
            url:url,
            data: form.serialize(),
            dataType: "json",
            success: function(data){
                handleResponse(data);
            },
            error : function(){
                console.log("Une erreur est survenue");
            }
        });
    }

    /**
     * Fonction qui permet de gérer la réponse Ajax permettant de rajouter un favoris/playlist
     * @param data
     */
    function handleResponse(data){

        $(".modal").modal("hide"); //Je Cache La Modal
        $("#loaderPlaylist").hide(); // Je Cache Le Loader
        //Je rajoute le message comme quoi un favoris a été ajouté et/ou une playlist crée
        //J'ai des erreurs
        if(data.error !== undefined){
            var error = data.error.replace("ERROR:", "");
            $("#favShareContainer").after("<div class='alert alert-danger'>"+error+"</div>");
        }else{
            $("#favShareContainer").after("<div class='alert alert-success'>"+data.message+"</div>");
        }

        //Je cachel le message
        $(".alert-success, .alert-danger").delay(3000).slideUp();

        //Si c'est une création de playlist, je rajoute une nouvelle playlist dans la liste des "radios"
        if(data.playlist !== undefined) {

            $("#favoris__token").before(
                "<div class='checkbox'><input type='radio' id='favoris_playlist_" + data.playlist.id + "' name='favoris[playlist]' require='required' value='" + data.playlist.id + "' checked='checked'><label for='favoris_playlist_" + data.playlist.id + "' name='favoris[playlist]' required='required' value='" + data.playlist.id + "'>" + data.playlist.name + "</label></div>");

            //J'efface la valeur de l'input
            $("#playlist_name").val("");
            //Je rajoute le comportement me permettant de cliquer sur la nouvelle playlist crée
            $("#playlistContainer .checkbox").last().find("input[type='radio']").change(function(){
                $("#loaderPlaylist").show().css("display", "inline-block");
                addFavoris(favorisForm);
            });
        }
    }

    $("#addPlaylist").click(function(e){
        e.preventDefault();
        $("#loaderPlaylist").show().css("display", "inline-block");
        var playlistForm = $("form[name='playlist']");
        if($.trim(playlistForm.length) > 0)
            addFavoris(playlistForm);
    });

    $(".alert-success").delay(3000).slideUp();



});