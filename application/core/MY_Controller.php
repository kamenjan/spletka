<?php

class MY_Controller extends CI_Controller {

    public $data = [];

    function __construct() {
        parent::__construct();
        $this->data['site_name'] = 'Spletka';
        $this->data['errors'] = [];
        $this->load->model('spletka_m');
        $this->data['base_url'] = base_url();
    }

    
    // AJAX asynchronious function. 
    // Returns events occuring month after $time
    function events_per_month($time) {

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
            $events[] = date("d", strtotime($date['date_event']));
        }

        echo json_encode($events);
    }

    // AJAX asynchronious function. 
    // Returns active survey data formatted for Google JSAPI chart data
    function get_survey() {
        $survey = [];

        $data = $this->spletka_m->get_survey();

        $survey['cols'][] = ['id' => '', 'label' => $data->question, 'pattern' => '', 'type' => 'string'];
        $survey['cols'][] = ['id' => '', 'label' => 'count', 'pattern' => '', 'type' => 'number'];

        foreach ($data->answers as $answer) {
        $survey['rows'][] = ['c' => [['v' => $answer->answer, 'f' => null],['v' => $answer->count, 'f' => null]]  ];
        }

        die(json_encode($survey));

    }

}
