<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<div class="container-fluid">
    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Naslov          
        </div>
        <div class="col-xs-10">
            <input type="text" name="title" class="form-control" value="<?= $post->title ?>" >
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Tip objave
        </div>
        <div class="col-xs-10">
            <div class="dropdown">
                <?=
                form_dropdown('tag', [
                    'news' => 'novica',
                    'report' => 'reportaža',
                    'article' => 'članek',
                    'international' => 'international',
                    'announcement' => 'obesvtilo'
                        ], $post->tag);
                ?>
            </div>
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Besedilo
        </div>
        <div class="col-xs-10">
            <?php echo form_textarea('body', set_value('body', $post->body), 'class="tinymce"'); ?>
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Datum dogodka
        </div>
        <div class="col-xs-10">
            <?php if ($post->date_event == null) { ?>
                <input type="text" name="date_event" class="datepicker" >
            <?php } else { ?>
                <input type="text" name="date_event" value="<?= $post->date_event; ?>" class="datepicker" >
            <?php }  ?>
            
            
        </div>
    </div>

    <div class="row SS_padding-vertical" id="gallery">
        <div class="col-xs-2">
            Flickr album ID
        </div>
        <div class="col-xs-4">
            <input type="text" name="fl_link" class="form-control" value="<?= $post->fl_link ?>" >      
        </div>
    </div>

    <div class="row SS_padding-vertical" id="gallery">
        <div class="col-xs-2">
            YouTube video ID
        </div>
        <div class="col-xs-4">
            <input type="text" name="yt_link" class="form-control" value="<?= $post->yt_link ?>" >      
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Facebook link
        </div>
        <div class="col-xs-4">
            <input type="text" name="fb_link" class="form-control" value="<?= $post->fb_link ?>" >
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-4">

        </div>
        <div class="col-xs-10">
            <?php echo form_submit('submit', 'Shrani objavo', 'class="btn btn-primary"'); ?>
            <?php if (isset($post->id) && $account_type == 'admin') { ?>
                <a class="btn btn-primary" href="<?= base_url('admin/post/approve/') . '/' . $post->id ?>">Pozegnaj</a>
            <?php }
            ?>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    jQuery(document).ready(function () {

        //$("#gallery").hide();
        //$("#image").hide();

        //$("#album_helper").click(function () {
        //    $("#dialog").dialog();
        //  $("#dialog").dialog("open");
        //});

        // $("#article").click(function () {
        //    $("#image").show();
        //    $("#gallery").hide();
        //});

        //$("#report").click(function () {
        //  $("#gallery").show();
        //   $("#image").hide();
        // });
    });

</script>


