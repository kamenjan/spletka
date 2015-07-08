<?php

class Calendar extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');

        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['subview'] = 'calendar';
        $this->load->view('_layout_main', $this->data);
    }
 
    public function date($time) { 

        //take date (mysql timestamp format)
        $date = date('Y-m-d H:i:s', strtotime($time));
        // search posts table and return posts with matching date_event
        $this->data['posts'] = $this->post_m->get_by(['date_event' => $date]);

        $this->data['date'] = date('Y-m-d H:i:s', strtotime($time));

        $this->data['meta_title'] = date('Y-m-d', strtotime($time));

        $this->data['subview'] = 'calendar';
        $this->load->view('_layout_main', $this->data);
    }
}
