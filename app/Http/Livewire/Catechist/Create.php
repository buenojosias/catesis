<?php

namespace App\Http\Livewire\Catechist;

use App\Models\Community;
use App\Models\User;
use Auth;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $birth;
    public $marital_status;
    public $community_id;
    public $role;
    public $communities;
    public $roles;

    public $user;

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
        $this->user = Auth::user();
        if($this->user->hasRole('admin')) {
            $this->communities = Community::all();
        } else {
            $this->community_id = $this->user->community_id;
        }

        $roles = Role::query();
        if(!$this->user->hasRole('admin')) {
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
            'role' => 'required|integer',
            'community_id' => 'nullable|required_unless:role,1|integer',
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
