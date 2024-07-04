<div>
    @if ($step == 1)
        @livewire('appointment-wizard.patient-information-step')
    @elseif ($step == 2)
        @livewire('appointment-wizard.select-specialty-step')
    @elseif ($step == 3)
        @livewire('appointment-wizard.select-medic-step')
    @elseif ($step == 4)
        @livewire('appointment-wizard.select-date-time-step')
    @elseif ($step == 5)
        @livewire('appointment-wizard.confirm-appointment-step')
    @endif
</div>
