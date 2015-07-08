<?php

class User extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
    }

    public function profile() {

        $user_id = $this->session->userdata('id');

        $user_name = $this->data['profile']['user_name'] = $this->user_m->get($user_id)->name;
        $this->data['profile']['user_email'] = $this->user_m->get($user_id)->email;
        $this->data['profile']['posts'] = $this->post_m->get_by(['author' => $user_name]);

        $this->data['subview'] = 'admin/user/profile';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit() {

        $user_id = $this->session->userdata('id');
        $this->data['user'] = $this->user_m->get($user_id);
        
        // Set up the form
        $rules = $this->user_m->rules_edit;

        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->user_m->array_from_post(array('name', 'email', 'password'));
            $data['password'] = $this->user_m->hash($data['password']);
            $this->user_m->save($data, $user_id);
            $this->logout();
        }

        // Load the view
        $this->data['subview'] = 'admin/user/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function login() {

        // If user is already logged in, we redirect him
        if ($this->user_m->loggedin() == TRUE) {
            redirect('admin/dashboard');
        } 

        // Set form
        $rules = $this->user_m->rules;
        $this->form_validation->set_rules($rules);

        // Process form
        if ($this->form_validation->run() == TRUE) {
            // We can login and redirect
            if ($this->user_m->login() == TRUE) {
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'That email/password comabination does not exist');
                redirect('admin/user/login', 'refresh');
            }
        }

        // Load the view
        $this->data['subview'] = 'admin/user/login';
        $this->load->view('admin/user/login', $this->data);
    }

    public function logout() {
        $this->user_m->logout();
        redirect(base_url());
    }

    public function _unique_email($str) {
        /*
         * Segment is not always 4, it depends on the project state
         * Do NOT validate, if the email already exists, unless
         * it's the email for the current user
         */
        $id = $this->uri->segment(4);
        $this->db->where('email', $this->input->post('email'));
        !$id || $this->db->where('id !=', $id);
        $user = $this->user_m->get();

        if (count($user)) {
            $this->form_validation->set_message('_unique_email', '%s should be unique');
            return FALSE;
        }

        return TRUE;
    }

}
