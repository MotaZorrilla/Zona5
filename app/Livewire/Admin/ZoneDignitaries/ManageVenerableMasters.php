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

    public function order($field)
    {
        if ($this->orderBy === $field) {
            $this->orderDirection = $this->orderDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->orderDirection = 'asc';
        }
        $this->orderBy = $field;
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
        ]);
    }
}
