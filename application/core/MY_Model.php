<?php

/**
 * MY_Model class is a core model that defines all the basic CRUD operations. 
 * Low level table specific models extend this model and implement all the
 * fields and functionality.  
 * 
 * @author Rok Arih
 */
class MY_Model extends CI_Model {

    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public $rules = array();
    protected $_timestamps = FALSE;

    function __construct() {
        parent::__construct();
    }

    public function get($id = NULL, $single = FALSE) {

        if ($id != NULL) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        } elseif ($single == TRUE) {
            $method = 'row';
        } else {
            $method = 'result';
        }

        /*
         * This conditiona checks if db->orderby() has already been set.
         * If not, use the models default $_order_by value
         */
        if (!count($this->db->ar_orderby)) {
            $this->db->order_by($this->_order_by);
        }
        return $this->db->get($this->_table_name)->$method();
    }

    public function get_by($where, $single = FALSE) {
        $this->db->where($where);
        return $this->get(NULL, $single);
    }

    public function save($data, $id = NULL) {

        // Set timestamps
        if ($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $id || $data['date_created'] = $now;
            $data['date_modified'] = $now;
        }

        // Insert
        if ($id === NULL) {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $id = $this->db->insert_id();
        }
        // Update
        else {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }

        return $id;
    }

//    public function test() {
//        dump_exit(strtolower(get_class()));
//        if (strtolower(get_class()) == 'people') {
//            $filepath = './assets/uploads/post_img/' . $filename;
//        }
//    }


    /*
     * TODO repair function so it also deletes personnel image
     */
    public function delete($_id) {
        $filter = $this->_primary_filter;
        $id = $filter($_id);

        if (!$id) {
            return FALSE;
        }

        // if picture reference is set, delete the file
        if (isset($this->get_by(['id' => $_id])[0]->picture)) {
            $filename = $this->get_by(['id' => $_id])[0]->picture;
            $filepath;

            // team_img folder
            if (isset($this->get_by(['id' => $_id])[0]->name)) {
                $filepath = './assets/uploads/team_img/' . $filename;
            }
            // post_img folder
            if (isset($this->get_by(['id' => $_id])[0]->title)) {
                $filepath = './assets/uploads/post_img/' . $filename;
            }
            // person_img folder
            if (strtolower(get_class()) == 'people') {
                $filepath = './assets/uploads/post_img/' . $filename;
            }
            $this->delete_picture($filepath);
        }

        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);
    }

    public function approve($id) {
        $data = ['approved' => 'true'];
        $this->db->where($this->_primary_key, $id);
        $this->db->update($this->_table_name, $data);
    }

    public function array_from_post($fields) {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    public function delete_picture($filepath) {
        // Make sure it does not delete default noimage.jpg picture
        if (strpos($filepath, 'noimage') === false) {
            unlink($filepath);
        }
    }

}
