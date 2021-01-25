<?php date_default_timezone_set('America/Buenos_Aires');?>
<div id="main">
    <img src="<?= base_url('assets/images/resized/ujim.png') ?>" id="logo">
    
    <div class="paginas">
        <?php if ($dev->idDevocional > 1) { 
            $fechaPrev = date('Y-m-d', strtotime($fecha . ' -1 day'));
        ?>
            <a id="prev" href="<?= base_url('/devocionales/dia/'.$fechaPrev) ?>"><</a>    
        <?php } ?>
        
        <?php if ($dev->idDevocional < $count && $fecha < date('Y-m-d')) {
            $fechaNext = date('Y-m-d', strtotime($fecha . ' +1 day'));
        ?>
            <a id="next" href="<?= base_url('/devocionales/dia/'.$fechaNext) ?>">></a>    
        <?php } ?>
    </div>
    <div class="devocional">
        <span class="devocional__id">DEVOCIONAL #<?= $dev->idDevocional ?></span>
        <span class="devocional__fecha"><?= $dev->diaPublicacion ?></span>

        <h2 class="devocional__titulo"><?= $dev->titulo ?></h2>
        <h3 class="devocional__subtitulo"><i><?= $dev->subtitulo ?></i></h3>

        <div class="devocional__cuerpo"><?= $dev->cuerpo ?></div>

        <!--<div class="social-bar">
            <a href="https://www.facebook.com/UJIM2018/">
                <img src="<?= base_url('assets/images/ic_facebook.png') ?>">
            </a>
            <a href="https://www.instagram.com/ujim20/">
                <img src="<?= base_url('assets/images/ic_instagram.png') ?>">
            </a>
            <a href="https://wa.me/message/JTV7IO4V23T6G1">
                <img src="<?= base_url('assets/images/ic_whatsapp.png') ?>">
            </a>
        </div> -->
    </div>

    <!-- <a id="ir_devocionales" href="<?= base_url('/devocionales') ?>">VER DEVOCIONALES</a> -->
</div>