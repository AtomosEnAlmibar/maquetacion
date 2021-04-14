<?php

namespace App\Models\DB;

class Client extends DBModel
{

    protected $table = 't_clients';

    public function directions()
    {
        return $this->hasMany(Direction::class, 'client_id');
    }

}
