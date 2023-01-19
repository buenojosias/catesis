<?php

namespace App\Http\Livewire\Kinship;

use Livewire\Component;
use WireUi\Traits\Actions;

class Contact extends Component
{
    use Actions;

    public $kinship;
    public $contact;
    public $phone, $whatsapp, $email, $facebook, $instagram;
    public $kinships;

    public $showContactModal;

    protected $validationAttributes = [
        'phone' => 'Telefone',
        'whatsapp' => 'WhatsApp',
        'email' => 'E-mail',
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
    ];

    public function mount($kinship)
    {
        $this->kinship = $kinship;
        $contact = $kinship->contact;
        if($contact) {
            $this->contact = $contact;
            $this->phone = $contact->phone;
            $this->whatsapp = $contact->whatsapp;
            $this->email = $contact->email;
            $this->facebook = $contact->facebook;
            $this->instagram = $contact->instagram;
        }
    }

    public function submitContact()
    {
        $validateContact = $this->validate([
            'phone' => 'nullable|string|min:14|max:15',
            'whatsapp' => 'nullable|string|min:14|max:15',
            'email' => 'nullable|email',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|string',
        ]);
        try {
            if($this->contact) {
                $save = $this->kinship->contact()->update($validateContact);
            } else {
                $this->contact = $this->kinship->contact()->create($validateContact);
            }
            $this->contact = $validateContact;
            $this->notification()->success($description = 'Informações de contato salvas com sucesso.');
            $this->showContactModal = false;
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao salvar contatos.');
            dd($th);
        }
    }

    public function openContactModal()
    {
        $this->showContactModal = true;
    }

    public function render()
    {
        return view('livewire.kinship.contact');
    }}
