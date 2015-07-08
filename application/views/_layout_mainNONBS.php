<!DOCTYPE html>

<html>
    <head>
        <title><?php echo $site_name ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style1.css"); ?>">

        <!--JQuery-->
        <script src="http://code.jquery.com/jquery.js"></script>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <!-- Datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <!--LightSlider-->
        <link href="<?php echo base_url('assets/lightslider') ?>/src/css/lightslider.css" media="screen" rel="stylesheet">
        <script src="<?php echo base_url('assets/lightslider') ?>/src/js/lightslider.js"></script>

        <!--Sticky-->
        <script src="<?php echo base_url('assets/sticky/jquery.sticky.js') ?>"></script>
    </head>

    <body>
        <div id="container">
            <div id="header" class="SS_container">
                <img id="logoRight" src="<?= base_url('assets/images/silaLogo1.gif') ?>" alt="logo1">
                <img id="logoLeft" src="<?= base_url('assets/images/silaLogo2.gif') ?>" alt="logo1">
            </div>

            <div id="navigation" class="SS_container">
                <span style="border-right: 1px dotted;"><a href="<?php echo base_url('home') ?>" class="btn glyphicon glyphicon-home"></a></span>
                <span><a href="<?php echo base_url('season') ?>" class="btn">tekoca sezona</a></span>
                <span style="border-right: 1px dotted;"><a href="<?php echo base_url('archive') ?>" class="btn">arhiv</a></span>
                <span><a href="<?php echo base_url('about') ?>" class="btn">o sili</a></span>
                <span><a href="<?php echo base_url('people') ?>" class="btn">osebje</a></span>
                <span><a href="<?php echo base_url('cooperation') ?>" class="btn">sodelujte z nami</a></span>
                <span style="border-right: 1px dotted;"><a href="<?php echo base_url('contact') ?>" class="btn">kontakt</a></span>
                <span><a href="<?php echo base_url('improv') ?>" class="btn">o improvizaciji</a></span>
                <span><a href="<?php echo base_url('international') ?>" class="btn">international</a></span>              
            </div>

            <div id="sidebar" class="SS_container">
                <div id="sidebar_inner">


                    <div id="calendar" style="font-size: 13px !important;"></div>


                    <div style="text-align: center;">
                        <span>
                            <img src="<?= base_url('assets/images/facebook_logo1.png') ?>" alt="Facebook Logo" style="margin: 5px">
                            <img src="<?= base_url('assets/images/flickr_logo.png') ?>" alt="Facebook Logo" style="margin: 5px">
                            <img src="<?= base_url('assets/images/twitter_logo.png') ?>" alt="Facebook Logo" style="margin: 5px">
                        </span>
                    </div> 


                    <div align="center" style="font-size: 120%;">Zadnje objave:</div>
                    <?php foreach ($latest as $post) { ?>
                        <a href="<?= base_url() ?>post/show_post/<?= $post->id ?>" style="font-size: 110%;"><?= $post->title ?></a>
                        <div style="font-size: 90%;"><?= date('d.m.y', strtotime($post->date_created)) . ' | ' . translate($post->tag); ?></div>
                    <?php } ?>
                </div>
            </div>

            <div id="main" class="SS_container">
                <?php $this->load->view($subview); ?>
            </div>

            <div id="footer" class="SS_container">
                <div id="ljudmilaLogo" style="float: right; margin: 5px;">
                    <p style="font-size: 10px; margin: 0px; padding: 0px; text-align: center;">Stran gosti:</p>
                    <img src="<?= base_url('assets/images/ljudmilaLogo.png') ?>" alt="Ljudmila Logo">
                </div>
            </div>


        </div>

        <script type="text/javascript">

            // JQuery Date picker
            /* setting the dayNames and monthNames is optional. This example just shows you how you can modify them or use the defaults */
            $('#calendar').datepicker({
                dateFormat: "dd-mm-yy",
                dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                onSelect: function (dateText) {

                    /* get the selected date */
                    var selectedDate = $('#calendar').datepicker('getDate');

                    /* get the array of day names and month names from the date picker */
                    var dayNames = $('#calendar').datepicker('option', 'dayNames');
                    /* default dayNames can be accessed using $.datepicker._defaults.dayNames; */
                    var monthNames = $('#calendar').datepicker('option', 'monthNames');
                    /* default monthNames can be accessed using $.datepicker._defaults.monthNames; */

                    /* assign are vars */
                    var date = selectedDate.getDate();
                    var day = dayNames[selectedDate.getDay()]; // taking the day name from the array of day names 
                    var month = monthNames[selectedDate.getMonth()]; // taking the month name from the array of month names
                    var year = selectedDate.getFullYear();

                    /* update the ui */
                    $('#day').html(day + ' ' + date);
                    $('#month').html(month);
                    $('#year').html(year);
                    //console.log(date, month, year);

                    var url = "<?= base_url('calendar/date/') ?>" + "/" + date + month + year;
                    console.log(url);
                    $(location).attr('href', url);
                }
            });

            jQuery(document).ready(function () {

                // LightSlider
                $("#lightSlider").lightSlider({
                    gallery: true,
                    item: 1,
                    thumbItem: 9,
                    slideMargin: 0,
                    speed: 500,
                    auto: true,
                    loop: true,
                    onSliderLoad: function () {
                        $('#lightSlider').removeClass('cS-hidden');
                    }
                });

                //Sticky
                $("#sidebar_inner").sticky({topSpacing: 1});
                //$("#inner_navbar").sticky({topSpacing: 0});

                // testing offset distance of element from edge of the document
                $(window).scroll(function () {
                    var offset = $("#main").offset().top - $(window).scrollTop();
                    if (offset <= 0) {
                        //$( ".main_col" ).append( "<span id=\"inner_navbar\">inner nav bar</span>" );
                        //$("#inner_navbar").css("display", "block");
                    } else {
                        //$( "#inner_navbar" ).remove();
                        //$("#inner_navbar").css("display", "none");
                    }
                    //console.log(offset);
                });
            });
        </script>
    </body>
</html>