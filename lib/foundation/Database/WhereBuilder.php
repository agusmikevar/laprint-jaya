<?php

namespace Bsb\Foundation\Database;

use Illuminate\Support\Str;

class WhereBuilder
{
    /**
     * The index on queue.
     * 
     * @var string
     */
    private $queueIndex = '';

    /**
     * The column on queue.
     * 
     * @var string
     */
    private $queueColumn = '';

    /**
     * Injected request.
     * 
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Store the wheres.
     * 
     * @var array
     */
    private $wheres = [];

    /**
     * Set the request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Bsb\Foundation\Database
     */
    public function with($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Set the index to be built.
     * 
     * @param  string  $index
     * @return \Bsb\Foundation\Database
     */
    public function index($index)
    {
        $this->queueIndex = $index;
        $this->queueColumn = $index;

        return $this;
    }

    /**
     * Set the column to be built
     * 
     * @param  string  $column
     * @return \Bsb\Foundation\Database
     */
    public function column($column)
    {
        $this->queueColumn = $column;

        return $this;
    }

    /**
     * Execute the mode.
     * 
     * @param  string  $mode
     * @param  array   $args
     * @return \Bsb\Foundation\Database
     */
    public function mode($mode, $args = [])
    {
        $args = is_array($args) ? $args : explode('|', $args);

        $mode = Str::camel($mode);
        $this->{$mode.'Mode'}(...$args);

        return $this;
    }

    /**
     * @return void
     */
    public function booleanMode()
    {
        $queueIndex = $this->queueIndex;
        $queueColumn = $this->queueColumn;
        $request = $this->request;

        if ($request->query($queueIndex, '*') !== '*') {
            $this->wheres[] = [
                $queueColumn, $request->boolean($queueIndex)
            ];
        }
    }

    /**
     * @return void
     */
    public function stringMode($leftWildcard = '%', $rightWildCard = '%')
    {
        $queueIndex = $this->queueIndex;
        $queueColumn = $this->queueColumn;
        $request = $this->request;

        $this->wheres[] = [
            $queueColumn, 'like', $leftWildcard . $request->query($queueIndex, '') . $rightWildCard
        ];
    }

    /**
     * @return void
     */
    public function strictStringMode()
    {
        $queueIndex = $this->queueIndex;
        $queueColumn = $this->queueColumn;
        $request = $this->request;
        $value = $request->query($queueIndex, '*');

        if ($value !== '*') {
            $this->wheres[] = [
                $queueColumn, '=', $value
            ];
        }
    }

    /**
     * @return void
     */
    public function nullableStringMode($leftWildcard = '%', $rightWildCard = '%')
    {
        $queueIndex = $this->queueIndex;
        $queueColumn = $this->queueColumn;
        $request = $this->request;

        $this->wheres[] = [
            function ($query) use (
                $queueColumn,
                $queueIndex,
                $leftWildcard,
                $rightWildCard,
                $request
            ) {
                return $query->where(
                    $queueColumn,
                    'like', 
                    $leftWildcard.$request->query($queueIndex, '').$rightWildCard
                )->orWhereNull($queueColumn);
            }
        ];
    }

    /**
     * @return void
     */
    public function idMode()
    {
        $queueIndex = $this->queueIndex;
        $queueColumn = $this->queueColumn;
        $request = $this->request;
        $value = $request->query($queueIndex, '*');

        if ($value !== '*') {
            $this->wheres[] = [
                $queueColumn, $value
            ];
        }
    }

    /**
     * @return void
     */
    public function booleanToTimestampMode()
    {
        $queueIndex = $this->queueIndex;
        $queueColumn = $this->queueColumn;
        $request = $this->request;
        
        if ($request->query($queueIndex, '*') !== '*') {
            $value = $request->boolean($queueIndex);
            $this->wheres[] = [
                $value
                    ?   (fn ($query) => $query->whereNotNull($queueColumn))
                    :   (fn ($query) => $query->whereNull($queueColumn))
            ];
        }
    }

    /**
     * Get the wheres collection.
     * 
     * @return array
     */
    public function toArray()
    {
        return $this->wheres;
    }

    /**
     * Prettier version of "toArray" method.
     * 
     * @return array
     */
    public function done()
    {
        return $this->toArray();
    }
}
