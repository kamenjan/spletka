<?php

class Team_m extends MY_model {

    protected $_table_name = 'teams';
    protected $_order_by = 'id desc';
    public $rules = array(
        'name' => array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean'
        ),
        'description' => array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'required|required|xss_clean'
        ),
        'school' => array(
            'field' => 'school',
            'label' => 'School',
            'rules' => 'trim|required|xss_clean'
        ),
        'picture' => array(
            'field' => 'picture',
            'label' => 'Picture',
            'rules' => ''
        )
    );

    function __construct() {
        parent::__construct();
    }

    
    public function get_new() {
        $team = new stdClass();
        $team ->name = '';
        $team->description = '';
        $team->school = '';
        $team->picture = 'noimage.jpg';
        return $team;
    }

    function get_ID_array() {
        $this->db->select('id');
        $query = $this->db->get($this->_table_name);
        return $query->result();
    }

    function get_post_count() {
        $this->db->select('id')->from('posts');
        $query = $this->db->get();
        return $query->num_rows();
    }

}
