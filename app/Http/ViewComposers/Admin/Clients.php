<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Client as Client;

class Clients
{
    public $clients;

    public function __construct()
    {
        $this->clients = Client::orderBy('name', 'asc')->get();
    }

    public function compose(View $view)
    {
        $view->with('clients', $this->clients);
    }
}