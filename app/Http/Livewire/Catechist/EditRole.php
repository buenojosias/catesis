<?php

namespace App\Http\Livewire\Catechist;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use WireUi\Traits\Actions;

class EditRole extends Component
{
    use Actions;

    public $catechist;
    public $role;
    public $roles;
    public $user;

    public function loadData()
    {
        $this->role = $this->catechist->roles()->first()->id ?? null;
        $roles = Role::query()->where('name','<>','super-admin');
        if(!$this->user->hasRole('admin')) {
            $roles->where('name','<>','admin');
        }
        $this->roles = $roles->get();
    }

    public function mount($catechist)
    {
        $this->user = auth()->user();
        $this->catechist = $catechist;
    }

    public function submit()
    {
        if($this->role) {
            try {
                $this->catechist->roles()->detach();
                $this->catechist->roles()->attach((int)$this->role);
                $this->notification()->success($description = 'Função atualizada com sucesso.');
                $this->dispatchBrowserEvent('close', ['show' => false]);
            } catch (\Throwable $th) {
                $this->notification()->error($description = 'Ocorreu um erro ao atualizar função.');
                dd($th);
            }
        } else {
            $this->notification()->error($description = 'Selecione uma função válida.');
        }
    }

    public function render()
    {
        return view('livewire.catechist.edit-role');
    }
}
