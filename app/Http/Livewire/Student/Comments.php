<?php

namespace App\Http\Livewire\Student;

use App\Models\Student;
use Livewire\Component;
use WireUi\Traits\Actions;

class Comments extends Component
{
    use Actions;

    public $student;
    public $comments;
    public $description;

    protected $validationAttributes = [
        'description' => 'Comentário',
    ];

    public function mount(Student $student)
    {
        $this->student = $student;
        $this->comments = $student->comments()->with('user')->orderBy('id', 'desc')->get();
    }

    public function submitComment()
    {
        $validate = $this->validate([
            'description' => 'required|string',
        ]);
        try {
            $comment = $this->student->comments()->create([
                'user_id' => auth()->user()->id,
                'description' => $this->description,
            ]);
            $this->comments->prepend($comment);
            $this->resetDescription();
            $this->dispatchBrowserEvent('close-textarea', ['showTextarea' => false]);
            $this->notification()->success($description = 'O comentário foi adicionado com sucesso.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao salvar comentário.');
            dd($th);
        }
    }

    public function resetDescription()
    {
        $this->description = '';
    }

    public function render()
    {
        return view('livewire.student.comments');
    }
}
