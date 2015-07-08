<?php
// Create $added_teams array for chosen multipicker values when editing existing post,
if (isset($teamIDs)) {
    foreach ($teamIDs as $added_team_id) {
        foreach ($teams as $id => $team_name) {
            if ($added_team_id == $id) {
                $added_teams[$id] = $team_name;
            }
        }
    }
    // and remove same values from $teams array sent from controller.
    $teams = array_diff($teams, $added_teams);
}
?>

<?php
//dump($this->_ci_cached_vars);
?>

<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<div class="container-fluid">

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Sezona
        </div>
        <div class="col-xs-10">
                <?= $season->name; ?>
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Opis
        </div>
        <div class="col-xs-10">
            <?php echo form_textarea('body', $season->body, 'class="tinymce"'); ?>
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Ekipe
        </div>
        <div class="col-xs-10">
            <!--TODO remove styling from tag to css !!-->
            <div class="col-xs-5" style="padding: 0px;">
                <select name="from[]" id="multiselect" class="form-control" size="8" multiple="multiple" data-right-all="#right_All_1">
                    <?php
                    foreach ($teams as $id => $team_name) {
                        echo '<option value="' . $id . '">' . $team_name . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-xs-2">
                <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
            </div>
            <!--TODO remove styling from tag to css !!-->
            <div class="col-xs-5" style="padding: 0px;">
                <select name="teams[]" id="multiselect_to" class="form-control" size="8" multiple="multiple">
                    <?php
                    foreach ($added_teams as $id => $team) {
                        echo '<option value="' . $id . '">' . $team . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">
            Stopnicke
        </div>
        <div class="col-xs-10">
            <select name="1st" style="width: 180px">
                <option value="<?= $season->first; ?>"><?php if($season->first!=''){echo $added_teams[$season->first];} ?></option>
            </select>

            <select name="2nd" style="width: 180px">
                <option value="<?= $season->second; ?>"><?php if($season->second!=''){echo $added_teams[$season->second];} ?></option>
            </select>

            <select name="3rd" style="width: 180px">
                <option value="<?= $season->third; ?>"><?php if($season->third!=''){echo $added_teams[$season->third];} ?></option>
            </select>
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-2">

        </div>
        <div class="col-xs-10">
            <?php echo form_submit('submit', 'Shrani sezono', 'class="btn btn-primary"'); ?>
        </div>
    </div>
</div>
<?php echo form_close(); ?>


