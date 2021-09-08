<?php

namespace Bsb\Foundation\Database;

trait BuildExtent
{
    /**
     * @return \Bsb\Foundation\Database\ExtentBuilder
     */
    public function buildExtent()
    {
        return new ExtentBuilder();
    }
}
