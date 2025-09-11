<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUsers extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $filterLodgeId = ''; // New property for filtering by lodge
    public $filterDegree = ''; // New property for filtering by filtering by degree

    public $lodges; // To hold all lodges for the dropdown
    public $degrees = ['Aprendiz', 'Compañero', 'Maestro']; // Predefined degrees

    public function mount()
    {
        $this->lodges = \App\Models\Lodge::all(); // Load all lodges on component mount
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $query = User::query(); // Start with base User query

        // Apply search filter
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('phone_number', 'like', '%' . $this->search . '%');
            });
        }

        // Apply lodge filter
        if (!empty($this->filterLodgeId)) {
            $query->whereHas('lodges', function ($q) {
                $q->where('lodges.id', $this->filterLodgeId);
            });
        }

        // Apply degree filter
        if (!empty($this->filterDegree)) {
            $query->where('degree', $this->filterDegree);
        }

        // Handle sorting
        if (in_array($this->sortField, ['lodges.name', 'lodges.number'])) {
            $query->leftJoin('lodge_user', 'users.id', '=', 'lodge_user.user_id')
                  ->leftJoin('lodges', 'lodge_user.lodge_id', '=', 'lodges.id')
                  ->select('users.*', 'lodges.name as lodge_name', 'lodges.number as lodge_number'); // Select all necessary columns

            if ($this->sortField === 'lodges.name') {
                $query->orderBy('lodge_name', $this->sortDirection); // Order by alias
            } elseif ($this->sortField === 'lodges.number') {
                $query->orderBy('lodge_number', $this->sortDirection); // Order by alias
            }
        } else {
            // If not sorting by related lodge fields, just order by the user's own field
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        // Eager load lodges and roles for display
        $query->with(['lodges', 'roles']);


        $users = $query->paginate(10);

        return view('livewire.admin.users.manage-users', [
            'users' => $users,
        ]);
    }

    public function openUserModal($userId)
    {
        $this->dispatch('showUserModal', userId: $userId);
    }
}