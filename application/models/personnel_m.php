<?php

class Personnel_m extends MY_Model {

    protected $_table_name = 'personnel';
    protected $_order_by = 'name';
    public $rules = array(
        'name' => array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|trim|xss_clean'
        ),
        'body' => array(
            'field' => 'body',
            'label' => 'Body',
            'rules' => 'required'
        )
    );
    
    function __construct() {
        parent::__construct();
    }

    public function get_new() {
        $person = new stdClass();
        $person->name = '';
        $person->body = '';
        $person->picture = '';
        return $person;
    }

    function get_ID_array() {
        $this->db->select('id');
        $query = $this->db->get($this->_table_name);
        return $query->result();
    }

    function get_personnel_count() {
        $this->db->select('id')->from('personnel');
        $query = $this->db->get();
        return $query->num_rows();
    }

}
