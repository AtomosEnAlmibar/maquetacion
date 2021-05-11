<?php

namespace App\Vendor\Locale;

use App\Vendor\Locale\Models\Locale as DBLocale;
use App\Vendor\Locale\Models\LocaleLanguage;
use Debugbar;

class Locale
{
    protected $rel_parent;
    protected $language;

    public function setParent($rel_parent)
    {
        $this->rel_parent=$rel_parent;
    }

    public function getParent()
    {
        return $this->rel_parent;
    }

    public function store()
    {
        foreach ($locale as $key => $value) {
            $data=explode(".",$locale,PHP_INT_MAX);    
            
        }
    }
}