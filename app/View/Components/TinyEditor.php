<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TinyEditor extends Component
{
    public $name;
    public $value;
    public $height;
    public $required;
    
    public function __construct($name = 'content', $value = '', $height = 500, $required = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->height = $height;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.tiny-editor');
    }
}