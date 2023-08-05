<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SearchBar extends Component
{
    use WithPagination;
    public $query;
    public function render()
    {
        $users = [];
        if ($this->query) {
            $users = User::where(function ($queryBuilder) {
                $queryBuilder->where('name', 'LIKE', '%' . $this->query . '%')
                    ->orWhere('username', 'LIKE', '%' . $this->query . '%');
            })->paginate(10);

            if ($users->isEmpty()) {
                $users = [];
            }
        }

        return view('livewire.search-bar', compact('users'));
    }


    public function navigateToUserProfile($userId)
    {
        // Redirect to the user profile page
        return redirect()->route('user.profile', ['id' => $userId]);
    }
}
