<?php

namespace App\Http\Controllers\Admin;

use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Models\DB\Client;

class ClientController extends Controller
{
    protected $client;

    function __construct(Client $client)
    {
        //$this->middleware('auth');

        $this->client = $client;
    }

    public function indexJson(Request $request)
    {
        $length = $request->input('length');
        $orderBy = $request->input('column'); 
        $orderByDir = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        
        $query = $this->client->eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data = $query->paginate($length);
        
        return new DataTableCollectionResource($data);
    }

    public function index()
    {

        $view = View::make('admin.clients.index')
                ->with('client', $this->client)
                ->with('clients', $this->client->where('active', 1)->get());

        if(request()->ajax()) {
            
            $sections = $view->renderSections(); 
            
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }

        return $view;
    }

    public function create()
    {

        $view = View::make('admin.clients.index')
        ->with('client', $this->client)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(ClientRequest $request)
    {            
        $client = $this->client->updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'password' => bcrypt(request('password')),            
            'active' => 1,
        ]);

        $view = View::make('admin.clients.index')
        ->with('clients', $this->client->where('active', 1)->get())
        ->with('client', $client)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $client->id,
        ]);
    }

    public function show(Client $client)
    {
        $view = View::make('admin.clients.index')
        ->with('client', $client)
        ->with('clients', $this->client->where('active', 1)->get());   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(Client $client)
    {
        $client->active = 0;
        $client->save();

        // $client->delete();

        $view = View::make('admin.clients.index')
            ->with('client', $this->client)
            ->with('clients', $this->client->where('active', 1)->get())
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }
}
