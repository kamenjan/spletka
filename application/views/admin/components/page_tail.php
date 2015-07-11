<?php $this->load->view($delete_modal); ?>

<!--JQuery-->
<script src="http://code.jquery.com/jquery.js"></script>

<!-- Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<!-- Datepicker -->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<!--JQuery Multiselect-->
<script src="<?php echo base_url('assets/multiselect') ?>/js/multiselect.min.js"></script>

<!--TinyMCE Text Editor-->
<script type="text/javascript" src="<?php echo base_url('assets/tinymce') ?>/js/tinymce/tinymce.min.js"></script>

<!--LightSlider-->

<script src="<?php echo base_url('assets/lightslider') ?>/src/js/lightslider.js"></script>

<script type="text/javascript">

    var xmlhttp;

    // Callback function for AJAX, returns dates for currently selected month 
    // in bootstraps inline datepicker
    function highlightEvents(date) {
        loadXMLDoc("<?= base_url('calendar/events_per_month/') ?>" + '/' + date, function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {

                // Get response (JSON encoded in php)
                var monthEvents = xmlhttp.responseText;
                // Parse JSON to JavaScript object
                var object = JSON.parse(monthEvents);
                var days = [];
                for (var key in object) {
                    if (object.hasOwnProperty(key)) {
                        var day = parseInt(JSON.stringify(object[key]).replace(/['"]+/g, ''));
                        $("td[class='day']").filter(function () {
                            return $(this).text() == day;
                        }).css('background-color', '#999');
                    }
                }
            }
        });
    }

    // AJAX
    function loadXMLDoc(url, cfun) {
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = cfun;
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }

    // TODO fix, so it returns to normal on windowssize > 754 !!
    function removePadding() {
        windowsize = $(window).width();
        if (windowsize < 754) {
            $('#SS_main_parent').removeAttr("style");
        } else {
            $('#SS_main_parent').attr("style", "padding-right: 0px; margin: 0px;");
        }
    }

    removePadding();

    $(window).on('resize', function () {
        removePadding();
    });

    // Hide the text editor for comments
    // TODO default display: none, show on event
    $("#comment_textarea").hide();
    $("button[id='comment']").click(function () {
        $("#comment_textarea").show();
        $('html, body').animate({
            scrollTop: $("#comment_textarea").offset().top
        }, 2000);
    });

    jQuery(document).ready(function () {

        $('.SS_calendar').datepicker().on
                ('changeMonth', function (e) {
                    var currMonth = new Date(e.date).getMonth() + 1;
                    var currYear = String(e.date).split(" ")[3];
                    highlightEvents(currMonth + '-' + currYear);
                }).datepicker().on
                ('changeDate', function (e) {
                    var date = new Date($('.SS_calendar').datepicker('getDate'));
                    var test = $('.SS_calendar').datepicker('getDate');
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    var url = "<?= base_url('calendar/date/') ?>" + "/" + day + '-' + month + '-' + year;
                    $(location).attr('href', url);
                });

        // Highlight events on page load but after datepicker has been initialized
        var date = new Date();
        var currMonth = date.getMonth() + 1;
        var currYear = date.getFullYear();
        highlightEvents(currMonth + '-' + currYear);

        $('#SS_media_selector').change(function () {

            switch ($(this).val()) {
                case 'gallery':
                    $('#SS_youtube_link').hide();
                    $('#SS_flickr_link').show();
                    break;
                case 'video':
                    $('#SS_flickr_link').hide();
                    $('#SS_youtube_link').show();
            }
        });

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

        // Bootstrap delete modal
        $('#deleteModal').on('shown.bs.modal', function (e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('controller') + '/delete/' + $(e.relatedTarget).data('id'));
        });

        // JQuery MultiSelector
        $('#multiselect').multiselect();

        // JQuery Date picker
        $(".datepicker").datepicker({
            dateFormat: "dd-mm-yy"
        });

        $("#calendar").datepicker({
            dateFormat: "dd-mm-yy"
        });

        // TinyMCE text editor
        tinymce.init({
            selector: "textarea",
            // ===========================================
            // INCLUDE THE PLUGIN
            // ===========================================

            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste jbimages"
            ],
            // ===========================================
            // PUT PLUGIN'S BUTTON on the toolbar
            // ===========================================

            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
            // ===========================================
            // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
            // ===========================================

            relative_urls: false
        });


        // Code for updating viable team select for podium in season/edit view 
        $("button[id*='multiselect']").bind("click", function () {

            $("select[name='1st']").empty();
            $("select[name='1st']").append("<option value=''></option>");
            $("select[name='2nd']").empty();
            $("select[name='2nd']").append("<option value=''></option>");
            $("select[name='3rd']").empty();
            $("select[name='3rd']").append("<option value=''></option>");

            // For each element in selected teams
            $("select[name='teams[]']>option").each(function (index) {
                var teamName = $(this).text();
                var teamID = $(this).attr("value");

                // If element already exists do nothing, else add it to podium possibilities list
                if ($("select[name='1st']>option[value='" + teamID + "']").length) {
                } else {
                    $("select[name='1st']").append("<option value=" + teamID + ">" + teamName + "</option>");
                    $("select[name='2nd']").append("<option value=" + teamID + ">" + teamName + "</option>");
                    $("select[name='3rd']").append("<option value=" + teamID + ">" + teamName + "</option>");
                }

            });
        });



    });
</script>

</body>
</html>

