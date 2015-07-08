<?php

class Improv extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        
        $this->data['meta_title'] = 'O improvizaciji';
        
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {      
        $this->data['posts'] = $this->post_m->get_by(['approved' => 'true', 'tag' => 'article']);

        $this->data['subview'] = 'improv';
        $this->load->view('_layout_main', $this->data);
    }

}
