<?php

class Answer_m extends MY_Model {

    protected $_table_name = 'answers';
    protected $_order_by = 'surveyID';
    public $rules = array(
        'question' => array(
            'field' => 'answer1',
            'label' => 'Answer1',
            'rules' => 'required|trim|xss_clean',
            'field' => 'answer2',
            'label' => 'Answer2',
            'rules' => 'required|trim|xss_clean',
            'field' => 'answer3',
            'label' => 'Answer3',
            'rules' => 'trim|xss_clean',
            'field' => 'answer4',
            'label' => 'Answer4',
            'rules' => 'trim|xss_clean',
            'field' => 'answer5',
            'label' => 'Answer5',
            'rules' => 'trim|xss_clean',
            'field' => 'answer6',
            'label' => 'Answer6',
            'rules' => 'trim|xss_clean',
        )
    );

    function __construct() {
        parent::__construct();
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

    function get_answer_count() {
        $this->db->select('id')->from($this->_table_name);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function add_vote($id) {
        $this->db->where('id', $id);
        $this->db->set('count', 'count+1', FALSE);
        $this->db->update($this->_table_name);
    }

    function delete($id) {
        $this->db->where('surveyID', $id);
        $this->db->delete($this->_table_name);
    }

}
