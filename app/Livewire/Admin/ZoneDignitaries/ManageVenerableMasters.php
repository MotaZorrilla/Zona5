<?php

namespace App\Livewire\Admin\ZoneDignitaries;

use Livewire\Component;
use App\Models\User;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class ManageVenerableMasters extends Component
{
    use WithPagination;

    public $orderBy = 'name';
    public $orderDirection = 'asc';
    public $search = '';

    public $showEditModal = false;
    public $showAddModal = false;
    public $selectedLodgeId = null;
    public $selectedUserId = null;
    public $newVmName = '';
    public $newVmPhoneNumber = '';
    
    public $editingVmId;
    public $editingVmName;
    public $editingVmLodgeName;
    public $editingVmLodgeId;
    public $editingVmPhoneNumber;
    public $selectedNewVmId;
    public $lodgeMembers = [];

    protected $rules = [
        'editingVmName' => 'required|string|max:255',
        'editingVmPhoneNumber' => 'nullable|string|max:20',
        'selectedNewVmId' => 'nullable|exists:users,id',
        'selectedLodgeId' => 'required|exists:lodges,id',
        'selectedUserId' => 'required|exists:users,id',
        'newVmName' => 'required|string|max:255',
        'newVmPhoneNumber' => 'nullable|string|max:20',
    ];

    public function order($field)
    {
        if ($this->orderBy === $field) {
            $this->orderDirection = $this->orderDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->orderDirection = 'asc';
        }
        $this->orderBy = $field;
        
        $this->dispatch('contentChanged');
    }

    public function openEditModal($vmId)
    {
        $this->editingVmId = $vmId;
        $vm = User::find($vmId);

        if ($vm) {
            $this->editingVmName = $vm->name;
            $this->editingVmPhoneNumber = $vm->phone_number;

            $lodge = $vm->lodges->first();
            if ($lodge) {
                $this->editingVmLodgeName = $lodge->name;
                $this->editingVmLodgeId = $lodge->id;

                // Get all members of this lodge, excluding the current VM
                $this->lodgeMembers = User::whereHas('lodges', function ($query) use ($lodge) {
                    $query->where('lodges.id', $lodge->id);
                })
                ->where('id', '!=', $vmId) // Exclude current VM
                ->get();
            } else {
                $this->editingVmLodgeName = 'N/A';
                $this->editingVmLodgeId = null;
                $this->lodgeMembers = [];
            }
        }

        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->resetValidation();
        $this->reset(['editingVmId', 'editingVmName', 'editingVmLodgeName', 'editingVmLodgeId', 'editingVmPhoneNumber', 'selectedNewVmId', 'lodgeMembers']);
    }

    public function openAddModal()
    {
        $this->showAddModal = true;
        $this->reset(['selectedLodgeId', 'selectedUserId', 'newVmName', 'newVmPhoneNumber', 'lodgeMembers']);
        $this->resetValidation();
    }

    public function closeAddModal()
    {
        $this->showAddModal = false;
        $this->reset(['selectedLodgeId', 'selectedUserId', 'newVmName', 'newVmPhoneNumber', 'lodgeMembers']);
        $this->resetValidation();
    }

    public function updatedSelectedLodgeId($value)
    {
        if ($value) {
            // Get all members of the selected lodge
            $this->lodgeMembers = User::whereHas('lodges', function ($query) use ($value) {
                $query->where('lodges.id', $value);
            })->get();
        } else {
            $this->lodgeMembers = [];
        }
        
        // Reset selected user when lodge changes
        $this->selectedUserId = null;
        
        $this->dispatch('contentChanged');
    }

    public function updateVenerableMaster()
    {
        $this->validate();

        $currentVm = User::find($this->editingVmId);
        $vmPosition = Position::where('name', 'Venerable Maestro')->first();
        $exVmPosition = Position::where('name', 'Ex Venerable Maestro')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();

        if (!$currentVm || !$vmPosition) {
            session()->flash('error', 'Error: Venerable Maestro o posición no encontrada.');
            $this->closeEditModal();
            return;
        }

        // Option 1: Change the Venerable Master to another member of the same lodge
        if ($this->selectedNewVmId) {
            $newVm = User::find($this->selectedNewVmId);
            if ($newVm) {
                // Update old VM's position
                if ($exVmPosition) {
                    $currentVm->lodges()->updateExistingPivot($this->editingVmLodgeId, ['position_id' => $exVmPosition->id]);
                } else {
                    $currentVm->lodges()->updateExistingPivot($this->editingVmLodgeId, ['position_id' => $memberPosition->id]);
                }

                // Assign new VM's position
                $newVm->lodges()->updateExistingPivot($this->editingVmLodgeId, ['position_id' => $vmPosition->id]);

                session()->flash('message', 'Venerable Maestro cambiado exitosamente.');
            } else {
                session()->flash('error', 'Error: Nuevo Venerable Maestro no encontrado.');
            }
        }
        // Option 2: Update current VM's details (name, phone_number)
        else {
            $currentVm->update([
                'name' => $this->editingVmName,
                'phone_number' => $this->editingVmPhoneNumber,
            ]);
            session()->flash('message', 'Detalles del Venerable Maestro actualizados exitosamente.');
        }

        $this->closeEditModal();
    }

    public function addVenerableMaster()
    {
        $this->validate([
            'selectedLodgeId' => 'required|exists:lodges,id',
            'selectedUserId' => 'required|exists:users,id',
        ]);

        $user = User::find($this->selectedUserId);
        $lodge = Lodge::find($this->selectedLodgeId);
        $vmPosition = Position::where('name', 'Venerable Maestro')->first();

        if (!$user || !$lodge || !$vmPosition) {
            session()->flash('error', 'Error: Usuario, Logia o posición no encontrada.');
            return;
        }

        // Check if user is already a member of the lodge
        if (!$user->lodges->contains($lodge->id)) {
            // If not, attach the user to the lodge as a member first
            $memberPosition = Position::where('name', 'Miembro')->first();
            $user->lodges()->attach($lodge->id, [
                'position_id' => $memberPosition ? $memberPosition->id : null
            ]);
        }

        // Update user's position to Venerable Maestro
        $user->lodges()->updateExistingPivot($lodge->id, ['position_id' => $vmPosition->id]);

        session()->flash('message', 'Venerable Maestro agregado exitosamente.');
        $this->closeAddModal();
        $this->render();
    }

    public function createNewUserAndMakeVm()
    {
        $this->validate([
            'selectedLodgeId' => 'required|exists:lodges,id',
            'newVmName' => 'required|string|max:255',
            'newVmPhoneNumber' => 'nullable|string|max:20',
        ]);

        // Create new user
        $user = User::create([
            'name' => $this->newVmName,
            'phone_number' => $this->newVmPhoneNumber,
            'email' => null, // Or generate a unique email
            'password' => bcrypt('password'), // Default password, should be changed by user
        ]);

        $lodge = Lodge::find($this->selectedLodgeId);
        $vmPosition = Position::where('name', 'Venerable Maestro')->first();

        if (!$user || !$lodge || !$vmPosition) {
            session()->flash('error', 'Error: No se pudo crear el usuario o encontrar la logia/posición.');
            return;
        }

        // Attach user to lodge with Venerable Maestro position
        $user->lodges()->attach($lodge->id, [
            'position_id' => $vmPosition->id
        ]);

        session()->flash('message', 'Nuevo Venerable Maestro creado y agregado exitosamente.');
        $this->closeAddModal();
        $this->render();
    }

    public function removeVenerableMaster($vmId, $lodgeId)
    {
        $vm = User::find($vmId);
        $vmPosition = Position::where('name', 'Venerable Maestro')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();

        if (!$vm || !$vmPosition) {
            session()->flash('error', 'Error: Venerable Maestro o posición no encontrada.');
            return;
        }

        // Change VM's position to member
        if ($memberPosition) {
            $vm->lodges()->updateExistingPivot($lodgeId, ['position_id' => $memberPosition->id]);
        } else {
            // If member position doesn't exist, detach the user from the lodge
            $vm->lodges()->detach($lodgeId);
        }

        session()->flash('message', 'Venerable Maestro removido exitosamente.');
        $this->render();
    }

    public function render()
    {
        $vmPositionId = Position::where('name', 'Venerable Maestro')->value('id');

        $query = User::query()
            ->select('users.*')
            ->with(['lodges' => function ($query) use ($vmPositionId) {
                $query->where('lodge_user.position_id', $vmPositionId);
            }])
            ->whereHas('lodges', function ($q) use ($vmPositionId) {
                $q->where('lodge_user.position_id', $vmPositionId);
            })
            ->join('lodge_user', 'users.id', '=', 'lodge_user.user_id')
            ->join('lodges', 'lodge_user.lodge_id', '=', 'lodges.id')
            ->where('lodge_user.position_id', $vmPositionId);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('users.name', 'like', '%' . $this->search . '%')
                  ->orWhere('lodges.name', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->orderBy === 'lodge_name') {
            $query->orderBy('lodges.name', $this->orderDirection);
        } elseif ($this->orderBy === 'lodge_number') {
            $query->orderBy('lodges.number', $this->orderDirection);
        } else {
            $query->orderBy('users.' . $this->orderBy, $this->orderDirection);
        }

        $venerableMasters = $query->paginate(10);

        return view('livewire.admin.zone-dignitaries.manage-venerable-masters', [
            'venerableMasters' => $venerableMasters,
            'lodges' => Lodge::all(),
        ]);
    }
}
