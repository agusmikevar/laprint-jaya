<?php

namespace Bsb\Foundation\Database;

trait BuildWhere
{
    /**
     * @return \Bsb\Foundation\Database\WhereBuilder
     */
    public function buildWhere()
    {
        return new WhereBuilder();
    }
}
