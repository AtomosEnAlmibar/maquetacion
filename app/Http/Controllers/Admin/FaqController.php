<?php

namespace App\Http\Controllers\Admin;

use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Http\Requests\Admin\FaqRequest;
use App\Vendor\Locale\Locale;
use App\Models\DB\Faq;
use Debugbar;

class FaqController extends Controller
{
    protected $faq;
    protected $locale;

    function __construct(Faq $faq,Agent $agent, Locale $locale)
    {
        //$this->middleware('auth');

        $this->faq = $faq;
        $this->locale = $locale;
        $this->agent = $agent;

        //$this->locale->setParent('faqs');
        //$this->image->setEntity('faqs');
    }

    public function indexJson(Request $request)
    {
        $length = $request->input('length');
        $orderBy = $request->input('column'); 
        $orderByDir = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        
        $query = $this->faq->eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data = $query->paginate($length);
        
        return new DataTableCollectionResource($data);
    }

    public function index()
    {

        $view = View::make('admin.faqs.index')
                ->with('faq', $this->faq)
                ->with('faqs', $this->faq->where('active', 1)->paginate(10));

        if(request()->ajax()) {
            
            $sections = $view->renderSections(); 
            
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],                
                'datos' => $sections['datos'],
            ]); 
        }        
        return $view;
    }

    public function create()
    {

        $view = View::make('admin.faqs.index')
        ->with('faq', $this->faq)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(FaqRequest $request)
    {            
        $faq = $this->faq->updateOrCreate([
            'id' => request('id')],[
            'category_id' => request('category_id'),
            'title' => request('title'),
            'description' => request('description'),
            'active' => 1,
        ]);

        if(request('locale')){
            $locale = $this->locale->store(request('locale'), $faq->id);
        }

        if (request('id')){
            $message = \Lang::get('admin/faqs.faq-update');
        }else{
            $message = \Lang::get('admin/faqs.faq-create');
        }

        $view = View::make('admin.faqs.index')
        ->with('faqs', $this->faq->where('active', 1)->get())
        ->with('faq', $faq)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message,
            'id' => $faq->id,
        ]);
    }

    public function show(Faq $faq)
    {
        $view = View::make('admin.faqs.index')
        ->with('faq', $faq)
        ->with('faqs', $this->faq->where('active', 1)->get());   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(Faq $faq)
    {
        $faq->active = 0;
        $faq->save();

        // $faq->delete();

        $message = \Lang::get('admin/faqs.faq-delete');

        $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with('faqs', $this->faq->where('active', 1)->get())
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message
        ]);
    }

    public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));
        
        $query = $this->faq->query();

        if($filters != null){

            $query->when($filters->category_id, function ($q, $category_id) {

                if($category_id == 'all'){
                    return $q;
                }
                else{
                    return $q->where('category_id', $category_id);
                }
            });
    
            $query->when($filters->search, function ($q, $search) {
    
                if($search == null){
                    return $q;
                }
                else {
                    return $q->where('t_faqs.title', 'like', "%$search%");
                }   
            });
    
            $query->when($filters->init_date, function ($q, $init_date) {
    
                if($init_date == 'all'){
                    return $q;
                }
                else {
                    $q->whereDate('t_faqs.created_at', '>=', $init_date);
                }   
            });
    
            $query->when($filters->final_date, function ($q, $final_date) {
    
                if($final_date == 'all'){
                    return $q;
                }
                else {
                    $q->whereDate('t_faqs.created_at', '<=', $final_date);
                }   
            });
        }
       
        if($this->agent->isMobile()){
            $faqs = $query->where('t_faqs.active', 1)
                    ->orderBy('t_faqs.id', 'asc')
                    ->paginate(10)
                    ->appends(['filters' => json_encode($filters)]);  
        }

        if($this->agent->isDesktop()){
            $faqs = $query->where('t_faqs.active', 1)
                    ->orderBy('t_faqs.di', 'asc')
                    ->paginate(6)
                    ->appends(['filters' => json_encode($filters)]);   
        }

        $view = View::make('admin.faqs.index')
            ->with('faqs', $faqs)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }
}
