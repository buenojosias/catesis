<?php

namespace App\Http\Livewire\Catechist\Create;
use WireUi\Traits\Actions;

use Livewire\Component;

class Contact extends Component
{
    use Actions;

    public $catechist;
    public $contact;
    public $phone, $whatsapp, $email, $facebook, $instagram;

    protected $validationAttributes = [
        'phone' => 'Telefone',
        'whatsapp' => 'WhatsApp',
        'email' => 'E-mail',
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
    ];

    public function mount($catechist) {
        $this->catechist = $catechist;
        $this->email = $catechist->email;
    }

    public function submit()
    {
        $validateContact = $this->validate([
            'phone' => 'nullable|string|min:14|max:15',
            'whatsapp' => 'nullable|string|min:14|max:15',
            'email' => 'nullable|email',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|string',
        ]);
        try {
            $this->contact = $this->catechist->contact()->create($validateContact);
            $this->notification()->success($description = 'Contatos salvos com sucesso.');
            return redirect()->route('catechists.show', $this->catechist)->with('success','Cadastro concluído com sucesso.');
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao salvar contato.');
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.catechist.create.contact');
    }
}
