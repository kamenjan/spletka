<a class="btn btn-lg" href="<?= base_url('admin/season/edit') ?>"><span class="glyphicon glyphicon-plus"></span> Dodaj novo sezono</a>
<hr>

<?php
if (isset($seasons)) {
    echo '<div class="container-fluid">';
    foreach ($seasons as $row) {
        ?>
        <div class="row">
            <div class="col-xs-4">
                <a href="<?= base_url('admin/season/show_season/') . '/' ?><?= $row->id ?>"><?= substr(strip_tags($row->name), 0, 50) ?></a>
            </div>

            <div class="col-xs-8">
                <a class="btn glyphicon glyphicon-edit" href="<?= base_url('admin/season/edit/') . '/' . $row->id ?>"></a>
            </div>
        </div>
        <?php
    }
    echo '</div>';
}   
?>



