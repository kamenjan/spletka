<?php
//dump($this->_ci_cached_vars);
if (isset($post->id)) {
    ?>
    <div id="post">
        <h4><?= $post->title ?></h4>

        <p>Objavil/a: <?= $post->date_created ?> | <?= $post->author ?></p>

        <?php if (isset($post->flickr)) { ?>
        <div style="margin: auto; width: 400px;">
            <ul id="lightSlider" class="gallery list-unstyled cS-hidden">
                <?php foreach ($post->flickr['photoset']['photo'] as $photo) { ?>
                    <li data-thumb="https://farm<?= $photo['farm'] ?>.staticflickr.com/<?= $photo['server'] ?>/<?= $photo['id'] ?>_<?= $photo['secret'] ?>_t.jpg">
                        <img u="image" src="https://farm<?= $photo['farm'] ?>.staticflickr.com/<?= $photo['server'] ?>/<?= $photo['id'] ?>_<?= $photo['secret'] ?>.jpg" />
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>

        <p><?= $post->body ?></p>

    </div><?php } else { ?>
    <p>Objava ne obstaja.</p>
<?php } ?>

    

