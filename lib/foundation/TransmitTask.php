<?php

namespace Bsb\Foundation;

trait TransmitTask
{
    /**
     * @param  \Bsb\Foundation\Task  $task
     * @param  \Illuminate\Http\Request  $request
     * @param  ...$args
     * @return void
     */
    public function transmit(Task $task, $request, ...$args)
    {
        return $task->handle($request, ...$args);
    }
}
