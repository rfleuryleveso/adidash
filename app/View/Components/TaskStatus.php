<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TaskStatus extends Component {
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
			"WAITING_FOR_PARENT_TASK" => "is-warning",
			"WAITING" => "is-light",
			"STARTED" => "is-info",
			"FINISHED" => "is-success",
			"CANCELLED" => "is-black",
		];
		$STATUS_FRIENDLY = [
			"WAITING_FOR_PARENT_TASK" => "En attente de la tâche parente",
			"WAITING" => "En attente",
			"STARTED" => "Commencé",
			"FINISHED" => "Fini",
			"CANCELLED" => "Annulé",
		];
		return view('components.task-status', ['status' => $this->status, 'color' => $STATUS_COLOR[$this->status], 'friendly' => $STATUS_FRIENDLY[$this->status]]);
	}
}
