<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class sidepanel extends Component
{
    /**
     * Create a new component instance.
     */
    public $routeName;

    public function __construct()
    {
        $this->routeName = Route::currentRouteName();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidepanel');
    }
}
