
// Retrive backend data from data container
//---------------------------------------------------------------------------//
var controller;
var base_url;
var answered_survey;

$('.data-container').each(function () {
    var container = $(this);
    controller = container.data('controller');
    base_url = container.data('base_url');
    answered_survey = container.data('answered_survey');
});

console.log(answered_survey);

// removes padding on main div, so the gap looks nice
// it removes padding if main div takes whole width of window (smaller devices)
//---------------------------------------------------------------------------//
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

//survey scripts and functionality
//---------------------------------------------------------------------------//
google.load("visualization", "1", {packages: ["corechart"]});

function drawChart(chartData) {
    var chart = [
        [chartData.cols[0].label, chartData.cols[1].label]
    ];

    var rows = chartData.rows;
    for (var i = 0; i < rows.length; ++i) {
        chart.push([rows[i].c[0].v, parseInt(rows[i].c[1].v)]);
    }

    var data = google.visualization.arrayToDataTable(chart, false);

    var options = {
        title: chartData.cols[0].label,
        width: $('#SS_sidebar').width(),
        colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
        backgroundColor: '#CFCFCF'
    };

    chart = new google.visualization.PieChart(
        document.getElementById('SS_piechart'));

    chart.draw(data, options);
}

//document.ready functions
//---------------------------------------------------------------------------//
$(document).ready(function (){
    if (!answered_survey) {
        $('#SS_piechart').hide();
        console.log('debug');
    }


    $('.SS_calendar').datepicker().on(
        'changeMonth', function (e) {
            var currMonth = new Date(e.date).getMonth() + 1;
            var currYear = String(e.date).split(" ")[3];
            var date = currMonth + '-' + currYear;

            $.post(base_url + controller + '/events_per_month/' + date,
                   function (response) {
                for (var day in response) {
                    if (response.hasOwnProperty(day)) {
                        var tmp_event = parseInt(JSON.stringify(
                            response[day]).replace(/['"]+/g, ''));
                        $("td[class='day']").filter(function () {
                            return $(this).text() == tmp_event;
                        }).css('background-color', '#999');
                    }
                }
            }, 'json');

            console.log(controller);

        }).datepicker().on
        ('changeDate', function (e) {
            var date = new Date($('.SS_calendar').datepicker('getDate'));
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            var url = base_url + 'calendar/date/' + day + '-' + month + '-' +
                      year;
            $(location).attr('href', url);
        });


    // Draw a survey result char in sidebar
    // JQuery AJAX function ($.ajax or $.post) - usese post to communicate with
    // server
    $.post(base_url + controller + '/get_survey', function (response) {
        var chartData = response;
        drawChart(chartData);
    }, 'json');


    // Highlight events on page load, but after datepicker has been initialized
    var now = new Date();
    var currMonth = now.getMonth() + 1;
    var currYear = now.getFullYear();
    var date = currMonth + '-' + currYear;
    $.post(base_url + controller + '/events_per_month/' + date,
           function (response) {
        for (var day in response) {
            if (response.hasOwnProperty(day)) {
                var tmp_event = parseInt(JSON.stringify(
                    response[day]).replace(/['"]+/g, ''));
                $("td[class='day']").filter(function () {
                    return $(this).text() == tmp_event;
                }).css('background-color', '#999');
            }
        }
    }, 'json');

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

    // Sidebar survey submit button function
    $("#submit_btn").click(function () {

        // Get checked answer
        answer = {
            'answer': $('input[name=answer]:checked', '#SS_survey').val()
        };

        // JQuery AJAX function ($.ajax or $.post) - usese post to communicate
        // with server
        $.post(base_url + controller + '/update_survey', answer,
               function (response) {

            // TUKI !!!!!
            var chartData = response;
            $("#SS_survey").remove();
            $('#SS_piechart').show();
            drawChart(chartData);
        }, 'json');

    });
});

$(window).resize(function () {
    $('#SS_piechart').width( $('#SS_sidebar').width() );
    console.log('sidebar = ' + $('#SS_sidebar').width());
    console.log('chart = ' + $('#SS_piechart').width());
});
