<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Http\Requests\Admin\LeechRequest;
use App\Vendor\Locale\Locale;
use App\Vendor\Image\Image;
use App\Models\DB\Leech; 
use Debugbar;

class LeechController extends Controller
{
    protected $agent;
    protected $locale;
    protected $image;
    protected $paginate;
    protected $leech;

    function __construct(Leech $leech, Agent $agent, Locale $locale, Image $image)
    {
        $this->middleware('auth');
        $this->agent = $agent;
        $this->locale = $locale;
        $this->image = $image;
        $this->leech = $leech;
        $this->leech->visible = 1;

        if ($this->agent->isMobile()) {
            $this->paginate = 10;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 6;
        }

        $this->locale->setParent('leeches');
        $this->image->setEntity('leeches');
    }

    public function index()
    {
        $view = View::make('admin.leeches.index')
        ->with('leech', $this->leech)
        ->with('leeches', $this->leech->where('active', 1)
        ->orderBy('created_at', 'desc')
        ->paginate($this->paginate));
    
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
        $view = View::make('admin.leeches.index')
        ->with('leech', $this->leech)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(LeechRequest $request)
    {                              
        Debugbar::info(request('seo'));
        
        $leech = $this->leech->updateOrCreate([
            'id' => request('id')],[
            'category_id' => request('category_id'),
            'title' => request('title'),
            'visible' => request('visible') == "true" ? 1 : 0 ,
            'active' => 1,                    
        ]);

        if(request('locale')){
            $locale = $this->locale->store(request('locale'), $leech->id);
        }

        if(request('images')){
            $images = $this->image->storeRequest(request('images'), 'webp', $leech->id);
        }

        if (request('id')){
            $message = \Lang::get('admin/leeches.leech-update');
        }else{
            $message = \Lang::get('admin/leeches.leech-create');
        }

        $view = View::make('admin.leeches.index')
        ->with('leeches', $this->leech->where('active', 1)->orderBy('created_at', 'desc')->paginate($this->paginate))
        ->with('leech', $leech)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message,
            'id' => $leech->id,
        ]);
    }

    public function edit(Leech $leech)
    {
        $locale = $this->locale->show($leech->id);

        $view = View::make('admin.leeches.index')
        ->with('locale', $locale)
        ->with('leech', $leech)
        ->with('leeches', $this->leech->where('active', 1)->orderBy('created_at', 'desc')->paginate($this->paginate));        
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(Leech $leech){

        $view = View::make('admin.leeches.index')
        ->with('leech', $leech)
        ->with('leeches', $this->leech->where('active', 1)->orderBy('created_at', 'desc')->paginate($this->paginate))
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }

    public function destroy(Leech $leech)
    {
        $leech->active = 0;
        $leech->save();

        $message = \Lang::get('admin/leeches.leech-delete');

        $view = View::make('admin.leeches.index')
        ->with('leech', $this->leech)
        ->with('leeches', $this->leech->where('active', 1)->orderBy('created_at', 'desc')->paginate($this->paginate))
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message
        ]);
    }

    public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));
        
        $query = $this->leech->query();

        if($filters != null){
    
            $query->when($filters->search, function ($q, $search) {
    
                if($search == null){
                    return $q;
                }
                else {
                    return $q->where('t_leeches.title', 'like', "%$search%");
                }   
            });
    
            $query->when($filters->init_date, function ($q, $init_date) {
    
                if($init_date == 'all'){
                    return $q;
                }
                else {
                    $q->whereDate('t_leeches.created_at', '>=', $init_date);
                }   
            });
    
            $query->when($filters->final_date, function ($q, $final_date) {
    
                if($final_date == 'all'){
                    return $q;
                }
                else {
                    $q->whereDate('t_leeches.created_at', '<=', $final_date);
                }   
            });
        }
       
        if($this->agent->isMobile()){
            $leeches = $query->where('t_leeches.active', 1)
                    ->orderBy('t_leeches.id', 'asc')
                    ->paginate(10)
                    ->appends(['filters' => json_encode($filters)]);  
        }

        if($this->agent->isDesktop()){
            $leeches = $query->where('t_leeches.active', 1)
                    ->orderBy('t_leeches.di', 'asc')
                    ->paginate(6)
                    ->appends(['filters' => json_encode($filters)]);   
        }

        $view = View::make('admin.leeches.index')
            ->with('leeches', $leeches)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }
}
