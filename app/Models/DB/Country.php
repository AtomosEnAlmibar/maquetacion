<?php

namespace App\Models\DB;

class Country extends DBModel
{

    protected $table = 't_countries';

    public function directions()
    {
        return $this->hasMany(Direction::class, 'country_id');
    }
}
