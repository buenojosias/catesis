<?php

namespace App\Http\Livewire\Group;

use App\Models\Theme;
use Livewire\Component;
use WireUi\Traits\Actions;

class Encounters extends Component
{
    use Actions;

    public $encounters;
    public $form;
    public $group;
    public $method;
    public $showFormModal;
    public $themes;

    protected $validationAttributes = [
        'form.date' => 'Data do encontro',
        'form.method' => 'Método',
        'form.theme_id' => 'Tema',
    ];

    public function openFormModal($method, $encounter = null)
    {
        $this->method = $method;
        $this->form = $encounter;
        if ($method === 'create') {
            $this->form['date'] = null;
        }
        $this->themes = Theme::where('grade_id', $this->group->grade_id)->orderBy('sequence', 'asc')->get();
        $this->showFormModal = true;
    }

    public function submitEncounter()
    {
        $validThemes = $this->themes->pluck('id')->toArray();
        $validMethods = ['presencial', 'familiar'];
        $validate = $this->validate([
            'form.date' => 'required|date',
            'form.method' => 'required|string|in:' . implode(',', $validMethods),
            'form.theme_id' => 'nullable|integer|in:' . implode(',', $validThemes),
        ]);
        if ($this->method === 'create') {
            try {
                $this->group->encounters()->create($this->form);
                $this->notification()->success($description = 'Encontro cadastrado com sucesso.');
                //$this->encounters->push($encounter);
                $this->showFormModal = false;
            } catch (\Throwable $th) {
                $this->notification()->error($description = 'Ocorreu um erro ao salvar encontro.');
                dd($th);
            }
        } else if ($this->method === 'edit') {
            try {
                $this->group->encounters()->findOrFail($this->form['id'])->update($this->form);
                $this->notification()->success($description = 'Encontro salvo com sucesso.');
                //$this->encounters = $this->group->encounters()->orderBy('date', 'asc')->with('theme')->get();
                $this->showFormModal = false;
            } catch (\Throwable $th) {
                $this->notification()->error($description = 'Ocorreu um erro ao salvar encontro.');
                dd($th);
            }
        }
    }

    public function mount($group)
    {
        $this->group = $group;
    }

    public function render()
    {
        $this->encounters = $this->group->encounters()->orderBy('date', 'asc')->with('theme')->get();
        return view('livewire.group.encounters');
    }
}