<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BorderedBadge extends Component
{
    public $color;
    public $text;

    public function __construct($color, $text)
    {
        $this->color = $color;
        $this->text = $text;
    }

    public function render()
    {
        return view('components.bordered-badge');
    }
}
