<a class="btn btn-lg" href="<?= base_url('admin/media/edit') ?>"><span class="glyphicon glyphicon-plus"></span> Dodaj novo vsebino</a>
<hr>

<?php
if (isset($galleries)) {
    echo '<div class="container-fluid">';
    foreach ($galleries as $row) {
        ?>
        <div class="row">
            <div class="col-xs-4">
                <a href="<?= base_url() ?>admin/gallery/show_gallery/<?= $row->id ?>"><?= substr(strip_tags($row->name), 0, 50) ?></a>
            </div>
            <div class="col-xs-3">
                <?php echo date('d.m.y', strtotime($row->date)); ?>
            </div>
            <div class="col-xs-2">
                <?= $row->season_name ?>
            </div>
            <div class="col-xs-2">
                <?php if ($this->session->userdata('type') == 'admin') { ?>
                    <a class="btn glyphicon glyphicon-edit" href="<?= base_url('admin/gallery/edit/') . '/' . $row->id ?>"></a>
                <?php }
                ?>

                <?php
                // If $account_type (passed to view from Admin_Controller) == admin, show delete buttons
                if ($this->session->userdata('type') == 'admin') {
                    ?>
                    <a class = "btn glyphicon glyphicon-trash" 
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



