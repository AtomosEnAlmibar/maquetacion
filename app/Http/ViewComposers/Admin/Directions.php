<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Direction as Direction;

class Directions
{
    public $directions;

    public function __construct()
    {
        $this->directions = Direction::orderBy('client_id', 'asc')->get();
    }

    public function compose(View $view)
    {
        $view->with('directions', $this->directions);
    }
}