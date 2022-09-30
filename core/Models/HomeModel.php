<?php namespace Core\Models;

use Core\Conf\Kyaaaa\DB;

class HomeModel {
    public function __construct() {
        $this->users = DB::query('users');
    }

    public function get_username() {
        $builder = $this->users;
        $builder->select('username');
        $query = $builder->get()[0]->username;
        return $query;
    }

}