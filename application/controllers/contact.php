<?php

class Contact extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        
        $this->data['meta_title'] = 'Kontakt';
        
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['subview'] = 'contact';
        $this->load->view('_layout_main', $this->data);
    }

}
