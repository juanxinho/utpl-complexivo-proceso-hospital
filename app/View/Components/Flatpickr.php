<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Flatpickr extends Component
{
    public $id;
    public $name;
    public $dateFormat;
    public $maxDate;
    public $value;

    public function __construct($id, $name, $dateFormat = 'd-m-Y', $maxDate = null, $value = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->dateFormat = $dateFormat;
        $this->maxDate = $maxDate;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.flatpickr');
    }
}
