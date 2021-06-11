<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Http\Requests\Admin\LocaleTagRequest;
use App\Vendor\Locale\Models\LocaleTag;
use Debugbar;

class LocaleTagController extends Controller
{

    function __construct(LocaleTag $locale_tag, Agent $agent)
    {    
        $this->middleware('auth');
        
        $this->locale_tag = $locale_tag;

        $this->agent = $agent;
    }

    public function index()
    {
        $tags=$this->locale_tag
                ->select('group', 'key')
                ->groupBy('group', 'key')
                ->where('active', 1)
                ->SimplePaginate(8);

        $view = View::make('admin.locale_tags.index')
                ->with('locale_tags', $tags)
                ->with('locale_tag', $this->locale_tag);

        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }

        return $view;
    }

    public function store(Request $request)
    {

        $locale_tag = LocaleTag::updateOrCreate([
            'id' => request('id')],[
            'group' => request('group'),
            'key' => request('key'),
            'value' => request('value'),
            'visible' => 1,
            'active' => 1,
        ]);

        if (request('id')){
            $message = \Lang::get('admin/locale_tags.locale_tag-update');
        }else{
            $message = \Lang::get('admin/locale_tags.locale_tag-create');
        }

        $view = View::make('admin.locale_tags.index')
        ->with('locale_tags', $this->locale_tag->where('active', 1)->get())
        ->with('locale_tag', $locale_tag)
        ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message,
            'id' => $locale_tag->id        
        ]);
    }

    public function edit($group, $key)
    {

        $tags = $this->locale_tag->where('key', $key)->where('group', str_replace('-', '/' , $group))->paginate($this->paginate); 
        $tag = $tags->first();

        $languages = $this->language->get();

        foreach($languages as $language){
            $locale = $tags->filter(function($item) use($language) {
                return $item->language == $language->alias;
            })->first();

            $tag['value.'. $language->alias] = empty($locale->value) ? '': $locale->value; 
        }
        
        $view = View::make('admin.tags.index')
        ->with('tags', $tags)
        ->with('tag', $tag);
        
        if(request()->ajax()) {
            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(LocaleTag $locale_tag)
    {
        $view = View::make('admin.locale_tags.index')
        ->with('locale_tag', $locale_tag)
        ->with('locale_tags', $this->locale_tag->where('active', 1)->get());   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(LocaleTag $locale_tag)
    {   
        $locale_tag->active = 0;
        $locale_tag->save();

        $message = \Lang::get('admin/locale_tags.locale_tag-delete');

        $view = View::make('admin.locale_tags.index')
            ->with('locale_tag', $this->locale_tag)
            ->with('locale_tags', $this->locale_tag->where('active', 1)->get())
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }

    public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));
        
        $query = $this->locale_tag->query();

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

    public function importTags()
    {
        $this->manager->importTranslations(); 
        Debugbar::info($this->manager->importTranslations());
        $message =  \Lang::get('admin/tags.tag-import');

        $tags = $this->locale_tag
        ->select('group', 'key')
        ->groupBy('group', 'key')
        ->where('group', 'not like', 'admin/%')
        ->where('group', 'not like', 'front/seo')
        ->paginate($this->paginate);  

        $view = View::make('admin.tags.index')
            ->with('tags', $tags)
            ->with('tag', $this->locale_tag);

        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'message' => $message,
            ]); 
        }
    }
}
