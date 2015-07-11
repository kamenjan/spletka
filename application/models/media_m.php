<?php

class Media_m extends MY_Model {

    protected $_table_name = 'media';
    protected $_order_by = 'date';
    public $rules = array(
        'tag' => array(
            'field' => 'tag',
            'label' => 'Tag',
            'rules' => 'required|trim|xss_clean'
        ),
        'name' => array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|trim|xss_clean'
        ),
        'fl_link' => array(
            'field' => 'fl_link',
            'label' => 'fl_link',
            'rules' => 'trim|xss_clean'
        ),
        'yt_link' => array(
            'field' => 'yt_link',
            'label' => 'yt_link',
            'rules' => 'trim|xss_clean'
        ),        
        'seasonID' => array(
            'field' => 'seasonID',
            'label' => 'SeasonID',
            'rules' => 'required|trim|xss_clean',
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
