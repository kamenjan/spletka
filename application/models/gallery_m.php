<?php

class Gallery_m extends MY_Model {

    protected $_table_name = 'galleries';
    protected $_order_by = 'date';
    public $rules = array(
        'name' => array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|trim|xss_clean'
        ),
        'fl_link' => array(
            'field' => 'fl_link',
            'label' => 'fl_link',
            'rules' => 'required'
        ),
        'date' => array(
            'field' => 'date',
            'label' => 'Date',
            'rules' => 'required'
        ),
        'seasonID' => array(
            'field' => 'seasonID',
            'label' => 'SeasonID',
            'rules' => ''
        )
    );
    function __construct() {
        parent::__construct();
    }

    public function get_new() {
        $gallery = new stdClass();
        $gallery->name = '';
        $gallery->fl_link = '';
        $gallery->date = '';
        $gallery->seasonID = '';
        $gallery->season_name = '';
        return $gallery;
    }

    function get_ID_array() {
        $this->db->select('id');
        $query = $this->db->get($this->_table_name);
        return $query->result();
    }

    function get_gallery_count() {
        $this->db->select('id')->from('gallery');
        $query = $this->db->get();
        return $query->num_rows();
    }

}
