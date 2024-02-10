<?php

namespace App\Http\Livewire\Encounter;

use App\Models\Community;
use App\Models\Encounter;
use App\Models\Group;
use App\Models\Theme;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;
    use WithPagination;

    public $community;
    public $now;
    public $date;
    public $period;
    public $form;
    public $showFormModal;
    public $themes;

    protected $queryString = [
        'community' => ['except' => ''],
        'date' => ['except' => ''],
    ];

    protected $validationAttributes = [
        'form.date' => 'Data do encontro',
        'form.method' => 'Método',
        'form.theme_id' => 'Tema',
    ];

    public function updatingCommunity()
    {
        $this->resetPage();
    }

    public function updatingdate()
    {
        $this->resetPage();
    }

    public function openFormModal()
    {
        $this->form['date'] = null;
        $this->themes = Theme::whereNull('grade_id')->orderBy('title', 'asc')->get();
        $this->showFormModal = true;
    }

    public function submitEncounter()
    {
        $validThemes = $this->themes->pluck('id')->toArray();
        $validMethods = ['Presencial', 'Familiar'];
        $validate = $this->validate([
            'form.date' => 'required|date',
            'form.method' => 'required|string|in:' . implode(',', $validMethods),
            'form.theme_id' => 'nullable|integer|in:' . implode(',', $validThemes),
        ]);
        $groups = Group::where('finished', false)->where('year', date('Y'))->whereDoesntHave('encounters', function($query){
            $query->whereDate('date', $this->form['date']);
        })->get();
        try {
            foreach($groups as $group) {
                $group->encounters()->create([
                    'date' => date($this->form['date'] . ' ' . $group->time->format('H:i:s')),
                    'method' => $this->form['method'],
                    'theme_id' => $this->form['theme_id'] ?? null,
                ]);
            }
            $this->notification()->success($description = 'Encontros cadastrados com sucesso.');
            $this->showFormModal = false;
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao salvar encontros.');
            dd($th);
        }
    }

    public function mount($period)
    {
        $this->period = $period;
        $this->now = date('Y-m-d');
        $this->community = session('community_id') ?? null;
    }

    public function render()
    {
        if (auth()->user()->hasRole('admin')) {
            $communities = Community::all();
        }

        $encounters = Encounter::query()
            ->with('theme', 'group.grade')
            ->when(!$this->date, function ($query) {
                $query->whereRelation('group', 'year', date('Y'));
            })
            ->when(auth()->user()->hasRole('admin'), function ($query) {
                $query->with('group.community');
            })
            ->when($this->community, function ($query) {
                $query->whereRelation('group', 'community_id', $this->community);
            })
            ->when(auth()->user()->hasExactRoles('catechist'), function ($query) {
                $groups = auth()->user()->groups()->pluck('id');
                return $query->whereIn('group_id', $groups);
            })
            ->when($this->date, function ($query) {
                $query->whereDate('date', $this->date);
            })
            ->when($this->period === 'proximos', function ($query) {
                $query
                    ->whereDate('date', '>=', $this->now)
                    ->orderBy('date', 'asc');
            })
            ->when($this->period === 'realizados', function ($query) {
                $query
                    ->whereDate('date', '<=', $this->now)
                    ->with('students')
                    ->orderBy('date', 'desc');
            })
            ->paginate();

        return view('livewire.encounter.index', [
            'encounters' => $encounters,
            'communities' => $communities ?? null,
        ]);
    }
}
