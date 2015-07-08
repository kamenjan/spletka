<?php

class Cooperation extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        
        $this->data['meta_title'] = 'Sodelovanje';
        
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['subview'] = 'cooperation';
        $this->load->view('_layout_main', $this->data);
    }

}
