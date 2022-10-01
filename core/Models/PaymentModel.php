<?php namespace Core\Models;

use Core\Conf\Kyaaaa\DB;

class PaymentModel {

    public function save_donation($data) {
        $builder = DB::query('donations');
        $builder->insert($data);
        $query = $builder->save();
        return $query;
    }

}