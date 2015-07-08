<?php

class Post extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');

        $this->data['meta_title'] = 'Objava';

        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['subview'] = 'season';
        $this->load->view('_layout_main', $this->data);
    }

    public function show_post($id) {
        $this->data['post'] = $this->post_m->get($id);
        $this->data['subview'] = 'post';

        // If flickr album link is set get photo data
        // TODO assamble urls for all the pictures and their thumbnails,
        // instead of doing that in the view
        if ($this->data['post']->fl_link != '') {
            $this->load->library('phpflickr');
            $this->data['post']->flickr = $this->phpflickr->photosets_getPhotos($this->data['post']->fl_link);
        }

        $this->load->view('_layout_main', $this->data);
    }

}
