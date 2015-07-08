<?php //dump($this->_ci_cached_vars);  ?>
<div class="row">
    <div class="SS_post col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
        <h3><?= $season['season']->name ?></h3>
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
</div>