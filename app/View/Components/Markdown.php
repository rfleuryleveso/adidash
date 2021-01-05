<?php

namespace App\View\Components;

use Illuminate\View\Component;
use \Parsedown;

class Markdown extends Component
{
    /**
     * The content.
     *
     * @var int
     */
    public $content;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $Parsedown = new Parsedown();
        $rendered = $Parsedown->setBreaksEnabled(true)->text($this->content);
        return view('components.markdown', ['rendered' => $rendered]);
    }
}
