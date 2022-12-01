<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InterestPill extends Component
{
    public $interest;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($interest)
    {
        $this->interest = $interest;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.interest-pill');
    }
}
