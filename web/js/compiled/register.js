$(document).ready(function(){

    //Récupération des mes items
    var form = document.querySelector("#fos_user_registration_form");
    var items = document.querySelectorAll("div.form-group");
    var inputPseudo = items[0].querySelector("input");
    var inputEmail = items[1].querySelector("input");
    var inputPassword1 = items[2].querySelector("input");
    var inputPassword2 = items[3].querySelector("input");
    var currentEmail = "";
    var currentPseudo = "";
    var currentPassword1 = "";
    var currentPassword2 = "";
    var errorPseudo = false;
    var errorEmail = false;
    var errorPassword1 = false;
    var errorPassword2 = false;

    function checkInput(value){
        var data = "";
        if(value[0] == "pseudo"){
            data = "pseudo="+value[1];
        }else if(value[0] == "email"){
            data = "email="+value[1];
        }
        $.ajax({
            type:"POST",
            url:'../ajax/check',
            data: data,
            dataType:'json',
            success : function(data){
                addError(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                console.log('erreur');
                console.log(XMLHttpRequest.responseText, textStatus, errorThrown);
            }

        });

    }

    function addError(data){

        if(data.pseudo != null){
            errorPseudo = false;
            $(items[0]).find('ul').remove();
            $(items[0]).removeClass("has-error");
            currentPseudo = $('#fos_user_registration_form_username').val();
        }
        if(data.email != null){
            errorEmail = false;
            $(items[1]).removeClass("has-error");
            $(items[1]).find('ul').remove();
            currentEmail = $('#fos_user_registration_form_email').val();
        }
        //Gestion des erreurs
        if(data.errorPseudo != null){
            errorPseudo = true;
            $(items[0]).find('ul').remove();
            $(inputPseudo).before("<ul><li>"+data.errorPseudo+"</li></ul>");
            $(items[0]).addClass("has-error");
            currentPseudo = $('#fos_user_registration_form_username').val();
        }
        if(data.errorEmail != null){
            errorEmail = true;
            $(items[1]).find('ul').remove();
            $(inputEmail).before("<ul><li>"+data.errorEmail+"</li></ul>");
            $(items[1]).addClass("has-error");
            currentEmail = $('#fos_user_registration_form_email').val();
        }
    }
    //Appel de la fonction
    $('#fos_user_registration_form_username').blur(function(){
        console.log(currentPseudo);
        var value = $.trim($(this).val());
        if(value != currentPseudo){
            var data = ["pseudo", value];
            if( value.length > 0){
                checkInput(data);
            }
        }
    });
    $('#fos_user_registration_form_email').blur(function(){
        var value = $.trim($(this).val());
        if(value != currentEmail) {
            var data = ["email", value];
            if (value.length > 0) {
                checkInput(data);
            }
        }
    });
    $("#fos_user_registration_form_plainPassword_first").keyup(function(){
        var value = $.trim($(this).val());
        console.log(value.length);
        if(value.length > 4) {
            if (value.length < 8) {
                errorPassword1 = true;
                $(items[2]).find('ul').remove();
                $(items[2]).removeClass("has-success");
                $(items[2]).addClass("has-error");
                $(inputPassword1).before("<ul><li>Le mot de passe est trop court</li></ul>");
            } else {
                errorPassword1 = false;
                $(items[2]).find('ul').remove();
                $(items[2]).removeClass("has-error");
                $(items[2]).addClass("has-success");
            }
        }
    });

    $("#fos_user_registration_form_plainPassword_second").keyup(function(){
        var value = $.trim($(this).val());
        if(value.length > 4) {
            if (value.length >= 8) {
                var password1 = $.trim($("#fos_user_registration_form_plainPassword_first").val());
                if (value !== password1) {
                    errorPassword2 = true;
                    $(items[2]).find('ul').remove();
                    $(items[3]).addClass("has-error");
                    $(items[2]).addClass("has-error");
                    $(items[3]).removeClass("has-success");
                    $(inputPassword1).before("<ul><li>Les deux mots de passe ne sont pas identiques</li></ul>");
                } else {
                    errorPassword2 = false;
                    $(items[2]).find('ul').remove();
                    $(items[2]).removeClass("has-error");
                    $(items[3]).removeClass("has-error");
                    $(items[3]).addClass("has-success");
                }
            }
        }
    });

    //Au click sur le bouton ( en dehors des appels ajax ), je check tout ça
    $("form").submit(function(e){
        if(!errorPseudo && !errorEmail && !errorPassword1 && !errorPassword2){
            return;
        }
        e.preventDefault();
    });

});