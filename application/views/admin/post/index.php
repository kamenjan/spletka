<?php //dump($this->_ci_cached_vars); ?>
<a class="btn btn-lg" href="<?= base_url('admin/post/edit') ?>"><span class="glyphicon glyphicon-plus"></span> Dodaj novo objavo</a>
<hr>

<?php
if (isset($posts)) {
    echo '<div class="container-fluid">';
    foreach ($posts as $row) {
        ?>
        <div class="row">
            <div class="col-xs-3">
                <?php
                if ($row->approved == 'true') {
                    $color = 'green';
                    $glyphicon = 'glyphicon glyphicon-ok';
                } else {
                    $color = 'orange';
                    $glyphicon = 'glyphicon glyphicon-question-sign';
                }
                ?>
                <span class="<?= $glyphicon ?>" style="color: <?= $color ?>"></span>
                <a href="<?= base_url() ?>admin/post/show_post/<?= $row->id ?>"><?= substr(strip_tags($row->title), 0, 20).' ...' ?></a>
            </div>
            <div class="col-xs-2">
                <?php echo date('d.m.y H:i', strtotime($row->date_created)); ?>
            </div>
            <div class="col-xs-2">
                <?= translate($row->tag); ?>
            </div>
            <div class="col-xs-2">
                <?= $row->author ?>
            </div>
            <div class="col-xs-2">
                <?php if (($row->approved != 'true' && $row->author == $this->session->userdata('name')) || $this->session->userdata('type') == 'admin') { ?>
                    <a class="glyphicon glyphicon-edit" href="<?= base_url('admin/post/edit/') . '/' . $row->id ?>"></a>
                <?php }
                ?>

                <?php
                // If $account_type (passed to view from Admin_Controller) == admin, show delete buttons
                if ($this->session->userdata('type') == 'admin') {
                    ?>
                    <a class = "glyphicon glyphicon-trash" 
                       href = "#" 
                       data-target="#deleteModal" 
                       data-toggle = "modal" 
                       data-controller="<?= $controller ?>" 
                       data-id="<?= $row->id ?>" 
                       ></a>
                   <?php }
                   ?>
            </div>
        </div>
        <?php
    }
    echo '</div>';
}
?>



