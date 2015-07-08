<?php

class Comment_m extends MY_Model {

    protected $_table_name = 'comments';
    protected $_order_by = 'date_created desc';
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

    public function get_new() {
        $comment = new stdClass();
        $comment->body = '';
        return $comment;
    }

    function get_ID_array() {
        $this->db->select('id');
        $query = $this->db->get($this->_table_name);
        return $query->result();
    }

    function get_comments_count() {
        $this->db->select('id')->from('comments');
        $query = $this->db->get();
        return $query->num_rows();
    }

}
