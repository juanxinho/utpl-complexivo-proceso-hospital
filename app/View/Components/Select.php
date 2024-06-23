<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $id;
    public $options;
    public $value;
    public $placeholder;

    public function __construct($name, $id, $options = [], $value = null, $placeholder = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->options = $options;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.select');
    }
}
