<?php
//dump($this->_ci_cached_vars);
?>

<div class="container-fluid">
    <div class="row SS_padding-vertical">
        <div class="col-xs-12">
            Nepotrjene objave
        </div>
    </div>
    <div class="row SS_padding-vertical">
        <div class="col-xs-10 col-xs-offset-1 SS_border">
            <?php foreach ($posts as $post) { ?>
                <div class="row SS_padding-vertical">
                    <div class="col-xs-4">
                        <a href="<?= base_url('admin/post/show_post/') . '/' . $post->id ?>"><?= $post->title ?></a>
                    </div>
                    <div class="col-xs-3">
                        <?php echo date('d.m.y H:i', strtotime($post->date_created)); ?>
                    </div>
                    <div class="col-xs-4">
                        <?= $post->author ?>
                    </div>
                    <div class="col-xs-1">
                        <a class="glyphicon glyphicon-edit" href="<?= base_url('admin/post/edit/') . '/' . $post->id ?>"></a>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-3">
            Deska
        </div>
        <div class="col-xs-9">
        </div>
    </div>

    <div class="row SS_padding-vertical">
        <?php foreach ($comments as $comment) { ?>
            <div class="col-xs-12 SS_comment">
                <div class="row SS_padding-vertical">
                    <div class="col-xs-12">
                        <span><?= date('d.m.y H:i', strtotime($comment->date_created)) . ' | ' . $comment->author; ?></span> 
                    </div>
                </div>
                <div class="row SS_padding-vertical">
                    <div class="col-xs-11 col-xs-offset-1">
                        <?= $comment->body ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="row SS_padding-vertical">
        <div class="col-xs-12">
            <button id="comment" class="btn btn-primary btn-xs">Podaj izjavo</button>
        </div>
    </div>   

    <div id="comment_textarea">
        <?php echo form_open(); ?>
        <div class="row SS_padding-vertical">
            <div class="col-xs-12">
                <?php echo form_textarea('body', set_value(''), 'class="tinymce"'); ?>
            </div>
        </div>
        <div class="row SS_padding-vertical">
            <div class="col-xs-12">
                <?php echo form_submit('submit', 'Prilepi', 'class="btn btn-primary"'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>


</div>


