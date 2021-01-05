<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TaskTag extends Component
{
    /**
     * The tag.
     *
     * @var string
     */
    public $tag;
    
    /**
     * Create a new component instance.
     * @param  string  $color
     * @param string $icon
     * @return void
     */
    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.task-tag', ['tag'=>$this->tag]);
    }
}
