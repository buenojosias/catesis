<?php

namespace App\Http\Livewire\Event;

use Livewire\Component;

class ShowModal extends Component
{
    public $eventData;
    public $modalShow;

    protected $listeners = [
        'emitOpenShowModal',
    ];

    public function emitOpenShowModal($eventData)
    {
        $this->eventData = $eventData;
        $this->modalShow = true;
    }

    public function render()
    {
        return view('livewire.event.show-modal');
    }
}
