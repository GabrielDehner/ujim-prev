<div id="main">
    <img src="<?= base_url('assets/images/resized/ujim.png') ?>" id="logo">
    <br>
    <br>
    <br>
    <div class="form-group">
        <?php foreach ($devocional as $key =>$dev) {
        ?>
        <div class="row form-group">
            <div class="col-2"></div>
            <div class="col-8 card diaDevocional"  <? echo 'id="'.$key.'" '.'data-value="'. $dev->diaPublicacion.'"' ?> style="cursor: pointer;">
                <div class="card-header">
                    <h5>DEVOCIONAL #<?= $dev->idDevocional?></h5>    
                </div>
                <div class="card-body">
                    <span><?= $dev->diaPublicacion ?></span>
                </div>
            </div>
        </div>
        <?php 
        } ?>
    </div>
</div>