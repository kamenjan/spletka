<?php $this->load->view('components/page_head'); ?>


<div class="data-container" data-controller="<?= $controller; ?>" data-base_url="<?= $base_url; ?>" data-answered_survey="<?= $answered_survey; ?>">
<?php
//dump($this->_ci_cached_vars);
//dump($this->session->userdata);
?>
</div>


<div class="container">
    <div class="row">           
        <div class="col-sm-12">
            <div id="header" class="SS_container">
                <img src="<?= base_url('assets/images/silaLogo1.gif') ?>" alt="Sila Logo" style="margin: 5px"> 
                <img src="<?= base_url('assets/images/silaLogo2.gif') ?>" alt="Sila Logo" align="right" style="margin: 5px"> 
            </div>
        </div>
    </div>

    <div  class="row">
        <div class="col-sm-12">
            <div id="navigation" class="SS_container">
                <span style="border-right: 1px dotted;"><a href="<?php echo base_url('home') ?>" class="btn glyphicon glyphicon-home"></a></span>
                <span><a href="<?php echo base_url('season') ?>" class="btn">SEZONA <?= $current_season ?></a></span>
                <span style="border-right: 1px dotted;"><a href="<?php echo base_url('archive') ?>" class="btn">ARHIV</a></span>
                <span><a href="<?php echo base_url('about') ?>" class="btn">O ŠILI</a></span>
                <span><a href="<?php echo base_url('people') ?>" class="btn">OSEBJE</a></span>
                <span><a href="<?php echo base_url('cooperation') ?>" class="btn">SODELUJTE Z NAMI</a></span>
                <span style="border-right: 1px dotted;"><a href="<?php echo base_url('contact') ?>" class="btn">KONTAKT</a></span>
                <span><a href="<?php echo base_url('improv') ?>" class="btn">O IMPROVIZACIJI</a></span>
                <span><a href="<?php echo base_url('international') ?>" class="btn">INTERNATIONAL</a></span>
            </div>
        </div>
    </div>

    <div class="row"> 

        <div id="SS_main_parent" class="col-lg-9 col-md-9 col-sm-8 col-xs-12"  style="padding-right: 0px; margin: 0;">
            <div id="main" class="SS_container"> 
                <div class="row"> 
                    <?php $this->load->view($subview); ?>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">             
            <div id="SS_sidebar" class="SS_container">
                <div class="row">
                    <?php $this->load->view('components/sidebar'); ?>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12">
            <div id="footer" class="SS_container">
                <p style="font-size: 10px; margin: 0px; padding: 0px; ">Stran gosti:</p>
                <img src="<?= base_url('assets/images/ljudmilaLogo.png') ?>" alt="Ljudmila Logo">
            </div>
        </div>
    </div>

</div>
<?php $this->load->view('components/page_tail'); ?>