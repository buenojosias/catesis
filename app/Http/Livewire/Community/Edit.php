<?php

namespace App\Http\Livewire\Community;

use App\Models\Community;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Edit extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $community;

    public $name;

    public function mount(Community $community)
    {
        $this->form->fill([
            'name' => $this->community->name,
        ]);
    }

    protected function getFormSchema(): array 
    {
        return [
            Forms\Components\TextInput::make('name')->required(),
        ];
    }

    public function render()
    {
        return view('livewire.community.edit', [
            //'community' => $this->community
        ]);
    }
}
