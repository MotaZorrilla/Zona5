<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Lodge;

class LodgeMembersOverview extends Component
{
    public $sortBy = 'users_count'; // Default sort by member count
    public $sortDirection = 'desc'; // Default sort descending

    public function render()
    {
        $lodges = Lodge::withCount('users')->get(); // Always fetch fresh data

        // Apply sorting based on sortBy and sortDirection
        if ($this->sortDirection === 'asc') {
            $sortedLodges = $lodges->sortBy($this->sortBy);
        } else {
            $sortedLodges = $lodges->sortByDesc($this->sortBy);
        }

        $maxMembers = $lodges->max('users_count') ?? 0; // Calculate maxMembers from the original collection

        return view('livewire.admin.lodge-members-overview', [
            'lodges' => $sortedLodges,
            'maxMembers' => $maxMembers,
        ]);
    }

    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc'; // Default to asc when changing sort field
        }
    }
}