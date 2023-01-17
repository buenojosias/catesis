<?php

namespace App\Http\Livewire\Student\Create;
use WireUi\Traits\Actions;

use Livewire\Component;

class Contact extends Component
{
    use Actions;

    public $student;
    public $contact;
    public $phone, $whatsapp, $email, $facebook, $instagram;

    protected $validationAttributes = [
        'phone' => 'Telefone',
        'whatsapp' => 'WhatsApp',
        'email' => 'E-mail',
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
    ];

    public function submit()
    {
        $validateContact = $this->validate([
            'phone' => 'nullable|required_without:whatsapp|string|min:14|max:15',
            'whatsapp' => 'nullable|required_without:phone|string|min:14|max:15',
            'email' => 'nullable|email',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);
        try {
            $this->contact = $this->student->contact()->create($validateContact);
            $this->notification()->success($description = 'Contatos salvos com sucesso.');
            $this->dispatchBrowserEvent('close', ['form' => false]);
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao salvar contato.');
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.student.create.contact');
    }
}
