<?php

namespace App\Models\DB;

class Direction extends DBModel
{

    protected $table = 't_directions';


    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
