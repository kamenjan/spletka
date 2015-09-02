<?php

class Post_m extends MY_Model {
    /*
     * TODO:
     * 1. Set form rules for posts (url link, file links, tinyMCE text) 
     */

    protected $_table_name = 'posts';
    protected $_order_by = 'date_created desc';
    public $rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ),
        'tag' => array(
            'field' => 'tag',
            'label' => 'Tag',
            'rules' => 'required'
        ),
        'date_event' => array(
            'field' => 'date_event',
            'label' => 'Date',
            'rules' => ''
        ),
        'body' => array(
            'field' => 'body',
            'label' => 'Body',
            'rules' => 'trim|required|xss_clean'
        ),
        'fb_link' => array(
            'field' => 'fb_link',
            'label' => 'fb_link',
            'rules' => ''
        ),
        'yt_link' => array(
            'field' => 'yt_link',
            'label' => 'yt_link',
            'rules' => ''
        ),
        'fl_link' => array(
            'field' => 'fb_link',
            'label' => 'fb_link',
            'rules' => ''
        ),
    );

    function __construct() {
        parent::__construct();
    }

    public function get_new() {
        $post = new stdClass();
        $post->title = '';
        $post->tag = 'article';
        $post->date_event = '';
        $post->body = '';
        $post->fb_link = '';
        $post->yt_link = '';
        $post->fl_link = '';
        return $post;
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

    function get_announcements() {
        $this->db->order_by("date_created", "desc");
        $this->db->select('id, tag, title, date_created, author');
        $this->db->where(['approved' => 'true', 'tag' => 'announcement']);
        //$this->db->where('approved =', 'true');
        $this->db->limit(3);
        return $this->db->get($this->_table_name)->result();
    }

    // Returns post that are 'news' or 'report' for home page
    function get_home() {
        $this->db->where('approved =', 'true');
        $this->db->where('tag =', 'news');
        $this->db->or_where('tag =', 'report');
        $this->db->or_where('tag =', 'announcement');
        $this->db->order_by("date_created", "desc");

        return $this->db->get($this->_table_name)->result();
    }

    // Returns days on which events occur for parameters $start and $end (of month)
    function get_calendar($start, $end) {

        $this->db->select('date_event');
        $this->db->where('date_event >', $start);
        $this->db->where('date_event <', $end);
        $this->db->where('approved =', 'true');

        return $this->db->get($this->_table_name)->result_array();
    }

}
