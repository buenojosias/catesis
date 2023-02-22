<?php

namespace App\Http\Livewire\Encounter;

use Livewire\Component;
use WireUi\Traits\Actions;

class Comments extends Component
{
    use Actions;

    public $canAddComment;
    public $comments;
    public $commentDescription;
    public $encounter;
    public $group;

    protected $validationAttributes = [
        'commentDescription' => 'Comentário',
    ];

    public function mount($encounter, $group)
    {
        $this->encounter = $encounter;
        $this->comments = $encounter->comments()->with('user')->orderBy('id', 'desc')->get();
        if($this->group->users()->find(auth()->user()) || (auth()->user()->hasAnyRole(['admin','coordinator','secretary']) && $this->group->community_id === auth()->user()->community_id))
        {
            $this->canAddComment = true;
        } else {
            $this->canAddComment = false;
        }
    }

    public function submitComment()
    {
        $validate = $this->validate([
            'commentDescription' => 'required|string',
        ]);
        try {
            $comment = $this->encounter->comments()->create([
                'user_id' => auth()->user()->id,
                'description' => $this->commentDescription,
            ]);
            $this->comments->prepend($comment);
            $this->resetDescription();
            $this->dispatchBrowserEvent('close-textarea', ['showTextarea' => false]);
            $this->notification()->success($description = 'Comentário adicionado com sucesso.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao salvar comentário.');
            dd($th);
        }
    }

    public function resetDescription()
    {
        $this->commentDescription = '';
    }
    public function render()
    {
        return view('livewire.encounter.comments');
    }
}
