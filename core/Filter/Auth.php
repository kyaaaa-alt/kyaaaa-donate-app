<?php namespace Core\Conf\Filter;

class Auth {

    public function __construct() {
        $this->session = session();
    }

    public function filter() {
        if (!$this->session->has('isLogin')) {
            redirectTo(url('login'));
        }
    }

}