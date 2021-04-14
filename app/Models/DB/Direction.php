<?php

namespace App\Models\DB;

class Direction extends DBModel
{

    protected $table = 't_directions';


    public function clients() {

        return $this->belongsTo(Client::class);

    }
}
