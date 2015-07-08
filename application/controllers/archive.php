<?php

class Archive extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        
        $this->data['meta_title'] = 'Arhiv';
        
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        
        $this->data['seasons'] = $this->season_m->get_archive();
        
        $this->data['subview'] = 'archive';
        $this->load->view('_layout_main', $this->data);
    }

}
