<?php namespace Core\Models;

use Core\Conf\Kyaaaa\DB;

class DonateModel {
    public function __construct() {
        $this->donations = DB::query('donations');
    }

    public function save_donation($data) {
        $builder = $this->donations;
        $builder->insert($data);
        $query = $builder->save();
        return $query;
    }

}