<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TaskNotationStatus extends Component
{
    /**
     * The status.
     *
     * @var string
     */
    public $status;

    /**
     * Create a new component instance.
     * @param  string  $status
     * @return void
     */
    public function __construct($status) {
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render() {
        $STATUS_COLOR = [
            "WAITING_FOR_CHIEF" => "is-warning",
            "WAITING_FOR_STAFF" => "is-light",
            "FINISHED" => "is-success",
        ];
        $STATUS_FRIENDLY = [
            "WAITING_FOR_CHIEF" => "En attente du chef de projet",
            "WAITING_FOR_STAFF" => "En attente du staff",
            "FINISHED" => "Fini",
        ];
        return view('components.task-notation-status', ['status' => $this->status, 'color' => $STATUS_COLOR[$this->status], 'friendly' => $STATUS_FRIENDLY[$this->status]]);
    }
}
