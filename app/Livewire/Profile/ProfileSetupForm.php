<?php

namespace App\Livewire\Profile;

use App\Models\Lodge;
use App\Models\Position;
use Livewire\Component;

class ProfileSetupForm extends Component
{
    public $national_id;
    public $birth_date;
    public $initiation_date;
    public $degree;
    public $profession;
    public $phone_number;
    public $selected_lodge;
    public $selected_position;
    
    public $lodges;
    public $positions;

    public function mount()
    {
        $user = auth()->user();
        
        // Si el usuario ya tiene datos, los cargamos
        $this->national_id = $user->national_id ?? '';
        $this->birth_date = $user->birth_date ?? '';
        $this->initiation_date = $user->initiation_date ?? '';
        $this->degree = $user->degree ?? '';
        $this->profession = $user->profession ?? '';
        $this->phone_number = $user->phone_number ?? '';
        
        // Obtenemos la relación con logias para cargar la logia y posición seleccionadas
        if ($user->lodges->count() > 0) {
            $lodgeUser = $user->lodges->first(); // Suponiendo una relación uno a muchos o tomamos la primera
            $this->selected_lodge = $lodgeUser->id;
            $pivot = $user->lodges()->where('lodges.id', $lodgeUser->id)->first()->pivot;
            $this->selected_position = $pivot->position_id ?? null;
        }
        
        // Cargamos lodges y positions para el formulario
        $this->lodges = Lodge::all();
        $this->positions = Position::all();
    }

    public function saveProfile()
    {
        $user = auth()->user();
        
        $validated = $this->validate([
            'national_id' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'initiation_date' => 'required|date',
            'degree' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'selected_lodge' => 'required|exists:lodges,id',
            'selected_position' => 'required|exists:positions,id',
        ]);

        // Actualizamos los datos del usuario
        $user->update([
            'national_id' => $validated['national_id'],
            'birth_date' => $validated['birth_date'],
            'initiation_date' => $validated['initiation_date'],
            'degree' => $validated['degree'],
            'profession' => $validated['profession'],
            'phone_number' => $validated['phone_number'],
        ]);

        // Asociamos la logia y posición
        $user->lodges()->sync([$validated['selected_lodge'] => ['position_id' => $validated['selected_position']]]);

        // Cambiamos el estado del usuario a pending para que sea aprobado por un admin
        // En lugar de activarlo directamente, se queda en pending y el admin lo aprueba
        session()->flash('message', 'Perfil actualizado correctamente. Espere la aprobación del administrador.');
        
        // Recargar los datos del usuario en el formulario para reflejar los cambios
        $this->mount();
    }

    public function render()
    {
        return view('livewire.profile.profile-setup-form');
    }
}