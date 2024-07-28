<?php

namespace App\Livewire;

use Livewire\Component;

class Items extends Component
{
    public $items;

    public function mount()
    {
        // Initialize your items array (usually this would be fetched from a database)
        $this->items = [
            ['id' => 1, 'name' => 'Item 1'],
            ['id' => 2, 'name' => 'Item 2'],
            ['id' => 3, 'name' => 'Item 3'],
        ];
    }

    public function render()
    {
        return view('livewire.items');
    }
}
