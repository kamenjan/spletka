<?php

class Media_m extends MY_Model {

    protected $_table_name = 'media';
    protected $_order_by = 'date';
    public $rules = array(
        'name' => array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|trim|xss_clean'
        ),
        'link' => array(
            'field' => 'link',
            'label' => 'link',
            'rules' => 'required|trim|xss_clean'
        ),
        'date' => array(
            'field' => 'date',
            'label' => 'Date',
            'rules' => 'required'
        )
    );
    
    function __construct() {
        parent::__construct();
    }

    public function get_new() {
        $media = new stdClass();
        $media->name = '';
        $media->tag = '';
        $media->link = '';
        $media->date = '';
        $media->seasonID = '';
        $media->season_name = '';
        return $media;
    }

    function get_ID_array() {
        $this->db->select('id');
        $query = $this->db->get($this->_table_name);
        return $query->result();
    }

    function get_media_count() {
        $this->db->select('id')->from('media');
        $query = $this->db->get();
        return $query->num_rows();
    }

}
