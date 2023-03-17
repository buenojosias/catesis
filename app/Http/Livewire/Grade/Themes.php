<?php

namespace App\Http\Livewire\Grade;

use App\Models\Theme;
use Livewire\Component;
use WireUi\Traits\Actions;

class Themes extends Component
{
    use Actions;

    public $theme_id, $title, $description, $global = false;
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
                $savedTheme = Theme::create([
                    'grade_id' => $this->global === false ? $this->grade->id : null,
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
            $validate['grade_id'] = $this->global === false ? $this->grade->id : null;
            try {
                $theme = Theme::findOrFail($this->theme_id)->update($validate);
                $this->themes = Theme::where('grade_id', $this->grade->id)->orWhereNull('grade_id')->orderBy('grade_id')->get();
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
        // $this->can_edit = auth()->user()->hasRole('admin') || (auth()->user()->hasRole('coordinator') && auth()->user()->community_id === null);
        $this->can_edit = auth()->user()->hasRole(['admin','coordinator']);
        $this->grade = $grade;
        $this->themes = Theme::where('grade_id', $this->grade->id)->orWhereNull('grade_id')->orderBy('grade_id')->get();
    }

    public function openModal($method, $modalTheme = null)
    {
        $this->method = $method;
        $this->modalTitle = $method === 'edit' ? 'Editar tema' : 'Novo tema';
        $this->theme_id = $modalTheme['id'] ?? null;
        $this->title = $modalTheme['title'] ?? null;
        $this->description = $modalTheme['description'] ?? null;
        if($method === 'edit') {
            $this->global = $modalTheme['grade_id'] ? false : true;
        }
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.grade.themes');
    }
}
