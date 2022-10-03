<?php namespace Core\Models;

use Core\Conf\Kyaaaa\DB;

class AdminModel {

    public function get_user_by_email($email) {
        $builder = DB::query('users');
        $builder->select('*');
        $builder->where('email', $email);
        $query = $builder->get();
        return $query;
    }

    public function get_donations() {
        $builder = DB::query('donations');
        $builder->select('*');
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();
        return $query;
    }

    public function get_users() {
        $builder = DB::query('users');
        $builder->select('*');
        $query = $builder->get()[0];
        return $query;
    }

    public function get_settings() {
        $builder = DB::query('settings');
        $builder->select('*');
        $query = $builder->get()[0];
        return $query;
    }

    public function update_profile($data) {
        $builder = DB::query('users');
        $builder->update($data);
        $query = $builder->save();
        return $query;
    }

    public function update_settings($data) {
        $builder = DB::query('settings');
        $builder->update($data);
        $query = $builder->save();
        return $query;
    }

    public function count_paid() {
        $builder = DB::query('donations');
        $builder->select('COUNT(id) as total');
        $builder->where('status', 'PAID');
        $query = $builder->get()[0]->total;
        return $query;
    }

    public function count_all() {
        $builder = DB::query('donations');
        $builder->select('COUNT(id) as total');
        $query = $builder->get()[0]->total;
        return $query;
    }

    public function total_paid_donation() {
        $builder = DB::query('donations');
        $builder->select('SUM(amount) as total');
        $builder->where('status', 'PAID');
        $query = $builder->get()[0]->total;
        return $query;
    }

}