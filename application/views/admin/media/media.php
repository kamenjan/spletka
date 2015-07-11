<?php
//dump($this->_ci_cached_vars);
if (isset($media->id)) {
    ?>
    <div id="media">
        <h4><?= $media->name ?></h4>

        <?php
        switch ($media->tag) {
            case 'gallery':
                ?>
                <div style="margin: auto; width: 400px;">
                    <ul id="lightSlider" class="gallery list-unstyled cS-hidden">
                        <?php foreach ($media->flickr['photoset']['photo'] as $photo) { ?>
                            <li data-thumb="https://farm<?= $photo['farm'] ?>.staticflickr.com/<?= $photo['server'] ?>/<?= $photo['id'] ?>_<?= $photo['secret'] ?>_t.jpg">
                                <img u="image" src="https://farm<?= $photo['farm'] ?>.staticflickr.com/<?= $photo['server'] ?>/<?= $photo['id'] ?>_<?= $photo['secret'] ?>.jpg" />
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php
                break;

            case 'video':
        }
        ?>
    </div><?php } else { ?>
    <p>Vsebina ne obstaja.</p>
<?php } ?>



