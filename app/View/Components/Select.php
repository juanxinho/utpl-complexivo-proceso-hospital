<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * The name attribute of the select element.
     *
     * @var string
     */
    public $name;

    /**
     * The id attribute of the select element.
     *
     * @var string
     */
    public $id;

    /**
     * The options for the select element.
     *
     * @var array
     */
    public $options;

    /**
     * The selected value for the select element.
     *
     * @var string|null
     */
    public $value;

    /**
     * The placeholder for the select element.
     *
     * @var string|null
     */
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $id
     * @param array $options
     * @param string|null $value
     * @param string|null $placeholder
     * @return void
     */
    public function __construct($name, $id, $options = [], $value = null, $placeholder = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->options = $options;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.select');
    }
}
