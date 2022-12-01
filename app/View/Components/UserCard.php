<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserCard extends Component
{
    public $user;
    public $profile;
    public $interests;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user, $profile = null, $interests = [])
    {
        $this->user = $user;
        $this->profile = $profile;
        $this->interests = $interests;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-card');
    }
}
