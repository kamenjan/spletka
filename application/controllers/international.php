<?php

class International extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        
        $this->data['meta_title'] = 'International';
        
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['posts'] = $this->post_m->get_by(['approved' => 'true', 'tag' => 'international']);
        
        $this->data['subview'] = 'international';
        $this->load->view('_layout_main', $this->data);
    }

}
