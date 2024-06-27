<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DatePicker extends Component
{
    public $name;
    public $id;
    public $value;
    public $defaultdate;

    public function __construct($name, $id, $value = null, $defaultdate = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->defaultdate = $defaultdate;
    }

    public function render()
    {
        return view('components.date-picker');
    }
}

