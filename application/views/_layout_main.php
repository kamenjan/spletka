<?php $this->load->view('components/page_head'); ?>

<!-- 
    Div without style for holding data passed to view from controller.
    This data is used by JS and assigned global in custom.js
-->
<div class="data-container" 
     data-controller="<?= $controller; ?>" 
     data-base_url="<?= $base_url; ?>" 
     data-answered_survey="<?= $answered_survey; ?>">
    <?php
        //dump($this->_ci_cached_vars);
        //dump($this->session->userdata);
    
    ?>
</div>

<div class="container">
    <div class="row">           
        <div class="col-xs-12">
            <div id="header" class="SS_container">
                <img src="<?= base_url('assets/images/silaLogo1.gif') ?>" alt="Sila Logo" style="margin: 5px"> 
                <img src="<?= base_url('assets/images/silaLogo2.gif') ?>" alt="Sila Logo" align="right" style="margin: 5px"> 
            </div>
        </div>
    </div>

    <div  class="row">
        <div class="col-xs-12">
            <nav id="navigation" class="SS_container">
                <a href="#" id="nav-pull"><span class="glyphicon glyphicon-menu-hamburger" style="margin-right:6px"></span>Meni</a>
                <ul>
                    <li>
                        <a href="<?php echo base_url('home') ?>" class="btn">ZADNJE OBJAVE</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('season') ?>" class="btn">SEZONA <?= $current_season ?></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('archive') ?>" class="btn">ARHIV</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('about') ?>" class="btn">O ŠILI</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('people') ?>" class="btn">OSEBJE</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('cooperation') ?>" class="btn">SODELUJTE Z NAMI</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('contact') ?>" class="btn">KONTAKT</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('improv') ?>" class="btn">O IMPROVIZACIJI</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('international') ?>" class="btn">INTERNATIONAL</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="row"> 

        <div id="SS_main_parent" class="col-md-9 col-sm-8 col-xs-12"  style="padding-right: 0px; margin: 0;">
            <div id="main" class="SS_container"> 
                <div class="row"> 
                    <?php $this->load->view($subview); ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4 col-xs-12">             
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