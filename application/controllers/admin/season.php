<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Season extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('spletka_m');
        $this->data['controller'] = strtolower(get_class());
    }

    public function index() {
        $this->data['seasons'] = $this->season_m->get();
        $this->data['subview'] = 'admin/season/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function show_season($id) {
        $this->data['season'] = $this->spletka_m->get_season($id);        
        $this->data['subview'] = 'admin/season/season';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id) {
        
        // Season are premade rows, it is not possible to create a new one.
        // If there is no $id in the argument or user is not admin, 
        // redirect to season/index
        if (!$id || !$this->correct_permissions('admin')) {
            redirect(base_url('admin/season'));
        }

        $this->data['teamIDs'] = $this->teams_to_seasons_m->get($id, 'ID');
        
        $this->data['season'] = $this->season_m->get($id);

        // Grab the podium teams
        $this->data['season']->first = $this->teams_to_seasons_m->get_by($id, ['podium' => 1])[0];
        $this->data['season']->second = $this->teams_to_seasons_m->get_by($id, ['podium' => 2])[0];
        $this->data['season']->third = $this->teams_to_seasons_m->get_by($id, ['podium' => 3])[0];

        $rules = $this->season_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            // Set $season_data and $team_data arrays with all the columns
            $data['season'] = $this->season_m->array_from_post(array(
                'body'
            ));
            $data['teams'] = $this->input->post('teams');

            $data['1st'] = $this->input->post('1st');
            $data['2nd'] = $this->input->post('2nd');
            $data['3rd'] = $this->input->post('3rd');

            //dump($data);

            $this->spletka_m->save_season($data, $id);
            redirect('admin/season');
        }

        // Set the data for team multiselect
        // TODO get ID && name, not the whole row
        foreach ($this->team_m->get() as $row) {
            $teams[$row->id] = $row->name;
        }
        $this->data['teams'] = $teams;

        // Load the view
        $this->data['subview'] = 'admin/season/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete($seasonID) {

        if (!$this->correct_permissions('admin')) {
            redirect(base_url() . 'admin/season');
        }

        $this->spletka_m->delete_season($seasonID);
        redirect(base_url() . 'admin/season');
    }

    function approve($id) {
        $this->season_m->approve($id);
        redirect(base_url() . 'admin/season');
    }

}
