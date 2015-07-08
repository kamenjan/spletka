<?php

class TestController extends Frontend_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {

        $this->load->library('calendar');

        echo $this->calendar->generate();
    }

}
