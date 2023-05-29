<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Updated extends Component {


    public $date;
    public $name;

    public function __construct($date, $name)
    {
        $this->date = $date;
        $this->name = $name;
    }

    public function render () {
        return view('components.updated');
    }
}