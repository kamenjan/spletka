<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['galleries'] = $this->gallery_m->get();

        // Show seasons by their name not ID
        foreach ($this->data['galleries'] as $key => $gallery) {
            $this->data['galleries'][$key]->season_name = $this->season_m->get_by(['id' => $gallery->seasonID])[0]->name;
        }

        $this->data['subview'] = 'admin/gallery/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function show_gallery($id) {
        $this->data['gallery'] = $this->gallery_m->get($id);
        $this->data['ID_Array'] = $this->gallery_m->get_ID_array();

        // Get the actual photo urls via a call to 'phpflickr' library with 
        // gallerys ID as an argument
        $this->load->library('phpflickr');
        $this->data['gallery']->flickr = $this->phpflickr->photosets_getPhotos($this->data['gallery']->fl_link);

        $this->data['subview'] = 'admin/gallery/gallery';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL) {

        // Send all created seasons to gallery edit view
        foreach ($this->season_m->get() as $row) {
            $this->data['seasons'][$row->id] = $row->name;
        }

        // Fetch a gallery or set a new one
        if ($id) {
            $this->data['gallery'] = $this->gallery_m->get($id);
            $this->data['gallery']->date = date('d-m-Y', strtotime($this->data['gallery']->date));
            count($this->data['gallery']) || $this->data['errors'][] = 'Gallery could not be found';
        } else {
            $this->data['gallery'] = $this->gallery_m->get_new();
        }

        // Set up the form and form rules
        $rules = $this->gallery_m->rules;
        $this->form_validation->set_rules($rules);

        // Helps with validation
        $this->load->library('phpflickr');

        // Process the form
        if ($this->form_validation->run() == TRUE) {

            // Set $data array with form input ($_POST) columns
            $data = $this->gallery_m->array_from_post(array(
                'name',
                'fl_link',
                'seasonID'
            ));
            $data['fl_link'] = trim($data['fl_link']);
            $data['date'] = date('Y-m-d H:i:s', strtotime($this->input->post('date')));

            // Validate the flickr photoset ID
            if ($this->phpflickr->photosets_getPhotos($data['fl_link'])) {
                $this->gallery_m->save($data, $id);
                redirect('admin/gallery');
            } else {
                $this->data['errors']['photoset ID error'] = 'Ta photoset ne obstaja';
            }
        }

        // Load the view
        $this->data['subview'] = 'admin/gallery/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete($id) {

        if ($this->correct_permissions('admin')) {
            $this->gallery_m->delete($id);
        }

        redirect(base_url() . 'admin/gallery');
    }

    // TODO write a flicker photoset validation function
    function validate_flickr_photoset($photoset_id) {
        
    }

}
