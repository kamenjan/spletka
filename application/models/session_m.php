<?php

class Session_m extends MY_Model {

    protected $_table_name = 'ci_sessions';

    function __construct() {
        parent::__construct();
    }

    function update() {
        // go Through all the sessions and remove answerd suervey true
        $this->db->get($this->_table_name)->$method();
    }

}
