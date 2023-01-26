<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    public $dayLabels = array('DOM', 'SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SÁB');
    public $monthLabels = array('0', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Junho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
    public $currentYear;
    public $currentMonth;
    public $daysInMonth;
    public $firstWeekdayOfMonth;
    public $lastWeekdayOfMonth;
    public $remainder;


    public $nextMonth;
    public $nextYear;
    public $previusMonth;
    public $previusYear;

    public $events;

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

    public function getEvents()
    {
        $this->events = Event::whereMonth('starts_at', $this->currentMonth)->get();
        foreach($this->events as $event) {
            $event['day'] = Carbon::parse($event->starts_at)->format('d');
        }
    }

    public function openShowModal($eventData)
    {
        $this->emit('emitOpenShowModal', $eventData);
    }

    public function render()
    {
        $this->load($this->currentMonth, $this->currentYear);
        return view('livewire.event.calendar');
    }
}
