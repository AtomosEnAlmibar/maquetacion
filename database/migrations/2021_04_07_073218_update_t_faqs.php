<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


Schema::table('t_faqs', function (Blueprint $table) {
    $table->foreignId('category_id')->constrained('t_faq_categories')->after('id');
});

