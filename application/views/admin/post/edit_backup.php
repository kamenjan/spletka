<?php echo validation_errors(); ?>
<?php echo form_open_multipart(); ?>
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
            <div><input type="radio" name="tag" value="article" <?php
                if ($post->tag == 'article') {
                    echo "checked";
                }
                ?> id="article"> Novica </div>
            <div><input type="radio" name="tag" value="report" <?php
                if ($post->tag == 'report') {
                    echo "checked";
                }
                ?> id="report"> Reportaža </div>
        </div>
    </div>
    <div class="row SS_padding-vertical" id="image">
        <div class="col-xs-2">
            Slika
        </div>
        <div class="col-xs-10">
            <?php echo form_upload('picture'); ?>
            <?php
            if (isset($errors['upload_errors'])) {
                echo $errors['upload_errors'];
            }
            ?>
        </div>
    </div>
    <div class="row SS_padding-vertical" id="gallery">
        <div class="col-xs-2">
            Album ID <span id="album_helper" class="glyphicon glyphicon-question-sign"></span>
        </div>
        <div class="col-xs-10">
            <input type="text" name="fl_link" class="form-control" value="<?= $post->fl_link ?>" >      
        </div>
    </div>
    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Datum dogodka
        </div>
        <div class="col-xs-10">
            <input type="text" name="date_event" value="<?= $post->date_event; ?>" class="datepicker" >
        </div>
    </div>
    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Besedilo
        </div>
        <div class="col-xs-10">
            <?php echo form_textarea('post', set_value('post', $post->post), 'class="tinymce"'); ?>
        </div>
    </div>
    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Facebook link
        </div>
        <div class="col-xs-10">
            <input type="text" name="fb_link" class="form-control" value="<?= $post->fb_link ?>" >
        </div>
    </div>
    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Twitter link
        </div>
        <div class="col-xs-10">
            <input type="text" name="tw_link" class="form-control" value="<?= $post->tw_link ?>" >
        </div>
    </div>
    <div class="row SS_padding-vertical">
        <div class="col-xs-2">

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

        $("#gallery").hide();

        $("#album_helper").click(function () {
            $("#dialog").dialog();
            $("#dialog").dialog("open");
        });

        $("#article").click(function () {
            $("#image").show();
            $("#gallery").hide();
        });

        $("#report").click(function () {
            $("#gallery").show();
            $("#image").hide();
        });
    });

</script>


