<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\DB\Slider;

class SliderController extends Controller
{

    function __construct(Slider $slider, Agent $agent)
    {    
        //$this->middleware('auth');
        
        $this->slider = $slider;

        $this->agent = $agent;
    }

    public function index()
    {

        $view = View::make('admin.sliders.index')
                ->with('sliders', $this->slider->where('active', 1)->SimplePaginate(8))
                ->with('slider', $this->slider);

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
        $view = View::make('admin.sliders.index')
        ->with('slider', $this->slider)
        ->renderSections();

        return response()->json([
            'form' => $view['form'],
        ]);
    }

    public function store(SliderRequest $request)
    {

        $slider = Slider::updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'entity' => request('entity'),
            'visible' => 1,
            'active' => 1,
        ]);

        if (request('id')){
            $message = \Lang::get('admin/sliders.slider-update');
        }else{
            $message = \Lang::get('admin/sliders.slider-create');
        }

        $view = View::make('admin.sliders.index')
        ->with('sliders', $this->slider->where('active', 1)->get())
        ->with('slider', $slider)
        ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message,
            'id' => $slider->id        
        ]);
    }

    public function edit(Slider $slider)
    {
                
        $view = View::make('admin.sliders.index')
        ->with('slider', $slider)
        ->with('sliders', $this->slider->where('active', 1)->get());
        
        if(request()->ajax()) {
            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(Slider $slider)
    {
        $view = View::make('admin.sliders.index')
        ->with('slider', $slider)
        ->with('sliders', $this->slider->where('active', 1)->get());   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(Slider $slider)
    {   
        $slider->active = 0;
        $slider->save();

        $message = \Lang::get('admin/sliders.slider-delete');

        $view = View::make('admin.sliders.index')
            ->with('slider', $this->slider)
            ->with('sliders', $this->slider->where('active', 1)->get())
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }

    public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));
        
        $query = $this->slider->query();

        if($filters != null){

            $query->when($filters->search, function ($q, $search) {
    
                if($search == null){
                    return $q;
                }
                else {
                    return $q->where('t_sliders.name', 'like', "%$search%");
                }   
            });
    
            $query->when($filters->init_date, function ($q, $init_date) {
    
                if($init_date == 'all'){
                    return $q;
                }
                else {
                    $q->whereDate('t_sliders.created_at', '>=', $init_date);
                }   
            });
    
            $query->when($filters->final_date, function ($q, $final_date) {
    
                if($final_date == 'all'){
                    return $q;
                }
                else {
                    $q->whereDate('t_sliders.created_at', '<=', $final_date);
                }   
            });
        }
       
        if($this->agent->isMobile()){
            $sliders = $query->where('t_sliders.active', 1)
                    ->orderBy('t_sliders.id', 'asc')
                    ->paginate(10)
                    ->appends(['filters' => json_encode($filters)]);  
        }

        if($this->agent->isDesktop()){
            $sliders = $query->where('t_sliders.active', 1)
                    ->orderBy('t_sliders.id', 'asc')
                    ->paginate(6)
                    ->appends(['filters' => json_encode($filters)]);   
        }

        $view = View::make('admin.sliders.index')
            ->with('sliders', $sliders)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }
}
