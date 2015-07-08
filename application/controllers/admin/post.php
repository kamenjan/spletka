<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['posts'] = $this->post_m->get();
        $this->data['subview'] = 'admin/post/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function show_post($id) {
        $this->data['post'] = $this->post_m->get($id);
        $this->data['ID_Array'] = $this->post_m->get_ID_array();

        // If flickr album link is set get photo data
        // TODO assamble urls for all the pictures and their thumbnails,
        // instead of doing that in the view
        if ($this->data['post']->fl_link != '') {
            $this->load->library('phpflickr');
            $this->data['post']->flickr = $this->phpflickr->photosets_getPhotos($this->data['post']->fl_link);
        }
        $this->data['subview'] = 'admin/post/post';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL) {
        // Fetch a post or set a new one
        if ($id) {
            $this->data['post'] = $this->post_m->get($id);
            // Parse MySQL timestamp to d-m-Y string for preset input value
            $this->data['post']->date_event = date('d-m-Y', strtotime($this->data['post']->date_event));
            count($this->data['post']) || $this->data['errors'][] = 'Post could not be found';
        } else {
            $this->data['post'] = $this->post_m->get_new();
        }

        // Set up the form
        $rules = $this->post_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {

            // Set $data array with all the columns
            $data = $this->post_m->array_from_post(array(
                'title',
                'tag',
                'body',
                'fb_link',
                'yt_link',
                'fl_link'
            ));
            $data['date_event'] = date('Y-m-d H:i:s', strtotime($this->input->post('date_event')));
            $data['author'] = $this->session->userdata('name');
            
            $data['season_id'] = $this->season_m->get_ID_by_date($data['date_event']);
           
            //dump_exit($data);
            $this->post_m->save($data, $id);
            redirect('admin/post');
        }

        // Load the view
        $this->data['subview'] = 'admin/post/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete($postID) {

        if (!$this->correct_permissions('admin')) {
            redirect(base_url() . 'admin/post');
        }

        $this->spletka_m->post_m->delete($postID);
        redirect(base_url() . 'admin/post');
    }

    function approve($id) {
        $this->spletka_m->post_m->approve($id);
        redirect(base_url() . 'admin/post');
    }

}
