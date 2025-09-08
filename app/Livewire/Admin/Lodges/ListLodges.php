<?php

namespace App\Livewire\Admin\Lodges;

use App\Models\Lodge;
use Livewire\Component;
use Livewire\WithPagination;

class ListLodges extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $filterOriente = '';

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
        $query = Lodge::withCount('users');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('number', 'like', '%' . $this->search . '%')
                  ->orWhere('oriente', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->filterOriente)) {
            $query->where('oriente', $this->filterOriente);
        }

        $lodges = $query->orderBy($this->sortField, $this->sortDirection)
                        ->paginate(10);

        return view('livewire.admin.lodges.list-lodges', [
            'lodges' => $lodges,
            'orientes' => Lodge::distinct()->pluck('oriente'),
        ]);
    }
}