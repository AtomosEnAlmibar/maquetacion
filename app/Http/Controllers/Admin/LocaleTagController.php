<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Http\Requests\Admin\LocaleTagRequest;
use App\Vendor\Locale\Models\LocaleTag;

class LocaleTagController extends Controller
{

    function __construct(LocaleTag $localeTag, Agent $agent)
    {    
        //$this->middleware('auth');
        
        $this->localeTag = $localeTag;

        $this->agent = $agent;
    }

    public function index()
    {
        $tags=$this->localeTag
                ->select('group', 'key')
                ->groupBy('group', 'key')
                ->where('active', 1)
                ->SimplePaginate(8);

        $view = View::make('admin.locale_tags.index')
                ->with('locale_tags', $tags)
                ->with('localeTag', $this->localeTag);

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
        $view = View::make('admin.locale_tags.index')
        ->with('localeTag', $this->localeTag)
        ->renderSections();

        return response()->json([
            'form' => $view['form'],
        ]);
    }

    public function store(LocaleTagRequest $request)
    {

        $localeTag = LocaleTag::updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'entity' => request('entity'),
            'visible' => 1,
            'active' => 1,
        ]);

        if (request('id')){
            $message = \Lang::get('admin/locale_tags.localeTag-update');
        }else{
            $message = \Lang::get('admin/locale_tags.localeTag-create');
        }

        $view = View::make('admin.locale_tags.index')
        ->with('locale_tags', $this->localeTag->where('active', 1)->get())
        ->with('localeTag', $localeTag)
        ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message,
            'id' => $localeTag->id        
        ]);
    }

    public function edit(LocaleTag $localeTag)
    {
                
        $view = View::make('admin.locale_tags.index')
        ->with('localeTag', $localeTag)
        ->with('locale_tags', $this->localeTag->where('active', 1)->get());
        
        if(request()->ajax()) {
            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(LocaleTag $localeTag)
    {
        $view = View::make('admin.locale_tags.index')
        ->with('localeTag', $localeTag)
        ->with('locale_tags', $this->localeTag->where('active', 1)->get());   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(LocaleTag $localeTag)
    {   
        $localeTag->active = 0;
        $localeTag->save();

        $message = \Lang::get('admin/locale_tags.localeTag-delete');

        $view = View::make('admin.locale_tags.index')
            ->with('localeTag', $this->localeTag)
            ->with('locale_tags', $this->localeTag->where('active', 1)->get())
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }

    public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));
        
        $query = $this->localeTag->query();

        if($filters != null){

            $query->when($filters->search, function ($q, $search) {
    
                if($search == null){
                    return $q;
                }
                else {
                    return $q->where('t_locale_tags.name', 'like', "%$search%");
                }   
            });
    
            $query->when($filters->init_date, function ($q, $init_date) {
    
                if($init_date == 'all'){
                    return $q;
                }
                else {
                    $q->whereDate('t_locale_tags.created_at', '>=', $init_date);
                }   
            });
    
            $query->when($filters->final_date, function ($q, $final_date) {
    
                if($final_date == 'all'){
                    return $q;
                }
                else {
                    $q->whereDate('t_locale_tags.created_at', '<=', $final_date);
                }   
            });
        }
       
        if($this->agent->isMobile()){
            $locale_tags = $query->where('t_locale_tags.active', 1)
                    ->orderBy('t_locale_tags.id', 'asc')
                    ->paginate(10)
                    ->appends(['filters' => json_encode($filters)]);  
        }

        if($this->agent->isDesktop()){
            $locale_tags = $query->where('t_locale_tags.active', 1)
                    ->orderBy('t_locale_tags.id', 'asc')
                    ->paginate(6)
                    ->appends(['filters' => json_encode($filters)]);   
        }

        $view = View::make('admin.locale_tags.index')
            ->with('locale_tags', $locale_tags)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }
}
