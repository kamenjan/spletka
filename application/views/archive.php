
<div class="row">
    <div class="SS_post col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
        <p>Arhiv</p>
        <?php 
        foreach ($seasons as $season) { ?>
        <h4><a href="<?= base_url('season/show_season/'. $season->id);?>"><?= $season->name?></a></h4>
        
        <?php } ?>
    </div>
</div>


