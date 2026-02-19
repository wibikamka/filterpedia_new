<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $links;

public function __construct(array $links = [])
{
    $this->links = $links;
}

    public function render()
    {
        return view('components.breadcrumb');
    }
}
