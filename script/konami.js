jQuery(function(){
    var KonamiKeys = [];
    function Konami(e){
        KonamiKeys.push(e.keyCode);
        if (KonamiKeys.toString().indexOf("38,38,40,40,37,39,37,39,66,65") >= 0) {
            jQuery(this).unbind('keydown', Konami);
            kExec();
        }
    }
    jQuery(document).keydown(Konami);
});
function kExec(){
    document.getElementById('WhenIm').innerHTML = '<section><article style="text-align:center;"><video width="848" height="480" controls autoplay><source src="ressources/konami/konami.mp4" type="video/mp4" />Your browser does not support MP4 HTML5 Video :(</video></article></section>';
}
