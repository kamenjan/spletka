<?php

/**
 * Spletka_m class is a higher level CI_Model that brings together all the
 * low level one-table models and junction table model and describes the
 * interaction between them.   
 * 
 * @author Rok Arih
 */
class Spletka_m extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('post_m');
        $this->load->model('team_m');
        $this->load->model('season_m');
        $this->load->model('media_m');
        $this->load->model('comment_m');
        $this->load->model('personnel_m');
        $this->load->model('survey_m');
        $this->load->model('answer_m');
        $this->load->model('teams_to_seasons_m');
    }

    /**
     * @param array() [$data] to be saved in designated DB tables
     * @param int [$id] [OPTIONAL] [DEFAULT = NULL]
     * 
     * Uses season_m and teams_to_season_m to save a season and team references
     */
    public function save_season($data, $id) {

        $first = $data['1st'];
        $second = $data['2nd'];
        $third = $data['3rd'];


        // Upadete 'seasons' table and
        $this->season_m->save($data['season'], $id);

        // 'teamsToSeason' reference table
        $this->teams_to_seasons_m->delete($id);
        foreach ($data['teams'] as $teamID) {

            $data = [
                'teamID' => $teamID,
                'seasonID' => $id,
                'podium' => 0
            ];

            if ($teamID == $first) {
                $data['podium'] = 1;
            }

            if ($teamID == $second) {
                $data['podium'] = 2;
            }

            if ($teamID == $third) {
                $data['podium'] = 3;
            }

            $this->teams_to_seasons_m->save($data);
        }
    }

    // Returns season including teams
    public function get_season($id) {
        $data = [];
        $data['season'] = $this->season_m->get($id);

        if ($this->teams_to_seasons_m->get($id, 'ID') !== NULL) {
            foreach ($this->teams_to_seasons_m->get($id, 'ID') as $key => $teamID) {
                $this->team_m->get($teamID);
                $data['teams'][$key] = $this->team_m->get($teamID);
            }
        }
        return $data;
    }

    public function get_current_season() {
        $id = $this->season_m->get_ID_by_date(date('d-m-Y', strtotime("now")));

        $data = [];
        $data['season'] = $this->season_m->get($id);


        if ($this->teams_to_seasons_m->get($id, 'ID') !== NULL) {
            foreach ($this->teams_to_seasons_m->get($id, 'ID') as $key => $teamID) {
                $this->team_m->get($teamID);
                $data['teams'][$key] = $this->team_m->get($teamID);
            }
        }
        return $data;
    }

    public function delete_season($id) {
        $this->season_m->delete($id);
        $this->teams_to_seasons_m->delete($id);
    }

    public function save_survey($data, $id = NULL) {

        $surveyID = $this->survey_m->save(['question' => $data['question']], $id);

        foreach ($data['answers'] as $answer) {
            if ($answer != '') {
                $this->answer_m->save(['surveyID' => $surveyID, 'answer' => $answer]);
            }
        }
    }

    // Returns survey including answers (default == active)
    public function get_survey($id = NULL) {
        if ($id) {
            $data = $this->survey_m->get($id);
            $data->answers = $this->answer_m->get_by(['surveyID' => $id]);
        } else {
            $data = $this->survey_m->get_by(['status' => 'active'])[0];
            $data->answers = $this->answer_m->get_by(['surveyID' => $data->id]);
        }

        return $data;
    }

    public function update_survey($answer) {


        return $data;
    }

    public function delete_survey($id) {
        $this->survey_m->delete($id);
        $this->answer_m->delete($id);
    }

}
