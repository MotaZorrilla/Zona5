<?php

namespace App\Livewire\Profile;

use Livewire\Component;

#[\Livewire\Attributes\Layout('layouts.admin')]
class Pending extends Component
{
    public function render()
    {
        return view('livewire.profile.pending');
    }
}