<?php

class Admin_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->data['meta_title'] = '';
        
        // Set exception admin urls, that can be accessed 
        $exception_uris = [
            'admin/user/login'
        ];
        if (in_array(uri_string(), $exception_uris) == FALSE) {
            if ($this->user_m->loggedin() == FALSE) {
                redirect('admin/user/login');
            }
        }

        // Set $data (sent to views) account type, so certain (delete) buttons can be hidden
        $this->data['account_type'] = $this->session->userdata('type');

        // Assign modal views for use through out the admin views
        $this->data['delete_modal'] = 'admin/components/delete_confirm';
    }

    function correct_permissions($required) {
        $user_type = $this->session->userdata('type');
        if ($required == "editor") {
            if ($user_type) {
                return true;
            }
        } elseif ($required == "admin") {
            if ($user_type == "admin") {
                return true;
            }
        }
    }

    function resize_image($path, $file, $controller) {
        $config = [
            'image_library' => 'gd2',
            'source_image' => $path,
            'create_thumb' => TRUE,
            'maintain_ratio' => TRUE,
            'width' => 300,
            'height' => 200,
                //'new_image' => './assets/uploads/' . $controller . '_img/' . $file . $extension
        ];

        //dump_exit($config);

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        unlink($path);
    }


}
