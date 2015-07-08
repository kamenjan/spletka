<?php $this->load->view('admin/components/page_head'); ?>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-sm-offset-4 SS_padding">
                <div class="SS_container">
                    <h3 class="text-center">Log in</h3>
                    <p class="text-center">Please login using your credentials</p>
                </div>
            </div>
        </div>
        <div  class="row">
            <div class="col-xs-12 col-sm-4 col-sm-offset-4 SS_padding">
                <div class="SS_container">
                    <?php echo validation_errors(); ?>
                    <?php echo form_open(); ?>
                    <div class="row">
                        <div class="col-xs-12 text-center">Email:</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-center"><?php echo form_input('email'); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-center">Password:</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-center"><?php echo form_password('password'); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-center"><?php echo form_submit('submit', 'Log in', 'class="btn btn-primary"'); ?></div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-sm-offset-4 SS_padding">
                <div class="SS_container">
                    <p class="text-right">Sila Spletka</p>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('admin/components/page_tail'); ?>

