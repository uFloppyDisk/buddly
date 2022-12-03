<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserDemographic extends Component
{
    public $birthdate;
    public $gender;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($birthdate, $gender = null)
    {
        $this->birthdate = $birthdate;
        $this->gender = $gender;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-demographic');
    }
}
