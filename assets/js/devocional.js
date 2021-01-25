$(function() {
    $(".diaDevocional").click(function(){
        var fecha = document.getElementById(this.id).getAttribute('data-value');
        window.location.href = `./devocionales/dia/${fecha}`;
    });
})