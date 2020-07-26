<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $name, $value, $rows;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $value = null, $rows = 5)
    {
        $this->name = $name;
        $this->value = $value;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.textarea');
    }
}
