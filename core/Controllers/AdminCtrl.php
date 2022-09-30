<?php namespace Core\Controllers;

class AdminCtrl {

    public function index() {
        $data['title'] = 'Docs';
        $data['subtitle'] = 'Sample Pages';
        return view('home/docs', $data);
    }

}