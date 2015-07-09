<?php
if ($account_type == 'admin') {
    ?>
    <a class="btn btn-lg" href="<?= base_url('admin/personnel/edit') ?>"><span class="glyphicon glyphicon-plus"></span> Dodaj novo osebo</a>
    <hr>
<?php }
?>

<?php
if (isset($personnel)) {
    echo '<div class="container-fluid">';
    foreach ($personnel as $row) {
        ?>
        <div class="row">
            <div class="col-xs-3">
                <a href="<?= base_url() ?>admin/personnel/show_person/<?= $row->id ?>"><?= substr(strip_tags($row->name), 0, 20) . ' ...' ?></a>
            </div>
            <div class="col-xs-2">
            </div>
            <div class="col-xs-2">
            </div>
            <div class="col-xs-2">
            </div>
            <div class="col-xs-2">
                <?php if ($this->session->userdata('type') == 'admin') { ?>
                    <a class="glyphicon glyphicon-edit" href="<?= base_url('admin/personnel/edit/') . '/' . $row->id ?>"></a>
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



