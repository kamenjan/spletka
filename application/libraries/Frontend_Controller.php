<?php

class Frontend_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->data['meta_title'] = '';
        $this->data['current_season'] = $this->spletka_m->get_current_season()['season']->name;
        $this->data['announcements'] = $this->post_m->get_announcements();

        $this->data['user_data'] = $this->session->all_userdata();
        $this->data['survey'] = $this->spletka_m->get_survey();

        if (!$this->session->userdata('survey')) {
            $this->session->set_userdata(['survey' => FALSE]);
        }
        $this->data['answered_survey'] = $this->session->userdata('survey');
    }

    // AJAX asynchronious function. 
    // Activated on survey submit.
    // Takes answerID and returns survey data
    // TODO - override post input, get input from function call
    function update_survey() {

        // If there is a valid post input (TODO validate!)
        if ($this->input->post('answer')) {

            // This user has answered the survey
            $this->session->set_userdata(['survey' => TRUE]);

            // Take the data ($answerID) from browser and increment answer count in DB
            $answerID = $this->input->post('answer');
            $this->answer_m->add_vote($answerID);

            //$output = json_encode(array('success' => true));

            $survey = [];

            $data = $this->spletka_m->get_survey();

            $survey['cols'][] = ['id' => '', 'label' => $data->question, 'pattern' => '', 'type' => 'string'];
            $survey['cols'][] = ['id' => '', 'label' => 'count', 'pattern' => '', 'type' => 'number'];

            foreach ($data->answers as $answer) {
                $survey['rows'][] = ['c' => [['v' => $answer->answer, 'f' => null], ['v' => $answer->count, 'f' => null]]];
            }

            die(json_encode($survey));
        }
    }

}
