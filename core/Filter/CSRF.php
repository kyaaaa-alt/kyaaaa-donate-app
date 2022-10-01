<?php namespace Core\Filter;

class CSRF {
    public function donate() {
        if(!csrf()->isValidRequest()){
            echo json_encode([
                    'success' => false,
                    'invoice' => '',
                    'msg' => 'Invalid token: reload this page (donation only accept from orign webform) not http clients']
            );
            die;
        }
    }
}