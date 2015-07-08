<?php
//dump($this->_ci_cached_vars);
?>
<div class="row SS_padding-vertical">
    <div class="col-xs-3">
        Uporabnik
    </div>

    <div class="col-xs-9">
        <?= $profile['user_name'] ?>
    </div>
</div>

<div class="row SS_padding-vertical">
    <div class="col-xs-3">
        Email
    </div>

    <div class="col-xs-9">
        <?= $profile['user_email'] ?>
    </div>
</div>

<div class="row SS_padding-vertical">
    <div class="col-xs-12">
        <a href="<?= base_url('admin/user/edit') ?>">Spremeni nastavitve racuna</a>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-xs-3">
        Objave
    </div>

    <div class="col-xs-9">
        <?php foreach ($profile['posts'] as $post) { ?>
            <div class="row">
                <div class="col-xs-3">
                    <a href="<?= base_url('admin/post/show_post/' . $post->id) ?>"><?= $post->title ?></a>
                </div>
                <div class="col-xs-3">
                    <?php
                    if ($post->tag == 'article') {
                        echo 'Novica';
                    } else {
                        echo 'Reportaža';
                    }
                    ?>
                </div>
                <div class="col-xs-3">
                    <?php echo date('d.m.y H:i', strtotime($post->date_created)); ?>
                </div>
                <div class="col-xs-3">
                    <a class="glyphicon glyphicon-edit" href="<?= base_url('admin/post/edit/' . $post->id) ?>"></a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>