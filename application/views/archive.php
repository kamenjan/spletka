<div class="SS_post col-lg-11 col-md-11 col-sm-11 col-xs-11">
    <h1>Arhiv</h1>
    <?php 
    foreach ($seasons as $season) { ?>
    <h4><a href="<?= base_url('season/show_season/'. $season->id);?>"><?= $season->name?></a></h4>
    
    <?php } ?>
</div>


