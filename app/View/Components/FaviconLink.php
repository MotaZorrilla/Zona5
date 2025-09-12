<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Setting;

class FaviconLink extends Component
{
    public $faviconUrl;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $faviconPath = Setting::where('key', 'favicon')->first()->value ?? null;
        $this->faviconUrl = $faviconPath ? asset('uploads/' . $faviconPath) : null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.favicon-link');
    }
}