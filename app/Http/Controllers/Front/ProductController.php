<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Vendor\Locale\Locale;
use App\Models\DB\Product;
use App;
use Debugbar;

class ProductController extends Controller
{
    protected $agent;
    protected $product;
    protected $locale;

    function __construct(Product $product, Locale $locale, Agent $agent)
    {
        $this->agent = $agent;
        $this->product = $product;
    }

    public function index()
    {        

        if($this->agent->isDesktop()){
            $products = $this->product->with('image_featured_desktop')->where('active', 1)->where('visible', 1)->get();
            $products = $this->product->with('image_grid_desktop')->where('active', 1)->where('visible', 1)->get();
        }
        
        elseif($this->agent->isMobile()){
            $products = $this->product->with('image_featured_mobile')->where('active', 1)->where('visible', 1)->get();
            $products = $this->product->with('image_grid_mobile')->where('active', 1)->where('visible', 1)->get();
        } 

        $view = View::make('front.products.index')
                ->with('products', $products );

        return $view;
    }
}