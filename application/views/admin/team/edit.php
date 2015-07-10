<?php //dump($this->_ci_cached_vars);?>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart(); ?>
<div class="container-fluid">

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Ime ekipe
        </div>
        <div class="col-xs-10">
            <input type="text" name="name" class="form-control" value="<?= $team->name ?>" >
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Šola
        </div>
        <div class="col-xs-10">
            <input type="text" name="school" class="form-control" value="<?= $team->school ?>" >
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Opis
        </div>
        <div class="col-xs-10">
            <?php echo form_textarea('description', set_value('description', $team->description), 'class="tinymce"'); ?>
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Slika
        </div>
        <div class="col-xs-10">
            <?php
            //TODO potreben totalen slogovni masaker
            if (isset($team->id)) { ?>
                <img src="<?= base_url('assets/uploads/team_img/'.$team->picture)?>" alt="Slika ekipe"><br />
            <?php }
            ?>
            
            
            <?php echo 'Uporabi drugo: ' . form_upload('picture'); ?>
            <?php
            if (isset($errors['upload_errors'])) {
                echo $errors['upload_errors'];
            }
            ?>


            <input type="checkbox" name="default_picture">
            <span>Nimamo slike ekipe, uporabi privzeto sliko</span>

        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
        </div>
        <div class="col-xs-10">
            <?php echo form_submit('submit', 'Shrani ekipo', 'class="btn btn-primary"'); ?>
        </div>
    </div>

</div>

<?php echo form_close(); ?>