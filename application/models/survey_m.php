<?php

class Survey_m extends MY_Model {

    protected $_table_name = 'surveys';
    protected $_order_by = 'date_created desc';
    protected $_timestamps = TRUE;
    public $rules = array(
        'question' => array(
            'field' => 'question',
            'label' => 'Question',
            'rules' => 'required|trim|xss_clean'
        )
    );

    function __construct() {
        parent::__construct();
    }

    public function activate($id) {
        
        $now = date('Y-m-d H:i:s');
                
        $deactivate = ['status' => 'finished', 'date_modified' => $now];
        $this->db->where(['status' => 'active']);
        $this->db->update($this->_table_name, $deactivate);

        $activate = ['status' => 'active', 'date_modified' => $now];
        $this->db->where($this->_primary_key, $id);
        $this->db->update($this->_table_name, $activate);
    }

    public function get_new() {
        $survey = new stdClass();
        $survey->question = '';
        return $survey;
    }

    function get_ID_array() {
        $this->db->select('id');
        $query = $this->db->get($this->_table_name);
        return $query->result();
    }

    function get_personnel_count() {
        $this->db->select('id')->from($this->_table_name);
        $query = $this->db->get();
        return $query->num_rows();
    }

}
