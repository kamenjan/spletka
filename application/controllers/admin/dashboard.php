<?php

class Dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {

        $this->data['posts'] = $this->post_m->get_by(['approved' => 'false']);
        
        $this->data['comments'] = $this->comment_m->get();

        // Set up the form and form rules
        $rules = $this->comment_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {

            $data['body'] = $this->input->post('body');
            $data['author'] = $this->session->userdata('name');

            $this->comment_m->save($data);
            redirect('admin/dashboard');
        }


        $this->data['subview'] = 'admin/dashboard/home';
        $this->load->view('admin/_layout_main', $this->data);
    }

}
