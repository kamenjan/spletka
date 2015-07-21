<?php

class Season extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');

        $this->data['meta_title'] = 'Trenutna sezona';

        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['season'] = $this->spletka_m->get_current_season();
        $this->data['subview'] = 'season';
        $this->load->view('_layout_main', $this->data);
    }

    function show_season($id) {
        $this->data['season'] = $this->spletka_m->get_season($id);
        $this->data['media'] = $this->media_m->get_by(['seasonID' => $id]);
        $this->data['posts'] = $this->post_m->get_by(['season_id' => $id]);
        $this->data['subview'] = 'season';
        $this->load->view('_layout_main', $this->data);
    }

}
