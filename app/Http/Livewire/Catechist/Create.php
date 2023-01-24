<?php

namespace App\Http\Livewire\Catechist;

use App\Models\Community;
use App\Models\User;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;

    public $name, $email, $password, $password_confirmation, $community_id, $role;
    public $birthday, $marital_status;
    public $communities;
    public $roles;
    public $catechist;
    public $profile;
    public $user;

    protected $validationAttributes = [
        'name' => 'Nome',
        'email' => 'E-mail',
        'password' => 'Senha',
        'password_confirmation' => 'Confirmação de senha',
        'community_id' => 'Comunidade',
        'birthday' => 'Data de nascimento',
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
            'birthday' => 'required|date|before:now',
            'marital_status' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'community_id' => $this->community_id,
            ]);
            $profile = $user->profile()->create($validateProfile);
            $role = $user->roles()->attach((int)$this->role);
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao cadastrar catequista.');
            dd($th);
        }
        if($user && $profile) {
            DB::commit();
            $this->catechist = $user;
            $this->profile = $profile;
            $this->notification()->success($title = 'Catequista cadastrado(a) com sucesso', $description = 'Continue completando as informações.');
        } else {
            DB::rollback();
            $this->notification()->error($description = 'Ocorreu um erro ao cadastrar catequista.');
        }
    }

    public function render(): View
    {
        return view('livewire.catechist.create');
    }
}
