<div>
    @if ($step == 1)
        @livewire('patient-information-step')
    @elseif ($step == 2)
        @livewire('select-specialty-step')
    @elseif ($step == 3)
        @livewire('select-doctor-step')
    @elseif ($step == 4)
        @livewire('select-date-time-step')
    @elseif ($step == 5)
        @livewire('confirm-appointment-step')
    @endif
</div>
