<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Media extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['media'] = $this->media_m->get();

        // Show seasons by their name not ID
        foreach ($this->data['media'] as $key => $media) {
            $this->data['media'][$key]->season_name = $this->season_m->get_by(['id' => $media->seasonID])[0]->name;
        }

        $this->data['subview'] = 'admin/media/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function show_media($id) {
        $this->data['media'] = $this->media_m->get($id);
        $this->data['ID_Array'] = $this->media_m->get_ID_array();

        // Get the actual photo urls via a call to 'phpflickr' library with 
        // gallerys ID as an argument
        $this->load->library('phpflickr');

        switch ($this->data['media']->tag) {
            case 'video':
                
                break;

            case 'gallery':
                $this->data['media']->flickr = $this->phpflickr->photosets_getPhotos($this->data['media']->link);
        }

        $this->data['subview'] = 'admin/media/media';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL) {

        // Send all created seasons to gallery edit view
        foreach ($this->season_m->get() as $row) {
            $this->data['seasons'][$row->id] = $row->name;
        }

        // Fetch a gallery or set a new one
        if ($id) {
            $this->data['media'] = $this->media_m->get($id);
            //$this->data['media']->date = date('d-m-Y', strtotime($this->data['media']->date));
            count($this->data['media']) || $this->data['errors'][] = 'Media could not be found';
        } else {
            $this->data['media'] = $this->media_m->get_new();
        }

        // Set up the form and form rules
        $rules = $this->media_m->rules;
        $this->form_validation->set_rules($rules);

        // Helps with validation
        $this->load->library('phpflickr');

        // Process the form
        if ($this->form_validation->run() == TRUE) {

            // Set $data array with form input ($_POST) columns
            $data = $this->media_m->array_from_post(array(
                'tag',
                'name',
                'seasonID'
            ));

            switch ($data['tag']) {
                case 'video':
                    $data['link'] = $this->input->post('yt_link');
                    break;
                case 'gallery':
                    $data['link'] = $this->input->post('fl_link');
            }

            //$data['date'] = date('Y-m-d H:i:s', strtotime($this->input->post('date')));
            // TODO - Validate flickr photoset ID or youtube link
//            if ($data['tag'] == 'gallery' && $this->phpflickr->photosets_getPhotos($data['link'])) {
//                $this->media_m->save($data, $id);
//                redirect('admin/media');
//            } else {
//                $this->data['errors']['photoset ID error'] = 'Ta photoset ne obstaja';
//            }

            $this->media_m->save($data, $id);
            redirect('admin/media');
        }

        // Load the view
        $this->data['subview'] = 'admin/media/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete($id) {

        if ($this->correct_permissions('admin')) {
            $this->media_m->delete($id);
        }

        redirect(base_url() . 'admin/gallery');
    }

    // TODO write a flicker photoset validation function
    function validate_flickr_photoset($photoset_id) {
        
    }

}
