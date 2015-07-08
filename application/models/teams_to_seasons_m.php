<?php

class Teams_to_seasons_m extends MY_Model {

    protected $_table_name = 'teamsToSeasons';
    protected $_order_by = 'season_id desc';

    function __construct() {
        parent::__construct();
    }

    // Get all teams for season, if $method is 'ID', return just their IDs
    public function get($seasonID, $method = NULL) {
        if ($method == 'ID') {
            $this->db->select('teamID');
        }
        $this->db->where('seasonID', $seasonID);
        $data = $this->db->get($this->_table_name)->result();

        foreach ($data as $row) {
            $teams[] = $row->teamID;
        }
        if (isset($teams)) {
            return $teams;
        }
    }

    public function get_by($seasonID, $where) {
        $this->db->where($where);
        return $this->get($seasonID);
    }

    // Save the teams to season references
    public function save($data) {

        $this->db->set($data);
        $this->db->insert($this->_table_name);
    }

    // Delete all the references 
    public function delete($seasonID) {

        $this->db->where('seasonID', $seasonID);
        $this->db->delete($this->_table_name);
    }

}
