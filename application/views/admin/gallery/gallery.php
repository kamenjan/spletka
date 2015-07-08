<?php
//dump($this->_ci_cached_vars);
if (isset($gallery->id)) {
    ?>
    <div id="gallery">
        <h4><?= $gallery->name ?></h4>

        <?php if (isset($gallery->flickr)) { ?>
        <div style="margin: auto; width: 400px;">
            <ul id="lightSlider" class="gallery list-unstyled cS-hidden">
                <?php foreach ($gallery->flickr['photoset']['photo'] as $photo) { ?>
                    <li data-thumb="https://farm<?= $photo['farm'] ?>.staticflickr.com/<?= $photo['server'] ?>/<?= $photo['id'] ?>_<?= $photo['secret'] ?>_t.jpg">
                        <img u="image" src="https://farm<?= $photo['farm'] ?>.staticflickr.com/<?= $photo['server'] ?>/<?= $photo['id'] ?>_<?= $photo['secret'] ?>.jpg" />
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>

    </div><?php } else { ?>
    <p>Album ne obstaja.</p>
<?php } ?>

    

