<?php

namespace App\Http\Livewire\Catechist;

use App\Models\Community;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;

    public $name = 'Teste';
    public $email = 'teste@teste.com';
    public $password = '123456';
    public $password_confirmation = '123456';
    public $birth = '2008-12-05';
    public $marital_status = 'Casado(a)';
    public $community_id;
    public $role;
    public $communities;
    public $roles;

    protected $validationAttributes = [
        'name' => 'Nome completo',
        'email' => 'E-mail',
        'password' => 'Senha',
        'password_confirmation' => 'Confirmação de senha',
        'community_id' => 'Comunidade',
        'birth' => 'Data de nascimento',
        'marital_status' => 'Estado civil',
        'role' => 'Função',
    ];

    public function mount(): void
    {
        if(Auth()->user()->hasRole('admin')) {
            $this->communities = Community::all();
        } else {
            $this->community_id = Auth()->user()->community_id;
        }

        $roles = Role::query();
        if(!Auth()->user()->hasRole('admin')) {
            $roles->where('name','<>','admin');
        }
        $this->roles = $roles->get();
    }

    public function submit() 
    {
        $validateUser = $this->validate([
            'name' => 'required|string|min:6|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:32',
            'password_confirmation' => 'required|same:password',
            'community_id' => 'required|integer',
            'role' => 'required|integer',
        ]);
        $validateProfile = $this->validate([
            'birth' => 'required|date|before:now',
            'marital_status' => 'required|string',
        ]);

        try {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'community_id' => $this->community_id,
            ]);
            $profile = $user->profile()->create($validateProfile);
            $role = $user->roles()->attach((int)$this->role);
            return redirect()->route('catechists.show', $user)->with('success','Catequista cadastrado(a) com sucesso!');
        } catch (\Throwable $th) {
            $this->dialog(['description' => 'Ocorreu um erro ao cadastrar catequista.','icon'=>'error']);
            dd($th);
        }
    }

    public function render(): View
    {
        return view('livewire.catechist.create');
    }
}
