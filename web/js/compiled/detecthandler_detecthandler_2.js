$(document).ready(function(){

    //******************TEST DETECTION ADBLOCK*****************//
    // Function called if AdBlock is not detected
    function adBlockNotDetected() {
        //TODO LAISSER TEL QUEL
        console.log("adblock non detecte");
    }
    // Function called if AdBlock is detected
    function adBlockDetected() {
        //TODO METTRE UNE PUB PARTENAIRE AVEC UNE IMAGE
        console.log("adbloc detecté");
        var windowWidth = $(window).width();
        $(window).resize(function(){
            windowWidth = $(this).width();
            if(windowWidth < 768 ){
                $("#testContainer").empty();
                image = 'ban_amazon_small.png';
                $("#testContainer").append("<img class='img-responsive' src='../images/"+image+"'/>");
            }
            if(windowWidth >= 768){
                $("#testContainer").empty();
                image = 'ban_amazon.png';
                $("#testContainer").append("<img src='../images/"+image+"'/>");
            }
        });

        if(windowWidth < 768){
            var image = 'ban_amazon_small.png';
        }else{
            var image = 'ban_amazon.png';
        }
        $("#testContainer").append("<img class='img-responsive' src='../images/"+image+"'/>");
    }

    // Recommended audit because AdBlock lock the file 'blockadblock.js'
    // If the file is not called, the variable does not exist 'blockAdBlock'
    // This means that AdBlock is present
    if(typeof blockAdBlock === 'undefined') {
        adBlockDetected();
    } else {
        console.log(blockAdBlock);
        blockAdBlock.onDetected(adBlockDetected);
        blockAdBlock.onNotDetected(adBlockNotDetected);
        //blockAdBlock.onDetected(adBlockDetected);
        //blockAdBlock.onNotDetected(adBlockNotDetected);
        //// and|or
        //blockAdBlock.on(true, adBlockDetected);
        //blockAdBlock.on(false, adBlockNotDetected);
        //// and|or
        //blockAdBlock.on(true, adBlockDetected).onNotDetected(adBlockNotDetected);
    }

    // Change the options
    //blockAdBlock.setOption('checkOnLoad', false);
    // and|or
    blockAdBlock.setOption({
        debug: false,
        checkOnLoad: true,
        resetOnEnd: false
    });

});