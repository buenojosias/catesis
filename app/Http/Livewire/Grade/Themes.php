<?php

namespace App\Http\Livewire\Grade;

use Livewire\Component;
use WireUi\Traits\Actions;

class Themes extends Component
{
    use Actions;

    public $theme_id, $title, $description;
    public $showModal;
    public $method;
    public $modalTitle;
    public $modalTheme;
    public $themes;
    public $grade;
    public $can_edit;

    protected $validationAttributes = [
        'title' => 'Título',
        'description' => 'Descrição',
    ];

    public function submit()
    {
        $validate = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if($this->method === 'create') {
            try {
                $savedTheme = $this->grade->themes()->create([
                    'title' => $this->title,
                    'description' => $this->description,
                    'sequence' => $this->themes->count() + 1,
                ]);
                $this->themes->push($savedTheme);
                $this->notification()->success($description = 'Tema cadastrado com sucesso.');
                $this->showModal = false;
            } catch (\Throwable $th) {
                $this->notification()->error($description = 'Ocorreu um erro ao cadastrar tema.');
                dd($th);
            }
        } else if($this->method === 'edit') {
            try {
                $theme = $this->grade->themes()->findOrFail($this->theme_id)->update($validate);
                $this->themes = $this->grade->themes()->get();
                $this->notification()->success($description = 'Tema alterado com sucesso.');
                $this->showModal = false;
            } catch (\Throwable $th) {
                $this->notification()->error($description = 'Ocorreu um erro ao alterar tema.');
                dd($th);
            }
        } else {
            $this->notification()->error($description = 'Método inválido.');
        }
    }

    public function mount($grade)
    {
        $this->can_edit = auth()->user()->hasRole('admin') || (auth()->user()->hasRole('coordinator') && auth()->user()->community_id === null);
        $this->grade = $grade;
        $this->themes = $grade->themes;
    }

    public function openModal($method, $modalTheme = null)
    {
        $this->method = $method;
        $this->modalTitle = $method === 'edit' ? 'Editar tema' : 'Novo tema';
        $this->theme_id = $modalTheme['id'] ?? null;
        $this->title = $modalTheme['title'] ?? null;
        $this->description = $modalTheme['description'] ?? null;
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.grade.themes');
    }
}
