<?php

namespace App\Http\Livewire\Catechist;

use Livewire\Component;

class Contact extends Component
{
    public $address;
    public $contact;

    public function mount($catechist)
    {
        $this->address = $catechist->address;
        $this->contact = $catechist->contact;
    }

    public function render()
    {
        return view('livewire.catechist.contact');
    }
}
