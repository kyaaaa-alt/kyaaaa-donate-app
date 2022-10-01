<?php namespace Core\Controllers;

use Core\Models\AdminModel;

class AdminCtrl {

    public function __construct() {
        $this->AdminModel = new AdminModel();
        $this->request = request();
        $this->session = session();
    }

    public function login() {
        $data['title'] = 'Login';
        return view('auth/auth', $data);
    }

    public function logout() {
        $this->session->clear();
        redirectTo(url('login'));
    }

    public function auth() {
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        $get = $this->AdminModel->get_user_by_email($email);
        if (!empty($get)) {
            $verifyPassword = password_verify($password, $get[0]->password);
            if ($verifyPassword) {
                if ($get[0]->roles == '1') {
                    $sessiondata = [
                        'isAdmin' => TRUE,
                        'name' => $get[0]->name,
                        'username' => $get[0]->username,
                        'email' => $get[0]->email,
                    ];
                    $this->session->set($sessiondata);
                    return redirectTo(url('dashboard'));
                } else {
                    $this->session->flash('notif', 'invalid role');
                    return redirectTo(url('login'));
                }

            } else {
                $this->session->flash('notif', 'Password/Email Salah!');
                return redirectTo(url('login'));
            }
        } else {
            $this->session->flash('notif', 'Password/Email Salah!');
            return redirectTo(url('login'));
        }
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['donations'] = $this->AdminModel->get_donations();
        $data['users'] = $this->AdminModel->get_users();
        return view('admin/index', $data);
    }

    public function settings() {
        $data['title'] = 'Settings';
        $data['settings'] = $this->AdminModel->get_settings();
        $data['users'] = $this->AdminModel->get_users();
        return view('settings/index', $data);
    }

}