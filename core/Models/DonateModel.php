<?php namespace Core\Models;

use Core\Conf\Kyaaaa\DB;

class DonateModel {

    public function get_users() {
        $builder = DB::query('users');
        $builder->select('*');
        $query = $builder->get()[0];
        return $query;
    }

    public function get_donations() {
        $builder = DB::query('donations');
        $builder->select('*');
        $builder->where('status', 'PAID');
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();
        return $query;
    }

    public function get_settings() {
        $builder = DB::query('settings');
        $builder->select('*');
        $query = $builder->get()[0];
        return $query;
    }

}