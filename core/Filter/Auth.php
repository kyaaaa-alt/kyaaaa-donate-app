<?php namespace Core\Filter;

class Auth {

    public function __construct() {
        $this->session = session();
    }

    public function admin() {
        if (!$this->session->has('isAdmin')) {
            redirectTo(url('login'));
        }
    }

}