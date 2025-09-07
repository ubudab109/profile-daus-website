<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageOverlay extends Component
{
    public $image, $id;

    /**
     * Create a new component instance.
     */
    public function __construct($image, $id)
    {
        $this->image = $image;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.image-overlay');
    }
}
