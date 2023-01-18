<?php

namespace App\Http\Livewire\Catechist;

use Livewire\Component;

class Contact extends Component
{
    public $contact;

    public function mount($catechist)
    {
        $this->contact = $catechist->contact;
    }

    public function render()
    {
        return view('livewire.catechist.contact');
    }
}
