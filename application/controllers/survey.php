<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Survey extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {      
               
        $this->data['surveys'] = $this->survey_m->get();

        $this->data['subview'] = 'admin/survey/index';
        $this->load->view('admin/_layout_main', $this->data);
    }
}
