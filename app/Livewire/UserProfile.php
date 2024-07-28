<?php

namespace App\Livewire;

use Livewire\Component;

class UserProfile extends Component
{
    public $name;
    public $age;

    public function mount($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
