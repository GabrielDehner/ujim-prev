$(function() {

    fullscreen();

    $(window).resize(function () {
       fullscreen();
    });

});

function fullscreen() {
    const width = $(window).width();
    const height = $(window).height() - 90;

    $('#contenedor').css({
        width,
        'min-height': height
    });
}