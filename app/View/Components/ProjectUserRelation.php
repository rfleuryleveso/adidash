<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProjectUserRelation extends Component
{
    /**
	 * The relation type.
	 *
	 * @var int
	 */
	public $relation_type;

	/**
	 * Create a new component instance.
	 * @param  int  $relation_type
	 * @return void
	 */
	public function __construct(int $relation) {
		$this->relation_type = $relation;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|string
	 */
	public function render() {
		$STATUS_COLOR = [
			0 => "is-warning",
			1 => "is-light",
			2 => "is-info",
			3 => "is-success",
		];
		$STATUS_FRIENDLY = [
			0 => "Membre",
			1 => "Client",
			2 => "Sous-chef",
			3 => "Chef",
		];
		return view('components.project-user-relation', ['relation' => $this->relation_type, 'color' => $STATUS_COLOR[$this->relation_type], 'friendly' => $STATUS_FRIENDLY[$this->relation_type]]);
    }
}
