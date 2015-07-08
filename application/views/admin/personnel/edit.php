<?php echo validation_errors(); ?>
<?php echo form_open_multipart(); ?>
<div class="container-fluid">
    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Ime          
        </div>
        <div class="col-xs-10">
            <input type="text" name="name" class="form-control" value="<?= $person->name ?>" >  
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Opis
        </div>
        <div class="col-xs-10">
            <?php echo form_textarea('body', set_value('body', $person->body), 'class="tinymce"'); ?>
        </div>
    </div>

    <div class="row SS_padding-vertical" id="image">
        <div class="col-xs-2">
            Slika
        </div>
        <div class="col-xs-3">
            <?php echo form_upload('picture'); ?>
            <?php
            if (isset($errors['upload_errors'])) {
                echo $errors['upload_errors'];
            }
            ?>
        </div>
        <div class="col-xs-7">
            <input type="checkbox" name="default_picture">
            <span>Oseba je zelo nefotogenična, uporabi privzeto sliko</span>
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-4">

        </div>
        <div class="col-xs-10">
            <?php echo form_submit('submit', 'Shrani osebo', 'class="btn btn-primary"'); ?>
            <?php if (isset($post->id) && $account_type == 'admin') { ?>
                <a class="btn btn-primary" href="<?= base_url('admin/post/approve/') . '/' . $post->id ?>">Pozegnaj</a>
            <?php }
            ?>
        </div>
    </div>
</div>
<?php echo form_close(); ?>



