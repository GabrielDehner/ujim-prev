$(function() {

    fullscreen();

    $(window).resize(function () {
        fullscreen();
    });

});

function fullscreen() {
    const width = $(window).width();
    const height = $(window).height() - 108;

    $('#competition').css({
        width,
        'min-height': height
    });
}