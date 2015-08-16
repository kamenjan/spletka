<?php //dump($this->_ci_cached_vars);  ?>
<div class="SS_post col-lg-11 col-md-11 col-sm-11 col-xs-11">
    <h1><?= $season['season']->name ?></h1>
    <p><?= $season['season']->body ?></p>
    <hr>
    <?php
    if (isset($season['teams'])) {
        foreach ($season['teams'] as $team) {
            ?>
            <h4><?= $team->name ?></h4>
            <p><?= $team->description ?></p>
            <p><?= $team->school ?></p>
            <hr>
        <?php }
    }
    ?>
</div>
