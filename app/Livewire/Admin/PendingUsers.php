<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Enums\UserStatusEnum;
use Livewire\Component;
use Livewire\WithPagination;

class PendingUsers extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedUser = null;
    public $showApproveModal = false;
    public $showRejectModal = false;

    protected $listeners = ['userApproved' => 'resetModal', 'userRejected' => 'resetModal'];

    public function render()
    {
        $users = User::where('status', UserStatusEnum::PENDING)
                    ->where(function($query) {
                        $query->where('name', 'like', '%' . $this->search . '%')
                              ->orWhere('email', 'like', '%' . $this->search . '%')
                              ->orWhere('national_id', 'like', '%' . $this->search . '%');
                    })
                    ->paginate(10);

        return view('livewire.admin.pending-users', [
            'users' => $users
        ]);
    }

    public function approveUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->update(['status' => UserStatusEnum::ACTIVE]);
            $this->dispatch('userApproved');
        }
    }

    public function rejectUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->update(['status' => UserStatusEnum::INACTIVE]);
            $this->dispatch('userRejected');
        }
    }

    public function showApproveModal($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->showApproveModal = true;
    }

    public function showRejectModal($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->showRejectModal = true;
    }

    public function resetModal()
    {
        $this->showApproveModal = false;
        $this->showRejectModal = false;
        $this->selectedUser = null;
    }
}