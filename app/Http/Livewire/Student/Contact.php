<?php

namespace App\Http\Livewire\Student;

use App\Models\Student;
use Livewire\Component;
use WireUi\Traits\Actions;

class Contact extends Component
{
    use Actions;

    public $student;
    public $address;
    public $contact;
    public $kinships;

    public $showAddressModal;
    public $showContactModal;

    public $addressform = ['address','complement','district','city'];
    public $contactform = ['phone' => '','whatsapp' => '','email' => '','facebook' => '','instagram' => ''];

    protected $validationAttributes = [
        'contactform.phone' => 'Telefone',
        'contactform.whatsapp' => 'WhatsApp',
        'contactform.email' => 'E-mail',
        'contactform.facebook' => 'Facebook',
        'contactform.instagram' => 'Instagram',
        'addressform.address' => 'Endereço',
        'addressform.complement' => 'Complemento',
        'addressform.district' => 'Bairro',
        'addressform.city' => 'Cidade',
    ];

    public function mount(Student $student)
    {
        $this->student = $student;
        $this->address = $student->address;
        $this->contact = $student->contact;
        $this->kinships = $student->kinships()->with('contact')->get();
    }

    public function submitAddress()
    {
        $validateAddress = $this->validate([
            'addressform.address' => 'required|string|min:5|max:140',
            'addressform.complement' => 'nullable|string|max:100',
            'addressform.district' => 'required|string|min:3|max:90',
            'addressform.city' => 'required|string|min:3|max:90',
        ]);
        try {
            $updated = $this->student->address()->update([
                'address' => $this->addressform['address'],
                'complement' => $this->addressform['complement'],
                'district' => $this->addressform['district'],
                'city' => $this->addressform['city'],
            ]);
            $this->address['address'] = $this->addressform['address'];
            $this->address['complement'] = $this->addressform['complement'];
            $this->address['district'] = $this->addressform['district'];
            $this->address['city'] = $this->addressform['city'];
            $this->notification()->success(
                $title = 'Atualizado',
                $description = 'Endereço atualizado com sucesso.'
            );
            $this->showAddressModal = false;
        } catch (\Throwable $th) {
            $this->notification()->error(
                $title = 'Erro',
                $description = 'Ocorreu um erro ao atualizar endereço.'
            );
            dd($th);
        }
    }
    public function submitContact()
    {
        $validateContact = $this->validate([
            'contactform.phone' => 'nullable|required_without:contactform.whatsapp|string|min:14|max:15',
            'contactform.whatsapp' => 'nullable|required_without:contactform.phone|string|min:14|max:15',
            'contactform.email' => 'nullable|email',
            'contactform.facebook' => 'nullable|url',
            'contactform.instagram' => 'nullable|url',
        ]);
        try {
            $updated = $this->student->contact()->update([
                'phone' => $this->contactform['phone'],
                'whatsapp' => $this->contactform['whatsapp'],
                'email' => $this->contactform['email'],
                'facebook' => $this->contactform['facebook'],
                'instagram' => $this->contactform['instagram'],
            ]);
            $this->contact['phone'] = $this->contactform['phone'];
            $this->contact['whatsapp'] = $this->contactform['whatsapp'];
            $this->contact['email'] = $this->contactform['email'];
            $this->contact['facebook'] = $this->contactform['facebook'];
            $this->contact['instagram'] = $this->contactform['instagram'];
            $this->notification()->success(
                $title = 'Contato salvo',
                $description = 'Informações de contato atualizadas com sucesso.'
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

    public function openContactModal()
    {
        $this->contactform['phone'] = $this->student->contact['phone'];
        $this->contactform['whatsapp'] = $this->student->contact['whatsapp'];
        $this->contactform['email'] = $this->student->contact['email'];
        $this->contactform['facebook'] = $this->student->contact['facebook'];
        $this->contactform['instagram'] = $this->student->contact['instagram'];
        $this->showContactModal = true;
    }
    public function openAddressModal()
    {
        $this->addressform['address'] = $this->student->address['address'];
        $this->addressform['complement'] = $this->student->address['complement'];
        $this->addressform['district'] = $this->student->address['district'];
        $this->addressform['city'] = $this->student->address['city'];
        $this->showAddressModal = true;
    }

    public function render()
    {
        return view('livewire.student.contact');
    }
}
