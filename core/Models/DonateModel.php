<?php namespace Core\Models;

use Core\Conf\Kyaaaa\DB;

class DonateModel {

    public function get_username() {
        $builder = DB::query('users');
        $builder->select('username');
        $query = $builder->get()[0]->username;
        return $query;
    }

    public function get_donations() {
        $builder = DB::query('donations');
        $builder->select('*');
        $builder->where('status', 'PAID');
        $query = $builder->get();
        return $query;
    }

}