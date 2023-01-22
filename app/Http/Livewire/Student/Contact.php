<?php

namespace App\Http\Livewire\Student;

use App\Models\Student;
use Livewire\Component;
use WireUi\Traits\Actions;

class Contact extends Component
{
    use Actions;

    public $student;
    public $fulladdress, $fullcontact;
    public $address, $complement, $district, $city;
    public $phone, $whatsapp, $email, $facebook, $instagram;

    public $showAddressModal;
    public $showContactModal;

    protected $validationAttributes = [
        'phone' => 'Telefone',
        'whatsapp' => 'WhatsApp',
        'email' => 'E-mail',
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'address' => 'Endereço',
        'complement' => 'Complemento',
        'district' => 'Bairro',
        'city' => 'Cidade',
    ];

    public function mount(Student $student)
    {
        $this->student = $student;
        $address = $student->address;
        $contact = $student->contact;
        if($address) {
            $this->fulladdress = $address;
            $this->address = $address->address;
            $this->complement = $address->complement;
            $this->district = $address->district;
            $this->city = $address->city;
        }
        if($contact) {
            $this->fullcontact = $contact;
            $this->phone = $contact->phone;
            $this->whatsapp = $contact->whatsapp;
            $this->email = $contact->email;
            $this->facebook = $contact->facebook;
            $this->instagram = $contact->instagram;
        }
    }

    public function submitAddress()
    {
        $validateAddress = $this->validate([
            'address' => 'required|string|min:5|max:140',
            'complement' => 'nullable|string|max:100',
            'district' => 'required|string|min:3|max:90',
            'city' => 'required|string|min:3|max:90',
        ]);
        try {
            if($this->fulladdress) {
                $save = $this->student->address()->update($validateAddress);
            } else {
                $this->fulladdress = $this->student->address()->create($validateAddress);
            }
            $this->fulladdress = $validateAddress;
            $this->notification()->success(
                $title = 'Endereço salvo',
                $description = 'Endereço salvo com sucesso.'
            );
            $this->showAddressModal = false;
        } catch (\Throwable $th) {
            $this->notification()->error(
                $title = 'Erro',
                $description = 'Ocorreu um erro ao salvar endereço.'
            );
            dd($th);
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
            if($this->fullcontact) {
                $save = $this->student->contact()->update($validateContact);
            } else {
                $this->fullcontact = $this->student->contact()->create($validateContact);
            }
            $this->fullcontact = $validateContact;
            $this->notification()->success(
                $title = 'Contato salvo',
                $description = 'Informações de contato salvas com sucesso.'
            );
            $this->showContactModal = false;
        } catch (\Throwable $th) {
            $this->notification()->error(
                $title = 'Erro',
                $description = 'Ocorreu um erro ao salvar contatos.'
            );
            dd($th);
        }
    }

    public function openAddressModal()
    {
        $this->showAddressModal = true;
    }
    public function openContactModal()
    {
        $this->showContactModal = true;
    }

    public function render()
    {
        return view('livewire.student.contact');
    }
}
