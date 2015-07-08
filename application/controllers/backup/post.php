<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Posts extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('post');
    }

    public function index($start = 0) {
        $data['posts'] = $this->post->get_posts(3, $start);

        // Config files for pagination
        $config['base_url'] = base_url() . 'posts/index';
        $config['total_rows'] = $this->post->get_post_count();
        $config['per_page'] = 3;
        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('post_index', $data);
        $this->load->view('footer');
    }

    function post($postID) {
        $data['post'] = $this->post->get_post($postID);
        $data['ID_Array'] = $this->post->get_ID_array();
        $this->load->view('post_view', $data);
    }

    function correct_permissions($required) {
        $user_type = $this->session->userdata('user_type');
        if ($required == "user") {
            if ($user_type) {
                return true;
            }
        } elseif ($required == "author") {
            if ($user_type == "admin" || $user_type == "author") {
                return true;
            }
        } elseif ($required == "admin") {
            if ($user_type == "admin") {
                return true;
            }
        }
    }

    function new_post() {

        if (!$this->correct_permissions('author')) {
            redirect(base_url() . 'users/login');
        }

        if ($this->input->post('title') != '' && $this->input->post('post') != '') {
            $data = array(
                'title' => $this->input->post('title'),
                'post' => $this->input->post('post')
            );
            $this->post->insert_post($data);
            redirect(base_url() . 'posts/');
        } else {
            $this->load->view('new_post_view');
        }
    }

    function editpost($postID) {

        $data['success'] = 0;
        $user_type = $this->session->userdata('user_type');

        if ($user_type != 'admin' && $user_type != 'author') {
            redirect(base_url() . 'users/login');
        }

        if ($_POST) {
            $data_post = [
                'title' => $this->input->post('title'),
                'post' => $this->input->post('post')
            ];
            $this->post->update_post($postID, $data_post);
            $data['success'] = 1;
        }
        $data['post'] = $this->post->get_post($postID);
        $this->load->view('edit_post_view', $data);
    }

    function deletepost($postID) {

        $user_type = $this->session->userdata('user_type');

        if ($user_type != 'admin' && $user_type != 'author') {
            redirect(base_url() . 'users/login');
        }

        $this->post->delete_post($postID);
        redirect(base_url() . 'posts');
    }

}
