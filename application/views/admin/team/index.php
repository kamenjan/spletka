<?php
if ($account_type == 'admin') {
    ?>
    <a class="btn btn-lg" href="<?= base_url('admin/team/edit') ?>"><span class="glyphicon glyphicon-plus"></span> Dodaj novo ekipo</a>
    <hr>
<?php }
?>

<?php
if (isset($teams)) {
    echo '<div class="container-fluid">';
    foreach ($teams as $row) {
        ?>
        <div class="row">
            <div class="col-xs-3">
                <a href="<?= base_url() ?>admin/team/show_team/<?= $row->id ?>"><?= substr(strip_tags($row->name), 0, 50) ?></a>
            </div>
            <div class="col-xs-3">
                <?php echo date('d.m.y H:i', strtotime($row->date_created)); ?>
            </div>
            <div class="col-xs-4">
                <?= $row->school ?>
            </div>
            <div class="col-xs-2">               
                <?php
                if ($account_type == 'admin') {
                    ?>
                    <a class="btn glyphicon glyphicon-edit" href="<?= base_url('admin/team/edit/') . '/' . $row->id ?>"></a>
                    <a class = "btn glyphicon glyphicon-trash" href = "#" data-toggle = "modal" data-id = "<?= $row->id ?>" data-controller="<?= $controller ?>" data-target = "#deleteModal"></a>
                <?php }
                ?>
            </div>
        </div>
        <?php
    }
    echo '</div>';
}
?>

