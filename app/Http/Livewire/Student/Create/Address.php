<?php

namespace App\Http\Livewire\Student\Create;

use Livewire\Component;
use WireUi\Traits\Actions;

class Address extends Component
{
    use Actions;

    public $student;
    public $saved_address;
    public $address, $complement, $district, $city;

    protected $validationAttributes = [
        'address' => 'Endereço',
        'complement' => 'Complemento',
        'district' => 'Bairro',
        'city' => 'Cidade',
    ];

    public function submit()
    {
        $validateAddress = $this->validate([
            'address' => 'required|string|min:5|max:140',
            'complement' => 'nullable|string|max:100',
            'district' => 'required|string|min:3|max:90',
            'city' => 'required|string|min:3|max:90',
        ]);
        try {
            $this->saved_address = $this->student->address()->create($validateAddress);
            $this->notification()->success($description = 'Endereço salvo com sucesso.');
            $this->dispatchBrowserEvent('close', ['form' => false]);
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao salvar endereço.');
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.student.create.address');
    }
}
