<?php namespace Core\Controllers;

use Core\Models\DonateModel;

class DonateCtrl {
    public function __construct() {
        $this->DonateModel = new DonateModel();
        $this->request = request();
    }

    public function index() {
        $getusers = $this->DonateModel->get_users();
        $data['title'] = 'Dukung @' . $getusers->username;
        $data['username'] = $getusers->username;
        $data['users'] = $getusers;
        $data['donations'] = $this->DonateModel->get_donations();
        return view('donate/index', $data);
    }

    public function donate_notification() {
        $data['settings'] = $this->DonateModel->get_settings();
        return view('streamoverlay/donatenotification/index', $data);
    }

    public function test_notification() {
        $loadpusher = new \Core\Conf\Kyaaaa\Tripay();  // correct
        $pusher = $loadpusher->pusher();
        $push['name'] = 'Seseorang';
        $push['amount'] = 'Rp 1.000.000.000';
        $push['jumlah'] = '1000000000';
        $push['msgs'] = 'Ini adalah test, notifikasi donasi siap digunakan!';

        $pusher->trigger('my_stream', 'donate_event', $push);
        session()->flash('success', 'Ok!');
        redirectTo(url('dashboard/settings'));
    }

    public function running_text() {
        $get_donations = $this->DonateModel->get_donations();
        $data['donations'] = json_decode(json_encode($get_donations), true);
        return view('streamoverlay/runningtext/index', $data);
    }

}