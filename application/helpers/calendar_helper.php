<?php

function events_per_month($time) {

    $this->load->model('post_m');
    
    $date = explode("-", $time);
    $month = $date[0];
    $year = $date[1];

    $events = [];

    $start = mktime(0, 0, 0, $month, 1, $year);
    $end = mktime(23, 59, 0, $month, date('t', $start), $year);

    $start1 = date('Y-m-d H:i:s', $start);
    $end1 = date('Y-m-d H:i:s', $end);

    $result = $this->post_m->get_calendar($start1, $end1);

    foreach ($result as $date) {
        //dump($date['date_event']);
        //dump(date("d", strtotime($date['date_event'])));
        $events[] = date("d", strtotime($date['date_event']));
    }


    echo json_encode($events);
}


function test() {
    dump('neki');
}