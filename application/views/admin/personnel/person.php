<?php
if (isset($person)) {
    ?>
    <div>
        <h4><?= $person->name ?></h4>
        <img src="<?= base_url('assets/uploads/person_img/' . $person->picture) ?>" alt="Slika ekipe">
        <p><?= $person->body ?></p>
    </div><?php }
?>

