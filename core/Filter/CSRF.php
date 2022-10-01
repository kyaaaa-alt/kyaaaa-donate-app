<?php namespace Core\Filter;

class CSRF {
    public function donate() {
        if(!csrf()->isValidRequest()){
            echo json_encode([
                    'success' => false,
                    'invoice' => '',
                    'msg' => 'Invalid token: donation only accept from orign webform, not http clients']
            );
            die;
        }
    }

    public function auth() {
        if(!csrf()->isValidRequest()){
            $session = session();
            $session->flash('notif', 'invalid token');
            redirectTo(url('login'));
            exit();
        }
    }
}