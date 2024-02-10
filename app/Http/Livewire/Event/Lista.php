<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class Lista extends Component
{
    use Actions;

    public $dayLabels = array('DOM', 'SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SÁB');
    public $monthLabels = array('0', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Junho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
    public $currentYear;
    public $currentMonth;
    public $currentDay;
    public $daysInMonth;
    public $firstWeekdayOfMonth;
    public $lastWeekdayOfMonth;
    public $remainder;

    public $nextMonth;
    public $nextYear;
    public $previusMonth;
    public $previusYear;

    public $events;
    public $periodEvents;
    public $form;
    public $method;
    public $showFormModal;

    protected $queryString = [
        'currentYear' => ['except' => ''],
        'currentDay' => ['except' => ''],
        'currentMonth' => ['except' => ''],
    ];

    protected $validationAttributes = [
        'form.title' => 'Título',
        'form.description' => 'Descrição',
        'form.start_date' => 'Data de início',
        'form.start_time' => 'Horário de início',
        'form.end_date' => 'Data de término',
        'form.end_time' => 'Horário de término',
];

    public function mount($currentMonth = null, $currentYear = null)
    {
        $this->currentMonth = $currentMonth;
        $this->currentYear = $currentYear;
    }

    public function load($currentMonth, $currentYear)
    {
        $this->currentMonth = $currentMonth ?? intval(date('m'));
        $this->currentYear = $currentYear ?? intval(date('Y'));

        $date = strtotime($currentYear . '-' . $this->currentMonth);
        $this->daysInMonth = intval(date('t', $date));

        $firstDayOfMonth = date('Y-m-01', $date);
        $this->firstWeekdayOfMonth = date('w', (strtotime($firstDayOfMonth)));
        $lastDayOfMonth = date('Y-m-t', $date);
        $this->lastWeekdayOfMonth = date('w', (strtotime($lastDayOfMonth)));

        $this->remainder = $this->lastWeekdayOfMonth < 6 ? 6 - $this->lastWeekdayOfMonth : 0;
        $this->nextMonth = $this->currentMonth == 12 ? 1 : intval($this->currentMonth) + 1;
        $this->nextYear = $this->currentMonth == 12 ? intval($this->currentYear) + 1 : $this->currentYear;
        $this->previusMonth = $this->currentMonth == 1 ? 12 : intval($this->currentMonth) - 1;
        $this->previusYear = $this->currentMonth == 1 ? intval($this->currentYear) - 1 : $this->currentYear;

        $this->getEvents();
    }

    public function goToNextMonth()
    {
        $this->currentMonth = $this->nextMonth;
        $this->currentYear = $this->nextYear;
        $this->currentDay = null;
        $this->load($this->currentMonth, $this->currentYear);
    }

    public function goToPreviusMonth()
    {
        $this->currentMonth = $this->previusMonth;
        $this->currentYear = $this->previusYear;
        $this->currentDay = null;
        $this->load($this->currentMonth, $this->currentYear);
    }

    public function selectDay($day = null) {
        if($this->currentDay != $day) {
            $this->currentDay = $day;
        } else {
            $this->currentDay = null;
        }
    }

    public function getEvents()
    {
        $events = Event::query()
            ->whereMonth('start_date', $this->currentMonth)
            ->whereYear('start_date', $this->currentYear)
            ->with('user')
            ->orderBy('start_date', 'asc')->orderBy('start_time', 'asc')
            ->get();

        foreach($events as $event) {
            $event['day'] = intval(Carbon::parse($event->start_date)->format('d'));
        }
        $this->events = $events;
    }

    public function openShowModal($eventData)
    {
        $this->emit('emitOpenShowModal', $eventData);
    }

    public function openFormModal($method, $event = null)
    {
        $this->method = $method;
        $this->form = $event;
        if ($method === 'create') {
            $this->form['start_date'] = null;
            $this->form['end_date'] = null;
            $this->form['start_time'] = null;
            $this->form['end_time'] = null;
        }
        $this->showFormModal = true;
    }

    public function submitEvent()
    {
        $validate = $this->validate([
            'form.title' => 'required|string|max:255',
            'form.description' => 'required|string',
            'form.start_date' => 'required|date|after:now',
            'form.start_time' => 'nullable|date_format:H:i',
            'form.end_date' => 'nullable|date|after:form.start_date',
            'form.end_time' => 'nullable|date_format:H:i',
            ]);
        if ($this->method === 'create') {
            try {
                auth()->user()->events()->create($this->form);
                $this->notification()->success($description = 'Evento adicionado com sucesso.');
                $this->showFormModal = false;
            } catch (\Throwable $th) {
                $this->notification()->error($description = 'Ocorreu um erro ao salvar evento.');
                dd($th);
            }
        } else if ($this->method === 'edit') {
            try {
                Event::findOrFail($this->form['id'])->update($this->form);
                $this->notification()->success($description = 'Evento atualizado com sucesso.');
                $this->showFormModal = false;
            } catch (\Throwable $th) {
                $this->notification()->error($description = 'Ocorreu um erro ao atualizar evento.');
                dd($th);
            }
        }
    }

    public function removeEvent($event): void
    {
        $this->dialog()->confirm([
            'title' => 'Remover evento',
            'description' => 'Tem certeza que deseja remover o evento'.$event['title'].', do dia '.\Carbon\Carbon::parse($event['start_date'])->format('d/m/Y').'?',
            'method' => 'doRemoveEvent',
            'params' => ['event' => $event['id']],
            'acceptLabel' => 'Confirmar',
            'rejectLabel' => 'Cancelar',
        ]);
    }

    public function doRemoveEvent($event) {
        try {
            Event::query()->where('id', $event)->delete();
            $this->notification()->success($description = 'Evento removido com sucesso.');
        } catch (\Throwable $th) {
            $this->notification()->error($description = 'Ocorreu um erro ao remover evento.');
            dd($th);
        }
    }

    public function render()
    {
        $this->load($this->currentMonth, $this->currentYear);
        return view('livewire.event.lista');
    }
}
