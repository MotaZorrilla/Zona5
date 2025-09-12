<?php

namespace App\Livewire\Admin\ContentManager;

use Livewire\Component;
use App\Models\Setting;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class BrandIdentity extends Component
{
    use WithFileUploads;

    public $site_name = 'Gran Zona 5';
    public $theme_color = '#3b82f6';

    public $logo = null;
    public $favicon = null;

    public $existingLogo;
    public $existingFavicon;

    public function mount()
    {
        $this->site_name = Setting::where('key', 'site_name')->first()->value ?? $this->site_name;
        $this->theme_color = Setting::where('key', 'theme_color')->first()->value ?? $this->theme_color;
        $this->existingLogo = Setting::where('key', 'site_logo')->first()->value ?? null;
        $this->existingFavicon = Setting::where('key', 'favicon')->first()->value ?? null;
    }

    public function save()
    {
        $this->validate([
            'site_name' => 'required|string|max:255',
            'theme_color' => 'required|string|max:7',
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:512',
        ]);

        Setting::updateOrCreate(['key' => 'site_name'], ['value' => $this->site_name]);
        Setting::updateOrCreate(['key' => 'theme_color'], ['value' => $this->theme_color]);

        if ($this->logo) {
            if ($this->existingLogo) {
                Storage::disk('public')->delete($this->existingLogo);
            }
            $path = $this->logo->store('logos', 'public');
            Setting::updateOrCreate(['key' => 'site_logo'], ['value' => $path]);
            $this->existingLogo = $path;
            $this->logo = null;
        }

        if ($this->favicon) {
            if ($this->existingFavicon) {
                Storage::disk('public')->delete($this->existingFavicon);
            }
            $path = $this->favicon->store('logos', 'public');
            Setting::updateOrCreate(['key' => 'favicon'], ['value' => $path]);
            $this->existingFavicon = $path;
            $this->favicon = null;
        }

        session()->flash('message', 'Identidad de marca actualizada con éxito.');
        $this->dispatch('refresh-page');
    }

    public function render()
    {
        return view('livewire.admin.content-manager.brand-identity', [
            'logo' => $this->logo,
            'favicon' => $this->favicon,
            'existingLogo' => $this->existingLogo,
            'existingFavicon' => $this->existingFavicon,
        ]);
    }
}
