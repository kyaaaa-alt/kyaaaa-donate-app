<?php namespace Core\Models;

use Core\Conf\Kyaaaa\DB;

class PaymentModel {

    public function save_donation($data) {
        $builder = DB::query('donations');
        $builder->insert($data);
        $query = $builder->save();
        return $query;
    }

    public function get_merchant_ref($merchant_ref) {
        $builder = DB::query('donations');
        $builder->select('*');
        $builder->where('merchant_ref', $merchant_ref);
        $query = $builder->get();
        return $query;
    }

    public function update_donation($merchant_ref, $status) {
        $builder = DB::query('donations');
        $builder->update(['status' => $status]);
        $builder->where('merchant_ref', $merchant_ref);
        $query = $builder->save();
        return $query;
    }

    public function get_settings() {
        $builder = DB::query('settings');
        $builder->select('*');
        $query = $builder->get()[0];
        return $query;
    }

}