<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Personnel extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['personnel'] = $this->personnel_m->get();
        $this->data['subview'] = 'admin/personnel/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function show_person($id) {
        $this->data['person'] = $this->personnel_m->get($id);
        $this->data['ID_Array'] = $this->personnel_m->get_ID_array();

        $this->data['subview'] = 'admin/personnel/person';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL) {

        // Fetch a person or set a new one
        if ($id) {
            $this->data['person'] = $this->personnel_m->get($id);
            count($this->data['person']) || $this->data['errors'][] = 'Person could not be found';
        } else {
            $this->data['person'] = $this->personnel_m->get_new();
        }

        // Set upload configuration
        // use $this->image_lib->display_errors(); for debuging
        $config = [
            'upload_path' => './assets/uploads/person_img',
            'allowed_types' => 'gif|jpg|png',
            'file_name' => '',
            'max_size' => '250',
            'max_width' => '1000',
            'max_height' => '1000'
        ];
        $this->load->library('upload', $config);


        // Set up the form and form rules
        $rules = $this->personnel_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE &&
                ($this->upload->do_upload('picture') ||
                strpos($this->upload->display_errors(), 'You did not select a file to upload.') )) {

            // Info about uploaded file
            $this->data['file_data'] = $this->upload->data();

            // Set $data array with form input ($_POST) columns
            $data = $this->gallery_m->array_from_post(array(
                'name',
                'body'
            ));

            // If no picture was selected ond edit, keep the old reference (default = no_image.png), 
            // otherwise resize it, save it, set it as a new reference and delete the old file
            if ($this->input->post('default_picture') == 'on') {
                $data['picture'] = 'noimage.jpg';
            } else if ($this->data['file_data']['orig_name'] === "") {
                $data['picture'] = $this->data['team']->picture;
            } else {
                $this->personnel_m->delete_picture($this->data['file_data']['file_path'] . $this->data['team']->picture);
                $this->resize_image($this->data['file_data']['full_path'], $this->data['team']->name, $this->data['controller']);
                $data['picture'] = $this->upload->data()['raw_name'] . '_thumb' . $this->upload->data()["file_ext"];
            }

            //dump_exit($this->data['file_data']);
            //dump_exit($data);
            $this->personnel_m->save($data, $id);
            redirect('admin/personnel');
        } else {
            $this->data['errors']['upload_errors'] = $this->upload->display_errors();
        }

        // Load the view
        $this->data['subview'] = 'admin/personnel/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete($id) {

        if ($this->correct_permissions('admin')) {
            $this->personnel_m->delete($id);
        }

        redirect(base_url() . 'admin/personnel');
    }

    function resize_image($path, $file, $controller) {
        $config = [
            'image_library' => 'gd2',
            'source_image' => $path,
            'create_thumb' => TRUE,
            'maintain_ratio' => TRUE,
            'width' => 200,
            'height' => 200,
                //'new_image' => './assets/uploads/' . $controller . '_img/' . $file . $extension
        ];

        //dump_exit($config);

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        unlink($path);
    }

}
