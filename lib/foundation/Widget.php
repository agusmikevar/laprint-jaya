<?php

namespace Bsb\Foundation;

use Bsb\Foundation\Database\{
    BuildWhere,
    Transaction,
};

abstract class Widget
{
    use BuildWhere, Transaction;

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    abstract public function touch($request);
}
