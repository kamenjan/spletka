<?php
$js_answers = json_encode($survey->answers);
//dump($js_answers);
?>

<script>

    var JSON_array = <?= $js_answers ?>;
    var answers = [];
    var neki = [];

    for (var answer in JSON_array) {
        if (JSON_array.hasOwnProperty(answer)) {
            answers[JSON_array[answer].answer] = JSON_array[answer].count;
        }
    }
    
    //console.log(answers);
</script>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {

        //var data1 = google.visualization.arrayToDataTable(<?= $js_answers ?>);

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work', 11],
            ['Eat', 2],
            ['Commute', 2],
            ['Watch TV', 2],
            ['Sleep', 7]
        ]);
        
        console.log(data);

        var options = {
            title: '<?= $survey->question ?>',
            backgroundColor: '#CFCFCF'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
<div id="piechart" style="width: auto; height: 500px;"></div>

<?php
//dump($this->_ci_cached_vars);
if (isset($survey->id)) {
    ?>
    <div id="survey">
        <h4><?= $survey->question ?></h4>

        <?php foreach ($survey->answers as $answer) { ?>
            <span><?= $answer->answer ?></span><span><?= $answer->count ?></span>
            <?php
        }
        ?>


    </div><?php } else { ?>
    <p>Anketa ne obstaja.</p>
<?php } ?>



