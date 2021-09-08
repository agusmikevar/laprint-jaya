<?php

namespace Bsb\Foundation;

trait RevealWidget
{
    /**
     * @param  \Bsb\Foundation\Widget  $widget
     * @param  \Illuminate\Http\Request  $request
     * @param  ...$args
     * @return void
     */
    public function reveal(Widget $widget, $request, ...$args)
    {
        return $widget->touch($request, ...$args);
    }
}
