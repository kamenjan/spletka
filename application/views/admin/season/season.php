<?php
//TODO improve feedback on request failiure
if (!isset($season['season']->id)) {
    echo 'Sezona ne obstaja';
    sleep(5);
    redirect('admin/season');
}
?>
<div id="season">
    <h3><?= $season['season']->name ?></h3>
    <p><?= $season['season']->body ?></p>
    <hr>
    <?php if (isset($season['teams'])){ 
        foreach ($season['teams'] as $team) { ?>
        <h4><?= $team->name ?></h4>
        <p><?= $team->description ?></p>
        <p><?= $team->school ?></p>
        <hr>
    <?php } }?>
</div>




