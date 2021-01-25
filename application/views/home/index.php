<?php date_default_timezone_set('America/Buenos_Aires');?>
<div id="contenedor">
    <section id="main">
        <div class="header">
            <img src="<?= base_url('assets/images/resized/ujim.png') ?>" id="logo">
            <a href="<?= base_url('/devocionales/dia/'.date('Y-m-d')) ?>">DEVOCIONALES</a>
        </div>

        <p id="texto-principal">
            <span id="deci">10</span><span id="ma">ma</span><span id="conferencia">  CONFERENCIA</span><br> JUVENIL DE LAS IGLESIAS EN MISIONES
        </p>

        <div class="item">
            <img src="<?= base_url('assets/images/ic_item_orador.png') ?>">
            Orador Nicolás Bruselario
        </div>

        <div class="item">
            <img src="<?= base_url('assets/images/ic_item_fechas.png') ?>">
            14, 21 y 28 de Agosto a las 20.30 Hs
        </div>

        <div class="item">
            <img src="<?= base_url('assets/images/ic_item_videollamada.png') ?>">
            Zoom App
        </div>
        
        <a id="registrate" href="<?= base_url('/registro') ?>">REGISTRATE</a>

    </section>

    <section class="info">
        <h3><b>¿Qué es UJIM?</b></h3>
        <p id="ujimDsc">Ujim es un proyecto que comenzó hace 10 años cuando un grupo de jóvenes de diferentes iglesias tuvieron el deseo de empezar a trabajar juntos. Así surgió la primera conferencia juvenil unida en la provincia de Misiones. El camino ha sido largo y aún queda mucho por caminar pero por la gracia y el amor de Dios estamos llegando a la 10ma conferencia trabajando codo a codo en la familia de Dios, y queremos que seas parte acompañando, orando, y quién sabe, capaz en un futuro trabajando con nosotros.</p>
        <br>
        <br>
        <h3><b>¿Cómo participo?</b></h3>

        <div class="pasos">
            <div class="paso">
                <img src="<?= base_url('assets/images/ic_registrate.png') ?>">
                <h4><b>Registrate!</b></h4>
                <p>Si todavía no te registraste podés hacerlo gratuitamente <a href="<?= base_url('/registro') ?>">desde acá!</a></p>
            </div>

            <div class="paso">
                <img src="<?= base_url('assets/images/ic_reuniones.png') ?>">
                <h4><b>Participá en las reuniones!</b></h4>
                <p>No tenés que salir de tu casa! Estamos utilizando la app Zoom.</p>
            </div>

            <div class="paso">
                <img src="<?= base_url('assets/images/ic_devocional.png') ?>">
                <h4><b>Devocional Diario</b></h4>
                <p>Todos los días tendremos un devocional donde vas a aprender más de la Palabra de Dios.</p>
            </div>

            <div class="paso">
                <div class="iconos">
                    <img id="imgInstagram" src="<?= base_url('assets/images/ic_instagram.png') ?>">
                    <img id="imgWhatsapp" src="<?= base_url('assets/images/ic_whatsapp.png') ?>">
                    <img id="imgFacebook" src="<?= base_url('assets/images/ic_facebook.png') ?>">
                </div>
                
                <h4><b>Mantenete alerta!</b></h4>
                <p>Una vez registrado te comunicaremos los accesos para las reuniones. Además, estaremos anunciando las novedades en nuestras redes. No te duermas y seguinos!</p>
            </div>
        </div>

        <div class="contacto">
            <img src="<?= base_url('assets/images/ic_whatsapp.png') ?>">
            <span>Tenés una duda o una consulta? Escribinos al <b><a href="https://wa.me/message/JTV7IO4V23T6G1">+54 3764653543</a></b></span>    
        </div>
        
    </section>
</div>