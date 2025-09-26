<div>
    <!-- Calendar View -->
    <div class="mb-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-700">{{ $monthName }} {{ $currentYear }}</h2>
            <div class="flex gap-2">
                <button wire:click="previousMonth" class="text-gray-500 hover:text-gray-700">
                    <i class="ri-arrow-left-s-line text-2xl"></i>
                </button>
                <button wire:click="goToCurrentMonth" class="px-3 py-1 text-sm bg-primary-100 text-primary-600 rounded-md hover:bg-primary-200">
                    Hoy
                </button>
                <button wire:click="nextMonth" class="text-gray-500 hover:text-gray-700">
                    <i class="ri-arrow-right-s-line text-2xl"></i>
                </button>
            </div>
        </div>
        <div class="grid grid-cols-7 gap-1 text-center">
            <!-- Calendar Header -->
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Dom</div>
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Lun</div>
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Mar</div>
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Mié</div>
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Jue</div>
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Vie</div>
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Sáb</div>

            <!-- Empty days before the first day of the month -->
            @for ($i = 0; $i < $firstDayOfMonth; $i++)
                <div class="h-24 border-t border-gray-200 text-gray-400 pt-1"></div>
            @endfor

            <!-- Days of the month -->
            @for ($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $dayEvents = $this->getEventsForDay($day);
                    $isToday = $day == now()->day && $currentMonth == now()->month && $currentYear == now()->year;
                @endphp
                <div class="h-24 border-t border-gray-200 pt-1 relative {{ $isToday ? 'bg-blue-50 rounded' : '' }}">
                    <div class="font-medium">{{ $day }}</div>
                    <div class="space-y-1 mt-1 overflow-y-auto max-h-16">
                        @foreach ($dayEvents->take(2) as $event)
                            @php
                                $isPast = Carbon\Carbon::parse($event->start_time)->isPast();
                                $eventColor = $isPast ? 'gray' : ($event->is_public ? 'green' : 'pink');
                            @endphp
                            <div class="text-xs bg-{{ $eventColor }}-500 text-white rounded-sm px-1 truncate cursor-pointer" 
                                 title="{{ $event->title }}">
                                {{ Str::limit($event->title, 10) }}
                            </div>
                        @endforeach
                        @if ($dayEvents->count() > 2)
                            <div class="text-xs text-gray-500">+{{ $dayEvents->count() - 2 }}</div>
                        @endif
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>