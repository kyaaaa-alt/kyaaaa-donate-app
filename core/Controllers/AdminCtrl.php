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
                    $this->session->flash('error', 'invalid role');
                    return redirectTo(url('login'));
                }

            } else {
                $this->session->flash('error', 'Password/Email Salah!');
                return redirectTo(url('login'));
            }
        } else {
            $this->session->flash('error', 'Password/Email Salah!');
            return redirectTo(url('login'));
        }
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['paid'] = $this->AdminModel->count_paid();
        $data['total'] = $this->AdminModel->count_all();
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

    public function update_profile() {
        $file = $this->request->file('avatar');
        if ($this->request->getFileSize($file) != 0) {
            $allowedTypes = [
                'image/png' => 'png',
                'image/jpeg' => 'jpg'
            ];
            if (!$this->request->validate($file, $allowedTypes)) {
                $this->session->flash('error', 'File not allowed!');
                redirectTo(url('dashboard/settings'));
            }
            if ($this->request->getFileSize($file) >= 5) {
                $this->session->flash('error', 'Avatar Max Size 5MB');
                redirectTo(url('dashboard/settings'));
            }
            $path = 'assets/img';
            $newfilename = 'avatar.png';
            $moveFile = $this->request->move($file, $path, $newfilename, true);
        }

        $data['name'] = $this->request->post('name');
        $data['username'] = $this->request->post('username');
        $data['email'] = $this->request->post('email');
        if (!empty($this->request->post('password'))) {
            $data['password'] = password_hash($this->request->post('password'), PASSWORD_DEFAULT);
        }
        if (!empty($this->request->post('ig'))) {
            $data['ig'] = $this->request->post('ig');
        }
        if (!empty($this->request->post('fb'))) {
            $data['fb'] = $this->request->post('fb');
        }
        if (!empty($this->request->post('twitter'))) {
            $data['twitter'] = $this->request->post('twitter');
        }
        if (!empty($this->request->post('yt'))) {
            $data['yt'] = $this->request->post('yt');
        }
        if (!empty($this->request->post('twitch'))) {
            $data['twitch'] = $this->request->post('twitch');
        }
        if (!empty($this->request->post('github'))) {
            $data['github'] = $this->request->post('github');
        }
        if (!empty($this->request->post('linkedin'))) {
            $data['linkedin'] = $this->request->post('linkedin');
        }
        $update = $this->AdminModel->update_profile($data);
        if ($update) {
            $this->session->flash('success', 'Saved!');
            redirectTo(url('dashboard/settings'));
        } else {
            $this->session->flash('error', 'Failed!');
            redirectTo(url('dashboard/settings'));
        }
    }

    public function update_stream() {
        $file = $this->request->file('notif');
        if ($this->request->getFileSize($file) != 0) {
            $allowedTypes = [
                'audio/mpeg' => 'mp3'
            ];
            if (!$this->request->validate($file, $allowedTypes)) {
                $this->session->flash('error', 'File not allowed!');
                redirectTo(url('dashboard/settings'));
            }
            if ($this->request->getFileSize($file) >= 5) {
                $this->session->flash('error', 'Max Size 5MB');
                redirectTo(url('dashboard/settings'));
            }
            $path = 'assets/notif';
            $newfilename = 'notif.mp3';
            $moveFile = $this->request->move($file, $path, $newfilename, true);
            $this->session->flash('success', 'Saved!');
            redirectTo(url('dashboard/settings'));
        } else {
            $this->session->flash('error', 'No File');
            redirectTo(url('dashboard/settings'));
        }
    }

    public function update_tripay() {
        if (!empty($this->request->post('merchant_code'))) {
            $data['merchant_code'] = $this->request->post('merchant_code');
        } else {
            $this->session->flash('error', 'Fill the required fields');
            redirectTo(url('dashboard/settings'));
        }
        if (!empty($this->request->post('merchant_api_key'))) {
            $data['merchant_api_key'] = $this->request->post('merchant_api_key');
        } else {
            $this->session->flash('error', 'Fill the required fields');
            redirectTo(url('dashboard/settings'));
        }
        if (!empty($this->request->post('merchant_private_key'))) {
            $data['merchant_private_key'] = $this->request->post('merchant_private_key');
        } else {
            $this->session->flash('error', 'Fill the required fields');
            redirectTo(url('dashboard/settings'));
        }
        if (!empty($this->request->post('endpoint'))) {
            $data['endpoint'] = $this->request->post('endpoint');
        } else {
            $this->session->flash('error', 'Fill the required fields');
            redirectTo(url('dashboard/settings'));
        }
        $update = $this->AdminModel->update_settings($data);
        if ($update) {
            $this->session->flash('success', 'Saved!');
            redirectTo(url('dashboard/settings'));
        } else {
            $this->session->flash('error', 'Failed!');
            redirectTo(url('dashboard/settings'));
        }
    }

    public function update_pusher() {
        if (!empty($this->request->post('pusher_app_id'))) {
            $data['pusher_app_id'] = $this->request->post('pusher_app_id');
        } else {
            $this->session->flash('error', 'Fill the required fields');
            redirectTo(url('dashboard/settings'));
        }
        if (!empty($this->request->post('pusher_key'))) {
            $data['pusher_key'] = $this->request->post('pusher_key');
        } else {
            $this->session->flash('error', 'Fill the required fields');
            redirectTo(url('dashboard/settings'));
        }
        if (!empty($this->request->post('pusher_secret'))) {
            $data['pusher_secret'] = $this->request->post('pusher_secret');
        } else {
            $this->session->flash('error', 'Fill the required fields');
            redirectTo(url('dashboard/settings'));
        }
        if (!empty($this->request->post('pusher_cluster'))) {
            $data['pusher_cluster'] = $this->request->post('pusher_cluster');
        } else {
            $this->session->flash('error', 'Fill the required fields');
            redirectTo(url('dashboard/settings'));
        }
        $update = $this->AdminModel->update_settings($data);
        if ($update) {
            $this->session->flash('success', 'Saved!');
            redirectTo(url('dashboard/settings'));
        } else {
            $this->session->flash('error', 'Failed!');
            redirectTo(url('dashboard/settings'));
        }
    }

}