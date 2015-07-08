<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Team extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['teams'] = $this->team_m->get();
        $this->data['subview'] = 'admin/team/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function show_team($id) {
        $this->data['team'] = $this->team_m->get($id);
        $this->data['ID_Array'] = $this->team_m->get_ID_array();

        $this->data['subview'] = 'admin/team/team';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL) {
        // Fetch a team or set a new one
        if ($id) {
            $this->data['team'] = $this->spletka_m->team_m->get($id);
            count($this->data['team']) || $this->data['errors'][] = 'Team could not be found';
        } else {
            $this->data['team'] = $this->spletka_m->team_m->get_new();
        }

        // Set upload configuration
        // use $this->image_lib->display_errors(); for debuging
        $config = [
            'upload_path' => './assets/uploads/team_img',
            'allowed_types' => 'gif|jpg|png',
            'file_name' => '',
            'max_size' => '250',
            'max_width' => '1024',
            'max_height' => '768'
        ];
        $this->load->library('upload', $config);

        // Set up the form and form rules
        $rules = $this->spletka_m->team_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        // TODO porly written validation condition, refactor!
        if ($this->form_validation->run() == TRUE &&
                ($this->upload->do_upload('picture') ||
                strpos($this->upload->display_errors(), 'You did not select a file to upload.') )) {

            // Info about uploaded file
            $this->data['file_data'] = $this->upload->data();

            // Set $data array with all the columns
            $data = $this->spletka_m->team_m->array_from_post(array(
                'name',
                'description',
                'school'
            ));
            
            // If no picture was selected ond edit, keep the old reference (default = no_image.png), 
            // otherwise resize it, save it, set it as a new reference and delete the old file
            if ($this->input->post('default_picture') == 'on') {
                $data['picture'] = 'noimage.jpg';
            } else if ($this->data['file_data']['orig_name'] === "") {
                $data['picture'] = $this->data['team']->picture;
            } else {
                $this->team_m->delete_picture($this->data['file_data']['file_path'] . $this->data['team']->picture);                
                $this->resize_image($this->data['file_data']['full_path'], $this->data['team']->name, $this->data['controller']);
                $data['picture'] = $this->upload->data()['raw_name'] . '_thumb' . $this->upload->data()["file_ext"];
            }
            
            //dump_exit($this->data['file_data']);

            $this->team_m->save($data, $id);
            redirect('admin/team');
        } else {
            $this->data['errors']['upload_errors'] = $this->upload->display_errors();
        }

        // Load the view
        $this->data['subview'] = 'admin/team/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    // TODO refactor the method, so it also deletes all the references in 
    // teamsToSeason table to the team being deleted
    function delete($teamID) {

        if (!$this->correct_permissions('admin')) {
            redirect(base_url() . 'admin/team');
        }

        $this->spletka_m->team_m->delete($teamID);
        redirect(base_url() . 'admin/team');
    }

    // TODO move function to parent controller
    // use getClass() for controller name ('admin')
    function approve($id) {
        $this->spletka_m->team_m->approve($id);
        redirect(base_url() . 'admin/team');
    }

}
