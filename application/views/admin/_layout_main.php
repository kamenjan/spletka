<?php $this->load->view('admin/components/page_head'); ?>

<?php
//dump($this->_ci_cached_vars);
//dump($this->session->userdata);
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="header" class="SS_container">
                    <img src="<?= base_url('assets/images/silaLogo1.gif') ?>" alt="Sila Logo"> 
                    <img src="<?= base_url('assets/images/silaLogo2.gif') ?>" alt="Sila Logo" align="right"> 
                </div>
            </div>
        </div>

        <div  class="row">
            <div class="col-xs-12">
                <div id="navigation" class="SS_container">
                    <a href="<?php echo base_url('admin/dashboard') ?>" class="btn">aktualno</a>
                    <a href="<?php echo base_url('admin/post') ?>" class="btn">objave</a>
                    <a href="<?php echo base_url('admin/team') ?>" class="btn">ekipe</a>
                    <a href="<?php echo base_url('admin/season') ?>" class="btn">sezone</a>
                    <a href="<?php echo base_url('admin/personnel') ?>" class="btn">osebje</a>
                    <a href="<?php echo base_url('admin/survey') ?>" class="btn">ankete</a>
                    <a class="btn pull-right" href="<?= base_url('admin/user/logout') ?>"><span class="glyphicon glyphicon-off"></span> odjava</a>
                    <a class="btn pull-right" href="<?= base_url('admin/user/profile') ?>"><span class="glyphicon glyphicon-user"></span><?= ' ' . $this->session->userdata('name') ?></a>
                </div>
            </div>
        </div>

        <div  class="row">
            <div id="SS_main_parent" class="col-xs-12"  style="padding-right: 0px; margin: 0;">
                <div id="main" class="SS_container"> 
                    <div class="row"> 
                        <?php $this->load->view($subview); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <?php $this->load->view('admin/components/page_tail'); ?>