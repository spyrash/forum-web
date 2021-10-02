$(document).ready(function(){ 
    $(".myButton").click(function(){
        if($(".myCode").css("display")=="none") {
            $(".myCode").fadeIn(800);
            blurElement(".langImg, .testo",4);
        }
        else {
            $(".myCode").fadeOut(800);
            blurElement(".langImg, .testo",0);
        }
    });
});

function blurElement(element, size) {
    var filterVal = 'blur(' + size + 'px)';
    $(element).css({
        'filter':filterVal,
        'webkitFilter':filterVal,
        'mozFilter':filterVal,
        'oFilter':filterVal,
        'msFilter':filterVal,
        'transition':'all 0.5s ease-out',
        '-webkit-transition':'all 0.5s ease-out',
        '-moz-transition':'all 0.5s ease-out',
        '-o-transition':'all 0.5s ease-out'
    });
}