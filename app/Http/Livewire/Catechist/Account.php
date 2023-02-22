<?php

namespace App\Http\Livewire\Catechist;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use WireUi\Traits\Actions;
use Illuminate\Validation\Rules\Password;

class Account extends Component
{
    use Actions;

    public $catechist;
    public $roles, $catechist_roles = [];
    public $current_email, $new_email, $confirmation_email;
    public $current_password, $new_password, $confirmation_password;
    public $user;

    protected $validationAttributes = [
        'current_email' => 'E-mail atual',
        'new_email' => 'Novo e-mail',
        'confirmation_email' => 'Confirmação de e-mail',
        'current_password' => 'Senha atual',
        'new_password' => 'Nova senha',
        'confirmation_password' => 'Confirmação de senha',
    ];

    public function loadRoles()
    {
        $roles = Role::query()->where('name','<>','super-admin');
        if(!$this->user->hasRole('admin')) {
            $roles->where('name','<>','admin');
        }
        $this->roles = $roles->get()->toArray();
        $this->catechist_roles = $this->catechist->roles->pluck('name')->toArray();
    }

    public function submitPassword()
    {
        $validate = $this->validate([
            'current_password' => $this->catechist->id === auth()->user()->id ? 'required|current_password' : 'nullable',
            'new_password' => ['required', Password::defaults()],
            'confirmation_password' => 'required|same:new_password',
        ]);
        try {
            $this->catechist->update([
                'password' => bcrypt($this->new_password),
            ]);
            $this->current_password = $this->new_password = $this->confirmation_password = '';
            $this->notification()->success($description = 'Senha alterada com sucesso.');
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Erro ao alterar senha.');
            dd($th);
        }
    }

    public function submitEmail()
    {
        $validate = $this->validate([
            'new_email' => 'required|different:current_email',
            'confirmation_email' => 'required|same:new_email'
        ]);
        try {
            $this->catechist->update([
                'email' => $this->new_email,
                'email_verified_at' => null
            ]);
            $this->current_email = $this->new_email;
            $this->new_email = $this->confirmation_email = '';
            $this->notification()->success($title = 'E-mail atualizado com sucesso.', $description = 'Talvez seja necessário o usuário sair e entrar novamente.');
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Erro ao atualizar e-mail.');
            dd($th);
        }
    }

    public function submitRoles()
    {
        if($this->catechist->syncRoles($this->catechist_roles)) {
            $this->notification()->success($title = 'Funções atualizadas com sucesso.', $description = 'Talvez seja necessário o usuário sair e entrar novamente.');
        }
    }

    public function mount($catechist)
    {
        $this->user = auth()->user();
        $this->catechist = $catechist;
        $this->current_email = $catechist->email;
        $this->loadRoles();
    }

    public function render()
    {
        return view('livewire.catechist.account');
    }
}
