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
    public $form;

    public $method;

    public $showFormModal;

    protected $validationAttributes = [
        'form.title' => 'Título',
        'form.description' => 'Descrição',
        'form.starts_at' => 'Data e horário de iníncio',
        'form.ends_at' => 'Data e horário de término',
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
        $this->load($this->currentMonth, $this->currentYear);
    }

    public function goToPreviusMonth()
    {
        $this->currentMonth = $this->previusMonth;
        $this->currentYear = $this->previusYear;
        $this->load($this->currentMonth, $this->currentYear);
    }

    public function selectDay($day) {
        if($this->currentDay != $day) {
            $this->currentDay = $day;
        } else {
            $this->currentDay = null;
        }
    }

    public function getEvents()
    {
        $this->events = Event::query()
            ->whereMonth('starts_at', $this->currentMonth)
            ->whereYear('starts_at', $this->currentYear)
            ->with('user')
            ->orderBy('starts_at', 'asc')
            ->get();

        foreach($this->events as $event) {
            $event['day'] = Carbon::parse($event->starts_at)->format('d');
        }
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
            $this->form['starts_at'] = null;
            $this->form['ends_at'] = null;
        }
        $this->showFormModal = true;
    }

    public function submitEvent()
    {
        $validate = $this->validate([
            'form.title' => 'required|string|max:255',
            'form.description' => 'required|string',
            'form.starts_at' => 'required|date|after:now',
            'form.ends_at' => 'nullable|date|after:form.starts_at',
            ]);
        if ($this->method === 'create') {
            try {
                auth()->user()->events()->create($this->form);
                $this->notification()->success($description = 'Evento adicionado com sucesso.');
                //$this->events->push($encounter);
                $this->showFormModal = false;
            } catch (\Throwable $th) {
                $this->notification()->error($description = 'Ocorreu um erro ao salvar evento.');
                dd($th);
            }
        } else if ($this->method === 'edit') {
            try {
                Event::findOrFail($this->form['id'])->update($this->form);
                $this->notification()->success($description = 'Evento atualizado com sucesso.');
                //$this->encounters = $this->group->encounters()->orderBy('date', 'asc')->with('theme')->get();
                $this->showFormModal = false;
            } catch (\Throwable $th) {
                $this->notification()->error($description = 'Ocorreu um erro ao atualizar evento.');
                dd($th);
            }
        }
    }

    public function render()
    {
        $this->load($this->currentMonth, $this->currentYear);
        return view('livewire.event.lista');
    }
}
