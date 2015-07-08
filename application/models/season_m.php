<?php

class Season_m extends MY_Model {

    protected $_table_name = 'seasons';
    protected $_order_by = 'start desc';

    /*
     * TODO:
     *      1. Set form rules for seasons (url link, file links, tinyMCE text) 
     *      2. 
     */
    public $rules = array(
        'body' => array(
            'field' => 'body',
            'label' => 'Body',
            'rules' => 'required|trim|xss_clean'
        )
    );

    function __construct() {
        parent::__construct();
    }

    function get_archive() {
        
        $method = 'result'; // 'result_array'
        $now = date('Y-m-d H:i:s');
        
        //$this->db->where('date_event >', $start);
        $this->db->where('end <', $now);

        return $this->db->get($this->_table_name)->$method();
    }

    function get_ID_by_date($date) {

        $event_timestamp = strtotime($date);

        $query = $this->db->get($this->_table_name);
        $seasons = $query->result();

        foreach ($seasons as $season) {
            $season_start_timestamp = strtotime($season->start);
            $season_end_timestamp = strtotime($season->end);
            if ($event_timestamp > $season_start_timestamp && $event_timestamp < $season_end_timestamp) {
                return $season->id;
            }
        }
    }

    function get_ID_array() {
        $this->db->select('id');
        $query = $this->db->get($this->_table_name);
        return $query->result();
    }

    function get_season_count() {
        $this->db->select('id')->from('seasons');
        $query = $this->db->get();
        return $query->num_rows();
    }

}
