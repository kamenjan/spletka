<?php

class Home extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->data['meta_title'] = 'Domov';       
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {

        $this->data['posts'] = $this->post_m->get_home();

        $this->data['subview'] = 'home';
        $this->load->view('_layout_main', $this->data);
    }

}
