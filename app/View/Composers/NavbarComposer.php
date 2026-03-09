<?php
// app/View/Composers/NavbarComposer.php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class NavbarComposer
{
    public function compose(View $view)
    {
        $categories = Category::all();
        $view->with('categories', $categories);
    }
}