<?php
//dump($this->_ci_cached_vars);
?>
<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<div class="container-fluid">

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Vsebina
        </div>
        <div class="col-xs-10">
            <?=
            form_dropdown('tag', [
                'video' => 'video',
                'gallery' => 'foto album'
                    ], $media->tag, 'id="SS_media_selector"');
            ?>
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Naslov
        </div>
        <div class="col-xs-10">
            <input type="text" name="name" class="form-control" value="<?= $media->name ?>" >
        </div>
    </div>

    <div id="SS_flickr_link" class="row SS_padding-vertical">
        <div class="col-xs-2">
            Flickr album ID
        </div>
        <div class="col-xs-10">
            <input type="text" name="fl_link" class="form-control" value="<?= $media->link ?>" >
            <p>Primer - 72157653253290646 (https://www.flickr.com/photos/133458882@N07/sets/<b>72157653253290646</b>)</p>
        </div>
    </div>


    <div id="SS_youtube_link" class="row SS_padding-vertical">
        <div class="col-xs-2">
            Youtube video ID
        </div>
        <div class="col-xs-10">
            <input type="text" name="yt_link" class="form-control" value="<?= $media->link ?>" >
            <p>Primer - LMh5CF_P_wY (https://www.youtube.com/watch?v=<b>LMh5CF_P_wY</b>)</p>
        </div>
    </div> 



    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Sezona
        </div>
        <div class="col-xs-10">
            <div class="dropdown">
                <?php echo form_dropdown('seasonID', $seasons, $media->seasonID); ?>
            </div>
        </div>
    </div>


    <div class="row SS_padding-vertical">
        <div class="col-xs-2">

        </div>
        <div class="col-xs-10">
            <?php echo form_submit('submit', 'Shrani album', 'class="btn btn-primary"'); ?>
        </div>
    </div>
</div>
<?php echo form_close(); ?>



