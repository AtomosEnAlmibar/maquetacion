<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\FaqCategory as FaqCategory;

class FaqCategories
{
    public $faq_categories;

    public function __construct()
    {
        $this->faq_categories = FaqCategory::orderBy('name', 'asc')->get();
    }

    public function compose(View $view)
    {
        $view->with('faq_categories', $this->faq_categories);
    }
}