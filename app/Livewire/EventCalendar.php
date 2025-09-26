<?php

namespace App\Livewire;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class EventCalendar extends Component
{
    public $currentMonth;
    public $currentYear;
    public $events;
    
    public function mount()
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
        $this->loadEvents();
    }
    
    public function loadEvents()
    {
        $startDate = Carbon::create($this->currentYear, $this->currentMonth, 1)->startOfMonth();
        $endDate = Carbon::create($this->currentYear, $this->currentMonth, 1)->endOfMonth();
        
        $this->events = Event::whereBetween('start_time', [$startDate, $endDate])
            ->orderBy('start_time', 'asc')
            ->get();
    }
    
    public function previousMonth()
    {
        if ($this->currentMonth == 1) {
            $this->currentMonth = 12;
            $this->currentYear--;
        } else {
            $this->currentMonth--;
        }
        $this->loadEvents();
    }
    
    public function nextMonth()
    {
        if ($this->currentMonth == 12) {
            $this->currentMonth = 1;
            $this->currentYear++;
        } else {
            $this->currentMonth++;
        }
        $this->loadEvents();
    }
    
    public function goToCurrentMonth()
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
        $this->loadEvents();
    }
    
    public function getDaysInMonthProperty()
    {
        return Carbon::create($this->currentYear, $this->currentMonth, 1)->daysInMonth;
    }
    
    public function getFirstDayOfMonthProperty()
    {
        return Carbon::create($this->currentYear, $this->currentMonth, 1)->dayOfWeek;
    }
    
    public function getMonthNameProperty()
    {
        $monthNames = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
        return $monthNames[$this->currentMonth];
    }
    
    public function getEventsForDay($day)
    {
        return $this->events->filter(function ($event) use ($day) {
            return Carbon::parse($event->start_time)->day == $day && 
                   Carbon::parse($event->start_time)->month == $this->currentMonth &&
                   Carbon::parse($event->start_time)->year == $this->currentYear;
        });
    }
    
    public function render()
    {
        return view('livewire.event-calendar', [
            'monthName' => $this->monthName,
            'daysInMonth' => $this->daysInMonth,
            'firstDayOfMonth' => $this->firstDayOfMonth,
        ]);
    }
}