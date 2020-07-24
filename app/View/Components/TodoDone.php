<?php

namespace App\View\Components;

use App\Todo;
use Illuminate\View\Component;

class TodoDone extends Component
{
    public $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function render()
    {
        return view('components.todo-done');
    }
}
