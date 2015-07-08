<?php //dump($this->_ci_cached_vars); ?>

<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<div class="container-fluid">
    <div class="row SS_padding-vertical">
        <div class="col-xs-3">
            Uporabnisko ime
        </div>
        <div class="col-xs-9">
            <input type="text" name="name" class="form-control" value="<?= $user->name ?>" >
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-3">
            Email
        </div>
        <div class="col-xs-9">
            <input type="text" name="email" class="form-control" value="<?= $user->email ?>" >
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-3">
            Geslo
        </div>
        <div class="col-xs-9">
            <input type="password" name="password" class="form-control" value="" >
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-3">
            Ponovi geslo
        </div>
        <div class="col-xs-9">
            <input type="password" name="password_confirm" class="form-control" value="" >
        </div>
    </div>


    <div class="row SS_padding-vertical">
        <div class="col-xs-3">

        </div>
        <div class="col-xs-9">
            <?php echo form_submit('submit', 'Shrani spremembe', 'class="btn btn-primary"'); ?>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

