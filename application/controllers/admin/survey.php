<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Survey extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['surveys'] = $this->survey_m->get();

        $this->data['subview'] = 'admin/survey/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function show_survey($id) {

        //$test = array_merge($this->data, $this->spletka_m->get_survey($id));

        $this->data['survey'] = $this->spletka_m->get_survey($id);
        //$this->data['ID_Array'] = $this->survey_m->get_ID_array();

        $this->data['subview'] = 'admin/survey/survey';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL) {
        // Fetch a survey or set a new one
        if ($id) {
            $this->data['survey'] = $this->survey_m->get($id);

            count($this->data['survey']) || $this->data['errors'][] = 'Survey could not be found';
        } else {
            $this->data['survey'] = $this->survey_m->get_new();
        }

        // Set up the form
        $rules = array_merge($this->survey_m->rules, $this->answer_m->rules);
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {


            $data['question'] = $this->input->post('question');
            $data['answers'] = $this->survey_m->array_from_post(array(
                'answer1',
                'answer2',
                'answer3',
                'answer4',
                'answer5',
                'answer6',
            ));

            $this->spletka_m->save_survey($data, $id);

            redirect('admin/survey');
        }

        // Load the view
        $this->data['subview'] = 'admin/survey/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete($surveyID) {

        if (!$this->correct_permissions('admin')) {
            redirect(base_url() . 'admin/survey');
        }

        $this->spletka_m->delete_survey($surveyID);
        redirect(base_url() . 'admin/survey');
    }

    function activate($id) {

        $this->survey_m->activate($id);
        redirect(base_url() . 'admin/survey');
    }

    function end_survey($id) {
        $this->survey_m->change_status($id, 'finished');
        redirect(base_url() . 'admin/survey');
    }

}
