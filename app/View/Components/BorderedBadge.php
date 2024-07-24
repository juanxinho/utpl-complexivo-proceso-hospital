<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BorderedBadge extends Component
{
    /**
     * The color of the badge.
     *
     * @var string
     */
    public $color;

    /**
     * The text to display inside the badge.
     *
     * @var string
     */
    public $text;

    /**
     * Create a new component instance.
     *
     * @param string $color
     * @param string $text
     * @return void
     */
    public function __construct($color, $text)
    {
        $this->color = $color;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.bordered-badge');
    }
}
