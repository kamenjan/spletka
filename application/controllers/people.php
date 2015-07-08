<?php

class People extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        
        $this->data['meta_title'] = 'Osebje';
        
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['personnel'] = $this->personnel_m->get();
        $this->data['subview'] = 'people';
        $this->load->view('_layout_main', $this->data);
    }

}
