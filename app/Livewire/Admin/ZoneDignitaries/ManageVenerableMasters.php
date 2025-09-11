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

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $search = '';

    public $showEditModal = false;
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
    ];

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $field;
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

    public function render()
    {
        $vmPositionId = Position::where('name', 'Venerable Maestro')->value('id');

        $query = User::query();

        // Apply the Venerable Master filter first
        $query->whereHas('lodges', function ($q) use ($vmPositionId) {
            $q->where('lodge_user.position_id', $vmPositionId);
        });

        // Apply search filter
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhereHas('lodges', function($q2) {
                      $q2->where('name', 'like', '%' . $this->search . '%')
                         ->orWhere('number', 'like', '%' . $this->search . '%');
                  });
            });
        }

        // Apply Joins and Selects for Sorting by related fields
        if (in_array($this->sortBy, ['lodge_name', 'lodge_number'])) {
            $query->leftJoin('lodge_user', 'users.id', '=', 'lodge_user.user_id')
                  ->leftJoin('lodges', 'lodge_user.lodge_id', '=', 'lodges.id')
                  ->select('users.*', 'lodges.name as lodge_name', 'lodges.number as lodge_number');
        }

        // Apply sorting
        if (in_array($this->sortBy, ['name', 'phone_number'])) {
            $query->orderBy($this->sortBy, $this->sortDirection);
        } elseif ($this->sortBy === 'lodge_name') {
            $query->orderBy('lodge_name', $this->sortDirection);
        } elseif ($this->sortBy === 'lodge_number') {
            $query->orderBy('lodge_number', $this->sortDirection);
        }

        $venerableMasters = $query->with(['lodges' => function ($query) use ($vmPositionId) {
            $query->where('lodge_user.position_id', $vmPositionId);
        }])
        ->paginate(10)
        ->map(function ($user) {
            $lodge = $user->lodges->first();
            return (object) [
                'id' => $user->id,
                'name' => $user->name,
                'lodge_name' => $lodge ? $lodge->name : 'N/A',
                'lodge_number' => $lodge ? $lodge->number : 'N/A',
                'phone_number' => $user->phone_number,
            ];
        });

        return view('livewire.admin.zone-dignitaries.manage-venerable-masters', compact('venerableMasters'));
    }
}