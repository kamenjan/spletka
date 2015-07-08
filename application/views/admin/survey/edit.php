<?php echo validation_errors(); ?>
<?php //dump($this->_ci_cached_vars);       ?>
<?php echo form_open(); ?>
<div class="container-fluid">
    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Vprasanje          
        </div>
        <div class="col-xs-10">
            <input type="text" name="question" class="form-control" value="<?= $survey->question ?>" >
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Odgovori          
        </div>
        <div class="col-xs-10">
            <input type="text" name="answer1" class="form-control" value="" >
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">

        </div>
        <div class="col-xs-10">
            <input type="text" name="answer2" class="form-control" value="" >
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">

        </div>
        <div class="col-xs-10">
            <input type="text" name="answer3" class="form-control" value="" >
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">

        </div>
        <div class="col-xs-10">
            <input type="text" name="answer4" class="form-control" value="" >
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">

        </div>
        <div class="col-xs-10">
            <input type="text" name="answer5" class="form-control" value="" >
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">

        </div>
        <div class="col-xs-10">
            <input type="text" name="answer6" class="form-control" value="" >
        </div>
    </div>


    <div class="row SS_padding-vertical">
        <div class="col-xs-10">
            <?php echo form_submit('submit', 'Shrani anketo', 'class="btn btn-primary"'); ?>
        </div>
    </div>
</div>
<?php echo form_close(); ?>




