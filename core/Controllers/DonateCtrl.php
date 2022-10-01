<?php namespace Core\Controllers;

use Core\Models\DonateModel;

class DonateCtrl {
    public function __construct() {
        $this->DonateModel = new DonateModel();
        $this->request = request();
    }

    public function index() {
        $username = $this->DonateModel->get_username();
        $data['title'] = 'Dukung @' . $username;
        $data['username'] = $username;
        $data['donations'] = $this->DonateModel->get_donations();
        return view('donate/index', $data);
    }

}