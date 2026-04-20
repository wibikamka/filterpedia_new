<?php
// app/View/Composers/NavbarComposer.php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class NavbarComposer
{
    public function compose(View $view)
    {
        $categories = Category::where('is_active', true)
            ->whereHas('products', function($q) {
                $q->where('is_active', true);
            })
            ->orderBy('name')
            ->get();
        
        $view->with('categories', $categories);
    }
}