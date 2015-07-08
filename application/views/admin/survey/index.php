<?php //dump($this->_ci_cached_vars); ?>
<a class="btn btn-lg" href="<?= base_url('admin/survey/edit') ?>"><span class="glyphicon glyphicon-plus"></span> Dodaj novo anketo</a>
<hr>

<?php
if (isset($surveys)) {
    echo '<div class="container-fluid">';
    foreach ($surveys as $row) {
        ?>
        <div class="row">
            <div class="col-xs-3">
                <a href="<?= base_url() ?>admin/survey/show_survey/<?= $row->id ?>"><?= substr(strip_tags($row->question), 0, 20) . ' ...' ?></a>
            </div>

            <div class="col-xs-2">
                <?php echo date('d.m.y H:i', strtotime($row->date_created)); ?>
            </div>

            <div class="col-xs-2">   
                <?php
                switch ($row->status) {
                    case 'active':
                        echo '<span class="glyphicon glyphicon-pushpin"></span>';
                        break;
                    case 'ready':
                        echo '<a href="' . base_url('admin/survey/activate/') . '/' . $row->id .'"><span class="glyphicon glyphicon-time"></span></a>';
                        break;
                    case 'finished':
                        echo '<span class="glyphicon glyphicon-check"></span>';                        
                        break;
                }
                ?>
            </div>

            <div class="col-xs-2">              
            </div>

            <div class="col-xs-2">

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



