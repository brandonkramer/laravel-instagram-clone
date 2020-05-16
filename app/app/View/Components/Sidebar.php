<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{

    public $title;
    public $content;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $content
     */
    public function __construct ( $title, $content )
    {
        $this->title   = $title;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render ()
    {
        return view( 'components.sidebar' );
    }

    /**
     * @return string[]
     */
    public function list ( $string )
    {
        return [
            'hallo',
            'test',
            'mayo',
            'ketchup',
            $string
        ];
    }
}
