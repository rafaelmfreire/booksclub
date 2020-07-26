<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $type;
    public $pattern;
    public $maxlength;
    public $title;
    public $value;
    public $step;
    public $min;
    public $max;
    public $disabled;

    public function __construct($name, $type = 'text', $pattern = null, $maxlength = null, $title = null, $value = null, $disabled = false, $step = null, $min = null, $max = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->pattern = $pattern;
        $this->maxlength = $maxlength;
        $this->title = $title;
        $this->value = $value;
        $this->step = $step;
        $this->min = $min;
        $this->max = $max;
        $this->disabled = $disabled;
    }

    public function render()
    {
        return view('components.input');
    }
}
