<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
    <?php //dump($this->_ci_cached_vars); ?>


    <h4>Prikazujem: <?= date('d.m.y', strtotime($date))?></h4>
    <?php foreach ($posts as $post) { ?>
        <div class="SS_post col-xs-12">

            <h3><a href="<?= base_url() ?>post/show_post/<?= $post->id ?>"><?= $post->title ?></a></h3>
            <span><?= $post->author . ' | ' . date('d.m.y H:i', strtotime($post->date_created)) . ' | ' . translate($post->tag); ?></span>

            <?php if ($post->yt_link != '') { ?>
                <span class="glyphicon glyphicon-film"></span>
            <?php } ?>
            <?php if ($post->fl_link != '') { ?>
                <span class="glyphicon glyphicon-camera"></span>
            <?php } ?>
            <?= substr($post->body, 0, strpos($post->body, "</p>") + 4); ?>
            <a href="<?= base_url() ?>post/show_post/<?= $post->id ?>"><span class="glyphicon glyphicon-file"></span> Preberi več</a>
        </div>
        <?php
    }
    ?>
</div>