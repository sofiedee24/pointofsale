<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterBar extends Component
{
    public $sortFields;
    public $defaultSort;
    /**
     * Create a new component instance.
     */
    public function __construct($sortFields = [], $defaultSort = 'name')
    {
        $this->sortFields = $sortFields;
        $this->defaultSort = $defaultSort;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filter-bar');
    }
}
