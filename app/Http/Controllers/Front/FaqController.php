<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Vendor\Locale\Locale;
use App\Models\DB\Faq;
use App;
use Debugbar;

class FaqController extends Controller
{
    protected $agent;
    protected $faq;
    protected $locale;

    function __construct(Faq $faq, Locale $locale, Agent $agent)
    {
        $this->agent = $agent;
        $this->faq = $faq;
    }

    public function index()
    {        
        
        // $locale = $this->locale->getAllByLanguage();
        
        // $faqs = $this->faq->with(['locale' => function($query){
        //     $query->pluck('value','tag')->toArray();
        // }])->where('active', 1)->get();

        // $faqs = $faqs->map(function($faq) {  
        //     return collect($faq)->union($faq->locale->pluck('value','tag'));
        // });

        if($this->agent->isDesktop()){
            $faqs = $this->faq->with('image_featured_desktop')->where('active', 1)->where('visible', 1)->get();
            $faqs = $this->faq->with('image_grid_desktop')->where('active', 1)->where('visible', 1)->get();
        }
        
        elseif($this->agent->isMobile()){
            $faqs = $this->faq->with('image_featured_mobile')->where('active', 1)->where('visible', 1)->get();
            $faqs = $this->faq->with('image_grid_mobile')->where('active', 1)->where('visible', 1)->get();
        }

        $view = View::make('front.faqs.index')
                ->with('faqs', $faqs );

        return $view;
    }

}
