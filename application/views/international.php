<div class="SS_post col-xs-11">
    <h1>International cooperation</h1>
    <p>opis, pretkli dogodki in dogovori, vse v anglescini</p>
</div>


<?php foreach ($posts as $post) { ?>
    <div class="SS_post col-lg-11 col-md-11 col-sm-11 col-xs-11">
        <h3><a href="<?= base_url() ?>post/show_post/<?= $post->id ?>"><?= $post->title ?></a></h3>
        <div class="post-info"><p><?= $post->author . ' | ' . date('d.m.y H:i', strtotime($post->date_created)) . ' | ' . translate($post->tag); ?></p></div>
        <?= substr($post->body, 0, strpos($post->body, "</p>") + 4); ?>
        <a href="<?= base_url() ?>post/show_post/<?= $post->id ?>"><span class="glyphicon glyphicon-file"></span> Preberi več</a>
    </div>
    <?php
}
?>
