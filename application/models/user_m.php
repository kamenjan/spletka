<?php

class User_m extends MY_Model {

    protected $_table_name = 'users';
    protected $_order_by = 'name';

    /*
     * Login rules
     */
    public $rules = array(
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|xss_clean'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        )
    );

    /*
     * Admin rules (edit user)
     */
    public $rules_edit = array(
        'name' => array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean'
        ),
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|xss_clean'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|matches[password_confirm]|xss_clean'
        ),
        'password_confirm' => array(
            'field' => 'password_confirm',
            'label' => 'Confirm password',
            'rules' => 'matches[password]'
        ),
    );

    function __construct() {
        parent::__construct();
    }

    // TODO Seperate design based cookies and backend cookies !! 
    public function login() {
        $user = $this->get_by([
            'email' => $this->input->post('email'),
            'password' => $this->hash($this->input->post('password')),
                ], TRUE);

        if (count($user)) {
            // Log in user
            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id,
                'type' => $user->type,
                'loggedin' => TRUE,
            ];
            $this->session->set_userdata($data);
        }
    }

    public function logout() {
        $active_user_data = [
                'name' => '',
                'email' => '',
                'id' => '',
                'type' => '',
                'loggedin' => ''
            ];

        $this->session->unset_userdata($active_user_data);
    }

    public function loggedin() {
        return (bool) $this->session->userdata('loggedin');
    }

    public function array_from_post($fields) {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    public function get_new() {
        $user = new stdClass();
        $user->name = '';
        $user->email = '';
        $user->password = '';
        return $user;
    }

    public function hash($string) {
        return sha1($string);
    }

}
