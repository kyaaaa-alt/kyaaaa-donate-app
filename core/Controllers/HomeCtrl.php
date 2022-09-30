<?php namespace Core\Controllers;

use Core\Models\HomeModel;

class HomeCtrl {
    public function __construct() {
        $this->HomeModel = new HomeModel();
    }

    public function index() {
        $username = $this->HomeModel->get_username();
        $data['title'] = 'Dukung @' . $username;
        $data['username'] = $username;
        return view('home/index', $data);
    }

    public function login() {
        $data['title'] = 'Hello World';
        $data['subtitle'] = 'Kyaaaa-PHP Framework';
        return view('home/index', $data);
    }

}