<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Setting;

class ApplicationLogo extends Component
{
    public $logoUrl;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
                $this->logoPath = Setting::where('key', 'site_logo')->first()->value ?? null;
        $this->logoUrl = $this->logoPath ? asset('uploads/' . $this->logoPath) . '?v=' . time() : null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.application-logo');
    }
}
