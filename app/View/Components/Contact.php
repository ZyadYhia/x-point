<?php

namespace App\View\Components;

use App\Models\Contact as ModelsContact;
use Illuminate\View\Component;

class Contact extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['settings']= ModelsContact::select('fb','twitter','youtube','instagram')->first();
        return view('components.contact')->with($data);
    }
}
