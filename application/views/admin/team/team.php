<?php 

if (isset($team)) {
    ?>
    <div>

        <h4><?= $team->name ?></h4>
        <img src="<?= base_url('assets/uploads/team_img/'.$team->picture)?>" alt="Slika ekipe">
        <p><?= $team->school ?></p>
        <p><?= $team->description ?></p>
        <p>Dodano: <?= $team->date_created ?></p>
    </div><?php }
?>

