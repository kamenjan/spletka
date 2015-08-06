<?php
//dump($this->_ci_cached_vars);  
?>

<h1 style="margin: 2% 4% 0; padding: 0px 8px;">O improvizaciji</h1>

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


