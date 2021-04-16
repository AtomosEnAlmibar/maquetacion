<?php

namespace App\Http\Controllers\Admin;

use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DirectionRequest;
use App\Models\DB\Direction;

class DirectionController extends Controller
{
    protected $direction;

    function __construct(Direction $direction)
    {
        //$this->middleware('auth');

        $this->direction = $direction;
    }

    public function indexJson(Request $request)
    {
        $length = $request->input('length');
        $orderBy = $request->input('column'); 
        $orderByDir = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        
        $query = $this->direction->eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data = $query->paginate($length);
        
        return new DataTableCollectionResource($data);
    }

    public function index()
    {

        $view = View::make('admin.directions.index')
                ->with('direction', $this->direction)
                ->with('directions', $this->direction->where('active', 1)->get());

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

        $view = View::make('admin.directions.index')
        ->with('direction', $this->direction)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(DirectionRequest $request)
    {            
        $direction = $this->direction->updateOrCreate([
            'id' => request('id')],[
            'client_id' => request('client_id'),
            'country_id' => request('country_id'),
            'state' => request('state'),
            'city' => request('city'),
            'address' => request('address'),
            'postal_code' => request('postal_code'),            
            'active' => 1,
        ]);

        $view = View::make('admin.directions.index')
        ->with('directions', $this->direction->where('active', 1)->get())
        ->with('direction', $direction)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $direction->id,
        ]);
    }

    public function edit(Direction $direction)
    {
                
        $view = View::make('admin.directions.index')
        ->with('direction', $direction)
        ->with('directions', $this->direction->where('active', 1)->get());
        
        if(request()->ajax()) {
            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(Direction $direction)
    {
        $view = View::make('admin.directions.index')
        ->with('direction', $direction)
        ->with('directions', $this->direction->where('active', 1)->get());   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(Direction $direction)
    {
        $direction->active = 0;
        $direction->save();

        // $direction->delete();

        $view = View::make('admin.directions.index')
            ->with('direction', $this->direction)
            ->with('directions', $this->direction->where('active', 1)->get())
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }
}
