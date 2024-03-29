<?php

namespace App\Http\Livewire\Catechist;

use App\Models\Community;
use App\Models\Parish;
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

    public $name, $email, $password, $password_confirmation, $parish_id, $community_id, $role;
    public $birthday, $marital_status;
    public $parishes;
    public $communities;
    public $roles;
    public $catechist;
    public $profile;
    public $user, $auth_role;

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
        if(!auth()->user()->can('user_create') && session('role') != 'super-admin')
            abort(403);

        $this->auth_role = session('role');
        $this->user = Auth::user();
        if($this->auth_role === 'super-admin') {
            $this->parishes = Parish::all();
            $this->communities = Community::all();
        }
        if($this->auth_role === 'admin') {
            $this->communities = Community::all();
        }
        $roles = Role::query()->where('name','<>','super-admin');
        if($this->auth_role !== 'admin') {
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
            'community_id' => 'nullable|integer',
        ]);
        $validateProfile = $this->validate([
            'birthday' => 'required|date|before:now',
            'marital_status' => 'nullable|string|max:32',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'community_id' => $this->community_id ?? null,
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
