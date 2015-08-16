<?php //dump($this->_ci_cached_vars);  ?>

<div class="container-fluid">
        <div class="col-md-12">
            <h1>Osebje</h1>
        </div>
        <?php foreach ($personnel as $person) { ?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">            
            <img src="<?= base_url('assets/uploads/person_img/' . $person->picture) ?>"  class="people-photo" alt="Slika osebe">
            <p style="text-align: center;"><?= $person->name?></p>
        </div>
        <?php }
        ?>
</div>

