<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DatePicker extends Component
{
    /**
     * The name attribute of the input field.
     *
     * @var string
     */
    public $name;

    /**
     * The id attribute of the input field.
     *
     * @var string
     */
    public $id;

    /**
     * The value attribute of the input field.
     *
     * @var string|null
     */
    public $value;

    /**
     * The default date for the date picker.
     *
     * @var string|null
     */
    public $defaultdate;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $id
     * @param string|null $value
     * @param string|null $defaultdate
     * @return void
     */
    public function __construct($name, $id, $value = null, $defaultdate = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->defaultdate = $defaultdate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.date-picker');
    }
}
